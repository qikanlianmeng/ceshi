<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '商家专线';
$store = pdo_fetch("SELECT id,img,sn,type FROM " . tablename('navlange_pinche_store') . " WHERE uid=" . $_W['member']['uid']);
if(empty($store)) {
	header("Location: " . $this->createMobileurl('store_register'));
}
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
	$store_line = pdo_fetchall("SELECT id,departure_prov,departure_city,departure_district,departure_address,terminal_prov,terminal_city,terminal_district,terminal_address FROM " . tablename('navlange_pinche_line') . " WHERE store_id=" . $store['id']);
} else if ($op == 'delete_line') {
	pdo_delete('navlange_pinche_line',array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
}

include $this->template('store_line');
?>