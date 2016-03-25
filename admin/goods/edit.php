<?php
 include '../init.php';
 
$cate_id=$_GET['cate_id'];
$id=$_GET['gid'];

$sql="SELECT id,name,path,concat(path,id,',') as bpath FROM ".PRE."category ORDER BY bpath";
$result =mysql_query($sql);
if($result && mysql_num_rows($result)>0){
    $cate_list = array();
    while($row=mysql_fetch_assoc($result)){
        $cate_list[]=$row;
    }
}

$sql="SELECT id,name,cate_id,price,stock,status,heart,sell,comment,`describe` FROM ".PRE."goods WHERE id={$id} ORDER BY id ASC";
$result=mysql_query($sql);
if($result && mysql_num_rows($result)>0)
{
  $productlist=array();
  while($row=mysql_fetch_assoc($result))
  {
	$productlist[]=$row;  
  }
} 

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
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for input.text-radio{}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：商品管理&nbsp;&nbsp;>&nbsp;&nbsp;修改商品</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">编辑商品</a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="action.php?a=edit" enctype="multipart/form-data">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
     <?php foreach($productlist as $val){?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品名称：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="name" value="<?php echo $val['name']?>" class="text-word">
        </td>
        </tr>

       <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品分类：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <select name="cate_id" id="level">
<?php 
    foreach($cate_list as $val2){
    //统计path字段有几个逗号
    $num =substr_count($val2['path'],',');
    $space = str_repeat('—',($num-1)*2);
?>
    <?php if($val2['id']==$cate_id) {
    echo '<option value="'.$cate_id.'" selected>&nbsp;&nbsp;'.$space.$val2['name'].'</option>';
	}
	else{
	echo '<option value="'.$val2['id'].'">&nbsp;&nbsp;'.$space.$val2['name'].'</option>';	
    } 
} ?>
    </select>
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">商品价格：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="number" name="price" value="<?php echo $val['price']?>" class="text-word">
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">商品库存：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="number" name="stock" value="<?php echo $val['stock']?>" class="text-word">
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">是否上架：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="radio" name="status" value="0" class="text-radio" <?php echo $val['status']==0?' checked':''; ?>>卖完下架
    <input type="radio" name="status" value="1" class="text-radio" <?php echo $val['status']==1?' checked':''; ?>>有货速抢
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">收藏人数：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="number" name="heart" value="<?php echo $val['heart']?>" class="text-word">
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">销量：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="number" name="sell" value="<?php echo $val['sell']?>" class="text-word">
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">评论数目：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="number" name="comment" value="<?php echo $val['comment']?>" class="text-word">
    </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">商品描述：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <textarea name="describe" rows="10" cols="50"><?php echo $val['describe'] ?></textarea>
    </td>
    </tr>
     
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <input name="" type="submit" value="提交" class="text-but">
    <input name="" type="reset" value="重置" class="text-but"></td>
    </tr>
    <?php }?>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>
