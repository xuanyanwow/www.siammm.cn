# reids实现接口限流

## inc

- 接口 inc 接口名 
- 返回key的值，如果是1  则代表第一次，则设置ttl 自动过期

## 有序集合

- ZCOUNT key min max  返回区间内的数量 查看是否超出阈值
- ZAAD key score member 访问时间戳当score，member是访问用户id或者随意字符

## 令牌桶

- 自定义进程生产令牌
- 请求拿令牌，拿不到则不得访问

## redis-cell

redis 4.0 以后开始支持扩展模块，redis-cell 是一个用rust语言编写的基于令牌桶算法的的限流模块，提供原子性的限流功能，并允许突发流量，可以很方便的应用于分布式环境中。

```
> cl.throttle mylimit 15 30 60
1）（integer）0 # 0 表示获取成功，1 表示拒绝
2）（integer）15 # 漏斗容量
3）（integer）14 # 漏斗剩余容量
4）（integer）-1 # 被拒绝之后，多长时间之后再试（单位：秒）-1 表示无需重试
5）（integer）2 # 多久之后漏斗完全空出来
```