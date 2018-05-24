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
$MonthNum=getMonthOrders();
//print_r($MonthNum['05']);
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
        data:['所有订单','待付款','已付款','代发货']
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
            type : 'value'
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
            data:[26, 59, 30, 84, 27, 77, 176, 1182, 487, 188, 60, 23],
            markPoint : {
                data : [
                    {name : '年最高', value : 1182, xAxis: 7, yAxis: 1182, symbolSize:18},
                    {name : '年最低', value : 23, xAxis: 11, yAxis: 3}
                ]
            },
           
			
        }
		, {
            name:'已付款',
            type:'bar',
            data:[26, 59, 60, 264, 287, 77, 176, 122, 247, 148, 60, 23],
            markPoint : {
                data : [
                    {name : '年最高', value : 172, xAxis: 7, yAxis: 172, symbolSize:18},
                    {name : '年最低', value : 23, xAxis: 11, yAxis: 3}
                ]
            },
           
		}
		, {
            name:'代发货',
            type:'bar',
            data:[26, 59, 80, 24, 87, 70, 175, 1072, 48, 18, 69, 63],
            markPoint : {
                data : [
                    {name : '年最高', value : 1072, xAxis: 7, yAxis: 1072, symbolSize:18},
                    {name : '年最低', value : 22, xAxis: 11, yAxis: 3}
                ]
            },
           
		}
    ]
};
                    
                myChart.setOption(option);
            }
        );
    </script> 