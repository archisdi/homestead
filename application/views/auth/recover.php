<div class="col-lg-8 col-lg-offset-2">

    <h2>Recover Account</h2>

    <hr>

    <?php if (isset($disabled)) { ?>

        <div class="alert alert-danger">
            <p>
                Account Recovery is Disabled.
            </p>
            <p>
                If you have exceeded the maximum login attempts, or exceeded
                the allowed number of password recovery attempts, account recovery
                will be disabled for a short period of time.
                Please wait ' . ( (int) config_item('seconds_on_hold') / 60 ) . '
                minutes, or contact us if you require assistance gaining access to your account.
            </p>
        </div>

    <?php } else if (isset($banned)) { ?>

        <div class="alert alert-danger">
            <p>
                Account Locked.
            </p>
            <p>
                You have attempted to use the password recovery system using
                an email address that belongs to an account that has been
                purposely denied access to the authenticated areas of this website.
                If you feel this is an error, you may contact us
                to make an inquiry regarding the status of the account.
            </p>
        </div>

    <?php } else if (isset($confirmation)) { ?>
        <div class="alert alert-success">
            <p>
                <strong>We have sent you an email with recovery link , please check your email.</strong>
            </p>
        </div>

    <?php } else if (isset($no_match)) { ?>

        <div class="alert alert-warning">
            <p class="feedback_header">
                Supplied email did not match any record.
            </p>
        </div>

        <?php $show_form = 1;

    } else { ?>

        <div class="alert alert-success">
            If you've forgotten your password and/or username,
            enter the email address used for your account,
            and we will send you an e-mail
            with instructions on how to access your account.
        </div>
        <?php $show_form = 1;
    } ?>

    <?php if (isset($show_form)) {

        echo form_open(null, ['class' => 'form-horizontal']); ?>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-block btn-sm">Send Email</button>
            </div>
        </div>

        </form>

    <?php } ?>
</div>