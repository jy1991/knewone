<?php
  include './init.php';
  include './yzmfunc.php';
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
$sql="SELECT id,name,cate_id,price,stock,status,heart,sell,comment,`describe` FROM ".PRE."goods {$where} ORDER BY id ASC  LIMIT 7";
$result=mysql_query($sql);
if($result && mysql_num_rows($result)>0)
{
  $productlist=array();
  while($row=mysql_fetch_assoc($result))
  {
	$productlist[]=$row;  
  }
} 


  $sql2="SELECT * FROM ".PRE."head WHERE person_id={$_SESSION['home']['id']}";
  $result2 = mysql_query($sql2);
  $prev_head=array();
  if($result2 && mysql_num_rows($result2))
  {
	while($row2=mysql_fetch_assoc($result2))
	{
	   $prev_head[]=$row2;  
	}
  
  $img_path =URL.'/uploads/';
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
<title>KnewOne - 分享科技与设计产品，发现更好的生活</title>
<link rel="shortcut  icon" type="image/x-icon" href="favicon.ico" media="screen" /> 
<link rel="stylesheet" href="css/index.css">
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css"/>
<link rel="stylesheet" type="text/css" href="css/register.css"/>
<link rel="stylesheet" type="text/css" href="css/yzmstyle.css"/>
<script>
$(document).ready(function(){
 var t=window.setInterval(function(){
	var yzmnum=document.getElementById("title0");
	if(yzmnum.innerHTML==10)
	{
	  clearInterval(t);
	  document.form_register.submit();
	  //window.location.href="./dologin.php";
	}
 },1000);
 $(".after_login .head").mousemove(function()
 {
   $("#person_list").css("display","block");
  })
 $("#person_list").mouseleave(function()
 {
   $("#person_list").css("display","none");	 
 })
  $(".after_login .email").mouseover(function()
 {
   $("#person_list").css("display","none");	 
 }) 
})
function register()
 {
	$('.drop').slideUp(),
    $('#link').removeClass('signinclick').addClass('signin'); 
	$(".register").slideDown().animate({height:'390px'},{queue:false, duration:600, easing: 'easeOutBounce'}),
    $('#link2').removeClass('signout').addClass('signoutclick'); 
 }
function drop()
{
    $('.register').slideUp(),
    $('#link2').removeClass('signoutclick').addClass('signout');
	$(".drop").slideDown().animate({height:'350px'},{queue:false, duration:600, easing: 'easeOutBounce'}),
    $('#link').removeClass('signin').addClass('signinclick');	
}
function nav_list_show()
{
   $("#nav_list").css("display","block");
s}
function nav_list_hide()
{
   $("#nav_list").mouseleave(function(){
     $("#nav_list").css("display","none");
   });
}
function nav_list_hide2()
{
   $("#nav_list").css("display","none");
}
</script>
</head>

<body>

<!--small-->
<div id="small" class="m0a">
  <div class="top m0a">
    <div class="icon">
      <img class="pr fl" style="width:42px" src="images/icon/1.png" alt="KnewOne" title="KnewOne，根本停不下来" onMouseover="shake(this,'onmouseout')" >
    </div>
    <h1 class="logo fl">KnewOne</h1>
    <div class="cb"></div>
  </div>
  <div class="target m0a">
    <img title="分享科技与设计产品，发现更好的生活" alt="分享科技与设计产品，发现更好的生活" src="images/index/target.png">
  </div>
  <section class="login_button3 m0a">
    <div class="login3 m0a">
      <a href="#" class="signin3">
        <span class="sign-in3"></span>登录<span>|</span>注册
      </a>
    </div>
  </section>
</div>
<!--small--> 
<!--search-->  
  <div id="search" role="search">
    <div class="search-inner m0a">
      <form class="search-form" role="form" action="https://baidu.com/s" accept-charset="UTF-8" method="get">
        <input name="ie" type="hidden" value="utf-8">
        <label class="search-seo">搜索产品</label>
        <span class="search-icon"></span>
        <input autocomplete="on" name="s" placeholder="搜索产品" role="search" type="search">
        <a class="search-submit fr">
           <div class="box m0a">
              <span class="find-icon fl"></span>
              <span class="find-word fr">浏览发现</span>
           </div>
        </a>
      </form> 
    </div> 
  </div>
<!--search--> 
<!--footer-->
<footer id="footer" class="m0a">
  <small class="fl my">
  <a target="_blank" rel="nofollow" href="http://www.miibeian.gov.cn">粤ICP备 13057487 号<br>© 2015 KnewOne</a>
  </small>
  <div class="badge_blue"></div>
  <div class="footer-nav my">
     <a href="#">关于<span class="ob">KnewOne</span></a>
     <a href="#">加入我们</a>
     <a href="#">联系我们</a>
     <a href="#">免责声明</a>
     <a href="#">建议反馈</a>
  </div>
</footer>
<!--footer-->

<!--body-->
<div class="body">
<!--header-->
<header id="header" role="banner">
  <nav class="navbar" role="navigation">
    <div class="nav-header fl">
      <a href="#">KnewOne</a>
    </div>
    <ul class="nav-list fl">
      <li class="change"><a href="index.php?child=0">首页</a></li>
      <li class="change" onMouseOver="nav_list_hide2();"><a href="#">发现</a></li>
      <li class="product change" onMouseLeave="nav_list_hide();"><a href="index.php" onMouseOver="nav_list_show();"><span class="trangle">产品</span></a></li>
      <li class="change" onMouseOver="nav_list_hide2();"><a href="#">文章</a></li>
      <li class="change"><a href="shop.php">商店</a></li>
      <li class="change"><a href="#">小组</a></li>
      <li class="share"><a href="#"><span class="crossline"></span>分享产品</a></li>
    </ul>
<?php if(!empty($_SESSION['home'])) {?>
    <div class="after_login">
      <ul>
        <li class="cart" onClick="window.location.href='./cart.php'"></li>
        <li class="lightning"></li>
        <li class="email"></li>
        <li class="head">
          <a href="#"><img style="width:34px; height:34px;" src="<?php echo $img_path; ?>"></a>
        </li>                
      </ul>
    </div>
<?php } ?>    
  </nav>
</header>

<!--header-->

<!--banner-->
<div id="bannerimg">
   <img class="bannerimg" src="images/index/big_image.jpg">
</div>
<div id="banner">
    <div class="icon">
      <img style="width:60px" src="images/icon/1.png" alt="KnewOne" title="KnewOne，根本停不下来" onMouseover="shake(this,'onmouseout')" >  
      </div>
    <h1 class="logo fr">KnewOne</h1>
    <div class="target m0a">
    <img title="分享科技与设计产品，发现更好的生活" alt="分享科技与设计产品，发现更好的生活" src="images/index/target.png">
  </div>
</div>
<!--banner-->
<!--login-button-->  
  <section class="login_button m0a">
    <div id="login2" class="login m0a"> 
        <a href="#" id="link" class="signin fl"><span class="sign-in"></span>登录</a> 
        <form action="./dologin.php?a=login" class="drop" method="post">
            <span class="title m0a">登录</span>
            <div class="main">
            <input type="text" name="name" class="required" style="float:left" placeholder="用户名"/>
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
            <a class="test m0a" id="link2" class="signout" href="#" style="color:#fff; font-size:1.6em; width:80%; border-radius:20px; margin-top:16px;" onClick="register();">注册&nbsp;<span class="name">Knewone</span>&nbsp;></a>
            </p>
            </div>
        </form>
       <!--register-->
       <a href="#" id="link2" class="signout fr"><span>|</span>注册</a> 
        <form action="./dologin.php?a=register" class="register" method="post" name="form_register">
            <span class="title m0a">注册</span>
            <div class="main">
            <input type="text" name="newname" class="required" style="float:left" placeholder="用户名"/>
            <input type="password" style="float:right" name="newpwd" placeholder="密码" />
            </div>
            <div class="main">
            <input type="text" name="email" class="required" style="float:left" placeholder="邮件地址"/>
            <input type="text" style="float:right" name="phone" placeholder="手机号码" />
            <div class="yzm m0a" style="width:538px; height:auto;">
		
 <!--验证码-->
<div class="grade_warp" style="padding-top:70px;">
   <div class="User_ratings User_grade" id="div_fraction0">
		<div class="ratings_title01"><p><span style="font-size:1.2em; color:#47b2e2; margin-right:10px; display:inline-block;">——验证码——</span><i>拖动滑块完成验证</i></p></div>
		<div class="ratings_bars">
			<span id="title0">0</span>
			<span class="bars_10">0</span>
			<div class="scale" id="bar0">
				<div></div>
				<span id="btn0" style="margin-left:0px;"></span>
			</div>
			<span class="bars_10">10</span>
		</div>
	</div>
</div>	
<!--验证码-->

<script type="text/javascript">
scale = function (btn, bar, title) {
	this.btn = document.getElementById(btn);
	this.bar = document.getElementById(bar);
	this.title = document.getElementById(title);
	this.step = this.bar.getElementsByTagName("DIV")[0];
	this.init();
};
scale.prototype = {
	init: function () {
		var f = this, g = document, b = window, m = Math;
		f.btn.onmousedown = function (e) {
			var x = (e || b.event).clientX;
			var l = this.offsetLeft;
			var max = f.bar.offsetWidth - this.offsetWidth;
			g.onmousemove = function (e) {
				var thisX = (e || b.event).clientX;
				var to = m.min(max, m.max(-2, l + (thisX - x)));
				f.btn.style.left = to + 'px';
				f.ondrag(m.round(m.max(0, to / max) * 100), to);
				b.getSelection ? b.getSelection().removeAllRanges() : g.selection.empty();
			};
			g.onmouseup = new Function('this.onmousemove=null');
		};
	},
	ondrag: function (pos, x) {
		this.step.style.width = Math.max(0, x) + 'px';
		this.title.innerHTML = pos / 10 + '';
	}
}
new scale('btn0', 'bar0', 'title0');
new scale('btn1', 'bar1', 'title1');
new scale('btn2', 'bar2', 'title2');
new scale('btn3', 'bar3', 'title3');
new scale('btn4', 'bar4', 'title4');
</script>       
        
  </div>
  </div>
  <div class="footer2 m0a">
  <p>
  <a class="test m0a" id="link" class="signout" href="#" style="color:#fff; font-size:1.6em; width:80%; border-radius:20px; margin-top:16px;" onClick="drop();">登录&nbsp;<span class="name">Knewone</span>&nbsp;></a>
  </p>
  </div>
</form>
    <!--register-->
    </div> 
   
  </section>
<!--login-button--> 
<!--big-search-->
 <div id="big-search" class="fl" role="search">
    <div class="search-inner m0a">
      <form class="search-form" role="form" action="https://baidu.com/s" accept-charset="UTF-8" method="get">
        <input name="ie" type="hidden" value="utf-8">
        <label class="search-seo">搜索产品</label>
        <span class="search-icon"></span>
        <input autocomplete="on" class="text" placeholder="搜索产品" role="search" type="search">
        <a class="search-submit fr">
           <div class="box m0a">
              <span class="find-icon fl"></span>
              <span class="find-word fr">浏览发现</span>
           </div>
        </a>
      </form> 
    </div>
  </div>
  <div class="cb"></div>
<!--big-search-->
<!--list-->
<div id="list" class="m0a">
  <?php foreach($catelist as $valc) { ?>
  <ul>
    <li class="<?php if($valc['id']==$child) {echo 'nav_active';}  ?>">
      <a data-toggle="table" href="index.php?child=<?php echo $valc['id'] ?>">
       <?php echo $valc['name'] ?>
      </a>
    </li>    
  </ul>
  <?php } ?>
</div>
<!--list-->
<!--recommend-->
<?php 
$i=0;
foreach($productlist as $valp) {$i++;} 
$rand=mt_rand(0,$i-1);
?>
<section class="recommend m0a">
  <figure class="left fl">
  <?php
$sql="SELECT id,name,is_face FROM ".PRE."image where goods_id = {$productlist[$rand]['id']} and is_face=1 ORDER BY id ASC";
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
    <a href="#"><img src="<?php echo $rand_img_url; ?>"></a>
      <figcaption>
        <div class="name m0a">
          <a href="#"><?php echo $productlist[$rand]['name']; ?></a>
           <div class="detail m0a">
            <p class="fl"><span class="heart"></span><span><?php echo $productlist[$rand]['heart']; ?></span></p>
            <p><span class="check"></span><span><?php echo $productlist[$rand]['sell']; ?></span></p>
            <p class="fr"><span class="pencil"></span><span><?php echo $productlist[$rand]['comment']; ?></span></p>
           </div>
        </div>
      </figcaption>
  </figure>
  <section class="reviews fr">
    <article class="top">
      <div class="avatar fl">
        <a href="#"><img class="m0a" src="images/index/a24dde7d03895cba461f0abbac912992.jpg"</a>
        <p class="name m0a">Eleeven</p>
      </div>
      <section class="review-wrap fr">
         <header class="review-header">  
            <hgroup class="review-title">
              <h4><a href="#">脆弱的马卡龙</a></h4>
              <h5>Stylepie 马卡龙暖手宝宝</h5>
              <div class="score fr">
                <span class="active"></span>
                <span class="active"></span>
                <span class="active"></span>
                <span class="star"></span>
                <span class="star"></span>
              </div>
            </hgroup>
            <div class="like fr">
              <span class="hand"></span>0
            </div>
         </header>
         <section class="review-body">
           <p>终于充完电，可以用了！强迫症的我顺手把上面的标牌纸撕了，还是两面都是粉嫩的紫色看着舒服，有字还是不爽的。说说使用感受吧，反应挺灵敏的，把按键拨到中间，对着小口吹气，温度很快就上来了，大概持续5分钟，如果拨到on就一直持续发热，拿在手里还是相当温暖的，只是还不知道充一次电能用多久。

最后我比较想吐槽这个袋子，口有点小啊，好不容易才挤进去。。</p>
         </section>
      </section>
      <div class="cb"></div>
    </article>
    <article class="bottom">
            <div class="avatar fl">
        <a href="#"><img class="m0a" src="images/index/yyk.jpg"</a>
        <p class="name m0a">悠悠客</p>
      </div>
      <section class="review-wrap fr">
         <header class="review-header">  
            <hgroup class="review-title">
              <h4><a href="#">挺可爱的暖手宝</a></h4>
              <h5>Stylepie 马卡龙暖手宝宝</h5>
              <div class="score fr">
                <span class="active"></span>
                <span class="active"></span>
                <span class="active"></span>
                <span class="star"></span>
                <span class="star"></span>
              </div>
            </hgroup>
            <div class="like fr">
              <span class="hand"></span>0
            </div>
         </header>
         <section class="review-body">
           <p>终于充完电，可以用了！强迫症的我顺手把上面的标牌纸撕了，还是两面都是粉嫩的紫色看着舒服，有字还是不爽的。说说使用感受吧，反应挺灵敏的，把按键拨到中间，对着小口吹气，温度很快就上来了，大概持续5分钟，如果拨到on就一直持续发热，拿在手里还是相当温暖的，只是还不知道充一次电能用多久。

最后我比较想吐槽这个袋子，口有点小啊，好不容易才挤进去。。</p>
         </section>
          <ul>
           <li><img alt="wait" src="images/index/9b5ac52616592e26b487e31c869dd45b.JPG!small.jpg">
           </li>
           <li><img alt="wait" src="images/index/5037cf9c30cc082238a199264304e14d.JPG!small.jpg">
           </li>
           <li><img alt="wait" src="images/index/b71d1fb304d832a6d0ffb2c20b0847d6.JPG!small.jpg">
           </li>
           <li><img alt="wait" src="images/index/b19324c2fbba6cd8ad8e0fb9cc2faf2a.JPG!small.jpg">
           </li>
           <li><img alt="wait" src="images/index/c4a5670525f26b4d5a10b5de2b784cfc.JPG!small.jpg">
           </li>
           <li><img alt="wait" src="images/index/cfa9b8a68c13e91e7d7d360b079df0bb.JPG!small.jpg">
           </li>
          </ul>
      </section>
      <div class="cb"></div>
    </article>
    </article>
  </section>
</section>
<!--recommend-->

<!--category-->
<div id="category" class="m0a">
  <!--product-->
  <?php foreach($productlist as $valp) { ?>
  <section class="product">
    <figure>
      <div class="left fl">
<?php
$sql="SELECT id,name,is_face FROM ".PRE."image where goods_id = {$valp['id']} and is_face=1 ORDER BY id ASC";
$result =mysql_query($sql);
if($result && mysql_num_rows($result)>0){
	$img_face=array();
    while($row=mysql_fetch_assoc($result)){
        $img_face=$row;
    }
}
$img_url='./uploads/';
$img_url .=substr($img_face['name'],0,4).'/';   
$img_url .=substr($img_face['name'],4,2).'/';
$img_url .=substr($img_face['name'],6,2).'/';
$img_url .=$img_face['name'];
?>
        <a class="thumb m0a" href="#" target="_blank">
          <img src="<?php echo $img_url; ?>" alt="wait">
        </a>
      </div>  
      <div class="center fl">
        <figcaption class="m0a">
          <hgrop>
            <span><?php echo $valp['name'] ?></span>
          </hgrop>
          <p class="price">￥<?php echo trim($valp['price'],'0') ?></p>
          <div class="detail">
            <div class="icon m0a">
              <div class="heart fl">
                <i></i>
                <h4><?php echo $valp['heart'] ?></h4>
              </div>
              <div class="check fl">
                <i></i>
                <h4><?php echo $valp['sell'] ?></h4>
              </div>
              <div class="pencil fr">
                <i></i>
                <h4><?php echo $valp['comment'] ?></h4>
              </div>
            </div>
          </div>
        </figcaption>
      </div>
    </figure>
    <div class="right fr">
<?php
  $sql="SELECT * FROM ".PRE."comment WHERE goods_id={$valp['id']} LIMIT 1";
  $result = mysql_query($sql);
  $comment='';
  if($result && mysql_num_rows($result))
  {
	while($row=mysql_fetch_assoc($result))
	{
	   $comment=$row;  
	}
  }

?>
      <article class="top m0a">
<?php 
   $sql="SELECT * FROM ".PRE."customer WHERE id={$comment['customer_id']}";
  $result = mysql_query($sql);
  $customer='';
  if($result && mysql_num_rows($result))
  {
	while($row=mysql_fetch_assoc($result))
	{
	   $customer=$row;  
	}
  } 
  $sql2="SELECT * FROM ".PRE."head WHERE person_id={$comment['customer_id']}";
  $result2 = mysql_query($sql2);
  $use_head='';
  if($result2 && mysql_num_rows($result2))
  {
	while($row2=mysql_fetch_assoc($result2))
	{
	   $use_head=$row2;  
	}
  
   $img_url=URL.'/uploads/';
   $img_url .=substr($use_head['name'],0,4).'/';   
   $img_url .=substr($use_head['name'],4,2).'/';
   $img_url .=substr($use_head['name'],6,2).'/';
   $img_url .='60_'.$use_head['name'];
  }else
  {
   $img_url='./images/icon/head.png';	  
  }
?>
      <div class="avatar fl">
        <a href="#"><img class="m0a" src="<?php echo $img_url; ?>"</a>
        <p class="name m0a"><?php echo $customer['name']; ?></p>
      </div>
      <section class="review-wrap fr">
         <header class="review-header">  
            <hgroup class="review-title">
              <h4><a href="#"><?php echo $customer['phone']; ?></a></h4>
              <h5><?php echo $comment['addtime']; ?></h5>
              <div class="score fr">
<?php $star=$comment['star'];
			 for($i=0;$i<$star;$i++){   ?>  
             <span class="active"></span>
<?php } 
             for($i=0;$i<5-$star;$i++){  
?>
             <span></span>
<?php  } ?>
              </div>
            </hgroup>
            <div class="like fr">
              <span class="hand"></span>0
            </div>
         </header>
         <section class="review-body">
           <p><?php echo $comment['content']; ?></p>
         </section>
      </section>
      <div class="cb"></div>
    </article>
    </div>
  </section>
  <?php } ?>
  <!--product-->
    

</div>
<!--category-->
<!--big_footer-->
<footer id="big_footer" class="m0a">
  <small class="fl my">
  <a target="_blank" rel="nofollow" href="http://www.miibeian.gov.cn">粤ICP备 13057487 号<br>© 2015 KnewOne</a>
  </small>
  <div class="badge_blue"></div>
  <div class="footer-nav my">
     <a href="#">关于<span class="ob">KnewOne</span></a>
     <a href="#">加入我们</a>
     <a href="#">联系我们</a>
     <a href="#">免责声明</a>
     <a href="#">建议反馈</a>
  </div>
</footer>
<!--big_footer-->

<!--body-->

<!--nav_list-->
<div id="nav_list">
  <?php foreach($catelist as $valc) { ?>
  <ul>
    <li>
      <a data-toggle="table" href="index.php?child=<?php echo $valc['id'] ?>">
       <?php echo $valc['name'] ?>
      </a>
    </li>    
  </ul>
  <?php } ?>
</div>
<!--nav_list-->

<!--person_list-->
<div id="person_list">
  <ul>
    <li>
      <a href="#">个人主页</a>
    </li>
    <li>
      <a href="person_info.php">账户设置</a>
    </li>
    <li>
      <a href="orderlist.php">我的订单</a>
    </li>
    <li>
      <a href="commentlist.php">我的评价</a>
    </li>
    <li>
      <a href="#">寻求帮助</a>
    </li>
    <li>
      <a href="action.php?a=unit">安全退出</a>
    </li>    
  </ul>
</div>

<!--person_list-->
</body>
</html>
