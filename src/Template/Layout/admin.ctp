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
        <?= $pageHeading ?>
        |
        THE CLOUD CISO
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(array('../plugins/bootstrap/css/bootstrap.min.css','admin/colors/blue.css','../selectbox/dist/css/select2.min.css','../vendor_web/datepicker/css/datepicker.css','admin/style.css')) ?>

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
		.mOptions > .btn:after {
			float:right !important;
			margin-top:8px !important;
		}

	</style>
	<script src="<?php echo $this->request->getAttribute('webroot').'plugins/jquery/jquery.min.js'; ?>"></script>
  <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
   <body class="fix-header fix-sidebar">
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
                       <img src="../../../img/logo-light.svg">
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

                    	<li class="nav-item dropdown">
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
		                    	<?php if($thisUser['role']!='Approver'): ?>
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
	                        	<?php endif; ?>
	                        	<?php
	                        		if($thisUser['role']=='Company'){
	                        			echo $this->Html->link('<i class="fa fa-power-off"></i> Logout',array(
											'controller'=>'companies','action'=>'logout'
										),array(
											'class'=>'waves-effect dropdown-item',
											'escape'=>false
										));
	                        		} else {
	                        			echo $this->Html->link('<i class="fa fa-power-off"></i> Logout',array(
											'controller'=>'users','action'=>'logout'
										),array(
											'class'=>'waves-effect dropdown-item',
											'escape'=>false
										));
	                        		}

	                        	?>

		                      </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php if($thisUser['role']=='Super Admin'): ?>
        	<?= $this->Element('superNav') ?>
        <?php elseif($thisUser['role']=='Company'): ?>
       		<?= $this->Element('companyNav') ?>
   		<?php elseif($thisUser['role']=='Approver'): ?>
   			<?= $this->Element('approverNav') ?>
       	<?php endif; ?>

         <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Start Page Content -->
                <?= $this->Flash->render() ?>

    			<?= $this->fetch('content') ?>
                <!-- End Page Content -->
         	</div>
         </div>

    </div>
    <!--compliance status modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="effectivenessModal">
	  <div class="modal-dialog modal-lg modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Control Effectiveness Scales</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="">
	        <table class="table table-bordered" style="font-size:15px;margin-bottom:0px;">
	        	<thead>
	        		<tr class="bg-secondary text-white">
	        			<th>Control Effectiveness</th>
	        			<th>Description</th>
	        			<!--<th>Score</th>-->
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<?php foreach($ceScales as $ceScale): ?>
	        			<tr>
	        				<td><?php echo $ceScale->name; ?></td>
	        				<td><?php echo $ceScale->description; ?></td>
	        				<!--<td><?php echo $ceScale->score; ?></td>-->
	        			</tr>
	        		<?php endforeach; ?>
	        	</tbody>
	        </table>
	      </div>

	    </div>
	  </div>
	</div>
    <!--compliance status modal ends -->
    <div class="modal fade" tabindex="-1" role="dialog" id="maturityDescriptionsModal">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Maturity Descriptions</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="">
	        <table class="table table-bordered" style="font-size:14px;margin-bottom:0px;">
	        	<thead>
	        		<tr class="bg-secondary text-white">
	        			<th>Maturity Attribure &darr;</th>
	        			<?php
	        				$mad=0;
							foreach($descs as $mop=>$md){
								if($mad>0){break;}
								foreach($md as $mp=>$v){
						?>
						<th><?php echo $mp; ?></th>
						<?php } $mad++; } ?>
	        		</tr>
	        	</thead>

	        		<?php foreach($descs as $desc=>$dopts): ?>
	        			<tbody id="<?php echo str_replace(" ", "", $desc) ?>" >
		        			<tr>
		        				<td><?php echo $desc; ?></td>
		        				<?php foreach($dopts as $dopt): ?>
		        				<td><?php echo $dopt; ?></td>
		        				<?php endforeach; ?>
		        			</tr>
	        			</tbody>
	        		<?php endforeach; ?>

	        </table>
	      </div>

	    </div>
	  </div>
	</div>

    <?php if($thisUser['role']=='Super Admin'): ?>


	    <?php if($genMappingPending > 0 || $RbMappingPending > 0): ?>
	  	<!-- warning modal for mappings-->
	  	<div class="modal fade" tabindex="-1" role="dialog" id="warningModal">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header bg-danger text-white">
		        <h5 class="modal-title text-white">
		        	<i class="fa fa-exclamation-triangle"></i>
		        	Risk-Control Mapping
		        </h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body text-danger">
		        <?php if($genMappingPending > 0): ?>
		        	<p align="justify">
		        		Risk - Control Mapping for new added Risks or Controls is pending in Generalized Risk Control Mapping Masters.
			        	<br>Kindly
			        	<?php
			        		echo $this->Html->link("<i class='fa fa-random'></i> Update Mapping here",[
			        			'controller'=>'GenControls','action'=>'rcmappings'
			        		],[
			        			'class'=>'btn btn-danger',
			        			'escape'=>false
			        		]);
			        	?>
			        	to avoid Assessment level issues.
		        	</p>
		        	<hr>
		        <?php endif; ?>
		        <?php if($RbMappingPending > 0): ?>
		        	<p align="justify">
		        		Risk - Control Mapping for new added Risks or Controls is pending for Regulatory Bodies Risk Control Mapping masters.
			        	<br>Kindly
			        	<?php
			        		echo $this->Html->link("<i class='fa fa-random'></i> Update Mapping here",[
			        			'controller'=>'RegulatoryBodies','action'=>'index'
			        		],[
			        			'class'=>'btn btn-danger',
			        			'escape'=>false
			        		]);
			        	?>
			        	to avoid Assessment level issues.
		        	</p>
		        <?php endif; ?>
		      </div>
		    </div>
		  </div>
		</div>
	  	<!-- warning modal ends here-->
	    <?php endif; ?>
    <?php endif; ?>
     <!-- chart js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

   <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <?= $this->Html->script(array('../plugins/bootstrap/js/tether.min.js','../plugins/bootstrap/js/bootstrap.min.js','admin/jquery.slimscroll.js','admin/waves.js','admin/sidebarmenu.js','../plugins/sticky-kit-master/dist/sticky-kit.min.js','admin/custom.min.js','../plugins/flot/jquery.flot.js','../plugins/flot.tooltip/js/jquery.flot.tooltip.min.js','../plugins/styleswitcher/jQuery.style.switcher.js','admin/flot-data.js','../selectbox/dist/js/select2.full.min.js','../vendor_web/datepicker/js/bootstrap-datepicker.js')) ?>
    <?= $this->fetch('script') ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    <script>

    	$(function(){
    		$('.select2').select2({
			  theme: "classic"
			});
			$('#warningModal').modal('show');

			$('[data-toggle="tooltip"]').tooltip();
    		$('[data-toggle="popover"]').popover();
    	});

    	$('.dataTable').DataTable({
	        "paging":   false,
	        "ordering": false,
	        "info":     false
	    });
    </script>

    <script>
    	$(function(){
    		$('.mattrInfoTable').find('tbody').hide();
    		$(document).on('click','.maturityAttrInfo',function(){
				var iBtn = $(this);
				var mId = $(this).data('id');
				//console.log(riskId);
				var effectiveTbody = $('.mattrInfoTable').find('#'+mId);
				$('#maturityDescriptionsModal').modal('show');
				//console.log(effectiveTbody);
				effectiveTbody.show();
			});
			$('#maturityDescriptionsModal').on('hidden.bs.modal', function (e) {
			  $('.mattrInfoTable').find('tbody').hide();
			})
    	});
    </script>
</body>
</html>
