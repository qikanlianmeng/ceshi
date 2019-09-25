<?php
global $_W,$_GPC;
$comment = pdo_fetchall("SELECT comment.* FROM " . tablename('navlange_pinche_comment') . " AS comment LEFT JOIN " . tablename('navlange_pinche_pin') . " AS pin ON comment.pin_id=pin.id WHERE pin.owner_id=" . $_GPC['id']);
$comment_info = array();
foreach ($comment as $key => $value) {
    $fan = pdo_fetch("SELECT uid FROM " . tablename('mc_mapping_fans') . " WHERE openid='" . $value['openid'] . "'");
    if(!empty($fan) && $fan['uid'] != '') {
        $member = pdo_fetch("SELECT avatar,nickname FROM " . tablename('mc_members') . " WHERE uid=" . $fan['uid']);
        $data['avatar'] = $member['avatar'];
        $data['nickname'] = $member['nickname'];
    }
    $data['comment_level'] = $value['comment_level'];
    $item = json_decode($value['content']);
    $data['content'] = $item;
    $data['other'] = $value['other'];
    $data['time'] = $value['time'];
    array_push($comment_info,$data);
}
include $this->template('comment');
?>