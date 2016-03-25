<?php
    
include '../init.php';

$a = $_GET['a'];

switch($a){
case 'add':
  //1.判断所有表单项是否为空
  foreach($_POST as $val){
  if($val == ''){
    echo '表单未填完，<a href="./add.php">返回</a>';
    exit();
    }          
  }

  //2.处理文件上传
  $filename = upload('pic',PATH.'uploads/');
  //判断上传是否成功
  if(!$filename){
     echo '上传失败，请重新上传<a href="./add.php">返回</a>';
     exit();
  }

  //图片缩放
  //处理图片路径
  $img_path = PATH.'uploads/';
  $img_path .=substr($filename,0,4).'/';//year
  $img_path .=substr($filename,4,2).'/';//month
  $img_path .=substr($filename,6,2).'/';//days
  $img_path .=$filename;
  
  if(
     !zoom($img_path,150,150)||
     !zoom($img_path,80,80) ||
     !zoom ($img_path,50,50)
   ){
    //拼接缩放图片路径
    $path_150 = dirname($img_path).'/150_'.basename($img_path);
    $path_80 = dirname($img_path).'/80_'.basename($img_path);
    $path_50 = dirname($img_path).'/50_'.basename($img_path);
    unlink($path_150);
    unlink($path_80);
    unlink($path_50);

    //删除原图
    unlink($img_path);
    echo '图片缩放失败，重新上传<a href="./add.php">返回</a>';
    exit(); 
    }

    //接受数据
    $name = $_POST['name'];
    $cate_id=$_POST['cate_id'];
    $price=$_POST['price'];
    $stock=$_POST['stock'];
    $status = $_POST['status'];
    $heart = $_POST['heart'];
    $sell = $_POST['sell'];
    $comment = $_POST['comment'];
    $describe = $_POST['describe'];
    $addtime = time();
    $sql="INSERT INTO ".PRE."goods(name,cate_id,price,stock,`status`,heart,sell,comment,addtime,`describe`) VALUES('{$name}',{$cate_id},{$price},{$stock},{$status},{$heart},{$sell},{$comment},{$addtime},'{$describe}')";
    
    $result = mysql_query($sql);
    if($result && mysql_affected_rows()>0){
        $goods_id = mysql_insert_id();
        $sql = "INSERT INTO ".PRE."image(name,goods_id,is_face) VALUES('{$filename}',{$goods_id},1)";
        $result = mysql_query($sql);
        if($result && mysql_affected_rows()>0){
            echo '商品添加成功<a href="index.php">返回</a>';
			exit();
        }else{
          //删除刚才写入goods表中的数据
          $sql ="DELETE FROM ".PRE."goods WHERE id={$goods_id}";
          $result=mysql_query($sql);
          if($result){
             //拼接缩放图片路径
             $path_150 = dirname($img_path).'/150_'.basename($img_path);
             $path_80 = dirname($img_path).'/80_'.basename($img_path);
             $path_50 = dirname($img_path).'/50_'.basename($img_path);
             unlink($path_150);
             unlink($path_80);
             unlink($path_50);

             //删除原图
             unlink($img_path);
             echo '商品图片添加，失败请<a href="./add.php">返回</a>';
             exit(); 
            }
        }
        
    }else{
    //拼接缩放图片路径
    $path_150 = dirname($img_path).'/150_'.basename($img_path);
    $path_80 = dirname($img_path).'/80_'.basename($img_path);
    $path_50 = dirname($img_path).'/50_'.basename($img_path);
    unlink($path_150);
    unlink($path_80);
    unlink($path_50);

    //删除原图
    unlink($img_path);
    echo '商品添加失败，请<a href="./add.php">返回</a>';
    exit(); 
    }
  break;
  
case 'status':
    $id = $_GET['id'];
    $status =$_GET['status'];
    $sql ="UPDATE ".PRE."goods SET status={$status} WHERE id={$id}";
    $result =mysql_query($sql);
    if($result&& mysql_affected_rows()>0){
        header('location:index.php');
    }else{
        header('location:index.php');
    }
    break;

	
case 'del':
	$gid=$_GET['gid'];
	$sql ="SELECT name FROM ".PRE."image WHERE goods_id = {$gid}";
	$result =mysql_query($sql);
	if($result && mysql_num_rows($result)>0){
		$img_list = array();
		while($row=mysql_fetch_assoc($result)){
			$img_list[]=$row;
		}
	}

	foreach($img_list as $val){

	$path = PATH.'uploads/';
	$path .=substr($val['name'],0,4).'/';
	$path .=substr($val['name'],4,2).'/';
	$path .=substr($val['name'],6,2).'/';

	$path_src = $path.$val['name'];

	$path_150 = $path.'/150_'.$val['name'];

	$path_80 = $path .'/80_'.$val['name'];

	$path_50 = $path.'50_'.$val['name'];
	
	@unlink($path_150);
	@unlink($path_80);
	@unlink($path_50);
	@unlink($path_src);
	}

	$sql ="DELETE FROM ".PRE."image WHERE goods_id={$gid}";
	$result =mysql_query($sql);
	if($result){
		$sql="DELETE FROM ".PRE."goods WHERE id={$gid}";
		$result =mysql_query($sql);
		if($result){
		    header('location:index.php');
		}else{
			echo '商品表删除失败。<a href="index.php">返回</a>'; 
			exit();
		}
	}else{
		    echo '图片表删除失败。<a href="index.php">返回</a>'; 
			exit();
	}
	break;

case 'addimg':
    $gid = $_GET['gid'];
    $filename = upload('pic',PATH.'uploads/');
	if(!$filename){
		echo '上传失败，<a href="image.php?gid='.$gid.'">返回</a>';
		exit();
	}     
    $img_path = PATH.'uploads/';
	$img_path .=substr($filename,0,4).'/';
	$img_path .=substr($filename,4,2).'/';
	$img_path .=substr($filename,6,2).'/';
	$img_path .=$filename;
	if(
	   !zoom($img_path,150,150)||
	   !zoom($img_path,80,80)||
	   !zoom($img_path,50,50)
	){
	   $path_150 = dirname($img_path).'/150_'.basename($img_path);
	   $path_80 = dirname($img_path).'/80_'.basename($img_path);
	   $path_50 = dirname($img_path).'/50_'.basename($img_path);
	   unlink($path_150);
	   unlink($path_80);
	   unlink($path_50);
       unlink($img_path);
	 echo '图片缩放失败，请重新上传<a href="image.php?gid='.$gid.'">返回</a>';
	 exit(); 
	}
	
	$sql ="INSERT INTO ".PRE."image(name,goods_id,is_face) VALUES('{$filename}','{$gid}',0)";
	$result =mysql_query($sql);
	if($result && mysql_affected_rows()>0){
	   echo '添加图片成功<a href="image.php?gid='.$gid.'">返回</a>';exit;
	}else{
	   $path_150 = dirname($img_path).'/150_'.basename($img_path);
	   $path_80 = dirname($img_path).'/80_'.basename($img_path);
	   $path_50 = dirname($img_path).'/50_'.basename($img_path);
	   unlink($path_150);
	   unlink($path_80);
	   unlink($path_50);
       unlink($img_path); 
	   echo '添加图片失败 重新上传<a href="image.php?gid='.$gid.'">返回</a>';
	   exit(); 
	}
	break;

case 'imgdel':
	$gid=$_GET['gid'];
	$iid = $_GET['iid'];
	$is_face = $_GET['is_face'];
	if($is_face == 1){
    echo '不能删除封面，<a href="image.php?gid='.$gid.'">返回</a>';
	exit();
	}
	$sql ="SELECT name FROM ".PRE."image WHERE id = {$iid}";
	$result =mysql_query($sql);
	if($result && mysql_num_rows($result)>0){
		$img_list = array();
		while($row=mysql_fetch_assoc($result)){
			$img_list[]=$row;
		}
	}

	foreach($img_list as $val){

	$path = PATH.'uploads/';
	$path .=substr($val['name'],0,4).'/';
	$path .=substr($val['name'],4,2).'/';
	$path .=substr($val['name'],6,2).'/';

	$path_src = $path.$val['name'];

	$path_150 = $path.'/150_'.$val['name'];

	$path_80 = $path .'/80_'.$val['name'];

	$path_50 = $path.'50_'.$val['name'];
	
	@unlink($path_150);
	@unlink($path_80);
	@unlink($path_50);
	@unlink($path_src);
	}
	
	$sql="DELETE FROM ".PRE."image WHERE id={$iid}";
	$result =mysql_query($sql);
	if($result){
	   header('location:image.php?gid='.$gid);
	}else{
	   header('location:image.php?gid='.$gid);
	}
	break;
	
case 'is_face':
    $gid=$_GET['gid'];
	$iid=$_GET['iid'];
	$gname=$_GET['gname'];
	$sql ="UPDATE ".PRE."image SET is_face=0 WHERE goods_id={$gid}";
    $result =mysql_query($sql);
    if($result&& mysql_affected_rows()>0)
	{
	  $sql ="UPDATE ".PRE."image SET is_face=1 WHERE id={$iid}";
	  $result =mysql_query($sql);
	  if($result&& mysql_affected_rows()>0)
	  {
	    header('location:image.php?gid='.$gid.'&gname='.$gname);
	  }else{
        header('location:image.php?gid='.$gid.'&gname='.$gname);
      }
	}else{
	  header('location:image.php?gid='.$gid.'&gname='.$gname);	
	}
    break;
	
case 'edit':
    $id=$_POST['id'];
    $name=$_POST['name'];
	$cate_id=$_POST['cate_id'];
	$price=$_POST['price'];
	$stock=$_POST['stock'];
	$status=$_POST['status'];
	$heart=$_POST['heart'];
	$sell=$_POST['sell'];
	$comment=$_POST['comments'];
	$describe=$_POST['describe'];
	
	$sql="UPDATE ".PRE."goods SET name='{$name}',cate_id='{$cate_id}',price='{$price}',stock='{$stock}',`status`='{$status}',heart='{$heart}',sell='{$sell}',comment='{$comment}',`describe`='{$describe}' WHERE id='{$id}'";
	$result =mysql_query($sql);
	if($result && mysql_affected_rows()>0){
	   echo '修改成功，<a href="index.php">返回</a>';
	   exit();
	}else{
	   echo '没有改动，<a href="index.php"">返回</a>';
	   exit();
	}
}
  break;


?>