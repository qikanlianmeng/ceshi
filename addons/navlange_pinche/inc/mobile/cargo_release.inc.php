<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '发布货源';
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$conf = pdo_fetch("SELECT passenger_mobile_by_force,color,cargo_goods_line_mode,cargo_goods_type_on,cargo_delivery_need_on,cargo_arrival_service_on,cargo_price_mode,cargo_note_mode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$wx_member = pdo_fetch("SELECT mobile FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
	$note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='goods'");
	if($_GPC['line'] > 0) {
		$line = pdo_fetch("SELECT departure_prov,departure_city,departure_district,departure_station,terminal_prov,terminal_city,terminal_district,terminal_station FROM " . tablename('navlange_pinche_line') . " WHERE id=" . $_GPC['line']);
	}
} else if ($op == 'release_submit') {
	global $_W,$_GPC;
    $client['uniacid'] = $_W['uniacid'];
	$client['uid'] = $_W['member']['uid'];
	$is_exist = pdo_get("navlange_pinche_client",$client);
	if(empty($is_exist)) {
		$this->register_passenger($_W['member']['uid'],$_W['openid']);
	}
	/*$status = $this->travel_release_check();
	if($status != '0') {
		message(error($status,''),'','ajax');
	}*/
	$wx_member = pdo_fetch("SELECT realname,mobile FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
	$travel['departure_city'] = $_GPC['departure_city'];
    $travel['departure_district'] = $_GPC['departure_district'];
	$travel['departure_station'] = $_GPC['departure_station'];
	$travel['terminal_city'] = $_GPC['terminal_city'];
    $travel['terminal_district'] = $_GPC['terminal_district'];
	$travel['terminal_station'] = $_GPC['terminal_station'];
	$travel['departure_time'] = strtotime($_GPC['departure_time']);
	$travel['name'] = $wx_member['realname'];
	$travel['mobile'] = $wx_member['mobile'];
	$travel['goods_type'] = $_GPC['goods_type'];
	$travel['boarding_place'] = $_GPC['departure_station'];
	$travel['lng'] = $_GPC['lng'];
	$travel['lat'] = $_GPC['lat'];
	$travel['terminal_lng'] = $_GPC['terminal_lng'];
	$travel['terminal_lat'] = $_GPC['terminal_lat'];
	$travel['uid'] = $_W['member']['uid'];
	$travel['openid'] = $_W['openid'];
	$travel['uniacid'] = $_W['uniacid'];
	$travel['release_time'] = TIMESTAMP;
	$travel['volume'] = $_GPC['volume'];
	$travel['weight'] = $_GPC['weight'];
	$travel['goods_length'] = $_GPC['goods_length'];
	$travel['goods_width'] = $_GPC['goods_width'];
	$travel['goods_height'] = $_GPC['goods_height'];
	$travel['delivery_need'] = $_GPC['delivery_need'];
	$travel['arrival_service'] = $_GPC['arrival_service'];
	$travel['expected_price'] = $_GPC['expected_price'];
	$travel['pay_mode'] = $_GPC['pay_mode'];
	$travel['status'] = '0';
	$travel['type'] = '5';
	$travel['note'] = $_GPC['note'];
    $travel['source'] = '0';
    $travel['car_type'] = $_GPC['car_type'];
    $travel['car_length'] = $_GPC['car_length'];
    $travel['need_cover'] = $_GPC['cover'];
    $travel['goods_name'] = $_GPC['goods_name'];
    $travel['start_time'] = strtotime($_GPC['start_time']);
    $travel['end_time'] = strtotime($_GPC['end_time']);
	pdo_insert('navlange_pinche_travel',$travel);
	$id = pdo_insertid();
	if(!empty($_GPC['attachment'])) {
        foreach ($_GPC['attachment'] as $key => $value) {
            $data['uniacid'] = $_W['uniacid'];
            $data['travel_id'] = $id;
            $data['type'] = '5';
            $data['img'] = $value;
            pdo_insert('navlange_pinche_gallery',$data);
        }
    }
    if($_GPC['line'] > 0) {
    	$member['uniacid'] = $_W['uniacid'];
    	$member['type'] = '5';
    	$member['uid'] = $_W['member']['uid'];
    	$member['openid'] = $_W['openid'];
    	$member['pin_time'] = TIMESTAMP;
    	$sn_prefix = date('YmdHis',$member['pin_time']);
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
		$member['sn'] = $sn_prefix . $pin_sn_suffix;
		$member['travel_id'] = $id;
		$member['owner_id'] = $_GPC['line'];
		$member['status'] = '0';
		pdo_insert('navlange_pinche_member',$member);
    }
	message(error(0,''),'','ajax');
}
include $this->template('cargo_release');
?>