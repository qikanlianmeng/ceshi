<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'add_pin_fixed') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('marketing',array('op'=>'pin_fixed'))?>">固定拼车</a>
    </li>
    <?php  } ?>
    <?php  if($op == 'add_pin_stick') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('marketing',array('op'=>'pin_stick'))?>">置顶拼车</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'first_order') { ?>
            首单
        <?php  } else if($op == 'coupon') { ?>
            优惠券
        <?php  } else if($op == 'fx') { ?>
            分销
        <?php  } else if($op == 'partner') { ?>
            合伙人
        <?php  } else if($op == 'integral') { ?>
            积分
        <?php  } else if($op == 'pin_fixed') { ?>
            固定拼车
        <?php  } else if($op == 'add_pin_fixed') { ?>
            添加固定拼车
        <?php  } else if($op == 'pin_stick') { ?>
            置顶拼车
        <?php  } else if($op == 'add_pin_stick') { ?>
            添加置顶拼车
        <?php  } else if($op == 'owner') { ?>
            司机营销
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'first_order') { ?>
<div id="first_order_panel" class="panel panel-default">
    <div class="panel-heading">
        首单优惠&nbsp;<input type="checkbox" name="first_order_on" value="1" <?php  if(intval($marketing_conf['first_order_on'])==1) { ?> checked="checked" <?php  } ?> />
    </div>
    <div class="panel-body" <?php  if($marketing_conf['first_order_on']=='0') { ?>style="display:none"<?php  } ?>>
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    首单免费
                </label>
                <div class="col-sm-10">
                    <input type="checkbox" name="first_order_free" value="1" <?php  if(intval($marketing_conf['first_order_free'])=='1') { ?> checked="checked" <?php  } ?> />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    首单优惠金额
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" step="0.01" name="first_order_discount" value="<?php  echo $marketing_conf['first_order_discount'];?>" placeholder="请输入首单优惠金额" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    首单优惠最低消费
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" step="0.01" name="first_order_discount_min_consumption" value="<?php  echo $marketing_conf['first_order_discount_min_consumption'];?>" placeholder="请输入首单需满足的最低消费" />
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
        $(":checkbox[name='first_order_free']").bootstrapSwitch();
        $(":checkbox[name='first_order_on']").bootstrapSwitch();
        $(":checkbox[name='first_order_on']").on('switchChange.bootstrapSwitch', function(e, state){
            $this = $(this);
            var status = this.checked ? 1 : 0;
            $.post("<?php  echo $this->createWeburl('marketing', array('op' => 'first_order_on_control'));?>", {status:status}, function(resp){
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功！', '', 'success');
                    if(status == 1) {
                        $("#first_order_panel .panel-body").show();
                    } else {
                        $("#first_order_panel .panel-body").hide();
                    }
                }
            });
        });
    })
})
</script>
<?php  } else if($op == 'coupon') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        启用优惠券：
        <input type="checkbox" name="coupon_on" value="1" <?php  if(intval($marketing_conf['coupon_on'])==1) { ?> checked="checked" <?php  } ?> />
    </div>
    <div id="coupon_body" class="panel-body" <?php  if($marketing_conf['coupon_on']=='0') { ?>style="display:none"<?php  } ?>>
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">名称</th>
                    <th style="text-align: center">最低消费</th>
                    <th style="text-align: center;width:100px">启用</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($coupon_list)) { foreach($coupon_list as $index => $item) { ?>
                    <tr id="package_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['name'];?></td>
                        <td style="text-align: center"><?php  echo $item['min_consumption'];?></td>
                        <td style="text-align: center">
                            <input name="coupon_<?php  echo $item['id'];?>" type="checkbox" <?php  if($sel_coupon[$item['id']]=='1') { ?>checked<?php  } ?> value="1" />
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='coupon_on']").bootstrapSwitch();
        $(":checkbox[name='coupon_on']").on('switchChange.bootstrapSwitch', function(e, state){
            $this = $(this);
            var status = this.checked ? 1 : 0;
            $.post("<?php  echo $this->createWeburl('marketing', array('op' => 'coupon_control'));?>", {status:status}, function(resp){
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功！', '', 'success');
                    if(status == 1) {
                        $("#coupon_body").show();
                    } else {
                        $("#coupon_body").hide();
                    }
                }
            });
        });
    })
})
$("input[name^='coupon_']").change(function(){
    var status_arr = new Array();
    <?php  if(is_array($coupon_list)) { foreach($coupon_list as $index => $item) { ?>
        status_arr.push($("input[name='coupon_<?php  echo $item['id'];?>']:checked").val());
    <?php  } } ?>
    $.post("<?php  echo $this->createWeburl('marketing',array('op'=>'coupon_config'))?>",{
            status: status_arr
        },function(response) {
            var res = $.parseJSON(response);
            if(res.message.errno == 0) {
                tankuang(200,'设置成功！');
            }
        }
    );
})
</script>
<?php  } else if($op == 'fx') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        分销配置
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    启用分销
                    <?php  if(empty($fx_module)) { ?>
                        <span style="color:red">(未安装分销模块)</span>
                    <?php  } else { ?>
                        <span style="color:green">(已安装分销模块)</span>
                    <?php  } ?>
                </label>
                <div class="col-sm-10">
                    <?php  if(empty($fx_module)) { ?>
                        <input type="checkbox" name="fx_on" value="1" disabled />
                    <?php  } else { ?>
                        <input type="checkbox" name="fx_on" value="1" <?php  if(intval($marketing_conf['fx_on'])=='1') { ?> checked="checked" <?php  } ?> />
                    <?php  } ?>
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
        $(":checkbox[name='fx_on']").bootstrapSwitch();
    })
})
</script>
<?php  } else if($op == 'partner') { ?>
<div id="first_order_panel" class="panel panel-default">
    <div class="panel-heading">
        合伙人奖励
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">奖励模式</label>
                <div class="col-sm-9">
                    <select class="form-control" name="partner_award_mode">
                        <option value="0" <?php  if($marketing_conf['partner_award_mode'] == '0') { ?>selected<?php  } ?>>无奖励</option>
                        <option value="1" <?php  if($marketing_conf['partner_award_mode'] == '1') { ?>selected<?php  } ?>>固定金额</option>
                        <option value="2" <?php  if($marketing_conf['partner_award_mode'] == '2') { ?>selected<?php  } ?>>按比例金额</option>
                    </select>
                </div>
            </div>  
            <div id="fixed_award_panel" class="form-group" style="<?php  if($marketing_conf['partner_award_mode'] != '1') { ?>display:none<?php  } ?>">
                <label class="col-sm-2 control-label">
                    合伙人固定奖励金额
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input name="partner_award_money" value="<?php  echo $marketing_conf['partner_award_money'];?>" type="number" step="0.01" class="form-control" placeholder="请输入每单合伙人固定奖励金额" />
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>
            <div id="ratio_award_panel" class="form-group" style="<?php  if($marketing_conf['partner_award_mode'] != '2') { ?>display:none<?php  } ?>">
                <label class="col-sm-2 control-label">
                    合伙人奖励比例
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input name="partner_award_ratio" value="<?php  echo $marketing_conf['partner_award_ratio'];?>" type="number" class="form-control" placeholder="请输入每单合伙人奖励比例" />
                        <span class="input-group-addon">%</span>
                    </div>
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
<script type="text/javascript">
    $("select[name='partner_award_mode']").change(function(){
        var mode = $("select[name='partner_award_mode']").val();
        if(mode == '0') {
            $("#fixed_award_panel").hide();
            $("#ratio_award_panel").hide();
        } else if (mode == '1') {
            $("#fixed_award_panel").show();
            $("#ratio_award_panel").hide();
        } else if (mode == '2') {
            $("#fixed_award_panel").hide();
            $("#ratio_award_panel").show();
        }
    })
</script>
<?php  } else if($op == 'integral') { ?>
<div class="panel panel-default">
    <div class="panel-heading">积分</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    司机发布行程
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" value="<?php  echo $marketing_conf['owner_release_pin_integral'];?>" name="owner_release_pin_integral" class="form-control" />
                        <span class="input-group-addon">分</span>
                    </div>
                </div>
                <label class="col-sm-2 control-label">
                    每天最多领取次数
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" value="<?php  echo $marketing_conf['owner_release_pin_integral_per_day'];?>" name="owner_release_pin_integral_per_day" class="form-control" />
                        <span class="input-group-addon">次</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    司机行程完成
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" value="<?php  echo $marketing_conf['owner_pin_success_integral'];?>" name="owner_pin_success_integral" class="form-control" />
                        <span class="input-group-addon">分</span>
                    </div>
                </div>
                <label class="col-sm-2 control-label">
                    每天最多领取次数
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" value="<?php  echo $marketing_conf['owner_pin_success_integral_per_day'];?>" name="owner_pin_success_integral_per_day" class="form-control" />
                        <span class="input-group-addon">次</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    乘客分享行程
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" value="<?php  echo $marketing_conf['passenger_share_integral'];?>" name="passenger_share_integral" class="form-control" />
                        <span class="input-group-addon">分</span>
                    </div>
                </div>
                <label class="col-sm-2 control-label">
                    每天最多领取次数
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="number" value="<?php  echo $marketing_conf['passenger_share_integral_per_day'];?>" name="passenger_share_integral_per_day" class="form-control" />
                        <span class="input-group-addon">次</span>
                    </div>
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
<?php  } else if($op == 'pin_fixed') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        启用拼车固定：
        <input type="checkbox" name="pin_fixed_on" value="1" <?php  if(intval($conf['pin_fixed_on'])==1) { ?> checked="checked" <?php  } ?> />
    </div>
    <div id="pin_fixed_body" class="panel-body" <?php  if($conf['pin_fixed_on']=='0') { ?>style="display:none"<?php  } ?>>
        <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('marketing',array('op'=>'add_pin_fixed'))?>'">添加</button>
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">周期</th>
                    <th style="text-align: center">价格</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($package)) { foreach($package as $index => $item) { ?>
                    <tr id="package_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['period'];?></td>
                        <td style="text-align: center"><?php  echo $item['price'];?></td>
                        <td style="text-align: center">
                            <a href="javascript:delete_pin_fixed_package(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='pin_fixed_on']").bootstrapSwitch();
        $(":checkbox[name='pin_fixed_on']").on('switchChange.bootstrapSwitch', function(e, state){
            $this = $(this);
            var status = this.checked ? 1 : 0;
            $.post("<?php  echo $this->createWeburl('marketing', array('op' => 'pin_fixed_control'));?>", {status:status}, function(resp){
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功！', '', 'success');
                    if(status == 1) {
                        $("#pin_fixed_body").show();
                    } else {
                        $("#pin_fixed_body").hide();
                    }
                }
            });
        });
    })
})
function delete_pin_fixed_package(id) {
    $.post("<?php  echo $this->createWeburl('marketing',array('op'=>'delete_pin_fixed_package'))?>",{
            id:id
        },function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(300,'删除成功！');
                $("#package_"+id).remove();
            } else {
                alert("删除失败！");
            }
        }
    );
}
</script>
<?php  } else if($op == 'add_pin_fixed') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        添加固定拼车
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">固定周期</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="period" class="form-control" placeholder="请输入固定周期" />
                        <span class="input-group-addon">小时</span>
                    </div>
                </div>
            </div>              
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">价格</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="price" type="number" step="0.01" class="form-control" placeholder="请输入价格" />
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>              
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="add_submit" value="添加">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'pin_stick') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        启用拼车置顶：
        <input type="checkbox" name="pin_stick_on" value="1" <?php  if(intval($conf['pin_stick_on'])==1) { ?> checked="checked" <?php  } ?> />
    </div>
    <div id="pin_stick_body" class="panel-body" <?php  if($conf['pin_stick_on']=='0') { ?>style="display:none"<?php  } ?>>
        <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('marketing',array('op'=>'add_pin_stick'))?>'">添加</button>
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">周期</th>
                    <th style="text-align: center">价格</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($package)) { foreach($package as $index => $item) { ?>
                    <tr id="package_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['period'];?></td>
                        <td style="text-align: center"><?php  echo $item['price'];?></td>
                        <td style="text-align: center">
                            <a href="javascript:delete_pin_stick_package(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='pin_stick_on']").bootstrapSwitch();
        $(":checkbox[name='pin_stick_on']").on('switchChange.bootstrapSwitch', function(e, state){
            $this = $(this);
            var status = this.checked ? 1 : 0;
            $.post("<?php  echo $this->createWeburl('marketing', array('op' => 'pin_stick_control'));?>", {status:status}, function(resp){
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功！', '', 'success');
                    if(status == 1) {
                        $("#pin_stick_body").show();
                    } else {
                        $("#pin_stick_body").hide();
                    }
                }
            });
        });
    })
})
function delete_pin_stick_package(id) {
    $.post("<?php  echo $this->createWeburl('marketing',array('op'=>'delete_pin_stick_package'))?>",{
            id:id
        },function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(300,'删除成功！');
                $("#package_"+id).remove();
            } else {
                alert("删除失败！");
            }
        }
    );
}
</script>
<?php  } else if($op == 'add_pin_stick') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        添加置顶拼车
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">置顶周期</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="period" class="form-control" placeholder="请输入置顶周期" />
                        <span class="input-group-addon">小时</span>
                    </div>
                </div>
            </div>              
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">价格</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="price" type="number" step="0.01" class="form-control" placeholder="请输入价格" />
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>              
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="add_submit" value="添加">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'owner') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        司机接单奖励
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">奖励模式</label>
                <div class="col-sm-9">
                    <select class="form-control" name="owner_award_mode">
                        <option value="0" <?php  if($marketing_conf['owner_award_mode'] == '0') { ?>selected<?php  } ?>>无奖励</option>
                        <option value="1" <?php  if($marketing_conf['owner_award_mode'] == '1') { ?>selected<?php  } ?>>固定金额比例金额</option>
                        <option value="2" <?php  if($marketing_conf['owner_award_mode'] == '2') { ?>selected<?php  } ?>>比例金额</option>
                    </select>
                </div>
            </div>              
            <div id="fixed_award_panel" class="form-group" style="<?php  if($marketing_conf['owner_award_mode'] != '1') { ?>display:none<?php  } ?>">
                <label for="name" class="col-sm-2 control-label">固定奖励金额</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="owner_fixed_award_money" value="<?php  echo $marketing_conf['owner_fixed_award_money'];?>" type="number" step="0.01" class="form-control" placeholder="请输入每单司机固定奖励金额" />
                        <span class="input-group-addon">元</span>
                    </div>
                </div>
            </div>              
            <div id="ratio_award_panel" class="form-group" style="<?php  if($marketing_conf['owner_award_mode'] != '2') { ?>display:none<?php  } ?>">
                <label for="name" class="col-sm-2 control-label">奖励比例</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="owner_award_ratio" value="<?php  echo $marketing_conf['owner_award_ratio'];?>" type="number" class="form-control" placeholder="请输入每单司机奖励比例" />
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>           
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="award_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("select[name='owner_award_mode']").change(function(){
        var mode = $("select[name='owner_award_mode']").val();
        $("#fixed_award_panel").hide();
        $("#ratio_award_panel").hide();
        if(mode == '1') {
            $("#fixed_award_panel").show();
        } else if(mode == '2') {
            $("#ratio_award_panel").show();
        }
    })
