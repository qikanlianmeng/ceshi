<?php
mc_oauth_userinfo();
global $_W,$_GPC;
$conf = pdo_fetch("SELECT color,info_share_page_title,info_share_qrcode_hint,info_share_qrcode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$_W['page']['title'] = '';
$_W['page']['sitename'] = $conf['info_share_page_title'];
$pin = pdo_get('navlange_pinche_pin',array('id'=>$_GPC['id']));
$pin_count = $this->pin_count($_GPC['id']);
$comment = pdo_getall('navlange_pinche_comment',array('pin_id'=>$_GPC['id']));
$comment_info = array();
foreach ($comment as $key => $value) {
    $wx_member = mc_fetch(mc_openid2uid($value['openid']));
    $data['nickname'] = $wx_member['nickname'];
    $data['headimgurl'] = $wx_member['avatar'];
    $data['time'] = date('m-d H:i',$value['time']);
    $item = json_decode($value['content']);
    $data['content'] = $item;
    $data['other'] = $value['other'];
    array_push($comment_info,$data);
}
$user_info = mc_fetch(mc_openid2uid($_W['openid']));
include $this->template('share');
?>