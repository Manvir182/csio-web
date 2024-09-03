<style>
	tr.pStatements {
		display:none !important;
	}
	tr.pStatements.open {
		display:table-row !important;
	}
	.psToggleer {
		cursor:pointer;
	}
	.psToggleer.fa-plus-square {
		color:#008000;
	}
	.psToggleer.fa-minus-square {
		color:#E9AB2E;
	}
	th {
		vertical-align:top !important;
	}
	th .newRiskBtn {
		display:inline-block;
		width:18px;
		height:18px;
		line-height:20px;
		background:#2c3e50;
		color:#fff;
		border-radius:2px;
		box-shadow:2px 2px 10px #333;
		font-weight:bold;
		font-size:12px;
		text-align:center;
		float:right;
		/*margin-right:-30px;*/
		
		cursor:pointer;
	}
	
	th .newRiskBtn:hover {
		background:#E9AB2E;
	}
	
	th .editRiskBtn,
	th .delRiskBtn {
		color:red;
		margin-top:10px;
		margin-bottom:0px;
		cursor:pointer;
	}
	th .editRiskBtn:hover,
	th .delRiskBtn:hover {
		color:#fff;
	}
	.falert {
		margin-left:10px;
		padding-left:20px;
		padding-right:20px;
		font-weight:bold;
	}
