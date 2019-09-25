<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'edit' OR $op == 'post') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('city')?>">城市管理</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'index') { ?>
            城市管理
        <?php  } else if($op == 'edit') { ?>
            编辑城市
        <?php  } else if($op == 'post') { ?>
            添加城市
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'index') { ?>
	<div class="panel panel-default">
        <div class="panel-heading">城市列表</div>
	    <div class="panel-body">
            <div style="text-align: right">
                <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('city',array('op'=>'post'))?>'">添加城市</button>
            </div>
			<table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
				<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
					<tr>
					    <th style="text-align: center">城市名称</th>
                        <th style="text-align: center;width:40px">默认</th>
					    <th style="text-align: center;width:100px">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($city)) { foreach($city as $index => $item) { ?>
						<tr id="<?php  echo $item['id'];?>">
							<td style="text-align: center"><?php  echo $item['city'];?></td>
                            <td style="text-align: center"><input id="city_<?php  echo $item['id'];?>" type="checkbox" <?php  if($item['is_default'] == '1') echo 'checked'; ?> /></td>
							<td style="text-align: center">
								<a href="<?php  echo $this->createWeburl('city',array('op'=>'edit','id'=>$item['id']))?>" style="color:#4CB0F9"><i class="fa fa-edit"></i></a>
								<a href="javascript:delete_city(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
<script>
$("input[id^='city_']").change(function(){
    var id = $(this).attr('id');
    var id_arr = id.split('_');
    if($("input[id='"+id+"']:checked").val() == 'on') {
        $.post("<?php  echo $this->createWeburl('city',array('op'=>'set_default'))?>",{
                id:id_arr[1],
                is_default:$("input[id='"+id+"']:checked").val() == 'on' ? '1' : '0'
            },
            function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == 0) {
                    $("input[id^='city_']").prop('checked',false);
                    $("input[id='"+id+"']").prop('checked',true);
                    tankuang(300,"设置成功！");
                }
            }
        );
    } else {
        $(this).prop('checked',true);
    }    
})
function delete_city(id) {
	var r = confirm("删除城市！");
	if(r) {
		$.post("<?php  echo $this->createWeburl('city', array('op' => 'delete_city'));?>",{
				id:id
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
}
</script>
<?php  } else if($op == 'post') { ?>
<div class="panel panel-default">
	<div class="panel-body">
	    <form class="form-horizontal" role="form" action="" method="POST">
			<div class="form-group">
				<label class="col-sm-2 control-label">字母索引</label>
				<div class="col-sm-10">
					<select name="alphabetical_index" class="form-control">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
						<option value="E">E</option>
						<option value="F">F</option>
						<option value="G">G</option>
						<option value="H">H</option>
						<option value="I">I</option>
						<option value="J">J</option>
						<option value="K">K</option>
						<option value="L">L</option>
						<option value="M">M</option>
						<option value="N">N</option>
						<option value="O">O</option>
						<option value="P">P</option>
						<option value="Q">Q</option>
						<option value="R">R</option>
						<option value="S">S</option>
						<option value="T">T</option>
						<option value="U">U</option>
						<option value="V">V</option>
						<option value="W">W</option>
						<option value="X">X</option>
						<option value="Y">Y</option>
						<option value="Z">Z</option>
					</select>
				</div>
			</div>
			<div class="form-group">
                <label for="name" class="col-sm-2 control-label">所在城市</label>
                <div class="col-sm-10">
                    <div data-toggle="distpicker"><!-- container -->
                        <select name="prov"></select><!-- 省 -->
                        <select name="city"></select><!-- 市 -->
                    </div>
                </div>
            </div>
            <script>
                var requireExtend = require.config({
                    paths: {
                        'distpicker': '<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/distpicker', //结尾不写.js
                        'distpicker.data': '<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/distpicker.data', //结尾不写.js
                    },
                    shim:{
                        //依赖
                        'distpicker' : {
                            exports: '$',
                            deps: ['distpicker.data']
                        },
                    }
                });
                requireExtend(["distpicker"]);
            </script>
		  	<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default" name="add" value="添加">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
				</div>
			</div>
		</form>
	</div>
</div>
<?php  } else if($op == 'edit') { ?>
<div class="panel panel-default">
    <div class="panel-heading">基本信息</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">字母索引</label>
                <div class="col-sm-10">
                    <select name="alphabetical_index" class="form-control">
                        <option <?php  if($city['alphabetical_index'] == 'A') { ?>selected<?php  } ?> value="A">A</option>
                        <option <?php  if($city['alphabetical_index'] == 'B') { ?>selected<?php  } ?> value="B">B</option>
                        <option <?php  if($city['alphabetical_index'] == 'C') { ?>selected<?php  } ?> value="C">C</option>
                        <option <?php  if($city['alphabetical_index'] == 'D') { ?>selected<?php  } ?> value="D">D</option>
                        <option <?php  if($city['alphabetical_index'] == 'E') { ?>selected<?php  } ?> value="E">E</option>
                        <option <?php  if($city['alphabetical_index'] == 'F') { ?>selected<?php  } ?> value="F">F</option>
                        <option <?php  if($city['alphabetical_index'] == 'G') { ?>selected<?php  } ?> value="G">G</option>
                        <option <?php  if($city['alphabetical_index'] == 'H') { ?>selected<?php  } ?> value="H">H</option>
                        <option <?php  if($city['alphabetical_index'] == 'I') { ?>selected<?php  } ?> value="I">I</option>
                        <option <?php  if($city['alphabetical_index'] == 'J') { ?>selected<?php  } ?> value="J">J</option>
                        <option <?php  if($city['alphabetical_index'] == 'K') { ?>selected<?php  } ?> value="K">K</option>
                        <option <?php  if($city['alphabetical_index'] == 'L') { ?>selected<?php  } ?> value="L">L</option>
                        <option <?php  if($city['alphabetical_index'] == 'M') { ?>selected<?php  } ?> value="M">M</option>
                        <option <?php  if($city['alphabetical_index'] == 'N') { ?>selected<?php  } ?> value="N">N</option>
                        <option <?php  if($city['alphabetical_index'] == 'O') { ?>selected<?php  } ?> value="O">O</option>
                        <option <?php  if($city['alphabetical_index'] == 'P') { ?>selected<?php  } ?> value="P">P</option>
                        <option <?php  if($city['alphabetical_index'] == 'Q') { ?>selected<?php  } ?> value="Q">Q</option>
                        <option <?php  if($city['alphabetical_index'] == 'R') { ?>selected<?php  } ?> value="R">R</option>
                        <option <?php  if($city['alphabetical_index'] == 'S') { ?>selected<?php  } ?> value="S">S</option>
                        <option <?php  if($city['alphabetical_index'] == 'T') { ?>selected<?php  } ?> value="T">T</option>
                        <option <?php  if($city['alphabetical_index'] == 'U') { ?>selected<?php  } ?> value="U">U</option>
                        <option <?php  if($city['alphabetical_index'] == 'V') { ?>selected<?php  } ?> value="V">V</option>
                        <option <?php  if($city['alphabetical_index'] == 'W') { ?>selected<?php  } ?> value="W">W</option>
                        <option <?php  if($city['alphabetical_index'] == 'X') { ?>selected<?php  } ?> value="X">X</option>
                        <option <?php  if($city['alphabetical_index'] == 'Y') { ?>selected<?php  } ?> value="Y">Y</option>
                        <option <?php  if($city['alphabetical_index'] == 'Z') { ?>selected<?php  } ?> value="Z">Z</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">所在城市</label>
                <div class="col-sm-10">
                    <div data-toggle="distpicker"><!-- container -->
                        <select name="prov" data-province="<?php  echo $city['prov'];?>"></select><!-- 省 -->
                        <select name="city" data-city="<?php  echo $city['city'];?>"></select><!-- 市 -->
                    </div>
                </div>
            </div>
            <script>
                var requireExtend = require.config({
                    paths: {
                        'distpicker': '<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/distpicker', //结尾不写.js
                        'distpicker.data': '<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/distpicker.data', //结尾不写.js
                    },
                    shim:{
                        //依赖
                        'distpicker' : {
                            exports: '$',
                            deps: ['distpicker.data']
                        },
                    }
                });
                requireExtend(["distpicker"]);
            </script>
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