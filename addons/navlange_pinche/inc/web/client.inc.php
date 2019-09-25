<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $client = pdo_fetchall("SELECT client.*,mc_member.avatar as avatar,mc_member.nickname as nickname,mc_member.realname as realname,mc_member.mobile as mobile FROM " . tablename('navlange_pinche_client') . " AS client LEFT JOIN " . tablename('mc_members') . " AS mc_member ON client.uid=mc_member.uid WHERE client.uniacid='" . $_W['uniacid'] . "' ORDER BY register_time DESC");
} else if ($op == 'change_credit') {
    pdo_update('navlange_pinche_client',array('credit_score'=>$_GPC['credit_score']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'delete_client') {
    pdo_delete('navlange_pinche_client',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}

include $this->template('client');
?>