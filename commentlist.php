<?php 
  include './init.php';
  
  if(empty($_SESSION['home']))
  {
	header("location:index.php");  
  }
  $sql="SELECT * FROM ".PRE."comment WHERE customer_id='{$_SESSION['home']['id']}' ORDER BY addtime DESC";
  $result = mysql_query($sql);
  $commentlist=array();
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $commentlist[]=$row;  
	}
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
<link rel="stylesheet" href="css/commentlist.css">
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
<script>
function new_address()
{
  window.location.href='new_address.php';	
}
</script>
</head>

<body style="background-color:#ebecee;">
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

<div class="list fr">
    <div class="title">
      <h2>账户</h2>
    </div>
    <ul>
      <li>
        <a href="#">个人信息</a>
      </li>
      <li>
        <a href="account_info.php">账户信息</a>
      </li>
      <li>
        <a href="#">通知设置</a>
      </li>
      <li class="li_active">
        <a href="#">我的评价</a>
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
  
<?php foreach($commentlist as $valc){ 

  $sql="SELECT * FROM ".PRE."goods WHERE id='{$valc['goods_id']}'";
  $result = mysql_query($sql);
  $goods='';
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $goods=$row;  
	}
  }


?>

  <div class="title fl">
    <h1 class="fl">评价信息</h1>
    <div class="cb"></div>

    <div class="number">订单编号: <?php echo $valc['order_number']; ?></div>
    
    <div class="time">
	<?php 
	$time=substr($valc['addtime'],0,4).'-';
	$time.=substr($valc['addtime'],4,2).'-';
	$time.=substr($valc['addtime'],6,2).'&nbsp;&nbsp;';
	$time.=substr($valc['addtime'],8,2).':';
	$time.=substr($valc['addtime'],10,2).':';
	$time.=substr($valc['addtime'],12,2);
	echo $time;
	?>
    </div>

  <div class="content fl">
    <div class="area">
    <ul>
    <?php 
      $sum=0;
	 ?>
      <li>
      <?php
	  $sql="SELECT * FROM ".PRE."goods WHERE id={$valc['goods_id']}";
	  $result=mysql_query($sql);
	  $goods=array();
	  if($result && mysql_num_rows($result)>0)
	  {
		$goods=mysql_fetch_assoc($result);  
	  }
	  
	  $sql="SELECT name FROM ".PRE."image WHERE goods_id={$valc['goods_id']} AND is_face=1";
	  $result=mysql_query($sql);
	  $img=array();
	  if($result && mysql_num_rows($result)>0)
	  {
		$img=mysql_fetch_assoc($result);  
	  }
	  $img_url=URL.'/uploads/';
	  $img_url.=substr($img['name'],0,4).'/';
	  $img_url.=substr($img['name'],4,2).'/';
	  $img_url.=substr($img['name'],6,2).'/';
	  $img_url.='/80_'.$img['name'];
	  ?>
         <img src="<?php echo $img_url; ?>">
         <div class="name fl">
            <p><?php echo $goods['name'] ?></p>
            <p class="kind">任意型号</p>
         </div>
         <span style="color:#47b2e2; font-size:1.3em; line-height:30px;">￥<?php echo $goods['price'] ?></span>
      </li>
      <?php
	    $sum+=$total;
	  ?>
    
      <div class="provide">
        <span>以上商品由 Knewone 提供</span>
      </div>
    </ul>
  </div>
    <div class="bottom">
      <div class="bar">
      <span>评价内容：</span>
     <textarea id="comment" class="fl" rows="10" cols="80" disabled style="padding:20px; color:#47b2e2; font-size:1.2em;"><?php echo $valc['content']; ?></textarea>
      <span style="margin-left:40px;">评星：</span>
      <select class="star" disabled>
      <option value="1" <?php if($valc['star']==1){echo 'selected';} ?>>1</option>
      <option value="2" <?php if($valc['star']==2){echo 'selected';} ?>>2</option>
      <option value="3" <?php if($valc['star']==3){echo 'selected';} ?>>3</option>
      <option value="4" <?php if($valc['star']==4){echo 'selected';} ?>>4</option>
      <option value="5" <?php if($valc['star']==5){echo 'selected';} ?>>5</option>
      </select>
      
      <div class="cb"></div>
   
      <a href="action.php?a=del_comment&comment_id=<?php echo $valc['id'];?>">
        <span class="del_btn fr">删&nbsp;&nbsp;除</span>
       </a>
       </div>
	     <div class="account fr">
           <span></span>
           <span class="summary"></span>
         </div>
      </div>
  

    </div>  
     <?php } ?>    
  </div>

</div>
<!--main-->
<!--body-->
</body>

</html>