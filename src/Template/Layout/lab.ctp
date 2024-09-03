<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	  <?= $this->Html->meta('icon') ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrfToken" content="<?= $this->request->getParam('_csrfToken'); ?>">

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
	.p20{
			padding:20px;
	}
  </style>
</head>
<body class="">
  <header class="main-header qpage">
          <?php echo $this->element('employeeNav'); ?>

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
  <?php
  	echo $this->Html->script(['../vendor_web/datepicker/js/bootstrap-datepicker.js','lab/custom.js']);
	echo $this->fetch('script');
  ?>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
  	$(function(){

		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();

		$('.datepicker').datepicker({
			format:'mm/dd/yyyy'
		});

		<?php if(!empty($egrcNav)): ?>
			$('.<?php echo $egrcNav; ?>').addClass('active');
		<?php endif; ?>

	});

    $(document).ready(function(){
        $('#deletephoto').hide();


   function readURL(input) {
      var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
	  if (input.files && input.files[0]) {
	  	 if(!allowedExtensions.exec(input.value)){
	        alert('Please select file having extensions .jpeg / .jpg / .png only.');
	        input.value = '';

	    } else {
	    	var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#vphoto').attr('src', e.target.result);
		    }
		    reader.readAsDataURL(input.files[0]);
	    }

	  }
	}
$(document).on('click','#vphoto',function(){
	$('#signImage').trigger('click');
});
$("#signImage").change(function() {
  readURL(this);
    //$('#uploadbtnvalue').text("Change Photo");
     $('#deletephoto').show().css({"position":"relative","z-index":"999"});
});



        });

     $('#deletephoto').on("click", function(){
         $(this).hide();
          $('#uploadbtnvalue').text("Upload Photo");
     });



    $("#allcheckbox").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
        $('#selecttxt').text(" Select All");
        if ($('input#allcheckbox').is(':checked')) {
            $('#selecttxt').text(" Unselect All");
        }
 });




    </script>

    <div class="modal fade" tabindex="-1" role="dialog" id="fmlevelModal">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Maturity Levels Defined</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="">
	        <table class="table table-bordered" style="font-size:15px;margin-bottom:0px;">
	        	<thead>
	        		<tr class="bg-secondary text-white">
	        			<th>Maturity Level</th>
	        			<th>Description</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<?php foreach($fMLevels as $cScale): ?>
	        			<tr>
	        				<td><?php echo $cScale->name; ?></td>
	        				<td><?php echo $cScale->description; ?></td>
	        			</tr>
	        		<?php endforeach; ?>
	        	</tbody>
	        </table>
	      </div>

	    </div>
	  </div>
	</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="scalesModal">
	  <div class="modal-dialog modal-lg modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Risk Severity Scales</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="">
	        <table class="table table-bordered" style="font-size:15px;margin-bottom:0px;">
	        	<thead>
	        		<tr class="bg-secondary text-white">
	        			<th>Risk Severity Scale</th>
	        			<th>Financial Loss</th>
	        			<th>Customer</th>
	        			<th>Regulatory</th>
	        			<th>Business Disruption</th>
	        			<th>Headline Risk</th>
	        			<!--<th>Score</th>-->
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<?php foreach($cScales as $cScale): ?>
	        			<tr>
	        				<td class="<?php echo $cScale->severity_scale; ?>"><?php echo $cScale->severity_scale; ?></td>
	        				<td><?php echo $cScale->financial_loss; ?></td>
	        				<td><?php echo $cScale->customer; ?></td>
	        				<td><?php echo $cScale->regulatory; ?></td>
	        				<td><?php echo $cScale->business_disruption; ?></td>
	        				<td><?php echo $cScale->headline_risk; ?></td>
	        				<!--<td><?php echo $cScale->score; ?></td>-->
	        			</tr>
	        		<?php endforeach; ?>
	        	</tbody>
	        </table>
	      </div>

	    </div>
	  </div>
	</div>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="maturityDescriptionsModal">
	  <div class="modal-dialog modal-lg modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">Maturity Descriptions</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="">
	        <table class="table table-bordered mattrInfoTable" style="font-size:14px;margin-bottom:0px;">
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

	<div class="modal fade" tabindex="-1" role="dialog" id="cmaturityDescriptionsModal">
	  <div class="modal-dialog modal-lg modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-danger text-white">
	        <h5 class="modal-title">CMMC Process Maturity Descriptions</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="">
	        <table class="table table-bordered cmattrInfoTable" style="font-size:14px;margin-bottom:0px;">
	        	<thead>
	        		<tr class="bg-secondary text-white">
	        			<th>Maturity Attribure &darr;</th>
	        			<?php
	        				$mad=0;
							foreach($cdescs as $mop=>$md){
								if($mad>0){break;}
								foreach($md as $mp=>$v){
						?>
						<th><?php echo $mp; ?></th>
						<?php } $mad++; } ?>
	        		</tr>
	        	</thead>

        		<?php foreach($cdescs as $desc=>$dopts): ?>
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


    <div class="pageLoader">
    	<i class="fa fa-spin fa-spinner"></i>

    	<span class="blinking"> Loading ...</span>
    </div>
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

			$('.cmattrInfoTable').find('tbody').hide();
    		$(document).on('click','.cmaturityAttrInfo',function(){
				var iBtn = $(this);
				var mId = $(this).data('id');
				//console.log(riskId);
				var effectiveTbody = $('.cmattrInfoTable').find('#'+mId);
				$('#cmaturityDescriptionsModal').modal('show');
				//console.log(effectiveTbody);
				effectiveTbody.show();
			});
			$('#cmaturityDescriptionsModal').on('hidden.bs.modal', function (e) {
			  $('.cmattrInfoTable').find('tbody').hide();
			})

    	});
    </script>

</body>
</html>
