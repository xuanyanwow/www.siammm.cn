# 读书类中私有字段是三种方法

## 反射

```php
class Foo {
 private $bar = "Foo bar!";
}
 
// 获取反射类及反射属性
$class = new \ReflectionClass(Foo::class);
$property = $class->getProperty("bar");
// 设置属性可访问
$property->setAccessible(true);
 
$foo = new Foo;
// 获取对象属性值
// 注意：只能通过 ReflectionProperty 实例的 getValue 方法访问
// 不能这样直接访问： $foo->bar;
echo $property->getValue($foo), PHP_EOL:
// 输出： Foo bar!
```

## 闭包

```php
function test($object, $property){
    return (function() use($property){
        return $this->$property;
    })->call($object);
}
```


> php7 Closure::call()  特性,旧版Php使用bindTo

## 数组

```php
class Foo {
 private $bar = "Foo bar!";
}
 
$foo = new Foo;
// 强制转型
$attrs = (array)$foo;
// 拼接key，注意 "\0" 不能改成单引号！
$key = "\0" . Foo::class . "\0" . "bar";
echo $attrs[$key], PHP_EOL;
// 输出： Foo bar!
```


- public属性， key是 属性名
- protected属性，key是 \0*\0属性名
- private属性， key是 \0类名\0属性名




# 性能

性能： 数组 > 反射 > 闭包

易用性： 闭包 > 数组 > 反射

推荐： 闭包 > 反射 > 数组
