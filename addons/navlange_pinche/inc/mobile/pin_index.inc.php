<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$_W['page']['title'] = '';
	$_W['page']['sitename'] = pdo_fetchcolumn("SELECT customer_name FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='pin_index'");
	$conf = pdo_fetch("SELECT comment_display_on,color,mode_menu_on,owner_info_available_before_pin,need_travel_before_pin_on,owner_color,pin_display_days_before,multi_pin_compete_on,pin_mode_on,fast_mode_on,charter_mode_on,cargo_mode_on,bus_mode_on,pin_mode_name,fast_mode_name,charter_mode_name,cargo_mode_name,bus_mode_name,max_day_to_release FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
	$banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='all_index'");
	$menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
	$general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
	$params[':uniacid'] = $_W['uniacid'];
	$params[':time'] = TIMESTAMP-$conf['pin_display_days_before']*24*60*60;
	$sql_fixed = "SELECT pin.*,mc_member.avatar as avatar,mc_member.nickname as nickname,owner.credit_score as credit_score,owner.tel as tel FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('mc_members') . " AS mc_member ON pin.uid=mc_member.uid LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.uid=owner.uid WHERE pin.uniacid=:uniacid" . " AND pin.type='1' AND pin.departure_time>:time AND (pin.status='0' OR pin.status='1' OR pin.status='9') AND pin.is_fixed='1' AND pin.fixed_expire>=" . TIMESTAMP;
    if($_GPC['departure_station']) {
    	$sql_fixed .= " AND pin.departure_station LIKE '%" . $_GPC['departure_station'] . "%'";
    }
    if($_GPC['terminal_station']) {
    	$sql_fixed .= " AND pin.terminal_station LIKE '%" . $_GPC['terminal_station'] . "%'";
    }
    $sql_fixed .= " ORDER BY pin.fixed_release_time DESC";
	$pin_fixed = pdo_fetchall($sql_fixed,$params);
	$sql_stick = "SELECT pin.*,mc_member.avatar as avatar,mc_member.nickname as nickname,owner.credit_score as credit_score,owner.tel as tel FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('mc_members') . " AS mc_member ON pin.uid=mc_member.uid LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.uid=owner.uid WHERE pin.uniacid=:uniacid" . " AND pin.type='1' AND pin.departure_time>:time AND (pin.status='0' OR pin.status='1' OR pin.status='9') AND (pin.is_fixed='0' OR (pin.is_fixed='1' AND pin.fixed_expire<" . TIMESTAMP . ")) AND pin.is_stick='1' AND pin.stick_expire>=" . TIMESTAMP;
	if($_GPC['departure_station']) {
    	$sql_stick .= " AND pin.departure_station LIKE '%" . $_GPC['departure_station'] . "%'";
    }
    if($_GPC['terminal_station']) {
    	$sql_stick .= " AND pin.terminal_station LIKE '%" . $_GPC['terminal_station'] . "%'";
    }
    $sql_stick .= " ORDER BY pin.stick_release_time DESC";
	$pin_stick = pdo_fetchall($sql_stick,$params);
	$sql_general = "SELECT pin.*,mc_member.avatar as avatar,mc_member.nickname as nickname,owner.credit_score as credit_score,owner.tel as tel FROM " . tablename('navlange_pinche_pin') . " AS pin LEFT JOIN " . tablename('mc_members') . " AS mc_member ON pin.uid=mc_member.uid LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON pin.uid=owner.uid WHERE pin.uniacid=:uniacid" . " AND pin.type='1' AND pin.departure_time>:time AND (pin.status='0' OR pin.status='1' OR pin.status='9') AND (pin.is_fixed='0' OR (pin.is_fixed='1' AND pin.fixed_expire<" . TIMESTAMP . ")) AND (pin.is_stick='0' OR (pin.is_stick='1' AND pin.stick_expire<" . TIMESTAMP . "))";
	if($_GPC['departure_city']) {
    	$sql_general .= " AND pin.departure_city='" . $_GPC['departure_city'] . "'";
    }
    if($_GPC['terminal_city']) {
    	$sql_general .= " AND pin.terminal_city='" . $_GPC['terminal_city'] . "'";
    }
    $sql_general .= " ORDER BY pin.release_time DESC";
	$pin_general = pdo_fetchall($sql_general,$params);
	$pin = array_merge($pin_fixed,$pin_stick,$pin_general);
    $pin_info = array();
    $pin_legal = array();
    $pin_expired = array();
    foreach ($pin as $key => $value) {
        $data = $value;
        if($data['status']=='0' && $data['departure_time'] < TIMESTAMP) {
            pdo_update('navlange_pinche_pin',array('status'=>'9'),array('id'=>$value['id']));
            $data['status'] = '9';
        }
        if($data['status'] == '9') {
            array_push($pin_expired,$data);
        } else {
            array_push($pin_legal,$data);
        }
    }
    $pin_info = array_merge($pin_legal,$pin_expired);
    $note_template_list = pdo_fetchall("SELECT id,content FROM " . tablename('navlange_pinche_note_template') . " WHERE uniacid=" . $_W['uniacid'] . " AND scene='travel'");
}

include $this->template('pin_index');
?>