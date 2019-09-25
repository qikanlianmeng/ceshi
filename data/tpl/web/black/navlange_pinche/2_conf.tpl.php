<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <li class="active">
        <?php  if($op == 'index') { ?>
            基础设置
        <?php  } else if($op == 'mode') { ?>
            模式管理
        <?php  } else if($op == 'pin') { ?>
            拼车设置
        <?php  } else if($op == 'cargo') { ?>
            拼货设置
        <?php  } else if($op == 'bus') { ?>
            班车专线设置
        <?php  } else if($op == 'wx_message') { ?>
            模板消息
        <?php  } else if($op == 'sms') { ?>
            短信设置
        <?php  } else if($op == 'note') { ?>
            备注模板
        <?php  } else if($op == 'agreement') { ?>
            协议管理
        <?php  } else if($op == 'use_notice') { ?>
            使用须知
        <?php  } else if($op == 'share') { ?>
            分享设置
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'index') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		系统配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">系统色调</label>
				<div class="col-sm-10">
					<?php  echo tpl_form_field_color('color',$conf['color']);?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">车主色调</label>
				<div class="col-sm-10">
					<?php  echo tpl_form_field_color('owner_color',$conf['owner_color']);?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">背景色调</label>
				<div class="col-sm-10">
					<?php  echo tpl_form_field_color('bg_color',$conf['bg_color']);?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">显示车牌号</label>
				<div class="col-sm-10">
					<input type="checkbox" name="car_number_display" value="1" <?php  if(intval($conf['car_number_display'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">显示评价信息</label>
				<div class="col-sm-10">
					<input type="checkbox" name="comment_display_on" value="1" <?php  if(intval($conf['comment_display_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">乘客发布通知所有车主</label>
				<div class="col-sm-10">
					<input type="checkbox" name="travel_release_notify_all_owner_on" value="1" <?php  if(intval($conf['travel_release_notify_all_owner_on'])=='1') { ?> checked="checked" <?php  } ?> />
					<span style="color:red">*此功能开启将对系统性能影响非常大，不建议开启！</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">平台提成</label>
				<div class="col-sm-10">
					<div class="input-group">
						<input class="form-control" name="platform_deduct" value="<?php  echo $conf['platform_deduct'];?>" type="number" placeholder="请输入平台提成：0-100">
						<span class="input-group-addon">%</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">车主默认信誉值</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="owner_default_credit_score" value="<?php  echo $conf['owner_default_credit_score'];?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">乘客默认信誉值</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="client_default_credit_score" value="<?php  echo $conf['client_default_credit_score'];?>" />
				</div>
			</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车主提现到</label>
                <div class="col-sm-10">
                    <select class="form-control" name="owner_withdraw_to_mode">
                        <option <?php  if($conf['owner_withdraw_to_mode']=='0') { ?>selected<?php  } ?> value="0">微信零钱</option>
                        <option <?php  if($conf['owner_withdraw_to_mode']=='1') { ?>selected<?php  } ?> value="1">我的余额</option>
                    </select>
                </div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 control-label">最小提现金额</label>
				<div class="col-sm-10">
					<div class="input-group">
						<input type="number" class="form-control" name="withdraw_min" value="<?php  echo $conf['withdraw_min'];?>" />
						<span class="input-group-addon">元</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="system_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='car_number_display']").bootstrapSwitch();
		$(":checkbox[name='comment_display_on']").bootstrapSwitch();
		$(":checkbox[name='travel_release_notify_all_owner_on']").bootstrapSwitch();
	})
})
</script>
<div class="panel panel-default">
	<div class="panel-heading">
		会员配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">启用会员</label>
				<div class="col-sm-10">
					<input type="checkbox" name="member_on" value="1" <?php  if(intval($conf['member_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div id="member_panel" <?php  if($conf['member_on'] != '1') { ?>style="display:none"<?php  } ?>>
				<div class="form-group">
					<label class="col-sm-2 control-label">会员类型</label>
					<div class="col-sm-10">
						<select class="form-control" name="member_type">
							<option <?php  if($conf['member_type'] == '0') { ?>selected<?php  } ?> value="0">折扣会员</option>
							<option <?php  if($conf['member_type'] == '1') { ?>selected<?php  } ?> value="1">差价会员</option>
							<option <?php  if($conf['member_type'] == '2') { ?>selected<?php  } ?> value="2">计数会员</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="member_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='member_on']").bootstrapSwitch();
		$(":checkbox[name='member_on']").on('switchChange.bootstrapSwitch', function(e, state){
			if(state == true) {
				$("#member_panel").show();
			} else {
				$("#member_panel").hide();
			}
		});
	})
})
</script>
<div class="panel panel-default">
	<div class="panel-heading">
		支付配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">启用线下支付</label>
				<div class="col-sm-10">
					<input type="checkbox" name="pay_mode_9_on" value="1" <?php  if(intval($conf['pay_mode_9_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">启用余额支付</label>
				<div class="col-sm-10">
					<input type="checkbox" name="pay_mode_0_on" value="1" <?php  if(intval($conf['pay_mode_0_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">启用微信支付</label>
				<div class="col-sm-10">
					<input type="checkbox" name="pay_mode_1_on" value="1" <?php  if(intval($conf['pay_mode_1_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">默认支付模式</label>
				<div class="col-sm-10">
					<select class="form-control" name="default_pay_mode">
						<option <?php  if($conf['default_pay_mode'] == '0') { ?>selected<?php  } ?> value="0">余额支付</option>
						<option <?php  if($conf['default_pay_mode'] == '1') { ?>selected<?php  } ?> value="1">微信支付</option>
						<option <?php  if($conf['default_pay_mode'] == '9') { ?>selected<?php  } ?> value="9">线下支付</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="pay_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='pay_mode_9_on']").bootstrapSwitch();
		$(":checkbox[name='pay_mode_0_on']").bootstrapSwitch();
		$(":checkbox[name='pay_mode_1_on']").bootstrapSwitch();
	})
})
</script>
<?php  } else if($op == 'mode') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		模式配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">模式菜单开启</label>
				<div class="col-sm-10">
					<input type="checkbox" name="mode_menu_on" value="1" <?php  if(intval($conf['mode_menu_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">拼车模式开启</label>
				<div class="col-sm-1">
					<input type="checkbox" name="pin_mode_on" value="1" <?php  if(intval($conf['pin_mode_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
				<label class="col-sm-2 control-label">拼车模式别名</label>
				<div class="col-sm-1">
					<input class="form-control" type="text" name="pin_mode_name" value="<?php  echo $conf['pin_mode_name'];?>" />
				</div>
                <div class="col-sm-2 checkbox">
    				<label>
      					<input name="core_mode_1" <?php  if($conf['core_mode'] == '1') { ?>checked<?php  } ?> type="checkbox">核心模式
    				</label>
  				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">快车模式开启</label>
				<div class="col-sm-1">
					<input type="checkbox" name="fast_mode_on" value="1" <?php  if(intval($conf['fast_mode_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
				<label class="col-sm-2 control-label">快车模式别名</label>
				<div class="col-sm-1">
					<input class="form-control" type="text" name="fast_mode_name" value="<?php  echo $conf['fast_mode_name'];?>" />
				</div>
                <div class="col-sm-2 checkbox">
    				<label>
      					<input name="core_mode_2" <?php  if($conf['core_mode'] == '2') { ?>checked<?php  } ?> type="checkbox">核心模式
    				</label>
  				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">包车模式开启</label>
				<div class="col-sm-1">
					<input type="checkbox" name="charter_mode_on" value="1" <?php  if(intval($conf['charter_mode_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
				<label class="col-sm-2 control-label">包车模式别名</label>
				<div class="col-sm-1">
					<input class="form-control" type="text" name="charter_mode_name" value="<?php  echo $conf['charter_mode_name'];?>" />
				</div>
                <div class="col-sm-2 checkbox">
    				<label>
      					<input name="core_mode_3" <?php  if($conf['core_mode'] == '3') { ?>checked<?php  } ?> type="checkbox">核心模式
    				</label>
  				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">带货模式开启</label>
				<div class="col-sm-1">
					<input type="checkbox" name="cargo_mode_on" value="1" <?php  if(intval($conf['cargo_mode_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
				<label class="col-sm-2 control-label">带货模式别名</label>
				<div class="col-sm-1">
					<input class="form-control" type="text" name="cargo_mode_name" value="<?php  echo $conf['cargo_mode_name'];?>" />
				</div>
                <div class="col-sm-2 checkbox">
    				<label>
      					<input name="core_mode_5" <?php  if($conf['core_mode'] == '5') { ?>checked<?php  } ?> type="checkbox">核心模式
    				</label>
  				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">班车专线模式开启</label>
				<div class="col-sm-1">
					<input type="checkbox" name="bus_mode_on" value="1" <?php  if(intval($conf['bus_mode_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
				<label class="col-sm-2 control-label">班车专线模式别名</label>
				<div class="col-sm-1">
					<input class="form-control" type="text" name="bus_mode_name" value="<?php  echo $conf['bus_mode_name'];?>" />
				</div>
                <div class="col-sm-2 checkbox">
    				<label>
      					<input name="core_mode_4" <?php  if($conf['core_mode'] == '4') { ?>checked<?php  } ?> type="checkbox">核心模式
    				</label>
  				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">城市切换</label>
				<div class="col-sm-1">
					<input type="checkbox" name="city_on" value="1" <?php  if($conf['city_on']=='1') { ?>checked="checked"<?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="mode_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='mode_menu_on']").bootstrapSwitch();
		$(":checkbox[name='pin_mode_on']").bootstrapSwitch();
		$(":checkbox[name='fast_mode_on']").bootstrapSwitch();
		$(":checkbox[name='charter_mode_on']").bootstrapSwitch();
		$(":checkbox[name='cargo_mode_on']").bootstrapSwitch();
		$(":checkbox[name='bus_mode_on']").bootstrapSwitch();
		$(":checkbox[name='city_on']").bootstrapSwitch();
	})
})
$("input[name^='core_mode_']").change(function() {
	var name = $(this).attr('name');
	var name_arr = name.split('_');
	if($("input[name='"+name+"']:checked").val() == 'on') {
		$.post("<?php  echo $this->createWeburl('conf',array('op'=>'set_core_mode'))?>",{
				mode: name_arr[2]
			},function(resp) {
				location.reload();
			}
		);
	} else {
		location.reload();
	}
})
</script>
<?php  } else if($op == 'agreement') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		系统配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">启用协议</label>
				<div class="col-sm-10">
					<input type="checkbox" name="agreement_on" value="1" <?php  if(intval($conf['agreement_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">协议标题</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" name="agreement_title" value="<?php  echo $conf['agreement_title'];?>" />
				</div>
			</div>
			<div class="form-group">
                <label class="col-sm-2 control-label">协议内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('agreement_content', $conf['agreement_content']);?>
                </div>
            </div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="agreement_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='agreement_on']").bootstrapSwitch();
	})
})
</script>
<?php  } else if($op == 'pin') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		拼车配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">拼车流程方案</label>
				<div class="col-sm-10">
					<select class="form-control" name="pin_progress_mode">
						<option value="0" <?php  if($conf['pin_progress_mode']=='0') { ?>selected<?php  } ?>>默认方案</option>
						<option value="1" <?php  if($conf['pin_progress_mode']=='1') { ?>selected<?php  } ?>>精简方案</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">允许车主同时发布多个拼车</label>
				<div class="col-sm-10">
					<input type="checkbox" name="pin_release_multi_on" value="1" <?php  if(intval($conf['pin_release_multi_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">乘客信息接单后才可视</label>
				<div class="col-sm-10">
					<input type="checkbox" name="passenger_info_available_before_pin" value="1" <?php  if(intval($conf['passenger_info_available_before_pin'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">司机信息接单后才可视</label>
				<div class="col-sm-10">
					<input type="checkbox" name="owner_info_available_before_pin" value="1" <?php  if(intval($conf['owner_info_available_before_pin'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">车主需要审核才能发布</label>
				<div class="col-sm-10">
					<input type="checkbox" name="release_need_license" value="1" <?php  if(intval($conf['release_need_license'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">出行未确认允许被重复接单</label>
				<div class="col-sm-10">
					<input type="checkbox" name="multi_pin_compete_on" value="1" <?php  if(intval($conf['multi_pin_compete_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">允许乘客重复发布出行</label>
				<div class="col-sm-10">
					<input type="checkbox" name="multi_pin_travel_release_on" value="1" <?php  if(intval($conf['multi_pin_travel_release_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">乘客拼车需发布出行</label>
				<div class="col-sm-10">
					<input type="checkbox" name="need_travel_before_pin_on" value="1" <?php  if(intval($conf['need_travel_before_pin_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">默认采用乘客行程作为出车发布信息</label>
				<div class="col-sm-10">
					<input type="checkbox" name="use_travel_as_pin_by_default_on" value="1" <?php  if(intval($conf['use_travel_as_pin_by_default_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">用户每天允许取消次数</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" name="pin_cancel_times_per_day" value="<?php  echo $conf['pin_cancel_times_per_day'];?>" />
				</div>
				<label class="col-sm-6" style="padding-top:5px;color:red">如果设置为0表示没有取消次数限制</label>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">允许车主发布最低信誉值</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" name="pin_release_need_credit_score" value="<?php  echo $conf['pin_release_need_credit_score'];?>" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">拼车显示</label>
				<div class="col-sm-10">
					<div class="input-group">
						<input value="<?php  echo $conf['pin_display_days_before'];?>" class="form-control" name="pin_display_days_before" />
						<span class="input-group-addon">天以内</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">车主发布拼车时间限制</label>
				<div class="col-sm-10">
					<div class="input-group">
						<input value="<?php  echo $conf['max_day_to_release'];?>" class="form-control" name="max_day_to_release" />
						<span class="input-group-addon">天以内</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">始发站输入模式</label>
				<div class="col-sm-10">
					<select name="pin_departure_station_mode" class="form-control">
						<option <?php  if($conf['pin_departure_station_mode']=='0') { ?>selected<?php  } ?> value="0">地图选取</option>
						<option <?php  if($conf['pin_departure_station_mode']=='1') { ?>selected<?php  } ?> value="1">手动输入或选择</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">到达站输入模式</label>
				<div class="col-sm-10">
					<select name="pin_terminal_station_mode" class="form-control">
						<option <?php  if($conf['pin_terminal_station_mode']=='0') { ?>selected<?php  } ?> value="0">地图选取</option>
						<option <?php  if($conf['pin_terminal_station_mode']=='1') { ?>selected<?php  } ?> value="1">手动输入或选择</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">路线输入模式</label>
				<div class="col-sm-10">
					<select name="pin_line_mode" class="form-control">
						<option <?php  if($conf['pin_line_mode']=='0') { ?>selected<?php  } ?> value="0">手动输入</option>
						<option <?php  if($conf['pin_line_mode']=='1') { ?>selected<?php  } ?> value="1">选择输入</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="pin_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='pin_release_multi_on']").bootstrapSwitch();
		$(":checkbox[name='release_need_license']").bootstrapSwitch();
		$(":checkbox[name='passenger_info_available_before_pin']").bootstrapSwitch();
		$(":checkbox[name='owner_info_available_before_pin']").bootstrapSwitch();
		$(":checkbox[name='multi_pin_compete_on']").bootstrapSwitch();
		$(":checkbox[name='multi_pin_travel_release_on']").bootstrapSwitch();
		$(":checkbox[name='need_travel_before_pin_on']").bootstrapSwitch();
		$(":checkbox[name='use_travel_as_pin_by_default_on']").bootstrapSwitch();
	})
})
</script>
<?php  } else if($op == 'cargo') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		拼货配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">拼货专线</label>
				<div class="col-sm-10">
					<input type="checkbox" name="cargo_line_on" value="1" <?php  if(intval($conf['cargo_line_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">货源线路模式</label>
				<div class="col-sm-10">
					<select class="form-control" name="cargo_goods_line_mode">
						<option value="0" <?php  if($conf['cargo_goods_line_mode']=='0') { ?>selected<?php  } ?>>地图选取</option>
						<option value="1" <?php  if($conf['cargo_goods_line_mode']=='1') { ?>selected<?php  } ?>>手动输入</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">接单价格</label>
				<div class="col-sm-10">
					<input type="number" step="0.01" name="cargo_accept_price" value="<?php  echo $conf['cargo_accept_price'];?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">货物类型</label>
				<div class="col-sm-10">
					<input type="checkbox" name="cargo_goods_type_on" value="1" <?php  if(intval($conf['cargo_goods_type_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">货物长、宽、高</label>
				<div class="col-sm-10">
					<input type="checkbox" name="cargo_goods_size_on" value="1" <?php  if(intval($conf['cargo_goods_size_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">配送需求</label>
				<div class="col-sm-10">
					<input type="checkbox" name="cargo_delivery_need_on" value="1" <?php  if(intval($conf['cargo_delivery_need_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">到站服务</label>
				<div class="col-sm-10">
					<input type="checkbox" name="cargo_arrival_service_on" value="1" <?php  if(intval($conf['cargo_arrival_service_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">价格模式</label>
				<div class="col-sm-10">
					<select class="form-control" name="cargo_price_mode">
						<option value="0" <?php  if($conf['cargo_price_mode'] == '0') { ?>selected<?php  } ?>>手动输入</option>
						<option value="1" <?php  if($conf['cargo_price_mode'] == '1') { ?>selected<?php  } ?>>自动计算</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">支付模式</label>
				<div class="col-sm-10">
					<select class="form-control" name="cargo_deposit_mode">
						<option value="0" <?php  if($conf['cargo_deposit_mode'] == '0') { ?>selected<?php  } ?>>常规模式</option>
						<option value="1" <?php  if($conf['cargo_deposit_mode'] == '1') { ?>selected<?php  } ?>>押金模式</option>
					</select>
					<span style="color:red">*常规模式：发布支付的费用将作为实际需要的费用；押金模式：发布支付的费用被扣押，流程走完退还</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">付款方式</label>
				<div class="col-sm-10">
					<input type="checkbox" value="1" <?php  if($conf['goods_pay_mode_1_on'] == '1') { ?>checked<?php  } ?> name="goods_pay_mode_1_on" />现金结算&#12288;
					<input type="checkbox" value="1" <?php  if($conf['goods_pay_mode_2_on'] == '1') { ?>checked<?php  } ?> name="goods_pay_mode_2_on" />货到付款&#12288;
					<input type="checkbox" value="1" <?php  if($conf['goods_pay_mode_3_on'] == '1') { ?>checked<?php  } ?> name="goods_pay_mode_3_on" />分享者付款
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">备注模式</label>
				<div class="col-sm-10">
					<select class="form-control" name="cargo_note_mode">
						<option value="0" <?php  if($conf['cargo_note_mode'] == '0') { ?>selected<?php  } ?>>手动输入</option>
						<option value="1" <?php  if($conf['cargo_note_mode'] == '1') { ?>selected<?php  } ?>>从模板选择</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">发货到货时间模式</label>
				<div class="col-sm-10">
					<select class="form-control" name="goods_time_mode">
						<option value="0" <?php  if($conf['goods_time_mode'] == '0') { ?>selected<?php  } ?>>小时：分钟</option>
						<option value="1" <?php  if($conf['goods_time_mode'] == '1') { ?>selected<?php  } ?>>上午、中午、下午</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="cargo_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='cargo_line_on']").bootstrapSwitch();
		$(":checkbox[name='cargo_goods_type_on']").bootstrapSwitch();
		$(":checkbox[name='cargo_goods_size_on']").bootstrapSwitch();
		$(":checkbox[name='cargo_delivery_need_on']").bootstrapSwitch();
		$(":checkbox[name='cargo_arrival_service_on']").bootstrapSwitch();
	})
})
</script>
<div class="panel panel-default">
	<div class="panel-heading">保证金</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-6">
				<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
	                <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
	                    <tr>
	                        <th style="text-align: center">名称</th>
	                        <th style="text-align: center;width:100px">金额</th>
	                        <th style="text-align: center;width:100px">操作</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php  if(is_array($insurance_record)) { foreach($insurance_record as $index => $item) { ?>
                        <tr id="<?php  echo $item['id'];?>">
                            <td style="text-align: center"><?php  echo $item['name'];?></td>
                            <td style="text-align: center"><?php  echo $item['money'];?></td>
                            <td style="text-align: center">
                            	<button class="btn btn-danger btn-xs" onclick="delete_insurance(<?php  echo $item['id'];?>)">
                            		<i class="fa fa-trash"></i>
                            	</button>
                            </td>
                        </tr>
                        <?php  } } ?>
	                </tbody>
	            </table>
			</div>
			<script type="text/javascript">
				function delete_insurance(id) {
					$.post("<?php  echo $this->createWeburl('conf',array('op'=>'delete_insurance'))?>",{
							id:id
						},function(resp) {
							resp = $.parseJSON(resp);
							if(resp.message.errno == 0) {
								tankuang(200,'删除成功！');
								$("#"+id).remove();
							}
						}
					);
				}
			</script>
			<div class="col-sm-6">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">保证金名称</label>
						<div class="col-sm-10">
							<input type="text" name="insurance_name" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">保证金金额</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="number" step="0.01" name="insurance_money" class="form-control" />
								<span class="input-group-addon">元</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="insurance_submit" value="添加">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php  } else if($op == 'bus') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		班车专线配置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">允许乘客发布</label>
				<div class="col-sm-10">
					<input type="checkbox" name="bus_travel_release_on" value="1" <?php  if(intval($conf['bus_travel_release_on'])=='1') { ?> checked="checked" <?php  } ?> />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="bus_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	require(['bootstrap.switch'], function() {
		$(":checkbox[name='bus_travel_release_on']").bootstrapSwitch();
	})
})
</script>
<?php  } else if($op == 'wx_message') { ?>
	<div class="panel panel-default">
        <div class="panel-heading">
            微信模板消息
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">拼车订单提醒</label>
                    <div class="col-sm-10">
                        <input name="pin_order_notice" value="<?php  echo $message['pin_order_notice'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：拼车订单提醒</label>
                        <br>
                        <label>编号：OPENTM401300341</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">乘客出行发布成功</label>
                    <div class="col-sm-10">
                        <input name="release_success" value="<?php  echo $message['release_success'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：拼车请求发布成功通知</label>
                        <br>
                        <label>编号：OPENTM405446043</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">拼车加入提醒</label>
                    <div class="col-sm-10">
                        <input name="join_notice" value="<?php  echo $message['join_notice'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：拼车加入提醒</label>
                        <br>
                        <label>编号：OPENTM207847143</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">司机接乘客通知</label>
                    <div class="col-sm-10">
                        <input name="join_result" value="<?php  echo $message['join_result'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：拼车结果通知</label>
                        <br>
                        <label>编号：OPENTM207030403</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">乘客支付通知</label>
                    <div class="col-sm-10">
                        <input name="pay" value="<?php  echo $message['pay'];?>" class="form-control" placeholder="请输入乘客支付成功通知模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：付款成功提醒</label>
                        <br>
                        <label>编号：OPENTM414371980</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">乘客取消通知</label>
                    <div class="col-sm-10">
                        <input name="passenger_cancel" value="<?php  echo $message['passenger_cancel'];?>" class="form-control" placeholder="请输入乘客取消通知模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：订单取消提醒</label>
                        <br>
                        <label>编号：OPENTM414371975</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">车主取消通知</label>
                    <div class="col-sm-10">
                        <input name="owner_cancel" value="<?php  echo $message['owner_cancel'];?>" class="form-control" placeholder="请输入车主取消通知模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：订单取消提醒</label>
                        <br>
                        <label>编号：OPENTM414371970</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">注册审核通知</label>
                    <div class="col-sm-10">
                        <input name="owner_register" value="<?php  echo $message['owner_register'];?>" class="form-control" placeholder="请输入车主注册审核通知模板消息ID" />
                        <label>行业：IT科技 - 互联网|电子商务</label>
                        <br>
                        <label>名称：注册审核通知</label>
                        <br>
                        <label>编号：OPENTM407362300</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="submit" value="设置">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            小程序模板消息
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">乘客订单被接通知</label>
                    <div class="col-sm-10">
                        <input name="xcx_travel_been_accept" value="<?php  echo $message['xcx_travel_been_accept'];?>" class="form-control" placeholder="请输入车主接单成功通知乘客模板消息ID" />
                        <label>名称：拼车成功通知</label>
                        <br>
                        <label>ID：AT0274</label>
                        <br>
                        <label>关键词：司机姓名、司机电话、车牌号码</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="xcx_submit" value="设置">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php  } else if($op == 'sms') { ?>
<div id="info_panel_1" class="panel panel-default">
    <div class="panel-heading">
        启用短信通知：
        <input type="checkbox" name="sms_on" value="1" <?php  if(intval($message['sms_on'])=='1') { ?> checked="checked" <?php  } ?> />
    </div>
    <div class="panel-body" <?php  if(intval($message['sms_on'])=='0') { ?> style="display:none" <?php  } ?>>
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">聚合key</label>
                <div class="col-sm-10">
                    <input name="juhe_key" value="<?php  echo $message['juhe_key'];?>" class="form-control" placeholder="请输入聚合平台分配的key" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">拼车发布成功模板ID</label>
                <div class="col-sm-10">
                    <input name="release_success_juhe_id" value="<?php  echo $message['release_success_juhe_id'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                    <label>模板内容：尊敬的车主#name#,您的出行信息发布成功！</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">拼车加入提醒模板ID</label>
                <div class="col-sm-10">
                    <input name="join_notice_juhe_id" value="<?php  echo $message['join_notice_juhe_id'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                    <label>模板内容：尊敬的车主,手机号为#tel#的乘客#name#加入了您的出行，赶紧去联系乘客吧！</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">拼车结果通知模板ID</label>
                <div class="col-sm-10">
                    <input name="join_result_juhe_id" value="<?php  echo $message['join_result_juhe_id'];?>" class="form-control" placeholder="请输入车主发布拼车成功模板消息ID" />
                    <label>模板内容：拼车成功,车主#name#的手机号为#tel#，赶紧去联系司机吧！</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='sms_on']").bootstrapSwitch();
        $(':checkbox').on('switchChange.bootstrapSwitch', function(e, state){
            $this = $(this);
            var status = this.checked ? 1 : 0;
            $.post("<?php  echo $this->createWeburl('conf', array('op' => 'sms_control'));?>", {status:status}, function(resp){
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功！', '', 'success');
                    if(status == 1) {
                        $("#info_panel_1 .panel-body").show();
                    } else {
                        $("#info_panel_1 .panel-body").hide();
                    }
                }
            });
        });
    })
})
</script>
<?php  } else if($op == 'note') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		出行要求模板管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">出行要求</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($travel_note_template)) { foreach($travel_note_template as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center"><?php  echo $item['content'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_travel(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-info">
			<div class="panel-heading">
				添加出行要求模板
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">出行要求</label>
						<div class="col-sm-10">
							<input name="content"  type="text" class="form-control" placeholder="请输入出行要求" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="travel_note_template_add" value="添加">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
function delete_travel(id) {
	var r = confirm("删除模板！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('conf',array('op'=>delete_note_template))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除成功！");
					$("#"+id).remove();
				}
			}
		);
	}
}
</script>
<div class="panel panel-default">
	<div class="panel-heading">
		出行服务模板管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">出行服务</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($pin_note_template)) { foreach($pin_note_template as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center"><?php  echo $item['content'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_pin(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-info">
			<div class="panel-heading">
				添加出行服务模板
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">出行服务</label>
						<div class="col-sm-10">
							<input name="content"  type="text" class="form-control" placeholder="请输入出行服务" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="pin_note_template_add" value="添加">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
function delete_pin(id) {
	var r = confirm("删除模板！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('conf',array('op'=>delete_note_template))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除成功！");
					$("#"+id).remove();
				}
			}
		);
	}
}
</script>
<div class="panel panel-default">
	<div class="panel-heading">
		乘客取消理由模板管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">乘客取消理由</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($passenger_cancel_reason_template)) { foreach($passenger_cancel_reason_template as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center"><?php  echo $item['content'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_passenger_cancel_reason(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-info">
			<div class="panel-heading">
				添加乘客取消理由模板
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">乘客取消理由</label>
						<div class="col-sm-10">
							<input name="content"  type="text" class="form-control" placeholder="请输入乘客取消理由" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="passenger_cancel_reason_add" value="添加">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
function delete_passenger_cancel_reason(id) {
	var r = confirm("删除模板！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('conf',array('op'=>delete_note_template))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除成功！");
					$("#"+id).remove();
				}
			}
		);
	}
}
</script>

<div class="panel panel-default">
	<div class="panel-heading">
		货源要求模板管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">备注</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($goods_note_template)) { foreach($goods_note_template as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center"><?php  echo $item['content'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_goods(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-info">
			<div class="panel-heading">
				添加货源要求模板
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">货源要求</label>
						<div class="col-sm-10">
							<input name="content"  type="text" class="form-control" placeholder="请输入货源要求" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="goods_note_template_add" value="添加">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
						<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
							<tr>
								<th style="text-align: center">配送需求</th>
								<th style="text-align: center;width:100px">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($goods_delivery_need_template)) { foreach($goods_delivery_need_template as $index => $item) { ?>
								<tr id="<?php  echo $item['id'];?>">
									<td style="text-align: center"><?php  echo $item['content'];?></td>
									<td style="text-align: center">
										<a href="javascript:delete_goods(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
									</td>
								</tr>
							<?php  } } ?>
						</tbody>
					</table>
					<div class="panel panel-info">
						<div class="panel-heading">
							添加货源配送需求模板
						</div>
						<div class="panel-body">
							<form class="form-horizontal" role="form" action="" method="POST">
								<div class="form-group">
									<label class="col-sm-2 control-label">配送需求</label>
									<div class="col-sm-10">
										<input name="content"  type="text" class="form-control" placeholder="请输入配送需求" />
									</div>
							  	</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-default" name="goods_delivery_need_template_add" value="添加">
										<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
						<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
							<tr>
								<th style="text-align: center">到站服务</th>
								<th style="text-align: center;width:100px">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($goods_arrival_service_template)) { foreach($goods_arrival_service_template as $index => $item) { ?>
								<tr id="<?php  echo $item['id'];?>">
									<td style="text-align: center"><?php  echo $item['content'];?></td>
									<td style="text-align: center">
										<a href="javascript:delete_goods(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
									</td>
								</tr>
							<?php  } } ?>
						</tbody>
					</table>
					<div class="panel panel-info">
						<div class="panel-heading">
							添加货源到站服务模板
						</div>
						<div class="panel-body">
							<form class="form-horizontal" role="form" action="" method="POST">
								<div class="form-group">
									<label class="col-sm-2 control-label">到站服务</label>
									<div class="col-sm-10">
										<input name="content"  type="text" class="form-control" placeholder="请输入到站服务" />
									</div>
							  	</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-default" name="goods_arrival_service_template_add" value="添加">
										<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function delete_goods(id) {
	var r = confirm("删除模板！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('conf',array('op'=>delete_note_template))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除成功！");
					$("#"+id).remove();
				}
			}
		);
	}
}
</script>

<div class="panel panel-default">
	<div class="panel-heading">
		拼货服务模板管理
	</div>
	<div class="panel-body">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
						<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
							<tr>
								<th style="text-align: center">发站服务</th>
								<th style="text-align: center;width:100px">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($cargo_note_template)) { foreach($cargo_note_template as $index => $item) { ?>
								<tr id="<?php  echo $item['id'];?>">
									<td style="text-align: center"><?php  echo $item['content'];?></td>
									<td style="text-align: center">
										<a href="javascript:delete_goods(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
									</td>
								</tr>
							<?php  } } ?>
						</tbody>
					</table>
					<div class="panel panel-info">
						<div class="panel-heading">
							添加拼货发站服务模板
						</div>
						<div class="panel-body">
							<form class="form-horizontal" role="form" action="" method="POST">
								<div class="form-group">
									<label class="col-sm-2 control-label">发站服务</label>
									<div class="col-sm-10">
										<input name="content"  type="text" class="form-control" placeholder="请输入发站服务" />
									</div>
							  	</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-default" name="cargo_note_template_add" value="添加">
										<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
						<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
							<tr>
								<th style="text-align: center">到站服务</th>
								<th style="text-align: center;width:100px">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($cargo_arrival_note_template)) { foreach($cargo_arrival_note_template as $index => $item) { ?>
								<tr id="<?php  echo $item['id'];?>">
									<td style="text-align: center"><?php  echo $item['content'];?></td>
									<td style="text-align: center">
										<a href="javascript:delete_goods(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
									</td>
								</tr>
							<?php  } } ?>
						</tbody>
					</table>
					<div class="panel panel-info">
						<div class="panel-heading">
							添加拼货到站服务模板
						</div>
						<div class="panel-body">
							<form class="form-horizontal" role="form" action="" method="POST">
								<div class="form-group">
									<label class="col-sm-2 control-label">到站服务</label>
									<div class="col-sm-10">
										<input name="arrival_content"  type="text" class="form-control" placeholder="请输入到站服务" />
									</div>
							  	</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<input type="submit" class="btn btn-default" name="cargo_arrival_note_template_add" value="添加">
										<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function delete_goods(id) {
	var r = confirm("删除模板！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('conf',array('op'=>delete_note_template))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除成功！");
					$("#"+id).remove();
				}
			}
		);
	}
}
</script>
<?php  } else if($op == 'use_notice') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		使用须知
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
                <label class="col-sm-2 control-label">须知内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('use_notice', $conf['use_notice']);?>
                </div>
            </div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="use_notice_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<?php  } else if($op == 'share') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        分享设置
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">分享提示</label>
                <div class="col-sm-10">
                    <input class="form-control" name="info_share_hint" value="<?php  echo $conf['info_share_hint'];?>" type="text" placeholder="请输入分享提示语">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分享页面打开标题</label>
                <div class="col-sm-10">
                    <input class="form-control" name="info_share_page_title" value="<?php  echo $conf['info_share_page_title'];?>" type="text" placeholder="请输入分享标题">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分享标题</label>
                <div class="col-sm-10">
                    <input class="form-control" name="info_share_title" value="<?php  echo $conf['info_share_title'];?>" type="text" placeholder="请输入分享标题">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">分享描述</label>
                <div class="col-sm-10">
                    <input class="form-control" name="info_share_desc" value="<?php  echo $conf['info_share_desc'];?>" type="text" placeholder="请输入分享描述">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">分享图片</label>
                <div class="col-sm-10">
                    <?php  if($conf['info_share_img'] != '') echo tpl_form_field_image('info_share_img', $conf['info_share_img']); else echo tpl_form_field_image('info_share_img');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">二维码提示语</label>
                <div class="col-sm-10">
                    <input class="form-control" name="info_share_qrcode_hint" value="<?php  echo $conf['info_share_qrcode_hint'];?>" type="text" placeholder="请输入二维码提示语">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">分享二维码</label>
                <div class="col-sm-10">
                    <?php  if($conf['info_share_qrcode'] != '') echo tpl_form_field_image('info_share_qrcode', $conf['info_share_qrcode']); else echo tpl_form_field_image('info_share_qrcode');?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="share_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } ?>
<script>
function tankuang(pWidth,content) {    
    $("#msg").remove();
    var html ='<div id="msg" style="position:fixed;top:50%;width:100%;height:30px;line-height:30px;margin-top:-15px;"><p style="background:#000;opacity:0.8;width:'+ pWidth +'px;color:#fff;text-align:center;padding:10px 10px;margin:0 auto;font-size:12px;border-radius:4px;">'+ content +'</p></div>'
    $("body").append(html);
    var t=setTimeout(next,2000);
    function next() {
        $("#msg").remove();
    }
}
</script>