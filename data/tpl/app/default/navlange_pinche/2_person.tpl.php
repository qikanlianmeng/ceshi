<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=10" />
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
    .working {
        background-color: <?php  echo $conf['color'];?>;
    }
    .rest {
        background-color: #D4D4D4;
    }
</style>
<script>
	mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
<?php  if($menu_list) { ?>
<nav class="mui-bar mui-bar-tab">
        <?php  if(is_array($menu_list)) { foreach($menu_list as $index => $item) { ?>
            <?php  if(($item['name_en']=='general_release' AND $general_release_menu['display']=='1') OR $item['name_en'] != 'general_release') { ?>
                <a class="mui-tab-item<?php  if($item['name_en']=='person') { ?> mui-active<?php  } ?>" href="<?php  echo $item['url'];?>">
                <?php  if($item['name_en'] != 'general_release') { ?>
                    <div style="height:24px;padding-top:2px">
                        <?php  if($item['icon'] != '') { ?>
                        <img src="<?php  if($item['name_en']=='person') echo tomedia($item['icon_active']);else echo tomedia($item['icon']);?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/<?php  echo $item['name_en'];?><?php  if($item['name_en']=='person') echo '_active';?>.png'" width="20px" height="20px" />
                        <?php  } else { ?>
                            <i class="iconfont icon-<?php  echo $item['icon_name'];?>"></i>
                        <?php  } ?>
                    </div>
                    <div style="height:21px;font-size:12px"><span class="mui-tab-label"><?php  echo $item['customer_name'];?></span></div>
                <?php  } ?>
                </a>
            <?php  } ?>
        <?php  } } ?>
    </nav>

<?php  if($general_release_menu['display'] == '1') { ?>
<div style="width:50px;height:65px;position: fixed;bottom:0px;left:50%;margin-left:-25px;z-index: 11">
        <div style="width:45px;height:45px;line-height: 45px;margin:0px auto;border-radius: 22.5px;background-color: #F7F7F7;text-align:center;color:#929292" onclick="location.href='<?php  echo $this->createMobileurl('general_release')?>'">
            <?php  if($general_release_menu['icon'] != '') { ?>
            <img src="<?php  echo tomedia($release_menu['icon']);?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_reserve_service/template/style/img/release.png'" width="40px" height="40px" />
            <?php  } else { ?>
                <i class="iconfont icon-<?php  echo $general_release_menu['icon_name'];?>" style="font-size:45px"></i>
            <?php  } ?>
        </div>
        <div style="width:50px;height:20px;background-color: #F7F7F7;margin:0px auto;text-align: center;font-size:12px;color:#929292">
            <span class="mui-tab-label"><?php  echo $general_release_menu['customer_name'];?></span>
        </div>
    </div>
<?php  } ?>
<?php  } ?>
<div style="background-color: <?php  echo $conf['color'];?>;color:white;padding:10px" onclick="location.href='<?php  echo murl('entry',array('m'=>'navlange_member','do'=>'profile'),true,true)?>'">
    <div style="width:60px;height:54px;text-align: center">
        <img src="<?php  echo $mc_member['avatar'];?>" width="50px" height="50px" style="border-radius: 25px;border:2px white solid" />
    </div>
    <div style="width:40px;height:54px;text-align: center;line-height: 54px;margin:-54px 0px 0px auto">
        <i class="iconfont icon-right"></i>
    </div>
    <div style="margin:-54px 40px 0px 60px;min-height: 54px;padding-top:5px">
        <div><?php  echo $_W['fans']['nickname'];?></div>
        <div>
            信誉值：<?php  echo $is_owner['credit_score'];?>
        </div>
    </div>
</div>
<div class="container" style="background-color: white">
    <div class="row">
        <div class="col-xs-6" style="border:1px #F3F3F3 solid;line-height: 50px;text-align: center">
            <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/user_center_icon5.png" height="20px" width="auto" />
            <span>余额</span>
            <span style="color:red"><?php  echo $mc_member['credit3'];?></span>
        </div>
        <div class="col-xs-6" style="border:1px #F3F3F3 solid;border-left: 0px;line-height: 50px;text-align: center" onclick="location.href='<?php  echo $this->createMobileurl('my_travel',array('status'=>'3'))?>'">
            <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/integral.png" height="20px" width="auto" />
            <span>积分</span>
            <span style="color:red"><?php  echo intval($_W['member']['credit1'])?></span>
        </div>
    </div>
