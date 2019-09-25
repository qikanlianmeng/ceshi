<?php
global $_W,$_GPC;
if(checksubmit('share_submit')) {
    $data['info_share_hint'] = $_GPC['info_share_hint'];
    $data['info_share_page_title'] = $_GPC['info_share_page_title'];
    $data['info_share_title'] = $_GPC['info_share_title'];
    $data['info_share_desc'] = $_GPC['info_share_desc'];
    if(!empty($_GPC['info_share_img'])) {
        $data['info_share_img'] = $_GPC['info_share_img'];
    }

    $data['info_share_qrcode_hint'] = $_GPC['info_share_qrcode_hint'];
    if(!empty($_GPC['info_share_qrcode'])) {
        $data['info_share_qrcode'] = $_GPC['info_share_qrcode'];
    }
    pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
    message('设置成功！','refresh','success');
}
$conf = pdo_fetch("SELECT info_share_hint,info_share_page_title,info_share_title,info_share_desc,info_share_img,info_share_qrcode_hint,info_share_qrcode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
include $this->template('share');
?>