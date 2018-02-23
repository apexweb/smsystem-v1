<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'SMS Screen Management System';
?>


<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SMS Screen Management System | Security Screen Calculator">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="/sscalc/assets/images/favicon_1.ico">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>

    <?= $this->element('Layout/cssfiles') ?>

    <?= $this->fetch('css') ?>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?= $this->Html->script('/assets/js/modernizr.min.js') ?>

</head>

<body class="fixed-left-void widescreen">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?= $this->Html->link('<i class="md-local-parking icon-c-logo"></i><span>SMS', '/', ['class' => 'logo navbar-brand', 'escape' => false]) ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse " aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav custom-nav">
			<li><?= $this->Html->link('<span> Login </span>', ['controller' => 'users', 'action' => 'login'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
			<li><?= $this->Html->link('<span> Register </span>', ['controller' => 'users', 'action' => 'register'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tech Assistance</a>
                <ul class="dropdown-menu">
                    <li><?= $this->Html->link('<span> Door Configurations </span>', ['controller' => 'pages', 'action' => 'door-configurations'], ['class' => 'waves-effect', 'escape' => false, 'style' => 'color:#fff;', 'target' => '_blank']) ?></li>
                    <li><?= $this->Html->link('<span> Additional Sections </span>', ['controller' => 'pages', 'action' => 'additional-sections'], ['class' => 'waves-effect', 'escape' => false, 'style' => 'color:#fff;', 'target' => '_blank']) ?></li>
                </ul>
            </li>
            <li><?= $this->Html->link('<span> About </span>', ['controller' => '/', 'action' => '/'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
		  </ul>
		</div>
	  </div>
	</nav>
    <div class="topbar" style="display:none;">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <?= $this->Html->link('<i class="md-local-parking icon-c-logo"></i><span>SMS', '/', ['class' => 'logo', 'escape' => false]) ?>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="pull-left">
                    <div class="custom-nav  hidden-sm hidden-xs">
                        <ul>
                            <li><?= $this->Html->link('<span> Login </span>', ['controller' => 'users', 'action' => 'login'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                            <li><?= $this->Html->link('<span> Register </span>', ['controller' => 'users', 'action' => 'register'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                            <li style="width:145px;" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tech Assistance</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> Door Configurations </span>', ['controller' => 'pages', 'action' => 'door-configurations'], ['class' => 'waves-effect', 'escape' => false, 'style' => 'color:#fff;', 'target' => '_blank']) ?></li>
                                    <li><?= $this->Html->link('<span> Additional Sections </span>', ['controller' => 'pages', 'action' => 'additional-sections'], ['class' => 'waves-effect', 'escape' => false, 'style' => 'color:#fff;', 'target' => '_blank']) ?></li>
                                </ul>
                            </li>
                            <li><?= $this->Html->link('<span> About </span>', ['controller' => '/', 'action' => '/'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                        </ul>
                    </div>
                </div>

                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <?= $this->Flash->render() ?>
                            <?= $this->fetch('content') ?>

                        </div>
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            2016 © SMS Screen Management System
        </footer>
    </div>
</div>

<script>
    var resizefunc = [];
</script>
<style>
	.logo{line-height:100%;}
</style>
<!-- jQuery  -->
<?= $this->element('Layout/jsfiles') ?>
<?= $this->fetch('script') ?>

</body>
</html>
