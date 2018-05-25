<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';
$rowState1s=getState1or2Order();
$rowOrders=getAllOrder();
function getOrderType(){
    $rowOrders=getAllOrder();
    $type=array();
    $parenttype=array();
    for($i=0;$i<count($rowOrders);$i++){
        $sql="select go_type from bas_material_goods where go_id={$rowOrders[$i]['go_id']}";
        $go_type=fetchAll($sql);
        $type.array_push($type,$go_type[0]['go_type']);
    }
    for($i=0;$i<count($type);$i++){
        $sql="select gt_parentId from bas_material_goodstype where gt_id={$type[$i]}";
        $go_parenttype=fetchAll($sql);
        $sql2="select gt_parentId from bas_material_goodstype where gt_id={$go_parenttype[0]['gt_parentId']}";
        $go_parenttype2=fetchAll($sql2);
        $parenttype.array_push($parenttype,$go_parenttype2[0]['gt_parentId']);
    }
    return $parenttype;
}
$type=getOrderType();
$key = array_count_values($type);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/H-ui.js"></script>     
		<script src="assets/js/typeahead-bs2.min.js"></script>           	
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="assets/js/jquery.easy-pie-chart.min.js"></script>
        <script src="js/lrtk.js" type="text/javascript" ></script>
<title>订单管理</title>
</head>

