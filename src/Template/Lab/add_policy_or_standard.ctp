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
										<b> Add Policy or Standard </b>
									</div>
								</div>
								<div class="card-body">
									<?php echo $this -> Form -> create('Policy',['type'=>'file']); ?>
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
										<div class="col-3">
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
											<label class="control-label">Type</label>
										</div>
										<div class="col-3">
											<?php 
												echo $this->Form->control('type',[
													'type'=>'select',
													'empty'=>[''=>' -- Select --'],
													'label'=>false,
													'options'=>[
														'Policy'=>'Policy','Standard'=>'Standard'
													],
													'required'=>true,
													'class'=>'form-control ptype'
												]);
											 ?>
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											<label class="control-label"><span class="ps"></span> Name</label>
										</div>
										<div class="col-3">
											<?php 
												echo $this->Form->control('name',[
													'type'=>'text',
													'label'=>false,
													'required'=>true,
													'class'=>'form-control'
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
													'required'=>true,
													'class'=>'form-control datepicker',
													'autocomplete'=>'off'
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
													'required'=>true,
													'class'=>'form-control'
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
													'required'=>true,
													'class'=>'form-control docNumber'
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
													'required'=>true,
													'class'=>'form-control'
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
													'type'=>'text',
													'label'=>false,
													'required'=>true,
													'class'=>'form-control'
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
												<tbody class="respTbody">
													<tr class="respRow">
														<td>
															<?php 
																echo $this->Form->control('policy_responsibilities.roles.',[
																	'type'=>'text',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_responsibilities.responsibilities.',[
																	'type'=>'textarea',
																	'rows'=>'2',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
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
											<label class="control-label"><span class="ps">Policy</span> Statements</label>
										</div>
										<div class="col-9">
											<table class="table table-bordered font-14">
												<thead>
													<tr class="table-active">
														<th>Statements</th>
														<th></th>
													</tr>
												</thead>
												<tbody class="stateTbody">
													<tr class="stateRow">
														
														<td>
															<?php 
																echo $this->Form->control('policy_statements.name.',[
																	'type'=>'textarea',
																	'rows'=>'2',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control',
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
													'required'=>true,
													'class'=>'form-control'
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
												<tbody class="defTbody">
													<tr class="defRow">
														<td>
															<?php 
																echo $this->Form->control('policy_definitions.term.',[
																	'type'=>'text',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_definitions.definition.',[
																	'type'=>'textarea',
																	'rows'=>'2',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
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
													'required'=>true,
													'class'=>'form-control'
												]);
											 ?>
										</div>
									</div>
									<div class="row">
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
												<tbody class="appTbody">
													<tr class="appRow">
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.name.',[
																	'type'=>'text',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.title.',[
																	'type'=>'text',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
																]);
															?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.department.',[
																	'type'=>'text',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
																]);
															?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('policy_approvers.email.',[
																	'type'=>'text',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
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
																	'required'=>true,
																	'class'=>'form-control'
																]);
															 ?>
														</td>
														<td>
															<?php 
																echo $this->Form->control('document_owner_email',[
																	'type'=>'email',
																	'label'=>false,
																	'required'=>true,
																	'class'=>'form-control'
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
													<button class="btn btn-primary btn-block" type="submit" name="status" value="Final">
														<i class="fa fa-check"></i>
														Add <span class="ps">Policy</span>
													</button>
												</div>
												<div class="col-5">
													<button class="btn btn-secondary float-right" type="submit" name="status" value="Draft">
														<i class="fa fa-edit"></i>
														Save Draft
													</button>
												</div>
											</div>
											
											
										</div>
									</div>
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
	$(function(){
		var docNumbers = <?php echo $docNumbers; ?>;
		var rows = {
			'resp':$('.respTbody').html(),
			'state':$('.stateTbody').html(),
			'def':$('.defTbody').html(),
			'app':$('.appTbody').html()
		};
		
		$(document).on('click','.addMore',function(){
			var type = $(this).data('type');
			var newRow = rows[type];
			$("."+type+"Tbody").append(newRow);
			
			if(type=='app'){
				var radios = $("."+type+"Tbody").find('input[type="checkbox"]');
				var i = 0;
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
		
		$(document).on('change','.ptype',function(){
			$('.ps').html($(this).val());
			if($(this).val()!=""){
				$('.docNumber').val(docNumbers[$(this).val()]);
			} else {
				$('.docNumber').val('');
			}
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
		
		
		
	});
</script>