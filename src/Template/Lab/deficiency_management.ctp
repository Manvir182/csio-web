<style>
	svg > g > g:last-child { pointer-events: none }
	.form-control {
		box-shadow:none !important;
	}
	textarea.form-control {
		max-height:300px;
	}
	.table td,
	td,th
	 {
		box-sizing:border-box !important;
	}

	/*Scrollbar Style*/
	/* width */
	::-webkit-scrollbar {
	  width: 8px;
	  height:8px;
	}

	/* Track */
	::-webkit-scrollbar-track {
	  /*box-shadow: inset 0 0 5px grey; */
	  border-radius: 20px;
	}

	/* Handle */
	::-webkit-scrollbar-thumb {
	  background: rgba(0,0,0,0.2);/*#00232E; */
	  border-radius: 20px;
	}

	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
	  background: #00232E;
	  cursor:pointer;
	}

	/* Custom Css */
	.table-sticky-header td{
		position: sticky;
		top: 0;
		border-color:#ccc;
	}

	.custom-checkbox * {
		cursor:pointer;
	}



	/*
	@media (min-width: 1200px) {
	  .One {
	  	width:64px !important;
	  	font-size:12px;
	  }
	  .Two {width:89px !important;}
	  .Three {width:126px !important;}
	  .Four {width:136px !important;}
	  .Five {width:124px !important;}
	  .Six {width:95px !important;}
	  .Seven {width:136px !important;}
	  .Eight {width:127px !important;}
	  .Nine {width:81px !important;}
	  .Ten {width:133px !important;}
	  .Eleven {width:92px !important;}

	}

	@media (min-width: 1300px) {
	  .One {
	  	width:65px !important;
	  	font-size:12px;
	  }
	  .Two {width:82px !important;font-size:11px;}
	  .Three {width:143px !important;}
	  .Four {width:152px !important;}
	  .Five {width:125px !important;}
	  .Six {width:103px !important;}
	  .Seven {width:149px !important;}
	  .Eight {width:131px !important;}
	  .Nine {width:86px !important;}
	  .Ten {width:144px !important;}
	  .Eleven {width:103px !important;}

	}

	@media (min-width: 1700px) {
	  .One {
	  	width:88px !important;
	  }
	  .Two {width:101px !important;}
	  .Three {width:250px !important;}
	  .Four {width:250px !important;}
	  .Five {width:126px !important;}
	  .Six {width:150px !important;}
	  .Seven {width:228px !important;}
	  .Eight {width:161px !important;}
	  .Nine {width:115px !important;}
	  .Ten {width:212px !important;}
	  .Eleven {width:170px !important;}

	}
	*/

	 .One {
	  	width:88px !important;
	  }
	  .Two {width:101px !important;}
	  .Three {max-width:300px !important;}
	  .Four {max-width:300px !important;}
	  .Five {width:126px !important;}
	  .Six {width:150px !important;}
	  .Seven {max-width:300px !important;}
	  .Eight {width:161px !important;}
	  .Nine {width:200px !important;}
	  .Ten {width:212px !important;}
	  .Eleven {width:170px !important;}

	@media (max-width: 1300px){
		.sticky-table{
			min-width: 130%;
		}
	}


