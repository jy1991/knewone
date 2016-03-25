<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>

<body>

    <div id="login"> 
        <a href="#" id="link" class="signin">点 击</a> 
        <form class="drop">
            <span class="title m0a">登录</span>
            <div class="main">
            <input type="text" name="name" class="required" style="float:left" placeholder="用户名"/>
            <input type="password" style="float:right" name="password" placeholder="密码" />
            </div>
            <div class="group">
            <span class="remember"><input type="checkbox" class="checkbox"/>记住我</span> 
            <span class="forget"><a href="#" class="tooltip">忘记密码?</a></span>
            </div>
            <div class="action">
            <input type="submit" class="submit" value="登&nbsp;录" />
            </div>
            <div class="footer">
            <p><a href="#">注册<span>Knewone<span>&nbsp;></a></p>
            </div>
        </form>
    </div> 

</body>
</html>