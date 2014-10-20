<div class="tab-pane fade" id="getcircle">

        <div class="panel panel-default">
          <p class="panel-heading">URL</p>
          <div class="panel-body">
            <pre>http://ec2-54-169-66-69.ap-southeast-1.compute.amazonaws.com/nail_care_svr/index.php/circle/get_circle_info</pre>
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
                    </tbody>
                  </table></pre>
          </div>
        </div>

        <div class="panel panel-default">
          <p class="panel-heading">请求示例</p>
          <div class="panel-body">
            <pre>{circle_id:1}</pre>
          </div>
        </div>

        <div class="panel panel-default">
          <p class="panel-heading">注意事项</p>
          <div class="panel-body">无</div>
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
                    <input id="getcircle_cid" type="text" value="1" class="form-control"></div>
                </form>
                <div class="btn-toolbar list-toolbar">
                  <button id="getcircle_test" class="btn btn-primary">提交测试</button>
                </div>
              </div>
              <div class="col-md-9">
                <label>返回结果</label>
                <pre id="getcircle_result">无</pre>
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