<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
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
        message('添加成功！',$this->createWeburl('comment'),'success');
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
        message('添加成功！',$this->createWeburl('comment',array('op'=>'template')),'success');
    }
	$template = pdo_getall('navlange_pinche_comment_template',array('uniacid'=>$_W['uniacid'],'type'=>'0'));
} else if($op == 'owner_template') {
    if(checksubmit('add')) {
        $comment['content'] = $_GPC['content'];
        $comment['uniacid'] = $_W['uniacid'];
        $comment['type'] = '1';
        pdo_insert('navlange_pinche_comment_template',$comment);
        message('添加成功！',$this->createWeburl('comment',array('op'=>'owner_template')),'success');
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
}
include $this->template('comment');

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