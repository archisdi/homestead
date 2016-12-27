<h2><?php echo $title ?></h2>

<p>Homestead, your Real Estate Companion</p>

<?php if (isset($auth_user_id)) { ?>
<p>You're logged in as <?php echo $auth_username?></p>
<?php } ?>
