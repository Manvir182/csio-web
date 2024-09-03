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
<?php if($subtype=='Generalized'): ?>
	<div class="row">
		<div class="col-4">
			<div class="card">
				<div class="card-header bg-dark text-white">
					<h6 class="mb-0 text-white">
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
									<i class="fa fa-info-circle text-info float-right" data-toggle="modal" data-target="#scalesModal"></i>
									Inherent Risk Rank
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
							
							
							<?php foreach($risks as $risk): ?>
								<tr>
									<td>
										
										<label class="control-label">
											<?php echo $risk->name; ?>
											<?php if(strlen($risk->description)>0): ?>
													<i class="fa fa-info-circle text-info" style="margin-top:10px;margin-right:-18px;" title="<?php echo strip_tags($risk->description); ?>" data-toggle="tooltip" data-placement="right"></i>
											<?php endif; ?>
										</label>
										
										
										<input type="hidden" name="GenRisk[inherent][id][]" value="<?php echo $risk->id; ?>">
										<input type="hidden" name="GenRisk[inherent][name][]" value="<?php echo $risk->name; ?>">
										<input type="hidden" name="GenRisk[inherent][description][]" value="<?php echo strip_tags($risk->description); ?>">
									</td>
									<!--
									<td>
										<select <?php echo $readonly; ?> required class="form-control input-sm nRScales" name="GenRisk[inherent][scale][]">
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
								<i class="fa fa-info-circle text-info float-right thisRiskDesc" style="margin-top:10px;margin-right:-18px;"  desctitle data-toggle="tooltip" data-placement="right"></i>
								<input type="text" class="form-control input-sm" required name="GenRisk[inherent][name][]" value="" placeholder="Enter Risk Name">
								<input type="hidden" class="thisRiskDescValue" name="GenRisk[inherent][description][]" descvalue>
							</td>
							<!--
							<td>
								
								<select <?php echo $readonly; ?> required class="form-control input-sm nRScales" name="GenRisk[inherent][scale][]">
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
					<h6 class="mb-0 text-white">Update Control Requirements</h6>
				</div>
				<div class="card-block" style="padding:8px;">
					<p>
						<button class="btn btn-sm btn-secondary float-right" type="button" data-toggle="modal" data-target="#effectivenessModal">
							Control Effectiveness Scales
						</button>
						Kindly update control requirements for each control.
					</p>
					<div class="accordion" id="controlRequirements">
						<?php foreach($controls as $contKey=>$control): ?>
						  <div class="card controlCard" style="border:1px solid #ccc;" data-number="<?php echo $contKey; ?>">
						    <div class="card-header" id="controlHeading<?php echo $control->id; ?>" style="padding:4px 8px;">
						    	<button class="btn btn-danger btn-sm remControl float-right" type="button">
						    		<i class="fa fa-times-circle"></i>
						    	</button>
						      <h6 style="cursor:pointer;" data-toggle="collapse" data-target="#controlCollapse<?php echo $control->id; ?>" aria-expanded="true" aria-controls="controlCollapse<?php echo $control->id; ?>">
						      	 <i class="fa fa-chevron-down"></i>
						      	 <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][id][]" value="<?php echo $control->id; ?>">
						      	  <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][name][]" value="<?php echo $control->name; ?>">
						      	  <input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][description][]" value="<?php echo $control->description; ?>">
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
						    				<!--<th>Artifact File</th>-->
						    				<!--<th>Refs/Narrative</th>-->
						    				
						    			</tr>
						    		</thead>
						    		<tbody class="controlReqBody">
						    			<?php foreach($control->gen_control_requirements as $creq): ?>
						    				<tr>
						    					<td style="width:40%;">
						    						<?php echo $creq->name; ?>
						    						<input type="hidden" name="GenControl[control][<?php echo $contKey; ?>][req][name][]" value="<?php echo $creq->name; ?>">
						    					</td>
						    					<!--
												<td style="width:25%;">
													<input type="hidden" class="artifactUploaded" name="GenControl[control][<?php echo $contKey; ?>][req][artifact][]">
													<input <?php echo $readonly; ?> type="file" <?php echo $required=='Yes'?'required':''; ?> name="tFiles" class="form-control input-sm artifact" accept=".pdf">
												</td>-->
												
						    					<!--
												<td >
													<input type="text" <?php echo $readonly; ?> class="form-control input-sm" placeholder="Reference info" name="GenControl[control][<?php echo $contKey; ?>][req][reference][]">
												</td>-->
												
						    					
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
<?php endif; //generalized IF ends ?> 



