<?php

if (!isset($_GET['key']) || ($_GET['key'] !== "siam") ){
    echo "该页暂无key查看";die;
}


echo <<<siam
# Siam个人私用

- PHP与服务端通用面试点和实战记录：[业务笔记，问题笔记](question/)
- Go语言专栏：[业务笔记，问题笔记](go/)
- 软件工具：[SiamPan](http://pan.siammm.cn/)


## 自写教程和笔记

- [个人简历](resume/index.html)
- [简易web入门学习](easy_learn_web/)
- [23种设计模式笔记](oop_note/)

siam;


