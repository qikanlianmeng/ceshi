<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$line_list = pdo_fetchall("SELECT id,name,tel,cl_departure_station,cl_terminal_station FROM " . tablename('navlange_pinche_owner') . " WHERE uniacid=" . $_W['uniacid'] . " AND cl_on='1'");
} else if ($op == 'change_pined_amount') {
    $pin = pdo_fetch("SELECT passenger_count,pined_amount,left_amount FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['id']);
    $data['pined_amount'] = $_GPC['pined_amount'];
    $data['left_amount'] = $pin['passenger_count']-$data['pined_amount'];
    pdo_update('navlange_pinche_pin',$data,array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if($op == 'detail') {
    $id = $_GPC['id'];
    //$pin = pdo_fetch("SELECT pin.*,owner.name as owner_name,owner.tel as owner_tel,owner.car_series as car_series,owner.car_color as car_color,owner.car_number_1 as car_number_1,owner.car_number_2 as car_number_2,owner.car_number_3 as car_number_3 FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.owner_id=owner.id WHERE pin.uniacid=" . $_W['uniacid'] . " AND pin.id=" . $_GPC['id']);
    $goods = pdo_fetchall("SELECT mc_member.avatar as avatar,mc_member.realname as realname,mc_member.nickname as nickname,mc_member.mobile as mobile,member.status as status FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('mc_members') . " AS mc_member ON member.uid=mc_member.uid WHERE member.owner_id=" . $_GPC['id']);
} else if ($op == 'delete_pin') {
    $member = pdo_getall('navlange_pinche_member',array('pin_id'=>$_GPC['id']));
    foreach ($member as $key => $value) {
        pdo_update('navlange_pinche_travel',array('status'=>'0'),array('id'=>$value['travel_id']));
    }
	pdo_delete('navlange_pinche_member',array('pin_id'=>$_GPC['id']));
	pdo_delete('navlange_pinche_comment',array('pin_id'=>$_GPC['id']));
	pdo_delete('navlange_pinche_pin',array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'delete_member') {
    $member = pdo_get('navlange_pinche_member',array('id'=>$_GPC['id']));
    pdo_update('navlange_pinche_travel',array('status'=>'0'),array('id'=>$member['travel_id']));
    pdo_delete('navlange_pinche_member',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('cargo');
?>