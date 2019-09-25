<?php
global $_W,$_GPC;
$notice = pdo_fetch("SELECT notice.title as title,notice.release_time as release_time,notice.content as content,type.color as color,type.name as type FROM " . tablename('navlange_pinche_notice') . " AS notice LEFT JOIN " . tablename('navlange_pinche_notice_type') . " AS type ON notice.type=type.id WHERE notice.id=" . $_GPC['id']);
include $this->template('notice');
?>