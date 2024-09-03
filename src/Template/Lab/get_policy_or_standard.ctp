
<div class="Report p-3">
	
	<div id="pg1" style="text-align:right;">
		<div class="text-right" style="max-height:100px;">
			
			<?php if($policy->logoType==false): ?>
				<h3><?php echo $policy->logo; ?></h3>
			<?php else: ?>
				<img src="<?php echo $policy->logo; ?>" style="max-height:100px;height:100px;" height="100"	>
			<?php endif; ?>
		</div>
		<div style="padding-top:4in;">
			<h2><?php echo $policy->name; ?></h2>
			<h3><?php echo $policy->type; ?></h3>
			<h2><?php echo $policy->document_number; ?></h2>
		</div>
		<div style="padding-top:1in;">
			<h4>(<?php echo $company->company_name; ?>)</h4>
			<h5>Effective Date: <?php echo date('Y-M-d',strtotime($policy->approved_date)); ?></h5>
			<h5>Revision: <?php echo $policy->revision; ?></h5>
		</div>
	</div>
	<pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre>
	
	<div id="pg2" class="content" style="margin-top:30px;padding-top:30px;">
		<table class="table table-bordered" style="font-size:14px;width:100%;mso-element:header" border="1">
			<tr>
				<th>Document # <?php echo $policy->document_number; ?></th>
				<th>Title: </th>
				<th></th>
			</tr>
			<tr class="table-active">
				<th style="background:#eee;">Revision #: <?php echo $policy->revision; ?></th>
				<th style="background:#eee;">Effective Date: <?php echo date('m/d/Y',strtotime($policy->effective_date)); ?></th>
				<th style="background:#eee;">Issued By: </th>
			</tr>
		</table>
		<br>
		<ol style="text-transform:uppercase;font-weight:bold;">
			<li style="margin-bottom:10px;">Purpose</li>
			<li style="margin-bottom:10px;">Scope</li>
			<li style="margin-bottom:10px;">Responsibility</li>
			<li style="margin-bottom:10px;"><?php echo $policy->type; ?> Statements</li>
			<li style="margin-bottom:10px;">Exceptions</li>
			<li style="margin-bottom:10px;">Definitions</li>
			<li style="margin-bottom:10px;">Related Documents</li>
			<!-- <li style="margin-bottom:10px;">Approvals</li> -->
			<li style="margin-bottom:10px;">Document Owner</li>
			<li style="margin-bottom:10px;">Periodic Review History</li>
			<li style="margin-bottom:10px;">Change History</li>
			<li style="margin-bottom:10px;">Supersedes</li>
		</ol>
	</div>
	<pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre>
	<div class="content" style="margin-top:30px;padding-top:30px;">
		<hr>
		<p>
			<b>1. &nbsp; PURPOSE</b>
		</p>
		<p style="padding-left:30px;">
			<?php echo $policy->purpose; ?>
		</p>
		<p>
			<b>2. &nbsp; SCOPE</b>
		</p>
		<p style="padding-left:30px;">
			<?php echo $policy->scope; ?>
		</p>
		<p>
			<b>3. &nbsp; RESPONSIBILITIES</b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%" border="1">
				<tr class="table-success">
					<th style="background:#18bc9c;color:#fff;">Roles</th>
					<th style="background:#18bc9c;color:#fff;">Responsibilities</th>
				</tr>
				<?php foreach($policy->policy_responsibilities as $resp): ?>
					<tr>
						<td><?php echo $resp->roles; ?></td>
						<td><?php echo $resp->responsibilities; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</p>
		<p>
			<b>4. &nbsp; <?php echo strtoupper($policy->type); ?> STATEMENTS </b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
				<?php $sr=1; foreach($policy->policy_statements as $statement): ?>
					<tr>
						<td><?php echo $sr++; ?></td>
						<td><?php echo $statement->name; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</p>
		<p>
			<b>5. &nbsp; EXCEPTIONS</b>
		</p>
		<p style="padding-left:30px;">
			<?php echo $policy->exceptions; ?>
		</p>
		<p>
			<b>6. &nbsp; DEFINITIONS </b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
				<tr class="table-success">
					<th style="background:#18bc9c;color:#fff;"></th>
					<th style="background:#18bc9c;color:#fff;">Term</th>
					<th style="background:#18bc9c;color:#fff;">Definition</th>
				</tr>
				<?php $sr=1; foreach($policy->policy_definitions as $definition): ?>
					<tr>
						<td><?php echo $sr++; ?></td>
						<td><?php echo $definition->term; ?></td>
						<td><?php echo $definition->definition; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</p>
		<p>
			<b>7. &nbsp; RELATED DOCUMENTS</b>
		</p>
		<p style="padding-left:30px;">
			<?php echo $policy->related_documents; ?>
		</p>
		<!--<p>
			<b>8. &nbsp; APPROVALS </b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
				<tr class="table-success">
					<th style="background:#18bc9c;color:#fff;">Name/Title</th>
					<th style="background:#18bc9c;color:#fff;">Department</th>
					<th style="background:#18bc9c;color:#fff;">Signature</th>
					<th style="background:#18bc9c;color:#fff;">Date</th>
				</tr>
				<?php foreach($policy->policy_approvers as $approver): ?>
					<tr>
						<td>
							<?php echo $approver->name; ?>
							<?php echo $approver->type=="Author"?"(Author)":""; ?>
						</td>
						<td><?php echo $approver->department; ?></td>
						<td></td>
						<td></td>
					</tr>
				<?php endforeach; ?>
				
			</table>
		</p> -->
		<p>
			<b>8. &nbsp; DOCUMENT OWNER</b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
				<tr class="table-success">
					<th style="background:#18bc9c;color:#fff;">Name</th>
					<th style="background:#18bc9c;color:#fff;">Email</th>
				</tr>
				<tr>
					<td><?php echo $policy->document_owner_name; ?></td>
					<td><?php echo $policy->document_owner_email; ?></td>
				</tr>
			</table>
			
		</p>
		
		<p>
			<b>9. &nbsp; PERIODIC REVIEW HISTORY </b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
				<tr class="table-success">
					<th style="background:#18bc9c;color:#fff;">Reviewed By</th>
					<th style="background:#18bc9c;color:#fff;">Review Date</th>
				</tr>
				<?php foreach($policy->policy_review_history as $review): ?>
					<tr>
						<td><?php echo $review->name; ?></td>
						<td><?php echo date('d/M/Y',strtotime($review->created)); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</p>
		<p>
			<b>10. &nbsp; CHANGE HISTORY </b>
		</p>
		<p style="padding-left:30px;">
			<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
				<tr class="table-success">
					<th style="background:#18bc9c;color:#fff;">Revision</th>
					<th style="background:#18bc9c;color:#fff;">Changed By</th>
					<th style="background:#18bc9c;color:#fff;">Change Date</th>
					<th style="background:#18bc9c;color:#fff;">Change Summary</th>
				</tr>
				<?php foreach($policy->policy_change_history as $change): ?>
					<tr>
						<td></td>
						<td><?php echo $change->name; ?></td>
						<td><?php echo date('d/M/Y',strtotime($change->created)); ?></td>
						<td><?php echo $change->remarks; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</p>
		
	</div>
	
</div>
