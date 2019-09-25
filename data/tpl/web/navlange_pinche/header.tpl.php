<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/css/style.css" media="screen" type="text/css" />
<div data-skin="default" class="skin-default <?php  if($_GPC['main-lg']) { ?> main-lg-body <?php  } ?>">
<?php  $frames = buildframes(FRAME);_calc_current_frames($frames);?>
<div class="header">
	<?php  if(!empty($_W['uid'])) { ?>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-suitcase color-gray"></i>业务<span class="caret"></span></a>
					<ul class="dropdown-menu color-gray" role="menu">
						<?php  if(is_array($business_list)) { foreach($business_list as $index => $item) { ?>
						<li style="text-align: left;padding-left:30px">
							<a href="<?php  echo url('site/entry/admin', array('m' => $item['module']))?>"><i class="fa fa-share color-gray"></i> <?php  echo $item['name'];?></a>
						</li>
						<?php  } } ?>
					</ul>
				</li>
				<li><a href="<?php  echo url('site/entry/admin', array('m' => 'navlange_member'));?>">会员管理</a></li>
				<li><a href="<?php  echo url('site/entry/admin', array('m' => 'navlange_pay'));?>">收银</a></li>
				<?php  if(!empty($fx_module)) { ?>
				<li><a href="<?php  echo url('site/entry/admin', array('m' => 'navlange_fx'));?>">分销</a></li>
				<?php  } ?>
			</ul>
			<div class="pull-right related-info module-related-info">
			</div>
			<script>
				$.post('./index.php?c=module&a=display&do=accounts_dropdown_menu', {'module_name': "<?php  echo $_W['current_module']['name']?>", 'version_id': "<?php  echo $_GPC['version_id']?>"}, function(data){
				        $('.module-related-info').html(data);
				 }, 'html');
			</script>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="wi wi-user color-gray"></i><?php  echo $_W['user']['username'];?> <span class="caret"></span></a>
					<ul class="dropdown-menu color-gray" role="menu">
						<li>
							<a href="<?php  echo url('user/profile');?>" target="_blank"><i class="wi wi-account color-gray"></i> 我的账号</a>
						</li>
					<?php  if($_W['isfounder']) { ?>
						<li class="divider"></li>
					<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
						<li><a href="<?php  echo url('cloud/upgrade');?>" target="_blank"><i class="wi wi-update color-gray"></i> 自动更新</a></li>
					<?php  } ?>
						<li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="wi wi-cache color-gray"></i> 更新缓存</a></li>
						<li class="divider"></li>
					<?php  } ?>
						<li>
							<a href="<?php  echo url('user/logout');?>"><i class="fa fa-sign-out color-gray"></i> 退出系统</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	<?php  } else { ?>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown"><a href="<?php  echo url('user/register');?>">注册</a></li>
				<li class="dropdown"><a href="<?php  echo url('user/login');?>">登录</a></li>
			</ul>
		</div>
	<?php  } ?>