</script><div class="panel panel-default">
    <div class="panel-heading">
        司机邀请奖励
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">奖励模式</label>
                <div class="col-sm-9">
                    <select class="form-control" name="invite_award_mode">
                        <option value="0" <?php  if($marketing_conf['invite_award_mode'] == '0') { ?>selected<?php  } ?>>无奖励</option>
                        <option value="1" <?php  if($marketing_conf['invite_award_mode'] == '1') { ?>selected<?php  } ?>>被邀请司机接单按比例金额</option>
                    </select>
                </div>
            </div>              
            <div id="ratio_award_panel" class="form-group" style="<?php  if($marketing_conf['invite_award_mode'] != '1') { ?>display:none<?php  } ?>">
                <label for="name" class="col-sm-2 control-label">被邀请司机接单奖励比例</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input name="inviter_award_ratio_from_order" value="<?php  echo $marketing_conf['inviter_award_ratio_from_order'];?>" type="number" class="form-control" placeholder="请输入每单司机奖励比例" />
                        <span class="input-group-addon">%</span>
                    </div>
                </div>
            </div>           
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="invite_award_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("select[name='owner_award_mode']").change(function(){
        var mode = $("select[name='owner_award_mode']").val();
        $("#fixed_award_panel").hide();
        $("#ratio_award_panel").hide();
        if(mode == '1') {
            $("#fixed_award_panel").show();
        } else if(mode == '2') {
            $("#ratio_award_panel").show();
        }
    })
