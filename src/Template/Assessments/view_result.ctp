<style>
	.contReqs {
		cursor:pointer;
	}
	.fa-minus-square {
		//color:yellow !important;
	}
</style>

<div class="">
	<?php 
		$rcolors=[
			'Minor'=>'#008000','Major'=>'#ff0000','Moderate'=>'#ffff00','Extreme'=>'#701314','Significant'=>'#ff9900',""=>""
		];
		
	?>
	<table class="table table-bordered bg-white exporttable toExport">
		<tr>
			<td colspan="4" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
				Assessment Info
			</td>
		</tr>
		<tr>
			<td style="color:#800080;border:1px solid;">
				<h5 class="text-themecolor">Assessment Submission Name</h5>
				
				<?php echo $assessment->name; ?>
			</td>
			<td style="color:#800080;border:1px solid;">
				<h5 class="text-themecolor">Assessment Type</h5>
				
				<?php echo $assessment->sub_type; ?> (<?php echo $assessment->atype; ?>)
			</td>
			<td style="color:#800080;border:1px solid;">
				<h5 class="text-themecolor">Submission Date</h5>
				
				<?php echo date('d-M-y h:i a',strtotime($assessment->created)); ?> 
			</td>
			
			<td style="color:#800080;border:1px solid;">
				<h5 class="text-themecolor">Submitted By</h5>
				
				<?php echo $assessment->user->first_name." ".$assessment->user->last_name; ?>
				<br>
				(<b>Company:</b> <?php echo $assessment->user->company->company_name; ?>)
			</td>
			
		</tr>
	</table>
	
	
	
	
</div>
<?php 
	echo $this->Html->link('<i class="fa fa-file"></i> Download Report',[
		'controller'=>'assessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,'word'
	],[
		'class'=>"btn btn-danger report",
		'escape'=>false,'target'=>'_blank',
		'style'=>'float:right;'
	]);
?>

<button class="btn btn-primary exportbtn" style="float:right;" data-target="toExport">
	<i class="fa fa-download"></i>
	Download Excel
