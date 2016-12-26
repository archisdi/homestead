<html>
<head>
    <title> Homestead </title>
    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="icon" href="<?php echo base_url(); ?>favicon.png">

    <!--    <script src="http://cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>-->
</head>

<body>
<nav class="nav navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Homestead</a>
        </div>
        <div id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>about">About</a></li>
                    <li><a href="<?php echo base_url(); ?>properties">Properties</a></li>
                </ul>

            <?php if (isset($auth_user_id)) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url(); ?>auth/logout">Logout</a></li>
                </ul>
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url(); ?>login?redirect=/">Login</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>

<div class="container">
