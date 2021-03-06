<?php
global $_W,$_GPC;
$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['charter_mode_name'];
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
} else if ($op == 'change_status') {
    pdo_update('navlange_pinche_owner',array('charter_on'=>$_GPC['status']),array('openid'=>$_W['openid']));
    message(error(0,''),'','ajax');
} else if ($op == 'update_location') {
    $data['location'] = $_GPC['location'];
    $data['lng'] = $_GPC['lng'];
    $data['lat'] = $_GPC['lat'];
    pdo_update('navlange_pinche_owner',$data,array('openid'=>$_W['openid']));
    message(error(0,''),'','ajax');
}
include $this->template('owner_charter');
?>