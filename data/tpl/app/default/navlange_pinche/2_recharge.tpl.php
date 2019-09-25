<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css">
<style>
	.mui-input-group:before {
		height:0px;
	}
	.mui-input-group:after {
		height:0px;
	}
	.mui-input-group .mui-input-row:after {
		height:1px;
		background-color: #c8c7cc;
		left:0px;
	}
</style>
<div style="width:100%;height:80px;background-color: <?php  echo $conf['color'];?>;padding:15px 10px">
    <div style="width:50px;height:50px">
        <img src="<?php  echo $_W['fans']['headimgurl'];?>" width="50px" height="50px" style="border-radius: 40px;border:2px white solid" />
    </div>
    <div style="margin:-50px 0px 0px 60px">
        <div style="height:30px;color:white">
            <?php  echo $_W['fans']['nickname'];?>
        </div>
        <div style="height:20px;color:white">
            <i class="fa fa-cny"></i><span style="font-weight: bold;font-size:20px"><?php  echo $mc_member['credit3'];?></span>
        </div>
    </div>
</div>
<div style="margin-top:50px;margin-left:20px;margin-right:20px">
	<form class="mui-input-group">
	    <div id="other_money" class="mui-input-row">
	        <label>金额（元）</label>
	    	<input id="money" type="number" class="mui-input-clear" placeholder="请输入充值金额">
	    </div>
	    <div class="mui-button-row" style="margin-top:20px">
	        <button type="button" class="mui-btn mui-btn-primary mui-btn-block mui-disabled js-wechat-pay" style="background-color: <?php  echo $conf['color'];?>;border:0px" >确认充值</button>
	    </div>
	</form>
    <form id="pay_form" action="<?php  echo url('mc/cash/wechat');?>" method="post">
        <input type="hidden" name="params" value="" />
        <input type="hidden" name="coupon_id" value="" />
    </form>
</div>
<script>
<?php  if($pay_conf['debug'] == '1') { ?>
var pay_tid = '';
var fee = 0;
<?php  } ?>
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
    $('.js-wechat-pay').removeClass('mui-disabled');
    $('.js-wechat-pay').click(function(){
        if($("#money").val() <= 0) {
            mui.alert("请输入有效充值金额！");
        } else {
            $.post("<?php  echo $this->createMobileurl('recharge',array('op'=>'recharge'))?>",{
                    money:$("#money").val()
                },function(resp) {
                    console.log(resp);
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == 0) {
                        <?php  if($pay_conf['debug'] == '0') { ?>
                        $("input[name='params']").val(resp.message.message.params);
                        $("#pay_form").submit();
                        <?php  } else if($pay_conf['debug'] == '1') { ?>
                        pay_tid = resp.message.message.pay_tid;
                        fee = resp.message.message.fee;
                        $.post("<?php  echo $this->createMobileurl('payDebug')?>",{
                                tid:pay_tid,
                                fee:fee,
                                from:'notify'
                            },function(resp) {
                                resp = $.parseJSON(resp);
                                if(resp.message.errno == 0) {
                                    $.post("<?php  echo $this->createMobileurl('payDebug')?>",{
                                            tid:pay_tid,
                                            fee:fee,
                                            from:'return'
                                        },function(return_resp) {
                                            mui.alert("充值成功！",function() {
                                                location.href="<?php  echo $this->createMobileurl('person')?>";
                                            });
                                        }
                                    );
                                }
                            }
                        );
                        <?php  } ?>
                    }
                }
            );
        }
    });
    //$('.js-wechat-pay').html('微信支付');
});
</script>