<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';

$sql="select * from bas_material_goodstype where gt_id!='0'";
$rows=fetchAll($sql);
//print_r($results[0]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加品牌</title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
 <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css"/>       
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link href="Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
	    <script src="js/jquery-1.9.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/typeahead-bs2.min.js"></script>
         <script src="assets/layer/layer.js" type="text/javascript"></script>

</head>

<body>
<div class=" clearfix">
    <form action="doAdminAction.php?act=add_Attribute" method="post" enctype="multipart/form-data">
 <div id="add_brand" class="clearfix">
 <div class="left_add">
   <div class="title_name">添加属性</div>
   <ul class="add_conent">
    <li class=" clearfix"><label class="label_name" >属性名称：</label> <input name="name" type="text" class="add_text"/></li>
    <li class=" clearfix"><label class="label_name">属性编码：</label> <input name="id" type="text" class="add_text" style="width:80px"/></li>
    <li class=" clearfix"><label class="label_name">属性单位：</label>
        <input name="unit" type="text" class="add_text" style="width:80px"/>
    </li>
       <li><label class="label_name">分类属性：</label>
           <select class="select" name="class" size="1" style="margin-left: 10px;" id="parentId">
               <?php  foreach($rows as $row):?>
                   <option value="<?php echo $row['gt_name'];?>"><?php echo $row['gt_id'];?><?php echo $row['gt_name'];?></option>
               <?php endforeach;?>
           </select>
       </li>
         <li class=" clearfix"><label class="label_name">属性描述：</label> <textarea name="beizhu" cols="" rows="" class="textarea" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">500</span>字</span></li>
         <li class=" clearfix"><label class="label_name">显示状态：</label>
         <label><input name="checkbox" type="radio" class="ace" checked="checked" value="1"><span class="lbl">显示</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <label><input type="radio" class="ace" name="checkbox" value="0"><span class="lbl">不显示</span></label>
         </li>
   </ul>
 </div>
 </div>
  <div class="button_brand"><input name="" type="submit"  class="btn btn-warning" value="保存"/><input name="" type="reset" value="取消" class="btn btn-warning"/></div>
    </form>
</div>
</body>
</html>

<script type="text/javascript">

</script>
