<?php defined('IN_IA') or exit('Access Denied');?><?php 
$this->qc_template_mobile('header');
?>
<style>
a:hover {
    text-decoration: none
}
</style>
<script>
    mui('body').on('tap','a',function(){document.location.href=this.href;});  
</script>
<header class="mui-bar mui-bar-nav">
    <a class="mui-icon mui-icon-arrowleft mui-pull-left mui-plus-visble" href="javascript:history.go(-1)"></a>
    <!--a class="mui-icon mui-icon-phone mui-pull-right"></a-->
    <h1 class="mui-title">通告</h1>
</header>
<div style="height:44px"></div>
<?php  if(is_array($notice)) { foreach($notice as $index => $item) { ?>
    <div style="padding:5px 10px;<?php  if($index != 0) { ?>border-top:1px #F3F3F3 solid<?php  } ?>" onclick="location.href='<?php  echo $this->createMobileurl('notice',array('id'=>$item['id']))?>'">
        <div class="container">
            <div class="row">
                <div class="col-xs-6" style="padding:0px">
                    <span style="background-color: <?php  echo $item['color'];?>;color:white"><?php  echo $item['type'];?></span>
                </div>
                <div class="col-xs-6" style="text-align: right;padding:0px;font-size: 14px;color:grey">
                    <span><?php  echo date('Y-m-d H:i:s',$item['release_time'])?></span>
                </div>
            </div>
        </div>
        <div>
            <span><?php  echo $item['title'];?></span>
        </div>
    </div>
<?php  } } ?>