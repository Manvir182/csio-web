<style>
	li.media > span {
		display:inline-block;
		width:60px;
		height:60px;
		line-height: 60px;
		font-size:20px;
		background:#eee;
		color:#222;
		box-sizing:border-box;
		border:1px solid #ccc;
	}
</style>
<div class="row page-titles">
    <div class="col-md-8 col-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php
				echo $this -> Html -> link('Dashboard', array('controller' => 'approvers', 'action' => 'dashboard'));
            	?>
            </li>
           
            <li class="breadcrumb-item active">Approval Request Details</li>
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
	
	
    <div class="row">
    	<div class="col-sm-6">
    		<h4>
    			<?php echo $approval->policy->name; ?>
    			(<?php echo $approval->policy->document_number; ?>)
    			
    			<span class="badge badge-pill" style="background:#888;font-size:12px;line-height:15px;">
    				Current Status: 
    				<?php echo $approval->status; ?>
    			</span>
    		</h4>
    	</div>
    	<div class="col-sm-6">
    		<div class="text-right">
    			<?php if($approval->status!="Approved" && $approval->status!="Rejected"): ?>
					<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#responseModal">
						<i class="fa fa-info-circle"></i>
						Update Status
					</button>
				<?php endif; ?>
			</div>
    	</div>
    	<div class="col-sm-12">
    		<hr>
    	</div>
    	<!--Comparison Data is below-->
    	<div class="col-sm-6">
    		
    		<?php if($approval->old_data!=""): ?>
    			<?php $colClass="col-sm-6"; ?>
    		<h4 class="text-info">Policy's Old Details</h4>
    		
    		<div class="Report p-3" style="border:1px solid #555;">
    			<?php $policy=json_decode($approval->new_data); ?>
				<div id="pg1" style="text-align:right;">
					<div class="text-right" style="max-height:100px;">
						<?php if(strpos($policy -> logo,"http")): ?>
							<h3><?php echo $policy -> logo; ?></h3>
						<?php else: ?>
							<img src="<?php echo $policy -> logo; ?>" style="max-height:100px;height:100px;" height="100"	>
						<?php endif; ?>
					</div>
					<div style="padding-top:4in;">
						<h2><?php echo $policy -> name; ?></h2>
						<h3><?php echo $policy -> type; ?></h3>
						<h2><?php echo $policy -> document_number; ?></h2>
					</div>
					
					
				</div>
				<pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre>
				
				<div id="pg2" class="content" style="margin-top:30px;padding-top:30px;">
					<table class="table table-bordered" style="font-size:14px;width:100%;mso-element:header" border="1">
						<tr>
							<th>Document # <?php echo $policy -> document_number; ?></th>
							<th>Title: </th>
							<th></th>
						</tr>
						<tr class="table-active">
							<th style="background:#eee;">Revision #: <?php echo $policy -> revision; ?></th>
							<th style="background:#eee;">Effective Date: <?php echo date('m/d/Y', strtotime($policy -> effective_date)); ?></th>
							<th style="background:#eee;">Issued By: </th>
						</tr>
					</table>
					<br>
					<ol style="text-transform:uppercase;font-weight:bold;">
						<li style="margin-bottom:10px;">Purpose</li>
						<li style="margin-bottom:10px;">Scope</li>
						<li style="margin-bottom:10px;">Responsibility</li>
						<li style="margin-bottom:10px;"><?php echo $policy -> type; ?> Statements</li>
						<li style="margin-bottom:10px;">Exceptions</li>
						<li style="margin-bottom:10px;">Definitions</li>
						<li style="margin-bottom:10px;">Related Documents</li>
						<li style="margin-bottom:10px;">Approvals</li>
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
						<?php echo $policy -> purpose; ?>
					</p>
					<p>
						<b>2. &nbsp; SCOPE</b>
					</p>
					<p style="padding-left:30px;">
						<?php echo $policy -> scope; ?>
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
									<td><?php echo $resp -> roles; ?></td>
									<td><?php echo $resp -> responsibilities; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</p>
					<p>
						<b>4. &nbsp; <?php echo strtoupper($policy -> type); ?> STATEMENTS </b>
					</p>
					<p style="padding-left:30px;">
						<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
							<?php $sr=1; foreach($policy->policy_statements as $statement): ?>
								<tr>
									<td><?php echo $sr++; ?></td>
									<td><?php echo $statement -> name; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</p>
					<p>
						<b>5. &nbsp; EXCEPTIONS</b>
					</p>
					<p style="padding-left:30px;">
						<?php echo $policy -> exceptions; ?>
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
									<td><?php echo $definition -> term; ?></td>
									<td><?php echo $definition -> definition; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</p>
					<p>
						<b>7. &nbsp; RELATED DOCUMENTS</b>
					</p>
					<p style="padding-left:30px;">
						<?php echo $policy -> related_documents; ?>
					</p>
					<p>
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
										<?php echo $approver -> name; ?>
										<?php echo $approver -> type == "Author" ? "(Author)" : ""; ?>
									</td>
									<td><?php echo $approver -> department; ?></td>
									<td></td>
									<td></td>
								</tr>
							<?php endforeach; ?>
							
						</table>
					</p>
					<p>
						<b>9. &nbsp; DOCUMENT OWNER</b>
					</p>
					<p style="padding-left:30px;">
						<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
							<tr class="table-success">
								<th style="background:#18bc9c;color:#fff;">Name</th>
								<th style="background:#18bc9c;color:#fff;">Email</th>
							</tr>
							<tr>
								<td><?php echo $policy -> document_owner_name; ?></td>
								<td><?php echo $policy -> document_owner_email; ?></td>
							</tr>
						</table>
						
					</p>
					
					
					
					
				</div>
				
			</div>
    		<?php else: ?>
    			<?php $colClass="col-sm-8 offset-sm-2"; ?>
    		<?php endif; ?>
    	</div>
    	<div class="<?php echo $colClass; ?>">
    		<h4 class="text-danger">Policy's New Details</h4>
    		<div class="Report p-3" style="border:1px solid #555;">
    			<?php $policy=json_decode($approval->new_data); ?>
				<div id="pg1" style="text-align:right;">
					<div class="text-right" style="max-height:100px;">
						<?php if(strpos($policy -> logo,"http")): ?>
							<h3><?php echo $policy -> logo; ?></h3>
						<?php else: ?>
							<img src="<?php echo $policy -> logo; ?>" style="max-height:100px;height:100px;" height="100"	>
						<?php endif; ?>
					</div>
					<div style="padding-top:4in;">
						<h2><?php echo $policy -> name; ?></h2>
						<h3><?php echo $policy -> type; ?></h3>
						<h2><?php echo $policy -> document_number; ?></h2>
					</div>
					
					
				</div>
				<pre><br clear=all style='mso-special-character:line-break;page-break-before:always'></pre>
				
				<div id="pg2" class="content" style="margin-top:30px;padding-top:30px;">
					<table class="table table-bordered" style="font-size:14px;width:100%;mso-element:header" border="1">
						<tr>
							<th>Document # <?php echo $policy -> document_number; ?></th>
							<th>Title: </th>
							<th></th>
						</tr>
						<tr class="table-active">
							<th style="background:#eee;">Revision #: <?php echo $policy -> revision; ?></th>
							<th style="background:#eee;">Effective Date: <?php echo date('m/d/Y', strtotime($policy -> effective_date)); ?></th>
							<th style="background:#eee;">Issued By: </th>
						</tr>
					</table>
					<br>
					<ol style="text-transform:uppercase;font-weight:bold;">
						<li style="margin-bottom:10px;">Purpose</li>
						<li style="margin-bottom:10px;">Scope</li>
						<li style="margin-bottom:10px;">Responsibility</li>
						<li style="margin-bottom:10px;"><?php echo $policy -> type; ?> Statements</li>
						<li style="margin-bottom:10px;">Exceptions</li>
						<li style="margin-bottom:10px;">Definitions</li>
						<li style="margin-bottom:10px;">Related Documents</li>
						<li style="margin-bottom:10px;">Approvals</li>
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
						<?php echo $policy -> purpose; ?>
					</p>
					<p>
						<b>2. &nbsp; SCOPE</b>
					</p>
					<p style="padding-left:30px;">
						<?php echo $policy -> scope; ?>
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
									<td><?php echo $resp -> roles; ?></td>
									<td><?php echo $resp -> responsibilities; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</p>
					<p>
						<b>4. &nbsp; <?php echo strtoupper($policy -> type); ?> STATEMENTS </b>
					</p>
					<p style="padding-left:30px;">
						<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
							<?php $sr=1; foreach($policy->policy_statements as $statement): ?>
								<tr>
									<td><?php echo $sr++; ?></td>
									<td><?php echo $statement -> name; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</p>
					<p>
						<b>5. &nbsp; EXCEPTIONS</b>
					</p>
					<p style="padding-left:30px;">
						<?php echo $policy -> exceptions; ?>
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
									<td><?php echo $definition -> term; ?></td>
									<td><?php echo $definition -> definition; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</p>
					<p>
						<b>7. &nbsp; RELATED DOCUMENTS</b>
					</p>
					<p style="padding-left:30px;">
						<?php echo $policy -> related_documents; ?>
					</p>
					<p>
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
										<?php echo $approver -> name; ?>
										<?php echo $approver -> type == "Author" ? "(Author)" : ""; ?>
									</td>
									<td><?php echo $approver -> department; ?></td>
									<td></td>
									<td></td>
								</tr>
							<?php endforeach; ?>
							
						</table>
					</p>
					<p>
						<b>9. &nbsp; DOCUMENT OWNER</b>
					</p>
					<p style="padding-left:30px;">
						<table class="table table-bordered" style="font-size:14px;width:100%;" border="1">
							<tr class="table-success">
								<th style="background:#18bc9c;color:#fff;">Name</th>
								<th style="background:#18bc9c;color:#fff;">Email</th>
							</tr>
							<tr>
								<td><?php echo $policy -> document_owner_name; ?></td>
								<td><?php echo $policy -> document_owner_email; ?></td>
							</tr>
						</table>
						
					</p>
					
					
					
					
				</div>
				
			</div>
			
    	</div>
    	<div class="col-sm-8 offset-sm-2">
    		<!--Comments and Remarks-->
			<div class="mt-3">
				
				<h4>
					<i class="fa fa-comments"></i>
					Comments
				</h4>
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
					      <?php echo $aComment->remarks; ?>
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
					      <textarea id="newComment" class='form-control mt-1'></textarea>
					      <div class='text-right'>
				      		<button class="btn btn-success saveMyComment" type="button">
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
</div>


