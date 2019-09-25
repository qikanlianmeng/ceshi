<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '修改行程';
$conf = pdo_fetch("SELECT max_day_to_release FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$travel = pdo_fetch("SELECT departure_city,departure_station,terminal_city,terminal_station,amount,departure_time,note,expected_price FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
include $this->template('travel_edit_pin');
?>