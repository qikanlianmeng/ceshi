<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=3" />
<style>
    body {
        background-color: #F3F3F3
    }
    a:hover {
        text-decoration: none;
    }
    a:hover {
        color:#929292;
    }
    .mui-bar-tab .mui-tab-item.mui-active {
        color: <?php  echo $conf['color'];?>;
    }
    .owner{
        margin:10px;
        border-radius:5px;
        border:1px #EFEFEF solid;
        background-color: white;
        padding: 10px 10px 0px 10px;
    }
</style>
<script>
mui('body').on('tap','a',function(){document.location.href=this.href;}); 
</script>
<div id="main_panel">
    <!--header class="mui-bar mui-bar-nav">
        <a class="mui-icon mui-icon-person mui-pull-left mui-plus-visble" href="javascript:person()"></a>
        <a class="mui-pull-right" style="font-size:14px;height:44px;line-height: 44px" href="<?php  echo $this->createMobileurl('owner_charter')?>"><img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/owner.png" height="20px" width="auto" />司机</a>
        <?php  if($conf['city_on']=='1') { ?>
        <h1 class="mui-title" onclick="change_city()" style="font-weight: normal"><span class="mui-icon mui-icon-location" style="font-size:16px"></span><?php  echo $this->rtrim_cn($_SESSION['city'],'市');?>&nbsp;<i class="fa fa-angle-down"></i></h1>
        <?php  } ?>
    </header>
    <script>
    var mask = mui.createMask(function(){
        $("#person_panel").hide();
    });//callback为用户点击蒙版时自动执行的回调；;
    function person() {
        mask.show();
        $("#person_panel").show();
    }
    </script>
    <div id="person_panel" style="position: fixed;width:60%;top:0px;height:100%;background-color: white;z-index: 999;display:none">
        <div style="margin-top:40px;text-align: center">
            <img src="<?php  echo $_W['fans']['headimgurl'];?>" width="50px" height="50px" style="border-radius: 40px;border:2px white solid" />
        </div>
        <div style="text-align: center">
            <?php  echo $_W['fans']['nickname'];?>
        </div>
        <?php  if($conf['member_on'] == '1' && $member_info['level_id'] > 0) { ?>
            <div style="text-align: center;font-size:12px;color:grey" onclick="location.href='<?php  echo murl('entry', array('m' => 'navlange_member', 'do' => 'index'), true, true);?>'">
                <?php  echo $member_info['level'];?>
            </div>
        <?php  } ?>
        <div style="margin-top:40px">
            <div style="height:40px;margin-left:30px" onclick="location.href='<?php  echo $this->createMobileurl('my_travel');?>'">
                <div style="width:40px;height:40px;text-align: center;padding-top:9px">
                    <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/travel.png" height="20px" width="auto" />
                </div>
                <div style="margin:-40px 0px 0px 40px;height:40px;line-height: 40px">
                    行程
                </div>
            </div>
            <div style="height:40px;margin-top:20px;margin-left:30px" onclick="location.href='<?php  echo $this->createMobileurl('person');?>'">
                <div style="width:40px;height:40px;text-align: center;padding-top:9px">
                    <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/person_profile.png" height="20px" width="auto" />
                </div>
                <div style="margin:-40px 0px 0px 40px;height:40px;line-height: 40px">
                    乘客中心
                </div>
            </div>
        </div>
    </div>
    <div style="height:44px"></div-->
