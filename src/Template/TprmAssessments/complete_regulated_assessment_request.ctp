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
	.remRBody {
		display:none;
	}
	.card:hover .remRBody {
		display:inline-block;
	}
	
</style>
<script>
	reguNewRisk = {"test":"test value"}; 
</script>
<div class="main-content white-bg">
       <div class="container-fluid questionborder">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Assessment Submission Form</h5>
               </div>
           </div>
           <div class="row questionborder1 ">
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
                            
                            <div class="assessmentInputs col-12" style="padding:35px;">
                            	<div class="col-md-12 col-sm-12" style="margin-left:-35px;">	
							    	<div class="form-row">                                          
							          <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
							            	<h6 class="questions">Select Regulatory Body</h6>
							            </div> 
							            <div class="col-md-7 col-sm-7 col-md-7 col-xs-12 m-t-10">
							            	<ul class="thisRegulatoryBodies">
							            		<?php $myRBodies = (array) $assessment->assessments_regulatory_bodies; /*for regulatory bodies list below*/ ?>
												<?php foreach($regulatoryBodies as $rBody): ?>
													<li>
														<?php
															$arb_id = "";
															$arb_id = gettype (array_search($rBody->id, array_column($myRBodies, 'regulatory_body_id')))==gettype(0)?$myRBodies[array_search($rBody->id, array_column($myRBodies, 'regulatory_body_id'))]['id']:"";
														?>
											    		<?php 
											        		echo $this->Form->control('regulatoryBody['.$rBody->id.']['.$arb_id.']',[
											        			'value'=>$rBody->id,
											        			'id'=>'regulatoryBody'.$rBody->id,
											        			'label'=>array('text'=>" ".$rBody->name,),
											        			'type'=>'checkbox',
											        			'hiddenField'=>false,
											        			'class'=>'reguBody',
											        			'checked'=>gettype (array_search($rBody->id, array_column($myRBodies, 'regulatory_body_id')))==gettype(0)?TRUE:FALSE
											        		]);
											        	?>
											        </li>
										    	<?php endforeach; ?>
											</ul>
							            </div> 
							            <div class="col-md-12 col-sm-12 col-md-12 col-xs-12">
							            	<h6 class="questions">Update Inherent Risk Ranks and Control Requirements for selected Regulatory Bodies</h6>
							            </div> 
							    	</div>
							    </div>
							    <div class="col-md-12 col-sm-12 reguRisksControls accordion" id="rAccordion" style="">
							    	
							    	<?php foreach($assessment->assessments_regulatory_bodies as $rBody): ?>
							    		<?php $nRiskScales=""; ?>
							    		<!--<input type="hidden" value="<?php echo $rBody->id; ?>" name="GenRisk[assessments_regulatory_bodies][id][]">-->
							    		<div class="card rBodyCard<?php echo $rBody->regulatory_body_id; ?>">
										    <div class="card-header bg-dark" id="heading<?php echo $rBody->regulatory_body_id; ?>">
										    	<button class="btn btn-danger remRBody" style="float:right;" data-rbody="input#regulatoryBody<?php echo $rBody->regulatory_body_id; ?>" type="button">
										    		<i class="fa fa-times-circle"></i>
										    	</button>
										      <h2 class="mb-0">
										        <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#rcollapse<?php echo $rBody->regulatory_body_id; ?>" aria-expanded="true" aria-controls="rcollapse<?php echo $rBody->regulatory_body_id; ?>">
										          <?php echo $rBody->regulatory_body->name; ?>
										        </button>
										      </h2>
										    </div>
										
										    <div id="rcollapse<?php echo $rBody->regulatory_body_id; ?>" class="collapse" aria-labelledby="heading<?php echo $rBody->regulatory_body_id; ?>" data-parent="#rAccordion">
										      <div class="card-body myRBody" data-id="<?php echo $rBody->regulatory_body_id; ?>">
										        
										        <div class="row">
													<div class="col-4">
														<div class="card">
															<div class="card-header bg-dark text-white">
																<h6 class="mb-0">
																	<!--
																	<button type="button" class="btn btn-warning btn-sm float-right customRiskModalBtn regulated" data-rbid="<?php echo $rBody->regulatory_body_id; ?>" data-toggle="tooltip" title="You can use custom Risk Severity Scales if needed." data-placement="top">
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
																		
																		
																		<?php foreach($rBody->assessment_risks as $risk): ?>
																			<tr>
																				<td>
																					<label class="control-label">
																						<?php echo $risk->risk; ?>
																					</label>
																					<?php if(strlen($risk->description)>0): ?>
																							<i class="fa fa-info-circle text-info float-right" style="margin-top:10px;margin-right:-18px;" title="<?php echo strip_tags($risk->description); ?>" data-toggle="tooltip" data-placement="right"></i>
																					<?php endif; ?>
																				</td>
																				<td>
																					<input type="hidden" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][id][]" value="<?php echo $risk->id; ?>">
																					<input type="hidden" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][name][]" value="<?php echo $risk->risk; ?>">
																					<select required class="form-control input-sm nRScales" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][scale][]">
																						<option value="">--Select--</option>
																						<?php foreach($rBody->assessment_severity_scales as $scale): ?>
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
																				<button class="btn btn-sm btn-info addNewRisk regulated" type="button" data-rbid="<?php echo $rBody->regulatory_body_id; ?>">
																					<i class="fa fa-plus-square"></i>
																					New Risk	
																				</button>
																			</td>
																		</tr>
																	</tbody>
																</table>
																<?php
																	$nRiskScales.='<tr>
																					<td><input type="text" class="form-control input-sm" required name="GenRisk['.$rBody->regulatory_body_id.'][inherent][name][]" value="" placeholder="Enter Risk Name">
																					</td>
																					<td>
																						<select required class="form-control input-sm nRScales" name="GenRisk['.$rBody->regulatory_body_id.'][inherent][scale][]">
																							<option value="">--Select--</option>';
																?>
																<?php foreach($rBody->assessment_severity_scales as $scale): ?>
																	<?php $nRiskScales.='<option value="'.$scale->severity_scale.'">'.$scale->score.'-'.$scale->severity_scale.'</option>'; ?>
																<?php endforeach; ?>
																<?php
																		$nRiskScales.='</select>
																				</td>
																				<td>
																					<button class="remRisk btn btn-sm btn-danger" type="button">
																						<i class="fa fa-times"></i>
																					</button>
																				</td>
																			</tr>';
																?>
																<script>
																	reguNewRisk['"<?php echo $rBody->regulatory_body_id; ?>"']=<?php echo json_encode($nRiskScales); ?>;
																</script>
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
																<div class="accordion" id="controlRequirements<?php echo $rBody->regulatory_body_id; ?>">
																	<?php foreach($rBody->assessment_controls as $contKey=>$control): ?>
																	  <div class="card controlCard" style="border:1px solid #ccc;" data-number="<?php echo $contKey; ?>">
																	    <div class="card-header" id="controlHeading<?php echo $control->id; ?>" style="padding:4px 8px;">
																	    	<button class="btn btn-danger btn-sm remControl float-right" type="button">
																	    		<i class="fa fa-times-circle"></i>
																	    	</button>
																	      <h6 style="cursor:pointer;" data-toggle="collapse" data-target="#controlCollapse<?php echo $control->id; ?>" aria-expanded="true" aria-controls="controlCollapse<?php echo $control->id; ?>">
																	      	 <i class="fa fa-chevron-down"></i>
																	      	  <input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][id][]" value="<?php echo $control->id; ?>">
																	      	  <input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][name][]" value="<?php echo $control->name; ?>">
																	          <?php echo $control->name; ?>
																	          <i class="fa fa-info-circle text-info" style="margin-top:10px" title="<?php echo strip_tags($control->description); ?>" data-toggle="tooltip" data-placement="top"></i>
																	      </h6>
																	    </div>
																	    <div id="controlCollapse<?php echo $control->id; ?>" class="collapse" aria-labelledby="controlHeading<?php echo $control->id; ?>" data-parent="#controlRequirements<?php echo $rBody->regulatory_body_id; ?>">
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
																	    						<input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][id][]" value="<?php echo $creq->id; ?>">
																	    						<input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][name][]" value="<?php echo $creq->name; ?>">
																	    					</td>
																	    					<td style="width:25%;">
																	    						<!--<input type="hidden" class="artifactUploaded" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][artifact][]">
																	    						<input type="file" name="tFiles" class="form-control input-sm artifact" accept=".pdf">-->
																	    						<?php if($creq->artifact!=''): ?>
																	    							<input type="hidden" class="artifactUploaded" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][artifact][]" value="<?php echo $creq->artifact; ?>">
																	    							<span class="falert alert-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div></span>	
																	    						<?php else: ?>
																	    							<input type="hidden" class="artifactUploaded" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][artifact][]">
																	    							<input type="file" name="tFiles" class="form-control input-sm artifact" accept=".pdf">
																	    						<?php endif; ?>
																	    					</td>
																	    					<td >
																	    						<input type="text" class="form-control input-sm" placeholder="Reference info" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][reference][]">
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
																	<button class="btn btn-sm btn-warning addNewControl regulated" type="button" data-rbid="<?php echo $rBody->regulatory_body_id; ?>">
																		<i class="fa fa-plus-square"></i>
																		Add Custom Control Area
																	</button>
																</p>
															</div>
														</div>
													</div>
												</div>
										        
										      </div>
										    </div>
										  </div>
							    	<?php endforeach; ?>
							    </div> 
								
                            </div>
                           
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
               <div class="nRiskScalesUsed">
               	<?php foreach($assessment->assessments_regulatory_bodies as $rBody): ?>
               		<?php foreach($rBody->assessment_severity_scales as $scale): ?>
               			<input type="hidden" class="form-control input-sm" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][rScales][id][]" value="<?php echo $scale->id;  ?>">
	               		<input type="hidden" class="form-control input-sm" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][rScales][name][]" value="<?php echo $scale->severity_scale;  ?>">
	               		<input type="hidden" class="form-control input-sm" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][rScales][score][]"  value="<?php echo $scale->score; ?>">
               		<?php endforeach; ?>
               	<?php endforeach; ?>
               </div>
               <?php echo $this->Form->end(); ?>
              
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
      		$(document).on('click','.nScaleBtn',function(){
      			$('.nrow').append(nr);
      		});
      		$(document).on('click','.remNr',function(){
      			$(this).parents('.row').remove();
      		});
      		$('#customScalesModal').on('hidden.bs.modal', function (e) {
			  $('.nrow').remove();
			  $('.nnrow').append("<div class='nrow'>"+nr+"</div>");
			  thisRbId=false;
      		});
			
      		$(document).on('click','.useNewRiskScales',function(){
      			nscales = $('#customScalesModal').find('.nGenRScales');
      			nscores = $('#customScalesModal').find('.nGenRScaleScores');
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
      			
      			if(thisRbId==false){
      				$('.nRScales').html('');
      				$('.nRScales').html(nsOptions);
      				thisRb = "";
      				//inserting into the form to submit along with
	      			nscales.each(function(){
	      				$(this).clone().appendTo('.nRiskScalesUsed');
	      			});
	      			nscores.each(function(){
	      				$(this).clone().appendTo('.nRiskScalesUsed');
	      			});
	      			
	      			newRisk = '<tr><td><input type="text" class="form-control input-sm" required name="GenRisk'+thisRb+'[inherent][name][]" value="" placeholder="Enter Risk Name">';
	      			newRisk += '</td><td><select required class="form-control input-sm nRScales" name="GenRisk'+thisRb+'[inherent][scale][]">'+nsOptions;
					newRisk += '</select></td><td><button class="remRisk btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i></button></td></tr>';
	      			
      			} else {
      				$('.rBodyCard'+thisRbId).find('.nRScales').html('');
      				$('.rBodyCard'+thisRbId).find('.nRScales').html(nsOptions);
      				thisRb = "["+thisRbId+"]";
      				
      				//inserting into the form to submit along with
      				$('.nRiskScalesUsed').find('[name*="GenRisk'+thisRb+'"]').remove();
	      			nscales.each(function(){
	      				$(this).clone().prop('name','GenRisk'+thisRb+'[rScales][name][]').appendTo('.nRiskScalesUsed');
	      			});
	      			nscores.each(function(){
	      				$(this).clone().prop('name','GenRisk'+thisRb+'[rScales][score][]').appendTo('.nRiskScalesUsed');
	      			});
	      			
	      			rnewRisk = '<tr><td><input type="text" class="form-control input-sm" required name="GenRisk'+thisRb+'[inherent][name][]" value="" placeholder="Enter Risk Name">';
	      			rnewRisk += '</td><td><select required class="form-control input-sm nRScales" name="GenRisk'+thisRb+'[inherent][scale][]">'+nsOptions;
					rnewRisk += '</select></td><td><button class="remRisk btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i></button></td></tr>';
	      			reguNewRisk['"'+thisRbId+'"'] = rnewRisk;
      			}
      			
      			$('.nRiskScalesUsed').find('input').prop('type','hidden');
      			
      			
      			$('#customScalesModal').modal('hide');
      		});
      		
      	});
      </script>
    </div>
  </div>
