 <style>
    .data-subsmission .table
        {
    background: #233149;
            color: #fff;
}
        .data-subsmission .table th
        {
            text-transform: uppercase !important;
        }


      .data-subsmission   .table td, .data-subsmission  .table th {
    padding: .75rem;
    vertical-align: top;
          font-family: 'noir';
          font-size: 21px;
    border: 1px solid #dee2e6;
              height: 42px;

          text-align: center;
}

	.data-subsmission .table tr:hover td {
		color:#ffffff;
	}
    </style>
<div class="white-bg">
       <div class="container-fluid questionborder">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Assessment Reporting</h5>
               </div>

           </div>

           <div class="row questionborder1 cl_paddi" style="padding-top:15px;">
              <div class="col-md-12 form-inline">
              	<?php echo $this->Form->create($search,['id'=>'searchForm']);
              		$this->Form->setTemplates([
					    'inputContainer' => '{{content}}',
					]);
              	?>
              	<div class="form-group">
              		<div class="input-group input-group-lg mb-3">
              			<div class="input-group-prepend">
              				<span class="input-group-text bg-primary text-white">SEARCH</span>
              			</div>

              			<?php
              				echo $this->Form->control('stype',[
              					'type'=>'select',
              					'class'=>'form-control stype',
              					'empty'=>[''=>'--Select--'],
              					'options'=>['created'=>'Date','name'=>'Assessment Name','case_number'=>'Case Number','sub_type'=>'Assessment Type','status'=>'Status'],
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
              			?>

					  <div class="input-group-append sbtn">
					    <button class="btn btn-primary" type="submit" id="button-addon2"><i class='fa fa-search'></i></button>
					  </div>
					</div>
              	</div>
              	<?php echo $this->Form->end(); ?>

              </div>
              <div class="col-md-12" style="padding:5px;"></div>
          <div class="col-md-12 ">

    								<div class="table-responsive data-subsmission" >
	    								<table class="table table-hover">
										  <thead>
										    <tr>
										      <th>Submission Name</th>
										      <th>Case Number</th>
										      <th>Date</th>
										      <th>Assessment Type</th>
										      <th>Status</th>
										    </tr>
										  </thead>
										  <tbody>
										  	<?php foreach ($assessments as $assessment): ?>
											  	<tr>
											      <td>
											      	<?php echo $assessment->name; ?>
											      </td>
											      <td><?php echo $assessment->case_number; ?></td>
											      <td>
											      	<?php echo date('d-M-y h:i A',strtotime($assessment->modified)); ?>
											      </td>
											      <td>
											      	<?php echo $assessment->sub_type; ?>
											      	(<?php echo $assessment->atype; ?>)
											      </td>
											      <td>


											      	<?php if($assessment->status=='Review or Draft'): ?>
											      		<?php echo $assessment->status; ?>
											      		<br>
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
														  		if($assessment->sub_type!='CMMC'){
																	echo $this->Html->link('<i class="fa fa-file-word"></i> Word',[
																		'controller'=>'TprmAssessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,"word"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
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
																	'controller'=>'TprmAssessments','action'=>'viewResult',$assessment->id,$assessment->sub_type,"export"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
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
											      		<?php echo $assessment->status; ?>
											      		<br>
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
															  	if($assessment->sub_type!='CMMC'){
																	echo $this->Html->link('<i class="fa fa-file-word"></i> Word',[
																		'controller'=>'TprmAssessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,"word"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
																	],[
																		'class'=>"report dropdown-item",
																		'escape'=>false,'target'=>'_blank',
																		'data-toggle'=>'tooltip',
																		'data-placement'=>'left',
																		'title'=>"Result Report"
																	]);
																}
															?>
															<?php
																echo $this->Html->link('<i class="fa fa-file-excel"></i> Excel',[
																	'controller'=>'TprmAssessments','action'=>'viewResult',$assessment->id,$assessment->sub_type,"export"/*,$assessment->case_number."_".$assessment->name.".pdf"*/
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
															// if($assessment->sub_type!='CMMC' && $assessment->sub_type!='eGRC' ){
															// 	echo $this->Html->link('<i class="fa fa-redo"></i>',[
															// 		'controller'=>'Assessments','action'=>'assessmentRepeat',$assessment->id,$assessment->sub_type
															// 	],[
															// 		'class'=>'btn btn-sm btn-secondary','escape'=>false,
															// 		'data-toggle'=>'tooltip','title'=>'Re-Assessment'
															// 	]);
															// }
														?>
											      	<?php endif; ?>
											      	<?php if($assessment->atype=="Self" && $assessment->status!='Completed'): ?>
											      		<?php
											      			echo $this->Html->link('<i class="fa fa-eye"></i>',[
											      				'controller'=>'TprmAssessments','action'=>'view',$assessment->id,$assessment->sub_type
											      			],[
											      				'class'=>'btn btn-info btn-sm text-white',
											      				'escape'=>false, 'target'=>'_blank',
											      				'data-toggle'=>'tooltip',
											      				'data-placement'=>'top',
											      				'title'=>'View Assessment'
											      			]);
											      		?>
											      	<?php endif; ?>
											      </td>
											    </tr>
										    <?php endforeach; ?>


										  </tbody>
										</table>
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

                <div class="sr-only" style="line-height: 29px;">
                    <h4 class="title-section">Statuses Explained:</h4>
                    <ul class="status-list">
                        <li class="new-site parent"><span class="item-heading">Submitted</span> <span class="text-status"> -  Submission has been received but has not yet been viewed by our analysts.</span></li>
                        <li class="new-site parent"><span class="item-heading">Processing </span> <span class="text-status"> - This is where we go over the information they have provided us to ensure it is correct, and is fully reviewed prior to the start of the assessments for that client.</span></li>
                        <li class="new-site parent"><span class="item-heading">Temporarily Halted </span> <span class="text-status"> -  If information is unclear, inaccurate or otherwise out of order the assessment process will be stopped and a representative from our company will reach out to the
    individual (Using the information provided in their questionnaire)</span>
                            <ol type="A" class="child-list">
                                <li class="new-site child">A. Information as to why the process was halted will always be presented when an assessment has been halted.</li>
                                <li class="new-site child">B.  Must keep clients in the loop, client should be emailed or called.</li>
                            </ol>
                        </li>

                        <li class="new-site parent"><span class="item-heading"> Assessment in Progress </span> <span class="text-status"> - Documentation provided by client is being reviewed by our analysts based on client requests from the submission form.</span></li>
                        <li class="new-site parent"><span class="item-heading">Assessment in Final Stages  </span> <span class="text-status"> - Assessment is in its final stages when all information from the submitted documentation has been fully reviewed and the relevant requested information is
    ready to be entered into the system for client viewing.</span></li>
                        <li class="new-site parent"><span class="item-heading">Assessment Completed </span> <span class="text-status"> - Client can view our assessment of the requested cybersecurity assessment</span>
                            <ol type="A" class="child-list">
                                <li class="new-site child"> <span class="text-status">A. Will be presented in Results section.</span></li>
                                <li class="new-site child"> <span class="text-status">B. Clicking on an “Assessment Completed” status will redirect the client to the Results tab.</span></li>
                                <li class="new-site child"> <span class="text-status">C. If major concerns are detected, a red flag will appear when the client go to check the results (results still accessible though)</span>
                                    <ol type="I" class="sub-child-list">
                                        <li class="new-site sub-child"> <span class="text-status">I. Results will include a brief statement as to where to look for the major concern</span></li>

                                    </ol>
                                </li>
                            </ol>
                        </li>
                    </ul>
                </div>
           </div>
       </div>
        <!-- content wrapper -->
        <br>
  </div>
  <!-- main content closed -->
  <?php

		$clear = $this->Html->link('<i class="fa fa-times"></i> Clear',[
			'controller'=>'Assessments','action'=>'tracking'
		],[
			'class'=>'btn btn-info','escape'=>false
		]);
	?>
<script>
	$(function(){
		<?php if(empty($date)): ?>
		$('.stext2').hide();
		<?php endif; ?>
		$(document).on('click','.showResult',function(){
			aid = $(this).attr('data-aid');
			st = $(this).attr('data-subtype');

			var win = window.open("<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'viewResult'),true); ?>/"+aid+"/"+st,"Assessment Results","width=1200,height=550,left=0,top=0");
			win.resizeTo(1250,550);
		});

		//searching form settings
		$(document).on('change','.stype',function(){
			if($(this).val()=='created'){
				$('.stext').prop('type','date').focus();
				$('.stext2').prop('type','date').show();
				$('.stext').prop('placeholder','dd-mmm-yyyy');
				$('.stext2').prop('placeholder','dd-mmm-yyyy').prop('required',true);
			} else {
				$('.stext').prop('type','search').focus();
				$('.stext2').prop('type','text').hide();
				$('.stext').prop('placeholder','Enter Text');
				$('.stext2').prop('placeholder','').prop('required',false);
			}
		});

		//pagination for searching

		if($('.stype').val()!=""){
			/*
			$(document).on('click','.pagination li a',function(e){
				e.preventDefault();
				var link = $(this).prop('href');
				if(link.length>0){
					link = link.split('?');
					var formUrl = $('#searchForm').prop('action')+"?"+link[1];
					console.log(formUrl);
					$('#searchForm').prop('action',formUrl).submit();
				}
			});

			*/
			var clearButton = '<?php echo $clear; ?>';
			$('.sbtn').append(clearButton);
		}

		if($('.stype').val()=='created'){
			$('.stext').prop('type','date');
			$('.stext2').prop('type','date');
		}
	});
</script>