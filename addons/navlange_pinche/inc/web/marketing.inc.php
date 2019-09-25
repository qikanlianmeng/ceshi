<?php
global $_W,$_GPC;
$marketing_conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
if(empty($marketing_conf)) {
    pdo_insert('navlange_pinche_marketing_conf',array('uniacid'=>$_W['uniacid']));
    $marketing_conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
}
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'first_order';
if ($op == 'first_order') {
    if(checksubmit()) {
        $conf['first_order_free'] = ($_GPC['first_order_free'] == '1') ? '1' : '0';
        $conf['first_order_discount'] = $_GPC['first_order_discount'];
        $conf['first_order_discount_min_consumption'] = $_GPC['first_order_discount_min_consumption'];
        pdo_update('navlange_pinche_marketing_conf',$conf,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
} else if ($op == 'first_order_on_control') {
    pdo_update('navlange_pinche_marketing_conf',array('first_order_on'=>$_GPC['status']),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'coupon') {
    $coupon_list = pdo_fetchall("SELECT id,name,min_consumption FROM " . tablename('navlange_coupon') . " WHERE uniacid=" . $_W['uniacid']);
    $sel_coupon = json_decode($marketing_conf['coupon'],true);
} else if ($op == 'coupon_config') {
    $coupon_list = pdo_fetchall("SELECT id FROM " . tablename('navlange_coupon') . " WHERE uniacid=" . $_W['uniacid']);
    $coupon_conf = array();
    foreach ($coupon_list as $key => $value) {
        $coupon_conf[$value['id']] = $_GPC['status'][$key] == '1' ? '1' : '0';
    }
    pdo_update('navlange_pinche_marketing_conf',array('coupon'=>json_encode($coupon_conf)),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'coupon_control') {
    pdo_update('navlange_pinche_marketing_conf',array('coupon_on'=>$_GPC['status']),array('uniacid'=>$_W['uniacid']));
    message(error(0,'','ajax'));
} else if ($op == 'fx') {
    if(checksubmit()) {
        $data['fx_on'] = ($_GPC['fx_on'] == '1') ? '1' : '0';
        pdo_update('navlange_pinche_marketing_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    $fx_module = pdo_fetch("SELECT mid FROM " . tablename('modules') . " WHERE name='navlange_fx'");
} else if ($op == 'partner'){
    if(checksubmit()) {
        $data['partner_award_mode'] = $_GPC['partner_award_mode'];
        $data['partner_award_money'] = $_GPC['partner_award_money'];
        $data['partner_award_ratio'] = $_GPC['partner_award_ratio'];
        pdo_update('navlange_pinche_marketing_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
} else if ($op == 'integral') {
    if(checksubmit()) {
        $data['owner_release_pin_integral'] = $_GPC['owner_release_pin_integral'];
        $data['owner_release_pin_integral_per_day'] = $_GPC['owner_release_pin_integral_per_day'];
        $data['owner_pin_success_integral'] = $_GPC['owner_pin_success_integral'];
        $data['owner_pin_success_integral_per_day'] = $_GPC['owner_pin_success_integral_per_day'];
        $data['passenger_share_integral'] = $_GPC['passenger_share_integral'];
        $data['passenger_share_integral_per_day'] = $_GPC['passenger_share_integral_per_day'];
        pdo_update('navlange_pinche_marketing_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
} else if($op == 'pin_fixed') {
    $conf = pdo_fetch("SELECT pin_fixed_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    if($conf['pin_fixed_on'] == '1') {
        $package = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_pin_fixed_package') . " WHERE uniacid=" . $_W['uniacid']);
    }
} else if ($op == 'pin_fixed_control') {
    pdo_update('navlange_pinche_conf',array('pin_fixed_on'=>$_GPC['status']),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'add_pin_fixed') {
    if(checksubmit('add_submit')) {
        $data['period'] = $_GPC['period'];
        $data['price'] = $_GPC['price'];
        $data['uniacid'] = $_W['uniacid'];
        pdo_insert('navlange_pinche_pin_fixed_package',$data);
        message('添加成功！',$this->createWeburl('marketing',array('op'=>'pin_fixed')),'success');
    }
} else if ($op == 'delete_pin_fixed_package') {
    pdo_delete('navlange_pinche_pin_fixed_package',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if($op == 'pin_stick') {
    $conf = pdo_fetch("SELECT pin_stick_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    if($conf['pin_stick_on'] == '1') {
        $package = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_pin_stick_package') . " WHERE uniacid=" . $_W['uniacid']);
    }
} else if ($op == 'pin_stick_control') {
    pdo_update('navlange_pinche_conf',array('pin_stick_on'=>$_GPC['status']),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'add_pin_stick') {
    if(checksubmit('add_submit')) {
        $data['period'] = $_GPC['period'];
        $data['price'] = $_GPC['price'];
        $data['uniacid'] = $_W['uniacid'];
        pdo_insert('navlange_pinche_pin_stick_package',$data);
        message('添加成功！',$this->createWeburl('marketing',array('op'=>'pin_stick')),'success');
    }
} else if ($op == 'delete_pin_stick_package') {
    pdo_delete('navlange_pinche_pin_stick_package',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'owner') {
    if(checksubmit('award_submit')) {
        $data['owner_award_mode'] = $_GPC['owner_award_mode'];
        $data['owner_fixed_award_money'] = $_GPC['owner_fixed_award_money'];
        $data['owner_award_ratio'] = $_GPC['owner_award_ratio'];
        pdo_update('navlange_pinche_marketing_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    if(checksubmit('invite_award_submit')) {
        $data['invite_award_mode'] = $_GPC['invite_award_mode'];
        $data['inviter_award_ratio_from_order'] = $_GPC['inviter_award_ratio_from_order'];
        pdo_update('navlange_pinche_marketing_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $delta_member_level = pdo_fetchall("SELECT id,name FROM " . tablename('navlange_member_level') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1'");
    if(!$marketing_conf['owner_classify']) {
        foreach ($delta_member_level as $key => $value) {
            $delta[$value['id']] = 0;
        }
        $delta[0] = 0;
        pdo_update('navlange_pinche_marketing_conf',array('owner_classify'=>json_encode($delta)),array('uniacid'=>$_W['uniacid']));
    } else {
        $delta = json_decode($marketing_conf['owner_classify'],true);
    }
} else if ($op == 'owner_classify_on_control') {
    pdo_update('navlange_pinche_marketing_conf',array('owner_classify_on'=>$_GPC['status']),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'update_classify') {
    pdo_update('navlange_pinche_marketing_conf',array('owner_classify'=>json_encode($_GPC['delta'])),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
}
include $this->template('marketing');
?>