</style>
<div class="main-content" style="font-size:18px;">
	<div class="container-fluid">
		<div class="row ">
			<div class="col-md-12">

				<div class="c_b-lr">
					<h5 class="cl_abt text-center" style="text-transform: none;">eGRC TOOLS</h5>
					<br>
					<?php echo $this->element('egrcNav'); ?>
					<hr>
				</div>
			</div>
		</div>
		<h3 align="center">Risk &amp; Control Registry for <?php echo $ucompany->company_name; ?></h4>
		<p align="center" class="text-danger">
			Your Risk and Control Registry/ Risk Control Matrix (RCM) is auto generated from your policies and standards.
			Your must however, map the controls to relevant Risk and save.
		</p>
		<p align="center">
			P indicates primary control reliance and S indicates secondary reliance. Select N to remove the mapping. Each risk must have at least one primary (P) control. 
		</p>

		<?php foreach($policies as $policy): ?>
	<?php echo $this->Form->create("RegistryForm".$policy->id,['class'=>'registryForm', 'id'=>'registryForm'.$policy->id,'url'=>$this->Url->build(array('controller'=>'lab','action'=>'savePolicyRiskMapping'),true)]); ?>
			<div class="">
			<table class="table table-bordered txable-hover myTable" id="registryTable<?php echo $policy->id; ?>" style="font-size:14px;margin-bottom:0px;">

			  	<thead>
			  		<tr>
			  			<th class="bg-warning text-white"></th>
			  			<th class="bg-warning text-white"></th>
			  			<th class="bg-secondary riskCell" colspan="<?php echo count($policy->egrc_master_rc_mappings); ?>">
			  				<i class='fa fa-plus newRiskBtn' data-toggle='tooltip' title='New Risk Profile'></i>
			  				Risks &rarr;
			  			</th>
			  		</tr>
			  		<tr class="riskHeaderRow">
			  			<th class="bg-warning text-white"></th>
			  			<th class="bg-warning text-white" style="width:10%;"> Control Areas &darr;</th>
			  			<?php foreach($policy->egrc_master_rc_mappings as $k=>$risk): ?>
			  				<th  class="bg-secondary <?php echo !empty($risk->egrc_risk->company_id)?'riskCell'.$risk->egrc_risk->id:''; ?>">
			  					<i class="fa fa-info-circle text-white" style="float:right;" title="<?php echo strip_tags($risk->egrc_risk->description); ?>" data-toggle="tooltip" data-placement="top"></i>
			  					<?php echo $risk->egrc_risk->name; ?>
			  					
			  					<?php if(!empty($risk->egrc_risk->company_id)): ?>
			  						<i class="fa fa-trash delRiskBtn float-right" data-risk-id="<?php echo $risk->egrc_risk->id; ?>" style="clear:right;" data-toggle="tooltip" data-placement="left" title="Delete"></i>
			  					<?php endif; ?>
			  					
			  				</th>	
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<tr class="mappingRow" data-policy-id="<?php echo $policy->id; ?>">
			  			<td>
			  				<i class="fa fa-plus-square font-20 psToggleer" data-prow="#pStatements<?php echo $policy->id; ?>"></i>
			  			</td>
			  			<td style="width:10%;font-weight:bold;">
			  				<?php echo str_replace('Standard','',str_replace("Policy","",$policy->name)); ?>
			  			</td>
			  			<?php foreach($policy->egrc_master_rc_mappings as $k=>$risk): ?>
			  				<td align="center" style="<?php echo $risk->status=='Pending'?'background:#ffd96a;':''; ?>" class="<?php echo !empty($risk->egrc_risk->company_id)?'riskCell'.$risk->egrc_risk->id:''; ?>">
			  					<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
			  					  
								  <label class="btn btn-outline-primary <?php echo $risk->mapping=='P'?'active':''; ?>">
								    <input type="radio" name="mapping~<?php echo $risk->id; ?>" <?php echo $risk->mapping=='P'?'checked':''; ?> value="P" id="optionmapping~<?php echo $risk->id; ?>" autocomplete="off">P
								  </label>
								  <label class="btn btn-outline-primary <?php echo $risk->mapping=='S'?'active':''; ?>">
								    <input type="radio" name="mapping~<?php echo $risk->id; ?>" <?php echo $risk->mapping=='S'?'checked':''; ?> value="S" id="optionmapping~<?php echo $risk->id; ?>" autocomplete="off">S
								  </label>
								  
								  <label class="btn btn-outline-primary <?php echo $risk->mapping=='N'?'active':''; ?>">
								    <input type="radio" name="mapping~<?php echo $risk->id; ?>" <?php echo $risk->mapping=='N'?'checked':''; ?> value="N" id="optionmapping~<?php echo $risk->id; ?>" autocomplete="off">N
								  </label>
								  
								</div>
			  				</td>
			  			<?php endforeach; ?>
			  		</tr>
			  		<tr id="pStatements<?php echo $policy->id; ?>" class="pStatements">
			  			<td class="statementCell" colspan="<?php echo count($policy->egrc_master_rc_mappings)+2; ?>">
			  				<p>
			  					<b>Control Requirements</b>
			  				</p>
			  				<div class="list-group">
			  					<?php foreach($policy->policy_statements as $statement): ?>
								  <a href="javascript:void(0);" class="list-group-item list-group-item-action" style="color:#2c3e50;">
								    <?php echo $statement->name; ?>
								  </a>
								<?php endforeach; ?>
							</div>
			  				
			  			</td>
			  		</tr>
			  	</tbody>
		  	</table>
		  	<div class="p-2 p-l-0 p-r-0">
			  	<button class="btn btn-success btn-sm isubmitBtn" type="submit"  data-policy-id="<?php echo $policy->id; ?>">
			  		Save <?php echo $policy->name; ?> Risk and Control
			  	</button>
			  	<span class="submitProgress"></span>
			  	<!--
			  	<button class="btn btn-info btn-sm pull-right float-right" type="button">
			  		Assess <?php echo $policy->name; ?> Risk and Control
			  	</button>
			  	-->
			</div>
		  </div>
		  <?php echo $this->Form->end(); ?>
		  <div class="p-10"></div>
		<?php endforeach; ?>
		
		<hr>
		<div class="row">
			<div class="col-sm-4 offset-sm-4">
				<div class="row">
					<!--
					<div class="col-sm-5">
						<button class="btn btn-success btn-block" type="button">
							Save All
						</button>
					</div>
				    -->
					<div class="col-sm-6 offset-sm-3">
						<?php 
							echo $this->Html->link('<i class="fa fa-calculator"></i> &nbsp; Assess All',[
								'controller'=>'assessments','action'=>'assessmentRequestEgrc'
							],[
								'escape'=>false,
								'class'=>'btn btn-success btn-block',
								'role'=>'button'
							]);
						?>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	<!-- map section closed -->
	<div class="p-3"></div>
	<!-- content wrapper -->
</div>

<!--Add Risk Modal-->
<div class="modal" tabindex="-1" role="dialog" id="newEgrcRisk">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Risk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group from-group-sm">
        	<label class="control-label">Risk Name</label>
        	<input type="text" id="newRiskField" class="form-control form-control-sm">
        </div>
        <div class="form-group from-group-sm">
        	<label class="control-label">Risk Description</label>
        	<textarea id="newRiskDescField" rows="5" class="form-control form-control-sm"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm float-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm addNewRiskButton">Add Now</button>
      </div>
    </div>
  </div>
