<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$rowsUsers=getAllUser();
$pros=getAllPro();
$prosStatus1=getStatus1Pro();
$prosStatus0=getStatus0Pro();
$prosStatus2=getStatus2Pro();
$rowOrders=getAllOrder();
$rowState1=getState1Order();
$rowState2=getState2Order();
$rowState3=getState3Order();
$rowState6=getState6Order();
$rowState45=getState45Order();
if(isset($_SESSION['adminId'])){
    $sql="select * from sys_message where message_to={$_SESSION['adminId']} and message_status=2";
    $rows=fetchAll($sql);
    //print_r($rows);
}elseif(isset($_COOKIE['adminId'])){
    $sql="select * from sys_message where message_to={$_COOKIE['adminId']}and message_status=2";
    $rows=fetchAll($sql);
    //print_r($rows);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link href="assets/css/codemirror.css" rel="stylesheet">
    <!--[if IE 7]>
    <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="assets/js/ace-extra.min.js"></script>
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <!--[if !IE]> -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- <![endif]-->
    <script src="assets/dist/echarts.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <title></title>
</head>
<body>
<div class="page-content clearfix">
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
        <i class="icon-ok green"></i>欢迎使用<strong class="green">后台管理系统<small>(v1.2)</small></strong>,你本次登陆时间为<?php echo $showtime=date("Y-m-d H:i:s");?>，登陆IP为<?php echo $ip=getloginIP(); ?>
    </div>
    <div class="state-overview clearfix">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <a href="#" title="商城会员">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <h1><?php echo count($rowsUsers);?></h1>
                        <p>商城用户</p>
                    </div>
                </a>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="icon-tags"></i>
                </div>
                <div class="value">
                    <h1><?php echo count($pros);?></h1>
                    <p>上架商品</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol yellow">
                    <i class="icon-shopping-cart"></i>
                </div>
                <div class="value">
                    <h1><?php echo count($rowOrders);?></h1>
                    <p>商城订单</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol blue">
                    <i class="icon-bar-chart"></i>
                </div>
                <div class="value">
                    <h1><?php

                        for($i=0;$i<count($rowState3);$i++){
                            $sumPrice=$rowState3[$i]['tota']*$rowState3[$i]['price'];
                            $result=$result+$sumPrice;
                        }
                        $result=$result;
                        echo $result;
                        ?></h1>
                    <p>交易记录</p>
                </div>
            </section>
        </div>
    </div>
    <!--实时交易记录-->
    <div class="clearfix">
        <div class="Order_Statistics ">
            <div class="title_name">订单统计信息</div>
            <table class="table table-bordered">
                <tbody>
                <tr><td class="name">待发货订单：</td><td class="munber"><a href="#"><?php echo count($rowState1);?></a>&nbsp;个</td></tr>
                <tr><td class="name">待收货订单：</td><td class="munber"><a href="#"><?php echo count($rowState2);?></a>&nbsp;个</td></tr>
                <tr><td class="name">已成交订单数：</td><td class="munber"><a href="#"><?php echo count($rowState3);?></a>&nbsp;个</td></tr>
                <tr><td class="name">待付款订单数：</td><td class="munber"><a href="#"><?php echo count($rowState6);?></a>&nbsp;个</td></tr>
                <tr><td class="name">交易失败：</td><td class="munber"><a href="#"><?php echo count($rowState45);?></a>&nbsp;个</td></tr>
                </tbody>
            </table>
        </div>
        <div class="Order_Statistics">
            <div class="title_name">商品统计信息</div>
            <table class="table table-bordered">
                <tbody>
                <tr><td class="name">商品总数：</td><td class="munber"><a href="#"><?php echo count($pros);?></a>&nbsp;个</td></tr>
                <tr><td class="name">上架商品：</td><td class="munber"><a href="#"><?php echo count($prosStatus1);?></a>&nbsp;个</td></tr>
                <tr><td class="name">下架商品：</td><td class="munber"><a href="#"><?php echo count($prosStatus2);?></a>&nbsp;个</td></tr>
                <tr><td class="name">待审核商品：</td><td class="munber"><a href="#"><?php echo count($prosStatus0);?></a>&nbsp;条</td></tr>

                </tbody>
            </table>
        </div>
        <!--<div class="t_Record">
          <div id="main" style="height:300px; overflow:hidden; width:100%; overflow:auto" ></div>
         </div> -->
        <div class="news_style">
            <div class="title_name">最新消息</div>
            <ul class="list">
                <?php  foreach($rows as $row):?>
                    <li><i class="icon-bell red"></i><a href="Guestbook.php"><?php echo $row['message_content'];?></a></li>
                <?php endforeach;?>

            </ul>
        </div>
    </div>
    <!--记录-->
    <div class="clearfix">
        <div class="home_btn">
            <div>
                <a href="Products_List.php"  title="审核商品" class="btn  btn-info btn-sm no-radius">
                    <i class="bigger-200"><img src="images/icon-addp.png" /></i>
                    <h5 class="margin-top">审核商品</h5>
                </a>
                <a href="Category_Manage.php"  title="产品分类" class="btn  btn-primary btn-sm no-radius">
                    <i class="bigger-200"><img src="images/icon-cpgl.png" /></i>
                    <h5 class="margin-top">产品分类</h5>
                </a>
                <a href="admin_info.php"  title="个人信息" class="btn  btn-success btn-sm no-radius">
                    <i class="bigger-200"><img src="images/icon-grxx.png" /></i>
                    <h5 class="margin-top">个人信息</h5>
                </a>
                <a href="Order_handling.html"  title="商品订单" class="btn  btn-purple btn-sm no-radius">
                    <i class="bigger-200"><img src="images/icon-gwcc.png" /></i>
                    <h5 class="margin-top">商品订单</h5>
                </a>
            </div>
        </div>

    </div>

</div>
</body>
</html>
<script type="text/javascript">
    //面包屑返回值
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.iframeAuto(index);
    $('.no-radius').on('click', function(){
        var cname = $(this).attr("title");
        var chref = $(this).attr("href");
        var cnames = parent.$('.Current_page').html();
        var herf = parent.$("#iframe").attr("src");
        parent.$('#parentIframe').html(cname);
        parent.$('#iframe').attr("src",chref).ready();;
        parent.$('#parentIframe').css("display","inline-block");
        parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
        //parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
        parent.layer.close(index);

    });
    $(document).ready(function(){

        $(".t_Record").width($(window).width()-640);
        //当文档窗口发生改变时 触发
        $(window).resize(function(){
            $(".t_Record").width($(window).width()-640);
        });
    });


</script>