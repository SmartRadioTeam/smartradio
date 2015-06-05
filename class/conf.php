<?php
error_reporting(0); 

/*基础配置*/
define("PROJECTNAME", "三明学院点歌台");//项目名称
define("MYSQLHOST", "localhost");//主数据库地址
define("MYSQLUSER", "qwe7002");//主数据库用户名
define("MYSQLPASSWORD", "123456");//主数据库密码
define("MYSQLDB", "qwe7002_smxyradio");//主数据库名称
define("DBSWITCH", "MYSQL");//主数据库类型
/*提示文本配置*/
define("SUBMITYES", "您的信息已经成功提交到数据库，请耐心等待广播站排序播放！谢谢！"); //提交成功
define("SUBMITNO", "服务器错误！请通知管理员！管理员qq：381511791"); //提交失败
define("SUBMITHSONG", "您点播的歌曲为禁止点播歌曲，无法提交到点歌台。请更换后再提交！"); //禁止点播

/*页底脚本*/
define("TJ", '<script type="text/javascript" src="http://tajs.qq.com/stats?sId=30230785" charset="UTF-8"></script>
'); //统计脚本
define("BEIAN", "");//备案
define("ERWEIMA", "");//二维码图片地址

/*作弊配置*/
define("NOPLAY", 0);//未播放数

/*seo优化*/
define("DESCRIPTION", "三明学院学生宣传中心，三明学院广播站官方网上点歌系统。");
define("AUTHOR","");
define("KEYWORDS","三明学院_三明学院点歌台");
