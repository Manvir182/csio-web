<style>
	.form-control {
		padding:2px;
		min-width:100px;
	}
	.form-control.busy {
		background-image:url(<?php echo $this->request->getAttribute('webroot'); ?>/img/loader.gif);
		background-repeat:no-repeat;
		background-size:auto 60%;
		background-position:85% center;
	}
	.btn.abtns,
	.btn.cbtns {
		padding-left:20px;
		text-align:left !important;
	}
	.btn.abtns .fa,
	.btn.cbtns .fa {
		margin-left:-15px;
	}
	.bg-dark {
		background-color:#233149;
	}
	/*
	.cmmcDomainforStats .domainStats {
		visibility:hidden;
		opacity:0;
		transition:all .4s;
	}
	.cmmcDomainforStats:hover .domainStats {
		visibility:visible;
		opacity:1;
	}
	*/
</style>
<div class="row page-titles">
    <div class="col-md-12 col-12">
        <ol class="breadcrumb" style="">
        	<?php if($thisUser['role']=='Employee'): ?>
        		<li class="breadcrumb-item">
	            	<?php
	            		echo $this->Html->link('Dashboard',array(
							'controller'=>'lab','action'=>'dashboard'
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item">
	            	<?php
	            		echo $this->Html->link('Tracking',array(
							'controller'=>'Assessments','action'=>'tracking'
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item active">View Assessment Details</li>
        	<?php else: ?>
	            <li class="breadcrumb-item">
	            	<?php
	            		echo $this->Html->link('Dashboard',array(
							'controller'=>'users','action'=>'dashboard'
						));
	            	?>
	            </li>
	            <?php if($thisUser['role']=='Company'): ?>
	            	<li class="breadcrumb-item">
		            	<?php
		            		echo $this->Html->link('Assessments',array(
								'controller'=>'Assessments','action'=>'selfAssessments'
							));
		            	?>
		            </li>
	            <?php else: ?>
	            	<li class="breadcrumb-item">
		            	<?php
		            		echo $this->Html->link('Assessments',array(
								'controller'=>'Assessments','action'=>'listAssessments'
							));
		            	?>
		            </li>
	            <?php endif; ?>
	            <li class="breadcrumb-item active">View Assessment Details</li>
	       <?php endif; ?>

        </ol>
    </div>

</div>
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
			<td>
				<h5 class="text-themecolor">Assessment Statuses</h5>
				<br>
				<div class="btn-group btn-group-sm">
				  <button type="button" class="btn <?php echo $assessment->status=='Completed'?'btn-success':'btn-info'; ?>"><?= h($assessment->status) ?></button>
				  <?php if($assessment->status!='Completed'): ?>
				  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <div class="dropdown-menu dropdown-menu-right" style="overflow:hidden;">
				  	<?php if($assessment->status=='Completed'): ?>
        				<?php
					  		echo $this->Form->postLink('View Results',array('action'=>'assessmentResults'),array('data'=>array('id'=>$assessment->id),'class'=>'dropdown-item'));
					  	?>
        			<?php else: ?>
					  	<div class="dropdown-header">Update Status </div>
					  	<?php
					  		//echo $this->Form->postLink('In Progress',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'In Progress'),'confirm'=>'Are you sure to mark this assignment as "In Progress".','class'=>'dropdown-item'));
					  	?>
					  	<?php if($assessment->status=='In Progress'): ?>
						  	<?php
						  		echo $this->Form->postLink('Review / Draft',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Review or Draft'),'confirm'=>'Are you sure to mark this assignment as "Review or Draft"','class'=>'dropdown-item'));
						  	?>
					  	<?php elseif($assessment->status=='Review or Draft'): ?>
						  	<?php
						  		echo $this->Form->postLink('Accepted',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Accepted'),'confirm'=>'Are you sure to mark this assignment as "Accepted"','class'=>'dropdown-item'));
						  	?>
						  	<?php
						  		echo $this->Form->postLink('Rejected Pending Updates',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Rejected Pending Updates'),'confirm'=>'Are you sure to mark this assignment as  "Rejected Pending Updates"','class'=>'dropdown-item'));
						  	?>
						<?php elseif($assessment->status=='Accepted'): ?>
							<?php
								echo $this->Form->postLink('Completed',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Completed'),'confirm'=>'Are you sure to mark this assignment as completed','class'=>'dropdown-item'));
							?>
						<?php elseif($assessment->status=='Rejected Pending Updates'): ?>
							<?php
						  		echo $this->Form->postLink('Accepted',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Accepted'),'confirm'=>'Are you sure to mark this assignment as "Accepted"','class'=>'dropdown-item'));
						  	?>
					  	<?php endif; ?>
					  	<?php
					  		/*
					  		if($assessment->status!='Completed'){
					  			echo $this->Form->postLink('Completed',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Completed'),'confirm'=>'Are you sure to mark this assignment as completed','class'=>'dropdown-item'));
					  		}  else {
					  			echo "<a class='dropdown-item' data-toggle='tooltip' data-placement='left' title='Assessement is marked as Completed.'>Completed</a>";
					  		}
					  		*/
					  	?>
				  	<?php endif ?>
				  </div>
				  <?php endif ?>
				</div>

				&nbsp;
				<button class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#statusesModal">
					<i class="fa fa-file"></i>
					Show All
				</button>
			</td>
			<td>
				<h5 class="text-themecolor">
					Actions
				</h5>
				<br>
				<?php if($assessment->status=='Review or Draft'): ?>
					<div class="dropdown" style="display:inline-block;">
					  <a class="btn btn-danger btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fa fa-download"></i>
					  </a>

					  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					  	<?php
					  		if($assessment->sub_type!='CMMC'){
								echo $this->Html->link('<i class="fa fa-file-word"></i> Word',[
									'controller'=>'assessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,"word"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
								],[
									'class'=>"report dropdown-item",
									'escape'=>false,'target'=>'_blank',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'title'=>"Result Draft"
								]);
							}
						?>
						<?php
							echo $this->Html->link('<i class="fa fa-file-excel"></i> Excel',[
								'controller'=>'assessments','action'=>'viewResult',$assessment->id,$assessment->sub_type,"export"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
							],[
								'class'=>"report dropdown-item",
								'escape'=>false,'target'=>'_blank',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'title'=>"Result Draft"
							]);
						?>

					  </div>
					</div>

		      	<?php elseif($assessment->status=='Completed'): ?>

		      		<button class="btn btn-sm btn-warning text-white showResult" data-aid="<?php echo $assessment->id; ?>" data-subtype="<?php echo $assessment->sub_type; ?>" type="button" data-toggle="tooltip" title="Show Results">
						<i class="fa fa-file"></i>
					</button>
					<?php
						/*
						echo $this->Html->link('<i class="fa fa-download"></i>',[
							'controller'=>'assessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,'word'
						],[
							'class'=>"btn btn-success btn-sm text-white report",
							'escape'=>false,'target'=>'_blank',
							'data-toggle'=>'tooltip',
							'data-placement'=>'top',
							'title'=>"Result Report"
						]);
						*/
					?>

					<div class="dropdown" style="display:inline-block;">
					  <a class="btn btn-danger btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fa fa-download"></i>
					  </a>

					  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					  	<?php
							echo $this->Html->link('<i class="fa fa-file-word"></i> Word',[
								'controller'=>'assessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,"word"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
							],[
								'class'=>"report dropdown-item",
								'escape'=>false,'target'=>'_blank',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'title'=>"Result Report"
							]);
						?>
						<?php
							echo $this->Html->link('<i class="fa fa-file-excel"></i> Excel',[
								'controller'=>'assessments','action'=>'viewResult',$assessment->id,$assessment->sub_type,"export"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
							],[
								'class'=>"report dropdown-item",
								'escape'=>false,'target'=>'_blank',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'title'=>"Result Report"
							]);
						?>

					  </div>
					</div>
					<?php
						/*
						echo $this->Form->postLink('<i class="fa fa-redo"></i>',[
							'controller'=>'Assessments','action'=>'assessmentRepeat',$assessment->id,$assessment->sub_type
						],[
							'class'=>'btn btn-sm btn-secondary','escape'=>false,
							'data-toggle'=>'tooltip','title'=>'Re-Assessment'
						]);
						*/
					?>
		      	<?php endif; ?>
			</td>
		</tr>
	</table>
	<?php if($assessment->sub_type=='CMMC'): ?>
		<span class="float-right">
			<span class="text-danger">
				<i class="fa fa-info-circle"></i>
				<b>Click on Domain Name/Level to expand/collapse</b>
			</span>
		</span>

		<h4>CMMC Domains</h4>

		<div class="accordion" id="CmmcAccordion">
		  <?php foreach($assessment->cmmc_assessment_domains as $dkey=>$cmmcDomain): ?>
		  	<?php
		  		//calculating the Level of the Domain
		  		$thisDomainLevel = 'Inadequate';
				foreach($cmmcDomain->cmmc_assessment_levels as $cdLevel){
					if($cdLevel->score==100){
						$thisDomainLevel = $cdLevel->name;
					} else {
						break;
					}
				}
		  	?>

			  <div class="card">
			    <div class="card-header bg-dark cmmcDomainforStats">

			     	<span class="float-right text-white domainStats">
			     		<b>Capability: </b>
			     		<?php

							if($thisDomainLevel != 'Inadequate'){
								$lstring = "";
								foreach($cmmcDomain->cmmc_assessment_levels as $cdLevel){
									if($thisDomainLevel == $cdLevel->name){
										$lstring.= '<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">'.$cdLevel->name."</span>";
									} else {
										//$lstring.= '<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14 ml-2">'.$cdLevel->name."</span>";
									}

								}
								echo $lstring;
							} else {
								echo '<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14 ml-2">'.$thisDomainLevel."</span>";
							}
						?>
			     		|
			     		<b>Process: </b>
			     		<?php
			     			if(!is_null($cmmcDomain->score)){
			     				foreach($amoptions as $amoption){
				     				if($amoption->code==$cmmcDomain->maturity_level){
				     					echo '<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">'.$amoption->code."</span>";
									} else {
										//echo '<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14 ml-2">'.$amoption->code."</span>";
									}
				     			}
			     			} else {
			     				echo 'Pending';
			     			}

			     		?>
			     		|
			     		<b>Compliance: </b>
			     		<?php

			     			if(!is_null($cmmcDomain->score)){
				     			echo '<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">'.$cmmcDomain->score."%</span>";
								/*
					     		foreach($cmmcDomain->cmmc_assessment_levels as $clevel){
					     			if($clevel->score==100){
				     					echo '<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">'.$clevel->code." - ".$clevel->score."%</span>";
									} else {
										echo '<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14 ml-2">'.$clevel->code." - ".$clevel->score."%</span>";
									}
								}
								*/
							} else {
			     				echo 'Pending';
			     			}
						?>
						<!--
			     		<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">
			    			Capability: <?php echo $thisDomainLevel; ?>
			    		</span>
			    		<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">
			    			Process: ML2
			    		</span>
			      		<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">
			      			Compliance:
			    			<?php if(empty($cmmcDomain->score)): ?>
			    				Pending
			    			<?php else: ?>
			    				<?php echo $cmmcDomain->score; ?> %
			    			<?php endif; ?>

			    		</span>
			    		-->
			      	</span>
			      	<h4 class="mb-0">

		      			<a class="text-white d-block"  data-toggle="collapse" href="#domain<?php echo $cmmcDomain->id; ?>">
		      			  <span class="fa fa-chevron-circle-down" style="font-size:10px;position:relative;margin-left:-8px;"></span>
				          <?php echo $cmmcDomain->name; ?>
				        </a>
			        </h4>


			    </div>
				<div id="domain<?php echo $cmmcDomain->id; ?>" class="collapse <?php echo $dkey==0?'show':''; ?>" data-parent="#CmmcAccordion">
			      <div class="card-body p-0">
			      		<h4 class="px-3 mt-2"><?php echo $cmmcDomain->name; ?> Levels</h4>
			    		<div class="accordion" id="domain<?php echo $cmmcDomain->id; ?>levelAccordion">
			    		  <?php foreach($cmmcDomain->cmmc_assessment_levels as $level): ?>
							  <div class="card rounded-0 mb-0">
							    <div class="card-header bg-info rounded-0">
							    	<span class="float-right">
							    		<b>Process: </b>
							     		<?php
							     			if(!is_null($level->score)){
							     				foreach($amoptions as $amoption){
								     				if($amoption->code==$level->maturity_level){
								     					echo '<span class="px-2 d-inline-block rounded-pill bg-white text-primary font-14 ml-2">'.$amoption->code."</span>";
													} else {
														//echo '<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14 ml-2">'.$amoption->code."</span>";
													}
								     			}
							     			} else {
							     				echo 'Pending';
							     			}

							     		?>
							     		|
							     		<b>Compliance: </b>
							     		<?php
								     		if(!is_null($level->score)){
								     			echo '<span class="px-2 d-inline-block rounded-pill bg-white text-primary font-14 ml-2">'.$level->score."%</span>";
												/*
									     		if($level->score==100){
							     					echo '<span class="px-2 d-inline-block rounded-pill bg-white text-primary font-14 ml-2">'.$level->score."%</span>";
												} else {
													echo '<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14 ml-2">'.$level->score."%</span>";
												}
												*/
											} else {
							     				echo 'Pending';
							     			}
										?>

							    		<!--
							    		<?php if(!is_numeric($level->score)): ?>
								    		<span class="d-inline-block px-2 py-1 bg-secondary border-dark rounded-pill font-14 text-white">
								    			Compliance: Pending
								    		</span>
							    		<?php else: ?>
							    			<span class="d-inline-block px-2 bg-white border-dark rounded-pill font-14 text-dark border mr-2">
								    			Compliance: <?php echo $level->score; ?> %
								    		</span>

						    			<?php endif; ?>
						    			-->
							    		<?php
							    			$thisLevelPosition=0;
											foreach($cmmcDomain->cmmc_assessment_levels as $pos=>$alvl){
												if($level->code==$alvl->code){
													$thisLevelPosition = $pos;
												}
											}
											$allLvls = $cmmcDomain->cmmc_assessment_levels;

											if($thisLevelPosition>0 && $allLvls[$thisLevelPosition-1]['status']=='Pending'){
												echo "<button class='btn btn-danger btn-sm' type='button' data-toggle='tooltip' data-placement='left' title='Previous Level is not Completed Yet.'>
														Assess
													  </button>";
											} else {
												echo $this->Html->link('Assess',[
								    				'controller'=>'assessments','action'=>'cmmcCapabilityMaturity',$level->id,$assessment->sub_type
								    			],[
								    				'class'=>'btn btn-danger btn-sm'
								    			]);
											}
							    		?>

							    	</span>
							      <h2 class="mb-0">
							        <button class="btn btn-link text-white text-left" type="button" data-toggle="collapse" data-target="#domain<?php echo $cmmcDomain->id; ?>level<?php echo $level->id; ?>">
							          <span class="fa fa-chevron-circle-down" style="font-size:10px;position:relative;margin-left:-8px;"></span>
							          <?php echo $level->code; ?> - <?php echo $level->name; ?>
							        </button>
							      </h2>
							    </div>

							    <div id="domain<?php echo $cmmcDomain->id; ?>level<?php echo $level->id; ?>" class="collapse" data-parent="#domain<?php echo $cmmcDomain->id; ?>levelAccordion">
							      <div class="card-body rounded-0 p-0">
							      	<h4 class="mt-2 pl-3"><?php echo $level->name; ?> Capabilities</h4>
							      	<div class="accordion" id="domain<?php echo $cmmcDomain->id; ?>level<?php echo $level->id; ?>Accordion">
						    		  <?php foreach($level->cmmc_assessment_capabilities as $capability): ?>
										  <div class="card rounded-0 mb-0">
										    <div class="card-header rounded-0">
										    	<span class="float-right">
										      		<span class="px-2 d-inline-block rounded-pill bg-secondary text-white font-14">
										    			<?php if(empty($capability->score)): ?>
										    				0%
										    			<?php else: ?>
										    				<?php echo $capability->score; ?> %
										    			<?php endif; ?>

										    		</span>
										      	</span>
										      <h2 class="mb-0">

										        <button class="btn btn-link text-dark text-left" type="button" data-toggle="collapse" data-target="#domain<?php echo $cmmcDomain->id; ?>level<?php echo $level->id; ?>cap<?php echo $capability->id; ?>">
										          <span class="fa fa-chevron-circle-down" style="font-size:10px;position:relative;margin-left:-8px;"></span>
										          <?php echo $capability->code; ?> - <?php echo $capability->name; ?>
										        </button>
										      </h2>
										    </div>

										    <div id="domain<?php echo $cmmcDomain->id; ?>level<?php echo $level->id; ?>cap<?php echo $capability->id; ?>" class="collapse" data-parent="#domain<?php echo $cmmcDomain->id; ?>level<?php echo $level->id; ?>Accordion">
										      <div class="card-body rounded-0">
										      	<h4>Practices</h4>
										      	<ul class="list-group">
										      	  <?php foreach($capability->cmmc_assessment_practices as $practice): ?>
												  	<li class="list-group-item">
												  		<span class="float-right">
												      		<span class="px-2 d-inline-block rounded-pill bg-info text-white font-14 ml-2">
												    			<?php if(empty($practice->score)): ?>
												    				0%
												    			<?php else: ?>
												    				<?php echo $practice->score; ?> %
												    			<?php endif; ?>

												    		</span>
												      	</span>
												  		<?php echo $practice->code; ?> -
												  		<?php echo $practice->name; ?>
												  	</li>
												  <?php endforeach; ?>
												</ul>
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
			  </div>
		  <?php endforeach; ?>
		</div> <!--ccmc accordion ends-->



	<?php elseif($assessment->sub_type=='Regulated'): ?>
		<h4>Regulatory Bodies</h4>
		<div class="accordion" id="rbAccordion">
			<?php $ssr=0; ?>
			<?php foreach($assessment->assessments_regulatory_bodies as $rBody): ?>


			  <div class="card" style="border:1px solid #233149;margin-top:8px;">
			    <div class="card-heade" id="headingr<?= $rBody->id ?>">
			      <h4 class="mb-0 p-10 text-white" style="cursor:pointer;background:#233149;" data-toggle="collapse" data-target="#rcollapse<?= $rBody->id ?>" aria-expanded="false" aria-controls="rcollapse<?= $rBody->id ?>">
			      	<span class="fa fa-chevron-circle-down float-right"></span>
				    <?= $rBody->regulatory_body->name ?>
			      </h4>
			    </div>

			    <div id="rcollapse<?= $rBody->id ?>" class="collapse <?php echo $ssr==0?' show':''; $ssr++; ?>" aria-labelledby="headingr<?= $rBody->id ?>" data-parent="#rbAccordion">
			      <div class="card-body p-10">
			        <div class="row">
				    	<div class="col-4">
				    		<div class="card">
				    			<h4 class="m-b-0 p-10 bg-info text-white font-bold">Risk Domains</h4>
				    			<table class="table table-bordered m-b-0 table-hover">
				    				<thead>
				    					<tr>
				    						<th class="text-themecolor">No.</th>
				    						<th class="text-themecolor">Risk Domain</th>
				    						<th class="text-themecolor">
				    							Inherent Risk
				    							<i class="fa fa-info-circle text-info ml-1" data-toggle="modal" data-target='#scalesModal'></i>
				    						</th>
				    						<?php //if($assessment->status=="Completed"): ?>
				    							<th class="text-themecolor">Residual Risk</th>
				    						<?php //endif; ?>
				    					</tr>
				    				</thead>
				    				<tbody>
				    					<?php $sr=1; foreach($rBody->assessment_risks as $risk): ?>
				    						<tr>
				    							<td align="center"><?= $sr++ ?>.</td>
				    							<td>
				    								<?= $risk->risk ?>
				    								<i class="fa fa-info-circle text-info ml-1" data-toggle="tooltip" data-placement='right' title="<?php echo $risk->risk_description; ?>"></i>
				    							</td>
				    							<td class="<?= $risk->inherent_scale ?> form-group">
				    								<!--<?= $risk->inherent_scale ?>-->
				    								<select class="form-control input-sm <?= $risk->inherent_scale ?> instantSave" data-table="assessment_risks" data-id="<?php echo $risk->id; ?>">
				    									<option value="">-Select-</option>
				    									<?php foreach($scales as $scale): ?>
				    										<option <?php echo $scale->severity_scale==$risk->inherent_scale?"selected":""; ?> value="<?php echo $scale->severity_scale; ?>"><?php echo $scale->severity_scale; ?></option>
				    									<?php endforeach; ?>
				    								</select>

				    							</td>
				    							<?php //if($assessment->status=="Completed"): ?>
					    							<td class="<?= $risk->residual_scale ?>"><?= $risk->residual_scale ?></td>
					    						<?php //endif; ?>
				    						</tr>
				    					<?php endforeach; ?>
				    				</tbody>
				    			</table>
				    		</div>
				    	</div>
				    	<div class="col-8">
				    		<div class="card bg-white" style="border:1px solid #ccc;" id="assessmentControls">
				    			<h4 class="m-b-0 p-10 bg-info text-white font-bold">


					    			<div class="row">
					    				<div class="col-sm-4">
					    					Control Areas
					    				</div>
					    				<div class="col-sm-4">
					    					Compliance Status
					    					<i class="fa fa-info-circle text-white ml-1" data-toggle="modal" data-target='#effectivenessModal'></i>
					    				</div>
					    				<div class="col-sm-4">
					    					<?php
							    				echo $this->Html->link('<i class="fa fa-calendar"></i> Update Risk Control Mapping',[
							    					'controller'=>'assessments','action'=>'rcmapping',$assessment->id,$assessment->sub_type,$rBody->id
							    				],[
							    					'class'=>'btn btn-warning btn-sm float-right',
							    					'escape'=>false
							    				]);
							    			?>
					    				</div>
					    			</div>
				    			</h4>
				    			<?php foreach($rBody->assessment_controls as $control): ?>

				    				<div class="card mb-0">
				    					<h5 class="m-b-0 p-10 bg-light text-dark font-bold">
				    						<div class="row">
				    							<div class="col-sm-4">
				    								<button class="btn m-b-0 m-l-0 cbtns" style="background-color:transparent;outline:none;box-shadow:none;display:inline-block;text-align:left;" data-toggle="collapse" data-target="#collapse<?= $control->id ?>" aria-expanded="false" aria-controls="collapse<?= $control->id ?>" type="button">
						    							<span class="fa fa-chevron-circle-down"></span>
						    							<?= $control->name ?>
						    						</button>
						    						<?php if(strlen($control->description)>0): ?>
						    							<i class="fa fa-info-circle text-info ml-1" data-toggle="tooltip" data-placement='right' title="<?php echo $control->description; ?>"></i>
						    						<?php endif; ?>
				    							</div>
				    							<div class="col-sm-4">
				    								<span style="font-size:14px;">
						    							<?= empty($control->compliance_status)?"<i class='fa fa-info-circle text-warning' data-toggle='tooltip' title='Not Updated'></i> "."Not Updated yet":"<i class='fa fa-check-circle text-success' data-toggle='tooltip' title='Updated'></i> ".$control->compliance_status ?>
						    						</span>
				    							</div>
				    							<div class="col-sm-4">
				    								<?php
						    							echo $this->Html->link('<i class="fa fa-bookmark"></i> Perform Control & Maturity Assessment',[
						    								'controller'=>'assessments','action'=>'controlMaturityRating',$control->id,$assessment->sub_type
						    							],[
						    								'class'=>'btn btn-sm btn-danger float-right m-b-0',
						    								'escape'=>false
						    							]);
						    						?>
				    							</div>
				    						</div>
				    					</h5>
				    					<div class="collapse" id="collapse<?= $control->id ?>" data-parent="#assessmentControls">
				    						<table class="table table-bordered table-hover">
				    							<thead>
							    					<tr class="active">
							    						<th class="text-themecolor">Requirement Name</th>
							    						<th class="text-themecolor">Artifact</th>
							    						<th class="text-themecolor">Compliance Status</th>
							    					</tr>
							    				</thead>
							    				<tbody>
							    					<?php foreach($control->assessment_control_requirements as $creq): ?>
							    						<tr>
							    							<td><?= $creq->name ?></td>
							    							<td style="min-width:160px;">
							    								<button class="btn btn-sm btn-warning showArtifact" <?php echo $creq->artifact==""?"style='display:none;'":''; ?> type="button" data-file="<?php echo $creq->artifact; ?>">
						    										Artifact
						    									</button>
						    								</td>
							    							<td>
							    								<?php echo $creq->compliance_status; ?>
							    							</td>
							    						</tr>
							    					<?php endforeach; ?>
							    				</tbody>
				    						</table>
				    					</div>
				    				</div>

				    			<?php endforeach; ?>
				    		</div>
				    	</div>
				    </div>
			      </div>
			    </div>
			  </div>
			<?php endforeach; ?>
		</div> <!--regu body accordion ends-->
	<?php elseif($assessment->sub_type=='FFIEC Regulated'): ?>

		<div class="row mt-2">
	    	<div class="col-5">
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
				      			Residual Risk
				      			<i class="fa fa-info-circle text-info ml-1" data-toggle="modal" data-target='#scalesModal'></i>
				      		</div>
				      	</div>

	    			</h4>
	    			<div class="py-2">


	    				<div class="row">
				      		<div class="col-sm-6 col-xl-6">
				      			<b class="ml-2">Overall </b>
				      		</div>
				      		<div class="col-lg-3 col-xl-3 text-center">
				      			<span class="overall" style="margin-left:-22px;"></span>
				      		</div>
				      		<div class="col-lg-3 col-xl-3 text-center">

				      		</div>
				      	</div>
	    			</div>
	    			<div class="accordion" id="raccordionExample">
	    			<?php $avgInherentScore=0; ?>
	    			  <?php foreach($assessment->ffiec_assessment_risks as $key=>$fRisk): ?>
	    			  	<?php $avgInherentScore+=$fRisk->inherent_score; ?>
						  <div class="card riskCard">
						    <div class="card-header" id="headingOnefar<?php echo $fRisk->id; ?>" style="padding-left:0px;">
						      <h2 class="mb-0">
						      	<div class="row">
						      		<div class="col-sm-6 col-xl-6">
						      			<button class="btn btn-link text-primary collapsed abtns" style="text-align:left !important;" type="button" data-toggle="collapse" data-target="#collapseOnefar<?php echo $fRisk->id; ?>" aria-expanded="true" aria-controls="collapseOnefar<?php echo $fRisk->id; ?>">
						      			  <i class="fa fa-caret-down"></i>
								          <?php echo $fRisk->name; ?>
								        </button>
								    </div>
						      		<div class="col-sm-3 col-xl-3 text-center">
						      			<span class="btn btn-sm btn-secondary inherent badge-pill <?php echo $fRisk->inherent_scale; ?>" style="width:100px;<?php echo $fRisk->inherent_scale==''?'color:red;background:rgba(0,0,0,0.1)':''; ?>">
											<?php echo $fRisk->inherent_scale==""?"Incomplete":$fRisk->inherent_scale; ?>
										</span>
						      		</div>
						      		<div class="col-sm-3 col-xl-3 text-center">
						      			<span class="btn btn-sm btn-secondary residual badge-pill <?php echo $fRisk->residual_scale; ?>" style="width:100px;">
											<?php echo $fRisk->residual_scale==""?"Incomplete":$fRisk->residual_scale; ?>
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
						      					</td>
						      					<td class="form-group <?php echo $fRiskFactor->scale; ?>">
						      						<?php echo $fRiskFactor->scale; ?>
						      						<!--
						      						<select class="form-control instantSaveFactor <?php echo $fRiskFactor->scale; ?>" data-id="<?php echo $fRiskFactor->id; ?>">
						      							<?php if(empty($fRiskFactor->scale)): ?>
						      								<option value=""></option>
						      							<?php endif; ?>
						      							<?php foreach($scales as $scale): ?>
						      								<option <?php echo $fRiskFactor->score==$scale->score?'selected':''; ?> value="<?php echo $scale->score."~".$scale->severity_scale; ?>"><?php echo $scale->severity_scale; ?></option>
						      							<?php endforeach; ?>
						      						</select>
						      						-->
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
	    	<div class="col-7">
	    		<div class="card">
	    			<h4 class="m-b-0 mb-0 p-10 bg-primary text-white font-bold">
	    				<div class="row">
	    					<div class="col-5">
	    						FFIEC Control Areas
	    					</div>
	    					<div class="col-2">
	    						FFIEC Target
	    						<i class="fa fa-info-circle text-white" data-toggle="modal" data-target="#fTargetModal"></i>


	    					</div>
	    					<div class="col-2">
	    						Compliance Status
								<i class="fa fa-info-circle text-white ml-1" data-toggle="modal" data-target='#effectivenessModal'></i>
					    	</div>
	    					<div class="col-3 text-right">
	    						<?php
				    				echo $this->Html->link('<i class="fa fa-calendar"></i> Risk Control Mapping',[
				    					'controller'=>'assessments','action'=>'ffiecRcmapping',$assessment->id
				    				],[
				    					'class'=>'btn btn-warning btn-sm',
				    					'escape'=>false,
				    					//'onclick'=>'return false;'
				    				]);
				    			?>
	    					</div>
	    				</div>
	    			</h4>
	    			<div class="accordion" id="caccordionExample">
	    			  <?php foreach($assessment->ffiec_assessment_domains as $fdomain): ?>
						  <div class="card">
						    <div class="card-header" id="headingOnefd<?php echo $fdomain->id; ?>" style="padding-left:0px;">
						      <h2 class="mb-0" >
						      	<div class="row">
			    					<div class="col-5">
			    						<button class="btn btn-link text-primary cbtns" type="button" data-toggle="collapse" data-target="#collapseOnefd<?php echo $fdomain->id; ?>" aria-expanded="false" aria-controls="collapseOnefd<?php echo $fdomain->id; ?>">
								          <i class="fa fa-caret-down"></i>
								          <?php echo $fdomain->name; ?> <!--:<?php //echo $fdomain->ffiec_assessment_domain_a_factors[0]->ffiec_assessment_domain_requirements[0]->maturity_level; ?> -->
								        </button>
			    					</div>
			    					<div class="col-2">
			    						<?php if(empty($fdomain->compliance_status) || $fdomain->compliance_status==""): ?>
			    						<div class="form-group">
											<select class="form-control fcTargetBtnDropdown" data-id="<?php echo $fdomain->id; ?>" data-default="<?php echo $fdomain->ffiec_assessment_domain_a_factors[0]->ffiec_assessment_domain_requirements[0]->maturity_level; ?>">
											</select>
											<span class="text-danger fcLoader" style="font-size:12px;line-height:15px;font-weight:bold;display:none;">
												<i class="fa fa-spin fa-spinner"></i>
												<span class="blinking">Processing...</span>
											</span>
										</div>
										<?php else: ?>
											<div style="font-size:15px;line-height:18px;padding-top:5px;">
												<?php echo $fdomain->m_level; ?>
											</div>
										<?php endif; ?>

			    					</div>
			    					<div class="col-2 text-center" style="font-size:15px;line-height:18px;padding-top:5px;">

			    							<?php echo $fdomain->compliance_status==""?'<span class="btn btn-sm btn-secondary badge-pill">Not Updated</span>':$fdomain->compliance_status; ?>

			    					</div>
			    					<div class="col-3 text-right">
			    						<?php
			    							echo $this->Html->link('<i class="fa fa-bookmark"></i> Perform Control Assessment',[
			    								'controller'=>'assessments','action'=>'domainMaturityRating',$fdomain->id,$assessment->sub_type
			    							],[
			    								'class'=>'btn btn-sm btn-danger float-right m-b-0',
			    								'escape'=>false,
			    								//'onclick'=>'return false;'
			    							]);
			    						?>
			    					</div>
			    				</div>

						      </h2>
						    </div>

						    <div id="collapseOnefd<?php echo $fdomain->id; ?>" class="collapse" aria-labelledby="headingOnefd<?php echo $fdomain->id; ?>" data-parent="#caccordionExample">
						      <div class="card-body">
						      	<h4>Assessment Factors</h4>
						      	<div class="accordion" id="accordionExamplefd<?php echo $fdomain->id; ?>">
						      		<?php foreach($fdomain->ffiec_assessment_domain_a_factors as $aFactor): ?>
									  <div class="card">
									    <div class="card-header" id="headingOneaf<?php echo $aFactor->id; ?>" style="padding-left:0px;">
									    	<i class="fa fa-caret-down float-right m-t-10 mt-1"></i>
									      <h2 class="mb-0">
									      	<button class="btn btn-link text-primary" type="button" data-toggle="collapse" data-target="#collapseOneaf<?php echo $aFactor->id; ?>" aria-expanded="false" aria-controls="collapseOneaf<?php echo $aFactor->id; ?>">
									          <?php echo $aFactor->name; ?>
									        </button>
									      </h2>
									    </div>

									    <div id="collapseOneaf<?php echo $aFactor->id; ?>" class="collapse" aria-labelledby="headingOneaf<?php echo $aFactor->id; ?>" data-parent="#accordionExamplefd<?php echo $fdomain->id; ?>">
									      <div class="card-body p-0">
									      	<table class="table table-hover mb-0 m-b-0">
									      		<thead>
									      			<tr class="table-active">
									      				<th style="width:60% !important;">Domain Requirement</th>
									      				<th>Artifact</th>
									      				<th>Compliance Status</th>
									      			</tr>
									      		</thead>
									      		<tbody>
									      			<?php foreach($aFactor->ffiec_assessment_domain_requirements as $dStat): ?>
									      				<tr>
									      					<td>
									      						<?php echo $dStat->name; ?>
									      					</td>
									      					<td>
									      						<?php //echo $dStat->artifact; ?>
									      						<button class="btn btn-sm btn-warning showArtifact" <?php echo $dStat->artifact==""?"style='display:none;'":''; ?> type="button" data-file="<?php echo $dStat->artifact; ?>">
						    										Artifact
						    									</button>
									      					</td>
									      					<td><?php echo $dStat->compliance_status; ?></td>
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

	    		</div>
	    	</div>
	    </div>

	<?php elseif($assessment->sub_type=='eGRC'): ?>
		<div class="row">
	    	<div class="col-5">
	    		<div class="card">
	    			<h4 class="m-b-0 p-10 bg-info text-white font-bold">Risk Domains</h4>
	    			<table class="table table-bordered m-b-0 table-hover">
	    				<thead>
	    					<tr>
	    						<th class="text-themecolor">No.</th>
	    						<th class="text-themecolor">Risk Domain</th>
	    						<th class="text-themecolor">
	    							Inherent Risk
	    							<i class="fa fa-info-circle text-info ml-1" data-toggle="modal" data-target='#scalesModal'></i>
	    						</th>
	    						<?php //if($assessment->status=="Completed"): ?>
	    							<th class="text-themecolor">Residual Risk</th>
	    						<?php //endif; ?>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<?php $sr=1; foreach($assessment->egrc_assessment_risks as $risk): ?>
	    						<tr>
	    							<td align="center"><?= $sr++ ?>.</td>
	    							<td>
	    								<?= $risk->name ?>
	    								<i class="fa fa-info-circle text-info ml-1" data-toggle="tooltip" data-placement='right' title="<?php echo $risk->description; ?>"></i>
	    							</td>
	    							<td class="<?= $risk->inherent_scale ?> form-group">
	    								<!--<?= $risk->inherent_scale ?>-->
	    								<select class="form-control input-sm <?= $risk->inherent_scale ?> instantSave" data-table="egrc_assessment_risks" data-id="<?php echo $risk->id; ?>">
	    									<option value="">-Select-</option>
	    									<?php foreach($scales as $scale): ?>
	    										<option <?php echo $scale->severity_scale==$risk->inherent_scale?"selected":""; ?> value="<?php echo $scale->severity_scale; ?>"><?php echo $scale->severity_scale; ?></option>
	    									<?php endforeach; ?>
	    								</select>

	    							</td>
	    							<?php //if($assessment->status=="Completed"): ?>
		    							<td class="residualCell <?= $risk->residual_scale ?>"><?= $risk->residual_scale ?></td>
		    						<?php //endif; ?>
	    						</tr>
	    					<?php endforeach; ?>
	    				</tbody>
	    			</table>
	    		</div>
	    	</div>
	    	<div class="col-7">
	    		<div class="card bg-white" style="border:1px solid #ccc;" id="assessmentControls">

	    			<h4 class="m-b-0 p-10 bg-info text-white font-bold">
	    				<div class="row">
		    				<div class="col-sm-4">
		    					Control Areas
		    				</div>
		    				<div class="col-sm-4">
		    					Compliance Status
		    					<i class="fa fa-info-circle text-white" data-toggle="modal" data-target='#effectivenessModal'></i>
		    				</div>
		    				<div class="col-sm-4">
			    				<?php
				    				echo $this->Html->link('<i class="fa fa-calendar"></i> Update Risk Control Mapping',[
				    					'controller'=>'assessments','action'=>'egrcRcmapping',$assessment->id,$assessment->sub_type
				    				],[
				    					'class'=>'btn btn-warning btn-sm float-right',
				    					'escape'=>false,
				    					'disabled'=>false
				    				]);
				    			?>
			    			</div>
		    			</div>
	    			</h4>
	    			<?php foreach($assessment->egrc_assessment_policies as $control): ?>

	    				<div class="card mb-0">
	    					<h5 class="m-b-0 p-10 bg-light text-dark font-bold" style="border-bottom:1px solid #ccc;">
	    						<div class="row">
	    							<div class="col-sm-4">
	    								<button class="btn m-b-0 collapsed m-l-0 cbtns" style="background-color:transparent;outline:none;box-shadow:none;display:inline-block;text-align:left;" data-toggle="collapse" data-target="#collapse<?= $control->id ?>" aria-expanded="false" aria-controls="collapse<?= $control->id ?>" type="button">
			    							<span class="fa fa-chevron-circle-down"></span>
			    							<?= $control->name ?>
			    						</button>
			    						<?php if(strlen($control->description)>0): ?>
			    						<i class="fa fa-info-circle text-info ml-1" data-toggle="tooltip" data-placement='right' title="<?php echo $control->description; ?>"></i>
			    						<?php endif; ?>
	    							</div>
	    							<div class="col-sm-4">
	    								<span style="font-size:14px;">
			    							<?= empty($control->compliance_status)?"<i class='fa fa-info-circle text-warning' data-toggle='tooltip' title='Not Updated'></i> "."Not Updated yet":"<i class='fa fa-check-circle text-success' data-toggle='tooltip' title='Updated'></i> ".$control->compliance_status ?>
			    						</span>
	    							</div>
	    							<div class="col-sm-4">
	    								<?php
			    							echo $this->Html->link('<i class="fa fa-bookmark"></i> Perform Control & Maturity Assessment',[
			    								'controller'=>'assessments','action'=>'policyMaturityRating',$control->id,$assessment->sub_type
			    							],[
			    								'class'=>'btn btn-sm btn-danger float-right m-b-0',
			    								'escape'=>false,
			    								'disabled'=>true
			    							]);
			    						?>
	    							</div>
	    						</div>
	    					</h5>
	    					<div class="collapse" id="collapse<?= $control->id ?>" data-parent="#assessmentControls">
	    						<table class="table table-bordered table-hover">
	    							<thead>
				    					<tr class="active">
				    						<th class="text-themecolor">Requirement Name</th>
				    						<th class="text-themecolor">Artifact</th>
				    						<th class="text-themecolor">Compliance Status</th>
				    					</tr>
				    				</thead>
				    				<tbody>
				    					<?php foreach($control->egrc_assessment_policy_statements as $creq): ?>
				    						<tr>
				    							<td><?= $creq->name ?></td>
				    							<td style="min-width:160px;">
				    								<button class="btn btn-sm btn-warning showArtifact" <?php echo $creq->artifact==""?"style='display:none;'":''; ?> type="button" data-file="<?php echo $creq->artifact; ?>">
			    										Artifact
			    									</button>
				    							</td>
				    							<td>
				    								<?php echo $creq->compliance_status; ?>
				    							</td>
				    						</tr>
				    					<?php endforeach; ?>
				    				</tbody>
	    						</table>
	    					</div>
	    				</div>

	    			<?php endforeach; ?>
	    		</div>


	    	</div>
	    </div>
	<?php else: ?>
		<center class="mb-2">
			<span class="font-16 text-danger">
				<b>
					<i class="fa fa-info-circle"></i>
					IMPORTANT: Please Update Risk Control Mapping and select appropriate Inherrent Risk before Perform Control and Maturity Rating
				</b>
			</span>
		</center>
		<div class="row">
	    	<div class="col-5">
	    		<div class="card">
	    			<h4 class="m-b-0 p-10 bg-info text-white font-bold">Risk Domains</h4>
	    			<table class="table table-bordered m-b-0 table-hover">
	    				<thead>
	    					<tr>
	    						<th class="text-themecolor">No.</th>
	    						<th class="text-themecolor">Risk Domain</th>
	    						<th class="text-themecolor">
	    							Inherent Risk
	    							<i class="fa fa-info-circle text-info ml-1" data-toggle="modal" data-target='#scalesModal'></i>
	    						</th>
	    						<?php //if($assessment->status=="Completed"): ?>
	    							<th class="text-themecolor">Residual Risk</th>
	    						<?php //endif; ?>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<?php $sr=1; foreach($assessment->assessment_risks as $risk): ?>
	    						<tr>
	    							<td align="center"><?= $sr++ ?>.</td>
	    							<td>
	    								<?= $risk->risk ?>
	    								<i class="fa fa-info-circle text-info ml-1" data-toggle="tooltip" data-placement='right' title="<?php echo $risk->risk_description; ?>"></i>
	    							</td>
	    							<td class="<?= $risk->inherent_scale ?> form-group">
	    								<!--<?= $risk->inherent_scale ?>-->
	    								<select class="form-control input-sm <?= $risk->inherent_scale ?> instantSave" data-table="assessment_risks" data-id="<?php echo $risk->id; ?>">
	    									<option value="">-Select-</option>
	    									<?php foreach($scales as $scale): ?>
	    										<option <?php echo $scale->severity_scale==$risk->inherent_scale?"selected":""; ?> value="<?php echo $scale->severity_scale; ?>"><?php echo $scale->severity_scale; ?></option>
	    									<?php endforeach; ?>
	    								</select>

	    							</td>
	    							<?php //if($assessment->status=="Completed"): ?>
		    							<td class="residualCell <?= $risk->residual_scale ?>"><?= $risk->residual_scale ?></td>
		    						<?php //endif; ?>
	    						</tr>
	    					<?php endforeach; ?>
	    				</tbody>
	    			</table>
	    		</div>
	    	</div>
	    	<div class="col-7">
	    		<div class="card bg-white" style="border:1px solid #ccc;" id="assessmentControls">

	    			<h4 class="m-b-0 p-10 bg-info text-white font-bold">
	    				<div class="row">
		    				<div class="col-sm-4">
		    					Control Areas
		    				</div>
		    				<div class="col-sm-4">
		    					Compliance Status
		    					<i class="fa fa-info-circle text-white" data-toggle="modal" data-target='#effectivenessModal'></i>
		    				</div>
		    				<div class="col-sm-4">
			    				<?php
				    				echo $this->Html->link('<i class="fa fa-calendar"></i> Update Risk Control Mapping',[
				    					'controller'=>'assessments','action'=>'rcmapping',$assessment->id,$assessment->sub_type
				    				],[
				    					'class'=>'btn btn-danger btn-sm float-right',
				    					'escape'=>false
				    				]);
				    			?>
			    			</div>
		    			</div>
	    			</h4>
	    			<?php foreach($assessment->assessment_controls as $control): ?>

	    				<div class="card mb-0">
	    					<h5 class="m-b-0 p-10 bg-light text-dark font-bold" style="border-bottom:1px solid #ccc;">
	    						<div class="row">
	    							<div class="col-sm-4">
	    								<button class="btn m-b-0 collapsed m-l-0 cbtns" style="background-color:transparent;outline:none;box-shadow:none;display:inline-block;text-align:left;" data-toggle="collapse" data-target="#collapse<?= $control->id ?>" aria-expanded="false" aria-controls="collapse<?= $control->id ?>" type="button">
			    							<span class="fa fa-chevron-circle-down"></span>
			    							<?= $control->name ?>
			    						</button>
			    						<?php if(strlen($control->description)>0): ?>
			    						<i class="fa fa-info-circle text-info ml-1" data-toggle="tooltip" data-placement='right' title="<?php echo $control->description; ?>"></i>
			    						<?php endif; ?>
	    							</div>
	    							<div class="col-sm-4">
	    								<span style="font-size:14px;">
			    							<?= empty($control->compliance_status)?"<i class='fa fa-info-circle text-warning' data-toggle='tooltip' title='Not Updated'></i> "."Not Updated yet":"<i class='fa fa-check-circle text-success' data-toggle='tooltip' title='Updated'></i> ".$control->compliance_status ?>
			    						</span>
	    							</div>
	    							<div class="col-sm-4">
	    								<?php
			    							echo $this->Html->link('<i class="fa fa-bookmark"></i> Perform Control & Maturity Assessment',[
			    								'controller'=>'assessments','action'=>'controlMaturityRating',$control->id,$assessment->sub_type
			    							],[
			    								'class'=>'btn btn-sm btn-danger float-right m-b-0',
			    								'escape'=>false
			    							]);
			    						?>
	    							</div>
	    						</div>
	    					</h5>
	    					<div class="collapse" id="collapse<?= $control->id ?>" data-parent="#assessmentControls">
	    						<table class="table table-bordered table-hover">
	    							<thead>
				    					<tr class="active">
				    						<th class="text-themecolor">Requirement Name</th>
				    						<th class="text-themecolor">Artifact</th>
				    						<th class="text-themecolor">Compliance Status</th>
				    					</tr>
				    				</thead>
				    				<tbody>
				    					<?php foreach($control->assessment_control_requirements as $creq): ?>
				    						<tr>
				    							<td><?= $creq->name ?></td>
				    							<td style="min-width:160px;">
				    								<button class="btn btn-sm btn-warning showArtifact" <?php echo $creq->artifact==""?"style='display:none;'":''; ?> type="button" data-file="<?php echo $creq->artifact; ?>">
			    										Artifact
			    									</button>
				    							</td>
				    							<td>
				    								<?php echo $creq->compliance_status; ?>
				    							</td>
				    						</tr>
				    					<?php endforeach; ?>
				    				</tbody>
	    						</table>
	    					</div>
	    				</div>

	    			<?php endforeach; ?>
	    		</div>


	    	</div>
	    </div>
	<?php endif; ?>
	<div class="text-right pt-3">
		<?php if($assessment->status!='Completed'): ?>
				<?php if($assessment->status=='In Progress'): ?>
				  	<?php
				  		echo $this->Form->postLink('Mark Assessment as Review / Draft',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Review or Draft'),'confirm'=>'Are you sure to mark this assignment as "Review or Draft"','class'=>'btn btn-warning'));
				  	?>
			  	<?php elseif($assessment->status=='Review or Draft'): ?>
				  	<?php
				  		echo $this->Form->postLink('Mask Assessment as Accepted',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Accepted'),'confirm'=>'Are you sure to mark this assignment as "Accepted"','class'=>'btn btn-primary'));
				  	?>
				<?php elseif($assessment->status=='Accepted'): ?>
					<?php
						echo $this->Form->postLink('Mark Assessments as Completed',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Completed'),'confirm'=>'Are you sure to mark this assignment as completed','class'=>'btn btn-success'));
					?>
				<?php elseif($assessment->status=='Rejected Pending Updates'): ?>
					<?php
				  		echo $this->Form->postLink('Mark Assessment as Review / Draft',array('action'=>'toggleStatus'),array('data'=>array('id'=>$assessment->id,'status'=>'Review or Draft'),'confirm'=>'Are you sure to mark this assignment as "Review or Draft"','class'=>'btn btn-warning'));
				  	?>

				<?php endif; ?>
			<?php endif ?>
	</div>
</div>

<br>
<br>

<?php if($assessment->sub_type=='FFIEC Regulated'): ?>
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
	    	 	<?php foreach($fRisks as $fk=>$frisk): ?>

    	 			<?php foreach($frisk->ffiec_risk_factors as $frk=>$fRiskFactor): ?>
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


<!--artifact Modal-->
<div class="modal fade" id="artifactModal" tabindex="-1" role="dialog" aria-labelledby="artifactModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Artifact File</h5>
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



<!--assessmetn status Modal-->
<div class="modal fade" id="statusesModal" tabindex="-1" role="dialog" aria-labelledby="statusesModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assessment Statuses (Stages)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <table class="table table-bordered table-striped m-0">
        	<thead>
        		<tr class="bg-info">
        			<th class="text-white">Date</th>
        			<th class="text-white">Status</th>
        			<th class="text-white">Log</th>
        			<th class="text-white">Updated By</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php
        			 $myStatuses =  array_column($assessment->assessment_statuses,"created");
					 array_multisort($myStatuses,SORT_DESC,$assessment->assessment_statuses);
        			 foreach($assessment->assessment_statuses as $aStatus): ?>
        			<tr>
        				<td><?php echo date('d-M-Y H:i:s',strtotime($aStatus->created)); ?></td>
        				<td><?php echo $aStatus->status; ?></td>
        				<td><?php echo $aStatus->status_log; ?></td>
        				<td><?php echo $aStatus->user->first_name." ".$aStatus->user->last_name; ?></td>
        			</tr>
        		<?php endforeach; ?>
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--assessment status modal ends-->

<!--FFIEC Maturity Target Info Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="fTargetModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FFIEC Maturity Target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center text-info">
        	The FFIEC targetsshown is the minimum maturity target as required by your inherent risk assessment;
        	this loads the appropriate controls required, you may change this desired level to a level higher
        	based on the FFIEC Risk Profile and Cybersecurity Maturity Levels Table below:

        </p>
        <?php echo $this->Html->image('ffiec-chart.png',['width'=>'100%']) ?>
      </div>

    </div>
  </div>
</div>

<script>
	var rproto = "<?php echo $uProto; ?>";
	var saving='<span class="bg-info badge"><i class="fa fa-spinner fa-spin"></i><span class="blinking">Saving</span></span>';
	var saved='<span class="bg-success badge"><i class="fa fa-check"></i><span>Saved</span></span>';
	var notSaved='<span class="bg-danger badge"><i class="fa fa-check"></i><span>Not Saved</span></span>';
	$(function(){





		$(document).on('click','.showArtifact',function(){
			artifact = $(this).attr('data-file');
			if(artifact){
				$('#artifactFrame').prop('src',artifact);
				$('#artifactModal').modal('show');
			}

		});
		$('#artifactModal').on('hidden.bs.modal', function (e) {
		  $('#artifactFrame').prop('src',"");
		})

		<?php if($assessment->status!='Completed'): ?>

			//flor ffiec regulated assessments
			$(document).on('change','.instantSaveFactor',function(){
				var field = $(this);
				var parent = field.parents('td');
				var iBadge = field.parents('.riskCard').find('.btn.inherent');
				//console.log(iBadge.html());
				parent.find('.badge').remove();
				if(field.val()){


					postData = {
						id:field.attr('data-id'),
						value:field.val()
					};


					//console.log(postData);
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'saveInstantFactor'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.ajax({
						url : thisUrl,
						method : "POST",
						headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},

						data : postData,
						beforeSend:function(){
							parent.append(saving);
							field.prop('disabled',true);
						},
						success:function(resp){
							//console.log(resp);
							//return;
							parent.find('.badge').remove();
							var fieldClass = field.val();
							//fieldClass = fieldClass.indexOf('2~');
							fieldClass =  fieldClass.substring(2,fieldClass.length);
							console.log()
							if(resp==1){
								parent.append(saved);
								field.attr('class','');
								field.addClass(fieldClass).addClass('form-control instantSaveFactor').trigger('blur');
								parent.attr('class','');
								parent.addClass(fieldClass).addClass('form-group');

								field.find('option[value=""]').remove();
								//console.log(emptyOption);

							} else {

								var res = resp.indexOf('2~');
								if(res==0){
									var rscale = resp.substring(2,resp.length);
									parent.append(saved);
									field.attr('class','');
									field.addClass(fieldClass).addClass('form-control instantSaveFactor').trigger('blur');
									parent.attr('class','');
									parent.addClass(fieldClass).addClass('form-group');
									iBadge.attr('class','btn btn-sm btn-secondary inherent badge-pill');
									iBadge.html(rscale).addClass(rscale);

									field.find('option[value=""]').remove();
									//console.log(emptyOption);
								} else {
									parent.append(notSaved);
									field.trigger('blur');
								}


							}

							field.prop('disabled',false);
						}
					});


				}

			});

			//for regulated/generalized/other assessmments
			$(document).on('change','.instantSave',function(){
				var field = $(this);
				var parent = field.parents('td');
				parent.find('.badge').remove();
				if(field.val()){


					postData = {
						table:field.attr('data-table'),
						id:field.attr('data-id'),
						value:field.val()
					};
					console.log(postData);

					//console.log(postData);
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'saveInstantUpdate'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.ajax({
						url : thisUrl,
						method : "POST",
						headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},

						data : postData,
						beforeSend:function(){
							parent.append(saving);
							field.prop('disabled',true);

						},
						success:function(resp){
							//console.log(resp);

							parent.find('.badge').remove();
							if(resp==1){
								parent.append(saved);
								field.attr('class','');
								field.addClass(field.val()).addClass('form-control instantSave input-sm').trigger('blur');
								parent.attr('class','');
								parent.addClass(field.val()).addClass('form-group');

							} else {

								var res = resp.indexOf('1~');
								if((field.attr('data-table')=='assessment_risks' || field.attr('data-table')=='egrc_assessment_risks') && res==0){
									parent.append(saved);
									field.attr('class','');
									field.addClass(field.val()).addClass('form-control instantSave input-sm').trigger('blur');
									parent.attr('class','');
									parent.addClass(field.val()).addClass('form-group');

									var rscale = resp.substring(2,resp.length);
									if(rscale!="- NA -"){
										parent.siblings('.residualCell').prop('class','residualCell '+rscale).html(rscale);
									} else {
										parent.siblings('.residualCell').prop('class','residualCell').html(rscale);
									}

								} else {
									parent.append(notSaved);
									field.trigger('blur');
								}

							}

							field.prop('disabled',false);
						}
					});


				}

			});

			var ref;
			$(document).on('focus','.instantSaveRef',function(){
				ref = $(this).val();
				console.log("focused");
			});
			$(document).on('blur','.instantSaveRef',function(){
				var field = $(this);
				var parent = field.parents('td');
				parent.find('.badge').remove();
				if(field.val()){


					postData = {
						table:field.attr('data-table'),
						id:field.attr('data-id'),
						value:field.val()
					};


					if(ref!=field.val()){
						var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'saveInstantUpdate'),true); ?>";
						thisUrl = thisUrl.replace("http:", rproto);
						$.ajax({
							url : thisUrl,
							method : "POST",
							headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},

							data : postData,
							beforeSend:function(){
								parent.append(saving);
							},
							success:function(resp){
								console.log(resp);
								parent.find('.badge').remove();
								if(resp==1){
									parent.append(saved);

								} else {
									parent.append(notSaved);

								}
							}
						});
					}



				}

			});

			//handling artifact file upload.
			$(document).on('change','.artifact',function(){
				//removing error message if present
				$(this).parent('td').find('.falert').remove();
				finput=$(this);
				var acrid = finput.attr('data-id');
				var file = $(this).get(0).files[0];
				var name = file.name;
				//console.log(file);

				var form_data = new FormData();
				form_data.append("id",acrid);
				form_data.append("afile", file);

				//console.log(form_data);
				var ext = name.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext, ['pdf']) == -1){
					$('<span class="falert alert-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
					$(this).val('');
				} else {
					//console.log(file);
					finput.parent('td').find('.falert').remove();
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'uploadArtifactFromAdmin'),true); ?>";
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
							//return;
							finput.parent('td').find('.artifactUploaded').val('');
							if(data==3){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
								finput.val('');
							} else if(data==4){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> No file provided.</span>').insertAfter(finput);
								finput.val('');
							} else if(data==0){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Sorry! Try again.</span>').insertAfter(finput);
								finput.val('');
							} else if(data.indexOf("http")>-1){
								//finput.parent('td').find('.artifactUploaded').val(data);
								//finput.prop('type','hidden');
								//finput.prop('required',false);
								finput.parent('td').find('.falert').remove();
								finput.parent('td').find('.showArtifact').remove();
								$('<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="'+data+'">Artifact</button>').insertBefore(finput);
								$('<span class="falert badge bg-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div> <span class="badge sr-only bg-warning text-white reUploadArtifact pointer"><i class="fa fa-redo"></i> Re-upload</span> </span>').insertAfter(finput);
								finput.val('');
							} else {
								finput.parent('td').find('.falert').remove();
								$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Sorry! Something went wrong. Try again.</span>').insertAfter(finput);
								finput.val('');
							}
						}
					});

				}
			});
			//reuploading artifact
			$(document).on('click','.reUploadArtifact',function(){
				var parent = $(this).parents('td');
				//parent.find('.artifactUploaded').val('');
				parent.find('.artifact').prop('type','file');
				parent.find('.falert').remove();
				parent.find('.artifact').trigger('click');
			});

			//articact file upload ends

			setInterval(function(){
				$('.badge').fadeOut('slow');
			},5000);
		<?php else: ?>
			$('.reUploadArtifact').remove();
			$('.instantSaveRef').prop('disabled',true);
			$('.form-control').prop('disabled',true);
		<?php endif; ?>


		$(document).on('click','.showResult',function(){
			aid = $(this).attr('data-aid');
			st = $(this).attr('data-subtype');

			var win = window.open("<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'viewResult'),true); ?>/"+aid+"/"+st,"Assessment Results","width=1200,height=550,left=0,top=0");
			win.resizeTo(1250,550);
		});

	});
</script>
<script>
	var rproto2 = "<?php echo $uProto; ?>";

	$(function(){
		var rproto2 = "<?php echo $uProto; ?>";
		var ascore = <?php echo round($avgInherentScore/count($assessment->ffiec_assessment_risks),2); ?>;
		var maturityScales = {'Minor':['Baseline','Evolving'],'Minimum':['Baseline','Evolving'],'Moderate':['Baseline','Evolving','Intermediate'],'Significant':['Evolving','Intermediate','Advanced'],'Major':['Intermediate','Advanced','Innovation'],'Extreme':['Advanced','Innovation']};


		var thisUrl2 = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRiskScaleByScore2'),true); ?>";
		thisUrl2 = thisUrl2.replace("http:", rproto2);

		$.ajax({
			url : thisUrl2+"/"+ascore,
			method : "POST",
			headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},
			data : {},
			beforeSend:function(){

			},
			success:function(resp){
				var matOptions = maturityScales[resp];
  				mtOptions = ``;
  				for(ab=0;ab<matOptions.length;ab++){
  					mtOptions +=`<option class="my-2 py-2" value="`+matOptions[ab]+`">`+matOptions[ab]+`</option>`;
  				}
  				$(document).find('.fcTargetBtnDropdown').html(mtOptions);
				sel = $(document).find('.fcTargetBtnDropdown');
				$(document).find('span.overall').html(`<span class="btn btn-sm btn-secondary badge-pill `+resp+`" style="width:100px;">`+resp+`</span>`);
				sel.each(function(){
					$(this).val($(this).data('default'));
				});
			},
			error:function(){

			}
		});

		var prevMoption = "";
		$(document).find('.fcTargetBtnDropdown').on('focus',function(){
			prevMoption = $(this).val();
		}).on('change',function(){
			var sbox = $(this);
			var loader = sbox.siblings('.fcLoader');
			var controlId = sbox.data('id');
			var mlevel = sbox.val();
			var thisUrl2 = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'updateFfiecControlFactor'),true); ?>";
			thisUrl2 = thisUrl2.replace("http:", rproto2);

			$.ajax({
				url : thisUrl2,
				method : "POST",
				headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},
				data : {controlId:controlId,mlevel:mlevel},
				beforeSend:function(){
					loader.fadeIn();
				},
				success:function(resp){
					if(resp==0){
						swal({
						  title: "Sorry! Not updated. Try again.",
						  text: "THE CLOUD CISO",
						  icon: "warning",
						 // buttons: true,
						  dangerMode: true,
						});
						sbox.val(prevMoption);
					} else {
						$('#collapseOnefd'+controlId).html(resp);
					}

					loader.fadeOut();
				},
				error:function(){
					swal({
					  title: "Sorry! Not updated. Try again.",
					  text: "THE CLOUD CISO",
					  icon: "warning",
					  //buttons: true,
					  dangerMode: true,
					});
					sbox.val(prevMoption);
					loader.fadeOut();
				}
			});

		});


	});
</script>