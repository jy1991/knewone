<?php
include '../init.php';

$gid = $_GET['gid'];
$gname= $_GET['gname'];

//开始分页
//每页显示条数
$num = 10;
//得到总条数 总共有多少条数据
$sql="SELECT COUNT(id) total FROM ".PRE."image where goods_id = {$gid}";

$result = mysql_query($sql);
if($result && mysql_num_rows($result)>0){
    $rows = mysql_fetch_assoc($result);
}
//得到总条数
$total = $rows['total'];

//得到总页数
//总页数 = ceil(总条数/每页多少条) 进一法取整
$amount = ceil($total/$num);

//接收页码
$page = (int)$_GET['page'];
//锁定页码范围

if($page<1){
    $page =1;
}
if($page>$amount){
    $page =$amount;
}
//下一页
$next = $page+1;
//上一页
$prev = $page-1;


//偏移量 = （页数-1）*每页显示数
$offset = ($page -1)*$num;

$sql="SELECT id,name,is_face FROM ".PRE."image where goods_id = {$gid} ORDER BY id ASC";
$result =mysql_query($sql);
if($result && mysql_num_rows($result)>0){
    $i_list=array();
    while($row=mysql_fetch_assoc($result)){
        $i_list[]=$row;
    }
} 

// 产生数字链接
$start = $page -2;

$end = $page+2;

$num_links="";
if($start<1){
    $end+=(1-$start);
	$start=1;
}
if($end>$amount){
    $start-=($end-$amount);
	$end=$amount;
}
if($amount==0)
{
  $start=0;
  $end=0;	
}
if($amount==1)
{
  $start=1;
  $end=1;	
}
if($amount==2)
{
  $start=1;
  $end=2;	
}
if($amount==3)
{
  $start=1;
  $end=3;	
}
if($amount==4)
{
  $start=1;
  $end=4;	
}
if($amount==5)
{
  $start=1;
  $end=5;	
}
for($i=$start;$i<=$end;$i++){
    if($i == $page){
    $num_links.="<p style='width:4px; height:24px; line-height:24px; background:#7AA9CC; text-align:center; float:left; padding:0 8px;'><a href='index.php?page=$i{$url}' style='color:#fff; font-size=12px'>$i</a></p>";
    continue;
    }
    $num_links .="<p style='width:4px; height:24px; line-height:24px; background:#fff; text-align:center; float:left; padding:0 8px;'><a href='index.php?page=$i{$url}' style='color:#7AA9CC; font-size=12px'>$i</a></p>";
}


$str = <<<aaa
    <div style='float:right; margin-right:2px'>
    <p style='float:left; margin-right:12px; height:24px; line-height:24px;'>第&nbsp;<span style='color:#7AA9CC; font-size=10px'>{$page}</span>&nbsp;页&nbsp;&nbsp;共&nbsp;<span style='color:#7AA9CC; font-size=10px'>{$amount}</span>&nbsp;页&nbsp;&nbsp;总共&nbsp;<span style='color:#7AA9CC; font-size=10px'>{$total}</span>&nbsp;条数</p>
    <p style='width:4px; height:24px; line-height:24px; background:#fff; text-align:center; float:left; padding:0 8px;'><a href='index.php?page=1{$url}' style='color:#7AA9CC; font-size=10px'><<</a></p>
    <p style='width:4px; height:24px; line-height:24px; background:#fff; text-align:center; float:left; padding:0 8px;'><a href='index.php?page={$prev}{$url}' style='color:#7AA9CC; font-size=10px'><</a></p>
	$num_links
    <p style='width:4px; height:24px; line-height:24px; background:#fff; text-align:center; float:left; padding:0 8px;'><a href='index.php?page={$next}{$url}' style='color:#7AA9CC; font-size=10px'>></a></p>
    <p style='width:4px; height:24px; line-height:24px; background:#fff; text-align:center; float:left; padding:0 8px;'><a href='index.php?page={$amount}{$url}' style='color:#7AA9CC; font-size=10px'>>></a></p>
    </div>
aaa;

$i = 1;
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../css/css.css" type="text/css" rel="stylesheet" />
<link href="../css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF; background:#fff}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a.back{ background:#548fc9; padding:0 0px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:left}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
<script>
 function del_confirm() {
    if(!confirm("确认要删除吗？")) {
        window.event.returnValue = false;
      }
   }
</script> 
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：图片管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  	<tr>
   	  <td width="50%" align="left" valign="middle">
      <form method="post" action="action.php?a=addimg&gid=<?php echo $gid?>"  enctype="multipart/form-data">
        <span>上传图片：&nbsp;&nbsp;</span>
        <input type="file" name="pic" class="text-word">
	    <input name="" type="submit" value="上传" class="text-but">
	  </form>
      </td>
      <td width="10%" align="right" valign="middle" style="text-align:center"><a href="index.php?" target="mainFrame" onFocus="this.blur()" class="back">返回上层</a></td>
      <td width="20%" align="right" valign="middle" style="padding-right:24px">您正在管理<span style="font-size:1.2em; color:#548fc9; padding:0px 6px 0px 6px; background:#fff; display:inline_block; margin:0px 6px 0px 6px;"><?php echo $gname?></span>的图片</td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
   <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
   <tr>
    <th align="center" valign="middle" class="borderright">编号</th>
    <th align="center" valign="middle" class="borderright">图片</th>
    <th align="center" valign="middle" class="borderright">是否封面</th>
    <th align="center" valign="middle">操作</th>
   </tr>
  <?php foreach($i_list as $val){?>
   <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="center" valign="middle" class="borderright borderbottom"><?php echo $offset+$i ?></td>
    <td width="400px" align="center" valign="middle" class="borderright borderbottom"> <?php 
     $img_url=URL.'/uploads/';
     $img_url .=substr($val['name'],0,4).'/';   
     $img_url .=substr($val['name'],4,2).'/';
     $img_url .=substr($val['name'],6,2).'/';
     $img_url .='80_'.$val['name'];
 ?>   
    <img style="margin:8px" src="<?php echo $img_url?>"/></td>
    <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['is_face']==1?'<font color="green" size="4">√</font>':'<a href="action.php?a=is_face&iid='.$val['id'].'&gid='.$gid.'&gname='.$gname.'"><font size="4" color="red">×</font></a>' ?></td>
    <td align="center" valign="middle" class="borderbottom"><a href="action.php?a=imgdel&gid=<?php echo $gid?>&iid=<?php echo $val['id']?>&is_face=<?php echo $val['is_face']?>" target="mainFrame" onFocus="this.blur()"  onClick="del_confirm();" class="add">删除</a></td>
  </tr>
  <?php $i++;  }?>
    </table></td>
    </tr>
   <tr>
   <td align="left" valign="top" class="fenye">
   <?php echo $str ?>
   </td>
  </tr>
</table>
</body>
</html>
