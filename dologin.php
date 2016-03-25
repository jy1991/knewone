<?php

include './init.php';

$a=$_GET['a'];

switch($a)
{
  case 'login':	
  $name = $_POST['name'];
  $password = $_POST['pwd'];
  
  $sql ="SELECT id,name,password,display FROM ".PRE."customer WHERE name='{$name}'";
  $result = mysql_query($sql);
  if($result && mysql_num_rows($result)>0){
	$rows = mysql_fetch_assoc($result);
	$password = md5($password);
	if($password != $rows['password']){
		echo '用户名或密码错误 ，请重新填写，点击<a href="index.php">返回</a>';
		exit();
	}
	if($rows['display']==1)
	{
		echo '您的账户已被封禁。点击<a href="index.php">返回</a>';
		exit();
	}
	unset($rows['password']);
	$_SESSION['home']=$rows;
	header("location:index.php");
  }else{
	echo '用户名或密码错误 ，请重新填写，点击<a href="index.php">返回</a>';
	exit();
  }
  break;
  
  case 'register':
        $name = $_POST['newname'];
        $password = $_POST['newpwd'];
        $email=$_POST['email'];
		$phone=$_POST['phone'];
		if($name=='')
		{
		  echo '别耍花样 <a href="index.php">返回</a>';
		  exit();	
		}
		if($password=='' || $email=='' || $phone=='')
		{
		  echo '请填写完整 <a href="index.php">返回</a>';
		  exit();	
		}
        $password = md5($password);
        
        $sql="INSERT INTO ".PRE."customer(id,name,password,email,phone) VALUES(NULL,'{$name}','{$password}','{$email}','{$phone}')";
        
		$result = mysql_query($sql);
        if($result && mysql_affected_rows()>0){
            echo '注册成功<a href="index.php">返回</a>';
            exit();
        }else{
            echo '注册失败<a href="index.php">返回</a>';
        }
    break;
  
  
  break;
  
}


  

