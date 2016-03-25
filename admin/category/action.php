<?php

include '../init.php';

$a = $_GET['a'];

switch($a){
	case 'add':
    $name = $_POST['name'];
    if(empty($_POST['pid']))
	{
	   $pid = 0;
	}else
	{
	   $pid = $_POST['pid'];
	}
	$display = $_POST['display'];
	$sql="SELECT id,name,pid,path,concat(path,id,',') as bpath FROM ".PRE."category WHERE id={$pid}";
    $result =mysql_query($sql);
    if($result && mysql_num_rows($result)>0){
        $row = mysql_fetch_assoc($result);
    }
    $path =$row['bpath'];
	if(empty($path))
	{
	   $path = '0,';
	}
	$sql="INSERT INTO ".PRE."category(id,name,pid,path,display) VALUES(NULL,'{$name}',{$pid},'{$path}',{$display})";
    $result =mysql_query($sql);
    if($result && mysql_affected_rows()>0){
        echo '添加成功请<a href="index.php?pid='.$pid.'">返回</a>';
		exit();
    }else{
          echo '添加失败<a href="add.php">返回</a>';
		  exit();
    }
        break;
    case 'addchild':
    $name = $_POST['name'];
    $pid = $_POST['pid'];
    $path = $_POST['path'];
    $display=$_POST['display'];
    $sql="INSERT INTO ".PRE."category(id,name,pid,path,display) VALUES(NULL,'{$name}',{$pid},'{$path}',{$display})";
    $result =mysql_query($sql);
    if($result && mysql_affected_rows()>0){
        echo '添加成功请<a href="index.php?pid='.$pid.'">返回</a>';
		exit();
    }else{
          echo '添加失败<a href="addcild.php">返回</a>';exit;
    }
        break;
    case 'del':
        $id = $_GET['id'];
		$sql="SELECT name FROM ".PRE."category WHERE pid={$id}";
        $result =mysql_query($sql);
        if($result && mysql_num_rows($result)>0)
		{
          $row = mysql_fetch_assoc($result);
		  echo '不能删除，因为有子分类&nbsp;&nbsp;'.$row['name'].'&nbsp;&nbsp;请<a href="index.php?pid='.$id.'">返回</a>';
		  exit();
        }
		$sql ="DELETE FROM ".PRE."category WHERE id ={$id}";
        $result =mysql_query($sql);
        if($result){
            echo '删除成功 请<a href="index.php?pid='.$id.'">返回</a>';
        }else{
            header('location:index.php');
        }
        break;
     case 'display':
        $id = $_GET['id'];
		$pid = $_GET['pid'];
        $display =$_GET['display'];
        $sql ="UPDATE ".PRE."category SET display={$display} WHERE id={$id}";
        $result =mysql_query($sql);
		if($result&& mysql_affected_rows()>0){
            header('location:index.php?pid='.$pid);
		}else{
            header('location:index.php?pid='.$pid);
        }
        break;
     case 'edit':
       $id = $_GET['id'];
	   $pid = $_GET['pid'];
       $new_name = $_POST['new_name'];
	   if($new_name=="")
	   {
		 echo '新分类名不能为空'.'请<a href="index.php?pid='.$pid.'">返回</a>';       edit();
	   }
       $display = $_POST['display'];
	   $sql="UPDATE ".PRE."category SET name='{$new_name}',display='{$display}' WHERE id='{$id}'";
       $result =mysql_query($sql);
	   if($result&& mysql_affected_rows()>0){
           echo '修改成功 请<a href="index.php?pid='.$pid.'">返回</a>';
	   }else{
           header('location:index.php?pid='.$pid);
       }
        break;
}
?>