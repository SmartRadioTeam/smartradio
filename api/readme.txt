#smuradio Api信息
***
#目录信息
* /api/command(前端ajax请求api)
* /api/admin_control(后台操作api)
#请求操作
##点歌信息查询
地址：/api/command/index.php

方法：Get

返回：json

例子：
{
   "projcetname":"",项目名称
   "permission":"0",//是否允许点歌
   "notice":"notice",//通知信息
   "cleantime":"",//已播出数据清理时间
   "lostandfound":[]//失物招领信息(数组)
   "songinfo":
   [
      {
      "info":"0",//此条点歌的状态,0为未播放，1为无法播放，2为已播放
      "songtitle":"8080080",//歌曲名
      "songcover":"http://",//专辑图地址
      "songurl":"http://",//歌曲地址
      "user":"测试用户",//点歌人信息
      "to":"测试用户",//赠送对象信息
      "message"："asdfghjkl"//最想说的话信息
      }
   ]
}

##提交点歌接口
地址：/api/command/update.php 

方法：Post

返回：字符串

该api需要提交以下字段
