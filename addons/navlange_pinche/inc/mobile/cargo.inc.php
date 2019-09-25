<?php
global $_W,$_GPC;
    $conf = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
    $_W['page']['title'] = '';
    $_W['page']['sitename'] = $conf['cargo_mode_name'];
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
    
    $line = pdo_fetchall("SELECT line.id as id,line.departure_station,line.departure_city,line.departure_district,line.terminal_station,line.terminal_city,line.terminal_district,line.stations_str,line.name as name,store.img as avatar,store.name as store_name,store.tel as tel FROM " . tablename('navlange_pinche_line') . " AS line LEFT JOIN " . tablename('navlange_pinche_store') . " AS store ON line.store_id=store.id WHERE line.uniacid=" . $_W['uniacid'] . " AND line.type='5'");

include $this->template('cargo');
?>