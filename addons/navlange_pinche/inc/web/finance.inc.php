<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'recharge';
if($op == 'recharge') {
	$list = pdo_fetchall("SELECT recharge.id as id,member.avatar as avatar,member.nickname as nickname,member.realname as realname,recharge.money as money,recharge.status as status,recharge.generate_time as time FROM " . tablename('navlange_pinche_credit3_record') . " AS recharge LEFT JOIN " . tablename('mc_members') . " AS member ON recharge.uid=member.uid WHERE recharge.uniacid=" . $_W['uniacid'] . " AND recharge.mode='0' ORDER BY generate_time DESC");
} else if ($op == 'withdraw') {
	$list = pdo_fetchall("SELECT recharge.id as id,member.avatar as avatar,member.nickname as nickname,member.realname as realname,member.mobile as mobile,recharge.money as money,recharge.status as status,recharge.generate_time as time FROM " . tablename('navlange_pinche_credit3_record') . " AS recharge LEFT JOIN " . tablename('mc_members') . " AS member ON recharge.uid=member.uid WHERE recharge.uniacid=" . $_W['uniacid'] . " AND recharge.mode='2' ORDER BY generate_time DESC");
} else if ($op == 'pay_withdraw') {
	pdo_update('navlange_pinche_credit3_record',array('status'=>'1'),array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'award') {
	$list = pdo_fetchall("SELECT record.id as id,mc_member.avatar as avatar,mc_member.realname as realname,mc_member.nickname as nickname,record.money as money,record.desc as description,record.generate_time as generate_time,record.status as status FROM " . tablename('navlange_pinche_credit4_record') . " AS record LEFT JOIN " . tablename('mc_members') . " AS mc_member ON record.uid=mc_member.uid WHERE record.uniacid=" . $_W['uniacid'] . " AND mode<>'0' ORDER BY record.generate_time DESC");
} else if ($op == 'delete_award_record') {
	pdo_delete('navlange_pinche_credit4_record',array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'accept_award') {
	$record = pdo_fetch("SELECT uid,money FROM " . tablename('navlange_pinche_credit4_record') . " WHERE id=" . $_GPC['id']);
	$mc_member = pdo_fetch("SELECT credit4 FROM " . tablename('mc_members') . " WHERE uid=" . $record['uid']);
	$new_member['credit4'] = $mc_member['credit4'] + $record['money'];
	pdo_update('mc_members',$new_member,array('uid'=>$record['uid']));
	pdo_update('navlange_pinche_credit4_record',array('status'=>'1'),array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'award_withdraw') {
	$list = pdo_fetchall("SELECT recharge.id as id,member.avatar as avatar,member.nickname as nickname,member.realname as realname,member.mobile as mobile,recharge.money as money,recharge.status as status,recharge.generate_time as time FROM " . tablename('navlange_pinche_credit4_record') . " AS recharge LEFT JOIN " . tablename('mc_members') . " AS member ON recharge.uid=member.uid WHERE recharge.uniacid=" . $_W['uniacid'] . " AND recharge.mode='0' ORDER BY generate_time DESC");
} else if ($op == 'pay_award') {
	pdo_update('navlange_pinche_credit4_record',array('status'=>'1'),array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
}
include $this->template('finance');
?>