<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '订单详情';
    $owner = pdo_get('navlange_pinche_owner',array('uniacid'=>$_W['uniacid'],'openid'=>$_W['openid']));
    $member = pdo_fetch("SELECT member.id as id,member.owner_id as owner_id,travel.departure_station as departure_station,travel.terminal_station as terminal_station,bus_line.departure_time as departure_time,travel.date as date,travel.amount as amount,member.status as status FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('navlange_pinche_travel') . " AS travel ON member.travel_id=travel.id LEFT JOIN " . tablename('navlange_pinche_bus_line') . " AS bus_line ON travel.bus_line=bus_line.id WHERE member.id=" . $_GPC['id']);
} else if ($op == 'arrival') {
    $travel_id = pdo_fetchcolumn("SELECT travel_id FROM " . tablename('navlange_pinche_member') . " WHERE id=" . $_GPC['id']);
    pdo_update('navlange_pinche_travel',array('status'=>'6'),array('id'=>$travel_id));
    pdo_update('navlange_pinche_member',array('status'=>'6'),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}

include $this->template('bus_info');
?>