</style>
<div class="main-content" style="font-size:18px;">
	<div class="container-fluid">
		<div class="row ">
			<div class="col-md-12">

				<div class="c_b-lr">
					<h5 class="cl_abt text-center" style="text-transform: none;">eGRC TOOLS</h5>
					<br>
					<?php echo $this->element('egrcNav'); ?>
					<hr>
				</div>
			</div>
		</div>
	 </div>
	 <h5 class="cl_abt text-center" style="text-transform: none;"><?php echo $company->company_name; ?></h5>
	 <h4 class="text-center" style="text-transform: none;">
	 	Remediation Tracking, Planning and Management
	 </h4>
	 <p align="center" class='text-danger'>
	 	These findings are a result of assessing your policies and standards.
	 </p>
	 <div class="container-fluid">
	 	<div class="row">
	 		<div class="col-4">
	 			<br>
	 			<table class="table table-bordered font-16">
	 				<thead>
	 					<tr>
	 						<th colspan="2">
	 							<?php echo $company->company_name; ?> Remedation Management Snapshot
	 						</th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<tr>
	 						<th>Outstanding Issues</th>
	 						<td><?php echo $stats['outstanding']['pc']; ?></td>
	 					</tr>
	 					<tr>
	 						<th>Issues on Track</th>
	 						<td><?php echo $stats['ontrack']['pc']; ?></td>
	 					</tr>
	 					<tr>
	 						<th>Most Affected Policy/Standard</th>
	 						<td>
	 							<?php if($stats['affected_policy']==0): ?>
	 								No Data Available
	 							<?php else: ?>
	 								<?php echo $stats['affected_policy']['affected_policy']; ?>
		 							<span class="bg-secondary text-white" style="display:inline-block;line-height:14px;font-size:14px;padding:3px;border-radius:3px;">
		 								<?php echo $stats['affected_policy']['ccount']; ?> Issues
		 							</span>
	 							<?php endif; ?>

	 						</td>
	 					</tr>
	 					<tr>
	 						<th>Ratio of High Risk Issues</th>
	 						<td><?php echo $stats['highrisk']; ?></td>
	 					</tr>
	 					<tr>
	 						<th>Number of Remediation Issues in past 6 months</th>
	 						<td>
	 							<?php echo $stats['pastSixMonths']['pc']; ?>
	 						</td>
	 					</tr>
	 				</tbody>
	 			</table>

	 		</div>
	 		<div class="col-4">
	 			<center>
	 				<b>Risk Exposure Chart</b>
	 			</center>
	 			<div id="piechart" style="height:350px;"></div>
	 		</div>
	 		<div class="col-4">
	 			<center>
	 				<b>Remediation Tracking Chart</b>
	 			</center>
	 			<div id="remTrackingChart" style="height:350px;"></div>
	 		</div>
	 		<div class="clearfix"></div>
	 		<div class="col-8 form-inline">
              	<?php echo $this->Form->create($search,['id'=>'searchForm']);
              		$this->Form->setTemplates([
					    'inputContainer' => '{{content}}',
					]);
              	?>
              	<div class="form-group">
              		<div class="input-group mb-3 mt-3">
              			<div class="input-group-prepend">
              				<span class="input-group-text bg-primary text-white">SEARCH</span>
              			</div>

              			<?php
              				echo $this->Form->control('stype',[
              					'type'=>'select',
              					'class'=>'form-control stype',
              					'empty'=>[''=>'--Select--'],
              					'options'=>['created'=>'Date Identified','affected_policy'=>'Affected Policy/Standard','issue_id'=>'Issue ID','status'=>'Status','owner_name'=>'Owner','risk_ranking'=>'Risk Ranking'],
              					'required'=>true,
              					'label'=>false
              				]);
							echo $this->Form->control('stext',[
								'type'=>'search',
								'class'=>'form-control stext',
								'required'=>true,
								'label'=>false,
								'placeholder'=>'Enter Text'
							]);
							echo $this->Form->control('stext2',[
								'type'=>'search',
								'class'=>'form-control stext2',
								'required'=>false,
								'label'=>false,
								'placeholder'=>'Enter Text'
							]);
							echo $this->Form->control('stext',[
								'type'=>'search',
								'class'=>'form-control riskRanking',
								'required'=>true,
								'label'=>false,
								'type'=>'select',
								'empty'=>[''=>''],
								'options'=>['Minor'=>'Minor','Moderate'=>'Moderate','Significant'=>'Significant','Major'=>'Major','Extreme'=>'Extreme']
							]);
							echo $this->Form->control('stext',[
								'type'=>'search',
								'class'=>'form-control statuses',
								'required'=>true,
								'label'=>false,
								'type'=>'select',
								'empty'=>[''=>''],
								'options'=>['On Track'=>'On Track','Delayed'=>'Delayed','Remediated'=>'Remediated']
							]);
              			?>

					  <div class="input-group-append sbtn">
					    <button class="btn btn-primary" type="submit" id="button-addon2"><i class='fa fa-search'></i></button>
					  </div>
					</div>
              	</div>
              	<?php echo $this->Form->end(); ?>

              </div>
             <div class="col-4">
             	<div class="text-right">
	             	<div class="mt-4">
	             		<div class="btn-group keepOpen">
						  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  	Show/Hide Columns
						  </button>
						  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importModal" > Import Data </button>

						  <div class="dropdown-menu dropdown-menu-right bg-light text-primary">
						  	<form class="" onsubmit="return false;">


							    <div class="form-group p-10">
							    	<div class="custom-control custom-checkbox">
									  <input type="checkbox" checked class="custom-control-input showHide" id="col_4">
									  <label class="custom-control-label" for="col_4">Detailed Description</label>
									</div>
							    </div>
							    <div class="form-group p-10">
							    	<div class="custom-control custom-checkbox">
									  <input type="checkbox" checked class="custom-control-input showHide" id="col_5">
									  <label class="custom-control-label" for="col_5">Affected Policy/ Standard</label>
									</div>
							    </div>
							    <div class="form-group p-10">
							    	<div class="custom-control custom-checkbox">
									  <input type="checkbox" checked class="custom-control-input showHide" id="col_6">
									  <label class="custom-control-label" for="col_6">Risk Ranking</label>
									</div>
							    </div>
							    <div class="dropdown-divider"></div>
							    <div class="form-group p-10">
							    	<div class="custom-control custom-checkbox">
									  <input type="checkbox" checked class="custom-control-input showHide" id="col_7">
									  <label class="custom-control-label" for="col_7">Remediation Plan</label>
									</div>
							    </div>
							    <div class="form-group p-10">
							    	<div class="custom-control custom-checkbox">
									  <input type="checkbox" checked class="custom-control-input showHide" id="col_8">
									  <label class="custom-control-label" for="col_8">Compensating Controls</label>
									</div>
							    </div>

							</form>
						  </div>
						</div>
	             	</div>
				</div>
             </div>
	 		<div class="col-12">
				<!-- Display validation errors, if any -->
				<?= $this->Flash->render() ?>

	 			<div style="max-height:600px;overflow-y:scroll;border-bottom:1px solid #eee;">
	 			<table class="table table-bordered table-hover font-14 m-0 sticky-table" style="position: relative;">
	 				<thead class="table-sticky-header">
		 					<tr class="table-primary">

		 						<td class="One">Issue ID</td>
		 						<td class="Two">Date<br>Identified</td>
		 						<td class="Three">Summary</td>

		 						<td class="Four">
		 							<i class="fa fa-info-circle float-right" data-toggle='tooltip' data-placement="top" title="Please provide additional detailed information about the issue"></i>
		 							Detailed<br>Description
		 						</td>

		 						<td class="Five">Affected Policy/Standard</td>
		 						<td class="Six">
		 							<i class="fa fa-info-circle float-right" data-toggle="modal" data-target="#scalesModal"></i>
		 							Risk<br>Ranking
		 						</td>
		 						<td class="Seven">Remediation<br>Plan</td>
		 						<td class="Eight">Compensating<br>Controls</td>
		 						<td class="Nine">Owner</td>
		 						<td class="Ten">Entity Name</td>
		 						<td class="Eleven">Remediation<br>Date</td>
		 						<td class="Twelve">Status</td>
		 					</tr>
		 				</thead>
	 				<tbody>
	 					<?php
 							$remdStatusColor=[
 								'On Track'=>'#ff9900',
 								'Delayed'=>'#ff0000',
 								'Remediated'=>'#008000',
 								''=>'#333'
 							];
 						?>
 						<?php if(count($remds)==0): ?>
 							<tr class="table-info text-center">
 								<td colspan="12">
 									No Data Available
 								</td>
 							</tr>
 						<?php endif; ?>
	 					<?php foreach($remds as $remd): ?>
	 						<?php if($remd->status!='Remediated'): ?>

			 					<tr id="remdRow<?php echo $remd->id; ?>" data-id="<?php echo $remd->id; ?>">

			 						<td class="One">
			 							<?php echo $remd->issue_id; ?>
			 						</td>
			 						<td class="Two">
			 							<?php echo date('Y/m/d',strtotime($remd->created)); ?>
			 						</td>
			 						<td class="Three">
			 							<?php echo $remd->summary; ?>
			 						</td>

			 						<td class="Four" class="p-0">
			 							<textarea class="form-control border-0 bg-transparent font-14 detailed_description" rows="5" style="color:#333;" placeholder="Type here..."><?php echo $remd->detailed_description; ?></textarea>
			 						</td>

			 						<td class="Five"><?php echo $remd->affected_policy; ?></td>
			 						<td class="Six">
			 							<select class="form-control bg-transparent font-14 risk_ranking" style="color:#333;">
			 								<option <?php echo $remd->risk_ranking==''?'selected':''; ?> value="">- Select -</option>
			 								<option <?php echo $remd->risk_ranking=='Minor'?'selected':''; ?> value="Minor">Minor</option>
			 								<option <?php echo $remd->risk_ranking=='Moderate'?'selected':''; ?> value="Moderate">Moderate</option>
			 								<option <?php echo $remd->risk_ranking=='Significant'?'selected':''; ?> value="Significant">Significant</option>
			 								<option <?php echo $remd->risk_ranking=='Major'?'selected':''; ?> value="Major">Major</option>
			 								<option <?php echo $remd->risk_ranking=='Extreme'?'selected':''; ?> value="Extreme">Extreme</option>
			 							</select>
			 						</td>

			 						<td class="Seven" class="p-0">
			 							<textarea class="form-control border-0 bg-transparent font-14 remediation_plan" rows="5" style="color:#333;" placeholder="Type here..."><?php echo $remd->remediation_plan; ?></textarea>
			 						</td>

			 						<td class="Eight" class="p-0">
			 							<textarea class="form-control border-0 bg-transparent font-14 compensating_controls" rows="5" style="color:#333;" placeholder="Type here..."><?php echo $remd->compensating_controls; ?></textarea>
			 						</td>
			 						<td class="Nine" class="p-0">
			 							<textarea class="form-control bg-transparent owner_name" placeholder="Name" style="color:#333;"><?php echo $remd->owner_name; ?></textarea>
			 							<textarea class="form-control bg-transparent owner_department" placeholder="Department" style="color:#333;"><?php echo $remd->owner_department; ?></textarea>
			 						</td>
									 <td class="Ten" class="p-0">
			 							<textarea class="form-control bg-transparent entity_name" placeholder="Entity Name" style="color:#333;"><?php echo $remd->entity_name; ?></textarea>
			 						</td>
			 						<td class="Eleven">
			 							<input type="date" min="<?php echo date('Y-m-d',strtotime($remd->created)); ?>" class="form-control remediation_date" style="color:#333;width:95%;margin:0px;" value="<?php echo empty($remd->remediation_date)?"":date('Y-m-d',strtotime($remd->remediation_date)); ?>">
			 						</td>

			 						<td class="Twelve" class="statusCell">
			 							<?php
			 								$delayed = "";
											$color = $remdStatusColor[$remd->status];
			 								if($remd->status=="" && !empty($remd->remediation_date)){
			 									if(date('d-m-y',strtotime($remd->remediation_date)) < date('d-m-y')){
			 										$delayed = "selected";
													$color = $remdStatusColor['Delayed'];
			 									}
			 								}
			 							?>
			 							<select class='form-control font-14 status' style="color:<?php echo $color; ?>;">
			 								<option value="">- Select -</option>
			 								<option <?php echo $remd->status=='On Track'?'selected':''; ?> value="On Track">On Track</option>
			 								<option <?php echo $delayed; ?> <?php echo $remd->status=='Delayed'?'selected':''; ?> value="Delayed">Delayed</option>
			 								<option <?php echo $remd->status=='Remediated'?'selected':''; ?> value="Remediated">Remediated</option>
			 							</select>

				 							<div class="pt-4 text-right">
				 								<button type="button" class="btn btn-sm btn-secondary updateBtn" data-id="#remdRow<?php echo $remd->id; ?>">
				 									Update
				 								</button>
				 							</div>

			 						</td>
			 					</tr>

			 					<tr id="remdRow<?php echo $remd->id; ?>Row" style="display:none;">
			 						<td></td>
			 						<td></td>
			 						<td colspan="5">
			 							<label class="control-label">
				 							<i class="fa fa-info-circle float-right" data-toggle='tooltip' data-placement="top" title="Please provide additional detailed information about the issue"></i>
			 								Detailed Description
			 							</label>
			 							<textarea class="form-control border-0 bg-transparent font-14 detailed_description" rows="5" style="color:#333;" placeholder="Type here..."><?php echo $remd->detailed_description; ?></textarea>

			 						</td>
			 						<td colspan="5">
			 							<label class="control-label">
			 								Remediation Plan
			 							</label>
			 							<textarea class="form-control border-0 bg-transparent font-14 remediation_plan" rows="5" style="color:#333;" placeholder="Type here..."><?php echo $remd->remediation_plan; ?></textarea>
			 						</td>

			 					</tr>
			 				<?php else: ?>
			 					<tr id="remdRow<?php echo $remd->id; ?>" data-id="<?php echo $remd->id; ?>">

			 						<td class="One">
			 							<?php echo $remd->issue_id; ?>
			 						</td>
			 						<td class="Two">
			 							<?php echo date('Y/m/d',strtotime($remd->created)); ?>
			 						</td>
			 						<td class="Three">

			 								<?php echo $remd->summary; ?>

			 						</td>

			 						<td class="Four">

			 								<?php echo $remd->detailed_description; ?>

			 						</td>

			 						<td class="Five"><?php echo $remd->affected_policy; ?></td>
			 						<td class="Six">
			 							<?php echo $remd->risk_ranking; ?>
			 						</td>
			 						<td class="Seven">
			 							<?php echo $remd->remediation_plan; ?>
			 						</td>

			 						<td class="Eight">
			 							<?php echo $remd->compensating_controls; ?>
			 						</td>

			 						<td class="Nine">
			 							<?php echo $remd->owner_name; ?>
			 							<?php if(!empty($remd->owner_department)): ?>
				 							<br>
				 							(<?php echo $remd->owner_department; ?>)
			 							<?php endif; ?>
			 						</td>
									 <td class="Ten">
			 							<?php echo $remd->entity_name; ?>
			 						</td>

			 						<td class="Eleven">
			 							<?php echo date('Y/m/d',strtotime($remd->remediation_date)); ?>
			 						</td>

			 						<td class="Twelve" class="statusCell">
			 							<?php
			 								$color = $remdStatusColor[$remd->status];
			 								if($remd->status=="" && !empty($remd->remediation_date)){
			 									if(date('d-m-y',strtotime($remd->remediation_date)) < date('d-m-y')){
			 										$color = $remdStatusColor['Delayed'];
			 									}
			 								}
			 							?>
			 							<span style="color:<?php echo $color; ?>;">
			 								<?php echo $remd->status; ?>
			 							</span>


			 						</td>
			 					</tr>
			 					<tr id="remdRow<?php echo $remd->id; ?>Row" style="display:none;">
			 						<td></td>
			 						<td></td>
			 						<td colspan="5">
			 							<label class="control-label">
				 							<i class="fa fa-info-circle float-right" data-toggle='tooltip' data-placement="top" title="Please provide additional detailed information about the issue"></i>
			 								Detailed Description
			 							</label>
			 							<?php echo $remd->detailed_description; ?>
			 						</td>
			 						<td colspan="5">
			 							<label class="control-label">
			 								Remediation Plan
			 							</label>
			 							<?php echo $remd->remediation_plan; ?>
			 						</td>

			 					</tr>
			 				<?php endif; ?>
	 					<?php endforeach; ?>

	 				</tbody>
	 			</table>
	 			</div>
	 			<br>
	 			<div class="paginator">
			        <ul class="pagination">
			            <?= $this->Paginator->first('<< ' . __('first')) ?>
			            <?= $this->Paginator->prev('< ' . __('previous')) ?>
			            <?= $this->Paginator->numbers() ?>
			            <?= $this->Paginator->next(__('next') . ' >') ?>
			            <?= $this->Paginator->last(__('last') . ' >>') ?>
			        </ul>
			        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
			    </div>
	 		</div>
	 	</div>
	 </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="importModal">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><i class="fa fa-envelope"></i> Import Data </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">


			<!-- Create the form -->
			<?= $this->Form->create(null, ['url' => ['controller' => 'Import', 'action' => 'import'], 'id' => 'importForm', 'class' => 'needs-validation', 'novalidate' => true, 'enctype' => 'multipart/form-data']) ?>

				<label> Choose Excel File . <a href="<?php echo $this->request->getAttribute('webroot').'DeficiencyManagementSample.xlsx' ?>"> Download Sample File </a> </label> <br/>
				<?= $this->Form->file('import_file', ['id' => 'importFile','accept' =>'*xlsx']) ?>

				<!-- Add a submit button -->
				<?= $this->Form->button('Import', ['id' => 'importSubmit','class'=>'btn btn-info']) ?>

			<?= $this->Form->end() ?>

	      </div>

	    </div>
	</div>
