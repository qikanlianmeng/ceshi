<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'todo_index';
if($op == 'todo_index') {
    if(checksubmit()) {
        $data = array();
        $data['index_title'] = $_GPC['index_title'];
        $data['index_statistic_display_on'] = $_GPC['index_statistic_display_on'] == '1' ? '1' : '0';
        $data['index_toast_on'] = $_GPC['index_toast_on'] == '1' ? '1' : '0';
        $data['index_discovery_on'] = $_GPC['index_discovery_on'] == '1' ? '1' : '0';
        $data['index_toast_content'] = $_GPC['index_toast_content'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    if(checksubmit('add_banner')) {
        $item = array();
        $item['uniacid'] = $_W['uniacid'];
        $item['img'] = $_GPC['img'];
        $item['url'] = $_GPC['url'];
        $item['page'] = 'todo_index';
        pdo_insert('navlange_pinche_banner',$item);
        message('添加成功！','refresh','success');
    }
    if(checksubmit('image_nav_submit')) {
        $data['image_nav_mode'] = $_GPC['image_nav_mode'];
        $data['nav_img_1_title'] = $_GPC['nav_img_1_title'];
        $data['nav_img_1_desc'] = $_GPC['nav_img_1_desc'];
        $data['nav_img_1_url'] = $_GPC['nav_img_1_url'];
        $data['nav_img_1_color'] = $_GPC['nav_img_1_color'];
        $data['nav_img_1'] = $_GPC['nav_img_1'];
        $data['nav_img_2_title'] = $_GPC['nav_img_2_title'];
        $data['nav_img_2_desc'] = $_GPC['nav_img_2_desc'];
        $data['nav_img_2_url'] = $_GPC['nav_img_2_url'];
        $data['nav_img_2_color'] = $_GPC['nav_img_2_color'];
        $data['nav_img_2'] = $_GPC['nav_img_2'];
        $data['nav_img_3_title'] = $_GPC['nav_img_3_title'];
        $data['nav_img_3_desc'] = $_GPC['nav_img_3_desc'];
        $data['nav_img_3_url'] = $_GPC['nav_img_3_url'];
        $data['nav_img_3_color'] = $_GPC['nav_img_3_color'];
        $data['nav_img_3'] = $_GPC['nav_img_3'];
        $data['nav_img_4_title'] = $_GPC['nav_img_4_title'];
        $data['nav_img_4_desc'] = $_GPC['nav_img_4_desc'];
        $data['nav_img_4_url'] = $_GPC['nav_img_4_url'];
        $data['nav_img_4_color'] = $_GPC['nav_img_4_color'];
        $data['nav_img_4'] = $_GPC['nav_img_4'];
        $data['nav_img_5_title'] = $_GPC['nav_img_5_title'];
        $data['nav_img_5_desc'] = $_GPC['nav_img_5_desc'];
        $data['nav_img_5_url'] = $_GPC['nav_img_5_url'];
        $data['nav_img_5_color'] = $_GPC['nav_img_5_color'];
        $data['nav_img_5'] = $_GPC['nav_img_5'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $banner_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_banner') . " WHERE uniacid=" . $_W['uniacid'] . " AND page='todo_index'");
    $conf = pdo_fetch("SELECT index_statistic_display_on,index_toast_on,index_toast_content,image_nav_mode,nav_img_1_title,nav_img_1_desc,nav_img_1,nav_img_1_color,nav_img_1_url,nav_img_2_title,nav_img_2_desc,nav_img_2,nav_img_2_color,nav_img_2_url,nav_img_3_title,nav_img_3_desc,nav_img_3,nav_img_3_color,nav_img_3_url,nav_img_4_title,nav_img_4_desc,nav_img_4,nav_img_4_color,nav_img_4_url,nav_img_5_title,nav_img_5_desc,nav_img_5,nav_img_5_color,nav_img_5_url,index_discovery_on,index_title FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if($op == 'general_release') {
    if(checksubmit()) {
        $data['pin_release_travel_note'] = $_GPC['pin_release_travel_note'];
        $data['pin_release_pin_note'] = $_GPC['pin_release_pin_note'];
        $data['fast_release_travel_note'] = $_GPC['fast_release_travel_note'];
        $data['cargo_release_travel_note'] = $_GPC['cargo_release_travel_note'];
        $data['cargo_release_pin_note'] = $_GPC['cargo_release_pin_note'];
        $data['general_release_cargo_name'] = $_GPC['general_release_cargo_name'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    $conf = pdo_fetch("SELECT pin_release_travel_note,pin_release_pin_note,fast_release_travel_note,cargo_release_travel_note,cargo_release_pin_note,general_release_cargo_name FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_all_index_banner') {
    pdo_delete('navlange_pinche_banner',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'pin_release') {
    if(checksubmit('passenger_submit')) {
        $data['passenger_mobile_by_force'] = $_GPC['passenger_mobile_by_force'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    $conf = pdo_fetch("SELECT passenger_mobile_by_force FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'my_travel') {
    if(checksubmit('person_submit')) {
        $data['my_travel_canceled_display_on'] = $_GPC['my_travel_canceled_display_on']== '1' ? '1' : '0';
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $conf = pdo_fetch("SELECT my_travel_canceled_display_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'person') {
    if(checksubmit('person_submit')) {
        $data['person_item_theme'] = $_GPC['person_item_theme'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $conf = pdo_fetch("SELECT person_item_theme FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'charter') {
    
} else if ($op == 'cargo') {
    if(checksubmit()) {
        $data['goods_list_banner_on'] = $_GPC['goods_list_banner_on'] == '1' ? '1' : '0';
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $conf = pdo_fetch("SELECT goods_list_banner_on FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'fast') {
   
} else if ($op == 'bus') {
    
} else if ($op == 'store_register') {
    if(checksubmit()) {
        $data['store_register_head_img'] = $_GPC['store_register_head_img'];
        $data['store_register_agreement'] = $_GPC['store_register_agreement'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $conf = pdo_fetch("SELECT store_register_head_img,store_register_agreement FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'help') {
    if(checksubmit('help_submit')) {
        $data['help_content'] = $_GPC['help_content'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    if(checksubmit('disclaimer_submit')) {
        $data['disclaimer'] = $_GPC['disclaimer'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    if(checksubmit('about_platform_submit')) {
        $data['about_platform'] = $_GPC['about_platform'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $conf = pdo_fetch("SELECT help_content,disclaimer,about_platform FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'func_menu') {
    if(checksubmit('add')) {
        $func_menu['uniacid'] = $_W['uniacid'];
        $func_menu['type'] = '1';
        $func_menu['name'] = $_GPC['name'];
        $func_menu['customer_name'] = $_GPC['customer_name'];
        $func_menu['mode'] = '0';
        if(!empty($_GPC['icon'])) {
            $func_menu['icon'] = $_GPC['icon'];
        }
        if(!empty($_GPC['icon_active'])) {
            $func_menu['icon_active'] = $_GPC['icon_active'];
        }
        $func_menu['url'] = $_GPC['url'];
        $func_menu['display'] = '1';
        pdo_insert('navlange_pinche_menu',$func_menu);
        $func_menu_id = pdo_insertid();
        $last_func_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND mode='0' ORDER BY order_index DESC");
        if(!empty($last_func_menu)) {
            $order_index = $last_func_menu['order_index'] + 1;
        } else {
            $order_index = 1;
        }
        pdo_update('navlange_pinche_menu',array('order_index'=>$order_index),array('id'=>$func_menu_id));
        message('添加成功！','refresh','success');
    }
    $func_menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY order_index");
} else if ($op == 'delete_func_menu') {
    $func_menu =pdo_fetch("SELECT icon,icon_active FROM " . tablename('navlange_pinche_menu') . " WHERE id=" . $_GPC['id']);
    pdo_delete('navlange_pinche_menu',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'set_func_menu_order_index') {
    set_func_menu_order_index($_GPC['id'],$_GPC['order_index']);
    message(error(0,''),'','ajax');
} else if ($op == 'set_func_menu_display') {
    pdo_update('navlange_pinche_menu',array('display'=>$_GPC['display']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}  else if ($op == 'edit_func_menu') {
    $id = $_GPC['id'];
    if(checksubmit('edit')) {
        $func_menu['icon'] = $_GPC['icon'];
        $func_menu['icon_active'] = $_GPC['icon_active'];
        $func_menu['name'] = $_GPC['name'];
        $func_menu['customer_name'] = $_GPC['customer_name'];
        $func_menu['url'] = $_GPC['url'];
        pdo_update('navlange_pinche_menu',$func_menu,array('id'=>$_GPC['id']));
        message('修改成功！','refresh','success');
    }
    $func_menu_info = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE id=" . $_GPC['id']);
} else if ($op == 'menu') {
    if(checksubmit('add')) {
        $menu['uniacid'] = $_W['uniacid'];
        $menu['type'] = '1';
        $menu['name'] = $_GPC['name'];
        $menu['customer_name'] = $_GPC['customer_name'];
        $menu['mode'] = '1';
        if(!empty($_GPC['icon'])) {
            $menu['icon'] = $_GPC['icon'];
        }
        if(!empty($_GPC['icon_active'])) {
            $menu['icon_active'] = $_GPC['icon_active'];
        }
        $menu['url'] = $_GPC['url'];
        $menu['display'] = '1';
        pdo_insert('navlange_pinche_menu',$menu);
        $menu_id = pdo_insertid();
        $last_menu = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND mode='1' ORDER BY order_index DESC");
        if(!empty($last_menu)) {
            $order_index = $last_menu['order_index'] + 1;
        } else {
            $order_index = 1;
        }
        pdo_update('navlange_pinche_menu',array('order_index'=>$order_index),array('id'=>$menu_id));
        message('添加成功！','refresh','success');
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '首页';
    $sys_menu['name_en'] = 'todo_index';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'todo_index'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/index/index';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '首页';
        $sys_menu['icon_name'] = 'shouye';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '我是乘客';
    $sys_menu['name_en'] = 'pin_index';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'pin_index'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/pin/list';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '我是乘客';
        $sys_menu['icon_name'] = 'zhaorendaiban';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '我是货主';
    $sys_menu['name_en'] = 'pin_index';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'cargo'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/cargo/list';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '我是货主';
        $sys_menu['icon_name'] = 'zhaorendaiban';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '我是乘客(班车专线)';
    $sys_menu['name_en'] = 'bus_index';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'bus'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/bus/list';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '0';
        $sys_menu['customer_name'] = '我是乘客';
        $sys_menu['icon_name'] = 'zhaorendaiban';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '我是车主';
    $sys_menu['name_en'] = 'travel_index';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'travel_index'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/travel/list';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '我是车主';
        $sys_menu['icon_name'] = 'icon';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '我是车主(拼货)';
    $sys_menu['name_en'] = 'travel_index';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'owner_cargo'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/goods/list';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '我是车主';
        $sys_menu['icon_name'] = 'icon';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '乘客发布';
    $sys_menu['name_en'] = 'travel_release_pin';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'travel_release_pin'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/release/travel';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '0';
        $sys_menu['customer_name'] = '乘客发布';
        $sys_menu['icon_name'] = 'icon';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '发布';
    $sys_menu['name_en'] = 'general_release';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'general_release'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/release/index';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '发布';
        $sys_menu['icon_name'] = 'jia';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '司机发布';
    $sys_menu['name_en'] = 'release_pin';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'release_pin'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/release/pin';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '0';
        $sys_menu['customer_name'] = '司机发布';
        $sys_menu['icon_name'] = 'zhaorendaiban';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $sys_menu = array();
    $sys_menu['uniacid'] = $_W['uniacid'];
    $sys_menu['type'] = '0';
    $sys_menu['name'] = '个人中心';
    $sys_menu['name_en'] = 'person';
    $sys_menu['mode'] = '1';
    $sys_menu['url'] = murl('entry', array('m' => 'navlange_pinche', 'do' => 'person'), true, true);
    $sys_menu['wxapp_url'] = '/navlange_pinche/pages/person/index';
    $is_exist = pdo_get('navlange_pinche_menu',$sys_menu);
    if(empty($is_exist)) {
        $sys_menu['display'] = '1';
        $sys_menu['customer_name'] = '个人中心';
        $sys_menu['icon_name'] = 'gerenzhongxinxia';
        pdo_insert('navlange_pinche_menu',$sys_menu);
    }
    $menu_list = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE uniacid=" . $_W['uniacid'] . " AND mode='1' ORDER BY order_index");
} else if ($op == 'delete_menu') {
    $menu =pdo_fetch("SELECT icon,icon_active FROM " . tablename('navlange_pinche_menu') . " WHERE id=" . $_GPC['id']);
    pdo_delete('navlange_pinche_menu',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'set_menu_order_index') {
    set_menu_order_index($_GPC['id'],$_GPC['order_index']);
    message(error(0,''),'','ajax');
} else if ($op == 'set_menu_display') {
    pdo_update('navlange_pinche_menu',array('display'=>$_GPC['display']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}  else if ($op == 'edit_menu') {
    $id = $_GPC['id'];
    if(checksubmit('edit')) {
        $menu['icon'] = $_GPC['icon'];
        $menu['icon_active'] = $_GPC['icon_active'];
        $menu['name'] = $_GPC['name'];
        $menu['customer_name'] = $_GPC['customer_name'];
        $menu['url'] = $_GPC['url'];
        pdo_update('navlange_pinche_menu',$menu,array('id'=>$_GPC['id']));
        message('修改成功！','refresh','success');
    }
    $menu_info = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_menu') . " WHERE id=" . $_GPC['id']);
}
include $this->template('page');

function set_func_menu_order_index($id,$order_index) {
    $func_menu = pdo_get('navlange_pinche_menu',array('id'=>$id));
    if($func_menu['order_index'] == $order_index) {
        return;
    }
    pdo_update('navlange_pinche_menu',array('order_index'=>0),array('id'=>$id));//临时设置为0
    update_next_func_menu($order_index);
    pdo_update('navlange_pinche_menu',array("order_index"=>$order_index),array('id'=>$id));
}
function update_next_func_menu($order_index) {
    global $_W;
    $exist = pdo_getall('navlange_pinche_menu',array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'mode'=>'0'));
    if($exist) {
        update_next_func_menu($order_index+1);
    }
    pdo_update('navlange_pinche_menu',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'mode'=>'0'));
}

function set_menu_order_index($id,$order_index) {
    $menu = pdo_get('navlange_pinche_menu',array('id'=>$id));
    if($menu['order_index'] == $order_index) {
        return;
    }
    pdo_update('navlange_pinche_menu',array('order_index'=>0),array('id'=>$id));//临时设置为0
    update_next_menu($order_index);
    pdo_update('navlange_pinche_menu',array("order_index"=>$order_index),array('id'=>$id));
}
function update_next_menu($order_index) {
    global $_W;
    $exist = pdo_getall('navlange_pinche_menu',array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'mode'=>'1'));
    if($exist) {
        update_next_menu($order_index+1);
    }
    pdo_update('navlange_pinche_menu',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'mode'=>'1'));
}
?>