<?php
global $_W,$_GPC;
$conf = pdo_fetch("SELECT color FROM " . tablename('navlange_cwash_conf') . " WHERE uniacid=" . $_W['uniacid']);
include $this->template('coupon');
?>