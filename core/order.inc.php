<?php
/**
 * Created by PhpStorm.
 * User: chuny
 * Date: 2018/5/23
 * Time: 16:39
 */

ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';
/**
得到所有订单信息
 **/
function getAllOrder(){

    $sql="select * from scm_all_order";
    $rows=fetchAll($sql);
    return $rows;
}
function getState1Order(){
    $sql="select * from scm_all_order where state=1";
    $rows=fetchAll($sql);
    return $rows;
}
function getState2Order(){
    $sql="select * from scm_all_order where state=2";
    $rows=fetchAll($sql);
    return $rows;
}
function getState1or2Order(){
    $sql="select * from scm_all_order where state=2 or state=1";
    $rows=fetchAll($sql);
    return $rows;
}
function getState3Order(){
    $sql="select * from scm_all_order where state=3";
    $rows=fetchAll($sql);
    return $rows;
}
function getState6Order(){
    $sql="select * from scm_all_order where state=6";
    $rows=fetchAll($sql);
    return $rows;
}
function getState45Order(){
    $sql="select * from scm_all_order where state!=3 and state!=1 and state!=2 and state!=6";
    $rows=fetchAll($sql);
    return $rows;
}
function getState5Order(){
    $sql="select * from scm_all_order where state!=3 and state!=1 and state!=2 and state!=6 and state!=4";
    $rows=fetchAll($sql);
    return $rows;
}

/**
订单发货
 **/
function Express($id){
    $showtime=date("Y-m-d H:i:s");
    $arr['state']=intval($_POST['state']);
    $arr['express']=$_POST['express'];
    $arr['express_Num']=$_POST['expressNum'];
    $arr['senddate']=$showtime;
    //var_dump($arr);
    if(update("scm_all_order", $arr,"or_id={$id}")){
        $mes="发货成功!<br/>";

    }else{
        $mes="发货失败!<br/>";

    }
    return $mes;
}
?>