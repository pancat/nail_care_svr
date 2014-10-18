<div class="content">
  <div class="header">

    <h1 class="page-title">接口测试-个人信息模块</h1>
    <ul class="breadcrumb">
      <li>
        <a href="<?php echo site_url('admin/admin_dev/show_main'); ?>">主页</a>
      </li>
      <li>
        <a href="">接口测试</a>
      </li>
      <li>
        <a href="<?php echo site_url('admin/admin_dev/show_tuser'); ?>">个人信息模块</a>
      </li>
    </ul>
  </div>

  <div class="main-content">

    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#login" data-toggle="tab">登录</a>
      </li>
      <li>
        <a href="#register" data-toggle="tab">注册</a>
      </li>

      <li class="dropdown">
        <a href="#" id="user_info" class="dropdown-toggle" data-toggle="dropdown">个人信息 <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="user_info">
          <li><a href="#user_info_get" tabindex="-1" role="tab" data-toggle="tab">获取信息</a></li>
          <!--<li><a href="#user_info_update" tabindex="-1" role="tab" data-toggle="tab">修改信息</a></li>
          <li><a href="#user_info_delete" tabindex="-1" role="tab" data-toggle="tab">删除信息</a></li> -->
        </ul>
      </li>
    </ul>

    <div class="row">
      <div class="col-md-8">
        <br>
        <div id="myTabContent" class="tab-content">

          <div class="tab-pane active in" id="login">

            <div class="panel panel-default">
                <p class="panel-heading">URL</p>
                <div class="panel-body">
                  <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/user/login</pre>
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
                        <td>username</td>
                        <td>true</td>
                        <td>string[11]</td>
                        <td>合法的11位手机号码</td>
                        <td>用户登录所使用的用户名</td>
                      </tr>
                      
                      <tr>
                        <td>password</td>
                        <td>true</td>
                        <td>string[3,11]</td>
                        <td>没有特殊字符</td>
                        <td>用户登录所使用的密码</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求示例</p>
                <div class="panel-body">
                  <pre>{username:123, password:123}</pre>
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
                        <td>操作结果。{'1':成功, '101':格式验证失败，用户名或密码格式不合法,'102':用户名或密码错误</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>sessionid</td>
                        <td>string</td>
                        <td>sessionid，验证用户的凭证。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>username</td>
                        <td>string</td>
                        <td>用户名。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>nick_name</td>
                        <td>string</td>
                        <td>用户昵称。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>age</td>
                        <td>integer</td>
                        <td>年龄。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>status</td>
                        <td>integer</td>
                        <td>用户。{1：正常，0：已冻结}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>email</td>
                        <td>string</td>
                        <td>邮箱。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>level</td>
                        <td>int</td>
                        <td>用户类型。{1：普通用户}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>avatar_uri</td>
                        <td>string</td>
                        <td>头像图片地址。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>address</td>
                        <td>string</td>
                        <td>地址。</td>
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
                        <label>用户名</label>
                        <input id="login_username" type="text" value="123" class="form-control"></div>
                      <div class="form-group">
                        <label>密码</label>
                        <input id="login_password" type="text" value="123" class="form-control"></div>
                  </form>
                      <div class="btn-toolbar list-toolbar">
                        <button id="login_test" class="btn btn-primary">提交测试</button>
                    </div>
                </div>
                <div class="col-md-9">
                  <label>返回结果</label>
                  <pre id="login_result">无</pre>
                </div>
              </div>
              <div></div>
            </div>
            </div>

            </div>

          <div class="tab-pane fade" id="register">

            <div class="panel panel-default">
                <p class="panel-heading">URL</p>
                <div class="panel-body">
                  <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/user/register</pre>
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
                        <td>username</td>
                        <td>true</td>
                        <td>string[11]</td>
                        <td>合法的11位手机号码</td>
                        <td>用户登录所使用的用户名</td>
                      </tr>
                      
                      <tr>
                        <td>password</td>
                        <td>true</td>
                        <td>string[3,11]</td>
                        <td>没有特殊字符</td>
                        <td>用户登录所使用的密码</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求示例</p>
                <div class="panel-body">
                  <pre>{username:123, password:123}</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">注意事项</p>
                <div class="panel-body">
                  注册后，客户端需要重新登陆。
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
                        <td>操作结果。{'1':成功, '101':验证失败，用户名密码组合不合法,'102':用户名已注册, '103':用户注册失败，服务器或数据库故障}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>id</td>
                        <td>int</td>
                        <td>用户id。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>username</td>
                        <td>string</td>
                        <td>用户名。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>nick_name</td>
                        <td>string</td>
                        <td>用户昵称。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>age</td>
                        <td>integer</td>
                        <td>年龄。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>status</td>
                        <td>integer</td>
                        <td>用户。{1：正常，0：已冻结}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>email</td>
                        <td>string</td>
                        <td>邮箱。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>level</td>
                        <td>int</td>
                        <td>用户类型。{1：普通用户}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>avatar_uri</td>
                        <td>string</td>
                        <td>头像图片地址。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>address</td>
                        <td>string</td>
                        <td>地址。</td>
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
                        <label>用户名</label>
                        <input id="register_username" type="text" class="form-control"></div>
                      <div class="form-group">
                        <label>密码</label>
                        <input id="register_password" type="text" class="form-control"></div>
                  </form>
                      <div class="btn-toolbar list-toolbar">
                        <button id="register_test" class="btn btn-primary">提交测试</button>
                    </div>
                </div>
                <div class="col-md-9">
                  <label>返回结果</label>
                  <pre id="register_result">无</pre>
                </div>
              </div>
              <div></div>
            </div>
            </div>

            </div>
  
          <div class="tab-pane fade" id="user_info_get">

            <div class="panel panel-default">
                <p class="panel-heading">URL</p>
                <div class="panel-body">
                  <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/user/get_user_info</pre>
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
                        <td>id</td>
                        <td>true</td>
                        <td>int</td>
                        <td>数字</td>
                        <td>用户id</td>
                      </tr>
                    </tbody>
                  </table></pre>
                </div>
            </div>

            <div class="panel panel-default">
                <p class="panel-heading">请求示例</p>
                <div class="panel-body">
                  <pre>{session:e0g90g5c9nl4fbh8btub8dlc40, id:4}</pre>
                </div>
            </div>
            
            <div class="panel panel-default">
                <p class="panel-heading">注意事项</p>
                <div class="panel-body">
                  登陆后，客户端需要保存sessionid。
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
                        <td>操作结果。{'1':成功, '101':用户名身份验证失败,'102':获取用户信息失败}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>id</td>
                        <td>int</td>
                        <td>用户id。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>username</td>
                        <td>string</td>
                        <td>用户名。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>nick_name</td>
                        <td>string</td>
                        <td>用户昵称。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>age</td>
                        <td>integer</td>
                        <td>年龄。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>status</td>
                        <td>integer</td>
                        <td>用户。{1：正常，0：已冻结}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>email</td>
                        <td>string</td>
                        <td>邮箱。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>level</td>
                        <td>int</td>
                        <td>用户类型。{1：普通用户}</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>avatar_uri</td>
                        <td>string</td>
                        <td>头像图片地址。</td>
                      </tr>
                    </tbody>
                    <tbody>
                      <tr>
                        <td>address</td>
                        <td>string</td>
                        <td>地址。</td>
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
                        <input id="userinfo1_sid" type="text" value="e0g90g5c9nl4fbh8btub8dlc40" class="form-control"></div>
                      <div class="form-group">
                        <label>用户id</label>
                        <input id="userinfo1_uid" type="text" value="4" class="form-control"></div>
                  </form>
                      <div class="btn-toolbar list-toolbar">
                        <button id="userinfo1_test" class="btn btn-primary">提交测试</button>
                    </div>
                </div>
                <div class="col-md-9">
                  <label>返回结果</label>
                  <pre id="userinfo1_result">无</pre>
                </div>
              </div>
              <div></div>
            </div>
            </div>

            </div>

        </div>
      </div>
    </div>


    <div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete Confirmation</h3>
          </div>
          <div class="modal-body">

            <p class="error-text"> <i class="fa fa-warning modal-icon"></i>
              Are you sure you want to delete the user?
            </p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-danger" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>


<script src="assets/js/common/json-format.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
  $("#login_test").click(function(){
    name=$("#login_username").val();
    psd =$("#login_password").val();
    $.post("<?php echo site_url('user/login'); ?>",
    {
      username:name,
      password:psd
    },
    function(data,status){
      formated = jsonformat(data);
      $("#login_result").html(formated);
    });
  });

  $("#register_test").click(function(){
    name=$("#register_username").val();
    psd =$("#register_password").val();
    $.post("<?php echo site_url('user/register'); ?>",
    {
      username:name,
      password:psd
    },
    function(data,status){
      formated = jsonformat(data);
      $("#register_result").html(formated);
    });
  });

  $("#userinfo1_test").click(function(){
    sid=$("#userinfo1_sid").val();
    uid =$("#userinfo1_uid").val();
    $.post("<?php echo site_url('user/get_user_info'); ?>",
    {
      sessionid:sid,
      id:uid
    },
    function(data,status){
      formated = jsonformat(data);
      $("#userinfo1_result").html(formated);
    });
  });
  
});
</script>