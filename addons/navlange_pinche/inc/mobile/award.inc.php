<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '奖励';
$conf = pdo_fetch("SELECT color,withdraw_min FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$partner = pdo_fetch("SELECT id FROM " . tablename('navlange_partner') . " WHERE uid=" . $_W['member']['uid']);
$owner = pdo_fetch("SELECT status FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if($op == 'index') {
	if(!empty($partner)) {
		$op = 'partner';
	} else if (!empty($owner)) {
		$op = 'owner';
	}
}
if($op == 'partner') {
	$record = pdo_fetchall("SELECT award.generate_time as generate_time,award.money as money,award.status as status,award.desc as description FROM " . tablename('navlange_partner_award_record') . " AS award LEFT JOIN " . tablename('mc_members') . " AS mc_member ON award.pre=mc_member.uid WHERE award.pre=" . $_W['member']['uid'] . " ORDER BY generate_time DESC");
} else if ($op == 'owner') {
	$record = pdo_fetchall("SELECT award.generate_time as generate_time,award.money as money,award.status as status,award.desc as description FROM " . tablename('navlange_pinche_credit4_record') . " AS award LEFT JOIN " . tablename('mc_members') . " AS mc_member ON award.uid=mc_member.uid WHERE award.uid=" . $_W['member']['uid'] . " ORDER BY generate_time DESC");
} else if ($op == 'withdraw') {
	global $_W,$_GPC;
    $mc_member = pdo_fetch("SELECT credit4,credit5 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
	if($mc_member['credit4'] < $_GPC['money']) {
	    message(error(1,'OVER_CREDIT'),'','ajax');
	} else {
	    $mc_member['credit4'] = $mc_member['credit4']-$_GPC['money'];
	    $mc_member['credit5'] = $mc_member['credit5']+$_GPC['money'];
        pdo_update('mc_members',$mc_member,array('uid'=>$_W['member']['uid']));
	    $pay['generate_time'] = TIMESTAMP;
	    $sn_prefix = date('YmdHis',$pay['generate_time']);
	    $pay_count = pdo_fetchall("SELECT * FROM " . tablename('navlange_enterprise_pay') . " WHERE tid LIKE '" . $sn_prefix . "%'");
	    $pay_count = count($pay_count)+1;
	    if($pay_count < 10) {
	        $pay_sn_suffix = '0000' . $pay_count;
	    } else if ($pay_count < 100) {
	        $pay_sn_suffix = '000' . $pay_count;
	    } else if ($pay_count < 1000) {
	        $pay_sn_suffix = '00' . $pay_count;
	    } else if ($pay_count < 10000) {
	        $pay_sn_suffix = '0' . $pay_count;
	    }
	    $pay['tid'] = $sn_prefix . $pay_sn_suffix;
	    $pay['uniacid'] = $_W['uniacid'];
        $pay['uid'] = $_W['member']['uid'];
	    $pay['openid'] = $_W['openid'];
	    $pay['money'] = $_GPC['money'];
	    $pay['status'] = '0';
	    pdo_insert('navlange_enterprise_pay',$pay);
        $pay['pay_tid'] = $pay['tid'];
        $pay['mode'] = '0';
        $pay['desc'] = '奖励提现：' . $_GPC['money'];
	    pdo_insert('navlange_pinche_credit4_record',$pay);
	    message(error(2,''),'','ajax');
	}
}
$mc_member = pdo_fetch("SELECT credit4 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
include $this->template('award');
?>