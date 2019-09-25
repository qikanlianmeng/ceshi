<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=3" />
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.css" />
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.js"></script>
<style>
	body {
		background-color:#F3F3F3;
	}
    .mui-segmented-control.mui-segmented-control-inverted .mui-control-item {
        border-bottom: 2px white solid;
        color:grey;
    }
    .mui-segmented-control.mui-segmented-control-inverted .mui-control-item.mui-active {
        border-bottom: 2px <?php  echo $conf['color'];?> solid;
        color:<?php  echo $conf['color'];?>;
    }
    .mui-bar-tab .mui-tab-item.mui-active {
        color: <?php  echo $conf['color'];?>;
    }
    .mode {
        height:35px;
        line-height: 33px;
        width:50px;
        margin:0px auto;
        text-align: center
    }
	.mode_active {
		border-bottom:2px <?php  echo $conf['color'];?> solid;
		color:<?php  echo $conf['color'];?>
	}
    a:hover {
        text-decoration: none
    }
    .pin {
        margin:5px;
        padding:5px 10px;
        background-color:white;
    }
    .travel {
        margin:5px;
        padding:5px 10px;
        background-color:white;
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
    <?php  if($conf['mode_menu_on'] == '1' && ($conf['pin_mode_on']=='1' OR $conf['fast_mode_on']=='1' OR $conf['charter_mode_on']=='1' OR $conf['cargo_mode_on']=='1' OR $conf['bus_mode_on']=='1')) { ?>
    <div style="margin:0px;background-color: white">
        <div class="mui-scroll-wrapper mui-slider-indicator mui-segmented-control mui-segmented-control-inverted" style="height:40px">
            <div id="all_item" class="mui-scroll">
                <?php  if($conf['pin_mode_on'] == '1') { ?>
                <a class="mui-control-item mui-active" href="javascript:void(0)">
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
                <a class="mui-control-item" href="javascript:jump_out('<?php  echo $this->createMobileurl('bus')?>')">
                    <?php  echo $conf['bus_mode_name'];?>
                </a>
                <?php  } ?>
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
    </div>
    <div id="pin_panel">
        <?php  if(!empty($pin_info)) { ?>
        <?php  if(is_array($pin_info)) { foreach($pin_info as $index => $item) { ?>
            <div class="pin">
                <div style="padding-bottom: 5px">
                    <div style="width:50px;text-align: center;height:40px">
                        <img src="<?php  echo $item['avatar'];?>" width="40px" height="40px" style="border-radius: 20px" />
                    </div>
                    <div style="margin:-40px 40px 0px 50px;">
                        <div style="white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                            <?php  echo $item['nickname'];?>&#12288;<span style="color:grey"><?php echo $conf['owner_info_available_before_pin'] == '1' ? $this->hidtel($item['tel']) : $item['tel']?></span>
                        </div>
                        <div>
                            <span class="mui-badge" style="border-radius: 2px;background-color:<?php  echo $conf['color'];?>;color:white">信用分：<?php  echo $item['credit_score'];?></span>
                            <?php  if($conf['owner_info_available_before_pin']=='0') { ?>
                            &nbsp;
                            <span style="color:grey"><?php  echo $item['car_series'];?>&nbsp;&nbsp;<?php  echo $item['car_number'];?></span>
                            <?php  } ?>
                            <?php  if($conf['comment_display_on'] == '1') { ?>
                            &nbsp;<a href="<?php  echo $this->createMobileurl('comment_list',array('role'=>'owner','uid'=>$item['uid']))?>" style="color:<?php  echo $conf['color'];?>;text-decoration: underline;">评论</a>
                            <?php  } ?>
                        </div>
                    </div>
                    <div style="width:40px;margin:-40px 0px 0px auto;height:40px;line-height: 40px">
                        <?php  if($conf['owner_info_available_before_pin']=='0') { ?>
                        <a href="tel:<?php  echo $item['tel'];?>" style="color:green"><i class="iconfont icon-bohao" style="font-size:30px"></i></a>
                        <?php  } ?>
                    </div>
                </div>
                <div class="container" style="border-top:1px #F3F3F3 solid;padding-bottom:8px;padding-top:5px;font-size:12px">
                    <div class="row">
                        <div class="col-xs-7" style="padding:0px 0px 0px 10px">
                            <i class="iconfont icon-yuyue"></i> <?php  echo date('m月d日 H:i',$item['departure_time'])?>
                        </div>
                        <div class="col-xs-2" style="padding:0px">
                                <?php  if($item['left_amount']>0) { ?>
                                    <?php  echo $item['left_amount'];?>座
                                <?php  } else { ?>
                                <span style="color:red">已满</span>
                                <?php  } ?>
                        </div>
                        <div class="col-xs-3" style="padding:0px;text-align: right">
                            <span style="font-size:18px"><?php  echo intval($item['price'])?></span>元/<span style="font-size:12px">座</span>
                        </div>
                    </div>
                </div>
                <div style="min-height: 50px;padding-left: 8px">
                    <div style="white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                        <span style="color:green"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                        <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($item['departure_city'],'市')?>-<?php  echo $item['departure_station'];?></span>
                        <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $item['departure_district'];?></span>
                    </div>
                    <div style="padding-top:5px;white-space: nowrap;text-overflow:ellipsis; overflow:hidden;">
                        <span style="color:red"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                        <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($item['terminal_city'],'市')?>-<?php  echo $item['terminal_station'];?></span>
                        <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $item['terminal_district'];?></span>
                    </div>
                </div>
                <div style="border-top:1px #F3F3F3 solid;">
                    <div style="width:80px;margin:0px 0px 0px auto;padding-top:8px">
                        <?php  if($item['status']=='9') { ?>
                            <i class="iconfont icon-yiguoqi" style="font-size:30px"></i>
                        <?php  } else { ?>
                            <button class="mui-btn" style="background-color:<?php  echo $conf['color'];?>;border-color:<?php  echo $conf['color'];?>;color:white" onclick="pin(<?php  echo $item['id'];?>)">请TA接我</button>
                        <?php  } ?>
                    </div>
                    <?php  if($item['stations']) { ?>
                        <div style="margin:-41px 80px 0px 0px;min-height: 41px;padding-top:10px;color:grey">
                            途径：<?php  echo $item['stations'];?>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        <?php  } } ?>
        <?php  } else { ?>
            <div style="margin-top:80px;text-align: center">
                <i class="iconfont icon-dengdai" style="font-size:50px;color:grey"></i>
            </div>
            <div style="text-align: center;padding-top:10px;color:grey">
                暂无匹配的司机发布！<a href="<?php  echo $this->createMobileurl('pin_index')?>" style="color:grey;text-decoration: underline;">查看其它</a>
            </div>
        <?php  } ?>
    </div>
    <script>
        Date.prototype.format = function(format) {
            var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
            };
            if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
            }
            for (var k in date) {
                if (new RegExp("(" + k + ")").test(format)) {
                    format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
                }
            }
            return format;
        }
        var mask = mui.createMask(function(){
            $("#register").hide();
            $("#release_btn").show();
            $("#release_panel").css('margin-left','50px');
            $("#release_detail").hide();
            $("#person_panel").hide();
            $("#travel_panel").hide();
        });//callback为用户点击蒙版时自动执行的回调；;
        var pin_id;
        var travel_id;
        function pin(id) {
            $.post("<?php  echo $this->createMobileurl('join_pin_check')?>",{
                    id:id
                },function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == 0) {
                        pin_id = id;
                        if(!resp.message.message) {
                            $("#register").show();
                            $("#main_panel").hide();
                        } else {
                            var travel_info = resp.message.message;
                            travel_id = travel_info.id;
                            var newDate = new Date();
                            newDate.setTime(travel_info.departure_time * 1000);
                            $("#travel_departure_time").html(newDate.format('dd/MM hh:mm'));
                            $("#travel_passenger_count").html(travel_info.amount);
                            $("#travel_departure_station").html(travel_info.departure_station);
                            $("#travel_terminal_station").html(travel_info.terminal_station);
                            $("#travel_expected_price").html(travel_info.expected_price);
                            $("#travel_panel").show();
                            mask.show();//显示遮罩
                        }
                    } else if(resp.message.errno == '1') {
                        alert("您已拼过该车，请不要重复拼车！");
                    } else if (resp.message.errno == '4') {
                        alert("该车已拼满！");
                    } else if (resp.message.errno == '2') {
                        alert("该车剩余座位数量不满足您此次拼车！");
                    } else if (resp.message.errno == '3') {
                        alert("您是车主，不能参与自己发布的拼车！");
                    } else if (resp.message.errno == '5') {
                        var btnArray = ['取消','立即发布'];
                        mui.confirm('需要先发布出行才能拼车！','',btnArray,function(e){
                            if(e.index == 1) {
                                location.href="<?php  echo $this->createMobileurl('travel_release_pin')?>";
                            }
                        })
                    } else if (resp.message.errno == '6') {
                        $("#mobile_register_panel").show();
                    } else if (resp.message.errno == '7') {
                        var btnArray = ['取消','立即完善'];
                        mui.confirm('请完善联系方式，方便车主联系您！','',btnArray,function(e){
                            if(e.index == 1) {
                                location.href="<?php  echo murl('entry',array('m'=>'navlange_member','do'=>'mobile','navlange_from'=>'pin_index'),true,true)?>";
                            }
                        })
                    }
                }
            );
        }
        </script>
    </script>

        <div id="travel_panel" style="position: fixed;bottom:0px;width:100%;background-color:white;z-index: 999;padding:10px;display:none">
            <div style="border-bottom:1px #F3F3F3 solid">
                <div style="width:60px;height:40px">
                    <button class="mui-btn mui-btn-xs" onclick="cancel_join()">取消</button>
                </div>
                <div style="margin:-40px 60px 0px 60px;height:40px;line-height: 40px;text-align: center">
                    <label>请确认您的行程</label>
                </div>
                <div style="width:60px;height:40px;margin:-40px 0px 0px auto">
                    <button class="mui-btn mui-btn-xs mui-btn-success" onclick="confirm_join()">确认</button>
                </div>
            </div>
            <div style="padding-top:10px">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6" style="padding:0px">
                            <span><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                            <span style="position: relative;top:-5px" id="travel_departure_time">--</span>
                        </div>
                        <div class="col-xs-6">
                            <span>拼座</span>
                            <span id="travel_passenger_count">--</span>
                        </div>
                    </div>
                    
                </div>
                <div>
                    <span style="color:green"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                    <span style="position: relative;top:-5px" id="travel_departure_station">--</span>
                </div>
                <div>
                    <span style="color:red"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                    <span style="position: relative;top:-5px" id="travel_terminal_station">--</span>
                </div>
            </div>
            <div style="text-align: right;font-size:20px">
                <span id="travel_expected_price">--</span>元
            </div>
        </div>
        <script>
            function cancel_join() {
                $("travel_panel").hide();
                mask.close();
            }
            function confirm_join() {
                $.post("<?php  echo $this->createMobileurl('join_pin_submit')?>",{
                        id:pin_id,
                        travel_id:travel_id
                    },function(resp) {
                        mask.close();//显示遮罩
                        $("#travel_panel").hide();
                        resp = $.parseJSON(resp);
                        if(resp.message.errno == '1') {
                            alert("您已拼过该车，请不要重复拼车！");
                        } else if (resp.message.errno == '4') {
                            alert("该车已拼满！");
                        } else if (resp.message.errno == '2') {
                            alert("该车剩余座位数量不满足您此次拼车！");
                        } else if (resp.message.errno == '3') {
                            alert("您是车主，不能参与自己发布的拼车！");
                        } else if (resp.message.errno == '5') {
                            var btnArray = ['取消','立即发布'];
                            mui.confirm('需要先发布出行才能拼车！','',btnArray,function(e){
                                if(e.index == 1) {
                                    location.href="<?php  echo $this->createMobileurl('travel_release_pin')?>";
                                }
                            })
                        } else {
                            mui.alert("拼车成功！",function(){
                                location.href="<?php  echo $this->createMobileurl('travel_info')?>&id="+travel_id;
                            })
                        }
                    }
                );
            }
        </script>
    <div style="height:60px"></div>
