<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '帮助中心';
$banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='todo_index'");
$conf = pdo_fetch("SELECT help_content,color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
include $this->template('help');
?>