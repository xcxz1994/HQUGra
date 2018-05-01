<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';

$rows=getAllUser();
$Allnumber=count($rows);
$commonNum=getcommon()[1];
$IroncardNum=getIroncard()[1];
$CopperNum=getCopper()[1];
$SilverNum=getSilver()[1];
$GoldNum=getGold()[1];
$JewelNum=getJewel()[1];
$RedJewelNum=getRedJewel()[1];
$BlueJewelNum=getBlueJewel()[1];
$BlackJewelNum=getBlackJewel()[1];

function getcommon(){
    $common=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='普通会员') {
            $common.array_push($common,$rows[$i]);
        }else{
           // echo "没有普通会员";
        }
    }
    $commonNum=count($common);
    return array($common,$commonNum);
}
function getIroncard(){
    $Ironcard=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='铁牌会员') {
            $Ironcard.array_push($Ironcard,$rows[$i]);
        }else{
           // echo "没有铁牌会员";
        }
    }
    $IroncardNum=count($Ironcard);
    return array($Ironcard,$IroncardNum);
}
function getCopper(){
    $Copper=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='铜牌会员') {
            $Copper.array_push($Copper,$rows[$i]);
        }else{
            //echo "没有铜牌会员";
        }
    }
    $CopperNum=count($Copper);
    return array($Copper,$CopperNum);
}
function getSilver(){
    $Silver=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='银牌会员') {
            $Silver.array_push($Silver,$rows[$i]);
        }else{
            //echo "没有银牌会员";
        }
    }
    $SilverNum=count($Silver);
    return array($Silver,$SilverNum);
}
function getGold(){
    $Gold=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='金牌会员') {
            $Gold.array_push($Gold,$rows[$i]);
        }else{
            //echo "没有金牌会员";
        }
    }
    $GoldNum=count($Gold);
    return array($Gold,$GoldNum);
}
function getJewel(){
    $Jewel=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='钻石会员') {
            $Jewel.array_push($Jewel,$rows[$i]);
        }else{
            //echo "没有钻石会员";
        }
    }
    $JewelNum=count($Jewel);
    return array($Jewel,$JewelNum);
}
function getRedJewel(){
    $RedJewel=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='红钻会员') {
            $RedJewel.array_push($RedJewel,$rows[$i]);
        }else{
            //echo "没有红钻会员";
        }
    }
    $RedJewelNum=count($RedJewel);
    return array($RedJewel,$RedJewelNum);
}
function getBlueJewel(){
    $BlueJewel=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='蓝钻会员') {
            $BlueJewel.array_push($BlueJewel,$rows[$i]);
        }else{
            //echo "没有蓝钻会员";
        }
    }
    $BlueJewelNum=count($BlueJewel);
    return array($BlueJewel,$BlueJewelNum);
}
function getBlackJewel(){
    $BlackJewel=array();
    $rows=getAllUser();
    for($i=0;$i<count($rows);$i++){
        if($rows[$i]['cl_grade']=='黑钻会员') {
            $BlackJewel.array_push($BlackJewel,$rows[$i]);
        }else{
            //echo "没有黑钻会员";
        }
    }
    $BlackJewelNum=count($BlackJewel);
    return array($BlackJewel,$BlackJewelNum);
}


?>

<!DOCTYPE>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>       
        <link href="assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>   
        <script src="js/lrtk.js" type="text/javascript" ></script>		
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="assets/dist/echarts.js"></script>
      
<title>会员等级</title>
</head>

