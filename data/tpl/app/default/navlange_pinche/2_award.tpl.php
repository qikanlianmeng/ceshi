<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=6" />
<style>
	body{
		background-color: #F3F3F3
	}
    a:hover{
        text-decoration: none
    }
    .mui-bar-tab .mui-tab-item.mui-active {
        color: <?php  echo $conf['color'];?>;
    }
    .mui-segmented-control {
        border:0px;
    }
    .mui-segmented-control .mui-control-item {
        border:0px;
        color:black;
    }
    .mui-segmented-control .mui-control-item.mui-active {
        background-color: white;
        color:red;
        border-bottom:2px red solid;
    }
    .mui-bar-tab .mui-tab-item.mui-active {
        color: <?php  echo $conf['color'];?>;
    }
</style>
<script>
	mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
<?php  if($op == 'index') { ?>
    <div style="text-align: center;margin-top:50px">暂无奖励！</div>
<?php  } else { ?>
    <?php  if($partner && $owner) { ?>
    <div id="segmentedControl" class="mui-segmented-control" style="background-color: white">
        <a class="mui-control-item<?php  if($op == 'partner') { ?> mui-active<?php  } ?>" href="<?php  echo $this->createMobileurl('award',array('op'=>'partner'))?>">
            合伙人奖励
        </a>
        <a class="mui-control-item<?php  if($op == 'owner') { ?> mui-active<?php  } ?>" href="<?php  echo $this->createMobileurl('award',array('op'=>'owner'))?>">
            司机奖励
        </a>
    </div>
    <?php  } ?>
    <?php  if($op == 'partner') { ?>
    <div class="container">
        <?php  if(is_array($record)) { foreach($record as $index => $item) { ?>
            <div class="row" style="background-color:white;border-bottom:1px #F3F3F3 solid">
                <div class="col-xs-3" style="text-align: center;padding:0px">
                    <?php  echo date('Y-m-d H:i:s',$item['generate_time'])?>
                </div>
                <div class="col-xs-2" style="text-align: center;padding:0px;line-height: 45px">
                    <?php  echo $item['money'];?>
                </div>
                <div class="col-xs-2" style="text-align: center;padding:0px;line-height: 45px">
                    <?php  if($item['status']=='1') { ?>
                        <span class="mui-badge mui-badge-success">成功</span>
                    <?php  } else { ?>
                        <span class="mui-badge mui-badge-danger">待审核</span>
                    <?php  } ?>
                </div>
                <div class="col-xs-5" style="text-align: center;padding-top:12px">
                    <?php  echo $item['description'];?>
                </div>
            </div>
        <?php  } } ?>
    </div>
    <?php  } else if($op == 'owner') { ?>
    <div class="container">
        <?php  if(is_array($record)) { foreach($record as $index => $item) { ?>
            <div class="row" style="background-color:white;border-bottom:1px #F3F3F3 solid">
                <div class="col-xs-3" style="text-align: center;padding:0px">
                    <?php  echo date('Y-m-d H:i:s',$item['generate_time'])?>
                </div>
                <div class="col-xs-2" style="text-align: center;padding:0px;line-height: 45px">
                    <?php  echo $item['money'];?>
                </div>
                <div class="col-xs-2" style="text-align: center;padding:0px;line-height: 45px">
                    <?php  if($item['status']=='1') { ?>
                        <span class="mui-badge mui-badge-success">成功</span>
                    <?php  } else { ?>
                        <span class="mui-badge mui-badge-danger">待审核</span>
                    <?php  } ?>
                </div>
                <div class="col-xs-5" style="text-align: center;padding-top:12px">
                    <?php  echo $item['description'];?>
                </div>
            </div>
        <?php  } } ?>
    </div>
    <?php  } ?>
<?php  } ?>
<div style="position: fixed;bottom:0px;height:50px;width:100%;background-color:#000000;background-color:rgba(0,0,0,0.5);line-height: 50px;padding-left:10px">
    <div style="width:60px;height:50px;margin:0px 0px 0px auto;padding-top: 10px">
        <button class="mui-btn mui-btn-danger mui-btn-xs" onclick="withdraw()">提现</button>
    </div>
    <div style="margin:-50px 60px 0px 0px">
        <span style="color:white">总奖励金额：</span><span style="color:white;font-size: 26px">¥<?php  echo $mc_member['credit4'];?></span>
    </div>
</div>
<script type="text/javascript">
    function withdraw() {
        var btnArray=['确定','取消'];
        mui.prompt('请输入提现金额\<br>到账时间：3-5个工作日','有效提现金额','奖励提现',btnArray,function(e) {
            if(e.index == 0) {
                if(!(e.value > 0)) {
                    $(".mui-popup-in").remove();
                    mui.alert("请输入有效金额！",function(){
                        
                    });
                } else if (!(e.value > <?php  echo $conf['withdraw_min'];?>)) {
                    $(".mui-popup-in").remove();
                    mui.alert("提现金额不能低于：<?php  echo $conf['withdraw_min'];?>元！",function(){
                        
                    });
                } else {
                    price = e.value;
                    $.post("<?php  echo $this->createMobileurl('award',array('op'=>'withdraw'))?>",{
                            money:price
                        },function(resp) {
                            console.log(resp);
                            resp = $.parseJSON(resp);
                            if(resp.message.errno == '0') {
                                mui.alert("提取成功！",function(){
                                    location.href="<?php  echo $this->createMobileurl('deposit',array('mode'=>'1'))?>";
                                });
                            } else if (resp.message.errno == '1') {
                                var message = resp.message.message;
                                if (message == 'OVER_CREDIT') {
                                    mui.alert("提取金额超过用户余额！");
                                } else if(message == 'NOTENOUGH') {
                                    mui.alert("系统账户余额不足，请及时联系系统管理员后台提取！");
                                } else {
                                    mui.alert("提取失败，请及时联系系统管理员后台提取！");
                                }
                            } else if (resp.message.errno == '2') {
                                mui.alert("提取申请已提交！",function(){
                                    location.href="<?php  echo $this->createMobileurl('award')?>";
                                });
                            }
                        }
                    );
                }
            }
        })
    }
</script>