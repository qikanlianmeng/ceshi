<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '出行详情';
$conf = pdo_fetch("SELECT owner_color,color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$travel = pdo_fetch("SELECT status,amount,expected_price,departure_time,departure_city,departure_station,terminal_city,terminal_station FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
$member = pdo_fetchall("SELECT id,owner_id,pin_id,status,owner_comming_to_departure_station,owner_arrived_departure_station FROM " . tablename('navlange_pinche_member') . " WHERE travel_id=" . $_GPC['id']);
$member_info = array();
foreach ($member as $key => $value) {
	$owner = pdo_fetch("SELECT mc_member.avatar as avatar,mc_member.nickname as nickname,owner.credit_score as credit_score,owner.car_number_1 as car_number_1,owner.car_number_2 as car_number_2,owner.car_number_3 as car_number_3,owner.tel as tel,owner.car_series as car_series FROM " . tablename('navlange_pinche_owner') . " AS owner LEFT JOIN " . tablename('mc_members') . " AS mc_member ON owner.uid=mc_member.uid WHERE owner.id=" . $value['owner_id']);
	$data['owner'] = $owner;
	$data['pin'] = pdo_fetch("SELECT pined_amount,note FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $value['pin_id']);
	$data['status'] = $value['status'];
	$data['owner_comming_to_departure_station'] = $value['owner_comming_to_departure_station'];
	$data['owner_arrived_departure_station'] = $value['owner_arrived_departure_station'];
	$data['id'] = $value['id'];
	$comment = pdo_get('navlange_pinche_comment',array('member_id'=>$value['id'],'type'=>'1'));
	if(!empty($comment)) {
		$comment['time'] = date('m-d H:i',$comment['time']);
		$item = json_decode($comment['content']);
		$comment['content'] = $item;
		$comment['other'] = $comment['other'];
		$comment['comment_level'] = $comment['comment_level'];
		$comment['uid'] = $comment['uid'];
	}
	$data['comment'] = $comment;
	$my_comment = pdo_get('navlange_pinche_comment',array('member_id'=>$value['id'],'type'=>'0'));
	if(!empty($my_comment)) {
		$my_comment['time'] = date('m-d H:i',$my_comment['time']);
		$item = json_decode($my_comment['content']);
		$my_comment['content'] = $item;
		$my_comment['other'] = $my_comment['other'];
		$my_comment['comment_level'] = $my_comment['comment_level'];
		$my_comment['uid'] = $my_comment['uid'];
	}
	$data['my_comment'] = $my_comment;
	array_push($member_info,$data);
}
$template = pdo_getall('navlange_pinche_comment_template',array('uniacid'=>$_W['uniacid'],'type'=>'0'));
$cancel_reason_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='passenger_cancel'");
include $this->template('travel_info');
?>