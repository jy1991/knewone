<?php

/*
*  文件上传函数
*  @date   2015.11.3
*  @author jch
*  @param $name 表单name属性值
*  @param $dir  上传成功保存的目录
*  @param $allow_type 允许上传的文件类型
*  @return 文件上传成功返回文件名 失败返回false
*/
function upload($name='pic',$dir='./uploads/',$allow_type=array('jpg','png','gif','jpeg'))
{
  switch($_FILES[$name]['error'])
  {
	 case 0:
	 echo '文件上传成功！';
	 break; 
	 case 1:
	 echo '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。';
	 break;
	 case 2:
	 echo '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。';
	 break;
	 case 3:
	 echo '文件只有部分被上传。';
	 break;
	 case 4:
	 echo '没有文件被上传。';
	 break;
	 case 6:
	 echo '找不到临时文件夹。';
	 break;
	 case 7:
	 echo '文件写入失败。';
	 break;
  }
  $suffix=strrchr($_FILES[$name]['name'],'.');
  $type=ltrim($suffix,'.');
  if(!in_array($type,$allow_type))
  {
	echo '文件类型错误';
	return false;  
  }
  $filename=date('Ymd').uniqid().mt_rand(0,9999).$suffix;
  $save_path=rtrim($dir,'/');
  $save_path.='/';
  $save_path.=date('Y/m/d');
  if(!file_exists($save_path))
  mkdir($save_path,'0777',true);
  $path=$save_path.'/'.$filename;
  if(!is_uploaded_file($_FILES[$name]['tmp_name']))
  {
	echo '别黑我';
	return false;  
  }
  if(!move_uploaded_file($_FILES[$name]['tmp_name'],$path))
  {
	echo '上传失败';
	return false;  
  }
  return $filename;
}


/*
* 缩放函数
* @param string    $img_path   图片路径
* @param int       $width      缩放后的宽
* @param int       $height     缩放后的高
* @return  没有返回值，函数自动保存缩放好的图片
*/
function zoom($img_path, $width=200, $height=200){

  // 1.获取图片的后缀
  $suffix = ltrim(strrchr($img_path, '.'),'.');
  if($suffix == 'jpg'){
     $suffix = 'jpeg';
  }

 // 拼接两个函数名
 // 创建图片资源的函数名
 // imagecreatefromjpeg imagecreatefrompng imagecreatefromgif
 $func_resource = 'imagecreatefrom'.$suffix;

 // 保存图片的函数名
 // imagejpeg  imagepng   imagegif
 $func_save = 'image'.$suffix;

 // 获取原图的宽和高
 list($src_w, $src_h)=getimagesize($img_path);
 // 直接缩放
 // 打开原图产生资源
 $src =$func_resource($img_path);

 // 创建小图
 $dst = imagecreatetruecolor($width, $height);

 // 专业缩放的函数
 imagecopyresampled($dst, $src, 0,0, 0,0, $width, $height, $src_w, $src_h);

 // 处理缩放后的完整图片路径
 $save_path = dirname($img_path).'/'.$width.'_'.basename($img_path);

 // 保存缩放后的图片
 // imagejpeg imagepng imagegif  保存成功返回真，保存失败返回假
 $result = $func_save($dst, $save_path);
 
  // 销毁资源
 imagedestroy($src);
 imagedestroy($dst);

 return $result;

 }
?>