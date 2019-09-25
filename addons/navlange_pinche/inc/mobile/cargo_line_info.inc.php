<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '专线详情';
$line = pdo_fetch("SELECT name,departure_prov,departure_city,departure_district,departure_station,terminal_prov,terminal_city,terminal_district,terminal_station,stations_str,price_per_f,price_per_d,price_include_tax,note,start_tel,start_name,start_mobile,arrival_note,arrival_tel,arrival_name,arrival_mobile FROM " . tablename('navlange_pinche_line') . " WHERE id=" . $_GPC['id']);
include $this->template('cargo_line_info');
?>