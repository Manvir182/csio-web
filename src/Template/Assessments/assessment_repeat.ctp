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
<div class="main-content white-bg">
       <div class="container-fluid questionborder">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Re-Assess Existing Assessment</h5>
               </div>
           </div>
           <div class="row questionborder1 ">
           	   <?php echo $this->Form->create($rassessment,['class'=>'w-100 assessmentForm','type'=>'file']); ?>
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
		                                		'required'=>true,

		                                	));
		                                ?>
                        			</div>
                        		</div>
                                <br>

                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">
                            		Assessment Classification
                            		<i class="fa fa-info-circle text-info" style="margin-top:10px;" data-toggle="popover"
                            			data-trigger="hover"
										data-content="<b>Self Assessment </b>: This type of assessment is conducted by your team/company to assess your risk internally.<br><br><b>Independent</b>: This type of assessment is an objective assessment conducted by an independent third party/THE CLOUD CISO to assess risks. Selecting this option delegates the assessment to the independent third party/THE CLOUD CISO for conducting the assessment."
										data-placement='right'
										data-html='true'
										title=""
										data-original-title="Select a classification"
                            		></i>
                            	</h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<?php
                            		echo $this->Form->control('atype',[
                            			'label'=>false,
                            			'class'=>'atype',
                            			'type'=>'hidden',
                            			//'options'=>array(''=>'-- Select --','Self'=>'Self Assessment','Independent'=>'Independent Assessment'),
                            			'required'=>true,
                            			//'value'=>$rassessment->atype
                            		]);
                            	?>
                            	<span class="form-control input-sm">
                            		<?php echo $rassessment->atype; ?> Assessment
                            	</span>
                            </div>
                            <div class="col-12" style="padding:6px;"></div>

                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">
                            		Assessment Type
                            		<i class="fa fa-info-circle text-info" style="margin-top:10px;" data-toggle="popover"
                            			data-trigger="hover"
										data-content="<b>Generalized Assessment </b>: A general set of controls that cover industry standardized risks areas based on the CObIT framework is used to offer broad assessment of the control environment.<br><br><b>Regulated Assessment</b>: An assessment that is specific to a particular regulatory body. In some instances organizations may opt to perform regulator specific assessments.<br><br><b>FFIEC Regulated Assessment</b>: Specialised Assessment for Federal Financial Institutions Examination Council (FFIEC).<br><br><b>Other</b>: A custom assessment wherein you may define very specific risks and controls that you would like assessed using our risk assessment tool."
										data-placement='right'
										data-html='true'
										title=""
										data-original-title="Select an assessment type"
                            		></i>
                            	</h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12 m-t-10">
                            	<?php
                            		echo $this->Form->control('sub_type',[
                            			'label'=>false,
                            			'class'=>'subtype',
                            			'type'=>'hidden',
                            			//'options'=>array(''=>'-- Select --','Generalized'=>'Generalized Assessment','Regulated'=>'Regulated Assessment','FFIEC Regulated'=>'FFIEC Regulated Assessment','Other'=>'Other Assessment'),
                            			'required'=>true,
                            			//'value'=>$rassessment->sub_type
                            		]);
                            	?>
                            	<span class="form-control input-sm">
                            		<?php echo $rassessment->sub_type; ?> Assessment
                            	</span>
                            </div>

                            <div class="col-12" style="padding:6px;"></div>
                            <div class="assessmentInputs col-12" style="padding:35px;">
                            	<!--Risk and controls-->
                            	<?php if($rassessment->sub_type=='Generalized'): ?>
									<div class="row">
										<div class="col-4">
											<div class="card">
												<div class="card-header bg-dark text-white">
													<h6 class="mb-0 text-white">
														Risk Domains
													</h6>
												</div>
												<div class="card-block">
													<table class="table table-borderless table-hover mb-0">
														<thead>
															<tr class="table-active">
																<th>Risk Domains</th>
																<th>Inherent Risk</th>
																<!--
																<th>
																	<button class="btn btn-sm btn-danger" type="button" style="visibility:hidden;opacity:0;">
																		<i class="fa fa-times"></i>
																	</button>
																</th>
																-->
															</tr>
														</thead>
														<tbody class="risks">


															<?php foreach($rassessment->assessment_risks as $risk): ?>
																<tr>
																	<td>
																		<?php echo $risk->risk; ?>
																		<?php if(strlen($risk->risk_description)>0): ?>
																			<i class="fa fa-info-circle text-info" style="margin-top:10px;margin-right:-18px;" title="<?php echo strip_tags($risk->risk_description); ?>" data-toggle="tooltip" data-placement="right"></i>
																		<?php endif; ?>
																		<input type="hidden" name="GenRisk[inherent][id][]" value="<?php echo $risk->risk_id; ?>">
																		<input type="hidden" name="GenRisk[inherent][name][]" value="<?php echo $risk->risk; ?>">
																		<input type="hidden" name="GenRisk[inherent][inhrent_scale][]" value="<?php echo $risk->inherent_scale; ?>">
																		<input type="hidden" name="GenRisk[inherent][description][]" value="<?php echo strip_tags($risk->risk_description); ?>">
																	</td>
																	<td class="<?php echo $risk->inherent_scale; ?> text-center">
																		<?php echo $risk->inherent_scale; ?>
																	</td>
																	<!--
																	<td>
																		<button class="remRisk btn btn-sm btn-danger" type="button">
																			<i class="fa fa-times"></i>
																		</button>
																	</td>
																	-->
																</tr>
															<?php endforeach; ?>
														</tbody>
														<tbody style="display:none;">
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
																<i class="fa fa-info-circle text-info float-right thisRiskDesc" style="margin-top:10px;margin-right:-18px;"  desctitle data-toggle="tooltip" data-placement="right"></i>
																<input type="text" class="form-control input-sm" required name="GenRisk[inherent][name][]" value="" placeholder="Enter Risk Name">
																<input type="hidden" class="thisRiskDescValue" name="GenRisk[inherent][description][]" descvalue>
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
													<h6 class="mb-0 text-white">Update Control Requirements</h6>
												</div>
												<div class="card-block" style="padding:8px;">
													<p>
														<!--
														<button class="btn btn-sm btn-secondary float-right" type="button" data-toggle="modal" data-target="#effectivenessModal">
															Control Effectiveness Scales
														</button>
														-->
														Kindly update control requirements for each control.
													</p>
													<div class="accordion" id="controlRequirements">
														<?php foreach($rassessment->assessment_controls as $contKey=>$control): ?>
														  <div class="card controlCard" style="border:1px solid #ccc;" data-number="<?php echo $contKey; ?>">
														    <div class="card-header" id="controlHeading<?php echo $control->control_id; ?>" style="padding:4px 8px;">
														    	<!--
														    	<button class="btn btn-danger btn-sm remControl float-right" type="button">
														    		<i class="fa fa-times-circle"></i>
														    	</button>
														    	-->
														      <h6 style="cursor:pointer;" data-toggle="collapse" data-target="#controlCollapse<?php echo $control->control_id; ?>" aria-expanded="true" aria-controls="controlCollapse<?php echo $control->control_id; ?>">
														      	 <i class="fa fa-chevron-down"></i>
														      	 <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][id][]" value="<?php echo $control->control_id; ?>">
														      	  <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][name][]" value="<?php echo $control->name; ?>">
														      	  <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][description][]" value="<?php echo $control->description; ?>">
														          <?php echo $control->name; ?>
														          <i class="fa fa-info-circle text-info" style="margin-top:10px" title="<?php echo strip_tags($control->description); ?>" data-toggle="tooltip" data-placement="top"></i>
														      </h6>
														    </div>
														    <div id="controlCollapse<?php echo $control->control_id; ?>" class="collapse" aria-labelledby="controlHeading<?php echo $control->control_id; ?>" data-parent="#controlRequirements">
														      <div class="card-bod">
														    	<table class="table table-borderless table-hover">
														    		<thead>
														    			<tr class="bg-light text-dark">
														    				<th>Control Requirement</th>
														    			</tr>
														    		</thead>
														    		<tbody class="controlReqBody">
														    			<?php foreach($control->assessment_control_requirements as $creq): ?>
														    				<tr>
														    					<td style="width:40%;">
														    						<?php echo $creq->name; ?>
														    						<input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][req][name][]" value="<?php echo $creq->name; ?>">
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
													<!--
													<p style="padding:8px 0px;display:none;">
														<button class="btn btn-sm btn-warning addNewControl" type="button">
															<i class="fa fa-plus-square"></i>
															Add Custom Control Area
														</button>
													</p>
													-->
												</div>
											</div>
										</div>
									</div>
									<script>
										noe = $('#controlRequirements').find('.controlCard');
										noe = noe.length;
										crow = "";
										rqRow = "";
										newRisk = "";
										$(function(){
											$('[data-toggle="tooltip"]').tooltip();
											$('[data-toggle="popover"]').popover();
											newRisk = $('.assessmentInputs').find('.newRiskRow').html();
											$('.assessmentInputs').find('.newRisk').remove();

										});
									</script>
								<?php endif; //generalized IF ends ?>



								<?php if($sType=='Regulated'): ?>
								    <div class="col-md-12 col-sm-12 reguRisksControls accordion" id="rAccordion" style="">
								    	<?php $srr=0; ?>
								    	<?php foreach($rassessment->assessments_regulatory_bodies as $rBody): ?>
								    	<div class="card rBodyCard<?php echo $rBody->regulatory_body_id; ?>">
										    <div class="card-header bg-dark" id="heading<?php echo $rBody->regulatory_body_id; ?>">
										    	<!--
										    	<button class="btn btn-danger remRBody" style="float:right;" data-rbody="input#regulatoryBody<?php echo $rBody->regulatory_body_id; ?>" type="button">
										    		<i class="fa fa-times-circle"></i>
										    	</button>
										    	-->
										      <h2 class="mb-0">
										        <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#rcollapse<?php echo $rBody->regulatory_body_id; ?>" aria-expanded="true" aria-controls="rcollapse<?php echo $rBody->regulatory_body_id; ?>">
										          <?php echo $rBody->regulatory_body->name; ?>
										        </button>
										      </h2>
										    </div>

										    <div id="rcollapse<?php echo $rBody->regulatory_body_id; ?>" class="collapse<?php echo $srr==0?' show':''; $srr++ ?>" aria-labelledby="heading<?php echo $rBody->regulatory_body_id; ?>" data-parent="#rAccordion">
										      <div class="card-body myRBody" data-id="<?php echo $rBody->regulatory_body_id; ?>">

										        <div class="row">
													<div class="col-4">
														<div class="card">
															<div class="card-header bg-dark text-white">
																<h6 class="mb-0">

																	Update Inherent Scores
																</h6>
															</div>
															<div class="card-block">
																<table class="table table-borderless table-hover mb-0">
																	<thead>
																		<tr class="table-active">
																			<th>Risk Domains</th>
																			<th>Inherent Risk</th>
																			<!--
																			<th>
																				<button class="btn btn-sm btn-danger" type="button" style="visibility:hidden;opacity:0;">
																					<i class="fa fa-times"></i>
																				</button>
																			</th>
																			-->
																		</tr>
																	</thead>
																	<tbody class="risks">


																		<?php foreach($rBody->assessment_risks as $risk): ?>
																			<tr>
																				<td>
																					<label class="control-label" style="display:block;">
																						<?php echo $risk->risk; ?>
																						<?php if(strlen($risk->risk_description)>0): ?>
																							<i class="fa fa-info-circle text-info" style="margin-top:10px;margin-right:-18px;" title="<?php echo strip_tags($risk->risk_description); ?>" data-toggle="tooltip" data-placement="right"></i>
																						<?php endif; ?>

																					</label>

																					<input type="hidden" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][id][]" value="<?php echo $risk->risk_id; ?>">
																					<input type="hidden" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][name][]" value="<?php echo $risk->risk; ?>">
																					<input type="hidden" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][inhrent_scale][]" value="<?php echo $risk->inherent_scale; ?>">
																					<input type="hidden" class="thisRiskDescValue" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][description][]" value="<?php echo strip_tags($risk->risk_description); ?>">

																				</td>
																				<td class="<?php echo $risk->inherent_scale; ?> text-center">
																					<?php echo $risk->inherent_scale; ?>
																				</td>
																				<!--
																				<td>
																					<button class="remRisk btn btn-sm btn-danger" type="button">
																						<i class="fa fa-times"></i>
																					</button>
																				</td>
																				-->
																			</tr>
																		<?php endforeach; ?>
																	</tbody>
																	<!--
																	<tbody>
																		<tr>
																			<td colspan="3">
																				<button class="btn btn-sm btn-info addNewRisk regulated" type="button" data-rbid="<?php echo $rBody->id; ?>">
																					<i class="fa fa-plus-square"></i>
																					New Risk
																				</button>
																			</td>
																		</tr>
																	</tbody>
																-->
																</table>
																<!--
																<table class="newRisk" style="display:none;">
																	<tbody class="newRiskRow">
																	<tr>
																		<td>
																			<i class="fa fa-info-circle text-info float-right thisRiskDesc" style="margin-top:10px;margin-right:-18px;" desctitle data-toggle="tooltip" data-placement="right"></i>
																			<input type="text" class="form-control input-sm" required name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][name][]" value="" placeholder="Enter Risk Name">
																			<input type="hidden" class="thisRiskDescValue" name="GenRisk[<?php echo $rBody->regulatory_body_id; ?>][inherent][description][]" descvalue>
																		</td>

																		<td>
																			<button class="remRisk btn btn-sm btn-danger" type="button">
																				<i class="fa fa-times"></i>
																			</button>
																		</td>
																	</tr>
																	</tbody>
																</table>
															-->
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
																	<!--
																	<button class="btn btn-sm btn-secondary float-right" type="button" data-toggle="modal" data-target="#effectivenessModal">
																		Control Effectiveness Scales
																	</button>
																	-->
																	Kindly update control requirements for each control.
																</p>
																<div class="accordion" id="controlRequirements<?php echo $rBody->regulatory_body_id; ?>">
																	<?php foreach($rBody->assessment_controls as $contKey=>$control): ?>
																	  <div class="card controlCard" style="border:1px solid #ccc;" data-number="<?php echo $contKey; ?>">
																	    <div class="card-header" id="controlHeading<?php echo $control->control_id; ?>" style="padding:4px 8px;">
																	    	<!--
																	    	<button class="btn btn-danger btn-sm remControl float-right" type="button">
																	    		<i class="fa fa-times-circle"></i>
																	    	</button>
																	    	-->
																	      <h6 style="cursor:pointer;" data-toggle="collapse" data-target="#controlCollapse<?php echo $control->control_id; ?>" aria-expanded="true" aria-controls="controlCollapse<?php echo $control->control_id; ?>">
																	      	 <i class="fa fa-chevron-down"></i>
																	      	  <input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][id][]" value="<?php echo $control->conrol_id; ?>">
																	      	  <input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][name][]" value="<?php echo $control->name; ?>">
																	      	  <input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][description][]" value="<?php echo $control->description; ?>">
																	          <?php echo $control->name; ?>
																	          <i class="fa fa-info-circle text-info" style="margin-top:10px" title="<?php echo strip_tags($control->description); ?>" data-toggle="tooltip" data-placement="top"></i>
																	      </h6>
																	    </div>
																	    <div id="controlCollapse<?php echo $control->control_id; ?>" class="collapse" aria-labelledby="controlHeading<?php echo $control->control_id; ?>" data-parent="#controlRequirements<?php echo $rBody->regulatory_body_id; ?>">
																	      <div class="card-bod">
																	    	<table class="table table-borderless table-hover">
																	    		<thead>
																	    			<tr class="bg-light text-dark">
																	    				<td>Control Requirement</td>

																	    			</tr>
																	    		</thead>
																	    		<tbody class="controlReqBody">
																	    			<?php foreach($control->assessment_control_requirements as $creq): ?>
																	    				<tr>
																	    					<td style="width:40%;">
																	    						<?php echo $creq->name; ?>
																	    						<input type="hidden" name="GenControl[<?php echo $rBody->regulatory_body_id; ?>][control][<?php echo $contKey; ?>][req][name][]" value="<?php echo $creq->name; ?>">
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
																<!--
																<p style="padding:8px 0px;">
																	<button class="btn btn-sm btn-warning addNewControl regulated" type="button" data-rbid="<?php echo $rBody->regulatory_body_id; ?>">
																		<i class="fa fa-plus-square"></i>
																		Add Custom Control Area
																	</button>
																</p>
																-->
															</div>
														</div>
													</div>
												</div>

										      </div>
										    </div>
										  </div>
										<?php endforeach; ?>


										<script>
											noe = $('#controlRequirements').find('.controlCard');
											noe = noe.length;
											crow = "";
											rqRow = "";
											newRisk = "";
											$(function(){
												$('[data-toggle="tooltip"]').tooltip();
												$('[data-toggle="popover"]').popover();
												newRisk = $('.assessmentInputs').find('.newRiskRow').html();
												$('.assessmentInputs').find('.newRisk').remove();
											});

										</script>
								    </div>
								<?php endif; //Regulated IF ends ?>





								<?php if($sType=='Other'): ?>
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
														Risk Domains
													</h6>
												</div>
												<div class="card-block">
													<table class="table table-borderless table-hover">
														<thead>
															<tr class="active">
																<th>Risk Domains</th>
																<!--
																<th>
																	Inherent Risk Rank
																	<i class="fa fa-info-circle text-info float-right" data-toggle="modal" data-target="#scalesModal"></i>
																</th>
																-->
																<th>

																	<button class="btn btn-sm btn-danger" type="button" style="visibility:hidden;opacity:0;">
																		<i class="fa fa-times"></i>
																	</button>
																</th>
															</tr>
														</thead>
														<tbody class="risks">

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
																<i class="fa fa-info-circle text-info float-right thisRiskDesc" style="margin-top:10px;margin-right:-18px;"  desctitle data-toggle="tooltip" data-placement="right"></i>
																<input type="text" class="form-control input-sm" required name="GenRisk[inherent][name][]" value="" placeholder="Enter Risk Name">
																<input type="hidden" class="thisRiskDescValue" name="GenRisk[inherent][description][]" descvalue>
															</td>
															<!--
															<td>
																<select required class="form-control input-sm nRScales" name="GenRisk[inherent][scale][]">
																	<option value="">--Select--</option>
																	<?php foreach($rScales as $scale): ?>
																		<option value="<?php echo $scale->severity_scale; ?>"><?php echo $scale->score."-".$scale->severity_scale; ?></option>
																	<?php endforeach; ?>
																</select>
															</td>
															-->
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
														<!--
														<button class="btn btn-sm btn-secondary float-right" type="button" data-toggle="modal" data-target="#effectivenessModal">
															Control Effectiveness Scales
														</button>
														-->
														Kindly Add Controls and update control requirements for each control.
													</p>
													<div class="accordion" id="controlRequirements">

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
								<?php endif; //Other IF ends ?>
								<?php if($sType=='FFIEC Regulated'): ?>
									<div class="row">
										<div class="col-4">
											<div class="card">
												<h4 class="m-b-0 mb-0 p-10 bg-dark card-header text-white font-bold">
							    					<div class="row">
											      		<div class="col-sm-9 col-xl-9">
											      			Risk Domains
											      		</div>
											      		<div class="col-lg-3 col-xl-3 text-center">
											      			<span class="float-right pull-right">
											      				<i class="fa fa-info-circle text-info ml-1" data-toggle="modal" data-target='#scalesModal'></i>
											      			</span>
											      			Inherent Risk
											      		</div>
											      	</div>
								    			</h4>
								    			<div class="accordion" id="raccordionExample">
								    			  <?php foreach($rassessment->ffiec_assessment_risks as $key=>$fRisk): ?>
													  <div class="card riskCard">
													    <div class="card-header" id="headingOnefar<?php echo $fRisk->id; ?>" style="padding-left:0px;">
													      <h2 class="mb-0">
													      	<div class="row">
													      		<div class="col-sm-9 col-xl-9">
													      			<button class="btn btn-link text-primary collapsed abtns" style="text-align:left !important;" type="button" data-toggle="collapse" data-target="#collapseOnefar<?php echo $fRisk->id; ?>" aria-expanded="true" aria-controls="collapseOnefar<?php echo $fRisk->id; ?>">
													      			  <i class="fa fa-caret-down"></i>
															          <?php echo $fRisk->name; ?>
															        </button>
															        <input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][name]" value="<?php echo $fRisk->name; ?>">
																	<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][inherent_scale]" value="<?php echo $fRisk->inherent_scale; ?>">
															    	<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][inherent_score]" value="<?php echo $fRisk->inherent_score; ?>">
															    	<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][ffiec_risk_id]" value="<?php echo $fRisk->ffiec_risk_id; ?>">
															    </div>

													      		<div class="col-sm-3 col-xl-3 text-center">
													      			<span class="btn btn-sm btn-secondary inherent badge-pill <?php echo $fRisk->inherent_scale; ?>" style="width:100px;">
																		<?php echo $fRisk->inherent_scale; ?>
																	</span>
													      		</div>
													      	</div>
													      </h2>
													    </div>

													    <div id="collapseOnefar<?php echo $fRisk->id; ?>" class="collapse" aria-labelledby="headingOnefar<?php echo $fRisk->id; ?>" data-parent="#raccordionExample">
													      <div class="card-body" style="padding:0px;">
													      	<table class="table table-bordered m-0 table-hover">
													      		<thead>
													      			<tr class="table-active">
													      				<th style="width:70% !important;">Risk Attribute</th>
													      				<th>
													      					Risk Level
													      				</th>
													      			</tr>
													      		</thead>
													      		<tbody>

													      			<?php foreach($fRisk->ffiec_assessment_risk_factors as $frk=>$fRiskFactor): ?>
													      				<tr>
													      					<td>
													      						<i class="fa fa-info-circle text-info float-right fRiskFactorsInfo" data-key="<?php echo $key.$frk; ?>"></i>
													      						<?php echo $fRiskFactor->name; ?>
													      						<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][ffiec_assessment_risk_factors][<?php echo $frk; ?>][frisk_id]" value="<?php echo $fRiskFactor->frisk_id; ?>">
															    				<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][ffiec_assessment_risk_factors][<?php echo $frk; ?>][name]" value="<?php echo $fRiskFactor->name; ?>">
															    				<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][ffiec_assessment_risk_factors][<?php echo $frk; ?>][score]" value="<?php echo $fRiskFactor->score; ?>">
															    				<input type="hidden" name="risks[ffiec_assessment_risks][<?php echo $key; ?>][ffiec_assessment_risk_factors][<?php echo $frk; ?>][scale]" value="<?php echo $fRiskFactor->scale; ?>">

													      					</td>
													      					<td class="form-group <?php echo $fRiskFactor->scale; ?>">
													      						<?php echo $fRiskFactor->scale; ?>
													      					</td>
													      				</tr>
													      			<?php endforeach; ?>
													      		</tbody>
													      	</table>
													      </div>
													    </div>
													  </div>
												  <?php endforeach; ?>

												</div>

											</div>

										</div>
										<div class="col-8">
											<div class="card card-info">
												<h4 class="m-b-0 mb-0 p-10 bg-primary text-white font-bold">
							    				<div class="row">
							    					<div class="col-9">
							    						FFIEC Domains
							    					</div>
							    					<div class="col-3">
							    						Compliance Status
													</div>

							    				</div>
							    			</h4>
							    			<div class="accordion" id="caccordionExample">
							    			  <?php foreach($rassessment->ffiec_assessment_domains as $k=>$fdomain): ?>
												  <div class="card">
												    <div class="card-header" id="headingOnefd<?php echo $fdomain->id; ?>" style="padding-left:0px;">
												      <h2 class="mb-0" >
												      	<div class="row">
									    					<div class="col-9">
									    						<button class="btn btn-link text-primary cbtns" type="button" data-toggle="collapse" data-target="#collapseOnefd<?php echo $fdomain->id; ?>" aria-expanded="false" aria-controls="collapseOnefd<?php echo $fdomain->id; ?>">
														          <i class="fa fa-caret-down"></i>
														          <?php echo $fdomain->name; ?>
														        </button>
														    	<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][ffiec_domain_id]" value="<?php echo $fdomain->ffiec_domain_id; ?>">
																<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][name]" value="<?php echo $fdomain->name; ?>">
																<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][m_level]" value="<?php echo $fdomain->ffiec_assessment_domain_a_factors[0]->ffiec_assessment_domain_requirements[0]->maturity_level; ?>">
																<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][description]" value="<?php echo $fdomain->description; ?>">
															</div>
									    					<div class="col-3 text-center" style="font-size:15px;line-height:18px;padding-top:5px;">
									    						<span class="btn btn-sm btn-secondary badge-pill">
									    							<?php echo $fdomain->ffiec_assessment_domain_a_factors[0]->ffiec_assessment_domain_requirements[0]->maturity_level; ?>
									    						</span>
									    					</div>

									    				</div>

												      </h2>
												    </div>

												    <div id="collapseOnefd<?php echo $fdomain->id; ?>" class="collapse" aria-labelledby="headingOnefd<?php echo $fdomain->id; ?>" data-parent="#caccordionExample">
												      <div class="card-body">
												      	<h4>Assessment Factors</h4>
												      	<div class="accordion" id="accordionExamplefd<?php echo $fdomain->id; ?>">
												      		<?php foreach($fdomain->ffiec_assessment_domain_a_factors as $ak=>$aFactor): ?>
															  <div class="card">
															    <div class="card-header" id="headingOneaf<?php echo $aFactor->id; ?>" style="padding-left:0px;">
															    	<i class="fa fa-caret-down float-right m-t-10 mt-1"></i>
															      <h2 class="mb-0">
															      	<button class="btn btn-link text-primary" type="button" data-toggle="collapse" data-target="#collapseOneaf<?php echo $aFactor->id; ?>" aria-expanded="false" aria-controls="collapseOneaf<?php echo $aFactor->id; ?>">
															          <?php echo $aFactor->name; ?>
															        </button>
															      	<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][ffiec_assessment_domain_a_factors][<?php echo $ak; ?>][name]" value="<?php echo $aFactor->name; ?>">
																  </h2>
															    </div>

															    <div id="collapseOneaf<?php echo $aFactor->id; ?>" class="collapse" aria-labelledby="headingOneaf<?php echo $aFactor->id; ?>" data-parent="#accordionExamplefd<?php echo $fdomain->id; ?>">
															      <div class="card-body p-0">
															      	<table class="table table-hover mb-0 m-b-0">
															      		<thead>
															      			<tr class="table-active">
															      				<th style="">Domain Requirements</th>
															      			</tr>
															      		</thead>
															      		<tbody>
															      			<?php foreach($aFactor->ffiec_assessment_domain_requirements as $fk=>$dStat): ?>
															      				<tr>
															      					<td>
															      						<?php echo $dStat->name; ?>
															      						<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][ffiec_assessment_domain_a_factors][<?php echo $ak; ?>][ffiec_assessment_domain_requirements][<?php echo $fk; ?>][component]" value="<?php echo $dStat->component; ?>">
																  						<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][ffiec_assessment_domain_a_factors][<?php echo $ak; ?>][ffiec_assessment_domain_requirements][<?php echo $fk; ?>][maturity_level]" value="<?php echo $dStat->maturity_level; ?>">
																  						<input type="hidden" name="domains[ffiec_assessment_domains][<?php echo $k; ?>][ffiec_assessment_domain_a_factors][<?php echo $ak; ?>][ffiec_assessment_domain_requirements][<?php echo $fk; ?>][name]" value="<?php echo $dStat->name; ?>">
																  					</td>
															      				</tr>
																		  <?php endforeach; ?>
															      		</tbody>
															      	</table>

															      </div>
															    </div>
															  </div>
														  	<?php endforeach; ?>
														</div>
												      </div>
												    </div>
												  </div>
											  <?php endforeach; ?>
											</div>
											<!--
												<div class="card-block" style="padding:0px;">

													<table class="table table-hover m-b-0">
														<thead>
															<tr class="table-active">
																<th>
																	Domain
																</th>
																<th>
																	Selected Desired Maturity
																	<i class="fa fa-info-circle text-info" style="margin-top:10px;"  data-toggle="modal" data-target="#fmlevelModal" title="Maturity Levels Information"></i>
																</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach($rassessment->ffiec_assessment_domains as $domain): ?>
																<tr>
																	<td>
																		<div class="form-group">
																			<input type="hidden" name="domains[]" value="<?php echo $domain->ffiec_domain_id; ?>">
																			<?php echo $domain->name; ?>
																		</div>
																	</td>
																	<td>
																		<div class="form-group">
																			<select class="form-control input-sm" required name="mlevels[]">
																				<option value="">-- Select --</option>
																				<?php foreach($mLevels as $mLevel): ?>
																					<option <?php echo $mLevel==$domain->m_level?'selected':''; ?> value="<?php echo $mLevel; ?>"><?php echo $mLevel; ?></option>
																				<?php endforeach; ?>
																			</select>
																		</div>
																	</td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
												-->
											</div>
										</div>
									</div>
								<?php endif; ?>

                            	<!--Risks andn Controls ends-->
                            </div>
                            <div class="col-md-12 col-sm-12 sr-only " >
                            	<div class="form-row">
                                  <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
		                            	<h6 class="questions">Final Submission</h6>
		                            </div>
		                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12 m-t-10">
		                            	<?php
		                            		/*
                                        	echo $this->Form->control('status',array(
												'type'=>'select','class'=>'form-control input-sm',
												'required'=>true,
												'label'=>false,
												'empty'=>array(''=>'-- Select --'),
												'options'=>array('Submitted'=>'Final Submission to perform assessment','Submitting'=>'Save to continue later.')
											));
											*/
                                        ?>
		                            </div>
                            	</div>

                            </div>
                            <div class="col-md-12 col-sm-12 " style="display:none;"><br><br>
                                <center><button type="button" class="cisobtn cisoblue cisopadding cisoblue-outline  sperator-line"><span class="text-blue-bg">Begin Assessment</span></button></center>
                            </div>
                            <div class="col-md-12 cisosp">

                                <div class="row">
                                    <div class="col-md-3">

                                             <div class="image-upload-prw" style=" text-align: center;width:100%;">
                                                <?php
                                                	echo $this->Form->control('signature',array(
														'type'=>'text','class'=>'form-control text-center',
														'required'=>true,
														'label'=>false,
														'value'=>$thisUser['first_name']." ".$thisUser['last_name'],
														'style'=>'height:100%;border:none;',
														'readonly'=>true
													));

                                                ?>

                                             </div>

                                    </div>
                                    <div class="col-md-2">
                                        <center>
                                             <div class="currentdate">
                                             	<?php echo date('M d, Y',time()); ?>
                                             </div>
                                        </center>
                                    </div>
                                    <div class="col-md-7 text-right">
		                               <button type="submit" class="cisobtn cisoblue  cisoblue-outline submit-form-btn" style="padding:5px 10px;">Start</button>
		                            </div>
                                </div>
                            </div>


                        </div>
                    </div>
               <?php $this->Form->unlockField('GenControl'); ?>
               <?php $this->Form->unlockField('GenRisk'); ?>

               <div class="nRiskScalesUsed"></div>
               <?php echo $this->Form->end(); ?>
           </div>
       </div>
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
      <div class="modal-body">
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
<!--Risk Description Model-->
<div class="modal" tabindex="-1" role="dialog" id="riskDescModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Risk Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<textarea class="form-control newRiskDesc"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info addNewRiskNow">Add New Risk Domain</button>
      </div>
    </div>
  </div>
