<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$rows=getAllAdmin();

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
		<script src="assets/js/typeahead-bs2.min.js"></script>           	
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="js/dragDivResize.js" type="text/javascript"></script>
<title>添加权限</title>
</head>

<body>
<div class="Competence_add_style clearfix">
  <div class="left_Competence_add">
   <div class="title_name">添加权限</div>
    <div class="Competence_add">
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限名称 </label>
       <div class="col-sm-5 " >

           <select class="select" name="powername" size="1"  style="margin-left: 10px;">
               <option value="超级管理员">超级管理员</option>
               <option value="普通管理员">普通管理员</option>
               <option value="栏目主辑">栏目主辑</option>
               <option value="栏目编辑">栏目编辑</option>
           </select>

       </div>
	</div>
     <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 权限描述 </label>
      <div class="col-sm-9"><textarea name="权限描述" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span></div>
	</div>
    <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 用户选择 </label>
       <div class="col-sm-9">
           <?php  foreach($rows as $row):?>
       <label class="middle"><input class="ace" type="checkbox" id="id-disable-check"><span class="lbl"> <?php echo $row['username'];?></span></label>

           <?php endforeach;?>
	</div>   
   </div>
   <!--按钮操作-->
   <div class="Button_operation">
				<button onclick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="fa fa-save "></i> 保存并提交</button>
				<button onclick="article_save();" class="btn btn-secondary  btn-warning" type="button"><i class="fa fa-reply"></i> 返回上一步</button>
				<button onclick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
   </div>
   </div>
   <!--权限分配-->
   <div class="Assign_style">
      <div class="title_name">权限分配</div>
      <div class="Select_Competence">
      <dl class="permission-list">
		<dt><label class="middle"><input name="product-managent-0" class="ace" type="checkbox" id="product-disable-check" value="产品管理"><span class="lbl">产品管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="产品列表" class="ace"  name="product-managent-0-0" id="products_list"><span class="lbl">产品列表</span></label></dt>
         <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="product-managent-0-0-0" id="products_list-0-0-0"  ><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="product-managent-0-0-0" id="products_list-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="product-managent-0-0-0" id="products_list-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="product-managent-0-0-0" id="products_list-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="product-managent-0-0-0" id="products_list-0-0-4"><span class="lbl">审核</span></label>
		</dd>
		</dl>
	     <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="品牌管理" class="ace"  name="product-managent-0-0" id="brand_managent"> <span class="lbl">品牌管理</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="product-managent-0-0-0" id="brand_managent-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="product-managent-0-0-0" id="brand_managent-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="product-managent-0-0-0" id="brand_managent-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="product-managent-0-0-0" id="brand_managent-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="product-managent-0-0-0" id="brand_managent-0-0-4"><span class="lbl">审核</span></label>
		 </dd>
		</dl>
        <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="分类管理" class="ace"  name="product-managent-0-0" id="sort_managent"> <span class="lbl">分类管理</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="product-managent-0-0-0" id="sort_managent-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="product-managent-0-0-0" id="sort_managent-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="product-managent-0-0-0" id="sort_managent-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="product-managent-0-0-0" id="sort_managent-0-0-3"><span class="lbl">查看</span></label>
		 </dd>
		</dl>
		</dd>
	    </dl> 
        <!--图片管理-->
         <dl class="permission-list">
		<dt><label class="middle"><input name="image-managent-0" class="ace" type="checkbox" id="image-disable-check" value="图片管理"><span class="lbl">图片管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="广告管理" class="ace"  name="image-managent-0-0" id="adver_managent"><span class="lbl">广告管理</span></label></dt>
         <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="image-managent-0-0-0" id="adver_managent-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="image-managent-0-0-0" id="adver_managent-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="image-managent-0-0-0" id="adver_managent-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="image-managent-0-0-0" id="adver_managent-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="image-managent-0-0-0" id="adver_managent-0-0-4"><span class="lbl">审核</span></label>

		</dd>
		</dl>
	     <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="广告分类" class="ace"  name="image-managent-0-0" id="adver_sort"> <span class="lbl">广告分类</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="image-managent-0-0-0" id="adver_sort-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="image-managent-0-0-0" id="adver_sort-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="image-managent-0-0-0" id="adver_sort-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="image-managent-0-0-0" id="adver_sort-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="image-managent-0-0-0" id="adver_sort-0-0-4"><span class="lbl">审核</span></label>
		 </dd>
		</dl>
        </dd>
	    </dl> 
        <!--交易管理--> 
        <dl class="permission-list">
		<dt><label class="middle"><input name="trade-managent-0" class="ace" type="checkbox" id="trade-disable-check" value="交易管理"><span class="lbl">交易管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="交易信息" class="ace"  name="trade-managent-0-0" id="trade_info"><span class="lbl">交易信息</span></label></dt>
         <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="trade-managent-0-0-0" id="trade_info-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="trade-managent-0-0-0" id="trade_info-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="trade-managent-0-0-0" id="trade_info-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="trade-managent-0-0-0" id="trade_info-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="trade-managent-0-0-0" id="trade_info-0-0-4"><span class="lbl">审核</span></label>
		</dd>
		</dl>
	     <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="订单管理" class="ace"  name="trade-managent-0-0" id="order_managent"> <span class="lbl">订单管理</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="trade-managent-0-0-0" id="order_managent-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="trade-managent-0-0-0" id="order_managent-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="trade-managent-0-0-0" id="order_managent-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="trade-managent-0-0-0" id="order_managent-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="trade-managent-0-0-0" id="order_managent-0-0-4"><span class="lbl">审核</span></label>
		 </dd>
		</dl> 
             <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="退款操作" class="ace"  name="trade-managent-0-0" id="refund_operation"> <span class="lbl">退款操作</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="trade-managent-0-0-0" id="refund_operation-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="trade-managent-0-0-0" id="refund_operation-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="trade-managent-0-0-0" id="refund_operation-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="trade-managent-0-0-0" id="refund_operation-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="trade-managent-0-0-0" id="refund_operation-0-0-4"><span class="lbl">审核</span></label>
		 </dd>
		</dl>  
        </dd>
		</dl> 
        
          <!--会员管理--> 
        <dl class="permission-list">
		<dt><label class="middle"><input name="member-managent-0" class="ace" type="checkbox" id="member-disable-check" value="会员管理"><span class="lbl">会员管理</span></label></dt>
		<dd>
		 <dl class="cl permission-list2">
		 <dt><label class="middle"><input type="checkbox" value="会员信息" class="ace"  name="member-managent-0-0" id="member_info"><span class="lbl">会员信息</span></label></dt>
         <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="member-managent-0-0-0" id="member_info-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="member-managent-0-0-0" id="member_info-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="member-managent-0-0-0" id="member_info-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="member-managent-0-0-0" id="member_info-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="member-managent-0-0-0" id="member_info-0-0-4"><span class="lbl">审核</span></label>
		</dd>
		</dl>
	     <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="登记管理" class="ace"  name="member-managent-0-0" id="register_managent"> <span class="lbl">登记管理</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="member-managent-0-0-0" id="register_managent-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="member-managent-0-0-0" id="register_managent-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="member-managent-0-0-0" id="register_managent-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="member-managent-0-0-0" id="register_managent-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="member-managent-0-0-0" id="register_managent-0-0-4"><span class="lbl">审核</span></label>
		 </dd>
		</dl> 
             <dl class="cl permission-list2">
		  <dt><label class="middle"><input type="checkbox" value="会员积分" class="ace"  name="member-managent-0-0" id="member_integral"> <span class="lbl">会员积分</span></label></dt>
		  <dd>
		   <label class="middle"><input type="checkbox" value="0" class="ace" name="member-managent-0-0-0" id="member_integral-0-0-0"><span class="lbl">添加</span></label>
		   <label class="middle"><input type="checkbox" value="1" class="ace" name="member-managent-0-0-0" id="member_integral-0-0-1"><span class="lbl">修改</span></label>
		   <label class="middle"><input type="checkbox" value="2" class="ace" name="member-managent-0-0-0" id="member_integral-0-0-2"><span class="lbl">删除</span></label>
		   <label class="middle"><input type="checkbox" value="3" class="ace" name="member-managent-0-0-0" id="member_integral-0-0-3"><span class="lbl">查看</span></label>
		   <label class="middle"><input type="checkbox" value="4" class="ace" name="member-managent-0-0-0" id="member_integral-0-0-4"><span class="lbl">审核</span></label>
		 </dd>
		</dl>  
        </dd>
		</dl> 
      </div> 
  </div>
</div>
</body>
</html>
<script type="text/javascript">
//初始化宽度、高度  
 $(".left_Competence_add,.Competence_add_style").height($(window).height()).val();; 
 $(".Assign_style").width($(window).width()-500).height($(window).height()).val();
 $(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	
	$(".Assign_style").width($(window).width()-500).height($(window).height()).val();
	$(".Select_Competence").width($(window).width()-500).height($(window).height()-40).val();
	$(".left_Competence_add,.Competence_add_style").height($(window).height()).val();;
	});
/*字数限制*/
function checkLength(which) {
	var maxChars = 200; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您出入的字数超多限制!',	
    });
		// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
		which.value = which.value.substring(0,maxChars);
		return false;
	}else{
		var curr = maxChars - which.value.length; //250 减去 当前输入的
		document.getElementById("sy").innerHTML = curr.toString();
		return true;
	}
};
/*按钮选择*/
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
		
	});
});

</script>
