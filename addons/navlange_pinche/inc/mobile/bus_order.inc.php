<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '专线订单';
$status = array_key_exists('status', $_GPC) ? $_GPC['status'] : '-1';
$owner = pdo_get('navlange_pinche_owner',array('uniacid'=>$_W['uniacid'],'openid'=>$_W['openid']));
$member = pdo_fetchall("SELECT member.id as id,travel.departure_station as departure_station,travel.terminal_station as terminal_station,bus_line.departure_time as departure_time,travel.date as date,travel.amount as amount,member.status as status FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('navlange_pinche_travel') . " AS travel ON member.travel_id=travel.id LEFT JOIN " . tablename('navlange_pinche_bus_line') . " AS bus_line ON travel.bus_line=bus_line.id WHERE member.owner_id=" . $owner['id'] . " AND member.type='4'");
include $this->template('bus_order');
?>