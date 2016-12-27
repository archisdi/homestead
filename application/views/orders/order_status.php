<br>

<?php if (isset($success)) { ?>

    <div class="alert alert-success">
        <?php echo $success ?>
    </div>

<?php } elseif (isset($fail)) { ?>

    <div class="alert alert-danger">
        <?php echo $fail ?>
    </div>

<?php } ?>
