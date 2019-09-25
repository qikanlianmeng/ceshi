<?php
global $_W,$_GPC;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '评论信息';
if($_GPC['role'] == 'owner') {
	$list = pdo_fetchall("SELECT comment_level,content,other,time FROM " . tablename('navlange_pinche_comment') . " WHERE type='0' AND owner_uid=" . $_GPC['uid']);
} else if ($_GPC['role'] == 'client') {
	$list = pdo_fetchall("SELECT comment_level,content,other,time FROM " . tablename('navlange_pinche_comment') . " WHERE type='1' AND uid=" . $_GPC['uid']);
}
foreach ($list as $key => &$value) {
	$value['content'] = json_decode($value['content']);
}
include $this->template('comment_list');
?>