<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = pdo_fetchcolumn("SELECT customer_name FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='travel_index'");
	$conf = pdo_fetch("SELECT comment_display_on,color,mode_menu_on,owner_color,pin_display_days_before,multi_pin_compete_on,pin_departure_station_mode,pin_terminal_station_mode,max_day_to_release,pin_line_mode,release_need_license,pin_release_need_credit_score,pin_mode_on,fast_mode_on,charter_mode_on,cargo_mode_on,bus_mode_on,pin_mode_name,fast_mode_name,charter_mode_name,cargo_mode_name,bus_mode_name,passenger_info_available_before_pin,use_travel_as_pin_by_default_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $marketing_conf = pdo_fetch("SELECT owner_classify_on,owner_classify FROM " . tablename('navlange_pinche_marketing_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$owner = pdo_get('navlange_pinche_owner',array('uniacid'=>$_W['uniacid'],'openid'=>$_W['openid']));
	if($conf['release_need_license']=='1' && (empty($owner) || $owner['status']=='0')) {
	    $need_check = '1';
	}
	$banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='all_index'");
	$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
	$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
	
	if($conf['multi_pin_compete_on'] == '0') {
        $sql = "SELECT travel.*,mc_member.avatar as avatar,mc_member.nickname as nickname,client.credit_score as credit_score FROM " . tablename('navlange_pinche_travel') . " AS travel LEFT JOIN " . tablename('mc_members') . " AS mc_member ON travel.uid=mc_member.uid LEFT JOIN " . tablename('navlange_pinche_client') . " AS client ON travel.uid=client.uid WHERE travel.uniacid=" . $_W['uniacid'] . " AND client.uniacid=" . $_W['uniacid'] . " AND travel.type='1' AND travel.departure_time>:time AND (travel.status='0' OR travel.status='9')";
    } else if ($conf['multi_pin_compete_on'] == '1') {
        $sql = "SELECT travel.*,mc_member.avatar as avatar,mc_member.nickname as nickname,client.credit_score as credit_score FROM " . tablename('navlange_pinche_travel') . " AS travel LEFT JOIN " . tablename('mc_members') . " AS mc_member ON travel.uid=mc_member.uid LEFT JOIN " . tablename('navlange_pinche_client') . " AS client ON travel.uid=client.uid WHERE travel.uniacid=" . $_W['uniacid'] . " AND client.uniacid=" . $_W['uniacid'] . " AND travel.type='1' AND travel.departure_time>:time AND (travel.status='0' OR travel.status='1' OR travel.status='9')";
    }
    $params = array();
    $params[':time'] = TIMESTAMP-$conf['pin_display_days_before']*24*60*60;
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
    $note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='pin'");
}

include $this->template('travel_index');
?>