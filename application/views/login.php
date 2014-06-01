<?php $this->load->view('layout/header_head'); ?>
<?php $this->load->view('layout/header_body_blank'); ?>

<div class="col-lg-4 col-lg-offset-4">
    <div class="login-panel panel panel-default text-center">
        <?php if (isset($_GET['message']) && $_GET['message'] === 'bad') : ?>
            <div class="alert alert-danger">
                <?php echo lang('Bad username or password, please try again.'); ?>
            </div>
        <?php endif; ?>
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo lang('Welcome to') ?> LiHoCoS</h3>
        </div>
        <div class="panel-body">
            <form id="login" role="form" action="<?php echo base_url('auth/process'); ?>" method="post" name="process">
                <input name="from" type="hidden" value="<?php if (isset($_GET['from'])) echo $_GET['from']; ?>">
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="<?php echo lang('E-Mail or Username'); ?>" name="emailOrUsername" type="text" autofocus="true">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="<?php echo lang('Password'); ?>" name="password" type="password" value="">
                    </div>
                    <!--<div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>-->
                    <button href="index.html" class="btn btn-lg btn-success btn-block"><?php echo lang('Login'); ?></button>
                </fieldset>
            </form>
        </div>
        <?php if (is_demo()) : ?>
            <div class="panel-footer">
                You can login with<br />
                Username: <code>admin</code><br />
                Password: <code>admin</code>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>

    $(document).ready(function() {

        if (GetUrlParameter('message') === 'bad')
            $('.login-panel').effect('shake', {times: 3});

    });

</script>

<?php $this->load->view('layout/footer_blank'); ?>
<?php $this->load->view('layout/footer_footer'); ?>