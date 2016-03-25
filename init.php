<?php
//开启session
session_start();
//字符集
header("content-type:text/html; charset=utf-8");
//时区
date_default_timezone_set('PRC');
//错误级别
error_reporting('E_ALL^E_NOTICE');
//路径
define('PATH',str_replace('\\','/',dirname(__FILE__).'/'));
//定义到前台的项目目录
define('URL','http://localhost/knewone');
//导入文件
include PATH.'config.php';

//连接数据库
$link=mysql_connect(HOST,USER,PWD);
//判断错误
if(mysql_errno())
{
  echo mysql_errno().':'.mysql_error();
  exit();	
}
//选择数据库
mysql_select_db(DBNAME);
//设置字符集
mysql_set_charset(CHARSET);

//导入文件 function.php 
include PATH.'./function.php';

?>