</div>
<!--Risk description model ends here-->


<?php if($rassessment->sub_type=='FFIEC Regulated'): ?>
	<!--Risk Factors / Scales Modal-->
	<div class="modal fade" id="fRiskFactorModal" tabindex="-1" role="dialog" aria-labelledby="artifactModalTitle" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-info">
	        <h5 class="modal-title text-white" id="exampleModalLongTitle">Risk Scales</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body p-0">
	    	 <table class="table table-bordered m-b-0 m-0 fRisksDataTable">
	    	 	<thead>
	    	 		<tr class="table-active">
	    	 			<th style="width:20%;">Risk Attribute</th>
	    	 			<th class="">Minor</th>
	    	 			<th class="">Moderate</th>
	    	 			<th class="">Significant</th>
	    	 			<th class="">Major</th>
	    	 			<th class="">Extreme</th>
	    	 		</tr>
	    	 	</thead>
	    	 	<?php foreach($rfRisks as $fk=>$rfrisk): ?>

    	 			<?php foreach($rfrisk->ffiec_risk_factors as $frk=>$fRiskFactor): ?>
    	 				<tbody class="frisk<?php echo $fk.$frk; ?>" style="display:none;">
	    	 				<tr>
	    	 					<td style="color:#000;"><?php echo $fRiskFactor->name; ?></td>
	    	 					<td style="color:#666;"><?php echo $fRiskFactor->minor; ?></td>
	    	 					<td style="color:#666;"><?php echo $fRiskFactor->moderate; ?></td>
	    	 					<td style="color:#666;"><?php echo $fRiskFactor->significant; ?></td>
	    	 					<td style="color:#666;"><?php echo $fRiskFactor->major; ?></td>
	    	 					<td style="color:#666;"><?php echo $fRiskFactor->extreme; ?></td>
	    	 				</tr>
    	 				</tbody>
    	 			<?php endforeach; ?>

	    	 	<?php endforeach; ?>
	    	 </table>
	      </div>
	    </div>
	  </div>
	</div>
	<script>
		$(function(){
			$(document).on('click','.fRiskFactorsInfo',function(){
				var iBtn = $(this);
				var riskId = $(this).data('key');
				console.log(riskId);
				var effectiveTbody = $('.fRisksDataTable').find('.frisk'+riskId);
				$('#fRiskFactorModal').modal('show');
				//console.log(effectiveTbody);
				effectiveTbody.show();
			});
			$('#fRiskFactorModal').on('hidden.bs.modal', function (e) {
			  $('.fRisksDataTable').find('tbody').hide();
			})
		});
	</script>
	<!-- Risk Factors / Scales Modal Ends -->
