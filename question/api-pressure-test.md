# API压力测试

- ab
- wrk —— 多线程，性能更好




api压测 2HG 2M 压测结果1400请求 达到140qps


压测1H2G1M 个人测试主机

apisix网关 空跑反向代理百度 9000请求 qps `240`

反向代理TP6 开启opacache，查询一次数据库，qps `110`


