<?php defined('IN_IA') or exit('Access Denied');?><?php  if(!defined('SYSTEM_WELCOME_MODULE')) { ?>
<div class="account-info-name">
	<a href="<?php  echo url('account/display/platform')?>"><i class="wi wi-back-circle"></i></a>
	<span class="account-name"><a href="<?php  echo url('account/display/platform')?>"><?php  echo $_W['account']['name'];?></a></span>
</div>
<?php  } ?>
<div class="module-info-name">
	<?php  if(file_exists(IA_ROOT. "/addons/". $_W['current_module']['name']. "/icon-custom.jpg")) { ?>
		<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon-custom.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
	<?php  } else { ?>
		<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
	<?php  } ?>
	<span class="name"><?php  echo $_W['current_module']['title'];?></span>
</div>

<!-- 兼容历史性问题：模块内获取不到模块信息$module的问题-start -->
<?php  if(defined('CRUMBS_NAV') && CRUMBS_NAV == 1) { ?>
<?php  global $module;?>
<?php  } ?>
<!-- end -->