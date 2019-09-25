<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <li class="active">
        出行管理
    </li>
</ol>
<div class="panel panel-default">
	<div class="panel-heading">
		出行管理
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
			<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
				<tr>
					<th style="text-align: center;width:60px">跨省</th>
					<th style="text-align: center">出发站</th>
					<th style="text-align: center">目的地</th>
					<th style="text-align: center">货物名称</th>
					<th style="text-align: center">重量/体积</th>
					<th style="text-align: center">车型</th>
					<th style="text-align: center">装货时间</th>
					<th style="text-align: center;width:60px">状态</th>
					<th style="text-align: center;width:50px">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($travel)) { foreach($travel as $index => $item) { ?>
					<tr id="travel_1_<?php  echo $item['id'];?>">
						<td colspan="9">
							下单时间：<?php  echo date('Y-m-d H:i:s',$item['release_time'])?>&#12288;乘客：<?php  echo $item['name'];?>&#12288;联系方式：<?php  echo $item['mobile'];?>&#12288;人数：<?php  echo $item['amount'];?>&#12288;来源：<?php  if($item['source'] == '0') { ?>公众号<?php  } else if($item['source'] == '1') { ?>小程序<?php  } ?>
						</td>
					</tr>
					<tr id="travel_2_<?php  echo $item['id'];?>">
						<td style="text-align: center">
							<?php  if($item['is_trans_provincial'] == '0') { ?>
								省内
							<?php  } else if($item['is_trans_provincial'] == '1') { ?>
								跨省
							<?php  } ?>
						</td>
						<td style="text-align: center"><?php  echo $item['departure_station'];?></td>
						<td style="text-align: center"><?php  echo $item['terminal_station'];?></td>
						<td style="text-align: center">
							<?php  echo $item['goods_name'];?>
						</td>
						<td style="text-align: center">
							<?php  echo $item['weight'];?>吨/<?php  echo $item['volume'];?>方
						</td>
						<td style="text-align: center"><?php  echo $this->trans_car_type($item['car_type'])?></td>
						<td style="text-align: center"><?php  echo date('d/m H:i',$item['departure_time'])?></td>
						<td style="text-align: center">
							<?php  if($item['status'] == '0') { ?>
								<span class="label label-info"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '1') { ?>
								<span class="label label-primary"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '2') { ?>
								<span class="label label-danger"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '3') { ?>
								<span class="label label-success"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '4') { ?>
								<span class="label label-warning"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '5') { ?>
								<span class="label label-danger"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '6') { ?>
								<span class="label label-success"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '7') { ?>
								<span class="label label-success"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '9') { ?>
								<span class="label label-default"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } else if($item['status'] == '10') { ?>
								<span class="label label-default"><?php  echo $this->trans_status($item['status'])?></span>
							<?php  } ?>
						</td>
						<td style="text-align: center">
							<a href="javascript:delete_travel(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
function delete_travel(id) {
	var r = confirm("删除货源！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('travel',array('op'=>delete_travel))?>",{
				id:id
			},
			function(resp) {
				resp = $.parseJSON(resp);
				if(resp.message.errno == 0) {
					alert("删除货源成功！");
					$("#travel_1_"+id).remove();
					$("#travel_2_"+id).remove();
				}
			}
		);
	}
}
</script>