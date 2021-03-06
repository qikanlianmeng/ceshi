<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('profile/common', TEMPLATE_INCLUDEPATH)) : (include template('profile/common', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'uc_setting') { ?>
<div class="js-profile-uc" ng-controller="ucCtrl" ng-cloak>
	<div class="alert we7-page-alert ">
		<p>
			使用UC能够整合其他系统的会员信息. 如果你不清楚此功能的作用, 请咨询您的技术人员. <br />
			1. 在UC系统中增加新的应用, 并填写[应用接口文件名称]为: uc.php?uniacid=<?php  echo $_W['uniacid'];?> <br />
			2. 在下方启用UC, 并按照UC系统中新增的应用参数填写
		</p>
	</div>
	<div class="form-files-box">
		<div class="form-file header">设置UC参数</div>
		<div class="form-file">
			<div class="form-label">启用UC</div>
			<div class="form-value" >使用UC能够整合其他系统的会员信息. 如果你不清楚此功能的作用, 请咨询您的技术人员.</div>
			<div class="form-edit">
				<div ng-if="uc.status == 1" ng-click="saveSetting(0, 'status')" class="switch switchOn"></div>
				<div ng-if="!uc.status" ng-click="saveSetting(1, 'status')" class="switch"></div>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">快速录入</div>
			<div class="form-value">你可以直接复制UC中的[应用的 UCenter 配置信息]来快速搞定配置参数.</div>
			<div class="form-edit">
				<we7-modal-form type="'textarea'" label="'快速录入'" value="" on-confirm="saveSetting(formValue, 'fastinput')"></we7-modal-form>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">通行证名称</div>
			<div class="form-value" ng-if="uc.title" ng-bind="uc.title"></div>
			<div class="form-value" ng-if="!uc.title">请输入你的通行证名称, 方便与UC系统联系.比如: 你的论坛名字</div>
			<div class="form-edit">
				<we7-modal-form type="'text'" label="'通行证名称'" value="uc.title" on-confirm="saveSetting(formValue, 'title')"></we7-modal-form>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">应用ID</div>
			<div class="form-value" ng-bind="uc.appid"></div>
			<div class="form-edit">
				<we7-modal-form type="'text'" label="'应用ID'" value="uc.appid" on-confirm="saveSetting(formValue, 'appid')"></we7-modal-form>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">通信密钥</div>
			<div class="form-value" ng-bind="uc.key"></div>
			<div class="form-edit">
				<we7-modal-form type="'text'" label="'通信密钥'" value="uc.key" on-confirm="saveSetting(formValue, 'key')"></we7-modal-form>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">UCenter字符集</div>
			<div class="form-value" ng-bind="uc.charset"></div>
			<div class="form-edit">
				<we7-modal-form type="'text'" label="'UCenter字符集'" value="uc.charset" on-confirm="saveSetting(formValue, 'charset')"></we7-modal-form>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">MySQL通行方式</div>
			<div class="form-value" ng-show="uc.connect == 'mysql'">已选择</div>
			<div class="form-value" ng-show="uc.connect != 'mysql'">未选择</div>
			<div class="form-edit">
				<a class="javascript:;" ng-click="changeConnect('mysql')">设置</a>
			</div>
		</div>
		<div class="form-file">
			<div class="form-label">远程方式HTTP</div>
			<div class="form-value" ng-show="uc.connect == 'http'">已选择</div>
			<div class="form-value" ng-show="uc.connect != 'http'">未选择</div>
			<div class="form-edit">
				<a class="javascript:;" ng-click="changeConnect('http')">设置</a>
			</div>
		</div>
	</div>

	<div class="modal fade" id="mysqlconnect" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">MySQL通行方式</div>
				</div>
				<div class="modal-body">
					<div class="form we7-form">
						<div class="form-group">
							<label class="control-label col-sm-2">是否选择</label>
							<div class="form-controls col-sm-10">
								<input id='status1' type="radio" name="mysql_status" value="1" ng-model="mysql_status" ng-checked="uc.connect == 'mysql'"/>
								<label for="status1">是</label>
								<input id='status2' type="radio" name="mysql_status" value="0" ng-model="mysql_status" ng-checked="uc.connect != 'mysql'"/>
								<label for="status2">否</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">数据库主机</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="dbhost" class="form-control" value="{{uc.dbhost}}" ng-model="uc.dbhost">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">数据库用户名</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="dbuser" class="form-control" value="{{uc.dbuser}}" ng-model="uc.dbuser"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">数据库密码</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="dbpw" class="form-control" value="{{uc.dbpw}}" ng-model="uc.dbpw"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">数据库名称</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="dbname" class="form-control" value="{{uc.dbname}}" ng-model="uc.dbname"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">数据库字符集</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="dbcharset" class="form-control" value="{{uc.dbcharset}}" ng-model="uc.dbcharset"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">表前缀</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="dbtablepre" class="form-control" value="{{uc.dbtablepre}}" ng-model="uc.dbtablepre"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否持久连接</label>
							<div class="col-sm-8 col-xs-12">
								<input type="radio" id="dbconnect1" name="dbconnect" value="1" ng-model="uc.dbconnect"/>
								<label class="radio-inline" for="dbconnect1">是</label>
								<input type="radio" id="dbconnect2" name="dbconnect" value="0" ng-model="uc.dbconnect"/>
								<label class="radio-inline" for="dbconnect2">否</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveConnect('mysql')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="httpconnect" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">远程方式HTTP</div>
				</div>
				<div class="modal-body">
					<div class="form we7-form">
						<div class="form-group">
							<label class="control-label col-sm-2">是否选择</label>
							<div class="form-controls col-sm-10">
								<input id='status-1' type="radio" name="http_status" value="1"  ng-model="http_status"ng-checked="uc.connect == 'http'"/>
								<label for="status-1">是</label>
								<input id='status-2' type="radio" name="http_status" value="0"  ng-model="http_status"ng-checked="uc.connect != 'http'"/>
								<label for="status-2">否</label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">服务端URL地址</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="api" class="form-control" value="{{uc.api}}" ng-model="uc.api"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">服务端IP</label>
							<div class="col-sm-8 col-xs-12">
								<input type="text" name="ip" class="form-control" value="{{uc.ip}}" ng-model="uc.ip"/>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="saveConnect('http')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	angular.module('profileApp').value('config', {
		'uc' : <?php  echo json_encode($uc)?>,
		'setting_url' : "<?php  echo url('profile/common/uc_setting')?>",
		'token' : "<?php  echo $_W['token'];?>"
	});
	angular.bootstrap($('.js-profile-uc'), ['profileApp']);
	//处理快速录入
</script>
<?php  } else if($do == 'upload_file') { ?>
<div class="main">
	<form id="form21" action="<?php  echo url('profile/common/upload_file')?>" method="post" class="we7-form form" enctype="multipart/form-data">
		<div class="alert we7-page-alert">
				设置JS接口安全域名，需要上传的文件。 
		</div>
		<table class="we7-table table-hover table-form">
			<col width="150px"/>
			<col />
			<col width="150px"/>
			<tr>
				<th>上传js接口文件</th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td>上传文件</td>
				<td class="color-gray"></td>
				<td class="text-right">
					<div class="link-group">
						<a href="javascript:;"  data-toggle="modal" data-target="#jsauth_acid">修改</a>
					</div>
				</td>
			</tr>
		</table>
		<div class="modal fade" id="jsauth_acid" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="we7-modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">选择公众号</div>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">上传文件</label>
								<div class="col-sm-8">
									<input type="file" name="file" value="">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
							<input type="submit" class="btn btn-primary" name="submit" value="上传" />
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

