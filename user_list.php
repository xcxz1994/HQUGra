<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';

$rows=getAllUser();
$number=count($rows);
//print_r($rows);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>       
        <link href="assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/cityselect.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="assets/js/jquery.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>
		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="js/H-ui.js"></script> 
        <script type="text/javascript" src="js/H-ui.admin.js"></script> 
        <script src="assets/layer/layer.js" type="text/javascript" ></script>
        <script src="assets/laydate/laydate.js" type="text/javascript"></script>
    <script src="assets/js/cityselect.js" type="text/javascript"></script>
<title>用户列表</title>
</head>

<body>
<div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
    <div class="search_style">
     
      <ul class="search_content clearfix">
       <li><label class="l_f">商家名称</label><input name="" type="text"  class="text_add" placeholder="输入商家名称、电话、邮箱"  style=" width:400px"/></li>
       <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
    </div>
     <!---->
     <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()" id="member_add" class="btn btn-warning"><i class="icon-plus"></i>添加用户</a>
        <a href="javascript:ovid()" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
       </span>
       <span class="r_f">共：<b><?php echo $number;?></b>条</span>
     </div>
     <!---->
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
          <td><u style="cursor:pointer" class="text-primary" onclick="member_show(<?php echo $row['cl_id'];?>)"><?php echo $row['cl_name'];?></u></td>
            <td><?php echo $row['cl_represent'];?></td>

          <td><?php echo $row['cl_phone'];?></td>
          <td class="text-l"><?php echo $row['cl_adress'];?></td>
          <td><?php echo $row['cl_registDate'];?></td>
          <td><?php echo $row['cl_grade'];?></td>
          <td class="td-status"><span class="label label-success radius">已启用</span></td>
          <td class="td-manage">
          <a onClick="member_stop(this,'10001')"  href="javascript:;" title="停用"  class="btn btn-xs btn-success"><i class="icon-ok bigger-120"></i></a> 
          <a title="编辑" onclick="member_edit('550')" href="javascript:;"  class="btn btn-xs btn-info" ><i class="icon-edit bigger-120"></i></a>
          <a title="删除" href="javascript:;"  onclick="member_del(this,'1')" class="btn btn-xs btn-warning" ><i class="icon-trash  bigger-120"></i></a>
          </td>
		</tr>
    <?php endforeach;?>
      </tbody>
	</table>
   </div>
  </div>
 </div>
</div>
<!--添加用户图层-->
<div class="add_menber" id="add_menber_style" style="display:none">
  
    <ul class=" page-content">
     <li><label class="label_name">账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</label>
         <span class="add_name">

             <input type="text" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="账号不能为空">
         </span>
         <div class="prompt r_f"></div>
     </li>
     <li><label class="label_name">用户名：</label>
         <span class="add_name">
             <input type="text" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="用户名不能为空">
         </span>
         <div class="prompt r_f"></div>
     </li>
        <li><label class="label_name">初始密码：</label><span class="add_name">
                <input type="password" placeholder="密码" name="userpassword" autocomplete="off" value="" class="input-text" datatype="*6-20" nullmsg="密码不能为空">
            </span>
            <div class="prompt r_f"></div>
        </li>
     <div class="prompt r_f"></div>
     </li>
     <li><label class="label_name">确认密码：</label><span class="add_name">
             <input type="password" placeholder="确认新密码" autocomplete="off" class="input-text Validform_error" errormsg="您两次输入的新密码不一致！" datatype="*" nullmsg="请再输入一次新密码！" recheck="userpassword" id="newpassword2" name="newpassword2">

         </span>
         <div class="prompt r_f"></div>
     </li>
     <li><label class="label_name">移动电话：</label>
         <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="手机不能为空">
         </span>
         <div class="prompt r_f"></div>
     </li>

     <li class="adderss"><label class="label_name">公司住址：</label>
         <span class="add_name">

             <input name="公司住址" type="text"  class="cityinput" id="citySelect" placeholder="请输入目的地" style=" width:350px"/>
         </span>
         <div class="prompt r_f"></div>
     </li>
        <li><label class="label_name">法人代表：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="法人代表不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">营业执照号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="营业执照号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">开户银行：</label>
            <span class="add_name">
                <select class="select" name="admin-role" size="1" style="margin-left: 10px;">
					<option value="工商银行">工商银行</option>
					<option value="开发银行">开发银行</option>
					<option value="建设银行">建设银行</option>
					<option value="交通银行">交通银行</option>
				</select>
         </span>
            <div class="prompt r_f"></div>
        </li>

        <li><label class="label_name">开户银行号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="开户银行号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">开户银行手机号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="开户银行手机号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">税号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="税号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>



        <li><label class="label_name">上传营业执照：</label>

                  <input type="file"  value="" placeholder="" id="id-input-file-2" name="user-tel" datatype="m" nullmsg="营业执照不能为空" style="margin-left: 10px;">

            <div class="prompt r_f"></div>
        </li>


        <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="add_name">
     <label><input name="form-field-radio1" type="radio" checked="checked" class="ace"><span class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="form-field-radio1"type="radio" class="ace"><span class="lbl">关闭</span></label></span><div class="prompt r_f"></div></li>

        <li>
            <label class="label_name">备注：</label>
            <div class="formControls">
                <textarea name="" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="checkLength(this);" style="float: left;"></textarea>
                <span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
            </div>
        </li>
    </ul>
 </div>

