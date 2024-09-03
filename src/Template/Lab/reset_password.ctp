<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link href="/ciso/favicon.ico" type="image/x-icon" rel="icon"/><link href="/ciso/favicon.ico" type="image/x-icon" rel="shortcut icon"/>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>CISO - Reset Your Password</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Custom main css -->
  <link rel="stylesheet" href="<?php echo $this->request->getAttribute('webroot'); ?>css/lab/style.css">
  <style>
  	.field-label {
  		font-size:17px;
  	}
  	.alert{
  		position:fixed;
  		width:80%;
  		left:10%;
  		top:20%;
  		z-index: 99999;
  		text-align:center;
  	}

	.brand-title,.tag-line,.field-label,.sign-up a
	{
		color:white !important;
	}
  </style>
</head>
<body class="content-wrapper " style="padding:0px;">
  <div class="main-content ">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-2 col-sm-2 col-12"></div>
            <div class="col-md-8 col-sm-8 col-12">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <div class="text-logo text-center ciso-mt">
                              <h4 class="brand-title">THE CLOUD CISO</h4>
                              <p class="tag-line">RISK ASSESSMENT</p>
                            </div>
                        </center>
                    </div>

                     <div class="col-md-12 ">

                            <?= $this->Flash->render() ?>
		                	<?php echo $this->Form->create("Lab",array('class'=>'user-enter-form')); ?>
		                	<div class="conatiner">
                                <div class="form-container">
                                  <div class="input-fileds">
                                    <div class="form-fields">
					                	<?php
					                		echo $this->Form->control('password',array(
												'class'=>'form-control text-center',
												'type'=>'password',
												'label'=>array('class'=>'field-label','text'=>'New Password'),
												'div'=>array('class'=>'form-group'),
												'data-toggle'=>'popover',
												'data-trigger'=>'focus',
												'data-content'=>"Must be minimum 8 characters long.<br>Must contain 1 uppercase character,<br> 1 number and 1 special character",
												'data-placement'=>'right',
												'data-html'=>'true',
												'title'=>"",
												'data-original-title'=>"Password Rules"
											));
										?>
										<?php
					                		echo $this->Form->control('confirm_password',array(
												'class'=>'form-control text-center',
												'type'=>'password',
												'label'=>array('class'=>'field-label','text'=>'Confirm Password'),
												'div'=>array('class'=>'form-group'),
												'data-toggle'=>'popover',
												'data-trigger'=>'focus',
												'data-content'=>"Must be minimum 8 characters long.<br>Must contain 1 uppercase character,<br> 1 number and 1 special character",
												'data-placement'=>'right',
												'data-html'=>'true',
												'title'=>"",
												'data-original-title'=>"Password Rules"
											));
										?>
					                	<div class="form-group">
					                		<button type="submit" class="btn enter-btn">Submit</button>
					                	</div>

                           			 </div>
                            		</div>
                            		 <?php
                                  		echo $this->Html->image('labs/hex-shape.png',array(
											'class'=>'hex img-responsive'
										));
                                  	?>
                           		</div>
                       		</div>
                       		<?php $this->Form->unlockField('confirm_password'); ?>
                       		<?php echo $this->Form->end(); ?>
                    	</div>

                      <div class="col-md-12 ">

                    </div>

                </div>
                <!-- row closed -->

            </div>
             <div class="col-md-2 col-sm-2 col-12"></div>
              <div class="col-md-12 col-sm-12 col-12">

                <p class="sign-up text-md-center text-sm-center">
                	<?php
                		echo $this->Html->link('Back to Login',array(
							'controller'=>'lab','action'=>'login'
						));
                	?>
                </p>
              </div>
          </div>


      </div>
    <!-- content wrapper -->
  </div>
  <!-- main content closed -->

  <!-- Custom JavaScript -->
  <script src="<?php echo $this->request->getAttribute('webroot'); ?>js/lab/custom.js"></script>
  <script>
  	setTimeout(function(){
   	$('.alert').fadeOut(4000,function(){
   		$('.alert').remove();
   	})
   },5000);

   <?php if(!empty($status)): ?>
   		$(function(){
   			$('.form-control').prop('disabled',true);
   			$('.enter-btn').prop('disabled',true);
   		});
   <?php endif; ?>
   $(function(){
   	$('[data-toggle="popover"]').popover();

   });
  </script>
</body>
</html>
