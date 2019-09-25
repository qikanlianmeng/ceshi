<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['fast_mode_name'];
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
    $travel = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE openid='" . $_W['openid'] . "' AND type='2' AND (status='0' OR status='1' OR status='3' OR status='4')");
    $is_waiting = !empty($travel) ? '1' : '0';
    $member = pdo_fetch("SELECT id,travel_id,status FROM " . tablename('navlange_pinche_member') . " WHERE openid='" . $_W['openid'] ."' AND type='2' AND (status='4' OR status='6')");
    if(!empty($member)) {
        $is_waiting = '1';
        $need_pay = '1';
        $travel = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $member['travel_id']);
    } else {
        $need_pay = '0';
    }
} else if ($op == 'release') {
    $client['uniacid'] = $_W['uniacid'];
    $client['openid'] = $_W['openid'];
    $is_exist = pdo_get("navlange_pinche_client",$cient);
    if(empty($is_exist)) {
        $client['uid'] = mc_openid2uid($_W['openid']);
        $client['register_time'] = TIMESTAMP;
        $client['credit_score'] = pdo_fetchcolumn("SELECT client_default_credit_score FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
        pdo_insert('navlange_pinche_client',$client);
    }
    $travel['uniacid'] = $_W['uniacid'];
    $travel['openid'] = $_W['openid'];
    $fans = pdo_fetch("SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE openid='" . $_W['openid'] . "'");
    if(!empty($fans)) {
        $travel['uid'] = $fans['uid'];
    }
    $travel['departure_station'] = $_GPC['departure_station'];
    $travel['departure_city'] = $_GPC['departure_city'];
    $travel['departure_district'] = $_GPC['departure_district'];
    $travel['terminal_station'] = $_GPC['terminal_station'];
    $travel['terminal_city'] = $_GPC['terminal_city'];
    $travel['terminal_district'] = $_GPC['terminal_district'];
    $travel['lng'] = $_GPC['lng'];
    $travel['lat'] = $_GPC['lat'];
    $travel['terminal_lng'] = $_GPC['terminal_lng'];
    $travel['terminal_lat'] = $_GPC['terminal_lat'];
    $travel['is_booking'] = $_GPC['time_mode'];
    if($_GPC['time_mode'] == '0') {
        $travel['departure_time'] = TIMESTAMP;
    } else {
        $travel['departure_time'] = strtotime($_GPC['date']);
    }
    $travel['release_time'] = TIMESTAMP;
    $travel['type'] = '2';
    $travel['status'] = '0';
    $travel['amount'] = 1;
    pdo_insert('navlange_pinche_travel',$travel);
    message(error(0,''),'','ajax');
} else if ($op == 'cancel') {
    pdo_update('navlange_pinche_travel',array('status'=>'2'),array('id'=>$_GPC['id']));
    pdo_update('navlange_pinche_member',array('status'=>'2'),array('travel_id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('fast');
?>