<div class="row page-titles">
    <div class="col-md-12 col-12">
        <ol class="breadcrumb">
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
            
            <li class="breadcrumb-item active">Assessment Requests</li>
        </ol>
    </div> 
                    
</div>
<div class="">
    <div class="card card-block">
        <div class="table-responsiv">
		    <table cellpadding="0" cellspacing="0" class="table table-bordered table-stripped dataTable">
		        <thead>
		            <tr class="table-inverse text-warning">
		                <th scope="col">No.</th>
		                <th>Owner</th>
		                <th>Assessment Type</th>
		                <th>Assessment Name</th>
		                <th>Status</th>
		                <th>Date</th>
		                <th scope="col" class="actions"><?= __('Actions') ?></th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php $sr=1; foreach ($assessments as $assessment): ?>
		            <tr>
		                <td align="center"><?= $sr++; ?>.</td>
		              	<td>
		              		<span style="color:#999;font-size:small;">
		              			<i class="fa fa-briefcase"></i>
		              		</span>
		              		<?= $assessment->user->first_name." ".$assessment->user->last_name ?> <br>
		              		
		              		<span style="color:#999;font-size:small;">
		              			<i class="fa fa-building"></i>
		              		</span>
		              		<?= $assessment->user->company->company_name ?>
		              		
		              	</td>
		                <td><?= $assessment->sub_type ?> <br> (<?= $assessment->atype ?>)</td>
		                <td style="width:25%;">
		              		<?= $assessment->name ?>
		              	</td>
		                <td>
		                	<div class="btn-group">
							  <button type="button" class="btn <?php echo $assessment->status=='Completed'?'btn-success':'btn-info'; ?>"><?= h($assessment->status) ?></button>
							  <?php if($assessment->status!='Completed'): ?>
							  <button type="button" class="btn btn-inverse active dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
						</td>
		                <td style="width:100px;"><?= h(date('d-M-y',strtotime($assessment->created))) ?></td>
		                
		                <td class="actions" style="width:100px;">
		                	<?php
		                		echo $this->Html->link('<span class="fa fa-eye"></span>',[
	                				'controller'=>'assessments','action'=>'view',$assessment->id,$assessment->sub_type=='Regulated'?'Regulated':''
	                			],[
	                				'escape'=>false,
	                				'class'=>'btn btn-sm btn-info text-white',
	                				'data-toggle'=>'tooltip',
	                				'title'=>'View Details'
	                			]);
							?>
							<?php if($assessment->status=='Completed' || $assessment->status=='Review or Draft'): ?>
								<button class="btn btn-sm btn-success text-white showResult" data-aid="<?php echo $assessment->id; ?>" data-subtype="<?php echo $assessment->sub_type; ?>" type="button" data-toggle="tooltip" title="Show Results">
									<i class="fa fa-file"></i>
								</button>
								<?php 
									echo $this->Html->link('<i class="fa fa-download"></i>',[
										'controller'=>'assessments','action'=>'exportResultReport',$assessment->id,$assessment->sub_type,$assessment->case_number."_".$assessment->name.".pdf"
									],[
										'class'=>"btn btn-danger btn-sm text-white report",
										'escape'=>false,'target'=>'_blank',
										'data-toggle'=>'tooltip',
										'data-placement'=>'top',
										'title'=>"Export Report Document"
									]);
								?>
							<?php endif; ?>
		                	
		                </td>
		            </tr>
		            <?php endforeach; ?>
		        </tbody>
		    </table>
		</div>
	</div>
	
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
<script>
	$(function(){
		$(document).on('click','.showResult',function(){
			aid = $(this).attr('data-aid');
			st = $(this).attr('data-subtype');
			
			var win = window.open("<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'viewResult'),true); ?>/"+aid+"/"+st,"Assessment Results","width=1200,height=550,left=0,top=0");
			win.resizeTo(1250,550);
		});
	});
</script>