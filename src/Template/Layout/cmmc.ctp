<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	  <?= $this->Html->meta('icon') ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>THE CLOUD CISO</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
 <meta name="description" content="cmmc, cybersecurity maturity model certification, government cybersecurity, cybersecurity requirements for government contracting">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

  <?php
  		echo $this->Html->css(['../vendor_web/bootstrap/css/theme.min.css','../vendor_web/fontawesome-free/css/all.min.css','web/agency.min.css','web/custom.css']);
		echo $this->fetch('css');
  ?>
  <?= $this->Html->css(array('../cmmc/css/c-style.css','../cmmc/css/leader-line.css')) ?>


 	<?= $this->fetch('css') ?>
  <?php
  	echo $this->Html->script(['../vendor_web/jquery/jquery.min.js','../vendor_web/bootstrap/js/bootstrap.bundle.min.js','../vendor_web/jquery-easing/jquery.easing.min.js','web/jqBootstrapValidation.js','web/contact_me.js','web/agency.js']);
	echo $this->fetch('script');

  ?>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <style>
  	.alert{
  		position:fixed;
  		width:80%;
  		left:10%;
  		top:20%;
  		z-index: 99999;
  		text-align:center;
  	}
  	.footer
        {
            background: #100a57;
            padding:30px !important;
            color: #fff;
        }


        .footer ul
        {
            text-align: center;
        }
    .footer li
        {
            display: inline-block;
            list-style: none;
            margin-right: 30px;
            text-align: center;
        }
        .footer a {
        	color:#fff;
        }
        .footer a:hover,
        .footer a:active,
        .footer a:visited {
        	color:#fff;
        }
  </style>
</head>
<body id="page-top" class="content-wrapper">
  	<!-- main content begins -->
  		<?= $this->Flash->render() ?>

		<?= $this->fetch('content') ?>
    <!-- main content closed -->



	<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><i class="fa fa-lock"></i> Login as</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-2"></div>
	      		<div class="col-8">
	      			<?php
		        		echo $this->Html->link('<span class="float-left"><i class="fa fa-users"></i></span>Company',
							'/company'
						,[
							'class'=>'btn btn-warning btn-block','escape'=>false
						]);

						echo $this->Html->link('<span class="float-left"><i class="fa fa-user"></i></span>Employee',
							'/lab'
						,[
							'class'=>'btn btn-info btn-block','escape'=>false
						]);
						echo "<hr style='border-color:#eee;'>";
						echo $this->Html->link('<span class="float-left"><i class="fa fa-briefcase"></i></span>Approvers',
							'/approver'
						,[
							'class'=>'btn btn-primary btn-block','escape'=>false
						]);
						/*
						echo "<hr>";
						echo $this->Html->link('<span class="float-left"><i class="fa fa-briefcase"></i></span>Admin',
							'/superadmin'
						,[
							'class'=>'btn btn-danger btn-block','escape'=>false
						]);
						*/
		        	?>
	      		</div>
	      	</div>

	      </div>
	    </div>
	  </div>
	</div>


  <!-- Custom JavaScript -->

 <script>
   // $(document).on('submit','#register-form',function(event){
	   	// event.preventDefault();
	    // grecaptcha.reset();
	    // grecaptcha.execute();
   // });
   setTimeout(function(){
   	$('.alert').fadeOut(4000,function(){
   		$('.alert').remove();
   	})
   },5000);

   $(function(){
   	$('[data-toggle="popover"]').popover();
   	//$('#loginModal').modal('show');
   });


 </script>
</body>
</html>