<!-- 修改用户图层-->
<div class="add_menber" id="edit_menber_style" style="display:none">

    <ul class=" page-content">
        <li><label class="label_name">账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</label>
            <span class="add_name">

             <input type="text" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="账号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">用户名：</label>
            <span class="add_name">
             <input type="text" class="input-text" value="" placeholder="" id="user-name" name="user-name" datatype="*2-16" nullmsg="用户名不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">初始密码：</label><span class="add_name">
                <input type="password" placeholder="密码" name="userpassword" autocomplete="off" value="" class="input-text" datatype="*6-20" nullmsg="密码不能为空">
            </span>
            <div class="prompt r_f"></div>
        </li>
        <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">确认密码：</label><span class="add_name">
             <input type="password" placeholder="确认新密码" autocomplete="off" class="input-text Validform_error" errormsg="您两次输入的新密码不一致！" datatype="*" nullmsg="请再输入一次新密码！" recheck="userpassword" id="newpassword2" name="newpassword2">

         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">移动电话：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="手机不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>

        <li class="adderss"><label class="label_name">公司住址：</label>
            <span class="add_name">

             <input name="公司住址" type="text"  class="cityinput" id="citySelect" placeholder="请输入目的地" style=" width:350px"/>
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">法人代表：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="法人代表不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">营业执照号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="营业执照号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">开户银行：</label>
            <span class="add_name">
                <select class="select" name="admin-role" size="1" style="margin-left: 10px;">
					<option value="工商银行">工商银行</option>
					<option value="开发银行">开发银行</option>
					<option value="建设银行">建设银行</option>
					<option value="交通银行">交通银行</option>
				</select>
         </span>
            <div class="prompt r_f"></div>
        </li>

        <li><label class="label_name">开户银行号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="开户银行号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">开户银行手机号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="开户银行手机号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>
        <li><label class="label_name">税号：</label>
            <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="" id="user-tel" name="user-tel" datatype="m" nullmsg="税号不能为空">
         </span>
            <div class="prompt r_f"></div>
        </li>



        <li><label class="label_name">上传营业执照：</label>

            <input type="file"  value="" placeholder="" id="id-input-file-2" name="user-tel" datatype="m" nullmsg="营业执照不能为空" style="margin-left: 10px;">

            <div class="prompt r_f"></div>
        </li>


        <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label><span class="add_name">
     <label><input name="form-field-radio1" type="radio" checked="checked" class="ace"><span class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="form-field-radio1"type="radio" class="ace"><span class="lbl">关闭</span></label></span><div class="prompt r_f"></div></li>

        <li>
            <label class="label_name">备注：</label>
            <div class="formControls">
                <textarea name="" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true" onkeyup="checkLength(this);" style="float: left;"></textarea>
                <span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
            </div>
        </li>
    </ul>
</div>
</body>
</html>
<script>
jQuery(function($) {
				var oTable1 = $('#sample-table').dataTable( {
				"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
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
			})
/*用户-添加*/
 $('#member_add').on('click', function(){
     var test=new Vcity.CitySelector({input:'citySelect'});
    layer.open({
        type: 1,
        title: '添加用户',
		maxmin: true, 
		shadeClose: true, //点击遮罩关闭层
        area : ['850px' , ''],
        content:$('#add_menber_style'),
		btn:['提交','取消'],
		yes:function(index,layero){	
		 var num=0;
		 var str="";

     $(".add_menber input[type$='text']").each(function(n){
          if($(this).val()=="")
          {
               
			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',				
				icon:0,								
          }); 
		    num++;
            return false;            
          } 
		 });
		  if(num>0){  return false;}	 	
          else{
			  layer.alert('添加成功！',{
               title: '提示框',				
			icon:1,		
			  });
			   layer.close(index);	
		  }		  		     				
		}
    });
});
/*用户-查看*/
function member_show(id){
    //alert(id)
    layer.open({
        type: 2,
        title:'编辑用户',
        area: ['500px','800px'],
        shadeClose: false,
        content: './member-show.php?id='+id,
        setwin:'./index.php'
    });
}
/*用户-停用*/
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
/*用户-编辑*/
function member_edit(id){
	  layer.open({
        type: 1,
        title: '修改用户信息',
		maxmin: true, 
		shadeClose:false, //点击遮罩关闭层
        area : ['850px' , ''],
        content:$('#edit_menber_style'),
		btn:['提交','取消'],
		yes:function(index,layero){	
		 var num=0;
		 var str="";
     $(".add_menber input[type$='text']").each(function(n){
          if($(this).val()=="")
          {
               
			   layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',				
				icon:0,								
          }); 
		    num++;
            return false;            
          } 
		 });
		  if(num>0){  return false;}	 	
          else{
			  layer.alert('添加成功！',{
               title: '提示框',				
			icon:1,		
			  });
			   layer.close(index);	
		  }		  		     				
		}
    });
}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
laydate({
    elem: '#start',
    event: 'focus' 
});

</script>


<script>
    $('#id-input-file-2').ace_file_input({
        no_file:'选择上传图标 ...',
        btn_choose:'选择',
        btn_change:'更改',
        droppable:false,
        onchange:null,
        thumbnail:false, //| true | large
        whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
    });
</script>