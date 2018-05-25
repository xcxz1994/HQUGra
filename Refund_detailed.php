<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';

$id=$_REQUEST['id'];
//print_r($id);

$sql="select * from scm_all_order where or_id={$id}";
$row=fetchOne($sql);
$sql2="select * from bas_contact_client where cl_id='{$row['cl_idone']}'";
$client=fetchOne($sql2);
//print_r($client);
$sql3="select * from bas_material_goods where go_id={$row['go_id']}";
$pro=fetchOne($sql3);
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
        <script src="js/H-ui.js" type="text/javascript"></script>          	
        <script src="assets/layer/layer.js" type="text/javascript" ></script>          
<title>退款详细</title>
</head>

<body>
<div class="margin clearfix">
 <div class="Refund_detailed">
    <div class="Numbering">询价单编号:<b><?php echo $row['ap_id']?></b></div>
    <div class="detailed_style">
     <!--退款信息-->
     <div class="Receiver_style">
     <div class="title_name">退款信息</div>
     <div class="Info_style clearfix">
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款人姓名： </label>
         <div class="o_content"><?php echo $client['cl_name'];?></div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款人电话： </label>
         <div class="o_content"><?php echo $client['cl_phone'];?></div>
        </div>
         <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款方式：</label>
         <div class="o_content">银联</div>
        </div>
         <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款数量：</label>
         <div class="o_content"><?php echo $row['tota'];?>件</div>
        </div>
         <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 快递名称：</label>
         <div class="o_content"><?php echo $row['express'];?></div>
        </div>
         <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 快递单号：</label>
         <div class="o_content"><?php echo $row['express_Num']?></div>
        </div>
         <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款账户：</label>
         <div class="o_content"><?php echo $client['cl_bank'];?>卡</div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款账号：</label>
         <div class="o_content"><?php echo $client['cl_bankNum'];?></div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款金额：</label>
         <div class="o_content"><?php $sumPrice=$row['tota']*$row['price'];echo $sumPrice; ?>元</div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 退款日期：</label>
         <div class="o_content"><?php echo $row['approvedate']?></div>
        </div>
        <div class="col-xs-3">  
         <label class="label_name" for="form-field-2"> 状态：</label>
         <div class="o_content"><?php
             if($row['state']==4){
                 echo " <td>待退款 </td>";
             }elseif ($row['state']==5){
                 echo " <td>已退款</td>";
             }
             ?></div>
        </div>
     </div>
    </div>
    <div class="Receiver_style">
    <div class="title_name">退款说明</div>
    <div class="reund_content">
      买家收到货,需要退货,如何退货呢--淘宝退款流程交易订单的交易状态是卖家已发货,有可能是因为产品问题或者其他原因需要退...  
    </div>
    </div>
    
    <!--产品信息-->
    <div class="product_style">
    <div class="title_name">产品信息</div>
    <div class="Info_style clearfix">
      <div class="product_info clearfix">
      <a href="#" class="img_link"><img src="<?php echo substr(explode(",",$row['image'])[1],1);?>"></a>
      <span>
      <a href="#" class="name_link"><?php echo $pro['attribute'];?></a>
      <p>编号：<?php echo $pro['go_id'];?></p>
      <p>规格：<?php echo $pro['go_specType'];?></p>
      <p>数量：<?php echo $row['tota'];?>件</p>
      <p>价格：<b class="price"><i>￥</i><?php echo $row['price'];?></b></p>
      </span>
      </div>
    </div>
    </div>
    </div>    
 </div>
</div>
</body>
</html>
