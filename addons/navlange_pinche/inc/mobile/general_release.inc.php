<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '拼车发布';
$conf = pdo_fetch("SELECT color,owner_color,pin_mode_on,fast_mode_on,cargo_mode_on,pin_release_travel_note,pin_release_pin_note,fast_release_travel_note,cargo_release_travel_note,cargo_release_pin_note FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
include $this->template('general_release');
?>