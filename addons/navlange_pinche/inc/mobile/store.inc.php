<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '商家中心';
$store = pdo_fetch("SELECT id,img,sn,type FROM " . tablename('navlange_pinche_store') . " WHERE uid=" . $_W['member']['uid']);
if(empty($store)) {
	header("Location: " . $this->createMobileurl('store_register'));
}

$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
include $this->template('store');
?>