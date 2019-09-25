<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '确认支付';
    $travel = pdo_get('navlange_pinche_travel',array('id'=>$_GPC['id']));
    /*if($travel['status'] != '1') {
        header("Location: " . $this->createMobileurl('my_travel'));
    }*/
    $member = pdo_fetchall("SELECT member.id as id, owner.car_series as car_series,owner.car_color as car_color,owner.car_number_1 as car_number_1,owner.car_number_2 as car_number_2,owner.car_number_3 as car_number_3,owner.name as owner_name,owner.tel as owner_tel, pin.passenger_count as passenger_count,pin.price as price FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('navlange_pinche_pin') . " AS pin ON member.pin_id=pin.id LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.owner_id=owner.id WHERE member.travel_id=" . $_GPC['id']);
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'confirm') {
    $res = get_price($_GPC['member_id']);
    if($_GPC['pay_mode'] == '9') {
        $pin = pdo_fetch("SELECT pin.id as id,pin.type as type FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_member') . " AS member ON pin.id=member.pin_id WHERE member.id=" . $_GPC['member_id']);
        pdo_update('navlange_pinche_travel',array('status'=>'4'),array('id'=>$_GPC['travel_id']));
        pdo_update('navlange_pinche_member',array('status'=>'4','pay_mode'=>$_GPC['pay_mode'],'payed_money'=>$res['discount_price']),array('id'=>$_GPC['member_id']));
        pdo_delete('navlange_pinche_member',array('travel_id'=>$_GPC['travel_id'],'status'=>'0'));
        $this->travel_join_pin_success($_GPC['travel_id'],$pin['id']);
        message(error(0,''),'','ajax');
    } else if ($_GPC['pay_mode'] == '0' || $res['to_pay']==0) {
        $mc_member = pdo_fetch("SELECT credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
        if($mc_member['credit3'] < $res['discount_price']) {
            message(error(1,'余额不足'),'','ajax');
        } else {
            $mc_member['credit3'] = $mc_member['credit3'] - $res['discount_price'];
            pdo_update('mc_members',$mc_member,array('uid'=>$_W['member']['uid']));
            $credit3_record['generate_time'] = TIMESTAMP;
            $credit3_record['uniacid'] = $_W['uniacid'];
            $credit3_record['mode'] = '1';
            $credit3_record['desc'] = '拼车付款';
            $credit3_record['status'] = '0';
            $credit3_record['money'] = $res['discount_price'];
            $credit3_record['openid'] = $_W['openid'];
            $credit3_record['uid'] = $_W['member']['uid'];
            pdo_insert('navlange_pinche_credit3_record',$credit3_record);
            $pin = pdo_fetch("SELECT pin.id as id,pin.type as type FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_member') . " AS member ON pin.id=member.pin_id WHERE member.id=" . $_GPC['member_id']);
            if($pin['type']!='2') {
                pdo_update('navlange_pinche_travel',array('status'=>'4'),array('id'=>$_GPC['travel_id']));
                pdo_update('navlange_pinche_member',array('status'=>'4','pay_mode'=>$_GPC['pay_mode'],'payed_money'=>$res['discount_price']),array('id'=>$_GPC['member_id']));
                pdo_delete('navlange_pinche_member',array('travel_id'=>$_GPC['travel_id'],'status'=>'0'));
                $this->pay_notify($_GPC['member_id']);
            } else {
                pdo_update('navlange_pinche_travel',array('status'=>'7'),array('id'=>$_GPC['travel_id']));
                pdo_update('navlange_pinche_member',array('status'=>'7','pay_mode'=>$_GPC['pay_mode'],'payed_money'=>$res['discount_price']),array('id'=>$_GPC['member_id']));
                $this->confirm_arrival($_GPC['member_id']);
            }
            message(error(0,$pin['type']),'','ajax');
        }
    } else if ($_GPC['pay_mode'] == '1') {
        $member = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_member') . " WHERE id=" . $_GPC['member_id']);
        $params = array(
            'tid' => $member['pay_tid'],      //充值模块中的订单号，此号码用于业务模块中区分订单，交易的识别码
            'ordersn' => $member['sn'],  //收银台中显示的订单号
            'title' => '拼车付款：' . $res['to_pay'] . '元',          //收银台中显示的标题
            'fee' => $res['to_pay'],      //收银台中显示需要支付的金额,只能大于 0
            'user' => $_W['openid'],     //付款用户, 付款的用户名(选填项)
            'module' => $this->module['name'],
        );
        $log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $this->module['name'], 'tid' => $params['tid']));
        //在pay方法中，要检测是否已经生成了paylog订单记录，如果没有需要插入一条订单数据
        //未调用系统pay方法的，可以将此代码放至自己的pay方法中，进行漏洞修复
        if (empty($log)) {
            $log = array(
                'uniacid' => $_W['uniacid'],
                'acid' => $_W['acid'],
                'openid' => $_W['openid'],
                'module' => $this->module['name'], //模块名称，请保证$this可用
                'tid' => $params['tid'],
                'fee' => $params['fee'],
                'card_fee' => $params['fee'],
                'status' => '0',
                'is_usecard' => '0',
            );
            pdo_insert('core_paylog', $log);
        }
        $reply['params'] = base64_encode(json_encode($params));
        message(error(2,$reply),'','ajax');
    }
} else if ($op == 'get_price') {
    $res = get_price($_GPC['member_id']);
    message(error(0,$res),'','ajax');
}
$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
include $this->template('confirm');

function get_price($member_id) {
    global $_W;
    $member = pdo_get('navlange_pinche_member',array('id'=>$member_id));
    $passenger_count = pdo_fetchcolumn("SELECT amount FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $member['travel_id']);
    $discount_price = $member['price']*$passenger_count;
    $marketing_conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $is_first_order = '0';
    if($marketing_conf['first_order_on'] == '1') {
        $legal_order = pdo_fetch("SELECT id FROM " . tablename('navlange_pinche_member') . " WHERE status<>'0' AND status<>'1' AND status<>'10' AND openid='" . $_W['openid'] . "'");
        if(empty($legal_order)) {
            if($marketing_conf['first_order_free'] == '1') {
                $discount_price = 0;
                $is_first_order = '1';
                $is_free = '1';
            } else if($discount_price>$marketing_conf['first_order_discount'] && $discount_price>=$marketing_conf['first_order_discount_min_consumption']) {
                $discount_price = $discount_price - $marketing_conf['first_order_discount'];
                $is_first_order = '1';
                $is_free = '0';
            }
        }
    }
    if($is_first_order == '0') {
        $conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
        if($conf['member_on'] == '1') {
            $uid = mc_openid2uid($_W['openid']);
            $qc_member = pdo_fetch("SELECT member.level_id as level_id FROM " . tablename('navlange_member') . " AS member LEFT JOIN " . tablename('navlange_member_level') . " AS level ON member.level_id=level.id WHERE member.uid=:uid AND level.type=:type",array(':uid'=>$uid,':type'=>'0'));
            if(empty($qc_member) || (!empty($qc_member) && $qc_member['is_permanent'] == '0' && $qc_member['expire']<=time())) {
                $level = pdo_get('navlange_member_level',array('type'=>$type,'is_default'=>'1'));
            } else {
                $level = pdo_get('navlange_member_level',array('id'=>$qc_member['level_id']));
            }
            $member_info['level'] = $level['name'];
            $member_info['type'] = $type;
            $member_info['level_id'] = $level['id'];
            $member_info['discount'] = $level['discount'];
            if($member_info['discount'] != '' && $member_info['discount'] > 0) {
                $discount_price = number_format($discount_price*$member_info['discount'],2);
            }
        }
    }
    $pay_conf = pdo_get('navlange_pay_conf',array('uniacid'=>$_W['uniacid']));
    if(!empty($pay_conf) && $pay_conf['debug'] == '1' && $discount_price > 0) {
        $to_pay = $pay_conf['debug_money'];
    } else {
        $to_pay = $discount_price;
    }
    $res['price'] = $member['price']*$passenger_count;
    $res['discount_price'] = $discount_price;
    $res['is_free'] = $is_free;
    $res['is_first_order'] = $is_first_order;
    $res['to_pay'] = $to_pay;
    $res['member_info'] = $member_info;
    return $res;
}
?>