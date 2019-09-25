<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=7" />
<style>
	body {
		background-color:#F3F3F3;
	}
    .mui-bar-tab .mui-tab-item.mui-active {
        color: <?php  echo $conf['color'];?>;
    }
    a:hover {
        text-decoration: none
    }
    .role {
        border: 1px #FCFCFC solid;
        border-radius: 20px
    }
    .role_active {
        background-color: white;
        color:<?php  echo $conf['color'];?>;
        border-radius: 20px;
        border:1px #F7F7F7 solid;
    }
</style>
<script>
    mui('body').on('tap','a',function(){document.location.href=this.href;});  
    var share_url = "<?php  echo murl('entry', array('m' => 'navlange_pinche', 'do' => 'todo_index'), true, true);?>";
    wx.config(jssdkconfig);
    wx.ready(function(){
        wx.onMenuShareAppMessage({
            title: '<?php  echo $conf['info_share_title'];?>', // 分享标题
            desc: '<?php  echo $conf['info_share_desc'];?>', // 分享描述
            link: share_url, // 分享链接
            imgUrl: '<?php  echo tomedia($conf['info_share_img']);?>', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () { 
                
            },
            cancel: function () { 
            }
        });
        wx.onMenuShareTimeline({
            title: '<?php  echo $conf['info_share_title'];?>', // 分享标题
            desc: '<?php  echo $conf['info_share_desc'];?>', // 分享描述
            link: share_url, // 分享链接
            imgUrl: '<?php  echo tomedia($conf['info_share_img']);?>', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () { 
                
            },
            cancel: function () { 
            }
        });
    });
