<div class="col-lg-8 col-lg-offset-2">

    <h2>Account Recovery - Change Password</h2>
    <hr>
    <?php

    $showform = 1;

    if (isset($validation_errors)) { ?>
        <div class="alert alert-danger">
            <p>
                The following error occurred while changing your password:
            </p>
            <ul>
                <?php echo $validation_errors ?>
            </ul>
            <p>
                PASSWORD NOT UPDATED
            </p>
        </div>
    <?php } else {

        $display_instructions = 1;
    }

    if (isset($validation_passed)) { ?>

        <div class="alert alert-success">
            <p>
                You have successfully changed your password.
            </p>
            <p>
                You can now <a class="text-primary" href="<?php echo base_url(); ?>login">login</a>
            </p>
        </div>

        <?php
        $showform = 0;
    }
    if (isset($recovery_error)) { ?>

        <div class="alert alert-danger">
            <p>
                No usable data for account recovery.
            </p>
            <p>
                Account recovery links expire after
                <?php echo((int)config_item('recovery_code_expiration') / (60 * 60)) ?>
                hours.<br/>You will need to use the
                <a href="<?php echo base_url(); ?>recover">Account Recovery</a> form
                to send yourself a new link.
            </p>
        </div>

        <?php $showform = 0;
    }

    if (isset($disabled)) { ?>

        <div class="alert alert-danger">
            <p>
                Account recovery is disabled.
            </p>
            <p>
                You have exceeded the maximum login attempts or exceeded the
                allowed number of password recovery attempts.
                Please wait <?php echo((int)config_item('seconds_on_hold') / 60) ?>
                minutes, or contact us if you require assistance gaining access to your account.
            </p>
        </div>
        <?php

        $showform = 0;
    }
    if ($showform == 1) {
        if (isset($recovery_code, $user_id)) {
            if (isset($display_instructions)) {
                if (isset($username)) { ?>
                    <p>
                    <div class="alert alert-success">
                        Your login user name is <i><?php echo $username ?></i><br/>
                        Please write this down, and change your password now
                    </div>
                    </p>
                <?php } else { ?>
                    <div class="alert alert-success">
                        <p>Please change your password now</p>
                    </div>
                    <?php
                }
            }
            ?>
            <div id="form">
                <?php echo form_open(null, ['class' => 'form-horizontal']) ?>

                <div class="form-group">
                    <label for="passwd" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="passwd" id="passwd">
                    </div>
                </div>

                <div class="form-group">
                    <label for="passwd_confirm" class="col-sm-2 control-label">Confirm</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success btn-block btn-sm">Change Password</button>
                    </div>
                </div>

                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
