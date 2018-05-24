<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$rowState3=getState3Order();
$rowOrders=getAllOrder();
$rowState45=getState45Order();
$rowState5=getState5Order();
function getMonthOrders(){
    $rowOrders=getAllOrder();
    $Month=array();
    for($i=0;$i<count($rowOrders);$i++){
       $Month.array_push($Month,explode("-",explode(" ",$rowOrders[$i]['xiaddate'])[0])[1]);
    }
    return array_count_values($Month);
}
function getMonthState6(){
    $rowMonthState6=getState6Order();
    $MonthState6=array();
    for($i=0;$i<count($rowMonthState6);$i++){
        $MonthState6.array_push($MonthState6,explode("-",explode(" ",$rowMonthState6[$i]['xiaddate'])[0])[1]);
    }
    return array_count_values($MonthState6);
}

function getMonthState3(){
    $rowMonthState3=getState3Order();
    $MonthState3=array();
    for($i=0;$i<count($rowMonthState3);$i++){
        $MonthState3.array_push($MonthState3,explode("-",explode(" ",$rowMonthState3[$i]['xiaddate'])[0])[1]);
    }
    return array_count_values($MonthState3);
}
function getMonthState1(){
    $rowMonthState1=getState1Order();
    $MonthState1=array();
    for($i=0;$i<count($rowMonthState1);$i++){
        $MonthState1.array_push($MonthState1,explode("-",explode(" ",$rowMonthState1[$i]['xiaddate'])[0])[1]);
    }
    return array_count_values($MonthState1);
}
$MonthNum=getMonthOrders();
$MonthState6=getMonthState6();
$MonthState3=getMonthState3();
$MonthState1=getMonthState1();

//print_r(intval($key));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link href="assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
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
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>       
		<!-- <![endif]-->
        <script src="assets/dist/echarts.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
<title>交易</title>
</head>

<body>
<div class=" page-content clearfix">
 <div class="transaction_style">
   <ul class="state-overview clearfix">
    <li class="Info">
     <span class="symbol red"><i class="fa fa-jpy"></i></span>
     <span class="value"><h4>交易金额</h4><p class="Quantity color_red"><?php

             for($i=0;$i<count($rowState3);$i++){
                 $sumPrice=$rowState3[$i]['tota']*$rowState3[$i]['price'];
                 $result=$result+$sumPrice;
             }
             $result=$result;
             echo $result;
             ?></p></span>
    </li>
     <li class="Info">
     <span class="symbol  blue"><i class="fa fa-shopping-cart"></i></span>
     <span class="value"><h4>订单数量</h4><p class="Quantity color_red"><?php echo count($rowOrders);?></p></span>
    </li>
     <li class="Info">
     <span class="symbol terques"><i class="fa fa-shopping-cart"></i></span>
     <span class="value"><h4>交易成功</h4><p class="Quantity color_red"><?php echo count($rowState3);?></p></span>
    </li>
     <li class="Info">
     <span class="symbol yellow"><i class="fa fa-shopping-cart"></i></span>
     <span class="value"><h4>交易失败</h4><p class="Quantity color_red"><?php echo count($rowState45);?></p></span>
    </li>
     <li class="Info">
     <span class="symbol darkblue"><i class="fa fa-jpy"></i></span>
     <span class="value"><h4>退款金额</h4><p class="Quantity color_red"><?php

             for($i=0;$i<count($rowState5);$i++){
                 $sumPrice=$rowState5[$i]['tota']*$rowState5[$i]['price'];
                 $result=$result+$sumPrice;
             }
             $result=$result;
             echo $result;
             ?></p></span>
    </li>
   </ul>
 
 </div>
 <div class="t_Record">
               <div id="main" style="height:400px; overflow:hidden; width:100%; overflow:auto" ></div>     
              </div> 
