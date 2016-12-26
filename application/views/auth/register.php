<div class="col-lg-8 col-lg-offset-2">

    <h2><?php echo $title ?></h2>

    <hr>

    <?php if (isset($errors)) { ?>

        <div class="alert alert-danger">
            <p><strong>Registration Fail.</strong></p>
            <?php echo $errors ?>
        </div>

    <?php } elseif (isset($success)) { ?>

        <div class="alert alert-success">
            <p><strong><?php echo $success ?></strong></p>
        </div>

    <?php
    }

    echo form_open('register', ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
            <input type="text" name="username" id="username" autocomplete="off" maxlength="255"
                   class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="password">
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="email">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success btn-block btn-sm">Sign up</button>
        </div>
    </div>

    </form>
    <hr>
    Already have an account ? Login <a href="<?php echo base_url(); ?>login">here</a>
</div>