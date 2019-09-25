<?php
global $_W,$_GPC;

$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['bus_mode_name'];
    if($conf['member_on'] == '1') {
        $member_info = $this->member_info($_W['member']['uid'],$conf['member_type']);
    }
    if($conf['city_on'] == '1') {
        if($_GPC['city'] != '') {
            $city = pdo_fetch("SELECT prov,city FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " AND city='" . $_GPC['city'] . "'");
            $_SESSION['prov'] = $city['prov'];
            $_SESSION['city'] = $city['city'];
        } else {
            if(!$_SESSION['city'] || !$_SESSION['prov']) {
                $city = pdo_fetch("SELECT prov,city FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY is_default DESC");
                $_SESSION['prov'] = $city['prov'];
                $_SESSION['city'] = $city['city'];
            }
        }
        if($_GPC['district'] != '') {
            $_SESSION['district'] = $_GPC['district'];
        } else {
            if(!$_SESSION['district']) {
                $_SESSION['district'] = '全城';
            }
        }
        $alphabetical = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        $all_city = array();
        foreach ($alphabetical as $key => $value) {
            $city = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_city') . " WHERE uniacid=" . $_W['uniacid'] . " AND alphabetical_index='" . $value . "'");
            if(count($city) > 0) {
                $data = array();
                $data['alphabetical_index'] = $value;
                $data['city'] = $city;
                array_push($all_city,$data);
            }
        }
    }
    $banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='todo_index'");
    $menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
    $general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
    $sql = "SELECT * FROM " . tablename('navlange_pinche_bus_line') . " WHERE uniacid=" . $_W['uniacid'];
    if($conf['city_on'] == '1') {
        $sql .= " AND departure_city='" . $_SESSION['city'] . "'";
        if($_SESSION['district'] != '全城') {
            $sql .= " AND departure_district='" . $_SESSION['district'] . "'";
        }
    }
    $line = pdo_fetchall($sql);
    $line_info = array();
    foreach ($line as $key => $value) {
        $data = $value;
        $data['owner'] = pdo_fetchall("SELECT owner.id as id,mc_member.avatar as avatar,owner.credit_score as credit_score,owner.car_number_1 as car_number_1,owner.car_number_2 as car_number_2,owner.car_number_3 as car_number_3,owner.name as name,owner.tel as tel FROM " . tablename('navlange_pinche_bus_line_owner') . " AS line_owner LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON line_owner.owner_id=owner.id LEFT JOIN " . tablename('mc_members') . " AS mc_member ON owner.uid=mc_member.uid WHERE line_owner.bus_line_id=" . $value['id'] . " AND owner.working_on='1'");
        $data['station'] = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_bus_line_station') . " WHERE bus_line_id=" . $value['id'] . " ORDER BY order_index");
        array_push($line_info,$data);
    }
    $user_info = mc_fetch($_W['member']['uid']);
    $note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='travel'");
} else if ($op == 'register_submit') {
    $travel['uniacid'] = $_W['uniacid'];
    $travel['openid'] = $_W['openid'];
    $travel['uid'] = mc_openid2uid($_W['openid']);
    $travel['bus_line'] = $_GPC['line_id'];
    $bus_line = pdo_fetch("SELECT departure_station,terminal_station,departure_time FROM " . tablename('navlange_pinche_bus_line') . " WHERE id=" . $_GPC['line_id']);
    $travel['departure_station'] = $bus_line['departure_station'];
    $travel['terminal_station'] = $bus_line['terminal_station'];
    $travel['departure_time'] = strtotime($_GPC['date']);
    $travel['name'] = $_GPC['name'];
    $travel['mobile'] = $_GPC['mobile'];
    $travel['amount'] = $_GPC['amount'];
    $travel['release_time'] = time();
    $travel['status'] = '0';
    $travel['type'] = '4';
    pdo_insert('navlange_pinche_travel',$travel);
    message(error(0,date('Y-m-d',strtotime($_GPC['date']))),'','ajax');
} else if ($op == 'reserve') {
    $line = pdo_fetch("SELECT departure_station,departure_city,departure_district,departure_lng,departure_lat,terminal_station,terminal_city,terminal_district,terminal_lng,terminal_lat,departure_time,boarding_place,price FROM " . tablename('navlange_pinche_bus_line') . " WHERE id=" . $_GPC['line_id']);
    $pin['line_id'] = $_GPC['line_id'];
    $pin['departure_time'] = strtotime(date('Y-m-d',TIMESTAMP) . " " . $line['departure_time']);
    $pin['owner_id'] = $_GPC['owner_id'];
    $is_exist = pdo_get("navlange_pinche_pin",$pin);
    if(empty($is_exist)) {
        $owner = pdo_get('navlange_pinche_owner',array('id'=>$_GPC['owner_id']));
        $pin['openid'] = $owner['openid']; 
        $pin['uid']  = $owner['uid'];
        $pin['owner_id'] = $owner['id'];
        $pin['car_number'] = $owner['car_number_1'] . $owner['car_number_2'] . $owner['car_number_3'];
        $pin['car_series'] = $owner['car_series'];
        $pin['car_color'] = $owner['car_color'];
        $pin['departure_city'] = $line['departure_city'];
        $pin['departure_district'] = $line['departure_district'];
        $pin['departure_station'] = $line['departure_station'];
        $pin['terminal_city'] = $line['terminal_city'];
        $pin['terminal_district'] = $line['terminal_district'];
        $pin['terminal_station'] = $line['terminal_station'];
        $pin['boarding_place'] = $line['boarding_place'];
        $pin['lng'] = $line['departure_lng'];
        $pin['lat'] = $line['departure_lat'];
        $pin['price'] = $line['price'];
        $pin['passenger_count'] = 5;
        $pin['left_amount'] = 5;
        $pin['pined_amount'] = 0;
        $pin['note'] = '';
        $pin['uniacid'] = $_W['uniacid'];
        $pin['release_time'] = TIMESTAMP;
        $pin['status'] = '0';
        $pin['type'] = '4';
        $pin['stations'] = '';
        pdo_insert('navlange_pinche_pin',$pin);
        $pin_id = pdo_insertid('navlange_pinche_pin');
    } else {
        $pin = $is_exist;
        $pin_id = $is_exist['id'];
    }
    $client['uniacid'] = $_W['uniacid'];
    $client['uid'] = $_W['member']['uid'];
    $is_exist = pdo_get("navlange_pinche_client",$client);
    if(empty($is_exist)) {
        $this->register_passenger($_W['member']['uid'],$_W['openid']);
    }
    $new_travel['departure_station'] = $pin['departure_station'];
    $new_travel['departure_city'] = $pin['departure_city'];
    $new_travel['departure_district'] = $pin['departure_district'];
    $new_travel['terminal_station'] = $pin['terminal_station'];
    $new_travel['terminal_city'] = $pin['terminal_city'];
    $new_travel['terminal_district'] = $pin['terminal_district'];
    $new_travel['departure_time'] = $pin['departure_time'];
    $new_travel['lng'] = $line['departure_lng'];
    $new_travel['lat'] = $line['departure_lat'];
    $new_travel['terminal_lng'] = $line['terminal_lng'];
    $new_travel['terminal_lat'] = $line['terminal_lat'];
    $new_travel['name'] = $_GPC['name'];
    $new_travel['mobile'] = $_GPC['mobile'];
    $new_travel['amount'] = $_GPC['amount'];
    $new_travel['boarding_place'] = $pin['boarding_place'];
    $new_travel['uid'] = $_W['member']['uid'];
    $new_travel['expected_price'] = $pin['price']*$_GPC['amount'];
    $new_travel['openid'] = $_W['openid'];
    $new_travel['uniacid'] = $_W['uniacid'];
    $new_travel['release_time'] = TIMESTAMP;
    $new_travel['status'] = '1';
    $new_travel['type'] = '4';
    $new_travel['note'] = $_GPC['note'];
    pdo_insert('navlange_pinche_travel',$new_travel);
    $travel_id = pdo_insertid('navlange_pinche_travel');
    $new_member['uid'] = $new_travel['uid'];
    $new_member['passenger_amount'] = $new_travel['amount'];
    $new_member['openid'] = $_W['openid'];
    $new_member['owner_id'] = $pin['owner_id'];
    $new_member['pin_id'] = $pin_id;
    $new_member['travel_id'] = $travel_id;
    $new_member['pin_time'] = TIMESTAMP;
    $new_member['status'] = '0';
    $new_member['uniacid'] = $_W['uniacid'];
    $new_member['type'] = '1';
    $sn_prefix = date('YmdHis',$new_member['pin_time']);
    $pin_count = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_member') . " WHERE sn LIKE '" . $sn_prefix . "%'");
    $pin_count = count($pin_count)+1;
    if($pin_count < 10) {
        $pin_sn_suffix = '0000' . $pin_count;
    } else if ($pin_count < 100) {
        $pin_sn_suffix = '000' . $pin_count;
    } else if ($pin_count < 1000) {
        $pin_sn_suffix = '00' . $pin_count;
    } else if ($pin_count < 10000) {
        $pin_sn_suffix = '0' . $pin_count;
    }
    $new_member['sn'] = $sn_prefix . $pin_sn_suffix;
    $new_member['price'] = $pin['price']*$_GPC['amount'];
    pdo_insert('navlange_pinche_member',$new_member);
    $member_id = pdo_insertid();
    $this->travel_join_pin_success($travel_id,$pin_id);
    $this->join_pin_notify($member_id);
    message(error(0,$travel_id),'','ajax');
}
    
include $this->template('bus');
?>