sumradio
一个点歌管理系统
========
简介
============================
开发代号：sumradio

一个使用PHP MySQL开发的点歌台程序，适用于各类学校广播站的点歌节目的点歌单收集，可以兼容各种PC浏览器和手机浏览器。并且提供windows Phone API

程序设计：qwe7002

前端设计：Addams_Chen,qwe7002

如何安装
============================
请编辑/config/文件夹下的配置文件，填写好您的mysql数据库用户名，密码，数据库名称以及网站名称。

初始用户为 admin，密码123456。请注意后台密码拥有清空数据库的权限，请设置的稍微复杂以避免猜测。

登录 ssh,安装 mysql-python软件包后，执行 python install/setup.py <用户名> <密码> <数据库名>导入数据库信息，您也可以直接使用其他方法导入 install.sql 来完成安装。

设置好您的apache，nginx（本程序建议使用apache，当然这并不代表您不能使用IIS，事实上它适用于任何一个能执行PHP的服务器程序）

需要自行设置的计划任务
============================
本系统拥有两个计划任务，位于 system/crontab 下，这两个程序可以为您自动备份数据库以及清理数据。请将它们设置为计划任务，并且安装好 mysql-python 扩展。

感谢
============================
优秀的开源前端框架bootstarp