<?php endif; ?>

<script>
		var rproto = "<?php echo $uProto; ?>";



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
    		//newRisk='';
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
	    				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRisksAndControls'),true); ?>";
						thisUrl = thisUrl.replace("http:", rproto);
						console.log(encodeURI(thisUrl+"/"+subtypeval+"/"+atype));
	    				container.load(encodeURI(thisUrl+"/"+subtypeval+"/"+atype),function(response,status,xhr){
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
    		riskPtable='';
    		riskRgid ="";
    		riskDesc = "";
    		$(document).on('click','.addNewRisk',function(){
    			$('#riskDescModal').modal('show');
    			riskPtable = $(this).parents('table').find('.risks');
    			riskDesc = $('.newRiskDesc').val();
    			if($(this).hasClass('regulated')){
    				riskRgid = $(this).attr('data-rbid');
    			}
    			/*
    			ptable = $(this).parents('table').find('.risks');
    			if($(this).hasClass('regulated')){
    				rgid = $(this).attr('data-rbid');
    				$(reguNewRisk['"'+rgid+'"']).appendTo(ptable)
    			} else {
    				$(newRisk).appendTo(ptable);
    			}
    			*/

    			//console.log(riskPtable);
			});

			$(document).on('keyup','.newRiskDesc',function(){
				var str = $(this).val();
				str = str.replace(/[^a-z0-9\s]/gi, '');
				//str = str.replace(/'/g,'');
				$(this).val(str);
			});

			$(document).on('click','.addNewRiskNow',function(){

				thisRiskDesc = "title='"+$('.newRiskDesc').val()+"'";
				thisRiskDescValue = "value='"+$('.newRiskDesc').val()+"'";
    			if(riskRgid!=""){
    				arisk = reguNewRisk['"'+riskRgid+'"'];
    				arisk = arisk.replace('desctitle',thisRiskDesc).replace('descvalue',thisRiskDescValue);
    				//arisk = arisk.replace('descvalue',thisRiskDescValue);
    			} else {
    				arisk = newRisk.replace('desctitle',thisRiskDesc).replace('descvalue',thisRiskDescValue);
    				//arisk = newRisk.replace('descvalue',thisRiskDescValue);
    			}

    			$(arisk).appendTo(riskPtable);
    			$('[data-toggle="tooltip"]').tooltip();

    			riskPtable = "";
    			riskRgid = "";
    			thisRiskDesc = "";
    			$('.newRiskDesc').val('');
    			$('#riskDescModal').modal('hide');
			});

    		$(document).on('click','.remRisk',function(){
    			/*
				if(confirm("Are you sure ?")){
					$(this).parents('tr').remove();
				}
				*/
				swal({
				  title: "eGRC",
				  text: "Are you sure to delete ?",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				   $(this).parents('tr').remove();
				  }
				});
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
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'uploadArtifact'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.ajax({
						url : thisUrl,
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
								$('<span class="falert alert-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div> <span class="badge bg-warning text-white reUploadArtifact pointer"><i class="fa fa-redo"></i> Re-upload</span> </span>').insertAfter(finput);
							} else {
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Sorry! Something went wrong. Try again.</span>').insertAfter(finput);
								finput.val('');
							}
						}
					});

				}
			});
			//reuploading artifact
			$(document).on('click','.reUploadArtifact',function(){
				var parent = $(this).parents('td');
				parent.find('.artifactUploaded').val('');
				parent.find('.artifact').prop('type','file');
				parent.find('.falert').remove();
				parent.find('.artifact').trigger('click');
			});

			//articact file upload ends


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
				crow += '<button class="btn btn-danger btn-sm remControl float-right" type="button"><i class="fa fa-times-circle"></i></button><h6 style="cursor:pointer;" ><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#controlCollapseNew'+(noe+1)+'" aria-expanded="true" aria-controls="controlCollapseNew'+(noe+1)+'">';
				crow += '<i class="fa fa-chevron-down"></i></button>';
				crow += '<input type="text" style="width:50%;display:inline-block;" placeholder="Enter Control Area Name" required class="form-control input-sm" name="GenControl'+rbid+'[control]['+(noe)+'][name][]" value="">';
				crow += '</h6></div><div id="controlCollapseNew'+(noe+1)+'" class="collapse show" aria-labelledby="controlHeadingNew'+(noe+1)+'" data-parent="#controlRequirements'+brbid+'">';
				crow += '<div class="card-bod"><textarea class="form-control" placeholder="Enter Control Description" required name="GenControl'+rbid+'[control]['+(noe)+'][description][]"></textarea><table class="table table-borderless table-hover">';
				crow += '<thead><tr class="bg-light text-dark"><th>Control Requirements</th><!--<th>Artifact File</th>-->';
				crow += '<!--<th>Reference</th>--></tr></thead><tbody class="controlReqBody"></tbody></table><p style="padding:8px;"><button class="btn btn-sm btn-primary addNewControlReq '+regu+'" data-rbid="'+brbid+'" type="button"><i class="fa fa-plus-square"></i>';
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
					readonly="";
				} else {
					if($('.subtype').val()!="Other"){
						readonly="disabled";
					} else {
						readonly="";
					}

				}
				rbid = "";
				if(btn.hasClass('regulated')){
					rbid="["+btn.attr('data-rbid')+"]";
				}
				//adding new control requirement to control
				rqRow = '<tr><td style="width:40%;"><input type="text" class="form-control input-sm" name="GenControl'+rbid+'[control]['+noc+'][req][name][]" required value="">';
				rqRow += '</td><!--<td style="width:25%;"><input type="hidden" class="artifactUploaded" name="GenControl'+rbid+'[control]['+noc+'][req][artifact][]">';
				rqRow += '<input type="file" '+reqrd+' '+readonly+' class="form-control input-sm artifact" accept=".pdf">-->';
				rqRow += '</td><!--<td ><input type="text" '+readonly+' class="form-control input-sm" placeholder="Reference info" name="GenControl'+rbid+'[control]['+noc+'][req][reference][]"></td>--></tr>';
				//alert(rqRow);
				parent.find('.controlReqBody').append(rqRow);
			});

			//removing control area
			$(document).on('click','.remControl',function(){
				var btn = $(this);
				/*
				if(confirm("Are you sure to remove this Control ?")){
					btn.parents('.controlCard').remove();
				}
				*/
				swal({
				  title: "eGRC",
				  text: "Are you sure to remove this Control ?",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				   btn.parents('.controlCard').remove();
				  }
				});
			});
			//controlarea add/remove functions ends





			//for regulated assessments
			reguRisksControls="";
			reguNewRisk = {"test":"test value"};
			$(document).on('click','.thisRegulatoryBodies .reguBody',function(){
				var rbody = $(this);
				var atype = $('.atype').val();
				pageLoader.addClass('open');
				rcontainer = $('.reguRisksControls');
				if(rbody.prop('checked')==true){
					//if selected any regulatory body
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRisksAndControlsRegulated'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.get(thisUrl+"/"+rbody.val()+"/"+atype,function(resp){
						//return resp;
						pageLoader.removeClass('open');
						rcontainer.append(resp);

						//console.log(resp);
						resp = $('.rBodyCard'+rbody.val());
						rnewRisk = resp.find('.newRiskRow').html();
						resp.find('.newRisk').remove();
						reguNewRisk['"'+rbody.val()+'"']=rnewRisk;
						//console.log(reguNewRisk);

						resp.find('[data-toggle="collapse"]').trigger('click');

					});
    			} else {
    				/*
					if(confirm("All of your data updated for this regulatory body will be lost. Are you sure ?")){
						rcontainer.find('.rBodyCard'+rbody.val()).remove();
					} else {
						rbody.prop('checked',true);
					}
					*/
					swal({
					  title: "eGRC",
					  text: "All of your data updated for this regulatory body will be lost. Are you sure?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) {
					    rcontainer.find('.rBodyCard'+rbody.val()).remove();
					  } else {
					  	rbody.prop('checked',true);
					  }
					});

					pageLoader.removeClass('open');
				}

			});

			//removing regulatory body for assessment
			$(document).on('click','.remRBody',function(){
				$($(this).attr('data-rbody')).trigger('click');
			});

			//for regulated assessments ends here


		   $(document).on('submit','.assessmentForm',function(e){
		   		//at least 1 regulatory body must be selected for
		   		//regulated assessments
		   		var regus = $('.reguBody');
		   		var required = 0;
		   		if(regus.length>0){
		   			regus.each(function(){
		   				if($(this).prop('checked')==true){
		   					required++;
		   				}
		   			});
		   			if(required==0){
		   				//alert("Kindly select atleast one regulatory body.");
		   				swal({
						  title: "eGRC",
						  text: "Kindly select atleast one regulatory body.",
						  icon: "warning",
						  buttons: true,
						  //dangerMode: true,
						});
		   				e.preventDefault();
		   				return;
		   			}


		   		}


		   		//cehcking if control area requirement present
		   		//for each control
		   		var controlCards = $('.controlCard');
		   		required=0;
		   		controlCards.each(function(){
		   			var a = $(this).find('.controlReqBody tr');
		   			if(a.length==0){
		   				required++;
		   			}
		   			//console.log(required);
		   		});
		   		if(required>0){
		   			swal({
					  title: "eGRC",
					  text: "Control Area must have at least 1 Control Area Requirement. Kindly check your custom control areas.",
					  icon: "warning",
					  buttons: true,
					  //dangerMode: true,
					});
		   			e.preventDefault();
		   		}

		   });

		}); //document ready ends

   	$(function(){
   		$('[data-toggle="popover"]').popover();
   	});


</script>
