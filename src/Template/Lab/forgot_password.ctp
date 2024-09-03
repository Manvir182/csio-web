<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link href="/ciso/favicon.ico" type="image/x-icon" rel="icon"/><link href="/ciso/favicon.ico" type="image/x-icon" rel="shortcut icon"/>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>CISO - Forgot Password</title>
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
  	.alert{
  		position:fixed;
  		width:80%;
  		left:10%;
  		top:20%;
  		z-index: 99999;
  		text-align:center;
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
                             <div class="text-center ciso-mt mb-3">
                             <div class="logo_brand">
					  			<img src="../../img/logo-light.svg">
							</div>							
                            </div>
                        </center>
                    </div>

                     <div class="col-md-12 ">
                          <br><br>
                            <?= $this->Flash->render() ?>
		                	<?php echo $this->Form->create("Lab",array('class'=>'user-enter-form')); ?>
		                	<div class="conatiner">
                                <div class="form-container">
                                  <div class="login_form input-fileds">
                                    <div class="form-fields pt-2">
					                	<?php
					                		echo $this->Form->control('company_email',array(
												'class'=>'form-control text-center',
												'label'=>array('class'=>'field-label','text'=>'Enter Email'),
												'div'=>array('class'=>'form-group')
											));
										?>
					                	<div class="form-group mt-4">
					                		<button type="submit" class="btn enter-btn">Submit</button>
					                	</div>

                           			 </div>
                            		</div>                            		
                           		</div>
                       		</div>
                       		<?php echo $this->Form->end(); ?>
                    	</div>

                      <div class="col-md-12 ">

                    </div>

                </div>
                <!-- row closed -->

            </div>
             <div class="col-md-2 col-sm-2 col-12"></div>
              <div class="col-md-12 col-sm-12 col-12">
              	<br><br>
                <p class="sign-up text-md-center text-sm-center mt-0 text-white backtohome">
                	<?php
                		echo $this->Html->link('Back to Login',array(
							'controller'=>'lab','action'=>'login'
						),[
							'class'=>'text-center text-white',
							'style'=>""
							]);
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
  </script>
</body>
</html>
