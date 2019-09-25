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
</style>
<script>
	mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
<header class="mui-bar mui-bar-nav">
    <a class="mui-icon mui-icon-arrowleft mui-pull-left mui-plus-visble" href="javascript:history.go(-1)"></a>
    <h1 class="mui-title">我的钱包</h1>
</header>
<div style="padding:10px;background-color: <?php  echo $conf['color'];?>;color:white;margin-top:45px">
    <div style="font-size:18px">余额（元）</div>
    <div style="font-size:30px;padding:10px 0px"><?php  echo $mc_member['credit3'];?></div>
    <div>余额可用于支付车费</div>
    <div style="text-align: right;margin-top:-30px">
        <button class="mui-btn" style="background-color:white;color:<?php  echo $conf['color'];?>" onclick="location.href='<?php  echo $this->createMobileurl('recharge')?>'">充值</button>
        <?php  if($owner['status']=='1') { ?>
        <button class="mui-btn" style="background-color:<?php  echo $conf['owner_color'];?>;color:white" onclick="location.href='<?php  echo $this->createMobileurl('owner_withdraw')?>'">提现</button>
        <?php  } ?>
    </div>
</div>
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
                    <?php  if($item['mode']=='2') { ?>
                    <span class="mui-badge mui-badge-default">审核中</span>
                    <?php  } else { ?>
                    <span class="mui-badge mui-badge-danger">失败</span>
                    <?php  } ?>
                    </span>
                <?php  } ?>
            </div>
            <div class="col-xs-5" style="text-align: center;padding-top:12px">
                <?php  echo $item['description'];?>
            </div>
        </div>
    <?php  } } ?>
</div>