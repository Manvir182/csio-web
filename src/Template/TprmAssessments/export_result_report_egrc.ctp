<?php error_reporting(E_NOTICE | E_WARNING | E_PARSE); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> Assessment Report : THE CLOUD CISO </title>
		<?= $this->Html->meta('icon') ?>
		<?php if($assessment->status=='Review or Draft'): ?>
			<style>
				/*h2:after,
				h3:after,*/
				h4:after {
					content:'DRAFT',
					position:absolute;top:4in;left:1cm;font-size:1in;font-weight:bold;color:rgba(2,2,2,0.3);transform:rotate(-45deg);
				}
			</style>

		<?php endif; ?>
		<style>
			li {
				padding:6px;
			}
		</style>
	</head>
	<body style="font-family:Arial, Helvetica, sans-serif;">
		<div id="report" class="report" style="">
			<div class="reportHeader" style="text-align:center;background:#000080;color:#fff;padding:4px;border:5px solid #111;box-shadow:4px 4px 4px #999;">
				<h2 style="color:#fff;text-align:center;">
					THE CLOUD CISO Risk Assessment
					<br>
					for
					<br>
					<?php echo $company->company_name; ?>
				</h2>
			</div>
			<h4 align="center" style="padding:1in;">
				Approvals
			</h4>
			<p>
				<b>
					<span style="color:#000080;">DRAFT</span>
					Submitted by:
				</b>
				<br>
				<span style="color:#999;">
					&nbsp;&nbsp;&nbsp;&nbsp;&mdash; <?php echo $assessment->user->first_name." ".$assessment->user->last_name; ?>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&mdash; <?php echo $assessment->user->position_title; ?> @ <?php echo $company->company_name; ?>
				</span>
			</p>
			<p align="right">
				<b>Date: <?php echo date('m/d/Y',strtotime($assessment->created)); ?></b>
			</p>
			<p>
				<b>
					Approved &amp; Accepted By:
				</b>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&mdash;
				<span style="color:#999;">
					<?php echo $assessment->assessment_statuses[0]->user->first_name; ?>
					<?php echo $assessment->assessment_statuses[0]->user->last_name; ?>
				</span>
			</p>
			<p align="center">
				<b>Revision History</b>
			</p>
			<table cellspacing="0" border=1 width="100%" style="">
				<thead>
					<tr>
						<th style="background-color:#000080;color:#fff;font-weight:bold;">Version</th>
						<th style="background-color:#000080;color:#fff;font-weight:bold;">Date</th>
						<th style="background-color:#000080;color:#fff;font-weight:bold;">Description</th>
						<th style="background-color:#000080;color:#fff;font-weight:bold;">Author</th>
					</tr>
				</thead>
				<tbody>
					<?php $sr=1; foreach($assessmentStatuses as $aStatus): ?>
						<tr>
							<td align="center">
								<?php if($aStatus->status!="Completed"): ?>
								.<?php echo $sr++; ?>
								<?php else: ?>
									2
								<?php endif; ?>
							</td>
							<td align="center"><?php echo date("m/d/y",strtotime($aStatus->created)); ?></td>
							<td align="center"><?php echo $aStatus->status; ?></td>
							<td><?php echo $aStatus->user->first_name." ".$aStatus->user->last_name; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<h2 style="page-break-before: always;" align="center">Table of Contents</h2>
			<ul style="list-style:none;">
				<li>
					<b>1. Executive Summary</b>
					<ul style="list-style:none;">
						<li>
							1.1 Conclusions
						</li>
						<li>
							1.2 Table of Findings
						</li>
					</ul>
				</li>
				<li>
					<b>2. Methodology and Objective</b>
					<ul style="list-style:none;">
						<li>
							2.1 Methodology
						</li>
						<li>
							2.2 Objective
						</li>
					</ul>
				</li>
				<li>
					<b>3. Operational Risks</b>
					<ul style="list-style:none;">
						<?php $sr=0; foreach($assessment->egrc_assessment_risks as $maRisk): ?>
							<li>3.<?php echo $sr+=1; ?> <?php echo $maRisk->name; ?></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li>
					<b>
						4. Maturity Assessment
					</b>
					<ul style="list-style:none;">
						<?php $sr=1; foreach($assessment->egrc_assessment_policies as $maControl): ?>
							<li>4.<?php echo $sr+=1; ?> <?php echo $maControl->name; ?></li>
						<?php endforeach; ?>
					</ul>
				</li>
				<li>
					<b>5. Appendices</b>
					<ul style="list-style:none;">
						<li>5.1 Mapping of Risk Families to Control Domains</li>
					</ul>
				</li>
			</ul>

			<h2 style="page-break-before: always;">1. Executive Summary</h2>
			<h3>1.1 <u>Conclusions</u></h3>
			<p>
				This Analysis evaluated the risks and investigated over
				<?php
					$noOfReqs = 0;
					foreach($assessment->egrc_assessment_policies as $ac){
						$noOfReqs+=count($ac->egrc_assessment_policy_statements);
					}
					echo $noOfReqs;
				?>

				 specific controls requirements as
				part of <?php echo $company->company_name; ?> control environment.
				The analysis concluded that there is unmitigated risk in the following

				<?php
					$noOfRisksAboveMinor=0;
					foreach($assessment->egrc_assessment_risks as $ar){
						if($ar->residual_scale!='Minor'){
							$noOfRisksAboveMinor++;
						}
					}
					echo $noOfRisksAboveMinor;
				?>
				 areas:
			</p>
				<table style="" cellspacing="0" cellpadding="5" border="1" bordercolor="#222222" width="100%">
					<thead>
						<tr>
							<th style="background-color:#000080;color:#fff;">Risk Domain</th>
							<th style="background-color:#000080;color:#fff;">Residual Risk</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($assessment->egrc_assessment_risks as $ar): ?>
							<?php if($ar->residual_scale!='Minor'): ?>
								<tr>
									<td><?php echo $ar->risk; ?></td>
									<td><?php echo $ar->residual_scale; ?></td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			<p>
				The highest risk area(s) were identified as
				<?php
					$rss="";
					foreach($riskScales as $rs){
						if($rs->severity_scale!="Minor"){
							$rss.=$rs->severity_scale.", ";
						}
					}
					echo substr($rss,0,-2);
				?>.
			</p>
			<?php foreach($riskScales as $rs): ?>
				<?php if($rs->severity_scale=="Minor"){continue;} ?>
				<p>
					The expected financial impact of an incident classified
				    as "<?php echo $rs->severity_scale; ?>" would be <?php echo $rs->financial_loss; ?>.
				</p>
			<?php endforeach; ?>
			<p>
				And it could bring about customer dissatisfaction, have a temporary business affect, hold a regulatory impact.
			</p>
			<h5>Control Exceptions Noted</h5>
			<p>
				<?php
					$noOfNonCompliance=0;
					foreach($assessment->egrc_assessment_policies as $acs){
						foreach($acs->egrc_assessment_policy_statements as $acsr){
							if($acsr->compliance_status=="Partially Compliant" || $acsr->compliance_status=="Non Compliant"){
								$noOfNonCompliance++;
							}
						}
					}
				?>
				The assessment identified <?= $noOfNonCompliance ?> controls requirements in the following Control Domains:
			</p>
			<table style="" cellspacing="0" cellpadding="5" border="1" bordercolor="#222222" width="100%">
				<thead>
					<tr>
						<th style="background-color:#000080;color:#fff;">Control Area</th>
						<th style="background-color:#000080;color:#fff;">Compliance Status</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($assessment->egrc_assessment_policies as $acs): ?>

						<?php if($acs->compliance_status!="Partially Compliant" && $acs->compliance_status!="Non Compliant"){ continue; } ?>

						<tr>
							<td colspan="2">
								<?php echo $acs->name; ?> (<?php echo $acs->compliance_status; ?>)
							</td>
						</tr>
						<tr>
							<td>
								<?php echo $acs->name; ?> requirements
							</td>
							<td>
								<ul>
									<?php foreach($acs->egrc_assessment_policy_statements as $acsr): ?>
										<?php if($acsr->compliance_status!="Partially Compliant" && $acsr->compliance_status!="Non Compliant"){continue;} ?>
										<li>
											<?php echo $acsr->name; ?>
											(<?php echo $acsr->compliance_status; ?>)
										</li>
									<?php endforeach; ?>
								</ul>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		<h3>1.2 <u>Table of Findings</u></h3>
			<p>

				<table width="100%" border="1" bordercolor="#333" cellspacing="0" style="font-size:10px;">
					<thead>
						<tr>
							<th rowspan="2" style="text-align:center;" class="text-dark">Findings / Exceptions</th>
							<th colspan="<?php echo count($risks); ?>" style="text-align:center;"  class="text-dark">Risk Considerations</th>
							<th rowspan="2" style="padding:4px;"></th>
							<th style="text-align:center;" colspan="<?php echo count($assessment->egrc_assessment_policies); ?>"  class="text-dark">Control Areas</th>
						</tr>
						<tr>
							<?php foreach($risks as $eRisk): ?>
								<th style="background:lightyellow;" align="center" class="text-dark">
									<?php echo $eRisk; ?>
								</th>
							<?php endforeach; ?>

							<?php foreach($assessment->egrc_assessment_policies as $eCont): ?>
								<th style="background:lightgreen;" align="center" class="text-dark" >
									<?php echo $eCont->name; ?>
								</th>
							<?php endforeach; ?>
						</tr>

					</thead>
					<tbody>
						<?php foreach($expTable as $exceptions=>$riskMapping): ?>
							<?php
								$exceptions=explode('~~',$exceptions);
								$control_id = $exceptions[0];
								$exception = $exceptions[1];
							?>
							<tr>
								<td>
									<?php echo $exception; ?>
								</td>
								<?php foreach($riskMapping as $rMap): ?>
									<td style="text-align: center;">
										<?php if($rMap=="P"): ?>
											<font size="3">*</font>
										<?php endif; ?>
									</td>
								<?php endforeach; ?>
								<td></td>
								<?php foreach($assessment->egrc_assessment_policies as $eCont): ?>
									<td style="text-align: center;">
										<?php if($eCont->id==$control_id): ?>
											<font size="3">*</font>
										<?php endif; ?>
									</td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</p>

			<h2>
				2. Methodology and Objective
			</h2>
			<h4>2.1 <u>Methodology</u></h4>
			<p align="justify">
				The methodology for this Assessment includes reliance on the collection of
				information gathered through interviews with <?php echo $company->company_name; ?> and the
				collection of related documentation that codifies the organization
				policies and procedures. A total of <?php echo count($assessment->egrc_assessment_risks); ?> risk areas
				were assessed and mapped to <?php echo count($assessment->egrc_assessment_policies); ?>, in addition
				to a review of the maturity of these processes using the CObIT
				framework for control maturity.
			</p>
			<h4>2.2 <u>Objective</u></h4>
			<p align="justify">
				The objective of the Assessment is to establish a risk profile for
				<?php echo $company->company_name; ?> that
					identifies and alerts Management to unmitigated risks, so that management can reply
					with appropriate strategies to either remediate control exceptions or implement
					compensating controls to mitigate them.
			</p>
			<h2>
				3. Operational Risks
			</h2>
			<p align="justify">
				The Analysis considered logical controls in <?php echo count($assessment->egrc_assessment_risks); ?>
				Risk Domains for the <?php echo $company->company_name; ?> environment.
			</p>

			<?php $sr=0; foreach($assessment->egrc_assessment_risks as $aRisk): ?>
				<h4>3.<?php echo $sr+=1; ?> <?php echo $aRisk->risk; ?></h4>
				<h5>Overview</h5>
				<p align="justify">
					<?php echo $aRisk->risk_description; ?>
				</p>
				<h5>Inherent Risk</h5>
				<p align="justify">
					Overall Inherent Risk Severity Rating: <?php echo $aRisk->inherent_scale; ?>
				</p>
				<p align="justify">
					The expected financial impact of a <?php echo $aRisk->inherent_scale; ?> incident would be
					<?php $rScale = $riskScales[$aRisk->inherent_scale]; ?>
					"<?php echo $rScale->financial_loss; ?>".
					It could also bring about <?php echo $rScale->business_disruption; ?>,
					<?php echo $rScale->regulatory; ?>  and <?php echo $rScale->headline_risk; ?> .
				</p>
				<h5>Risk Management</h5>
				<p>

					<b>Control Exceptions: </b>
					<?php if(!empty($expRisks[$aRisk->id])): ?>

						The table below is a subset of the overall list of Control Domain
						exceptions, showing those findings that are relevant to this risk:
						<table style="" cellspacing="0" cellpadding="5" border="1" bordercolor="#222222" width="60%" style="margin:auto;">
							<thead>
								<tr>
									<th style="background-color:#000080;color:#fff;">
										Exception(s)
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($expRisks[$aRisk->id] as $excep): ?>
									<tr>
										<td>
											<?php echo $excep; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>

					<?php else: ?>
						There are no exceptions found.
					<?php endif; ?>
				</p>
				<h5>Residual Risks</h5>
				<p align="justify">
					Overall Residual Risk Severity Rating: <?php echo $aRisk->residual_scale; ?>
				</p>
				<p align="justify">
					<?php $rScale = @$riskScales[$aRisk->residual_scale]; ?>
					The expected financial impact of an incident
					using this classification would be "<?php echo @$rScale->financial_loss; ?>".
					An incident could result in <?php echo @$rScale->business_disruption; ?>
					that could bring about <?php echo @$rScale->customer; ?>
					 or cause even <?php echo @$rScale->headline_risk; ?>.
					It would have <?php echo @$rScale->regulatory; ?>.
				</p>
			<?php endforeach; ?>

			<h2>
				4. Maturity Assessment
			</h2>
			<p align="justify">
				The Analysis considered controls in <?php echo count($assessment->egrc_assessment_policies); ?>
				Control Domains.  In each, a collection of controls was used to gain an overall
				assessment of the control environment.
			</p>
			<p align="justify">
				As part of this Assessment, <?php echo $company->company_name; ?> rated
				<?php echo count($assessment->egrc_assessment_policies); ?> broad, yet discreet, Control Domains.
				The assessment of these Control Domains was based on the design and
				operating effectiveness of each functional control requirement contributed
				to the overall Control Domain, and of the Control Maturity of each Control Domain.
			</p>
			<p align="justify">
				The overall Control Maturity rating is based on six
				factors adopted for use in this analysis, as suggested in CobIT:
			</p>
			<ul>
				<?php foreach($mAttributes as $mAttribute): ?>
					<li>
						<?php echo $mAttribute->name; ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<p align="justify">
				<?php $avg=[]; ?>
				<?php foreach($assessment->egrc_assessment_policies as $acs): ?>
					<?php
						$avg[]=$acs['maturity_rating'];
					?>
				<?php endforeach; ?>

				Across all of the Control domains, the average Control
				Maturity was <?php echo round(array_sum($avg)/count($avg),2); ?>.
			</p>

			<?php $sr=1; foreach($assessment->egrc_assessment_policies as $aControl): ?>
				<h4>4.<?php echo $sr+=1; ?> <?php echo $aControl->name; ?></h4>
				<p>
					Overall Compliance Status Rating: <?php echo $aControl->maturity_rating; ?>
				</p>
				<p align="justify">
					This rating indicates:
				</p>
				<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border:1px solid #333;border-width:0 0 1px 1px">
					<thead>
						<tr>
							<th style="border:1px solid #333;border-width:1px 1px 0 0 ;color:darkblue;">Control Domain</th>
							<th style="border:1px solid #333;border-width:1px 1px 0 0 ;color:darkblue;">Maturity Rating</th>
							<?php foreach($aControl->egrc_assessment_maturity_scores as $amScore): ?>
								<th style="border:1px solid #333;border-width:1px 1px 0 0 ;color:darkblue;">
									<?php echo $amScore->maturity_attribute; ?>
								</th>
							<?php endforeach; ?>
						</tr>
						<tr>
							<th style="border:1px solid #333;border-width:1px 1px 0 0 ;color:#fff;background-color:#4600a5;"><?php echo $aControl->name; ?></th>
							<th style="border:1px solid #333;border-width:1px 1px 0 0 ;color:#111;background:#fff58c;"><?php echo $aControl->maturity_rating; ?></th>
							<?php foreach($aControl->egrc_assessment_maturity_scores as $amScore): ?>
								<th style="border:1px solid #333;border-width:1px 1px 0 0 ;color:#111;background:#fff58c;">
									<?php echo $amScore->score." - ".$amScore->maturity_option; ?>
								</th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="border:1px solid #333;border-width:1px 1px 0 0 ;"></td>
							<td style="border:1px solid #333;border-width:1px 1px 0 0 ;"></td>
							<?php foreach($aControl->egrc_assessment_maturity_scores as $amScore): ?>
								<td style="border:1px solid #333;border-width:1px 1px 0 0 ;">
									<?php echo $mDescriptions[$amScore->maturity_attribute][$amScore->score]; ?>
								</td>
							<?php endforeach; ?>
						</tr>
					</tbody>
				</table>

			<?php endforeach; ?>

			<h2 style="page-break-before: always">
				5. Appendices
			</h2>
			<h4>5.1 Mapping of Risk Families to Control Domains</h4>
			<p align="justify">
				The table below associates Risks with the Controls Domains that affect them.
				"P" indicates that the Control Domain is a Primary control, and
				"S" indicates that the Control Domains is a Secondary control,
				in addressing each risk.
			</p>

			<!--mapping-->



	    	  <table cellspacing="0" cellpadding="2" style="font-size:15px;border:1px solid;border-width:1px 1px 0 0;">

			  	<thead>

			  		<tr>

			  			<th style="border:1px solid #333;color:#111;border-width:0 0 1px 1px" class=""></th>
			  			<th style="border:1px solid #333;color:#111;border-width:0 0 1px 1px" colspan="<?php echo count($risks); ?>">Risks Areas &rarr;</th>
			  		</tr>
			  		<tr>
			  			<th style="border:1px solid #333;color:#111;border-width:0 0 1px 1px" class=""> Control Areas &darr;</th>
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th style="background:#800080;color:#ffffff;border:1px solid #333;border-width:0 0 1px 1px;" class=""><?php echo $risk; ?></th>
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>

			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<td style="background:#800080;color:#ffffff;text-align:left;border:1px solid #333;border-width:0 0 1px 1px">
				  				<?php echo str_replace('Standard','',str_replace("Policy","",$risk_id)); ?>
				  			</td>

				  			<?php foreach($rows as $row): ?>
				  				<td style="<?php echo $row['mapping']==""?'background:#ffffcc;':''; ?>border:1px solid #333;border-width:0 0 1px 1px;text-align:center;">
				  					<?php echo $row['mapping']; ?>

				  				</td>
				  			<?php endforeach; ?>
				  		</tr>
			  		<?php endforeach; ?>

			  	</tbody>
			  </table>
			<!--mapping ends-->





		<script src="<?php echo $this->request->getAttribute('webroot').'plugins/jquery/jquery.min.js'; ?>"></script>

		<script>
			$(function(){
				exportHTML();
				$('#report').html("");
				window.close();
			});


		    function exportHTML(){
		       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
		            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
		            "xmlns='http://www.w3.org/TR/REC-html40'>"+
		            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
		       var footer = "</body></html>";
		       var sourceHTML = header+document.getElementById("report").innerHTML+footer;

		       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
		       var fileDownload = document.createElement("a");
		       document.body.appendChild(fileDownload);
		       fileDownload.href = source;
		       fileDownload.download = '<?php echo $assessment->case_number."_".$assessment->name; ?>.doc';
		       fileDownload.click();
		       document.body.removeChild(fileDownload);
		    }


		</script>

	</body>
</html>