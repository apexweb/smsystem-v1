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
$role = $authUser['role'];

?>


<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SMS Screen Management System | Security Screen Calculator">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="/assets/images/favicon_1.ico">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>

    <?= $this->element('Layout/cssfiles') ?>

    <?= $this->fetch('css') ?>
    
    <link media="only screen and (max-width: 768px), only screen and (max-device-width: 768px)" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"  crossorigin="anonymous">
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?= $this->Html->script('/assets/js/modernizr.min.js') ?>
    
    <script>
        var ajaxurl = "<?= $this->Url->build('/', true);?>";
    </script>
</head>

<body class="fixed-left-void widescreen">

<!-- Begin page -->
<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?= $this->Html->link('<span>SMS', '/', ['class' => 'logo navbar-brand', 'escape' => false]) ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse " aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav custom-nav custom-nav-left">
            <?php if ($role == 'manufacturer'): ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Orders</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> All Orders </span>', ['controller' => 'quotes', 'action' => 'orders'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Orders Scheduler </span>', ['controller' => 'quotes', 'action' => 'scheduler'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> My Quotes </span>', ['controller' => 'quotes', 'action' => 'myquotes'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add Quote </span>', ['controller' => 'quotes', 'action' => 'roleselect'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <!--<li><?//= $this->Html->link('<span> Master Calculator Values </span>', ['controller' => 'mcvalues', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?//= $this->Html->link('<span> Drop Down Values </span>', ['controller' => 'dropdowns', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>-->
                                    
                                </ul>
                            </li>


                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Combined Stocks</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> All Combined Stocks </span>', ['controller' => 'stocks', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add Order Materials </span>', ['controller' => 'stocks', 'action' => 'orderslist'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                            <li><?= $this->Html->link('Parts', ['controller' => 'parts', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Installations', ['controller' => 'installations', 'action' => 'index']) ?></li>


                        <?php elseif ($role == 'supplier'): ?>
                            <li class="partsli" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Parts</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> All Parts </span>', ['controller' => 'parts', 'action' => 'all'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Manufacturer\'s Parts </span>', ['controller' => 'parts', 'action' => 'selectmf'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New </span>', ['controller' => 'parts', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manufacturers</a>
                                <ul class="dropdown-menu1">
                                    <li><?= $this->Html->link('<span> All Users </span>', ['controller' => 'users', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> All Manufacturers </span>', ['controller' => 'users', 'action' => 'manufacturers'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New Manufacturer </span>', ['controller' => 'users', 'action' => 'addmanufacturer'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New User </span>', ['controller' => 'users', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                        <?php elseif ($role == 'admin'): ?>

                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> All Users </span>', ['controller' => 'users', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New User </span>', ['controller' => 'users', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                        <?php elseif ($role == 'distributor' || $role == 'wholesaler' || $role == 'retailer'): ?>

                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quotes</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> All Quotes </span>', ['controller' => 'Quotes', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add Quote </span>', ['controller' => 'Quotes', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>
                            <li><?= $this->Html->link('Installations', ['controller' => 'installations', 'action' => 'index']) ?></li>

                        <?php endif; ?>


                        <?php if ($role): ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tech Assistance</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> Door Configurations </span>', ['controller' => 'pages', 'action' => 'door-configurations'], ['class' => 'waves-effect', 'escape' => false, 'target' => '_blank']) ?></li>
                                    <li><?= $this->Html->link('<span> Additional Sections </span>', ['controller' => 'pages', 'action' => 'additional-sections'], ['class' => 'waves-effect', 'escape' => false, 'target' => '_blank']) ?></li>
                                </ul>
                            </li>
                            <li><?= $this->Html->link('Important Info', ['controller' => 'pages', 'action' => 'importantinfo']) ?></li>
                        <?php endif; ?>
                        
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings</a>
                            <ul class="dropdown-menu">
                                
                                <?php if ($role == 'manufacturer'): ?>
                                <li><?= $this->Html->link('<span> Customize Invoice </span>', ['controller' => 'settings', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                <li><?= $this->Html->link('<span> Drop Down Values </span>', ['controller' => 'dropdowns', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                <li><?= $this->Html->link('Matrix Tables', ['controller' => 'Matrixtables', 'action' => 'tableselect']) ?></li>
                                <li><?= $this->Html->link('<span> Master Calculator Values </span>', ['controller' => 'mcvalues', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                       
                                <?php elseif ($role == 'supplier'): ?>
                                <li><?= $this->Html->link('<span> Drop Down Values </span>', ['controller' => 'dropdowns', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                <?php endif; ?>                                 
                            </ul>
                        </li>

                        
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right custom-nav custom-nav-right">
			<li class="dropdown">

				<a href="" class="dropdown-toggle profile" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="profile-name">Gidday, <?= $authUser['username']; ?></span>
					<?= $this->Html->image('/assets/images/users/avatar-1.jpg', ['alt' => 'user-img', 'class' => 'img-circle']) ?>
				</a>


				<ul class="dropdown-menu">
					<li><?= $this->Html->link('<i class="ti-user m-r-5"></i> <span> Edit Profile </span>', ['controller' => 'users', 'action' => 'edit', $authUser['id']], ['class' => 'waves-effect', 'escape' => false]) ?></li>
				</ul>
			</li>
            <li><?= $this->Html->link('<i class="ti-power-off m-r-5 logout-icon"></i> <span> Log out </span>', ['controller' => 'users', 'action' => 'logout'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
		</ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <!-- Top Bar Start -->
    <div class="topbar" style="display:none;">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <?= $this->Html->link('<span>SMS', '/', ['class' => 'logo', 'escape' => false]) ?>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav navbar-right pull-right">

                    <li class="dropdown">

                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <span class="profile-name">Gidday, <?= $authUser['username']; ?></span>
                            <?= $this->Html->image('/assets/images/users/avatar-1.jpg', ['alt' => 'user-img', 'class' => 'img-circle']) ?>
                        </a>


                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('<i class="ti-user m-r-5"></i> <span> Edit Profile </span>', ['controller' => 'users', 'action' => 'edit', $authUser['id']], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                        </ul>
                    </li>
                    
                    <li><?= $this->Html->link('<i class="ti-power-off m-r-5 logout-icon"></i> <span> Log out </span>', ['controller' => 'users', 'action' => 'logout'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                    

                </ul>

                <div class="collapse navbar-collapse custom-nav">
                    <ul>
                        <?php if ($role == 'manufacturer'): ?>
                            <li><a href="#">Orders</a>
                                <ul>
                                    <li><?= $this->Html->link('<span> Orders Scheduler </span>', ['controller' => 'quotes', 'action' => 'scheduler'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add Quote </span>', ['controller' => 'quotes', 'action' => 'roleselect'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> All Orders </span>', ['controller' => 'quotes', 'action' => 'orders'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <!--<li><?//= $this->Html->link('<span> Master Calculator Values </span>', ['controller' => 'mcvalues', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?//= $this->Html->link('<span> Drop Down Values </span>', ['controller' => 'dropdowns', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>-->
                                    <li><?= $this->Html->link('<span> My Quotes </span>', ['controller' => 'quotes', 'action' => 'myquotes'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                            <li><?= $this->Html->link('Matrix Tables', ['controller' => 'Matrixtables', 'action' => 'tableselect']) ?></li>

                            <li><a href="#">Combined Stocks</a>
                                <ul>
                                    <li><?= $this->Html->link('<span> All Combined Stocks </span>', ['controller' => 'stocks', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add Order Materials </span>', ['controller' => 'stocks', 'action' => 'orderslist'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                            <li><?= $this->Html->link('Parts', ['controller' => 'parts', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Installations', ['controller' => 'installations', 'action' => 'index']) ?></li>


                        <?php elseif ($role == 'supplier'): ?>
                            <li class="partsli"><a href="#">Parts</a>
                                <ul>
                                    <li><?= $this->Html->link('<span> All Parts </span>', ['controller' => 'parts', 'action' => 'all'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Manufacturer\'s Parts </span>', ['controller' => 'parts', 'action' => 'selectmf'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New </span>', ['controller' => 'parts', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>
                            <li><a href="#">Manufacturers</a>
                                <ul>
                                    <li><?= $this->Html->link('<span> All Users </span>', ['controller' => 'users', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> All Manufacturers </span>', ['controller' => 'users', 'action' => 'manufacturers'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New Manufacturer </span>', ['controller' => 'users', 'action' => 'addmanufacturer'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New User </span>', ['controller' => 'users', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                        <?php elseif ($role == 'admin'): ?>

                            <li><a href="#">Users</a>
                                <ul>
                                    <li><?= $this->Html->link('<span> All Users </span>', ['controller' => 'users', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add New User </span>', ['controller' => 'users', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>

                        <?php elseif ($role == 'distributor' || $role == 'wholesaler' || $role == 'retailer'): ?>

                            <li><a href="#">Quotes</a>
                                <ul>
                                    <li><?= $this->Html->link('<span> All Quotes </span>', ['controller' => 'Quotes', 'action' => 'index'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                    <li><?= $this->Html->link('<span> Add Quote </span>', ['controller' => 'Quotes', 'action' => 'add'], ['class' => 'waves-effect', 'escape' => false]) ?></li>
                                </ul>
                            </li>
                            <li><?= $this->Html->link('Installations', ['controller' => 'installations', 'action' => 'index']) ?></li>

                        <?php endif; ?>


                        <?php if ($role): ?>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tech Assistance</a>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link('<span> Door Configurations </span>', ['controller' => 'pages', 'action' => 'door-configurations'], ['class' => 'waves-effect', 'escape' => false, 'target' => '_blank']) ?></li>
                                    <li><?= $this->Html->link('<span> Additional Sections </span>', ['controller' => 'pages', 'action' => 'additional-sections'], ['class' => 'waves-effect', 'escape' => false, 'target' => '_blank']) ?></li>
                                </ul>
                            </li>
                            <li><?= $this->Html->link('Important Info', ['controller' => 'pages', 'action' => 'importantinfo']) ?></li>
                        <?php endif; ?>

                        <li class="about"><?= $this->Html->link('About', ['controller' => 'pages', 'action' => 'display']); ?></li>
                    </ul>
                </div>
                <!--                </div>-->
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
                        <!--                        <div class="card-box">-->
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                        <!--                        </div>-->
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            2017 © SMS Screen Management System.
        </footer>
    </div>
</div>

<script>
    var resizefunc = [];
</script>
<style>
.custom-nav > li > a {padding-left:0px;padding-right:0px ;text-align:center;}
.custom-nav .dropdown-menu>li>a {padding:0 0 0 15px !important;line-height:unset;color:#fff;}
.logo{font-size:20px !important;line-height:inherit;}
span.profile-name{padding-right:5px;right:0 !important;}
</style>
<!-- jQuery  -->
<?= $this->element('Layout/jsfiles') ?>

<?= $this->fetch('script') ?>


</body>
</html>
