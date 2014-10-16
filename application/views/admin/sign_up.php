
    


        <div class="dialog">
    <div class="panel panel-default">
        <div class="panel-heading no-collapse">
            <h3 class="panel-title">注册</h3>
        </div>
        <div class="panel-body">
            <form  name="register" action="<?php echo site_url('admin/admin_dev/register'); ?>" method="post">
                <?php if(isset($error)) {  ?>
                <div class="alert">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>警告!</strong> <?php echo ' '.$error; ?>
                </div>
                <?php } ?>
                <div class="form-group">
                    <label>用户名*</label>
                    <input name="username" type="text" class="form-control span12" required>
                </div>
                <div class="form-group">
                    <label>密码*</label>
                    <input name="psd" type="password" class="form-control span12" required>
                </div>
                <div class="form-group">
                    <label>昵称</label>
                    <input name="nickname" type="text" class="form-control span12">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control span12">
                </div>
                <div class="form-group">
                    <a onclick="JavaScript:document.register.submit();" class="btn btn-primary pull-right">
                        注册!
                    </a>
                    <label class="remember-me"><input type="checkbox"> I agree with the <a href="terms-and-conditions.html">Terms and Conditions</a></label>
                </div>
                    <div class="clearfix"></div>
            </form>
        </div>
        <div class="panel-footer text-right"> 
            <a href="#">登陆</a>
        </div>
    </div>
  <!--  <p><a href="privacy-policy.html" style="font-size: .75em; margin-top: .25em;">Privacy Policy</a></p>-->
</div>



    <script src="aircraft/lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>

  
</body></html>