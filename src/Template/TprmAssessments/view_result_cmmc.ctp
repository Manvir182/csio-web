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
	/*
	echo $this->Html->link('<i class="fa fa-file"></i> Download Report',[
		'controller'=>'assessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,'word'
	],[
		'class'=>"btn btn-danger report",
		'escape'=>false,'target'=>'_blank',
		'style'=>'float:right;'
	]);
	*/
?>

<button class="btn btn-primary exportbtn" style="float:right;" data-target="toExport">
	<i class="fa fa-download"></i>
	Download Excel
</button>


<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
 
  <li class="nav-item active">
    <a class="nav-link" id="controls-tab" data-toggle="pill" href="#controls" role="tab" aria-controls="controls" aria-selected="false">
    	CMMC Domains
    </a>
  </li>
  
  
</ul>
<div class="tab-content" id="pills-tabContent">
  
  <div class="tab-pane fade show active" id="controls" role="tabpanel" aria-labelledby="controls-tab">
  		<div class="accordion" id="cAccordion">
  			<table class="toExport" style="display:none;">
  				<tbody>
  					<tr>
  						<td colspan="3"><b>CMMC Control Domains</b></td>
  					</tr>
  				</tbody>
  			</table>
			<?php $i=0; foreach($assessment->cmmc_assessment_domains as $rBody): ?>
				
			 
			  <div class="card" style="border:1px solid #233149;margin-top:8px;">
			    <div class="card-heade" id="headingc<?= $rBody->id ?>">
			      <h4 class="mb-0 p-10 text-white <?php echo $i==0?'collapsed':''; ?>" style="cursor:pointer;background:#233149;" data-toggle="collapse" data-target="#ccollapse<?= $rBody->id ?>" aria-expanded="false" aria-controls="ccollapse<?= $rBody->id ?>">
			      	<span class="fa fa-chevron-circle-down float-right"></span>
				    <?= $rBody->name ?>
			      </h4>
			    </div>
			
			    <div id="ccollapse<?= $rBody->id ?>" class="collapse <?php echo $i==0?'show':''; ?>" aria-labelledby="headingc<?= $rBody->id ?>" data-parent="#cAccordion">
			      <div class="card-body p-0">
			        <div class="row">
				    	<div class="col-12">
				    		<div class="card bg-white" style="border:1px solid #ccc;" id="assessmentControls<?= $rBody->id ?>">
				    			<table class="table table-bordered table-hover m-b-0 toExport">
									<thead>
										<tr>
											<td colspan="<?php echo count($rBody->cmmc_assessment_levels[0]->cmmc_assessment_maturity_scores)+1; ?>" style="display:none;background:#233149;color:#ffffff;text-align:left;border:1px solid;">
												<?= $rBody->name ?> 
											</td>
											<td style="display:none;background:#c5e45b;color:#111;text-align:left;border:1px solid;"> 
												<b>Capability: </b>
												<?php
											  		//calculating the Level of the Domain
											  		$thisDomainLevel = 'Inadequate';
													foreach($rBody->cmmc_assessment_levels as $cdLevel){
														if($cdLevel->score==100){
															$thisDomainLevel = $cdLevel->name;
														} else {
															break;
														}
													}
													echo $thisDomainLevel;
											  	?>
											  	
											</td>
											<td style="display:none;background:#ffffcc;color:#111;text-align:left;border:1px solid;">
												<b>Process: </b> <?php echo $rBody->maturity_level; ?>
											</td>
											<td style="display:none;background:#00b0ed;color:#111;text-align:left;border:1px solid;">
												<b>Compliant: </b> <?php echo $rBody->score; ?>%
											</td>
										</tr>
										<tr>
											<td colspan="<?php echo count($rBody->cmmc_assessment_levels[0]->cmmc_assessment_maturity_scores)+4; ?>" style="display:none;background:#800080;color:#ffffff;text-align:left;border:1px solid;">
												<?= $rBody->name ?> Levels
											</td>
										</tr>
										<tr class="text-center text-blue">
											<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class=""></td>
											<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Capability Levels</td>
											<td style="font-weight:bold;border:1px solid #444;" rowspan="2" valign="middle" class="">Capability Maturity</td>
											<td style="font-weight:bold;border:1px solid #444;" colspan="<?php echo count($rBody->cmmc_assessment_levels[0]->cmmc_assessment_maturity_scores)+1; ?>"  class="">
												CMMC Process Maturity
											</td>
										</tr>
										<tr>
											<td style="font-weight:bold;border:1px solid #444;" valign="middle" class="">Process Maturity Rating</td>
											<?php foreach($rBody->cmmc_assessment_levels[0]->cmmc_assessment_maturity_scores as $mAttr): ?>
												<td style="font-weight:bold;border:1px solid #444;" valign="middle" class=""><?php echo $mAttr->maturity_attribute; ?></td>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($rBody->cmmc_assessment_levels as $cLevel): ?>
											<tr class="table-warning">
												<td style="background:#800080;color:#fff;border:1px solid #555;" class="text-center">
													<span class="fa fa-plus-square contReqs" data-target=".contReqTable<?= $cLevel->id ?>"></span>
													
												</td>
												<td style="background:#800080;color:#fff;border:1px solid #555;"><?= $cLevel->name ?></td>
												<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?= $cLevel->score ?>%</td>
												<td style="background:#ffffcc;color:#111;border:1px solid #555;" class="text-center"><?= $cLevel->maturity_level ?></td>
												<?php foreach($cLevel->cmmc_assessment_maturity_scores as $mAttr): ?>
													<td style="background:#ffffcc;color:#111;border:1px solid #555;"><?php echo $mAttr->maturity_option; ?></td>
												<?php endforeach; ?>
											</tr>
											<?php $rLength = count($cLevel->cmmc_assessment_capabilities); ?>
											<?php $crl=0; foreach($cLevel->cmmc_assessment_capabilities as $creq): ?>
												<tr style="display:none;" class="contReqslist table-info contReqTable<?= $cLevel->id ?>">
													<?php if($crl==0): ?>
														<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"></td>
														<td style="background:#cc99ff;color:#111;border:1px solid #555;" rowspan="<?php echo $rLength; ?>"> <?= $cLevel->name ?> Capabilities </td>
													<?php endif; ?>
													<td style="background:#ffffcc;color:#111;border:1px solid #555;" colspan="<?php echo count($rBody->cmmc_assessment_levels[0]->cmmc_assessment_maturity_scores)+2; ?>">
														<h4>
															<span class="fa fa-plus-square contReqs" data-target=".contAReqTable<?= $creq->id ?>"></span>
															<b><?= $creq->name ?></b>
														</h4>
														<div class="contAReqTable<?= $creq->id ?>" style="display:none;">
															<ul>
																<?php foreach($creq->cmmc_assessment_practices as $fcreq): ?>
																		<li>
																			<p>
																				<?php echo $fcreq->code; ?> -
																				<?php echo $fcreq->name; ?>
																				<br>
																				<u><?php echo $fcreq->score; ?>% Compliant</u>
																				
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
				    		</div>
				    	</div>
				    </div>
			      </div>
			    </div>
			  </div>
			<?php $i++; endforeach; ?>
		</div> <!--regu body accordion ends-->
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
				//window.close();
			},2000);
		<?php endif; ?>
		
	});
</script>