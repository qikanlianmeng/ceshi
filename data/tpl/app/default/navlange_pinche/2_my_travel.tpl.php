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
        border-bottom:2px red solid;
    }
    .mui-bar-tab .mui-tab-item.mui-active {
        color: <?php  echo $conf['color'];?>;
    }
.express{
	margin:10px;
	border-radius:5px;
	border:1px #EFEFEF solid;
	background-color: white;
	padding: 10px;
}
.address{
	margin:10px 5px;
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
    <a class="mui-control-item mui-active" >
        <?php  if($conf['core_mode']=='5') { ?>货主<?php  } else { ?>乘客<?php  } ?>行程
    </a>
    <a class="mui-control-item" href="<?php  echo $this->createMobileurl('owner_pin')?>">
        车主行程
    </a>
</div>
<?php  if(!empty($travel)) { ?>
<?php  if(is_array($travel)) { foreach($travel as $index => $vo) { ?>
	<div id="travel_<?php  echo $vo['id'];?>" class='express send'>
		<div class="container" style="padding-bottom:8px;padding-top:5px;font-size:12px">
            <div class="row">
                <div class="col-xs-7" style="padding:0px 0px 0px 10px">
                    <i class="iconfont icon-yuyue"></i> <?php  echo date('m月d日 H:i',$vo['departure_time'])?>
                </div>
                <div class="col-xs-2" style="padding:0px">
                    <?php  if($vo['type'] == '5') { ?>
                    <?php  echo $this->trans_goods_type($vo['goods_type'])?>
                    <?php  } else { ?>
                    <?php  echo $vo['amount'];?>人
                    <?php  } ?>
                </div>
                <div class="col-xs-3" style="padding:0px;text-align: right">
                    <?php  if($vo['type'] == '5') { ?>
                    <?php  echo $vo['weight'];?>吨
                    <?php  } else { ?>
                    <?php  echo $vo['expected_price'];?>元
                    <?php  } ?>
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
					<div class="col-xs-5 status" style="line-height: 33px;padding:0px">
						状态：
						<?php  if($conf['pin_progress_mode']=='0') { ?>
							<?php  echo $this->trans_status($vo['status']);?>
						<?php  } else if($conf['pin_progress_mode']=='1') { ?>
							<?php  if($vo['status']=='1') { ?>
								<?php  if($vo['owner_confirmed']=='0') { ?>
									待车主确认
								<?php  } else if($vo['owner_arrived_departure_station']=='1') { ?>
									司机已到达出发地
								<?php  } else if($vo['owner_comming_to_departure_station']=='1') { ?>
									司机已出发
								<?php  } else { ?>
									等待司机
								<?php  } ?>
							<?php  } else { ?>
								<?php  echo $this->trans_status($vo['status']);?>
							<?php  } ?>
						<?php  } ?>
						<?php  if($vo['status']=='0' && $vo['departure_time']<TIMESTAMP) { ?>
							<i class="iconfont icon-yiguoqi"></i>
						<?php  } ?>
					</div>
					<div class="col-xs-7" style="text-align:right;padding:0px">
						<?php  if($vo['status'] == '3' || $vo['status'] == '4' || $vo['status'] == '5' || $vo['status'] == '6' || $vo['status'] == '7') { ?>
							<button type="button" class="mui-btn mui-btn-outlined" onclick="location.href='<?php  echo $this->createMobileurl('travel_info',array('id'=>$vo['id']))?>'">出行详情</button>
						<?php  } ?>
						<?php  if($vo['status']=='0') { ?>
							<button type="button" class="mui-btn mui-btn-success" onclick="location.href='<?php  echo $this->createMobileurl('travel_edit_pin',array('id'=>$vo['id']))?>'">编辑</button>
						<?php  } ?>
						<?php  if($vo['status'] == '0' || $vo['status'] == '1') { ?>
							<button type="button" class="mui-btn mui-btn-danger" onclick="cancel_travel(<?php  echo $vo['id'];?>,'<?php  echo $vo['status'];?>')">取消</button>
						<?php  } ?>
						<?php  if($vo['status'] == '1' && ($conf['pin_progress_mode']=='0' || ($conf['pin_progress_mode']=='1' && $vo['owner_confirmed']=='1'))) { ?>
							<button type="button" class="mui-btn" style="background-color: <?php  echo $conf['color'];?>;color:white" onclick="confirm_travel(<?php  echo $vo['id'];?>)">去确认</button>
						<?php  } ?>							
					</div>
				</div>
			</div>				
		</div>
	</div>
<?php  } } ?>

<div id="cancel_reason_panel" style="position: fixed;bottom:0px;min-height:200px;width:100%;background-color:white;padding:5px;display:none">
    <div style="border-bottom:1px #F3F3F3 solid">
        <div style="width:60px;height:40px">
            <button class="mui-btn mui-btn-xs" onclick="cancel_reason()">取消</button>
        </div>
        <div style="margin:-40px 60px 0px 60px;height:40px;line-height: 40px;text-align: center">
            <label>取消理由</label>
        </div>
        <div style="width:80px;height:40px;margin:-40px 0px 0px auto">
            <button class="mui-btn mui-btn-xs mui-btn-success" onclick="confirm_cancel()">确认取消</button>
        </div>
    </div>
    <div style="padding-top:10px">
        <div style="text-align: center;padding:10px">
            <i class="iconfont icon-tixing"></i>请选择取消理由！
        </div>
        <?php  if(is_array($cancel_reason_template_list)) { foreach($cancel_reason_template_list as $index => $item) { ?>
            <button id="note_<?php  echo $item['id'];?>" class="mui-btn mui-btn-default" style="margin:3px" onclick="change_note_status(<?php  echo $item['id'];?>,'<?php  echo $item['content'];?>')"><?php  echo $item['content'];?></button>
        <?php  } } ?>
    </div>
</div>

<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/array.js"></script>
<script>
var canceling_travel = 0;
var selected_reason = new Array();
function cancel_travel(id,status) {
    if(status=='0') {
        var btnArray = ['我再等等','确认取消'];
        mui.confirm('确认取消出行！','',btnArray,function(e){
            if(e.index == 1) {
                canceling_travel = id;
                confirm_cancel();
            }
        })
    } else {
        var btnArray = ['我再等等','确认取消'];
        mui.confirm('如果车主已出发，强行取消行程，会对您的信用分造成影响！','',btnArray,function(e){
            if(e.index == 1) {
                canceling_travel = id;
                $("#cancel_reason_panel").show();
            }
        })
    }
}

function cancel_reason() {
	$("#cancel_reason_panel").hide();
}
function change_note_status(id) {
    if(in_array(selected_reason,id)) {
        removeByValue(selected_reason,id);
        $("#note_"+id).removeClass('mui-btn-warning');
    } else {
        selected_reason.push(id);
        $("#note_"+id).addClass('mui-btn-warning');
    }
}
function confirm_cancel() {
	$.post("<?php  echo $this->createMobileurl('cancel_travel')?>",{
			id:canceling_travel,
			reason:selected_reason
		},function(resp) {
			resp = $.parseJSON(resp);
			if(resp.message.errno == 0) {
				mui.alert("出行已取消！",function(){
					location.href="<?php  echo $this->createMobileurl('todo_index')?>";
				})
			} else {
				mui.alert("取消失败！");
			}
		}
	);
}

function confirm_travel(id) {
	window.location.href="<?php  echo $this->createMobileurl('confirm')?>"+"&id="+id;
}
</script>
<?php  } else { ?>
	<div style="width:220px;margin:40px auto">
		<div style="width:90px;height:80px">
			<img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/empty_order.png" width="80px" height="80px" />
		</div>
		<div style="margin:-80px 0px 0px 90px;padding-top:30px">
			无此类出行订单！
		</div>
	</div>
	<div style="text-align: center">
		<!--buton class="mui-btn mui-btn-warning" style="padding-left:10px;padding-right:10px" onclick="location.href='<?php  echo $this->createMobileurl('index')?>'">去拼车</buton-->
	</div>
<?php  } ?>
<div style="height:50px"></div>