<?php
  include './init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>KnewOne - 分享科技与设计产品，发现更好的生活</title>
    <link href="css/alogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="form1" runat="server" action="dologin.php" method="post">
    <div class="Main">
     <ul>
       <li class="top"></li>
       <li class="top2"></li>
       <li class="topA"></li>
       <li class="topB"><span><img style="width:272px; height:122px; margin-top:30px" src="images/login/logo.jpg" alt="" style="" /></span></li>
       <li class="topC"></li>
       <li class="topD"></li>
     <ul class="login">
       <li><span class="left login-text">用户名：</span> <span style="left"><input id="Text1" type="text" class="txt" name="username"/></span></li>
       <li><span class="left login-text">密码：</span> <span style="left">
<input id="Text2" type="password" class="txt" name="pwd" /></span></li>
     </ul>
       <li class="topE"></li>
       <li class="middle_A"></li>
       <li class="middle_B"></li>
       <li class="middle_C"><span class="btn"><input name="" type="image" src="images/login/btnlogin.gif" /></span></li>
       <li class="middle_D"></li>
       <li class="bottom_A"></li>
       <li class="bottom_B">KnewOne - 分享科技与设计产品，发现更好的生活&nbsp;&nbsp;www.knewone.com</li>
     </ul>
    </div>
    </form>
</body>
</html>
