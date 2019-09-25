<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '我的钱包';
$mc_member = pdo_fetch("SELECT credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
$owner = pdo_fetch("SELECT status,total_income,withdrawed_income FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
$conf = pdo_fetch("SELECT color,owner_color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$record = pdo_fetchall("SELECT record.mode as mode,record.money as money,record.generate_time as generate_time,record.status as status,record.desc as description FROM " . tablename('navlange_pinche_credit3_record') . " AS record WHERE record.uid=" . $_W['member']['uid'] . " ORDER BY record.generate_time DESC");
include $this->template('wallet');
?>