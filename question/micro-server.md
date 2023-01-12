# 微服务

- nacos  ——  注册、发现平台；配置中心；动态DNS；
- 以下俩个是同等地位 选一
- grpc   ——  grpc 是一个rpc远程调用的实现，在代码中 `像调用一个类一样，去调用别的机器的接口`
- - 中文文档 http://doc.oschina.net/grpc?t=60133
- dubbo  ——  结合nacos，跟发现平台对接，传递接口serviceName；动态选择节点，使用grpc发送调用；`优化代码过程，不用显式地填写远程机器IP和端口`
- - https://dubbo.apache.org/zh/docs/quick-start/
- - 接入`nacos`: https://dubbo.apache.org/zh/docs/references/registry/nacos/
- - 透明地址发现让 `Dubbo` 请求可以被发送到任意 IP 实例上，这个过程中流量被随机分配。
- - 当项目中添加 `dubbo-registry-nacos` 后，您无需显式地编程实现服务发现和注册逻辑，实际实现由该三方包提供，接下来配置 Naocs 注册中心
```go
func main() {
	config.Load()
	user := &pkg.User{}
	err := userProvider.GetUser(context.TODO(), []interface{}{"A001"}, user)
	if err != nil {
		os.Exit(1)
		return
	}
	gxlog.CInfo("response result: %v\n", user)
}
```


## 扩展

- protobuf语言结构 `https://www.cnblogs.com/sanshengshui/p/9739521.html`
```
// 更改proto文件后 需要重新生成
protoc --go_out=. --go_opt=paths=source_relative \
    --go-grpc_out=. --go-grpc_opt=paths=source_relative \
    helloworld/helloworld.proto
```
- kafka
- kafka集群部署
- rabbitMq
- elasticsearch 集群
- go GMP调度原理
- - https://learnku.com/articles/41728
- - https://www.kancloud.cn/aceld/golang/1958304  



## TODO

- [x] 学习protobuf
- [x] 手写grpc客户端和服务端测试`在siam_go中`
- [x] nacos单机部署 
- [ ] nacos集群测试
- [ ] dubbo接入nacos

