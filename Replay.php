<?php
/**
 * Created by PhpStorm.
 * User: chuny
 * Date: 2018/5/25
 * Time: 19:24
 */
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';
$id=$_REQUEST['id'];
$sql="select * from sys_message where id='{$id}'";
$row=fetchOne($sql);
//print_r($row);
$sql2="select * from bas_contact_client where cl_id='{$row['message_from']}'";
$client=fetchOne($sql2);
//print_r($client);
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
    <title>回复留言</title>
</head>

<body>
<!--留言详细-->
<div id="Guestbook">
    <form action="doAdminAction.php?act=Replay&id=<?php echo $row['id'];?>&client=<?php echo $client['cl_id']?>" method="post" id="form-admin-add">
    <div class="content_style">
        <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">留言用户 </label>
            <div class="col-sm-9"><?php

                echo $client['cl_name'];
                ?></div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1"> 留言内容 </label>
            <div class="col-sm-9"><?php echo $row['message_content'];?></div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label no-padding-right" for="form-field-1">是否回复 </label>
            <div class="col-sm-9">
                <label><input name="checkbox" type="checkbox" class="ace" id="checkbox"><span class="lbl"> 回复</span></label>
                <div class="Reply_style">
                    <textarea name="ReplayContent" class="form-control" id="form_textarea" placeholder="" onkeyup="checkLength(this);"></textarea>
                    <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span>字</span>
                </div>
            </div>
        </div>
        <input class="btn btn-primary radius" type="submit" id="ReplayOK" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        <input class="btn btn-primary radius" type="button" id="Canel" value="&nbsp;&nbsp;取消&nbsp;&nbsp;">
    </div>
    </form>
</div>

</body>

</html>
<script>
    /*checkbox激发事件*/
    $('#checkbox').on('click',function(){
        if($('input[name="checkbox"]').prop("checked")){
            $('.Reply_style').css('display','block');
        }
        else{

            $('.Reply_style').css('display','none');
        }
    })
    /*字数限制*/
    function checkLength(which) {
        var maxChars = 200; //
        if(which.value.length > maxChars){
            layer.open({
                icon:2,
                title:'提示框',
                content:'您输入的字数超过限制!',
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
</script>