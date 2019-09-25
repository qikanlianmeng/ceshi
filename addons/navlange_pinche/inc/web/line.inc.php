<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $line = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_line') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_line') {
    pdo_delete('navlange_pinche_line',array('id'=>$_GPC['id']));
    pdo_delete('navlange_pinche_line_station',array('line_id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'add') {
    if(checksubmit('add')) {
        $data['name'] = $_GPC['name'];
        $data['price'] = $_GPC['price'];
        $data['uniacid'] = $_W['uniacid'];
        $data['departure_station_id'] = $_GPC['departure_station_id'];
        $departure_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['departure_station_id']);
        $data['departure_station'] = $departure_station['name'];
        $data['departure_prov'] = $departure_station['prov'];
        $data['departure_city'] = $departure_station['city'];
        $data['departure_district'] = $departure_station['district'];
        $data['departure_address'] = $departure_station['address'];
        $data['departure_lng'] = $departure_station['lng'];
        $data['departure_lat'] = $departure_station['lat'];
        $data['terminal_station_id'] = $_GPC['terminal_station_id'];
        $terminal_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['terminal_station_id']);
        $data['terminal_station'] = $terminal_station['name'];
        $data['terminal_prov'] = $terminal_station['prov'];
        $data['terminal_city'] = $terminal_station['city'];
        $data['terminal_district'] = $terminal_station['district'];
        $data['terminal_address'] = $terminal_station['address'];
        $data['terminal_lng'] = $terminal_station['lng'];
        $data['terminal_lat'] = $terminal_station['lat'];
        pdo_insert('navlange_pinche_line',$data);
        $id = pdo_insertid();
        message('添加站点成功！',$this->createWeburl('line',array('op'=>'edit_line','id'=>$id)),'success');
    }
    $departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_departure_station='1' AND uniacid=" . $_W['uniacid']);
    $terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_terminal_station='1' AND uniacid=" . $_W['uniacid']);
} else if ($op == 'edit_line') {
    if(checksubmit('edit')) {
        $data['name'] = $_GPC['name'];
        $data['price'] = $_GPC['price'];
        $data['departure_station_id'] = $_GPC['departure_station_id'];
        $departure_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['departure_station_id']);
        $data['departure_station'] = $departure_station['name'];
        $data['departure_prov'] = $departure_station['prov'];
        $data['departure_city'] = $departure_station['city'];
        $data['departure_district'] = $departure_station['district'];
        $data['departure_address'] = $departure_station['address'];
        $data['departure_lng'] = $departure_station['lng'];
        $data['departure_lat'] = $departure_station['lat'];
        $data['terminal_station_id'] = $_GPC['terminal_station_id'];
        $terminal_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['terminal_station_id']);
        $data['terminal_station'] = $terminal_station['name'];
        $data['terminal_prov'] = $terminal_station['prov'];
        $data['terminal_city'] = $terminal_station['city'];
        $data['terminal_district'] = $terminal_station['district'];
        $data['terminal_address'] = $terminal_station['address'];
        $data['terminal_lng'] = $terminal_station['lng'];
        $data['terminal_lat'] = $terminal_station['lat'];
        pdo_update('navlange_pinche_line',$data,array('id'=>$_GPC['id']));
        message('修改成功！','refresh','success');
    }
    if(checksubmit('add')) {
        $data['line_id'] = $_GPC['id'];
        $data['station_id'] = $_GPC['station'];
        $data['uniacid'] = $_W['uniacid'];
        pdo_insert('navlange_pinche_line_station',$data);
        $id = pdo_insertid();
        $last_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_line_station') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY order_index DESC");
        if(!empty($last_station)) {
            $order_index = $last_station['order_index'] + 1;
        } else {
            $order_index = 1;
        }
        pdo_update('navlange_pinche_line_station',array('order_index'=>$order_index),array('id'=>$id));
        message('添加成功！','refresh','success');
    }
    if(checksubmit('add_price')) {
        $item = array();
        $item['uniacid'] = $_W['uniacid'];
        $item['line_id'] = $_GPC['id'];
        $item['passenger_amount'] = $_GPC['passenger_amount'];
        $item['price'] = $_GPC['price'];
        pdo_insert('navlange_pinche_line_price',$item);
        message('添加成功！','refresh','success');
    }
    $id = $_GPC['id'];
    $line = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_line') . " WHERE id=" . $_GPC['id']);
    $line_station = pdo_fetchall("SELECT line_station.id as id,station.name as station_name,line_station.order_index as order_index FROM " . tablename('navlange_pinche_line_station') . " AS line_station LEFT JOIN " . tablename('navlange_pinche_station') . " AS station ON line_station.station_id=station.id WHERE line_id=" . $_GPC['id'] . " ORDER BY order_index");
    $all_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid']);
    $line_price = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_line_price') . " WHERE line_id=" . $_GPC['id']);
    $departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_departure_station='1' AND uniacid=" . $_W['uniacid']);
    $terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_terminal_station='1' AND uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_price') {
    pdo_delete('navlange_pinche_line_price',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'delete_line_station') {
    pdo_delete('navlange_pinche_line_station',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'set_station_order_index') {
    set_station_order_index($_GPC['id'],$_GPC['order_index']);
    message(error(0,''),'','ajax');
} else if ($op == 'station') {
    $station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'set_pin_departure_station') {
    pdo_update('navlange_pinche_station',array('is_pin_departure_station'=>$_GPC['status']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'set_pin_terminal_station') {
    pdo_update('navlange_pinche_station',array('is_pin_terminal_station'=>$_GPC['status']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'delete_station') {
    pdo_delete('navlange_pinche_station',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'edit_station') {
    $station_id = $_GPC['station_id'];
    if(checksubmit('edit')) {
        $data['name'] = $_GPC['name'];
        $data['prov'] = $_GPC['prov'];
        $data['city'] = $_GPC['city'];
        $data['district'] = $_GPC['district'];
        $data['address'] = $_GPC['address'];
        $data['lng'] = $_GPC['lng'];
        $data['lat'] = $_GPC['lat'];
        pdo_update('navlange_pinche_station',$data,array('id'=>$station_id));
        message('设置成功！','refresh','success');
    }
    $station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['station_id']);
} else if ($op == 'add_station') {
    if(checksubmit('add')) {
        $data['uniacid'] = $_W['uniacid'];
        $data['name'] = $_GPC['name'];
        $data['prov'] = $_GPC['prov'];
        $data['city'] = $_GPC['city'];
        $data['district'] = $_GPC['district'];
        $data['address'] = $_GPC['address'];
        $data['lng'] = $_GPC['lng'];
        $data['lat'] = $_GPC['lat'];
        pdo_insert('navlange_pinche_station',$data);
        message('添加成功！',$this->createWeburl('line',array('op'=>'station')),'success');
    }
} else if ($op == 'bus') {
    $line = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_bus_line') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_bus') {
    pdo_delete('navlange_pinche_bus_line',array('id'=>$_GPC['id']));
    pdo_delete('navlange_pinche_bus_line_station',array('bus_line_id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'add_bus') {
    if(checksubmit('add')) {
        $line['departure_station_id'] = $_GPC['departure_station_id'];
        $departure_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['departure_station_id']);
        $line['departure_station'] = $departure_station['name'];
        $line['departure_prov'] = $departure_station['prov'];
        $line['departure_city'] = $departure_station['city'];
        $line['departure_district'] = $departure_station['district'];
        $line['departure_address'] = $departure_station['address'];
        $line['departure_lng'] = $departure_station['lng'];
        $line['departure_lat'] = $departure_station['lat'];
        $line['terminal_station_id'] = $_GPC['terminal_station_id'];
        $terminal_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['terminal_station_id']);
        $line['terminal_station'] = $terminal_station['name'];
        $line['terminal_prov'] = $terminal_station['prov'];
        $line['terminal_city'] = $terminal_station['city'];
        $line['terminal_district'] = $terminal_station['district'];
        $line['terminal_address'] = $terminal_station['address'];
        $line['terminal_lng'] = $terminal_station['lng'];
        $line['terminal_lat'] = $terminal_station['lat'];
        $line['boarding_place'] = $_GPC['boarding_place'];
        $line['price'] = $_GPC['price'];
        $line['fix_departure_time'] = $_GPC['fix_departure_time'];
        $line['departure_time'] = $_GPC['departure_time'];
        $line['terminal_time'] = $_GPC['terminal_time'];
        $line['uniacid'] = $_W['uniacid'];
        pdo_insert('navlange_pinche_bus_line',$line);
        $id = pdo_insertid();
        message('添加成功！',$this->createWeburl('line',array('op'=>'bus')),'success');
    }
    $departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_departure_station='1' AND uniacid=" . $_W['uniacid']);
    $terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_terminal_station='1' AND uniacid=" . $_W['uniacid']);
} else if ($op == 'edit_bus') {
    if(checksubmit('edit')) {
        $line['departure_station_id'] = $_GPC['departure_station_id'];
        $departure_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['departure_station_id']);
        $line['departure_station'] = $departure_station['name'];
        $line['departure_prov'] = $departure_station['prov'];
        $line['departure_city'] = $departure_station['city'];
        $line['departure_district'] = $departure_station['district'];
        $line['departure_address'] = $departure_station['address'];
        $line['departure_lng'] = $departure_station['lng'];
        $line['departure_lat'] = $departure_station['lat'];
        $line['terminal_station_id'] = $_GPC['terminal_station_id'];
        $terminal_station = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE id=" . $_GPC['terminal_station_id']);
        $line['terminal_station'] = $terminal_station['name'];
        $line['terminal_prov'] = $terminal_station['prov'];
        $line['terminal_city'] = $terminal_station['city'];
        $line['terminal_district'] = $terminal_station['district'];
        $line['terminal_address'] = $terminal_station['address'];
        $line['terminal_lng'] = $terminal_station['lng'];
        $line['terminal_lat'] = $terminal_station['lat'];
        $line['boarding_place'] = $_GPC['boarding_place'];
        $line['price'] = $_GPC['price'];
        $line['fix_departure_time'] = $_GPC['fix_departure_time'];
        $line['departure_time'] = $_GPC['departure_time'];
        $line['terminal_time'] = $_GPC['terminal_time'];
        pdo_update('navlange_pinche_bus_line',$line,array('id'=>$_GPC['id']));
        message('修改成功！','refresh','success');
    }
    if(checksubmit('add_station')) {
        $station['uniacid'] = $_W['uniacid'];
        $station['bus_line_id'] = $_GPC['id'];
        $station['station'] = $_GPC['station'];
        pdo_insert('navlange_pinche_bus_line_station',$station);
        $id = pdo_insertid();
        $last_station = pdo_fetch("SELECT order_index FROM " . tablename('navlange_pinche_bus_line_station') . " WHERE bus_line_id=" . $_GPC['id'] . " ORDER BY order_index DESC");
        if(!empty($last_station)) {
            $order_index = $last_station['order_index'] + 1;
        } else {
            $order_index = 1;
        }
        pdo_update('navlange_pinche_bus_line_station',array('order_index'=>$order_index),array('id'=>$id));
        message('添加成功！','refresh','success');
    }
    if(checksubmit('add_owner')) {
        $owner = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_owner') . " WHERE tel='" . $_GPC['owner_mobile'] . "' AND uniacid=" . $_W['uniacid']);
        if(empty($owner)) {
            message('无此车主！','refresh','error');
        } else {
            $line_owner['uniacid'] = $_W['uniacid'];
            $line_owner['bus_line_id'] = $_GPC['id'];
            $line_owner['owner_id'] = $owner['id'];
            pdo_insert('navlange_pinche_bus_line_owner',$line_owner);
            message('添加成功！','refresh','success');
        }
    }
    $id = $_GPC['id'];
    $line = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_bus_line') . " WHERE id=" . $_GPC['id']);
    $owner = pdo_fetchall("SELECT line_owner.id as id,owner.car_number_1 as car_number_1,owner.car_number_2 as car_number_2,owner.car_number_3 as car_number_3,owner.name as name,owner.tel as tel FROM " . tablename('navlange_pinche_bus_line_owner') . " AS line_owner LEFT JOIN " . tablename('navlange_pinche_owner') . " AS owner ON line_owner.owner_id=owner.id WHERE line_owner.bus_line_id=" . $_GPC['id']);
    $station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_bus_line_station') . " WHERE bus_line_id=" . $_GPC['id'] . " ORDER BY order_index");
    $departure_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_departure_station='1' AND uniacid=" . $_W['uniacid']);
    $terminal_station = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_station') . " WHERE is_pin_terminal_station='1' AND uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_bus_station') {
    pdo_delete('navlange_pinche_bus_line_station',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'set_bus_station_order_index') {
    $bus_line_id = pdo_fetchcolumn("SELECT bus_line_id FROM " . tablename('navlange_pinche_bus_line_station') . " WHERE id=" . $_GPC['id']);
    set_bus_station_order_index($_GPC['id'],$_GPC['order_index'],$bus_line_id);
    message(error(0,''),'','ajax');
} else if ($op == 'search_bus_owner') {
    $owner = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_owner') . " WHERE tel='" . $_GPC['mobile'] . "' AND uniacid=" . $_W['uniacid']);
    if(!empty($owner)) {
        message(error(0,$owner),'','ajax');
    } else {
        message(error(1,''),'','ajax');
    }
} else if ($op == 'delete_bus_owner') {
    pdo_delete('navlange_pinche_bus_line_owner',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}

include $this->template('line');

function set_station_order_index($id,$order_index) {
    $station = pdo_get('navlange_pinche_line_station',array('id'=>$id));
    if($station['order_index'] == $order_index) {
        return;
    }
    pdo_update('navlange_pinche_line_station',array('order_index'=>0),array('id'=>$id));//临时设置为0
    update_next_station($order_index,$station['line_id']);
    pdo_update('navlange_pinche_line_station',array("order_index"=>$order_index),array('id'=>$id));
}
function update_next_station($order_index,$line_id) {
    global $_W;
    $exist = pdo_getall('navlange_pinche_line_station',array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'line_id'=>$line_id));
    if($exist) {
        update_next_station($order_index+1,$line_id);
    }
    pdo_update('navlange_pinche_line_station',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'line_id'=>$line_id));
}

function set_bus_station_order_index($id,$order_index,$bus_line_id) {
    $bus_line_station = pdo_get('navlange_pinche_bus_line_station',array('id'=>$id));
    if($bus_line_station['order_index'] == $order_index) {
        return;
    }
    pdo_update('navlange_pinche_bus_line_station',array('order_index'=>0),array('id'=>$id));
    update_next_bus_station($order_index,$bus_line_id);
    pdo_update('navlange_pinche_bus_line_station',array("order_index"=>$order_index),array('id'=>$id));
}
function update_next_bus_station($order_index,$bus_line_id) {
    global $_W;
    $exist = pdo_getall('navlange_pinche_bus_line_station',array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'bus_line_id'=>$bus_line_id));
    if($exist) {
        update_next_bus_station($order_index+1,$bus_line_id);
    }
    pdo_update('navlange_pinche_bus_line_station',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'uniacid'=>$_W['uniacid'],'bus_line_id'=>$bus_line_id));
}
?>