</div>
<!--Add Risk Modal Ends-->
<script>
	
	var rproto = "<?php echo $uProto; ?>";
	$(function(){
		var thIndex = 0;
		
		var mappingCell = `<td align="center">
			  					<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
			  					  <label class="btn btn-outline-secondary">
								    <input type="radio" name="mapping" value="P"  autocomplete="off" class="newRiskRadio">P
								  </label>
								  <label class="btn btn-outline-secondary ">
								    <input type="radio" name="mapping"  value="S"  autocomplete="off" class="newRiskRadio">S
								  </label>
								  <label class="btn btn-outline-secondary">
								    <input type="radio" name="mapping" value="N"  autocomplete="off" class="newRiskRadio">N
								  </label>
								</div>
			  				</td>`;
		
		
	
		
		$(document).on('click','.psToggleer',function(){
			var toggler = $(this);
			toggler.toggleClass('fa-minus-square').toggleClass('fa-plus-square');
			//$('.pStatements').removeClass('open');
			$(toggler.data('prow')).toggleClass('open');
		});
		/*
		var newRiskBtn = "<i class='fa fa-plus newRiskBtn' data-toggle='tooltip' title='New Risk Profile'></i>";
		$('.riskHeaderRow > th:last-child').prepend(newRiskBtn);
		*/
		
		$(document).on('click','.newRiskBtn',function(){
			$('#newEgrcRisk').modal('show');
		});
		
		
		//adding new risk profile to the tables
		$(document).on('click','.addNewRiskButton',function(){
			var newRiskName = $('#newRiskField').val();
			var newRiskDesc = $('#newRiskDescField').val();
			
			if(newRiskName){
				var isRemBtn = $('#newEgrcRisk').find('#rmRiskBtn');
				console.log(isRemBtn.length);
				if(isRemBtn.length){ //checking if editing the risk or creating new
					
					var thClass = isRemBtn.data('pclass');
					$('th.'+thClass).html(`<i class="fa fa-info-circle text-white" style="float:right;" title="`+newRiskDesc+`" data-toggle="tooltip" data-placement="top"></i><span>`+newRiskName+`</span><i class="fa fa-edit editRiskBtn float-right" style="clear:right;" data-toggle="tooltip" data-placement="bottom" title="Edit `+newRiskName+`"></i>`);
					
				} else {
					$('.statementCell').prop('colspan',parseInt($('.statementCell').prop('colspan'))+1);
					$('.riskCell').prop('colspan',parseInt($('.riskCell').prop('colspan'))+1);
					$('.riskHeaderRow').append(`<th class="bg-secondary riskTh`+thIndex+`" data-pclass="riskTh`+thIndex+`"><i class="fa fa-info-circle text-white" style="float:right;" title="`+newRiskDesc+`" data-toggle="tooltip" data-placement="top"></i><span>`+newRiskName+`</span><i class="fa fa-edit editRiskBtn float-right" style="clear:right;" data-toggle="tooltip" data-placement="bottom" title="Edit `+newRiskName+`"></i></th>`);
					mCell = mappingCell.replace(`<td align="center">`,`<td align="center" class="newRiskCell riskTh`+thIndex+`">`);
					
					//$('.mappingRow').append(mCell);	
					
					$('.mappingRow').each(function(){
						mappingRow = $(this);
						mCell1 = mCell.replace(/type=\"radio\" name=\"mapping\"/g,`type="radio" name="nmapping[`+mappingRow.data('policy-id')+`][`+thIndex+`]"`);
						mappingRow.append(mCell1);
						mappingRow.append(`<input type="hidden" name="risknames[`+mappingRow.data('policy-id')+`][`+thIndex+`]" value="`+newRiskName+`">`);
						mappingRow.append(`<input type="hidden" name="riskdesc[`+mappingRow.data('policy-id')+`][`+thIndex+`]" value="`+newRiskDesc+`">`);
						
					});
					
				}
				
				$('#newEgrcRisk').modal('hide');
				
				$("[data-toggle='tooltip']").tooltip();
				thIndex++;
			} else {
				swal({
				  title: "eGRC",
				  text: "Risk Name and Risk Description is required.",
				  icon: "warning",
				  buttons: true,
				  //dangerMode: true,
				});
			}
			
		});
		
		//show the risk profile to edit.
		$(document).on('click','.editRiskBtn',function(){
			var btn = $(this);
			var rdesc = btn.siblings('.fa-info-circle').attr('data-original-title');
			var rname = btn.siblings('span').html();
			var pClass = btn.parents('th').data('pclass');
			
			$('#newRiskField').val(rname);
			$('#newRiskDescField').val(rdesc);
			//$('<input type="hidden" id="pclass" value="'+pClass+'">').appendTo('#newEgrcRisk .modal-footer');
			$('<button id="rmRiskBtn" class="btn btn-sm btn-warning float-left" data-pclass="'+pClass+'" type="button">Remove This Risk</button>').prependTo('#newEgrcRisk .modal-footer');
			$('#newEgrcRisk').modal('show');
			
		});
		
		
		//deleting newly added risk profile before save.
		$(document).on('click','#rmRiskBtn',function(){
			var th = $(this).data('pclass');
			swal({
			  title: "eGRC",
			  text: "Are you sure to delete ?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	var indx = $('.'+th).index();
			  	
			  	//removing table heasding and row cells
			  	$('.'+th).remove();
			  	
			  	//updating the table structure
			  	$('.statementCell').prop('colspan',parseInt($('.statementCell').prop('colspan'))-1);
				$('.riskCell').prop('colspan',parseInt($('.riskCell').prop('colspan'))-1);
			  	
			  } 
			  
			  $('#newEgrcRisk').modal('hide');
			});
			
			
			
		});
		
		
		//reset modal structure when closed.
		$(document).on('hidden.bs.modal','#newEgrcRisk',function(e){
			$('#newRiskField').val('');
			$('#newRiskDescField').val('');
			//$('#newEgrcRisk .modal-footer').find('#pclass').remove();
			$('#newEgrcRisk .modal-footer').find('#rmRiskBtn').remove();
		});
		
		
		//submitting
		$(document).on('submit','.registryForm',function(e){
			//e.preventDefault();
			var newCells = $(this).find('.newRiskCell');
			//validating to select mapping for new added Risk before saving
			newCells.each(function(){
				var status = 0;
				newRadios = $(this).find('.newRiskRadio');
				//console.log(newRadios)
				newRadios.each(function(){
					if($(this).prop('checked')==false){
						status++;
					}
				});
				if(status==3){
					swal({
					  title: "eGRC",
					  text: "Risk Control Mapping is not completed. Please check.",
					  icon: "warning",
					  //buttons: true,
					  dangerMode: true,
					}).then((willDelete) => {
						
						$('.submitProgress').html('');
						$('.isubmitBtn').prop('disabled',false);
					});
					e.preventDefault();
					return;
				}
			});
			
			$(this).find('.submitProgress').html('<button class="falert btn btn-danger btn-sm"><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Saving...</span></button>');
			$('.isubmitBtn').prop('disabled',true);
			
		});
		
		
		$(document).on('click','.delRiskBtn',function(){
			parentCell = $(this).parent('th');
			cellIndex = parentCell.index();
			riskId = $(this).data('risk-id');
			loader = $('.pageLoader');
			
			swal({
			  title: "eGRC",
			  text: "All Related data will also be deleted. Are you sure to delete this Risk?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'deleteEgrcRisk'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.ajax({
						url : thisUrl,
						method : "POST",
						headers: {
						    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
						 },
						data : {id:riskId},
						
						beforeSend : function(xhr) {
							loader.addClass('open');
						},
						success : function(data) {
							
							loader.removeClass('open');
							if(data==1){
								swal({
								  title: "eGRC",
								  text: "Successfully Deleted!",
								  icon: "success",
								  //buttons: true,
								  dangerMode: false,
								});
								
								$('.statementCell').prop('colspan',parseInt($('.statementCell').prop('colspan'))-1);
								$('.riskCell').prop('colspan',parseInt($('.riskCell').prop('colspan'))-1);
								$('.riskCell'+riskId).remove();
								
							} else {
								swal({
								  title: "eGRC",
								  text: "Sorry! Not deleted. Try again after page refresh.",
								  icon: "warning",
								  //buttons: true,
								  dangerMode: true,
								});
							}
							
							
							
						}
					});
				} 
				
			});
			
			
		});
		
		
		
	});
</script>


