<?php
include '../init.php';
for($i=1;$i<100;$i++){
    $name = 'user'.$i;
    $password=md5('123456');
    $type= 1;
    $sql="INSERT INTO ".PRE."user(id,name,password,type) VALUES(NULL,'{$name}','{$password}','{$type}')";
       // echo $sql;exit;
        $result = mysql_query($sql);
        if($result && mysql_affected_rows()>0){
            echo '添加成功<a href="index.php">返回</a>';
        }else{
            echo '添加失败<a href="add.php">返回</a>';
        }

    }
