<?php
session_start();
function yzmfunc($width=123,$height=47,$num=4,$fontsize=12,$type=4)
{
	$img=imagecreatetruecolor($width,$height);
	imagefill($img,0,0,imagecolorallocate($img,mt_rand(130,255),mt_rand(130,255),mt_rand(130,255)));
	
	for($i=0;$i<mt_rand(40,60);$i++)
	{
	  imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)));
	}
	
	for($i=0;$i<mt_rand(8,12);$i++)
	{
	  imageline($img,mt_rand(0,$width),mt_rand(0,$width),mt_rand(0,$width),mt_rand(0,$width),imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)));
	}
	switch($type)
	{
	  case 1:
	  if($num>10)
	  $num=10;
	  $str='1234567890';
	  break;
	  case 2:
	  if($num>26)
	  $num=26;
	  $str='qwertyuiopasdfghjklzxcvbnm';
	  break;
	  case 3:
	  if($num>26)
	  $str='QWERTYUIOPASDFGHJKLZXCVBNM';
	  break;
	  case 4:
	  if($num>62)	
	  $num=62;
	  $str='23456789qwertyupasdfghjkzxcvbnmQWERTYUPASDFGHJKZXCVBNM';
	  break;
	}

	$str=str_shuffle($str);
	$str=substr($str,0,$num);
	
	$_SESSION['vcode']=$str;
	$w=$width/$num;
	file_put_contents('yzm2.txt',$str);
	for($i=0;$i<$num;$i++)
	{
	  
	  $x=$i*$w+8;
	  $y=mt_rand($fontsize,$height);
	  imagettftext($img,$fontsize,mt_rand(-30,30),$x,$y,imagecolorallocate($img,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120)),'./6PXBUS.TTF',$str{$i});
	}
	
	header('content-type:image/jpeg');
	imagejpeg($img);
	imagedestroy($img);
}

?>