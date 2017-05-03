 <div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
        <h1 class="logo-name">CI+</h1>
        </div>
        <h3><?php echo lang('login_heading');?></h3>
        <p><?php echo lang('login_subheading');?></p>
        <p id="infoMessage"><?php echo $message;?></p>

        <?php echo form_open("login", array('class' => 'm-t', 'role' => 'form'));?>

        <div class="form-group">
            <?php echo form_input($identity, 'admin@admin.com', 'class="form-control" placeholder="'.lang('login_identity_label').'"');?>
        </div>

        <div class="form-group">
            <?php echo form_input($password, 'password', 'class="form-control" placeholder="'.lang('login_password_label').'"');?>
        </div>

        <div class="checkbox m-r-xs">
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
            <?php echo lang('login_remember_label', 'remember');?>
        </div>
        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary block full-width m-b"');?>

        <?php echo form_close();?>

        <a href="auth/forgot_password"><small><?php echo lang('login_forgot_password');?></small></a>
        <p class="m-t"> <small><strong>{company_name}</strong> &copy; {app_year}</small> </p>
    </div>
</div>