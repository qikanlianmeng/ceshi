<?php
global $_W,$_GPC;
$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['bus_mode_name'];
    $owner = pdo_get('navlange_pinche_owner',array('uniacid'=>$_W['uniacid'],'openid'=>$_W['openid']));
    if($conf['release_need_license']=='1' && (empty($owner) || $owner['status']=='0')) {
        $need_check = '1';
    }
    if($conf['member_on'] == '1') {
        $member_info = $this->member_info($_W['member']['uid'],$conf['member_type']);
    }
    if(!empty($_GPC['city'])) {
        $_SESSION['city'] = pdo_fetchcolumn("SELECT city FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " AND id=" . $_GPC['city']);
    } else {
        $_SESSION['city'] = pdo_fetchcolumn("SELECT city FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_default='1'");
    }
    $alphabetical = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $all_city = array();
    foreach ($alphabetical as $key => $value) {
        $city = pdo_getall('navlange_pinche_city',array("alphabetical_index"=>$value));
        if(count($city) > 0) {
            $data = array();
            $data['alphabetical_index'] = $value;
            $data['city'] = $city;
            array_push($all_city,$data);
        }
    }
    $banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='todo_index'");
    $menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
    $general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
    $travel_info = pdo_fetchall("SELECT travel.*,bus_line.fix_departure_time as fix_departure_time FROM " . tablename('navlange_pinche_travel') . " AS travel LEFT JOIN " . tablename('navlange_pinche_bus_line') . " AS bus_line ON travel.bus_line=bus_line.id WHERE travel.uniacid=" . $_W['uniacid'] . " AND travel.type='4' AND travel.status='0'");
} else if ($op == 'pick_travel') {
    $travel = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
    $member['uniacid'] = $_W['uniacid'];
    $member['type'] = '4';
    $member['uid'] = $travel['uid'];
    $member['openid'] = $travel['openid'];
    $member['travel_id'] = $_GPC['id'];
    $member['owner_id'] = pdo_fetchcolumn("SELECT id FROM " . tablename('navlange_pinche_owner') . " WHERE uniacid=" . $_W['uniacid'] . " AND openid='" . $_W['openid'] . "'");
    $member['status'] = '3';
    $member['pin_time'] = time();
    $member['passenger_amount'] = $travel['amount'];
    $sn_prefix = date('YmdHis',$member['pin_time']);
    $pmember_count = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_member') . " WHERE sn LIKE '" . $sn_prefix . "%'");
    $pmember_count = count($pmember_count)+1;
    if($pmember_count < 10) {
        $pin_sn_suffix = '0000' . $pmember_count;
    } else if ($pmember_count < 100) {
        $pin_sn_suffix = '000' . $pmember_count;
    } else if ($pmember_count < 1000) {
        $pin_sn_suffix = '00' . $pmember_count;
    } else if ($pmember_count < 10000) {
        $pin_sn_suffix = '0' . $pmember_count;
    }
    $member['sn'] = $sn_prefix . $pin_sn_suffix;
    $pay_count = pdo_fetchall("SELECT * FROM " . tablename('core_paylog') . " WHERE tid LIKE '" . $sn_prefix . "%'");
    $pay_count = count($pay_count)+1;
    if($pay_count < 10) {
        $pay_tid_suffix = '0000' . $pay_count;
    } else if ($pay_count < 100) {
        $pay_tid_suffix = '000' . $pay_count;
    } else if ($pay_count < 1000) {
        $pay_tid_suffix = '00' . $pay_count;
    } else if ($pay_count < 10000) {
        $pay_tid_suffix = '0' . $pay_count;
    }
    $member['pay_tid'] = $sn_prefix . $pay_tid_suffix;
    $member['price'] = pdo_fetchcolumn("SELECT price FROM " . tablename('navlange_pinche_bus_line') . " WHERE id=" . $travel['bus_line']);
    pdo_insert('navlange_pinche_member',$member);
    pdo_update('navlange_pinche_travel',array('status'=>'3'),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('owner_bus');
?>