<!--Response Modal-->
<div class="modal" tabindex="-1" role="dialog" id="responseModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<?php echo $this->Form->create($approval); ?>	
   		<?php 
   	
    		$this->Form->setTemplates([
			    'inputContainer' => '	
			        {{content}} '
			]);
    	?>
      <div class="modal-header">
        <h5 class="modal-title">Respond on Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<div class="form-group">
        		<?php 
        			echo $this->Form->control('status',[
        				'class'=>'form-control',
        				'type'=>'select',
        				'options'=>[
        					'Pending Approval'=>'Pending Approval',
        					'Approved'=>'Approved',
        					'Rejected'=>'Rejected',
        					'Comments'=>'Comments'
        				],
        				'empty'=>[
        					""=>" -- Select Status -- "
        				]
        			]);
        		?>
        	</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary float-left">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>
<!--Response Modal Ends-->
<?php if($approval->status=="Pending Approval" || $approval->status=="Comments"): ?>
<script>
	var rproto = "<?php echo $uProto; ?>";
	var saving = '<div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Saving...</span></div>';
	
	$(function(){
		
		$(document).on('click','.saveMyComment',function(){
			$('.commentError').html("");
			var comment = $('#newComment').val();
			var btn = $(this);
			var btnHtml = btn.html();
			console.log(comment);
			if(comment){
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'approvers','action'=>'saveApprovalComment'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				
				
				$.ajax({
					url : thisUrl,
					method : "POST",
					headers: {
					    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
					 },
					data : {approval_request_id:'<?php echo $approval->id; ?>',comment:$('#newComment').val()},
					
					beforeSend : function(xhr) {
						btn.prop('disabled',true).html(saving);
					},
					success : function(data) {
						btn.prop('disabled',false).html(btnHtml);
						
						if(data==0){
							$('.commentError').html("Sorry! Not saved. Try again.");
						} else {
							$('.approvalComments').append(data);
							$('#newComment').val('')
						}
						
						
					}
				});
			}
		});
		
		
		
	});
	
</script>
<?php endif; ?>