</script>
<div id="main_panel">
    <?php  if($menu_list) { ?>
    <nav class="mui-bar mui-bar-tab">
        <?php  if(is_array($menu_list)) { foreach($menu_list as $index => $item) { ?>
            <?php  if(($item['name_en']=='general_release' AND $general_release_menu['display']=='1') OR $item['name_en'] != 'general_release') { ?>
                <a class="mui-tab-item<?php  if($item['name_en']=='todo_index') { ?> mui-active<?php  } ?>" href="<?php  echo $item['url'];?>">
                <?php  if($item['name_en'] != 'general_release') { ?>
                    <div style="height:24px;padding-top:2px">
                        <?php  if($item['icon'] != '') { ?>
                        <img src="<?php  if($item['name_en']=='todo_index') echo tomedia($item['icon_active']);else echo tomedia($item['icon']);?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/<?php  echo $item['name_en'];?><?php  if($item['name_en']=='todo_index') echo '_active';?>.png'" width="20px" height="20px" />
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
        <?php  if($conf['index_statistic_display_on'] == '1') { ?>
        <div style="position:relative;height:42px;margin-top:-42px;background:rgba(0, 0, 0, 0.6)!important;filter:Alpha(opacity=60); background:#000;color:white;padding:10px">
            <div class="container">
                <div class="row">
                    <div class="col-xs-1" style="text-align: center;padding:0px">
                        <i class="iconfont icon-tongji"></i>
                    </div>
                    <div class="col-xs-4" style="text-align: center;padding:0px">
                        车主：<span style="font-size:16px;font-weight: bold;color:<?php  echo $conf['owner_color'];?>"><?php  echo $platform['owner_amount'];?></span>位
                    </div>
                    <div class="col-xs-4" style="text-align: center;padding:0px">
                        用户：<span style="font-size: 16px;font-weight: bold;color:<?php  echo $conf['color'];?>"><?php  echo $platform['passenger_amount'];?></span>位
                    </div>
                </div>
            </div>
        </div>
        <?php  } ?>
        <div class="mui-slider-indicator" style="text-align: right">   
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
    
    <?php  if(!empty($notice)) { ?>
    <div style="padding:3px 10px;background-color: white">
        <div style="height:30px;font-size:12px;margin-right: 40px">
            <marquee direction="up" scrollamount="1" style="height:30px">
                <?php  if(is_array($notice)) { foreach($notice as $index => $item) { ?>
                    <div onclick="location.href='<?php  echo $this->createMobileurl('notice',array('id'=>$item['id']))?>'">
                        <span style="background-color: <?php  echo $item['color'];?>;color:white"><?php  echo $item['type'];?></span>&nbsp;<span><?php  echo $item['title'];?></span>
                    </div>
                <?php  } } ?>
            </marquee>
        </div>
        <div style="width:40px;height:30px;margin:-30px 0px 0px auto;line-height: 30px;text-align: center;font-size:12px" onclick="location.href='<?php  echo $this->createMobileurl('notice_list')?>'">
            更多...
        </div>
    </div>
    <?php  } ?>

    <?php  if($conf['image_nav_mode'] == '1') { ?>
        <div class="container" style="margin-top:10px">
            <div class="row">
                <div class="col-xs-6" style="padding:0px 5px 5px 5px;">
                    <div style="padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_1_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_1'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_1_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_1_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_1_desc'];?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding:0px 5px 5px 5px;">
                    <div style="padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_2_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_2'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_2_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_2_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_2_desc'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
    <?php  if($conf['image_nav_mode'] == '2') { ?>
        <div class="container" style="margin-top:10px">
            <div class="row">
                <div class="col-xs-6" style="padding:0px 5px 5px 5px;">
                    <div style="padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_1_url'];?>'">
                        <div style="text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_1_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_1_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_1_desc'];?></div>
                        </div>
                        <div style="height:85px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_1'])?>" width="85px" height="85px" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding:0px 5px 5px 5px;">
                    <div style="padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_2_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_2'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_2_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_2_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_2_desc'];?></div>
                        </div>
                    </div>
                    <div style="margin-top:5px;padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_3_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_3'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_3_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_3_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_3_desc'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
    <?php  if($conf['image_nav_mode'] == '3') { ?>
        <div class="container" style="margin-top:10px">
            <div class="row">
                <div class="col-xs-6" style="padding:0px 5px 5px 5px;">
                    <div style="padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_1_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_1'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_1_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_1_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_1_desc'];?></div>
                        </div>
                    </div>
                    <div style="margin-top:5px;padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_2_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_2'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_2_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_2_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_2_desc'];?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding:0px 5px 5px 5px;">
                    <div style="padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_3_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_3'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_3_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_3_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_3_desc'];?></div>
                        </div>
                    </div>
                    <div style="margin-top:5px;padding:10px 0px;border-radius: 5px;background-color:white" onclick="location.href='<?php  echo $conf['nav_img_4_url'];?>'">
                        <div style="width:70px;height:60px;text-align: center">
                            <img src="<?php  echo tomedia($conf['nav_img_4'])?>" width="60px" height="60px" />
                        </div>
                        <div style="margin:-60px 0px 0px 70px;text-align: center;height:60px;padding-top:10px">
                            <div style="color:<?php  echo $conf['nav_img_4_color'];?>;font-weight: bold;font-size:16px"><?php  echo $conf['nav_img_4_title'];?></div>
                            <div style="color:grey"><?php  echo $conf['nav_img_4_desc'];?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
    
    <?php  if(!empty($travel_list)) { ?>
    <div style="margin:10px;background-color:white;border-radius:5px">
        <div style="padding:10px;border-bottom:1px #F3F3F3 solid">
            <i class="iconfont icon-laba-copy"></i>&nbsp;出行提醒
        </div>
        <div>
            <?php  if(is_array($travel_list)) { foreach($travel_list as $index => $vo) { ?>
                <div onclick="get_pin_info(<?php  echo $vo['id'];?>,'<?php  echo $vo['departure_city'];?>','<?php  echo $vo['terminal_city'];?>')">
                    <div style="width:60px;text-align: center;height:60px;line-height: 60px;padding-top:-5px">
                        <i class="iconfont icon-dengdai" style="font-size: 50px;color:grey"></i>
                    </div>
                    <div style="width:20px;text-align: center;height:60px;line-height: 70px;margin:-60px 0px 0px auto">
                        <i class="iconfont icon-right"></i>
                    </div>
                    <div style="height:60px;width:100px;margin:-60px 20px 0px auto;line-height: 70px;text-align: right">
                        <?php  if($conf['pin_progress_mode']=='0') { ?>
                            <?php  echo $this->trans_status($vo['status']);?>
                        <?php  } else if($conf['pin_progress_mode']=='1') { ?>
                            <?php  if($vo['status']=='1') { ?>
                                <?php  if($vo['owner_confirmed']=='0') { ?>
                                    待车主确认
                                <?php  } else if($vo['owner_arrived_departure_station']=='1') { ?>
                                    司机已到出发地
                                <?php  } else if($vo['owner_comming_to_departure_station']=='1') { ?>
                                    司机已出发
                                <?php  } else { ?>
                                    等待司机
                                <?php  } ?>
                            <?php  } else { ?>
                                <?php  echo $this->trans_status($vo['status']);?>
                            <?php  } ?>
                        <?php  } ?>
                    </div>
                    <div style="min-height: 60px;margin:-60px 120px 0px 60px">
                        <div>
                            <?php  echo date('m-d H:i',$vo['departure_time']);?>
                        </div>
                        <div>
                            <span style="color:green"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                            <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['departure_city'],'市')?>-<?php  echo $vo['departure_station'];?></span>
                            <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $vo['departure_district'];?></span>
                        </div>
                        <div>
                            <span style="color:red"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                            <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['terminal_city'],'市')?>-<?php  echo $vo['terminal_station'];?></span>
                            <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $vo['terminal_district'];?></span>
                        </div>
                    </div>
                </div>
            <?php  } } ?>
        </div>
    </div>
    <?php  } ?>
    <?php  if(!empty($pin_list)) { ?>
    <div style="margin:10px;background-color:white;border-radius:5px">
        <div style="padding:10px;border-bottom:1px #F3F3F3 solid">
            <i class="iconfont icon-laba-copy"></i>&nbsp;出车提醒
        </div>
        <div>
            <?php  if(is_array($pin_list)) { foreach($pin_list as $index => $vo) { ?>
                <div onclick="show_info(<?php  echo $vo['id'];?>,'<?php  echo $vo['departure_city'];?>','<?php  echo $vo['terminal_city'];?>')">
                    <div style="width:60px;text-align: center;height:60px;line-height: 60px;padding-top:-5px">
                        <i class="iconfont icon-dengdai" style="font-size: 50px;color:grey"></i>
                    </div>
                    <div style="width:20px;text-align: center;height:60px;line-height: 70px;margin:-60px 0px 0px auto">
                        <i class="iconfont icon-right"></i>
                    </div>
                    <div style="height:60px;width:80px;margin:-60px 20px 0px auto;line-height: 70px;text-align: right">
                        <?php  echo $this->trans_pin_status($vo['status']);?>
                    </div>
                    <div style="min-height: 60px;margin:-60px 80px 0px 60px">
                        <div>
                            <?php  echo date('m-d H:i',$vo['departure_time']);?>
                        </div>
                        <div>
                            <span style="color:green"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                            <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['departure_city'],'市')?>-<?php  echo $vo['departure_station'];?></span>
                            <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $vo['departure_district'];?></span>
                        </div>
                        <div>
                            <span style="color:red"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                            <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['terminal_city'],'市')?>-<?php  echo $vo['terminal_station'];?></span>
                            <span style="font-size: 12px;color:grey;position: relative;top:-5px"><?php  echo $vo['terminal_district'];?></span>
                        </div>
                    </div>
                </div>
                <?php  if($vo['pined_amount']==0) { ?>
                    <div style="text-align: right;padding:5px;border-top:1px #F3F3F3 solid">
                        <button style="background-color:<?php  echo $conf['owner_color'];?>;color:white" onclick="location.href='<?php  echo $this->createMobileurl('pin_edit',array('id'=>$vo['id']))?>'">编辑</button>
                        <button class="mui-btn-danger" onclick="cancel_pin(<?php  echo $vo['id'];?>)">取消</button>
                    </div>
                <?php  } ?>
            <?php  } } ?>
        </div>
    </div>
    <?php  } ?>

    <div style="margin:20px 10px">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div style="background-color: #FCFCFC;color:#B3B3B3;width:100px;height:40px;border-radius: 20px">
                        <div id="role_mode_0" class="role role_active" style="width:50px;height:40px;line-height: 40px;text-align: center;font-size:12px" onclick="change_role_mode('0')">
                            <?php  if($conf['core_mode'] == '5') { ?>货主<?php  } else { ?>乘客<?php  } ?>
                        </div>
                        <div id="role_mode_1" class="role" style="width:50px;height:40px;margin:-40px 0px 0px 50px;line-height: 40px;text-align: center;font-size:12px" onclick="change_role_mode('1')">
                            车主
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="text-align: right;line-height: 40px;text-decoration: underline;;color:<?php  echo $conf['color'];?>" onclick="sel_line()">
                    常用线路
                </div>
            </div>
        </div>
        <script>
        var role_mode = '0';
        function change_role_mode(mode) {
            if(role_mode != mode) {
                role_mode = mode;
                if(mode == '0') {
                    $("#role_mode_1").removeClass('role_active');
                    $("#role_mode_0").addClass('role_active');
                    $("#search_btn").html('立即找车');
                } else if (mode == '1') {
                    $("#role_mode_1").addClass('role_active');
                    $("#role_mode_0").removeClass('role_active');
                    <?php  if($conf['core_mode'] == '5') { ?>
                    $("#search_btn").html('立即找货');
                    <?php  } else { ?>
                    $("#search_btn").html('立即找人');
                    <?php  } ?>
                }
            }
        }
        </script>

        <div style="background-color: white;height:40px;border-top:1px #F3F3F3 solid">
            <div style="width:30px;height:40px;line-height: 40px;color:#3BBBA2;text-align: center">
                <i class="fa fa-circle-o"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="departure_station" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="出发地" onfocus="blur()" onclick="sel_departure_place()" />
            </div>
        </div>
        <div style="background-color: white;height:40px;border-top:1px #F3F3F3 solid;border-bottom:1px #F3F3F3 solid">
            <div style="width:30px;height:40px;line-height: 40px;color:#FB8641;text-align: center">
                <i class="fa fa-circle"></i>
            </div>
            <div style="height:40px;margin:-40px 0px 0px 30px">
                <input id="terminal_station" style="width:100%;text-align: center;background-color: transparent;border:0px;border-radius: 0px;height:40px" placeholder="目的地" onfocus="blur()" onclick="sel_terminal_place()" />
            </div>
        </div>
        <div style="padding:10px;background-color: white">
            <button id="search_btn" class="mui-btn mui-btn-block" style="background-color:<?php  echo $conf['color'];?>;border-color:<?php  echo $conf['color'];?>;color:white;margin-bottom: 0px" onclick="search()">立即找车</button>
        </div>
    </div>
    <div style="margin:10px;background-color:white;border-radius:5px">
        <div style="padding:10px;border-bottom:1px #F3F3F3 solid">
            <i class="iconfont icon-faxian"></i>&nbsp;发现
        </div>
        <div style="padding:0px 0px 0px 10px">
            <div class="container" style="padding:10px">
                <div class="row" onclick="location.href='<?php  echo $this->createMobileurl('owner_info')?>'">
                    <div class="col-xs-10">
                        <i class="iconfont icon-siji"></i>&nbsp;成为车主
                    </div>
                    <div class="col-xs-2" style="text-align: right">
                        <i class="iconfont icon-right"></i>
                    </div>
                </div>
            </div>
            <div class="container" style="padding:10px;border-top:1px #F3F3F3 solid">
                <div class="row" onclick="invite()">
                    <div class="col-xs-10">
                        <i class="iconfont icon-yaoqing"></i>&nbsp;邀请车主
                    </div>
                    <div class="col-xs-2" style="text-align: right">
                        <i class="iconfont icon-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height:60px"></div>
</div>


<script>
    function get_pin_info(id,departure_city,terminal_city) {
        $.post("<?php  echo $this->createMobileurl('get_travel_pin')?>",{
                id:id
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    var pin = resp.message.message;
                    location.href="<?php  echo $this->createMobileurl('travel_info')?>"+"&id="+id;
                } else {
                    location.href="<?php  echo $this->createMobileurl('pin_index')?>&departure_city="+departure_city+"&terminal_city="+terminal_city;
                }
            }
        );
    }
    function show_info(id,departure_city,terminal_city) {
        $.post("<?php  echo $this->createMobileurl('get_pin_info')?>",{
                id:id
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    var pin = resp.message.message;
                    if(pin.pined_amount > 0) {
                        location.href="<?php  echo $this->createMobileurl('info')?>"+"&id="+id;
                    } else {
                        location.href="<?php  echo $this->createMobileurl('travel_index')?>&departure_city="+departure_city+"&terminal_city="+terminal_city;
                    }
                }
            }
        );
    }
    function cancel_pin(id) {
        var btnArray = ['暂不取消','确认取消'];
        mui.confirm('确认取消出车！','',btnArray,function(e){
            if(e.index == 1) {
                $.post("<?php  echo $this->createMobileurl('cancel_pin')?>",{id:id},
                    function(resp) {
                        resp = $.parseJSON(resp);
                        if(resp.message.errno == '0') {
                            mui.alert("取消成功！",function(){
                                location.reload();
                            })
                        }
                    }
                );
            }
        })
    }
    function invite() {
        <?php  if($owner['status'] == '1') { ?>
            $.post("<?php  echo $this->createMobileurl('todo_index',array('op'=>'get_invite_code'))?>",
                function(resp) {
                    resp = $.parseJSON(resp);
                    var invite_code = resp.message.message;
                    mui.alert("邀请码："+invite_code);
                }
            );
        <?php  } else { ?>
            var btnArray = ['取消','立即注册'];
            mui.confirm('注册成为车主，才能邀请好友！','',btnArray,function(e){
                if(e.index == 1) {
                    location.href="<?php  echo $this->createMobileurl('owner_info')?>";
                }
            })
        <?php  } ?>
    }
    function search() {
        if(departure_city == '') {
            mui.alert("请选择出发地！");
        } else if (terminal_city == '') {
            mui.alert("请选择目的地！");
        } else {
            if(role_mode == '0') {
                var url = "<?php  echo $this->createMobileurl('pin_index')?>";
            } else if (role_mode == '1') {
                var url = "<?php  echo $this->createMobileurl('travel_index')?>";
            }
            url += "&departure_city=" + departure_city + "&departure_station=" + departure_station + "&terminal_city=" + terminal_city + "&terminal_station=" + terminal_station;
            location.href=url;
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
                $("#lng").val(res.longitude);
                $("#lat").val(res.latitude);
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
            } else if (cur_place == '1') {
                if(loc.poiname != '我的位置') {
                    terminal_city = loc.cityname;
                    terminal_station = loc.poiname;
                }
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

<script type="text/javascript">
    function sel_line() {
        $("#main_panel").hide();
        $("#line_panel").show();
    }
    function cancel_line() {
        $("#main_panel").show();
        $("#line_panel").hide();
    }
    function sel_line_confirm(sel_departure_city,sel_departure_station,sel_departure_district,sel_terminal_city,sel_terminal_station,sel_terminal_district) {
        departure_city = sel_departure_city;
        departure_station = sel_departure_station;
        departure_district = sel_departure_district;
        terminal_city = sel_terminal_city;
        terminal_station = sel_terminal_station;
        terminal_district = sel_terminal_district;
        $("#departure_station").val(sel_departure_city.trim('市','right')+'-'+sel_departure_station+'('+sel_departure_district+')');
        $("#terminal_station").val(sel_terminal_city.trim('市','right')+'-'+sel_terminal_station+'('+sel_terminal_district+')');
        cancel_line();
    }
</script>
<div id="line_panel" style="display:none">
    <header class="mui-bar mui-bar-nav">
        <a class="mui-icon mui-icon-arrowleft mui-pull-left mui-plus-visble" href="javascript:cancel_line()"></a>
        <h1 class="mui-title">选择路线</h1>
    </header>
    <div style="margin-top:50px">
        <?php  if(is_array($line_list)) { foreach($line_list as $index => $item) { ?>
            <div style="margin:5px;background-color:white;border-radius:5px" onclick="sel_line_confirm('<?php  echo $item['departure_city'];?>','<?php  echo $item['departure_address'];?>','<?php  echo $item['departure_district'];?>','<?php  echo $item['terminal_city'];?>','<?php  echo $item['terminal_address'];?>','<?php  echo $item['terminal_district'];?>')">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-1" style="color:#3BBBA2">
                            始：
                        </div>
                        <div class="col-xs-11">
                            <div><?php  echo $item['departure_station'];?></div>
                            <div>
                                <?php  echo $this->rtrim_cn($item['departure_city'],'市') . '-' . $item['departure_address'] . '(' . $item['departure_district'] . ')'?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border-top:1px #F3F3F3 dashed">
                        <div class="col-xs-1" style="color:#FB8641">
                            终：
                        </div>
                        <div class="col-xs-11">
                            <div><?php  echo $item['terminal_station'];?></div>
                            <div>
                                <?php  echo $this->rtrim_cn($item['terminal_city'],'市') . '-' . $item['terminal_address'] . '(' . $item['terminal_district'] . ')'?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php  } } ?>
    </div>
</div>