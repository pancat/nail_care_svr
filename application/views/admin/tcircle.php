<div class="content">
  <div class="header">

    <h1 class="page-title">接口测试-圈子模块</h1>
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo site_url('admin/admin_dev/show_main'); ?>">主页</a>
      </li>
      <li>
        <a href="">接口测试</a>
      </li>
      <li>
        <a href="<?php echo site_url('admin/admin_dev/show_tcircle'); ?>">圈子模块</a>
      </li>
    </ul>
  </div>

  <div class="main-content">
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#getcirclelist" data-toggle="tab">获取圈子列表</a>
      </li>
      <li>
        <a href="#getcircle" data-toggle="tab">获取圈子信息</a>
      </li>
      <li>
        <a href="#getimage" data-toggle="tab">获取圈子图片</a>
      </li> 
      <li>
        <a href="#addcircle" data-toggle="tab">添加圈子</a>
      </li>
     <!--<li>
        <a href="#addimage" data-toggle="tab">添加圈子图片</a>
      </li>-->
      <li class="dropdown">
        <a href="#" id="circomment" class="dropdown-toggle" data-toggle="dropdown">
          圈子评论
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="circomment">
          <li>
            <a href="#getcomment" tabindex="-1" role="tab" data-toggle="tab">获取评论</a>
          </li>
          <li>
            <a href="#addcomment" tabindex="-1" role="tab" data-toggle="tab">添加评论</a>
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

        <?php echo $this->
        load->view('admin/tcircle_getcirclelist'); ?>
        <?php echo $this->
        load->view('admin/tcircle_getcircle'); ?>
        <?php echo $this->load->view('admin/tcircle_getimage'); ?>
        <?php echo $this->load->view('admin/tcircle_addcircle'); ?>
        <?php //echo $this->load->view('admin/tcircle_addimage'); ?>
        <?php echo $this->
        load->view('admin/tcircle_getcomment'); ?>
        <?php echo $this->
        load->view('admin/tcircle_addcomment'); ?>
      </div>

    </div>

  </div>
</div>

<script src="assets/js/common/json-format.js" type="text/javascript"></script>
<script>
$(document).ready(function(){

  $("#addcircle_test").click(function(){
    sessionid=$("#addcircle_sessionid").val(); 
    id=$("#addcircle_uid").val();
    cid =$("#addcircle_title").val();
    content =$("#addcircle_content").val();
    // uploadfile =$("#addcircle_uploadfile").val();
    $.post("<?php echo site_url('user/add_circle'); ?>",
    {
      sessionid:sessionid,
      id:id,
      title:title,
      content:content
      // uploadfile:uploadfile
    },
    function(data,status){
      // formated = jsonformat(data);
      $("#addcircle_result").html(data);
    });
  });

  $("#addcomment_test").click(function(){
    sessionid=$("#addcomment_sessionid").val(); 
    uid=$("#addcomment_uid").val();
    cid =$("#addcomment_cid").val();
    comments =$("#addcomment_comments").val();
    $.post("<?php echo site_url('user/add_comment'); ?>",
    {
      sessionid:sessionid,
      uid:uid,
      cid:cid,
      comments:comments
    },
    function(data,status){
      formated = jsonformat(data);
      $("#addcomment_result").html(formated);
    });
  });

  $("#getcomment_test").click(function(){
    cid=$("#getcomment_cid").val(); 
    offset=$("#getcomment_offset").val();
    limit =$("#getcomment_limit").val();
    orderby =$("#getcomment_orderby").val();
    order =$("#getcomment_order").val();
    $.get("<?php echo site_url('circle/get_circle_comments'); ?>"+"/"+cid+"/"+offset+"/"+limit+"/"+orderby+"/"+order,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getcomment_result").html(formated);
    });
  });


  $("#getcirclelist_test").click(function(){ 
    offset=$("#getcirclelist_offset").val();
    limit =$("#getcirclelist_limit").val();
    orderby =$("#getcirclelist_orderby").val();
    order =$("#getcirclelist_order").val();
    $.get("<?php echo site_url('circle/get_circle_list'); ?>"+"/"+offset+"/"+limit+"/"+orderby+"/"+order,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getcirclelist_result").html(formated);
    });
  });

  $("#getcircle_test").click(function(){ 
    circle_id=$("#getcircle_cid").val();
    $.get("<?php echo site_url('circle/get_circle_info'); ?>"+"/"+circle_id,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getcircle_result").html(formated);
    });
  });

  $("#getimage_test").click(function(){ 
    circle_id=$("#getimage_cid").val();
    $.get("<?php echo site_url('circle/get_circle_images'); ?>"+"/"+circle_id,
    {},
    function(data, status){
      formated = jsonformat(data);
      $("#getimage_result").html(formated);
    });
  });


});
</script>