</script>
<div id="owner_classify_panel" class="panel panel-default">
    <div class="panel-heading">
        司机分级&nbsp;<input type="checkbox" name="owner_classify_on" value="1" <?php  if(intval($marketing_conf['owner_classify_on'])==1) { ?> checked="checked" <?php  } ?> />
    </div>
    <div class="panel-body" <?php  if($marketing_conf['owner_classify_on']=='0') { ?>style="display:none"<?php  } ?>>
        <span style="color:red">*只针对会员插件里面的差价会员等级</span>
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">会员等级</th>
                    <th style="text-align: center">乘客订单延迟(分钟)</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($delta_member_level)) { foreach($delta_member_level as $index => $item) { ?>
                    <tr id="level_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['name'];?></td>
                        <td style="text-align: center">
                            <input type="number" style="text-align: center" onchange="update_classify()" id="delay_<?php  echo $item['id'];?>" value="<?php  echo $delta[$item['id']];?>" />
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:delete_member_level(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
                <tr id="level_<?php  echo $item['id'];?>">
                    <td style="text-align: center">非会员</td>
                    <td style="text-align: center">
                        <input type="number" style="text-align: center" onchange="update_classify()" id="delay_0" value="<?php  echo $delta['0'];?>" />
                    </td>
                    <td style="text-align: center">
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='owner_classify_on']").bootstrapSwitch();
        $(":checkbox[name='owner_classify_on']").on('switchChange.bootstrapSwitch', function(e, state){
            $this = $(this);
            var status = this.checked ? 1 : 0;
            $.post("<?php  echo $this->createWeburl('marketing', array('op' => 'owner_classify_on_control'));?>", {status:status}, function(resp){
                console.log(resp);
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功！', '', 'success');
                    if(status == 1) {
                        $("#owner_classify_panel .panel-body").show();
                    } else {
                        $("#owner_classify_panel .panel-body").hide();
                    }
                }
            });
        });
    })
})
function update_classify() {
    var delta = new Array();
    <?php  if(is_array($delta_member_level)) { foreach($delta_member_level as $index => $item) { ?>
        delta[<?php  echo $item['id'];?>] = $("#delay_<?php  echo $item['id'];?>").val();
    <?php  } } ?>
    delta[0] = $("#delay_0").val();
    $.post("<?php  echo $this->createWeburl('marketing',array('op'=>'update_classify'))?>",{
            delta:delta
        },function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(200,'设置成功！');
            }
        }
    );
}
</script>
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