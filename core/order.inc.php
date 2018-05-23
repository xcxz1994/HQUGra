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
?>