
    


        <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">登陆</p>
        <div class="panel-body" >
            <form name="login" action="<?php echo site_url('admin/admin_dev/login')?>" method="post">
                <?php if(isset($info)) {  ?>
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>恭喜!</strong> <?php echo ' '.$info; ?>
                </div>
                <?php } ?>
                <?php if(isset($error)) {  ?>
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>警告!</strong> <?php echo ' '.$error; ?>
                </div>
                <?php } ?>

                <div class="form-group">
                    <label>用户名</label>
                    <input name="username" type="text" class="form-control span12">
                </div>
                <div class="form-group">
                <label>密码</label>
                    <input name="psd" type="password" class="form-controlspan12 form-control">
                </div>
                    <a onclick="JavaScript:document.login.submit();" class="btn btn-primary pull-right"> 登陆</a>
                <label class="remember-me"><input type="checkbox"> Remember me</label>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <!-- <p class="pull-right" style=""><a href="http://www.portnine.com" target="blank" style="font-size: .75em; margin-top: .25em;">Design by Portnine</a></p>-->
    <p><a href="reset-password.html">Forgot your password?</a></p>
</div>



    <script src="aircraft/lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
</body></html>
