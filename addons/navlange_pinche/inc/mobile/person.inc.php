<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = '个人中心';
	$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
	$marketing_conf = pdo_fetch("SELECT coupon_on,fx_on FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$item_count = 6;
	if($marketing_conf['coupon_on'] == '1') {
		$item_count += 1;
	}
	if($marketing_conf['fx_on'] == '1') {
		$item_count += 1;
	}
	$empty_item_count = 3-($item_count % 3);
	$empty_item = array();
	for($i = 0; $i < $empty_item_count; $i++) {
		array_push($empty_item,$i);
	}
	$mc_member = pdo_fetch("SELECT avatar,credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
	if($conf['member_on'] == '1') {
	    $member = $this->member_info($_W['member']['uid'],$conf['member_type']);
	}
	$to_travel = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND (status='0' OR status='1' OR status='3' OR status='4') AND openid='" . $_W['openid'] . "'");
	$owner_pin = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_pin') . " WHERE uid=" . $_W['member']['uid'] . " AND (status='0' OR status='1')");
	$recharge_package_on = pdo_fetchcolumn("SELECT recharge_package_on FROM " . tablename('navlange_pay_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$is_owner = pdo_fetch("SELECT status,credit_score,total_income,withdrawed_income,working_on FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
	$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
	$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
} else if ($op == 'switch_working') {
	$owner = pdo_fetch("SELECT working_on FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
	$owner['working_on'] = $owner['working_on'] == '1' ? '0' : '1';
	pdo_update('navlange_pinche_owner',$owner,array('uid'=>$_W['member']['uid']));
	message(error(0,''),'','ajax');
}

include $this->template('person');
?>