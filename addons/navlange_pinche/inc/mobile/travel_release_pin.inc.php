<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '乘客发布';
$conf = pdo_fetch("SELECT color,pin_departure_station_mode,pin_terminal_station_mode,max_day_to_release,passenger_mobile_by_force FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
if($conf['pin_departure_station_mode']=='1') {
	$departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_departure_station='1'");
}
if($conf['pin_terminal_station_mode']=='1') {
	$terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_terminal_station='1'");
}
$note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='travel'");
$wx_member = pdo_fetch("SELECT mobile FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
include $this->template('travel_release_pin');
?>