<?php
include './init.php';


$a = $_GET['a'];

switch($a){
    case 'add':
        $name = $_POST['name'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        if($password !=$repassword){
            echo '两次密码不一样 请<a href="add.php">返回</a>';
            exit;
        }
        $password = md5($password);
        $email=$_POST['email'];
		$phone=$_POST['phone'];
		$sex=$_POST['sex'];
		$area=$_POST['area'];
		$web=$_POST['web'];
		$describe=$_POST['describe'];
		$exp=$_POST['exp'];
		$grade=$_POST['grade'];
		$ko=$_POST['ko'];
		$addtime=$_POST['addtime'];
		$display=$_POST['display'];
        $sql="INSERT INTO ".PRE."customer(id,name,password,email,phone,sex,area,web,`describe`,exp,grade,ko,addtime,display) VALUES(NULL,'{$name}','{$password}','{$email}','{$phone}','{$sex}','{$area}','{$web}','{$describe}','{$exp}','{$grade}','{$ko}','{$addtime}','{$display}')";
        
		$result = mysql_query($sql);
        if($result && mysql_affected_rows()>0){
            echo '添加成功<a href="index.php">返回</a>';
            exit;
        }else{
            echo '添加失败<a href="add.php">返回</a>';
        }
    break;
	
    case 'del':
        $id = $_GET['id'];
        $sql ="DELETE FROM ".PRE."customer WHERE id ={$id}";
        $result =mysql_query($sql);
        if($result){
            echo '删除成功 请<a href="index.php">返回</a>';
        }else{
            header('location:index.php');
        }
        break;
    
	case 'display':
        $id = $_GET['id'];
        $display =$_GET['display'];
        $sql ="UPDATE ".PRE."customer SET display={$display} WHERE id={$id}";
        $result =mysql_query($sql);
        if($result&& mysql_affected_rows()>0){
            header('location:index.php');
        }else{
            header('location:index.php');
        }
        break;
		
    case 'edit':
        
		$id=$_SESSION['home']['id'];
		$name = $_POST['name'];
        $sex=$_POST['sex'];
		$area=$_POST['area'];
		$web=$_POST['web'];
		$describe=$_POST['describe'];
		
		//2.处理文件上传
  $filename = upload('head',PATH.'uploads/');
  //判断上传是否成功
  if($filename!='false')
{
  //图片缩放
  //处理图片路径
  $img_path = PATH.'uploads/';
  $img_path .=substr($filename,0,4).'/';//year
  $img_path .=substr($filename,4,2).'/';//month
  $img_path .=substr($filename,6,2).'/';//days
  $img_path .=$filename;
  
  if(!zoom ($img_path,60,60))
  {
    //拼接缩放图片路径
    $path_60 = dirname($img_path).'/60_'.basename($img_path);
    unlink($path_60);

    //删除原图
    unlink($img_path);
    echo '图片缩放失败，重新上传<a href="./person_info.php">返回</a>';
    exit(); 
  }
  unlink($img_path);
  
  $sql="SELECT * FROM ".PRE."head WHERE person_id={$id}";
  $result = mysql_query($sql);
  $prev_head=array();
  if($result && mysql_num_rows($result))
  {
	while($row=mysql_fetch_assoc($result))
	{
	   $prev_head[]=$row;  
	}
  
  $img_path = PATH.'uploads/';
  $img_path .=substr($prev_head[0]['name'],0,4).'/';//year
  $img_path .=substr($prev_head[0]['name'],4,2).'/';//month
  $img_path .=substr($prev_head[0]['name'],6,2).'/';//days
  $img_path .='60_'.$prev_head[0]['name'];
  unlink($img_path);
  
  $sql="UPDATE ".PRE."head SET name='{$filename}' WHERE person_id='{$id}'";
   $result =mysql_query($sql);
   if(!($result && mysql_affected_rows()>0)){
	 echo '更新图片表失败<a href="person_info.php">返回</a>';
	 exit();
   }
  
  }else
  {
  
  $sql="INSERT INTO ".PRE."head(id,name,person_id) VALUES(NULL,'{$filename}','{$id}')";
  $result = mysql_query($sql);
  if(!($result && mysql_affected_rows()>0)){
	  echo '插入头像表失败<a href="person_info.php">返回</a>';
    }
  }
}	

   $sql="UPDATE ".PRE."customer SET name='{$name}',sex='{$sex}',area='{$area}',web='{$web}',`describe`='{$describe}' WHERE id='{$id}'";
   $result =mysql_query($sql);
   if($result && mysql_affected_rows()>0){
	 echo '<br>修改成功<a href="person_info.php">返回</a>';
	 exit();
   }else{
	  echo '没有修改<a href="person_info.php">返回</a>';
	  exit();
   }
   
   break;
		 
	case 'set_pwd':
	$id = $_SESSION['home']['id'];
	$password=$_POST['pwd'];
	$new_password=$_POST['new_pwd'];
	$renew_password=$_POST['renew_pwd'];
    if($new_password != $renew_password)
	{
	   echo '两次输入密码不一致，<a href="account_info.php">返回</a>';
	   exit();	
	}
   
   $sql="SELECT password FROM ".PRE."customer WHERE id={$id}";
   $result = mysql_query($sql);
   $pwd='';
   if($result && mysql_num_rows($result))
   {
	 while($row=mysql_fetch_assoc($result))
	 {
	   $pwd=$row;  
	 }
   }
   if(md5($password) != $pwd['password'])
   {
	 echo '原密码错误，<a href="account_info.php">返回</a>';
	 exit();	
   }
	
	$new_password = md5($new_password);
	$sql="UPDATE ".PRE."customer SET password='{$new_password}' WHERE id='{$id}'";
    $result =mysql_query($sql);
    if($result && mysql_affected_rows()>0){
       echo '修改成功<a href="account_info.php">返回</a>';
	   exit();
    }else{
       echo '修改失败<a hre=="account_info.php">返回</a>';
	   exit();
    }
	break;
	
	case 'unit':
	unset($_SESSION['home']);
	header('location:index.php');
	break;
	
	case 'set_email':
	$id=$_SESSION['home']['id'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$sql="UPDATE ".PRE."customer SET email='{$email}',phone='{$phone}' WHERE id='{$id}'";
   $result =mysql_query($sql);
   if($result && mysql_affected_rows()>0){
	 echo '<br>修改成功<a href="account_info.php">返回</a>';
	 exit();
   }else{
	  echo '没有修改<a href="account_info.php">返回</a>';
	  exit();
   }
   
   break;
   
   case 'new_address':
   $number=$_POST['number'];
   $address=$_POST['address'];
   $person=$_POST['person'];
   $phone=$_POST['phone'];
   $default=$_POST['default'];
   if(!$address || !$person || !$phone)
   {
	 echo '请填写完整。<a style="text-decoration:none" href="new_address.php">返回</a>'; 
	 exit();  
   }
   if($default=='')
   {
	  $default=0;   
   }else
   {
	 $sql="SELECT * FROM ".PRE."address WHERE `default`=1 AND customer_id={$_SESSION['home']['id']}";
	 $result = mysql_query($sql);
	 $default_address='';
	 if($result && mysql_num_rows($result))
	 {
	   while($row=mysql_fetch_assoc($result))
	   {
		 $default_address=$row;  
	   }
	   $sql="UPDATE ".PRE."address SET `default`=0 WHERE id='{$default_address['id']}'";
	   $result =mysql_query($sql);
	   if($result && mysql_affected_rows()>0){
		 
	   }else{
		  echo '原有默认收货地址修改不成功<a href="new_address.php">返回</a>';
		  exit();
	   }
	 }
   }
   
   $sql="INSERT INTO ".PRE."address(id,address,person,phone,`default`,customer_id) VALUES(NULL,'{$address}','{$person}','{$phone}','{$default}','{$_SESSION['home']['id']}')";
  $result = mysql_query($sql);
  if(!($result && mysql_affected_rows()>0)){
	  echo '插入地址失败<a href="new_address.php">返回</a>';
    }else
	{
	  header('location:address.php?number='.$number);	
	}
   break;
   
   case 'del_address':
    $address_id=$_GET['id'];
	$number=$_GET['number'];
    $sql="DELETE FROM ".PRE."address WHERE id={$address_id}";
	$result=mysql_query($sql);
	if($result && mysql_affected_rows()>0)
	{
	   header('location:address.php?number='.$number);
	   exit(); 
	}else
	{
	   echo '删除地址失败，<a href="address.php?number='.$number.'">返回</a>'; 
	}
	
   break;
   
   case 'order':
   $customer_id=$_SESSION['home']['id'];
   $sum=$_POST['sum'];
   $qty=$_POST['all'];
   $number=date('Ymd').uniqid().mt_rand(0,999);
   $addtime=date('YmdHis');

  $sql="INSERT INTO ".PRE."order(id,number,customer_id,sum,qty,addtime) VALUES(NULL,'{$number}','{$customer_id}','{$sum}','{$qty}','{$addtime}')";
  $result = mysql_query($sql);
  if(!($result && mysql_affected_rows()>0)){
	  echo '插入订单失败<a href="cart.php">返回</a>';
    }
  $sql="SELECT * FROM ".PRE."cart WHERE person_id={$_SESSION['home']['id']}";
  $result = mysql_query($sql);
  $cart=array();
  if($result && mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))
	{
	  $cart[]=$row;  
	}
  }
  foreach($cart as $valc)
  {
	$sql="SELECT name,price FROM ".PRE."goods WHERE id={$valc['product_id']}";
		$result = mysql_query($sql);
		$product='';
		if($result && mysql_num_rows($result)>0){
		  while($row=mysql_fetch_assoc($result))
		  {
			$product=$row;  
		  }
		} 
	  
	$sql="INSERT INTO ".PRE."order_goods(id,goods_id,qty,order_number,goods_name,price) VALUES(NULL,'{$valc['product_id']}','{$valc['qty']}','{$number}','{$product['name']}','{$product['price']}')";
	$result = mysql_query($sql);
	if(!($result && mysql_affected_rows()>0)){
		echo '插入订单商品表失败<a href="cart.php">返回</a>';
	  }
	
   $sql2="SELECT stock FROM ".PRE."goods WHERE id={$valc['product_id']}";
		$result2 = mysql_query($sql2);
		$stock='';
		if($result2 && mysql_num_rows($result2)>0){
		  while($row2=mysql_fetch_assoc($result2))
		  {
			$stock=$row2;  
		  }
		}  
	  $stock1=$stock['stock'];
	  $stock2=$stock1-$valc['qty'];
   $sql="UPDATE ".PRE."goods SET stock={$stock2} WHERE id={$valc['product_id']}";
	   $result =mysql_query($sql);
	   if(!($result && mysql_affected_rows()>0)){
		 echo '更新库存失败，<a href="cart.php">返回</a>';
		 exit();
	   }
  
  }
  $sql="DELETE FROM ".PRE."cart WHERE person_id={$customer_id}";
  $result=mysql_query($sql);
  if($result && mysql_affected_rows()>0)
  {
	 header('location:order.php?number='.$number);
	 exit(); 
  }else
  {
	 echo '删除购物车失败，<a href="address.php">返回</a>'; 
  } 
  
   break;
   
    case 'cancel_order':
    $number=$_GET['number'];
	$sql="UPDATE ".PRE."order SET `status`=4 WHERE number='".$number."'";
	   $result =mysql_query($sql);
	   if(!($result && mysql_affected_rows()>0)){
	      echo '取消订单不成功<a href="order_list.php">返回</a>';
		  exit();
	   }
	
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
	   echo '删除订单商品表失败，<a href="orderlist.php">返回</a>'; 
	   exit();
	  } 
	}
	header('location:orderlist.php');
	exit(); 
   
   break;
   
   case 'change_default_address':
   $id=$_POST['default'];
   $number=$_POST['number'];
   $sql="SELECT * FROM ".PRE."address WHERE `default`=1 AND customer_id={$_SESSION['home']['id']}";
	 $result = mysql_query($sql);
	 $default_address='';
	 if($result && mysql_num_rows($result))
	 {
	   while($row=mysql_fetch_assoc($result))
	   {
		 $default_address=$row;  
	   }
	   if($default_address['id']!=$id)
	   {
		 $sql="UPDATE ".PRE."address SET `default`=0 WHERE id='{$default_address['id']}'";
		 $result =mysql_query($sql);
		 if($result && mysql_affected_rows()>0){
		   $sql="UPDATE ".PRE."address SET `default`=1 WHERE id='{$id}'";
		   $result =mysql_query($sql);
		   if($result && mysql_affected_rows()>0){
			 
	   }else{
		  echo '原有默认收货地址修改不成功<a href="new_address.php">返回</a>';
		  exit();
	   }
		   
		 }else{
		echo '原有默认收货地址修改不成功<a href="new_address.php">返回</a>';
			exit();
		 }    
	   }
	 }
	 if($number=='')
	 {
	   header('location:orderlist.php');	
	 }else
	 {
	   header('location:order.php?number='.$number);	 
	 }
	 
   break;
   
   case 'del_order':
   $number=$_GET['number'];
   $sql="DELETE FROM ".PRE."order WHERE number='".$number."'";
   $result=mysql_query($sql);
   if($result && mysql_affected_rows()>0)
   {
	  header('location:orderlist.php');
 	  exit();  
   }else
   {
	  echo '删除订单失败，<a href="orderlist.php">返回</a>'; 
   }
   break;
   
   case 'pay':
   $address=$_POST['address'];
   $person=$_POST['person'];
   $phone=$_POST['phone'];
   $number=$_POST['number'];
   $use_ko=$_POST['ko'];
   if($address=='')
   {
	 echo '请选择收货地址<a href="order.php?number='.$number.'">返回</a>';     exit();
   }
    
		$sql="SELECT ko FROM ".PRE."customer WHERE id={$_SESSION['home']['id']}";
		$result = mysql_query($sql);
		$pre_ko='';
		if($result && mysql_num_rows($result)>0){
		  $pre_ko=mysql_fetch_assoc($result);
        }else
		{
		  echo '查找原ko币失败<a href="ko.php">返回</a>';
          exit();		
		}
		$pre_ko=$pre_ko['ko'];
		
		if($use_ko<0 || $use_ko>$pre_ko)
		{
	 echo '使用ko币错误<a href="order.php?number='.$number.'">返回</a>';
     exit();	
		}
        
		$sql="SELECT sum FROM ".PRE."order WHERE number='{$number}'";
		$result = mysql_query($sql);
		$sum='';
		if($result && mysql_num_rows($result)>0){
		  $sum=mysql_fetch_assoc($result);
        }else
		{
		  echo '查找订单总价失败<a href="ko.php">返回</a>';
          exit();		
		}
		$sum=$sum['sum'];
		
		if($sum*100<$use_ko)
		{
		  echo '使用ko币超过订单总价<a href="order.php?number='.$number.'">返回</a>';
          exit();	
		}
		
		if($use_ko!=0)
		{
		  $sum=$sum-intval($use_ko/100);
		  $sql="UPDATE ".PRE."order SET sum={$sum} WHERE number='{$number}'";
		  $result =mysql_query($sql);
		  if(!($result && mysql_affected_rows()>0)){
			 echo '更新总价失败<a href="orderlist.php">返回</a>';
			 exit();		  
		  }
		$ko=$pre_ko-$use_ko;
		
		$sql="UPDATE ".PRE."customer SET ko={$ko} WHERE id={$_SESSION['home']['id']}";
	    $result =mysql_query($sql);
	    if(!($result && mysql_affected_rows()>0)){
		   echo '更新ko币失败<a href="ko.php">返回</a>';
	 	   exit();		  
	     }
		}
		
		$sql="UPDATE ".PRE."order SET address='{$address}',person='{$person}',phone='{$phone}',`status`=1 WHERE number='{$number}'";
	   $result =mysql_query($sql);
	   if(!($result && mysql_affected_rows()>0)){
	echo '更新收货地址失败<a href="order.php?number='.$number.'">返回</a>';
	exit();		  
	   } 
		
	 header('location:orderlist.php'); 
	
   break;
   
   case 'sure':
   $number=$_GET['number'];
   $sql="UPDATE ".PRE."order SET `status`=3 WHERE number='{$number}'";
	 $result =mysql_query($sql);
	 if(!($result && mysql_affected_rows()>0)){
        echo '更新收货状态失败<a href="orderlist.php">返回</a>';
        exit();		  
	 }else
	 {
	   $sql="SELECT ko FROM ".PRE."customer WHERE id={$_SESSION['home']['id']}";
		$result = mysql_query($sql);
		$pre_ko='';
		if($result && mysql_num_rows($result)>0){
		  $pre_ko=mysql_fetch_assoc($result);
        }else
		{
		  echo '查找原ko币失败<a href="ko.php">返回</a>';
          exit();		
		}
		$pre_ko=$pre_ko['ko'];
		
		$sql="SELECT sum FROM ".PRE."order WHERE number='{$number}'";
		$result = mysql_query($sql);
		$sum='';
		if($result && mysql_num_rows($result)>0){
		  $sum=mysql_fetch_assoc($result);
        }else
		{
		  echo '查找订单总价失败<a href="ko.php">返回</a>';
          exit();		
		}
		$sum=$sum['sum'];
		$ko=$pre_ko+$sum;
	    $sql="UPDATE ".PRE."customer SET ko={$ko} WHERE id={$_SESSION['home']['id']}";
	    $result =mysql_query($sql);
	    if(!($result && mysql_affected_rows()>0)){
		   echo '更新ko币失败<a href="ko.php">返回</a>';
	 	   exit();		  
	    }
		header('location:orderlist.php'); 
	 
	 }
		
   break;
   
   case 'back_order':
   $number=$_GET['number'];
   $sql="UPDATE ".PRE."order SET `status`=5 WHERE number='{$number}'";
	 $result =mysql_query($sql);
	 if(!($result && mysql_affected_rows()>0)){
        echo '更新退货状态失败<a href="orderlist.php">返回</a>';
        exit();		  
	 }else
	 {
		header('location:orderlist.php'); 
	 }
   
   break;
   
   case 'comment':
   $number=$_POST['number'];
   $goods_id=$_POST['goods_id'];
   $content=$_POST['content'];
   $star=$_POST['star'];
   if($content=='')
   {
	 echo '评论不能为空。<a href="orderlist.php">返回</a>';
	 exit();   
   }
   $addtime=date('YmdHis');
   $display=0;
   	$sql="INSERT INTO ".PRE."comment(id,goods_id,customer_id,`content`,`star`,order_number,addtime,display) VALUES(NULL,'{$goods_id}','{$_SESSION['home']['id']}','{$content}','{$star}','{$number}','{$addtime}','{$display}')";
	$result = mysql_query($sql);
	if(!($result && mysql_affected_rows()>0)){
		echo '插入评价表失败<a href="orderlist.php">返回</a>';
	  }
    
	$sql="UPDATE ".PRE."order_goods SET is_comment=1 WHERE order_number='{$number}' AND goods_id='{$goods_id}'";
	 $result =mysql_query($sql);
	 if(!($result && mysql_affected_rows()>0)){
        echo '更新评价状态失败<a href="orderlist.php">返回</a>';
        exit();		  
	 }	
   	   
   header('location:commentlist.php');
   break;
   
   case 'del_comment':
   $id=$_GET['comment_id'];
   $sql="DELETE FROM ".PRE."comment WHERE id=".$id;
   $result=mysql_query($sql);
   if($result && mysql_affected_rows()>0)
   {
	  header('location:commentlist.php');
 	  exit();  
   }else
   {
	  echo '删除评价失败，<a href="commentlist.php">返回</a>'; 
   }
   
   break;	
}

?>

