<?php
include '../init.php';


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
        $type=$_POST['type'];    
        $password = md5($password);
		if($_SESSION['admin']['type']==0)
		{
		  echo '您为普通用户，没有添加用户权限<a href="index.php">返回</a>';
		  exit();	
		}else if($_SESSION['admin']['type']==1)
		{
		  if($type!=0)
		  {
			 echo '您为普通管理员，没有添加管理员权限<a href="add.php">返回</a>';             exit();
		  }
		  
		}
		
        $sql="INSERT INTO ".PRE."user(id,name,password,type) VALUES(NULL,'{$name}','{$password}','{$type}')";
        
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
		$sql="SELECT type FROM ".PRE."user WHERE id ={$id}";
		$result =mysql_query($sql);
		if(($result)&&(mysql_num_rows($result)>0))
		{
		  $rows=mysql_fetch_assoc($result);	
		}
		if($_SESSION['admin']['type']<$rows['type'])
		{
		  echo '您的用户权限不够，不能删除比自己权限高的用户。<a href="index.php">返回</a>';
		  exit();	
		}
        $sql ="DELETE FROM ".PRE."user WHERE id ={$id}";
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
        $sql ="UPDATE ".PRE."user SET display={$display} WHERE id={$id} and type!=2";
        $result =mysql_query($sql);
        if($result&& mysql_affected_rows()>0){
            header('location:index.php');
        }else{
            header('location:index.php');
        }
        break;
		
    case 'edit':
        $name = $_POST['name'];
        $type=$_POST['type'];
		$sex=$_POST['sex'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$display=$_POST['display'];
        $id=$_GET['id'];
		/*不能修改比自己权限高的用户 提升后的权限不能比自己高*/
		if(($_SESSION['admin']['type']<$_POST['last_type'])||($_SESSION['admin']['type']<$type))
		{
		  echo '您的用户权限不够。不能修改比自己权高的用户，提升后的权限不能比自己高<a href="add.php">返回</a>';
		  exit();	
		}
		$sql="UPDATE ".PRE."user SET name='{$name}',type='{$type}',sex='{$sex}',phone='{$phone}',email='{$email}',display='{$display}' WHERE id='{$id}'";
         $result =mysql_query($sql);
         if($result && mysql_affected_rows()>0){
           echo '修改成功<a href="index.php">返回</a>';
		   exit();
         }else{
            echo '修改失败<a href="edit.php?id='.$id.'">返回</a>';
			exit();
         }
		 
	case 'changepwd':
	$id = $_GET['id'];
	$password=$_POST['password'];
	$new_password=$_POST['new_password'];
	$renew_password=$_POST['renew_password'];
	$sql ="SELECT id,name,password,type FROM ".PRE."user WHERE id='{$id}'";
    $result = mysql_query($sql);
    if($result && mysql_num_rows($result)>0)
	{
    $rows = mysql_fetch_assoc($result);
	}
    $password = md5($password);
    if($password != $rows['password']){
        echo '原始密码错误，<a href="index.php">返回</a>';
        exit();
    }
	if($new_password != $renew_password)
	{
	   echo '两次输入密码不一致，<a href="index.php">返回</a>';
	   exit();	
	}
	$new_password = md5($new_password);
	$sql="UPDATE ".PRE."user SET password='{$new_password}' WHERE id='{$id}'";
    $result =mysql_query($sql);
    if($result && mysql_affected_rows()>0){
       echo '修改成功<a href="index.php">返回</a>';
	   exit();
    }else{
       echo '修改失败<a href="edit.php?id='.$id.'">返回</a>';
	   exit();
    }
	
}

?>

