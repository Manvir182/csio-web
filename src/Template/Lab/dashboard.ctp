
<section class='text-center'>
	<h2>
		<b>
			<?php echo $thisUser['company_name']; ?>
		</b>
	</h2>
	<h2 style="text-transform: uppercase;">
		Executive Dashboard
	</h2>
</section>
<hr class="bg-info">
	<div class="container p-t-0">
		<h2 align="center" class="">
			<b>
				Regulatory Exposure
			</b>
		</h2>
		<p align="center" class="text-danger">
			<!--
			Based on "<?php echo $thisUser['company_name']; ?>" activities, "<?php echo $thisUser['company_name']; ?>"
			may be required to comply with the following regulations and industry standards.
			-->
			The regulatory status of <?php echo $thisUser['company_name']; ?> core business activities
		</p>
		<div class="table-responsive">

					<?php if(empty($reguComplianceData)): ?>
						<div class="alert alert-warning text-center" style="border-radius:100px;">
							<i class="fa fa-window-restore"></i>
							<?php
					        	echo $this->Html->link('Run the wizard',array(
									'controller'=>'lab','action'=>'regulationComplianceWizard'
								),array('class'=>'alert-link','escape'=>false));
					         ?>
						</div>
					<?php else: ?>
						<table class="table table-bordered">
							<thead>
								<tr class="table-info">
									<th>Activity</th>
									<th>Regulation</th>
									<th>Compliance Status</th>
									<th>Risk Exposure</th>

								</tr>

							</thead>
							<tbody>
								<?php foreach($reguComplianceData as $reguCompliance): ?>
									<tr>
										<th><?php echo $reguCompliance['activity']; ?></th>
										<td>
											<?php echo $reguCompliance['rbody']; ?>
											<span class="float-right">
												<?php
													if($reguCompliance['rbody']=="Federal Financial Institutions Examination Council (FFIEC)"){
														echo $this->Html->link('<i class="fa fa-calculator"></i>',[
															'controller'=>'assessments','action'=>'assessmentRequest','ffiec'
														],[
															'escape'=>false,
															'class'=>'btn btn-secondary btn-sm',
															'data-toggle'=>'tooltip','title'=>'Assess Now',
															'data-placement'=>'top'
														]);

													} elseif($reguCompliance['rbody']=="Cybersecurity Maturity Model Certification (CMMC)"){
														echo $this->Html->link('<i class="fa fa-calculator"></i>',[
															'controller'=>'assessments','action'=>'assessmentRequestCmmc'
														],[
															'escape'=>false,
															'class'=>'btn btn-secondary btn-sm',
															'data-toggle'=>'tooltip','title'=>'Assess Now',
															'data-placement'=>'top'
														]);
													} else {
														echo $this->Html->link('<i class="fa fa-calculator"></i>',[
															'controller'=>'assessments','action'=>'assessmentRequest',$reguCompliance['rbodyId']
														],[
															'escape'=>false,
															'class'=>'btn btn-secondary btn-sm',
															'data-toggle'=>'tooltip','title'=>'Assess Now',
															'data-placement'=>'top'
														]);
													}
												?>
											</span>
										</td>
										<td><?php echo $reguCompliance['compStatus']; ?></td>
										<td><?php echo $reguCompliance['riskExposure']; ?></td>

									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>



		</div>
	</div>
<hr class="bg-info">
<center style="font-size:25px;line-height:40px;font-family:arial;">
	<i class="fa fa-info-circle mr-2 font-18 mt-2" data-toggle="tooltip" title="The current quarterly maturity rating, compliance status and risk level is an average of the assessments performed in the previous quarter."></i>
	<span class="btn btn-sm btn-info badge-pill">
		Quarterly Maturity Rating
		<span class="badge badge-primary badge-pill" style="font-size:inherit;">
			<?php echo $dashStats['avgMRating']; ?>
		</span>
	</span>
	<span class="btn btn-sm btn-info badge-pill">
		Quarterly Compliance Status
		<span class="badge badge-primary badge-pill" style="font-size:inherit;">
			<?php echo $dashStats['avgCompScore']; ?>
		</span>
	</span>
	<span class="btn btn-sm btn-info badge-pill">
		Quarterly Risk Level
		<span class="badge badge-primary badge-pill" style="font-size:inherit;">
			<?php echo $dashStats['avgRiskScore']; ?>
		</span>
	</span>

