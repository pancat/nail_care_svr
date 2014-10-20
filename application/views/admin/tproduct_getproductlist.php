<div class="tab-pane active in" id="getproductlist">

  <div class="panel panel-default">
    <p class="panel-heading">URL</p>
    <div class="panel-body">
      <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/product/get_product_list</pre>
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
                        <td>获取产品的数量，默认：10</td>
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
                        <td>product_id</td>
                        <td>integer</td>
                        <td>产品的id</td>
                      </tr>
                      <tr>
                        <td>name</td>
                        <td>string</td>
                        <td>产品的名称</td>
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
                      <tr>
                        <td>cre_date</td>
                        <td>string</td>
                        <td>评论时间</td>
                      </tr>
                      <tr>
                        <td>hit</td>
                        <td>integer</td>
                        <td>点击量</td>
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
              <label>偏移量</label>
              <input id="getproductlist_offset" type="text" value="0" class="form-control"></div>
            <div class="form-group">
              <label>评论个数</label>
              <input id="getproductlist_limit" type="text" value="10" class="form-control"></div>
            <div class="form-group">
              <label>排序关键字</label>
              <input id="getproductlist_orderby" type="text" value="cre_date" class="form-control"></div>
            <div class="form-group">
              <label>排序方式</label>
              <input id="getproductlist_order" type="text" value="desc" class="form-control"></div>
          </form>
          <div class="btn-toolbar list-toolbar">
            <button id="getproductlist_test" class="btn btn-primary">提交测试</button>
          </div>
        </div>
        <div class="col-md-9">
          <label>返回结果</label>
          <pre id="getproductlist_result">无</pre>
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