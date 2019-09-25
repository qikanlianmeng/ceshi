<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=3" />
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
.time_active {
    background-color: white;
    color:black;
    border-radius: 20px;
    border:1px #F7F7F7 solid;
}
</style>
<script>
    mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
<div id="main_panel">
    <!--header class="mui-bar mui-bar-nav">
        <a class="mui-icon mui-icon-person mui-pull-left mui-plus-visble" href="javascript:person()"></a>
        <a class="mui-pull-right" style="font-size:14px;height:44px;line-height: 44px" href="<?php  echo $this->createMobileurl('owner_fast')?>"><img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/owner.png" height="20px" width="auto" />司机</a>
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
                <a class="mui-control-item mui-active" href="javascript:void(0)">
                    <?php  echo $conf['fast_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['charter_mode_on'] == '1') { ?>
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('charter')?>')">
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
    <div style="margin:10px">
        <?php  if($is_waiting=='1') { ?>
        <div style="text-align: center;color:<?php  echo $conf['color'];?>;font-size:20px">
            <?php  if($travel['status']=='0') { ?>
                待车主接单中...
            <?php  } else if($travel['status'] == '3') { ?>
                待出行...
            <?php  } else if($travel['status'] == '4') { ?>
                出行中...
            <?php  } else if($need_pay == '1') { ?>
                有未支付的订单...
            <?php  } ?>
        </div>
        <?php  } ?>
        <div style="background-color: #FCFCFC;color:#B3B3B3;width:100px;height:40px;border-radius: 20px">
            <div id="time_mode_0" <?php  if($is_waiting=='0' || ($is_waiting=='1' && $travel['is_booking']=='0')) { ?>class="time_active"<?php  } ?> style="width:50px;height:40px;line-height: 40px;text-align: center;font-size:12px" onclick="change_time_mode('0')">
                现在
            </div>
            <div id="time_mode_1" <?php  if($is_waiting=='1' && $travel['is_booking']=='1') { ?>class="time_active"<?php  } ?> style="width:50px;height:40px;margin:-40px 0px 0px 50px;line-height: 40px;text-align: center;font-size:12px" onclick="change_time_mode('1')">
                预约
            </div>
        </div>
        <script>
        var time_mode = '0';
        function change_time_mode(mode) {
            if('<?php  echo $is_waiting;?>' == '0') {
                if(time_mode != mode) {
                    time_mode = mode;
                    if(mode == '0') {
                        $("#time_mode_1").removeClass('time_active');
                        $("#time_mode_0").addClass('time_active');
                        $("#date_item").hide();
                    } else if (mode == '1') {
                        $("#time_mode_1").addClass('time_active');
                        $("#time_mode_0").removeClass('time_active');
                        $("#date_item").show();
                    }
                }
            }
        }
        </script>
        <div id="date_item" style="background-color: white;height:40px;border-top:1px #F3F3F3 solid; <?php  if($is_waiting=='0' || ($is_waiting=='1' && $travel['is_booking']=='0')) { ?>display:none<?php  } ?>">
            <div style="width:30px;height:40px;line-height: 40px;color:#a8a8a8;text-align: center">
                <i class="fa fa-clock-o"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="date" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" <?php  if($is_waiting=='1') { ?>value="<?php  echo date('Y-m-d H:i',$travel['departure_time'])?>" disabled="true" <?php  } ?>  readonly="true" onfocus=this.blur()  placeholder="选择出行时间" />
            </div>
        </div>
        <div style="background-color: white;height:40px;border-top:1px #F3F3F3 solid">
            <div style="width:30px;height:40px;line-height: 40px;color:#3BBBA2;text-align: center">
                <i class="fa fa-circle-o"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="departure_station" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="出发地" onfocus="blur()" onclick="sel_departure_place()" />
                <input type="hidden" id="release_lng" />
                <input type="hidden" id="release_lat" />
            </div>
        </div>
        <div style="background-color: white;height:40px;border-top:1px #F3F3F3 solid">
            <div style="width:30px;height:40px;line-height: 40px;color:#FB8641;text-align: center">
                <i class="fa fa-circle"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="terminal_station" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="目的地" onfocus="blur()" onclick="sel_terminal_place()" />
                <input type="hidden" id="terminal_lng" />
                <input type="hidden" id="terminal_lat" />
            </div>
        </div>
        <?php  if($is_waiting == '0') { ?>
            <div style="margin:20px">
                <button class="mui-btn mui-btn-block" style="background-color: <?php  echo $conf['color'];?>;color:white;border:0px" onclick="release()">发布</button>
            </div>
        <?php  } else if($need_pay == '0') { ?>
            <div style="margin:20px">
                <button class="mui-btn mui-btn-danger mui-btn-block" onclick="cancel(<?php  echo $travel['id'];?>)">取消</button>
            </div>
        <?php  } else if($member['status']=='6') { ?>
            <div style="margin:20px">
                <button class="mui-btn mui-btn-danger mui-btn-block" onclick="location.href='<?php  echo $this->createMobileurl('confirm',array('id'=>$travel['id']))?>'">去支付</button>
            </div>
        <?php  } ?>
    </div>
</div>

<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.css" />
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.js"></script>
<script>
$("#date").click(function(){
    var today = new Date();
    var year = today.getFullYear();
    var dtPicker = new mui.DtPicker({
        beginYear: year,//设置开始日期 
        endYear: year+1
    }); 
    dtPicker.show(function (selectItems) { 
        var str_time = selectItems.y.value+"/"+selectItems.m.value+"/"+selectItems.d.value+" "+selectItems.h.value+":"+selectItems.i.value;
        var sel_date = new Date(str_time);
        var timestamp = Date.parse(sel_date);
        var now = Date.parse(today);
        if(timestamp < now) {
            mui.alert("出行时间已过，请重新选择！");
        } else if (timestamp > (<?php  echo $conf['max_day_to_release'];?>*24*60*60*1000+now)) {
            mui.alert("只能发布<?php  echo $conf['max_day_to_release'];?>天以内的拼车，谢谢您的配合！");
        } else {
            $("#date").val(str_time);
        }
    })
})
function change_city() {
    $("#main_panel").hide();
    $("#city_panel").show();
}
function release() {
    if($("#departure_station").val() == "") {
        mui.alert("请输入出发地点！");
        $("#departure_station").focus();
    } else if ($("#terminal_station").val() == "") {
        mui.alert("请输入终点站！");
        $("#terminal_station").focus();
    } else if(time_mode == '1' && $("#date").val() == "") {
        mui.alert("请选择出行时间！");
    } else {
        $.post("<?php  echo $this->createMobileurl('fast',array('op'=>'release'))?>",{
                time_mode:time_mode,
                date:$("#date").val(),
                departure_station:departure_station,
                departure_city:departure_city,
                departure_district:departure_district,
                terminal_station:terminal_station,
                terminal_city:terminal_city,
                terminal_district:terminal_district,
                lng:$("#release_lng").val(),
                lat:$("#release_lat").val(),
                terminal_lng:$("#terminal_lng").val(),
                terminal_lat:$("#terminal_lat").val()
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == '0') {
                    alert("发布成功！");
                    location.reload();
                }
            }
        );
    }
}
function cancel(id) {
    $.post("<?php  echo $this->createMobileurl('fast',array('op'=>'cancel'))?>",{
            id:id
        },function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == '0') {
                alert('取消成功！');
                location.reload();
            }
        }
    );
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
    location.href="<?php  echo $this->createMobileurl('fast')?>"+"&city="+id;
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

