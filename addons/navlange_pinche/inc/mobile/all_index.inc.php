<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = '首页';
	$conf = pdo_fetch("SELECT color,owner_color,pin_display_days_before,multi_pin_compete_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='all_index'");
	$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
	$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
	$params[':uniacid'] = $_W['uniacid'];
	$params[':time'] = time()-$conf['pin_display_days_before']*24*60*60;
	$sql_fixed = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=:uniacid" . " AND type='1' AND departure_time>:time AND (status='0') AND is_fixed='1' AND fixed_expire>=" . time() . " ORDER BY fixed_release_time DESC";
	$pin_fixed = pdo_fetchall($sql_fixed,$params);
	$sql_stick = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=:uniacid" . " AND type='1' AND departure_time>:time AND (status='0') AND (is_fixed='0' OR (is_fixed='1' AND fixed_expire<" . time() . ")) AND is_stick='1' AND stick_expire>=" . time() . " ORDER BY stick_release_time DESC";
	$pin_stick = pdo_fetchall($sql_stick,$params);
	$sql_general = "SELECT * FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=:uniacid" . " AND type='1' AND departure_time>:time AND (status='0') AND (is_fixed='0' OR (is_fixed='1' AND fixed_expire<" . time() . ")) AND (is_stick='0' OR (is_stick='1' AND stick_expire<" . time() . "))" . " ORDER BY release_time DESC";
	$pin_general = pdo_fetchall($sql_general,$params);
	$pin = array_merge($pin_fixed,$pin_stick,$pin_general);

	if($conf['multi_pin_compete_on'] == '0') {
        $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1' AND departure_time>:time AND status='0' ORDER BY release_time DESC";
    } else if ($conf['multi_pin_compete_on'] == '1') {
        $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1' AND departure_time>:time AND (status='0' OR status='1') ORDER BY release_time DESC";
    }
    $params = array();
    $params[':time'] = time()-$conf['pin_display_days_before']*24*60*60;
    $travel = pdo_fetchall($sql,$params);
}

include $this->template('all_index');
?>