<?php 
  include './init.php';
  
   $id = $_SESSION['home']['id'];
   
   $sql ="SELECT * FROM ".PRE."customer WHERE id=".$id;
   $result =mysql_query($sql);
   if($result && mysql_num_rows($result)>0)
   {
     $row = mysql_fetch_assoc($result);
   }
   
  $sql2="SELECT * FROM ".PRE."head WHERE person_id={$id}";
  $result2 = mysql_query($sql2);
  $prev_head=array();
  if($result2 && mysql_num_rows($result2))
  {
	while($row2=mysql_fetch_assoc($result2))
	{
	   $prev_head[]=$row2;  
	}
  
  $img_path = 'uploads/';
  $img_path .=substr($prev_head[0]['name'],0,4).'/';//year
  $img_path .=substr($prev_head[0]['name'],4,2).'/';//month
  $img_path .=substr($prev_head[0]['name'],6,2).'/';//days
  $img_path .='60_'.$prev_head[0]['name'];
  }else{

  $img_path="images/icon/head.png";  
	  
  }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="纪程瀚">
<meta name="description" content="一期项目">
<meta name="keywords" content="KnewOne, 剁手网, 新奇酷, 科技, 设计, 产品, 使用, 经验, 评测">
<title>个人信息 - KnewOne</title>
<link rel="shortcut  icon" type="image/x-icon" href="favicon.ico" media="screen" /> 
<link rel="stylesheet" href="css/person_info.css">
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="css/demo.css">
<link rel="stylesheet" href="css/slicebox.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css"/>

<script type="text/javascript" src="js/shop.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/modernizr.custom.46884.js"></script>

</head>

<body>
<div class="body">
<!--body-->
<!--header-->
<header id="header" role="banner">
    <div class="icon">
      <img class="pr fl" style="width:48px" src="images/icon/1.png" alt="KnewOne" title="KnewOne，根本停不下来" onMouseover="shake(this,'onmouseout')" >
    </div>
  <nav class="navbar" role="navigation">
    <div class="nav-header fl">
      <a href="#">KnewOne</a>
    </div>
    <ul class="nav-list fl">
      <li class="change"><a href="index.php">首页</a></li>
      <li class="change"><a href="#">发现</a></li>
      <li class="product change"><a href="shop.php"><span class="trangle">产品</span></a></li>
      <li class="change"><a href="#">文章</a></li>
      <li class="underline"><a href="shop.php">商店</a></li>
      <li class="change"><a href="#">小组</a></li>
      <li class="share"><a href="#"><span class="crossline"></span>分享产品</a></li>
    </ul>
    <div class="navbar_login fr">
      <a href="#" id="link" class="signin"><span class="icon">登录</span></a>
      <!---->
      <form action="./admin/dologin.php" class="drop" method="post" enctype="multipart/form-data">
            <span class="title m0a">登录</span>
            <div class="main">
            <input type="text" name="username" class="required" style="float:left" placeholder="用户名"/>
            <input type="password" style="float:right" name="pwd" placeholder="密码" />
            </div>
            <div class="group">
            <span class="remember" style="color:#999"><input type="checkbox" class="checkbox" />记住我</span> 
            <span class="forget2"><a href="#">忘记密码?</a></span>
            </div>
            <div class="action">
            <input type="submit" class="submit" value="登&nbsp;录" />
            </div>
            <div class="footer2 m0a">
            <p>
            <a class="test m0a" id="link2" class="signout" href="#" style="color:#fff; font-size:1.6em; width:80%; border-radius:20px; margin-top:16px;">注册&nbsp;<span class="name">Knewone</span>&nbsp;></a>
            </p>
            </div>
        </form>
      <!---->
    </div>
    <form id="navbar_search" class="fr" method="get" accept-charset="UTF-8" action="/search" role="search">
      <div class="search">
        <span class="search-icon fl"></span>
        <input class="form-control fr" type="search" spellcheck="false" name="q" autocomplete="off">
      </div>
    </form>
  </nav>
</header>
<!--header-->
<div class="fill"></div>
<!--main-->
<div id="main" class="m0a">
  <div class="content fl">
    <div class="title">
      <h1>个人信息</h1>
    </div>
    <form id="person_info" name="person_info" action="action.php?a=edit" method="post" enctype="multipart/form-data">
     <p class="name"><span>姓名</span><input type="text" name="name" value="<?php echo $row['name'] ?>"></p>
     <p class="head">
       <span>头像</span>
       <img src="<?php echo $img_path; ?>">
       <input type="file" name="head">
     </p>
      <p>
        <span>性别</span><input class="sex" type="radio" name="sex" value="0" <?php if($row['sex']==0){echo 'checked'; }?>><span style="width:20px; padding-left:6px;">男</span>
        <input class="sex" type="radio" name="sex" value="1" <?php if($row['sex']==1){echo 'checked'; }?>><span style="width:20px; padding-left:6px;">女</span>
      </p>
    <p><span class="area">地区</span><input type="text" name="area" value="<?php echo $row['area'] ?>"></p>
    <p><span class="web">个人网站</span><input type="text" name="web" value="<?php echo $row['web'] ?>"></p>
    <p><span class="web fl">自我描述</span><textarea name="describe" form="person_info"  class="textarea" cols="50" rows="10" wrap="physical"><?php echo $row['describe'] ?></textarea></p>
    <div class="save" onClick="document.person_info.submit()">保&nbsp;存</div>
    </form>
  </div>
  <div class="list fr">
    <div class="title">
      <h2>账户</h2>
    </div>
    <ul>
      <li class="li_active">
        <a href="#">个人信息</a>
      </li>
      <li>
        <a href="account_info.php">账户信息</a>
      </li>
      <li>
        <a href="#">通知设置</a>
      </li>
      <li>
        <a href="#">我的文章</a>
      </li>
      <li>
        <a href="#">我的草稿</a>
      </li>
    </ul>
    <div class="title">
      <h2>购买</h2>
    </div>
    <ul>
      <li>
        <a href="orderlist.php">我的订单</a>
      </li>
      <li>
        <a href="#">领养记录</a>
      </li>
      <li>
        <a href="ko.php">我的KO币</a>
      </li>
      <li>
        <a href="address.php">收货地址</a>
      </li>
      <li>
        <a href="#">优惠券</a>
      </li>
    </ul>
  </div>
</div>
<!--main-->
<!--body-->
</body>

</html>