<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=6" />
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
            <img src="<?php  echo tomedia($release_menu['icon']);?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/release.png'" width="40px" height="40px" />
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
    <?php  if($conf['city_on']=='1') { ?>
        <div style="position: absolute;width:100%;height:40px;top:5px;line-height: 40px;text-align: center;z-index: 2">
            <span class="mui-badge" style="padding:5px 10px;color:white;background-color: rgba(0,0,0,.6);" onclick="sel_city()"><span class=" mui-icon mui-icon-location" style="font-size:18px"></span><span style="font-size:12px"><?php  echo $this->rtrim_cn($_SESSION['city'],'市');?> <?php echo $_SESSION['district']=='全城' ? '' : $_SESSION['district']?></span></span>
        </div>
    <?php  } ?>
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
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('cargo')?>')">
                    <?php  echo $conf['cargo_mode_name'];?>
                </a>
                <?php  } ?>
                <?php  if($conf['bus_mode_on'] == '1') { ?>
                <a class="mui-control-item mui-active" href="javascript:void(0)">
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
    <?php  if(!empty($line_info)) { ?>
    <div id="all_pin" style="margin-bottom:90px">
        <?php  if(is_array($line_info)) { foreach($line_info as $index => $vo) { ?>
            <div id="<?php  echo $vo['id'];?>" class="pin">
                <div class="container" style="padding-bottom:8px;padding-top:5px;font-size:12px">
                    <div class="row">
                        <div class="col-xs-7" style="padding:0px 0px 0px 10px">
                            <i class="iconfont icon-yuyue"></i> <span style="font-size:16px"><?php  echo $vo['departure_time'];?></span><i class="iconfont icon-hengxian"></i><span style="font-size:16px"><?php  echo $vo['terminal_time'];?></span>
                        </div>
                        <div class="col-xs-2" style="padding:0px">
                            
                        </div>
                        <div class="col-xs-3" style="padding:0px;text-align: right">
                            <span style="font-size:18px"><?php  echo intval($vo['price'])?></span>元/<span style="font-size:12px">座</span>
                        </div>
                    </div>
                </div>
                <div style="min-height: 50px;padding-left: 8px">
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
                </div>
                <div style="border-top:1px #F3F3F3 solid;padding:10px">
                    途径：
                    <?php  if(is_array($vo['station'])) { foreach($vo['station'] as $i => $station) { ?>
                        <?php  if($i != 0) { ?>
                            -><?php  echo $station['station'];?>
                        <?php  } else { ?>
                            <?php  echo $station['station'];?>
                        <?php  } ?>
                    <?php  } } ?>
                </div>
                <?php  if(!empty($vo['owner'])) { ?>
                <div style="border-top: 1px #EFEFEF solid;height:5px"></div>
                <div style="margin:5px 10px 10px 10px">
                    <?php  if(is_array($vo['owner'])) { foreach($vo['owner'] as $i => $owner) { ?>
                        <div style="width:80px;height:50px;padding-top:10px;margin:0px 0px 0px auto;text-align: right">
                            <button class="mui-btn mui-btn-xs" style="background-color:<?php  echo $conf['color'];?>;color:white" onclick="reserve(<?php  echo $vo['id'];?>,<?php  echo $owner['id'];?>)">预定</button>
                        </div>
                        <div style="padding-bottom: 5px;margin:-50px 80px 0px 0px">
                            <div style="width:50px;text-align: center;height:40px">
                                <img src="<?php  echo tomedia($owner['avatar'])?>" width="40px" height="40px" style="border-radius: 20px" />
                            </div>
                            <div style="margin:-40px 40px 0px 50px;">
                                <div style="white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                                    <?php  echo $owner['name'];?>&#12288;<span style="color:grey"><?php echo $conf['owner_info_available_before_pin'] == '1' ? $this->hidtel($owner['tel']) : $owner['tel']?></span>
                                </div>
                                <div>
                                    <span class="mui-badge" style="border-radius: 2px;background-color:<?php  echo $conf['color'];?>;color:white">信用分：<?php  echo $owner['credit_score'];?></span>
                                    <?php  if($conf['owner_info_available_before_pin']=='0') { ?>
                                    &nbsp;
                                    <span style="color:grey"><?php  echo $owner['car_series'];?>&nbsp;&nbsp;<?php  echo $owner['car_number'];?></span>
                                    <?php  } ?>
                                </div>
                            </div>
                            <div style="width:40px;margin:-40px 0px 0px auto;height:40px;line-height: 40px">
                                <?php  if($conf['owner_info_available_before_pin']=='0') { ?>
                                <a href="tel:<?php  echo $item['tel'];?>" style="color:green"><i class="iconfont icon-bohao" style="font-size:30px"></i></a>
                                <?php  } ?>
                            </div>
                        </div>
                    <?php  } } ?>
                </div>
                <?php  } ?>
                <?php  if($conf['bus_travel_release_on']=='1') { ?>
                <div style="margin:5px 10px">
                    <button class="mui-btn mui-btn-block" style="background-color:<?php  echo $conf['color'];?>;border-color:<?php  echo $conf['color'];?>;color:white" onclick="release(<?php  echo $vo['id'];?>,'<?php  echo $vo['fix_departure_time'];?>')">发布</button>
                </div>
                <?php  } ?>
            </div>
        <?php  } } ?>
    </div>
    <script type="text/javascript">
        var selected_line = 0;
        var fix_departure_time = '0';
        var selected_line_id = 0;
        var selected_owner_id = 0;
        function release(id,is_fix_departure_time) {
            selected_line = id;
            fix_departure_time = is_fix_departure_time;
            mask.show();//显示遮罩
            $("#register").show();
        }
        function reserve(line_id,owner_id) {
            selected_line_id = line_id;
            selected_owner_id = owner_id;
            $("#main_panel").hide();
            $("#join_panel").show();
        }
    </script>
    <?php  } else { ?>
        <div style="width:220px;margin:40px auto">
            <div style="width:90px;height:80px">
                <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/empty_order.png" width="80px" height="80px" />
            </div>
            <div style="margin:-80px 0px 0px 90px;padding-top:30px">
                暂无合适的拼车！
            </div>
        </div>
    <?php  } ?>
</div>

<?php  if($conf['bus_travel_release_on']=='1') { ?>
    <div id="register" style="padding:10px;display:none;position: fixed;top:40%;width:100%;z-index:999">
        <form class="mui-input-group" action="" method="POST" style="z-index:999">
            <div class="mui-input-row">
                <div style="width:80px;height:40px;line-height: 40px;padding-left:15px;font-weight: bold">
                    姓名
                </div>
                <div style="margin:-40px 0px 0px 80px;height:40px">
                    <input type="text" id="name" name="name" value="<?php  echo $user_info['realname'];?>" class="mui-input-clear" placeholder="请输入姓名">
                </div>
            </div>
            <div class="mui-input-row">
                <div style="width:80px;height:40px;line-height: 40px;padding-left:15px;font-weight: bold">
                    联系电话
                </div>
                <div style="margin:-40px 0px 0px 80px;height:40px">
                    <input type="number" id="mobile" name="mobile" value="<?php  echo $user_info['mobile'];?>" class="mui-input-clear" placeholder="请输入联系电话">
                </div>
            </div>
            <div class="mui-input-row">
                <div style="width:80px;height:40px;line-height: 40px;padding-left:15px;font-weight: bold">
                    人数
                </div>
                <div style="margin:-40px 0px 0px 80px;height:40px">
                    <input type="number" id="amount" name="amount" value="1" class="mui-input-clear" placeholder="请输入人数">
                </div>
            </div>
            <div class="mui-input-row">
                <div style="width:80px;height:40px;line-height: 40px;padding-left:15px;font-weight: bold">
                    出行日期
                </div>
                <div style="margin:-40px 0px 0px 80px;height:40px">
                    <input id="date" style="padding:10px 15px;width:100%;background-color: transparent;border:0px;border-radius: 0px;height:40px" readonly="true" onfocus=this.blur()  placeholder="出行日期" />
                </div>
            </div>
            <div class="mui-button-row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="button" class="mui-btn mui-btn-danger mui-btn-block" style="font-size:16px;padding:6px;background-color: #a8a8a8;color:white;border:0px" onclick="release_cancel()">取消</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="mui-btn mui-btn-primary mui-btn-block" style="font-size:16px;padding:6px;background-color: <?php  echo $conf['color'];?>;color:white;border:0px" onclick="register_submit()">确认</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.css" />
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.js"></script>
<script>
function release_cancel() {
    $("#register").hide();
    mask.close();
}
function register_submit() {
    if($("#name").val() == '') {
        mui.alert("请输入姓名！",function(){
            $("#name").focus();
        });
    } else if ($("#mobile").val() == '') {
        mui.alert("请输入联系电话！",function(){
            $("#mobile").focus();
        })
    } else if ($("#amount").val() == '') {
        mui.alert("请输入乘客人数！",function(){
            $("#amount").focus();
        })
    } else if ($("#date").val() == '') {
        mui.alert("请选择出行日期！");
    } else {
        $.post("<?php  echo $this->createMobileurl('bus',array('op'=>'register_submit'))?>",{
                line_id:selected_line,
                name:$("#name").val(),
                mobile:$("#mobile").val(),
                amount:$("#amount").val(),
                date:$("#date").val()
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    mui.alert("发布成功！");
                    $("#register").hide();
                    mask.close();
                }
            }
        );
    }
}
$("#date").click(function(){
    var today = new Date();
    today = new Date(today.getFullYear(),today.getMonth(),today.getDate());
    var year = today.getFullYear();
    if(fix_departure_time == '1') {
        var dtPicker = new mui.DtPicker({
            type:'date',
            beginYear: year,//设置开始日期 
            endYear: year+1
        }); 
    } else {
        var dtPicker = new mui.DtPicker({
            beginYear: year,//设置开始日期 
            endYear: year+1
        }); 
    }
    
    dtPicker.show(function (selectItems) { 
        if(fix_departure_time=='1') {
            var str_time = selectItems.y.value+"/"+selectItems.m.value+"/"+selectItems.d.value;
        } else {
            var str_time = selectItems.y.value+"/"+selectItems.m.value+"/"+selectItems.d.value+" "+selectItems.h.value+":"+selectItems.i.value+":"+selectItems.m.value;
        }
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
</script>
<?php  } ?>

<?php  if($conf['city_on'] == '1') { ?>
<style>
    .city_item {
        height:40px;
        line-height: 40px;
        background-color: white;
        padding:0px 10px;
    }
    .district {
        margin:5px;
    }
    .district.active {
        border:1px <?php  echo $conf['color'];?> solid;
        color:<?php  echo $conf['color'];?>
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
        <span id="step_2_cur_district"><?php  echo $_SESSION['district'];?></span>
    </div>
    <div id="all_district" style="padding:10px 20px 10px 10px;background-color:white">

    </div>
    <?php  if(is_array($all_city)) { foreach($all_city as $index => $item) { ?>
        <div style="height:40px;line-height: 40px;padding:0px 10px;color:grey"><?php  echo $item['alphabetical_index'];?></div>
        <?php  if(is_array($item['city'])) { foreach($item['city'] as $i => $city) { ?>
            <div class="city_item" onclick="sel_city_confirm('<?php  echo $city['prov'];?>','<?php  echo $city['city'];?>')">
                <?php  echo $this->rtrim_cn($city['city'],'市');?>
            </div>
        <?php  } } ?>
    <?php  } } ?>
    <div style="display:none" data-toggle="distpicker"><!-- container -->
        <select name="prov" data-province="<?php  echo $_SESSION['prov'];?>"></select><!-- 省 -->
        <select name="city" data-city="<?php  echo $_SESSION['city'];?>"></select><!-- 市 -->
        <select name="district" data-district=""></select><!-- 市 -->
    </div>
</div>

<script>
var cur_city = "<?php  echo $_SESSION['city'];?>";
var cur_district = "<?php  echo $_SESSION['district'];?>";
var selected_city = "<?php  echo $_SESSION['city'];?>";
var selected_district = "<?php  echo $_SESSION['district'];?>";
function sel_city() {
    $("#main_panel").hide();
    $("#city_panel").show();
    refresh_district();
}
var requireExtend = require.config({
    paths: {
        'distpicker': '<?php  echo $_W['siteroot'];?>addons/navlange_shop/template/style/js/distpicker', //结尾不写.js
        'distpicker.data': '<?php  echo $_W['siteroot'];?>addons/navlange_shop/template/style/js/distpicker.data', //结尾不写.js
    },
    shim:{
        //依赖
        'distpicker' : {
            exports: '$',
            deps: ['distpicker.data']
        },
    }
});
requireExtend(["distpicker"]);

function refresh_district() {
    $("#step_2_cur_city").html(selected_city);
    if(selected_district == '') {
        $("#step_2_cur_district").html("请选择区、县");
        $("#step_2_cur_district").css('color','red');
    } else {
        $("#step_2_cur_district").html(selected_district);
        $("#step_2_cur_district").css('color','black');
    }
    $("#all_district").html("");
    var html = "<button class='district";
    if(selected_district == '全城') {
        html += " active";
    }
    html += "' onclick=\"sel_district_confirm('全城')\">全城</button>";
    $("#all_district").append(html);
    $("select[name='district'] option").each(function() {
        var district = $(this).attr('value');
        if(district != '') {
            var html = "<button class='district";
            if(cur_district == district) {
                html += " active";
            }
            html += "' onclick=\"sel_district_confirm('"+district+"')\">"+district+"</button>";
            $("#all_district").append(html);
        }
    });
}
function sel_city_confirm(prov,city) {
    $("select[name='prov']").val(prov);
    $("select[name='prov']").trigger("change");
    $("select[name='city']").val(city);
    $("select[name='city']").trigger("change");
    selected_city = city;
    selected_district = '';
    refresh_district();
}
function sel_district_confirm(district) {
    location.href="<?php  echo $this->createMobileurl('bus')?>&city="+selected_city+"&district="+district;
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

$(function(){
    var win_height = document.body.clientHeight;
    $("#city_panel").css('min-height',win_height);
})
</script>

<?php  } ?>

    <div id="join_panel" style="display:none">
        <header class="mui-bar mui-bar-nav">
            <a class="mui-icon mui-icon-arrowleft" href="javascript:cancel_release_join()"></a>
            <h1 class="mui-title">发布新的班车专线行程</h1>
        </header>
        <div style="background-color: white;height:40px;border-bottom:1px #F3F3F3 solid;margin-top:45px">
            <div style="width:50px;height:40px;line-height: 40px;color:<?php  echo $conf['color'];?>;text-align: center">
                <i class="iconfont icon-chengke"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 50px">
                <input id="join_name" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="姓名" value="<?php echo $user_info['realname'] ? $user_info['realname'] : $user_info['nickname']?>" />
            </div>
        </div>
        <div style="background-color: white;height:40px;border-bottom:1px #F3F3F3 solid">
            <div style="width:50px;height:40px;line-height: 40px;color:<?php  echo $conf['color'];?>;text-align: center">
                <i class="iconfont icon-bohao"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 50px">
                <input id="join_mobile" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="联系电话" value="<?php  echo $user_info['mobile'];?>" />
            </div>
        </div>
        <div style="height:40px;background-color: white;border-top:1px #F3F3F3 solid">
            <div style="height:40px;line-height: 40px;padding-left: 10px">
                乘客人数：
            </div>
            <div style="height:40px;margin:-40px 0px 0px auto;width:130px;padding-top:3px">
                <div class="mui-numbox" data-numbox-step='1' data-numbox-min='<?php echo $max_amount > 0 ? 1 : 0?>' data-numbox-max='<?php  echo $max_amount;?>'>
                    <button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
                    <input id="join_amount" name="join_amount" class="mui-numbox-input" value="1" type="number" />
                    <button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
                </div>
            </div>
        </div>
        <label style="padding:10px 10px 0px 10px"><i class="iconfont icon-tixing"></i>选择出行服务</label>
        <div style="background-color:white;padding:10px">
            <?php  if(is_array($note_template_list)) { foreach($note_template_list as $index => $item) { ?>
                <button id="note_<?php  echo $item['id'];?>" class="mui-btn mui-btn-default" onclick="change_note_status(<?php  echo $item['id'];?>,'<?php  echo $item['content'];?>')"><?php  echo $item['content'];?></button>
            <?php  } } ?>
        </div>
        <div style="height:50px"></div>
        <div style="position: fixed;bottom:0px;width:100%;height:40px;text-align: center;line-height: 40px;background-color:<?php  echo $conf['color'];?>;color:white" onclick="release_join()">
            确认乘车
        </div>
    </div>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/array.js"></script>
<script type="text/javascript">
    function cancel_release_join() {
        $("#join_panel").hide();
        $("#main_panel").show();
    }
    var selected_notes = new Array();
    function change_note_status(id,content) {
        if(in_array(selected_notes,content)) {
            removeByValue(selected_notes,content);
            $("#note_"+id).removeClass('mui-btn-warning');
        } else {
            selected_notes.push(content);
            $("#note_"+id).addClass('mui-btn-warning');
        }
    }
    function release_join() {
        var note = '';
        for(var i=0; i<selected_notes.length; i++) {
            if(i > 0) {
                note += ';';
            }
            note += selected_notes[i];
        }
        $.post("<?php  echo $this->createMobileurl('bus',array('op'=>'reserve'))?>",{
                line_id: selected_line_id,
                owner_id: selected_owner_id,
                name: $("#join_name").val(),
                mobile: $("#join_mobile").val(),
                amount: $("#join_amount").val(),
                note: note
            },function(response) {
                var res = $.parseJSON(response);
                if(res.message.errno == 0) {
                    location.href="<?php  echo $this->createMobileurl('travel_info')?>&id=" + res.message.message;
                }
            }
        );
    }
</script>