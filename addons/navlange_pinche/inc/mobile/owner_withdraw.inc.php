<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '车主提现';
$conf = pdo_fetch("SELECT withdraw_min FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$mc_member = pdo_fetch("SELECT credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
include $this->template('owner_withdraw');
?>