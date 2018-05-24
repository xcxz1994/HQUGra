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
?>