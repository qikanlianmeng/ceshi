<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<li<?php  if($do == 'backup') { ?> class="active"<?php  } ?>><a href="<?php  echo url('system/database');?>">备份</a></li>
	<li<?php  if($do == 'restore') { ?> class="active"<?php  } ?>><a href="<?php  echo url('system/database/restore');?>">还原</a></li>
	<li<?php  if($do == 'trim') { ?> class="active"<?php  } ?>><a href="<?php  echo url('system/database/trim');?>">数据库结构整理</a></li>
	<li<?php  if($do == 'optimize') { ?> class="active"<?php  } ?>><a href="<?php  echo url('system/database/optimize');?>">优化</a></li>
	<li<?php  if($do == 'run') { ?> class="active"<?php  } ?>><a href="<?php  echo url('system/database/run');?>">运行SQL</a></li>
</ul>
	<?php  if($do == 'backup') { ?>
		<div class="alert we7-page-alert">
				<p><i class="wi wi-info-sign"></i>使用本系统备份的备份数据, 只能使用本系统来进行还原. 如果使用其他工具, 或者自行导入sql, 可能造成数据不完整或不正确.<p>
				<p><strong class="color-dark">请在站点访问量比较低的时间段(如:深夜)操作, 或操作之前关闭站点. 来防止可能出现的意外数据丢失. </strong><p>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-12 col-md-10" style = "margin-top:20px">
				<a  class="btn btn-primary span3" style = "margin-left:220px" href="<?php  echo url('system/database/backup', array('status'=>1,'start'=>2));?>">开始备份</a>
			</div>
		</div>
 	<?php  } ?>
	<?php  if($do == 'restore') { ?>
	<div class="alert we7-page-alert">
		<p><i class="wi wi-info-sign"></i>使用系统系统备份的备份数据, 只能使用系统系统来进行还原. 如果使用其他工具, 或者自行导入sql, 可能造成数据不完整或不正确.</p>
		<p><strong>请在站点访问量比较低的时间段(如:深夜)操作, 或操作之前关闭站点. 来防止可能出现的意外数据丢失. </strong></p>
	</div>
	<form action="" method="post" class="form-horizontal form">


			<table class="table we7-table table-hover site-list">
				<col width="285px"/>
				<col width="160px"/>
				<col width="120px"/>
				<col width="140px"/>
				<tr>
					<th class="text-left">备份名称</th>
					<th class="text-left">备份时间</th>
					<th>分卷数量</th>
					<th class="text-right">操作</th>
				</tr>
				<?php  if(is_array($reduction)) { foreach($reduction as $row) { ?>
				<tr>
					<td class="text-left"><?php  echo $row['bakdir'];?></td>
					<td class="text-left"><?php  echo date('Y-m-d H:i:s', $row['time']);?></td>
					<td><?php  echo $row['volume'];?></td>
					<td>
						<div class="link-group">
							<a href="javascript:;" onclick="confirmNotice('restore', '<?php  echo $row["bakdir"];?>', '<?php  echo date('Y-m-d H:i:s', $row['time']);?>');">还原此备份</a>
							<a href="javascript:;" class="del" onclick="confirmNotice('delete', '<?php  echo $row["bakdir"];?>');">删除</a>
						</div>
					</td>
				</tr>
				<?php  } } ?>
			</table>
			<script>
                function confirmNotice(type, bakdir, storeTime) {
                    if (type == 'restore') {
                        util.confirm(function () {
                            window.location.href = "<?php  echo url('system/database/restore')?>" + 'restore_dirname=' + bakdir;
                        }, function () {
                            return false;
                        }, '确定要将数据库数据还原到<span class="color-red">' + storeTime + '</span> 备份的数据吗?　<p>还原备份数据, 数据库将被覆盖。请谨慎操作！</p>');
					} else {
                        util.confirm(function () {
                            window.location.href = "<?php  echo url('system/database/restore')?>" + 'delete_dirname=' + bakdir;
                        }, function () {
                            return false;
                        }, '确认删除备份记录? ');
					}
                }
			</script>
		<?php  } ?>
	<?php  if($do == 'trim') { ?>
	<div class="alert we7-page-alert table-info" style="display:none;">
		<p><i class="wi wi-info-sign"></i><strong>恭喜,您的数据表中已无冗余信息。</strong></p>
	</div>
	<form action="" method="post" class="form-horizontal form">

		<?php  if(!empty($diff)) { ?>
		<table class="table table-hover  we7-table trim-container">
			<thead>
				<tr>
					<th style="width:400px;">表名称</th>
					<th >字段</th>
					<th >索引</th>
				</tr>
			</thead>
			<tbody>
			<?php  if(is_array($diff)) { foreach($diff as $row) { ?>
			<tr>
				<td class="tablename"><?php  echo $row['name'];?></td>
				<td>
					<?php  if(is_array($row['fields'])) { foreach($row['fields'] as $field) { ?>
						<div style="height:50px;" id="field<?php  echo $field;?>">
							<span><?php  echo $field;?></span>
							<a href="javascript:;" data-type="field" title="删除" class="btn btn-default btn-sm" style="float:right">删除</a>
						</div>
					<?php  } } ?>
				</td>
				<td>
					<?php  if(is_array($row['indexes'])) { foreach($row['indexes'] as $index) { ?>
						<div style="height:50px;float:right" id="index<?php  echo $index;?>">
							<span><?php  echo $index;?></span>
							<a href="javascript:;" data-type="index" title="删除" class="btn btn-danger btn-sm" >删除</a>
						</div>
					<?php  } } ?>
				</td>
			</tr>
			<?php  } } ?>
			</tbody>
		</table>
		<?php  } ?>
		<script type="text/javascript">
				if ($(".tablename").text() == '') {
					$(".table-info").css('display', 'block');
				}
				$(".trim-container a").click(function() {
					if (!confirm('删除后将彻底改变数据库信息!')) {
						return false;
					}
					var type = $(this).attr('data-type');
					var data = $(this).prev().text();
					var table = $(this).parent().parent().parent().children("td.tablename").text();
					$.post('<?php  echo url('system/database/trim')?>', {'type' : type, 'data' : data, 'table' : table}, function(status){
						if (status == 'success') {
							$('#'+type+data).remove();
						}
					});
					var fields = $(this).parent().parent().children("div");
					var indexes = $(this).parent().parent().siblings().children("div");
					if (fields.length <= 1 && indexes.length < 1) {
						$(this).parent().parent().parent().remove();
					}
					if ($(".tablename").text() == '') {
						$(".table-info").css('display', 'block');
					}
				});
		</script>
	<?php  } ?>
	<?php  if($do == 'optimize') { ?>
	<div class="alert we7-page-alert" style="margin-bottom:0">
			<i class="wi wi-info-sign"></i><strong>数据表优化可以去除数据文件中的碎片, 使记录排列紧密, 提高读写速度.</strong>
		</div>
	<form action="" method="post" class="form-horizontal form">
		
		
		<br>
		
		<?php  if(!empty($optimize_table)) { ?>
		<table class="table we7-table table-hover site-list">
			<col width="30px"/>
			<col width="100px"/>
			<col width="50px"/>
			<col width="50px"/>
			<col width="80px"/>
			<col width="80px"/>
			<col width="80px"/>
			<tr>
				<th>操作</th>
				<th>表名</th>
				<th>表类型</th>
				<th>记录数</th>
				<th>数据尺寸</th>
				<th>索引尺寸</th>
				<th>碎片尺寸</th>
			</tr>
			<?php  if(is_array($optimize_table)) { foreach($optimize_table as $row) { ?>
			<tr>
				<td><input type="checkbox" name="select[]" checked="checked" value="<?php  echo $row['title'];?>"></td>
				<td><?php  echo $row['title'];?></td>
				<td><?php  echo $row['type'];?></td>
				<td><?php  echo $row['rows'];?></td>
				<td><?php  echo $row['data'];?></td>
				<td><?php  echo $row['index'];?></td>
				<td><?php  echo $row['free'];?></td>
			</tr>
			<?php  } } ?>
			<tr>
				<td colspan="7" class="text-left">
					<button type="submit" class="btn btn-primary span3" name="submit" value="提交">开始优化</button>
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</td>
			</tr>
		</table>
		<?php  } else { ?>
			<div class="alert alert-success"><strong>没有要优化的数据表</strong></div>

		<?php  } ?>
	</form>
	<?php  } ?>
	<?php  if($do == 'run') { ?>
	<div class="alert we7-page-alert">
		<p><i class="wi wi-info-sign"></i>通过此功能可以直接在数据库中执行特定语句, 用于调试错误. 或者系统管理员特定排错. 注意, 这里运行的语句不会有任何返回结果.</p>
		<p><strong>注意: 此功能可能造成数据破坏, 请谨慎使用. 如果你不清楚他的功能, 请不要使用.</strong></p>
	</div>
	<form action="" method="post" class="we7-form" onsubmit="return confirm('请确保你已经了解这些语句的作用, 并自愿承担风险.');">
		
		<div class="form-group">
			<label class="control-label col-sm-1">SQL</label>
			<div class="form-controls col-sm-8">
				<textarea name="sql" class="form-control" rows="8" style="width:600px;"></textarea>
				<span class="help-block">多条语句请使用 ; 隔开</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label"></label>
			<div class="form-controls">
				<button type="submit" class="btn btn-primary span3" name="submit" value="提交">运行SQL</button>
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
		
	<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>