<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
   <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Generate Password | Approvers | THE CLOUD CISO
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
                      <h4 class="brand-title">THE CLOUD CISO</h4>
                      <p class="tag-line">
                      	RISK & ADVISORY
                      </p>
                    </div>
                </center>
                <?= $this->Flash->render() ?>
                <div class="login_form cisoblue-outline  cisoblue cisoblue-border row">
                	<p class="tag-line" style="text-align:center;color:#fff;font-size:20px;width:100%;">
                		Generate Password
                	</p>
                	<?php
                		$this->Form->setTemplates([
						    'inputContainer' => '
						    <div class="col-sm-12 col-12">
						        {{content}} </div>'
						]);
                	?>
                	<?php echo $this->Form->create("User",array('class'=>'field-label','style'=>'margin:auto;')); ?>

                	<?php
                		echo $this->Form->control('email',array(
							'class'=>'form-control text-center',
							'label'=>array('class'=>'field-label','text'=>'Enter Registered Email'),

						));

                	?>
                	<div class="form-group">
                		<button type="submit" class="btn enter-btn cl_mt3">Submit</button>
                	</div>
                	<?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
