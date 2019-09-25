<?php
global $_W,$_GPC;
$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
if(empty($conf)) {
    pdo_insert('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
    $conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
}
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    if(checksubmit('system_submit')) {
        if($_GPC['platform_deduct']<0 || $_GPC['platform_deduct'] > 100) {
            message('请输入0-100之间的平台提成比例！','','error');
        }
        $data['color'] = $_GPC['color'];
        $data['owner_color'] = $_GPC['owner_color'];
        $data['bg_color'] = $_GPC['bg_color'];
        $data['car_number_display'] = ($_GPC['car_number_display'] == '1') ? '1' : '0';
        $data['comment_display_on'] = ($_GPC['comment_display_on'] == '1') ? '1' : '0';
        $data['travel_release_notify_all_owner_on'] = ($_GPC['travel_release_notify_all_owner_on'] == '1') ? '1' : '0';
        $data['platform_deduct'] = $_GPC['platform_deduct'];
        $data['owner_default_credit_score'] = $_GPC['owner_default_credit_score'];
        $data['client_default_credit_score'] = $_GPC['client_default_credit_score'];
        $data['owner_withdraw_to_mode'] = $_GPC['owner_withdraw_to_mode'];
        $data['withdraw_min'] = $_GPC['withdraw_min'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    if(checksubmit('member_submit')) {
        $data['member_on'] = ($_GPC['member_on'] == '1') ? '1' : '0';
        $data['member_type'] = $_GPC['member_type'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    if(checksubmit('pay_submit')) {
        $data['pay_mode_9_on'] = ($_GPC['pay_mode_9_on'] == '1') ? '1' : '0';
        $data['pay_mode_0_on'] = ($_GPC['pay_mode_0_on'] == '1') ? '1' : '0';
        $data['pay_mode_1_on'] = ($_GPC['pay_mode_1_on'] == '1') ? '1' : '0';
        $data['default_pay_mode'] = $_GPC['default_pay_mode'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
} else if ($op == 'mode') {
    if(checksubmit('mode_submit')) {
        $data['mode_menu_on'] = ($_GPC['mode_menu_on'] == '1') ? '1' : '0';
        $data['pin_mode_on'] = ($_GPC['pin_mode_on'] == '1') ? '1' : '0';
        $data['fast_mode_on'] = ($_GPC['fast_mode_on'] == '1') ? '1' : '0';
        $data['charter_mode_on'] = ($_GPC['charter_mode_on'] == '1') ? '1' : '0';
        $data['cargo_mode_on'] = ($_GPC['cargo_mode_on'] == '1') ? '1' : '0';
        $data['bus_mode_on'] = ($_GPC['bus_mode_on'] == '1') ? '1' : '0';
        $data['city_on'] = ($_GPC['city_on'] == '1') ? '1' : '0';
        $data['pin_mode_name'] = $_GPC['pin_mode_name'];
        $data['fast_mode_name'] = $_GPC['fast_mode_name'];
        $data['charter_mode_name'] = $_GPC['charter_mode_name'];
        $data['cargo_mode_name'] = $_GPC['cargo_mode_name'];
        $data['bus_mode_name'] = $_GPC['bus_mode_name'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
} else if ($op == 'set_core_mode') {
    $data['core_mode'] = $_GPC['mode'];
    pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'agreement') {
    if(checksubmit('agreement_submit')) {
        $data['agreement_on'] = ($_GPC['agreement_on'] == '1') ? '1' : '0';
        $data['agreement_title'] = $_GPC['agreement_title'];
        $data['agreement_content'] = $_GPC['agreement_content'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
} else if ($op == 'pin') {
    if(checksubmit('pin_submit')) {
        $data['pin_progress_mode'] = $_GPC['pin_progress_mode'];
        $data['pin_release_multi_on'] = ($_GPC['pin_release_multi_on'] == '1') ? '1' : '0';
        $data['passenger_info_available_before_pin'] = ($_GPC['passenger_info_available_before_pin'] == '1') ? '1' : '0';
        $data['owner_info_available_before_pin'] = ($_GPC['owner_info_available_before_pin'] == '1') ? '1' : '0';
        $data['release_need_license'] = ($_GPC['release_need_license'] == '1') ? '1' : '0';
        $data['pin_display_days_before'] = $_GPC['pin_display_days_before'];
        $data['max_day_to_release'] = $_GPC['max_day_to_release'];
        $data['pin_terminal_station_mode'] = $_GPC['pin_terminal_station_mode'];
        $data['pin_departure_station_mode'] = $_GPC['pin_departure_station_mode'];
        $data['pin_line_mode'] = $_GPC['pin_line_mode'];
        $data['multi_pin_compete_on'] = ($_GPC['multi_pin_compete_on'] == '1') ? '1' : '0';
        $data['multi_pin_travel_release_on'] = ($_GPC['multi_pin_travel_release_on'] == '1') ? '1' : '0';
        $data['pin_release_need_credit_score'] = $_GPC['pin_release_need_credit_score'];
        $data['pin_cancel_times_per_day'] = $_GPC['pin_cancel_times_per_day'];
        $data['need_travel_before_pin_on'] = ($_GPC['need_travel_before_pin_on'] == '1') ? '1' : '0';
        $data['use_travel_as_pin_by_default_on'] = ($_GPC['use_travel_as_pin_by_default_on'] == '1') ? '1' : '0';
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
} else if ($op == 'cargo') {
    if(checksubmit('cargo_submit')) {
        $data['cargo_line_on'] = $_GPC['cargo_line_on'] == '1' ? '1' : '0';
        $data['cargo_goods_line_mode'] = $_GPC['cargo_goods_line_mode'];
        $data['cargo_accept_price'] = $_GPC['cargo_accept_price'];
        $data['cargo_goods_type_on'] = $_GPC['cargo_goods_type_on'] == '1' ? '1' : '0';
        $data['cargo_goods_size_on'] = $_GPC['cargo_goods_size_on'] == '1' ? '1' : '0';
        $data['cargo_delivery_need_on'] = $_GPC['cargo_delivery_need_on'] == '1' ? '1' : '0';
        $data['cargo_arrival_service_on'] = $_GPC['cargo_arrival_service_on'] == '1' ? '1' : '0';
        $data['cargo_price_mode'] = $_GPC['cargo_price_mode'];
        $data['goods_pay_mode_1_on'] = $_GPC['goods_pay_mode_1_on'] == '1' ? '1' : '0';
        $data['goods_pay_mode_2_on'] = $_GPC['goods_pay_mode_2_on'] == '1' ? '1' : '0';
        $data['goods_pay_mode_3_on'] = $_GPC['goods_pay_mode_3_on'] == '1' ? '1' : '0';
        $data['cargo_deposit_mode'] = $_GPC['cargo_deposit_mode'];
        $data['cargo_note_mode'] = $_GPC['cargo_note_mode'];
        $data['goods_time_mode'] = $_GPC['goods_time_mode'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    if(checksubmit('insurance_submit')) {
        $data['name'] = $_GPC['insurance_name'];
        $data['money'] = $_GPC['insurance_money'];
        $data['uniacid'] = $_W['uniacid'];
        pdo_insert('navlange_pinche_goods_insurance',$data);
        message("添加成功！",'refresh','success');
    }
    $insurance_record = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_goods_insurance') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_insurance') {
    pdo_delete('navlange_pinche_goods_insurance',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'bus') {
    if(checksubmit('bus_submit')) {
        $data['bus_travel_release_on'] = $_GPC['bus_travel_release_on'] == '1' ? '1' : '0';
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
} else if ($op == 'wx_message') {
    if(checksubmit()) {
        $message['pin_order_notice'] = $_GPC['pin_order_notice'];
        $message['release_success'] = $_GPC['release_success'];
        $message['join_notice'] = $_GPC['join_notice'];
        $message['join_result'] = $_GPC['join_result'];
        $message['pay'] = $_GPC['pay'];
        $message['passenger_cancel'] = $_GPC['passenger_cancel'];
        $message['owner_cancel'] = $_GPC['owner_cancel'];
        $message['owner_register'] = $_GPC['owner_register'];
        pdo_update('navlange_pinche_message',$message,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    if(checksubmit('xcx_submit')) {
        $message['xcx_travel_been_accept'] = $_GPC['xcx_travel_been_accept'];
        pdo_update('navlange_pinche_message',$message,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $message = pdo_get('navlange_pinche_message',array('uniacid'=>$_W['uniacid']));
    if(empty($message)) {
        pdo_insert('navlange_pinche_message',array('uniacid'=>$_W['uniacid']));
    }
} else if ($op == 'sms') {
    if(checksubmit()) {
        $message['juhe_key'] = $_GPC['juhe_key'];
        $message['release_success_juhe_id'] = $_GPC['release_success_juhe_id'];
        $message['join_notice_juhe_id'] = $_GPC['join_notice_juhe_id'];
        $message['join_result_juhe_id'] = $_GPC['join_result_juhe_id'];
        pdo_update('navlange_pinche_message',$message,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $message = pdo_get('navlange_pinche_message',array('uniacid'=>$_W['uniacid']));
    if(empty($message)) {
        pdo_insert('navlange_pinche_message',array('uniacid'=>$_W['uniacid']));
    }
} else if ($op == 'sms_control') {
    pdo_update('navlange_pinche_message',array('sms_on'=>$_GPC['status']),array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'note') {
    if(checksubmit('travel_note_template_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'travel';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('pin_note_template_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'pin';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('passenger_cancel_reason_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'passenger_cancel';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('goods_note_template_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'goods';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('goods_delivery_need_template_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'goods_delivery_need';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('goods_arrival_service_template_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'goods_arrival_service';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('cargo_note_template_add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'cargo';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    if(checksubmit('cargo_arrival_note_template_add')) {
        $comment['content'] = $_GPC['arrival_content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['scene'] = 'cargo_arrival';
        pdo_insert('navlange_pinche_note_template',$comment);
        message('添加成功！',$this->createWeburl('conf',array('op'=>'note')),'success');
    }
    $travel_note_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'travel'));
    $pin_note_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'pin'));
    $passenger_cancel_reason_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'passenger_cancel'));
    $goods_note_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'goods'));
    $goods_delivery_need_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'goods_delivery_need'));
    $goods_arrival_service_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'goods_arrival_service'));
    $cargo_note_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'cargo'));
    $cargo_arrival_note_template = pdo_getall('navlange_pinche_note_template',array('uniacid'=>$_W['uniacid'],'scene'=>'cargo_arrival'));
} else if ($op == 'delete_note_template') {
    pdo_delete('navlange_pinche_note_template',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'use_notice') {
    if(checksubmit('use_notice')) {
        $data['use_notice'] = $_GPC['use_notice'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
} else if ($op == 'share') {
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
}

include $this->template('conf');
?>