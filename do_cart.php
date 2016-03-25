<?php

include 'init.php';

$a=$_GET['a'];


switch($a)
{
  case 'new':
  $gid=$_POST['gid'];
  $kind=$_POST['kind'];
  $qty=$_POST['qty'];
  $stock=$_POST['stock'];
  
  $sql="SELECT g.name gname, g.price, i.name iname FROM ".PRE."goods g,".PRE."image i WHERE i.goods_id=g.id AND i.is_face=1 AND g.id={$gid}";
  $result=mysql_query($sql);
  if($result && mysql_num_rows($result)>0)
  {
	$goods=mysql_fetch_assoc($result);  
  }
  $goods['qty']=$qty; 
  $goods['stock']=$stock;
  $_SESSION['cart'][$gid]=$goods;
  
    $sql="SELECT * FROM ".PRE."cart WHERE person_id={$_SESSION['home']['id']} AND product_id={$gid}";
	$result = mysql_query($sql);
	$cart='';
	if($result && mysql_num_rows($result)>0)
	{
	  $cart=mysql_fetch_assoc($result);
	  $sql="UPDATE ".PRE."cart SET qty='{$qty}' WHERE person_id={$_SESSION['home']['id']} AND product_id={$gid}";
         $result =mysql_query($sql);
         if($result && mysql_affected_rows()>0){
           echo '更新购物车成功<a href="cart.php">返回</a>';
		   exit();
         }else
		 {
		   echo '更新购物车失败<a href="cart.php">返回</a>';
		   exit();	 
		 }
	  	
	}else{
	  $sql="INSERT INTO ".PRE."cart(id,product_id,qty,person_id) VALUES(NULL,'{$gid}','{$qty}','{$_SESSION['home']['id']}')";
	  $result = mysql_query($sql);
	  if($result && mysql_affected_rows()>0){
		  header('location:cart.php');
		  exit();
	  }else{
		  echo '添加购物车失败<a href="shop.php">返回</a>';
	  }
	
  }
  
  header('location:cart.php');
  break;
  
  case 'add':
  $gid=$_GET['gid'];
  $sql="SELECT * FROM ".PRE."cart WHERE person_id={$_SESSION['home']['id']} AND product_id={$gid}";
  $result = mysql_query($sql);
  $cart='';
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $cart=$row;  
	}
  }
  $qty=$cart['qty'];
  
  $sql="SELECT stock FROM ".PRE."goods WHERE id={$gid}";
  $result = mysql_query($sql);
  $goods='';
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $goods=$row;  
	}
  }
  if($qty < $goods['stock'])
  {
	$qty+=1;  
  }
   
   $sql="UPDATE ".PRE."cart SET qty='{$qty}' WHERE product_id='{$gid}' AND person_id={$_SESSION['home']['id']}";
   $result =mysql_query($sql);
   if($result && mysql_affected_rows()>0){
	 header('location:cart.php');
	 exit();
   }else
   {
	 header('location:cart.php');  
   }
  
  break;
  
  case 'min':
  $gid=$_GET['gid'];
  $sql="SELECT * FROM ".PRE."cart WHERE person_id={$_SESSION['home']['id']} AND product_id={$gid}";
  $result = mysql_query($sql);
  $cart='';
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $cart=$row;  
	}
  }
  $qty=$cart['qty'];
  
  if($qty > 1 )
  {
	$qty-=1;  
  }
   
   $sql="UPDATE ".PRE."cart SET qty='{$qty}' WHERE product_id='{$gid}' AND person_id={$_SESSION['home']['id']}";
   $result =mysql_query($sql);
   if($result && mysql_affected_rows()>0){
	 header('location:cart.php');
	 exit();
   }else
   {
	 header('location:cart.php');  
   }
  
  break;
  
  case 'del':
  $gid=$_GET['gid'];
  $sql="DELETE FROM ".PRE."cart WHERE product_id={$gid} AND person_id={$_SESSION['home']['id']}";
  $result=mysql_query($sql);
  if($result && mysql_affected_rows()>0)
  {
	 header('location:cart.php');
	 exit(); 
  }else
  {
	 header('location:cart.php'); 
  }
  break;
	
}

?>