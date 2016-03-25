<?php
include './init.php';

$product_id=$_GET['product_id'];
$sql="SELECT id,name,price,stock,status,heart,sell,comment,`describe` FROM ".PRE."goods WHERE id={$product_id}";
$result=mysql_query($sql);
if($result && mysql_num_rows($result)>0)
{
  $product=array();
  while($row=mysql_fetch_assoc($result))
  {
	$product[]=$row;  
  }
}

if(empty($_SESSION['home']))
{
  $buy_num=1;	
}else
{
  $sql="SELECT * FROM ".PRE."cart WHERE person_id={$_SESSION['home']['id']} AND product_id={$product_id} ";
  $result=mysql_query($sql);
  $cart='';
  if($result && mysql_num_rows($result)>0)
  {
	$cart=mysql_fetch_assoc($result);
	$buy_num=$cart['qty']; 
  }else
  {
    $buy_num=1;
  }
  
}
?>

<!doctype html>
<html>
<head>
<?php foreach($product as $valp){ ?>
<meta charset="utf-8">
<meta name="author" content="纪程瀚">
<meta name="description" content="一期项目">
<meta name="keywords" content="KnewOne, 剁手网, 新奇酷, 科技, 设计, 产品, 使用, 经验, 评测">
<title><?php echo $valp['name'] ?></title>
<link rel="shortcut  icon" type="image/x-icon" href="favicon.ico" media="screen" /> 
<link rel="stylesheet" href="css/product.css">
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
    var flag=0;
    $(function(){
    var aPage=$("#banner .page a");
	var aImg=$("#banner .box img");
	var iSize=aImg.size();
	index=0;
    var t=setInterval(function(){
		index++;
		if(index>(iSize-1))
		{
		  index=0;	
		}
		change();
	},2000);
	$("#banner .box").mouseout(function(){
	 var t=setInterval(function(){
		index++;
		if(index>(iSize-1))
		{
		  index=0;	
		}
		change();
	},2000);
	});
	$("#banner .box").hover(function(){
	 window.clearInterval(t);
	});
	$("#banner .btnLeft").click(function(){
		aImg.stop();
		index--;
		if(index<0)
		{
		  index=iSize-1;	
		}
		change();
	});
	$("#banner .btnRight").click(function(){
		aImg.stop();
		index++;
		if(index>(iSize-1))
		{
		  index=0;	
		}
		change();
	});
	
	aPage.click(function(){
	  aImg.stop();
	  index=$(this).index();
	  change();
	});
	function change()
	{
	  aPage.removeClass("active");
	  aPage.eq(index).addClass("active");
	  aImg.stop();
	  aImg.eq(index).siblings().animate({opacity:0},2000);
	  aImg.eq(index).animate({opacity:1},2000); 	
	}
	
	$(".container #main .footer .lookall").click(function(){
	  	if(flag==0)
		{
		 $(".container #main .content").css("height","auto");
		 flag=1;
		}else
		{
		 $(".container #main .content").css("height","204px");
		 flag=0;	
		}
	})
})
</script>
<script>
function back()
{
  window.location.href="index.php";
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
      <li class="product change"><a href="#"><span class="trangle">产品</span></a></li>
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
<!--container-->
<div class="container m0a">
  <div id="main">
    <div class="thing_header">
      <h1 class="m0a"><?php echo $valp['name'] ?></h1>
      <h5 class="m0a">没有写简介这个字段</h5>
    </div>
    <div class="nav m0a">
      <ul>
      <li style="border-bottom:solid 2px #47b2e2;">
      <a href="#">产品</a>
      </li>
      <li>
      <a href="#">评测</a>
      </li>
      <li>
      <a href="#">讨论</a>
      </li>
      <li>
      <a href="#">动态</a>
      </li>
      </ul>
    </div>
    <div id="banner">
  <a class="btnLeft" id="btnLeft" href="javascript:void(0);"></a>
  <a class="btnRight" id="btnRight" href="javascript:void(0);"></a>
  <div class="box">
<?php
$sql="SELECT id,name FROM ".PRE."image where goods_id = {$valp['id']} ORDER BY id ASC LIMIT 3";
$result =mysql_query($sql);
if($result && mysql_num_rows($result)>0){
	$product_img=array();
    while($row=mysql_fetch_assoc($result)){
        $product_img[]=$row;
    }
}
foreach($product_img as $valpi){
$product_img_url='./uploads/';
$product_img_url .=substr($valpi['name'],0,4).'/';   
$product_img_url .=substr($valpi['name'],4,2).'/';
$product_img_url .=substr($valpi['name'],6,2).'/';
$product_img_url .=$valpi['name'];
?>
    <img style="opacity:1;filter:alpha(opacity=100);" src="<?php echo $product_img_url; ?>">
<?php } ?>
  </div>
  <div class="page">
    <a class="active" href="javascript:void(0);">1</a>
    <a href="javascript:void(0);">2</a>
    <a href="javascript:void(0);">3</a>
  </div>
    </div>
    <div class="bar">
    <img src="images/product/gundong.jpg">
    </div>
    <div class="author">
      <p class="author_name">
        <img src="images/index/a24dde7d03895cba461f0abbac912992.jpg">
        <span>分享者 超能ventus</span>
      </p>
      <p class="error">纠错</p>
    </div>
  
  <div class="content">
    <p>
     <?php echo $valp['describe'] ?>
    </p>
   </div>
   <div class="footer">
     <span class="lookall">查看全部</span>
   </div>
  </div>
  
  <div id="side">
    <div class="shop">
      <header class="header">
      <span class="price">￥<?php echo $valp['price'] ?></span>
      </header>
      <div class="buy_box">
        <form id="new_cart_item" name="new_cart" action="do_cart.php?a=new" method="post">
          <input type="hidden" name="gid" value="<?php echo $product_id; ?>">
          <select id="kind" name="kind">
            <option value="">请选择型号</option>
          </select>
          <input id="buy_number" type="number" name="qty" value="<?php echo $buy_num; ?>" min="1" max="<?php echo $valp['stock'] ?>">
          <input type="hidden" name="stock" value="<?php echo $valp['stock'] ?>">
          <p class="buy_max">最多可购买&nbsp;<span><?php echo $valp['stock'] ?></span>&nbsp;件</p>
        </form>
      </div>
      <?php if(!empty($_SESSION['home']))
	  {
		if($valp['status']==1)
		{   
          echo '<button class="buy_btn" id="add_cart" onClick="document.new_cart.submit()">加入购物车</button>'; 
		}else
		{
		  echo '<button class="buy_btn" id="add_cart">商品已下架</button>'; 	
		}
	  }else
	  {
	  echo '<button class="buy_btn" id="add_cart" onClick="back();">请先登录</button>';  
	  }
	  ?>
      <button class="contact" name="contact" value="">联系客服</button>
      <div class="cb"></div>
    </div>
    <div class="merchant m0a">
      <p>
      <span>由</span> KnewOne <span>发货并提供</span> 售后服务
      </p>
    </div>
  </div>
</div>

<!--container-->
<?php } ?>
</body>
</html>