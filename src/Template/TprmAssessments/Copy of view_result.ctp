<style>
	.contReqs {
		cursor:pointer;
	}
	.fa-minus-square {
		color:red !important;
	}
</style>
<div class="">
	<table class="table table-bordered bg-white">
		<tr>
			<td>
				<h5 class="text-themecolor">Assessment Submission Name</h5>
				<br>
				<?php echo $assessment->name; ?>
			</td>
			<td>
				<h5 class="text-themecolor">Assessment Type</h5>
				<br>
				<?php echo $assessment->sub_type; ?> (<?php echo $assessment->atype; ?>)
			</td>
			<td>
				<h5 class="text-themecolor">Submission Date</h5>
				<br>
				<?php echo date('d-M-y h:i a',strtotime($assessment->created)); ?> 
			</td>
			
			<td>
				<h5 class="text-themecolor">Submitted By</h5>
				<br>
				<?php echo $assessment->user->first_name." ".$assessment->user->last_name; ?>
			</td>
			
		</tr>
	</table>
</div>
<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="risks-tab" data-toggle="pill" href="#risks" role="tab" aria-controls="risks" aria-selected="true">
    	Risks
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="controls-tab" data-toggle="pill" href="#controls" role="tab" aria-controls="controls" aria-selected="false">
    	Controls
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="rcmapping-tab" data-toggle="pill" href="#rcmapping" role="tab" aria-controls="rcmapping" aria-selected="false">
    	Risk Control Mapping
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="scales-tab" data-toggle="pill" href="#scales" role="tab" aria-controls="scales" aria-selected="false">
    	Scales
    </a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="risks" role="tabpanel" aria-labelledby="risks-tab">
  	<?php if($assessment->sub_type=='Regulated'): ?>
  		<div class="accordion" id="rbAccordion">
  			
			<?php $i=0; foreach($assessment->assessments_regulatory_bodies as $rBody): ?>
				
			 
			  <div class="card" style="border:1px solid #233149;margin-top:8px;">
			    <div class="card-heade" id="headingr<?= $rBody->id ?>">
			      <h4 class="mb-0 p-10 text-white <?php echo $i==0?'collapsed':''; ?>" style="cursor:pointer;background:#233149;" data-toggle="collapse" data-target="#rcollapse<?= $rBody->id ?>" aria-expanded="false" aria-controls="rcollapse<?= $rBody->id ?>">
			      	<span class="fa fa-chevron-circle-down float-right"></span>
				    <?= $rBody->regulatory_body->name ?>
			      </h4>
			    </div>
			
			    <div id="rcollapse<?= $rBody->id ?>" class="collapse <?php echo $i==0?'show':''; ?>" aria-labelledby="headingr<?= $rBody->id ?>" data-parent="#rbAccordion">
			      <div class="card-body p-0">
			        <div class="row">
				    	<div class="col-12">
				    		<div class="card">
				    			
				    			<table class="table table-bordered m-b-0 table-hover">
				    				<thead>
				    					<tr>
				    						<th class="text-themecolor">No.</th>
				    						<th class="text-themecolor">Risk Domain</th>
				    						<th class="text-themecolor">Inhrent Scale</th>
				    						<?php if($assessment->status=="Completed"): ?>
				    							<th class="text-themecolor">Residual Scale</th>
				    						<?php endif; ?>
				    					</tr>
				    				</thead>
				    				<tbody>
				    					<?php $sr=1; foreach($rBody->assessment_risks as $risk): ?>
				    						<tr>
				    							<td align="center" style="width:50px;"><?= $sr++ ?>.</td>
				    							<td><?= $risk->risk ?></td>
				    							<td style="width:130px;" class="<?= $risk->inherent_scale ?> text-white"><?= $risk->inherent_scale ?></td>
				    							<td style="width:130px;" class="<?= $risk->residual_scale ?> text-white"><?= $risk->residual_scale ?></td>
					    					</tr>
				    					<?php endforeach; ?>
				    				</tbody>
				    			</table>
				    		</div>
				    	</div>
				    	
				    </div>
			      </div>
			    </div>
			  </div>
			<?php $i++; endforeach; ?>
		</div> <!--regu body accordion ends-->
  	<?php else: ?>
  		<table class="table table-bordered m-b-0 table-hover">
			<thead>
				<tr class="bg-inverse text-white">
					<th class="text-themecolor">No.</th>
					<th class="text-themecolor">Risk Domain</th>
					<th class="text-themecolor">Inhrent Scale</th>
					<?php if($assessment->status=="Completed"): ?>
						<th class="text-themecolor">Residual Scale</th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php $sr=1; foreach($assessment->assessment_risks as $risk): ?>
					<tr>
						<td align="center" style="width:50px;"><?= $sr++ ?>.</td>
						<td><?= $risk->risk ?></td>
						<td style="width:130px;" class="<?= $risk->inherent_scale ?> text-white"><?= $risk->inherent_scale ?></td>
						<td style="width:130px;" class="<?= $risk->residual_scale ?> text-white"><?= $risk->residual_scale ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
  	<?php endif ?>
  </div>
  <div class="tab-pane fade" id="controls" role="tabpanel" aria-labelledby="controls-tab">
  		<?php if($assessment->sub_type=='Regulated'): ?>
  		<div class="accordion" id="cAccordion">
			<?php $i=0; foreach($assessment->assessments_regulatory_bodies as $rBody): ?>
				
			 
			  <div class="card" style="border:1px solid #233149;margin-top:8px;">
			    <div class="card-heade" id="headingc<?= $rBody->id ?>">
			      <h4 class="mb-0 p-10 text-white <?php echo $i==0?'collapsed':''; ?>" style="cursor:pointer;background:#233149;" data-toggle="collapse" data-target="#ccollapse<?= $rBody->id ?>" aria-expanded="false" aria-controls="ccollapse<?= $rBody->id ?>">
			      	<span class="fa fa-chevron-circle-down float-right"></span>
				    <?= $rBody->regulatory_body->name ?>
			      </h4>
			    </div>
			
			    <div id="ccollapse<?= $rBody->id ?>" class="collapse <?php echo $i==0?'show':''; ?>" aria-labelledby="headingc<?= $rBody->id ?>" data-parent="#cAccordion">
			      <div class="card-body p-0">
			        <div class="row">
				    	<div class="col-12">
				    		<div class="card bg-white" style="border:1px solid #ccc;" id="assessmentControls">
				    			<table class="table table-bordered table-hover m-b-0">
			    					<thead>
			    						<tr class="text-center text-blue">
			    							<td rowspan="2" valign="middle" class="bg-info text-white"></td>
				    						<td rowspan="2" valign="middle" class="bg-info text-white">Control Area</td>
				    						<td rowspan="2" valign="middle" class="bg-info text-white">Compliance Status</td>
				    						<td colspan="<?php echo count($rBody->assessment_controls[0]->assessment_maturity_scores)+1; ?>"  class="bg-info text-white">
				    							Control Maturity
				    						</td>
			    						</tr>
			    						<tr>
			    							<td valign="middle" class="bg-info text-white">Maturity Rating</td>
				    						<?php foreach($rBody->assessment_controls[0]->assessment_maturity_scores as $mAttr): ?>
				    							<td valign="middle" class="bg-info text-white"><?php echo $mAttr->maturity_attribute; ?></td>
				    						<?php endforeach; ?>
			    						</tr>
			    					</thead>
					    			<?php foreach($rBody->assessment_controls as $control): ?>
				    				
					    					<tbody>
					    						<tr class="table-warning">
					    							<td class="text-blue bg-light text-center">
					    								<span class="fa fa-plus-square contReqs" data-target="#contReqTable<?= $control->id ?>"></span>
					    							</td>
						    						<td class="bg-primary text-white"><?= $control->name ?></td>
						    						<td><?= $control->compliance_status ?></td>
						    						<td class="text-center"><?= $control->maturity_rating ?></td>
						    						<?php foreach($control->assessment_maturity_scores as $mAttr): ?>
						    							<td><?php echo $mAttr->maturity_option; ?></td>
						    						<?php endforeach; ?>
					    						</tr>
					    						<tr style="display:none;" class="contReqslist table-info" id="contReqTable<?= $control->id ?>">
					    							<td></td>
					    							<td class=""> <?= $control->name ?> Requirements</td>
					    							<td style="padding:0px;" colspan="<?php echo count($control->assessment_maturity_scores)+2; ?>">
					    								<table class="table table-bordered table-hover" style="margin:0px;">
							    							<tbody>
										    					<?php foreach($control->assessment_control_requirements as $creq): ?>
										    						<tr>
										    							<td><?= $creq->name ?></td>
										    							<td>
										    								<?php if(strlen($creq->artifact)>0): ?>
										    									<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="<?php echo $creq->artifact; ?>">
										    										Artifact
										    									</button>
										    								<?php else: ?>
										    									No Artifact
										    								<?php endif; ?>
										    							</td>
										    							<td><i><u>Refs/Narrative.:</u></i><?= $creq->reference ?></td>
										    						</tr>
										    					<?php endforeach; ?>
										    				</tbody>
							    						</table>
					    							</td>
					    							
					    						</tr>
					    					</tbody>
					    				
					    			<?php endforeach; ?>
				    			</table>
				    		</div>
				    	</div>
				    </div>
			      </div>
			    </div>
			  </div>
			<?php $i++; endforeach; ?>
		</div> <!--regu body accordion ends-->
  	<?php else: ?>
  		<table class="table table-bordered table-hover m-b-0">
			<thead>
				<tr class="text-center text-blue">
					<td rowspan="2" valign="middle" class="bg-info text-white"></td>
					<td rowspan="2" valign="middle" class="bg-info text-white">Control Area</td>
					<td rowspan="2" valign="middle" class="bg-info text-white">Compliance Status</td>
					<td colspan="<?php echo count($assessment->assessment_controls[0]->assessment_maturity_scores)+1; ?>"  class="bg-info text-white">
						Control Maturity
					</td>
				</tr>
				<tr>
					<td valign="middle" class="bg-info text-white">Maturity Rating</td>
					<?php foreach($assessment->assessment_controls[0]->assessment_maturity_scores as $mAttr): ?>
						<td valign="middle" class="bg-info text-white"><?php echo $mAttr->maturity_attribute; ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<?php foreach($assessment->assessment_controls as $control): ?>
			
					<tbody>
						<tr class="table-warning">
							<td class="text-blue bg-light text-center">
								<span class="fa fa-plus-square contReqs" data-target="#contReqTable<?= $control->id ?>"></span>
							</td>
    						<td class="bg-primary text-white"><?= $control->name ?></td>
    						<td><?= $control->compliance_status ?></td>
    						<td class="text-center"><?= $control->maturity_rating ?></td>
    						<?php foreach($control->assessment_maturity_scores as $mAttr): ?>
    							<td><?php echo $mAttr->maturity_option; ?></td>
    						<?php endforeach; ?>
						</tr>
						<tr style="display:none;" class="contReqslist table-info" id="contReqTable<?= $control->id ?>">
							<td></td>
							<td class=""> <?= $control->name ?> Requirements</td>
							<td style="padding:0px;" colspan="<?php echo count($control->assessment_maturity_scores)+2; ?>">
								<table class="table table-bordered table-hover" style="margin:0px;">
	    							<tbody>
				    					<?php foreach($control->assessment_control_requirements as $creq): ?>
				    						<tr>
				    							<td><?= $creq->name ?></td>
				    							<td>
				    								<?php if(strlen($creq->artifact)>0): ?>
				    									<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="<?php echo $creq->artifact; ?>">
				    										Artifact
				    									</button>
				    								<?php else: ?>
				    									No Artifact
				    								<?php endif; ?>
				    							</td>
				    							<td><i><u>Refs/Narrative.:</u></i><?= $creq->reference ?></td>
				    						</tr>
				    					<?php endforeach; ?>
				    				</tbody>
	    						</table>
							</td>
							
						</tr>
					</tbody>
				
			<?php endforeach; ?>
		</table>
  	<?php endif ?>
  </div>
  <div class="tab-pane fade" id="rcmapping" role="tabpanel" aria-labelledby="rcmapping-tab">
  		<?php if($assessment->sub_type=='Regulated'): ?>
	  		
	  			<div class="accordion" id="mapingAccordion">
					<?php $a=0; foreach($rcmappings as $rcmap): ?>
						<?php 
							$risks = $rcmap['mappings']['risks'];
							$table = $rcmap['mappings']['table'];
							$residuals = [];
							foreach($rcmap['mappings']['risk_ids'] as $rid){
								$residuals[$rid]['total']=0;
								$residuals[$rid]['count']=0;
							}
						?>
					  <div class="card" style="border:1px solid #233149;margin-top:8px;">
					    <div class="card-heade" id="mheading<?= $rcmap->id ?>">
					      <h4 class="mb-0 p-10 text-white <?php echo $a==0?'collapsed':""; ?>" style="cursor:pointer;background:#233149;" data-toggle="collapse" data-target="#mcollapse<?= $rcmap->id ?>" aria-expanded="false" aria-controls="mcollapse<?= $rcmap->id ?>">
					      	<span class="fa fa-chevron-circle-down float-right"></span>
						    <?= $rcmap->name ?>
					      </h4>
					    </div>
					    <div id="mcollapse<?= $rcmap->id ?>" class="collapse <?php echo $a==0?'show':""; ?>" aria-labelledby="mheading<?= $rcmap->id ?>" data-parent="#mapingAccordion">
					      <div class="card-body p-0">
					       		<div class="table-responsive">
						    	  <table class="table table-bordered table-hover myTable m-0">
					
								  	<thead>
								  		<tr>
								  			<!--<th  class="bg-light-info"></th>-->
								  			<th class="bg-warning text-white"></th>
								  			<th class="bg-warning text-white" colspan="3"></th>
								  			<th  class="bg-inverse" colspan="<?php echo count($risks); ?>">Risks &rarr;</th>
								  		</tr>
								  		<tr>
								  			<!--<th class="bg-light-info">No.</th>-->
								  			<th class="bg-warning text-white"> Control Areas &darr;</th>
								  			<th class="bg-info text-white"> Complaince </th>
								  			<th class="bg-info text-white"> Maturity</th>
								  			<th class="bg-info text-white"> Sub Total</th>
								  			<?php foreach($risks as $k=>$risk): ?>
								  				<th class="bg-inverse"><?php echo $risk; ?></th>
								  				
								  			<?php endforeach; ?>
								  		</tr>
								  	</thead>
								  	<tbody>
								  		
								  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
									  		<tr>
									  			<!--<td><?php echo $i++; ?></td>-->
									  			<td><?php echo $risk_id; ?></td>
									  			
									  			<?php $j=0; foreach($rows as $row): ?>
									  				<?php if($j==0): ?>
										  				<td>
										  					<?php echo $row['assessment_control']['compliance_score']; ?>
										  				</td>
										  				<td>
										  					<?php echo $row['assessment_control']['maturity_rating']; ?>
										  				</td>
										  				<td>
										  					<?php echo $row['assessment_control']['sub_total']; ?>
										  				</td>
									  				<?php endif; ?>
									  				<td>
									  					<?php echo $row['mapping']; ?>
									  					<?php 
									  						if($row['mapping']=="P"){
									  							$residuals[$row['assessment_risk']['id']]['total']+=$row['assessment_control']['maturity_rating'];
																$residuals[$row['assessment_risk']['id']]['count']++;
									  						}
									  					?>	
									  				</td>
									  			<?php $j++; endforeach; ?>
									  		</tr>
								  		<?php endforeach; ?>
								  		<tr class="table-active">
								  			<td class="bg-warning text-white">
							  					Control Coverage
							  				</td>
							  				<td class="bg-warning text-white">
							  					0.7
							  				</td>
							  				<td class="bg-warning text-white">
							  					0.3
							  				</td>
							  				<td class="bg-warning text-white"></td>
							  				<?php foreach($residuals as $residual): ?>
							  					<td class="bg-inverse text-warning"><?php echo $residual['count']==0?:round($residual['total']/$residual['count'],2); ?></td>
							  				<?php endforeach; ?>
								  		</tr>
								  	</tbody>
								  </table>
								</div>
					      </div>
					    </div>
					  </div>
					<?php $a++; endforeach; ?>
				</div>
	  		
  		<?php else: ?>
  			<?php 
  				$residuals=[];
  				foreach($risk_ids as $rid){
					$residuals[$rid]['total']=0;
					$residuals[$rid]['count']=0;
				}
  			?>
  			<div class="table-responsive">
	    	  <table class="table table-bordered table-hover myTable m-0">

			  	<thead>
			  		<tr>
			  			<!--<th  class="bg-light-info"></th>-->
			  			<th class="bg-warning text-white"></th>
			  			<th class="bg-warning text-white" colspan="3"></th>
			  			<th  class="bg-inverse" colspan="<?php echo count($risks); ?>">Risks &rarr;</th>
			  		</tr>
			  		<tr>
			  			<!--<th class="bg-light-info">No.</th>-->
			  			<th class="bg-warning text-white"> Control Areas &darr;</th>
			  			<th class="bg-info text-white"> Complaince </th>
			  			<th class="bg-info text-white"> Maturity</th>
			  			<th class="bg-info text-white"> Sub Total</th>
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th class="bg-inverse"><?php echo $risk; ?></th>
			  				
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<!--<td><?php echo $i++; ?></td>-->
				  			<td><?php echo $risk_id; ?></td>
				  			
				  			<?php $j=0; foreach($rows as $row): ?>
				  				<?php if($j==0): ?>
					  				<td>
					  					<?php echo $row['assessment_control']['compliance_score']; ?>
					  				</td>
					  				<td>
					  					<?php echo $row['assessment_control']['maturity_rating']; ?>
					  				</td>
					  				<td>
					  					<?php echo $row['assessment_control']['sub_total']; ?>
					  				</td>
				  				<?php endif; ?>
				  				<td>
				  					<?php echo $row['mapping']; ?>
				  					<?php 
				  						if($row['mapping']=="P"){
				  							$residuals[$row['assessment_risk']['id']]['total']+=$row['assessment_control']['maturity_rating'];
											$residuals[$row['assessment_risk']['id']]['count']++;
				  						}
				  					?>	
				  				</td>
				  			<?php $j++; endforeach; ?>
				  		</tr>
			  		<?php endforeach; ?>
			  		<tr class="table-active">
			  			<td class="bg-warning text-white">
		  					Control Coverage
		  				</td>
		  				<td class="bg-warning text-white">
		  					0.7
		  				</td>
		  				<td class="bg-warning text-white">
		  					0.3
		  				</td>
		  				<td class="bg-warning text-white"></td>
		  				<?php foreach($residuals as $residual): ?>
		  					<td class="bg-inverse text-warning"><?php echo $residual['count']==0?:round($residual['total']/$residual['count'],2); ?></td>
		  				<?php endforeach; ?>
			  		</tr>
			  	</tbody>
			  </table>
			</div>
  		<?php endif; ?>
  </div>
  <div class="tab-pane fade" id="scales" role="tabpanel" aria-labelledby="scales-tab">
  	  <h3>Risk Severity</h3>
  	  <table class="table table-bordered table-hover" style="font-size:15px;margin-bottom:0px;">
    	<thead>
    		<tr class="table-inverse">
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
    		<?php foreach($riskScales as $cScale): ?>
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
    <hr>
    <br>
    <h3>Control Effectiveness</h3>
    <table class="table table-bordered table-hover">
    	<thead>
    		<tr class="table-inverse">
    			<th>Name</th>
    			<th>Description</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php foreach($compStatuses as $compStatus): ?>
    			<tr class="table-active">
    				<td><?php echo $compStatus->name; ?></td>
    				<td><?php echo $compStatus->description; ?></td>
    			</tr>
    		<?php endforeach; ?>
    	</tbody>
    </table>
  </div>
</div>

<!--artifact Modal-->
<div class="modal fade" id="artifactModal" tabindex="-1" role="dialog" aria-labelledby="artifactModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
        	Artifact File
        	<span class="artifactLoader text-danger"><i class="fa fa-spinner fa-spin"></i> <span class="blinking">Loading file. Please wait...</span></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <embed style="width:100%;height:9in;" id="artifactFrame" src=""></embed>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--artifact modal ends-->
<script>
	$(function(){
		$('.contReqslist').hide();
		$(document).on('click','.contReqs',function(){
			target = $(this).attr('data-target');
			$(target).toggle('show');
			$(this).toggleClass('fa-minus-square');
		});
		
		$(document).on('click','.showArtifact',function(){
			artifact = $(this).attr('data-file');
			if(artifact){
				$('#artifactFrame').prop('src',artifact);
				$('#artifactModal').modal('show');
				setTimeout(function(){
					$('.artifactLoader').hide();
				},5000);
			}
			
		});
		$('#artifactModal').on('hidden.bs.modal', function (e) {
		  $('#artifactFrame').prop('src',"");
		  $('.artifactLoader').show();
		})
	});
</script>