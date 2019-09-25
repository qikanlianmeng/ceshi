<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'add_notice' OR $op == 'edit_notice') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('platform',array('op'=>'notice'))?>">公告管理</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'index') { ?>
        	统计
        <?php  } else if($op == 'comment') { ?>
            评价管理
        <?php  } else if($op == 'level') { ?>
            信用等级
        <?php  } else if($op == 'credit') { ?>
            信用积分体系
        <?php  } else if($op == 'template') { ?>
            乘客评论模板
        <?php  } else if($op == 'owner_template') { ?>
            车主评论模板
        <?php  } else if($op == 'suggestion') { ?>
            意见建议
        <?php  } else if($op == 'notice') { ?>
            公告管理
        <?php  } else if($op == 'add_notice') { ?>
            添加公告
        <?php  } else if($op == 'edit_notice') { ?>
            编辑公告
        <?php  } else if($op == 'notice_type') { ?>
            公告分类
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'index') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		平台统计
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">司机数量</label>
				<div class="col-sm-3">
					<input type="number" id="owner_amount" class="form-control" name="owner_amount" value="<?php  echo $platform['owner_amount'];?>" />
				</div>
				<label class="col-sm-2 control-label">乘客数量</label>
				<div class="col-sm-3">
					<input type="number" id="passenger_amount" class="form-control" name="passenger_amount" value="<?php  echo $platform['passenger_amount'];?>" />
				</div>
				<div class="col-sm-2">
					<button class="btn btn-primary" onclick="re_cal();return false;">一键统计</button>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="platform_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	function re_cal() {
		$.post("<?php  echo $this->createWeburl('platform',array('op'=>'re_cal_platform'))?>",function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					tankuang(200,'统计成功！');
					var info = resp.message.message;
					$("#owner_amount").val(info.owner_amount);
					$("#passenger_amount").val(info.passenger_amount);
				}
			}
		);
	}