<iframe id="mapPage" width="100%" height="100%" frameborder=0 
    src="https://apis.map.qq.com/tools/locpicker?search=1&type=1&key=7G4BZ-JFT3X-5TQ4M-ZDK7B-AFSP5-NAFV2&referer=myapp" style="display:none">
</iframe> 

<script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp"></script>
<script type="text/javascript">
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
    var departure_station = '';
    var departure_district = '';
    var departure_city = '';
    var terminal_station = '';
    var terminal_district = '';
    var terminal_city = '';
    var cur_place = '0';
    var is_init = '0';
    var geocoder = new qq.maps.Geocoder({
        complete:function(result){
            var addressComponents = result.detail.addressComponents;
            if(is_init == '0') {
                departure_city = addressComponents.city;
                departure_district = addressComponents.district;
                departure_station = addressComponents.street;
                $("#departure_station").val(addressComponents.city.trim('市','right')+'-'+addressComponents.street+'('+addressComponents.district+')');
                is_init = '1';
            } else {
                if(cur_place == '0') {
                    departure_district = addressComponents.district;
                    $("#departure_station").val(departure_city.trim('市','right')+'-'+departure_station+'('+departure_district+')');
                } else if (cur_place == '1') {
                    terminal_district = addressComponents.district;
                    $("#terminal_station").val(terminal_city.trim('市','right')+'-'+terminal_station+'('+terminal_district+')');
                }
            }
        }
    });
    wx.config(jssdkconfig);
    wx.ready(function(){
        wx.getLocation({
            type: 'gcj02', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                $("#release_lng").val(res.longitude);
                $("#release_lat").val(res.latitude);
                var coord=new qq.maps.LatLng(res.latitude,res.longitude);
                geocoder.getAddress(coord);
            }
        });     
    });

    $(function(){
        $("#mapPage").attr('width',window.screen.width);
        $("#mapPage").attr('height',window.screen.height);
    })
    window.addEventListener('message', function(event) {
        // 接收位置信息，用户选择确认位置点后选点组件会触发该事件，回传用户的位置信息
        var loc = event.data;
        if (loc && loc.module == 'locationPicker') {//防止其他应用也会向该页面post信息，需判断module是否为'locationPicker'
            if(cur_place == '0') {
                if(loc.poiname != '我的位置') {
                    departure_city = loc.cityname;
                    departure_station = loc.poiname;
                }
                $("#release_lng").val(loc.latlng.lng);
                $("#release_lat").val(loc.latlng.lat);
            } else if (cur_place == '1') {
                if(loc.poiname != '我的位置') {
                    terminal_city = loc.cityname;
                    terminal_station = loc.poiname;
                }
                $("#terminal_lng").val(loc.latlng.lng);
                $("#terminal_lat").val(loc.latlng.lat);
            }
            var coord=new qq.maps.LatLng(loc.latlng.lat,loc.latlng.lng);
            geocoder.getAddress(coord);
            $("#mapPage").hide();
            $("#main_panel").show();
        }                                
    }, false); 
    function sel_departure_place() {
        cur_place = '0';
        $("#main_panel").hide();
        $("#mapPage").show();
    }
    function sel_terminal_place() {
        cur_place = '1';
        $("#main_panel").hide();
        $("#mapPage").show();
    }
</script>

<script>
function tankuang(pWidth,content) {    
    $("#msg").remove();
    var html ='<div id="msg" style="position:fixed;bottom:30px;width:100%;height:30px;line-height:30px;margin-top:-15px;z-index:1000"><p style="background:#000;opacity:0.8;width:'+ pWidth +'px;color:#fff;text-align:center;padding:10px 10px;margin:0 auto;font-size:12px;border-radius:4px;">'+ content +'</p></div>'
    $("body").append(html);
    var t=setTimeout(next,2000);
    function next() {
        $("#msg").remove();
    }
}
</script>