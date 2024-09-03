<style>
	.control-label {
		text-transform:uppercase;
	}
	
	.removeRow {
		
		//border:1px solid #ccc;
		width:35px;
		height:35px;
		text-align:center;
		line-height:30px;
		font-size:20px;
		border-radius:4px;
		color:#999;
		cursor:pointer;
	}
	.removeRow:hover {
		color:red;
		border-color:red;
	}
	.form-group {
		margin-bottom:35px;
	}
	tr .form-group {
		margin-bottom:0px;
	}
	.custom-control-label {
		cursor:pointer !important;
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
					<div class="row">
						<div class="col-10 offset-1">
							<div class="card">
								<div class="card-header text-primary">
									<div class="">
										<b> Modify <?php echo $dtype; ?> </b>
									</div>
								</div>
								<div class="card-body">
									<?php echo $this -> Form -> create('Policy',['type'=>'file','url'=>$this->Url->build(array('controller'=>'lab','action'=>'saveEditPolicy',$policy->id),true)]); ?>
									<?php
										$this->Form->setTemplates([
											'inputContainer' => '<div class="form-group">
											{{content}} </div>'
										]);
									?>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Logo</label>
										</div>
										<div class="col-1">
											<?php if($policy->logoType==false): ?>
												<b><?php echo $policy->logo; ?></b>
											<?php else: ?>
												<img src="<?php echo $policy->logo; ?>" style="max-height:40px;max-width:100%;">
											<?php endif; ?>
										</div>
										<div class="col-2">
											<?php 
												echo $this->Form->control('logo',[
													'type'=>'file',
													'accept'=>'image/*',
													'label'=>false,
													'class'=>'form-control',
													'id'=>'logo'
												]);
											 ?>
										</div>
										<div class="col-3">
											<small class="text-secondary">
												<i>
													Logo Image should have height of 100px maximum.
												</i>
											</small>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label"><?php echo $dtype; ?> Name</label>
										</div>
										<div class="col-3">
											<?php 
												echo $this->Form->control('name',[
													'type'=>'text',
													'label'=>false,
													'required'=>true,
													'class'=>'form-control',
													'value'=>$policy->name
												]);
												echo $this->Form->control('type',[
													'type'=>'hidden',
													'label'=>false,
													'required'=>true,
													'class'=>'form-control',
													'value'=>$dtype
												]);
											 ?>
										</div>
										
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">EFFECTIVE DATE</label>
										</div>
										<div class="col-3">
											<?php 
												echo $this->Form->control('effective_date',[
													//'type'=>'text',
													'label'=>false,
													//'required'=>true,
													'class'=>'form-control datepicker req',
													'autocomplete'=>'off',
													'value'=>empty($policy->effective_date)?'':$policy->effective_date->format('m/d/Y'),
													
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Review Frequency</label>
										</div>
										<div class="col-3">
											<?php 
												echo $this->Form->control('review_frequency',[
													'type'=>'select',
													'empty'=>[''=>' -- Select --'],
													'label'=>false,
													'options'=>[
														'Monthly'=>'Monthly','Quarterly'=>'Quarterly','Annually'=>'Annually'
													],
													//'required'=>true,
													'class'=>'form-control req',
													'value'=>$policy->review_frequency
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Document Number</label>
										</div>
										<div class="col-3">
											<?php 
												echo $this->Form->control('document_number',[
													'type'=>'text',
													'label'=>false,
													//'required'=>true,
													'class'=>'form-control req',
													'value'=>$policy->document_number
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Purpose</label>
										</div>
										<div class="col-9">
											<?php 
												echo $this->Form->control('purpose',[
													'type'=>'textarea',
													'label'=>false,
													//'required'=>true,
													'class'=>'form-control req',
													'value'=>$policy->purpose
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Scope</label>
										</div>
										<div class="col-9">
											<?php 
												echo $this->Form->control('scope',[
													'type'=>'textarea',
													'label'=>false,
													//'required'=>true,
													'class'=>'form-control req',
													'value'=>$policy->scope
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Responsibilities</label>
										</div>
										<div class="col-9">
											<table class="table table-bordered font-14">
												<thead>
													<tr class="table-active">
														<th width="35%">Roles</th>
														<th>Responsibilities</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($policy->policy_responsibilities as $pResp): ?>
														<tr class="respRow">
															<td>
																<?php 
																	echo $this->Form->control('policy_responsibilities.id.',[
																		'type'=>'hidden',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pResp->id
																	]);
																	echo $this->Form->control('policy_responsibilities.roles.',[
																		'type'=>'text',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pResp->roles
																	]);
																 ?>
															</td>
															<td>
																<?php 
																	echo $this->Form->control('policy_responsibilities.responsibilities.',[
																		'type'=>'textarea',
																		'rows'=>'2',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pResp->responsibilities
																	]);
																?>
															</td>
															<td style="width:50px;">
																<i class="fa fa-trash removeRow" data-type="resp"></i>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
												<tbody class="respTbody">
													<tr class="respRow">
														<td>
															<?php 
																echo $this->Form->control('policy_responsibilities.roles.',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_responsibilities.responsibilities.',[
																	'type'=>'textarea',
																	'rows'=>'2',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req'
																]);
															?>
														</td>
														<td style="width:50px;">
															<i class="fa fa-trash removeRow" data-type="resp"></i>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<td colspan="3">
															<button class="btn btn-sm btn-secondary addMore" data-type="resp" type="button">Add More</button>
														</td>
													</tr>
												</tbody>
											</table>
											
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label"><?php echo $dtype; ?> Statements</label>
										</div>
										<div class="col-9">
											<table class="table table-bordered font-14">
												<thead>
													<tr class="table-active">
														<th>Statements</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($policy->policy_statements as $pStatement): ?>
														<tr class="stateRow">
															<td>
																<?php 
																	echo $this->Form->control('policy_statements.id.',[
																		'type'=>'hidden',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pStatement->id
																	]);
																	echo $this->Form->control('policy_statements.name.',[
																		'type'=>'textarea',
																		'rows'=>'2',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pStatement->name
																	]);
																?>
															</td>
															<td style="width:50px;">
																<i class="fa fa-trash removeRow" data-type="state"></i>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
												<tbody class="stateTbody">
													<tr class="stateRow">
														
														<td>
															<?php 
																echo $this->Form->control('policy_statements.name.',[
																	'type'=>'textarea',
																	'rows'=>'2',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req',
																]);
															?>
														</td>
														<td style="width:50px;">
															<i class="fa fa-trash removeRow" data-type="state"></i>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<td colspan="2">
															<button class="btn btn-sm btn-secondary addMore" data-type="state" type="button">Add More</button>
														</td>
													</tr>
												</tbody>
											</table>
											
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Exceptions</label>
										</div>
										<div class="col-9">
											<?php 
												echo $this->Form->control('exceptions',[
													'type'=>'textarea',
													'label'=>false,
													//'required'=>true,
													'class'=>'form-control req',
													'value'=>$policy->exceptions
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Definitions</label>
										</div>
										<div class="col-9">
											<table class="table table-bordered font-14">
												<thead>
													<tr class="table-active">
														<th width="35%">Term</th>
														<th>Definition</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($policy->policy_definitions as $pDef): ?>
														<tr class="defRow">
															<td>
																<?php 
																	echo $this->Form->control('policy_definitions.id.',[
																		'type'=>'hidden',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pDef->id
																	]);
																	echo $this->Form->control('policy_definitions.term.',[
																		'type'=>'text',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pDef->term
																	]);
																 ?>
															</td>
															<td>
																<?php 
																	echo $this->Form->control('policy_definitions.definition.',[
																		'type'=>'textarea',
																		'rows'=>'2',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control req',
																		'value'=>$pDef->definition
																	]);
																?>
															</td>
															<td style="width:50px;">
																<i class="fa fa-trash removeRow" data-type="def"></i>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
												<tbody class="defTbody">
													<tr class="defRow">
														<td>
															<?php 
																echo $this->Form->control('policy_definitions.term.',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_definitions.definition.',[
																	'type'=>'textarea',
																	'rows'=>'2',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req'
																]);
															?>
														</td>
														<td style="width:50px;">
															<i class="fa fa-trash removeRow" data-type="def"></i>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<td colspan="3">
															<button class="btn btn-sm btn-secondary addMore" data-type="def" type="button">Add More</button>
														</td>
													</tr>
												</tbody>
											</table>
											
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label">Related Documents</label>
										</div>
										<div class="col-9">
											<?php 
												echo $this->Form->control('related_documents',[
													'type'=>'textarea',
													'label'=>false,
													//'required'=>true,
													'class'=>'form-control req',
													'value'=>$policy->related_documents
												]);
											 ?>
										</div>
									</div>
									<div class="row" style="display:none">
										<div class="col-3">
											<label class="control-label">Approvals</label>
										</div>
										<div class="col-9">
											<table class="table table-bordered font-14">
												<thead>
													<tr class="table-active">
														<th width="35%">Name</th>
														<th>Title</th>
														<th>Department</th>
														<th>Email</th>
														<th>Author</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($policy->policy_approvers as $kk=>$pApprover): ?>
														<tr class="appRow">
															<td>
																<?php 
																	echo $this->Form->control('policy_approvers.id.',[
																		'type'=>'hidden',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control ',
																		'value'=>$pApprover->id
																	]);
																	echo $this->Form->control('policy_approvers.name.',[
																		'type'=>'text',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control ',
																		'value'=>$pApprover->name
																	]);
																 ?>
															</td>
															<td>
																<?php 
																	echo $this->Form->control('policy_approvers.title.',[
																		'type'=>'text',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control',
																		'value'=>$pApprover->title
																	]);
																?>
															</td>
															<td>
																<?php 
																	echo $this->Form->control('policy_approvers.department.',[
																		'type'=>'text',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control',
																		'value'=>$pApprover->department
																	]);
																?>
															</td>
															<td>
																<?php 
																	echo $this->Form->control('policy_approvers.email.',[
																		'type'=>'text',
																		'label'=>false,
																		//'required'=>true,
																		'class'=>'form-control approverEmail',
																		'value'=>$pApprover->email
																	]);
																?>
															</td>
															<td>
																<div class="form-group text-center">
																	
																	<div class="custom-control custom-checkbox">
																		<?php 
																			echo $this->Form->checkbox('policy_approvers.type.',[
																				'label'=>false,
																				'class'=>'custom-control-input appCheckBox',
																				'id'=>'Check'.$kk,
																				'hiddenField'=>true,
																				'checked'=>$pApprover->type=='Author'?true:false
																			]);
																		?>
																	  <!--
																	  <input type="checkbox" class="custom-control-input appCheckBox" name="PolicyApprovers[type][]" value="Author" id="customCheck1">
																	  -->
																	  <label class="custom-control-label" for="<?php echo 'Check'.$kk; ?>"></label>
																	</div>
																</div>
															</td>
															<td style="width:50px;">
																<i class="fa fa-trash removeRow" data-type="app"></i>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
												<tbody class="appTbody">
													<tr class="appRow">
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.name.',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.title.',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control'
																]);
															?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.department.',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control'
																]);
															?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.email.',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control approverEmail'
																]);
															?>
														</td>
														<td>
															<div class="form-group text-center">
																<div class="custom-control custom-checkbox">
																	<?php 
																		echo $this->Form->checkbox('policy_approvers.type.',[
																			'label'=>false,
																			'class'=>'custom-control-input appCheckBox',
																			'id'=>'Check0',
																			'hiddenField'=>true
																		]);
																	?>
																  <!--
																  <input type="checkbox" class="custom-control-input appCheckBox" name="PolicyApprovers[type][]" value="Author" id="customCheck1">
																  -->
																  <label class="custom-control-label" for="Check0"></label>
																</div>
															</div>
														</td>
														<td style="width:50px;">
															<i class="fa fa-trash removeRow" data-type="app"></i>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<td colspan="6">
															<button class="btn btn-sm btn-secondary addMore" data-type="app" type="button">Add More</button>
														</td>
													</tr>
												</tbody>
											</table>
											
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label" style="display:block;">&nbsp;	</label>
											<label class="control-label">Document Owner</label>
										</div>
										<div class="col-9">
											<table class="table table-bordered font-14">
												<thead>
													<tr class="table-active">
														<th width="40%">Name</th>
														<th>Email</th>
													</tr>
												</thead>
												<tbody class="">
													<tr class="">
														<td>
															<?php 
																echo $this->Form->control('document_owner_name',[
																	'type'=>'text',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req',
																	'value'=>$policy->document_owner_name
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('document_owner_email',[
																	'type'=>'email',
																	'label'=>false,
																	//'required'=>true,
																	'class'=>'form-control req',
																	'value'=>$policy->document_owner_email
																]);
															 ?>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-4 offset-4">
											<div class="row">
												<div class="col-7">
													<button class="btn btn-primary btn-block pSubmit" type="submit" name="status" value="Final">
														<i class="fa fa-check"></i>
														Final Update <?php echo $dtype; ?>
													</button>
												</div>
												
												<div class="col-5">
													<button class="btn btn-secondary float-right pSubmit" type="submit" name="status" value="Draft">
														<i class="fa fa-edit"></i>
														Save Draft
													</button>
												</div>
												
											</div>
											
											
										</div>
									</div>
									<?php $this->Form->unlockField('policy_approvers.id'); ?>
									<?php $this->Form->unlockField('policy_definitions.id'); ?>
									<?php $this->Form->unlockField('policy_responsibilities.id'); ?>
									<?php $this->Form->unlockField('policy_statements.id'); ?>
									<?php $this->Form->unlockField('status'); ?>
									
									<?php echo $this -> Form -> end(); ?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- map section closed -->

	<!-- content wrapper -->
</div>
<script>
	var rproto = "<?php echo $uProto; ?>";
	$(function(){
		
		//correcting form action url
		var furl = $('form').prop('action');
		furl = furl.replace("http:", rproto);
		$('form').prop('action',furl)
		
		
		var rows = {
			'resp':$('.respTbody').html(),
			'state':$('.stateTbody').html(),
			'def':$('.defTbody').html(),
			'app':$('.appTbody').html()
		};
		<?php if(count($policy->policy_responsibilities)>0): ?>
			$('.respTbody').html('');
		<?php endif; ?>
		<?php if(count($policy->policy_statements)>0): ?>
			$('.stateTbody').html('');
		<?php endif; ?>
		<?php if(count($policy->policy_definitions)>0): ?>
			$('.defTbody').html('');
		<?php endif; ?>
		<?php if(count($policy->policy_approvers)>0): ?>
			$('.appTbody').html('');
		<?php endif; ?>
		
		
		$(document).on('click','.addMore',function(){
			var type = $(this).data('type');
			var newRow = rows[type];
			$("."+type+"Tbody").append(newRow);
			
			if(type=='app'){
				var radios = $("."+type+"Tbody").find('input[type="checkbox"]');
				var i = <?php echo count($policy->policy_approvers); ?>+1;
				radios.each(function(){
					$(this).prop('id',"Check"+i);
					$(this).siblings('label').prop('for',"Check"+i);
					i++;
				});
			}
			
			
		});
		$(document).on('click','.removeRow',function(){
			var type = $(this).data('type');
			$(this).parents("."+type+"Row").remove();
		});
		
		$(document).on('click','.appCheckBox',function(){
			var checks = $('.appCheckBox:not(#'+$(this).prop('id')+')');
			//console.log($(this).prop('checked'));
			if($(this).prop('checked')){
				$(this).siblings('input[type="hidden"]').prop('disabled',true);
				checks.each(function(){
					$(this).prop('checked',false);
					$(this).siblings('input[type="hidden"]').prop('disabled',false);
				});
			}
			
		});
		
		
		//validating image dimentions for logo
		var _URL = window.URL || window.webkitURL;
		$(document).on('change','#logo',function(e){
			var file, img;
		    if ((file = this.files[0])) {
		        img = new Image();
		        img.onload = function () {
		          //alert(this.width + " " + this.height);
		          if(this.height>100){
		          	swal({
						  title: "eGRC",
						  text: "Sorry! Maximum Logo Height should less than or equal to 100px",
						  icon: "error",
						  dangerMode: true,
					});
					$('#logo').val('');
		          }
		          
		        };
		        img.src = _URL.createObjectURL(file);
		    }
		});
		
		$(document).on('click','.pSubmit',function(e){
			
			$('.req').prop('required',false);
			
			btn = $(this);
			ptype = btn.prop('value');
			if(ptype=='Final'){
				$('.req').prop('required',true);
			} else {
				$('.req').prop('required',false);
			}
			
		});
		
		$(document).on('blur','.approverEmail',function(e){
			var aField = $(this);
			var email = aField.val();
			if(email){
				
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'isApproverExist'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				
				$.ajax({
					url: thisUrl+"/"+email, 
					success: function(result){
					   if(result!=1){
					   	aField.addClass('is-invalid');
					   	aField.parent('.form-group').append('<span class="help-block text-danger">Approver Does not Exist.</span>');
					   	$('.pSubmit').prop('disabled',true);
					   	
					   } else {
					   	aField.removeClass('is-invalid');
					   	aField.parent('.form-group').find('.help-block').remove();
					   	
					   	var ab=0;
					   	$('.approverEmail').each(function(){
					   		if($(this).hasClass('is-invalid')){
					   			ab++;
					   		}
					   	});
					   	
					   	if(ab==0) {
					   	   	$('.pSubmit').prop('disabled',false);
					   	}
					   	
					   }
					},
					beforeSend:function(){
						
						$('.pSubmit').prop('disabled',true);
					}
				});
			}
		});
		
		
	});
</script>