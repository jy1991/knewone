<?php
include '../init.php';


$a = $_GET['a'];

switch($a){
    
	case 'shield':
	$id=$_GET['id'];
	$display=$_GET['display'];
	if($display==1)
	{
	  $display=0;
	 	
	}else
	{
	  $display=1;	
	}
	$sql="UPDATE ".PRE."comment SET display={$display} WHERE id={$id}";
	    $result =mysql_query($sql);
	    if(!($result && mysql_affected_rows()>0)){
		   echo '更新评价状态失败<a href="index.php">返回</a>';
	 	   exit();		  
	    }
		header('location:index.php'); 
	
	break;
	
}

?>