</div>

    <div id="register" style="display:none">
        <header class="mui-bar mui-bar-nav">
            <a class="mui-icon mui-icon-arrowleft" href="javascript:cancel_release_join()"></a>
            <h1 class="mui-title">发布新的行程拼车</h1>
        </header>
        <div style="background-color: white;height:40px;border-bottom:1px #F3F3F3 solid;margin-top:45px">
            <div style="width:30px;height:40px;line-height: 40px;color:#3BBBA2;text-align: center">
                <i class="fa fa-circle-o"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="departure_station" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="出发地" onfocus="blur()" onclick="sel_departure_place()" />
                <input type="hidden" id="lng" />
                <input type="hidden" id="lat" />
            </div>
        </div>
        <div style="background-color: white;height:40px;border-bottom:1px #F3F3F3 solid">
            <div style="width:30px;height:40px;line-height: 40px;color:#FB8641;text-align: center">
                <i class="fa fa-circle"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="terminal_station" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="目的地" onfocus="blur()" onclick="sel_terminal_place()" />
                <input type="hidden" id="terminal_lng" />
                <input type="hidden" id="terminal_lat" />
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-6" style="padding:0px;border-right: 1px #F3F3F3 solid">
                    <div style="background-color: white;height:40px;border-top:1px #F3F3F3 solid">
                        <div style="width:30px;height:40px;line-height: 40px;color:#a8a8a8;text-align: center">
                            <i class="fa fa-circle-o"></i>
                        </div>
                        <div style="height:40px;margin:-40px 0px 0px 30px">
                            <input id="date" readonly="true" onfocus="blur()" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="出行时间" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding:0px">
                    <div style="background-color: white;height:40px;border-top:1px #F3F3F3 solid">
                        <div style="width:30px;height:40px;line-height: 40px;color:#a8a8a8;text-align: center">
                            <i class="fa fa-circle-o"></i>
                        </div>
                        <div style="height:40px;margin:-40px 0px 0px 30px">
                            <input id="expected_price" type="number" step="0.01" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="期望价格" />
                        </div>
                        <div style="width:30px;height:40px;line-height: 40px;margin:-40px 0px 0px auto;color:#a8a8a8;text-align: center">
                            元
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height:40px;background-color: white;border-top:1px #F3F3F3 solid">
            <div style="height:40px;line-height: 40px;padding-left: 10px">
                乘客人数：
            </div>
            <div style="height:40px;margin:-40px 0px 0px auto;width:130px;padding-top:3px">
                <div class="mui-numbox" data-numbox-step='1' data-numbox-min='<?php echo $max_amount > 0 ? 1 : 0?>' data-numbox-max='<?php  echo $max_amount;?>'>
                    <button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
                    <input id="amount" name="amount" class="mui-numbox-input" value="1" type="number" />
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
            确认发布与拼车
        </div>
    </div>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/array.js"></script>