</div>
<?php  if(!empty($is_owner)) { ?>
    <div style="margin:10px">
        <button id="working_btn" class="mui-btn mui-btn-block <?php  if($is_owner['working_on']=='1') { ?>working<?php  } else { ?>rest<?php  } ?>" style="color:white" onclick="switch_working()"><?php  if($is_owner['working_on']=='1') { ?>接单中<?php  } else { ?>开始接单<?php  } ?></button>
    </div>
<?php  } ?>
<?php  if($conf['person_item_theme'] == '0') { ?>
<div class="container" style="margin-top:10px;padding:0px">
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('wallet')?>'">
        <div style="height:30px">
            <i class="iconfont icon-qianbao" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">我的钱包</div>
    </div>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('award')?>'">
        <div style="height:30px">
            <i class="iconfont icon-jiangli" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">奖励</div>
    </div>
    <?php  if($marketing_conf['coupon_on']=='1') { ?>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo murl('entry',array('m'=>'navlange_member','do'=>'coupon_list'),true,true)?>'">
        <div style="height:30px">
            <i class="iconfont icon-youhuiquan" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">优惠券</div>
    </div>
    <?php  } ?>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('my_travel')?>'">
        <div style="height:30px">
            <i class="iconfont icon-paperplaneempty" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">我的行程</div>
    </div>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo murl('entry',array('m'=>'navlange_member','do'=>'profile'),true,true)?>'">
        <div style="height:30px">
            <i class="iconfont icon-zhanghuziliao" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">我的资料</div>
    </div>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('owner_info')?>'">
        <div style="height:30px">
            <i class="iconfont icon-siji" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">车主信息</div>
    </div>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('store')?>'">
        <div style="height:30px">
            <i class="iconfont icon-tubiaolunkuo-" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">商家中心</div>
    </div>
    <?php  if($marketing_conf['fx_on']=='1') { ?>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo murl('entry',array('m'=>'navlange_fx','do'=>'person'),true,true)?>'">
        <div style="height:30px">
            <i class="iconfont icon-fenxiao" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">分销中心</div>
    </div>
    <?php  } ?>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('help')?>'">
        <div style="height:30px">
            <i class="iconfont icon-bangzhuzhongxin" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">帮助中心</div>
    </div>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid" onclick="location.href='<?php  echo $this->createMobileurl('about_platform')?>'">
        <div style="height:30px">
            <i class="iconfont icon-qunfengguanyupingtai" style="font-size: 30px"></i>
        </div>
        <div style="height:21px">关于平台</div>
    </div>
    <?php  if(is_array($empty_item)) { foreach($empty_item as $index => $item) { ?>
    <div class="col-xs-4" style="background-color: white;color:<?php  echo $conf['color'];?>;text-align: center;padding:10px;border:1px #F3F3F3 solid">
        <div style="height:30px">
            
        </div>
        <div style="height:21px"></div>
    </div>
    <?php  } } ?>
</div>
<?php  } else if($conf['person_item_theme'] == '1') { ?>
<ul class="mui-table-view">
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('wallet')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-qianbao" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                我的钱包
            </div>
        </a>
    </li>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('award')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-jiangli" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                奖励
            </div>
        </a>
    </li>
    <?php  if($marketing_conf['coupon_on']=='1') { ?>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo murl('entry',array('m'=>'navlange_member','do'=>'coupon_list'),true,true)?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-youhuiquan" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                优惠券
            </div>
        </a>
    </li>
    <?php  } ?>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('my_travel')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-paperplaneempty" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                我的行程
            </div>
        </a>
    </li>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo murl('entry',array('m'=>'navlange_member','do'=>'profile'),true,true)?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-zhanghuziliao" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                我的资料
            </div>
        </a>
    </li>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('owner_info')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-siji" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                车主信息
            </div>
        </a>
    </li>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('store')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-tubiaolunkuo-" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                商家中心
            </div>
        </a>
    </li>
    <?php  if($marketing_conf['fx_on']=='1') { ?>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo murl('entry',array('m'=>'navlange_fx','do'=>'person'),true,true)?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-fenxiao" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                分销中心
            </div>
        </a>
    </li>
    <?php  } ?>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('help')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-bangzhuzhongxin" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                帮助中心
            </div>
        </a>
    </li>
    <li class="mui-table-view-cell">
        <a class="mui-navigate-right" href="<?php  echo $this->createMobileurl('about_platform')?>">
            <div style="height:21px;line-height: 21px;width:50px;text-align: center;color:<?php  echo $conf['color'];?>">
                <i class="iconfont icon-qunfengguanyupingtai" style="font-size: 26px"></i>
            </div>
            <div style="height:21px;margin-top:-21px;margin-left:50px">
                关于平台
            </div>
        </a>
    </li>
</ul>
<?php  } ?>
<div style="height:60px"></div>
<script type="text/javascript">
    <?php  if(!empty($is_owner)) { ?>
        var working_on = "<?php  echo $is_owner['working_on'];?>";
        function switch_working() {
            $.post("<?php  echo $this->createMobileurl('person',array('op'=>'switch_working'))?>",function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == '0') {
                        working_on = working_on == '1' ? '0' : '1';
                        if(working_on == '1') {
                            $("#working_btn").removeClass("rest");
                            $("#working_btn").addClass("working");
                            $("#working_btn").html('接单中');
                        } else {
                            $("#working_btn").removeClass("working");
                            $("#working_btn").addClass("rest");
                            $("#working_btn").html('开始接单');
                        }
                    }
                }
            );
        }
    <?php  } ?>
</script>