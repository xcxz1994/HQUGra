<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$id=$_REQUEST['id'];
//print_r($id);
$sql="select * from bas_material_goods where go_id='{$id}'";
$row=fetchOne($sql);
//print_r(substr(explode(",",$row['go_image'])[1],1));
if(isset($_SESSION['adminId'])){
    $sql="select * from sys_admin where id={$_SESSION['adminId']}";
    $Adminrow=fetchAll($sql);
    //print_r($Adminrow[0]);
}elseif(isset($_COOKIE['adminId'])){
    $sql="select * from sys_admin where id={$_COOKIE['adminId']}";
    $Adminrow=fetchAll($sql);
    // print_r($Adminrow);
}
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
    <script src="assets/layer/layer.js" type="text/javascript" ></script>
    <script src="assets/laydate/laydate.js" type="text/javascript"></script>
    <title>商品审核</title>
</head>

<body>
<div class="margin clearfix">
    <div class="detailed_style clearfix">
        <em class="type"></em>
        <img src="<?php echo substr(explode(",",$row['go_image'])[1],1);?>" width="200px" height="200px"/>
        <img src="<?php echo substr(explode(",",$row['go_image'])[0],1);?>" width="200px" height="200px"/>

        <ul  style="padding-left: 0">
            <li ><label class="label_name">商品名称：</label><span class="info"><?php echo $row['go_name'];?></span>


            <li><label class="label_name">所属分类：</label><span class="info"><?php echo $row['go_type'];?></span></li>
            <li><label class="label_name">加入时间：</label><span class="info"><?php echo $row['go_jointime'];?></span></li>
            <li><label class="label_name">申请公司：</label><span class="info"><?php echo $row['cl_id'];?></span></li>
            <li><label class="label_name">商品价格：</label><span class="info"><?php echo $row['go_price'];?></span></li>
            <li><label >商品别名：</label><?php echo $row['go_alias'];?></li>
            <li><label >规格型号：</label><?php echo $row['go_specType'];?></li>
            <li><label >商品属性：</label><?php echo $row['attribute'];?></li>

        </ul>
    </div>
    <div class="Store_Introduction" style="margin-top: 30px;">
        <div class="title_name">商品介绍</div>
        <div class="info">
            <li><label >规格型号：</label><?php echo $row['go_specType'];?></li>
            <li><label >商品属性：</label><?php echo $row['attribute'];?></li>
        </div>
    </div>
    <div class="Store_Introduction">
        <div class="title_name">其他认证</div>
        <div class="info">

        </div>
    </div>
    <div class="At_button">
        <button onclick="through_save('this','<?php echo $row['go_id'];?>');" class="btn btn-primary radius" type="submit">通  过</button>
        <button onclick="cancel_save('this','<?php echo $row['cl_id'];?>');" class="btn btn-danger  btn-warning" type="button">拒  绝</button>
        <button onclick="return_close();" class="btn btn-default radius" type="button">返回上一步</button>
    </div>
</div>
</body>
</html>
<script>
    //通过
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.iframeAuto(index);
    function through_save(obj,id){
        //alert(id);
        layer.confirm('确认要审核通过该商品吗？',function(index){
            $.ajax({
                url: './doAdminAction.php?act=AuditPro&id='+id,
                type: 'post',
                data: {
                    'go_State':1
                },
                success:function(data){
                    console.log(data)
                    layer.alert('通过审核！',{
                        title: '提示框',
                        icon:1,
                    });
                }
            })
            layer.msg('已开通!',{icon:1,time:1000});
            location.href="Products_List.php";
            parent.$('#parentIframe').css("display","none");
            parent.$('.Current_page').css({"color":"#333333"});
        });


    }

    //返回操作
    function return_close(){
        location.href="Shops_Audit.php";
        parent.$('#parentIframe').css("display","none");
        parent.$('.Current_page').css({"color":"#333333"});

    }
    //拒绝
    function cancel_save(obj,id){
        var index = layer.open({
            type: 1,
            title: '内容',
            maxmin: true,
            shadeClose:false,
            area : ['600px' , ''],
            content:('<div class="shop_reason"><span class="content">请说明拒绝该申请人申请商品的理由，以便下次在申请时做好准备。</span><textarea name="请填写拒绝理由" class="form-control" id="form_textarea" placeholder="请填写拒绝理由" onkeyup="checkLength(this);"></textarea><span class="wordage">剩余字数：<span id="sy" style="color:Red;">500</span>字</span></div>'),
            btn:['确定','取消'],
            yes: function(index, layero){
                if($('.form-control').val()==""){
                    layer.alert('回复内容不能为空！',{
                        title: '提示框',
                        icon:0,
                    })
                }else{
                    var RefusalReason=$('.form-control').val();
                    var messagefrom=<?php echo $Adminrow[0]['id'];?>;
                    var messageto=id;
                    alert(messagefrom);
                    $.ajax({
                        url: './doAdminAction.php?act=RefusalUser&id='+id,
                        type: 'post',
                        data: {
                            'messagecontent':RefusalReason,
                            'messagefrom':messagefrom,
                            'messageto':messageto
                        },
                        success:function(data){
                            console.log(data)
                            layer.alert('审核不通过！',{
                                title: '提示框',
                                icon:1,
                            });


                        }

                    })
                    layer.msg('提交成功!',{icon:1,time:1000});
                    layer.close(index);
                }
            }
        })

    }
    /*字数限制*/
    function checkLength(which) {
        var maxChars = 500; //
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
            var curr = maxChars - which.value.length; //减去当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    };
</script>