</button>


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
				    			<table class="table table-bordered m-b-0 table-hover toExport" id="<?php echo clean($rBody->regulatory_body->name); ?>_Risks" style="width:50%;">
				    				<thead>
				    					<tr>
											<td colspan="3" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
												Risk Profiles --- <?= $rBody->regulatory_body->name ?>
											</td>
										</tr>
				    					<tr>
											<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Risk Domain</th>
											<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Inhrent Scale</th>
											<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Residual Scale</th>
											
										</tr>
				    				</thead>
				    				<tbody>
				    					<?php $sr=1; foreach($rBody->assessment_risks as $risk): ?>
				    						<tr>
				    							<td style="background:#800080;color:#fff;border:1px solid #888;"><?= $risk->risk ?></td>
				    							<td class="<?= $risk->inherent_scale ?>" style="background:<?= $rcolors[$risk->inherent_scale] ?>;border:1px solid #888;width:130px;"><?= $risk->inherent_scale ?></td>
				    							<td class="<?= $risk->residual_scale ?>" style="background:<?= $rcolors[$risk->residual_scale] ?>;border:1px solid #888;width:130px;"><?= $risk->residual_scale ?></td>
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
	<?php elseif($assessment->sub_type=='FFIEC Regulated'): ?>
		<div class="row">
			<div class="col-10 offset-1">
		<table class="table table-bordered table-hover m-b-0 toExport">
			<thead>
				<tr>
					<td colspan="4" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
						Risk Domains
					</td>
				</tr>
				<tr class="text-center text-blue">
					<td style="font-weight:bold;border:1px solid #444;background:#ffffcc;" valign="middle" class=""></td>
					<td style="font-weight:bold;border:1px solid #444;background:#ffffcc;" valign="middle" class="">Risk Domain</td>
					<td style="font-weight:bold;border:1px solid #444;background:#ffffcc;" valign="middle" class="">Inherent Risk</td>
					<td style="font-weight:bold;border:1px solid #444;background:#ffffcc;" class="">
						Residual Risk
					</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($assessment->ffiec_assessment_risks as $risk): ?>
					<tr class="table-warning">
						<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
							<span class="fa fa-plus-square contReqs" data-target=".riskFactorTable<?= $risk->id ?>"></span>
						</td>
						<td style="background:#800080;color:#fff;border:1px solid #555;width:70% !important;"><?= $risk->name ?></td>
						<td class="<?= $risk->inherent_scale ?>" style="border:1px solid #555;background-color:<?= $rcolors[$risk->inherent_scale] ?>;text-align:center;"><?= $risk->inherent_scale ?></td>
						<td class="<?= $risk->residual_scale ?>" style="border:1px solid #555;background-color:<?= $rcolors[$risk->residual_scale] ?>;text-align:center;"><?= $risk->residual_scale ?></td>
						
					</tr>
					<?php $rLength = count($risk->ffiec_assessment_risk_factors); ?>
					<tr style="display:none;" class="contReqslist table-info riskFactorTable<?= $risk->id ?>">
						<td style="background:#cc99ff;color:#111;border:1px solid #555;" colspan="2">
							<b>
								 <?= $risk->name ?> Statements 
							</b>
						</td>
						<td style="background:#cc99ff;color:#111;border:1px solid #555;"></td>
						<td style="background:#cc99ff;color:#111;border:1px solid #555;"></td>
					</tr>
					<?php $crl=0; foreach($risk->ffiec_assessment_risk_factors as $creq): ?>
						<tr style="display:none;" class="contReqslist table-info riskFactorTable<?= $risk->id ?>">
							
							<td colspan="2" style="color:#111;border:1px solid #555;width:70% !important;"> <?= $creq->name ?> </td>
							<td style="border:1px solid #555;text-align:center;background:<?= $rcolors[$creq->scale] ?>">
								<?= $creq->scale ?>
							</td>
							<td style="color:#111;border:1px solid #555;">
								
							</td>
						</tr>
					<?php $crl++; endforeach; ?>
					<tr style="display:none;" class="contReqslist table-info riskFactorTable<?= $risk->id ?>">
						<td colspan="4" style="background:#fff;border:1px solid;"></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>
  	<?php elseif($assessment->sub_type=='eGRC'): ?>
  		<table class="table table-bordered m-b-0 table-hover gRisks toExport" id="Risks" style="width:50%;">
			<thead>
				<tr>
					<td colspan="3" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
						Risk Profiles
					</td>
				</tr>
				<tr>
					<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Risk Domain</th>
					<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Inhrent Risk</th>
					<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Residual Risk</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach($assessment->egrc_assessment_risks as $risk): ?>
					<tr>
						<td style="background:#800080;color:#fff;border:1px solid #888;"><?= $risk->name ?></td>
						<td class="<?= $risk->inherent_scale ?>" style="background:<?= $rcolors[$risk->inherent_scale] ?>;border:1px solid #888;width:130px;"><?= $risk->inherent_scale ?></td>
						<td class="<?= $risk->residual_scale ?>" style="background:<?= $rcolors[$risk->residual_scale] ?>;border:1px solid #888;width:130px;"><?= $risk->residual_scale ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
  		<table class="table table-bordered m-b-0 table-hover gRisks toExport" id="Risks" style="width:50%;">
			<thead>
				<tr>
					<td colspan="3" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
						Risk Profiles
					</td>
				</tr>
				<tr>
					<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Risk Domain</th>
					<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Inhrent Risk</th>
					<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Residual Risk</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach($assessment->assessment_risks as $risk): ?>
					<tr>
						<td style="background:#800080;color:#fff;border:1px solid #888;"><?= $risk->risk ?></td>
						<td style="background:<?= $rcolors[$risk->inherent_scale] ?>;border:1px solid #888;color:#111111;width:130px;"><?= $risk->inherent_scale ?></td>
						<td style="background:<?= $rcolors[$risk->residual_scale] ?>;border:1px solid #888;color#111111;width:130px;"><?= $risk->residual_scale ?></td>
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
				    			<table class="table table-bordered table-hover m-b-0 toExport" id="<?php echo clean($rBody->regulatory_body->name); ?>_Controls">
			    					<thead>
			    						<tr>
											<td colspan="<?php echo count($rBody->assessment_controls[0]->assessment_maturity_scores)+4; ?>" style="display:none;background:#800080;color:#ffffff;font-weight:bold;text-align:left;border:1px solid;">
												Control Areas -- <?= $rBody->regulatory_body->name ?>
											</td>
										</tr>
			    						<tr class="text-center text-blue">
			    							<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="bg-info text-white"></td>
				    						<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="bg-info text-white">Control Area</td>
				    						<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="bg-info text-white">Compliance Status</td>
				    						<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($rBody->assessment_controls[0]->assessment_maturity_scores)+1; ?>"  class="bg-info text-white">
				    							Control Maturity
				    						</td>
			    						</tr>
			    						<tr>
			    							<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="bg-info text-white">Maturity Rating</td>
				    						<?php foreach($rBody->assessment_controls[0]->assessment_maturity_scores as $mAttr): ?>
				    							<td style="font-weight:bold;border:1px solid #444;" class="bg-info text-white"><?php echo $mAttr->maturity_attribute; ?></td>
				    						<?php endforeach; ?>
			    						</tr>
			    					</thead>
			    					<tbody>
					    				<?php foreach($rBody->assessment_controls as $control): ?>
				    							<tr class="table-warning">
					    							<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
					    								<span class="fa fa-plus-square contReqs" data-target=".contReqTable<?= $control->id ?>"></span>
					    							</td>
						    						<td style="background:#800080;color:#fff;border:1px solid #555;"><?= $control->name ?></td>
						    						<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?= $control->compliance_status ?></td>
						    						<td style="background:#ffffcc;color:#111;border:1px solid #555;" class="text-center"><?= $control->maturity_rating ?></td>
						    						<?php foreach($control->assessment_maturity_scores as $mAttr): ?>
						    							<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?php echo $mAttr->maturity_option; ?></td>
						    						<?php endforeach; ?>
					    						</tr>
					    						<?php $rLength = count($control->assessment_control_requirements); ?>
												<?php $crl=0; foreach($control->assessment_control_requirements as $creq): ?>
						    						<tr style="display:none;" class="contReqslist table-info contReqTable<?= $control->id ?>">
						    							<?php if($crl==0): ?>
						    								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"></td>
						    								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"> <?= $control->name ?> Requirements </td>
						    							<?php endif; ?>
						    							<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($rBody->assessment_controls[0]->assessment_maturity_scores)+2; ?>">
						    								<?= $creq->name ?> <br>
						    								<?php if(strlen($creq->artifact)>0): ?>
						    									<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="<?php echo $creq->artifact; ?>">
						    										Artifact
						    									</button>
						    								<?php else: ?>
						    									No Artifact
						    								<?php endif; ?>
						    								 <br>
						    								<i><u>Refs/Narrative :</u></i> <?= $creq->reference ?>
						    								<br>
															<i><u>Compliance Status :</u></i> <?= $creq->compliance_status ?>			
						    							</td>
						    						</tr>
						    					<?php $crl++; endforeach; ?>
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
	<?php elseif($assessment->sub_type=='FFIEC Regulated'): ?>
		<table class="table table-bordered table-hover m-b-0 toExport">
			<thead>
				<tr>
					<td colspan="<?php echo count($assessment->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
						FFIEC Domains 
					</td>
				</tr>
				<tr class="text-center text-blue">
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class=""></td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Control Area</td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Compliance Status</td>
					<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($assessment->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores)+1; ?>"  class="">
						FFIEC Domains Maturity
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="">Maturity Rating</td>
					<?php foreach($assessment->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores as $mAttr): ?>
						<td style="font-weight:bold;border:1px solid #444;" valign="middle" class=""><?php echo $mAttr->maturity_attribute; ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($assessment->ffiec_assessment_domains as $control): ?>
					<tr class="table-warning">
						<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
							<span class="fa fa-plus-square contReqs" data-target=".contReqTable<?= $control->id ?>"></span>
							
						</td>
						<td style="background:#800080;color:#fff;border:1px solid #555;"><?= $control->name ?></td>
						<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?= $control->compliance_status ?></td>
						<td style="background:#ffffcc;color:#111;border:1px solid #555;" class="text-center"><?= $control->maturity_rating ?></td>
						<?php foreach($control->ffiec_assessment_maturity_scores as $mAttr): ?>
							<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?php echo $mAttr->maturity_option; ?></td>
						<?php endforeach; ?>
					</tr>
					<?php $rLength = count($control->ffiec_assessment_domain_a_factors); ?>
					<?php $crl=0; foreach($control->ffiec_assessment_domain_a_factors as $creq): ?>
						<tr style="display:none;" class="contReqslist table-info contReqTable<?= $control->id ?>">
							<?php if($crl==0): ?>
								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"></td>
								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"> <?= $control->name ?> Assessment Factors </td>
							<?php endif; ?>
							<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($assessment->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores)+2; ?>">
								<h4>
									<span class="fa fa-plus-square contReqs" data-target=".contAReqTable<?= $creq->id ?>"></span>
									<b><?= $creq->name ?></b>
								</h4>
								<div class="contAReqTable<?= $creq->id ?>" style="display:none;">
									<ul>
										<?php foreach($creq->ffiec_assessment_domain_requirements as $fcreq): ?>
												<li>
													<p>
														<?php echo $fcreq->name; ?>
														<br>
														<u>Compliance Status : </u>
														<?php echo $fcreq->compliance_status; ?>
													</p>
												</li>
											<?php endforeach; ?>
									</ul>
									<!--
									<table class='table border'>
										<thead>
											<tr class="table-active">
												<td>Declarative Statement</td>
												<td>Compliance Status</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach($creq->ffiec_assessment_domain_requirements as $fcreq): ?>
												<tr>
													<td style="width:70%;"><?php echo $fcreq->name; ?></td>
													<td><?php echo $fcreq->compliance_status; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									-->
								</div>
							</td>
						</tr>
					<?php $crl++; endforeach; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	