</div>
</body>
</html>
<script type="text/javascript">
     $(document).ready(function(){
		 
		  $(".t_Record").width($(window).width()-60);
		  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
		 $(".t_Record").width($(window).width()-60);
		});
 });
	 
	 
        require.config({
            paths: {
                echarts: './assets/dist'
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/line',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                'echarts/chart/bar'
            ],
            function (ec,theme) {
                var myChart = ec.init(document.getElementById('main'),theme);
               option = {
    title : {
        text: '月购买订单交易记录',
        subtext: '实时获取用户订单购买记录'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['所有订单','待付款','已付款','待发货']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
        }
    ],
    yAxis : [
        {
            type : 'value',
        }
    ],
    series : [
        {
            name:'所有订单',
            type:'bar',
            data:[<?php echo $MonthNum['01'];?>, <?php echo $MonthNum['02'];?>, <?php echo $MonthNum['03'];?>, <?php echo $MonthNum['04'];?>, <?php echo $MonthNum['05'];?>, <?php echo $MonthNum['06'];?>, <?php echo $MonthNum['07'];?>, <?php echo $MonthNum['08'];?>, <?php echo $MonthNum['09'];?>, <?php echo $MonthNum['10'];?>,<?php echo $MonthNum['11'];?>, <?php echo $MonthNum['12'];?>],
            markPoint : {
                data : [
                    {type : 'max', name: '最大值'},
                    {type : 'min', name: '最小值'}
                ]
            }           
        },
        {
            name:'待付款',
            type:'bar',
            data:[<?php echo $MonthState6['01'];?>, <?php echo $MonthState6['02'];?>, <?php echo $MonthState6['03'];?>, <?php echo $MonthState6['04'];?>, <?php echo $MonthState6['05'];?>, <?php echo $MonthState6['06'];?>, <?php echo $MonthState6['07'];?>, <?php echo $MonthState6['08'];?>, <?php echo $MonthState6['09'];?>, <?php echo $MonthState6['10'];?>,<?php echo $MonthState6['11'];?>, <?php echo $MonthState6['12'];?>],
            markPoint : {
                data : [
                    {name : '年最高', value : <?php echo max($MonthState6);?>, xAxis: <?php echo $key=intval(array_search(max($MonthState6),$MonthState6));?>, yAxis: <?php echo max($MonthState6);?>, symbolSize:18},
                    {name : '年最低', value :<?php echo min($MonthState6);?>, xAxis: <?php echo $key=intval(array_search(min($MonthState6),$MonthState6));?>, yAxis:<?php echo min($MonthState6);?>}
                ]
            },
           
			
        }
		, {
            name:'已付款',
            type:'bar',
            data:[<?php echo $MonthState3['01'];?>, <?php echo $MonthState3['02'];?>, <?php echo $MonthState3['03'];?>, <?php echo $MonthState3['04'];?>, <?php echo $MonthState3['05'];?>, <?php echo $MonthState3['06'];?>, <?php echo $MonthState3['07'];?>, <?php echo $MonthState3['08'];?>, <?php echo $MonthState3['09'];?>, <?php echo $MonthState3['10'];?>,<?php echo $MonthState3['11'];?>, <?php echo $MonthState3['12'];?>],
            markPoint : {
                data : [
                    {name : '年最高', value : <?php echo max($MonthState3);?>, xAxis: <?php echo $key=intval(array_search(max($MonthState3),$MonthState3));?>, yAxis: <?php echo max($MonthState3);?>, symbolSize:18},
                    {name : '年最低', value :<?php echo min($MonthState3);?>, xAxis: <?php echo $key=intval(array_search(min($MonthState3),$MonthState3));?>, yAxis:<?php echo min($MonthState3);?>}
                ]
            },
           
		}
		, {
            name:'待发货',
            type:'bar',
            data:[<?php echo $MonthState1['01'];?>, <?php echo $MonthState1['02'];?>, <?php echo $MonthState1['03'];?>, <?php echo $MonthState1['04'];?>, <?php echo $MonthState1['05'];?>, <?php echo $MonthState1['06'];?>, <?php echo $MonthState1['07'];?>, <?php echo $MonthState1['08'];?>, <?php echo $MonthState1['09'];?>, <?php echo $MonthState1['10'];?>,<?php echo $MonthState1['11'];?>, <?php echo $MonthState1['12'];?>],
            markPoint : {
                data : [
                    {name : '年最高', value : <?php echo max($MonthState1);?>, xAxis: <?php echo $key=intval(array_search(max($MonthState1),$MonthState1));?>, yAxis: <?php echo max($MonthState1);?>, symbolSize:18},
                    {name : '年最低', value :<?php echo min($MonthState1);?>, xAxis: <?php echo $key=intval(array_search(min($MonthState1),$MonthState1));?>, yAxis:<?php echo min($MonthState1);?>}
                ]
            },
           
		}
    ]
};
                    
                myChart.setOption(option);
            }
        );
    </script> 