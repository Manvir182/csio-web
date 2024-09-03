<div class="row page-titles">
    <div class="col-md-8 col-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'approvers','action'=>'dashboard'
					));
            	?>
            </li>
           
            <li class="breadcrumb-item active">Approval Requests</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			// echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					// 'controller'=>'approvers','action'=>'add'
				// ),array(
					// 'escape'=>false, 'class'=>'btn btn-info'
				// ));
// 				
    		?>
    		
    	</div>
    </div>                  
</div>
<div class="">
    <div class="card">
        <div class="table-responsive">
		    <table cellpadding="0" cellspacing="0" class="table table-bordered table-stripped m-0">
		        <thead>
		            <tr class="table-active">
		                <th>Sr.No.</th>
		                <th>Policy/Standard</th>
		                <th>Request For</th>
		                <th>Status</th>
		                <th>Requester</th>
		                <th>Last Updated on</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php $sr=1; foreach($approvals as $approval): ?>
		        		<tr>
		        			<td><?php echo $sr++; ?></td>
		        			<td>
		        				<?php 
		        					$ltext = $approval->policy->name."(".$approval->policy->document_number.")";
									
									echo $this->Html->link($ltext,[
										'controller'=>'approvers',
										'action'=>'approvalRequest',
										$approval->id
									],[
										'escape'=>false,
										'class'=>'link'
									]);
									
		        				?>
		        				
		        			</td>
		        			<td>
		        				<?php if($approval->old_data==""): ?>
		        					New Created
		        				<?php else: ?>
		        					For Changes
		        				<?php endif; ?>
		        			</td>
		        			<td><?php echo $approval->status; ?></td>
		        			<td>
		        				<?php echo $approval->policy->user->first_name; ?>
		        				<?php echo $approval->policy->user->last_name; ?>
		        			</td>
		        			<td><?php echo date('d-M-Y h:i A',strtotime($approval->modified)); ?></td>
		        			
		        		</tr>
		        	<?php endforeach; ?>
		        	<?php if(count($approvals)==0): ?>
		        		<tr class="table-warning">
		        			<td colspan="5" class='text-center text-muted'>
		        				<i class="fa fa-info-circle"></i>
		        				No Pending Requests
		        			</td>
		        		</tr>	
		        	<?php endif; ?>
		        	
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
