# 统计QPS

## Nginx 访问日志分析

```
tail -500 blog.siammm.cn.log | grep index.php | awk '{print substr($4,2,20)}'| uniq -c

# 排序和只显示前20条
tail -n 1000000000 pay.hkfocusvision.com.log | grep index.php | awk '{print substr($4,2,20)}'| uniq -c | sort -r |
head -n 20
```

