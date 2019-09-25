<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    if(checksubmit('platform_submit')) {
        $data['owner_amount'] = $_GPC['owner_amount'];
        $data['passenger_amount'] = $_GPC['passenger_amount'];
        pdo_update('navlange_pinche_platform',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    $platform = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_platform') . " WHERE uniacid=" . $_W['uniacid']);
    if(empty($platform)) {
        $data['uniacid'] = $_W['uniacid'];
        pdo_insert('navlange_pinche_platform',$data);
        $platform = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_platform') . " WHERE uniacid=" . $_W['uniacid']);
    }
} else if ($op == 're_cal_platform') {
    $owner_amount = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_owner') . " WHERE uniacid=" . $_W['uniacid']);
    $passenger_amount = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_client') . " WHERE uniacid=" . $_W['uniacid']);
    $resp['owner_amount'] = $owner_amount;
    $resp['passenger_amount'] = $passenger_amount;
    message(error(0,$resp),'','ajax');
} else if($op == 'comment') {
    $comment = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_comment') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY time DESC");
    $comment_info = array();
    foreach ($comment as $key => $value) {
        $data = pdo_fetch("SELECT mc_member.avatar as owner_avatar,mc_member.mobile as owner_mobile FROM " . tablename('mc_members') . " AS mc_member WHERE uid=" . $value['owner_uid']);
        $client = pdo_fetch("SELECT mc_member.avatar as avatar,mc_member.mobile as mobile FROM " . tablename('mc_members') . " AS mc_member WHERE uid=" . $value['uid']);
        $data['avatar'] = $client['avatar'];
        $data['mobile'] = $client['mobile'];
        $pin = pdo_fetch("SELECT departure_station,terminal_station,departure_time FROM " . tablename('navlange_pinche_pin') . " WHERE id=" . $value['pin_id']);
        $data['departure_station'] = $pin['departure_station'];
        $data['terminal_station'] = $pin['terminal_station'];
        $data['departure_time'] = $pin['departure_time'];
        $item = json_decode($value['content']);
        $data['content'] = $item;
        $data['other'] = $value['other'];
        $data['comment_level'] = $value['comment_level'];
        $data['time'] = $value['time'];
        $data['id'] = $value['id'];
        array_push($comment_info,$data);
    }
} else if ($op == 'delete_comment') {
    pdo_delete('navlange_pinche_comment',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if($op == 'level') {
    if(checksubmit('add')) {
        $data['uniacid'] = $_W['uniacid'];
        $data['name']=$_GPC['name'];
        $data['color']=$_GPC['color'];
        $data['score']=$_GPC['score'];
        pdo_insert('navlange_pinche_credit_level',$data);
        $id = pdo_insertid();
        $last_level = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_credit_level') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY order_index DESC");
        if(!empty($last_level)) {
            $order_index = $last_level['order_index'] + 1;
        } else {
            $order_index = 1;
        }
        pdo_update('navlange_pinche_credit_level',array('order_index'=>$order_index),array('id'=>$id));
        message('添加成功！',$this->createWeburl('platform'),'success');
    }
    $all_level = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_credit_level') . " WHERE uniacid=" . $_W['uniacid'] . " ORDER BY order_index");
} else if ($op == 'set_level_order_index') {
    set_level_order_index($_GPC['id'],$_GPC['order_index']);
    message(error(0,''),'','ajax');
} else if ($op == 'delete_level') {
    pdo_delete('navlange_pinche_credit_level',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if($op == 'credit') {
    if(checksubmit('credit_score_submit')) {
        $data['passenger_cancel_pin_credit_score'] = $_GPC['passenger_cancel_pin_credit_score'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message("设置成功！",'refresh','success');
    }
    if(checksubmit('comment_credit_score_submit')) {
        $data['comment_level_0_point'] = $_GPC['level_0'];
        $data['comment_level_1_point'] = $_GPC['level_1'];
        $data['comment_level_2_point'] = $_GPC['level_2'];
        pdo_update('navlange_pinche_conf',$data,array('uniacid'=>$_W['uniacid']));
        message('设置成功！','refresh','success');
    }
    $conf = pdo_fetch("SELECT passenger_cancel_pin_credit_score,comment_level_0_point,comment_level_1_point,comment_level_2_point FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
} else if($op == 'template') {
    if(checksubmit('add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['type'] = '0';
        pdo_insert('navlange_pinche_comment_template',$comment);
        message('添加成功！',$this->createWeburl('platform',array('op'=>'template')),'success');
    }
	$template = pdo_getall('navlange_pinche_comment_template',array('uniacid'=>$_W['uniacid'],'type'=>'0'));
} else if($op == 'owner_template') {
    if(checksubmit('add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['type'] = '1';
        pdo_insert('navlange_pinche_comment_template',$comment);
        message('添加成功！',$this->createWeburl('platform',array('op'=>'owner_template')),'success');
    }
    $template = pdo_getall('navlange_pinche_comment_template',array('uniacid'=>$_W['uniacid'],'type'=>'1'));
} else if ($op == 'delete_template') {
	pdo_delete('navlange_pinche_comment_template',array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'suggestion') {
    $list = pdo_fetchall("SELECT suggestion.id as id,mc_member.avatar as avatar,suggestion.name as name,suggestion.mobile as mobile,suggestion.content as content,suggestion.release_time as release_time FROM " . tablename('navlange_pinche_suggestion') . " AS suggestion LEFT JOIN " . tablename('mc_members') . " AS mc_member ON suggestion.uid=mc_member.uid WHERE suggestion.uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_suggestion') {
    pdo_delete('navlange_pinche_suggestion',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'notice') {
    $notice = pdo_fetchall("SELECT notice.title as title,notice.id as id,type.name as type FROM " . tablename('navlange_pinche_notice') . " AS notice LEFT JOIN " . tablename('navlange_pinche_notice_type') . " AS type ON notice.type=type.id WHERE notice.uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_notice') {
    pdo_delete('navlange_pinche_notice',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'add_notice') {
    if(checksubmit('add_notice')) {
        $notice['uniacid'] = $_W['uniacid'];
        $notice['type'] = $_GPC['type'];
        $notice['title'] = $_GPC['title'];
        $notice['content'] = $_GPC['content'];
        $notice['release_time'] = time();
        pdo_insert('navlange_pinche_notice',$notice);
        message('添加成功！',$this->createWeburl('platform',array('op'=>'notice')),'success');
    }
    $type = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_notice_type') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'edit_notice') {
    if(checksubmit('edit')) {
        $data['type'] = $_GPC['type'];
        $data['title'] = $_GPC['title'];
        $data['content'] = $_GPC['content'];
        pdo_update('navlange_pinche_notice',$data,array('id'=>$_GPC['id']));
        message("修改成功！",'refresh','success');
    }
    $id = $_GPC['id'];
    $notice = pdo_fetch("SELECT * FROM " . tablename('navlange_pinche_notice') . " WHERE id=" . $_GPC['id']);
    $type = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_notice_type') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'notice_type') {
    if(checksubmit('add_type')) {
        $type['uniacid'] = $_W['uniacid'];
        $type['name'] = $_GPC['name'];
        $type['color'] = $_GPC['color'];
        pdo_insert('navlange_pinche_notice_type',$type);
        message('添加成功！','refresh','success');
    }
    $all_type = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_notice_type') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_notice_type') {
    pdo_delete('navlange_pinche_notice_type',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('platform');

function set_level_order_index($id,$order_index) {
    $level = pdo_get('navlange_pinche_credit_level',array('id'=>$id));
    if($level['order_index'] == $order_index) {
        return;
    }
    update_next_level($order_index);
    pdo_update('navlange_pinche_credit_level',array("order_index"=>$order_index),array('id'=>$id));
}
function update_next_level($order_index) {
    global $_W;
    $exist = pdo_getall('navlange_pinche_credit_level',array('order_index'=>$order_index,'uniacid'=>$_W['uniacid']));
    if($exist) {
        update_next_level($order_index+1);
    }
    pdo_update('navlange_pinche_credit_level',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'uniacid'=>$_W['uniacid']));
}
?>