</center>
<br>
    <div class="main-sections">
      <!-- map section -->
      <section class="maap-section">
        <div class="container map-box" style="padding-bottom:10px;">
		<!--<h4 class="title text-center map-title">(Industry) Cybersecurity Attacks</h4>-->
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="MaturityPerformance-tab" data-toggle="tab" href="#MaturityPerformance" role="tab" aria-controls="home" aria-selected="true">
						Maturity Performance over time
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="RiskPerformance-tab" data-toggle="tab" href="#RiskPerformance" role="tab" aria-controls="RiskPerformance" aria-selected="false">
						Risk Performance over time
					</a>
				</li>

			</ul>
			<div class="tab-content" id="myTabContent" style="border-width:1px;border-style:solid;border-color:#fff #dee2e6 #dee2e6;">
				<div class="tab-pane fade show active" id="MaturityPerformance" role="tabpanel" aria-labelledby="MaturityPerformance-tab">
					<div class="map">
			            <canvas id="canvas22" height="90"></canvas>
			        </div>
				</div>
				<div class="tab-pane fade" id="RiskPerformance" role="tabpanel" aria-labelledby="RiskPerformance-tab">
					<div class="map">
			            <canvas id="canvas21" height="90"></canvas>
			        </div>
				</div>

			</div>



        </div>
      </section>
        <!-- map section closed -->

    </div>
      <div class="container " style="display:none;padding-top:10px;padding-bottom:5px;">
           <div class="row">
           		<div class="col-md-2"></div>
                <div class="col-md-4">
                    <ul class="left-side-sect">
                    	<li class="cisotooltip">
                    		<?php
                            	echo $this->Html->link('<div class="cisobtn cisored cisoblue-border cisored-outline">Assessment Tool</div>',array(
									'controller'=>'Assessments','action'=>'assessmentRequest'
								),array(
									'escape'=>false
								));
                            ?>
                        </li>


                    </ul>
                  </div>
                   <div class="col-md-4">
                    <ul class="left-side-sect">


                          <li>
                          	<ul class="subleft cisowhite cisoblue-border cisoblue-outline">

                          <li>
                          	<?php
                            	echo $this->Html->link('<div class="cisobtn cisoblue">Tracking</div>',array(
									'controller'=>'assessments','action'=>'tracking'
								),array(
									'escape'=>false
								));
                            ?>
                          </li>

                             </ul>
                         </li>
                    </ul>
                  </div>

           </div>
      </div>
  <?php if($dashData): ?>
  <div class="row">
  	<div class="col-10 offset-1">
  		<hr class="bg-info">
		<?php if($dashData['assessment']->sub_type=='Regulated'): ?>
			<br><br>
			<section class='text-center'>
				<h2>
					<b>
						<?php echo $thisUser['company_name']; ?>
					</b>
				</h2>
				<h2 style="text-transform: uppercase;">
					Current Risk &amp; Control Profile
				</h2>
			</section>
			<div class="accordion" id="rbAccordion">

				<?php $i=0; foreach($dashData['assessment']->assessments_regulatory_bodies as $rBody): ?>


				  <div class="card" style="border:1px solid #233149;margin-top:8px;">
				    <div class="card-heade" id="headingr<?= $rBody->id ?>">
				      <h4 class="mb-0 p-10 text-white <?php echo $i==0?'collapsed':''; ?>" style="cursor:pointer;background:#233149;" data-toggle="collapse" data-target="#rcollapse<?= $rBody->id ?>" aria-expanded="false" aria-controls="rcollapse<?= $rBody->id ?>">
				      	<span class="fa fa-chevron-circle-down m-r-5"></span>
					    <?= $rBody->regulatory_body->name ?>
				      </h4>
				    </div>

				    <div id="rcollapse<?= $rBody->id ?>" class="collapse <?php echo $i==0?'show':''; ?>" aria-labelledby="headingr<?= $rBody->id ?>" data-parent="#rbAccordion">
				      <div class="card-block">
				      	<div class="row">
					    	<div class="col-12">
					    		<div class="card">
					    			<h3 align="center">Current Risk Profile</h3>
					    			<table class="table table-bordered m-b-0 table-hover toExport" style="width:auto;margin:auto;" id="<?php echo $rBody->regulatory_body->name; ?>_Risks" style="width:50%;">
					    				<thead>
					    					<tr>
												<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Risk Domain</th>
												<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Inhrent Risk</th>
												<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Residual Risk</th>

											</tr>
					    				</thead>
					    				<tbody>
					    					<?php $sr=1; foreach($rBody->assessment_risks as $risk): ?>

					    						<tr>
					    							<td style="background:#800080;color:#fff;border:1px solid #888;"><?= $risk->risk ?></td>
					    							<td class="<?= $risk->inherent_scale ?>" style="border:1px solid #888;width:130px;"><?= $risk->inherent_scale ?></td>
					    							<td class="<?= $risk->residual_scale ?>" style="border:1px solid #888;width:130px;"><?= $risk->residual_scale ?></td>
						    					</tr>
					    					<?php endforeach; ?>
					    				</tbody>
					    			</table>
					    		</div>
					    	</div>

					    </div>

					    <hr class="bg-info">
					    <h3 align="center">Current Control Profile</h3>
					    <div class="row">
					    	<div class="col-12">
					    		<div class="card bg-white" style="border:1px solid #ccc;" id="assessmentControls">

					    			<div class="table-responsive">
						    			<table class="table table-bordered table-hover m-b-0 toExport" id="<?php echo $rBody->regulatory_body->name; ?>_Controls">
					    					<thead>

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
							    							<td style="background:#800080;color:#fff;border:1px solid #555; " class="text-center">
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
				  </div>
				<?php $i++; endforeach; ?>
			</div> <!--regu body accordion ends-->
		<?php elseif($dashData['assessment']->sub_type=='FFIEC Regulated'): ?>

			<br>
			<br>
			<section class='text-center'>
				<h2>
					<b>
						<?php echo $thisUser['company_name']; ?>
					</b>
				</h2>
				<h2 style="text-transform: uppercase;">
					Current Risk Profile
				</h2>
			</section>
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
				<?php foreach($dashData['assessment']->ffiec_assessment_risks as $risk): ?>

					<tr class="">
						<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
							<span class="fa fa-plus-square contReqs" data-target=".riskFactorTable<?= $risk->id ?>"></span>
						</td>
						<td style="background:#800080;color:#fff;border:1px solid #555;width:70% !important;"><?= $risk->name ?></td>
						<td class="<?= $risk->inherent_scale ?>" style="border:1px solid #555;text-align:center;"><?= $risk->inherent_scale ?></td>
						<td class="<?= $risk->residual_scale ?>" style="border:1px solid #555;text-align:center;"><?= $risk->residual_scale ?></td>

					</tr>
					<?php $rLength = count($risk->ffiec_assessment_risk_factors); ?>
					<tr style="display:none;" class="contReqslist table-secondary riskFactorTable<?= $risk->id ?>">
						<td style="color:#111;border:1px solid #555;" colspan="4">
							<b>
								 <?= $risk->name ?> Statements
							</b>
						</td>

					</tr>
					<?php $crl=0; foreach($risk->ffiec_assessment_risk_factors as $creq): ?>
						<tr style="display:none;" class="contReqslist riskFactorTable<?= $risk->id ?>">

							<td colspan="2" style="color:#111;border:1px solid #555;width:70% !important;"> <?= $creq->name ?> </td>
							<td class="<?= $creq->scale ?>" style="border:1px solid #555;text-align:center;">
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

			<hr class="bg-info">
			<section class='text-center'>
				<h2>
					<b>
						<?php echo $thisUser['company_name']; ?>
					</b>
				</h2>
				<h2 style="text-transform: uppercase;">
					Current Control Profile
				</h2>
			</section>

			<table class="table table-bordered table-hover m-b-0 toExport">
			<thead>

				<tr class="text-center text-blue">
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class=""></td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Control Area</td>
					<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Compliance Status</td>
					<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($dashData['assessment']->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores)+1; ?>"  class="">
						FFIEC Domains Maturity
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="">Maturity Rating</td>
					<?php foreach($dashData['assessment']->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores as $mAttr): ?>
						<td style="font-weight:bold;border:1px solid #444;" valign="middle" class=""><?php echo $mAttr->maturity_attribute; ?></td>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach($dashData['assessment']->ffiec_assessment_domains as $control): ?>
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
							<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($dashData['assessment']->ffiec_assessment_domains[0]->ffiec_assessment_maturity_scores)+2; ?>">
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

								</div>
							</td>
						</tr>
					<?php $crl++; endforeach; ?>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php else: ?>
			<br>
			<br>
			<section class='text-center'>
				<h2>
					<b>
						<?php echo $thisUser['company_name']; ?>
					</b>
				</h2>
				<h2 style="text-transform: uppercase;">
					Current Risk Profile
				</h2>
			</section>
			<table class="table table-bordered m-b-0 table-hover gRisks toExport" id="Risks" style="width:50%;margin:auto;">
					<thead>

						<tr>
							<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Risk Domain</th>
							<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Inhrent Risk</th>
							<th style="background:#ffffcc;color:#111;border:1px solid #888;font-weight:bold;">Residual Risk</th>

						</tr>
					</thead>
					<tbody>
						<?php foreach($dashData['assessment']->assessment_risks as $risk): ?>
							<tr>
								<td style="background:#800080;color:#fff;border:1px solid #888;"><?= $risk->risk ?></td>
								<td class="<?= $risk->inherent_scale ?>" style="border:1px solid #888;width:130px;"><?= $risk->inherent_scale ?></td>
								<td class="<?= $risk->residual_scale ?>" style="border:1px solid #888;width:130px;"><?= $risk->residual_scale ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

				<hr class="bg-info">

				<section class='text-center'>
					<h2>
						<b>
							<?php echo $thisUser['company_name']; ?>
						</b>
					</h2>
					<h2 style="text-transform: uppercase;">
						Current Control Profile
					</h2>
				</section>

				<div class="table-responsive">
				<table class="table table-bordered table-hover m-b-0 toExport bg-white">
					<thead>

						<tr class="text-center text-blue">
							<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class=""></td>
							<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Control Area</td>
							<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Compliance Status</td>
							<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($dashData['assessment']->assessment_controls[0]->assessment_maturity_scores)+1; ?>"  class="">
								Control Maturity
							</td>
						</tr>
						<tr>
							<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="">Maturity Rating</td>
							<?php foreach($dashData['assessment']->assessment_controls[0]->assessment_maturity_scores as $mAttr): ?>
								<td style="font-weight:bold;border:1px solid #444;" valign="middle" class=""><?php echo $mAttr->maturity_attribute; ?></td>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach($dashData['assessment']->assessment_controls as $control): ?>
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
									<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($dashData['assessment']->assessment_controls[0]->assessment_maturity_scores)+2; ?>">
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
				</div>
		<?php endif; ?>

  	</div>
  </div>
  <?php else: ?>
  	<div>
  		<hr class="bg-info">

		<section class='text-center'>
			<h2>
				<b>
					<?php echo $thisUser['company_name']; ?>
				</b>
			</h2>
			<h2 style="text-transform: uppercase;">
				Current Risk Profile
			</h2>
			<div class="row">
				<div class="col-4 offset-4">
					<div class="alert alert-info">
						No Data Available
					</div>
				</div>
			</div>
		</section>

  		<hr class="bg-info">

		<section class='text-center'>
			<h2>
				<b>
					<?php echo $thisUser['company_name']; ?>
				</b>
			</h2>
			<h2 style="text-transform: uppercase;">
				Current Control Profile
			</h2>
			<div class="row">
				<div class="col-4 offset-4">
					<div class="alert alert-info">
						No Data Available
					</div>
				</div>
			</div>
		</section>
  	</div>

  <?php endif; //if no assessment found for current logged inemployee ?>
   <br>
   <br>
   <br>
   <script>
	$(function(){
		$('.contReqslist').hide();
		$(document).on('click','.contReqs',function(){
			target = $(this).attr('data-target');
			$(target).toggle('show');
			$(this).toggleClass('fa-minus-square');
			$(this).toggleClass('fa-plus-square');
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
  <script>
	$(function(){
		var lineChartData2 = {
		    labels: [<?php echo $labels; ?>],
		    datasets: [ {
		    	borderColor:"#333333",
		    	//pointRadius: '5',
		    	pointBackgroundColor:'#cccccc',//'#009efb',
		    	label : "Risk Performance",
		        fillColor: "rgba(151,187,205,0)",
		        strokeColor: "#333333",
		        pointColor: "#111111",
		        data: [<?php echo $yAxis2; ?>]
		    }],


		}
		var lineChartData = {
		    labels: [<?php echo $labels; ?>],
		    datasets: [{
		    	//backgroundColor: "rgba(0,0,0,0)",
		    	borderColor:"#2f3d4a",
		    	//pointStyle: 'rectRounded',
		    	pointBackgroundColor:'#2f3d4a',//'#009efb',
		    	label : "Control Maturity",
		        fillColor: "rgba(238,150,63,0)",
		        strokeColor: "rgba(238,150,63,1)",
		        pointColor: "rgba(238,150,63,1)",
		        data: [<?php echo $yAxis; ?>],
		        tension:0
		    }],


		}

		/*
		Chart.defaults.global.animationSteps = 100;
				//Chart.defaults.global.showTooltips = false;
				Chart.defaults.global.tooltipYPadding = 16;
				Chart.defaults.global.tooltipCornerRadius = 10;
				Chart.defaults.global.tooltipTitleFontStyle = "normal";
				Chart.defaults.global.tooltipFillColor = "rgba(0,160,0,0.8)";
				Chart.defaults.global.animationEasing = "easeOutBounce";
				Chart.defaults.global.responsive = true;
				Chart.defaults.global.scaleLineColor = "black";
				Chart.defaults.global.scaleFontSize = 12;*/


		var mRatings = <?php echo $mRatings; ?>;
		mRatings = Object.entries(mRatings);


		var ctx = document.getElementById("canvas22");
		var ctx2 = document.getElementById("canvas21");
		ctx.height = 83;

		if(ctx){
			ctx = ctx.getContext("2d");
			/*
			var LineChartDemo = new Chart(ctx).Line(lineChartData, {
							pointDotRadius: 5,
							bezierCurve: false,
							scaleShowVerticalLines: true,
							scaleGridLineColor: "#eeeeee"
						});
						*/

			var chart = new Chart(ctx, {
			    // The type of chart we want to create
			    type: 'line',

			    // The data for our dataset
			    data: lineChartData,

			    // Configuration options go here
			    options: {
			    	scales: {
				      yAxes: [{
				        ticks: {
				          beginAtZero: true,
				          stepSize: 0.5
				        }
				      }]},
			    	tooltips: {
			    		backgroundColor: "#009efb",
			            callbacks: {
			                label: function(tooltipItem, data) {

			                	label="";

			                	for(i=mRatings.length-1;i>=0;i--){
			                		mrat = mRatings[i][0];
			                		mlabl = mRatings[i][1];
			                		if(tooltipItem.yLabel>=mrat){
									  	return label = mlabl;

									  } else if(tooltipItem.yLabel<0){
									  	return label = "Ad hoc";

									  } else if(tooltipItem.yLabel<1 && tooltipItem.yLabel>=0){
									  	return label = "Ad hoc";

									  }
			                	}

			                 	return label;
			            }
			        }
			    	},
			    	legend:false,
			    }
			});

		}
		var second=false;
		/*
		var ctx2 = document.getElementById("canvas22");
		if(ctx2){
			ctx2 = ctx2.getContext("2d");
			var LineChartDemo = new Chart(ctx2).Line(lineChartData2, {
			    pointDotRadius: 5,
			    bezierCurve: false,
			    scaleShowVerticalLines: true,
			    scaleGridLineColor: "#eeeeee"

			});
		}
		*/

		var rScales = <?php echo $rScales; ?>;
		rScales = Object.entries(rScales);
		//console.log(rScales);

		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  //e.target // newly activated tab
		  //e.relatedTarget // previous active tab

		 if(second==false && ctx2){
		 	ctx2.height = 350;
			ctx2 = ctx2.getContext("2d");
			/*
			var LineChartDemo2 = new Chart(ctx2).Line(lineChartData2, {
							pointDotRadius: 5,
							bezierCurve: false,
							scaleShowVerticalLines: true,
							scaleGridLineColor: "#eeeeee"
													  });*/

			var chart2 = new Chart(ctx2, {
			    // The type of chart we want to create
			    type: 'line',

			    // The data for our dataset
			    data: lineChartData2,

			    // Configuration options go here
			    options: {
			    	 scales: {
				      yAxes: [{
				        ticks: {
				          beginAtZero: true,
				          stepSize: 0.5
				        }
				      }]},
			        tooltips: {

			            callbacks: {
			                label: function(tooltipItem, data) {
			                    label="";

			                	for(i=rScales.length-1;i>=0;i--){
			                		mrat = rScales[i][0];
			                		mlabl = rScales[i][1];
			                		if(tooltipItem.yLabel>=mrat){
									  	return label = mlabl;

									  } else if(tooltipItem.yLabel<0){
									  	return label = "Minor";

									  } else if(tooltipItem.yLabel<1 && tooltipItem.yLabel>=0){
									  	return label = "Minor";

									  }
			                	}

			                 	return label;
			                }
			            }
			        },
			        legend:false,
			    }
			});
			second=true;
		}


		});


	});





</script>
