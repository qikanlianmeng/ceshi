<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$owner = pdo_fetch("SELECT id,status FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
$store = pdo_fetch("SELECT id,status FROM " . tablename("navlange_pinche_store") . " WHERE uid=" . $_W['member']['uid']);
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$conf = pdo_fetch("SELECT color,owner_color,cargo_accept_price FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = '确认接单';
} else if ($op == 'accept_l') {
	$conf = pdo_fetch("SELECT cargo_accept_price FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$member = pdo_fetch("SELECT credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
    if($member['credit3'] < $conf['cargo_accept_price']) {
    	message(error(1,''),'','ajax');
    } else {
    	$travel = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
    	$new_member['openid'] = $travel['openid'];
	    $new_member['uid'] = $travel['uid'];
	    $new_member['travel_id'] = $_GPC['id'];
	    $new_member['store_id'] = $store['id'];
	    $new_member['pin_id'] = 0;
	    $new_member['pin_time'] = TIMESTAMP;
	    $new_member['status'] = '3';
	    $new_member['uniacid'] = $_W['uniacid'];
	    $sn_prefix = date('YmdHis',$new_member['pin_time']);
	    $pin_count = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_member') . " WHERE sn LIKE '" . $sn_prefix . "%'");
	    $pin_count = count($pin_count)+1;
	    if($pin_count < 10) {
	        $pin_sn_suffix = '0000' . $pin_count;
	    } else if ($pin_count < 100) {
	        $pin_sn_suffix = '000' . $pin_count;
	    } else if ($pin_count < 1000) {
	        $pin_sn_suffix = '00' . $pin_count;
	    } else if ($pin_count < 10000) {
	        $pin_sn_suffix = '0' . $pin_count;
	    }
	    $new_member['sn'] = $sn_prefix . $pin_sn_suffix;
	    $new_member['price'] = $conf['cargo_accept_price'];
	    $new_member['type'] = '5';
	    pdo_insert('navlange_pinche_member',$new_member);
	    pdo_update('navlange_pinche_travel',array('status'=>'3','owner_confirmed'=>'1'),array('id'=>$_GPC['id']));
	    pdo_update('mc_members',array('credit3'=>($member['credit3']-$new_member['price'])),array('uid'=>$_W['member']['uid']));
    	message(error(0,''),'','ajax');
    }
} else if ($op == 'accept') {
	$conf = pdo_fetch("SELECT cargo_accept_price FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$member = pdo_fetch("SELECT credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
    if($member['credit3'] < $conf['cargo_accept_price']) {
    	message(error(1,''),'','ajax');
    } else {
    	$travel = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
    	if($travel['uid']==$_W['member']['uid']) {
    		message(error(2,''),'','ajax');
    	}
    	$pin['openid'] = $_W['openid']; 
	    $pin['uid']  = $_W['member']['uid'];
	    $owner = pdo_get('navlange_pinche_owner',array('uid'=>$_W['member']['uid']));
	    $pin['owner_id'] = $owner['id'];
	    $pin['car_number'] = $owner['car_number_1'] . $owner['car_number_2'] . $owner['car_number_3'];
	    $pin['car_series'] = $owner['car_series'];
	    $pin['car_color'] = $owner['car_color'];
	    $pin['departure_city'] = $travel['departure_city'];
	    $pin['departure_station'] = $travel['departure_station'];
	    $pin['terminal_city'] = $travel['terminal_city'];
	    $pin['terminal_station'] = $travel['terminal_station'];
	    $pin['departure_time'] = $travel['departure_time'];
	    $pin['boarding_place'] = $travel['boarding_place'];
	    $pin['lng'] = $travel['lng'];
	    $pin['lat'] = $travel['lat'];
	    $pin['price'] = $_GPC['price'];
	    $pin['passenger_count'] = $_GPC['passenger_count'];
	    $pin['left_amount'] = $_GPC['passenger_count'];
	    $pin['pined_amount'] = 0;
	    $pin['uniacid'] = $_W['uniacid'];
	    $pin['release_time'] = TIMESTAMP;
	    $pin['status'] = '0';
	    $pin['type'] = '5';
	    pdo_insert('navlange_pinche_pin',$pin);
	    $id = pdo_insertid('navlange_pinche_pin');
	    $this->accept_travel($id,$_GPC['id']);

    	pdo_update('mc_members',array('credit3'=>($member['credit3']-$new_member['price'])),array('uid'=>$_W['member']['uid']));
		message(error(0,''),'','ajax');
    }
}
include $this->template('goods_confirm');
?>