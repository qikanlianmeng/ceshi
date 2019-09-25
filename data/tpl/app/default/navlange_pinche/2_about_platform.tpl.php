<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=5" />
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
<?php  if($menu_list) { ?>
<nav class="mui-bar mui-bar-tab">
        <?php  if(is_array($menu_list)) { foreach($menu_list as $index => $item) { ?>
            <?php  if(($item['name_en']=='general_release' AND $general_release_menu['display']=='1') OR $item['name_en'] != 'general_release') { ?>
                <a class="mui-tab-item" href="<?php  echo $item['url'];?>">
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

<div id="segmentedControl" class="mui-segmented-control" style="background-color: white">
    <a class="mui-control-item mui-active" href="javascript:change_mode('disclaimer');">
        免责声明
    </a>
    <a class="mui-control-item" href="javascript:change_mode('about_platform')">
        平台介绍
    </a>
    <a class="mui-control-item" href="javascript:change_mode('suggestion')">
        意见建议
    </a>
</div>
<script type="text/javascript">
    function change_mode(mode) {
        $("#disclaimer_panel").hide();
        $("#about_platform_panel").hide();
        $("#suggestion_panel").hide();
        $("#"+mode+"_panel").show();
        return true;
    }
</script>
<div id="disclaimer_panel" style="padding:10px">
    <?php  echo htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", $conf['disclaimer']));?>
</div>
<div id="about_platform_panel" style="padding:10px;display:none">
    <?php  echo htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", $conf['about_platform']));?>
</div>
<div id="suggestion_panel" style="padding:10px;display:none;background-color:white">
    <div class="mui-input-row">
        <label>姓名</label>
        <input id="name" name="name" type="text" class="mui-input-clear" placeholder="请输入姓名">
    </div>
    <div class="mui-input-row">
        <label>联系电话</label>
        <input id="mobile" name="mobile" type="number" class="mui-input-clear" placeholder="请输入联系电话">
    </div>
    <div style="padding:0px 10px">
        <label>留言</label>
        <div>
            <textarea id="content"></textarea>
        </div>
    </div>
    <div style="padding:5px 10px">
        <button class="mui-btn mui-btn-block" style="background-color:<?php  echo $conf['color'];?>;border-color: <?php  echo $conf['color'];?>;color:white" onclick="submit()">提交</button>
    </div>
</div>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/check_reg.js"></script>
<script type="text/javascript">
    function submit() {
        if($("#name").val() == '') {
            mui.alert("请输入姓名！",function(){
                $("#name").focus();
            })
        } else if (!checkPhone($("#mobile").val())) {
            $("#mobile").focus();
        } else if($("#content").val() == '') {
            mui.alert("请输入留言内容！",function() {
                $("#content").focus();
            })
        } else {
            $.post("<?php  echo $this->createMobileurl('suggestion_submit')?>",{
                    name:$("#name").val(),
                    mobile:$("#mobile").val(),
                    content:$("#content").val()
                },function(resp){
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == 0) {
                        mui.alert("留言成功！",function(){
                            location.reload();
                        });
                    }
                }
            );
        }
    }
</script>