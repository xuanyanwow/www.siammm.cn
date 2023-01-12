# clickhouse 

好文章：https://www.cnblogs.com/traditional/p/15218565.html

## 为什么快

- 列式存储 减少数据IO和传输 
- 向量化执行  很好利用CPU的计算速度

## 为什么选

- 免费开源 性能不低 ，在其他厂商之间对比还是不错的方案
- 开发公司原有是使用mysql数据库，所以clickhouse中有很多mysql的影子（自定义存储引擎）
- 实现了标准的sql规范，可以使用group by in 等语句、函数、视图等，迁移成本降低
- 关系型的数据库，可以更好体现数据中的实体关系，比redis等键值数据库更好操作和查询