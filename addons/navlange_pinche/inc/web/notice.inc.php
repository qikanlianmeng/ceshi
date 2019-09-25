<?php
global $_W,$_GPC;
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'index') {
    $notice = pdo_fetchall("SELECT notice.title as title,notice.id as id,type.name as type FROM " . tablename('navlange_pinche_notice') . " AS notice LEFT JOIN " . tablename('navlange_pinche_notice_type') . " AS type ON notice.type=type.id WHERE notice.uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_notice') {
    pdo_delete('navlange_pinche_notice',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
} else if ($op == 'add') {
    if(checksubmit('add_notice')) {
        $notice['uniacid'] = $_W['uniacid'];
        $notice['type'] = $_GPC['type'];
        $notice['title'] = $_GPC['title'];
        $notice['content'] = $_GPC['content'];
        $notice['release_time'] = time();
        pdo_insert('navlange_pinche_notice',$notice);
        message('添加成功！',$this->createWeburl('notice'),'success');
    }
    $type = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_notice_type') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'edit') {
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
} else if ($op == 'type') {
    if(checksubmit('add_type')) {
        $type['uniacid'] = $_W['uniacid'];
        $type['name'] = $_GPC['name'];
        $type['color'] = $_GPC['color'];
        pdo_insert('navlange_pinche_notice_type',$type);
        message('添加成功！','refresh','success');
    }
    $all_type = pdo_fetchall("SELECT * FROM " . tablename('navlange_pinche_notice_type') . " WHERE uniacid=" . $_W['uniacid']);
} else if ($op == 'delete_type') {
    pdo_delete('navlange_pinche_notice_type',array('id'=>$_GPC['id']));
    message(error(0,''),'','ajax');
}
include $this->template('notice');
?>