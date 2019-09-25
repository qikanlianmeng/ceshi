<?php
global $_W,$_GPC;

$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
	$city = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_city') . " WHERE uniacid='" . $_W['uniacid'] . "'");
} else if ($op == 'post') {
	if(checksubmit('add')) {
		$city['prov'] = $_GPC['prov'];
		$city['city'] = $_GPC['city'];
		$city['alphabetical_index'] = $_GPC['alphabetical_index'];
		$count = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid']);
		if($count == 0) {
			$city['is_default'] = '1';
		} else {
			$city['is_default'] = '0';
		}
		$city['uniacid'] = $_W['uniacid'];
		pdo_insert('navlange_pinche_city',$city);
		message('添加成功！',$this->createWeburl('city'),'success');
	}	
} else if ($op == 'edit') {
	$id = intval($_GPC['id']);
	if(checksubmit('edit')) {
		$data['prov'] = $_GPC['prov'];
		$data['city'] = $_GPC['city'];
		$data['alphabetical_index'] = $_GPC['alphabetical_index'];
		pdo_update('navlange_pinche_city',$data,array('id'=>$_GPC['id']));
		message('修改成功！','refresh','success');
	}
	$city = pdo_get('navlange_pinche_city',array('id'=>$_GPC['id']));
} else if ($op == 'delete_city') {
	pdo_delete('navlange_pinche_city',array('id'=>$_GPC['id'],));
	message(error(0,''),'','ajax');
} else if ($op == 'set_default') {
	pdo_update('navlange_pinche_city',array('is_default'=>'0'),array('is_default'=>'1','uniacid'=>$_W['uniacid']));
	pdo_update('navlange_pinche_city',array('is_default'=>'1'),array('id'=>$_GPC['id'],'uniacid'=>$_W['uniacid']));
	message(error(0,''),'','ajax');
}
include $this->template('city');

function set_area_order_index($id,$order_index,$district) {
	$area = pdo_get('navlange_pinche_area',array('id'=>$id));
	if($area['order_index'] == $order_index) {
		return;
	}
	update_next_area($order_index,$district);
	pdo_update('navlange_pinche_area',array("order_index"=>$order_index),array('id'=>$id));
}
function update_next_area($order_index,$district) {
	global $_W;
	$exist = pdo_getall('navlange_pinche_area',array('order_index'=>$order_index,'district'=>$district,'uniacid'=>$_W['uniacid']));
	if($exist) {
		update_next_area($order_index+1,$district);
	}
	pdo_update('navlange_pinche_area',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'district'=>$district,'uniacid'=>$_W['uniacid']));
}
?>