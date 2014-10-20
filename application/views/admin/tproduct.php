<div class="content">
  <div class="header">

    <h1 class="page-title">接口测试-产品模块</h1>
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo site_url('admin/admin_dev/show_main'); ?>">主页</a>
      </li>
      <li>
        <a href="">接口测试</a>
      </li>
      <li>
        <a href="<?php echo site_url('admin/admin_dev/show_tproduct'); ?>">产品模块</a>
      </li>
    </ul>
  </div>

  <div class="main-content">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#getproductadvs" data-toggle="tab">获取主页产品广告</a>
      </li>
      <li>
        <a href="#getproductlist" data-toggle="tab">获取产品列表</a>
      </li>
      <li>
        <a href="#getproduct" data-toggle="tab">获取产品信息</a>
      </li>
      <li>
        <a href="#getimage" data-toggle="tab">获取产品图片</a>
      </li>
      <li>
        <a href="#getlabel" data-toggle="tab">获取所有标签</a>
      </li>
      <li class="dropdown">
        <a href="#" id="prosearch" class="dropdown-toggle" data-toggle="dropdown">
          产品搜索
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="prosearch">
          <li>
            <a href="#search" tabindex="-1" role="tab" data-toggle="tab">描述+多标签搜索</a>
          </li>
          
          <!-- <li>
          <a href="#delcomment" tabindex="-1" role="tab" data-toggle="tab">删除评论</a>
        </li>
        -->
      </ul>
    </li>
  </ul>

  <div class="row">
    <div class="col-md-8">
      <br>
      <div id="myTabContent" class="tab-content">

        <?php echo $this->load->view('admin/tproduct_getproductadvs'); ?>
        <?php echo $this->load->view('admin/tproduct_getproductlist'); ?>
        <?php echo $this->load->view('admin/tproduct_getproduct'); ?>
        <?php echo $this->load->view('admin/tproduct_getimage'); ?>
        <?php echo $this->load->view('admin/tproduct_getlabel'); ?>
        <?php echo $this->load->view('admin/tproduct_search'); ?>

      </div>

    </div>

  </div>
</div>

<script src="assets/js/common/json-format.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
  $("#getproductadvs_test").click(function(){ 
    $.get("<?php echo site_url('product/get_home_ad_list'); ?>",
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getproductadvs_result").html(formated);
    });
  });

  $("#getproductlist_test").click(function(){ 
    offset=$("#getproductlist_offset").val();
    limit =$("#getproductlist_limit").val();
    orderby =$("#getproductlist_orderby").val();
    order =$("#getproductlist_order").val();
    $.get("<?php echo site_url('product/get_product_list'); ?>"+"/"+offset+"/"+limit+"/"+orderby+"/"+order,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getproductlist_result").html(formated);
    });
  });

  $("#getproduct_test").click(function(){ 
    product_id=$("#getproduct_pid").val();
    $.get("<?php echo site_url('product/get_product_info'); ?>"+"/"+product_id,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getproduct_result").html(formated);
    });
  });

   $("#getimage_test").click(function(){ 
    product_id=$("#getimage_pid").val();
    $.get("<?php echo site_url('product/get_product_images'); ?>"+"/"+product_id,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getimage_result").html(formated);
    });
  });

   $("#getlabel_test").click(function(){ 
    $.get("<?php echo site_url('product/get_all_labels'); ?>",
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getlabel_result").html(formated);
    });
  });

   $("#search_test").click(function(){
    like =$("#search_like").val();
    labels =$("#search_labels").val(); 
    $.post("<?php echo site_url('product/search'); ?>",
    {
      like:like,
      labels:labels
    },
    function(data, status){
      formated = jsonformat(data);
      $("#search_result").html(formated);
    });
  });




});
</script>