<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
	$consignee = pdo_getall('mc_member_address',array('uniacid'=>$_W['uniacid'],'uid'=>mc_openid2uid($_W['openid'])));
} else if ($op == 'add') {
	$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
} else if ($op == 'add_submit') {
	$consignee['username'] = $_GPC['name'];
	$consignee['mobile'] = $_GPC['tel'];
	$consignee['province'] = $_GPC['prov'];
	$consignee['city'] = $_GPC['city'];
	$consignee['district'] = $_GPC['district'];
	$consignee['address'] = $_GPC['address'];
	$consignee['uid'] = mc_openid2uid($_W['openid']);
	$consignee['uniacid'] = $_W['uniacid'];
	$exist_consignee = pdo_get('mc_member_address',array('uniacid'=>$_W['uniacid'],'uid'=>mc_openid2uid($_W['openid'])));
	if(empty($exist_consignee)) {
		$consignee['isdefault'] = '1';
	} else {
		if($_GPC['default'] == '1') {
			pdo_update('mc_member_address',array('isdefault'=>'0'),array('uniacid'=>$_W['uniacid'],'uid'=>mc_openid2uid($_W['openid'])));
		}
		$consignee['isdefault'] = $_GPC['default'];
	}
	pdo_insert('mc_member_address',$consignee);
	$id = pdo_insertid('mc_member_address');
	message(error(0,$id),'','ajax');
} else if ($op == 'edit') {
	$conf = pdo_get('navlange_pinche_conf',array('uniacid'=>$_W['uniacid']));
	$consignee = pdo_get('mc_member_address',array('id'=>$_GPC['id']));
} else if ($op == 'edit_submit') {
	$consignee['username'] = $_GPC['name'];
	$consignee['mobile'] = $_GPC['tel'];
	$consignee['province'] = $_GPC['prov'];
	$consignee['city'] = $_GPC['city'];
	$consignee['district'] = $_GPC['district'];
	$consignee['address'] = $_GPC['address'];
	$exist_consignee = pdo_getall('mc_member_address',array('uniacid'=>$_W['uniacid'],'uid'=>mc_openid2uid($_W['openid'])));
	if(count($exist_consignee) == 1) {
		$consignee['isdefault'] = '1';
	} else {
		if($_GPC['default'] == '1') {
			pdo_update('mc_member_address',array('isdefault'=>'0'),array('uniacid'=>$_W['uniacid'],'uid'=>mc_openid2uid($_W['openid'])));
			$consignee['isdefault'] = $_GPC['default'];
		}
	}
	pdo_update('mc_member_address',$consignee,array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'delete_consignee') {
	pdo_delete('mc_member_address',array('id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
} else if ($op == 'get_consignee') {
	$consignee = pdo_get('mc_member_address',array('id'=>$_GPC['id']));
	message(error(0,$consignee),'','ajax');
} else if ($op == 'get_my_consignee') {
	$consignee = pdo_getall('mc_member_address',array('uid'=>mc_openid2uid($_W['openid'])));
	message(error(0,$consignee),'','ajax');
}

include $this->template('consignee');

?>