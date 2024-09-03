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