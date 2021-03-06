<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template('header');
?>
<ol class="breadcrumb">
    <?php  if($op == 'edit_line' OR $op == 'add') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('line')?>">线路管理</a>
    </li>
    <?php  } ?>
    <?php  if($op == 'edit_station' OR $op == 'add_station') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('line',array('op'=>'station'))?>">站点管理</a>
    </li>
    <?php  } ?>
    <?php  if($op == 'edit_bus' OR $op == 'add_bus') { ?>
    <li>
        <a href="<?php  echo $this->createWeburl('line',array('op'=>'bus'))?>">班车专线</a>
    </li>
    <?php  } ?>
    <li class="active">
        <?php  if($op == 'index') { ?>
            线路管理
        <?php  } else if($op == 'edit_line') { ?>
            编辑线路
        <?php  } else if($op == 'add') { ?>
            添加线路
        <?php  } else if($op == 'station') { ?>
            站点管理
        <?php  } else if($op == 'edit_station') { ?>
            编辑站点
        <?php  } else if($op == 'add_station') { ?>
            添加站点
        <?php  } else if($op == 'bus') { ?>
            班车专线
        <?php  } else if($op == 'edit_bus') { ?>
            编辑
        <?php  } else if($op == 'add_bus') { ?>
            添加
        <?php  } ?>
    </li>
</ol>
<?php  if($op == 'index') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">线路列表</div>
        <div class="panel-body">
            <div style="text-align: right">
                <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('line',array('op'=>'add'))?>'">添加线路</button>
            </div>
            <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
                <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                    <tr>
                        <th style="text-align: center;width:50px">类型</th>
                        <th style="text-align: center;width:100px">线路名称</th>
                        <th style="text-align: center;width:100px">始发站</th>
                        <th style="text-align: center;width:100px">终点站</th>
                        <th style="text-align: center">站点</th>
                        <th style="text-align: center;width:80px">价格</th>
                        <th style="text-align: center;width:100px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($line)) { foreach($line as $index => $item) { ?>
                        <tr id="<?php  echo $item['id'];?>">
                            <td style="text-align: center">
                                <?php  if($item['type']=='1') { ?>
                                <span class="label label-primary">
                                <?php  } else if($item['type']=='2') { ?>
                                <span class="label label-success">
                                <?php  } else if($item['type']=='3') { ?>
                                <span class="label label-info">
                                <?php  } else if($item['type']=='4') { ?>
                                <span class="label label-warning">
                                <?php  } else if($item['type']=='5') { ?>
                                <span class="label label-warning">
                                <?php  } ?>
                                    <?php  echo $this->trans_travel_type($item['type']);?>
                                </span>
                            </td>
                            <td style="text-align: center"><?php  echo $item['name'];?></td>
                            <td style="text-align: center"><?php  echo $this->rtrim_cn($item['departure_city'],'市') . '-' . $item['departure_address'] . '(' . $item['departure_district'] . ')'?></td>
                            <td style="text-align: center"><?php  echo $this->rtrim_cn($item['terminal_city'],'市') . '-' . $item['terminal_address'] . '(' . $item['terminal_district'] . ')'?></td>
                            <td style="text-align: center">
                                <?php  echo $item['stations_str'];?>
                            </td>
                            <td style="text-align: center">
                                <?php  echo $item['price'];?>
                            </td>
                            <td style="text-align: center">
                                <a href="<?php  echo $this->createWeburl('line',array('op'=>'edit_line','id'=>$item['id']))?>" style="color:#4CB0F9"><i class="fa fa-edit"></i></a>
                                <a href="javascript:delete_line(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php  } } ?>
                </tbody>
            </table>
        </div>
    </div>
