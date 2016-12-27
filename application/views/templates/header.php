<html>
<head>
    <title> Homestead </title>
    <link rel="stylesheet" href="https://bootswatch.com/flatly/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="icon" href="<?php echo base_url('favicon.png'); ?>">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>

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
                <li><a href="<?php echo base_url('about'); ?>">About</a></li>
                <?php if (isset($auth_user_id)) { ?>
                    <?php if ($auth_role == 'admin') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">Properties <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('/properties'); ?>">List</a></li>
                                <li><a href="<?php echo base_url('/properties/create'); ?>">Create</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url(); ?>properties">Properties</a></li>
                    <?php }
                } else { ?>
                    <li><a href="<?php echo base_url(); ?>properties">Properties</a></li>
                <?php } ?>

            </ul>

            <?php if (isset($auth_user_id)) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($auth_role == 'admin') { ?>
                        <li><a href="<?php echo base_url('orders'); ?>">Orders</a></li>
                    <?php } ?>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><?php echo $auth_username ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if ($auth_role == 'customer') { ?>
<!--                                <li><a href="#">Profile</a></li>-->
                                <li><a href="<?php echo base_url('orders'); ?>">My Orders</a></li>
                                <li role="separator" class="divider"></li>
                            <?php } ?>

                            <li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('login?redirect=/'); ?>">Login</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>

<div class="container">
