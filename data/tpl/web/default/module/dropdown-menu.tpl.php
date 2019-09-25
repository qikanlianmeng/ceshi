<?php defined('IN_IA') or exit('Access Denied');?><span class="top-view">
	<a href="<?php  if($_W['role'] == ACCOUNT_MANAGE_NAME_CLERK) { ?>javascript:;<?php  } else { ?><?php  echo url('account/display/switch', array('uniacid' => $_W['uniacid'], 'type' => $_W['account']['type']))?><?php  } ?>" title="<?php  echo $_W['account']['name']?>" target="_blank">
		<i class="wi wi-<?php  echo $_W['account']->typeSign?>"></i>
		<?php  echo $_W['account']['name'];?>
	</a>
</span>
<span class="dropdown">
	<a href="javascript:;" class="dropdown-icon" data-toggle="dropdown" aria-expanded="false"><i class="wi wi-angle-down"></i></a>
	<ul class="dropdown-menu dropdown-menu-right" role="menu">
		<?php  if(is_array($accounts_list)) { foreach($accounts_list as $account) { ?>
		<li>
			<a href="<?php  echo $account['url']?>">
				<span>
					<i class="wi wi-<?php  echo $account['type_name']?>"></i>
					<?php  echo $account['account_name'];?>
				</span>
			</a>
		</li>
		<?php  } } ?>
	</ul>
</span>