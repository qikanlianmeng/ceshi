<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=4" />
<style>
body {
    background-color: #F3F3F3
}
.mui-bar-tab .mui-tab-item.mui-active {
    color: <?php  echo $conf['color'];?>;
}
.pin{
    margin:10px;
    border-radius:5px;
    border:1px #EFEFEF solid;
    background-color: white;
    padding: 10px 10px 0px 10px;
}
.info_item{
    margin:5px 15px;
    font-size:80%;
}
a:hover {
    text-decoration: none
}
</style>
<script>
    mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
<div id="main_panel">
    <!--header class="mui-bar mui-bar-nav">
        <a class="mui-icon mui-icon-person mui-pull-left mui-plus-visble" href="javascript:person()"></a>
        <a class="mui-pull-right" style="font-size:14px;height:44px;line-height: 44px" href="<?php  echo $this->createMobileurl('owner_cargo')?>"><img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/owner.png" height="20px" width="auto" />司机</a>
        <?php  if($conf['city_on']=='1') { ?>
        <h1 class="mui-title" style="font-weight: normal"><span class="mui-icon mui-icon-location" style="font-size:16px"></span><span onclick="change_city()"><?php  echo $this->rtrim_cn($_SESSION['city'],'市');?>&nbsp;<i class="fa fa-angle-down"></i></span></h1>
        <?php  } ?>
    </header>
    <script>
    var mask = mui.createMask(function(){
        $("#person_panel").hide();
    });//callback为用户点击蒙版时自动执行的回调；;
    function person() {
        $("#travel_release_panel").hide();
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
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('charter')?>')">
                    <?php  echo $conf['charter_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['cargo_mode_on'] == '1') { ?>
                <a class="mui-control-item mui-active" href="javascript:void(0)">
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
    <?php  if(!empty($line)) { ?>
    <div id="all_pin" style="margin-bottom:90px">
        <?php  if(is_array($line)) { foreach($line as $index => $vo) { ?>
            <div id="<?php  echo $vo['id'];?>" class="pin">
                <div style="width:70px;height:97px;margin:0px 0px 0px auto;text-align: center">
                    <a style="text-decoration: underline;color:<?php  echo $conf['color'];?>" href="<?php  echo $this->createMobileurl('cargo_line_info',array('id'=>$vo['id']))?>">详情</a>
                    <button class="mui-btn mui-btn-xs" style="margin-top:20px;background-color:<?php  echo $conf['color'];?>;color:white" onclick="pin(<?php  echo $vo['id'];?>)">发货</button>
                </div>
                <div style="min-height: 97px;padding-left: 8px;margin:-97px 70px 0px 0px">
                    <div style="white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                        <span style="color:green"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                        <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['departure_city'],'市')?>-<?php  echo $vo['departure_station'];?></span>
                        <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $vo['departure_district'];?></span>
                    </div>
                    <div style="padding-top:5px;white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                        <span style="color:red"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                        <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['terminal_city'],'市')?>-<?php  echo $vo['terminal_station'];?></span>
                        <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $vo['terminal_district'];?></span>
                    </div>
                    <div style="border-top:1px #F3F3F3 solid;padding:10px">
                        途径：<?php  echo $vo['stations_str'];?>
                    </div>
                </div>
                <div style="border-top: 1px #EFEFEF solid;height:5px"></div>
                <div style="margin:5px 10px 10px 10px">
                        <div style="width:80px;height:50px;padding-top:10px;margin:0px 0px 0px auto;text-align: right">
                            <span style="color:<?php  echo $conf['color'];?>" onclick="dail(<?php  echo $vo['tel'];?>)"><i class="iconfont icon-bohao" style="font-size:30px"></i></span>
                        </div>
                        <div style="padding-bottom: 5px;margin:-50px 80px 0px 0px">
                            <div style="width:50px;text-align: center;height:40px">
                                <img src="<?php  echo tomedia($vo['avatar'])?>" width="40px" height="40px" style="border-radius: 20px" />
                            </div>
                            <div style="margin:-40px 40px 0px 50px;">
                                <div style="white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                                    <?php  echo $vo['store_name'];?>&#12288;<span style="color:grey"><?php echo $conf['owner_info_available_before_pin'] == '1' ? $this->hidtel($vo['tel']) : $vo['tel']?></span>
                                </div>
                                <div style="min-height: 20px">
                                    <!--span class="mui-badge" style="border-radius: 2px;background-color:<?php  echo $conf['color'];?>;color:white">信用分：<?php  echo $vo['credit_score'];?></span-->
                                    <?php  if($conf['owner_info_available_before_pin']=='0') { ?>
                                    &nbsp;
                                    <!--span style="color:grey"><?php  echo $vo['car_series'];?>&nbsp;&nbsp;<?php  echo $vo['car_number'];?></span-->
                                    <?php  } ?>
                                </div>
                            </div>
                            <div style="width:40px;margin:-40px 0px 0px auto;height:40px;line-height: 40px">
                                <?php  if($conf['owner_info_available_before_pin']=='0') { ?>
                                <a href="tel:<?php  echo $vo['tel'];?>" style="color:green"><i class="iconfont icon-bohao" style="font-size:30px"></i></a>
                                <?php  } ?>
                            </div>
                        </div>
                </div>
            </div>
        <?php  } } ?>
    </div>
    <script type="text/javascript">
        var selected_line = 0;
        var fix_departure_time = '0';
        var selected_line_id = 0;
        var selected_owner_id = 0;
        function dail(tel) {
            location.href="tel:"+tel;
        }
        function pin(id) {
            location.href="<?php  echo $this->createMobileurl('cargo_release')?>&line="+id;
        }
    </script>
    <?php  } else { ?>
        <div style="width:220px;margin:40px auto">
            <div style="width:90px;height:80px">
                <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/empty_order.png" width="80px" height="80px" />
            </div>
            <div style="margin:-80px 0px 0px 90px;padding-top:30px">
                暂无合适的拼货专线！
            </div>
        </div>
    <?php  } ?>
</div>

<script>
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
    location.href="<?php  echo $this->createMobileurl('cargo')?>"+"&city="+id;
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