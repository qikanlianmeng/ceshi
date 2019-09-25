<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'edit_func_menu') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('page',array('op'=>'func_menu'))?>">功能菜单</a>
    </li>
    <?php  } ?>
    <?php  if($op == 'edit_menu') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('page',array('op'=>'menu'))?>">菜单</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'todo_index') { ?>
            首页
        <?php  } else if($op == 'general_release') { ?>
            发布中心
        <?php  } else if($op == 'pin_release') { ?>
            拼车发布
        <?php  } else if($op == 'my_travel') { ?>
            乘客/货源行程
        <?php  } else if($op == 'person') { ?>
            个人中心
        <?php  } else if($op == 'fast') { ?>
            快车
        <?php  } else if($op == 'charter') { ?>
            包车
        <?php  } else if($op == 'cargo') { ?>
            带货
        <?php  } else if($op == 'bus') { ?>
            班车专线
        <?php  } else if($op == 'store_register') { ?>
            商家入驻
        <?php  } else if($op == 'help') { ?>
            帮助中心
        <?php  } else if($op == 'disclaimer') { ?>
            免责声明
        <?php  } else if($op == 'about_platform') { ?>
            关于平台
        <?php  } else if($op == 'func_menu') { ?>
            功能菜单
        <?php  } else if($op == 'edit_func_menu') { ?>
            编辑功能菜单
        <?php  } else if($op == 'menu') { ?>
            菜单
        <?php  } else if($op == 'edit_menu') { ?>
            编辑菜单
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'todo_index') { ?>
<div class="panel panel-info">
    <div class="panel-heading">
        显示设置
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">首页标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="index_title" value="<?php  echo $conf['index_title'];?>" />
                </div>
            </div>     
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">显示平台统计数据</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="index_statistic_display_on" value="1" <?php  if(intval($conf['index_statistic_display_on'])=='1') { ?> checked="checked" <?php  } ?> />
                </div>
            </div>     
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">弹窗公告</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="index_toast_on" value="1" <?php  if(intval($conf['index_toast_on'])=='1') { ?> checked="checked" <?php  } ?> />
                </div>
            </div>     
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">显示发现</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="index_discovery_on" value="1" <?php  if(intval($conf['index_discovery_on'])=='1') { ?> checked="checked" <?php  } ?> />
                </div>
            </div> 
            <div class="form-group">
                <label class="col-sm-2 control-label">弹窗内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('index_toast_content', $conf['index_toast_content']);?>
                </div>
            </div>   
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='index_statistic_display_on']").bootstrapSwitch();
        $(":checkbox[name='index_toast_on']").bootstrapSwitch();
        $(":checkbox[name='index_discovery_on']").bootstrapSwitch();
    })
})
</script>
<div class="panel panel-default">
    <div class="panel-heading">
        轮播图
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center;width:120px">图片</th>
                    <th>跳转链接</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($banner_list)) { foreach($banner_list as $index => $item) { ?>
                    <tr id="<?php  echo $item['id'];?>">
                        <td style="text-align: center">
                            <img src="<?php  echo tomedia($item['img'])?>" height="auto" width="100px" />
                        </td>
                        <td>
                            <?php  echo $item['url'];?>
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:delete_banner(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-minus-square"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <div style="height:40px"></div>
        <div class="panel panel-info">
            <div class="panel-heading">
                添加轮播图
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">图片</label>
                        <div class="col-sm-10">
                            <?php  echo tpl_form_field_image('img');?>
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">跳转链接</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="url" placeholder="&#x963F;.&#x83AB;.&#x4E4B;.&#x5BB6;.&#x63D0;.&#x793A;:&#x8BF7;&#x8F93;&#x5165;&#x8DF3;&#x8F6C;&#x94FE;&#x63A5;" />
                        </div>
                    </div>          
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" name="add_banner" value="添加">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function delete_banner(id) {
    var r = confirm("删除轮播图！");
    if(r) {
        $.post("<?php  echo $this->createWeburl('page',array('op'=>'delete_all_index_banner'))?>",{
                id:id
            },
            function(resp) {
                console.log(resp);
                resp = $.parseJSON(resp);
                var res = resp.message;
                if(res.errno == '0') {
                    alert("删除成功！");
                    $("#"+id).remove();
                } else {
                    alert("删除失败！");
                }
            }
        );
    }
}
</script>
<div class="panel panel-default">
    <div class="panel-heading">
        宫格导航
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">宫格导航模式</label>
                <div class="col-sm-10">
                    <select class="form-control" name="image_nav_mode">
                        <option value="0" <?php  if($conf['image_nav_mode']=='0') { ?>selected<?php  } ?>>关闭</option>
                        <option value="1" <?php  if($conf['image_nav_mode']=='1') { ?>selected<?php  } ?>>2宫格</option>
                        <option value="2" <?php  if($conf['image_nav_mode']=='2') { ?>selected<?php  } ?>>3宫格</option>
                        <option value="3" <?php  if($conf['image_nav_mode']=='3') { ?>selected<?php  } ?>>4宫格</option>
                        <option value="4" <?php  if($conf['image_nav_mode']=='4') { ?>selected<?php  } ?>>5宫格</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">宫格一</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_1_title" value="<?php  echo $conf['nav_img_1_title'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_1_desc" value="<?php  echo $conf['nav_img_1_desc'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">跳转链接</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_1_url" value="<?php  echo $conf['nav_img_1_url'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">颜色</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_color('nav_img_1_color',$conf['nav_img_1_color']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_image('nav_img_1',$conf['nav_img_1']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">宫格二</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_2_title" value="<?php  echo $conf['nav_img_2_title'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_2_desc" value="<?php  echo $conf['nav_img_2_desc'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">跳转链接</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_2_url" value="<?php  echo $conf['nav_img_2_url'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">颜色</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_color('nav_img_2_color',$conf['nav_img_2_color']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_image('nav_img_2',$conf['nav_img_2']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">宫格三</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_3_title" value="<?php  echo $conf['nav_img_3_title'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_3_desc" value="<?php  echo $conf['nav_img_3_desc'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">跳转链接</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_3_url" value="<?php  echo $conf['nav_img_3_url'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">颜色</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_color('nav_img_3_color',$conf['nav_img_3_color']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_image('nav_img_3',$conf['nav_img_3']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">宫格四</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_4_title" value="<?php  echo $conf['nav_img_4_title'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_4_desc" value="<?php  echo $conf['nav_img_4_desc'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">跳转链接</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_4_url" value="<?php  echo $conf['nav_img_4_url'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">颜色</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_color('nav_img_4_color',$conf['nav_img_4_color']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_image('nav_img_4',$conf['nav_img_4']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">宫格五</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">标题</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_5_title" value="<?php  echo $conf['nav_img_5_title'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_5_desc" value="<?php  echo $conf['nav_img_5_desc'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">跳转链接</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nav_img_5_url" value="<?php  echo $conf['nav_img_5_url'];?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">颜色</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_color('nav_img_5_color',$conf['nav_img_5_color']);?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-6">
                                    <?php  echo tpl_form_field_image('nav_img_5',$conf['nav_img_5']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="image_nav_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'general_release') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        发布中心
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">[拼车]发布人找车说明</label>
                <div class="col-sm-10">
                    <input class="form-control" name="pin_release_travel_note" value="<?php  echo $conf['pin_release_travel_note'];?>" placeholder="请输入拼车发布人找车说明" />
                </div>
            </div>    
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">[拼车]发布车找人说明</label>
                <div class="col-sm-10">
                    <input class="form-control" name="pin_release_pin_note" value="<?php  echo $conf['pin_release_pin_note'];?>" placeholder="请输入拼车发布车找人说明" />
                </div>
            </div>    
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">[快车]发布人找车说明</label>
                <div class="col-sm-10">
                    <input class="form-control" name="fast_release_travel_note" value="<?php  echo $conf['fast_release_travel_note'];?>" placeholder="请输入快车发布人找车说明" />
                </div>
            </div>        
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">[带货]货找车名称</label>
                <div class="col-sm-10">
                    <input class="form-control" name="general_release_cargo_name" value="<?php  echo $conf['general_release_cargo_name'];?>" placeholder="请输入货找车显示名称" />
                </div>
            </div>  
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">[带货]货找车说明</label>
                <div class="col-sm-10">
                    <input class="form-control" name="cargo_release_travel_note" value="<?php  echo $conf['cargo_release_travel_note'];?>" placeholder="请输入带货发布货找车说明" />
                </div>
            </div>     
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">[带货]车找货说明</label>
                <div class="col-sm-10">
                    <input class="form-control" name="cargo_release_pin_note" value="<?php  echo $conf['cargo_release_pin_note'];?>" placeholder="请输入带货发布车找货说明" />
                </div>
            </div>    
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'pin_release') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">乘客发布</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">强制收录手机号</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="passenger_mobile_by_force">
                            <option value="1" <?php  if($conf['passenger_mobile_by_force']=='1') { ?>selected<?php  } ?>>是</option>
                            <option value="0" <?php  if($conf['passenger_mobile_by_force']=='0') { ?>selected<?php  } ?>>否</option>
                        </select>
                    </div>
                </div>              
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="passenger_submit" value="设置">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php  } else if($op == 'my_travel') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">乘客/货源行程</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">    
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">显示已取消行程</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="my_travel_canceled_display_on" value="1" <?php  if(intval($conf['my_travel_canceled_display_on'])=='1') { ?> checked="checked" <?php  } ?> />
                    </div>
                </div>              
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="person_submit" value="设置">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='my_travel_canceled_display_on']").bootstrapSwitch();
    })
})
</script>
<?php  } else if($op == 'person') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">个人中心</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">项目显示样式</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="person_item_theme">
                            <option value="0" <?php  if($conf['person_item_theme']=='0') { ?>selected<?php  } ?>>宫格</option>
                            <option value="1" <?php  if($conf['person_item_theme']=='1') { ?>selected<?php  } ?>>列表</option>
                        </select>
                    </div>
                </div>              
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-default" name="person_submit" value="设置">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php  } else if($op == 'charter') { ?>

<?php  } else if($op == 'cargo') { ?>
<div class="panel panel-info">
    <div class="panel-heading">
        拼货页面设置
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">货源列表页面轮播图</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="goods_list_banner_on" value="1" <?php  if(intval($conf['goods_list_banner_on'])=='1') { ?> checked="checked" <?php  } ?> />
                </div>
            </div>     
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
    require(['bootstrap.switch'], function() {
        $(":checkbox[name='goods_list_banner_on']").bootstrapSwitch();
    })
})
</script>
<?php  } else if($op == 'fast') { ?>

<?php  } else if($op == 'bus') { ?>

<?php  } else if($op == 'store_register') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        商家入驻设置
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">顶部图片</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('store_register_head_img',$conf['store_register_head_img']);?>
                </div>
            </div>    
            <div class="form-group">
                <label class="col-sm-2 control-label">入驻协议</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('store_register_agreement', $conf['store_register_agreement']);?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'help') { ?>
<div class="panel panel-default">
    <div class="panel-heading">
        帮助中心
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">帮助中心内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('help_content', $conf['help_content']);?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="help_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        免责声明
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">免责声明内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('disclaimer', $conf['disclaimer']);?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="disclaimer_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        平台介绍
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">平台介绍内容</label>
                <div class="col-sm-10">
                    <?php  echo tpl_ueditor('about_platform', $conf['about_platform']);?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="about_platform_submit" value="设置">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'func_menu') { ?>
<div class="panel panel-default">
    <div class="panel-heading">导航项设置</div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">菜单名称</th>
                    <th style="text-align: center">菜单类型</th>
                    <th style="text-align: center">显示名称</th>
                    <th style="text-align: center">排序</th>
                    <th style="text-align: center;width:80px">显示/隐藏</th>
                    <th style="text-align: center;width:80px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($func_menu_list)) { foreach($func_menu_list as $index => $item) { ?>
                    <tr id="func_menu_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['name'];?></td>
                        <td style="text-align: center">
                            <?php  if($item['type'] == '0') { ?>
                                <span class="label label-danger">系统</span>
                            <?php  } else { ?>
                                <span class="label label-primary">自定义</span>
                            <?php  } ?>
                        </td>
                        <td style="text-align: center"><?php  echo $item['customer_name'];?></td>
                        <td style="text-align: center">
                            <div class="input-group">
                               <input id="order_index_<?php  echo $item['id'];?>" type="number" class="form-control" value="<?php  echo $item['order_index'];?>" />
                               <span class="input-group-addon" onclick="set_order_index(<?php  echo $item['id'];?>)" style="cursor: pointer">设置</span>
                           </div>
                        </td>
                        <td style="text-align: center;margin-top:15px">
                            <input id="display_<?php  echo $item['id'];?>" type="checkbox" <?php  if($item['display'] == '1') echo 'checked'; ?> />
                        </td>
                        <td style="text-align: center">
                            <a href="<?php  echo $this->createWeburl('page',array('op'=>'edit_func_menu','id'=>$item['id']))?>"><i class="fa fa-edit"></i></a>
                            <?php  if($item['type'] == '1') { ?>
                                <a href="javascript:delete_func_menu(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                            <?php  } ?>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function delete_func_menu(id) {
    $.post("<?php  echo $this->createWeburl('page',array('op'=>'delete_func_menu'))?>",{
            id:id
        },function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(300,'删除成功！');
                $("#func_menu_"+id).remove();
            }
        }
    );
}
function set_order_index(id) {
    $.post("<?php  echo $this->createWeburl('page', array('op' => 'set_func_menu_order_index'));?>",{
            id:id,
            order_index:$("#order_index_"+id).val()
        },
        function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno != 0) {
                util.message('操作失败, 请稍后重试.')
            } else {
                util.message('操作成功', location.href, 'success');
            }
        }
    );
}
$("input[id^='display_']").change(function(){
        var id = $(this).attr('id');
        var id_arr = id.split('_');
        $.post("<?php  echo $this->createWeburl('page',array('op'=>'set_func_menu_display'))?>",{
                id:id_arr[1],
                display:$("input[id='"+id+"']:checked").val() == 'on' ? '1' : '0'
            },
            function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    tankuang(300,'设置成功');
                }
            }
        );
    })
