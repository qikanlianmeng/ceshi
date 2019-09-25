<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT core_mode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '我的出行';
    $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=:uniacid AND openid=:openid";
    $params[':uniacid'] = $_W['uniacid'];
    $params[':openid'] = $_W['openid'];
    $status = array_key_exists('status', $_GPC) ? $_GPC['status'] : '-1';
    if($status != '-1') {
        $sql .= " AND status=:status";
        $params[':status'] = $status;
    }
    $sql .= " ORDER BY release_time DESC";
    $travel = pdo_fetchall($sql,$params);
    $menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
    $general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
    $cancel_reason_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='passenger_cancel'");
} else if($op == 'cancel_travel') {
    $conf = pdo_fetch("SELECT pin_cancel_times_per_day FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $action['uniacid'] = $_W['uniacid'];
    $action['uid'] = $_W['member']['uid'];
    $action['openid'] = $_W['openid'];
    $action['date'] = strtotime(date('Y-m-d',time()));
    $is_exist = pdo_get('navlange_pinche_action',$action);
    if($conf['pin_cancel_times_per_day'] > 0 && $is_exist['total_pin_cancel_times_today'] >= $conf['pin_cancel_times_per_day']) {
        message(error(1,''),'','ajax');
    }

    $travel = pdo_fetch("SELECT amount FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
    $pin_list = pdo_fetchall("SELECT pin.id as id,pin.pined_amount as pined_amount,pin.left_amount as left_amount FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_member') . " AS member ON pin.id=member.pin_id WHERE member.travel_id=" . $_GPC['id']);
    foreach ($pin_list as $key => $pin) {
        $data['pined_amount'] = $pin['pined_amount']-$travel['amount'];
        $data['left_amount'] = $pin['left_amount']+$travel['amount'];
        pdo_update('navlange_pinche_pin',$data,array('id'=>$pin['id']));
    }

    pdo_delete('navlange_pinche_member',array('travel_id'=>$_GPC['id']));
    pdo_update('navlange_pinche_travel',array('status'=>'2'),array('id'=>$_GPC['id']));
    if(empty($is_exist)) {
        $action['total_pin_cancel_times_today'] = 1;
        pdo_insert('navlange_pinche_action',$action);
    } else {
        $action['total_pin_cancel_times_today'] = $is_exist['total_pin_cancel_times_today']+1;
        pdo_update('navlange_pinche_action',$action,array('id'=>$is_exist['id']));
    }
    message(error(0,''),'','ajax');
} else if ($op == 'get_pin') {
    $pin = pdo_fetchcolumn("SELECT pin_id FROM " . tablename('navlange_pinche_member') . " WHERE travel_id=" . $_GPC['id'] . " AND uniacid=" . $_W['uniacid']);
    message(error(0,$pin),'','ajax');
}
$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
include $this->template('my_travel');
?>