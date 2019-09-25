<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '货源详情';
$conf = pdo_fetch("SELECT owner_color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$goods = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
include $this->template('goods_info');
?>