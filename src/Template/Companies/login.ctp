<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
   <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Company Login | THE CLOUD CISO
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <?= $this->Html->css('admin/loginstyle.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body id="b-bkg">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 cl_mt">
               <center>
                    <div class="text-logo text-center ciso-mt">
                      <div class="logo_brand">
					  	<img src="../../img/logo-light.svg">
					  </div>
                      <p class="tag-line text-white" style="font-size:16px;">
                      	Company Login
                      </p>
                    </div>
                </center>
                <?= $this->Flash->render() ?>
                <div class="login_form row">
                	<?php
                		$this->Form->setTemplates([
						    'inputContainer' => '
						    <div class="col-sm-12 col-12">
						        {{content}} </div>'
						]);
                	?>
                	<?php echo $this->Form->create("User",array('class'=>'field-label form_card','style'=>'margin:auto;')); ?>

                	<?php
                		echo $this->Form->control('email',array(
							'class'=>'form-control text-center',
							'label'=>array('class'=>'field-label','text'=>'Email'),
							'placeholder'=>''
						));
						echo $this->Form->control('password',array(
							'class'=>'form-control text-center',
							'label'=>array('class'=>'field-label','text'=>'Password'),
							'placeholder'=>''
						));
                	?>
                	<div class="col-sm-12 col-12">
                		<button type="submit" class="btn enter-btn cl_mt3">Enter</button>
                	</div>
					<?php
                		echo $this->Html->link('Forgot Password?',array(
							'controller'=>'companies','action'=>'forgotPassword'
						),[
							'class'=>'text-center forgotlink',
							'style'=>""
						]);
                	?>
                	<?php echo $this->Form->end(); ?>
                </div>
                <p class="backtohome" style="">                	
                	<?php
                		echo $this->Html->link('Back to Website',array(
							'_name'=>'cisohome'
						),[
							'class'=>'text-center text-white tag-line',
							'style'=>""
						]);
                	?>
                </p>

            </div>
        </div>
    </div>
</body>

</html>