</div>
<div class="left-menu">
  	<div class="logo">
  		<?php  if(file_exists(IA_ROOT. "/addons/". $_W['current_module']['name']. "/icon-custom.jpg")) { ?>
		<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon-custom.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
		<?php  } else { ?>
		<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
		<?php  } ?>
		<div><?php  echo $_W['current_module']['title'];?></div>
  	</div>
  	<div class="accordion">
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='pin') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('pin')?>'"><span>出车</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('pin')?>">&#12288;出车</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('pin',array('op'=>'cargo'))?>">&#12288;拼货</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='travel' OR $_GPC['do']=='goods') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('travel')?>'"><span>出行</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('travel')?>">&#12288;出行</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('goods')?>">&#12288;货源</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
	  		<input type="radio" name="accordion-1" id="section-3" value="toggle" <?php  if($_GPC['do']=='line') { ?>checked="checked"<?php  } ?>/>
	  		<label for="section-3" onclick="location.href='<?php  echo $this->createWeburl('line')?>'"><span>线路站点</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('line')?>">&#12288;线路管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('line',array('op'=>'bus'))?>">&#12288;班车专线</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('line',array('op'=>'station'))?>">&#12288;站点管理</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='owner') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('owner')?>'"><span>司机乘客</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('owner')?>">&#12288;司机</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('owner',array('op'=>'client'))?>">&#12288;乘客</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='store') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('store')?>'"><span>商家</span></label>
		</div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='finance') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('finance',array('op'=>'recharge'))?>'"><span>财务管理</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('finance',array('op'=>'recharge'))?>">&#12288;充值管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('finance',array('op'=>'withdraw'))?>">&#12288;提现管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('finance',array('op'=>'award'))?>">&#12288;奖励管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('finance',array('op'=>'award_withdraw'))?>">&#12288;奖励提现</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
	  		<input type="radio" name="accordion-1" id="section-3" value="toggle" <?php  if($_GPC['do']=='platform') { ?>checked="checked"<?php  } ?>/>
	  		<label for="section-3" onclick="location.href='<?php  echo $this->createWeburl('platform')?>'"><span>平台</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform')?>">&#12288;统计</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'comment'))?>">&#12288;评价管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'level'))?>">&#12288;信用等级</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'credit'))?>">&#12288;信用积分体系</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'template'))?>">&#12288;乘客评论模板</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'owner_template'))?>">&#12288;车主评论模板</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'suggestion'))?>">&#12288;意见建议</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'notice'))?>">&#12288;公告</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('platform',array('op'=>'notice_type'))?>">&#12288;公告分类</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
	  		<input type="radio" name="accordion-1" id="section-3" value="toggle" <?php  if($_GPC['do']=='conf') { ?>checked="checked"<?php  } ?>/>
	  		<label for="section-3" onclick="location.href='<?php  echo $this->createWeburl('conf')?>'"><span>设置</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf')?>">&#12288;基础设置</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'mode'))?>">&#12288;模式管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'pin'))?>">&#12288;拼车设置</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'cargo'))?>">&#12288;拼货设置</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'bus'))?>">&#12288;班车专线设置</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'wx_message'))?>">&#12288;模板消息</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'sms'))?>">&#12288;短信设置</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'note'))?>">&#12288;备注模板</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'agreement'))?>">&#12288;协议管理</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'use_notice'))?>">&#12288;使用须知</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('conf',array('op'=>'share'))?>">&#12288;分享设置</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="segmentation"></div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='marketing') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('marketing')?>'"><span>营销</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'first_order'))?>">&#12288;首单优惠</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'coupon'))?>">&#12288;优惠券</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'fx'))?>">&#12288;分销</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'partner'))?>">&#12288;合伙人</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'owner'))?>">&#12288;司机营销</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'integral'))?>">&#12288;积分营销</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'pin_fixed'))?>">&#12288;固定拼车</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('marketing',array('op'=>'pin_stick'))?>">&#12288;置顶拼车</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='page') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('page')?>'"><span>页面设置</span></label>
	  		<div class="content">
				<ul>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'todo_index'))?>">&#12288;首页</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'general_release'))?>">&#12288;发布中心</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'pin_release'))?>">&#12288;拼车发布</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'my_travel'))?>">&#12288;乘客/货源行程</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'person'))?>">&#12288;个人中心</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'cargo'))?>">&#12288;带货</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'store_register'))?>">&#12288;商家入驻</a></span></li>
		  			<!--li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'func_menu'))?>">&#12288;功能菜单</a></span></li-->
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'help'))?>">&#12288;帮助、免责、介绍</a></span></li>
		  			<li><span><a href="<?php  echo $this->createWeburl('page',array('op'=>'menu'))?>">&#12288;底部菜单</a></span></li>
				</ul>
	  		</div>
		</div>
		<div class="section">
		  	<input type="radio" name="accordion-1" id="section-1" <?php  if($_GPC['do']=='city') { ?>checked="checked"<?php  } ?>/>
		  	<label for="section-1" onclick="location.href='<?php  echo $this->createWeburl('city')?>'"><span>城市管理</span></label>
		</div>
  	</div>
</div>
<script>
$(function(){
	var left_menu_height =  window.screen.availHeight-160;
	$(".accordion").css('height',left_menu_height + 'px');
	$(".left-menu").css('min-height',window.screen.availHeight+'px');
})
</script>
<div class="right-content">
<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?>
<div class="system-tips we7-body-alert" id="setmeal-tips">
	<div class="container text-right">
		<div class="alert-info">
			<a href="<?php  if($_W['isfounder']) { ?><?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?><?php  } else { ?>javascript:void(0);<?php  } ?>">
				该公众号管理员服务有效期：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
				<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
				目前已到期，请联系管理员续费
				<?php  } else { ?>
				将在<?php  echo floor(($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400);?>天后到期，请及时付费
				<?php  } ?>
			</a>
			<span class="tips-close" onclick="check_setmeal_hide();"><i class="wi wi-error-sign"></i></span>
		</div>
	</div>
</div>
<script>
	function check_setmeal_hide() {
		util.cookie.set('check_setmeal', 1, 1800);
		$('#setmeal-tips').hide();
		return false;
	}
</script>
<?php  } ?> 
