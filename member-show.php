<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';
$id=$_REQUEST['id'];
$sql="select * from bas_contact_client where cl_id='{$id}'";
$row=fetchOne($sql);
//print_r($row);
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
        <link href="assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
			<script src="assets/js/jquery.min.js"></script>
            <title>用户查看</title>
    <style>
        .label_name{

        }

    </style>
</head>
<body>
<div class="member_show" >
<div class="member_jbxx clearfix" >
  <img class="img" src="images/user.png">
  <dl  class="right_xxln">
  <dt><span class=""><?php echo $row['cl_name'];?></span> <span class="">余额：<?php echo $row['cl_balance']?></span></dt>
  <dd class="" style="margin-left:0">这家伙很懒，什么也没有留下</dd>
  </dl>
</div>
<div class="member_content">
  <ul>

   <li><label class="label_name">联系方式：</label><span class="name"><?php echo $row['cl_phone'];?></span></li>
   <li><label class="label_name">地址：</label><span class="name"><?php echo $row['cl_adress'];?></span></li>
   <li><label class="label_name">法人代表：</label><span class="name"><?php echo $row['cl_represent'];?></span></li>
   <li><label class="label_name">营业执照号：</label><span class="name"><?php echo $row['cl_busLicenseNum'];?></span></li>
   <li><label class="label_name">营业执照：</label><span class="name"><?php echo $row['cl_busLicensePicture'];?></span></li>
   <li><label class="label_name">开户银行：</label><span class="name"><?php echo $row['cl_bank'];?></span></li>
   <li><label class="label_name">开户银行号：</label><span class="name"><?php echo $row['cl_bankNum'];?></span></li>
   <li><label class="label_name">开户银行手机号：</label><span class="name"><?php echo $row['cl_bankPhone'];?></span></li>
   <li><label class="label_name">税号：</label><span class="name"><?php echo $row['cl_taxNum'];?></span></li>
   <li><label class="label_name">注册时间：</label><span class="name"><?php echo $row['cl_registDate'];?></span></li>
   <li><label class="label_name">积分：</label><span class="name"><?php echo $row['cl_integral'];?></span></li>
   <li><label class="label_name">等级：</label><span class="name"><?php echo $row['cl_grade'];?></span></li>
   
  </ul>
</div>
</div>
</body>
</html>