<body>
<div class="grading_style"> 
<div id="category">
    <div id="scrollsidebar" class="left_Treeview">
    <div class="show_btn" id="rightArrow"><span></span></div>
    <div class="widget-box side_content" >
    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
     <div class="side_list">
      <div class="widget-header header-color-green2">
          <h4 class="lighter smaller">会员等级</h4>
      </div>
      <div class="widget-body">
         <ul class="b_P_Sort_list">
             <li><i class="orange  fa fa-user-secret"></i><a href="#">全部(<?php echo $Allnumber;?>)</a></li>
             <li><i class="fa fa-diamond pink "></i> <a href="#">普通会员(<?php echo $commonNum;?>)</a></li>
             <li> <i class="fa fa-diamond pink "></i> <a href="#">铁牌会员(<?php echo $IroncardNum;?>)</a> </li>
             <li> <i class="fa fa-diamond pink "></i> <a href="#">铜牌会员(<?php echo $CopperNum;?>)</a></li>
             <li><i class="fa fa-diamond pink "></i> <a href="#">银牌会员(<?php echo $SilverNum;?>)</a></li>
             <li><i class="fa fa-diamond pink "></i> <a href="#">金牌会员(<?php echo $GoldNum;?>)</a></li>
             <li> <i class="fa fa-diamond grey"></i> <a href="#">钻石会员(<?php echo $JewelNum;?>)</a></li>
             <li> <i class="fa fa-diamond red"></i> <a href="#">红钻会员(<?php echo $RedJewelNum;?>)</a></li>
             <li> <i class="fa fa-diamond blue"></i> <a href="#">蓝钻会员(<?php echo $BlueJewelNum;?>)</a></li>
             <li> <i class="fa fa-diamond grey"></i> <a href="#">黑钻(<?php echo $BlackJewelNum;?>)</a></li>
            </ul>
  </div>
  </div>
  </div>  
  </div>
  <!--右侧样式-->
   <div class="page_right_style right_grading">
   <div class="Statistics_style" id="Statistic_pie">
     <div class="type_title">等级统计 
     <span class="top_show_btn Statistic_btn">显示</span> 
     <span class="Statistic_title Statistic_btn"><a title="隐藏" class="top_close_btn">隐藏</a></span>
     </div> 
      <div id="Statistics" class="Statistics"></div> 
      </div>
      <!--列表样式-->
      <div class="grading_list">
       <div class="type_title">全部会员等级列表</div>
         <div class="table_menu_list">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
             <th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
             <th width="80">账号</th>
             <th width="100">用户名</th>
             <th width="100">法人代表</th>
             <th width="90">手机</th>
             <th width="100">地址</th>
             <th width="100">加入时间</th>
             <th width="100">等级</th>
             <th width="70">状态</th>
             <th width="80">操作</th>
			</tr>
		</thead>
	<tbody>
    <?php  foreach($rows as $row):?>
        <tr>
            <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
            <td><?php echo $row['cl_id'];?></td>
            <td><u style="cursor:pointer" class="text-primary" onclick="member_show(<?php echo $row['id'];?>)"><?php echo $row['cl_name'];?></u></td>
            <td><?php echo $row['cl_represent'];?></td>

            <td><?php echo $row['cl_phone'];?></td>
            <td class="text-l"><?php echo $row['cl_address'];?></td>
            <td><?php echo $row['cl_registDate'];?></td>
            <td><?php echo $row['cl_grade'];?></td>
            <td class="td-status"><span class="label label-success radius">已启用</span></td>
            <td class="td-manage">
                <a onClick="member_stop(this,'10001')"  href="javascript:;" title="停用"  class="btn btn-xs btn-success"><i class="fa fa-check bigger-120"></i></a>

                <a title="删除" href="javascript:;"  onclick="member_del(this,<?php echo $row['id'];?>)" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
            </td>
        </tr>
    <?php endforeach;?>
      </tbody>
	</table>
   </div>
      </div>
   </div> 
  </div>
</div>
</body>
</html>
<script type="text/javascript"> 
$(function() { 
	$("#category").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:20,
		spacingh:240,
		set_scrollsidebar:'.right_grading',
	});
});
$(function() { 
	$("#Statistic_pie").fix({
		float : 'top',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		spacingw:0,
		spacingh:0,
		close_btn:'.top_close_btn',
		show_btn:'.top_show_btn',
		side_list:'.Statistics',
		close_btn_width:80,
		side_title:'.Statistic_title',
	});
});
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url+'#?='+id,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="fa fa-close bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}
/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="fa fa-check  bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
</script>
<script type="text/javascript">
//初始化宽度、高度  
 $(".widget-box").height($(window).height()); 
 $(".page_right_style").width($(window).width()-220);
 //$(".table_menu_list").width($(window).width()-240);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height());
	 $(".page_right_style").width($(window).width()-220);
	 //$(".table_menu_list").width($(window).width()-240);
	}) 
/**************/
     require.config({
            paths: {
                echarts: './assets/dist'
            }
        });
        require(
            [
                'echarts',
				'echarts/theme/macarons',
                'echarts/chart/pie',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
                'echarts/chart/funnel'
            ],
            function (ec,theme) {
                var myChart = ec.init(document.getElementById('Statistics'),theme);
			
			option = {
    title : {
        text: '用户等级统计',
        subtext: '实时更新最新等级',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        
        x : 'center',
        y : 'bottom',
        data:['普通用户','铁牌用户','铜牌用户','银牌用户','金牌用户','钻石用户','蓝钻用户','红钻用户']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: false},
            dataView : {show: false, readOnly: true},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'left',
                        max: 6200
                    }
                }
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    series : [
        {
            name:'品牌数量',
            type:'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:1200, name:'普通用户'},
                {value:1100, name:'铁牌用户'},
				{value:1300, name:'铜牌用户'},
				{value:1000, name:'银牌用户'},
				{value:980, name:'金牌用户'},
				{value:850, name:'钻石用户'},
				{value:550, name:'蓝钻用户'},
				{value:220, name:'红钻用户'},

            ]
        }
    ]
};
   myChart.setOption(option);
			}
);
</script>
<script type="text/javascript">
$(function($) {
				var oTable1 = $('#sample-table').dataTable( {
				"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,6,7,9]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			});
</script>
