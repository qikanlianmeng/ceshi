<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'detail') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('pin')?>">出车</a>
    </li>
    <?php  } ?>
    <?php  if($op == 'cargo_detail') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('pin',array('op'=>'cargo'))?>">拼货出车</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'index') { ?>
            出车
        <?php  } else if($op == 'detail') { ?>
            出车详情
        <?php  } else if($op == 'cargo') { ?>
            拼货出车
        <?php  } else if($op == 'cargo_detail') { ?>
            专线详情
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'index') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		出车管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center;width:60px">类别</th>
					<th style="text-align: center">始发站</th>
					<th style="text-align: center">目的地</th>
					<th style="text-align: center">出行时间</th>
					<th style="text-align: center">可乘人数</th>
					<th style="text-align: center">当前乘客数</th>
					<th style="text-align: center">集合地点</th>
					<th style="text-align: center">状态</th>
					<th style="text-align: center">价格</th>
					<th style="text-align: center;width:50px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($pin)) { foreach($pin as $index => $item) { ?>
					<tr id="pin_1_<?php  echo $item['id'];?>">
						<td colspan="10">
							<div style="margin:0px 100px 0px 0px;height:32px">
								车主：<?php  echo $item['owner_name'];?>&#12288;联系电话：<?php  echo $item['owner_tel'];?>&#12288;车型：<?php  echo $item['car_color'];?>&nbsp;<?php  echo $item['car_series'];?>&nbsp;<?php  echo $item['car_number_1'];?><?php  echo $item['car_number_2'];?><?php  echo $item['car_number_3'];?>
							</div>
							<div style="width:100px;margin:-32px 0px 0px auto">
								<button type="button" class="btn btn-default btn-xs" onclick="location.href='<?php  echo $this->createWeburl('pin',array('op'=>'detail','id'=>$item['id']))?>'">出车详情</button>
							</div>			
						</td>
					</tr>
					<tr id="pin_2_<?php  echo $item['id'];?>">
						<td style="text-align: center">
							<?php  if($item['type']=='1') { ?>
							<span class="label label-primary">
							<?php  } else if($item['type']=='2') { ?>
							<span class="label label-success">
							<?php  } else if($item['type']=='3') { ?>
							<span class="label label-info">
							<?php  } else if($item['type']=='4') { ?>
							<span class="label label-warning">
							<?php  } else if($item['type']=='5') { ?>
							<span class="label label-warning">
							<?php  } ?>
								<?php  echo $this->trans_travel_type($item['type']);?>
							</span>
						</td>
						<td style="text-align: center"><?php  echo $item['departure_station'];?></td>
						<td style="text-align: center"><?php  echo $item['terminal_station'];?></td>
						<td style="text-align: center">
							<?php  echo date('Y-m-d H:i:s',$item['departure_time'])?>
						</td>
						<td style="text-align: center"><?php  echo $item['passenger_count'];?></td>
						<td style="text-align: center">
							<input style="width:50px" onchange="change_pined_amount(<?php  echo $item['id'];?>)" type="number" id="pined_amount_<?php  echo $item['id'];?>" value="<?php  echo $item['pined_amount'];?>" />
						</td>
						<td style="text-align: center"><?php  echo $item['boarding_place'];?></td>
						<td style="text-align: center">
							<?php  if($item['status']=='0') { ?>
								<span class="label label-primary"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status']=='1') { ?>
								<span class="label label-warning"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status'] == '2') { ?>
								<span class="label label-danger"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status'] == '9') { ?>
								<span class="label label-default"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status'] == '3') { ?>
								<span class="label label-success"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } ?>
						</td>
						<td style="text-align: center"><?php  echo $item['price'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_pin(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
function change_pined_amount(id) {
	$.post("<?php  echo $this->createWeburl('pin',array('op'=>'change_pined_amount'))?>",{
			id:id,
			pined_amount:$("#pined_amount_"+id).val()
		},function(resp) {
			resp = $.parseJSON(resp);
			if(resp.message.errno == 0) {
				tankuang(200,"修改成功！");
			}
		}
	);
}
function delete_pin(id) {
	var r = confirm("删除出车！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('pin',array('op'=>delete_pin))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除出车成功！");
					$("#pin_1_"+id).remove();
					$("#pin_2_"+id).remove();
				}
			}
		);
	}
}
</script>
<?php  } else if($op == 'detail') { ?>
	<div class="alert alert-info">
		<div class="container" style="width:878px;margin-left:0px">
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					出发地：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['departure_station'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					目的地：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['terminal_station'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					出发时间：
				</div>
				<div class="col-sm-6">
					<?php  echo date('Y-m-d H:i:s',$pin['departure_time']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					登车地点：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['boarding_place'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					可乘人数：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['passenger_count'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					车主：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['owner_name'];?>(<?php  echo $pin['owner_tel'];?>)
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					车型：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['car_color'];?>&nbsp;<?php  echo $pin['car_series'];?>&nbsp;<?php  echo $pin['car_number_1'];?><?php  echo $pin['car_number_2'];?><?php  echo $pin['car_number_3'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					状态：
				</div>
				<div class="col-sm-6">
					<?php  if($pin['status']=='0') { ?>
						<span class="label label-primary"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } else if($pin['status']=='1') { ?>
						<span class="label label-warning"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } else if($pin['status'] == '2') { ?>
						<span class="label label-danger"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } else if($pin['status'] == '3') { ?>
						<span class="label label-success"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			乘客
		</div>
		<div class="panel-body">
			<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
				<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
					<tr>
						<th style="text-align: center">姓名</th>
						<th style="text-align: center">联系电话</th>
						<th style="text-align: center">人数</th>
						<th style="text-align: center">登车地点</th>
						<th style="text-align: center">状态</th>
						<th style="text-align: center;width:50px">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($travel)) { foreach($travel as $index => $item) { ?>
						<tr id="member_<?php  echo $item['id'];?>">
							<td style="text-align: center">
								<?php  echo $item['name'];?>
							</td>
							<td style="text-align: center">
								<?php  echo $item['mobile'];?>
							</td>
							<td style="text-align: center">
								<?php  echo $item['amount'];?>
							</td>
							<td style="text-align: center">
								<?php  echo $item['boarding_place'];?>
							</td>
							<td style="text-align: center">
								<?php  echo $this->trans_member_status($item['status'])?>
							</td>
							<td style="text-align: center">
								<a href="javascript:delete_member(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
	function delete_member(id) {
		var r = confirm("删除成员！");
		if(r) {
			$.post("<?php  echo $this->createWeburl('pin',array('op'=>'delete_member'))?>",{
					id:id
				},function(resp) {
					resp = $.parseJSON(resp);
					if(resp.message.errno == 0) {
						alert("删除成员成功！");
						$("#member_"+id).remove();
					}
				}
			);
		}
	}
	</script>
<?php  } else if($op == 'cargo') { ?>
<div class="panel panel-default">
	<div class="panel-heading">
		拼货出车
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center;width:60px">类别</th>
					<th style="text-align: center">始发站</th>
					<th style="text-align: center">目的地</th>
					<th style="text-align: center">状态</th>
					<th style="text-align: center">价格</th>
					<th style="text-align: center;width:50px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($pin)) { foreach($pin as $index => $item) { ?>
					<tr id="pin_1_<?php  echo $item['id'];?>">
						<td colspan="6">
							<div style="margin:0px 100px 0px 0px;height:32px">
								车主：<?php  echo $item['owner_name'];?>&#12288;联系电话：<?php  echo $item['owner_tel'];?>&#12288;车型：<?php  echo $item['car_color'];?>&nbsp;<?php  echo $item['car_series'];?>&nbsp;<?php  echo $item['car_number_1'];?><?php  echo $item['car_number_2'];?><?php  echo $item['car_number_3'];?>
							</div>
							<div style="width:100px;margin:-32px 0px 0px auto">
								<button type="button" class="btn btn-default btn-xs" onclick="location.href='<?php  echo $this->createWeburl('pin',array('op'=>'cargo_detail','id'=>$item['id']))?>'">出车详情</button>
							</div>			
						</td>
					</tr>
					<tr id="pin_2_<?php  echo $item['id'];?>">
						<td style="text-align: center">
							<?php  if($item['type']=='1') { ?>
							<span class="label label-primary">
							<?php  } else if($item['type']=='2') { ?>
							<span class="label label-success">
							<?php  } else if($item['type']=='3') { ?>
							<span class="label label-info">
							<?php  } else if($item['type']=='4') { ?>
							<span class="label label-warning">
							<?php  } else if($item['type']=='5') { ?>
							<span class="label label-warning">
							<?php  } ?>
								<?php  echo $this->trans_travel_type($item['type']);?>
							</span>
						</td>
						<td style="text-align: center"><?php  echo $item['departure_station'];?></td>
						<td style="text-align: center"><?php  echo $item['terminal_station'];?></td>
						<td style="text-align: center">
							<?php  if($item['status']=='0') { ?>
								<span class="label label-primary"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status']=='1') { ?>
								<span class="label label-warning"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status'] == '2') { ?>
								<span class="label label-danger"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status'] == '9') { ?>
								<span class="label label-default"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } else if($item['status'] == '3') { ?>
								<span class="label label-success"><?php  echo $this->trans_pin_status($item['status'])?></span>
							<?php  } ?>
						</td>
						<td style="text-align: center"><?php  echo $item['price'];?></td>
						<td style="text-align: center">
							<a href="javascript:delete_pin(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
function change_pined_amount(id) {
	$.post("<?php  echo $this->createWeburl('pin',array('op'=>'change_pined_amount'))?>",{
			id:id,
			pined_amount:$("#pined_amount_"+id).val()
		},function(resp) {
			resp = $.parseJSON(resp);
			if(resp.message.errno == 0) {
				tankuang(200,"修改成功！");
			}
		}
	);
}
function delete_pin(id) {
	var r = confirm("删除出车！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('pin',array('op'=>delete_pin))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除出车成功！");
					$("#pin_1_"+id).remove();
					$("#pin_2_"+id).remove();
				}
			}
		);
	}
}
</script>
<?php  } else if($op == 'cargo_detail') { ?>
	<div class="alert alert-info">
		<div class="container" style="width:878px;margin-left:0px">
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					出发地：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['departure_station'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					目的地：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['terminal_station'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					出发时间：
				</div>
				<div class="col-sm-6">
					<?php  echo date('Y-m-d H:i:s',$pin['departure_time']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					登车地点：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['boarding_place'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					可乘人数：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['passenger_count'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					车主：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['owner_name'];?>(<?php  echo $pin['owner_tel'];?>)
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					车型：
				</div>
				<div class="col-sm-6">
					<?php  echo $pin['car_color'];?>&nbsp;<?php  echo $pin['car_series'];?>&nbsp;<?php  echo $pin['car_number_1'];?><?php  echo $pin['car_number_2'];?><?php  echo $pin['car_number_3'];?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2" style="text-align: right">
					状态：
				</div>
				<div class="col-sm-6">
					<?php  if($pin['status']=='0') { ?>
						<span class="label label-primary"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } else if($pin['status']=='1') { ?>
						<span class="label label-warning"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } else if($pin['status'] == '2') { ?>
						<span class="label label-danger"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } else if($pin['status'] == '3') { ?>
						<span class="label label-success"><?php  echo $this->trans_pin_status($pin['status'])?></span>
					<?php  } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			货源
		</div>
		<div class="panel-body">
			<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
				<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
					<tr>
						<th style="text-align: center">姓名</th>
						<th style="text-align: center">联系电话</th>
						<th style="text-align: center">状态</th>
						<th style="text-align: center;width:50px">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($travel)) { foreach($travel as $index => $item) { ?>
						<tr id="member_<?php  echo $item['id'];?>">
							<td style="text-align: center">
								<?php  echo $item['name'];?>
							</td>
							<td style="text-align: center">
								<?php  echo $item['mobile'];?>
							</td>
							<td style="text-align: center">
								<?php  echo $this->trans_member_status($item['status'])?>
							</td>
							<td style="text-align: center">
								<a href="javascript:delete_member(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<script>
	function delete_member(id) {
		var r = confirm("删除成员！");
		if(r) {
			$.post("<?php  echo $this->createWeburl('pin',array('op'=>'delete_member'))?>",{
					id:id
				},function(resp) {
					resp = $.parseJSON(resp);
					if(resp.message.errno == 0) {
						alert("删除成员成功！");
						$("#member_"+id).remove();
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