<?php elseif($assessment->sub_type=='eGRC'): ?>
	<table class="table table-bordered table-hover m-b-0 toExport">
			<thead>
				<tr>
					<td colspan="<?php echo count($assessment->egrc_assessment_policies[0]->egrc_assessment_maturity_scores)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
						Control Areas 
					</td>
				</tr>
				<tr class="text-center text-blue">
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class=""></td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Control Area</td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Compliance Status</td>
					<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($assessment->egrc_assessment_policies[0]->egrc_assessment_maturity_scores)+1; ?>"  class="">
						Control Maturity
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="">Maturity Rating</td>
					<?php foreach($assessment->egrc_assessment_policies[0]->egrc_assessment_maturity_scores as $mAttr): ?>
						<td style="font-weight:bold;border:1px solid #444;" valign="middle" class=""><?php echo $mAttr->maturity_attribute; ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($assessment->egrc_assessment_policies as $control): ?>
					<tr class="table-warning">
						<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
							<span class="fa fa-plus-square contReqs" data-target=".contReqTable<?= $control->id ?>"></span>
						</td>
						<td style="background:#800080;color:#fff;border:1px solid #555;"><?= $control->name ?></td>
						<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?= $control->compliance_status ?></td>
						<td style="background:#ffffcc;color:#111;border:1px solid #555;" class="text-center"><?= $control->maturity_rating ?></td>
						<?php foreach($control->egrc_assessment_maturity_scores as $mAttr): ?>
							<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?php echo $mAttr->maturity_option; ?></td>
						<?php endforeach; ?>
					</tr>
					<?php $rLength = count($control->egrc_assessment_policy_statements); ?>
					<?php $crl=0; foreach($control->egrc_assessment_policy_statements as $creq): ?>
						<tr style="display:none;" class="contReqslist table-info contReqTable<?= $control->id ?>">
							<?php if($crl==0): ?>
								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"></td>
								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"> <?= $control->name ?> Requirements </td>
							<?php endif; ?>
							<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($assessment->egrc_assessment_policies[0]->egrc_assessment_maturity_scores)+2; ?>">
								<?= $creq->name ?> <br>
								<?php if(strlen($creq->artifact)>0): ?>
									<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="<?php echo $creq->artifact; ?>">
										Artifact
									</button>
								<?php else: ?>
									No Artifact
								<?php endif; ?>
								 <br>
								<i><u>Refs/Narrative :</u></i> <?= $creq->reference ?> <br>
								<i><u>Compliance Status :</u></i> <?= $creq->compliance_status ?>
							</td>
						</tr>
					<?php $crl++; endforeach; ?>
				<?php endforeach; ?>
			</tbody>
		</table>	
	
  	<?php else: ?>
  		<table class="table table-bordered table-hover m-b-0 toExport">
			<thead>
				<tr>
					<td colspan="<?php echo count($assessment->assessment_controls[0]->assessment_maturity_scores)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
						Control Areas 
					</td>
				</tr>
				<tr class="text-center text-blue">
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class=""></td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Control Area</td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Compliance Status</td>
					<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($assessment->assessment_controls[0]->assessment_maturity_scores)+1; ?>"  class="">
						Control Maturity
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="">Maturity Rating</td>
					<?php foreach($assessment->assessment_controls[0]->assessment_maturity_scores as $mAttr): ?>
						<td style="font-weight:bold;border:1px solid #444;" valign="middle" class=""><?php echo $mAttr->maturity_attribute; ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($assessment->assessment_controls as $control): ?>
					<tr class="table-warning">
						<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
							<span class="fa fa-plus-square contReqs" data-target=".contReqTable<?= $control->id ?>"></span>
						</td>
						<td style="background:#800080;color:#fff;border:1px solid #555;"><?= $control->name ?></td>
						<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?= $control->compliance_status ?></td>
						<td style="background:#ffffcc;color:#111;border:1px solid #555;" class="text-center"><?= $control->maturity_rating ?></td>
						<?php foreach($control->assessment_maturity_scores as $mAttr): ?>
							<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?php echo $mAttr->maturity_option; ?></td>
						<?php endforeach; ?>
					</tr>
					<?php $rLength = count($control->assessment_control_requirements); ?>
					<?php $crl=0; foreach($control->assessment_control_requirements as $creq): ?>
						<tr style="display:none;" class="contReqslist table-info contReqTable<?= $control->id ?>">
							<?php if($crl==0): ?>
								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"></td>
								<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"> <?= $control->name ?> Requirements </td>
							<?php endif; ?>
							<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($assessment->assessment_controls[0]->assessment_maturity_scores)+2; ?>">
								<?= $creq->name ?> <br>
								<?php if(strlen($creq->artifact)>0): ?>
									<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="<?php echo $creq->artifact; ?>">
										Artifact
									</button>
								<?php else: ?>
									No Artifact
								<?php endif; ?>
								 <br>
								<i><u>Refs/Narrative :</u></i> <?= $creq->reference ?> <br>
								<i><u>Compliance Status :</u></i> <?= $creq->compliance_status ?>
							</td>
						</tr>
					<?php $crl++; endforeach; ?>
				<?php endforeach; ?>
			</tbody>
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
					       		  
						    	  <table class="table table-bordered table-hover myTable m-0 toExport" id="<?php echo clean($rBody->regulatory_body->name); ?>_RCMapping">
					
								  	<thead>
								  		<tr>
											<td colspan="<?php echo count($risks)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
												Risk Control Mapping -- <?= $rcmap->name ?>
											</td>
										</tr>
								  		<tr>
								  			<!--<th  class="bg-light-info"></th>-->
								  			<th style="border:1px solid #333;color:#111;" class=""></th>
								  			<!--
								  			<th style="border:1px solid #333;color:#111;" class=""></th>
								  			<th style="border:1px solid #333;color:#111;"></th>
								  			<th style="border:1px solid #333;color:#111;"></th> 
								  			-->
								  			<th style="border:1px solid #333;color:#111;" colspan="<?php echo count($risks); ?>">Risks Areas </th>
								  		</tr>
								  		<tr>
								  			<!--<th class="bg-light-info">No.</th>-->
								  			<th style="border:1px solid #333;color:#111;" class=""> Control Areas </th>
								  			<!--
								  			<th style="border:1px solid #333;color:#111;" class=""> Complaince </th>
								  			<th style="border:1px solid #333;color:#111;" class=""> Maturity</th>
								  			<th style="border:1px solid #333;color:#111;" class=""> Sub Total</th>
								  			-->
								  			<?php foreach($risks as $k=>$risk): ?>
								  				<th style="background:#800080;color:#ffffff;border:1px solid #333;" class=""><?php echo $risk; ?></th>
								  				
								  			<?php endforeach; ?>
								  		</tr>
								  	</thead>
								  	<tbody>
								  		
								  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
									  		<tr>
									  			<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;"><?php echo $risk_id; ?></td>
									  			
									  			<?php $j=0; foreach($rows as $row): ?>
									  				
									  				<td style="<?php echo $row['mapping']==""?'background:#ffffcc;':''; ?>border:1px solid #333;">
									  					<?php echo $row['mapping']; ?>
									  					
									  				</td>
									  			<?php $j++; endforeach; ?>
									  		</tr>
								  		<?php endforeach; ?>
								  		
								  	</tbody>
								  </table>
								</div>
					      </div>
					    </div>
					  </div>
					<?php $a++; endforeach; ?>
				</div>
	  	<?php elseif($assessment->sub_type=='FFIEC Regulated'): ?>
	  		<div class="table-responsiv">
  				
	    	  <table class="table table-bordered table-hover myTable m-0 gMappings toExport" id="RCMapping">

			  	<thead>
			  		<tr>
						<td colspan="<?php echo count($risks)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
							Risk Control Mapping 
						</td>
					</tr>
			  		<tr>
			  			
			  			<th style="border:1px solid #333;color:#111;" class=""></th>
			  			<th style="border:1px solid #333;color:#111;" colspan="<?php echo count($risks); ?>">Risks Areas </th>
			  		</tr>
			  		<tr>
			  			<th style="border:1px solid #333;color:#111;width:20% !important;" class=""> FFIEC Domains </th>
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th style="background:#800080;color:#ffffff;border:1px solid #333;width:15% !important;" class=""><?php echo $risk; ?></th>
			  				
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;width:20% !important;"><?php echo $risk_id; ?></td>
				  			<?php $j=0; foreach($rows as $row): ?>
				  			
				  				<td style="<?php echo $row['mapping']==""?'background:#ffffcc;':''; ?>border:1px solid #333;width:15% !important;">
				  					<?php echo $row['mapping']; ?>
				  				</td>
				  			<?php $j++; endforeach; ?>
				  		</tr>
			  		<?php endforeach; ?>
			  		
			  	</tbody>
			  </table>
			</div>	
		<?php elseif($assessment->sub_type=='eGRC'): ?>
		<?php 
  				$residuals=[];
  				foreach($risk_ids as $rid){
					$residuals[$rid]['total']=0;
					$residuals[$rid]['count']=0;
				}
  			?>
  			<div class="table-responsive">
  				
	    	  <table class="table table-bordered table-hover myTable m-0 gMappings toExport" id="RCMapping">

			  	<thead>
			  		<tr>
						<td colspan="<?php echo count($risks)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
							Risk Control Mapping 
						</td>
					</tr>
			  		<tr>
			  			<!--<th  class="bg-light-info"></th>-->
			  			<th style="border:1px solid #333;color:#111;" class=""></th>
			  			<!--
			  			<th style="border:1px solid #333;color:#111;" class=""></th>
			  			<th style="border:1px solid #333;color:#111;"></th>
			  			<th style="border:1px solid #333;color:#111;"></th>
			  			-->
			  			<th style="border:1px solid #333;color:#111;" colspan="<?php echo count($risks); ?>">Risks Areas </th>
			  		</tr>
			  		<tr>
			  			<!--<th class="bg-light-info">No.</th>-->
			  			<th style="border:1px solid #333;color:#111;" class=""> Control Areas </th>
			  			<!--
			  			<th style="border:1px solid #333;color:#111;" class=""> Complaince </th>
			  			<th style="border:1px solid #333;color:#111;" class=""> Maturity</th>
			  			<th style="border:1px solid #333;color:#111;" class=""> Sub Total</th>
			  			-->
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th style="background:#800080;color:#ffffff;border:1px solid #333;" class=""><?php echo $risk; ?></th>
			  				
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<!--<td><?php echo $i++; ?></td>-->
				  			<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
				  				<?php echo str_replace('Standard','',str_replace("Policy","",$risk_id)); ?>
				  			</td>
				  			
				  			<?php $j=0; foreach($rows as $row): ?>
				  				<!--
				  				<?php if($j==0): ?>
					  				<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
					  					<?php echo $row['assessment_control']['compliance_score']; ?>
					  				</td>
					  				<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
					  					<?php echo $row['assessment_control']['maturity_rating']; ?>
					  				</td>
					  				<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
					  					<?php echo $row['assessment_control']['sub_total']; ?>
					  				</td>
				  				<?php endif; ?>
				  				-->
				  				<td style="<?php echo $row['mapping']==""?'background:#ffffcc;':''; ?>border:1px solid #333;">
				  					<?php echo $row['mapping']; ?>
				  					<?php 
				  						if($row['mapping']=="P"){
				  							$residuals[$row['egrc_assessment_risk']['id']]['total']+=$row['egrc_assessment_policy']['egrc_maturity_rating'];
											$residuals[$row['egrc_assessment_risk']['id']]['count']++;
				  						}
				  					?>	
				  				</td>
				  			<?php $j++; endforeach; ?>
				  		</tr>
			  		<?php endforeach; ?>
			  		<!--
			  		<tr class="">
			  			<td style="border:1px solid #333;" class="">
		  					
		  				</td>
		  				
		  				<?php foreach($residuals as $residual): ?>
		  					<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;"><?php echo ($residual['total']==0 && $residual['count']==0)?"":round($residual['total']/$residual['count'],0); ?></td>
		  				<?php endforeach; ?>
			  		</tr>
			  		-->
			  	</tbody>
			  </table>
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
  				
	    	  <table class="table table-bordered table-hover myTable m-0 gMappings toExport" id="RCMapping">

			  	<thead>
			  		<tr>
						<td colspan="<?php echo count($risks)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
							Risk Control Mapping 
						</td>
					</tr>
			  		<tr>
			  			<!--<th  class="bg-light-info"></th>-->
			  			<th style="border:1px solid #333;color:#111;" class=""></th>
			  			<!--
			  			<th style="border:1px solid #333;color:#111;" class=""></th>
			  			<th style="border:1px solid #333;color:#111;"></th>
			  			<th style="border:1px solid #333;color:#111;"></th>
			  			-->
			  			<th style="border:1px solid #333;color:#111;" colspan="<?php echo count($risks); ?>">Risks Areas </th>
			  		</tr>
			  		<tr>
			  			<!--<th class="bg-light-info">No.</th>-->
			  			<th style="border:1px solid #333;color:#111;" class=""> Control Areas </th>
			  			<!--
			  			<th style="border:1px solid #333;color:#111;" class=""> Complaince </th>
			  			<th style="border:1px solid #333;color:#111;" class=""> Maturity</th>
			  			<th style="border:1px solid #333;color:#111;" class=""> Sub Total</th>
			  			-->
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th style="background:#800080;color:#ffffff;border:1px solid #333;" class=""><?php echo $risk; ?></th>
			  				
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<!--<td><?php echo $i++; ?></td>-->
				  			<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;"><?php echo $risk_id; ?></td>
				  			
				  			<?php $j=0; foreach($rows as $row): ?>
				  				<!--
				  				<?php if($j==0): ?>
					  				<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
					  					<?php echo $row['assessment_control']['compliance_score']; ?>
					  				</td>
					  				<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
					  					<?php echo $row['assessment_control']['maturity_rating']; ?>
					  				</td>
					  				<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;">
					  					<?php echo $row['assessment_control']['sub_total']; ?>
					  				</td>
				  				<?php endif; ?>
				  				-->
				  				<td style="<?php echo $row['mapping']==""?'background:#ffffcc;':''; ?>border:1px solid #333;">
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
			  		<!--
			  		<tr class="">
			  			<td style="border:1px solid #333;" class="">
		  					
		  				</td>
		  				
		  				<?php foreach($residuals as $residual): ?>
		  					<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;"><?php echo ($residual['total']==0 && $residual['count']==0)?"":round($residual['total']/$residual['count'],0); ?></td>
		  				<?php endforeach; ?>
			  		</tr>
			  		-->
			  	</tbody>
			  </table>
			</div>
  		<?php endif; ?>
  </div>
  <div class="tab-pane fade" id="scales" role="tabpanel" aria-labelledby="scales-tab">
  	  <h3>Risk Severity</h3>
  	  <table class="table table-bordered table-hover toExport" id="RiskSeverityScale" style="font-size:15px;margin-bottom:0px;">
    	<thead>
    		<tr>
				<td colspan="6" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
					Risk Severity Scales
				</td>
			</tr>
    		<tr>
    			<th style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold;">Risk Severity Scale</th>
    			<th style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold">Financial Loss</th>
    			<th style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold;">Customer</th>
    			<th style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold;">Regulatory</th>
    			<th style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold;">Business Disruption</th>
    			<th style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold;">Headline Risk</th>
    			<!--<th>Score</th>-->
    		</tr>
    	</thead>
    	<tbody>
    		<?php foreach($riskScales as $cScale): ?>
    			<tr>
    				<td style="background:<?php echo $rcolors[$cScale->severity_scale]; ?>;color:#000;border:1px solid #000;" class="<?php echo $cScale->severity_scale; ?>"><?php echo $cScale->severity_scale; ?></td>
    				<td style="background:#ccc;color:#000;border:1px solid #000;"><?php echo $cScale->financial_loss; ?></td>
    				<td style="background:#ccc;color:#000;border:1px solid #000;"><?php echo $cScale->customer; ?></td>
    				<td style="background:#ccc;color:#000;border:1px solid #000;"><?php echo $cScale->regulatory; ?></td>
    				<td style="background:#ccc;color:#000;border:1px solid #000;"><?php echo $cScale->business_disruption; ?></td>
    				<td style="background:#ccc;color:#000;border:1px solid #000;"><?php echo $cScale->headline_risk; ?></td>
    				<!--<td><?php echo $cScale->score; ?></td>-->
    			</tr>
    		<?php endforeach; ?>
    	</tbody>
    </table>
    <hr>
    <br>
    <h3>Control Effectiveness</h3>
      
    <table class="table table-bordered table-hover toExport" id="ControlEffectiveness">
    	<thead>
    		<tr>
				<td colspan="4" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
					Control Effectiveness
				</td>
			</tr>
    		<tr class="">
    			<th style="background:#ccc;color:#000;border:1px solid #000;">Name</th>
    			<th style="background:#ccc;color:#000;border:1px solid #000;" colspan="3">Description</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php foreach($compStatuses as $compStatus): ?>
    			<tr class="">
    				<td style="background:#ccc;color:#000;border:1px solid #000;font-weight:bold;"><?php echo $compStatus->name; ?></td>
    				<td style="background:#ccc;color:#000;border:1px solid #000;" colspan="3"><?php echo $compStatus->description; ?></td>
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
<?php 
	function clean($string) {
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
	   return str_replace(' ', '_', $string); 
	}
?>
<script>
	
			//export html table to excel
			$(document).on('click','.exportbtn',function(e){
				//target = $(this).attr('data-target');
				$('.toExport').table2excel({
					filename: "Assessment",
					preserveColors:true
				});
				//console.log(abc);
			});
		
</script>

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
		
		<?php if(!empty($excel) && $excel=='export'): ?>
			$('.exportbtn').trigger('click');
			setTimeout(function(){
				window.close();
			},2000);
		<?php endif; ?>
		
	});
</script>