<script>
    function cancel_release_join() {
        $("#register").hide();
        $("#main_panel").show();
    }
    Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
    }
    $("#date").click(function(){
        var today = new Date();
        var year = today.getFullYear();
        var start = Date.parse(today)+30*60*1000;
        var start_d = new Date(start);
        var dtPicker = new mui.DtPicker({
            beginYear: year,//设置开始日期 
            endYear: year+1,
            value:start_d.format('yyyy-MM-dd h:m')
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
        if($("#departure_station").val()=="") {
            alert("请选择出发站点！");
            $("#departure_station").focus();
        } else if($("#terminal_station").val()=="") {
            alert("请选择目的站点！");
            $("#terminal_station").focus();
        } else if(!(parseInt($("#amount").val()) > 0)) {
            alert("请选择乘车人数！");
            $("#amount").focus();
        } else if($("#date").val()=="") {
            alert("请选择出行时间！");
            $("#date").focus();
        } else if (!(parseFloat($("#expected_price").val()) > 0)) {
            alert("请输入有效期望价格！");
            $("#expected_price").focus();
        } else {
            $.post("<?php  echo $this->createMobileurl('join_pin_submit')?>",{
                    id:pin_id,
                    departure_station:departure_station,
                    departure_district: departure_district,
                    departure_city:departure_city,
                    terminal_station:terminal_station,
                    terminal_district: terminal_district,
                    terminal_city:terminal_city,
                    departure_time:$("#date").val(),
                    amount:$("#amount").val(),
                    lng:$("#release_lng").val(),
                    lat:$("#release_lat").val(),
                    terminal_lng:$("#terminal_lng").val(),
                    terminal_lat:$("#terminal_lat").val(),
                    expected_price:$("#expected_price").val(),
                    note:$("#note").val()
                },function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == '0') {
                        travel_id = resp.message.message;
                        mui.alert("拼车成功！",function(){
                            location.href="<?php  echo $this->createMobileurl('travel_info')?>&id="+travel_id;
                        });
                    } else if (resp.message.errno == '1') {
                        $status = resp.message.message;
                        if($status == '1') {
                            mui.alert("您有未完成的出行，请不要重复发布出行！");
                        } else if ($status == '2') {
                            mui.alert("您有未完成的出车，暂时不能发布出行！");
                        }
                    } else if (resp.message.errno == '2') {
                        
                    }
                }
            );
        }
    }
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
            $("#register").show();
        }                                
    }, false); 
    function sel_departure_place() {
        cur_place = '0';
        $("#register").hide();
        $("#mapPage").show();
    }
    function sel_terminal_place() {
        cur_place = '1';
        $("#register").hide();
        $("#mapPage").show();
    }
