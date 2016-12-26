<div class="col-lg-8 col-lg-offset-2">

    <h2><?php echo $title ?></h2>

    <hr>

    <?php if (!isset($on_hold_message)) {

        if (isset($login_error_mesg)) { ?>

            <div class="alert alert-danger">
                <p><strong>Login Error, Invalid Username, Email Address, or Password.</strong></p>
                <p>Attemps : <?php echo $this->authentication->login_errors_count ?>
                    / <?php echo config_item('max_allowed_attempts') ?></p>
                <p>
                    Username, email address and password are all case sensitive.
                </p>
            </div>

        <?php }

        echo form_open($login_url, ['class' => 'form-horizontal']) ?>
        <div class="form-group">
            <label for="login_string" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="login_string" id="login_string" autocomplete="off" maxlength="255"
                       class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="login_pass" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="login_pass" id="login_pass">
            </div>
        </div>

        <?php if (config_item('allow_remember_me')) { ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Remember me
                        </label>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-block btn-sm">Sign in</button>
            </div>
        </div>
        </form>

    <?php } else { ?>
        <div class="alert alert-danger">
            <p><strong>Excessive Login Attempts </strong></p>

            <p> You have exceeded the maximum number of failed login attempts that this website will allow.</p>

            <p> Your access to login and account recovery has been blocked
                for <?php echo((int)config_item('seconds_on_hold') / 60) ?> minutes. </p>

            <p> Please use the <a href="<?php echo base_url(); ?>auth/recover">Account Recovery</a>
                after <?php echo((int)config_item('seconds_on_hold') / 60) ?> minutes has passed,
                or contact us if you require assistance gaining access to your account.
            </p>
        </div>
    <?php } ?>
    <hr>
    Doesn't have an account ? Register <a href="<?php echo base_url(); ?>register">here</a>
    <div class="pull-right">
        <a href="<?php echo base_url(); ?>recover">Forgot Password</a>
    </div>
</div>