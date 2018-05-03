<?php
/**
 * 添加分类的操作
 * @return string
 */
function addCate(){
	$arr['gt_name']=$_POST['cate-name'];
    $arr['gt_id']=$_POST['cate-id'];
    $arr['gt_beizhu']=$_POST['cate-beizhu'];

	if(insert("bas_material_goodstype",$arr)){
		$mes="分类添加成功!<br/><a href='product-category-add.php'>继续添加</a>|<a href='product-category-add.php'>查看分类</a>";
	}else{
		$mes="分类添加！<br/><a href='product-category-add.php'>重新添加</a>|<a href='product-category-add.php'>查看分类</a>";
	}
	return $mes;
}

/**
 * 根据ID得到指定分类信息
 * @param int $id
 * @return array
 */
function getCateById($id){
	$sql="select id,cName from bas_material_goodstype where id={$id}";
	return fetchOne($sql);
}

/**
 * 修改分类的操作
 * @param string $where
 * @return string
 */
function editCate($where){
	$arr=$_POST;
	if(update("bas_material_goodstype", $arr,$where)){
		$mes="分类修改成功!<br/><a href='listCate.php'>查看分类</a>";
	}else{
		$mes="分类修改失败!<br/><a href='listCate.php'>重新修改</a>";
	}
	return $mes;
}

/**
 *删除分类
 * @param string $where
 * @return string
 */
function delCate($id){
	$res=checkProExist($id);
	if(!$res){
		$where="id=".$id;
		if(delete("bas_material_goodstype",$where)){
			$mes="分类删除成功!<br/><a href='listCate.php'>查看分类</a>|<a href='addCate.php'>添加分类</a>";
		}else{
			$mes="删除失败！<br/><a href='listCate.php'>请重新操作</a>";
		}
		return $mes;
	}else{
		alertMes("不能删除分类，请先删除该分类下的商品", "listPro.php");
	}
}

/**
 * 得到所有分类
 * @return array
 */
function getAllCate(){
	$sql="select * from bas_material_goodstype where gt_parentId=0";
	$rows=fetchAll($sql);
	return $rows;
}


/**
新增子分类
 **/
function addSonCate(){
    $arrSon['gt_parentId']=$_POST['parentId'];
    $arrSon['gt_name']=$_POST['SonName'];
    $arrSon['gt_id']=$_POST['SonId'];
    $arrSon['gt_beizhu']=$_POST['Sonbeizhu'];

    if(insert("bas_material_goodstype",$arrSon)){
        $mes="子类添加成功!";
    }else{
        $mes="子类添加！";
    }
    return $mes;
}

