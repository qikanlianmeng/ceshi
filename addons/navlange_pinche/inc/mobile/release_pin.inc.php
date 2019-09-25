<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '司机发布';
$releaseable = $this->pin_releaseable();
$conf = pdo_fetch("SELECT color,release_need_license,pin_release_need_credit_score,pin_departure_station_mode,pin_terminal_station_mode,max_day_to_release,pin_line_mode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
if($conf['pin_departure_station_mode']=='1') {
	$departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_departure_station='1'");
}
if($conf['pin_terminal_station_mode']=='1') {
	$terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_terminal_station='1'");
}
$owner = pdo_get('navlange_pinche_owner',array('uniacid'=>$_W['uniacid'],'openid'=>$_W['openid']));
if($conf['release_need_license']=='1' && (empty($owner) || $owner['status']=='0')) {
    $need_check = '1';
} else {
	$need_check = '0';
}
$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
$note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='pin'");
include $this->template('release_pin');
?>