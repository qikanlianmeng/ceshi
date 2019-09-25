<?php
global $_W,$_GPC;
$conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$_W['page']['title'] = '';
$_W['page']['sitename'] = $conf['charter_mode_name'];
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
$banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='todo_index'");
$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
$owner = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_owner') . " WHERE uniacid=" . $_W['uniacid'] . " AND charter_on='1'");
$owner_info = array();
foreach ($owner as $key => $value) {
    $data=$value;
    $wx_info = mc_fetch($value['uid']);
    $data['avatar'] = $wx_info['avatar'];
    array_push($owner_info,$data);
}
include $this->template('charter');
?>