<?php  if($menu_list) { ?>
    <nav class="mui-bar mui-bar-tab">
        <?php  if(is_array($menu_list)) { foreach($menu_list as $index => $item) { ?>
            <?php  if(($item['name_en']=='general_release' AND $general_release_menu['display']=='1') OR $item['name_en'] != 'general_release') { ?>
                <a class="mui-tab-item<?php  if($item['name_en']=='pin_index') { ?> mui-active<?php  } ?>" href="<?php  echo $item['url'];?>">
                <?php  if($item['name_en'] != 'general_release') { ?>
                    <div style="height:24px;padding-top:2px">
                        <?php  if($item['icon'] != '') { ?>
                        <img src="<?php  if($item['name_en']=='pin_index') echo tomedia($item['icon_active']);else echo tomedia($item['icon']);?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/<?php  echo $item['name_en'];?><?php  if($item['name_en']=='pin_index') echo '_active';?>.png'" width="20px" height="20px" />
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
    <?php  if(!empty($banner_list)) { ?>
    <link rel="stylesheet" href="./resource/components/swiper/swiper.min.css">
    <div class="mui-slider">
        <div class="mui-slider-group mui-slider-loop">
            <div class="mui-slider-item">
                <a href="{$banner_list[count($banner_list)-1]['url']}"><img width="100%" height="auto" src="<?php  echo tomedia($banner_list[count($banner_list)-1]['img'])?>" /></a>
            </div>
            <?php  if(is_array($banner_list)) { foreach($banner_list as $index => $item) { ?>
            <div class="mui-slider-item">
                <a href="<?php  echo $item['url'];?>"><img width="100%" height="auto" src="<?php  echo tomedia($item['img'])?>" /></a>
            </div>
            <?php  } } ?>
            <div class="mui-slider-item">
                <a href="<?php  echo $banner_list[0]['url'];?>"><img width="100%" height="auto" src="<?php  echo tomedia($banner_list[0]['img'])?>" /></a>
            </div>
        </div>
        <div class="mui-slider-indicator">   
            <?php  if(is_array($banner_list)) { foreach($banner_list as $index => $item) { ?>
                <div class="mui-indicator <?php  if($index==0) { ?>mui-active<?php  } ?>"></div> 
            <?php  } } ?>
        </div>  
    </div>
    <script>
    var gallery = mui('.mui-slider');
    gallery.slider({
        interval:5000//自动轮播周期，若为0则不自动播放，默认为0；
    });
    </script>
    <?php  } ?>
    <style>
    .mui-segmented-control.mui-segmented-control-inverted .mui-control-item {
        border-bottom: 2px white solid;
        color:grey;
    }
    .mui-segmented-control.mui-segmented-control-inverted .mui-control-item.mui-active {
        border-bottom: 2px <?php  echo $conf['color'];?> solid;
        color:<?php  echo $conf['color'];?>;
    }
    </style>
    <?php  if($conf['mode_menu_on'] == '1') { ?>
    <div style="margin:0px;background-color: white">
        <div class="mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted" style="height:40px">
            <div id="all_item" class="mui-scroll">
                <?php  if($conf['pin_mode_on'] == '1') { ?>
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('pin_index')?>')">
                    <?php  echo $conf['pin_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['fast_mode_on'] == '1') { ?>
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('fast')?>')">
                    <?php  echo $conf['fast_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['charter_mode_on'] == '1') { ?>
                <a class="mui-control-item mui-active" href="javascript:void(0)">
                    <?php  echo $conf['charter_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['cargo_mode_on'] == '1') { ?>
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('cargo')?>')">
                    <?php  echo $conf['cargo_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['bus_mode_on'] == '1') { ?>
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('bus')?>')">
                    <?php  echo $conf['bus_mode_name'];?>
                </a>
                <?php  } ?>
            </div>
        </div>
    </div>
    <script>
        mui('.mui-scroll-wrapper').scroll({
            deceleration: 0.0005 //flick 减速系数，系数越大，滚动速度越慢，滚动距离越小，默认值0.0006
        });
        function jump_out(url) {
            location.href=url;
        }
    </script>
    <?php  } ?>
    <?php  if(is_array($owner_info)) { foreach($owner_info as $index => $item) { ?>
        <div class="owner">
            <div style="padding-bottom:5px;border-bottom:1px #EFEFEF solid">
                <div style="width:50px;height:40px;text-align: center">
                    <img src="<?php  echo $item['avatar'];?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/default_head_img.png'" width="40px" height="40px" style="border-radius: 20px" />
                </div>
                <div style="height:40px;margin:-40px 0px 0px 50px;height:40px">
                    <div style="height:20px">
                        <?php  echo $item['name'];?>&nbsp;<?php  echo $item['tel'];?>
                    </div>
                    <div style="height:20px;line-height: 20px;color:grey;font-size:12px">
                        <i class="fa fa-map-marker"></i><?php  echo $item['location'];?>
                    </div>
                </div>
            </div>
            <div class="container" style="padding:10px 5px">
                <div class="row">
                    <div class="col-xs-6">
                        <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/car.png" height="20px" width="auto" />&nbsp;<?php  echo $item['car_color'];?>&nbsp;<?php  echo $item['car_series'];?>
                    </div>
                    <div class="col-xs-6" style="text-align: right">
                        <?php  echo $item['car_number_1'];?><?php  echo $item['car_number_2'];?><?php  echo $item['car_number_3'];?>
                    </div>
                </div>
            </div>
            <div style="border-top: 1px #EFEFEF solid"></div>
            <div style="margin:5px auto 0px auto;text-align:center">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="mui-btn mui-btn-primary mui-btn-block" style="padding-top:5px;padding-bottom:5px;font-size:16px" onclick="open_location(<?php  echo $item['lng'];?>,<?php  echo $item['lat'];?>)">
                                导航
                            </button>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="mui-btn mui-btn-warning mui-btn-block" style="background-color: <?php  echo $conf['color'];?>;border-color:<?php  echo $conf['color'];?>;padding-top:5px;padding-bottom:5px;font-size:16px" onclick="location.href='tel:<?php  echo $item['tel'];?>'">
                                拨号
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  } } ?>
</div>
<script>
    wx.config(jssdkconfig);
    function open_location(lng,lat) {
        wx.openLocation({
            latitude: lat, // 纬度，浮点数，范围为90 ~ -90
            longitude: lng, // 经度，浮点数，范围为180 ~ -180。
            name: '', // 位置名
            address: '', // 地址详情说明
            scale: 13, // 地图缩放级别,整形值,范围从1~28。默认为最大
            infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
        });
    }
    function change_city() {
        $("#main_panel").hide();
        $("#city_panel").show();
    }
</script>
<style>
    .city_item {
        height:40px;
        line-height: 40px;
        background-color: white;
        padding:0px 10px;
    }
</style>
<div id="city_panel" style="background-color: <?php  echo $conf['bg_color'];?>;display:none">
    <header class="mui-bar mui-bar-nav">
        <a class="mui-icon mui-icon-left-nav mui-pull-left" href="javascript:cancel_city_select()"></a>
        <h1 class="mui-title">选择城市</h1>
    </header>
    <script type="text/javascript">
        function cancel_city_select() {
            $("#city_panel").hide();
            $("#main_panel").show();
        }
    </script>
    <div style="position: fixed;top:0px;right:0px;width:30px;height:100%;text-align: center;background:rgba(0, 0, 0, 0.1)!important;filter:Alpha(opacity=10); background:#000;z-index: 2;padding-top: 100px;color:grey">
        <?php  if(is_array($all_city)) { foreach($all_city as $index => $item) { ?>
            <div><?php  echo $item['alphabetical_index'];?></div>
        <?php  } } ?>
    </div>
    <div style="height:60px"></div>
    <div style="height:40px;line-height: 40px;background-color: white;padding:0px 10px">
        <span style="color:grey">当前城市：</span>
        <span id="step_2_cur_city"><?php  echo $this->rtrim_cn($_SESSION['city'],'市');?></span>
    </div>
    <?php  if(is_array($all_city)) { foreach($all_city as $index => $item) { ?>
        <div style="height:40px;line-height: 40px;padding:0px 10px;color:grey"><?php  echo $item['alphabetical_index'];?></div>
        <?php  if(is_array($item['city'])) { foreach($item['city'] as $i => $city) { ?>
            <div class="city_item" onclick="sel_city(<?php  echo $city['id'];?>,'<?php  echo $city['city'];?>')">
                <?php  echo $this->rtrim_cn($city['city'],'市');?>
            </div>
        <?php  } } ?>
    <?php  } } ?>
</div>
<script>
$(function(){
    var win_height = document.body.clientHeight;
    $("#city_panel").css('min-height',win_height);
})
function sel_city(id,city) {
    location.href="<?php  echo $this->createMobileurl('charter')?>"+"&city="+id;
}
String.prototype.trim = function (char, type) {
    if (char) {
        if (type == 'left') {
            return this.replace(new RegExp('^\\'+char+'+', 'g'), '');
        } else if (type == 'right') {
            return this.replace(new RegExp('\\'+char+'+$', 'g'), '');
        }
        return this.replace(new RegExp('^\\'+char+'+|\\'+char+'+$', 'g'), '');
    }
    return this.replace(/^\s+|\s+$/g, '');
};
</script>