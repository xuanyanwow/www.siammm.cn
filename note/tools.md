# 工具类型
✍️ 🚩

## Node

- 多版本切换管理 [nvs](https://github.com/jasongin/nvs)

## PHP

<details>
<summary>Xdebug</summary>

> `Http Request` -设置的host(80)-> `Xdebug` -转发给init配置中的端口 默认9000-> `Phpstorm`监听 

</details>


<details>
<summary>Xdebug的日志分析工具</summary>

[QCacheGrind](#) 、[wincachegrind](https://github.com/ceefour/wincachegrind)

> QCacheGrind默认选择的格式 跟xdebug默认生成的不同，所以要手动选为*.*

</details>

## Mysql

<details>
<summary>Canal </summary>

[canal](https://github.com/alibaba/canal)
 
 
- 外网访问在配置中`canal.ip =0.0.0.0` 指定id 或者全部
- 实例配置只配置以下3个
```
# position info
canal.instance.master.address=127.0.0.1:3306
canal.instance.master.journal.name=mysql-bin.000006
canal.instance.master.position=29595`
```

</details>


## 微服务

- 🚩 配置中心 [nacos](https://github.com/alibaba/nacos)
- 🚩 开发集成框架 [Dubbo](https://dubbo.apache.org/zh/docs/introduction/)

## Web


</details>


<details>
<summary>模拟假数据生成 [faker-js]</summary>

[faker-js](https://github.com/faker-js/faker)
```html
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Fader.js模拟数据</title>
</head>

<body>
<div class="demo">faker.js模拟数据，打开控制台看输出。</div>
// 在这里使用cdn的方式引入fake.js
<script src="https://cdn.bootcss.com/Faker/3.1.0/faker.min.js"></script>
<script type="text/javascript">
    function init() {
        faker.locale = "zh_CN";//设置数据是中文类型
        var randomName = faker.name.findName();
        var randomEmail = faker.internet.email();
        var randomCard = faker.helpers.createCard();
        var randomwebsite = faker.internet.url();
        var randomaddress = faker.address.streetAddress() + faker.address.city() + faker.address.country();
        var randombio = faker.lorem.sentences();
        var randomimage = faker.image.avatar();
        var customers = []

        for (var id = 0; id < 50; id++) {
            var firstName = faker.name.firstName()
            var lastName = faker.name.firstName()
            var phoneNumber = faker.phone.phoneNumberFormat()
            // 生成数组对象结构的数据
            customers.push({
                "id": id,
                "first_name": firstName,
                "last_name": lastName,
                "phone": phoneNumber
            })
        }

        console.log(randomName);
        console.log(randomEmail);
        console.log(randomCard);
        console.log(randomwebsite);
        console.log(randomaddress);
        console.log(randombio);
        console.log(randomimage);
        console.log(customers);
    }
    window.onloade = init()
</script>
</body>

</html>
```


</details>

- Node JS Console输出加颜色 [color-js](https://github.com/Marak/colors.js)

## JAVA

- 以有趣和好理解的方式展示Java和Web的内容教程 : How2j [How2j](https://how2j.cn/)


## Go

## Github

- 基础仓库数据api [social](https://shields.io/category/social)
- Star分析 [astral](https://app.astralapp.com/dashboard)
- Github开放api `https://api.github.com/users/x/starred?page=1&per_page=100`


## Help辅助 效率

- [Emoji速查](https://www.emojidaquan.com/common-buildings-emojis)
- [SnippetStore代码段软件](https://zerox-dg.github.io/SnippetStoreWeb/#download)
