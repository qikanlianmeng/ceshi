<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'set_profile') {
    $uid = mc_openid2uid($_W['openid']);
    $data['realname'] = $_GPC['realname'];
    $data['mobile'] = $_GPC['mobile'];
    pdo_update('mc_members',$data,array('uid'=>$uid));
    message(error(0,''),'','ajax');
}
$conf = pdo_fetch("SELECT color,owner_color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$mode = !empty($_GPC['mode']) ? $_GPC['mode'] : '0';
include $this->template('person_profile');
?>