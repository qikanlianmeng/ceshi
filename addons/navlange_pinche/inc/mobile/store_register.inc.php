<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '商家入驻';
$conf = pdo_fetch("SELECT store_register_head_img,store_register_agreement,color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
if(checksubmit('register')) {
    if($_GPC['type']=='-1') {
        message('请选择商家类型！','refresh','error');
    } else if($_GPC['name'] == '') {
        message('请输入商店名称！','refresh','error');
    } else if ($_GPC['img_thumb'] == '') {
        message('请上传商店头像！','refresh','error');
    } else if ($_GPC['mobile'] == '') {
        message('请输入商店联系电话！','refresh','error');
    } else {
        $data['uniacid'] = $_W['uniacid'];
        $data['type'] = $_GPC['type'];
        $data['uid'] = $_W['member']['uid'];
        $data['openid'] = $_W['openid'];
        $data['name'] = $_GPC['name'];
        $data['prov'] = $_GPC['prov'];
        $data['city'] = $_GPC['city'];
        $data['district'] = $_GPC['district'];
        $data['address'] = $_GPC['address'];
        $data['scale'] = $_GPC['scale'];
        $data['mobile'] = $_GPC['mobile'];
        $data['img'] = $_GPC['img_thumb'];
        $data['intro'] = $_GPC['intro'];
        $data['register_time'] = time();
        $data['status'] = '0';
        pdo_insert('navlange_pinche_store',$data);
        $id = pdo_insertid();
        if($id<10) {
            $sn = '00000' . $id;
        } else if ($id < 100) {
            $sn = '0000' . $id;
        } else if ($id < 1000) {
            $sn = '000' . $id;
        } else if ($id < 10000) {
            $sn = '00' . $id;
        } else if ($id < 100000) {
            $sn = '0' . $id;
        } else {
            $sn = $id;
        }
        $sn = 'PC' . $sn;
        pdo_update('navlange_pinche_store',array('sn'=>$sn),array('id'=>$id));
        $last_store = pdo_fetch("SELECT order_index FROM " . tablename('navlange_pinche_store') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY order_index DESC");
        if($last_store['order_index'] >= 0) {
            $order_index = $last_store['order_index'] + 1;
        } else {
            $order_index = 0;
        }
        pdo_update('navlange_pinche_store',array('order_index'=>$order_index),array('id'=>$id));
        message('申请提交成功！','refresh','success');
    }
}
$store = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_store') . " WHERE uid=" . $_W['member']['uid']);
include $this->template('store_register');
?>