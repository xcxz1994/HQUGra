<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
$act=$_REQUEST['act'];
if($act=="addUser"){
    addUser();
}

/**
 * 检查管理员是否存在
 * @param unknown_type $sql
 * @return Ambigous <multitype:, multitype:>
 */
function checkAdmin($sql){
    return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
function checkLogined(){
    if($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
        alertMes("请先登陆","login.php");
    }
}
/**
 * 添加管理员
 * @return string
 */
function addAdmin(){
    $showtime=date("Y-m-d H:i:s");
    $arr['username']=$_POST['user-name'];
    $arr['password']=md5($_POST['userpassword']);
    $arr['email']=$_POST['email'];
    $arr['userphone']=$_POST['user-tel'];
    $arr['adminrole']=$_POST['admin-role'];
    $arr['jointime']=$showtime;
    var_dump($arr);
    if(insert("sys_admin",$arr)){
        $mes="添加成功!<br/><a href='administrator.php'>继续添加</a>|<a href='administrator.php'>查看管理员列表</a>";
    }else{
        $mes="添加失败!<br/><a href='administrator.php'>重新添加</a>";
    }
    return $mes;
}

/**
 * 得到所有的管理员
 * @return array
 */
function getAllAdmin(){

    $sql="select id,username,email,userphone,adminrole,jointime from sys_admin ";
    $rows=fetchAll($sql);
    return $rows;
}
/*function getSuperAdmin(){
    $sql="select id,username,email,userphone,adminrole,jointime from sys_admin where adminrole='超级管理员'";
    $rows=fetchAll($sql);

    return $rows;
}
function getAdmin(){
    $sql="select id,username,email,userphone,adminrole,jointime from sys_admin where adminrole='管理员'";
    $rows=fetchAll($sql);

    return $rows;
}
function getWriter(){
    $sql="select id,username,email,userphone,adminrole,jointime from sys_admin where adminrole='栏目主辑' or adminrole='栏目编辑'";
    $rows=fetchAll($sql);

    return $rows;
}
*/
function getAdminByPage($page,$pageSize=2){
    $sql="select * from sys_admin";
    global $totalRows;
    $totalRows=getResultNum($sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,username,email from sys_admin limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
    $showtime=date("Y-m-d H:i:s");
    $arr['username']=$_POST['user-name'];
    $arr['password']=md5($_POST['userpassword']);
    $arr['sex']=$_POST['sex'];
    $arr['age']=$_POST['age'];
    $arr['email']=$_POST['email'];
    $arr['userphone']=$_POST['user-tel'];
    $arr['qq']=$_POST['qq'];
    $arr['adminrole']=$_POST['admin-role'];
    $arr['jointime']=$showtime;
    var_dump($arr);
    if(update("sys_admin", $arr,"id={$id}")){
        $mes="编辑成功!<br/>";

    }else{
        $mes="编辑失败!<br/>";

    }
    return $mes;
}

/**
管理员修改个人信息
 **/
function editAdminInfo($id){

    $arr['username']=$_POST['user-name'];
    $arr['sex']=$_POST['sex'];
    $arr['age']=$_POST['age'];
    $arr['email']=$_POST['email'];
    $arr['userphone']=$_POST['user-tel'];
    $arr['qq']=$_POST['qq'];
    $arr['adminrole']=$_POST['admin-role'];
    var_dump($arr);
    if(update("sys_admin", $arr,"id={$id}")){
        $mes="修改个人信息成功!<br/>";

    }else{
        $mes="修改个人信息失败!<br/>";

    }
    return $mes;
}


/**
修改管理员个人密码
 **/
function editAdminPwd($id){

    $arr['password']=md5($_POST['newpassword']);
    var_dump($arr);
    if(update("sys_admin", $arr,"id={$id}")){
        $mes="修改个人信息成功!<br/>";

    }else{
        $mes="修改个人信息失败!<br/>";

    }
    return $mes;
}
/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
function delAdmin($id){
    if(delete("sys_admin","id={$id}")){
        $mes="删除成功!<br/>";
        echo "0";
    }else{
        $mes="删除失败!<br/>";
        echo "1";
    }
    return $mes;
}

/**
 * 注销管理员
 */
function logout(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminId'])){
        setcookie("adminId","",time()-1);
    }
    if(isset($_COOKIE['adminName'])){
        setcookie("adminName","",time()-1);
    }
    session_destroy();
    header("location:./login.php");
}

/**
 * 得到所有的入住商家
 * @return array
 */
function getAllUser(){

    $sql="select * from  bas_contact_client";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * 添加用户的操作
 * @param int $id
 * @return string
 */

function addUser(){

    $showtime=date("Y-m-d H:i:s");
    $arruser['cl_registDate']=$showtime;
    $arruser['cl_id']=$_POST['user-id'];

    $arruser['cl_pswd']=md5($_POST['user-pwd']);
    $arruser['cl_name']=$_POST['user-name'];
    $arruser['cl_phone']=$_POST['user-tel'];
    $arruser['cl_address']=$_POST['user-address'];
    $arruser['cl_represent']=$_POST['user-represent'];
    $arruser['cl_busLicenseNum']=$_POST['user-busLicenseNum'];
    $arruser['cl_bank']=$_POST['user-bank'];
    $arruser['cl_bankNum']=$_POST['user-bankNum'];
    $arruser['cl_bankPhone']=$_POST['user-bankPhone'];
    $arruser['cl_taxNum']=$_POST['user-taxNum'];
    $arruser['cl_loginState']=$_POST['user-Status'];
    $arruser['cl_beizhu']=$_POST['user-beizhu'];
    $arruser['cl_busLicensePicture']=$_POST['user-busLicenseImg'];



    if(insert("bas_contact_client",$arruser)){
        var_dump("aaaaaaaaaaaaaaa");
        $mes="添加成功!<br/><a href='user_list.php'>继续添加</a>|<a href='user_list.php'>查看用户列表</a>";
    }else{
        $mes="添加失败!<br/><a href='user_list.php'>重新添加</a>";
    }
    return $mes;
}
/**
 * 删除用户的操作
 * @param int $id
 * @return string
 */
function delUser($id){
    $sql="select face from sys_user where id=".$id;
    $row=fetchOne($sql);
    $face=$row['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/".$face);
    }
    if(delete("sys_user","id={$id}")){
        $mes="删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
    }
    return $mes;
}
/**
 * 编辑用户的操作
 * @param int $id
 * @return string
 */
function editUser($id){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if(update("sys_user", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listUser.php'>请重新修改</a>";
    }
    return $mes;
}


/**
获取管理员登录的地区
 **/
function getCity($ip = '')//获取地区
{
    if($ip == ''){
        $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";//新浪借口获取访问者地区
        $ip=json_decode(file_get_contents($url),true);
        $data = $ip;
    }else{
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;//淘宝借口需要填写ip
        $ip=json_decode(file_get_contents($url));
        if((string)$ip->code=='1'){
            return false;
        }
        $data = (array)$ip->data;
    }

    return $data;
}
/**
获取管理员登录的IP
 **/
function getloginIP(){
    if ($_SERVER['REMOTE_ADDR']) {//判断SERVER里面有没有ip，因为用户访问的时候会自动给你网这里面存入一个ip
        $cip = $_SERVER['REMOTE_ADDR'];
    } elseif (getenv("REMOTE_ADDR")) {//如果没有去系统变量里面取一次 getenv()取系统变量的方法名字
        $cip = getenv("REMOTE_ADDR");
    } elseif (getenv("HTTP_CLIENT_IP")) {//如果还没有在去系统变量里取下客户端的ip
        $cip = getenv("HTTP_CLIENT_IP");
    } else {
        $cip = "unknown";
    }
    return $cip;
}
/**

 获取当前管理员的登录记录
 **/
function getLoginRecord(){
    $sql="select * from sys_admin_loginrecord where username='{$_SESSION['adminName']}'";
    $rows=fetchAll($sql);
    return $rows;
}