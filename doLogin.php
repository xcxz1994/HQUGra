<?php

ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$username = $_POST['username'];
$password=md5($_POST['password']);

$autoFlag=$_POST['autoFlag'];

    $sql="select * from hqugra_admin where username='{$username}' and password='{$password}'";
    $row=checkAdmin($sql);
    if($row){
        //如果选了一周内自动登陆
        if($autoFlag){
            setcookie("adminId",$row['id'],time()+7*24*3600);
            setcookie("adminName",$row['username'],time()+7*24*3600);
        }
        $_SESSION['adminName']=$row['username'];
        $_SESSION['adminId']=$row['id'];
        echo "0";
       // alertMes("登陆成功","index.php");
    }else{
        echo "1";
        //alertMes("登陆失败，重新登陆","login.php");
    }


?>