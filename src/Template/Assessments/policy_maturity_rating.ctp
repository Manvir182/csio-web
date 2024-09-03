<div class="row page-titles">
    <div class="col-md-12 col-12">
        <ol class="breadcrumb">
        	<?php if($thisUser['role']=='Employee'): ?>
        		<li class="breadcrumb-item">
	            	<?php 
	            		echo $this->Html->link('Dashboard',array(
							'controller'=>'lab','action'=>'dashboard'
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item">
	            	<?php 
	            		echo $this->Html->link('Tracking',array(
							'controller'=>'Assessments','action'=>'tracking'
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item">
	            	<?php 
	            		if($asub_type=='Regulated'){
	            			echo $this->Html->link('View Assessments Details',array(
								'controller'=>'Assessments','action'=>'view',$aControl->assessments_regulatory_body->assessment_id,$asub_type
							));
	            		} else {
	            			echo $this->Html->link('View Assessments Details',array(
								'controller'=>'Assessments','action'=>'view',$aControl->assessment_id,$asub_type
							));	
	            		}
	            		
						//echo $aControl;
	            	?>
	            	
	            </li>
	            <li class="breadcrumb-item active">Perform Control &amp; Maturity Assessment</li>
        	<?php else: ?>
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
	            <li class="breadcrumb-item">
	            	<?php 
	            		if($asub_type=='Regulated'){
	            			echo $this->Html->link('View Assessments Details',array(
								'controller'=>'Assessments','action'=>'view',$aControl->assessments_regulatory_body->assessment_id,$asub_type
							));
	            		} else {
	            			echo $this->Html->link('View Assessments Details',array(
								'controller'=>'Assessments','action'=>'view',$aControl->assessment_id,$asub_type
							));	
	            		}
	            		
						//echo $aControl;
	            	?>
	            	
	            </li>
	            <li class="breadcrumb-item active">Perform Control &amp; Maturity Assessment</li>
            <?php endif; ?>
        </ol>
    </div> 
</div>
<div class="">
	<table class="table table-bordered bg-white">
		<tr>
			<td>
				<h5 class="text-themecolor">Assessment Submission Name</h5>
				<br>
				<?php echo $thisAssessment->name; ?>
			</td>
			<td>
				<h5 class="text-themecolor">Assessment Type</h5>
				<br>
				<?php echo $thisAssessment->sub_type; ?> (<?php echo $thisAssessment->atype; ?>)
			</td>
			<td>
				<h5 class="text-themecolor">Submission Date</h5>
				<br>
				<?php echo date('d-M-y h:i a',strtotime($thisAssessment->created)); ?> 
			</td>
			
			<td>
				<h5 class="text-themecolor">Submitted By</h5>
				<br>
				<?php echo $thisAssessment->signature; ?>
			</td>
			
		</tr>
	</table>
</div>
<?= $this->Form->create($aControl,['class'=>'cmrForm']) ?>

<div class="card" style="border:1px solid #ccc;">
	<div class="card-header">
		<h4 class="m-b-0 p-b-0">
			Update Compliance Statuses for <span class="text-danger"><?= $aControl->name ?></span> requirements
		</h4>
	</div>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="bg-light text-themecolor" style="">Control Requirement</th>
				<th class="bg-light text-themecolor" style="width:200px;">Artifact File</th>
				<th class="bg-light text-themecolor" style="width:20%;">Refs/Narrative</th>
				<th class="bg-light text-themecolor" style="width:20%;">
					Compliance Status
					<i class="fa fa-info-circle text-info" data-toggle="modal" data-target='#effectivenessModal'></i>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($aControl->egrc_assessment_policy_statements as $creq): ?>
				<tr>
					<td <?php echo strlen($creq->name)>10?'style="white-space:pre-line;vertical-align:top;word-wrap: break-word;"':''; ?> style="width:250px;">
						<?= $creq->name ?>
					</td>
					<td data-id="<?= $creq->id ?>" style="vertical-align: top;">
						<!--
						<?php if(strlen($creq->artifact)>0): ?>
							<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="<?php echo $creq->artifact; ?>">
								Artifact
							</button>
						<?php else: ?>
							&mdash;
						<?php endif; ?>
						-->
						<button class="btn btn-sm btn-warning showArtifact" <?php echo $creq->artifact==""?"style='display:none;'":''; ?> type="button" data-file="<?php echo $creq->artifact; ?>">
							Artifact
						</button>
						<button class="btn btn-sm btn-danger deleteArtifact" <?php echo $creq->artifact==""?"style='display:none;'":''; ?> type="button" data-toggle="tooltip" title="Delete">
							<i class="fa fa-times"></i>
						</button>
						<button class="btn btn-sm btn-info reUploadArtifact" type="button" style="float:right;">Upload</button>
						<input type="file" style="display:none;" class="form-control input-sm artifact" data-id="<?php echo $creq->id; ?>" accept=".pdf">
					</td>
					<td style="vertical-align: top;">
						<!--<input type="text" class="form-control input-sm instantSaveRef" data-table="assessment_control_requirements" data-id="<?php echo $creq->id; ?>" value="<?= $creq->reference ?>"> -->
						<textarea class="form-control input-sm instantSaveRef" style="white-space:pre-line;" data-table="egrc_assessment_policy_statements" data-id="<?php echo $creq->id; ?>"><?= $creq->reference ?></textarea>
					</td>
					<td style="vertical-align: top;width:250px;">
						<select class="form-control rComp" required name="rCompliance[<?= $creq->id ?>]">
							<option value="">-- Select --</option>
							<?php foreach($compStatuses as $cStatus): ?>
								<option <?= $creq->compliance_status!=$cStatus->name?:'selected' ?> value="<?= $cStatus->name ?>~<?= $cStatus->score ?>"><?= $cStatus->name ?></option>
							<?php endforeach; ?>
						</select>
					</td>
					
				</tr>
			<?php endforeach; ?>
			
			
		</tbody>
	</table>
</div>
<br>
<div class="card" style="border:1px solid #ccc;">
	<div class="card-header">
		<h4 class="m-b-0 p-b-0">
			Update Maturity Ratings for Control Area
			<span class="text-danger"><?= $aControl->name ?></span>
		</h4>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-themecolor">Overall Control Compliance Status
						<i class="fa fa-info-circle text-info" data-toggle="modal" data-target='#effectivenessModal'></i>
					</th>
					<th class="text-themecolor">Maturity Ratings
						<!-- <i class="fa fa-info-circle text-info" data-toggle="modal" data-target='#maturityDescriptionsModal'></i> -->
						
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="width:40%;">
						<select class="form-control cComp" required name="cStatus">
							<option value="">--Select--</option>
							<?php foreach($compStatuses as $cStatus): ?>
								<option <?= $cStatus->name!=$aControl->compliance_status?:'selected' ?> value="<?= $cStatus->name ?>~<?= $cStatus->score ?>"><?= $cStatus->name ?></option>
							<?php endforeach; ?>
						</select>
					</td>
					<td class="p-0">
						<table class="table table-borderless m-b-0">
							<tbody>
								<?php foreach($aControl->egrc_assessment_maturity_scores as $mAttribute): ?>
									<tr>
										<td>
											<label class="control-label">
												<?php echo $mAttribute->maturity_attribute; ?>
												<i class="fa fa-info-circle text-info maturityAttrInfo" data-id="<?php echo str_replace(" ","",$mAttribute->maturity_attribute); ?>"></i>
											</label>
										</td>
										<td>
											<?php 
												$ttips = $descs[$mAttribute->maturity_attribute];
											?>
											<div class="dropdown mOptions">
											  <button class="btn btn-outline-primary btn-block dropdown-toggle mAttrBtn text-left" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											   <span>
											   		<?= !empty($mAttribute->maturity_option)?$mAttribute->maturity_option:'Please Select One' ?>
											   </span>
											  </button>
											  <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton" style="min-width:300px;">
											  	<li class="dropdown-item mAttrOption" data-value="" data-toggle="tooltip" title="Please Select One" data-placement="right" style="cursor:pointer;">
											    	Please Select One
											    </li>
											    <?php $selectedMO=""; ?>
											  	<?php foreach($mAttributeOptions as $mOption): ?>
												    <li class="dropdown-item mAttrOption" data-value="<?php echo $mOption->name; ?>~<?php echo $mOption->score; ?>" data-toggle="tooltip" title="<?php echo $ttips[$mOption->name]; ?>" data-placement="right" style="cursor:pointer;">
												    	<?php echo $mOption->name; ?>
												    </li>
												    <?php if(empty($selectedMO)): ?>
												    	<?php $selectedMO=($mOption->name==$mAttribute->maturity_option?$mOption->name.'~'.$mOption->score:"") ?>
												    <?php endif; ?>
											    <?php endforeach; ?>
											  </ul>
											</div>
											<input type="hidden" name="mOptions[<?= $mAttribute->id ?>]" required class="mAttrOptionField mAttr" value="<?= $selectedMO ?>">
											<!--
											<select name="mOptions[<?= $mAttribute->id ?>]" required class="form-control mAttr">
												<option value="">-- Select --</option>
												<?php foreach($mAttributeOptions as $mOption): ?>
													<option <?= $mOption->name!=$mAttribute->maturity_option?:"selected" ?> value="<?php echo $mOption->name; ?>~<?php echo $mOption->score; ?>"><?php echo $mOption->name; ?></option>
												<?php endforeach; ?>
											</select>
											-->
										</td>		
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>						
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>
</div>
<br>
<center>
	<button class="btn btn-success" type="submit" <?php echo $aControl->status=='Completed'?"disabled":''; ?>>
		<i class="fa fa-check"></i>
		Update Now
	</button>
</center>
<br><br>
<?= $this->Form->end() ?>
<!--artifact Modal-->
<div class="modal fade" id="artifactModal" tabindex="-1" role="dialog" aria-labelledby="artifactModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
        	Artifact File
        	<span class="artifactLoader text-danger"><i class="fa fa-spinner fa-spin"></i> <span class="blinking">Loading file. Please wait...</span></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        <embed style="width:100%;height:9in;" id="artifactFrame" src="" ></embed>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--artifact modal ends-->
<script>
	var rproto = "<?php echo $uProto; ?>";
	var saving='<span class="bg-info badge"><i class="fa fa-spinner fa-spin"></i><span class="blinking">Saving</span></span>';
	var saved='<span class="bg-success badge"><i class="fa fa-check"></i><span>Saved</span></span>';
	var notSaved='<span class="bg-danger badge"><i class="fa fa-check"></i><span>Not Saved</span></span>';
	
	$(function(){
		
		$(document).on('click','.mAttrOption',function(){
			selectedOption = $(this).data('value');
			selectedOptionText = $(this).text();
			$(this).parents('.mOptions').find('.mAttrBtn > span').html(selectedOptionText);
			$(this).parents('.mOptions').siblings('.mAttrOptionField').val(selectedOption);
		});
		
		<?php if($thisAssessment->status=='Completed'): ?>
			$('.form-control').prop('disabled',true);
			$('.reUploadArtifact').remove();
			$('.deleteArtifact').remove();
			$('.instantSaveRef').prop('disabled',true);
		<?php endif; ?>
		
		$(document).on('submit','.cmrForm',function(frm){
			//var status = $('.cmrStatus').val();
			//if(status=='Completed'){
				var flag = true;
				var mAttr = $('.mAttr');
				var rComp = $('.rComp');
				
				mAttr.each(function(){
					if($(this).val()==""){
						flag = false;
						//break;
					}
				});
				rComp.each(function(){
					if($(this).val()==""){
						flag = false;
						//break;
					}
				});
				
				if(flag==false){
					swal({
					  title: 'eGRC',
					  text: "Kindly update all fields.",
					  icon: "error",
					  button: "Okay",
					});
					frm.preventDefault();
				}
			//}
			
		});
		
		$(document).on('click','.showArtifact',function(){
			artifact = $(this).attr('data-file');
			if(artifact){
				$('#artifactFrame').prop('src',artifact);
				$('#artifactModal').modal('show');
				setTimeout(function(){
					$('.artifactLoader').hide();
				},5000);
			}
			
		});
		$('#artifactModal').on('hidden.bs.modal', function (e) {
		  $('#artifactFrame').prop('src',"");
		  $('.artifactLoader').show();
		})
		
		
		
		//reuploading artifact
		$(document).on('click','.reUploadArtifact',function(){
			var parent = $(this).parents('td');
			//parent.find('.artifactUploaded').val('');
			parent.find('.artifact').prop('type','file');
			parent.find('.falert').remove();
			parent.find('.artifact').trigger('click');
		});
		
		//handling artifact file upload.
		$(document).on('change','.artifact',function(){
			//removing error message if present
			$(this).parent('td').find('.falert').remove();
			finput=$(this);
			var acrid = finput.attr('data-id');
			var file = $(this).get(0).files[0];
			var name = file.name;
			//console.log(file);
			
			var form_data = new FormData();
			form_data.append("id",acrid);
			form_data.append("afile", file);
			
			//console.log(form_data);
			var ext = name.split('.').pop().toLowerCase();
			if(jQuery.inArray(ext, ['pdf']) == -1){
				$('<span class="falert alert-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
				$(this).val('');
			} else {
				//console.log(file);
				finput.parent('td').find('.falert').remove();
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'uploadArtifactForEgrc'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				$.ajax({
					url : thisUrl,
					method : "POST",
					headers: {
					    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
					 },
					data : form_data,
					contentType : false,
					cache : false,
					processData : false,
					beforeSend : function(xhr) {
						$('<span class="falert alert-warning"><div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Uploading...</span></div></span>').insertAfter(finput);
					},
					success : function(data) {
						//console.log(data);
						//return;
						finput.parent('td').find('.artifactUploaded').val('');
						if(data==3){
							finput.parent('td').find('.falert').remove();
							$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
							finput.val('');
						} else if(data==4){
							finput.parent('td').find('.falert').remove();
							$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> No file provided.</span>').insertAfter(finput);
							finput.val('');
						} else if(data==0){
							finput.parent('td').find('.falert').remove();
							$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Sorry! Try again.</span>').insertAfter(finput);
							finput.val('');
						} else if(data.indexOf("http")>-1){
							//finput.parent('td').find('.artifactUploaded').val(data);
							//finput.prop('type','hidden');
							//finput.prop('required',false);
							finput.parent('td').find('.falert').remove();
							finput.parent('td').find('.showArtifact').remove();
							finput.parent('td').find('.deleteArtifact').remove();
							$('<button class="btn btn-sm btn-warning showArtifact" type="button" data-file="'+data+'">Artifact</button>').insertBefore(finput);
							$('<button class="btn btn-sm btn-danger deleteArtifact" type="button" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></button>').insertBefore(finput);
							
							$('<span class="falert badge bg-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div> <span class="badge sr-only bg-warning text-white reUploadArtifact pointer"><i class="fa fa-redo"></i> Re-upload</span> </span>').insertAfter(finput);
							$('[data-toggle="tooltip"]').tooltip();
							finput.val('');
						} else {
							finput.parent('td').find('.falert').remove();
							$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Sorry! Something went wrong. Try again.</span>').insertAfter(finput);
							finput.val('');
						}
					}
				});
				
			}
		}); 
		//articact file upload ends
		
		//handling artifact delete.
		$(document).on('click','.deleteArtifact',function(){
			//removing error message if present
			$(this).parent('td').find('.falert').remove();
			finput=$(this);
			var acrid = finput.parent('td').attr('data-id');
			
			
			var form_data = new FormData();
			form_data.append("id",acrid);
			
			
			if(confirm("Are you sure to delete this Artifact.")){
				//console.log(file);
				finput.parent('td').find('.falert').remove();
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'deleteArtifactEgrc'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				$.ajax({
					url : thisUrl,
					method : "POST",
					headers: {
					    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
					 },
					data : form_data,
					contentType : false,
					cache : false,
					processData : false,
					beforeSend : function(xhr) {
						$('<span class="falert alert-warning"><div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Deleting...</span></div></span>').insertAfter(finput);
					},
					success : function(data) {
						finput.parent('td').find('.artifactUploaded').val('');
						if(data==1){
							finput.parent('td').find('.falert').remove();
							finput.parent('td').find('.showArtifact').remove();
							finput.parent('td').find('.deleteArtifact').remove();
							
							$('<span class="falert badge bg-success"><div><i class="fa fa-check"></i> Successfully Deleted.</div></span>').insertAfter(finput);
							finput.val('');
						} else {
							finput.parent('td').find('.falert').remove();
							$('<span class="falert badge bg-danger"><i class="fa fa-info"></i> Sorry! Something went wrong. Try again.</span>').insertAfter(finput);
							finput.val('');
						}
					}
				});
				
			}
		}); //delete artifact ends
		
		
		
		var ref;
		$(document).on('focus','.instantSaveRef',function(){
			ref = $(this).val();
			console.log("focused");
		});
		$(document).on('blur','.instantSaveRef',function(){
			var field = $(this);
			var parent = field.parents('td');
			parent.find('.badge').remove();
			if(field.val()){
				
				
				postData = {
					table:field.attr('data-table'),
					id:field.attr('data-id'),
					value:field.val()
				};
				
				
				if(ref!=field.val()){
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'saveInstantUpdate'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.ajax({
						url : thisUrl,
						method : "POST",
						headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},
						
						data : postData,
						beforeSend:function(){
							parent.append(saving);
						},
						success:function(resp){
							console.log(resp);
							parent.find('.badge').remove();
							if(resp==1){
								parent.append(saved);
								
							} else {
								parent.append(notSaved);
								
							}
						}
					});
				}
			} 
			
		});
		
		var selIndex = 0;
		$(document).on('click focus','.cComp, .rComp',function(){
			selIndex = $(this).prop('selectedIndex');
		});
		
		
		$(document).on('change','.cComp, .rComp',function(){
			var changed = $(this);
			var cComp = $('.cComp');
			var cval = cComp.val();
			var rComp = $('.rComp');
			//var ncArray = new Array();
			var thisComp = cComp.val();
			thisComp = thisComp.substring(0,thisComp.indexOf('~'));
			var msg = 'You are not able to conclude "'+thisComp+'" ';
				msg+=' for Control Area "<?= $aControl->name ?>" because some control requirements does not have appropriate Compliance Status.';
				msg+=' Please review Compliance status of control requirements or select'; 
				msg+=' appropriate Overall control compliance status.';
					
			var rCompEmpty=0;
			var rError = 0; 
			var rCompValues = new Array();
			rComp.each(function(){
				ele = $(this);
				if($(this).val()){
					tc = $(this).val().split('~');
					rCompValues.push(tc[1])
				}
				if(changed.hasClass('cComp') && ele.val()==""){
					rCompEmpty++;
				}
			});
			var maxRCompValue = Math.max(...rCompValues);
			var minRCompValue = Math.min(...rCompValues); 
			if(cval){
				tcv = cval.split('~');
				
				if(((tcv[1]==<?php echo $fullComplianceScore; ?> || tcv[1]==<?php echo $fullComplianceScore2; ?>) && minRCompValue<<?php echo $fullComplianceScore2; ?>) || (tcv[1]>maxRCompValue || tcv[1]<minRCompValue)){
					rError++;
				}
			}
			
			
			if(rCompEmpty>0){
				swal({
				  title: 'eGRC',
				  text: "Compliance status for each control requirement should be updated before updating overall Control Compliance status.",
				  icon: "error",
				  button: "Okay",
				});
				changed.prop('selectedIndex',selIndex);
				return false;
			}
			
			if(rError>0){
				swal({
				  title: 'eGRC',
				  text: msg,
				  icon: "error",
				  button: "Okay",
				});
				changed.prop('selectedIndex',selIndex);
				return false;
			}
			
			
		});
		
		
		/*
		$(document).on('change','.cComp, .rComp',function(){
			var changed = $(this);
			var cComp = $('.cComp');
			var cval = cComp.val();
			var rComp = $('.rComp');
			var ncArray = new Array('Non Compliant~0','Partially Compliant~1.5');
			var thisComp = cComp.val();
			thisComp = thisComp.substring(0,thisComp.indexOf('~'));
			var msg = 'You are not able to conclude "'+thisComp+'" ';
				msg+=' for Control Area "<?= $aControl->name ?>" because some control requirements are partially compliant or';; 
				msg+=' non-compliant. Please review Compliance status of control requirements or select'; 
				msg+=' appropriate Overall control compliance status of Partially Compliant or Non-compliant.';
				
			var rCompEmpty=0;
			var rError = 0; 
			rComp.each(function(){
				ele = $(this);
				//console.log("Executed.");
				if(ncArray.indexOf(ele.val())>-1){
					if(cval && ncArray.indexOf(cval)<0){
						rError++;
					}
				}
				if(changed.hasClass('cComp') && ele.val()==""){
					rCompEmpty++;
				}
			});
			
			if(rCompEmpty>0){
				swal({
				  title: 'eGRC',
				  text: "Compliance status for each control requirement should be updated before updating overall Control Compliance status.",
				  icon: "error",
				  button: "Okay",
				});
				changed.prop('selectedIndex',selIndex);
				return false;
			}
			
			if(rError>0){
				swal({
				  title: 'eGRC',
				  text: msg,
				  icon: "error",
				  button: "Okay",
				});
				changed.prop('selectedIndex',selIndex);
				return false;
			}
			
			
		}); */
		
		
		
		setInterval(function(){
			$('.badge').fadeOut('slow');
		},5000);
		
	});
</script>