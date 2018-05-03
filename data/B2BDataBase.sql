-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.6.17 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 b2b 的数据库结构
CREATE DATABASE IF NOT EXISTS `b2b` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `b2b`;

-- 导出  表 b2b.bas_contact_client 结构
CREATE TABLE IF NOT EXISTS `bas_contact_client` (
  `cl_id` char(11) NOT NULL COMMENT '用户账号',
  `cl_pswd` varchar(16) DEFAULT NULL COMMENT '登录密码',
  `cl_registDate` date DEFAULT NULL COMMENT '注册日期',
  `cl_loginState` int(11) DEFAULT '2' COMMENT '用户登录状态1正常2审核3封号',
  `cl_name` varchar(50) DEFAULT NULL COMMENT '用户名称',
  `cl_represent` varchar(50) DEFAULT NULL COMMENT '法人代表',
  `cl_busLicenseNum` varchar(50) DEFAULT NULL COMMENT '用户营业执照号码',
  `cl_busLicensePicture` varchar(50) DEFAULT NULL COMMENT '营业执照图片',
  `cl_bank` varchar(50) DEFAULT NULL COMMENT '开户银行',
  `cl_bankNum` varchar(50) DEFAULT NULL COMMENT '开户银行号',
  `cl_bankPhone` varchar(50) DEFAULT NULL COMMENT '开户银行手机号',
  `cl_taxNum` varchar(50) DEFAULT NULL COMMENT '税号',
  `cl_adress` varchar(50) DEFAULT NULL COMMENT '用户地址',
  `cl_phone` varchar(50) DEFAULT NULL COMMENT '用户电话',
  PRIMARY KEY (`cl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 正在导出表  b2b.bas_contact_client 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bas_contact_client` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_contact_client` ENABLE KEYS */;

-- 导出  表 b2b.bas_material_goods 结构
CREATE TABLE IF NOT EXISTS `bas_material_goods` (
  `go_id` int(11) NOT NULL COMMENT '商品编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '所属用户',
  `go_name` varchar(11) DEFAULT NULL COMMENT '商品名称',
  `go_type` int(11) DEFAULT NULL COMMENT '商品类型',
  `go_code` int(11) DEFAULT NULL COMMENT '商品编码',
  `go_unit` varchar(50) DEFAULT NULL COMMENT '基本单位',
  `go_alias` varchar(50) DEFAULT NULL COMMENT '别名',
  `go_specType` varchar(50) DEFAULT NULL COMMENT '规格型号',
  `go_color` int(11) DEFAULT NULL COMMENT '1白2红',
  `attribute2` varchar(50) DEFAULT NULL COMMENT '物料属性2',
  `attribute3` varchar(50) DEFAULT NULL COMMENT '物料属性3',
  PRIMARY KEY (`go_id`),
  KEY `FK_bas_material_goods_bas_contact_client` (`cl_id`),
  KEY `FK_bas_material_goods_bas_material_goodstype` (`go_type`),
  CONSTRAINT `FK_bas_material_goods_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_bas_material_goods_bas_material_goodstype` FOREIGN KEY (`go_type`) REFERENCES `bas_material_goodstype` (`gt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

-- 正在导出表  b2b.bas_material_goods 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bas_material_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_material_goods` ENABLE KEYS */;

-- 导出  表 b2b.bas_material_goodstype 结构
CREATE TABLE IF NOT EXISTS `bas_material_goodstype` (
  `gt_id` int(11) NOT NULL COMMENT '类型ID',
  `gt_parentId` int(11) DEFAULT NULL COMMENT '上级类型ID',
  `gt_name` varchar(50) DEFAULT NULL COMMENT '类型名称',
  PRIMARY KEY (`gt_id`),
  KEY `FK_bas_material_goodstype_bas_material_goodstype` (`gt_parentId`),
  CONSTRAINT `FK_bas_material_goodstype_bas_material_goodstype` FOREIGN KEY (`gt_parentId`) REFERENCES `bas_material_goodstype` (`gt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品类型表';

-- 正在导出表  b2b.bas_material_goodstype 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `bas_material_goodstype` DISABLE KEYS */;
/*!40000 ALTER TABLE `bas_material_goodstype` ENABLE KEYS */;

-- 导出  表 b2b.scm_sell_contract 结构
CREATE TABLE IF NOT EXISTS `scm_sell_contract` (
  `sco_id` int(11) NOT NULL COMMENT '采购合同编号',
  `sor_id` int(11) DEFAULT NULL COMMENT '销售订单编号',
  `sco_content` varchar(1000) DEFAULT NULL COMMENT '合同内容',
  `sco_remark` varchar(50) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`sco_id`),
  KEY `FK_scm_sell_contract_scm_sell_order` (`sor_id`),
  CONSTRAINT `FK_scm_sell_contract_scm_sell_order` FOREIGN KEY (`sor_id`) REFERENCES `scm_sell_order` (`Sor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='销售合同表';

-- 正在导出表  b2b.scm_sell_contract 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_sell_contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_sell_contract` ENABLE KEYS */;

-- 导出  表 b2b.scm_sell_enroll 结构
CREATE TABLE IF NOT EXISTS `scm_sell_enroll` (
  `En_id` int(11) NOT NULL COMMENT '报名编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '用户编号id',
  `ac_id` int(11) DEFAULT NULL COMMENT '招募信息编号',
  `en_date` date DEFAULT NULL COMMENT '报名日期',
  `en_state` int(11) DEFAULT NULL COMMENT '1招募方已确认2招募方未确认3失效4草稿箱',
  `en_remark` varchar(50) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`En_id`),
  KEY `FK_scm_sell_enroll_bas_contact_client` (`cl_id`),
  KEY `FK_scm_sell_enroll_scm_stock_askclient` (`ac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='招募报名表';

-- 正在导出表  b2b.scm_sell_enroll 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_sell_enroll` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_sell_enroll` ENABLE KEYS */;

-- 导出  表 b2b.scm_sell_order 结构
CREATE TABLE IF NOT EXISTS `scm_sell_order` (
  `Sor_id` int(11) NOT NULL COMMENT '销售订单编号',
  `cl_id` char(50) DEFAULT NULL COMMENT '销售商编号id',
  `or_id` int(11) DEFAULT NULL COMMENT '采购订单编号',
  `Sor_state` int(11) DEFAULT NULL COMMENT '1等待买家付款2等待发货3已发货4退货/退款中5成功订单6关闭订单',
  `en_remark` varchar(50) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`Sor_id`),
  KEY `FK_scm_sell_order_scm_stock_order` (`or_id`),
  KEY `FK_scm_sell_order_bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_sell_order_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_sell_order_scm_stock_order` FOREIGN KEY (`or_id`) REFERENCES `scm_stock_order` (`or_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='销售订单表';

-- 正在导出表  b2b.scm_sell_order 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_sell_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_sell_order` ENABLE KEYS */;

-- 导出  表 b2b.scm_sell_quote 结构
CREATE TABLE IF NOT EXISTS `scm_sell_quote` (
  `qu_id` int(11) NOT NULL COMMENT '报价编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '用户编号',
  `ap_id` int(11) DEFAULT NULL COMMENT '询价单号',
  `Qu_date` date DEFAULT NULL COMMENT '报价日期',
  `qu_price` int(11) DEFAULT NULL COMMENT '报价',
  `Qu_state` int(11) DEFAULT NULL COMMENT '1询价方已确认2询价方未确认3失效4草稿箱',
  `qu_remark` varchar(50) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`qu_id`),
  KEY `FK_scm_sell_quote_bas_contact_client` (`cl_id`),
  KEY `FK_scm_sell_quote_scm_stock_askprice` (`ap_id`),
  CONSTRAINT `FK_scm_sell_quote_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_sell_quote_scm_stock_askprice` FOREIGN KEY (`ap_id`) REFERENCES `scm_stock_askprice` (`ap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='报价单表';

-- 正在导出表  b2b.scm_sell_quote 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_sell_quote` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_sell_quote` ENABLE KEYS */;

-- 导出  表 b2b.scm_stock_askclient 结构
CREATE TABLE IF NOT EXISTS `scm_stock_askclient` (
  `ac_id` int(11) NOT NULL COMMENT '招募编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '采购商编号',
  `ac_title` varchar(50) DEFAULT NULL COMMENT '招募标题',
  `ac_startDate` date DEFAULT NULL COMMENT '发布日期',
  `ac_endDate` date DEFAULT NULL COMMENT '截止日期',
  `ac_state` int(11) DEFAULT NULL COMMENT '1报名中2无报名3已合作4已失效',
  PRIMARY KEY (`ac_id`),
  KEY `FK_scm_stock_askclient_bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_stock_askclient_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='招募信息表';

-- 正在导出表  b2b.scm_stock_askclient 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_stock_askclient` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_stock_askclient` ENABLE KEYS */;

-- 导出  表 b2b.scm_stock_askprice 结构
CREATE TABLE IF NOT EXISTS `scm_stock_askprice` (
  `ap_id` int(11) NOT NULL COMMENT '询价编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '采购商编号',
  `ap_title` varchar(50) DEFAULT NULL COMMENT '询价标题',
  `go_id` int(11) DEFAULT NULL COMMENT '商品编号',
  `ap_amount` int(11) DEFAULT NULL COMMENT '采购数量',
  `ap_adress` varchar(50) DEFAULT NULL COMMENT '交货地',
  `ap_startDate` date DEFAULT NULL COMMENT '发布日期',
  `ap_endDate` date DEFAULT NULL COMMENT '截止日期',
  `ap_state` int(1) DEFAULT NULL COMMENT '1报价中2无报价3已合作4已失效',
  PRIMARY KEY (`ap_id`),
  KEY `FK_scm_stock_askprice_bas_contact_client` (`cl_id`),
  KEY `FK_scm_stock_askprice_bas_material_goods` (`go_id`),
  CONSTRAINT `FK_scm_stock_askprice_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_stock_askprice_bas_material_goods` FOREIGN KEY (`go_id`) REFERENCES `bas_material_goods` (`go_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='采购询价表';

-- 正在导出表  b2b.scm_stock_askprice 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_stock_askprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_stock_askprice` ENABLE KEYS */;

-- 导出  表 b2b.scm_stock_choosepurchase 结构
CREATE TABLE IF NOT EXISTS `scm_stock_choosepurchase` (
  `Cp_id` int(11) NOT NULL COMMENT '选购编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '用户编号',
  `Cp_Date` date DEFAULT NULL COMMENT '订单日期',
  `Cp_price` int(11) DEFAULT NULL COMMENT '单价',
  `Cp_num` int(11) DEFAULT NULL COMMENT '数量',
  `Cp_totalMoney` int(11) DEFAULT NULL COMMENT '总金额',
  `sc_attribute1` varchar(50) DEFAULT NULL COMMENT '属性1',
  `sc_attribute2` varchar(50) DEFAULT NULL COMMENT '属性2',
  PRIMARY KEY (`Cp_id`),
  KEY `FK_scm_stock_choosepurchase_bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_stock_choosepurchase_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品选购表';

-- 正在导出表  b2b.scm_stock_choosepurchase 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_stock_choosepurchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_stock_choosepurchase` ENABLE KEYS */;

-- 导出  表 b2b.scm_stock_contract 结构
CREATE TABLE IF NOT EXISTS `scm_stock_contract` (
  `co_id` int(11) NOT NULL COMMENT '采购合同编号',
  `or_id` int(11) DEFAULT NULL COMMENT '采购订单编号',
  `co_content` varchar(1000) DEFAULT NULL COMMENT '合同内容',
  `co_remark` varchar(50) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`co_id`),
  KEY `FK_scm_stock_contract_scm_stock_order` (`or_id`),
  CONSTRAINT `FK_scm_stock_contract_scm_stock_order` FOREIGN KEY (`or_id`) REFERENCES `scm_stock_order` (`or_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='采购合同表';

-- 正在导出表  b2b.scm_stock_contract 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_stock_contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_stock_contract` ENABLE KEYS */;

-- 导出  表 b2b.scm_stock_order 结构
CREATE TABLE IF NOT EXISTS `scm_stock_order` (
  `or_id` int(11) NOT NULL COMMENT '订单编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '采购商编号',
  `Cp_id` int(11) DEFAULT NULL COMMENT '选购详情',
  `ac_Date` date DEFAULT NULL COMMENT '订单日期',
  `ac_price` int(11) DEFAULT NULL COMMENT '单价',
  `ac_num` int(11) DEFAULT NULL COMMENT '数量',
  `ac_totalMoney` int(11) DEFAULT NULL COMMENT '实付款',
  `ac_state` varchar(50) DEFAULT NULL COMMENT '1待生成订单2待付款3待发货4待评价5已完成',
  PRIMARY KEY (`or_id`),
  KEY `FK_scm_stock_order_bas_contact_client` (`cl_id`),
  KEY `FK_scm_stock_order_scm_stock_choosepurchase` (`Cp_id`),
  CONSTRAINT `FK_scm_stock_order_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_stock_order_scm_stock_choosepurchase` FOREIGN KEY (`Cp_id`) REFERENCES `scm_stock_choosepurchase` (`Cp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='采购订单表';

-- 正在导出表  b2b.scm_stock_order 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_stock_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_stock_order` ENABLE KEYS */;

-- 导出  表 b2b.scm_stock_shoppingcart 结构
CREATE TABLE IF NOT EXISTS `scm_stock_shoppingcart` (
  `sc_id` int(11) NOT NULL COMMENT '购物车编号',
  `cl_id` char(11) DEFAULT NULL COMMENT '用户编号',
  `sc_Date` date DEFAULT NULL COMMENT '加入购物车日期',
  `sc_price` int(11) DEFAULT NULL COMMENT '单价',
  `sc_num` int(11) DEFAULT NULL COMMENT '数量',
  `sc_totalMoney` int(11) DEFAULT NULL COMMENT '总金额',
  `sc_attribute1` varchar(50) DEFAULT NULL COMMENT '属性1',
  `sc_attribute2` varchar(50) DEFAULT NULL COMMENT '属性2',
  PRIMARY KEY (`sc_id`),
  KEY `FK_scm_stock_shoppingcart_bas_contact_client` (`cl_id`),
  CONSTRAINT `FK_scm_stock_shoppingcart_bas_contact_client` FOREIGN KEY (`cl_id`) REFERENCES `bas_contact_client` (`cl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- 正在导出表  b2b.scm_stock_shoppingcart 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_stock_shoppingcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_stock_shoppingcart` ENABLE KEYS */;

-- 导出  表 b2b.scm_store_examinreport 结构
CREATE TABLE IF NOT EXISTS `scm_store_examinreport` (
  `er_id` int(11) NOT NULL COMMENT '验货报告编号',
  `or_id` int(11) DEFAULT NULL COMMENT '采购订单编号',
  `er_isRight` int(1) DEFAULT NULL COMMENT '是否符合合同要求',
  `er_remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`er_id`),
  KEY `FK_scm_store_examinreport_scm_stock_order` (`or_id`),
  CONSTRAINT `FK_scm_store_examinreport_scm_stock_order` FOREIGN KEY (`or_id`) REFERENCES `scm_stock_order` (`or_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='验货报告表';

-- 正在导出表  b2b.scm_store_examinreport 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_store_examinreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_store_examinreport` ENABLE KEYS */;

-- 导出  表 b2b.scm_store_return 结构
CREATE TABLE IF NOT EXISTS `scm_store_return` (
  `re_id` int(11) NOT NULL COMMENT '退换编号',
  `or_id` int(11) DEFAULT NULL COMMENT '采购订单编号',
  `re_state` int(1) DEFAULT NULL COMMENT '1退款2退货',
  `re_reasson` varchar(50) DEFAULT NULL COMMENT '退换原因',
  `re_remark` varchar(200) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`re_id`),
  KEY `FK_scm_store_return_scm_stock_order` (`or_id`),
  CONSTRAINT `FK_scm_store_return_scm_stock_order` FOREIGN KEY (`or_id`) REFERENCES `scm_stock_order` (`or_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='退款/退货表';

-- 正在导出表  b2b.scm_store_return 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `scm_store_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `scm_store_return` ENABLE KEYS */;

-- 导出  表 b2b.sys_admin 结构
CREATE TABLE IF NOT EXISTS `sys_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userphone` varchar(50) DEFAULT NULL,
  `adminrole` varchar(50) DEFAULT NULL,
  `jointime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- 正在导出表  b2b.sys_admin 的数据：~10 rows (大约)
/*!40000 ALTER TABLE `sys_admin` DISABLE KEYS */;
INSERT INTO `sys_admin` (`id`, `username`, `sex`, `age`, `qq`, `password`, `email`, `userphone`, `adminrole`, `jointime`) VALUES
	(1, 'king', NULL, NULL, NULL, 'b2086154f101464aab3328ba7e060deb', '382771946@qq.com', NULL, NULL, NULL),
	(2, 'admin', NULL, NULL, NULL, 'b2086154f101464aab3328ba7e060deb', '382771946@qq.com', NULL, NULL, NULL),
	(3, 'hqugra123', NULL, NULL, NULL, 'cab98d9ca998b351854f959064ca4935', 'hqugra123@qq.com', NULL, NULL, NULL),
	(4, 'hqugra1', NULL, NULL, NULL, '00e19d92ed3f2be707e94051b92986d1', 'hqugra1@qq.com', NULL, NULL, NULL),
	(6, 'test333', NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'test333@qq.com', '15859732634', '栏目编辑', '2018-04-25 16:32:55'),
	(7, 'chunyu6666', 'on', '26', '333333333', 'd41d8cd98f00b204e9800998ecf8427e', '222222', '222222', '超级管理员', '2018-04-26 14:25:21'),
	(8, 'user000', '女', '12', '9818777654', '65f458db36f584be4901e62b9502667a', '981877654@qq.com', '158597326930', '管理员', '2018-04-26 14:40:27'),
	(9, 'tcychunyu', NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '981877654@164.com', '15859732632', '栏目主辑', '2018-04-25 16:08:08'),
	(12, 'test', '男', '18', '9873123185', 'e10adc3949ba59abbe56e057f20f883e', '9818785741564', '15859732630', '超级管理员', '2018-04-26 12:27:41'),
	(13, '', NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '981877654@166.com', '15859732638', '管理员', '2018-04-26 13:42:11');
/*!40000 ALTER TABLE `sys_admin` ENABLE KEYS */;

-- 导出  表 b2b.sys_admin_loginrecord 结构
CREATE TABLE IF NOT EXISTS `sys_admin_loginrecord` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `adminrole` varchar(50) DEFAULT NULL,
  `logintime` varchar(50) DEFAULT NULL,
  `loginStatus` varchar(50) DEFAULT NULL,
  `loginSite` varchar(50) DEFAULT NULL,
  `loginIP` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='后台管理员登录记录信息';

-- 正在导出表  b2b.sys_admin_loginrecord 的数据：~21 rows (大约)
/*!40000 ALTER TABLE `sys_admin_loginrecord` DISABLE KEYS */;
INSERT INTO `sys_admin_loginrecord` (`id`, `username`, `adminrole`, `logintime`, `loginStatus`, `loginSite`, `loginIP`) VALUES
	(12, 'ursalink', '超级管理员', '2014-6-11 11:11:42', '登录成功', '中国-福建-厦门', '192.168.1.100'),
	(18, 'chunyu222', '超级管理员', '2018-04-26 12:27:06', '', '厦门', '::1'),
	(19, 'test', '超级管理员', '2018-04-26 12:29:46', '登录成功', '厦门', '::1'),
	(22, 'test', '超级管理员', '2018-04-26 12:34:15', '登录成功', '厦门', '::1'),
	(23, 'test', '', '2018-04-26 12:44:57', '', '厦门', '::1'),
	(24, 'test', '', '2018-04-26 12:51:26', '登录失败', '厦门', '::1'),
	(25, 'test', '超级管理员', '2018-04-26 12:51:31', '登录成功', '厦门', '::1'),
	(26, 'test', '超级管理员', '2018-04-26 12:54:27', '登录成功', '厦门', '::1'),
	(27, 'ursalink', '管理员', '2018-04-26 13:07:02', '登录成功', '厦门', '::1'),
	(28, 'chunyu222', '超级管理员', '2018-04-26 13:36:24', '登录成功', '厦门', '::1'),
	(29, 'chunyu222', '超级管理员', '2018-04-26 13:36:30', '登录成功', '厦门', '::1'),
	(30, 'chunyu6666', '', '2018-04-26 14:26:34', '登录失败', '厦门', '::1'),
	(31, 'chunyu6666', '', '2018-04-26 14:26:52', '登录失败', '厦门', '::1'),
	(32, 'chunyu6666', '', '2018-04-26 14:27:06', '登录失败', '厦门', '::1'),
	(33, 'ursalink', '管理员', '2018-04-26 14:27:32', '登录成功', '厦门', '::1'),
	(34, 'ursalinktest', '', '2018-04-26 14:34:51', '登录失败', '厦门', '::1'),
	(35, 'ursalinktest', '管理员', '2018-04-26 14:36:32', '登录成功', '厦门', '::1'),
	(36, 'user000', '', '2018-04-26 15:21:38', '登录失败', '厦门', '::1'),
	(37, 'user000', '管理员', '2018-04-26 15:24:35', '登录成功', '厦门', '::1'),
	(38, 'user000', '管理员', '2018-04-26 15:29:27', '登录成功', '厦门', '::1'),
	(39, 'test', '超级管理员', '2018-04-26 15:35:04', '登录成功', '厦门', '::1');
/*!40000 ALTER TABLE `sys_admin_loginrecord` ENABLE KEYS */;

-- 导出  表 b2b.sys_admin_power 结构
CREATE TABLE IF NOT EXISTS `sys_admin_power` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `adminrole` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='后台管理员权限分配';

-- 正在导出表  b2b.sys_admin_power 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `sys_admin_power` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_admin_power` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
