<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
require_once './include.php';

$rows=getAllCate();

function getGCate(){
    $rows=getAllCate();
    $Garr=array();
    for($i=0;$i<count($rows);$i++){
        $sql="select * from bas_material_goodstype group by gt_id having gt_parentId={$rows[$i]['gt_id']}";
        $Grows=fetchAll($sql);
        $Garr.array_push($Garr,$Grows);
    }
    return $Garr;
}
$results=getGCate();
//print_r($results[1]);
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
        <link rel="stylesheet" href="Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        
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
        <script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typeahead-bs2.min.js"></script>
        <script type="text/javascript" src="Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script> 
        <script src="js/lrtk.js" type="text/javascript" ></script>
<title>分类管理</title>
</head>

<body>
<div class=" clearfix">
 <div id="category">
    <div id="scrollsidebar" class="left_Treeview">
    <div class="show_btn" id="rightArrow"><span></span></div>
    <div class="widget-box side_content" >
    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
     <div class="side_list">
      <div class="widget-header header-color-green2">
          <h4 class="lighter smaller">产品类型列表</h4>
      </div>
      <div class="widget-body">
          <div class="widget-main padding-8">
              <div  id="treeDemo" class="ztree"></div>
          </div>
  </div>
  </div>
  </div>  
  </div>
<!---->
 <iframe ID="testIframe" Name="testIframe" FRAMEBORDER=0 SCROLLING=AUTO  SRC="product-category-add.php" class="page_right_style"></iframe>
 </div>
</div>
</body>
</html>
<script type="text/javascript"> 
$(function() { 
	$("#category").fix({
		float : 'left',
		//minStatue : true,
		skin : 'green',	
		durationTime :false
	});
});
</script>
<script type="text/javascript">
//初始化宽度、高度  
 $(".widget-box").height($(window).height()); 
 $(".page_right_style").width($(window).width()-220);
  //当文档窗口发生改变时 触发  
    $(window).resize(function(){
	$(".widget-box").height($(window).height());
	 $(".page_right_style").width($(window).width()-220);
	})
 
/**************/
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[

    <?php  foreach($rows as $row):?>
	{ id:<?php echo $row['gt_id']?>, pId:<?php echo $rows[0]['gt_id'];?>, name:"<?php echo $row['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[1] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[1]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[2] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[2]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[3] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[3]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[4] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[4]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[5] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[5]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[6] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[6]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
    <?php  foreach($results[7] as $result):?>
    { id:<?php echo $result['gt_id'];?>, pId:<?php echo $rows[7]['gt_id']?>, name:"<?php echo $result['gt_name']?>"},
    <?php endforeach;?>
];

		
var code;
		
function showCode(str) {
	if (!code) code = $("#code");
	code.empty();
	code.append("<li>"+str+"</li>");
}
		
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
	demoIframe.bind("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	zTree.selectNode(zTree.getNodeByParam("id",'11'));
});	
</script>