<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Assessment Results: THE CLOUD CISO

    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(array('../plugins/bootstrap/css/bootstrap.min.css','admin/colors/blue.css','../selectbox/dist/css/select2.min.css','admin/style.css')) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <style>
    	div.input {
    		padding-bottom:14px;
    	}
    	div.input label {
    		font-weight:bold !important;
    	}
    	.valMessage {
    		border:2px solid blue;
    		padding:3px 5px;
    		font-weight:bold;
    		text-align:center;
    		margin-bottom:6px;
    	}
    	.valMessage.success {
    		background:lightgreen;
    		border-color:darkgreen;
    		color:darkgreen;
    	}
    	.valMessage.error {
    		background:pink;
    		border-color:crimson;
    		color:crimson;
    	}
    </style>
    <style>

		.controlAreas {
			counter-reset: ca;

		}
		.controlAreas > .card:before {
			counter-increment: ca;
			content: counter(ca);
			display:inline-block;
			background:#999;
			color:#fff;
			//padding-left:6px;
			//padding-right:6px;
			font-size:12px;
			width:16px;
			height:16px;
			text-align:center;
			position:absolute;
			margin-top:-5px;
			margin-left:-5px;
			//border-radius:20px;
		}
		.remove {
			display:inline-block;
			position:absolute;

			width:18px;
			height:18px;
			font-size:16px;
			background:crimson;
			color:#fff;
			text-align:center;
			line-height:18px;
			cursor:pointer;
			text-shadow:1px 1px 1px #333;
			box-shadow:1px 1px 4px #999;
			display:none;
		}
		.remove:hover {
			background-color:red;

		}
		.controlAreas > .card > .remove {
			margin-left:100%;
		}
		.controlAreas > .card:hover > .remove,
		.cRequirement .row:hover  .remove {
			display:inline-block;
		}

		.cRequirement .remove {
			width:20px;
			height:20px;
			font-size:16px;
			line-height:16px;
			margin-top:6px;
		}
		.controlAreas > .card {
			box-shadow:0 0 4px #999;
		}
		.form-control::placeholder {
			color:#cdcdcd;
		}
		.controlAreas .controlRequirements {
			background:#eee;
			counter-reset: cr;
		}
		.controlAreas .controlRequirements .cRequirement .form-group:before {
			counter-increment: cr;
			content: counter(cr);
			display:inline-block;
			background:#999;
			color:#fff;
			font-size:12px;
			line-height:34px;
			width:16px;
			height:34px;
			text-align:center;
			position:absolute;
			margin-left:-16px;
			margin-top:2px;
			border-radius:4px 0 0 4px;
		}

	</style>
	<script src="<?php echo $this->request->getAttribute('webroot').'plugins/jquery/jquery.min.js'; ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
   <body class="fix-header fix-sidebar card-no-border">
	<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">
    	<header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b>
                            <?php
                        		echo $this->Html->image('admin/logo-text.png',array('class'=>'dark-logo minilogo'));
                        	?>
                        </b>

                        <!--End Logo icon -->
                    </a>

                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                 <ul class="navbar-nav mr-auto mt-md-0 ">
                   <li class="nav-item">
                    	<a class="pageHeading">
                    		<?= $pageHeading ?>
                    	</a>
                   </li>
                </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0 ml-auto">
                    	<li class="nav-item">

                    		<button class="nav-link btn-danger text-white" onclick="window.close();" style="cursor:pointer;">
                    			<i class="fa fa-times"></i>
                    			Close
                    		</button>
                    	</li>
                    	<li class="nav-item dropdown sr-only">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            	<?php if(empty($thisUser['photo'])): ?>
                            		<i class="fa fa-user-circle"></i>
                            	<?php else: ?>
                            		<?php
	                            		echo $this->Html->image($thisUser['photo'],array('class'=>'profile-pic m-r-5'));
	                            	?>
                            	<?php endif; ?>


                            	<?= $thisUser['first_name']." ".$thisUser['last_name'] ?>
                            </a>
		                    <div class="dropdown-menu dropdown-menu-right">
		                       <?php
	                        		echo $this->Html->link('<i class="fa fa-user"></i> My Profile',array(
										'controller'=>'users','action'=>'myProfile'
									),array(
										'class'=>'waves-effect dropdown-item',
										'escape'=>false
									));
	                        	?>
	                        	<?php
	                        		echo $this->Html->link('<i class="fa fa-lock"></i> Change Password',array(
										'controller'=>'users','action'=>'changePassword'
									),array(
										'class'=>'waves-effect dropdown-item',
										'escape'=>false
									));
	                        	?>
	                        	<?php
	                        		echo $this->Html->link('<i class="fa fa-power-off"></i> Logout',array(
										'controller'=>'users','action'=>'logout'
									),array(
										'class'=>'waves-effect dropdown-item',
										'escape'=>false
									));
	                        	?>

		                      </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

         <div class="page-wrappe">
            <div class="container-fluid">
                <!-- Start Page Content -->
                <?= $this->Flash->render() ?>

    			<?= $this->fetch('content') ?>
                <!-- End Page Content -->
         	</div>
         </div>

    </div>


    <?= $this->Html->script(array('../plugins/bootstrap/js/tether.min.js','../plugins/bootstrap/js/bootstrap.min.js','admin/jquery.slimscroll.js','admin/waves.js','admin/sidebarmenu.js','../plugins/sticky-kit-master/dist/sticky-kit.min.js','admin/custom.min.js','../plugins/flot/jquery.flot.js','../plugins/flot.tooltip/js/jquery.flot.tooltip.min.js','../plugins/styleswitcher/jQuery.style.switcher.js','admin/flot-data.js','../selectbox/dist/js/select2.full.min.js','tableToExcel.js')) ?>
    <?= $this->fetch('script') ?>
    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    <script>
    	$('[data-toggle="tooltip"]').tooltip();

    	$(function(){
    		$('.select2').select2({
			  theme: "classic"
			});
    	});

    	$('.dataTable').DataTable({
	        "paging":   false,
	        "ordering": false,
	        "info":     false
	    });
    </script>
</body>
</html>
