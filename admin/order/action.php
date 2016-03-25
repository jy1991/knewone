<?php
    
include '../init.php';

$a = $_GET['a'];

switch($a){
  
  case 'edit':
  $id=$_GET['id'];
  $person=$_POST['person'];
  $address=$_POST['address'];
  $phone=$_POST['phone'];
  $sum=$_POST['sum'];
  $status=$_POST['status'];
  $sql="UPDATE ".PRE."order SET address='{$address}',person='{$person}',phone='{$phone}',sum='{$sum}',`status`='{$status}'  WHERE id='{$id}'";
   $result =mysql_query($sql);
   if(!($result && mysql_affected_rows()>0)){
	 echo '更新订单失败<a href="index.php">返回</a>';
	 exit();
   }
   header('location:index.php');
  break;	

  case 'del':
   $number=$_GET['number'];
   $sql="DELETE FROM ".PRE."order WHERE number='".$number."'";
   $result=mysql_query($sql);
   if($result && mysql_affected_rows()>0)
   {
	$sql="SELECT * FROM ".PRE."order_goods WHERE order_number='".$number."'";
	$result = mysql_query($sql);
	$order_goods=array();
	if($result && mysql_num_rows($result)>0){
	  while($row=mysql_fetch_assoc($result))
	  {
		$order_goods[]=$row;  
	  }
	}
	foreach($order_goods as $valo)
	{
	$sql="DELETE FROM ".PRE."order_goods WHERE id=".$valo['id'];
	$result=mysql_query($sql);
	if(!($result && mysql_affected_rows()>0))
	{
	   echo '删除订单商品表失败，<a href="index.php">返回</a>'; 
	   exit();
	  } 
	} 
	  header('location:index.php');
 	  exit();  
   }else
   {
	  echo '删除订单失败，<a href="index.php">返回</a>'; 
   }
   break;
  
  case 'del_goods':
  $id=$_GET['id'];
  $sql="DELETE FROM ".PRE."order_goods WHERE id=".$id;
  $result=mysql_query($sql);
  if(!($result && mysql_affected_rows()>0))
  {
	 echo '删除订单商品表失败，<a href="index.php">返回</a>'; 
	 exit();
  } 
    header('location:index.php');
	exit(); 
  
  break;


}

?>