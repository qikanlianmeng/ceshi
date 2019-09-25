<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<li class="active"><a href="<?php  echo url('statistics/account');?>">所有平台账号流量统计</a></li>
	<li><a href="<?php  echo url('statistics/account/app_display');?>">所有平台账号app端访问统计</a></li>
</ul>
<div class="api">
	<div class="panel we7-panel api-target">
		<div class="panel-heading">今日/昨日关键指标</div>
		<div class="panel-body we7-padding-vertical">
			<div class="col-sm-4 text-center">
				<div class="title">整站流量总访问值</div>
				<div>
					<span class="today"><?php  echo $today;?></span>
					<span class="yesterday">/ <?php  echo $yesterday;?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="panel we7-panel" id="js-system-account-analysis" ng-controller="systemAccountAnalysisCtrl" ng-cloak>
		<div class="panel-heading tab">
			<span class="we7-margin">关键指标详解</span>
			<a href="javascript:;" class="active">所有平台账号流量访问值</a>
		</div>
		<div class="panel-body Date-view">
			<div class="tab-bar-time clearfrix">
				<span class="we7-margin-right">时间</span>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" ng-class="{'active': timeType == 'week'}" ng-click="getAccountApi('week')">周统计</button>
					<button type="button" class="btn btn-default" ng-class="{'active': timeType == 'month'}" ng-click="getAccountApi('month')">月统计</button>
					<div class="btn-group" role="group" ng-class="{'active': timeType == 'daterange'}">
						<button class="btn btn-default daterange daterange-date" we7-date-range-picker ng-model="dateRange"><span>{{dateRange.startDate}} </span>至<span> {{dateRange.endDate}}</span> <i class="fa fa-calendar"></i></button>
					</div>
				</div>
			</div>
			<div class="col-sm-12" id="chart-line" style="height:500px"></div>
		</div>
	</div>
	<div class="we7-margin-vertical color-dark font-lg">站内各平台账号访问量统计</div>
	<div class="panel we7-panel" id="js-system-account-visit" ng-controller="systemAccountVisit" ng-cloak>
		<div class="panel-heading tab">
			<a href="javascript:;">关键指标详解</a>
		</div>
		<div class="panel-body Date-view">
			<div class="tab-bar-time clearfrix">
				<span class="we7-margin-right">时间</span>
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" ng-class="{'active': visitTimeType == 'today'}" ng-click="getAccountVisit('today')">今日统计</button>
					<button type="button" class="btn btn-default" ng-class="{'active': visitTimeType == 'week'}" ng-click="getAccountVisit('week')">周统计</button>
					<button type="button" class="btn btn-default" ng-class="{'active': visitTimeType == 'month'}" ng-click="getAccountVisit('month')">月统计</button>
					<div class="btn-group" role="group">
						<button class="btn btn-default daterange daterange-date" we7-date-range-picker ng-model="visitDateRange"><span ng-bind="visitDate.startDate"></span>至<span ng-bind="visitDate.endDate"> </span> <i class="fa fa-calendar"></i></button>
					</div>
				</div>
			</div>
			<div class="api-percent-box">
				<table class="table we7-table">
					<col width="400px">
					<col width="200px">
					<col>
					<tr>
						<th>平台账号</th>
						<th>访问量</th>
						<th>占比</th>
					</tr>
					<tr ng-repeat="item in visitList">
						<td ng-bind="item.name"></td>
						<td ng-bind="item.total"></th>
						<td>
							<div class="percent-item" ng-style="{width: + (visitTotal > 0 ? item.total / visitTotal * 100 : 0) + '%'}"></div>
						</td>
					</tr>
				</table>
			</div>
			<div class="text-right">
				<div>
					<ul class="pagination pagination-centered">
						<li><a href="javascript:;" class="pager-nav" ng-click="changePage(1)">首页</a></li>
						<li><a href="javascript:;" class="pager-nav" ng-click="changePage(page - 1)" ng-show="page > 1">«上一页</a></li>
						<li ng-class="{active: item == page}"  ng-repeat="item in pageArray"><a href="javascript:;" ng-bind="item" ng-click="changePage(item)"></a></li>
						<li><a href="javascript:;" class="pager-nav" ng-click="changePage(page + 1)">下一页»</a></li>
						<li><a href="javascript:;" class="pager-nav" ng-click="changePage(visitTotalPage)">尾页</a></li>
					</ul>
				</div>		
			</div>
		</div>
	</div>
</div>
<script>
require(['daterangepicker'], function() {
	angular.module('statisticsApp').value('config', {
		'links': {
			'accountApi': "<?php  echo url('statistics/account/get_account_api')?>",
			'accountVisit': "<?php  echo url('statistics/account/get_account_visit')?>"
		},
	});
	angular.bootstrap($('#js-system-account-visit'), ['statisticsApp']);
	angular.bootstrap($('#js-system-account-analysis'), ['statisticsApp']);
})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>