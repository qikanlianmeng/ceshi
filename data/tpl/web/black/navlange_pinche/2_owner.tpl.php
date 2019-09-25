<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'edit' OR $op == 'add_wx_owner' OR $op == 'add_back_owner') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('owner')?>">司机管理</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'index') { ?>
            司机管理
        <?php  } else if($op == 'edit') { ?>
            编辑司机
        <?php  } else if($op == 'add_wx_owner') { ?>
            添加微信会员司机
        <?php  } else if($op == 'add_back_owner') { ?>
            添加后台司机
        <?php  } else if($op == 'client') { ?>
            乘客
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'index') { ?>
	<div class="panel panel-default">
        <div class="panel-heading">司机列表</div>
	    <div class="panel-body">
            <div style="text-align: right">
                <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('owner',array('op'=>'add_wx_owner'))?>'">添加微信会员司机</button>
                <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('owner',array('op'=>'add_back_owner'))?>'">添加后台司机</button>
            </div>
			<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
				<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
					<tr>
                        <th style="text-align: center;width:40px">头像</th>
						<th style="text-align: center">姓名</th>
					    <th style="text-align: center">联系电话</th>
					    <th style="text-align: center">车牌</th>
						<th style="text-align: center">车型</th>
					    <th style="text-align: center">车身颜色</th>
					    <th style="text-align: center">信誉值</th>
                        <th style="text-align: center">状态</th>
					    <th style="text-align: center;width:100px">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($owner)) { foreach($owner as $index => $item) { ?>
						<tr id="<?php  echo $item['id'];?>">
                            <td style="text-align: center">
                                <img src="<?php  echo $item['avatar'];?>" width="30px" height="30px" style="border-radius: 15px" />
                            </td>
							<td style="text-align: center"><?php  echo $item['name'];?></td>
							<td style="text-align: center"><?php  echo $item['tel'];?></td>
							<td style="text-align: center"><?php  echo $item['car_number_1'];?><?php  echo $item['car_number_2'];?><?php  echo $item['car_number_3'];?></td>
							<td style="text-align: center"><?php  echo $item['car_series'];?></td>
							<td style="text-align: center"><?php  echo $item['car_color'];?></td>
							<td style="text-align: center">
                                <input style="width:50px;text-align: center" name="owner_credit_<?php  echo $item['id'];?>" value="<?php  echo $item['credit_score'];?>" />
                            </td>
                            <td style="text-align: center">
								<?php  if($item['status'] == '0') { ?>
									<span class="label label-default">待审核</span>
								<?php  } else if($item['status'] == '1') { ?>
                                    <?php  if($item['working_on'] == '1') { ?>
									   <span class="label label-success">工作中</span>
                                    <?php  } else { ?>
                                       <span class="label label-default">休息中</span>
                                    <?php  } ?>
								<?php  } else if($item['status'] == '2') { ?>
									<span class="label label-warning">已解除绑定</span>
								<?php  } ?>
							</td>
							<td style="text-align: center">
								<a href="<?php  echo $this->createWeburl('owner',array('op'=>'edit','id'=>$item['id']))?>" style="color:#4CB0F9"><i class="fa fa-edit"></i></a>
								<a href="javascript:delete_owner(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
<script>
$("input[name^='owner_credit_']").change(function(){
    var id_str = $(this).attr('name');
    var id_arr = id_str.split("_");
    $.post("<?php  echo $this->createWeburl('owner',array('op'=>'change_credit'))?>",{
            id:id_arr[2],
            credit_score:$("input[name='"+id_str+"']").val()
        },function(resp) {
            resp = $.parseJSON(resp);
            tankuang(300,'修改成功！');
        }
    );
})
function delete_owner(id) {
	var r = confirm("删除司机！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('owner', array('op' => 'delete_owner'));?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno != 0) {
					util.message('操作失败, 请稍后重试.')
				} else {
					util.message('操作成功', location.href, 'success');
				}
			}
		);
	}
}
</script>
<?php  } else if($op=='edit') { ?>
<div class="panel panel-default">
	<div class="panel-body">
	    <form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">司机姓名</label>
				<div class="col-sm-10">
					<input name="name" class="form-control" value="<?php  echo $owner['name'];?>" />
				</div>
		  	</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">司机联系电话</label>
				<div class="col-sm-10">
					<input name="tel" class="form-control" value="<?php  echo $owner['tel'];?>" />
				</div>
		  	</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">总收入</label>
                <div class="col-sm-2">
                    <input name="total_income" class="form-control" value="<?php  echo $owner['total_income'];?>" />
                </div>
                <label class="col-sm-2 control-label">已提现</label>
                <div class="col-sm-2">
                    <input name="withdrawed_income" class="form-control" value="<?php  echo $owner['withdrawed_income'];?>" />
                </div>
                <label class="col-sm-2 control-label">可提现</label>
                <div class="col-sm-2">
                    <input name="available_income" class="form-control" value="<?php  echo $owner['available_income'];?>" />
                </div>
            </div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">车牌号</label>
				<div class="col-sm-4" style="width:200px">
					<select id="car_number_1" name="car_number_1" style="width:80px">
                        <option <?php  if($owner['car_number_1'] == '京') { ?>selected<?php  } ?>>京</option>
                        <option <?php  if($owner['car_number_1'] == '津') { ?>selected<?php  } ?>>津</option>
                        <option <?php  if($owner['car_number_1'] == '冀') { ?>selected<?php  } ?>>冀</option>
                        <option <?php  if($owner['car_number_1'] == '晋') { ?>selected<?php  } ?>>晋</option>
                        <option <?php  if($owner['car_number_1'] == '蒙') { ?>selected<?php  } ?>>蒙</option>
                        <option <?php  if($owner['car_number_1'] == '辽') { ?>selected<?php  } ?>>辽</option>
                        <option <?php  if($owner['car_number_1'] == '吉') { ?>selected<?php  } ?>>吉</option>
                        <option <?php  if($owner['car_number_1'] == '黑') { ?>selected<?php  } ?>>黑</option> 
                        <option <?php  if($owner['car_number_1'] == '沪') { ?>selected<?php  } ?>>沪</option>
                        <option <?php  if($owner['car_number_1'] == '苏') { ?>selected<?php  } ?>>苏</option> 
                        <option <?php  if($owner['car_number_1'] == '浙') { ?>selected<?php  } ?>>浙</option>
                        <option <?php  if($owner['car_number_1'] == '皖') { ?>selected<?php  } ?>>皖</option>
                        <option <?php  if($owner['car_number_1'] == '闽') { ?>selected<?php  } ?>>闽</option>
                        <option <?php  if($owner['car_number_1'] == '赣') { ?>selected<?php  } ?>>赣</option>
                        <option <?php  if($owner['car_number_1'] == '鲁') { ?>selected<?php  } ?>>鲁</option>
                        <option <?php  if($owner['car_number_1'] == '豫') { ?>selected<?php  } ?>>豫</option>
                        <option <?php  if($owner['car_number_1'] == '鄂') { ?>selected<?php  } ?>>鄂</option>
                        <option <?php  if($owner['car_number_1'] == '湘') { ?>selected<?php  } ?>>湘</option> 
                        <option <?php  if($owner['car_number_1'] == '粤') { ?>selected<?php  } ?>>粤</option>
                        <option <?php  if($owner['car_number_1'] == '桂') { ?>selected<?php  } ?>>桂</option>
                        <option <?php  if($owner['car_number_1'] == '琼') { ?>selected<?php  } ?>>琼</option>
                        <option <?php  if($owner['car_number_1'] == '渝') { ?>selected<?php  } ?>>渝</option>
                        <option <?php  if($owner['car_number_1'] == '川') { ?>selected<?php  } ?>>川</option>
                        <option <?php  if($owner['car_number_1'] == '贵') { ?>selected<?php  } ?>>贵</option>
                        <option <?php  if($owner['car_number_1'] == '云') { ?>selected<?php  } ?>>云</option>
                        <option <?php  if($owner['car_number_1'] == '藏') { ?>selected<?php  } ?>>藏</option>
                        <option <?php  if($owner['car_number_1'] == '陕') { ?>selected<?php  } ?>>陕</option>
                        <option <?php  if($owner['car_number_1'] == '甘') { ?>selected<?php  } ?>>甘</option>
                        <option <?php  if($owner['car_number_1'] == '青') { ?>selected<?php  } ?>>青</option>
                        <option <?php  if($owner['car_number_1'] == '宁') { ?>selected<?php  } ?>>宁</option>
                        <option <?php  if($owner['car_number_1'] == '新') { ?>selected<?php  } ?>>新</option>
                    </select>
                    <select id="car_number_2" name="car_number_2" style="width:80px">
                        <option <?php  if($owner['car_number_2'] == 'A') { ?>selected<?php  } ?>>A</option>
                        <option <?php  if($owner['car_number_2'] == 'B') { ?>selected<?php  } ?>>B</option>
                        <option <?php  if($owner['car_number_2'] == 'C') { ?>selected<?php  } ?>>C</option>
                        <option <?php  if($owner['car_number_2'] == 'D') { ?>selected<?php  } ?>>D</option>
                        <option <?php  if($owner['car_number_2'] == 'E') { ?>selected<?php  } ?>>E</option>
                        <option <?php  if($owner['car_number_2'] == 'F') { ?>selected<?php  } ?>>F</option>
                        <option <?php  if($owner['car_number_2'] == 'G') { ?>selected<?php  } ?>>G</option>
                        <option <?php  if($owner['car_number_2'] == 'H') { ?>selected<?php  } ?>>H</option>
                        <option <?php  if($owner['car_number_2'] == 'I') { ?>selected<?php  } ?>>I</option>
                        <option <?php  if($owner['car_number_2'] == 'J') { ?>selected<?php  } ?>>J</option>
                        <option <?php  if($owner['car_number_2'] == 'K') { ?>selected<?php  } ?>>K</option>
                        <option <?php  if($owner['car_number_2'] == 'L') { ?>selected<?php  } ?>>L</option>
                        <option <?php  if($owner['car_number_2'] == 'M') { ?>selected<?php  } ?>>M</option>
                        <option <?php  if($owner['car_number_2'] == 'N') { ?>selected<?php  } ?>>N</option>
                        <option <?php  if($owner['car_number_2'] == 'O') { ?>selected<?php  } ?>>O</option>
                        <option <?php  if($owner['car_number_2'] == 'P') { ?>selected<?php  } ?>>P</option>
                        <option <?php  if($owner['car_number_2'] == 'Q') { ?>selected<?php  } ?>>Q</option>
                        <option <?php  if($owner['car_number_2'] == 'R') { ?>selected<?php  } ?>>R</option>
                        <option <?php  if($owner['car_number_2'] == 'S') { ?>selected<?php  } ?>>S</option>
                        <option <?php  if($owner['car_number_2'] == 'T') { ?>selected<?php  } ?>>T</option>
                        <option <?php  if($owner['car_number_2'] == 'U') { ?>selected<?php  } ?>>U</option>
                        <option <?php  if($owner['car_number_2'] == 'V') { ?>selected<?php  } ?>>V</option>
                        <option <?php  if($owner['car_number_2'] == 'W') { ?>selected<?php  } ?>>W</option>
                        <option <?php  if($owner['car_number_2'] == 'X') { ?>selected<?php  } ?>>X</option>
                        <option <?php  if($owner['car_number_2'] == 'Y') { ?>selected<?php  } ?>>Y</option>
                        <option <?php  if($owner['car_number_2'] == 'Z') { ?>selected<?php  } ?>>Z</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <input id="car_number_3" class="form-control" name="car_number_3" style="text-transform:uppercase;" maxlength="6"  onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" value="<?php  echo $owner['car_number_3'];?>" class="weui_input" type="text" placeholder="请输六位数字字母"/>
				</div>
		  	</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">车型</label>
				<div class="col-sm-10">
					<input name="car_series" class="form-control" value="<?php  echo $owner['car_series'];?>" />
				</div>
		  	</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">车身颜色</label>
				<div class="col-sm-10">
					<input name="car_color" class="form-control" value="<?php  echo $owner['car_color'];?>" />
				</div>
		  	</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">行驶证</label>
				<div class="col-sm-10">
                    <?php  echo tpl_form_field_image('vehicle_travel_license',$owner['vehicle_travel_license']);?>
				</div>
		  	</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">驾驶证</label>
				<div class="col-sm-10">
                    <?php  echo tpl_form_field_image('driving_license',$owner['driving_license']);?>
				</div>
		  	</div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">车辆照片</label>
				<div class="col-sm-10">
                    <?php  echo tpl_form_field_image('car_img',$owner['car_img']);?>
				</div>
		  	</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">保险单</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('insurance_img',$owner['insurance_img']);?>
                    <div><a href="<?php  echo tomedia($owner['insurance_img'])?>">查看大图</a></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">保险有效期</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_date('insurance_expire',date('Y-m-d',$owner['insurance_expire']),false);?>
                </div>
            </div>
		  	<div class="form-group">
				<label class="col-sm-2 control-label">审核</label>
				<div class="col-sm-10">
					<select class="form-control" name="status">
						<option value="1" <?php  if($owner['status']=='1') { ?>selected<?php  } ?>>有效</option>
						<option value="0" <?php  if($owner['status']=='0') { ?>selected<?php  } ?>>无效</option>
					</select>
				</div>
		  	</div>
            <div class="form-group">
                <label class="col-sm-2 control-label">审核备注</label>
                <div class="col-sm-10">
                    <input name="note" class="form-control" placeholder="请输入审核备注" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">上级邀请司机</label>
                <div class="col-sm-10">
                    <?php  if($owner['inviter_uid'] > 0) { ?>
                        <img src="<?php  echo $inviter['avatar'];?>" width="30px" height="30px" style="border-radius: 15px" />
                        <?php  echo $inviter['name'];?>
                    <?php  } ?>
                </div>
            </div>
		  	<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="edit" value="修改">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<div class="over" style="display:none">
    <img id="big_pic" src=""></div>
</div>
<style type="text/css">
    .over {position: fixed; left:0; top:0; width:100%;height:100%; z-index:100;background:rgba(0, 0, 0, 0.6)!important;filter:Alpha(opacity=60); background:#000;text-align: center;}
</style>
<script type="text/javascript">
    $(".img-thumbnail").click(function(){
        var src = $(this).attr('src');
        $("#big_pic").attr('src',src);
        $(".over").show();
        var img_width = $("#big_pic").css('width');
        var img_height = $("#big_pic").css('height');
        var screen_width = window.screen.availHeight;
        var screen_height = window.screen.availHeight;
        var screen_scale = screen_width / screen_height;
        var margin_x = 100;
        var margin_y = 100 / screen_scale;
        screen_width = screen_width-margin_x;
        screen_height = screen_height - margin_y;
        if(img_width / img_height >= screen_width / screen_height) {
            $("#big_pic").css('width',screen_width);
            $("#big_pic").css('margin-top',(screen_height-(img_height*screen_scale))/2 + margin_y / 2);
        } else {
            $("#big_pic").css('height',screen_height);
            $("#big_pic").css('margin-top',margin_y / 2);
        }
    })
    $(".over").click(function() {
        $(this).hide();
    })
</script>
<?php  } else if($op == 'add_wx_owner') { ?>
<div id="add_sender_0_panel" class="panel panel-default">
    <div class="panel-heading">从微信添加</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">成员查找</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input name="search_key" type="text" class="form-control" placeholder="请输入成员昵称、姓名或者联系电话查找" />
                        <span class="input-group-addon" style="cursor: pointer;" onclick="search()">查找</span>
                    </div>
                    <div id="member_info" style="margin-top:10px">

                    </div>
                    <input type="hidden" name="to_add_sender" id="to_add_sender"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车牌号省份：</label>
                <div class="col-sm-10">
                    <select id="car_number_1" name="car_number_1" class="form-control">
                        <option <?php  if($owner['car_number_1'] == '京') { ?>selected<?php  } ?>>京</option>
                        <option <?php  if($owner['car_number_1'] == '津') { ?>selected<?php  } ?>>津</option>
                        <option <?php  if($owner['car_number_1'] == '冀') { ?>selected<?php  } ?>>冀</option>
                        <option <?php  if($owner['car_number_1'] == '晋') { ?>selected<?php  } ?>>晋</option>
                        <option <?php  if($owner['car_number_1'] == '蒙') { ?>selected<?php  } ?>>蒙</option>
                        <option <?php  if($owner['car_number_1'] == '辽') { ?>selected<?php  } ?>>辽</option>
                        <option <?php  if($owner['car_number_1'] == '吉') { ?>selected<?php  } ?>>吉</option>
                        <option <?php  if($owner['car_number_1'] == '黑') { ?>selected<?php  } ?>>黑</option> 
                        <option <?php  if($owner['car_number_1'] == '沪') { ?>selected<?php  } ?>>沪</option>
                        <option <?php  if($owner['car_number_1'] == '苏') { ?>selected<?php  } ?>>苏</option> 
                        <option <?php  if($owner['car_number_1'] == '浙') { ?>selected<?php  } ?>>浙</option>
                        <option <?php  if($owner['car_number_1'] == '皖') { ?>selected<?php  } ?>>皖</option>
                        <option <?php  if($owner['car_number_1'] == '闽') { ?>selected<?php  } ?>>闽</option>
                        <option <?php  if($owner['car_number_1'] == '赣') { ?>selected<?php  } ?>>赣</option>
                        <option <?php  if($owner['car_number_1'] == '鲁') { ?>selected<?php  } ?>>鲁</option>
                        <option <?php  if($owner['car_number_1'] == '豫') { ?>selected<?php  } ?>>豫</option>
                        <option <?php  if($owner['car_number_1'] == '鄂') { ?>selected<?php  } ?>>鄂</option>
                        <option <?php  if($owner['car_number_1'] == '湘') { ?>selected<?php  } ?>>湘</option> 
                        <option <?php  if($owner['car_number_1'] == '粤') { ?>selected<?php  } ?>>粤</option>
                        <option <?php  if($owner['car_number_1'] == '桂') { ?>selected<?php  } ?>>桂</option>
                        <option <?php  if($owner['car_number_1'] == '琼') { ?>selected<?php  } ?>>琼</option>
                        <option <?php  if($owner['car_number_1'] == '渝') { ?>selected<?php  } ?>>渝</option>
                        <option <?php  if($owner['car_number_1'] == '川') { ?>selected<?php  } ?>>川</option>
                        <option <?php  if($owner['car_number_1'] == '贵') { ?>selected<?php  } ?>>贵</option>
                        <option <?php  if($owner['car_number_1'] == '云') { ?>selected<?php  } ?>>云</option>
                        <option <?php  if($owner['car_number_1'] == '藏') { ?>selected<?php  } ?>>藏</option>
                        <option <?php  if($owner['car_number_1'] == '陕') { ?>selected<?php  } ?>>陕</option>
                        <option <?php  if($owner['car_number_1'] == '甘') { ?>selected<?php  } ?>>甘</option>
                        <option <?php  if($owner['car_number_1'] == '青') { ?>selected<?php  } ?>>青</option>
                        <option <?php  if($owner['car_number_1'] == '宁') { ?>selected<?php  } ?>>宁</option>
                        <option <?php  if($owner['car_number_1'] == '新') { ?>selected<?php  } ?>>新</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车牌号城市：</label>
                <div class="col-sm-10">
                    <select id="car_number_2" name="car_number_2" class="form-control">
                        <option <?php  if($owner['car_number_2'] == 'A') { ?>selected<?php  } ?>>A</option>
                        <option <?php  if($owner['car_number_2'] == 'B') { ?>selected<?php  } ?>>B</option>
                        <option <?php  if($owner['car_number_2'] == 'C') { ?>selected<?php  } ?>>C</option>
                        <option <?php  if($owner['car_number_2'] == 'D') { ?>selected<?php  } ?>>D</option>
                        <option <?php  if($owner['car_number_2'] == 'E') { ?>selected<?php  } ?>>E</option>
                        <option <?php  if($owner['car_number_2'] == 'F') { ?>selected<?php  } ?>>F</option>
                        <option <?php  if($owner['car_number_2'] == 'G') { ?>selected<?php  } ?>>G</option>
                        <option <?php  if($owner['car_number_2'] == 'H') { ?>selected<?php  } ?>>H</option>
                        <option <?php  if($owner['car_number_2'] == 'I') { ?>selected<?php  } ?>>I</option>
                        <option <?php  if($owner['car_number_2'] == 'J') { ?>selected<?php  } ?>>J</option>
                        <option <?php  if($owner['car_number_2'] == 'K') { ?>selected<?php  } ?>>K</option>
                        <option <?php  if($owner['car_number_2'] == 'L') { ?>selected<?php  } ?>>L</option>
                        <option <?php  if($owner['car_number_2'] == 'M') { ?>selected<?php  } ?>>M</option>
                        <option <?php  if($owner['car_number_2'] == 'N') { ?>selected<?php  } ?>>N</option>
                        <option <?php  if($owner['car_number_2'] == 'O') { ?>selected<?php  } ?>>O</option>
                        <option <?php  if($owner['car_number_2'] == 'P') { ?>selected<?php  } ?>>P</option>
                        <option <?php  if($owner['car_number_2'] == 'Q') { ?>selected<?php  } ?>>Q</option>
                        <option <?php  if($owner['car_number_2'] == 'R') { ?>selected<?php  } ?>>R</option>
                        <option <?php  if($owner['car_number_2'] == 'S') { ?>selected<?php  } ?>>S</option>
                        <option <?php  if($owner['car_number_2'] == 'T') { ?>selected<?php  } ?>>T</option>
                        <option <?php  if($owner['car_number_2'] == 'U') { ?>selected<?php  } ?>>U</option>
                        <option <?php  if($owner['car_number_2'] == 'V') { ?>selected<?php  } ?>>V</option>
                        <option <?php  if($owner['car_number_2'] == 'W') { ?>selected<?php  } ?>>W</option>
                        <option <?php  if($owner['car_number_2'] == 'X') { ?>selected<?php  } ?>>X</option>
                        <option <?php  if($owner['car_number_2'] == 'Y') { ?>selected<?php  } ?>>Y</option>
                        <option <?php  if($owner['car_number_2'] == 'Z') { ?>selected<?php  } ?>>Z</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车牌号六位字母数字：</label>
                <div class="col-sm-10">
                    <input name="car_number_3" type="text" class="form-control" placeholder="请输入车牌号六位字母数字" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车身颜色</label>
                <div class="col-sm-10">
                    <input name="car_color" type="text" class="form-control" placeholder="请输入车身颜色" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车型</label>
                <div class="col-sm-10">
                    <input name="car_series" type="text" class="form-control" placeholder="请输入车型" />
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
<script>
function search() {
    if($("input[name='search_key']").val() == "") {
        alert("请输入要查找成员昵称、姓名或者联系电话！");
    } else {
        $.post("<?php  echo $this->createWeburl('owner',array('op'=>'search_member'))?>",{
                search_key:$("input[name='search_key']").val()
            },function(resp) {
                resp = $.parseJSON(resp);
                var member = resp.message.message;
                var html = "";
                if(member.avatar != '') {
                    html += '<img src="' + member.avatar + '" width="30px" height="30px" style="border-radius:15px" />';
                }
                if(member.nickname != '') {
                    html += '<span>'+member.nickname+'</span>'
                }
                if(member.realname != '') {
                    html += '&#12288;真实姓名：'+member.realname;
                }
                if(member.mobile != '') {
                    html += '&#12288;联系电话：'+member.mobile;
                }
                $("#member_info").html(html);
                $("#to_add_sender").val(member.uid);
            }
        );
    }
}
</script>
<?php  } else if($op == 'add_back_owner') { ?>
<div id="add_sender_1_panel" class="panel panel-default">
    <div class="panel-heading">从后台添加</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="请输入用户名" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">联系电话</label>
                <div class="col-sm-10">
                    <input name="mobile" type="number" class="form-control" placeholder="请输入联系电话" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">头像</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('avatar');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车牌号省份：</label>
                <div class="col-sm-10">
                    <select id="car_number_1" name="car_number_1" class="form-control">
                        <option <?php  if($owner['car_number_1'] == '京') { ?>selected<?php  } ?>>京</option>
                        <option <?php  if($owner['car_number_1'] == '津') { ?>selected<?php  } ?>>津</option>
                        <option <?php  if($owner['car_number_1'] == '冀') { ?>selected<?php  } ?>>冀</option>
                        <option <?php  if($owner['car_number_1'] == '晋') { ?>selected<?php  } ?>>晋</option>
                        <option <?php  if($owner['car_number_1'] == '蒙') { ?>selected<?php  } ?>>蒙</option>
                        <option <?php  if($owner['car_number_1'] == '辽') { ?>selected<?php  } ?>>辽</option>
                        <option <?php  if($owner['car_number_1'] == '吉') { ?>selected<?php  } ?>>吉</option>
                        <option <?php  if($owner['car_number_1'] == '黑') { ?>selected<?php  } ?>>黑</option> 
                        <option <?php  if($owner['car_number_1'] == '沪') { ?>selected<?php  } ?>>沪</option>
                        <option <?php  if($owner['car_number_1'] == '苏') { ?>selected<?php  } ?>>苏</option> 
                        <option <?php  if($owner['car_number_1'] == '浙') { ?>selected<?php  } ?>>浙</option>
                        <option <?php  if($owner['car_number_1'] == '皖') { ?>selected<?php  } ?>>皖</option>
                        <option <?php  if($owner['car_number_1'] == '闽') { ?>selected<?php  } ?>>闽</option>
                        <option <?php  if($owner['car_number_1'] == '赣') { ?>selected<?php  } ?>>赣</option>
                        <option <?php  if($owner['car_number_1'] == '鲁') { ?>selected<?php  } ?>>鲁</option>
                        <option <?php  if($owner['car_number_1'] == '豫') { ?>selected<?php  } ?>>豫</option>
                        <option <?php  if($owner['car_number_1'] == '鄂') { ?>selected<?php  } ?>>鄂</option>
                        <option <?php  if($owner['car_number_1'] == '湘') { ?>selected<?php  } ?>>湘</option> 
                        <option <?php  if($owner['car_number_1'] == '粤') { ?>selected<?php  } ?>>粤</option>
                        <option <?php  if($owner['car_number_1'] == '桂') { ?>selected<?php  } ?>>桂</option>
                        <option <?php  if($owner['car_number_1'] == '琼') { ?>selected<?php  } ?>>琼</option>
                        <option <?php  if($owner['car_number_1'] == '渝') { ?>selected<?php  } ?>>渝</option>
                        <option <?php  if($owner['car_number_1'] == '川') { ?>selected<?php  } ?>>川</option>
                        <option <?php  if($owner['car_number_1'] == '贵') { ?>selected<?php  } ?>>贵</option>
                        <option <?php  if($owner['car_number_1'] == '云') { ?>selected<?php  } ?>>云</option>
                        <option <?php  if($owner['car_number_1'] == '藏') { ?>selected<?php  } ?>>藏</option>
                        <option <?php  if($owner['car_number_1'] == '陕') { ?>selected<?php  } ?>>陕</option>
                        <option <?php  if($owner['car_number_1'] == '甘') { ?>selected<?php  } ?>>甘</option>
                        <option <?php  if($owner['car_number_1'] == '青') { ?>selected<?php  } ?>>青</option>
                        <option <?php  if($owner['car_number_1'] == '宁') { ?>selected<?php  } ?>>宁</option>
                        <option <?php  if($owner['car_number_1'] == '新') { ?>selected<?php  } ?>>新</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车牌号城市：</label>
                <div class="col-sm-10">
                    <select id="car_number_2" name="car_number_2" class="form-control">
                        <option <?php  if($owner['car_number_2'] == 'A') { ?>selected<?php  } ?>>A</option>
                        <option <?php  if($owner['car_number_2'] == 'B') { ?>selected<?php  } ?>>B</option>
                        <option <?php  if($owner['car_number_2'] == 'C') { ?>selected<?php  } ?>>C</option>
                        <option <?php  if($owner['car_number_2'] == 'D') { ?>selected<?php  } ?>>D</option>
                        <option <?php  if($owner['car_number_2'] == 'E') { ?>selected<?php  } ?>>E</option>
                        <option <?php  if($owner['car_number_2'] == 'F') { ?>selected<?php  } ?>>F</option>
                        <option <?php  if($owner['car_number_2'] == 'G') { ?>selected<?php  } ?>>G</option>
                        <option <?php  if($owner['car_number_2'] == 'H') { ?>selected<?php  } ?>>H</option>
                        <option <?php  if($owner['car_number_2'] == 'I') { ?>selected<?php  } ?>>I</option>
                        <option <?php  if($owner['car_number_2'] == 'J') { ?>selected<?php  } ?>>J</option>
                        <option <?php  if($owner['car_number_2'] == 'K') { ?>selected<?php  } ?>>K</option>
                        <option <?php  if($owner['car_number_2'] == 'L') { ?>selected<?php  } ?>>L</option>
                        <option <?php  if($owner['car_number_2'] == 'M') { ?>selected<?php  } ?>>M</option>
                        <option <?php  if($owner['car_number_2'] == 'N') { ?>selected<?php  } ?>>N</option>
                        <option <?php  if($owner['car_number_2'] == 'O') { ?>selected<?php  } ?>>O</option>
                        <option <?php  if($owner['car_number_2'] == 'P') { ?>selected<?php  } ?>>P</option>
                        <option <?php  if($owner['car_number_2'] == 'Q') { ?>selected<?php  } ?>>Q</option>
                        <option <?php  if($owner['car_number_2'] == 'R') { ?>selected<?php  } ?>>R</option>
                        <option <?php  if($owner['car_number_2'] == 'S') { ?>selected<?php  } ?>>S</option>
                        <option <?php  if($owner['car_number_2'] == 'T') { ?>selected<?php  } ?>>T</option>
                        <option <?php  if($owner['car_number_2'] == 'U') { ?>selected<?php  } ?>>U</option>
                        <option <?php  if($owner['car_number_2'] == 'V') { ?>selected<?php  } ?>>V</option>
                        <option <?php  if($owner['car_number_2'] == 'W') { ?>selected<?php  } ?>>W</option>
                        <option <?php  if($owner['car_number_2'] == 'X') { ?>selected<?php  } ?>>X</option>
                        <option <?php  if($owner['car_number_2'] == 'Y') { ?>selected<?php  } ?>>Y</option>
                        <option <?php  if($owner['car_number_2'] == 'Z') { ?>selected<?php  } ?>>Z</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车牌号六位字母数字：</label>
                <div class="col-sm-10">
                    <input name="car_number_3" type="text" class="form-control" placeholder="请输入车牌号六位字母数字" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车身颜色</label>
                <div class="col-sm-10">
                    <input name="car_color" type="text" class="form-control" placeholder="请输入车身颜色" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">车型</label>
                <div class="col-sm-10">
                    <input name="car_series" type="text" class="form-control" placeholder="请输入车型" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="back_add_submit" value="添加">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'client') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">乘客列表</div>
        <div class="panel-body">
            <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
                <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                    <tr>
                        <th style="text-align: center">头像、昵称</th>
                        <th style="text-align: center">姓名</th>
                        <th style="text-align: center">联系电话</th>
                        <th style="text-align: center">注册时间</th>
                        <th style="text-align: center">信誉值</th>
                        <th style="text-align: center;width:100px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($client)) { foreach($client as $index => $item) { ?>
                        <tr id="<?php  echo $item['id'];?>">
                            <td style="text-align: center">
                                <img src="<?php  echo $item['avatar'];?>" width="30px" height="30px" />
                                <span style="position: relative;top:2px"><?php  echo $item['nickname'];?></span>
                            </td>
                            <td style="text-align: center"><?php  echo $item['realname'];?></td>
                            <td style="text-align: center"><?php  echo $item['mobile'];?></td>
                            <td style="text-align: center"><?php  echo date('Y-m-d H:i',$item['register_time'])?></td>
                            <td style="text-align: center">
                                <input style="width:50px;text-align: center" name="client_credit_<?php  echo $item['id'];?>" value="<?php  echo $item['credit_score'];?>" />
                            </td>
                            <td style="text-align: center">
                                <a href="javascript:delete_client(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php  } } ?>
                </tbody>
            </table>
        </div>
    </div>
<script>
$("input[name^='client_credit_']").change(function(){
    var id_str = $(this).attr('name');
    var id_arr = id_str.split("_");
    $.post("<?php  echo $this->createWeburl('owner',array('op'=>'change_owner_credit'))?>",{
            id:id_arr[2],
            credit_score:$("input[name='"+id_str+"']").val()
        },function(resp) {
            resp = $.parseJSON(resp);
            tankuang(300,'修改成功！');
        }
    );
})
function delete_client(id) {
    var r = confirm("删除乘客！");
    if(r) {
        $.post("<?php  echo $this->createWeburl('owner', array('op' => 'delete_client'));?>",{
                id:id
            },
            function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno != 0) {
                    util.message('操作失败, 请稍后重试.')
                } else {
                    util.message('操作成功', location.href, 'success');
                }
            }
        );
    }
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