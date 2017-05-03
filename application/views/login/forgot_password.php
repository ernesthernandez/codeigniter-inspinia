<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h2 class="font-bold"><?php echo lang('forgot_password_heading');?></h2>
                <p>
                   <?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?>
                </p>
                <p id="infoMessage">
                    <?php echo $message;?>
                </p>

                <div class="row">

                    <div class="col-lg-12">

                        <?php echo form_open("auth/forgot_password", array('class' => 'm-t', 'role' => 'form'));?>

                            <div class="form-group">
                                <?php echo form_input($identity, NULL, 'class="form-control" placeholder="'.(($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)).'"');?>
                            </div>

                            <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary block full-width m-b"');?></p>
                        <?php echo form_close();?>
                            <p><a type="button" href="{referer_url}" class="btn btn-default block full-width m-b"><?php echo lang('login_heading');?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-6">
            <strong>{company_name}</strong>
        </div>
        <div class="col-md-6 text-right">
           &copy;  <small>{app_year}</small>
        </div>
    </div>
</div>