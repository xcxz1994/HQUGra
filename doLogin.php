<?php

ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$username = $_POST['username'];
$password=md5($_POST['password']);
$logintime=date("Y-m-d H:i:s");
$city=getCity();
$IP=getloginIP();
$autoFlag=$_POST['autoFlag'];

$sql="select * from sys_admin where username='{$username}' and password='{$password}'";
$RecordSql="INSERT INTO sys_admin_loginrecord(username,adminrole,logintime,loginStatus,loginSite,loginIP) values ('{$username}','{$row['adminrole']}','{$logintime}','{$loginStatus}','{$city['country']}-{$city['province']}-{$city['city']}','{$IP}')";

$row=checkAdmin($sql);
global $loginStatus;


    //var_dump($IP);
if($row){
        //如果选了一周内自动登陆
        $loginStatus="登录成功";
        $arr['username']=$username;
        $arr['adminrole']=$row['adminrole'];
        $arr['logintime']=$logintime;
        $arr['loginStatus']=$loginStatus;
        $arr['loginSite']=$city['city'];
        $arr['loginIP']=$IP;
        if($autoFlag){
            setcookie("adminId",$row['id'],time()+7*24*3600);
            setcookie("adminName",$row['username'],time()+7*24*3600);
        }
        $_SESSION['adminName']=$row['username'];
        $_SESSION['adminId']=$row['id'];
        if(insert("sys_admin_loginrecord",$arr)){
           $mes="插入成功!";
        }else{
            $mes="插入失败!";
        }
        echo $row['adminrole'];
       // alertMes("登陆成功","index.php");

    }else{
        $arr['username']=$username;
        $arr['adminrole']=$row['adminrole'];
        $arr['logintime']=$logintime;
        $arr['loginStatus']=$loginStatus;
        $arr['loginSite']=$city['city'];
        $arr['loginIP']=$IP;
        $loginStatus="登录失败";
        insert("sys_admin_loginrecord",$arr);
        echo "1";
        //alertMes("登陆失败，重新登陆","login.php");
    }
?>