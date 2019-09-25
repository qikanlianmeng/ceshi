<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = $conf['pin_mode_name'];
	if($conf['member_on'] == '1') {
		$member_info = $this->member_info($_W['member']['uid'],$conf['member_type']);
	}
	if(!empty($_GPC['city'])) {
	    $_SESSION['city'] = pdo_fetchcolumn("SELECT city FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " AND id=" . $_GPC['city']);
	} else {
	    $_SESSION['city'] = pdo_fetchcolumn("SELECT city FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_default='1'");
	}
	$alphabetical = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$all_city = array();
	foreach ($alphabetical as $key => $value) {
	    $city = pdo_getall('navlange_pinche_city',array("alphabetical_index"=>$value));
	    if(count($city) > 0) {
	        $data = array();
	        $data['alphabetical_index'] = $value;
	        $data['city'] = $city;
	        array_push($all_city,$data);
	    }
	}
	if($conf['pin_index_advertise_on'] == '1') {
	    $advertise = pdo_getall('navlange_advertise_module',array('uniacid'=>$_W['uniacid'],'module_id'=>$_W['current_module']['mid'],'page'=>'pin_index'));
	    $advertise_info = array();
	    foreach ($advertise as $key => $value) {
	        $cur_advertise = pdo_get('navlange_advertise',array('id'=>$value['advertise_id']));
	        $data['pic_name'] = $cur_advertise['pic_name'];
	        $data['url'] = $cur_advertise['url'];
	        $data['advertise_id'] = $cur_advertise['id'];
	        array_push($advertise_info,$data);
	    }
	}
	$menu = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1'");
	$params[':uniacid'] = $_W['uniacid'];
	$params[':time'] = time()-$conf['pin_display_days_before']*24*60*60;
	$sql_fixed = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=:uniacid" . " AND type='1' AND departure_time>:time AND (status='0') AND is_fixed='1' AND fixed_expire>=" . time() . " ORDER BY fixed_release_time DESC";
	$pin_fixed = pdo_fetchall($sql_fixed,$params);
	$sql_stick = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=:uniacid" . " AND type='1' AND departure_time>:time AND (status='0') AND (is_fixed='0' OR (is_fixed='1' AND fixed_expire<" . time() . ")) AND is_stick='1' AND stick_expire>=" . time() . " ORDER BY stick_release_time DESC";
	$pin_stick = pdo_fetchall($sql_stick,$params);
	$sql_general = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=:uniacid" . " AND type='1' AND departure_time>:time AND (status='0') AND (is_fixed='0' OR (is_fixed='1' AND fixed_expire<" . time() . ")) AND (is_stick='0' OR (is_stick='1' AND stick_expire<" . time() . "))" . " ORDER BY release_time DESC";
	$pin_general = pdo_fetchall($sql_general,$params);
	$pin = array_merge($pin_fixed,$pin_stick,$pin_general);
	$pin_info = array();
	foreach ($pin as $key => $value) {
		$data['id'] = $value['id'];
		$data['departure_station'] = $value['departure_station'];
		$data['terminal_station'] = $value['terminal_station'];
		$data['departure_time'] = $value['departure_time'];
		$data['passenger_count'] = $value['passenger_count'];
		$data['pin_count'] = $this->pin_count($value['id']);
		$data['boarding_place'] = $value['boarding_place'];
		$data['car_series'] = $value['car_series'];
		$data['car_number'] = $value['car_number'];
		$data['status'] = $value['status'];
		$data['price'] = $value['price'];
		$data['is_fixed'] = $value['is_fixed'];
		$data['fixed_expire'] = $value['fixed_expire'];
		$data['is_stick'] = $value['is_stick'];
		$data['stick_expire'] = $value['stick_expire'];
		$data['tel'] = pdo_fetchcolumn("SELECT tel FROM " . tablename('navlange_pinche_owner') . " AS owner LEFT JOIN " . tablename('navlange_pinche_pin') . " AS pin ON owner.id=pin.owner_id WHERE pin.id=" . $value['id']);
		$owner = pdo_fetch("SELECT credit_score,status FROM " . tablename('navlange_pinche_owner') . " WHERE id=" . $value['owner_id']);
		$data['approved'] = $owner['status'] == '1' ? '1' : '0';
		$data['credit_level'] = $this->get_credit_level($owner['credit_score']);
		$data['owner_id'] = $value['owner_id'];
		array_push($pin_info,$data);
	}
	$user_info = mc_fetch(mc_openid2uid($_W['openid']));
	$notice = pdo_fetchall("SELECT notice.id as id,notice.title as title,type.name as type,type.color as color FROM " . tablename('navlange_pinche_notice') . " AS notice LEFT JOIN " . tablename('navlange_pinche_notice_type') . " AS type ON notice.type=type.id WHERE notice.uniacid=" . $_W['uniacid']);
	if($conf['pin_departure_station_mode']=='1') {
		$departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_departure_station='1'");
	}
	if($conf['pin_terminal_station_mode']=='1') {
		$terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_terminal_station='1'");
	}
	if($conf['pin_index_line_on']=='1') {
		$line = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_line') . " WHERE uniacid=" . $_W['uniacid'] . " LIMIT 0," . $conf['pin_index_line_amount']);
		$line_info = array();
		foreach ($line as $key => $value) {
			$data['name'] = $value['name'];
			$data['departure_station'] = pdo_fetchcolumn("SELECT name FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $value['departure_station']);
			$data['terminal_station'] = pdo_fetchcolumn("SELECT name FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $value['terminal_station']);
			array_push($line_info,$data);
		}
	}
	include $this->template('index');
} else if ($op == 'pin_check') {
	$owner_uid = pdo_fetchcolumn("SELECT uid FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
	$status = '0';
	if($owner_uid == mc_openid2uid($_W['openid'])) {
		$status = '3';
		message(error($status,''),'','ajax');
	}
	$is_member = pdo_fetch("SELECT member.* FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('navlange_pinche_travel') . " AS travel ON member.travel_id=travel.id WHERE travel.uid='" . mc_openid2uid($_W['openid']) . "' AND member.pin_id=" . $_GPC['id']);
	if(!empty($is_member)) {
		$status = '1';
		message(error($status,''),'','ajax');
	} else {
		$passenger_count = pdo_fetchcolumn("SELECT passenger_count FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
		$pin_count = $this->pin_count($_GPC['id']);
		if($pin_count>=$passenger_count) {
			$status = '2';
			message(error($status,''),'','ajax');
		}
	}
	message(error($status,''),'','ajax');
} else if ($op == 'pin') {
	$client['uniacid'] = $_W['uniacid'];
	$client['uid'] = $_W['member']['uid'];
	$is_exist = pdo_get("navlange_pinche_client",$client);
	if(empty($is_exist)) {
		$client['uid'] = $_W['member']['uid'];
		$client['openid'] = $_W['openid'];
		$client['register_time'] = time();
		$client['credit_score'] = pdo_fetchcolumn("SELECT client_default_credit_score FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
		pdo_insert('navlange_pinche_client',$client);
	}
	$member = pdo_getall('navlange_pinche_member',array('pin_id'=>$_GPC['id']));
	$pined = false;
	foreach ($member as $key => $value) {
		$travel = pdo_get('navlange_pinche_travel',array('id'=>$value['travel_id']));
		if($travel['openid'] == $_W['openid']) {
			$pined = true;
			break;
		}
	}
	if($pined == true) {
		$status = '1';
	} else {
		$passenger_count = pdo_fetchcolumn("SELECT passenger_count FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
		$pin_count = $this->pin_count($_GPC['id']);
		if(($pin_count+$_GPC['amount'])>$passenger_count) {
			$status = '2';
		} else {
			$pin = pdo_get('navlange_pinche_pin',array('id'=>$_GPC['id']));
			$new_travel['departure_station'] = $pin['departure_station'];
			$new_travel['terminal_station'] = $pin['terminal_station'];
			$new_travel['departure_time'] = $pin['departure_time'];
			$new_travel['name'] = $_GPC['name'];
			$new_travel['mobile'] = $_GPC['mobile'];
			$new_travel['amount'] = $_GPC['amount'];
			$new_travel['boarding_place'] = $pin['boarding_place'];
			$new_travel['lng'] = $_GPC['lng'];
			$new_travel['lat'] = $_GPC['lat'];
			$new_travel['uid'] = mc_openid2uid($_W['openid']);
			$new_travel['openid'] = $_W['openid'];
			$new_travel['uniacid'] = $_W['uniacid'];
			$new_travel['release_time'] = time();
			$new_travel['status'] = '1';
			$new_travel['type'] = '1';
			pdo_insert('navlange_pinche_travel',$new_travel);
			$travel_id = pdo_insertid('navlange_pinche_travel');
			$reply['id'] = $travel_id;
			$new_member['uid'] = $new_travel['uid'];
			$new_member['openid'] = $_W['openid'];
			$new_member['pin_id'] = $_GPC['id'];
			$new_member['travel_id'] = $travel_id;
			$new_member['pin_time'] = $new_travel['release_time'];
			$new_member['status'] = '0';
			$new_member['uniacid'] = $_W['uniacid'];
			$new_member['type'] = '1';
			$new_member['passenger_amount'] = $_GPC['amount'];
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
			$pay_count = pdo_fetchall("SELECT * FROM " . tablename('core_paylog') . " WHERE tid LIKE '" . $sn_prefix . "%'");
			$pay_count = count($pay_count)+1;
			if($pay_count < 10) {
				$pay_tid_suffix = '0000' . $pay_count;
			} else if ($pay_count < 100) {
				$pay_tid_suffix = '000' . $pay_count;
			} else if ($pay_count < 1000) {
				$pay_tid_suffix = '00' . $pay_count;
			} else if ($pay_count < 10000) {
				$pay_tid_suffix = '0' . $pay_count;
			}
			$new_member['pay_tid'] = $sn_prefix . $pay_tid_suffix;
			$new_member['price'] = $pin['price'];
			pdo_insert('navlange_pinche_member',$new_member);
			$reply['id'] = $travel_id;
			$status = '0';
		}
	}	
	message(error($status,$reply),'','ajax');
} else if ($op == 'refresh') {
	$sql = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=" . $_W['uniacid'] . " AND status='0' AND departure_station LIKE '%" . $_GPC['departure_station'] . "%' AND terminal_station LIKE '%" . $_GPC['terminal_station'] . "%'";
	if(!empty($_GPC['date'])) {
		$today = strtotime($_GPC['date']);
		$tomorrow = $today + 24*60*60;
		$sql .= " AND departure_time>=" . $today . " AND departure_time<" . $tomorrow;
	} else {
		$sql .= " AND departure_time>=" . time();
	}
	$sql .= " ORDER BY is_fixed DESC, is_stick DESC,fixed_release_time DESC, stick_release_time DESC, departure_time DESC";
	$pin = pdo_fetchall($sql);
	$pin_info = array();
	foreach ($pin as $key => $value) {
		$data['id'] = $value['id'];
		$data['departure_station'] = $value['departure_station'];
		$data['terminal_station'] = $value['terminal_station'];
		$data['departure_time'] = date('m-d H:i',$value['departure_time']);
		$data['price'] = $value['price'];
		$data['passenger_count'] = $value['passenger_count'];
		$data['pin_count'] = $this->pin_count($value['id']);
		$data['boarding_place'] = $value['boarding_place'];
		$data['is_fixed'] = $value['is_fixed'];
		$data['fixed_expire'] = $value['fixed_expire'] > time() ? '0' : '1';
		$data['is_stick'] = $value['is_stick'];
		$data['stick_expire'] = $value['stick_expire'] > time() ? '0' : '1';
		$owner = pdo_get('navlange_pinche_owner',array('id'=>$value['owner_id']));
		$data['car_series'] = $owner['car_series'];
		$data['tel'] = pdo_fetchcolumn("SELECT tel FROM " . tablename('navlange_pinche_owner') . " AS owner LEFT JOIN " . tablename('navlange_pinche_pin') . " AS pin ON owner.id=pin.owner_id WHERE pin.id=" . $value['id']);
		$owner = pdo_fetch("SELECT credit_score,status FROM " . tablename('navlange_pinche_owner') . " WHERE id=" . $value['owner_id']);
		$data['approved'] = $owner['status'] == '1' ? '1' : '0';
		$data['credit_level'] = $this->get_credit_level($owner['credit_score']);
		$data['owner_id'] = $value['owner_id'];
		array_push($pin_info,$data);
	}
	message(error(0,$pin_info),'','ajax');
} else if ($op == 'release_travel') {
	$client['uniacid'] = $_W['uniacid'];
	$client['uid'] = $_W['member']['uid'];
	$is_exist = pdo_get("navlange_pinche_client",$client);
	if(empty($is_exist)) {
		$client['uid'] = $_W['member']['uid'];
		$client['openid'] = $_W['openid'];
		$client['register_time'] = time();
		$client['credit_score'] = pdo_fetchcolumn("SELECT client_default_credit_score FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
		pdo_insert('navlange_pinche_client',$client);
	}
	$travel['departure_station'] = $_GPC['departure_station'];
	$travel['terminal_station'] = $_GPC['terminal_station'];
	$travel['departure_time'] = strtotime($_GPC['departure_time']);
	$travel['name'] = $_GPC['name'];
	$travel['mobile'] = $_GPC['mobile'];
	$travel['amount'] = $_GPC['amount'];
	$travel['boarding_place'] = $_GPC['boarding_place'];
	$travel['lng'] = $_GPC['lng'];
	$travel['lat'] = $_GPC['lat'];
	$travel['uid'] = mc_openid2uid($_W['openid']);
	$travel['openid'] = $_W['openid'];
	$travel['uniacid'] = $_W['uniacid'];
	$travel['release_time'] = time();
	$travel['expected_price'] = $_GPC['expected_price'];
	$travel['status'] = '0';
	$travel['type'] = '1';
	pdo_insert('navlange_pinche_travel',$travel);
	message(error(0,''),'','ajax');
}
?>