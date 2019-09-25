<?php
global $_W,$_GPC;
$permission = $this->permission();
$op = !empty($_GPC['op'])? $_GPC['op'] : 'index';
if($op == 'index') {
    $sql = "SELECT * FROM " . tablename('navlange_pinche_store') . " WHERE uniacid=" . $_W['uniacid'];
    if($permission == 'STORE') {
        $store = pdo_fetch("SELECT id FROM " . tablename('navlange_pinche_store') . " WHERE admin_uid=" . $_W['uid']);
        $sql .= " AND id=" . $store['id'];
    }
    $sql .= " ORDER BY order_index";
	$store = pdo_fetchall($sql);
} else if ($op == 'set_default') {
    if($_GPC['status']=='1') {
        pdo_update('navlange_pinche_store',array('is_default'=>'0'),array('uniacid'=>$_W['uniacid']));
        pdo_update('navlange_pinche_store',array('is_default'=>'1'),array('id'=>$_GPC['id']));
    } else {
        pdo_update('navlange_pinche_store',array('is_default'=>'0'),array('id'=>$_GPC['id']));
    }
    message(error(0,''),'','ajax');
} else if ($op == 'wx') {
    if(checksubmit('cancel_submit')) {
        pdo_update('navlange_pinche_store',array('uid'=>0),array('id'=>$_GPC['id']));
        message('解除绑定成功！','refresh','success');
    }
    if(checksubmit('bind_submit')) {
        pdo_update('navlange_pinche_store',array('uid'=>$_GPC['to_bind_member']),array('id'=>$_GPC['id']));
        message('绑定成功！','refresh','success');
    }
    $id = $_GPC['id'];
    $store = pdo_fetch("SELECT uid FROM " . tablename('navlange_pinche_store') . " WHERE id=" . $_GPC['id']);
    if($store['uid'] > 0) {
        $mc_member = pdo_fetch("SELECT nickname,avatar,realname,mobile FROM " . tablename('mc_members') . " WHERE uid=" . $store['uid']);
    }
} else if ($op == 'edit') {
    $id = $_GPC['id'];
    if(checksubmit('register_submit')) {
        if($_GPC['username'] == '') {
            message('请填写商家登入用户名！','refresh','error');
        }
        if($_GPC['password'] == '') {
            message('请填写商家登入密码！','refresh','error');
        }
        load()->model('user');
        $user['username'] = $_GPC['username'];
        $is_exist = user_check($user);
        if($is_exist) {
            message('用户名已被使用！','refresh','error');
        }
        $user['password'] = $_GPC['password'];
        $user['groupid'] = 1;
        $uid = user_register($user,null);
        $user = user_single($post);
        $data = array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'role' => 'operator'
        );
        pdo_insert('uni_account_users', $data);
        $permission = array(
            'uniacid' => $_W['uniacid'],
            'uid' => $uid,
            'type' => 'navlange_pinche',
            'permission' =>  'all'
        );
        pdo_insert('users_permission',$permission);
        $store['admin_uid'] = $uid;
        $store['username'] = $_GPC['username'];
        $store['password'] = $_GPC['password'];
        pdo_update('navlange_pinche_store',$store,array('id'=>$_GPC['id']));
        message('注册成功！','refresh','success');
    }
    if(checksubmit('edit')) {
		if(!empty($_GPC['img'])) {
			$store['img'] = $_GPC['img'];
		}
		$store['name'] = $_GPC['name'];
        $store['sn'] = $_GPC['sn'];
        $store['prov'] = $_GPC['prov'];
        $store['city'] = $_GPC['city'];
        $store['district'] = $_GPC['district'];
		$store['address'] = $_GPC['address'];
		$store['tel'] = $_GPC['tel'];
		$store['lng'] = $_GPC['lng'];
		$store['lat'] = $_GPC['lat'];
		$store['intro'] = $_GPC['intro'];
        $store['qq'] = $_GPC['qq'];
        $store['email'] = $_GPC['email'];
        $store['wx'] = $_GPC['wx'];
        $store['wx_qrcode'] = $_GPC['wx_qrcode'];
        $store['wxapp'] = $_GPC['wxapp'];
        $store['detail'] = $_GPC['detail'];
        $store['license'] = $_GPC['license'];
        $store['status'] = $_GPC['status'];
		pdo_update('navlange_pinche_store',$store,array('id'=>$_GPC['id']));
		message('修改成功！','refresh','success');
	}
	$store = pdo_get('navlange_pinche_store',array('id'=>$_GPC['id']));
} else if ($op == 'update_username') {
    $username = trim($_GPC['username']);
    $name_exist = pdo_get('users', array('username' => $username));
    if(!empty($name_exist)) {
        message(error(1,''),'','ajax');
    } else {
        pdo_update('users', array('username' => $username), array('uid' => $_GPC['admin_uid']));
        pdo_update('navlange_pinche_store',array('username'=>$username),array('admin_uid'=>$_GPC['admin_uid']));
        message(error(0,''),'','ajax');
    }
} else if ($op == 'update_password') {
    $user = pdo_fetch("SELECT salt FROM " . tablename('users') . " WHERE uid=" . $_GPC['admin_uid']);
    $password = user_hash($_GPC['password'], $user['salt']);
    pdo_update('users', array('password' => $password), array('uid' => $_GPC['admin_uid']));
    pdo_update('navlange_pinche_store',array('password'=>$_GPC['password']),array('admin_uid'=>$_GPC['admin_uid']));
    message(error(0,''),'','ajax');
} else if ($op == 'delete_admin') {
    $store = pdo_fetch("SELECT admin_uid FROM " . tablename('navlange_pinche_store') . " WHERE id=" . $_GPC['id']);
    pdo_delete('users',array('uid'=>$store['admin_uid']));
    pdo_delete('users_permission',array('uid'=>$store['admin_uid']));
    pdo_update('navlange_pinche_store',array('admin_uid'=>0,'username'=>'','password'=>''),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'set_store_order_index') {
    $id = $_GPC['id'];
    $order_index = $_GPC['order_index'];
    $store = pdo_get('navlange_pinche_store',array('id'=>$id));
    if($store['order_index'] != $order_index) {
        update_next_store($order_index);
        pdo_update('navlange_pinche_store',array("order_index"=>$order_index),array('id'=>$id));
    }
    message(error(0,''),'','ajax');
} else if ($op == 'delete_store') {
    $store = pdo_fetch("SELECT admin_uid FROM " . tablename('navlange_pinche_store') . " WHERE id=" . $_GPC['id']);
    pdo_delete('users',array('uid'=>$store['admin_uid']));
    pdo_delete('users_permission',array('uid'=>$store['admin_uid']));
    pdo_delete('navlange_pinche_store',array('id'=>$_GPC['id'],));
	message(error(0,''),'','ajax');
} else if ($op == 'post') {
    if(checksubmit('add')) {
        $exist_store = pdo_get('navlange_pinche_store',array('name'=>$_GPC['name'],'uniacid'=>$_W['uniacid']));
        if(!empty($exist_store)) {
            message('商家名称已存在！','refresh','error');
        } else {
            if(!empty($_GPC['img'])) {
                $store['img'] = $_GPC['img'];
            }
            $store['name'] = $_GPC['name'];
            $store['sn'] = $_GPC['sn'];
            $store['prov'] = $_GPC['prov'];
            $store['city'] = $_GPC['city'];
            $store['district'] = $_GPC['district'];
            $store['address'] = $_GPC['address'];
            $store['tel'] = $_GPC['tel'];
            $store['intro'] = $_GPC['intro'];
            $store['qq'] = $_GPC['qq'];
            $store['email'] = $_GPC['email'];
            $store['wx'] = $_GPC['wx'];
            $store['wx_qrcode'] = $_GPC['wx_qrcode'];
            $store['wxapp'] = $_GPC['wxapp'];
            $store['detail'] = $_GPC['detail'];
            $store['uniacid'] = $_W['uniacid'];
            $store['license'] = $_GPC['license'];
            pdo_insert('navlange_pinche_store',$store);
            message('添加成功！',$this->createWeburl('store'),'success');
        }
    }
}
include $this->template('store');

function update_next_store($order_index) {
    global $_W;
    $exist = pdo_getall('navlange_pinche_store',array('order_index'=>$order_index,'uniacid'=>$_W['uniacid']));
    if($exist) {
        update_next_store($order_index+1);
    }
    pdo_update('navlange_pinche_store',array('order_index'=>($order_index+1)),array('order_index'=>$order_index,'uniacid'=>$_W['uniacid']));
}
?>