# 并发控制


## Cond和Channel

哪个好？

- Cond：共享内存（变量）来达到通信的效果
- - 自由度高，所以容易出错，心智负担
- - 在读取之前可以修改和删除内部数据
- Channel：使用通信来达到共享内存的效果（订阅发布）
- - 内部黑盒 ，有什么内容只有读出才知道  强调通信

管道用于协调；互斥量（锁）用于同步


好文

- http://www.icodebang.com/article/219107

## 同时最大并发控制（协程池）

- tunny    https://github.com/Jeffail/tunny
- channel 控制  



并发控制（等待子协程所有都运行完成之后才能往下）
- WaitGroup