</script>
<div class="panel panel-default">
    <div class="panel-heading">添加菜单</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="请输入菜单名称" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单图标</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('icon');?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单激活图标</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('icon_active');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单显示名称</label>
                <div class="col-sm-10">
                    <input name="customer_name" type="text" class="form-control" placeholder="请输入菜单显示名称" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">跳转链接</label>
                <div class="col-sm-10">
                    <input name="url" type="text" class="form-control" placeholder="请输入菜单跳转链接" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="add" value="添加">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'edit_func_menu') { ?>
<div class="panel panel-default">
    <div class="panel-heading">编辑菜单</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-10">
                    <input name="name" <?php  if($func_menu_info['type']=='0') { ?>readonly<?php  } ?> value="<?php  echo $func_menu_info['name'];?>" type="text" class="form-control" placeholder="请输入菜单名称" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单图标</label>
                <div class="col-sm-10">
                    <?php  if($func_menu_info['icon'] != '') echo tpl_form_field_image('icon',$func_menu_info['icon']); else echo tpl_form_field_image('icon');?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单激活图标</label>
                <div class="col-sm-10">
                    <?php  if($func_menu_info['icon_active'] != '') echo tpl_form_field_image('icon_active',$func_menu_info['icon_active']); else echo tpl_form_field_image('icon_active');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单显示名称</label>
                <div class="col-sm-10">
                    <input name="customer_name" value="<?php  echo $func_menu_info['customer_name'];?>" type="text" class="form-control" placeholder="请输入菜单显示名称" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">跳转链接</label>
                <div class="col-sm-10">
                    <input name="url" value="<?php  echo $func_menu_info['url'];?>" type="text" class="form-control" placeholder="请输入菜单跳转链接" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="edit" value="修改">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'menu') { ?>
<div class="panel panel-default">
    <div class="panel-heading">导航项设置</div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">菜单名称</th>
                    <th style="text-align: center">菜单类型</th>
                    <th style="text-align: center">显示名称</th>
                    <th style="text-align: center">排序</th>
                    <th style="text-align: center;width:80px">显示/隐藏</th>
                    <th style="text-align: center;width:80px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($menu_list)) { foreach($menu_list as $index => $item) { ?>
                    <tr id="menu_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['name'];?></td>
                        <td style="text-align: center">
                            <?php  if($item['type'] == '0') { ?>
                                <span class="label label-danger">系统</span>
                            <?php  } else { ?>
                                <span class="label label-primary">自定义</span>
                            <?php  } ?>
                        </td>
                        <td style="text-align: center"><?php  echo $item['customer_name'];?></td>
                        <td style="text-align: center">
                            <div class="input-group">
                               <input id="order_index_<?php  echo $item['id'];?>" type="number" class="form-control" value="<?php  echo $item['order_index'];?>" />
                               <span class="input-group-addon" onclick="set_order_index(<?php  echo $item['id'];?>)" style="cursor: pointer">设置</span>
                           </div>
                        </td>
                        <td style="text-align: center;margin-top:15px">
                            <input id="display_<?php  echo $item['id'];?>" type="checkbox" <?php  if($item['display'] == '1') echo 'checked'; ?> />
                        </td>
                        <td style="text-align: center">
                            <a href="<?php  echo $this->createWeburl('page',array('op'=>'edit_menu','id'=>$item['id']))?>"><i class="fa fa-edit"></i></a>
                            <a href="javascript:delete_menu(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function delete_menu(id) {
    $.post("<?php  echo $this->createWeburl('page',array('op'=>'delete_menu'))?>",{
            id:id
        },function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(300,'删除成功！');
                $("#menu_"+id).remove();
            }
        }
    );
}
function set_order_index(id) {
    $.post("<?php  echo $this->createWeburl('page', array('op' => 'set_menu_order_index'));?>",{
            id:id,
            order_index:$("#order_index_"+id).val()
        },
        function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno != 0) {
                util.message('操作失败, 请稍后重试.')
            } else {
                util.message('操作成功', location.href, 'success');
            }
        }
    );
}
$("input[id^='display_']").change(function(){
        var id = $(this).attr('id');
        var id_arr = id.split('_');
        $.post("<?php  echo $this->createWeburl('page',array('op'=>'set_menu_display'))?>",{
                id:id_arr[1],
                display:$("input[id='"+id+"']:checked").val() == 'on' ? '1' : '0'
            },
            function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    tankuang(300,'设置成功');
                }
            }
        );
    })
