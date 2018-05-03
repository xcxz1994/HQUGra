<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';
$sql="select * from bas_material_goodstype";
$rows=fetchAll($sql);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
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
        <script src="assets/layer/layer.js" type="text/javascript" ></script>
        <script src="assets/laydate/laydate.js" type="text/javascript"></script>
    <title>添加物料分类</title>
</head>
<body>
<div class="type_style">
 <div class="type_title">物料类型信息</div>
  <div class="type_content">
  <div class="Operate_btn">
  <a href="javascript:ovid()" class="btn  btn-warning" id="addSonCate" onclick="addSonCate()"><i class="icon-edit align-top bigger-125"></i>新增子类型</a>
  <a href="javascript:ovid()" class="btn  btn-success" id="stopCate"><i class="icon-ok align-top bigger-125"></i>禁用该类型</a>
  <a href="javascript:ovid()" class="btn  btn-danger" id="delCate"><i class="icon-trash   align-top bigger-125"></i>删除该类型</a>
  </div>

  <form action="doAdminAction.php?act=addCate" method="post" class="form form-horizontal" id="form-user-add">
    <div class="Operate_cont clearfix">
      <label class="form-label"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls ">
        <input type="text" class="input-text" value="" placeholder="" id="cate-name" name="cate-name">
      </div>
    </div>
        <div class="Operate_cont clearfix">
      <label class="form-label"><span class="c-red">*</span>编号：</label>
      <div class="formControls ">
        <input type="text" class="input-text" value="" placeholder="请填入1-100的数字" id="cate-id" name="cate-id">
      </div>
    </div>
    <div class="Operate_cont clearfix">
    <label class="form-label">备注：</label>
    <div class="formControls">
    <textarea name="cate-beizhu" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
     <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
    </div>
    </div>
    <div class="">
     <div class="" style=" text-align:center">
      <input class="btn btn-primary radius" type="submit" value="提交">
      </div>
    </div>
  </form>

  </div>
    <!--新增子分类样式-->
    <div class="change_Pass_style" id="Add_SonCate" style="display:none">
        <ul class="xg_style">
            <li><label class="label_name">父类编号</label>
                <select class="select" name="parentId" size="1" style="margin-left: 10px;" id="parentId">
                    <?php  foreach($rows as $row):?>
                    <option><?php echo $row['gt_id'];?><?php echo $row['gt_name'];?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li><label class="label_name">新增子类编号</label><input name="SonId" type="text" class="" id="SonId"></li>
            <li><label class="label_name">新增子类名称</label><input name="SonName" type="text" class="" id="SonName"></li>
            <li><label class="label_name">子类信息备注</label><input name="Sonbeizhu" type="text" class="" id="Sonbeizhu"></li>

        </ul>
        <!--       <div class="center"> <button class="btn btn-primary" type="button" id="submit">确认修改</button></div>-->
    </div>
</div> 
</div>
<script type="text/javascript" src="Widget/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="Widget/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="assets/layer/layer.js"></script>
<script type="text/javascript" src="js/H-ui.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-user-add").Validform({
		tiptype:2,
		callback:function(form){
			form[0].submit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});

//增加子类型
function addSonCate(){
    layer.open({
        type: 1,
        title:'新增子分类',
        area: ['400px','400px'],
        shadeClose: true,
        content: $('#Add_SonCate'),
        btn:['确认增加'],
        yes:function(index, layero){
            if ($("#parentId").val()==""){
                layer.alert('父类不能为空!',{
                    title: '提示框',
                    icon:0,

                });
                return false;
            }
            if ($("#SonId").val()==""){
                layer.alert('新增子类编号不能为空!',{
                    title: '提示框',
                    icon:0,

                });
                return false;
            }

            if ($("#SonName").val()==""){
                layer.alert('子类名称不能为空!',{
                    title: '提示框',
                    icon:0,

                });
                return false;
            }
            else{
                 var parentId=$("#parentId").val();
                 var SonId=$("#SonId").val();
                 var SonName=$("#SonName").val();
                 var Sonbeizhu=$("#Sonbeizhu").val();
                alert(SonId);
                $.ajax({
                    url: './doAdminAction.php?act=addSonCate',
                    type: 'post',
                    data: {
                        'parentId':parentId,
                        'SonId':SonId,
                        'SonName':SonName,
                        'Sonbeizhu':Sonbeizhu
                    },
                    success:function(data){
                        console.log(data)
                        layer.alert('新增子类成功！',{
                            title: '提示框',
                            icon:1,
                        });
                    }
                })
            }
            window.location.reload();
        }
    });
}
</script>
</body>
</html>