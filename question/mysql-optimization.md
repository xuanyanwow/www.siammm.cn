# mysql优化角度

- [ ] 框架业务层分析 防止逻辑导致sql运行过多
- [ ] 开启sql慢日志，查找慢日志并对sql进行分析
- [ ] 传输数据过大可能导致慢
- [ ] 索引没有建立
- [ ] 索引没有命中 可能原因 不满足最左匹配，索引字段区分度不足，模糊查询，字段数据运算
- [ ] 索引正常，但索引树层级过多（数据量大）可进行分库分表
- [ ] 缓冲池(buffer pool)过小加上业务设计不合理，导致被冲刷淘汰，需要重新读磁盘
- [ ] 查看服务器负载 mysql线程负载 可能超出单机服务量
- [ ] 读写分离配置
- [ ] 数据库机器故障，主备健康度自动切换
- [ ] 增加缓存  分布式储存



> 以下知识为扩展和详细解读

## 缓冲池机制Buffer pool

扩展问题：全量select一次之后  会对缓冲区进行大换血吗

https://blog.csdn.net/mocas_wang/article/details/110306656

- free链表(记录buffer pool还有多少个空闲的页地址)
- flush链表(记录脏页)
- lru链表(用于决定谁淘汰)
- 冷热分离   将 lru 链表分为两部分，一部分是热数据区域链表，一部分是冷数据区域链表

## 写缓存Changes buffer

它是一种应用在非唯一普通索引页(non-unique secondary index page)不在缓冲池中，对页进行了写操作，并不会立刻将磁盘页加载到缓冲池，而仅仅记录缓冲变更(buffer changes)，等未来数据被读取时，再将数据合并(merge)恢复到缓冲池中的技术。写缓冲的目的是降低写操作的磁盘IO，提升数据库性能。

索引设置了唯一(unique)属性，在进行修改操作时，InnoDB必须进行唯一性检查。也就是说，索引页即使不在缓冲池，磁盘上的页读取无法避免


什么业务场景，适合开启InnoDB的写缓冲机制？

先说什么时候不适合，如上文分析，当：

- （1）数据库都是唯一索引；
- （2）或者，写入一个数据后，会立刻读取它；

这两类场景，在写操作进行时（进行后），本来就要进行进行页读取，本来相应页面就要入缓冲池，此时写缓存反倒成了负担，增加了复杂度。

什么时候适合使用写缓冲，如果：

- （1）数据库大部分是非唯一索引；
- （2）业务是写多读少，或者不是写后立刻读取；

可以使用写缓冲，将原本每次写入都需要进行磁盘IO的SQL，优化定期批量写磁盘。

> 画外音：例如，账单流水业务。

## InnoDb和MyISAM引擎 

引擎区别 [InnoDB，5项最佳实践，知其所以然？
](https://mp.weixin.qq.com/s?__biz=MjM5ODYxMDA5OQ==&mid=2651961428&idx=1&sn=31a9eb967941d888fbd4bb2112e9602b&chksm=bd2d0d888a5a849e7ebaa7756a8bc1b3d4e2f493f3a76383fc80f7e9ce7657e4ed2f6c01777d&scene=21#wechat_redirect)

索引区别 [1分钟了解MyISAM与InnoDB的索引差异](https://mp.weixin.qq.com/s?__biz=MjM5ODYxMDA5OQ==&mid=2651961494&idx=1&sn=34f1874c1e36c2bc8ab9f74af6546ec5&chksm=bd2d0d4a8a5a845c566006efce0831e610604a43279aab03e0a6dde9422b63944e908fcc6c05&scene=21#wechat_redirect)


InnoDb引擎的高性能原因（并发控制，多版本控制，Redo Log Undo Log实现等）   [InnoDB并发如此高](https://mp.weixin.qq.com/s?__biz=MjM5ODYxMDA5OQ==&mid=2651961444&idx=1&sn=830a93eb74ca484cbcedb06e485f611e&chksm=bd2d0db88a5a84ae5865cd05f8c7899153d16ec7e7976f06033f4fbfbecc2fdee6e8b89bb17b&scene=21#wechat_redirect)

- redo日志用于保障，已提交事务的ACID特性。
- undo日志用于保障，未提交事务不会对数据库的ACID特性产生影响。


## Mysql刷盘过程出现页损坏

从上面的知识我们可以得知，Mysql 增删改查都是在`内存页`中和`redo log`中进行，并不是真实落地到磁盘

后续落地到磁盘的过程中，可能会出现写多个页然后突然停电等异常情况，`页损坏`，Mysql是如何保障的？

double writer buffer，  双写，先写DWB磁盘（顺序追加磁盘，性能不会下降很多），再去写真实数据磁盘


写DWB磁盘异常的话可以丢弃，从磁盘+redo log恢复到内存页（磁盘判定页数据不完整 页损坏），尝试从double writer文件恢复到磁盘中

如果 double write 中的数据页被写坏了怎么办？

因为是先往共享表空间中写double write数据页，再往各个表对应的表空间文件中写实际的数据页，如果double write中的数据页坏点了，那恰恰说明，各个表对应的表空间文件中的数据页没坏！恢复的流程不会被打断！

## redo log 日志刷盘机制

redo log是一种顺序写，它有三层架构：
- （1）MySQL应用层：Log Buffer
- （2）OS内核层：OS cache
- （3）OS文件：log file

`innodb_flush_log_at_trx_commit`  推荐设置为2

![图片](https://img-blog.csdnimg.cn/img_convert/386b4542c4a4ce8c2081d4a1e2700618.png)


不同的配置 可能让`已提交事务出现数据丢失`的情况   

[文章解释](https://blog.csdn.net/shenjian58/article/details/124030259?spm=1001.2014.3001.5501)

## Mysql哈希索引


- （1）InnoDB用户无法手动创建哈希索引，这一层上说，InnoDB确实不支持哈希索引；
- （2）InnoDB会自调优(self-tuning)，如果判定建立自适应哈希索引(Adaptive Hash Index, AHI)，能够提升查询效率，InnoDB自己会建立相关哈希索引，这一层上说，InnoDB又是支持哈希索引的


> 不支持用户自建hash的原因：  行数多则索引过大  占用内次和磁盘IO  

查询路线 回表次数多等情况

![图片](https://img-blog.csdnimg.cn/img_convert/79b57524a83c1a5782d683be3ca53de1.png)
![图片](https://img-blog.csdnimg.cn/img_convert/1390c61e095abc981bcc26e7b4036de4.png)
