<?php
include './init.php';

if(empty($_GET['child']))
{
  $child=0;  
}else
{
  $child=$_GET['child'];    
}
$where=($child==0?"WHERE status=1":"WHERE cate_id=$child AND status=1"); 

header('Content-type:text/html; charset=utf-8');
$mysql = mysql_connect('localhost','root','123456');
mysql_query('set names utf8',$mysql);
mysql_select_db('knewone_shop',$mysql);
$page = isset($_GET['page'])?(int)$_GET['page']:0;
$num = isset($_GET['requestNum'])?(int)$_GET['requestNum']:6;
$startNum  =$page*$num;
$str='select id,name,price from '.PRE.'goods '.$where.' limit '.$startNum.' , '.$num.'';

$rows = mysql_query($str);
$data = array();
while ($row = mysql_fetch_assoc($rows)){
	$data[] = $row; 
}

$len=count($data);

for($i=0;$i<$len;$i++)
{  
   $sql="SELECT name FROM ".PRE."image where goods_id =". $data[$i]['id']." and is_face=1 ORDER BY id ASC";
   $result=mysql_query($sql);
   if($result && mysql_num_rows($result)>0)
  {
    $img_name=array();
    while($row=mysql_fetch_assoc($result))
    {
	$img_name[]=$row;  
    }
  } 
  $img_url='./uploads/';
  $img_url .=substr($img_name[0][name],0,4).'/';   
  $img_url .=substr($img_name[0][name],4,2).'/';
  $img_url .=substr($img_name[0][name],6,2).'/';
  $img_url .=$img_name[0][name];
  $data[$i]['src']=$img_url;
}
sleep(2);

echo json_encode($data);

?>