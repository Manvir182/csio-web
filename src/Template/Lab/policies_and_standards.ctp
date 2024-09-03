<style>
	ul.accordion * {
		user-select: none;
	}
	ul.accordion {
		list-style: none;
		padding-left: 25px;
	}
	ul.accordion ul, ul.accordion ul li {
		list-style: none;
	}
	ul.accordion, ul.accordion ul {
		/*padding-left: 10px;*/

	}
	ul.accordion ul {
		padding-left: 19px;
		margin-top: -20px;
	}
	ul.accordion ul li {
		padding-left: 0px;
	}
	ul.accordion > li {
		margin-bottom:40px;
	}
	ul.accordion li, ul.accordion a {
		cursor: pointer;
	}

	ul.accordion li:before {
		content: '';
		position: absolute;
		margin-left: -20px;
		display: inline-block;
		height: 100px;
		font-size: 26px;
		width: 1px;
		border: 1px solid #ccc;
		
	}
	ul.accordion ul > li:last-child:before {
		content: '';
		position: absolute;
		margin-left: -20px;
		display: inline-block;
		height: 50px;
		font-size: 26px;
		width: 1px;
		border:none;
		border-left: 2px solid #ccc;
		border-bottom:2px solid #ccc;
		margin-top:-25px;
		width:10px;
		
	}
	
	ul.accordion > li > a.node {
		display: inline-block;
		padding: 18px 0px;
	}
	
	ul.accordion > li > a.node:before {
		content: '';
		position: relative;
		border: 1px dotted white;
		border-bottom: 1px solid white;
		border-top: 1px solid white;
		width: 3px;
		height: 3px;
		cursor: pointer;
		display: inline-block;
		background-color: black;
		box-sizing: border-box;
		transform: scale(3);
		margin-right: 5px;
		margin-left:-20px;
		top: -4px;
	}
	ul.accordion > li > a.collapsed.node:before {
		content: '';
		position: relative;
		border: 1px dotted white;
		width: 3px;
		height: 3px;
		cursor: pointer;
		display: inline-block;
		background-color: black;
		box-sizing: border-box;
		transform: scale(3);
		margin-right: 5px;
		margin-left: -20px;
		top: -4px;
	}

	/*
	 ul.accordion > li > a.collapsed:before {
	 content:'';
	 position:relative;
	 border: 1px dotted white;
	 width: 3px;
	 height: 3px;
	 cursor:pointer;
	 display:inline-block;
	 background-color: black;
	 box-sizing: border-box;
	 transform: scale(3);
	 margin-right:5px;
	 margin-left:-12px;
	 top:-4px;
	 }

	 */
	ul.accordion lh {
		border: 0px solid;
		margin-left: -50px;
		display: inline-block;
		background: #fff;
		border-bottom: 2px solid #ccc;
		padding: 4px 10px;
	}
	/*
	 ul.accordion li ul:before {
	 content: "";
	 position: absolute;
	 margin-left: -45px;
	 display: inline-block;
	 height: 1px;
	 width: 26px;
	 border: 1px solid #ccc;
	 }
	 */
	ul.accordion {
		border-left: 2px solid #ccc;
		padding-left: 18px;
	}

	ul.accordion ul > li:before {
		content: '-';
		font-weight: bold;
		color: #ccc;
	}
	ul.accordion .node {
		cursor: pointer;
	}
	ul.accordion img {
		max-height: 15px;
		max-width: 15px;
	}

	ul.accordion li ul a {
		display: block;
		padding: 12px 8px;
		color:#555 !important;
		
	}
	
	.treeContainer {
		padding-left: 50px;
	}
	span.Draft {
		color:red !important;
	}
	a.showDetails.active {
		color:#7ab2e0 !important;
	}
	
	a.showDetails:before {
		float:right;
		content:'';
		width:16px;
		height:16px;
		display:inline-block;
		visibility:hidden;
		opacity:0;
		border:8px solid #7ab2e0;
		border-top-color:transparent;
		border-right-color:transparent;
		border-bottom-color:transparent;
		margin-right:0px;
		margin-top:5px;
		
	}
	
	a.showDetails.active:before {
		margin-right:-16px;
		visibility:visible;
		opacity:1;
		transition:all .1s;
	}
	
	
	
	/*Scrollbar Style*/
	/* width */
	::-webkit-scrollbar {
	  width: 8px;
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
	}
	
	@page { 
	  size: A4 !important;
	  }
	 
	li span.Edit {
		float:right;
		color:#E9AB2E;
		margin-right:-20px;
		margin-top:13px;
		display:none;
	}
	li span.Edit:hover {
		color:#F62D51;
	}
	li:hover > span.Edit {
		display:inline-block;
	}
	
	li.media {
		border-bottom:1px solid #ccc;
		margin-top:8px;
	}
	li.media.bg-light {
		padding:8px; 4px;
	}
	
	li.media > span {
		display:inline-block;
		width:30px;
		height:30px;
		line-height: 30px;
		font-size:16px;
		background:#eee;
		color:#222;
		box-sizing:border-box;
		border:1px solid #ccc;
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
					<div class="row">
						<div class="col-md-12 p-3">
							<div class="row">
								<div class="col-4">
									<div class="treeContainer">
										<ul class="accordion" id="accord">
											<lh>
												<?php echo $company->company_name; ?>
											</lh>
											<li>
												<a data-toggle="collapse" class="node" data-target="#a1">Policies</a>
												<ul id="a1" class="collapse show in">
													<?php if(count($policies)==0): ?>
														<li class="">
															<a>
																<span class="text-secondary" style="font-size:14px;">No Policy defined yet</No></span>
															</a>
														</li>
													<?php else: ?>
														<?php foreach($policies as $policy): ?>
															<li class="policyListItem<?php echo $policy->id; ?>">
																<span class="Edit policy" data-id="<?php echo $policy->id; ?>" data-toggle="tooltip" data-placement="top" title="Modify"><i class="fa fa-edit"></i></span>
																
																
																<a class="showDetails" href="#" data-type="Policy" data-number="<?php echo $policy->document_number; ?>" data-id="<?php echo $policy->id; ?>">
																	<?php echo $policy->document_number; ?>
																	-
																	<?php echo $policy->name; ?>
																	<?php if($policy->status=='Draft'): ?>
																		<span class="<?php echo $policy->status; ?>">
																		(Draft)
																		</span>
																	<?php endif; ?>
																	<?php if($policy->approved=="Pending"): ?>
																		<span class="text-warning">
																		(Approval Pending)
																		</span>
																	<?php endif; ?>
																</a>
															</li>
														<?php endforeach; ?>
													<?php endif; ?>
													<li>
														<?php 
															echo $this->Html->link('<span class="btn btn-sm btn-secondary"> [+Add Policy] </span>',[
																'controller'=>'lab','action'=>'addPolicy'
															],[
																'escape'=>false,'style'=>'font-weight:bold;'
															]);
														?>
													</li>
												</ul>
											</li>
											<li>
												<a data-toggle="collapse" class="node" data-target="#a2">Standards</a>
												<ul id="a2" class="collapse show in">
													<?php if(count($standards)==0): ?>
														<li class="">
															<a>
																<span class="text-secondary" style="font-size:14px;">No Standard defined yet</No></span>
															</a>
														</li>
													<?php else: ?>
														<?php foreach($standards as $policy): ?>
															<li class="policyListItem<?php echo $policy->id; ?>">
																<span class="Edit standard" data-id="<?php echo $policy->id; ?>" data-toggle="tooltip" data-placement="top" title="Modify"><i class="fa fa-edit"></i></span>
																
																
																<a class="showDetails" href="#" data-type="Standard" data-number="<?php echo $policy->document_number; ?>" data-id="<?php echo $policy->id; ?>">
																	<?php echo $policy->document_number; ?>
																	-
																	<?php echo $policy->name; ?>
																	<?php if($policy->status=='Draft'): ?>
																		<span class="<?php echo $policy->status; ?>">
																			(Draft)
																		</span>
																	<?php endif; ?>
																	<?php if($policy->approved=="Pending"): ?>
																		<span class="text-warning">
																		(Approval Pending)
																		</span>
																	<?php endif; ?>
																</a>
																
															</li>
														<?php endforeach; ?>
													<?php endif; ?>
													<li>
														<?php 
															echo $this->Html->link('<span class="btn btn-sm btn-secondary"> [+Add Standard] </span>',[
																'controller'=>'lab','action'=>'addStandard'
															],[
																'escape'=>false,
																
															]);
														?>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-8">
									<div class="row">
										<div class='col-sm-3 '>
											<button class="btn btn-sm btn-primary export" onclick="exportHTML();" style="display:none;" type="button">
												<i class="fa fa-file-word"></i>
												Export
											</button>
											<button class="btn btn-sm btn-info showApprovals" style="display:none;" type="button">
												<i class="fa fa-thumbs-up"></i>
												Approvals 
												and
												<i class="fa fa-comments"></i> 
												Comments
											</button>
										</div>
										<div class='col-sm-6 text-center polTitle'>
											
										</div>
										<div class='col-sm-3 text-right delBtnContainer'>
											
										</div>
										
										
									</div>
									<div class="border border-primary polDetails" id="polDetails" style="height:11in;overflow-y:auto;">
										<div class="text-danger p-20">
											<h2 class="text-danger">The Policies And Standards Library</h2>
											<ul>
												<lh>You can</lh>
												<li>&mdash; Create and Manage your Policies and Standards</li>
												<li>&mdash; Map your Policies to risks and controls</li>
												<li>&mdash; Assess your Policy Risks to your Organization</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- map section closed -->

	<!-- content wrapper -->
</div>
<!--Comments Modal-->
<div class="modal" tabindex="-1" role="dialog" id="commentModal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Approvals &amp; Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="commentBox">
      		
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<!--Comments Modal ends-->


<script>
	 var rproto = "<?php echo $uProto; ?>";
	 var loading = '<div class="m-3"><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Loading...</span></div>';
	 var saving = '<div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Saving...</span></div>';
	
	 var exportFileName = '';
	$(function(){
		
		var delBtnContainer = $('.delBtnContainer');
		var delBtn;
		
		container = $('.polDetails');
		
		
		
		//loading the select policy or standard in the right panel
		$(document).on('click','.showDetails',function(e){
			$('.showDetails').removeClass('active');
			$('.export').hide();
			$('.showApprovals').attr('data-id','').hide();
			delBtnContainer.html(''); //removing delete button if placed for any policy/standard
			e.preventDefault();
			var psid = $(this).data('id');
			var btn = $(this);
			btn.addClass('active');
			container.html(loading);
			setTimeout(function(){
				//building url to fetch the data
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'getPolicyOrStandard'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				
				console.log("Url -"+thisUrl);
				
				//injecting the fetched data to the right panel
				container.load(encodeURI(thisUrl+"/"+psid),function(response,status,xhr){
					console.log(status);
					exportFileName = btn.data('type')+"_"+btn.data('number')+".doc";
					$('.export').show();
					$('.showApprovals').attr('data-id',psid).show();
					$('.data').val(response);
					$('.polTitle').html(btn.text());
					
					//putting delete button
					delBtn=`<button class="btn btn-sm btn-danger deletePolicy" data-id="`+psid+`"  type="button">
							<i class="fa fa-times"></i>
							Delete
						</button>`;
					delBtnContainer.html(delBtn);
					
				});
			},10);
			
			
			
		});
		
		$(document).on('click','.deletePolicy',function(){
			polId = $(this).data('id');
			btn = $(this);
			polData = container.html();
			swal({
			  title: "eGRC",
			  text: "All Related data will be deleted and can not be undone. Are you sure to delete ?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			}).then((willDelete) => {
				
				if (willDelete) {
					
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'deletePolicy'),false); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.ajax({
						url : thisUrl,
						method : "POST",
						headers: {
						    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
						 },
						data : {id:polId},
						
						beforeSend : function(xhr) {
							btn.addClass('blinking');
							btn.text("Deleting...");
						},
						success : function(data) {
							if(data==1){
								swal({
								  title: "eGRC",
								  text: "Successfully Deleted!",
								  icon: "success",
								  
								  dangerMode: false,
								});
								$('.export').hide();
								container.html('');
								$('.polTitle').html('');
								delBtnContainer.html('');
								
								$('.policyListItem'+polId).remove();
								
							} else {
								swal({
								  title: "eGRC",
								  text: "Sorry! Not deleted. Try again after page refresh.",
								  icon: "warning",
								  //buttons: true,
								  dangerMode: true,
								});
								container.html(polData);
							}
							
							btn.removeClass('blinking');
							btn.text("Delete");
						}
					});
				} 
				
				
			});
		});
		
		
		
		//enabling the Editing of the policy oor standard
		$(document).on('click','span.Edit',function(){
			var pid = $(this).data('id');
			if($(this).hasClass('policy')){
				var editUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'editPolicy'),true); ?>/"+pid;
			} else {
				var editUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'editStandard'),true); ?>/"+pid;
			}
			editUrl = editUrl.replace("http:", rproto);
			
			window.document.location.href=editUrl;			
		});
		
		
		$(document).on('click','.showApprovals',function(){
			var btn = $(this);
			var psid = $(this).data('id');
			var container = $('.commentBox');
			$('#commentModal').modal('show');
			container.html(loading);
			
			var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'getPolicyApprovalsWithComments'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				
				//injecting the fetched data to the right panel
				container.load(encodeURI(thisUrl+"/"+psid),function(response,status,xhr){
					$('.commentBox').html(response);
				});
			
			
		});
		
		$(document).on('click','.saveMyComment',function(){
			var comment = $(this).parents('.media-body').find('.newComment').val();
			var cmtBox = $(this).parents('.media-body').find('.newComment');
			var btn = $(this);
			var btnHtml = btn.html();
			var approval_request_id = btn.data('id');
			var cmtError = $(this).parents('.media-body').find('.commentError');
			
			if(comment){
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'saveApprovalComment'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				$.ajax({
					url : thisUrl,
					method : "POST",
					headers: {
					    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
					 },
					data : {approval_request_id:approval_request_id,comment:comment},
					
					beforeSend : function(xhr) {
						btn.prop('disabled',true).html(saving);
						console.log('Sent');
					},
					success : function(data) {
						btn.prop('disabled',false).html(btnHtml);
						
						if(data==0){
							cmtError.html("Sorry! Not saved. Try again.");
						} else {
							btn.parents('.card-body').find('.approvalComments').append(data);
							cmtBox.val('');
						}
					}
				});
			}
		});
		
		$('#commentModal').on('hidden.bs.modal', function (e) {
		  $('.commentBox').html('');
		});
		
		
	});
	function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title></title></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("polDetails").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = exportFileName;
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
</script>
