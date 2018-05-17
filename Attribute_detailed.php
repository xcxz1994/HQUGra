<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';
$className=$_REQUEST['className'];
//var_dump($className);
$sql="select *  from sys_material_properties where pro_class='{$className}'";
$rows=fetchAll($sql);
//print_r($rows);
$sql2="select * from bas_material_goodstype where gt_name='{$className}'";
$parentClass=fetchOne($sql2);
$sql3="select gt_name from bas_material_goodstype where gt_id='{$parentClass['gt_parentId']}'";
$parentName=fetchOne($sql3);
//var_dump($parentName);
$sql4="select *  from bas_material_goods where go_type='{$parentClass['gt_id']}'";
$productNum=fetchAll($sql4);
//print_r($productNum);
$sql5="select * from bas_material_goodstype group by gt_id having gt_parentId='{$parentClass['gt_id']}'";
$SonClasses=fetchAll($sql5);
//print_r($productNum);
function getAllClient(){
    $arrClient=array();
    $arrClientList=array();
    $arrClientLast=array();
    $className=$_REQUEST['className'];
    $sql2="select * from bas_material_goodstype where gt_name='{$className}'";
    $parentClass=fetchOne($sql2);
    $sql4="select *  from bas_material_goods where go_type='{$parentClass['gt_id']}'";
    $productNum=fetchAll($sql4);
    for($i=0;$i<count($productNum);$i++){
        $sql6="select cl_id  from bas_material_goods where go_type={$productNum[$i]['go_type']}";
        $AllClients=fetchAll($sql6);
        $arrClient.array_push($arrClient,$AllClients);
    }

    for($i=0;$i<count($arrClient[0]);$i++){
        $sql7="select  DISTINCT id from bas_contact_client where cl_id='{$arrClient[0][$i]['cl_id']}'";
        $AllClientsList=fetchAll($sql7);
        $arrClientList.array_push($arrClientList,$AllClientsList);
    }
    for($i=0;$i<count($arrClientList);$i++){
        $sql8="select  * from bas_contact_client where id='{$arrClientList[$i][0]['id']}'";
        $AllClientsLast=fetchAll($sql8);
        $arrClientLast.array_push($arrClientLast,$AllClientsLast);
    }
    return $arrClientLast;
}
$AllClientsLasts=getAllClient();
//print_r($AllClientsLasts[0]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css"/>       
  <link rel="stylesheet" href="assets/css/ace.min.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
  <link href="Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
  <!--[if IE 7]>
    <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
  <![endif]-->
  <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
  <![endif]-->
  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/typeahead-bs2.min.js"></script>
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
  <script src="assets/layer/layer.js" type="text/javascript" ></script>
  <script src="assets/laydate/laydate.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/H-ui.js"></script> 
  <script type="text/javascript" src="js/H-ui.admin.js"></script> 
  <script src="js/lrtk.js" type="text/javascript"></script>
<title>物料详细</title>
</head>

