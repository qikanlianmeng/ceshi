<?php
global $_W;
$_W['page']['title'] = '';
$_W['page']['sitename'] = '使用须知';
$conf = pdo_fetch("SELECT use_notice FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
include $this->template('use_notice');
?>