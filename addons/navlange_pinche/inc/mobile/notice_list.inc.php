<?php
global $_W,$_GPC;
$notice = pdo_fetchall("SELECT notice.id as id,notice.title as title,notice.release_time as release_time,type.color as color,type.name as type FROM " . tablename('navlange_pinche_notice') . " AS notice LEFT JOIN " . tablename('navlange_pinche_notice_type') . " AS type ON notice.type=type.id WHERE notice.uniacid=" . $_W['uniacid'] . " ORDER BY notice.release_time DESC");
include $this->template('notice_list');
?>