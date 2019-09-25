<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$is_owner = pdo_fetch("SELECT status FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
if(!$is_owner['status']=='1') {
    header("Location: " . $this->createMobileurl('owner_info'));
}
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT core_mode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '我的出车';
    $status = array_key_exists('status', $_GPC) ? $_GPC['status'] : '-1';
    $sql = "SELECT pin.* FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.owner_id=owner.id WHERE owner.openid='" . $_W['openid'] . "'";
    if($status != '-1') {
        $sql .= " AND pin.status='" . $status . "'";
    }
    $sql .= " ORDER BY release_time DESC";
    $pin = pdo_fetchall($sql);
    $menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
    $general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
}

include $this->template('owner_pin');
?>