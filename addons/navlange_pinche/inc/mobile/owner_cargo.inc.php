<?php
global $_W,$_GPC;
$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['cargo_mode_name'];
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
    $sql = "SELECT travel.*,mc_member.avatar as avatar,mc_member.nickname as nickname,client.credit_score as credit_score FROM " . tablename('navlange_pinche_travel') . " AS travel LEFT JOIN " . tablename('mc_members') . " AS mc_member ON travel.uid=mc_member.uid LEFT JOIN " . tablename('navlange_pinche_client') . " AS client ON travel.uid=client.uid WHERE travel.uniacid=" . $_W['uniacid'] . " AND client.uniacid=" . $_W['uniacid'] . " AND travel.type='5' AND (travel.status='0' OR travel.status='9')";
    $params = array();
    if($_GPC['departure_city']) {
        $sql .= " AND travel.departure_city='" . $_GPC['departure_city'] . "'";
    }
    if($_GPC['terminal_city']) {
        $sql .= " AND travel.terminal_city='" . $_GPC['terminal_city'] . "'";
    }
    if($_GPC['departure_station']) {
        $sql .= " AND travel.departure_station LIKE '%" . $_GPC['departure_station'] . "%'";
    }
    if($_GPC['terminal_station']) {
        $sql .= " AND travel.terminal_station LIKE '%" . $_GPC['terminal_station'] . "%'";
    }
    if($marketing_conf['owner_classify_on'] == '1') {
        $member_delta = json_decode($marketing_conf['owner_classify'],true);
        $delta = $member_delta[0];
        $member_info = $this->member_info($_W['member']['uid'],'1');
        if($member_info['is_permanent'] == '1' || $member_info['expire'] >= TIMESTAMP) {
            $delta = $member_delta[$member_info['level_id']];
        }
        $delta = $delta * 60;
        $sql .= " AND travel.release_time <= " . (TIMESTAMP-$delta);
    }
    $sql .= " ORDER BY travel.release_time DESC";
    $travel = pdo_fetchall($sql,$params);
    $travel_info = array();
    $travel_legal = array();
    $travel_expired = array();
    foreach ($travel as $key => $value) {
        $data = $value;
        if($data['status']=='0' && $data['departure_time'] < TIMESTAMP) {
            pdo_update('navlange_pinche_travel',array('status'=>'9'),array('id'=>$value['id']));
            $data['status'] = '9';
        }
        if($data['status'] == '9') {
            array_push($travel_expired,$data);
        } else {
            array_push($travel_legal,$data);
        }
    }
    $travel_info = array_merge($travel_legal,$travel_expired);
} else if ($op == 'release_submit') {
    $pin['openid'] = $_W['openid'];
    $fans = pdo_fetch("SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE openid='" . $_W['openid'] . "'");
    if(!empty($fans)) {
        $pin['uid']  = $fans['uid'];
    }
    $owner = pdo_get('navlange_pinche_owner',array('openid'=>$_W['openid']));
    $pin['owner_id'] = $owner['id'];
    $pin['car_number'] = $owner['car_number_1'] . $owner['car_number_2'] . $owner['car_number_3'];
    $pin['car_series'] = $owner['car_series'];
    $pin['car_color'] = $owner['car_color'];
    $pin['departure_station'] = $_GPC['departure_station'];
    $pin['terminal_station'] = $_GPC['terminal_station'];
    $pin['departure_time'] = strtotime($_GPC['departure_time']);
    $pin['uniacid'] = $_W['uniacid'];
    $pin['release_time'] = time();
    $pin['status'] = '0';
    $pin['type'] = '4';
    pdo_insert('navlange_pinche_pin',$pin);
    $id = pdo_insertid();
    foreach ($_GPC['station'] as $key => $value) {
        $station['uniacid'] = $_W['uniacid'];
        $station['station'] = $value;
        $station['pin_id'] = $id;
        $station['order_index'] = $key+1;
        pdo_insert('navlange_pinche_pin_station',$station);
    }
    message(error(0,''),'','ajax');
} else if ($op == 'cancel_cargo') {
    pdo_update('navlange_pinche_pin',array('status'=>'2'),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('owner_cargo');
?>