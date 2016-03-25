<?php

include './init.php';

$name = $_POST['username'];
$password = $_POST['pwd'];

$sql ="SELECT id,name,password,type FROM ".PRE."user WHERE name='{$name}'";
$result = mysql_query($sql);
if($result && mysql_num_rows($result)>0){
    $rows = mysql_fetch_assoc($result);
    $password = md5($password);
    if($password != $rows['password']){
        echo '用户名或密码错误 ，请重新填写，点击<a href="login.php">返回</a>';
        exit();
    }
	if($rows['type']<1)
	{
	    echo '您是普通用户，请在前台登录。点击<a href="login.php">返回</a>';
		exit();
	}
    unset($rows['password']);
    $_SESSION['admin']=$rows;
    header("location:index.php");
}else{
    echo '用户名或密码错误 ，请重新填写，点击<a href="login.php">返回</a>';
    exit();
}


  

