<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$conf = pdo_fetch("SELECT color,owner_color,pin_fixed_on,pin_stick_on,owner_color,info_share_hint,info_share_title,info_share_desc,info_share_img FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$pin = pdo_get('navlange_pinche_pin',array('id'=>$_GPC['id']));
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = $pin['departure_station'] . '->' . $pin['terminal_station'] . ' ' . $_W['page']['sitename'];
	$member = pdo_fetchall("SELECT member.id as id,mc_member.avatar as avatar,mc_member.nickname as nickname FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('mc_members') . " AS mc_member ON member.uid=mc_member.uid WHERE member.pin_id=" . $_GPC['id']);
	if($member) {
		$member_info = $this->get_pin_member_info($member[0]['id']);
	}
	$comment = pdo_get('navlange_pinche_comment',array('pin_id'=>$_GPC['id'],'uid'=>$member_info['uid'],'type'=>'0'));
	if(!empty($comment)) {
		$comment['time'] = date('m-d H:i',$comment['time']);
		$item = json_decode($comment['content']);
		$comment['content'] = $item;
		$comment['other'] = $comment['other'];
		$comment['comment_level'] = $comment['comment_level'];
		$comment['uid'] = $comment['uid'];
	}
	$my_comment = pdo_get('navlange_pinche_comment',array('pin_id'=>$_GPC['id'],'member_id'=>$member_info['id'],'type'=>'1'));
	if(!empty($my_comment)) {
		$my_comment['time'] = date('m-d H:i',$my_comment['time']);
		$item = json_decode($my_comment['content']);
		$my_comment['content'] = $item;
		$my_comment['other'] = $my_comment['other'];
		$my_comment['comment_level'] = $my_comment['comment_level'];
		$my_comment['uid'] = $my_comment['uid'];
	}
	$template = pdo_getall('navlange_pinche_comment_template',array('uniacid'=>$_W['uniacid'],'type'=>'1'));
	$share_info = '我参与了从' . $pin['departure_station'] . '到' . $pin['terminal_station'] . "的出行，车辆型号为：" . $pin['car_series'] . "，可乘人数：" . $pin['passenger_count'] . "，已拼人数：" . $pin['pined_amount'] . "！";
	if($conf['pin_fixed_on']=='1' && $pin['status']=='0' && $is_owner == '1') {
		$fixed_package = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_pin_fixed_package') . " WHERE uniacid=" . $_W['uniacid']);
	}
	if($conf['pin_stick_on']=='1' && $pin['status']=='0' && $is_owner == '1') {
		$stick_package = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_pin_stick_package') . " WHERE uniacid=" . $_W['uniacid']);
	}
	include $this->template('info');
} else if ($op == 'get_passenger_info') {
	global $_GPC;
	$member = $this->get_pin_member_info($_GPC['id']);
	$res = $member;
	$comment = pdo_get('navlange_pinche_comment',array('pin_id'=>$member['pin_id'],'uid'=>$member['uid'],'type'=>'0'));
	if(!empty($comment)) {
		$comment['time'] = date('m-d H:i',$comment['time']);
		$item = json_decode($comment['content']);
		$comment['content'] = $item;
		$comment['other'] = $comment['other'];
		$comment['comment_level'] = $comment['comment_level'];
		$comment['uid'] = $comment['uid'];
	}
	$res['comment'] = $comment;
	$my_comment = pdo_get('navlange_pinche_comment',array('pin_id'=>$member['pin_id'],'member_id'=>$_GPC['id'],'type'=>'1'));
	if(!empty($my_comment)) {
		$my_comment['time'] = date('m-d H:i',$my_comment['time']);
		$item = json_decode($my_comment['content']);
		$my_comment['content'] = $item;
		$my_comment['other'] = $my_comment['other'];
		$my_comment['comment_level'] = $my_comment['comment_level'];
		$my_comment['uid'] = $my_comment['uid'];
	}
	$res['my_comment'] = $my_comment;
	$res['cancel_reason'] = $member['cancel_reason'] ? $member['cancel_reason'] : $member['owner_cancel_reason'];
	message(error(0,$res),'','ajax');
} else if ($op == 'confirm') {
	$travel_id = pdo_fetchcolumn("SELECT travel_id FROM " . tablename('navlange_pinche_member') . " WHERE id=" . $_GPC['id']);
	pdo_update('navlange_pinche_travel',array('owner_confirmed'=>'1'),array('id'=>$travel_id));
    pdo_update('navlange_pinche_member',array('status'=>'1'),array('id'=>$_GPC['id']));
    //$this->pin_success_notify($travel_id);
    message(error(0,''),'','ajax');
} else if ($op == 'comment') {
	$member = pdo_fetch("SELECT travel_id,openid,uid FROM " . tablename('navlange_pinche_member') . " WHERE id=" . $_GPC['member_id']);
	$comment = pdo_fetch("SELECT pin.owner_id as owner_id,pin.uid as owner_uid,pin.openid as owner_openid FROM " . tablename('navlange_pinche_pin') . " AS pin WHERE pin.id=" . $_GPC['pin_id']);
	$comment['pin_id'] = $_GPC['pin_id'];
	$comment['uniacid'] = $_W['uniacid'];
	$comment['openid'] = $member['openid'];
	$comment['uid'] = $member['uid'];
	$content = array();
	if(!empty($_GPC['template'])) {
		foreach ($_GPC['template'] as $key => $value) {
			$template = pdo_get('navlange_pinche_comment_template',array('id'=>$value));
			array_push($content,$template['content']);
		}
		$comment['content'] = json_encode($content);
	}
	if($_GPC['other'] != '') {
		$comment['other'] = $_GPC['other'];
	}
	$comment['time'] = time();
	$comment['comment_level'] = $_GPC['comment_level'];
	$comment['type'] = '1';
	$comment['member_id'] = $_GPC['member_id'];
	$comment['travel_id'] = $member['travel_id'];
	pdo_insert('navlange_pinche_comment',$comment);
	message(error(0,''),'','ajax');
} else if ($op == 'depart') {
	$member = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_member') . " WHERE pin_id=" . $_GPC['id']);
	foreach ($member as $key => $value) {
		pdo_update('navlange_pinche_travel',array('status'=>'4'),array('id'=>$value['travel_id']));
		pdo_update('navlange_pinche_member',array('status'=>'4'),array('id'=>$value['id'],'status'=>'3'));
	}
	pdo_update('navlange_pinche_pin',array('status'=>'1'),array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'terminal') {
	$member = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_member') . " WHERE pin_id=" . $_GPC['id']);
	$owner_uid = pdo_fetchcolumn("SELECT uid FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
	foreach ($member as $key => $value) {
		if($value['status'] == '0') {
			pdo_update('navlange_pinche_member',array('status'=>'10'),array('id'=>$value['id']));
		} else if ($value['status'] == '4') {
			pdo_update('navlange_pinche_travel',array('status'=>'6'),array('id'=>$value['travel_id']));
			pdo_update('navlange_pinche_member',array('status'=>'6'),array('id'=>$value['id']));
		}
	}
	pdo_update('navlange_pinche_pin',array('status'=>'3'),array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'terminal_confirm') {
	$this->confirm_arrival($_GPC['id']);
	message(error(0,''),'','ajax');
} else if ($op == 'confirm_arrival') {
	pdo_update('navlange_pinche_pin',array('price'=>$_GPC['price'],'status'=>'3'),array('id'=>$_GPC['id']));
	pdo_update('navlange_pinche_member',array('price'=>$_GPC['price'],'status'=>'6'),array('pin_id'=>$_GPC['id']));
	$member = pdo_fetch("SELECT travel_id FROM " . tablename('navlange_pinche_member') . " WHERE pin_id=" . $_GPC['id']);
	pdo_update('navlange_pinche_travel',array('status'=>'6'),array('id'=>$member['travel_id']));
	message(error(0,''),'','ajax');
} else if ($op == 'fixed_confirm') {
	$record['uniacid'] = $_W['uniacid'];
	$record['pin_id'] = $_GPC['pin_id'];
	$record['fixed_package_id'] = $_GPC['fixed_package'];
	$fixed_package = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_pin_fixed_package') . " WHERE id=" . $_GPC['fixed_package']);
	$record['period'] = $fixed_package['period'];
	$record['money'] = $fixed_package['price'];
	$record['release_time'] = time();
	$record['status'] = '0';
	$sn_prefix = date('YmdHis',$record['release_time']);
	$record_count = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_pin_fixed_record') . " WHERE sn LIKE '" . $sn_prefix . "%'");
	$record_count = count($record_count)+1;
	if($record_count < 10) {
		$pin_sn_suffix = '0000' . $record_count;
	} else if ($record_count < 100) {
		$pin_sn_suffix = '000' . $record_count;
	} else if ($record_count < 1000) {
		$pin_sn_suffix = '00' . $record_count;
	} else if ($record_count < 10000) {
		$pin_sn_suffix = '0' . $record_count;
	}
	$record['sn'] = $sn_prefix . $pin_sn_suffix;
	pdo_insert('navlange_pinche_pin_fixed_record',$record);
	$id = pdo_insertid();
	load()->model('mc');
	$uid = mc_openid2uid($_W['openid']);
	$member_info = mc_fetch($uid);
	if($member_info['credit2'] < $record['money']) {
		message(error(1,''),'','ajax');
	} else {
		mc_credit_update($uid, 'credit2', -$record['money'], array(0, '拼车固定支付'));
		pdo_update('navlange_pinche_pin_fixed_record',array('status'=>'1','pay_mode'=>'0','payed_money'=>$record['money']),array('id'=>$id));
		$pin = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['pin_id']);
		if($pin['fixed_expire'] > time()) {
			$data['fixed_expire'] = $pin['fixed_expire']+$record['period']*60*60;
		} else {
			$data['fixed_expire'] = time()+$record['period']*60*60;
		}
		$data['is_fixed'] = '1';
		$data['fixed_release_time'] = time();
		pdo_update('navlange_pinche_pin',$data,array('id'=>$_GPC['pin_id']));
		message(error(0,$member_info),'','ajax');
	}
} else if ($op == 'stick_confirm') {
	$record['uniacid'] = $_W['uniacid'];
	$record['pin_id'] = $_GPC['pin_id'];
	$record['stick_package_id'] = $_GPC['stick_package'];
	$stick_package = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_pin_stick_package') . " WHERE id=" . $_GPC['stick_package']);
	$record['period'] = $stick_package['period'];
	$record['money'] = $stick_package['price'];
	$record['release_time'] = time();
	$record['status'] = '0';
	$sn_prefix = date('YmdHis',$record['release_time']);
	$record_count = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_pin_stick_record') . " WHERE sn LIKE '" . $sn_prefix . "%'");
	$record_count = count($record_count)+1;
	if($record_count < 10) {
		$pin_sn_suffix = '0000' . $record_count;
	} else if ($record_count < 100) {
		$pin_sn_suffix = '000' . $record_count;
	} else if ($record_count < 1000) {
		$pin_sn_suffix = '00' . $record_count;
	} else if ($record_count < 10000) {
		$pin_sn_suffix = '0' . $record_count;
	}
	$record['sn'] = $sn_prefix . $pin_sn_suffix;
	pdo_insert('navlange_pinche_pin_stick_record',$record);
	$id = pdo_insertid();
	load()->model('mc');
	$uid = mc_openid2uid($_W['openid']);
	$member_info = mc_fetch($uid);
	if($member_info['credit2'] < $record['money']) {
		message(error(1,''),'','ajax');
	} else {
		mc_credit_update($uid, 'credit2', -$record['money'], array(0, '拼车固定支付'));
		pdo_update('navlange_pinche_pin_stick_record',array('status'=>'1','pay_mode'=>'0','payed_money'=>$record['money']),array('id'=>$id));
		$pin = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['pin_id']);
		if($pin['stick_expire'] > time()) {
			$data['stick_expire'] = $pin['stick_expire']+$record['period']*60*60;
		} else {
			$data['stick_expire'] = time()+$record['period']*60*60;
		}
		$data['is_stick'] = '1';
		$data['stick_release_time'] = time();
		pdo_update('navlange_pinche_pin',$data,array('id'=>$_GPC['pin_id']));
		message(error(0,$member_info),'','ajax');
	}
} else if ($op == 'share_success') {
	///分享赠送积分
	$pin = pdo_fetch("SELECT uid FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
	if($pin['uid'] != $_W['member']['uid']){
		$marketing_conf = pdo_fetch("SELECT passenger_share_integral,passenger_share_integral_per_day FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
	    $exists_record = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_integral_record') . " WHERE type='2' AND uid=" . $_W['member']['uid'] . " AND time>=" . strtotime(date('Y-m-d',time())) . " AND time<" . (strtotime(date('Y-m-d',time()))+24*60*60));
	    if($exists_record < $marketing_conf['passenger_share_integral_per_day'] && $marketing_conf['passenger_share_integral']>0) {
	        $mc_member = pdo_fetch("SELECT credit1 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
	        pdo_update('mc_members',array('credit1'=>($mc_member['credit1']+$marketing_conf['passenger_share_integral'])),array('uid'=>$_W['member']['uid']));
	        $item=array();
	        $item['uniacid'] = $_W['uniacid'];
	        $item['uid'] = $_W['member']['uid'];
	        $item['type'] = '2';
	        $item['integral'] = $marketing_conf['passenger_share_integral'];
	        $item['time'] = time();
	        $item['pin_id'] = $_GPC['id'];
	        pdo_insert('navlange_pinche_integral_record',$item);
	    }
	}
}

?>