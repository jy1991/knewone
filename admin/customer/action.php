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
        
		$id=$_GET['id'];
		$name = $_POST['name'];
        $email=$_POST['email'];
		$phone=$_POST['phone'];
		$sex=$_POST['sex'];
		$area=$_POST['area'];
		$web=$_POST['web'];
		$describe=$_POST['describe'];
		$exp=$_POST['exp'];
		$grade=$_POST['grade'];
		$ko=$_POST['ko'];
		$display=$_POST['display'];

		$sql="UPDATE ".PRE."customer SET name='{$name}',email='{$email}',phone='{$phone}',sex='{$sex}',area='{$area}',web='{$web}',`describe`='{$describe}',exp='{$exp}',grade='{$grade}',ko='{$ko}',display='{$display}' WHERE id='{$id}'";
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
    if($new_password != $renew_password)
	{
	   echo '两次输入密码不一致，<a href="index.php">返回</a>';
	   exit();	
	}
	$new_password = md5($new_password);
	$sql="UPDATE ".PRE."customer SET password='{$new_password}' WHERE id='{$id}'";
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

