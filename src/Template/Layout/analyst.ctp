<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	  <?= $this->Html->meta('icon') ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>THE CLOUD CISO</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="<?php echo $this->request->getAttribute('webroot').'vendor_web/bootstrap/css/theme.min.css'; ?>">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <?php
  		echo $this->Html->css(['../vendor_web/datepicker/css/datepicker.css','lab/style.css']);
		echo $this->fetch('css');
  ?>
  <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


  <style>
  	.pageLoader {
  		position:fixed;
  		z-index: 99999;
  		width:100%;
  		height:100%;
  		background:rgba(0,0,0,0.5);
  		top:0px;
  		left:0px;
  		font-size:25px;
  		color:#ffffff;
  		font-weight:bold;
  		text-align:center;
  		padding-top:20%;
  		display:none;
  		text-shadow:0 0 10px #000000;
  	}
  	.pageLoader .blinking {
  		font-size:25px;
  	}
  	.pageLoader.open {
  		display:block;
  	}
  	.pointer {
  		cursor:pointer;
  	}

  	.navbar-nav .dropdown-menu {
  		background-color:#233149;
  	}
  	.navbar-nav .dropdown-menu .dropdown-item {
  		color:#fff;
  		font-size:20px;
  	}
  	.navbar-nav .dropdown-menu .dropdown-item:hover {
  		color:#233149;
  		background-color:#fff;
  	}
  	.mOptions > .btn:after {
		float:right !important;
		margin-top:8px !important;
	}

  </style>
</head>
<body class="">
  <header class="main-header qpage">
          <?php echo $this->element('analystsNav'); ?>

  </header>
  <div class="main-content container-fluid">
        <!-- Start Page Content -->
        <?= $this->Flash->render() ?>

		<?= $this->fetch('content') ?>
    <!-- content wrapper -->
  </div>
  <!-- main content closed -->

  <!-- chart js-->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
   <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script src='<?php echo $this->request->getAttribute('webroot')."js/jquery.form.js"?>'></script>

  	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


  <!-- Custom JavaScript -->

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
  	$(function(){

		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();

		$('.datepicker').datepicker({
			format:'mm/dd/yyyy'
		});

	});

    </script>


    <div class="pageLoader">
    	<i class="fa fa-spin fa-spinner"></i>

    	<span class="blinking"> Loading ...</span>
    </div>


</body>
</html>
