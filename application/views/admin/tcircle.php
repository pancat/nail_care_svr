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
      <!--<li class="dropdown">
        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
          <li><a href="#dropdown1" tabindex="-1" role="tab" data-toggle="tab">@fat</a></li>
          <li><a href="#dropdown2" tabindex="-1" role="tab" data-toggle="tab">@mdo</a></li>
        </ul>
      </li>
    -->
      <li class="active">
        <a href="#getcirclelist" data-toggle="tab">获取圈子列表</a>
      </li>
      <li>
        <a href="#getcircle" data-toggle="tab">获取圈子信息</a>
      </li>
      <li class="dropdown">
        <a href="#" id="circomment" class="dropdown-toggle" data-toggle="dropdown">圈子评论 <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="circomment">
          <li><a href="#getcomment" tabindex="-1" role="tab" data-toggle="tab">获取评论</a></li>
          <li><a href="#addcomment" tabindex="-1" role="tab" data-toggle="tab">添加评论</a></li>
         <!-- <li><a href="#delcomment" tabindex="-1" role="tab" data-toggle="tab">删除评论</a></li>-->
        </ul>
      </li>
    </ul>

    <div class="row">
      <div class="col-md-8">
        <br>    
        <div id="myTabContent" class="tab-content">
        
        <div class="tab-pane active in" id="getcirclelist">

            <div class="panel panel-default">
                <p class="panel-heading">URL</p>
                <div class="panel-body">
                  <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/circle/get_circle_list</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">HTTP请求方式</p>
                <div class="panel-body">
                  <pre>get</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">返回格式</p>
                <div class="panel-body">
                  <pre>json</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">是否需要登录</p>
                <div class="panel-body">
                  <pre>false</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求参数</p>
                <div class="panel-body">
                  <pre><table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>字段</th>
                        <th>必选</th>
                        <th>类型和范围</th>
                        <th>约束</th>
                        <th>说明</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                      <tr>
                        <td>offset</td>
                        <td>false</td>
                        <td>int[0,n]</td>
                        <td>数字</td>
                        <td>偏移量,默认：0</td>
                      </tr>
                      <tr>
                        <td>limit</td>
                        <td>false</td>
                        <td>int[1,n]</td>
                        <td>数字</td>
                        <td>获取圈子的数量，默认：10</td>
                      </tr>
                      <tr>
                        <td>order_by</td>
                        <td>false</td>
                        <td>string</td>
                        <td>enum['cre_date']</td>
                        <td>排序关键字，默认：'cre_date'</td>
                      </tr>
                      <tr>
                        <td>order</td>
                        <td>false</td>
                        <td>string</td>
                        <td>enum['desc','asc']</td>
                        <td>排序方式，逆序或者正序，默认：'desc'</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求示例</p>
                <div class="panel-body">
                  <pre>{}</pre>
                </div>
            </div>
            
            
            <div class="panel panel-default">
                <p class="panel-heading">返回结果</p>
                <div class="panel-body">
                  <pre><table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>字段</th>
                        <th>类型及范围</th>
                        <th>说明</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>circle_id</td>
                        <td>integer</td>
                        <td>圈子的id</td>
                      </tr>
                      <tr>
                        <td>title</td>
                        <td>string</td>
                        <td>圈子的标题</td>
                      </tr>
                      <tr>
                        <td>content</td>
                        <td>string</td>
                        <td>圈子的内容</td>
                      </tr>
                      <tr>
                        <td>cre_date</td>
                        <td>string</td>
                        <td>圈子创建的时间</td>
                      </tr>
                      <tr>
                        <td>hit</td>
                        <td>integer</td>
                        <td>点击量</td>
                      </tr>
                      <tr>
                        <td>cre_date</td>
                        <td>true</td>
                        <td>评论时间</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
              <p class="panel-heading">测试接口</p>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-5">
                    <form>
                      <div class="form-group">
                        <label>偏移量</label>
                        <input id="getcirclelist_offset" type="text" value="0" class="form-control"></div>
                      <div class="form-group">
                        <label>评论个数</label>
                        <input id="getcirclelist_limit" type="text" value="10" class="form-control"></div>
                      <div class="form-group">
                        <label>排序关键字</label>
                        <input id="getcirclelist_orderby" type="text" value="cre_date" class="form-control"></div>
                      <div class="form-group">
                        <label>排序方式</label>
                        <input id="getcirclelist_order" type="text" value="desc" class="form-control"></div>
                  </form>
                      <div class="btn-toolbar list-toolbar">
                        <button id="getcirclelist_test" class="btn btn-primary">提交测试</button>
                    </div>
                </div>
                <div class="col-md-9">
                  <label>返回结果</label>
                  <pre id="getcirclelist_result">无</pre>
                </div>
              </div>
              <div></div>
            </div>
            </div>

            </div>  

        <div class="tab-pane fade" id="addcomment">

            <div class="panel panel-default">
                <p class="panel-heading">URL</p>
                <div class="panel-body">
                  <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/user/add_comment</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">HTTP请求方式</p>
                <div class="panel-body">
                  <pre>post</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">返回格式</p>
                <div class="panel-body">
                  <pre>json</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">是否需要登录</p>
                <div class="panel-body">
                  <pre>true</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求参数</p>
                <div class="panel-body">
                  <pre><table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>字段</th>
                        <th>必选</th>
                        <th>类型和范围</th>
                        <th>约束</th>
                        <th>说明</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>sessionid</td>
                        <td>true</td>
                        <td>string</td>
                        <td>无</td>
                        <td>登陆时服务器发给客户端。</td>
                      </tr>
                      <tr>
                        <td>uid</td>
                        <td>true</td>
                        <td>int</td>
                        <td>数字</td>
                        <td>用户id</td>
                      </tr>
                      <tr>
                        <td>cid</td>
                        <td>true</td>
                        <td>int</td>
                        <td>数字</td>
                        <td>圈子id</td>
                      </tr>
                      <tr>
                        <td>comments</td>
                        <td>true</td>
                        <td>string</td>
                        <td>无</td>
                        <td>评论内容</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求示例</p>
                <div class="panel-body">
                  <pre>{sessionid:e0g90g5c9nl4fbh8btub8dlc40, uid:4, cid:1, conmments:圈子评论测试案例}</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">注意事项</p>
                <div class="panel-body">
                  登录后，客户端要保存服务器发来的sessionid。
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">返回结果</p>
                <div class="panel-body">
                  <pre><table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>字段</th>
                        <th>类型及范围</th>
                        <th>说明</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>code</td>
                        <td>string{'1', '101', '102', '103'}</td>
                        <td>操作结果。{'1':成功, '101':用户验证失败,'102':信息缺失，'103':数据库写入失败</td>
                      </tr>
                      <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>评论的id</td>
                      </tr>
                      <tr>
                        <td>uid</td>
                        <td>integer</td>
                        <td>用户id</td>
                      </tr>
                      <tr>
                        <td>cid</td>
                        <td>integer</td>
                        <td>圈子id</td>
                      </tr>
                      <tr>
                        <td>commemts</td>
                        <td>string</td>
                        <td>评论。</td>
                      </tr>
                      <tr>
                        <td>cre_date</td>
                        <td>true</td>
                        <td>评论时间</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
              <p class="panel-heading">测试接口</p>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-5">
                    <form>
                      <div class="form-group">
                        <label>sessionid</label>
                        <input id="addcomment_sessionid" type="text" value="e0g90g5c9nl4fbh8btub8dlc40" class="form-control"></div>
                      <div class="form-group">
                        <label>用户id</label>
                        <input id="addcomment_uid" type="text" value="4" class="form-control"></div>
                      <div class="form-group">
                        <label>圈子id</label>
                        <input id="addcomment_cid" type="text" value="1" class="form-control"></div>
                      <div class="form-group">
                        <label>评论内容</label>
                        <input id="addcomment_comments" type="text" value="测试" class="form-control"></div>
                  </form>
                      <div class="btn-toolbar list-toolbar">
                        <button id="addcomment_test" class="btn btn-primary">提交测试</button>
                    </div>
                </div>
                <div class="col-md-9">
                  <label>返回结果</label>
                  <pre id="addcomment_result">无</pre>
                </div>
              </div>
              <div></div>
            </div>
            </div>

            </div>

        <div class="tab-pane fade" id="getcomment">

            <div class="panel panel-default">
                <p class="panel-heading">URL</p>
                <div class="panel-body">
                  <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/circle/get_circle_comments</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">HTTP请求方式</p>
                <div class="panel-body">
                  <pre>get</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">返回格式</p>
                <div class="panel-body">
                  <pre>json</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">是否需要登录</p>
                <div class="panel-body">
                  <pre>false</pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求参数</p>
                <div class="panel-body">
                  <pre><table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>字段</th>
                        <th>必选</th>
                        <th>类型和范围</th>
                        <th>约束</th>
                        <th>说明</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>circle_id</td>
                        <td>true</td>
                        <td>int</td>
                        <td>无</td>
                        <td>圈子id</td>
                      </tr>
                      <tr>
                        <td>offset</td>
                        <td>false</td>
                        <td>int[0,n]</td>
                        <td>数字</td>
                        <td>偏移量,默认：0</td>
                      </tr>
                      <tr>
                        <td>limit</td>
                        <td>false</td>
                        <td>int[1,n]</td>
                        <td>数字</td>
                        <td>获取评论的数量，默认：10</td>
                      </tr>
                      <tr>
                        <td>order_by</td>
                        <td>false</td>
                        <td>string</td>
                        <td>enum['cre_date']</td>
                        <td>排序关键字，默认：'cre_date'</td>
                      </tr>
                      <tr>
                        <td>order</td>
                        <td>false</td>
                        <td>string</td>
                        <td>enum['desc','asc']</td>
                        <td>排序方式，逆序或者正序，默认：'desc'</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求示例</p>
                <div class="panel-body">
                  <pre>{sessionid:e0g90g5c9nl4fbh8btub8dlc40, uid:4, cid:1, conmments:圈子评论测试案例}</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">注意事项</p>
                <div class="panel-body">
                  登录后，客户端要保存服务器发来的sessionid。
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">返回结果</p>
                <div class="panel-body">
                  <pre><table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>字段</th>
                        <th>类型及范围</th>
                        <th>说明</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>code</td>
                        <td>string{'1', '101', '102', '103'}</td>
                        <td>操作结果。{'1':成功, '101':用户验证失败,'102':信息缺失，'103':数据库写入失败</td>
                      </tr>
                      <tr>
                        <td>id</td>
                        <td>integer</td>
                        <td>评论的id</td>
                      </tr>
                      <tr>
                        <td>uid</td>
                        <td>integer</td>
                        <td>用户id</td>
                      </tr>
                      <tr>
                        <td>cid</td>
                        <td>integer</td>
                        <td>圈子id</td>
                      </tr>
                      <tr>
                        <td>commemts</td>
                        <td>string</td>
                        <td>评论。</td>
                      </tr>
                      <tr>
                        <td>cre_date</td>
                        <td>true</td>
                        <td>评论时间</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
              <p class="panel-heading">测试接口</p>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-5">
                    <form>
                      <div class="form-group">
                        <label>圈子id</label>
                        <input id="getcomment_cid" type="text" value="1" class="form-control"></div>
                      <div class="form-group">
                        <label>偏移量</label>
                        <input id="getcomment_offset" type="text" value="0" class="form-control"></div>
                      <div class="form-group">
                        <label>评论个数</label>
                        <input id="getcomment_limit" type="text" value="10" class="form-control"></div>
                      <div class="form-group">
                        <label>排序关键字</label>
                        <input id="getcomment_orderby" type="text" value="cre_date" class="form-control"></div>
                      <div class="form-group">
                        <label>排序方式</label>
                        <input id="getcomment_order" type="text" value="desc" class="form-control"></div>
                  </form>
                      <div class="btn-toolbar list-toolbar">
                        <button id="getcomment_test" class="btn btn-primary">提交测试</button>
                    </div>
                </div>
                <div class="col-md-9">
                  <label>返回结果</label>
                  <pre id="getcomment_result">无</pre>
                </div>
              </div>
              <div></div>
            </div>
            </div>
            

          </div>
          </div>
            
            <div class="back-to-top pull-right">
              <a href="<?php echo site_url('admin/admin_dev/show_tcircle'); ?>#top">
                回到顶部
              </a>
            </div>

        </div>

      </div>
    </div>



<script src="assets/js/common/json-format.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
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
});
</script>