</script>
<?php  } else if($op == 'comment') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		评价管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">司机</th>
					<th style="text-align: center">乘客</th>
					<th style="text-align: center">线路</th>
					<th style="text-align: center">出行时间</th>
					<th style="text-align: center">评价等级</th>
					<th style="text-align: center">评价内容</th>
					<th style="text-align: center">留言</th>
					<th style="text-align: center">评价时间</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($comment_info)) { foreach($comment_info as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center">
							<img src="<?php  echo $item['owner_avatar'];?>" width="30px" height="30px" style="border-radius: 15px" />
							<?php  echo $item['owner_mobile'];?>
						</td>
						<td style="text-align: center">
							<img src="<?php  echo $item['avatar'];?>" width="30px" height="30px" style="border-radius: 15px" />
							<?php  echo $item['mobile'];?>
						</td>
						<td style="text-align: center">
							<?php  echo $item['departure_station'];?>-><?php  echo $item['terminal_station'];?>
						</td>
						<td style="text-align: center">
							<?php  echo date('Y-m-d H:i',$item['departure_time'])?>
						</td>
						<td style="text-align: center">
							<?php  if($item['comment_level']=='0') { ?>
								<span class="label label-success">好评</span>
							<?php  } else if($item['comment_level'] == '1') { ?>
								<span class="label label-success">中评</span>
							<?php  } else if($item['comment_level'] == '2') { ?>
								<span class="label label-danger">差评</span>
							<?php  } ?>
						</td>
						<td style="text-align: center">
							<?php  if(is_array($item['content'])) { foreach($item['content'] as $i => $it) { ?>
								<span class="label label-warning"><?php  echo $it;?></span>
							<?php  } } ?>
						</td>
						<td style="text-align: center"><?php  echo $item['other'];?></td>
						<td style="text-align: center"><?php  echo date('Y-m-d H:i',$item['time'])?></td>
						<td style="text-align: center">
							<a href="javascript:delete_comment(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
function delete_comment(id) {
	$.post("<?php  echo $this->createWeburl('platform',array('op'=>'delete_comment'))?>",{
			id:id
		},function(resp) {
			resp = $.parseJSON(resp);
			if(resp.message.errno == 0) {
				$("#"+id).remove();
				tankuang(300,'删除评论成功！');
			}
		}
	);
}
</script>
<?php  } else if($op == 'level') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		信用等级
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">等级</th>
					<th style="text-align: center">最低分数</th>
					<th style="text-align: center;width:200px">排序</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($all_level)) { foreach($all_level as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center">
							<span class="label" style="background-color:<?php  echo $item['color'];?>;color:white"><?php  echo $item['name'];?></span>
						</td>
						<td style="text-align: center">
							<?php  echo $item['score'];?>
						</td>
						<td style="text-align: center">
							<div class="input-group">
								<input id="order_index_<?php  echo $item['id'];?>" type="number" class="form-control" value="<?php  echo $item['order_index'];?>" />
								<span class="input-group-addon" onclick="set_order_index(<?php  echo $item['id'];?>)" style="cursor: pointer">设置</span>
							</div>
						</td>
						<td style="text-align: center">
							<a href="javascript:delete_level(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-primary">
			<div class="panel-heading">
				添加等级
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">名称</label>
						<div class="col-sm-10">
							<input name="name"  type="text" class="form-control" placeholder="请输入等级名称" />
						</div>
				  	</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">颜色</label>
						<div class="col-sm-10">
							<?php  echo tpl_form_field_color('color');?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">最低分数</label>
						<div class="col-sm-10">
							<input name="score"  type="text" class="form-control" placeholder="请输入等级最低分数" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="add" value="添加">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
function delete_level(id) {
	var r = confirm("删除等级！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('platform',array('op'=>'delete_level'))?>",{
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
function set_order_index(id) {
	$.post("<?php  echo $this->createWeburl('platform', array('op' => 'set_level_order_index'));?>",{
			id:id,
			order_index:$("#order_index_"+id).val()
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
</script>
<?php  } else if($op == 'credit') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		信用积分设置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">乘客强行取消拼车</label>
				<div class="col-sm-10">
					<input name="passenger_cancel_pin_credit_score" value="<?php  echo $conf['passenger_cancel_pin_credit_score'];?>"  type="text" class="form-control" placeholder="请输入好评增减积分" />
					<label style="font-size:12px;color:red">如果需要减少积分，请设置为负数。比如要减10分请填写："-10"</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="credit_score_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		评论积分设置
	</div>
	<div class="panel-body">
		<form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">好评</label>
				<div class="col-sm-10">
					<input name="level_0" value="<?php  echo $conf['comment_level_0_point'];?>"  type="text" class="form-control" placeholder="请输入好评增减积分" />
					<label style="font-size:12px;color:red">如果需要减少积分，请设置为负数。比如要减10分请填写："-10"</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">中评</label>
				<div class="col-sm-10">
					<input name="level_1" value="<?php  echo $conf['comment_level_1_point'];?>"  type="text" class="form-control" placeholder="请输入中评增减积分" />
					<label style="font-size:12px;color:red">如果需要减少积分，请设置为负数。比如要减10分请填写："-10"</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">差评</label>
				<div class="col-sm-10">
					<input name="level_2" value="<?php  echo $conf['comment_level_2_point'];?>" type="text" class="form-control" placeholder="请输入差评增减积分" />
					<label style="font-size:12px;color:red">如果需要减少积分，请设置为负数。比如要减10分请填写："-10"</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="comment_credit_score_submit" value="设置">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<?php  } else if($op == 'template') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		乘客评论模板管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">评论</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($template)) { foreach($template as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center"><?php  echo $item['content'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_pin(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-primary">
			<div class="panel-heading">
				添加评论模板
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">评论</label>
						<div class="col-sm-10">
							<input name="content"  type="text" class="form-control" placeholder="请输入评论" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="add" value="添加">
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
		$.post("<?php  echo $this->createWeburl('platform',array('op'=>delete_template))?>",{
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
<?php  } else if($op == 'owner_template') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		车主评论模板管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center">评论</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($template)) { foreach($template as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center"><?php  echo $item['content'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_pin(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<div class="panel panel-primary">
			<div class="panel-heading">
				添加评论模板
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">评论</label>
						<div class="col-sm-10">
							<input name="content"  type="text" class="form-control" placeholder="请输入评论" />
						</div>
				  	</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-default" name="add" value="添加">
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
		$.post("<?php  echo $this->createWeburl('platform',array('op'=>delete_template))?>",{
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
<?php  } else if($op == 'suggestion') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		意见建议管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center;width:50px">头像</th>
					<th style="text-align: center;width:100px">姓名</th>
					<th style="text-align: center;width:100px">联系电话</th>
					<th style="text-align: center;">建议</th>
					<th style="text-align: center;width:120px">提交时间</th>
					<th style="text-align: center;width:100px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $index => $item) { ?>
					<tr id="<?php  echo $item['id'];?>">
						<td style="text-align: center">
							<img src="<?php  echo $item['avatar'];?>" width="30px" height="30px" style="border-radius: 15px">
						</td>
						<td style="text-align: center">
							<?php  echo $item['name'];?>
						</td>
						<td style="text-align: center">
							<?php  echo $item['mobile'];?>
						</td>
						<td style="text-align: center">
							<?php  echo $item['content'];?>
						</td>
						<td style="text-align: center">
							<?php  echo date('Y-m-d H:i',$item['release_time'])?>
						</td>
						<td style="text-align: center">
							<a href="javascript:delete_suggestion(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	function delete_suggestion(id) {
		$.post("<?php  echo $this->createWeburl('platform',array('op'=>'delete_suggestion'))?>",{
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
<?php  } else if($op == 'notice') { ?>
	<div class="panel panel-default">
        <div class="panel-heading">公告列表</div>
        <div class="panel-body">
            <div style="text-align: right">
                <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('platform',array('op'=>'add_notice'))?>'">添加公告</button>
            </div>
            <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
                <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                    <tr>
                        <th style="text-align: center">分类</th>
                        <th style="text-align: center">标题</th>
                        <th style="text-align: center;width:100px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($notice)) { foreach($notice as $index => $item) { ?>
                        <tr id="notice_<?php  echo $item['id'];?>">
                            <td style="text-align: center"><?php  echo $item['type'];?></td>
                            <td style="text-align: center">
                                <?php  echo $item['title'];?>
                            </td>
                            <td style="text-align: center">
                                <a href="<?php  echo $this->createWeburl('platform',array('op'=>'edit_notice','id'=>$item['id']))?>"><i class="fa fa-edit"></i></a>
                                <a href="javascript:delete_notice(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php  } } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    function delete_notice(id) {
        $.post("<?php  echo $this->createWeburl('platform',array('op'=>'delete_notice'))?>",{
                id:id
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    tankuang(300,'删除成功！');
                    $("#notice_"+id).remove();
                }
            }
        );
    }
    </script>
<?php  } else if($op == 'add_notice') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">添加公告</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类</label>
                    <div class="col-sm-10">
                        <select name="type" class="form-control">
                            <?php  if(is_array($type)) { foreach($type as $index => $item) { ?>
                                <option value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">标题</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" placeholder="请输入公告标题" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">正文</label>
                    <div class="col-sm-10">
                        <?php  echo tpl_ueditor('content');?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="add_notice" value="添加">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php  } else if($op == 'edit_notice') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">编辑公告</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类</label>
                    <div class="col-sm-10">
                        <select name="type" class="form-control">
                            <?php  if(is_array($type)) { foreach($type as $index => $item) { ?>
                                <option <?php  if($item['id']==$notice['type']) { ?>selected<?php  } ?> value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">标题</label>
                    <div class="col-sm-10">
                        <input name="title" value="<?php  echo $notice['title'];?>" type="text" class="form-control" placeholder="请输入公告标题" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">正文</label>
                    <div class="col-sm-10">
                        <?php  echo tpl_ueditor('content', $notice['content']);?>
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
<?php  } else if($op == 'notice_type') { ?>
	<div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
                <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                    <tr>
                        <th style="text-align: center">分类名称</th>
                        <th style="text-align: center">颜色</th>
                        <th style="text-align: center;width:100px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($all_type)) { foreach($all_type as $index => $item) { ?>
                        <tr id="type_<?php  echo $item['id'];?>">
                            <td style="text-align: center"><?php  echo $item['name'];?></td>
                            <td style="text-align: center">
                                <div style="width:20px;height:20px;background-color: <?php  echo $item['color'];?>;margin:0px auto"></div>
                            </td>
                            <td style="text-align: center">
                                <a href="javascript:delete_type(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php  } } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">添加分类</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">分类名称</label>
                    <div class="col-sm-10">
                        <input name="name" type="text" class="form-control" placeholder="请输入标签名称" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">背景色</label>
                    <div class="col-sm-10">
                        <?php  echo tpl_form_field_color('color');?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="add_type" value="添加">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    function delete_type(id) {
        $.post("<?php  echo $this->createWeburl('platform',array('op'=>'delete_notice_type'))?>",{
                id:id
            },function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    tankuang(300,'删除成功！');
                    $("#type_"+id).remove();
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