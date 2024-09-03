<style>
	.remRisk {
		display:none;
	}
	tr:hover .remRisk {
		display:inline-block;
	}
	.falert {
		padding:1px 4px;font-size:13px;
		display:block;
		margin-top:3px;
		border-radius:3px;
		border:1px solid;
	}
	.remControl {
		display:none;
	}
	.card-header:hover .remControl {
		display:inline-block;
	}
</style>
<div class="main-content white-bg">
       <div class="container-fluid questionborder">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Assessment Submission Form</h5>
               </div>
           </div>
           <div class="row questionborder1 ">
           	<?php if($subType=='Generalized' || $subType=='Other'): /*form would be different for Regulated assessments*/ ?>
           	   <?php echo $this->Form->create($assessment,['class'=>'w-100','type'=>'file']); ?>	
           	   <?php 
           	   		//echo $this->Form->control('client_id',['value'=>'1','type'=>'hidden']);
           	   ?>
               		<?php 
		        		$this->Form->setTemplates([
						    'inputContainer' => '	
						        {{content}} ',
						    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
							'radioWrapper' => '<li>{{label}}<li>'
						]);
		        	?>
                    <div class="col-md-12">
                        <div class="row cisobpadding tool-form-submission">   
                        	<div class="col-md-12">
                        		<div class="row">
                        			<div class="col-sm-3">
                        				<h6 class="questions" style="padding-top:5px;">Assessment Submission Name</h6>
                        			</div>
                        			<div class="col-sm-6">
                        				<?php
		                                	echo $this->Form->control('name',array(
		                                		'class'=>'form-control input-sm',
		                                		'label'=>false,
		                                		'style'=>'width:100%;',
		                                		'required'=>true
		                                	));
		                                ?>
                        			</div>
                        		</div>
                                <br>
                                
                            </div>   
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">Assessment For</h6>
                            </div> 
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<?php
                            		echo $this->Form->control('atype',[
                            			'label'=>false,
                            			'class'=>'form-control input-sm atype',
                            			'type'=>'select',
                            			'options'=>array(''=>'-- Select --','Self'=>'Self Assessment','Independent'=>'Independent Assessment'),
                            			'required'=>true,
                            			'disabled'=>true
                            		]);
                            	?>
                            </div> 
                            <div class="col-12" style="padding:6px;"></div>
                            
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">Assessment Type</h6>
                            </div> 
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12 m-t-10">
                            	<?php
                            		echo $this->Form->control('sub_type',[
                            			'label'=>false,
                            			'class'=>'form-control input-sm subtype',
                            			'type'=>'select',
                            			'options'=>array(''=>'-- Select --','Generalized'=>'Generalized Assessment','Regulated'=>'Regulated Assessment','Other'=>'Other Assessment'),
                            			'required'=>true,
                            			'disabled'=>true
                            		]);
                            	?>
                            </div> 
                            <div class="col-12" style="padding:6px;"></div>
                            
                            <!--          
                            <div class="col-md-12">
                                <h6 class="questions">What compliance body do you wish to have administered to the documentation for submission? </h6>
                                <ul style="list-style:none;">
                                	<?php $radioOptions = array(); ?>
                                	<?php foreach($regulatoryBodies as $body): ?>
                                		<?php 
                                			$radioOptions[]=['text'=>" ".$body['name'],'value'=>$body['id'],'style'=>'color:blue;','required'=>true,'class'=>'rgbody'];
                                		?>
                                	<?php endforeach; ?>	
                                    	<?php 
                                    		echo $this->Form->radio('regulatory_body_id',$radioOptions);
                                    	?>
                                    
                                   
                                    
                                </ul>
                            </div>   
                            <div class="col-12" style="padding:6px;"></div>
                            -->
                            <div class="assessmentInputs col-12" style="padding:35px;">
                            	<div class="row">
									<div class="col-4">
										<div class="card">
											<div class="card-header bg-dark text-white">
												<h6 class="mb-0">
													<!--
													<button type="button" class="btn btn-warning btn-sm float-right customRiskModalBtn" data-toggle="tooltip" title="You can use custom Risk Severity Scales if needed." data-placement="top">
														Use custom scales
													</button>
														-->
													Update Inherent Scores
												</h6>
											</div>
											<div class="card-block">
												<table class="table table-borderless">
													<thead>
														<tr class="active">
															<th>Risk Domains</th>
															<th>
																Inherent Risk Rank
																<i class="fa fa-info-circle text-info float-right" data-toggle="modal" data-target="#scalesModal"></i>
															</th>
															<th>
																<button class="btn btn-sm btn-danger" type="button" style="visibility:hidden;opacity:0;">
																	<i class="fa fa-times"></i>
																</button>
															</th>
														</tr>
													</thead>
													<tbody class="risks">
														
														
														<?php foreach($assessment->assessment_risks as $risk): ?>
															<tr>
																<td>
																	<label class="control-label">
																		<?php echo $risk->risk; ?>
																	</label>
																	<?php if(strlen($risk->risk_description)>0): ?>
																			<i class="fa fa-info-circle text-info float-right" style="margin-top:10px;margin-right:-18px;" title="<?php echo strip_tags($risk->description); ?>" data-toggle="tooltip" data-placement="right"></i>
																	<?php endif; ?>
																</td>
																<td>
																	<input type="hidden" name="GenRisk[inherent][id][]" value="<?php echo $risk->id; ?>">
																	<input type="hidden" name="GenRisk[inherent][name][]" value="<?php echo $risk->risk; ?>">
																	<select required class="form-control input-sm nRScales" name="GenRisk[inherent][scale][]">
																		<option value="">--Select--</option>
																		<?php foreach($assessment->assessment_severity_scales as $scale): ?>
																			<option <?php echo $risk->inherent_scale==$scale->severity_scale?'selected':''; ?> value="<?php echo $scale->severity_scale; ?>"><?php echo $scale->score."-".$scale->severity_scale; ?></option>
																		<?php endforeach; ?>
																	</select>
																</td>
																<td>
																	<button class="remRisk btn btn-sm btn-danger" type="button">
																		<i class="fa fa-times"></i>
																	</button>
																</td>
															</tr>
														<?php endforeach; ?>
													</tbody>
													<tbody>
														<tr>
															<td colspan="3">
																<button class="btn btn-sm btn-info addNewRisk" type="button">
																	<i class="fa fa-plus-square"></i>
																	New Risk	
																</button>
															</td>
														</tr>
													</tbody>
												</table>
												<table class="newRisk" style="display:none;">
													<tbody class="newRiskRow">
													<tr>
														<td>
															<input type="text" class="form-control input-sm" required name="GenRisk[inherent][name][]" value="" placeholder="Enter Risk Name">
														</td>
														<td>
															<select required class="form-control input-sm nRScales" name="GenRisk[inherent][scale][]">
																<option value="">--Select--</option>
																<?php foreach($assessment->assessment_severity_scales as $scale): ?>
																	<option value="<?php echo $scale->severity_scale; ?>"><?php echo $scale->score."-".$scale->severity_scale; ?></option>
																<?php endforeach; ?>
															</select>
														</td>
														<td>
															<button class="remRisk btn btn-sm btn-danger" type="button">
																<i class="fa fa-times"></i>
															</button>
														</td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
										
									</div>
									<div class="col-8">
										<div class="card card-info">
											<div class="card-header bg-dark text-white">
												<h6 class="mb-0">Update Control Requirements</h6>
											</div>
											<div class="card-block" style="padding:8px;">
												<p>
													<button class="btn btn-sm btn-secondary float-right" type="button" data-toggle="modal" data-target="#effectivenessModal">
														Control Effectiveness Scales
													</button>
													Kindly update control requirements for each control.
												</p>
												<div class="accordion" id="controlRequirements">
													<?php foreach($assessment->assessment_controls as $contKey=>$control): ?>
													  <div class="card controlCard" style="border:1px solid #ccc;" data-number="<?php echo $contKey; ?>">
													    <div class="card-header" id="controlHeading<?php echo $control->id; ?>" style="padding:4px 8px;">
													    	<button class="btn btn-danger btn-sm remControl float-right" type="button">
													    		<i class="fa fa-times-circle"></i>
													    	</button>
													      <h6 style="cursor:pointer;" data-toggle="collapse" data-target="#controlCollapse<?php echo $control->id; ?>" aria-expanded="true" aria-controls="controlCollapse<?php echo $control->id; ?>">
													      	 <i class="fa fa-chevron-down"></i>
													      	  <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][id][]" value="<?php echo $control->id; ?>">
													      	  <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][name][]" value="<?php echo $control->name; ?>">
													          <?php echo $control->name; ?>
													          <i class="fa fa-info-circle text-info" style="margin-top:10px" title="<?php echo strip_tags($control->description); ?>" data-toggle="tooltip" data-placement="top"></i>
													      </h6>
													    </div>
													    <div id="controlCollapse<?php echo $control->id; ?>" class="collapse" aria-labelledby="controlHeading<?php echo $control->id; ?>" data-parent="#controlRequirements">
													      <div class="card-bod">
													    	<table class="table table-borderless table-hover">
													    		<thead>
													    			<tr class="bg-light text-dark">
													    				<th>Control Requirement</th>
													    				<th>Artifact File</th>
													    				<th>Reference</th>
													    				
													    			</tr>
													    		</thead>
													    		<tbody class="controlReqBody">
													    			<?php foreach($control->assessment_control_requirements as $creq): ?>
													    				<tr>
													    					<td style="width:40%;">
													    						<?php echo $creq->name; ?>
													    						<input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][req][id][]" value="<?php echo $creq->id; ?>">
													    						<input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][req][name][]" value="<?php echo $creq->name; ?>">
													    					</td>
													    					<td style="width:25%;">
													    						<?php if($creq->artifact!=''): ?>
													    							<input type="hidden" class="artifactUploaded" name="GenControl[control][<?php echo $contKey; ?>][req][artifact][]" value="<?php echo $creq->artifact; ?>">
													    							<span class="falert alert-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div></span>	
													    						<?php else: ?>
													    							<input type="hidden" class="artifactUploaded" name="GenControl[control][<?php echo $contKey; ?>][req][artifact][]">
													    							<input type="file" <?php //echo $required=='Yes'?'required':''; ?> name="tFiles" class="form-control input-sm artifact" accept=".pdf">
													    						<?php endif; ?>
													    					</td>
													    					<td >
													    						<input type="text" class="form-control input-sm" placeholder="Reference info" name="GenControl[control][<?php echo $contKey; ?>][req][reference][]" value="<?php echo $creq->reference; ?>">
													    					</td>
													    					
													    				</tr>
													    			<?php endforeach; ?>
													    		</tbody>
													    	</table>
													      </div>
													    </div>
													  </div>
													<?php endforeach; //controls loop ends ?>
												</div>
												<p style="padding:8px 0px;">
													<button class="btn btn-sm btn-warning addNewControl" type="button">
														<i class="fa fa-plus-square"></i>
														Add Custom Control Area
													</button>
												</p>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <!--
                            <div class="col-12" style="padding:6px;"></div>
                            <div class="col-md-6 col-sm-6">
                            	<div class="inher" style="padding-left:35px;"></div>
                            </div>
                            -->
                            <div class="col-md-12 col-sm-12" >	
                            	<div class="form-row">                                          
                                  <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
		                            	<h6 class="questions">Final Submission</h6>
		                            </div> 
		                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12 m-t-10">
		                            	<?php
                                        	echo $this->Form->control('status',array(
												'type'=>'select','class'=>'form-control input-sm',
												'required'=>true,
												'label'=>false,
												'empty'=>array(''=>'-- Select --'),
												'options'=>array('Submitted'=>'Final Submission to perform assessment','Submitting'=>'Save to continue later.')
											));
                                        ?>
		                            </div> 
                            	</div>
                            <!--
                              <div class="cisoclientform">                  
                                <div class="form-row">                                          
                                  <div class=" col-md-12">
                                  	
                                  	<br>
                                    <p class="input-fields"><span class="text-label">File Upload:</span> 
                                    	
                                    	<?php
                                        	echo $this->Form->control('file',array(
												'type'=>'file','class'=>'file-upload-field',
												'required'=>true,
												'accept'=>'.pdf',
												'label'=>false
											));
                                        ?>
                                    </p>                   
                                  </div>                                          
                                  <div class=" col-md-12">
                                    <p class="input-fields"><span class="text-label">File Name:</span> 
                                    	
                                    	<?php
                                    		echo $this->Form->control('file_name',array(
												'class'=>'file-upload-field',
												'label'=>false
											));
                                    	?>
                                    </p>                   
                                  </div>                      
                                  <div class=" col-md-12">
                                    <p class="input-fields"><span class="text-label">Description:</span> 
                                    	
                                    	<?php
                                    		echo $this->Form->control('file_description',array(
												'class'=>'file-upload-field',
												'label'=>false
											));
                                    	?>
                                    </p>                   
                                  </div> 
                                </div>                    
                              </div>  -->             
                            </div>        
                            <div class="col-md-12 col-sm-12 "><br><br>
                                <center><button type="button" class="cisobtn cisoblue cisopadding cisoblue-outline  sperator-line"><span class="text-blue-bg">Legal disclaimer</span></button></center>
                            </div>
                            <div class="col-md-12 cisosp">
                                <h6 class="questions">To the best of [user's] knowledge, the contents of the questionnaire and documents to be submitted have
                                    not been falsified, and contain accurate and reliable information.</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                         <center>
                                             <div class="image-upload-prw" style=" text-align: center;"> 
                                              <!--
                                              <?php if(empty($assessment->signature)): ?>
                                                    <?php $requiredSignatures = true; ?>
                                                  <?php echo $this->Html->image('us.png',array('id'=>'vphoto','style'=>'cursor:pointer;')); ?>
                                                <?php else: ?>
                                                    <img id="vphoto" src="<?php echo $assessment->signature; ?>" style="cursor:pointer;">
                                                    <?php $requiredSignatures = false; ?>
                                                <?php endif; ?>
                                                -->
    
                                                <?php
                                                	/*
													echo $this->Form->control('signature',array(
														'type'=>'file','class'=>'upfbtn',
														'id'=>'signImage','required'=>$requiredSignatures,
														'accept'=>'.jpg,.png,.gif',
														'label'=>false
													));*/
													echo $this->Form->control('signature',array(
														'type'=>'text','class'=>'form-control text-center',
														'required'=>true,'readonly'=>true,
														'label'=>false,
														'value'=>$assessment->signature,
														'style'=>'height:100%;border:none;'
													));

                                                ?>
                                                
                                             </div>
                                             <span>[First Name - Last Name]</span>
                                         </center>
                                    </div>
                                    <div class="col-md-6">
                                        <center>
                                             <div class="currentdate"><?php echo date('d M, Y',time()); ?></div>
                                             <span>[Day/Month/Year]</span>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12"><br><br>
                                <h6 class="questions">“The submission of this signature consistutes the user’s agreement to the terms and conditions of this assessment 
                                    as well as the confirmation that the information provided is accurate to the best of the signing user’s knowledge.”
                                </h6>
                           </div>
                            <div class="col-md-3 col-sm-12 "><br><br>
                               <center><button type="submit" class="cisobtn cisoblue cisopadding cisoblue-outline submit-form-btn">Submit</button></center>
                            </div>
                        </div>
                    </div>
               <?php $this->Form->unlockField('GenControl'); ?>
               <?php $this->Form->unlockField('GenRisk'); ?>
               <div class="nRiskScalesUsed"></div>
               <?php echo $this->Form->end(); ?>
               <?php else: /*form for generalized and other assessments ends */?>
               		<h3>Work in progress...</h3>
               <?php endif; /*form for regulated assessments ends here*/ ?>
           </div>      
       </div>
        <script>
			noe = $('#controlRequirements').find('.controlCard');
			noe = noe.length;
			crow = "";
			rqRow = "";
			$(function(){
				$('[data-toggle="tooltip"]').tooltip();
				$('[data-toggle="popover"]').popover();
				
			});
			
		</script>
        <!-- content wrapper -->
  </div>
<!--custom Risk Scale Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="customScalesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Custom Severity Scales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body rScaleBody">
      	<div class="row form-group">
        	<div class="col-8">
        		<label><b>Risk Severity Scale Name</b></label>
        	</div>
        	<div class="col-4">
        		<label><b>Score</b></label> 
        	</div>
        </div>
        <div class="nnrow">
        	<?php foreach($assessment->assessment_severity_scales as $asrScale): ?>
        		<div class="">
			        <div class="row form-group">
			        	<div class="col-1">
			        		<button class="btn btn-sm btn-danger remNr" style="display:none;" type="button">
			        			<i class="fa fa-times-circle"></i>
			        		</button>
			        	</div>
			        	<div class="col-7">
			        		<input type="hidden" class="nRenRScaleIds" name="GenRisk[rScales][id][]" required value="<?php echo $asrScale->id; ?>">
			        		<input type="text" class="form-control input-sm nGenRScales" name="GenRisk[rScales][name][]" placeholder="Severity Scale Name" required value="<?php echo $asrScale->severity_scale; ?>">
			        	</div>
			        	<div class="col-4">
			        		<input type="number" class="form-control input-sm nGenRScaleScores" min="0" name="GenRisk[rScales][score][]" placeholder="0.0" required value="<?php echo $asrScale->score; ?>"> 
			        	</div>
			        </div>
		        </div>
        	<?php endforeach; ?>
	        <div class="nrow">
		        <div class="row form-group">
		        	<div class="col-1">
		        		<button class="btn btn-sm btn-danger remNr" type="button">
		        			<i class="fa fa-times-circle"></i>
		        		</button>
		        	</div>
		        	<div class="col-7">
		        		<input type="hidden" class="nRenRScaleIds" name="GenRisk[rScales][id][]" required value="new">
		        		<input type="text" class="form-control input-sm nGenRScales" name="GenRisk[rScales][name][]" placeholder="Severity Scale Name" required>
		        	</div>
		        	<div class="col-4">
		        		<input type="number" class="form-control input-sm nGenRScaleScores" min="0" name="GenRisk[rScales][score][]" placeholder="0.0" required> 
		        	</div>
		        </div>
	        </div>
        </div>
        <div class="myBtn">
        	<button class="btn btn-sm btn-inverse nScaleBtn" type="button"><i class="fa fa-plus"></i> New</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary useNewRiskScales">Confirm Now</button>
      </div>
      <script>
      	$(function(){
      		var nr = $('.nrow').html();
      		
      		$('.nrow').html('');
      		$(document).on('click','.nScaleBtn',function(){
      			$('.nrow').append(nr);
      		});
      		$(document).on('click','.remNr',function(){
      			$(this).parents('.row').remove();
      		});
      		$('#customScalesModal').on('hidden.bs.modal', function (e) {
			  //$('.nrow').remove();
			  //$('.nnrow').append("<div class='nrow'>"+nr+"</div>");
      		});
			
      		$(document).on('click','.useNewRiskScales',function(){
      			nscales = $('.rScaleBody').find('.nGenRScales');
      			nscores = $('.rScaleBody').find('.nGenRScaleScores');
      			nsids =  $('.rScaleBody').find('.nRenRScaleIds');
      			nscl = new Array();
      			nscr = new Array();
      			
      			nscales.each(function(){
      				nscl.push($(this).val());
      			});
      			nscores.each(function(){
      				nscr.push($(this).val());
      			});
      			nsOptions = "<option value=''>--Select--</option>";
      			for(i=0;i<nscl.length;i++){
      				if(nscl[i].length>0){
      					nsOptions+="<option value='"+nscl[i]+"'>"+nscr[i]+"-"+nscl[i]+"</option>";
      				}
      			}
      			console.log(nsOptions);
      			$('.nRScales').html('');
      			$('.nRScales').html(nsOptions);
      			
      			
      			$('.nRiskScalesUsed').html('');
      			//inserting into the form to submit along with
      			nscales.each(function(){
      				$(this).clone().appendTo('.nRiskScalesUsed');
      			});
      			nscores.each(function(){
      				$(this).clone().appendTo('.nRiskScalesUsed');
      			});
      			nsids.each(function(){
      				$(this).clone().appendTo('.nRiskScalesUsed');
      			});
      			$('.nRiskScalesUsed').find('input').prop('type','hidden');
      			
      			newRisk = '<tr><td><input type="text" class="form-control input-sm" required name="GenRisk[inherent][name][]" value="" placeholder="Enter Risk Name">';
      			newRisk += '</td><td><select required class="form-control input-sm nRScales" name="GenRisk[inherent][scale][]">'+nsOptions;
				newRisk += '</select></td><td><button class="remRisk btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i></button></td></tr>';
      			
      			$('#customScalesModal').modal('hide');
      		});
      		
      	});
      </script>
    </div>
  </div>
</div>
<!-- risk scale modal ends-->


<script>
		newRisk='';
    	$(function(){
    		newRisk = $('.assessmentInputs').find('.newRiskRow').html();
			$('.assessmentInputs').find('.newRisk').remove();
			
    		$(document).on('click','.customRiskModalBtn',function(){
    			$('#customScalesModal').modal('show');
    		});
    		
    		var loading = '<div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Loading...</span></div>';
    		
    		
    		//event handler to add new Risk profile for generalized assessment submission
    		$(document).on('click','.addNewRisk',function(){
				$(newRisk).appendTo('.risks');
			});
    		$(document).on('click','.remRisk',function(){
				if(confirm("Are you sure ?")){
					$(this).parents('tr').remove();
				}
			});
			
			
			//handling artifact file upload.
			$(document).on('change','.artifact',function(){
				//removing error message if present
				$(this).parent('td').find('.falert').remove();
				finput=$(this);
				
				var file = $(this).get(0).files[0];
				var name = file.name;
				//console.log(file);
				
				var form_data = new FormData();
				form_data.append("afile", file);
				var ext = name.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext, ['pdf']) == -1){
					$('<span class="falert alert-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
					$(this).val('');
				} else {
					console.log(file);
					finput.parent('td').find('.falert').remove();
					
					$.ajax({
						url : "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'uploadArtifact')); ?>",
						method : "POST",
						headers: {
						    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
						 },
						data : form_data,
						contentType : false,
						cache : false,
						processData : false,
						beforeSend : function(xhr) {
							$('<span class="falert alert-warning"><div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Uploading...</span></div></span>').insertAfter(finput);
						},
						success : function(data) {
							console.log(data);
							finput.parent('td').find('.artifactUploaded').val('');
							if(data==3){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
								finput.val('');
							} else if(data==4){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> No file provided.</span>').insertAfter(finput);
								finput.val('');
							} else if(data==0){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Sorry! Try again.</span>').insertAfter(finput);
								finput.val('');
							} else if(data.indexOf("http")>-1){
								finput.parent('td').find('.artifactUploaded').val(data);
								finput.prop('type','hidden');
								finput.prop('required',false);
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div></span>').insertAfter(finput);
							} else {
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Sorry! Something went wrong. Try again.</span>').insertAfter(finput);
								finput.val('');
							}
						}
					});
					
				}
			}); //articact file upload ends
			
			
			//control area add/remove functions
			//variables "noe" is declared in the get_risk_and_control.ctp file 
			$(document).on('click','.addNewControl',function(){
				parent = $('#controlRequirements');
				var atype = $('.atype').val();
				
				//adding New Control
				crow = '<div class="card controlCard" style="border:1px solid #ccc;" data-number="'+(noe)+'">';
				crow += '<div class="card-header" id="controlHeadingNew'+(noe+1)+'" style="padding:4px 8px;">';
				crow += '<button class="btn btn-danger btn-sm remControl float-right" type="button"><i class="fa fa-times-circle"></i></button><h6 style="cursor:pointer;" ><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#controlCollapseNew'+(noe+1)+'" aria-expanded="true" aria-controls="controlCollapseNew'+(noe+1)+'">';
				crow += '<i class="fa fa-chevron-down"></i></button>';
				crow += '<input type="text" style="width:50%;display:inline-block;" class="form-control input-sm" name="GenControl[control]['+(noe)+'][name][]" value="">';
				crow += '</h6></div><div id="controlCollapseNew'+(noe+1)+'" class="collapse" aria-labelledby="controlHeadingNew'+(noe+1)+'" data-parent="#controlRequirements">';
				crow += '<div class="card-bod"><table class="table table-borderless table-hover">';
				crow += '<thead><tr class="bg-light text-dark"><th>Control Requirement</th><th>Artifact File</th>';
				crow += '<th>Reference</th></tr></thead><tbody class="controlReqBody"></tbody></table><p style="padding:8px;"><button class="btn btn-sm btn-primary addNewControlReq" type="button"><i class="fa fa-plus-square"></i>';
				crow += ' Add Control Requirement</button></p></div></div></div>';
				parent.append(crow);
				//alert(crow);
				noe++;
			});
			
			//adding control requirement to particular control
			$(document).on('click','.addNewControlReq',function(){
				parent = $(this).parents('.controlCard');
				noc = parent.attr('data-number');
				var reqrd = "";
				if(atype=='Self'){
					reqrd="required";
				}
				//adding new control requirement to control
				rqRow = '<tr><td style="width:40%;"><input type="text" class="form-control input-sm" name="GenControl[control]['+noc+'][req][name][]" value="">';
				rqRow += '</td><td style="width:25%;"><input type="hidden" class="artifactUploaded" name="GenControl[control]['+noc+'][req][artifact][]">';
				rqRow += '<input type="file" '+reqrd+' class="form-control input-sm artifact" accept=".pdf">';
				rqRow += '</td><td ><input type="text" class="form-control input-sm" placeholder="Reference info" name="GenControl[control]['+noc+'][req][reference][]"></td></tr>';
				//alert(rqRow);
				parent.find('.controlReqBody').append(rqRow);
			});
			
			//removing control area
			$(document).on('click','.remControl',function(){
				var btn = $(this);
				if(confirm("Are you sure to remove this Control ?")){
					btn.parents('.controlCard').remove();
				}
			});
			//controlarea add/remove functions ends
				
		}); //document ready ends
	
    /*
	$(function(){
		var loading = '<br><p><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Loading...</span></p>';
		
		$(document).on('click','.rgbody',function(){
			$('.inher').html(loading);
			var rgbody = $(this).val();
			$('.inher').load("<?php //echo $this->Url->build(array('controller'=>'assessments','action'=>'updateInherent'),true); ?>//"+rgbody);
		});
		
	});
	*/
</script>