</script>

<script>
$(function(){
    var win_height = document.body.clientHeight;
    $("#city_panel").css('min-height',win_height);
})
function sel_city(id,city) {
    location.href="<?php  echo $this->createMobileurl('index')?>"+"&city="+id;
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

<div id="district_panel" style="width:100%;height:100%;display:none;z-index: 999;position: fixed;">
    <div id="map_container" style="position: fixed;width:100%;height:100%;top:0px">

    </div>
    <div style="position: fixed;top:10px;width:100%;">
        <div style="margin:0px 10px">
            <div class="input-group">
                <input id="search_address" class="form-control" placeholder="请输入地址">
                <span class="input-group-addon" onclick="theLocation()"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>
    <div style="position: fixed;bottom:0px;width:100%;text-align: center;background:rgba(0, 0, 0, 0.6)!important;filter:Alpha(opacity=60); background:#000;padding:5px;color:white">
        <div class="container">
            <div class="row">
                <div class="col-xs-8" style="text-align: left;line-height: 33px">
                    精确地图标注有助于司机找到您！
                </div>
                <div class="col-xs-4" style="text-align: right">
                    <button class="mui-btn mui-btn-warning" onclick="sel_address_confirm()">选取</button>
                </div>
            </div>              
        </div>
    </div>
</div>
<script>
    function sel_address_confirm() {
        $('#district_panel').hide();
        $("#main_panel").show();
        tankuang(200,'地图标注成功！');
    }
</script>

<div id="mobile_register_panel" style="display: none">
    <div style="position: fixed;top:0px;width:100%;height:100%;background:rgba(0, 0, 0, 0.6)!important;filter:Alpha(opacity=60); background:#000;z-index:998;"></div>
    <div style="position: fixed;top:100px;z-index: 999;width:100%;<?php  if($my_mobile != '') { ?>display:none<?php  } ?>">
        <div style="margin:0px 20px;background-color: white;padding:10px">
            <div style="text-align: center;color:grey;font-size:12px;margin-bottom:8px">
                绑定手机号有利于为您提供更优质服务！
            </div>
            <div style="background-color: white;height:40px;border-bottom:1px #F3F3F3 solid">
                <div style="width:30px;height:40px;line-height: 40px;color:#3BBBA2;text-align: center;color:<?php  echo $conf['color'];?>">
                    <i class="fa fa-phone"></i>
                </div>
                <div style="height:40px;margin:-40px 0px 0px 0px">
                    <input id="mobile" type="number" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="手机号" />
                </div>
            </div>
            <div style="margin:10px 10px 0px 10px">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="mui-btn mui-btn-block" style="background-color: <?php  echo $conf['color'];?>;border-color:<?php  echo $conf['color'];?>;color:white" onclick="submit_mobile()">
                                提交
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/check_reg.js"></script>
<script>
    function submit_mobile() {
        if(checkPhone($("#mobile").val())) {
            $.post("<?php  echo $this->createMobileurl('update_mobile')?>",{
                    mobile:$("#mobile").val()
                },function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == 0) {
                        $("#mobile_register_panel").hide();
                        tankuang(200,'设置成功！');
                    } else {
                        tankuang(200,'设置失败！');
                    }
                }
            );
        }
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