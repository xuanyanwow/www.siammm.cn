# 架构

搜索关键词`架构师`、`架构师 分布式`

- 阿里P8架构师深度概述分布式架构 —— https://blog.csdn.net/t4i2b10x4c22nf6a/article/details/83155490
- - 主要模拟了 系统架构的进化演练
- 阿里云分享，也讲述了进化演练 —— https://www.zhihu.com/question/19627054/answer/866167564

```
分布式服务的问题和挑战：(1) 当服务越来越多时，服务URL配置管理变得非常困难，F5硬件负载均衡器的单点压力也越来越大。
(2) 当进一步发展，服务间依赖关系变得错踪复杂，甚至分不清哪个应用要在哪个应用之前启动，架构师都不能完整的描述应用的架构关系。
(3) 服务的调用量越来越大，服务的容量问题就暴露出来，这个服务需要多少机器支撑？什么时候该加机器？
(4) 服务多了，沟通成本也开始上升，调某个服务失败该找谁？服务的参数都有什么约定？
(5) 一个服务有多个业务消费者，如何确保服务质量？
(6) 随着服务的不停升级，总有些意想不到的事发生，比如 cache 写错了导致内存溢出，故障不可避免，每次核心服务一挂，影响一大片，人心慌慌，如何控制故障的影响面？服务是否可以功能降级？或者资源劣化？针对这些问题，下述的单元化架构，微服务架构以及 Serveless 架构可以一定程度解决，另外针对业务系统，需要做到业务与业务隔离、管理域和运行域分开、业务与平台隔离方可解决上述问题。

作者：阿里云网站
链接：https://www.zhihu.com/question/19627054/answer/866167564
来源：知乎
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
```
```
架构师在完成上述架构设计后，最终是需要协同利益相关方一起按项目化运作落地拿结果，那么应该如何保证利益相关方在项目落地的满意度，如何保证按照架构很好的拿到项目成功的结果呢？架构管理能力是架构师非常重要的能力。
```

![图片](https://pic1.zhimg.com/v2-df157e63e66e8e5ef7d7a9647b7a734b_r.jpg?source=1940ef5c)
![架构结果管理](https://pica.zhimg.com/v2-7c257ecbab1e652095ffa7d1366fd09c_r.jpg?source=1940ef5c)

🚩 毕玄老师个人公众号：hellojavacases  系统架构师如何做好系统设计？



## 架构演进历史

### 单体架构

![img](http://file.siammm.cn/picgo/v2-71bb258b18f50b680fa0edbc980a954a_720w.jpg)

### 水平分层架构

**缓存与读写分离**

![img](http://file.siammm.cn/picgo/v2-c7ccbdbd98bf2006fff201f27f41f300_720w.jpg)

**动静分离**

![img](http://file.siammm.cn/picgo/v2-20c691b220b1513a133bef1c9d24de9f_720w.jpg)



**集群化高可用架构**

![img](http://file.siammm.cn/picgo/v2-203cf6de1e3b180141f26554d3add2f8_720w.jpg)

**业务拆分与分布式**

![img](http://file.siammm.cn/picgo/v2-f24231dafa70ba95a2f84262471dadfc_720w.jpg)

### 微服务架构



![img](http://file.siammm.cn/picgo/v2-1ba2382b9c83d40703b4bf73338acf55_720w.jpg)



![img](http://file.siammm.cn/picgo/v2-b4ce0e2cb9b2bbec1c3ce492d22f38f0_720w.jpg)

### Serverless架构