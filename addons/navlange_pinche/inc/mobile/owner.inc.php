<?php
global $_W;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '司机中心';
$conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
if($conf['member_on'] == '1') {
    $member = $this->member_info($_W['member']['uid'],$conf['member_type']);
}
$to_travel = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_pin') . " WHERE uniacid=" . $_W['uniacid'] . " AND status='0' AND uid=" . mc_openid2uid($_W['openid']));
$credit_score = pdo_fetchcolumn("SELECT credit_score FROM " . tablename('navlange_pinche_owner') . " WHERE openid='" . $_W['openid'] . "'");
include $this->template('owner');
?>