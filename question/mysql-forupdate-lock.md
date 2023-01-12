# mysql for update锁的一些小问题

## mysql条件查询不存在行，使用for update加锁的分析

https://blog.csdn.net/wj310298/article/details/79972337


假设现有数据id 为：1,2,3,4,7,8


for update id = 5  数据不存在，转为间隙锁(gap) 锁的数据为 [4,7]


此时如果有另一个事务插入 id=6 将会被堵塞，直到for update事务释放才能执行插入
