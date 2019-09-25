<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['pin_mode_name'];
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
    if($conf['pin_release_advertise_on'] == '1') {
        $advertise = pdo_getall('navlange_advertise_module',array('uniacid'=>$_W['uniacid'],'module_id'=>$_W['current_module']['mid'],'page'=>'pin_release'));
        $advertise_info = array();
        foreach ($advertise as $key => $value) {
            $cur_advertise = pdo_get('navlange_advertise',array('id'=>$value['advertise_id']));
            $data['pic_name'] = $cur_advertise['pic_name'];
            $data['url'] = $cur_advertise['url'];
            $data['advertise_id'] = $cur_advertise['id'];
            array_push($advertise_info,$data);
        }
    }
    if($conf['multi_pin_compete_on'] == '0') {
        $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1' AND departure_time>:time AND status='0' ORDER BY release_time DESC";
    } else if ($conf['multi_pin_compete_on'] == '1') {
        $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1' AND departure_time>:time AND (status='0' OR status='1') ORDER BY release_time DESC";
    }
    $params[':time'] = TIMESTAMP-$conf['pin_display_days_before']*24*60*60;
    $travel = pdo_fetchall($sql,$params);
    $travel_info = array();
    foreach ($travel as $key => $value) {
        $owner = pdo_get('navlange_pinche_owner',array('openid'=>$_W['openid']));
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
    $latest_pin = pdo_fetch("SELECT pin.* FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.owner_id=owner.id WHERE owner.openid='" . $_W['openid'] . "' ORDER BY pin.release_time DESC");
    if($conf['pin_departure_station_mode']=='1') {
        $departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_departure_station='1'");
    }
    if($conf['pin_terminal_station_mode']=='1') {
        $terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid'] . " AND is_pin_terminal_station='1'");
    }
} else if ($op == 'get_owner_pin') {
    $pin = pdo_fetchall("SELECT pin.id as id,pin.departure_city as departure_city,pin.departure_station as departure_station,pin.terminal_city as terminal_city,pin.terminal_station as terminal_station,pin.departure_time as departure_time,pin.passenger_count as passenger_count,pin.left_amount as left_amount,pin.price as price FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.owner_id=owner.id WHERE owner.openid='" . $_W['openid'] . "' AND (pin.status='0' OR pin.status='1') AND pin.departure_time>" . TIMESTAMP);
    $pin_info = array();
    foreach ($pin as $key => $value) {
        $data['departure_city'] = $value['departure_city'];
        $data['departure_station'] = $value['departure_station'];
        $data['terminal_city'] = $value['terminal_city'];
        $data['terminal_station'] = $value['terminal_station'];
        $data['id'] = $value['id'];
        $data['departure_time'] = date('m-d H:i',$value['departure_time']);
        $data['passenger_count'] = $value['passenger_count'];
        $data['left_amount'] = $value['left_amount'];
        $data['price'] = $value['price'];
        array_push($pin_info,$data);
    }
    message(error(0,$pin_info),'','ajax');
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
    $pin['passenger_count'] = $_GPC['passenger_count'];
    $pin['departure_time'] = strtotime($_GPC['departure_time']);
    $pin['boarding_place'] = $_GPC['boarding_place'];
    $pin['lng'] = $_GPC['lng'];
    $pin['lat'] = $_GPC['lat'];
    $pin['mode'] = $_GPC['mode'];
    $pin['price'] = $_GPC['price'];
    $pin['line'] = $_GPC['line'];
    $pin['note'] = $_GPC['note'];
    $pin['uniacid'] = $_W['uniacid'];
    $pin['release_time'] = TIMESTAMP;
    $pin['status'] = '0';
    pdo_insert('navlange_pinche_pin',$pin);
    $id = pdo_insertid('navlange_pinche_pin');
    ///发布赠送积分
    $marketing_conf = pdo_fetch("SELECT owner_release_pin_integral,owner_release_pin_integral_per_day FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $exists_record = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_integral_record') . " WHERE type='0' AND uid=" . $_W['member']['uid'] . " AND time>=" . strtotime(date('Y-m-d',TIMESTAMP)) . " AND time<" . (strtotime(date('Y-m-d',TIMESTAMP))+24*60*60));
    if($exists_record < $marketing_conf['owner_release_pin_integral_per_day'] && $marketing_conf['owner_release_pin_integral']>0) {
        $mc_member = pdo_fetch("SELECT credit1 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
        pdo_update('mc_members',array('credit1'=>($mc_member['credit1']+$marketing_conf['owner_release_pin_integral'])),array('uid'=>$_W['member']['uid']));
        $item=array();
        $item['uniacid'] = $_W['uniacid'];
        $item['uid'] = $_W['member']['uid'];
        $item['type'] = '0';
        $item['integral'] = $marketing_conf['owner_release_pin_integral'];
        $item['time'] = TIMESTAMP;
        $item['pin_id'] = $id;
        pdo_insert('navlange_pinche_integral_record',$item);
    }
    $message = pdo_get('navlange_pinche_message',array('uniacid'=>$_W['uniacid']));
    $data['first'] = array('value'=>'从'.$_GPC['departure_station'].'到'.$_GPC['terminal_station'].'的拼车发布成功','color'=>'#173177');
    $data['keyword1'] = array('value'=>$_GPC['departure_time'],'color'=>'#173177');
    $data['keyword2'] = array('value'=>$_GPC['departure_station'],'color'=>'#173177');
    $data['keyword3'] = array('value'=>$_GPC['terminal_station'],'color'=>'#173177');
    $data['keyword4'] = array('value'=>$owner['tel'],'color'=>'#173177');
    $data['remark'] = array('value'=>'感谢使用！','color'=>'#173177');
    $url = $_W['siteroot'] . ltrim($this->createMobileurl('info',array('id'=>$id)),'./');
    $acidarr = uni_accounts();//获取当前主公众号下的所有子公众号
    reset($acidarr);//重置数组指针
    $account = current($acidarr);//获取第一个字公众号
    $acid = $account['acid'];
    $acc = WeAccount::create($acid);//实例化消息类对象
    $acc->sendTplNotice($_W['openid'],$message['release_success'],$data,$url,'#FF683F');
    message(error(0,''),'','ajax');
} else if ($op == 'pin_submit') {
    $travel = pdo_fetch("SELECT uid,openid,amount FROM " . tablename('navlange_pinche_travel')  . " WHERE id=" . $_GPC['travel_id']);
    $pin = pdo_fetch("SELECT passenger_count,price FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $_GPC['pin_id']);
    $member = pdo_getall('navlange_pinche_member',array('uniacid'=>$_W['uniacid'],'pin_id'=>$_GPC['pin_id'],'status'=>'1'));
    $pined_count = 0;
    foreach ($member as $key => $value) {
        $confirmed_travel = pdo_get('navlange_pinche_travel',array('id'=>$value['travel_id']));
        $pined_count += $confirmed_travel['amount'];
    }
    if(($pined_count+$travel['amount']) > $pin['passenger_count']) {
        message(error(1,'FULL'),'','ajax');
    } else {
        $member['openid'] = $travel['openid'];
        $member['uid'] = $travel['uid'];
        $member['travel_id'] = $_GPC['travel_id'];
        $member['pin_id'] = $_GPC['pin_id'];
        $member['pin_time'] = TIMESTAMP;
        $member['status'] = '0';
        $member['uniacid'] = $_W['uniacid'];
        $sn_prefix = date('YmdHis',$member['pin_time']);
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
        $member['price'] = $pin['price'];
        $member['type'] = '1';
        $member['passenger_amount'] = $travel['amount'];
        pdo_insert('navlange_pinche_member',$member);
        pdo_update('navlange_pinche_travel',array('status'=>'1'),array('id'=>$_GPC['travel_id']));
        message(error(0,''),'','ajax');
    }
} else if ($op == 'refresh') {
    $conf = pdo_fetch("SELECT multi_pin_compete_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    if($conf['multi_pin_compete_on'] == '0') {
        $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1' AND status='0' AND departure_station LIKE '%" . $_GPC['departure_station'] . "%' AND terminal_station LIKE '%" . $_GPC['terminal_station'] . "%'";
    } else if ($conf['multi_pin_compete_on'] == '1') {
        $sql = "SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND type='1' AND (status='0' OR status='1') AND departure_station LIKE '%" . $_GPC['departure_station'] . "%' AND terminal_station LIKE '%" . $_GPC['terminal_station'] . "%'";
    }
    if(!empty($_GPC['date'])) {
        $today = strtotime($_GPC['date']);
        $tomorrow = $today + 24*60*60;
        $sql .= " AND departure_time>=" . $today . " AND departure_time<" . $tomorrow;
    } else {
        $sql .= " AND departure_time>=" . TIMESTAMP;
    }
    $sql .= " ORDER BY departure_time DESC";
    $travel = pdo_fetchall($sql);
    $travel_info = array();
    $conf = pdo_fetch("SELECT passenger_info_available_before_pin FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    foreach ($travel as $key => $value) {
        $owner = pdo_get('navlange_pinche_owner',array('openid'=>$_W['openid']));
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
            $data['departure_time'] = date('m-d H:i',$value['departure_time']);
            $data['release_time'] = date('d/m H:i',$value['release_time']);
            if ($conf['passenger_info_available_before_pin']=='1') {
                $data['name'] = $value['name'];
            } else if ($value['name'] != '') {
                $data['name'] = mb_substr($value['name'],0,1,'utf-8') . '**';
            }
            if ($conf['passenger_info_available_before_pin']=='1') {
                $data['mobile'] = $value['mobile'];
            }
            else if ($value['mobile'] != '') {
                $data['mobile'] = substr_replace($value['mobile'],'****',3,4);
            }
            $data['info_available'] = $conf['passenger_info_available_before_pin'];
            array_push($travel_info,$data);
        }
    }
    message(error(0,$travel_info),'','ajax');
}
$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
include $this->template('owner_index');
?>