<div class="tab-pane fade" id="search">

  <div class="panel panel-default">
    <p class="panel-heading">URL</p>
    <div class="panel-body">
      <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/product/search</pre>
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
                        <td>like</td>
                        <td>false</td>
                        <td>string</td>
                        <td>无</td>
                        <td>查询关键字</td>
                      </tr>
                      
                      <tr>
                        <td>labels</td>
                        <td>false</td>
                        <td>string</td>
                        <td>样例："1_2_3_5"</td>
                        <td>以'_'连接起来的标签的id</td>
                      </tr>
                    </tbody>
                  </table></pre>
    </div>
  </div>

  <div class="panel panel-default">
    <p class="panel-heading">请求示例</p>
    <div class="panel-body">
      <pre>{like:"彩妆", labels:"1_2_3_5"}</pre>
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
                        <td>产品id</td>
                      </tr>
                      <tr>
                        <td>name</td>
                        <td>string</td>
                        <td>产品名称</td>
                      </tr>
                      <tr>
                        <td>describe</td>
                        <td>string</td>
                        <td>产品描述</td>
                      </tr>
                      <tr>
                        <td>cre_date</td>
                        <td>string</td>
                        <td>产品创建时间</td>
                      </tr>
                      <tr>
                        <td>hit</td>
                        <td>integer</td>
                        <td>未定义（支持人数，喜爱人数等）</td>
                      </tr>
                      <tr>
                        <td>nick_name</td>
                        <td>string</td>
                        <td>美甲师昵称</td>
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
              <label>查询关键字</label>
              <input id="search_like" type="text" value="彩妆" class="form-control"></div>
            <div class="form-group">
              <label>标签id</label>
              <input id="search_labels" type="text" value="1_2_3_5" class="form-control"></div>
          </form>
          <div class="btn-toolbar list-toolbar">
            <button id="search_test" class="btn btn-primary">提交测试</button>
          </div>
        </div>
        <div class="col-md-9">
          <label>返回结果</label>
          <pre id="search_result">无</pre>
        </div>
      </div>
      
    </div>
  </div>
  <div class="back-to-top pull-right">
      <a href="<?php echo site_url('admin/admin_dev/show_tproduct'); ?>#top">
                      回到顶部
      </a>
  </div>
</div>