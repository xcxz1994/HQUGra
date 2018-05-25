<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

require_once './include.php';

if(isset($_SESSION['adminId'])){
    $sql="select * from sys_message where message_to={$_SESSION['adminId']} and message_status=2 and message_type=2";
    $rows=fetchAll($sql);
    //print_r($rows);
}elseif(isset($_COOKIE['adminId'])){
    $sql="select * from sys_message where message_to={$_COOKIE['adminId']}and message_status=2 and message_type=2";
    $rows=fetchAll($sql);
    //print_r($rows);
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
		<script src="js/displayPart.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>           	
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <script src="assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="assets/laydate/laydate.js" type="text/javascript"></script>
		  
<title>意见反馈</title>
</head>

<body>
<div class="margin clearfix">
 <div class="Feedback_style">
   <div class="search_style">
     
      <ul class="search_content clearfix">
       <li><label class="l_f">留言</label><input name="" type="text" class="text_add" placeholder="输入留言信息" style=" width:250px"></li>
       <li><label class="l_f">时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
       <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
      </ul>
    </div>
  <div class="border clearfix">
       <span class="l_f">
        <a href="javascript:ovid()" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;批量删除</a>
        <a href="javascript:ovid()" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>&nbsp;已浏览</a>
        <a href="javascript:ovid()" class="btn btn-yellow"><i class="fa fa-times"></i>&nbsp;未浏览</a>
        <a href="javascript:ovid()" class="btn btn-success"><i class="fa fa-feed"></i>&nbsp;建议</a>
        <a href="javascript:ovid()" class="btn btn-success"><i class="fa fa-feed"></i>&nbsp;投诉</a>
       </span>
       <span class="r_f">共：<b>2334</b>条</span>
     </div>
    <div class="feedback">
      <table class="table table-striped table-bordered table-hover" id="sample-table">
      <thead>
		 <tr>
          <th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
          <th width="80">ID</th>
          <th width="100px">姓名</th>
          <th width="100px">电话</th>
          <th width="160px">地址</th>
          <th width="">留言内容</th>
          <th width="180px">时间</th>
          <th width="60px">状态</th>
          <th width="70px">类型</th>                
          <th width="180px">操作</th>
          </tr>
      </thead>
	<tbody>
    <?php  foreach($rows as $row):?>
        <tr>
            <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
            <td><?php echo $row['id'];?></td>
            <td><u style="cursor:pointer"  class="text-primary" onclick="member_show('张小泉','member-show.html','1031','500','400')"><?php
                    $sql="select cl_name from bas_contact_client where cl_id='{$row['message_from']}'";
                    $client=fetchOne($sql);
                    echo $client['cl_name'];
                    ?></u></td>
            <td><?php  $sql2="select cl_phone from bas_contact_client where cl_id='{$row['message_from']}'";
                $client=fetchOne($sql2);
                echo $client['cl_phone'];?></td>
            <td><?php  $sql3="select cl_address from bas_contact_client where cl_id='{$row['message_from']}'";
                $client=fetchOne($sql3);
                echo $client['cl_address'];?></td>
            <td class="text-l">
                <a href="javascript:;" onclick="Guestbook_iew(<?php echo $row['id'];?>)"><?php echo $row['message_content'];?></a>
            </td>

            <td><?php echo $row['message_jointime'];?></td>
            <?php
            if($row['message_status']==1){
                echo " <td class=\"td-status\"><span class=\"label label-success radius\">已回复</span></td>";
            }elseif ($row['message_status']==2){
                echo " <td class=\"td-status\"><span class=\"label label-success radius\">未回复</span></td>";
            }
            ?>
            <td>投诉</td>>
            <td class="td-manage">
                <a onClick="member_stop(this,'10001')"  href="javascript:;" title="已浏览"  class="btn btn-xs btn-success"><i class="fa fa-check  bigger-120"></i></a>
                <a  onclick="Guestbook_iew(<?php echo $row['id'];?>)" title="回复"  href="javascript:;"  class="btn btn-xs btn-info" ><i class="fa fa-edit bigger-120"></i></a>
                <a  href="javascript:;"  onclick="member_del(this,'1')" title="删除" class="btn btn-xs btn-warning" ><i class="fa fa-trash  bigger-120"></i></a>
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
    /*留言查看*/
function Guestbook_iew(id){
        //alert(id);
        var index = layer.open({
            type: 2,
            title: '留言信息',
            maxmin: true,
            shadeClose:false,
            area : ['600px' , '500px'],
            content:'./Replay.php?id='+id,
        })
    };
/*留言-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
jQuery(function($) {
		var oTable1 = $('#sample-table').dataTable( {
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,3,4,5,6,7,8,9]}// 制定列不参与排序
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
</script>