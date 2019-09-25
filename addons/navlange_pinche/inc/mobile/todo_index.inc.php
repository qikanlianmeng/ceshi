<?php
global $_W, $_GPC;
$op = array_key_exists('op', $_GPC) ? $_GPC['op'] : 'index';
if ($op == 'index') {
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = '首页';
    $conf = pdo_fetch("SELECT color,owner_color,pin_progress_mode,info_share_title,info_share_img,info_share_desc,index_statistic_display_on,image_nav_mode,nav_img_1_title,nav_img_1_desc,nav_img_1,nav_img_1_color,nav_img_1_url,nav_img_2_title,nav_img_2_desc,nav_img_2,nav_img_2_color,nav_img_2_url,nav_img_3_title,nav_img_3_desc,nav_img_3,nav_img_3_color,nav_img_3_url,nav_img_4_title,nav_img_4_desc,nav_img_4,nav_img_4_color,nav_img_4_url,nav_img_5_title,nav_img_5_desc,nav_img_5,nav_img_5_color,nav_img_5_url,core_mode FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $platform = pdo_fetch("SELECT owner_amount,passenger_amount FROM " . tablename('navlange_pinche_platform') . " WHERE uniacid=" . $_W['uniacid']);
    $banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='todo_index'");
    $menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND display='1' AND mode='1' ORDER BY order_index");
    $general_release_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND name_en='general_release'");
    $line_list = pdo_fetchall("SELECT departure_station,departure_city,departure_address,departure_district,terminal_station,terminal_city,terminal_address,terminal_district FROM " . tablename('navlange_pinche_line') . " WHERE uniacid=" . $_W['uniacid']);
    $login_status = $this->check_mobile_login();
    if ($login_status == true) {
        $travel_list = pdo_fetchall("SELECT id,departure_time,departure_city,departure_station,departure_district,terminal_city,terminal_station,terminal_district,amount,boarding_place,status,owner_arrived_departure_station,owner_comming_to_departure_station FROM " . tablename('navlange_pinche_travel') . " WHERE uid=" . $_W['member']['uid'] . " AND (status='0' OR status='1' OR status='3' OR status='4' OR status='6')");
        $pin_list = pdo_fetchall("SELECT id,departure_time,departure_city,departure_station,departure_district,terminal_city,terminal_station,terminal_district,status,pined_amount FROM " . tablename('navlange_pinche_pin') . " WHERE uid=" . $_W['member']['uid'] . " AND (status='0' OR status='1')");
        $owner = pdo_fetch("SELECT status FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
    }
    $notice = pdo_fetchall("SELECT notice.id as id,notice.title as title,type.name as type,type.color as color FROM " . tablename('navlange_pinche_notice') . " AS notice LEFT JOIN " . tablename('navlange_pinche_notice_type') . " AS type ON notice.type=type.id WHERE notice.uniacid=" . $_W['uniacid']);
} else if ($op == 'get_invite_code') {
    $partner = pdo_fetch("SELECT invite_code FROM " . tablename('navlange_partner') . " WHERE uid=" . $_W['member']['uid']);
    if (!empty($partner)) {
        $invite_code = $partner['invite_code'];
    } else {
        $owner = pdo_fetch("SELECT id,invite_code FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_W['member']['uid']);
        if (!$owner['invite_code']) {
            $invite_code = $this->createCode($_W['member']['uid']);
            pdo_update('navlange_pinche_owner', array('invite_code' => $invite_code), array('uid' => $_W['member']['uid']));
        } else {
            $invite_code = $owner['invite_code'];
        }
    }
    message(error(0, $invite_code), '', 'ajax');
}

include $this->template('todo_index');
?>