</script>
<div class="panel panel-default">
    <div class="panel-heading">添加菜单</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="请输入菜单名称" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单图标</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('icon');?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单激活图标</label>
                <div class="col-sm-10">
                    <?php  echo tpl_form_field_image('icon_active');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单显示名称</label>
                <div class="col-sm-10">
                    <input name="customer_name" type="text" class="form-control" placeholder="请输入菜单显示名称" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">跳转链接</label>
                <div class="col-sm-10">
                    <input name="url" type="text" class="form-control" placeholder="请输入菜单跳转链接" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="add" value="添加">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php  } else if($op == 'edit_menu') { ?>
<div class="panel panel-default">
    <div class="panel-heading">编辑菜单</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单名称</label>
                <div class="col-sm-10">
                    <input name="name" <?php  if($menu_info['type']=='0') { ?>readonly<?php  } ?> value="<?php  echo $menu_info['name'];?>" type="text" class="form-control" placeholder="请输入菜单名称" />
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单图标</label>
                <div class="col-sm-10">
                    <?php  if($menu_info['icon'] != '') echo tpl_form_field_image('icon',$menu_info['icon']); else echo tpl_form_field_image('icon');?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">菜单激活图标</label>
                <div class="col-sm-10">
                    <?php  if($menu_info['icon_active'] != '') echo tpl_form_field_image('icon_active',$menu_info['icon_active']); else echo tpl_form_field_image('icon_active');?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">菜单显示名称</label>
                <div class="col-sm-10">
                    <input name="customer_name" value="<?php  echo $menu_info['customer_name'];?>" type="text" class="form-control" placeholder="请输入菜单显示名称" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">跳转链接</label>
                <div class="col-sm-10">
                    <input name="url" value="<?php  echo $menu_info['url'];?>" type="text" class="form-control" placeholder="请输入菜单跳转链接" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="edit" value="修改">
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>
        </form>
    </div>
</div>
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