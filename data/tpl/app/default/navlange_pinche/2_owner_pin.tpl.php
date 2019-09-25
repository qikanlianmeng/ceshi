<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/qc_font/iconfont.css?v=2" />
<style>
body{
    background-color: #F3F3F3;
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
        border-bottom:2px <?php  echo $conf['owner_color'];?> solid;
    }
.express{
    margin:10px;
    border-radius:5px;
    border:1px #EFEFEF solid;
    background-color: white;
    padding: 10px;
}
.address{
    margin:10px 15px;
    font-size:80%;
}
.send .goods {
    color:#EA7F17;
}
.send .express-time {
    color:#EA7F17;
}
.send .money {
    color:#EA7F17;
    text-align: right
}
.send .info {
    background-color: #EA7F17;
}
.status {
    height:24px;
    line-height: 24px;
    font-size:80%;
}
.status-0 {
    color:#397ADB;
}
.status-1 {
    color:#EA7F17;
}
.status-2 {
    color:green;
}
a:hover {
    text-decoration: none
}
</style>

<script>
    mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
    <nav class="mui-bar mui-bar-tab">
        <?php  if(is_array($menu_list)) { foreach($menu_list as $index => $item) { ?>
            <?php  if($general_release_menu['display']=='1') { ?>
                <a class="mui-tab-item<?php  if($item['name_en']=='my_travel') { ?> mui-active<?php  } ?>" href="<?php  echo $item['url'];?>">
                <?php  if($item['name_en'] != 'general_release') { ?>
                    <div style="height:24px;padding-top:2px">
                        <?php  if($item['icon'] != '') { ?>
                        <img src="<?php  if($item['name_en']=='my_travel') echo tomedia($item['icon_active']);else echo tomedia($item['icon']);?>" onerror="this.src='<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/<?php  echo $item['name_en'];?><?php  if($item['name_en']=='my_travel') echo '_active';?>.png'" width="20px" height="20px" />
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

<div id="segmentedControl" class="mui-segmented-control" style="background-color: white">
    <a class="mui-control-item" href="<?php  echo $this->createMobileurl('my_travel')?>">
        <?php  if($conf['core_mode']=='5') { ?>货主<?php  } else { ?>乘客<?php  } ?>行程
    </a>
    <a class="mui-control-item mui-active">
        车主行程
    </a>
</div>
<?php  if(!empty($pin)) { ?>
<?php  if(is_array($pin)) { foreach($pin as $index => $vo) { ?>
    <div id="pin_<?php  echo $vo['id'];?>" class='express send'>
        <div class="container" style="padding-bottom:8px;padding-top:5px;font-size:12px">
            <div class="row">
                <div class="col-xs-7" style="padding:0px 0px 0px 10px">
                    <i class="iconfont icon-yuyue"></i> <?php  echo date('m月d日 H:i',$vo['departure_time'])?>
                </div>
                <div class="col-xs-2" style="padding:0px">
                    <?php  if($vo['left_amount']>0) { ?>
                        <?php  echo $vo['left_amount'];?>座
                    <?php  } else { ?>
                        <span style="color:red">已满</span>
                    <?php  } ?>
                </div>
                <div class="col-xs-3" style="padding:0px;text-align: right">
                    <?php  echo intval($vo['price'])?>元/<span style="font-size:12px">座</span>
                </div>
            </div>
        </div>
        <div style="padding-left: 8px">
            <div>
                <span style="color:green"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['departure_city'],'市')?>-<?php  echo $vo['departure_station'];?></span>
            </div>
            <div style="padding-top:5px">
                <span style="color:red"><i class="iconfont icon-yuan" style="font-size:26px"></i></span>
                <span style="position: relative;top:-5px"><?php  echo $this->rtrim_cn($vo['terminal_city'],'市')?>-<?php  echo $vo['terminal_station'];?></span>
            </div>
        </div>
        <div style="border-top: 1px #EFEFEF solid"></div>
        <div style="margin:10px auto 0px auto">
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 status" style="line-height: 33px">
                        状态：<?php  echo $this->trans_pin_status($vo['status']);?>
                    </div>
                    <div class="col-xs-8" style="text-align:right">
                        <?php  if($vo['status'] == '0' OR $vo['status']=='1') { ?>
                            <button type="button" class="mui-btn mui-btn-warning" onclick="location.href='<?php  echo $this->createMobileurl('pin_edit',array('id'=>$vo['id']))?>'">编辑</button> 
                        <?php  } ?>
                        <button type="button" class="mui-btn mui-btn-success" onclick="location.href='<?php  echo $this->createMobileurl('info',array('id'=>$vo['id']))?>'">详情</button> 
                        <?php  if($vo['status'] == '0') { ?> 
                            <button type="button" class="mui-btn mui-btn-danger" onclick="cancel_pin(<?php  echo $vo['id'];?>)">取消</button>   
                        <?php  } ?>                     
                    </div>
                </div>
            </div>              
        </div>
    </div>
<?php  } } ?>
<script>
function cancel_pin(id) {
    var r = confirm("确认取消！");
    if(r) {
        $.post("<?php  echo $this->createMobileurl('cancel_pin')?>",{
                id:id
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    alert("取消成功！");
                    $("#pin_"+id).remove();
                }
            }
        );
    }
}
</script>
<?php  } else { ?>
    <div style="width:220px;margin:40px auto">
        <div style="width:90px;height:80px">
            <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/empty_order.png" width="80px" height="80px" />
        </div>
        <div style="margin:-80px 0px 0px 90px;padding-top:30px">
            暂无拼车发布！
        </div>
    </div>
<?php  } ?>