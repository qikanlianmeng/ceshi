<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '编辑出车';
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
	$note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='pin'");
    $pin = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
} else if($op == 'modify') {
    $data['passenger_count'] = $_GPC['passenger_count'];
    pdo_update('navlange_pinche_pin',$data,array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}

include $this->template('pin_edit');
?>