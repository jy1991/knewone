<?php 
  include './init.php';
  
  if(empty($_GET['child']))
  {
	$child=0;  
  }else
  {
	$child=$_GET['child'];    
  }
  $sql="SELECT id,name FROM ".PRE."category WHERE display=1 LIMIT 14";
  $result=mysql_query($sql);
  if($result && mysql_num_rows($result)>0)
  {
	$catelist=array();
	while($row=mysql_fetch_assoc($result))
	{
	  $catelist[]=$row;	
	}
  }
$where=($child==0?"":"WHERE cate_id=$child"); 
$sql="SELECT id,name,cate_id,price,stock,status,heart,sell,comment,`describe` FROM ".PRE."goods {$where} ORDER BY id ASC LIMIT 7";
$result=mysql_query($sql);
if($result && mysql_num_rows($result)>0)
{
  $productlist=array();
  while($row=mysql_fetch_assoc($result))
  {
	$productlist[]=$row;  
  }
} 

$sql="SELECT id,name FROM ".PRE."goods {$where} ORDER BY id ASC LIMIT 7";
$result=mysql_query($sql);
if($result && mysql_num_rows($result)>0)
{
  $recommendlist=array();
  while($row=mysql_fetch_assoc($result))
  {
	$recommendlist[]=$row;  
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
<link rel="stylesheet" href="css/shop.css">
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
<script type="text/javascript" src="js/drag.js"></script>
<script type="text/javascript" src="js/waterfall.js"></script>
<style>
body {
	background: #ebecee url(../images/shop/fancy_deboss.png) repeat top left;
	color: #444;
	font-size: 13px;
	font-weight: 400;
    -webkit-font-smoothing: antialiased;
    overflow-x: hidden;
    min-width: 320px;
}
</style>
</head>

<body>

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
<!--banner-->
 <div class="container">
    <div class="wrapper">

        <ul id="sb-slider" class="sb-slider">
            <li>
                <a href="#" target="_blank"><img src="images/shop/1.jpg" alt="image1"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
            <li>
                <a href="#" target="_blank"><img src="images/shop/2.jpg" alt="image2"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
            <li>
                <a href="#" target="_blank"><img src="images/shop/3.jpg" alt="image1"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
            <li>
                <a href="#" target="_blank"><img src="images/shop/4.jpg" alt="image1"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
            <li>
                <a href="#" target="_blank"><img src="images/shop/5.jpg" alt="image1"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
            <li>
                <a href="#" target="_blank"><img src="images/shop/6.jpg" alt="image1"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
            <li>
                <a href="#" target="_blank"><img src="images/shop/7.jpg" alt="image1"/></a>
                <div class="sb-description">
                    <h3>新奇酷商店 - KnewOne</h3>
                </div>
            </li>
        </ul>

        <div id="shadow" class="shadow"></div>

        <div id="nav-arrows" class="nav-arrows">
            <a href="#">Next</a>
            <a href="#">Previous</a>
        </div>
        <div id="nav-options" class="nav-options" style="display:block">
            <span id="navPlay">Play</span>
            <span id="navPause">Pause</span>
        </div>
        <div id="nav-dots" class="nav-dots">
            <span class="nav-dot-current"></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
   </div><!-- /wrapper -->
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.slicebox.js"></script>
<script type="text/javascript">
$(function() {
	var Page = (function() {
        var $navArrows = $( '#nav-arrows' ).hide(),
		    $shadow = $( '#shadow' ).hide(),
			slicebox = $( '#sb-slider' ).slicebox( {
			onReady : function() {
                   $navArrows.show();
				   $shadow.show();
                   },
					orientation : 'r',
					cuboidsRandom : true,
					disperseFactor : 30
				} ),
				init = function() {
                    initEvents();
				},
				initEvents = function() {
                   // add navigation events
		$navArrows.children( ':first' ).on( 'click', function() {
                 slicebox.next();
				 return false;
                } );
        $navArrows.children( ':last' ).on( 'click', function() {
				 slicebox.previous();
				 return false;
                 } );
		 $( '#navPlay' ).on( 'click', function() {
					slicebox.play();
					return false;
				} );
		 $( '#navPause' ).on( 'click', function() {
					slicebox.pause();
					return false;
				} );
                };
                return { init : init };
         })();
        Page.init();
    });
</script>

<!--banner-->
<!--recommend-->
 <div id="recommend" class="m0a">
   <div class="title">推荐商品</div>
    <ul class="rec_bar">
<?php
$i=0;
foreach($recommendlist as $valr) {$i++;} 
foreach($recommendlist as $valr) {
  $rand=mt_rand(0,$i-1);		
?>
<?php
$sql="SELECT id,name,is_face FROM ".PRE."image where goods_id = {$recommendlist[$rand]['id']} and is_face=1 ORDER BY id ASC";
$result =mysql_query($sql);
if($result && mysql_num_rows($result)>0){
	$rand_img_face=array();
    while($row=mysql_fetch_assoc($result)){
        $rand_img_face=$row;
    }
}
$rand_img_url='./uploads/';
$rand_img_url .=substr($rand_img_face['name'],0,4).'/';   
$rand_img_url .=substr($rand_img_face['name'],4,2).'/';
$rand_img_url .=substr($rand_img_face['name'],6,2).'/';
$rand_img_url .=$rand_img_face['name'];
?>
      <li class="fl">
        <div class="img">  
        <a href="product.php?product_id=<?php echo $recommendlist[$rand]['id']; ?>"><img src="<?php echo $rand_img_url; ?>"></a>
        </div>
        <div class="descript">
          <a href="product.php?product_id=<?php echo $recommendlist[$rand]['id']; ?>"><?php echo $recommendlist[$rand]['name']; ?></a>
        </div>
      </li>
    <?php } ?>  
    </ul>
 </div>
<!--recommend-->
<div id="shop" class="m0a">
  商店
</div>
<!--exploder-->
<div id="exploder" class="m0a">
  <div class="left fl">
  <div class="list">
    <h4>分类</h4>
    <div class="category m0a">
      <ul>
       <form action="shop.php" method="get">
       <?php foreach($catelist as $valc) { ?>
        <li>
        <div class="radio">
  		<a data-toggle="table" href="shop.php?child=<?php echo $valc['id'] ?>">
        <input type="radio" value="" id="radioInput" name=""  class="<?php if($valc['id']==$child) {echo 'nav_active';} ?>"/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $valc['name'] ?>
	  	<label for="radioInput"></label>
        </a>
  	    </div>
        </li>
		<?php } ?>
        </form>
      </ul>
    </div>
  </div>
 </div>
  
<!--products-->
<div id="products" class="fl">
    
  <div class="pin">
      <header class="box">
      <a href="#"><img src="images/shop/hehe.jpg"></a>
      </header>
      <section class="content">
        <h4>
         <a href="#" target="_blank" title="响应式布局 + 瀑布流">响应式布局 + 瀑布流</a>
        </h4>
      </section>
      <footer class="info">
        <span>made by</span>
        <span>纪程瀚</span>
      </footer>
  </div>
<div class="pin">
      <header class="box">
      <a href="#"><img src="images/shop/xixi.jpg"></a>
      </header>
      <section class="content">
        <h4>
         <a href="#" target="_blank" title="响应式布局 + 瀑布流">响应式布局 + 瀑布流</a>
        </h4>
      </section>
      <footer class="info">
        <span>made by</span>
        <span>纪程瀚</span>
      </footer>
  </div>
<div class="pin">
      <header class="box">
      <a href="#"><img src="images/shop/haha.jpg"></a>
      </header>
      <section class="content">
        <h4>
         <a href="#" target="_blank" title="响应式布局 + 瀑布流">响应式布局 + 瀑布流</a>
        </h4>
      </section>
      <footer class="info">
        <span>made by</span>
        <span>纪程瀚</span>
      </footer>
  </div>    
  


   
  
  
  
<!--products-->
      
</div> 
<!--exploder-->
<div class="cb"></div>
 </div>
 
<!--body-->
</body>
</html>