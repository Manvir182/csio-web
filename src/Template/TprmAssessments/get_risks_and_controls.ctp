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
<?php if($subtype=='CMMC'): ?>
	<pre>
		<?php //print_r($cdomains); ?>
	</pre>
	<div class="row">
		<div class="col-12">
			<h4 class="text-dark">CMMC Domains</h4>
			
			<div class="accordion" id="caccordionExample">
			<?php foreach($cdomains as $cdomain): ?>
			  <div class="card">
			    <div class="card-header bg-dark" id="cdomainHeading<?php echo $cdomain['id']; ?>">
			      <h2 class="mb-0">
			        <button class="btn btn-link btn-block text-left text-white" type="button" data-toggle="collapse" data-target="#cdomain<?php echo $cdomain['id']; ?>" aria-expanded="true" aria-controls="cdomain<?php echo $cdomain['id']; ?>">
			          <?php echo $cdomain['name']; ?>
			        </button>
			      </h2>
			    </div>
			
			    <div id="cdomain<?php echo $cdomain['id']; ?>" class="collapse" aria-labelledby="cdomainHeading<?php echo $cdomain['id']; ?>" data-parent="#caccordionExample">
			      <div class="card-body">
			      	
			      	<div class="accordion" id="cdaccordionExample<?php echo $cdomain['id']; ?>">
			      	  <?php foreach($cdomain['levels'] as $level=>$levelData): ?>	
			      	  	<?php $lname = str_replace(' ','',$level); ?>
						  <div class="card">
						    <div class="card-header">
						      <h2 class="mb-0">
						        <button class="btn btn-link btn-block text-dark text-left" type="button" data-toggle="collapse" data-target="#cdomain<?php echo $cdomain['id']; ?>level<?php echo $lname; ?>" >
						          <?php echo $level; ?>
						        </button>
						      </h2>
						    </div>
						
						    <div id="cdomain<?php echo $cdomain['id']; ?>level<?php echo $lname; ?>" class="collapse"  data-parent="#cdaccordionExample<?php echo $cdomain['id']; ?>">
						      <div class="card-body">
						      	<h4>Practices</h4>
						      	<ul>
						      		<?php foreach($levelData as $ldata): ?>
						      			<li>
						      				<?php echo $ldata->code; ?> &mdash; <?php echo $ldata->name; ?>
						      			</li>
						      		<?php endforeach; ?>
						      	</ul>
						      	 <pre>
						      	 	<?php //print_r($levelData); ?>
						      	 </pre>
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
		</div>
	</div>
