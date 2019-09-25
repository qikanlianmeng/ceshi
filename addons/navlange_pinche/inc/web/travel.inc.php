<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
	$travel = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_travel') . " WHERE uniacid=" . $_W['uniacid'] . " AND (type='1' OR type='2' OR type='3' OR type='4') ORDER BY release_time DESC");
	$travel_info = array();
    foreach ($travel as $key => $value) {
        $data = $value;
        if($data['type'] == '1' && $data['status']=='0' && $data['departure_time'] < TIMESTAMP) {
            pdo_update('navlange_pinche_travel',array('status'=>'9'),array('id'=>$value['id']));
            $data['status'] = '9';
        }
        array_push($travel_info,$data);
    }
	include $this->template('travel');
} else if ($op == 'delete_travel') {
    pdo_delete('navlange_pinche_member',array('travel_id'=>$_GPC['id']));
    pdo_delete('navlange_pinche_travel',array('id'=>$_GPC['id']));
    pdo_delete('navlange_pinche_gallery',array('travel_id'=>$_GPC['id']));
	message(error(0,''),'','ajax');
}
?>