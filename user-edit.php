<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/25
 * Time: 11:24
 */
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("content-type:text/html;charset=urtf-8");
require_once './include.php';
$id=$_REQUEST['id'];
$sql="select * from bas_contact_client where id='{$id}'";
$row=fetchOne($sql);
//print_r($row);
?>
<!DOCTYPE html>
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
<!-- 修改用户图层-->
<div class="add_menber" id="add_menber_style" >
    <form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" enctype="multipart/form-data" method="post">

        <ul class=" page-content">
            <li><label class="label_name">账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</label>
                <span class="add_name">

             <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_id'];?>" id="user-id" name="user-id" datatype="*2-16" nullmsg="账号不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">用户名：</label>
                <span class="add_name">
             <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_name'];?>" id="user-name" name="user-name" datatype="*2-16" nullmsg="用户名不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">原密码：</label><span class="add_name">
                <input type="password" placeholder="<?php echo $row['cl_pswd'];?>" name="user-pwd" id="user-pwd" autocomplete="off" value="" class="input-text" datatype="*6-20" nullmsg="密码不能为空">
            </span>
                <div class="prompt r_f"></div>
            </li>
            <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">新密码：</label><span class="add_name">
             <input type="password" placeholder="确认新密码" autocomplete="off" class="input-text Validform_error" errormsg="您两次输入的新密码不一致！" datatype="*" nullmsg="请再输入一次新密码！" recheck="userpassword" id="newpassword2" name="newpassword2">

         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">移动电话：</label>
                <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_phone'];?>" id="user-tel" name="user-tel" datatype="m" nullmsg="手机不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">会员等级：</label>
                <span class="add_name">
                 <select class="select" name="user-grade" id="user-grade" size="1" style="margin-left: 10px;">
                      <option><?php echo $row['cl_grade'];?></option>
					<option value="普通会员" >普通会员</option>
					<option value="铁牌会员">铁牌会员</option>
					<option value="铜牌会员">铜牌会员</option>
					<option value="银牌会员">银牌会员</option>
                     <option value="金牌会员">金牌会员</option>
                     <option value="钻石会员">钻石会员</option>
                     <option value="红钻会员">红钻会员</option>
                      <option value="蓝钻会员">蓝钻会员</option>
                      <option value="黑钻会员">黑钻会员</option>
				</select>

         </span>
                <div class="prompt r_f"></div>
            </li>
            <li class="adderss"><label class="label_name">公司住址：</label>
                <span class="add_name">

             <input name="user-address" placeholder="<?php echo $row['cl_address'];?>" type="text"  class="cityinput" id="citySelectEdit"  style=" width:180px"/>
         </span>
                <label class="label_name" style="margin-left: 50px;">所属行业：</label>
                <span class="add_name" style="margin-left: 22px;">
                <select class="select" name="user-type" id="user-type" size="1">
                    <option><?php echo $row['cl_type'];?></option>
					<option value="食品加工">食品加工</option>
					<option value="生活保健">生活保健</option>
					<option value="电子数码">电子数码</option>
					<option value="纺织服饰">纺织服饰</option>
				</select>
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">法人代表：</label>
                <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_represent'];?>" id="user-represent" name="user-represent" datatype="m" nullmsg="法人代表不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">营业执照号：</label>
                <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_busLicenseNum'];?>" id="user-busLicenseNum" name="user-busLicenseNum" datatype="m" nullmsg="营业执照号不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">开户银行：</label>
                <span class="add_name">
                <select class="select" name="user-bank" id="user-bank" size="1" style="margin-left: 10px;">
                     <option><?php echo $row['cl_bank'];?></option>
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

            <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_bankNum'];?>" id="user-bankNum" name="user-bankNum" datatype="m" nullmsg="开户银行号不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">开户银行手机号：</label>
                <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_bankPhone'];?>" id="user-bankPhone" name="user-bankPhone" datatype="m" nullmsg="开户银行手机号不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>
            <li><label class="label_name">税号：</label>
                <span class="add_name">

            <input type="text" class="input-text" value="" placeholder="<?php echo $row['cl_taxNum'];?>" id="user-taxNum" name="user-taxNum" datatype="m" nullmsg="税号不能为空">
         </span>
                <div class="prompt r_f"></div>
            </li>



            <li><label class="label_name">上传营业执照：</label>

                <input type="file"  value="" placeholder="" name="uploadPicture" id="file"   datatype="m" nullmsg="营业执照不能为空" style="margin-left: 10px;" title="上传照片" onchange="getPhoto(this)">

                <div class="prompt r_f"></div>
            </li>
            <li>
                <div class="ge_pic_icon_Infor">
                    <img src="<?php echo $row['cl_busLicensePicture'];?>" id="busLicenseImg" style="width: 300px;height: 150px;"/>
                </div>
            </li>
            <li></li>
            <li></li>
            <div class="prompt r_f"></div>
            <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label>
                <span class="add_name" >
     <label><input name="form-field-radio1" type="radio"  class="ace" value="1" id="start"><span class="lbl">开启</span></label>&nbsp;&nbsp;&nbsp;
     <label><input name="form-field-radio1"type="radio" class="ace" value="2" id="examine"><span class="lbl" >审核</span></label>
                <label><input name="form-field-radio1"type="radio" class="ace" value="3" id="stop"><span class="lbl" >封号</span></label>
            </span>

            </li>
            <li></li>

            <li style="">
                <label class="label_name">备注：</label>
                <div class="formControls">
                    <textarea name="user-baizhu" cols="" rows="" class="textarea" placeholder="<?php echo $row['cl_beizhu'];?>" dragonfly="true" onkeyup="checkLength(this);" style="float: left;" id="user-beizhu" name="user-beizhu"></textarea>
                    <span class="wordage">剩余字数：<span id="sy" style="color:Red;">100</span>字</span>
                </div>
            </li>
            <li></li>
            <li></li>
            <li></li>
            <li>
                <input class="btn btn-primary radius" type="submit" id="Add_User" value="&nbsp;&nbsp;修改&nbsp;&nbsp;">
            </li>
        </ul>
    </form>
</div>

</body>

</html>
<script type="text/javascript">
    var test=new Vcity.CitySelector({input:'citySelectEdit'});
    /*获取上传的图片路径*/
    var imgurl = "";
    function getPhoto(node) {
        var imgURL = "";
        try{
            var file = null;
            if(node.files && node.files[0] ){
                file = node.files[0];
            }else if(node.files && node.files.item(0)) {
                file = node.files.item(0);
            }
            //Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径
            try{
                imgURL =  file.getAsDataURL();
                console.log(imgURL);
            }catch(e){
                imgRUL = window.URL.createObjectURL(file);
            }
        }catch(e){
            if (node.files && node.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgURL = e.target.result;
                };
                reader.readAsDataURL(node.files[0]);
            }
        }

        creatImg(imgRUL);
        imgURL=creatImg(imgRUL);
        //alert(imgURL);
        return imgURL;
    }

    function creatImg(imgRUL){

        var textHtml = "<img src='"+imgRUL+"'width='300px' height='120px'/>";

        $(".ge_pic_icon_Infor").html(textHtml);
        return imgRUL;
    }



    /*j检查字数限制*/
    function checkLength(which) {
        var maxChars = 100; //
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
    /*设置radio被选中的状态*/
    if(<?php echo $row['cl_loginState'];?>==1){
        document.getElementById("start").checked=true;
    }else if(<?php echo $row['cl_loginState'];?>==2){
        document.getElementById("examine").checked=true;
    }else{
        document.getElementById("stop").checked=true;
    }
</script>
