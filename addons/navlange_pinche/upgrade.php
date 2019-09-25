<?php
$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_client` (
      `id` bigint(11) NOT NULL AUTO_INCREMENT,
      `uniacid` int(8) NOT NULL,
      `uid` bigint(11) NOT NULL,
      `openid` varchar(30) NOT NULL,
      `register_time` bigint(20) NOT NULL,
      `credit_score` int(8) NOT NULL DEFAULT '100',
      PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_marketing_conf` (
  `uniacid` int(8) NOT NULL,
  `first_order_on` varchar(1) DEFAULT '0',
  `first_order_free` varchar(1) NOT NULL DEFAULT '0',
  `first_order_discount` decimal(11,2) NOT NULL,
  `first_order_discount_min_consumption` decimal(11,2) DEFAULT NULL,
  `fx_on` varchar(1) NOT NULL DEFAULT '0',
  `svc_on` varchar(1) DEFAULT '0',
  PRIMARY KEY (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_integral_record` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `type` varchar(2) DEFAULT '0' COMMENT '0:车主发布拼车;1：车主拼车完成;2:乘客分享',
  `integral` int(8) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  `pin_id` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_banner` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) NOT NULL,
  `img` varchar(128) NOT NULL,
  `url` varchar(256) NOT NULL,
  `page` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_action` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `openid` varchar(30) DEFAULT NULL,
  `date` bigint(20) DEFAULT NULL,
  `total_pin_cancel_times_today` int(8) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_note_template` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) NOT NULL,
  `content` varchar(256) NOT NULL,
  `scene` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_platform` (
  `uniacid` bigint(11) NOT NULL,
  `owner_amount` bigint(11) DEFAULT '0',
  `passenger_amount` bigint(11) DEFAULT '0',
  PRIMARY KEY (`uniacid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_suggestion` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `type` varchar(2) DEFAULT '0' COMMENT '0:商家',
  `store_id` bigint(11) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `openid` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `content` text,
  `release_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_owner_withdraw` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tid` varchar(128) DEFAULT NULL,
  `uniacid` int(8) DEFAULT NULL,
  `uid` bigint(11) NOT NULL,
  `openid` varchar(30) DEFAULT NULL,
  `money` decimal(11,2) DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `generate_time` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_recharge` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `pay_tid` varchar(50) DEFAULT NULL,
  `package_id` bigint(11) DEFAULT NULL,
  `money` decimal(11,2) DEFAULT NULL,
  `gift_money` decimal(11,2) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `time` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_credit3_record` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `mode` varchar(2) DEFAULT NULL,
  `desc` varchar(128) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `pay_tid` varchar(50) DEFAULT NULL,
  `money` decimal(11,2) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `generate_time` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_gallery` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` bigint(11) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `travel_id` bigint(11) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_cargo_accept_order` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` bigint(11) DEFAULT NULL,
  `goods_id` bigint(11) DEFAULT NULL,
  `owner_id` bigint(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `pay_tid` varchar(50) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `generate_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_store` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `sn` varchar(20) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `admin_uid` bigint(11) DEFAULT '0',
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `openid` varchar(30) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `prov` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `district` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `lng` decimal(15,10) DEFAULT NULL,
  `lat` decimal(15,10) DEFAULT NULL,
  `scale` varchar(50) DEFAULT NULL,
  `intro` varchar(1024) DEFAULT NULL,
  `detail` text,
  `register_time` bigint(20) DEFAULT NULL,
  `is_default` varchar(1) DEFAULT '0',
  `license` varchar(128) DEFAULT NULL,
  `customer_slot_on` varchar(1) DEFAULT '0',
  `total_income` decimal(11,2) DEFAULT '0.00',
  `deduct_income` decimal(11,2) DEFAULT '0.00',
  `withdrawed_income` decimal(11,2) DEFAULT '0.00',
  `order_index` bigint(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `qq` varchar(50) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `wx` varchar(128) DEFAULT NULL,
  `wx_qrcode` varchar(128) DEFAULT NULL,
  `wxapp` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_credit4_record` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(8) DEFAULT NULL,
  `mode` varchar(2) DEFAULT NULL,
  `desc` varchar(128) DEFAULT NULL,
  `uid` bigint(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL,
  `pay_tid` varchar(50) DEFAULT NULL,
  `money` decimal(11,2) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `generate_time` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=409 DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_owner_note` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` bigint(11) DEFAULT NULL,
  `owner_id` bigint(11) DEFAULT NULL,
  `owner_uid` bigint(11) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
pdo_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `ims_navlange_pinche_goods_insurance` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `uniacid` bigint(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `money` decimal(11,2) DEFAULT '0.00',
  `order_index` bigint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
pdo_query($sql);
    
    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_hint')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_hint` varchar(255) DEFAULT '欢迎分享给您的朋友！';");
    }
    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_title')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_title` varchar(128) DEFAULT '分享标题';");
    }
    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_desc')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_desc` varchar(255) DEFAULT '分享描述';");
    }
    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_img')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_img` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'other')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `other` varchar(1024) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'car_number_display')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `car_number_display` varchar(1) NOT NULL DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_qrcode_hint')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_qrcode_hint` varchar(255) NOT NULL DEFAULT '此处是二维码提示';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_qrcode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_qrcode` varchar(128) NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_mode_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_mode_name` varchar(20) NOT NULL DEFAULT '拼车';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'fast_mode_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `fast_mode_name` varchar(20) NOT NULL DEFAULT '快车';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'charter_mode_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `charter_mode_name` varchar(20) NOT NULL DEFAULT '包车';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'owner_default_credit_score')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `owner_default_credit_score` int(5) DEFAULT '100';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'client_default_credit_score')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `client_default_credit_score` int(5) DEFAULT '100';");
    }

    if(pdo_fieldexists('navlange_pinche_conf', 'platform_deduct')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." MODIFY COLUMN `platform_deduct` int(5) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_release_need_credit_score')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_release_need_credit_score` int(5) DEFAULT '80';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_release_multi_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_release_multi_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_mode_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_mode_name` varchar(20) NOT NULL DEFAULT '带货';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'bus_mode_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `bus_mode_name` varchar(20) NOT NULL DEFAULT '班车专线';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'info_share_page_title')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `info_share_page_title` varchar(128) DEFAULT '欢迎使用出行系统';");
    }

    if(pdo_fieldexists('navlange_pinche_travel', 'status')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." MODIFY COLUMN `status` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'type')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `type` varchar(2) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_index_line_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_index_line_on` varchar(1) DEFAULT '0';");
    }

    if(pdo_fieldexists('navlange_pinche_conf', 'default_pay_mode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." MODIFY COLUMN `default_pay_mode` varchar(2) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_index_line_amount')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_index_line_amount` int(8) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'owner_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `owner_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'owner_uid')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `owner_uid` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'owner_openid')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `owner_openid` varchar(30) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'uid')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `uid` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'bus_line')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `bus_line` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'bus_travel_release_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `bus_travel_release_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'fix_departure_time')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `fix_departure_time` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_release_pin_integral')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_release_pin_integral` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_release_pin_integral_per_day')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_release_pin_integral_per_day` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_pin_success_integral')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_pin_success_integral` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_pin_success_integral_per_day')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_pin_success_integral_per_day` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'passenger_share_integral')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `passenger_share_integral` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'passenger_share_integral_per_day')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `passenger_share_integral_per_day` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_display_days_before')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_display_days_before` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_menu', 'mode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_menu')." ADD `mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_menu', 'icon_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_menu')." ADD `icon_name` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'pined_amount')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `pined_amount` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'left_amount')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `left_amount` int(8) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_cancel_times_per_day')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_cancel_times_per_day` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_progress_mode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_progress_mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'owner_confirmed')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `owner_confirmed` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'multi_pin_travel_release_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `multi_pin_travel_release_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `note` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'owner_comming_to_departure_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `owner_comming_to_departure_station` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'owner_arrived_departure_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `owner_arrived_departure_station` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_comming_to_departure_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_comming_to_departure_station` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_arrived_departure_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_arrived_departure_station` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'insurance_img')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `insurance_img` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'insurance_expire')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `insurance_expire` bigint(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'use_notice')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `use_notice` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'total_income')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `total_income` decimal(11,2) DEFAULT '0.00';");
    }

    if(pdo_fieldexists('navlange_pinche_owner', 'available_income')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." DROP COLUMN `available_income`;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'withdrawed_income')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `withdrawed_income` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'owner_withdraw_to_mode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `owner_withdraw_to_mode` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'need_travel_before_pin_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `need_travel_before_pin_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'city_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `city_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'cancel_reason')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `cancel_reason` varchar(1024) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'passenger_amount')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `passenger_amount` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'passenger_cancel_pin_credit_score')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `passenger_cancel_pin_credit_score` int(8) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'type')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `type` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'member_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `member_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_comment', 'travel_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment')." ADD `travel_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'terminal_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `terminal_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'terminal_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `terminal_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_comment_template', 'type')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_comment_template')." ADD `type` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_cancel_reason')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_cancel_reason` varchar(1024) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_cancel_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_cancel_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_cancel_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_cancel_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'departure_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `departure_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'terminal_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `terminal_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'departure_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `departure_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'terminal_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `terminal_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_menu', 'wxapp_url')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_menu')." ADD `wxapp_url` varchar(512) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_release_travel_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_release_travel_note` varchar(128) DEFAULT '顺路拼车方便快捷';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'pin_release_pin_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `pin_release_pin_note` varchar(128) DEFAULT '顺路接单省个油钱';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'fast_release_travel_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `fast_release_travel_note` varchar(128) DEFAULT '呼叫快车马上出发';");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'stations')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `stations` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'owner_arrived_departure_station_time')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `owner_arrived_departure_station_time` bigint(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_message', 'pin_order_notice')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_message')." ADD `pin_order_notice` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'working_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `working_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_message', 'pay')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_message')." ADD `pay` varchar(128) NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_message', 'owner_cancel')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_message')." ADD `owner_cancel` varchar(128) NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_message', 'passenger_cancel')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_message')." ADD `passenger_cancel` varchar(128) NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'passenger_mobile_by_force')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `passenger_mobile_by_force` varchar(1) NOT NULL DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'help_content')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `help_content` text NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'disclaimer')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `disclaimer` text NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'about_platform')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `about_platform` text NOT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'owner_info_available_before_pin')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `owner_info_available_before_pin` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'departure_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `departure_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'terminal_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `terminal_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'departure_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `departure_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'terminal_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `terminal_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'person_item_theme')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `person_item_theme` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_station', 'prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_station')." ADD `prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_station', 'city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_station')." ADD `city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_station', 'district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_station')." ADD `district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_station', 'address')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_station')." ADD `address` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_station', 'lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_station')." ADD `lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_station', 'lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_station')." ADD `lat` decimal(15,10) DEFAULT NULL;");
    }

    if(pdo_fieldexists('navlange_pinche_line', 'departure_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." MODIFY COLUMN `departure_station` varchar(50) DEFAULT NULL;");
    }

    if(pdo_fieldexists('navlange_pinche_line', 'terminal_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." MODIFY COLUMN `terminal_station` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_station_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_station_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_address')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_address` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'departure_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `departure_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_station_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_station_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_address')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_address` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'terminal_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `terminal_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'stations_str')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `stations_str` varchar(512) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'index_statistic_display_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `index_statistic_display_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_classify_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_classify_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_classify')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_classify` varchar(512) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_message', 'xcx_travel_been_accept')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_message')." ADD `xcx_travel_been_accept` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'source')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `source` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'use_travel_as_pin_by_default_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `use_travel_as_pin_by_default_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'coupon_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `coupon_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'coupon')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `coupon` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'travel_release_notify_all_owner_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `travel_release_notify_all_owner_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_pin', 'line_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_pin')." ADD `line_id` bigint(11) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_station_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_station_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_address')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_address` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'departure_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `departure_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_station_id')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_station_id` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_address')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_address` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_bus_line', 'terminal_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_bus_line')." ADD `terminal_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'comment_display_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `comment_display_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'register_time')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `register_time` bigint(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_release_travel_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_release_travel_note` varchar(128) DEFAULT '我有货要带';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'goods_type')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `goods_type` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'weight')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `weight` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_release_pin_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_release_pin_note` varchar(128) DEFAULT '发布拼货专线';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_on')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_departure_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_departure_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_departure_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_departure_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_departure_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_departure_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_departure_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_departure_station` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_departure_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_departure_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_departure_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_departure_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_terminal_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_terminal_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_terminal_city')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_terminal_city` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_terminal_district')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_terminal_district` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_terminal_station')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_terminal_station` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_terminal_lng')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_terminal_lng` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_terminal_lat')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_terminal_lat` decimal(15,10) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_stations_str')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_stations_str` varchar(512) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_note` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'terminal_time')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `terminal_time` bigint(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'car_type')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `car_type` varchar(2) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'car_length')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `car_length` decimal(11,2) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'need_cover')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `need_cover` varchar(1) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'goods_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `goods_name` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_goods_line_mode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_goods_line_mode` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'departure_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `departure_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'terminal_prov')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `terminal_prov` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'volume')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `volume` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'goods_length')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `goods_length` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'goods_width')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `goods_width` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'goods_height')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `goods_height` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'delivery_need')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `delivery_need` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'arrival_service')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `arrival_service` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'pay_mode')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `pay_mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_name` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_price_per_f')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_price_per_f` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_price_per_d')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_price_per_d` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_price_include_tax')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_price_include_tax` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_arrival_note')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_arrival_note` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_start_tel')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_start_tel` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_start_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_start_name` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_start_mobile')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_start_mobile` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_arrival_tel')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_arrival_tel` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_arrival_name')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_arrival_name` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'cl_arrival_mobile')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `cl_arrival_mobile` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'image_nav_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `image_nav_mode` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_1_title')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_1_title` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_1_desc')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_1_desc` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_1')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_1` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_1_color')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_1_color` varchar(7) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_1_url')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_1_url` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_2_title')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_2_title` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_2_desc')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_2_desc` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_2')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_2` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_2_color')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_2_color` varchar(7) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_2_url')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_2_url` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_3_title')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_3_title` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_3_desc')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_3_desc` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_3')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_3` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_3_color')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_3_color` varchar(7) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_3_url')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_3_url` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_4_title')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_4_title` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_4_desc')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_4_desc` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_4')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_4` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_4_color')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_4_color` varchar(7) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_4_url')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_4_url` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_5_title')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_5_title` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_5_desc')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_5_desc` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_5')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_5` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_5_color')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_5_color` varchar(7) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'nav_img_5_url')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `nav_img_5_url` varchar(255) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'core_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `core_mode` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_accept_price')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_accept_price` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_goods_type_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_goods_type_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_delivery_need_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_delivery_need_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_arrival_service_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_arrival_service_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_price_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_price_mode` varchar(1) DEFAULT '0';");
    }

    if(pdo_fieldexists('navlange_pinche_note_template', 'scene')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_note_template')." MODIFY COLUMN `scene` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_note_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_note_mode` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_goods_size_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_goods_size_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'is_trans_provincial')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `is_trans_provincial` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'share_income')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `share_income` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'accept_invoice')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `accept_invoice` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'start_time')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `start_time` bigint(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'end_time')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `end_time` bigint(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'goods_list_banner_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `goods_list_banner_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_award_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_award_mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_fixed_award_money')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_fixed_award_money` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'owner_award_ratio')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `owner_award_ratio` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'invite_code')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `invite_code` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'inviter_code')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `inviter_code` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'inviter_uid')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `inviter_uid` bigint(11) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'invite_award_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `invite_award_mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'inviter_award_ratio_from_order')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `inviter_award_ratio_from_order` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'zhuangxie_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `zhuangxie_mode` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'general_release_cargo_name')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `general_release_cargo_name` varchar(25) DEFAULT '发货';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'index_toast_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `index_toast_on` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'index_toast_content')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `index_toast_content` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'partner_award_money')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `partner_award_money` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'store_register_head_img')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `store_register_head_img` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'store_register_agreement')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `store_register_agreement` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'partner_award_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `partner_award_mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_marketing_conf', 'partner_award_ratio')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_marketing_conf')." ADD `partner_award_ratio` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_credit4_record', 'tid')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_credit4_record')." ADD `tid` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'uid')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `uid` bigint(11) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'store_id')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `store_id` bigint(11) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'type')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `type` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'note')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `note` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'price_per_f')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `price_per_f` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'price_per_d')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `price_per_d` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'price_include_tax')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `price_include_tax` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'start_note')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `start_note` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'arrival_note')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `arrival_note` text;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'start_tel')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `start_tel` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'start_name')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `start_name` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'start_mobile')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `start_mobile` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'arrival_tel')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `arrival_tel` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'arrival_name')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `arrival_name` varchar(50) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_line', 'arrival_mobile')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_line')." ADD `arrival_mobile` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_member', 'store_id')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_member')." ADD `store_id` bigint(11) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_deposit_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_deposit_mode` varchar(1) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'cargo_line_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `cargo_line_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_message', 'owner_register')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_message')." ADD `owner_register` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'index_discovery_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `index_discovery_on` varchar(1) DEFAULT '1';");
    }
    
    if(pdo_fieldexists('navlange_pinche_travel', 'car_type')) {
        pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." MODIFY COLUMN `car_type` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'index_title')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `index_title` varchar(128) DEFAULT '便民出行';");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'ID_img')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `ID_img` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_owner', 'ID_img_bk')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_owner')." ADD `ID_img_bk` varchar(128) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'goods_time_mode')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `goods_time_mode` varchar(2) DEFAULT '0';");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'start_slot')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `start_slot` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'end_slot')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `end_slot` varchar(20) DEFAULT NULL;");
    }

    if(!pdo_fieldexists('navlange_pinche_travel', 'insure_price')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_travel')." ADD `insure_price` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'withdraw_min')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `withdraw_min` decimal(11,2) DEFAULT '0.00';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'goods_pay_mode_1_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `goods_pay_mode_1_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'goods_pay_mode_2_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `goods_pay_mode_2_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'goods_pay_mode_3_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `goods_pay_mode_3_on` varchar(1) DEFAULT '1';");
    }

    if(!pdo_fieldexists('navlange_pinche_conf', 'my_travel_canceled_display_on')) {
      pdo_query("ALTER TABLE " . tablename('navlange_pinche_conf')." ADD `my_travel_canceled_display_on` varchar(1) DEFAULT '1';");
    }