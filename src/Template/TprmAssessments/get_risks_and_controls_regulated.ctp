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
	<div class="card rBodyCard<?php echo $rBody->id; ?>">
	    <div class="card-header bg-dark" id="heading<?php echo $rBody->id; ?>">
	    	<button class="btn btn-danger remRBody" style="float:right;" data-rbody="input#regulatoryBody<?php echo $rBody->id; ?>" type="button">
	    		<i class="fa fa-times-circle"></i>
	    	</button>
	      <h2 class="mb-0">
	        <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#rcollapse<?php echo $rBody->id; ?>" aria-expanded="true" aria-controls="rcollapse<?php echo $rBody->id; ?>">
	          <?php echo $rBody->name; ?>
	        </button>
	      </h2>
	    </div>
	
	    <div id="rcollapse<?php echo $rBody->id; ?>" class="collapse" aria-labelledby="heading<?php echo $rBody->id; ?>" data-parent="#rAccordion">
	      <div class="card-body myRBody" data-id="<?php echo $rBody->id; ?>">
	        
	        <div class="row">
				<div class="col-4">
					<div class="card">
						<div class="card-header bg-dark text-white">
							<h6 class="mb-0">
								<!--
								<button type="button" class="btn btn-warning btn-sm float-right customRiskModalBtn regulated" data-rbid="<?php echo $rBody->id; ?>" data-toggle="tooltip" title="You can use custom Risk Severity Scales if needed." data-placement="top">
									Use custom scales
								</button>
								-->
								Update Inherent Scores 
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
									
									
									<?php foreach($risks as $risk): ?>
										<tr>
											<td>
												<label class="control-label">
													<?php echo $risk->name; ?>
													<?php if(strlen($risk->description)>0): ?>
														<i class="fa fa-info-circle text-info" style="margin-top:10px;margin-right:-18px;" title="<?php echo strip_tags($risk->description); ?>" data-toggle="tooltip" data-placement="right"></i>
													<?php endif; ?>
													
												</label>
												
												<input type="hidden" name="GenRisk[<?php echo $rBody->id; ?>][inherent][id][]" value="<?php echo $risk->id; ?>">
												<input type="hidden" name="GenRisk[<?php echo $rBody->id; ?>][inherent][name][]" value="<?php echo $risk->name; ?>">
												<input type="hidden" class="thisRiskDescValue" name="GenRisk[<?php echo $rBody->id; ?>][inherent][description][]" value="<?php echo strip_tags($risk->description); ?>">
												
											</td>
											<!--
											<td>
												<select <?php echo $readonly; ?> required class="form-control input-sm nRScales" name="GenRisk[<?php echo $rBody->id; ?>][inherent][scale][]">
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
											<button class="btn btn-sm btn-info addNewRisk regulated" type="button" data-rbid="<?php echo $rBody->id; ?>">
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
										<i class="fa fa-info-circle text-info float-right thisRiskDesc" style="margin-top:10px;margin-right:-18px;" desctitle data-toggle="tooltip" data-placement="right"></i>
										<input type="text" class="form-control input-sm" required name="GenRisk[<?php echo $rBody->id; ?>][inherent][name][]" value="" placeholder="Enter Risk Name">
										<input type="hidden" class="thisRiskDescValue" name="GenRisk[<?php echo $rBody->id; ?>][inherent][description][]" descvalue>
									</td>
									<!--
									<td>
										<select <?php echo $readonly; ?> required class="form-control input-sm nRScales" name="GenRisk[<?php echo $rBody->id; ?>][inherent][scale][]">
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
								Kindly update control requirements for each control.
							</p>
							<div class="accordion" id="controlRequirements<?php echo $rBody->id; ?>">
								<?php foreach($controls as $contKey=>$control): ?>
								  <div class="card controlCard" style="border:1px solid #ccc;" data-number="<?php echo $contKey; ?>">
								    <div class="card-header" id="controlHeading<?php echo $control->id; ?>" style="padding:4px 8px;">
								    	<button class="btn btn-danger btn-sm remControl float-right" type="button">
								    		<i class="fa fa-times-circle"></i>
								    	</button>
								      <h6 style="cursor:pointer;" data-toggle="collapse" data-target="#controlCollapse<?php echo $control->id; ?>" aria-expanded="true" aria-controls="controlCollapse<?php echo $control->id; ?>">
								      	 <i class="fa fa-chevron-down"></i>
								      	  <input type="hidden" name="GenControl[<?php echo $rBody->id; ?>][control][<?php echo $contKey; ?>][id][]" value="<?php echo $control->id; ?>">
								      	  <input type="hidden" name="GenControl[<?php echo $rBody->id; ?>][control][<?php echo $contKey; ?>][name][]" value="<?php echo $control->name; ?>">
								      	  <input type="hidden" name="GenControl[<?php echo $rBody->id; ?>][control][<?php echo $contKey; ?>][description][]" value="<?php echo $control->description; ?>">
								          <?php echo $control->name; ?>
								          <i class="fa fa-info-circle text-info" style="margin-top:10px" title="<?php echo strip_tags($control->description); ?>" data-toggle="tooltip" data-placement="top"></i>
								      </h6>
								    </div>
								    <div id="controlCollapse<?php echo $control->id; ?>" class="collapse" aria-labelledby="controlHeading<?php echo $control->id; ?>" data-parent="#controlRequirements<?php echo $rBody->id; ?>">
								      <div class="card-bod">
								    	<table class="table table-borderless table-hover">
								    		<thead>
								    			<tr class="bg-light text-dark">
								    				<td>Control Requirement</td>
								    				<!--
								    				<th>Artifact File</th>
								    				<th>Refs/Narrative</th>
								    				-->
								    			</tr>
								    		</thead>
								    		<tbody class="controlReqBody">
								    			<?php foreach($control->rb_control_requirements as $creq): ?>
								    				<tr>
								    					<td style="width:40%;">
								    						<?php echo $creq->name; ?>
								    						<input type="hidden" name="GenControl[<?php echo $rBody->id; ?>][control][<?php echo $contKey; ?>][req][name][]" value="<?php echo $creq->name; ?>">
								    					</td>
								    					<!--
								    					<td style="width:25%;">
								    						<input type="hidden" class="artifactUploaded" name="GenControl[<?php echo $rBody->id; ?>][control][<?php echo $contKey; ?>][req][artifact][]">
								    						<input type="file" <?php echo $readonly; ?> name="tFiles" class="form-control input-sm artifact" accept=".pdf">
								    					</td>
								    					<td >
								    						<input type="text" <?php echo $readonly; ?> class="form-control input-sm" placeholder="Reference info" name="GenControl[<?php echo $rBody->id; ?>][control][<?php echo $contKey; ?>][req][reference][]">
								    					</td>
								    					-->
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
								<button class="btn btn-sm btn-warning addNewControl regulated" type="button" data-rbid="<?php echo $rBody->id; ?>">
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











