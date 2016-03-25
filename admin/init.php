<?php

//声明admin_path
define('ADMIN_PATH',str_replace('\\','/',dirname(__FILE__).'/'));


//定义一个后台的url
define('ADMIN_URL','http://localhost/knewone/admin/');

//包含上级的init.php

include ADMIN_PATH.'../init.php';

//防止地址栏直接登录
$filename=basename($_SERVER['SCRIPT_NAME']);
$allow_files=array('login.php','dologin.php');
if(!in_array($filename,$allow_files))
{
	if(empty($_SESSION['admin']))
   {
    header('location:'.ADMIN_URL.'login.php');	
   }
}