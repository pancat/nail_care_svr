<div class="tab-pane active in" id="getproductadvs">

  <div class="panel panel-default">
    <p class="panel-heading">URL</p>
    <div class="panel-body">
      <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/product/get_home_ad_list</pre>
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
      <pre>无</pre>
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
                        <td>p_id</td>
                        <td>integer</td>
                        <td>产品的id</td>
                      </tr>
                      <tr>
                        <td>p_describe</td>
                        <td>string</td>
                        <td>产品的描述</td>
                      </tr>
                      <tr>
                        <td>image_uri</td>
                        <td>string</td>
                        <td>产品的封面缩略图</td>
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
          <div class="btn-toolbar list-toolbar">
            <button id="getproductadvs_test" class="btn btn-primary">提交测试</button>
          </div>
        </div>
        <div class="col-md-9">
          <label>返回结果</label>
          <pre id="getproductadvs_result">无</pre>
        </div>
      </div>
      <div></div>
    </div>
  </div>
  <div class="back-to-top pull-right">
    <a href="<?php echo site_url('admin/admin_dev/show_tproduct'); ?>#top">
                    回到顶部
    </a>
  </div>
</div>