</div>

<br><br><br>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

	<?php if($stats['affected_policy']==0): ?>
		$('#piechart').html(`<center><br><span class="label badge-pill badge-info">No Data Available for chart</span></center>`);
		$('#remTrackingChart').html(`<center><br><span class="label badge-pill badge-info">No Data Available for chart</span></center>`);
	<?php else: ?>
	      google.charts.load('current', {'packages':['corechart']});
	      google.charts.setOnLoadCallback(drawChart);

	      function drawChart() {

	        var data = google.visualization.arrayToDataTable([
	          ['Risk Scale', 'Value'],
	          ['Minor',     <?php echo $stats['chart1']['Minor']; ?>],
	          ['Moderate',      <?php echo $stats['chart1']['Moderate']; ?>],
	          ['Significant',  <?php echo $stats['chart1']['Significant']; ?>],
	          ['Major', <?php echo $stats['chart1']['Major']; ?>],
	          ['Extreme',    <?php echo $stats['chart1']['Extreme']; ?>]
	        ]);

	        var options = {
	          //title: 'Risk Exposure Chart',
	          colors: ['#008000','#ffff00','#ff9900','#ff0000','#701314'],
	          legend: {position: 'bottom'},
	          is3D:true,
	          chartArea:{top:2,width:"100%",height:"90%"},

	        };

	        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	        chart.draw(data, options);


	        //drawing remediation tracking chart
	        var data2 = google.visualization.arrayToDataTable([
	          ['Status', 'Value'],
	          ['Delayed',     <?php echo $stats['outstanding']['pc']; ?>],
	          ['On Track',      <?php echo $stats['ontrack']['pc']; ?>],

	        ]);

	        var options2 = {
	          //title: 'Risk Exposure Chart',
	          colors: ['#ff0000','#ff9900'],
	          legend: {position: 'bottom'},
	          is3D:true,
	          chartArea:{top:2,width:"100%",height:"90%"},

	        };

	        var chart2 = new google.visualization.PieChart(document.getElementById('remTrackingChart'));

	        chart2.draw(data2, options2);


	      }
     <?php endif; ?>
       <?php

			$clear = $this->Html->link('<i class="fa fa-times"></i> Clear',[
				'controller'=>'lab','action'=>'deficiencyManagement'
			],[
				'class'=>'btn btn-info','escape'=>false
			]);
		?>

      	<?php if(empty($date)): ?>
			//$('.stext2').hide();
		<?php endif; ?>


    	var rproto = "<?php echo $uProto; ?>";
		var saving='<span class="bg-info text-white badge"><i class="fa fa-spinner fa-spin"></i><span class="blinking">Saving</span></span>';
		var saved='<span class="bg-success text-white badge"><i class="fa fa-check"></i><span>Saved</span></span>';
		var notSaved='<span class="bg-danger text-white badge"><i class="fa fa-check"></i><span>Not Saved</span></span>';

      $(function(){
      	/*for search form*/

      	var rskElement = $('select.riskRanking').clone();
      	var stsElement = $('select.statuses').clone();
      	//$('.stext').prop('type','date');
      	//$('.stext2').prop('type','date');
      	var txtElemment = $('.stext').clone();
      	var txt2Element = $('.stext2').clone();

      	if($('.stype').val()=='created'){
			$('.stext').prop('type','date');
			$('.stext2').prop('type','date');

			$('.riskRanking').remove();
      		$('.statuses').remove();
		} else if($('.stype').val()=='risk_ranking'){
			$('.stext').remove();
      		$('.stext2').remove();
      		$('.statuses').remove();
		} else if($(this).val()=='status'){
			$('.stext').remove();
      		$('.stext2').remove();
      		$('.riskRanking').remove();
		} else {
			$('.stext2').remove();
      		$('.riskRanking').remove();
      		$('.statuses').remove();
		}

      	$(document).on('change','.stype',function(){
			if($(this).val()=='created'){
				$('.riskRanking').remove();
		      	$('.statuses').remove();
		      	$('.stext').remove();
		      	$('.stext2').remove();
		      	txtElemment.insertAfter('.stype');
		      	txt2Element.insertAfter('.stext');

				$('.stext').prop('type','date').focus();
				$('.stext2').prop('type','date');
				//$('.stext2').show();
				$('.stext').prop('placeholder','dd-mmm-yyyy');
				$('.stext2').prop('placeholder','dd-mmm-yyyy').prop('required',true);
			} else if($(this).val()=='risk_ranking'){
				$('.riskRanking').remove();
		      	$('.statuses').remove();
		      	$('.stext').remove();
		      	$('.stext2').remove();
				rskElement.insertAfter('.stype');

			} else if($(this).val()=='status'){
				$('.riskRanking').remove();
		      	$('.statuses').remove();
		      	$('.stext').remove();
		      	$('.stext2').remove();
				stsElement.insertAfter('.stype');

			} else {
				$('.riskRanking').remove();
		      	$('.statuses').remove();
		      	$('.stext').remove();
		      	$('.stext2').remove();
		      	txtElemment.insertAfter('.stype');

				$('.stext').prop('type','search').focus();
				//$('.stext2').hide();
				$('.stext').prop('placeholder','Enter Text');
				//$('.stext2').prop('placeholder','').prop('required',false);
			}
		});

		//pagination for searching
		if($('.stype').val()!=""){

			var clearButton = '<?php echo $clear; ?>';
			$('.sbtn').append(clearButton);
		}


		/*search form js ends*/



		/*Updating the Remediation*/
		$(document).on('click','.updateBtn',function(){

			var parent = $($(this).data('id'));
			var statusCell = $(this).parents('.statusCell');


			postData = {
				id: parent.data('id'),
				detailed_description: parent.find('.detailed_description').val(),
				risk_ranking: parent.find('.risk_ranking').val(),
				remediation_plan: parent.find('.remediation_plan').val(),
				compensating_controls: parent.find('.compensating_controls').val(),
				owner_name: parent.find('.owner_name').val(),
				owner_department: parent.find('.owner_department').val(),
				entity_name: parent.find('.entity_name').val(),
				remediation_date: parent.find('.remediation_date').val(),
				status: parent.find('select.status').val(),
			};


			//console.log(postData);

			var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'updateDeficiencyRemediation'),false); ?>";
			thisUrl = thisUrl.replace("http:", rproto);
			$.ajax({
				url : thisUrl,
				method : "POST",
				headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},

				data : postData,
				beforeSend:function(){
					statusCell.append(saving);
					//field.prop('disabled',true);
				},
				success:function(resp){
					statusCell.find('.badge').remove();

					if(resp==1){
						statusCell.append(saved);

					} else {
						statusCell.append(notSaved);
					}

					setTimeout(function(){
						document.location.reload();
					},2000);

				},
				error:function(xhr){
					statusCell.find('.badge').remove();
					statusCell.append(notSaved);

					setTimeout(function(){
						document.location.reload();
					},2000);
				}
			});


		});
		/*Remediation Update ends*/

		//removing all badges
		setInterval(function(){
			$('.badge').fadeOut('slow');
		},5000);


		$(document).on('click.bs.dropdown.data-api', '.keepOpen', function (e) {
		  e.stopPropagation();
		});


		$(document).on('change','.showHide',function(){
			var colIndex = ($(this).prop('id')).split('_');


			if($(this).prop('checked')){
				$(".sticky-table td:nth-child("+colIndex[1]+")").show();
			} else {
				$(".sticky-table td:nth-child("+colIndex[1]+")").hide();
			}
		});


      });

</script>


<!-- Add the JavaScript code to handle the Ajax request -->
<script>
$(document).ready(function() {
    $('#importSubmit').click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Create a new FormData object and append the file
        var formData = new FormData();
        formData.append('import_file', $('#importFile')[0].files[0]);

        // Get the CSRF token from the meta tag
        var csrfToken = $('meta[name="csrfToken"]').attr('content');
		console.log(csrfToken);
        // Send the Ajax request
        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Import', 'action' => 'import']); ?>',
            type: 'POST',
            data: formData, // Pass the FormData object as data
            headers: {'X-CSRF-Token': csrfToken}, // Include the CSRF token in the headers
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle the success response
				console.log(response);
				if(response.status == 0){
					alert(response.message);
				}
				else
				{
					location.reload(true);
				}
            },
            error: function(xhr, status, error) {
                // Handle the error response
               alert(error);
            }
        });
    });
});

</script>