<?php if($subtype=='Regulated'): ?>
	<div class="col-md-12 col-sm-12" style="margin-left:-35px;">	
    	<div class="form-row">                                          
          <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
            	<h6 class="questions">Select Regulatory Body</h6>
            </div> 
            <div class="col-md-7 col-sm-7 col-md-7 col-xs-12 m-t-10">
            	<ul class="thisRegulatoryBodies">
					<?php foreach($regulatoryBodies as $rBody): ?>
						<li>
				    		<?php 
				        		echo $this->Form->control('regulatoryBody['.$rBody->id.'][]',[
				        			'value'=>$rBody->id,
				        			'id'=>'regulatoryBody'.$rBody->id,
				        			'label'=>array('text'=>" ".$rBody->name,),
				        			'type'=>'checkbox',
				        			'hiddenField'=>false,
				        			'class'=>'reguBody'
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
    <div class="col-md-12 col-sm-12 reguRisksControls accordion" id="rAccordion" style=""></div> 
	
	
	
	


<?php endif; //Regulated IF ends ?> 





<?php if($subtype=='Other'): ?>
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
						<button class="btn btn-sm btn-secondary float-right" type="button" data-toggle="modal" data-target="#effectivenessModal">
							Control Effectiveness Scales
						</button>
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
<?php endif; //Other IF ends ?> 
<?php if($subtype=='FFIEC Regulated'): ?>
	<div class="row">
		<div class="col-4">
			<div class="card">
				<div class="">
					<h6 class="mb-0 card-header bg-dark text-white">
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
						<thead style="display:none;">
							<tr class="active">
								<th>Risk Domains</th>
								<!--
								<th>
									Inherent Risk Rank
									<i class="fa fa-info-circle text-info float-right" data-toggle="modal" data-target="#scalesModal"></i>
								</th>
								-->
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
							<?php foreach($risks as $risk): ?>
								<tr>
									<td>
										<input type="hidden" name="risks[]" value="<?php echo $risk->name; ?>">
										<?php echo $risk->name; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
		<div class="col-8">
			<div class="card card-info">
				<div class="">
					<h6 class="mb-0 card-header bg-dark text-white">FFIEC Domains</h6>
				</div>
				<div class="card-block" style="padding:0px;">
					<p style="padding:8px;">
						<button class="btn btn-sm btn-secondary float-right sr-only" type="button" data-toggle="modal" data-target="#effectivenessModal">
							Control Effectiveness Scales
						</button>
						Kindly select the desired maturity for each domain.
					</p>
					<table class="table table-hover m-b-0">
						<thead>
							<tr class="table-active">
								<th>
									Domain 
								</th>
								<th>
									Desired Maturity
									<i class="fa fa-info-circle text-info" style="margin-top:10px;"  data-toggle="modal" data-target="#fmlevelModal" title="Maturity Levels Information"></i>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($domains as $domain): ?>
								<tr>
									<td>
										<div class="form-group">
											<input type="hidden" name="domains[]" value="<?php echo $domain->id; ?>">
											<?php echo $domain->name; ?>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control input-sm" required name="mlevels[]">
												<option value="">-- Select --</option>
												<?php foreach($mLevels as $mLevel): ?>
													<option value="<?php echo $mLevel; ?>"><?php echo $mLevel; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

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