<script>
function delete_line(id) {
    var r = confirm("删除线路！");
    if(r) {
        $.post("<?php  echo $this->createWeburl('line', array('op' => 'delete_line'));?>",{
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
<?php  } else if($op == 'add') { ?>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">线路名称</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="请输入线路名称" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">始发站</label>
                <div class="col-sm-10">
                    <select name="departure_station_id" class="form-control">
                        <?php  if(is_array($departure_station)) { foreach($departure_station as $index => $item) { ?>
                            <option value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">终点站</label>
                <div class="col-sm-10">
                    <select name="terminal_station_id" class="form-control">
                        <?php  if(is_array($terminal_station)) { foreach($terminal_station as $index => $item) { ?>
                            <option value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">价格</label>
                <div class="col-sm-10">
                    <input name="price" type="number" step="0.01" class="form-control" placeholder="请输入线路价格" />
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
<?php  } else if($op == 'edit_line') { ?>
<div class="panel panel-info">
    <div class="panel-heading">线路基本信息</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">线路名称</label>
                <div class="col-sm-10">
                    <input name="name" value="<?php  echo $line['name'];?>" type="text" class="form-control" placeholder="请输入线路名称" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">始发站</label>
                <div class="col-sm-10">
                    <select name="departure_station_id" class="form-control">
                        <?php  if(is_array($departure_station)) { foreach($departure_station as $index => $item) { ?>
                            <option <?php  if($item['id']==$line['departure_station_id']) { ?>selected<?php  } ?> value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">终点站</label>
                <div class="col-sm-10">
                    <select name="terminal_station_id" class="form-control">
                        <?php  if(is_array($terminal_station)) { foreach($terminal_station as $index => $item) { ?>
                            <option <?php  if($item['id']==$line['terminal_station_id']) { ?>selected<?php  } ?> value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">价格</label>
                <div class="col-sm-10">
                    <input name="price" type="number" value="<?php  echo $line['price'];?>" step="0.01" class="form-control" placeholder="请输入线路价格" />
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
<div class="panel panel-info">
    <div class="panel-heading">
        差异价格
    </div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">乘客人数</th>
                    <th style="text-align: center">价格</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($line_price)) { foreach($line_price as $index => $item) { ?>
                    <tr id="price_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['passenger_amount'];?></td>
                        <td style="text-align: center">
                            <?php  echo $item['price'];?>
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:delete_price(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <script>
        function delete_price(id) {
            var r = confirm("删除差异价格！");
            if(r) {
                $.post("<?php  echo $this->createWeburl('line', array('op' => 'delete_price'));?>",{
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
        <div class="panel panel-default">
            <div class="panel-heading">添加差异价格</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="POST">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">人数</label>
                        <div class="col-sm-10">
                            <input name="passenger_amount" type="number" class="form-control" placeholder="请输入乘客人数" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">价格</label>
                        <div class="col-sm-10">
                            <input name="price" type="number" step="0.01" class="form-control" placeholder="请输入线路价格" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" name="add_price" value="添加">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-info">
    <div class="panel-heading">站点</div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">线路名称</th>
                    <th style="text-align: center;width:150px">排序</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($line_station)) { foreach($line_station as $index => $item) { ?>
                    <tr id="line_station_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['station_name'];?></td>
                        <td style="text-align: center">
                            <div class="input-group">
                               <input id="station_order_index_<?php  echo $item['id'];?>" type="number" class="form-control" value="<?php  echo $item['order_index'];?>" />
                               <span class="input-group-addon" onclick="set_station_order_index(<?php  echo $item['id'];?>)" style="cursor: pointer">设置</span>
                           </div>
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:delete_line_station(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <script>
            function delete_line_station(id) {
                $.post("<?php  echo $this->createWeburl('line',array('op'=>'delete_line_station'))?>",{
                        id:id
                    },function(resp) {
                        resp = $.parseJSON(resp);
                        if(resp.message.errno == '0') {
                            $("#line_station_"+id).remove();
                            tankuang(300,'删除站点成功！');
                        }
                    }
                );
            }
            function set_station_order_index(id) {
                $.post("<?php  echo $this->createWeburl('line', array('op' => 'set_station_order_index'));?>",{
                        id:id,
                        order_index:$("#station_order_index_"+id).val()
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
        </script>
        <div class="panel panel-default">
            <div class="panel-heading">添加站点</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="POST">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">选择站点</label>
                        <div class="col-sm-10">
                            <select name="station" class="form-control">
                                <?php  if(is_array($all_station)) { foreach($all_station as $index => $item) { ?>
                                    <option value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                                <?php  } } ?>
                            </select>
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
    </div>
</div>
<?php  } else if($op == 'station') { ?>
<div class="panel panel-default">
    <div class="panel-heading">站点列表</div>
    <div class="panel-body">
        <div style="text-align: right">
            <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('line',array('op'=>'add_station'))?>'">添加站点</button>
        </div>
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">站点名称</th>
                    <th style="text-align: center;width:80px">拼车始发站</th>
                    <th style="text-align: center;width:80px">拼车终点站</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($station)) { foreach($station as $index => $item) { ?>
                    <tr id="<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['name'];?></td>
                        <td style="text-align: center">
                            <input id="pin_departure_station_<?php  echo $item['id'];?>" type="checkbox" <?php  if($item['is_pin_departure_station'] == '1') echo 'checked'; ?> />
                        </td>
                        <td style="text-align: center">
                            <input id="pin_terminal_station_<?php  echo $item['id'];?>" type="checkbox" <?php  if($item['is_pin_terminal_station'] == '1') echo 'checked'; ?> />
                        </td>
                        <td style="text-align: center">
                            <a href="<?php  echo $this->createWeburl('line',array('op'=>'edit_station','station_id'=>$item['id']))?>" style="color:#4CB0F9"><i class="fa fa-edit"></i></a>
                            <a href="javascript:delete_station(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$("input[id^='pin_departure_station_']").change(function(){
    var id = $(this).attr('id');
    var id_arr = id.split('_');
    $.post("<?php  echo $this->createWeburl('line',array('op'=>'set_pin_departure_station'))?>",{
            id:id_arr[3],
            status:$("input[id='"+id+"']:checked").val() == 'on' ? '1' : '0'
        },
        function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(300,'设置成功');
            }
        }
    );
})
$("input[id^='pin_terminal_station_']").change(function(){
    var id = $(this).attr('id');
    var id_arr = id.split('_');
    $.post("<?php  echo $this->createWeburl('line',array('op'=>'set_pin_terminal_station'))?>",{
            id:id_arr[3],
            status:$("input[id='"+id+"']:checked").val() == 'on' ? '1' : '0'
        },
        function(resp) {
            resp = $.parseJSON(resp);
            if(resp.message.errno == 0) {
                tankuang(300,'设置成功');
            }
        }
    );
})
function delete_station(id) {
    var r = confirm("删除站点！");
    if(r) {
        $.post("<?php  echo $this->createWeburl('line', array('op' => 'delete_station'));?>",{
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
<?php  } else if($op == 'edit_station') { ?>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">站点名称</label>
                <div class="col-sm-10">
                    <input name="name" value="<?php  echo $station['name'];?>" type="text" class="form-control" placeholder="请输入站点名称" />
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">详细位置</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?php  echo $this->rtrim_cn($station['city'],'市') . '-' . $station['address'] . '(' . $station['district'] . ')'?>" name="address_str" />
                        <input type="hidden" value="<?php  echo $station['prov'];?>" name="prov" />
                        <input type="hidden" value="<?php  echo $station['city'];?>" name="city" />
                        <input type="hidden" value="<?php  echo $station['district'];?>" name="district" />
                        <input type="hidden" value="<?php  echo $station['address'];?>" name="address" />
                        <input type="hidden" id="lng" name="lng" value="<?php  echo $station['lng'];?>" class="form-control" />
                        <input type="hidden" id="lat" name="lat" value="<?php  echo $station['lat'];?>" class="form-control" />
                    </div>
                    <div class="col-sm-2" style="padding-top:5px">
                        <a href="javascript:choose_address()" id="map">地图选取</a>
                    </div>
                </div> 
            </div>
            <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=gCF3WxqfpdvaRxciR9m1Nm7lbgEwXrky"></script>
            <script>
                String.prototype.trim = function (char, type) {
                    if (char) {
                        if (type == 'left') {
                            return this.replace(new RegExp('^\\'+char+'+', 'g'), '');
                        } else if (type == 'right') {
                            return this.replace(new RegExp('\\'+char+'+$', 'g'), '');
                        }
                        return this.replace(new RegExp('^\\'+char+'+|\\'+char+'+$', 'g'), '');
                    }
                    return this.replace(/^\s+|\s+$/g, '');
                };
                var map = null;
                var lng_tmp = 0;
                var lat_tmp = 0;
                function choose_address() {
                    $("#map-dialog").modal();
                    $('#map-dialog').on('shown.bs.modal', function () {
                        if(map == null) {
                            map = new BMap.Map("map-container");
                        }
                        if($("#lng").val()=='') {
                            $("#location").val('<?php  echo $default_city;?>' == '' ? '北京' : '<?php  echo $default_city;?>');
                            search_locate();
                        } else {
                            lng_tmp = $("#lng").val();
                            lat_tmp = $("#lat").val();
                            var point = new BMap.Point(lng_tmp,lat_tmp);
                            locate(point);
                        }
                    })
                }
                function search_locate() {
                    if($("#location").val() == "") {
                        alert("输入查询位置！");
                        $("#location").focus();
                    } else {
                        var myGeo = new BMap.Geocoder();
                        myGeo.getPoint($("#location").val(),function(point) {
                            if(point) {
                                locate(point);
                            }                           
                        },$("#location").val());
                    }                       
                }
                function locate(point) {
                    map.centerAndZoom(point,16);
                    map.addControl(new BMap.NavigationControl());
                    var marker = new BMap.Marker(point);
                    marker.enableDragging();
                    marker.addEventListener("dragend",function(e){
                        lng_tmp = e.point.lng;
                        lat_tmp = e.point.lat;
                    });    
                    map.clearOverlays(); 
                    map.addOverlay(marker);
                }
                function choose_address_confirm() {
                    $("#lng").val(lng_tmp);
                    $("#lat").val(lat_tmp);
                    var geoc = new BMap.Geocoder();
                    var pt = new BMap.Point(lng_tmp,lat_tmp);
                    geoc.getLocation(pt, function(rs){
                        var addComp = rs.addressComponents;
                        var prov = addComp.province;
                        prov = prov.trim('市','right');
                        $("input[name='prov']").val(prov);
                        $("input[name='city']").val(addComp.city);
                        $("input[name='district']").val(addComp.district);
                        $("input[name='address']").val(addComp.street);
                        $("input[name='address_str']").val(addComp.city.trim('市','right')+'-'+addComp.street+'('+addComp.district+')');
                    });
                    $("#map-dialog").modal('hide');
                }
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
    <div id="map-dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog we7-modal-dialog" style="width: 80%;"> 
            <div class="modal-content">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <h3>请选择地点</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="location" type="text" class="form-control" placeholder="请输入地址来直接查找相关位置" />
                            <div class="input-group-btn">
                                <button class="btn btn-default" onclick="search_locate()"><i class="icon-search"></i> 搜索</button>
                            </div>
                        </div>
                    </div>
                    <div id="map-container" style="height: 400px; z-index: 0; background-color: rgb(243, 241, 236); color: rgb(0, 0, 0);">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="choose_address_confirm()">确认</button>
                </div> 
            </div>
        </div>
    </div>
<?php  } else if($op == 'add_station') { ?>
<div class="panel panel-default">
    <div class="panel-heading">添加站点</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">站点名称</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="请输入站点名称" />
                </div>
            </div>
            <div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">详细位置</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="address_str" />
                        <input type="hidden" name="prov" />
                        <input type="hidden" name="city" />
                        <input type="hidden" name="district" />
                        <input type="hidden" name="address" />
                        <input type="hidden" id="lng" name="lng" value="<?php  echo $service['lng'];?>" class="form-control" />
                        <input type="hidden" id="lat" name="lat" value="<?php  echo $service['lat'];?>" class="form-control" />
                    </div>
                    <div class="col-sm-2" style="padding-top:5px">
                        <a href="javascript:choose_address()" id="map">地图选取</a>
                    </div>
                </div> 
            </div>
            <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=gCF3WxqfpdvaRxciR9m1Nm7lbgEwXrky"></script>
            <script>
                String.prototype.trim = function (char, type) {
                    if (char) {
                        if (type == 'left') {
                            return this.replace(new RegExp('^\\'+char+'+', 'g'), '');
                        } else if (type == 'right') {
                            return this.replace(new RegExp('\\'+char+'+$', 'g'), '');
                        }
                        return this.replace(new RegExp('^\\'+char+'+|\\'+char+'+$', 'g'), '');
                    }
                    return this.replace(/^\s+|\s+$/g, '');
                };
                var map = null;
                var lng_tmp = 0;
                var lat_tmp = 0;
                function choose_address() {
                    $("#map-dialog").modal();
                    $('#map-dialog').on('shown.bs.modal', function () {
                        if(map == null) {
                            map = new BMap.Map("map-container");
                        }
                        if($("#lng").val()=='') {
                            $("#location").val('<?php  echo $default_city;?>' == '' ? '北京' : '<?php  echo $default_city;?>');
                            search_locate();
                        } else {
                            lng_tmp = $("#lng").val();
                            lat_tmp = $("#lat").val();
                            var point = new BMap.Point(lng_tmp,lat_tmp);
                            locate(point);
                        }
                    })
                }
                function search_locate() {
                    if($("#location").val() == "") {
                        alert("输入查询位置！");
                        $("#location").focus();
                    } else {
                        var myGeo = new BMap.Geocoder();
                        myGeo.getPoint($("#location").val(),function(point) {
                            lng_tmp = point.lng;
                            lat_tmp = point.lat;
                            if(point) {
                                locate(point);
                            }                           
                        },$("#location").val());
                    }                       
                }
                function locate(point) {
                    map.centerAndZoom(point,16);
                    map.addControl(new BMap.NavigationControl());
                    var marker = new BMap.Marker(point);
                    marker.enableDragging();
                    marker.addEventListener("dragend",function(e){
                        lng_tmp = e.point.lng;
                        lat_tmp = e.point.lat;
                    });    
                    map.clearOverlays(); 
                    map.addOverlay(marker);
                }
                function choose_address_confirm() {
                    $("#lng").val(lng_tmp);
                    $("#lat").val(lat_tmp);
                    var geoc = new BMap.Geocoder();
                    var pt = new BMap.Point(lng_tmp,lat_tmp);
                    geoc.getLocation(pt, function(rs){
                        var addComp = rs.addressComponents;
                        var address = addComp.street == '' ? rs.surroundingPois[0].address : addComp.street;
                        var prov = addComp.province;
                        prov = prov.trim('市','right');
                        $("input[name='prov']").val(prov);
                        $("input[name='city']").val(addComp.city);
                        $("input[name='district']").val(addComp.district);
                        $("input[name='address']").val(address);
                        $("input[name='address_str']").val(addComp.city.trim('市','right')+'-'+address+'('+addComp.district+')');
                    });
                    $("#map-dialog").modal('hide');
                }
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
    <div id="map-dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog we7-modal-dialog" style="width: 80%;"> 
            <div class="modal-content">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
                    <h3>请选择地点</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="location" type="text" class="form-control" placeholder="请输入地址来直接查找相关位置" />
                            <div class="input-group-btn">
                                <button class="btn btn-default" onclick="search_locate()"><i class="icon-search"></i> 搜索</button>
                            </div>
                        </div>
                    </div>
                    <div id="map-container" style="height: 400px; z-index: 0; background-color: rgb(243, 241, 236); color: rgb(0, 0, 0);">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="choose_address_confirm()">确认</button>
                </div> 
            </div>
        </div>
    </div>
<?php  } else if($op == 'bus') { ?>
    <div class="panel panel-default">
        <div class="panel-heading">班车专线</div>
        <div class="panel-body">
            <div style="text-align: right">
                <button class="btn btn-primary" onclick="location.href='<?php  echo $this->createWeburl('line',array('op'=>'add_bus'))?>'">添加</button>
            </div>
            <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
                <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                    <tr>
                        <th style="text-align: center;width:100px">始发站</th>
                        <th style="text-align: center;width:100px">终点站</th>
                        <th style="text-align: center">登车地点</th>
                        <th style="text-align: center;width:100px">价格</th>
                        <th style="text-align: center;width:100px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($line)) { foreach($line as $index => $item) { ?>
                        <tr id="<?php  echo $item['id'];?>">
                            <td style="text-align: center"><?php  echo $item['departure_station'];?></td>
                            <td style="text-align: center"><?php  echo $item['terminal_station'];?></td>
                            <td style="text-align: center"><?php  echo $item['boarding_place'];?></td>
                            <td style="text-align: center"><?php  echo $item['price'];?></td>
                            <td style="text-align: center">
                                <a href="<?php  echo $this->createWeburl('line',array('op'=>'edit_bus','id'=>$item['id']))?>" style="color:#4CB0F9"><i class="fa fa-edit"></i></a>
                                <a href="javascript:delete_bus(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php  } } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        function delete_bus(id) {
            $.post("<?php  echo $this->createWeburl('line',array('op'=>'delete_bus'))?>",{
                    id:id
                },function(response) {
                    var resp = $.parseJSON(response);
                    if(resp.message.errno == 0) {
                        alert("删除成功！");
                        $("#"+id).remove();
                    }
                }
            );
        }
    </script>
<?php  } else if($op == 'add_bus') { ?>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">始发站</label>
                <div class="col-sm-10">
                    <select name="departure_station_id" class="form-control">
                        <?php  if(is_array($departure_station)) { foreach($departure_station as $index => $item) { ?>
                            <option value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">终点站</label>
                <div class="col-sm-10">
                    <select name="terminal_station_id" class="form-control">
                        <?php  if(is_array($terminal_station)) { foreach($terminal_station as $index => $item) { ?>
                            <option value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">登车地点</label>
                <div class="col-sm-10">
                    <input class="form-control" name="boarding_place" placeholder="请输入登车地点" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">价格</label>
                <div class="col-sm-10">
                    <input class="form-control" name="price" step="0.01" placeholder="请输入价格" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">出发时间固定</label>
                <div class="col-sm-10">
                    <select class="form-control" name="fix_departure_time">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
            </div>
            <script>
            $("select[name='fix_departure_time']").change(function(){
                if($("select[name='fix_departure_time']").val()== '0') {
                    $("#departure_info").hide();
                } else {
                    $("#departure_info").show();
                }
            })
            </script>
            <div id="departure_info">
                <div class="form-group">
                    <label class="col-sm-2 control-label">发车时间</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" name="departure_time" placeholder="请输入发车时间" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">预计到达时间</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" name="terminal_time" placeholder="请输入预计到达时间" />
                    </div>
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
<?php  } else if($op == 'edit_bus') { ?>
<div class="panel panel-default">
    <div class="panel-heading">基础信息</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">始发站</label>
                <div class="col-sm-10">
                    <select name="departure_station_id" class="form-control">
                        <?php  if(is_array($departure_station)) { foreach($departure_station as $index => $item) { ?>
                            <option <?php  if($item['id']==$line['departure_station_id']) { ?>selected<?php  } ?> value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">终点站</label>
                <div class="col-sm-10">
                    <select name="terminal_station_id" class="form-control">
                        <?php  if(is_array($terminal_station)) { foreach($terminal_station as $index => $item) { ?>
                            <option <?php  if($item['id']==$line['terminal_station_id']) { ?>selected<?php  } ?> value="<?php  echo $item['id'];?>"><?php  echo $item['name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">登车地点</label>
                <div class="col-sm-10">
                    <input class="form-control" name="boarding_place" value="<?php  echo $line['boarding_place'];?>" placeholder="请输入登车地点" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">价格</label>
                <div class="col-sm-10">
                    <input class="form-control" name="price" value="<?php  echo $line['price'];?>" step="0.01" placeholder="请输入价格" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">出发时间固定</label>
                <div class="col-sm-10">
                    <select class="form-control" name="fix_departure_time">
                        <option <?php  if($line['fix_departure_time']=='1') { ?>selected<?php  } ?> value="1">是</option>
                        <option <?php  if($line['fix_departure_time']=='0') { ?>selected<?php  } ?> value="0">否</option>
                    </select>
                </div>
            </div>
            <script>
            $("select[name='fix_departure_time']").change(function(){
                if($("select[name='fix_departure_time']").val()== '0') {
                    $("#departure_info").hide();
                } else {
                    $("#departure_info").show();
                }
            })
            </script>
            <div id="departure_info" <?php  if($line['fix_departure_time']=='0') { ?>style="display:none"<?php  } ?>>
                <div class="form-group">
                    <label class="col-sm-2 control-label">发车时间</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" name="departure_time" value="<?php  echo $line['departure_time'];?>" placeholder="请输入发车时间" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">预计到达时间</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" name="terminal_time" value="<?php  echo $line['terminal_time'];?>" placeholder="请输入预计到达时间" />
                    </div>
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
<div class="panel panel-default">
    <div class="panel-heading">途径线路</div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">站点名称</th>
                    <th style="text-align: center;width:150px">排序</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($station)) { foreach($station as $index => $item) { ?>
                    <tr id="station_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['station'];?></td>
                        <td style="text-align: center">
                            <div class="input-group">
                                <input id="order_index_<?php  echo $item['id'];?>" type="number" class="form-control" value="<?php  echo $item['order_index'];?>" />
                                <span class="input-group-addon" onclick="set_order_index(<?php  echo $item['id'];?>)" style="cursor: pointer">设置</span>
                            </div>
                        </td>
                        <td style="text-align: center">
                            <a href="javascript:delete_station(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <script>
            function delete_station(id) {
                $.post("<?php  echo $this->createWeburl('line',array('op'=>'delete_bus_station'))?>",{
                        id:id
                    },function(resp) {
                        resp = $.parseJSON(resp);
                        if(resp.message.errno == '0') {
                            tankuang(300,'删除成功！');
                            $("#station_"+id).remove();
                        }
                    }
                );
            }
            function set_order_index(id) {
                $.post("<?php  echo $this->createWeburl('line', array('op' => 'set_bus_station_order_index'));?>",{
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
        </script>
        <div class="panel panel-default">
            <div class="panel-heading">添加站点</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="POST">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">站点</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="station" placeholder="请输入站点名称" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" name="add_station" value="添加">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">司机</div>
    <div class="panel-body">
        <table class="table table-condensed table-striped" style="background-color: white;table-layout:fixed;word-wrap:break-word">
            <thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;">
                <tr>
                    <th style="text-align: center">姓名</th>
                    <th style="text-align: center">联系电话</th>
                    <th style="text-align: center">车牌</th>
                    <th style="text-align: center;width:100px">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($owner)) { foreach($owner as $index => $item) { ?>
                    <tr id="owner_<?php  echo $item['id'];?>">
                        <td style="text-align: center"><?php  echo $item['name'];?></td>
                        <td style="text-align: center"><?php  echo $item['tel'];?></td>
                        <td style="text-align: center"><?php  echo $item['car_number_1'];?><?php  echo $item['car_number_2'];?><?php  echo $item['car_number_3'];?></td>
                        <td style="text-align: center">
                            <a href="javascript:delete_owner(<?php  echo $item['id'];?>)" style="color:red"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php  } } ?>
            </tbody>
        </table>
        <script>
        function delete_owner(id) {
            $.post("<?php  echo $this->createWeburl('line',array('op'=>'delete_bus_owner'))?>",{
                    id:id
                },function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == '0') {
                        $("#owner_"+id).remove();
                        tankuang(300,'删除成功！');
                    }
                }
            );
        }
        </script>
        <form class="form-horizontal" role="form" action="" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">选择司机</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input id="owner_mobile" name="owner_mobile" class="form-control" placeholder="请输入司机手机号" />
                        <span class="input-group-addon" onclick="search()" style="cursor: pointer;">查询</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <span id="owner_info"></span>
                </div>
            </div>
            <script>
            function search() {
                if($("#owner_mobile").val() == '') {
                    alert("请输入要查询司机手机号！");
                    $("#owner_mobile").focus();
                } else {
                    $.post("<?php  echo $this->createWeburl('line',array('op'=>'search_bus_owner'))?>",{
                            mobile:$("#owner_mobile").val()
                        },function(resp) {
                            resp = $.parseJSON(resp);
                            if(resp.message.errno == '0') {
                                var owner = resp.message.message;
                                $("#owner_info").html(owner.name+" "+owner.car_number_1+owner.car_number_2+owner.car_number_3);
                                $("#owner_info").css('color','green');
                            } else {
                                $("#owner_info").html("无此车主！");
                                $("#owner_info").css('color','red');
                            }
                        }
                    );
                }
            }
            </script>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" name="add_owner" value="添加">
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