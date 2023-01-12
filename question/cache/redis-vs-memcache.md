# Redis与Memcache对比

[![xAM7Us.png](https://s1.ax1x.com/2022/09/24/xAM7Us.png)](https://imgse.com/i/xAM7Us)

1.性能
由于Redis只使用单核，而Memcached可以使用多核，所以在比较上，平均每一个核上Redis在存储小数据时比Memcached性能更高。而在100k以上的数据中，Memcached性能要高于Redis，虽然Redis最近也在存储大数据的性能上进行优化，但是比起Memcached，还是稍有逊色。

总体来讲，TPS方面redis和memcache差不多。

2.内存使用率
对于字符串键值对这样简单的数据类型储存，memcache的内存使用率更高。

如果Redis采用hash结构来做key-value存储，由于其组合式的压缩，其内存利用率会高于Memcached。

3.操作的便利性
Redis相比memecache，拥有更多的数据结构和支持更丰富的数据操作。

memecache以key-value形式存储数据，支持存储的value类型为String，二进制型。
Redis以key-value形式存储数据，支持存储的value类型相对更多，常用的数据类型主要有String、Hash、List、Set、Sorted Set。
数据操作方面，redis更好一些，不需要将数据读取到客户端中，使用了较少的网络IO次数。

在不只是需要GET/SET而需要其他复杂操作，如如排序、聚合，使用redis

4.网络模型
Redis使用单线程的IO复用模型，自己封装了一个简单的AeEvent事件处理框架，主要实现了epoll、kqueue和select，对于单纯只有IO操作来说，单线程可以将速度优势发挥到最大，但是Redis也提供了一些简单的计算功能，比如排序、聚合等，对于这些操作，单线程模型实际会严重影响整体吞吐量，CPU计算过程中，整个IO调度都是被阻塞住的。

Memcached是多线程，非阻塞IO复用的网络模型，分为监听主线程和worker子线程，监听线程监听网络连接，接受请求后，将连接描述字pipe 传递给worker线程，进行读写IO, 网络层使用libevent封装的事件库，多线程模型可以发挥多核作用，但是引入了cache coherency和锁的问题，比如，Memcached最常用的stats 命令，实际Memcached所有操作都要对这个全局变量加锁，进行计数等工作，带来了性能损耗。

5.数据存储与持久化
Redis和memcache都是将数据存储在内存中，都是内存数据库。

redis支持持久化。redis有部份数据存在硬盘上，这样能保证数据的持久性，支持数据的持久化。

Redis可以将一些很久没用到的value通过swap方法交换到磁盘。

持久化方式有RDB、AOF两种，RDB可以将存在于某一时刻的所有数据都写入硬盘里面。AOF会在执行写命令时，将被执行的写命令复制到硬盘里面。

memcache不支持持久化。 memcache把数据全部存在内存之中，断电后会挂掉，数据不能超过内存大小。

6、数据一致性（事务支持）
Memcache 在并发场景下，用cas保证一致性

redis事务支持比较弱，只能保证事务中的每个操作连续执行

## 怎么选择


如果需要缓存的数据只是key-value这样简单的结构时，我在项目里还是采用memcache，它也足够的稳定可靠。如果涉及到存储，排序等一系列复杂的操作时，毫无疑问选择redis。

如果业务中更加侧重性能的⾼效性，对持久化要求不⾼，那么应该优先选择 Memcached。

如果业务中对持久化有需求或者对数据涉及到存储、排序等一系列复杂的操作，比如业务中有排⾏榜类应⽤、社交关系存储、数据排重、实时配置等功能，那么应该优先选择 Redis。




> 综合下来，redis在大部分中小项目中的性能已经足够，同时带来数据的复杂操作便捷性，对项目的可持续扩展有较大帮助，所以我们公司选择了redis作为缓存