<body>
<div class="margin clearfix">
 <div class="cover_style" id="cover_style">
    <div class="top_style Order_form" id="Order_form_style">
      <div class="type_title">购物产品比例
      <div class="btn_style">  
      <a href="javascript:ovid()"  class="xianshi_btn Statistic_btn">显示</a> 
      <a href="javascript:ovid()"  class="yingchan_btn Statistic_btn b_n_btn">隐藏</a>
      </div>
      </div>
        <div class="hide_style clearfix">
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[1];?>" data-color="#D15B47"><span class="percent"><?php echo $key[1];?></span>%</div><span class="name">面料类</span></div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[2];?>" data-color="#87CEEB"><span class="percent"><?php echo $key[2];?></span>%</div><span class="name">纱线类</span></div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[3];?>" data-color="#87B87F"><span class="percent"><?php echo $key[3];?></span>%</div><span class="name">纺机类</span></div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[4];?>" data-color="#d63116"><span class="percent"><?php echo $key[4];?></span>%</div><span class="name">家纺类</span></div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[5];?>" data-color="#ff6600"><span class="percent"><?php echo $key[5];?></span>%</div><span class="name">服装类</span></div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[6];?>" data-color="#2ab023"><span class="percent"><?php echo $key[6];?></span>%</div><span class="name">辅料类</span></div>
       <div class="proportion"> <div class="easy-pie-chart percentage" data-percent="<?php echo $key[7];?>" data-color="#1e3ae6"><span class="percent"><?php echo $key[7];?></span>%</div><span class="name">原料类</span></div>

    </div>
    </div>
    <!--内容-->
   <div class="centent_style" id="centent_style">
     <div id="covar_list" class="order_list">
       <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
         <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list"><div class="widget-header header-color-green2"><h4 class="lighter smaller">订单类型分类</h4></div>
         <div class="widget-body">         
         <ul class="b_P_Sort_list">
             <li><i class="orange  fa fa-reorder"></i><a href="#">全部订单(<?php echo count($rowOrders);?>)</a></li>
             <li><i class="fa fa-sticky-note pink "></i> <a href="#">面料类(<?php echo $key[1];?>)</a></li>
             <li><i class="fa fa-sticky-note pink "></i> <a href="#">纱线类(<?php echo $key[2];?>)</a> </li>
             <li><i class="fa fa-sticky-note pink "></i> <a href="#">纺机类(<?php echo $key[3];?>)</a></li>
             <li><i class="fa fa-sticky-note pink "></i> <a href="#">家纺类(<?php echo $key[4];?>)</a></li>
             <li><i class="fa fa-sticky-note pink "></i> <a href="#">服装类(<?php echo $key[5];?>)</a></li>
             <li><i class="fa fa-sticky-note grey "></i> <a href="#">辅料类(<?php echo $key[6];?>)</a></li>
             <li><i class="fa fa-sticky-note red  "></i> <a href="#">原料类(<?php echo $key[7];?>)</a></li>
            </ul>
    
       </div>
      </div>  
     </div>
     </div>
     <!--左侧样式-->
     <div class="list_right_style">
     <div class="search_style">
     
      <ul class="search_content clearfix">
       <li><label class="l_f">订单编号</label><input name="" type="text" class="text_add" placeholder="订单订单编号" style=" width:250px"></li>
       <li><label class="l_f">时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="fa fa-search"></i>查询</button></li>
      </ul>
    </div>
      <!--订单列表展示-->
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="120px">询价单编号</th>
				<th width="150px">产品名称</th>
				<th width="100px">总价</th>
				<th width="100px">付款方式</th>
                <th width="120px">下单时间</th>
				<th width="100px">所属类型</th>
                <th width="80px">数量</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
    <?php  foreach($rowState1s as $rowState1):?>
     <tr>
     <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
     <td><?php echo $rowState1['ap_id'];?></td>
     <td class="order_product_name">
      <a href="#"><img src="<?php echo substr(explode(",",$rowState1['image'])[1],1);?>"  title="产品名称"/></a>
      <i class="fa fa-plus"></i>
       <a href="#"><img src="<?php echo substr(explode(",",$rowState1['image'])[0],1);?>"  title="产品名称"/></a>
     </td>
     <td><?php $sumPrice=$rowState1['tota']*$rowState1['price'];echo $sumPrice; ?></td>
     <?php
         if($rowState1['pay_type']==1){
             echo " <td>全款 </td>";
         }else{
             echo " <td>分期 </td>";
         }
      ?>
     <td><?php echo $rowState1['xiaddate'];?></td>
     <td><?php
         $go_id=$rowState1['go_id'];
         $sql="select go_type from bas_material_goods where go_id={$go_id}";
         $result=fetchOne($sql);
         $sql2="select * from bas_material_goodstype where gt_id={$result['go_type']}";
         $result2=fetchOne($sql2);
         echo $result2['gt_name'];
         ?></td>
     <td><?php echo $rowState1['tota'];?></td>
         <?php
         if($rowState1['state']==1){
             echo " <td class=\"td-status\"><span class=\"label label-success radius\">待发货</span></td>";
         }elseif ($rowState1['state']==2){
             echo " <td class=\"td-status\"><span class=\"label label-success radius\">待收货</span></td>";
         }
         ?>

     <td>
         <?php
         if($rowState1['state']==1){
             echo " <a onclick='Delivery_stop(this,$rowState1[or_id])' href='javascript:;' title='发货' class='btn btn-xs btn-success'><i class='fa fa-cubes bigger-120'></i></a>";
         }
         ?>
     <a title="订单详细"  href="order_detailed.php?id=<?php echo $rowState1['or_id'];?>"  class="btn btn-xs btn-info order_detailed" ><i class="fa fa-list bigger-120"></i></a>
     <a title="删除" href="javascript:;"  onclick="Order_form_del(this,'1')" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>    
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
 <!--发货-->
 <div id="Delivery_stop" style=" display:none">
  <div class="">
    <div class="content_style">

  <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">快递公司 </label>
       <div class="col-sm-9"><select class="form-control" id="form-field-select-1">
																<option value="">--选择快递--</option>
																<option value="天天快递">天天快递</option>
																<option value="圆通快递">圆通快递</option>
																<option value="中通快递">中通快递</option>
																<option value="顺丰快递">顺丰快递</option>
																<option value="申通快递">申通快递</option>
																<option value="邮政EMS">邮政EMS</option>
																<option value="邮政小包">邮政小包</option>
																<option value="韵达快递">韵达快递</option>
															</select></div>
	</div>
   <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 快递号 </label>
    <div class="col-sm-9"><input type="text" id="form-field-1" placeholder="快递号" class="col-xs-10 col-sm-5" style="margin-left:0px;"></div>
	</div>
 </div>
  </div>
 </div>
