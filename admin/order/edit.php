
<?php
    include '../init.php';
    $id = $_GET['order_id'];

    $sql ="SELECT * FROM ".PRE."order WHERE id=".$id;
    $result =mysql_query($sql);
    if($result && mysql_num_rows($result)>0){
        $row = mysql_fetch_assoc($result);
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
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover { background:url(../images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：订单管理&nbsp;&nbsp;>&nbsp;&nbsp;修改订单</td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">编辑订单</a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="action.php?a=edit&id=<?php echo $id?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">订单ID：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" value="<?php echo $row['id']?>" class="text-word" disabled>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">订单编号：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" value="<?php echo $row['number']?>" class="text-word" disabled>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">收货人姓名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="person" value="<?php echo $row['person']?>" class="text-word">
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">收货人地址：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="address" value="<?php echo $row['address']?>" class="text-word">
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">收货人电话：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="phone" value="<?php echo $row['phone']?>" class="text-word">
        </td>
      </tr>      
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">客户ID：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" value="<?php echo $row['customer_id']?>" class="text-word" disabled>
        </td>
      </tr> 
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">客户用户名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" value="
    <?php 
    $sql="SELECT * FROM ".PRE."customer WHERE id=".$row['customer_id'];
	$result = mysql_query($sql);
	$customer='';
	if($result && mysql_num_rows($result))
	{
	  while($row5=mysql_fetch_assoc($result))
	  {
		 $customer=$row5;  
	  }
	
	echo $customer['name']; 
	}
	?>
        " class="text-word" disabled>
        </td>
    </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">订单总价：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="sum" value="<?php echo $row['sum']?>" class="text-word">
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">商品数目：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" value="<?php echo $row['qty']?> 件" class="text-word" disabled>
        </td>
      </tr>  
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">订单状态：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
       <select class="text-word" name="status"> 
       <option value="0" <?php if($row['status']==0){ echo 'selected';} ?>>&nbsp;&nbsp;未付款</option>
       <option value="1" <?php if($row['status']==1){ echo 'selected';} ?>>&nbsp;&nbsp;已付款 未发货</option>
       <option value="2" <?php if($row['status']==2){ echo 'selected';} ?>>&nbsp;&nbsp;已付款 已发货</option>
       <option value="3" <?php if($row['status']==3){ echo 'selected';} ?>>&nbsp;&nbsp;确认收货</option>
       <option value="4" <?php if($row['status']==4){ echo 'selected';} ?>>&nbsp;&nbsp;交易关闭</option>
       <option value="5" <?php if($row['status']==5){ echo 'selected';} ?>>&nbsp;&nbsp;退货</option>
       <option value="6" <?php if($row['status']==6){ echo 'selected';} ?>>&nbsp;&nbsp;退款</option>
       <option value="7" <?php if($row['status']==7){ echo 'selected';} ?>>&nbsp;&nbsp;评论</option>
        </select>
        </td>
      </tr>          
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">生成时间：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" value="
	<?php 
	$time=substr($row['addtime'],0,4).'-';
	$time.=substr($row['addtime'],4,2).'-';
	$time.=substr($row['addtime'],6,2).'&nbsp;&nbsp;';
	$time.=substr($row['addtime'],8,2).' : ';
	$time.=substr($row['addtime'],10,2).' : ';
	$time.=substr($row['addtime'],12,2);
	echo $time;
	?>" class="text-word" disabled>
        </td>
      </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="修改" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
        </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>