<?php endif; //CMMC IF ends ?> 

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
	<span class="font-18 text-danger">
		<b>
			<i class="fa fa-info-circle"></i>
			Expand and complete inherent risk exercise for each Risk Domain
		</b>
	</span>
	<div class="row">
		<div class="col-6">
			<div class="card">
	    			<h4 class="m-b-0 p-10 bg-primary card-header text-white font-bold">
    					<div class="row">
				      		<div class="col-sm-6 col-xl-6">
				      			Risk Domains
				      		</div>
				      		<div class="col-lg-3 col-xl-3 text-center">
				      			Inherent Risk
				      			<i class="fa fa-info-circle text-info ml-1" data-toggle="modal" data-target='#scalesModal'></i>
				      		</div>
				      		<div class="col-lg-3 col-xl-3 text-center">
				      			FFIEC Maturity Target
				      		</div>
				      	</div>
	    			
	    			</h4>
	    			
	    			<div class="accordion" id="raccordionExample" style="background:#f7f7f7;">
	    				<div class="row">
	    					<div class="col-sm-9">
	    			  <?php foreach($risks as $key=>$fRisk): ?>
						  <div class="card riskCard" style="border-radius:0px;border-bottom:0px;">
						    <div class="card-header" id="headingOnefar<?php echo $fRisk->id; ?>" style="padding-left:0px;">
						      <h2 class="mb-0">
						      	<div class="row">
						      		<div class="col-sm-9 col-xl-9">
						      			<button class="btn btn-link text-primary collapsed abtns" style="text-align:left !important;" type="button" data-toggle="collapse" data-target="#collapseOnefar<?php echo $fRisk->id; ?>" aria-expanded="true" aria-controls="collapseOnefar<?php echo $fRisk->id; ?>">
						      			  <i class="fa fa-caret-down"></i>
								          <?php echo $fRisk->name; ?>
								          <input type="hidden" name="risksIds[]" value="<?php echo $fRisk->id; ?>">
								          <input type="hidden" name="risks[]" value="<?php echo $fRisk->name; ?>">
								        </button>
								    </div>
						      		<div class="col-sm-3 col-xl-3 text-center">
						      			<span class="btn btn-sm btn-secondary inherent badge-pill Incomplete" style="width:100px;">
											Incomplete
										</span>
										<input type="hidden" name="riskinherent[]" class="inherentField" value="">
						      		</div>
						      		<!--
						      		<div class="col-sm-3 col-xl-3 text-center">
						      			<span class="btn btn-sm btn-secondary residual badge-pill" style="width:100px;">
											Incomplete
										</span>
						      		</div> -->
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
						      			
						      			<?php foreach($fRisk->ffiec_risk_factors as $frk=>$fRiskFactor): ?>
						      				<tr>
						      					<td>
						      						<i class="fa fa-info-circle text-info float-right fRiskFactorsInfo" data-key="<?php echo $key.$frk; ?>"></i>
						      						<?php echo $fRiskFactor->name; ?>
						      						 <input type="hidden" name="riskfactors[<?php echo $key; ?>][<?php echo $frk; ?>][name]" value="<?php echo $fRiskFactor->name; ?>">
						      					</td>
						      					<td class="form-group">
						      						<select class="form-control ffIRiskLevelSelect" name="riskfactors[<?php echo $key; ?>][<?php echo $frk; ?>][scale]" data-id="<?php echo $fRiskFactor->id; ?>">
						      							<option value=""></option>
						      							<?php foreach($rScales as $scale): ?>
						      								<option value="<?php echo $scale->score."~".$scale->severity_scale; ?>"><?php echo $scale->severity_scale; ?></option>
						      							<?php endforeach; ?>
						      						</select>
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
					  
					  <div class="col-sm-3 text-center">
					  	<div class="pt-1">
					  		<span class="" style="margin-left:-30px; width:100%;font-weight:bold;">
								Overall Inherent Risk
							</span>
					  		
					  		<span class="btn btn-sm btn-secondary btn-block badge-pill" id="fOverAllInherent" style="margin-left:-15px;">
								Incomplete
							</span>
					  	</div>
					  	<div class="pt-3">
					  		<span class="" style="margin-left:-30px; width:100%;font-weight:bold;">
								FFIEC Maturity Target
							</span>
					  		<div class="dropdown">
							  <button class="fmTargetBtn btn btn-secondary btn-block residual badge-pill dropdown-toggle" style="margin-left:-15px;" type="button" id="fmTargetBtndropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Incomplete
							  </button>
							  <div class="dropdown-menu fmTargetBtnDropdown" aria-labelledby="fmTargetBtndropdownMenuButton">
							  	
							  </div>
							</div>
					  	</div>
					  </div>
					  </div>
					  
					</div>
	    		</div>
			<!--
			<div class="card">
				<div class="">
					<h6 class="mb-0 card-header bg-dark text-white">
						
						Risk Domains
					</h6>
				</div>
				<div class="card-block">
					<table class="table table-borderless table-hover">
						<thead style="display:none;">
							<tr class="active">
								<th>Risk Domains</th>
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
			-->
			
		</div>
		<div class="col-6" style="color:#2c86a3;">
			<center class="">
				FFIEC provided a general chart which shows the intersection of the Inherent Risk Level 
				obtained using this Risk Profile and the Cybersecurity Maturity Levels.
			</center>
			<p class=" text-center">
				Refer to the table below for guidance and reference on what the ranges will be based on inherent risk.
			</p>
			<p class=" text-center">
				Example: If the results of completing the Inherent Risk Profile indicated "Moderate" - 
				then "<?php echo $thisUser['company_name']; ?>" should strive to have a Cybersecurity Maturity of "Evolving","Intervediate" or "Baseline".
			</p>
			
			<p class="text-center" style="padding:0 120px 0 120px;">
				<?php 
					echo $this->Html->image('ffiec-chart.png',['style'=>'width:100%;']);
				?>
			</p>
			<p class="text-center">
				After expanding and completing the inherent risk excercise for each domain, you can 
				choose to proceed with the minimum maturity required 
				as presented by the assessment tool or you can change to a higher 
				level then click START to begin the assessment.
			</p>
			<div class="card card-info sr-only" style="display:none;">
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
											<input type="hidden" class="mlevels" name="mlevels[]" value="">
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











