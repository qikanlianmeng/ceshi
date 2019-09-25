<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab"></ul>
<div class="form-group we7-form" id="js-system-updatecache" ng-controller="UpdateCacheCtrl" ng-cloak>
	<div class="col-sm-2 control-label">缓存类型</div>
	<div class="col-sm-10 form-controls">
		<input type="checkbox" name="type[]" value="data" id="type_data" checked="checked" />
		<label for="type_data" class="checkbox-inline">
			 数据缓存
		</label>
		<input type="checkbox" name="type[]" value="template" id="type_template" checked="checked" />
		<label for="type_template" class="checkbox-inline">
			 模板缓存
		</label>
	</div>
	<div class="col-sm-offset-2">
		<span class="btn btn-primary we7-padding-horizontal we7-margin-top" ng-click="updateCache()">提交</span>
	</div>
</div>
<script>
	angular.bootstrap($("#js-system-updatecache"), ['systemApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>