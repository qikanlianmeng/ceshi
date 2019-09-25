<?php
global $_W,$_GPC;
$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['fast_mode_name'];
    $owner = pdo_get('navlange_pinche_owner',array('openid'=>$_W['openid']));
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
    $travel = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='2' AND status='0'" . " ORDER BY departure_time DESC");
    $travel_info = array();
    foreach ($travel as $key => $value) {
        if(!empty($owner)) {
            $member = pdo_fetch("SELECT member.* FROM " . tablename('navlange_pinche_member') . " AS member LEFT JOIN " . tablename('navlange_pinche_pin') . " AS pin ON member.pin_id=pin.id WHERE member.travel_id=" . $value['id'] . " AND pin.owner_id=" . $owner['id']);
        }
        if(empty($member) || empty($owner)) {
            $data = $value;
            load()->model('mc');
            $uid = mc_openid2uid($value['openid']);
            $user = mc_fetch($uid);
            $data['nickname'] = $user['nickname'];
            $data['headimgurl'] = $user['avatar'];
            array_push($travel_info,$data);
        }
    }
} else if ($op == 'pin') {
    $travel = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE id=" . $_GPC['id']);
    $pin['uniacid'] = $_W['uniacid'];
    $fan = pdo_fetch("SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE openid='" . $_W['openid'] . "'"); 
    if(!empty($fan)) {
        $pin['uid'] = $fan['uid'];
    }
    $pin['openid'] = $_W['openid'];
    $pin['departure_station'] = $travel['departure_station'];
    $pin['departure_city'] = $travel['departure_city'];
    $pin['departure_district'] = $travel['departure_district'];
    $pin['terminal_station'] = $travel['terminal_station'];
    $pin['terminal_city'] = $travel['terminal_city'];
    $pin['terminal_district'] = $travel['terminal_district'];
    $pin['type'] = '2';
    $owner = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_owner') . " WHERE openid='" . $_W['openid'] . "'");
    $pin['owner_id'] = $owner['id'];
    $pin['car_number'] = $owner['car_number_1'] . $owner['car_number_2'] . $owner['car_number_3'];
    $pin['car_series'] = $owner['car_series'];
    $pin['car_color'] = $owner['car_color'];
    $pin['status'] = '0';
    $pin['release_time'] = TIMESTAMP;
    $pin['passenger_count'] = $travel['amount'];
    pdo_insert('navlange_pinche_pin',$pin);
    $pin_id = pdo_insertid();
    $new_member['uid'] = $travel['uid'];
    $new_member['openid'] = $travel['openid'];
    $new_member['pin_id'] = $pin_id;
    $new_member['travel_id'] = $_GPC['id'];
    $new_member['pin_time'] = TIMESTAMP;
    $new_member['status'] = '3';
    $new_member['uniacid'] = $_W['uniacid'];
    $new_member['type'] = '2';
    $new_member['passenger_amount'] = $travel['amount'];
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
    pdo_insert('navlange_pinche_member',$new_member);
    pdo_update('navlange_pinche_travel',array('status'=>'3'),array('id'=>$_GPC['id']));
    $this->travel_join_pin_success($_GPC['id'],$pin_id);
    message(error(0,''),'','ajax');
}
include $this->template('owner_fast');
?>