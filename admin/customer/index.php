<?php 
include '../init.php';


//接受搜索信息
if($_GET['search']!=''){
    //如果进来说明用户点击查询了
    $search = $_GET['search'];
    $where = " WHERE name LIKE '%{$search}%'";
    $url ="&search={$search}";
    
}

//开始分页
//每页显示条数
$num = 10;
//得到总条数 总共有多少条数据
$sql="SELECT COUNT(id) total FROM ".PRE."customer {$where}";

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

$sql="SELECT * FROM ".PRE."customer {$where} limit $offset,$num";

$result = mysql_query($sql);
if($result && mysql_num_rows($result)>0){
    $customerlist = array();
    while($row = mysql_fetch_assoc($result)){
        $customerlist[]=$row;
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
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
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
    <td width="99%" align="left" valign="top">您的位置：客户管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="<?php 'index.php'.$url ?>">
	         <span>客户：</span>
             <input type="text" name="search"  value="<?php echo $_GET['search']?>" class="text-word">
	         <input name="" type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">新增客户</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">客户名</th>
        <th align="center" valign="middle" class="borderright">等级</th>
        <th align="center" valign="middle" class="borderright">经验</th>
        <th align="center" valign="middle" class="borderright">KO币</th>        <th align="center" valign="middle" class="borderright">锁定</th>
        <th align="center" valign="middle">操作</th>
      </tr>
      <?php foreach($customerlist as $val){?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $offset+$i ?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['name']?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['grade']?></td> 
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['exp']?></td>
      <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['ko']?></td>
    <td align="center" valign="middle" class="borderright borderbottom"><?php echo $val['display']==1?'<a href="action.php?a=display&id='.$val['id'].'&display=0">锁定</a>':'<a href="action.php?a=display&id='.$val['id'].'&display=1">正常</a>'?></td>
   <td align="center" valign="middle" class="borderbottom"><a href="edit.php?id=<?php echo $val['id']?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span><a href="changepwd.php?id=<?php echo $val['id']?>" target="mainFrame" onFocus="this.blur()" class="add">修改密码</a><span class="gray">&nbsp;|&nbsp;</span><a href="action.php?a=del&id=<?php echo $val['id']?>" target="mainFrame" onClick="del_confirm();" onFocus="this.blur()" class="add">删除</a></td>
   </tr>
      <?php $i++;  }?>
 
    </table></td>
    </tr>
  <tr>
  <td align="left" valign="top" class="fenye">

  <?php echo $str ?></td>
  </tr>
</table>
</body>
</html>
