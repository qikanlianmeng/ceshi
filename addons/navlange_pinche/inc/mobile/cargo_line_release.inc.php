<?php
global $_W,$_GPC;
$store = pdo_fetch("SELECT id,img,sn,type FROM " . tablename('navlange_pinche_store') . " WHERE uid=" . $_W['member']['uid']);
if(empty($store)) {
	header("Location: " . $this->createMobileurl('store_register'));
}
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = '发布拼货专线';
	$conf = pdo_fetch("SELECT passenger_mobile_by_force,cargo_goods_line_mode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='cargo'");
	$arrival_note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='cargo_arrival'");
} else if ($op == 'edit') {
	$line = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_line') . " WHERE id=" . $_GPC['id']);
} else if ($op == 'release_submit') {
	$data['name'] = $_GPC['name'];
	$data['departure_prov'] = $_GPC['departure_prov'];
	$data['departure_city'] = $_GPC['departure_city'];
	$data['departure_district'] = $_GPC['departure_district'];
	$data['departure_station'] = $_GPC['departure_station'];
	$data['departure_address'] = $_GPC['departure_station'];
	$data['departure_lng'] = $_GPC['lng'];
	$data['departure_lat'] = $_GPC['lat'];
	$data['terminal_prov'] = $_GPC['terminal_prov'];
	$data['terminal_city'] = $_GPC['terminal_city'];
	$data['terminal_district'] = $_GPC['terminal_district'];
	$data['terminal_station'] = $_GPC['terminal_station'];
	$data['terminal_address'] = $_GPC['terminal_station'];
	$data['terminal_lng'] = $_GPC['terminal_lng'];
	$data['terminal_lat'] = $_GPC['terminal_lat'];
	$data['note'] = $_GPC['note'];
	$data['stations_str'] = $_GPC['stations'];
	$data['price_per_f'] = $_GPC['price_per_f'];
	$data['price_per_d'] = $_GPC['price_per_d'];
	$data['price_include_tax'] = $_GPC['price_include_tax'];
	$data['arrival_note'] = $_GPC['arrival_note'];
	$data['start_tel'] = $_GPC['start_tel'];
	$data['start_name'] = $_GPC['start_name'];
	$data['start_mobile'] = $_GPC['start_mobile'];
	$data['arrival_tel'] = $_GPC['arrival_tel'];
	$data['arrival_name'] = $_GPC['arrival_name'];
	$data['arrival_mobile'] = $_GPC['arrival_mobile'];
	if($_GPC['is_edit'] == '1') {
		pdo_update('navlange_pinche_line',$data,array('id'=>$_GPC['id']));
	} else {
		$data['uniacid'] = $_W['uniacid'];
		$data['type'] = '5';
		$data['uid'] = $_W['member']['uid'];
		$data['store_id'] = $store['id'];
		pdo_insert('navlange_pinche_line',$data);
	}
	message(error(0,''),'','ajax');
}
	
include $this->template('cargo_line_release');
?>