<body>
<div class="page-content clearfix">
 <div class="brand_detailed">
  <div class="brand_info clearfix">
   <div class="title_brand">物料信息</div>
   <form>
    <ul class="Info_style clearfix">
     <li><label class="label_name">物料名称：</label> <span class="name"><?php echo $className;?></span></li>
      <li><label class="label_name">物料属性：</label><span class="name"><?php foreach($rows as $row):?><?php echo $row['pro_name'];?>;<?php endforeach;?></span></li>
      <li><label class="label_name">所属分类：</label><span class="name"><?php echo $parentName['gt_name'];?></span></li>
      <li><label class="label_name">物料编号：</label><span class="name"><?php echo $parentClass['gt_id'];?></span></li>
      <li><label class="label_name">总供应商：</label><span class="name">共<?php echo count($productNum);?>家</span></li>
      <li><label class="label_name">添加时间：</label><span class="name">2016-6-21 34：23</span></li>
      <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="name">启用</span></li>
      <li class="b_Introduce"><label class="label_name">物料介绍：</label><span class="name">玉兰油OLAY，是宝洁公司全球著名的护肤品牌，是中国区最大护肤品牌，在大陆已持续十年呈两位数增长。OLAY以全球高科技护肤研发技术为后盾，在深入了解中国女性对护肤和美的需要的基础上，不断扩大产品范围，目前已经涵盖了护肤和沐浴系列，真正帮助女性全面周到地呵护自己的肌肤。玉兰油全球销售额近十亿美金，成为世界上最大、最著名的护肤品牌之一。卓越的护肤功效获得世界爱美女性肯定，迅速畅销150多个国家。</span></li>
    </ul>
    <div class="brand_logo">
      <img src="<?php echo $productNum[0]['go_image'];?>"  width="120px" height="60px"/>
      <p class="name">物料图片(仅供参考)</p>
    </div>
   </form>
   </div>
 </div>
 <!--品牌商品-->
 <div class="border clearfix">
       <span class="l_f">
        <a href="picture-add.html"  title="添加物料" class="btn btn-warning Order_form"><i class="icon-plus"></i>添加物料</a>
        <a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
       <span class="r_f">该物料下共：<b><?php echo count($productNum);?></b>个供应商</span>
  </div>
     <!--产品列表-->
      <div class="b_products_list clearfix" id="products_list">
     <div id="scrollsidebar" class="left_Treeview">
        <div class="show_btn" id="rightArrow"><span></span></div>
        <div class="widget-box side_content" >
         <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
         <div class="side_list">
          <div class="widget-header header-color-green2"><h4 class="lighter smaller">物料子类</h4></div>
          <div class="widget-body">
            <ul class="b_P_Sort_list">
             <li><i class="orange icon-folder-close"></i></i><a href="#">全部(<?php echo count($productNum);?>)</a></li>
                <?php  foreach($SonClasses as $SonClass):?>
                    <li><i class="icon-file-text grey"></i> <a href="#"><?php echo $SonClass['gt_name'];?></a></li>
                <?php endforeach;?>



            </ul>
          
          </div>
        </div>
       </div>
       </div>
     <!--列表展示-->
       <div class="table_menu_list" id="testIframe">
       <table class="table table-striped table-bordered table-hover" id="sample-table">
		<thead>
		 <tr>
				<th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
				<th width="80px">供应商编号</th>
				<th width="250px">供应商名称</th>
				<th width="100px">地址</th>
				<th width="100px">电话</th>
                <th width="100px">库存</th>
				<th width="180px">加入时间</th>
                <th width="80px">审核状态</th>
				<th width="70px">状态</th>                
				<th width="200px">操作</th>
			</tr>
		</thead>
	<tbody>
    <?php  foreach($AllClientsLasts as $AllClientsLast):?>
     <tr>
        <td width="25px"><label><input type="checkbox" class="ace" ><span class="lbl"></span></label></td>
        <td width="80px"><?php echo $AllClientsLast[0]['id'];?></td>
        <td width="250px"><u style="cursor:pointer" class="text-primary" onclick=""><?php echo $AllClientsLast[0]['cl_name'];?></u></td>
        <td width="100px"><?php echo $AllClientsLast[0]['cl_address'];?></td>
        <td width="100px"><?php echo $AllClientsLast[0]['cl_phone'];?></td>
        <td width="100px">1000</td>
        <td width="180px"><?php echo $AllClientsLast[0]['cl_registDate'];?></td>
        <td class="text-l">通过</td>
        <td class="td-status"><span class="label label-success radius">已启用</span></td>
        <td class="td-manage">
        <a onClick="member_stop(this,'10001')"  href="javascript:;" title="停用"  class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a> 
        <a title="编辑" onclick="member_edit('编辑','member-add.html','4','','510')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a> 
        <a title="删除" href="javascript:;"  onclick="member_del(this,'1')" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
       </td>
	  </tr>
    <?php endforeach;?>
    </tbody>
    </table>
    </div>     
     </div>
</div>
</body>
</html>
<script type="text/javascript">
//数据
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,8,9]}// 制定列不参与排序
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
 	//图层隐藏限时参数		 
$(function() { 
	$("#products_list").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false,
		stylewidth:'220',
		spacingw:30,//设置隐藏时的距离
	    spacingh:260,//设置显示时间距
	});
});
//初始化宽度、高度  
 $(".widget-box").height($(window).height()-215); 
$(".table_menu_list").width($(window).width()-260);
 $(".table_menu_list").height($(window).height()-215);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height()-215);
	 $(".table_menu_list").width($(window).width()-260);
	  $(".table_menu_list").height($(window).height()-215);
	});
/*品牌-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs " onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="icon-ok bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="icon-ok bigger-120"></i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}

/*品牌-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
//面包屑返回值
var index = parent.layer.getFrameIndex(window.name);
parent.layer.iframeAuto(index);
$('.Order_form').on('click', function(){
	var cname = $(this).attr("title");
	var chref = $(this).attr("href");
	var cnames = parent.$('.Current_page').html();
	var herf = parent.$("#iframe").attr("src");
    parent.$('#parentIfour').html(cname);
    parent.$('#iframe').attr("src",chref).ready();;
	parent.$('#parentIfour').css("display","inline-block");
	//parent.$('.Current_page').attr({"name":herf,"href":"javascript:void(0)"}).css({"color":"#4c8fbd","cursor":"pointer"});
	parent.$('.parentIframe').attr("name",herf).css({"color":"#4c8fbd","cursor":"pointer"});
	//parent.$('.Current_page').html("<a href='javascript:void(0)' name="+herf+" class='iframeurl'>" + cnames + "</a>");
    parent.layer.close(index);
	
});
</script>
