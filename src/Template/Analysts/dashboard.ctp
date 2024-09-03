<section class='text-center'>
	<h2>
		<b>
			<?php echo $thisUser['company_name']; ?>
		</b>
	</h2>
	<h2 style="text-transform: uppercase;">
		Analysts Dashboard
	</h2>
</section>
<hr class="bg-info">


<div class="table-responsive">
		<?php if(empty($invitations)): ?>
			<div class="alert alert-warning text-center" style="border-radius:100px;">
				<i class="fa fa-info-circle"></i>
				No Data Available
			</div>
		<?php else: ?>
			<table class="table table-bordered">
				<thead>
					<tr style="background-color:#233149;color:#fff">
						<th>S.NO</th>
						<th>Assessment Type</th>
						<th>Invitation By</th>
						<th>Invitation Source</th>
						<th>Invited On</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 0;
						foreach($invitations as $invite):
					?>
						<tr>
							<th class="text-dark"><?php echo ++$counter; ?></th>
							<td><?php echo $invite['assessment_type']; ?></td>
							<td><?php echo $invite['Users']['username']; ?></td>
							<td><?php echo $invite['invitation_source']; ?></td>
							<td><?php echo (date('d-M-y',strtotime($invite['created']))); ?></td>
							<td>
								<?php
								if($invite['assessment_status']==0)
								{
									echo $this->Html->link('View',array(
										'controller'=>'TprmAssessments','action'=>'assessmentRequest',$invite['id']
									),array('class'=>'btn cisoblue cisoblue-outline text-white '));
								}else{
									echo $this->Html->link('Track',array(
										'controller'=>'TprmAssessments','action'=>'tracking'),array('class'=>'btn cisoblue cisoblue-outline text-white'));
								}
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
</div>