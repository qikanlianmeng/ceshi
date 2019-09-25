<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$owner = pdo_fetchall("SELECT owner.*,mc_member.avatar as avatar FROM " . tablename('navlange_pinche_owner') . " AS owner LEFT JOIN " . tablename('mc_members') . " AS mc_member ON owner.uid=mc_member.uid WHERE owner.uniacid=" . $_W['uniacid'] . " ORDER BY owner.register_time DESC");
} else if ($op == 'change_credit') {
    pdo_update('navlange_pinche_owner',array('credit_score'=>$_GPC['credit_score']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'delete_owner') {
	pdo_delete('navlange_pinche_owner',array('id'=>$_GPC['id']));
	message(error(0, ''), '', 'ajax');
} else if ($op == 'edit') {
	$id = intval($_GPC['id']);
	if(checksubmit('edit')) {
        $owner = pdo_fetch("SELECT uid,openid,status FROM " . tablename('navlange_pinche_owner') . " WHERE id=" . $_GPC['id']);
        $is_wechat = pdo_fetch("SELECT uniacid FROM " . tablename('account_wechats') . " WHERE uniacid=" . $_W['uniacid']);
        if(!empty($is_wechat) && $owner['status'] != $_GPC['status']) {
            $message = pdo_get('navlange_pinche_message',array('uniacid'=>$_W['uniacid']));
            if($_GPC['status'] == '1') {
                $first = "您好，你的车主认证请求已通过，欢迎使用。";
            } else {
                $first = "非常抱歉！你的车主认证求未通过审核。" . $_GPC['note'];
            }
            $data['first'] = array('value'=>$first,'color'=>'#173177');
            $data['keyword1'] = array('value'=>$_GPC['name'],'color'=>'#173177');
            $data['keyword2'] = array('value'=>$_GPC['tel'],'color'=>'#173177');
            $data['keyword3'] = array('value'=>date('Y-m-d H:i',TIMESTAMP),'color'=>'#173177');
            $data['remark'] = array('value'=>'感谢使用！','color'=>'#173177');
            $url = $_W['siteroot'] . ltrim($this->createMobileurl('owner_info'),'./');
            $acidarr = uni_accounts();//获取当前主公众号下的所有子公众号
            reset($acidarr);//重置数组指针
            $account = current($acidarr);//获取第一个字公众号
            $acid = $account['acid'];
            $acc = WeAccount::create($acid);//实例化消息类对象
            $acc->sendTplNotice($owner['openid'],$message['owner_register'],$data,$url,'#FF683F');
        }
		$new_owner['name'] = $_GPC['name'];
        $new_owner['tel'] = $_GPC['tel'];
        $new_owner['total_income'] = $_GPC['total_income'];
        $new_owner['withdrawed_income'] = $_GPC['withdrawed_income'];
        $new_owner['car_number_1'] = $_GPC['car_number_1'];
        $new_owner['car_number_2'] = $_GPC['car_number_2'];
        $new_owner['car_number_3'] = $_GPC['car_number_3'];
        $new_owner['car_series'] = $_GPC['car_series'];
		$new_owner['car_color'] = $_GPC['car_color'];
        $new_owner['vehicle_travel_license'] = $_GPC['vehicle_travel_license'];
        $new_owner['driving_license'] = $_GPC['driving_license'];
        $new_owner['car_img'] = $_GPC['car_img'];
        $new_owner['insurance_img'] = $_GPC['insurance_img'];
        $new_owner['insurance_expire'] = strtotime($_GPC['insurance_expire']);
        $new_owner['status'] = $_GPC['status'];
        pdo_update('navlange_pinche_owner',$new_owner,array('id'=>$_GPC['id']));
        if($_GPC['note'] != '') {
            $note['uniacid'] = $_W['uniacid'];
            $note['owner_id'] = $_GPC['id'];
            $note['owner_uid'] = $owner['uid'];
            $note['content'] = $_GPC['note'];
            $note['time'] = TIMESTAMP;
            pdo_insert('navlange_pinche_owner_note',$note);
        }
		message('设置成功！','refresh','success');
	}
	$owner = pdo_get('navlange_pinche_owner',array('id'=>$_GPC['id']));
    if($owner['inviter_uid'] > 0) {
        $inviter = pdo_fetch("SELECT owner.name as name,mc_member.avatar as avatar FROM " . tablename('navlange_pinche_owner') . " AS owner LEFT JOIN " . tablename('mc_members') . " AS mc_member ON owner.uid=mc_member.uid WHERE owner.uid=" . $owner['inviter_uid']);
    }
} else if ($op == 'add_wx_owner') {
	if(checksubmit('add_submit')) {
		if($_GPC['to_add_sender']==null) {
			message('请先搜索存在的用户，然后添加！','','error');
		}
		$is_exist = pdo_fetch("SELECT id FROM " . tablename('navlange_pinche_owner') . " WHERE uid=" . $_GPC['to_add_sender']);
		if(!empty($is_exist)) {
			message('用户已经是车主，请不要重复添加！','','error');
		}
		$owner['uid'] = $_GPC['to_add_sender'];
		$owner['uniacid'] = $_W['uniacid'];
		$owner['openid'] = pdo_fetchcolumn("SELECT openid FROM " . tablename('mc_mapping_fans') . " WHERE uid=" . $_GPC['to_add_sender']);
		$qc_member = pdo_fetch("SELECT realname,mobile FROM " . tablename('mc_members') . " WHERE uid=" . $_GPC['to_add_sender']);
		$owner['name'] = $qc_member['realname'];
		$owner['tel'] = $qc_member['mobile'];
		$owner['car_number_1'] = $_GPC['car_number_1'];
		$owner['car_number_2'] = $_GPC['car_number_2'];
		$owner['car_number_3'] = $_GPC['car_number_3'];
		$owner['car_color'] = $_GPC['car_color'];
		$owner['car_series'] = $_GPC['car_series'];
		$owner['status'] = '1';
		pdo_insert('navlange_pinche_owner',$owner);
        message('添加成功',$this->createWeburl('owner'),'success');
	}
} else if ($op == 'add_back_owner') {
	if(checksubmit('back_add_submit')) {
		if($_GPC['name']=='') {
            message('请输入用户名！','','error');
        } else if ($_GPC['mobile'] == '') {
            message('请输入联系电话！','','error');
        } else {
            $default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' .tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
            $data = array(
                'uniacid' => $_W['uniacid'], 
                'salt' => random(8),
                'groupid' => $default_groupid, 
                'createtime' => TIMESTAMP,
            );
            $data['realname'] = $_GPC['name'];
            $data['mobile'] = $_GPC['mobile'];
            $data['password'] = md5($_GPC['mobile'] . $data['salt'] . $_W['config']['setting']['authkey']);
            if(!empty($_GPC['avatar'])) {
                $data['avatar'] = tomedia($_GPC['avatar']);     
            } 
            $data['createtime'] = time();
            load()->func('logging');
            logging_run($data);
            pdo_insert('mc_members', $data);
            $owner['uniacid'] = $_W['uniacid'];
            $owner['uid'] = pdo_insertid();
            $owner['uniacid'] = $_W['uniacid'];
			$owner['name'] = $_GPC['name'];
			$owner['tel'] = $_GPC['mobile'];
			$owner['car_number_1'] = $_GPC['car_number_1'];
			$owner['car_number_2'] = $_GPC['car_number_2'];
			$owner['car_number_3'] = $_GPC['car_number_3'];
			$owner['car_color'] = $_GPC['car_color'];
			$owner['car_series'] = $_GPC['car_series'];
            $owner['status'] = '1';
            logging_run($owner);
            pdo_insert('navlange_pinche_owner',$owner);
            message('添加成功',$this->createWeburl('owner'),'success');
        }
	}
} else if ($op == 'search_member') {
    $member = pdo_fetch("SELECT uid,nickname,avatar,realname,mobile FROM " . tablename('mc_members') . " WHERE nickname LIKE '%" . $_GPC['search_key'] . "%'" . " OR realname LIKE '%" . $_GPC['search_key'] . "%'" . " OR mobile LIKE '%" . $_GPC['search_key'] . "%'");
    message(error(0,$member),'','ajax');
} else if ($op == 'client') {
    $client = pdo_fetchall("SELECT client.*,mc_member.avatar as avatar,mc_member.nickname as nickname,mc_member.realname as realname,mc_member.mobile as mobile FROM " . tablename('navlange_pinche_client') . " AS client LEFT JOIN " . tablename('mc_members') . " AS mc_member ON client.uid=mc_member.uid WHERE client.uniacid='" . $_W['uniacid'] . "' ORDER BY register_time DESC");
} else if ($op == 'change_owner_credit') {
    pdo_update('navlange_pinche_client',array('credit_score'=>$_GPC['credit_score']),array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'delete_client') {
    pdo_delete('navlange_pinche_client',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('owner');
?>