<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container" style="width: 90%;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
  <a class="navbar-brand" href="#"><?php echo Project_Name;?>管理中心</a>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<?php 
setcookie('backpage',Location_Filename,null,"/");
?>
    <li<?php if(Location_Filename == "index.php" && !isset($_GET['mode'])){echo ' class="active"';}?>><a href="index.php">今日播放</a></li>
<li<?php if(Location_Filename == "index.php" && $_GET['mode'] == "selectall"){echo ' class="active"';}?>><a href="index.php?mode=selectall">全部点播</a></li>
<li<?php if(Location_Filename == "index.php" && $_GET['mode'] == "search"){echo ' class="active"';}?>><a href="#today"data-toggle="modal">点播搜索</a></li>
	<li<?php if(Location_Filename == "lostandfound.php"){echo ' class="active"';}?>><a href="lostandfound.php">寻物启示</a></li>
	<li<?php if(Location_Filename == "bansong.php"){echo ' class="active"';}?>><a href="bansong.php">禁播歌曲管理</a></li>
	<li><a href="#off"data-toggle="modal">系统设置</a></li>
	<li><a href="command/outlogin.php">退出</a></li>
          </ul>
        </div>
      </div>
    </div>