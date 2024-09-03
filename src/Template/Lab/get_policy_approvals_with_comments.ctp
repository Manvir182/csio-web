<?php if(count($approvals)<1): ?>
	<div class="alert alert-warning text-center">
		<i class="fa fa-info-circle"></i>
		No Approval Requests found for this Policy.
	</div>
<?php endif; ?>

<div class="accordion" id="approvalAccordion">
	<?php foreach($approvals as $approval): ?>
		<div class="card">
			<div class="card-header" id="headingOne<?php echo $approval->id; ?>">
				<span class="float-right">
					<span class="badge badge-<?php echo $approval->status=="Approved"?'success':'warning'; ?> badge-pill ">
						<?php echo $approval->status; ?>
					</span>
					<span class="badge badge-info badge-pill ">
						<?php echo count($approval->policy_approval_comments); ?> Comments
					</span>
				</span>
				
				<h2 class="mb-0">
					<button class="btn btn-link text-primary" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $approval->id; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $approval->id; ?>">
						<?php echo $approval->approver->first_name; ?>	
					</button>
				</h2>
			</div>
	
			<div id="collapseOne<?php echo $approval->id; ?>" class="collapse" aria-labelledby="headingOne<?php echo $approval->id; ?>" data-parent="#approvalAccordion">
				<div class="card-body">
					<?php if(count($approval->policy_approval_comments)==0): ?>
						<div class="alert alert-warning text-center">
							<i class="fa fa-info-circle"></i>
							No Comments so far.
						</div>
					<?php endif; ?>
					<ul class="list-unstyled approvalComments">
					  <?php foreach($approval->policy_approval_comments as $aComment): ?>
					  	 <li class="media">
					       <span class="rounded-circle mr-3 text-center">
					       	 <?php if(empty($aComment->approver)): ?>
						    		<?php echo strtoupper(substr($approval->policy->user->first_name,0,1)).strtoupper(substr($approval->policy->user->last_name,0,1)); ?>
						     <?php else: ?>
						     	<?php echo strtoupper(substr($aComment->approver->first_name,0,1)).strtoupper(substr($aComment->approver->last_name,0,1)); ?>
						     <?php endif; ?>
						    </span>
						    <div class="media-body">
						    	<span class="badge badge-pill float-right" style="background:#eee;color:#222;">
						    		<?php echo date('d-m-Y h:i a',strtotime($aComment->created)); ?>
						    	</span>
						      <h5 class="mt-0 mb-1">
						      	 <?php if(empty($aComment->approver)): ?>
							    		<?php echo $approval->policy->user->first_name." ".$approval->policy->user->last_name; ?>
							     <?php else: ?>
							     	<?php echo $aComment->approver->first_name." ".$aComment->approver->last_name; ?>
							     <?php endif; ?>
						      </h5>
						      <p style="font-size:small;">
						      	<?php echo $aComment->remarks; ?>
						      </p>
						    </div>
						  </li>
					  <?php endforeach; ?>
					</ul>
					
					<?php if($approval->status=="Pending Approval" || $approval->status=="Comments"): ?>
						<ul class="list-unstyled">
						  <li class="media bg-light">
						    <span class="rounded-circle mr-3 text-center">
						    	<?php echo strtoupper(substr($thisUser['first_name'],0,1)).strtoupper(substr($thisUser['last_name'],0,1)); ?>
						    </span>
						    <div class="media-body">
						      <h5 class="mt-0 mb-1">Write Comment</h5>
						      <div class="commentError text-danger"></div>
						      <textarea class='form-control mt-1 newComment'></textarea>
						      <div class='text-right'>
					      		<button class="btn btn-success saveMyComment mt-2" data-id="<?php echo $approval->id; ?>" type="button">
					      			<i class="fa fa-check"></i>
					      			Save
					      		</button>
				      		  </div>
						    </div>
						  </li>
						</ul>
					<?php else: ?>
						<div class="text-muted text-center">
							Comments Closed
						</div>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
