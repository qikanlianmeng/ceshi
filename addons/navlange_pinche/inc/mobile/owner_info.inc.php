<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '车主认证';
    $conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
    $owner = pdo_get('navlange_pinche_owner',array('openid'=>$_W['openid']));
    if($owner['status'] == '0') {
        $note = pdo_fetch("SELECT content FROM " . tablename('navlange_pinche_owner_note') . " WHERE owner_uid=" . $_W['member']['uid'] . " ORDER BY time DESC");
    }
    include $this->template('owner_info');
} else if ($op == 'info_submit') {
    $owner['name'] = $_GPC['name'];
    $owner['tel'] = $_GPC['tel'];
    $owner['car_number_1'] = $_GPC['part_1'];
    $owner['car_number_2'] = $_GPC['part_2'];
    $owner['car_number_3'] = $_GPC['part_3'];
    $owner['car_series'] = $_GPC['car_series'];
    $owner['car_color'] = $_GPC['car_color'];
    if(!empty($_GPC['vehicle_travel_license'])) {
        $owner['vehicle_travel_license'] = $_GPC['vehicle_travel_license'];
    }
    if(!empty($_GPC['driving_license'])) {
        $owner['driving_license'] = $_GPC['driving_license'];
    }
    if(!empty($_GPC['car_img'])) {
        $owner['car_img'] = $_GPC['car_img'];
    }
    if(!empty($_GPC['insurance_img'])) {
        $owner['insurance_img'] = $_GPC['insurance_img'];
    }
    $owner['insurance_expire'] = strtotime($_GPC['insurance_expire']);
    $owner['status'] = '0';
    $owner['openid'] = $_W['openid'];
    $owner['uid'] = mc_openid2uid($_W['openid']);
    $owner['uniacid'] = $_W['uniacid'];
    $owner['credit_score'] = pdo_fetchcolumn("SELECT owner_default_credit_score FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $owner['register_time'] = TIMESTAMP;
    $owner['inviter_code'] = $_GPC['inviter_code'];
    $is_partner = pdo_fetch("SELECT uid FROM " . tablename('navlange_partner') . " WHERE invite_code='" . $_GPC['inviter_code'] . "'");
    if(!empty($is_partner)) {
        $core = pdo_fetch("SELECT id FROM " . tablename('navlange_partner_core') . " WHERE next=" . $_W['member']['uid']);
        if(empty($core)) {
            $core['uniacid'] = $_W['uniacid'];
            $core['pre'] = $is_partner['uid'];
            $core['next'] = $_W['member']['uid'];
            $core['time'] = TIMESTAMP;
            pdo_insert('navlange_partner_core',$core);
        }
    } else {
        $inviter_owner = pdo_fetch("SELECT uid FROM " . tablename('navlange_pinche_owner') . " WHERE invite_code='" . $_GPC['inviter_code'] . "'");
        if(!empty($inviter_owner)) {
            $owner['inviter_uid'] = $inviter_owner['uid'];
            $core = pdo_fetch("SELECT pre FROM " . tablename('navlange_partner_core') . " WHERE next=" . $inviter_owner['uid']);
            if(!empty($core)) {
                $new_core['uniacid'] = $_W['uniacid'];
                $new_core['pre'] = $core['pre'];
                $new_core['next'] = $_W['member']['uid'];
                $new_core['time'] = TIMESTAMP;
                pdo_insert('navlange_partner_core',$new_core);
            }
        }
    }
    pdo_insert('navlange_pinche_owner',$owner);
    $owner_id = pdo_insertid();
    $invite_code = $this->createCode($_W['member']['uid']);
    pdo_update('navlange_pinche_owner',array('invite_code'=>$invite_code),array('id'=>$owner_id));
    $platform = pdo_fetch("SELECT owner_amount FROM " . tablename('navlange_pinche_platform') . " WHERE uniacid=" . $_W['uniacid']);
    $platform_info['owner_amount'] = $platform['owner_amount']+1;
    pdo_update('navlange_pinche_platform',$platform_info,array('uniacid'=>$_W['uniacid']));
    message(error(0,''),'','ajax');
} else if ($op == 'modify') {
    $old_owner = pdo_get('navlange_pinche_owner',array('openid'=>$_W['openid']));
    $owner['name'] = $_GPC['name'];
    $owner['tel'] = $_GPC['tel'];
    $owner['car_number_1'] = $_GPC['part_1'];
    $owner['car_number_2'] = $_GPC['part_2'];
    $owner['car_number_3'] = $_GPC['part_3'];
    $owner['car_series'] = $_GPC['car_series'];
    $owner['car_color'] = $_GPC['car_color'];
    if(!empty($_GPC['vehicle_travel_license'])) {
        $owner['vehicle_travel_license'] = $_GPC['vehicle_travel_license'];
    }
    if(!empty($_GPC['driving_license'])) {
        $owner['driving_license'] = $_GPC['driving_license'];
    }
    if(!empty($_GPC['car_img'])) {
        $owner['car_img'] = $_GPC['car_img'];
    }
    if(!empty($_GPC['insurance_img'])) {
        $owner['insurance_img'] = $_GPC['insurance_img'];
    }
    $owner['insurance_expire'] = strtotime($_GPC['insurance_expire']);
    $owner['status'] = '0';
    pdo_update('navlange_pinche_owner',$owner,array('openid'=>$_W['openid']));
    message(error(0,''),'','ajax');
} else if ($op == 'cancel_bind') {
    pdo_update('navlange_pinche_owner',array('status'=>'2'),array('openid'=>$_W['openid']));
    message(error(0,$_GPC),'','ajax');
}
?>