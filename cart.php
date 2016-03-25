<?php 
  include './init.php';
  if(empty($_SESSION['home']))
  {
	header("location:index.php");  
  }
  $sql="SELECT * FROM ".PRE."cart WHERE person_id={$_SESSION['home']['id']}";
  $result = mysql_query($sql);
  $cart=array();
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $cart[]=$row;  
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
<title>新奇酷商店 - KnewOne</title>
<link rel="shortcut  icon" type="image/x-icon" href="favicon.ico" media="screen" /> 
<link rel="stylesheet" href="css/cart.css">
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="css/demo.css">
<link rel="stylesheet" href="css/slicebox.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css"/>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css"/>

<script type="text/javascript" src="js/shop.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/modernizr.custom.46884.js"></script>
<script>
function order()
{
  window.location.href='action.php?a=order';	
}
</script>

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
      <form action="./admin/dologin.php" class="drop" method="post">
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
<div id="main">
  <div class="title"><p>购物车</p></div>
  <div class="area">
    <ul>
    <?php 
	if(!empty($cart))
	{
	  $sum=0;
	  $all=0;
	  foreach($cart as $valc) { ?>
      <li>
      <?php
	  $sql="SELECT * FROM ".PRE."goods WHERE id={$valc['product_id']}";
	  $result=mysql_query($sql);
	  $goods=array();
	  if($result && mysql_num_rows($result)>0)
	  {
		$goods=mysql_fetch_assoc($result);  
	  }
	  
	  $sql="SELECT name FROM ".PRE."image WHERE goods_id={$valc['product_id']}";
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
         <div class="cal_price">
          <span class="unit_price">￥<?php echo $goods['price'] ?></span>
           <a href="do_cart.php?a=min&gid=<?php echo $goods['id']; ?>"><span class="min" <?php if($valc['qty']=='1'){ echo 'style="background:#ccc;"'; } ?>>-</span></a>
           <span class="num"><?php echo $valc['qty']; ?></span>
           <a href="do_cart.php?a=add&gid=<?php echo $goods['id']; ?>"><span class="add" <?php if($valc['qty']==$goods['stock']){ echo 'style="background:#ccc;"'; } ?>>+</span></a>
           <span class="sum"><?php $total=$goods['price']*$valc['qty']; echo $total; ?></span>
           <span class="del"><a href="do_cart.php?a=del&gid=<?php echo $goods['id']; ?>">删除</a></span>
         </div>
      
      </li>
      <?php
	    $sum+=$total;
		$all+=$valc['qty'];

	  ?>
      <?php  } ?>
      <div class="provide">
        <span>以上商品由 Knewone 提供</span>
      </div>
    </ul>
  </div>
    <div class="bottom">
      <div class="bar">
         <a href="#">
           <span class="account_btn fr" onClick="document.form_order.submit();">结&nbsp;&nbsp;算</span>
         </a>
         <div class="account fr">
           <span>总计<i>(不含运费)</i></span>
           <span class="summary">￥<?php echo $sum; ?></span>
         </div>
      </div>
    <?php }else{ ?>
      <span class="null fr">这家伙很懒，什么都没留下。。。</span>
    <?php } ?>
    </div>           
	<?php 
	echo '<form action="action.php?a=order" name="form_order" method="post" >';
	echo '<input type="hidden" name="sum" value="'.$sum.'">';
	echo '<input type="hidden" name="all" value="'.$all.'">';
	echo '</form>';
	?>
</div>
<!--main-->
<!--body-->
</body>

</html>