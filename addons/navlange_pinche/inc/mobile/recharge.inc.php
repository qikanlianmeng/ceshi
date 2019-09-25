<?php
global $_W,$_GPC;
$login_status = $this->check_mobile_login();
if(!$login_status) {
    header("Location: " . murl('entry',array('m'=>'navlange_member','do'=>'login'),true,true));
    exit();
}
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'index';
if($op == 'recharge') {
    $recharge['generate_time'] = TIMESTAMP;
    $recharge['uniacid'] = $_W['uniacid'];
    $recharge['mode'] = '0';
    $recharge['desc'] = '余额充值';
    $recharge['status'] = '0';
    $recharge['money'] = $_GPC['money'];
    $recharge['openid'] = $_W['openid'];
    $recharge['uid'] = $_W['member']['uid'];
    $sn_prefix = date('YmdHis',$recharge['generate_time']);
    $recharge_count = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('navlange_pinche_credit3_record') . " WHERE sn LIKE '" . $sn_prefix . "%'");
    $recharge_count = $recharge_count+1;
    if($recharge_count < 10) {
        $recharge_sn_suffix = '0000' . $recharge_count;
    } else if ($recharge_count < 100) {
        $recharge_sn_suffix = '000' . $recharge_count;
    } else if ($recharge_count < 1000) {
        $recharge_sn_suffix = '00' . $recharge_count;
    } else if ($recharge_count < 10000) {
        $recharge_sn_suffix = '0' . $recharge_count;
    }
    $recharge['sn'] = $sn_prefix . $recharge_sn_suffix;
    $pay_count = pdo_fetchcolumn("SELECT COUNT(plid) FROM " . tablename('core_paylog') . " WHERE tid LIKE '" . $sn_prefix . "%'");
    $pay_count = $pay_count+1;
    if($pay_count < 10) {
        $pay_tid_suffix = '0000' . $pay_count;
    } else if ($pay_count < 100) {
        $pay_tid_suffix = '000' . $pay_count;
    } else if ($pay_count < 1000) {
        $pay_tid_suffix = '00' . $pay_count;
    } else if ($pay_count < 10000) {
        $pay_tid_suffix = '0' . $pay_count;
    }
    $recharge['pay_tid'] = $sn_prefix . $pay_tid_suffix;
    pdo_insert('navlange_pinche_credit3_record',$recharge);
    $conf = pdo_fetch("SELECT debug,debug_money FROM " . tablename('navlange_pay_conf') . " WHERE uniacid=" . $_W['uniacid']);
    if($conf['debug'] == '1') {
        $to_pay = $conf['debug_money'];
    } else {
        $to_pay = $recharge['money'];
    }
    $params = array(
        'tid' => $recharge['pay_tid'],      //充值模块中的订单号，此号码用于业务模块中区分订单，交易的识别码
        'ordersn' => $recharge['sn'],  //收银台中显示的订单号
        'title' => '余额充值：' . $recharge['money'] . '元',          //收银台中显示的标题
        'fee' => $to_pay,      //收银台中显示需要支付的金额,只能大于 0
        'user' => $recharge['openid'],     //付款用户, 付款的用户名(选填项)
        'module' => $this->module['name'],
    );
    $log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $this->module['name'], 'tid' => $params['tid']));
    //在pay方法中，要检测是否已经生成了paylog订单记录，如果没有需要插入一条订单数据
    //未调用系统pay方法的，可以将此代码放至自己的pay方法中，进行漏洞修复
    if (empty($log)) {
        $log = array(
            'uniacid' => $_W['uniacid'],
            'acid' => $_W['acid'],
            'openid' => $recharge['openid'],
            'module' => $this->module['name'], //模块名称，请保证$this可用
            'tid' => $params['tid'],
            'fee' => $params['fee'],
            'card_fee' => $params['fee'],
            'status' => '0',
            'is_usecard' => '0',
        );
        pdo_insert('core_paylog', $log);
    }
    $res['params'] = base64_encode(json_encode($params));
    $pay_conf = pdo_fetch("SELECT debug FROM " . tablename('navlange_pay_conf') . " WHERE uniacid=" . $_W['uniacid']);
    if($pay_conf['debug'] == '1') {
        $res['pay_tid'] = $params['tid'];
        $res['fee'] = $params['fee'];
    }
    message(error(0,$res),'','ajax');
}
$_W['page']['title'] = '';
$_W['page']['sitename'] = '账户充值';
$mc_member = pdo_fetch("SELECT credit3 FROM " . tablename('mc_members') . " WHERE uid=" . $_W['member']['uid']);
$conf = pdo_fetch("SELECT color FROM " . tablename('navlange_pinche_conf') . " WHERE uniacid=" . $_W['uniacid']);
$pay_conf = pdo_fetch("SELECT debug FROM " . tablename('navlange_pay_conf') . " WHERE uniacid=" . $_W['uniacid']);
include $this->template('recharge');
?>