</div>
<!-- risk scale modal ends-->


<script>
	
    	$(function(){
    		pageLoader = $('.pageLoader');
    		
    		$(document).on('click','.customRiskModalBtn',function(){
    			if($(this).hasClass('regulated')){
    				thisRbId = $(this).attr('data-rbid');
    			} else {
    				thisRbId = false;
    			}
    			$('#customScalesModal').modal('show');
    		});
    		
    		var loading = '<div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Loading...</span></div>';
    		newRisk='';
    		//loading risks and controls for particular assessment type (Generalized and Others)
    		$(document).on('change','.atype',function(){
    			$('.subtype').trigger('change');
    		});
    		$(document).on('change','.subtype',function(){
    			if($('.atype').val()){
	    			var subtype = $(this);
	    			var subtypeval = $(this).val();
	    			var atype = $('.atype').val();
	    			var container = $('.assessmentInputs');
	    			if(subtypeval){
	    				container.html(loading);
	    				container.load("<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRisksAndControls'),true); ?>/"+subtypeval+"/"+atype,function(response,status,xhr){
	    					//1. creating element to handle new Risk Profile addition for generalized assessment submission
	    					newRisk = container.find('.newRiskRow').html();
							container.find('.newRisk').remove();
							if(atype=='Self'){
								$('.artifact').prop('required',false);
							}
							//1. ends
							
	    				});
	    				
	    			} else {
	    				container.html("");
	    			}
    			} else {
    				
    				$('.atype').focus().trigger('click');
    				$(this).val('');
    			}
    		});
    		
    		//event handler to add new Risk profile for generalized assessment submission
    		$(document).on('click','.addNewRisk',function(){
    			ptable = $(this).parents('table').find('.risks');
    			if($(this).hasClass('regulated')){
    				rgid = $(this).attr('data-rbid');
    				$(reguNewRisk['"'+rgid+'"']).appendTo(ptable)
    			} else {
    				$(newRisk).appendTo(ptable);
    			}
				
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
					//console.log(file);
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
							//console.log(data);
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
				btn = $(this);
				parent = $(this).parents('.card-block').find('.accordion');
				var atype = $('.atype').val();
				noe = parent.find('.controlCard');
				noe = noe.length;
				rbid = "";
				brbid = "";
				regu ="";
				if(btn.hasClass('regulated')){
					rbid="["+btn.attr('data-rbid')+"]";
					brbid = btn.attr('data-rbid');
					regu = "regulated";
				}
				//adding New Control
				crow = '<div class="card controlCard" style="border:1px solid #ccc;" data-number="'+(noe)+'">';
				crow += '<div class="card-header" id="controlHeadingNew'+(noe+1)+'" style="padding:4px 8px;">';
				crow += '<button class="btn btn-danger btn-sm remControl float-right" type="button"><i class="fa fa-times-circle"></i></button><h6 style="cursor:pointer;" ><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#controlCollapseNew'+(noe+1)+'" aria-expanded="true" aria-controls="controlCollapseNew'+(noe+1)+'">';
				crow += '<i class="fa fa-chevron-down"></i></button>';
				crow += '<input type="text" style="width:50%;display:inline-block;" class="form-control input-sm" name="GenControl'+rbid+'[control]['+(noe)+'][name][]" value="">';
				crow += '</h6></div><div id="controlCollapseNew'+(noe+1)+'" class="collapse" aria-labelledby="controlHeadingNew'+(noe+1)+'" data-parent="#controlRequirements'+brbid+'">';
				crow += '<div class="card-bod"><table class="table table-borderless table-hover">';
				crow += '<thead><tr class="bg-light text-dark"><th>Control Requirement</th><th>Artifact File</th>';
				crow += '<th>Reference</th></tr></thead><tbody class="controlReqBody"></tbody></table><p style="padding:8px;"><button class="btn btn-sm btn-primary addNewControlReq '+regu+'" data-rbid="'+brbid+'" type="button"><i class="fa fa-plus-square"></i>';
				crow += ' Add Control Requirement</button></p></div></div></div>';
				parent.append(crow);
				//alert(crow);
				noe++;
			});
			
			//adding control requirement to particular control
			$(document).on('click','.addNewControlReq',function(){
				btn=$(this);
				parent = $(this).parents('.controlCard');
				noc = parent.attr('data-number');
				var reqrd = "";
				if(atype=='Self'){
					reqrd="required";
				}
				rbid = "";
				if(btn.hasClass('regulated')){
					rbid="["+btn.attr('data-rbid')+"]";
				}
				//adding new control requirement to control
				rqRow = '<tr><td style="width:40%;"><input type="text" class="form-control input-sm" name="GenControl'+rbid+'[control]['+noc+'][req][name][]" value="">';
				rqRow += '</td><td style="width:25%;"><input type="hidden" class="artifactUploaded" name="GenControl'+rbid+'[control]['+noc+'][req][artifact][]">';
				rqRow += '<input type="file" '+reqrd+' class="form-control input-sm artifact" accept=".pdf">';
				rqRow += '</td><td ><input type="text" class="form-control input-sm" placeholder="Reference info" name="GenControl'+rbid+'[control]['+noc+'][req][reference][]"></td></tr>';
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
				
				
				
				
		
			//for regulated assessments
			reguRisksControls="";
			//reguNewRisk = {"test":"test value"}; //this is decalred at top of the page for this page 
			$(document).on('click','.thisRegulatoryBodies .reguBody',function(){
				var rbody = $(this);
				pageLoader.addClass('open');
				rcontainer = $('.reguRisksControls');
				if(rbody.prop('checked')==true){
					//if selected any regulatory body
					$.get("<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRisksAndControlsRegulated'),true); ?>/"+rbody.val(),function(resp){
						//return resp;
						pageLoader.removeClass('open');
						rcontainer.append(resp);
						//console.log(resp);
						resp = $('.rBodyCard'+rbody.val());
						rnewRisk = resp.find('.newRiskRow').html();
						resp.find('.newRisk').remove();
						reguNewRisk['"'+rbody.val()+'"']=rnewRisk;
						//console.log(reguNewRisk);
						
					});
    			} else {
					if(confirm("All of your data updated for this regulatory body will be lost. Are you sure ?")){
						rcontainer.find('.rBodyCard'+rbody.val()).remove();	
					} else {
						rbody.prop('checked',true);
					}
					
					pageLoader.removeClass('open');
				}
				
			});
			
			//removing regulatory body for assessment
			$(document).on('click','.remRBody',function(){
				$($(this).attr('data-rbody')).trigger('click');
			});
			
			//for regulated assessments ends here		
				
		
		}); //document ready ends
	
   
</script>