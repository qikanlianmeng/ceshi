<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.css" />
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/components/datepicker/mui.picker.all.js"></script>
<style>
.mui-input-group:before {
    height:0px;
}
.mui-input-group:after {
    height:0px;
}
</style>
<div class="mui-content" style="background-color: #f3f3f3">
    <div>
        <form class="mui-input-group" role="form" action="" method="POST">
            <div style="position:fixed;top:0px;width:100%;background-color:white">
                <div class="mui-input-row">
                    <label style="width:30%">车牌号</label>
                    <div style="margin-left:30%;width:70%">
                        <div style="width:30px;height:40px">
                            <select id="part_1" name="part_1">
                                <option <?php  if($owner['car_number_1'] == '京') { ?>selected<?php  } ?>>京</option>
                                <option <?php  if($owner['car_number_1'] == '津') { ?>selected<?php  } ?>>津</option>
                                <option <?php  if($owner['car_number_1'] == '冀') { ?>selected<?php  } ?>>冀</option>
                                <option <?php  if($owner['car_number_1'] == '晋') { ?>selected<?php  } ?>>晋</option>
                                <option <?php  if($owner['car_number_1'] == '蒙') { ?>selected<?php  } ?>>蒙</option>
                                <option <?php  if($owner['car_number_1'] == '辽') { ?>selected<?php  } ?>>辽</option>
                                <option <?php  if($owner['car_number_1'] == '吉') { ?>selected<?php  } ?>>吉</option>
                                <option <?php  if($owner['car_number_1'] == '黑') { ?>selected<?php  } ?>>黑</option> 
                                <option <?php  if($owner['car_number_1'] == '沪') { ?>selected<?php  } ?>>沪</option>
                                <option <?php  if($owner['car_number_1'] == '苏') { ?>selected<?php  } ?>>苏</option> 
                                <option <?php  if($owner['car_number_1'] == '浙') { ?>selected<?php  } ?>>浙</option>
                                <option <?php  if($owner['car_number_1'] == '皖') { ?>selected<?php  } ?>>皖</option>
                                <option <?php  if($owner['car_number_1'] == '闽') { ?>selected<?php  } ?>>闽</option>
                                <option <?php  if($owner['car_number_1'] == '赣') { ?>selected<?php  } ?>>赣</option>
                                <option <?php  if($owner['car_number_1'] == '鲁') { ?>selected<?php  } ?>>鲁</option>
                                <option <?php  if($owner['car_number_1'] == '豫') { ?>selected<?php  } ?>>豫</option>
                                <option <?php  if($owner['car_number_1'] == '鄂') { ?>selected<?php  } ?>>鄂</option>
                                <option <?php  if($owner['car_number_1'] == '湘') { ?>selected<?php  } ?>>湘</option> 
                                <option <?php  if($owner['car_number_1'] == '粤') { ?>selected<?php  } ?>>粤</option>
                                <option <?php  if($owner['car_number_1'] == '桂') { ?>selected<?php  } ?>>桂</option>
                                <option <?php  if($owner['car_number_1'] == '琼') { ?>selected<?php  } ?>>琼</option>
                                <option <?php  if($owner['car_number_1'] == '渝') { ?>selected<?php  } ?>>渝</option>
                                <option <?php  if($owner['car_number_1'] == '川') { ?>selected<?php  } ?>>川</option>
                                <option <?php  if($owner['car_number_1'] == '贵') { ?>selected<?php  } ?>>贵</option>
                                <option <?php  if($owner['car_number_1'] == '云') { ?>selected<?php  } ?>>云</option>
                                <option <?php  if($owner['car_number_1'] == '藏') { ?>selected<?php  } ?>>藏</option>
                                <option <?php  if($owner['car_number_1'] == '陕') { ?>selected<?php  } ?>>陕</option>
                                <option <?php  if($owner['car_number_1'] == '甘') { ?>selected<?php  } ?>>甘</option>
                                <option <?php  if($owner['car_number_1'] == '青') { ?>selected<?php  } ?>>青</option>
                                <option <?php  if($owner['car_number_1'] == '宁') { ?>selected<?php  } ?>>宁</option>
                                <option <?php  if($owner['car_number_1'] == '新') { ?>selected<?php  } ?>>新</option>
                            </select>
                        </div>
                        <div style="width:30px;margin-left:30px;margin-top:-40px;height:40px">
                            <select id="part_2" name="part_2">
                                <option <?php  if($owner['car_number_2'] == 'A') { ?>selected<?php  } ?>>A</option>
                                <option <?php  if($owner['car_number_2'] == 'B') { ?>selected<?php  } ?>>B</option>
                                <option <?php  if($owner['car_number_2'] == 'C') { ?>selected<?php  } ?>>C</option>
                                <option <?php  if($owner['car_number_2'] == 'D') { ?>selected<?php  } ?>>D</option>
                                <option <?php  if($owner['car_number_2'] == 'E') { ?>selected<?php  } ?>>E</option>
                                <option <?php  if($owner['car_number_2'] == 'F') { ?>selected<?php  } ?>>F</option>
                                <option <?php  if($owner['car_number_2'] == 'G') { ?>selected<?php  } ?>>G</option>
                                <option <?php  if($owner['car_number_2'] == 'H') { ?>selected<?php  } ?>>H</option>
                                <option <?php  if($owner['car_number_2'] == 'I') { ?>selected<?php  } ?>>I</option>
                                <option <?php  if($owner['car_number_2'] == 'J') { ?>selected<?php  } ?>>J</option>
                                <option <?php  if($owner['car_number_2'] == 'K') { ?>selected<?php  } ?>>K</option>
                                <option <?php  if($owner['car_number_2'] == 'L') { ?>selected<?php  } ?>>L</option>
                                <option <?php  if($owner['car_number_2'] == 'M') { ?>selected<?php  } ?>>M</option>
                                <option <?php  if($owner['car_number_2'] == 'N') { ?>selected<?php  } ?>>N</option>
                                <option <?php  if($owner['car_number_2'] == 'O') { ?>selected<?php  } ?>>O</option>
                                <option <?php  if($owner['car_number_2'] == 'P') { ?>selected<?php  } ?>>P</option>
                                <option <?php  if($owner['car_number_2'] == 'Q') { ?>selected<?php  } ?>>Q</option>
                                <option <?php  if($owner['car_number_2'] == 'R') { ?>selected<?php  } ?>>R</option>
                                <option <?php  if($owner['car_number_2'] == 'S') { ?>selected<?php  } ?>>S</option>
                                <option <?php  if($owner['car_number_2'] == 'T') { ?>selected<?php  } ?>>T</option>
                                <option <?php  if($owner['car_number_2'] == 'U') { ?>selected<?php  } ?>>U</option>
                                <option <?php  if($owner['car_number_2'] == 'V') { ?>selected<?php  } ?>>V</option>
                                <option <?php  if($owner['car_number_2'] == 'W') { ?>selected<?php  } ?>>W</option>
                                <option <?php  if($owner['car_number_2'] == 'X') { ?>selected<?php  } ?>>X</option>
                                <option <?php  if($owner['car_number_2'] == 'Y') { ?>selected<?php  } ?>>Y</option>
                                <option <?php  if($owner['car_number_2'] == 'Z') { ?>selected<?php  } ?>>Z</option>
                            </select>
                        </div>
                        <div style="margin-left:60px;margin-top:-40px">
                            <input id="part_3" name="part_3" style="text-transform:uppercase;" maxlength="7"  onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" value="<?php  echo $owner['car_number_3'];?>" class="weui_input" type="text" placeholder="请输六位数字字母"/>
                        </div>
                    </div>
                </div>
                <div class="mui-input-row">
                    <label style="width:30%">品牌型号</label>
                    <input id="car_series" name="car_series" value="<?php  echo $owner['car_series'];?>" style="width:70%" type="text" class="mui-input-clear" placeholder="请输入车辆品牌型号">
                </div>
                <div class="mui-input-row">
                    <label style="width:30%">车辆颜色</label>
                    <input id="car_color" name="car_color" value="<?php  echo $owner['car_color'];?>" style="width:70%" type="text" class="mui-input-clear" placeholder="请输入车身颜色">
                </div>
                <div class="mui-input-row">
                    <label style="width:30%">姓名</label>
                    <input id="name" name="name" value="<?php  echo $owner['name'];?>" style="width:70%" type="text" class="mui-input-clear" placeholder="请输入车主姓名">
                </div>
                <div class="mui-input-row">
                    <label style="width:30%">联系电话</label>
                    <input id="tel" name="tel" value="<?php  echo $owner['tel'];?>" style="width:70%" type="text" class="mui-input-clear" placeholder="请输入车主联系电话">
                </div>
                <div class="mui-input-row">
                    <label style="width:30%">保险有效期至</label>
                    <input id="insurance_expire" style="width:70%;background-color: transparent;border:0px;border-radius: 0px;height:40px" readonly="true" value="<?php echo date('Y-m-d',$owner['insurance_expire'] ? $owner['insurance_expire'] : time())?>" onfocus=this.blur()  placeholder="请选择保险有效至日期" />
                </div>
                <div class="mui-input-row">
                    <label style="width:30%">邀请码</label>
                    <input id="inviter_code" name="inviter_code" value="<?php  echo $owner['inviter_code'];?>" <?php  if(!empty($owner)) { ?>disabled<?php  } ?> style="width:70%" type="text" class="mui-input-clear" placeholder="请输入邀请码">
                </div>
                <div style="height:15px;background-color: <?php  echo $conf['bg_color'];?>;margin-top:10px"></div>
                <style>
                    .help-block img {
                        width:100%;
                        height:auto;
                    }
                </style>
            </div>
            <div style="margin-top:305px;padding:10px;width:100%">
                <div style="width:60px;height:40px;text-align: center;padding-top:8px">行驶证<br>【蓝本】</div>
                <div style="margin:-40px 0px 0px 60px">
                    <input type="file" accept="image/*" name="img_vehicle_travel_license" style="display:none" />
                    <img id="vehicle_travel_license_preview" src="<?php  echo tomedia($owner['vehicle_travel_license'])?>" onerror="javascript:this.src='./resource/images/nopic.jpg'" style="width:70%;height:auto" onclick="select_file('vehicle_travel_license');return false;" />
                </div>
            </div>
            <div style="padding:10px;width:100%">
                <div style="width:60px;height:40px;text-align: center;padding-top:8px">驾驶证<br>【黑本】</div>
                <div style="margin:-40px 0px 0px 60px">
                    <input type="file" accept="image/*" name="img_driving_license" style="display:none" />
                    <img id="driving_license_preview" src="<?php  echo tomedia($owner['driving_license'])?>" onerror="javascript:this.src='./resource/images/nopic.jpg'" style="width:70%;height:auto" onclick="select_file('driving_license');return false;" />
                </div>
            </div>
            <div style="padding:10px;width:100%">
                <div style="width:60px;height:40px;text-align: center;padding-top:8px">车辆照片</div>
                <div style="margin:-40px 0px 0px 60px">
                    <input type="file" accept="image/*" name="img_car_img" style="display:none" />
                    <img id="car_img_preview" src="<?php  echo tomedia($owner['car_img'])?>" onerror="javascript:this.src='./resource/images/nopic.jpg'" style="width:70%;height:auto" onclick="select_file('car_img');return false;" />
                    <div style="color:red;font-size:12px">
                        要求：车辆照片必须清楚看到车牌
                    </div>
                </div>
            </div>
            <div style="padding:10px;width:100%">
                <div style="width:60px;height:40px;text-align: center;padding-top:8px">保险单</div>
                <div style="margin:-40px 0px 0px 60px">
                    <input type="file" accept="image/*" name="img_insurance_img" style="display:none" />
                    <img id="insurance_img_preview" src="<?php  echo tomedia($owner['insurance_img'])?>" onerror="javascript:this.src='./resource/images/nopic.jpg'" style="width:70%;height:auto" onclick="select_file('insurance_img');return false;" />
                    <div style="color:red;font-size:12px">
                        要求：保险标志背面图要求清晰看到信息
                    </div>
                    <?php  if($owner['insurance_expire']=='' OR $owner['insurance_expire']<time()) { ?>
                        <div style="color:red">*保险已到期，请重新提交审核！</div>
                    <?php  } ?>
                </div>
            </div>
            <script>
                Date.prototype.format = function(format) {
                   var date = {
                          "M+": this.getMonth() + 1,
                          "d+": this.getDate(),
                          "h+": this.getHours(),
                          "m+": this.getMinutes(),
                          "s+": this.getSeconds(),
                          "q+": Math.floor((this.getMonth() + 3) / 3),
                          "S+": this.getMilliseconds()
                   };
                   if (/(y+)/i.test(format)) {
                          format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
                   }
                   for (var k in date) {
                          if (new RegExp("(" + k + ")").test(format)) {
                                 format = format.replace(RegExp.$1, RegExp.$1.length == 1
                                        ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
                          }
                   }
                   return format;
                }
                $("#insurance_expire").click(function(){
                    var start = <?php echo $owner['insurance_expire'] ? $owner['insurance_expire'] : time()?>*1000;
                    var start_d = new Date(start);
                    var dtPicker = new mui.DtPicker({
                        type: "date",
                        value:start_d.format('yyyy-MM-dd h:m')
                    }); 
                    dtPicker.show(function (selectItems) { 
                        var str_time = selectItems.y.value+"-"+selectItems.m.value+"-"+selectItems.d.value;
                        $("#insurance_expire").val(str_time);
                    })
                })
                var images = new Array();
                images['vehicle_travel_license'] = '<?php echo $owner['vehicle_travel_license'] ? tomedia($owner['vehicle_travel_license']) : ''?>';
                images['driving_license'] = '<?php echo $owner['driving_license'] ? tomedia($owner['driving_license']) : ''?>';
                images['car_img'] = '<?php echo $owner['car_img'] ? tomedia($owner['car_img']) : ''?>';
                images['insurance_img'] = '<?php echo $owner['insurance_img'] ? tomedia($owner['insurance_img']) : ''?>';
                function select_file(file){
                    $("input[name='img_"+file+"']").click();
                }
                var requireExtend = require.config({
                    paths: {
                        'lrz': "<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/js/lrz.all.bundle", //结尾不写.js
                    },
                    shim:{
                                        
                    }
                });
                requireExtend(["lrz"],function(res){
                    $("input[name^='img_']").on('change', function(){
                        var name = $(this).attr('name').substring(4);
                        lrz(this.files[0], {width: 640})
                            .then(function (rst) {
                                $.ajax({
                                    url: '<?php  echo $this->createMobileurl('upload_image')?>',
                                    type: 'post',
                                    data: {img: rst.base64},
                                    dataType: 'json',
                                    timeout: 200000,
                                    error: function(data){
                                        
                                    },
                                    success: function(data){
                                        images[name] = data.message.message.filename;
                                        $("#"+name+"_preview").attr('src',data.message.message.url);
                                    }
                                });

                            })
                            .catch(function (err) {

                            })
                            .always(function () {

                            });
                    });
                });
            </script>
        </form>
    </div>
    <div style="height:80px"></div>
</div>
    <div style="position:fixed;bottom:0px;padding:5px 10px;background-color: white;width:100%">
        <?php  if(empty($owner)) { ?>
            <button class="mui-btn mui-btn-block" style="background-color: <?php  echo $conf['color'];?>;color:white;margin:0px" onclick="info_submit()">提交认证</button>
        <?php  } else if($owner['status'] == '0' OR $owner['insurance_expire']=='' OR $owner['insurance_expire']<time()) { ?>
            <button class="mui-btn mui-btn-warning mui-btn-block" style="margin:0px" onclick="modify()">提交修改</button>
        <?php  } else if($owner['status'] == '1') { ?>
            <button class="mui-btn mui-btn-block" style="background-color: red;color:white;margin:0px" onclick="cancel_bind()">解除绑定</button>
        <?php  } else if($owner['status'] == '2') { ?>
            <button class="mui-btn mui-btn-block" style="background-color: <?php  echo $conf['color'];?>;color:white;margin:0px" onclick="modify()">重新认证</button>
        <?php  } ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-7">
                    <?php  if(($owner['status'] != '1' OR $owner['insurance_expire']=='' OR $owner['insurance_expire']<time()) && $conf['agreement_on'] == '1') { ?>
                        <div>
                            <input name="agreement_check" type="checkbox" /><span>同意<a href="javascript:show_agreement()">《<?php  echo $conf['agreement_title'];?>》</a></span>
                        </div>
                    <?php  } ?>
                </div>
                <div class="col-xs-5" style="text-align: right">
                    状态：
                    <?php  if(empty($owner)) { ?>
                        <span class="label label-default">未提交</span>
                    <?php  } else if($owner['status']=='0') { ?>
                        <span class="label label-default">待审核</span>
                    <?php  } else { ?>
                        <span class="label label-success">已审核</span>
                    <?php  } ?>
                </div>
            </div>
            <?php  if($owner['status'] == '0') { ?>
                <div style="text-align:right;color:grey"><?php  echo $note['content'];?></div>
            <?php  } ?>
        </div>
    </div>
<div id="agreement_panel" style="position: absolute;top:0px;left:0px;width:100%;height:100;padding:10px;z-index: 999;display: none">
    <div id="agreement_content" style="background-color: white;padding: 10px;overflow-y:scroll">
        <?php  echo htmlspecialchars_decode(str_replace(array("\r\n", "\r", "\n"), "", $conf['agreement_content']));?>
    </div>
    <div style="position: absolute;top:20px;right:20px;width:30px;height:30px">
        <img src="<?php  echo $_W['siteroot'];?>addons/navlange_pinche/template/style/img/close.png" width="30px" height="30px" onclick="close_agreement()" />
    </div>
</div>
<script>
var mask = mui.createMask(function(){});//callback为用户点击蒙版时自动执行的回调；
$(function(){
    var height = document.documentElement.clientHeight-20;
    $("#agreement_content").css('height',height);
})
function show_agreement() {
    mask.show();//显示遮罩
    $("#agreement_panel").show();
}
function close_agreement() {
    $("#agreement_panel").hide();
    mask.close();
}
function info_submit() {
    var agreed = $("input[name='agreement_check']:checked").val();
    if(agreed != 'on') {
        alert("请阅读协议！");
    } else {
        if($("#part_3").val() == "") {
            alert("请输入车牌号！");
            $("#part_3").focus();
        } else if ($("#car_series").val() == '') {
            alert("请输入车辆品牌型号！");
            $("#car_series").focus();
        } else if ($("#car_color").val() == '') {
            alert("请输入车辆颜色!");
            $("#car_color").focus();
        } else if ($("#name").val() == '') {
            alert("请输入姓名！");
            $("#name").focus();
        } else if ($("#tel").val() == "") {
            alert("请输入联系电话！");
            $("#tel").focus();
        } else {
            $.post("<?php  echo $this->createMobileurl('owner_info',array('op'=>'info_submit'))?>",{
                    part_1:$("#part_1").val(),
                    part_2:$("#part_2").val(),
                    part_3:$("#part_3").val(),
                    car_series:$("#car_series").val(),
                    car_color:$("#car_color").val(),
                    name:$("#name").val(),
                    tel:$("#tel").val(),
                    inviter_code: $("#inviter_code").val(),
                    vehicle_travel_license:images['vehicle_travel_license'],
                    driving_license:images['driving_license'],
                    car_img:images['car_img'],
                    insurance_img:images['insurance_img'],
                    insurance_expire: $("#insurance_expire").val()
                },function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == 0) {
                        alert("信息提交成功，请等待审核！");
                        location.href="<?php  echo $this->createMobileurl('person')?>";
                    }
                }
            );
        }
    }
}
function modify() {
    var agreed = $("input[name='agreement_check']:checked").val();
    if(agreed != 'on') {
        alert("请阅读协议！");
    } else {
        if($("#part_3").val() == "") {
            alert("请输入车牌号！");
            $("#part_3").focus();
        } else if ($("#car_series").val() == '') {
            alert("请输入车辆品牌型号！");
            $("#car_series").focus();
        } else if ($("#car_color").val() == '') {
            alert("请输入车辆颜色!");
            $("#car_color").focus();
        } else if ($("#name").val() == '') {
            alert("请输入姓名！");
            $("#name").focus();
        } else if ($("#tel").val() == "") {
            alert("请输入联系电话！");
            $("#tel").focus();
        } else {
            $.post("<?php  echo $this->createMobileurl('owner_info',array('op'=>'modify'))?>",{
                    part_1:$("#part_1").val(),
                    part_2:$("#part_2").val(),
                    part_3:$("#part_3").val(),
                    car_series:$("#car_series").val(),
                    car_color:$("#car_color").val(),
                    name:$("#name").val(),
                    tel:$("#tel").val(),
                    vehicle_travel_license:images['vehicle_travel_license'],
                    driving_license:images['driving_license'],
                    car_img:images['car_img'],
                    insurance_img:images['insurance_img'],
                    insurance_expire: $("#insurance_expire").val()
                },function(resp) {
                    resp = $.parseJSON(resp);
                    if(resp.message.errno == 0) {
                        alert("信息提交成功，请等待审核！");
                        location.href="<?php  echo $this->createMobileurl('person')?>";
                    }
                }
            );
        }
    }
}
function cancel_bind() {
    var r = confirm("解除绑定！解除后如果想再次提供拼车服务需要重新认证！");
    if(r) {
        $.post("<?php  echo $this->createMobileurl('owner_info',array('op'=>'cancel_bind'))?>",
            function(resp) {
                resp = $.parseJSON(resp);
                if(resp.message.errno == '0') {
                    alert("解除绑定成功！");
                    location.href="<?php  echo $this->createMobileurl('person')?>";
                }
            }
        );
    }
}
</script>