</body>
</html>
<script>
 $(function() { 
	$("#cover_style").fix({
		float : 'top',
		minStatue : false,
		skin : 'green',	
		durationTime :false,
		window_height:30,//设置浏览器与div的高度值差
		spacingw:0,//
		spacingh:0,//
		close_btn:'.yingchan_btn',
		show_btn:'.xianshi_btn',
		side_list:'.hide_style',
		widgetbox:'.top_style',
		close_btn_width:60,	
		da_height:'#centent_style,.left_Treeview,.list_right_style',	
		side_title:'.b_n_btn',		
		content:null,
		left_css:'.left_Treeview,.list_right_style'
		
		
	});
});
//左侧显示隐藏
$(function() { 
	$("#covar_list").fix({
		float : 'left',
		minStatue : false,
		skin:false,	
		//durationTime :false,
		spacingw:50,//设置隐藏时的距离
	    spacingh:270,//设置显示时间距
		stylewidth:'220',
		close_btn:'.close_btn',
		show_btn:'.show_btn',
		side_list:'.side_list',
		content:'.side_content',
		widgetbox:'.widget-box',
		da_height:null,
		table_menu:'.list_right_style'
	});
});
//时间选择
 laydate({
    elem: '#start',
    event: 'focus' 
});
/*订单-删除*/
function Order_form_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
/**发货**/
function Delivery_stop(obj,id){

	layer.open({
        type: 1,
        title: '发货',
		maxmin: true, 
		shadeClose:false,
        area : ['500px' , ''],
        content:$('#Delivery_stop'),
		btn:['确定','取消'],
		yes: function(index, layero){		
		if($('#form-field-1').val()==""){
			layer.alert('快递号不能为空！',{
               title: '提示框',				
			  icon:0,		
			  }) 
			
			}else{
             var express = $('#form-field-select-1').val();
            var expressNum= $('#form-field-1').val();
			 layer.confirm('提交成功！',function(index){
                 $.ajax({
                     url: './doAdminAction.php?act=express&id='+id,
                     type: 'post',
                     data: {
                         'express':express,
                         'expressNum':expressNum,
                         'state':2
                     },
                     success:function(data){
                         console.log(data)
                     }
                 })
		$(obj).parents("tr").find(".td-manage").prepend('<a style=" display:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="已发货"><i class="fa fa-cubes bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发货</span>');
		$(obj).remove();
		layer.msg('已发货!',{icon: 6,time:1000});
			});  
			layer.close(index);    		  
		  }
		
		}
	})
};
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form,.order_detailed').on('click', function(){
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

//初始化宽度、高度  
  var heights=$(".top_style").outerHeight()+47; 
 $(".centent_style").height($(window).height()-heights); 
 $(".page_right_style").width($(window).width()-220);
 $(".left_Treeview,.list_right_style").height($(window).height()-heights-2); 
 $(".list_right_style").width($(window).width()-250);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".centent_style").height($(window).height()-heights); 
	 $(".page_right_style").width($(window).width()-220);
	 $(".left_Treeview,.list_right_style").height($(window).height()-heights-2);  
	 $(".list_right_style").width($(window).width()-250);
	}) 
//比例
var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
			$('.easy-pie-chart.percentage').each(function(){
				$(this).easyPieChart({
					barColor: $(this).data('color'),
					trackColor: '#EEEEEE',
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: 10,
					animate: oldie ? false : 1000,
					size:103
				}).css('color', $(this).data('color'));
			});
		
			$('[data-rel=tooltip]').tooltip();
			$('[data-rel=popover]').popover({html:true});
</script>
<script>
//订单列表
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,1,2,3,4,5,6,7,8,9]}// 制定列不参与排序
		] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			
			
			
			});
</script>