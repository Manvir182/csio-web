<div class="main-content white-bg">
       <div class="container-fluid questionborder">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Assessment Submission Form</h5>
               </div>
           </div>
           <div class="row questionborder1 ">
           	   <?php echo $this->Form->create('Assessment',['class'=>'w-100 assessmentForm','type'=>'file','autocomplete'=>'off']); ?>
           	   <?php
           	   		//echo $this->Form->control('client_id',['value'=>'1','type'=>'hidden']);
           	   ?>
               		<?php
		        		$this->Form->setTemplates([
						    'inputContainer' => '
						        {{content}} ',
						    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
							'radioWrapper' => '<li>{{label}}<li>'
						]);
		        	?>
                    <div class="col-md-12">
                        <div class="row cisobpadding tool-form-submission">
                        	<div class="col-md-12">
                        		<div class="row">
                        			<div class="col-sm-3">
                        				<h6 class="questions" style="padding-top:5px;">Assessment Submission Name</h6>
                        			</div>
                        			<div class="col-sm-6">
                        				<?php
		                                	echo $this->Form->control('name',array(
		                                		'class'=>'form-control input-sm',
		                                		'label'=>false,
		                                		'style'=>'width:100%;',
		                                		'required'=>true
		                                	));
		                                ?>
                        			</div>
                        		</div>
                                <br>

                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">
                            		Assessment Classification
                            		<i class="fa fa-info-circle text-info" style="margin-top:10px;" data-toggle="popover"
                            			data-trigger="hover"
										data-content="<b>Self Assessment </b>: This type of assessment is conducted by your team/company to assess your risk internally.<br><br><b>Independent</b>: This type of assessment is an objective assessment conducted by an independent third party/THE CLOUD CISO to assess risks. Selecting this option delegates the assessment to the independent third party/THE CLOUD CISO for conducting the assessment."
										data-placement='right'
										data-html='true'
										title=""
										data-original-title="Select a classification"
                            		></i>
                            	</h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<?php
                            		echo $this->Form->control('atype',[
                            			'label'=>false,
                            			'class'=>'form-control input-sm atype',
                            			'type'=>'select',
                            			'options'=>array(''=>'-- Select --','Self'=>'Self Assessment','Independent'=>'Independent Assessment'),
                            			'required'=>true
                            		]);
                            	?>
                            </div>
                            <div class="col-12" style="padding:6px;"></div>

                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">
                            		Assessment Type
                            		<i class="fa fa-info-circle text-info" style="margin-top:10px;" data-toggle="popover"
                            			data-trigger="hover"
										data-content="<b>Generalized Assessment </b>: A general set of controls that cover industry standardized risks areas based on the CObIT framework is used to offer broad assessment of the control environment.<br><br><b>Regulated Assessment</b>: An assessment that is specific to a particular regulatory body. In some instances organizations may opt to perform regulator specific assessments.<br><br><b>FFIEC Regulated Assessment</b>: Specialised Assessment for Federal Financial Institutions Examination Council (FFIEC).<br><br><b>Other</b>: A custom assessment wherein you may define very specific risks and controls that you would like assessed using our risk assessment tool."
										data-placement='right'
										data-html='true'
										title=""
										data-original-title="Select an assessment type"
                            		></i>
                            	</h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12 m-t-10">
                            	<?php
                            		echo $this->Form->control('sub_type',[
                            			'label'=>false,
                            			'class'=>'form-control input-sm subtype',
                            			'type'=>'select',
                            			'options'=>array(''=>'-- Select --','Generalized'=>'Generalized Assessment','Regulated'=>'Regulated Assessment','FFIEC Regulated'=>'FFIEC Regulated Assessment','Other'=>'Other Assessment'),
                            			'required'=>true
                            		]);
                            	?>
                            </div>
                            <div class="col-12" style="padding:6px;"></div>
                            <div class="assessmentInputs col-12" style="padding:35px;"></div>
                            <div class="col-md-12 col-sm-12 sr-only " >
                            	<div class="form-row">
                                  <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
		                            	<h6 class="questions">Final Submission</h6>
		                            </div>
		                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12 m-t-10">
		                            	<?php
		                            		/*
                                        	echo $this->Form->control('status',array(
												'type'=>'select','class'=>'form-control input-sm',
												'required'=>true,
												'label'=>false,
												'empty'=>array(''=>'-- Select --'),
												'options'=>array('Submitted'=>'Final Submission to perform assessment','Submitting'=>'Save to continue later.')
											));
											*/
                                        ?>
		                            </div>
                            	</div>

                            </div>
                            <div class="col-md-12 col-sm-12 " style="display:none;"><br><br>
                                <center><button type="button" class="cisobtn cisoblue cisopadding cisoblue-outline  sperator-line"><span class="text-blue-bg">Begin Assessment</span></button></center>
                            </div>
                            <div class="col-md-12 cisosp">

                                <div class="row">
                                    <div class="col-md-3">

                                             <div class="image-upload-prw" style=" text-align: center;width:100%;">
                                                <?php
                                                	echo $this->Form->control('signature',array(
														'type'=>'text','class'=>'form-control text-center',
														'required'=>true,
														'label'=>false,
														'value'=>$thisUser['first_name']." ".$thisUser['last_name'],
														'style'=>'height:100%;border:none;',
														'readonly'=>true
													));

                                                ?>

                                             </div>

                                    </div>
                                    <div class="col-md-2">
                                        <center>
                                             <div class="currentdate">
                                             	<?php echo date('M d, Y',time()); ?>
                                             </div>
                                        </center>
                                    </div>
                                    <div class="col-md-7 text-right">
		                               <button type="submit" class="cisobtn cisoblue  cisoblue-outline submit-form-btn" style="padding:5px 10px;">Start</button>
		                            </div>
                                </div>
                            </div>


                        </div>
                    </div>
               <?php $this->Form->unlockField('GenControl'); ?>
               <?php $this->Form->unlockField('GenRisk'); ?>

               <div class="nRiskScalesUsed"></div>
               <?php echo $this->Form->end(); ?>
           </div>
       </div>
        <!-- content wrapper -->
  </div>

<!--FFIEC Risk Factors Information Modal-->
  <div class="modal fade" id="fRiskFactorModal" tabindex="-1" role="dialog" aria-labelledby="artifactModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLongTitle">Risk Scales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
    	 <table class="table table-bordered m-b-0 m-0 fRisksDataTable">
    	 	<thead>
    	 		<tr class="table-active">
    	 			<th style="width:20%;">Risk Attribute</th>
    	 			<th class="">Minor</th>
    	 			<th class="">Moderate</th>
    	 			<th class="">Significant</th>
    	 			<th class="">Major</th>
    	 			<th class="">Extreme</th>
    	 		</tr>
    	 	</thead>
    	 	<?php foreach($fRisks as $fk=>$frisk): ?>

	 			<?php foreach($frisk->ffiec_risk_factors as $frk=>$fRiskFactor): ?>
	 				<tbody class="frisk<?php echo $fk.$frk; ?>" style="display:none;">
    	 				<tr>
    	 					<td style="color:#000;"><?php echo $fRiskFactor->name; ?></td>
    	 					<td style="color:#666;"><?php echo $fRiskFactor->minor; ?></td>
    	 					<td style="color:#666;"><?php echo $fRiskFactor->moderate; ?></td>
    	 					<td style="color:#666;"><?php echo $fRiskFactor->significant; ?></td>
    	 					<td style="color:#666;"><?php echo $fRiskFactor->major; ?></td>
    	 					<td style="color:#666;"><?php echo $fRiskFactor->extreme; ?></td>
    	 				</tr>
	 				</tbody>
	 			<?php endforeach; ?>

    	 	<?php endforeach; ?>
    	 </table>
      </div>
    </div>
  </div>
</div>
<!--FFIEC Risk Factors Information Modal ends-->
<script>
	var rproto = "<?php echo $uProto; ?>";
	$(function(){
		//***//
  		$(document).on('click','.fRiskFactorsInfo',function(){
			var iBtn = $(this);
			var riskId = $(this).data('key');
			console.log(riskId);
			var effectiveTbody = $('.fRisksDataTable').find('.frisk'+riskId);
			$('#fRiskFactorModal').modal('show');
			//console.log(effectiveTbody);
			effectiveTbody.show();
		});
		$('#fRiskFactorModal').on('hidden.bs.modal', function (e) {
		  $('.fRisksDataTable').find('tbody').hide();
		});
		//***//
	});
</script>
<script>
	//for FFIEC assessment
  	$(function(){

  		var maturityScales = {'Minor':['Baseline','Evolving'],'Minimum':['Baseline','Evolving'],'Moderate':['Baseline','Evolving','Intermediate'],'Significant':['Evolving','Intermediate','Advanced'],'Major':['Intermediate','Advanced','Innovation'],'Extreme':['Advanced','Innovation']};

  		$(document).on('change','.ffIRiskLevelSelect',function(){
  			selectedLevel = $(this).val();
  			$(this).prop('class','').addClass('form-control ffIRiskLevelSelect');
  			$(this).parent('td').prop('class','').addClass('form-group');
  			if(selectedLevel){
  				sl = selectedLevel.split('~');
  				$(this).prop('class','').addClass('form-control ffIRiskLevelSelect '+sl[1]);
  				$(this).parent('td').prop('class','').addClass('form-group '+sl[1]);
  				$(this).trigger('blur');
  			}

  			updateInherent($(this).parents('.riskCard'));
  			//console.log(selectedLevel);
  		});

  		function updateInherent(element){
  			var avg = 0;
  			var isAll = 0;
  			var score = 0;
  			element.find('.ffIRiskLevelSelect').each(function(){
  				sLevel = $(this).val();
  				if(sLevel){
	  				slvl = sLevel.split('~');
	  				score = slvl[0];
	  				scale = slvl[1];
	  				avg=avg+parseFloat(score);
	  				isAll++;
	  			}

  			});

  			score = (avg/isAll).toFixed(2);
  			iScore = parseFloat(score);
  			if(isAll==element.find('.ffIRiskLevelSelect').length){
  				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRiskScaleByScore2'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				var pval = element.find('.btn.inherent').html();
				$.ajax({
					url : thisUrl+"/"+score,
					method : "POST",
					headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},
					data : {},
					beforeSend:function(){
						element.find('.btn.inherent').html('<i class="fa fa-spin fa-spinner"></i>');
						//console.log(this.url);
					},
					success:function(resp){
						//console.log(resp);
						element.find('.btn.inherent').html(resp);
						element.find('.btn.inherent').prop('class','').addClass('btn btn-sm btn-secondary inherent badge-pill '+resp).html(resp);
						element.find('.inherentField').val(iScore+"~"+resp);

					},
					error:function(){
						element.find('.btn.inherent').html(pval);
						element.find('.inherentField').val('');
					}
				});
  			} else {
  				element.find('.btn.inherent').prop('class','').addClass('btn btn-sm btn-secondary inherent badge-pill Incomplete').html('Incomplete');
  				element.find('.inherentField').val('');
  			}




  			//updating target dropdown when all inherent is selected
  			var score2 = 0;
  			var totalScore=0;
  			var isAllTotal=0;
  			$('.ffIRiskLevelSelect').each(function(){
  				sLev = $(this).val();
  				if(sLev){
	  				slvl = sLev.split('~');
	  				score = slvl[0];
	  				scale = slvl[1];
	  				totalScore=totalScore+parseFloat(score);
	  				isAllTotal++;
	  			}

  			});
  			score2 = (totalScore/isAllTotal).toFixed(2);
  			//score2 = parseFloat(score2);
  			if(isAllTotal==$('.ffIRiskLevelSelect').length){

  				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRiskScaleByScore2'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				var pval2 =$(document).find('.fmTargetBtn').html();
				$.ajax({
					url : thisUrl+"/"+score2,
					method : "POST",
					headers: {'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>},
					data : {},
					beforeSend:function(){
						$(document).find('.fmTargetBtn').html('<i class="fa fa-spin fa-spinner"></i>');
						console.log(this.url);
					},
					success:function(resp){
						var matOptions = maturityScales[resp];
		  				//mtOptions = `<div class="dropdown-menu fmTargetBtnDropdown" aria-labelledby="fmTargetBtndropdownMenuButton">`;
		  				mtOptions = ``;
		  				console.log(matOptions);
		  				for(ab=0;ab<matOptions.length;ab++){
		  					mtOptions +=`<a class="dropdown-item fmTargetAnchor" href="#">`+matOptions[ab]+`</a>`;
		  				}
						//mtOptions +=`</div>`;
		  				$(document).find('.fmTargetBtn').html(matOptions[0]).addClass('btn-danger');
		  				//$(document).find('.fmTargetBtn').parent('div.dropdown').append(mtOptions);
		  				$(document).find('.fmTargetBtnDropdown').html(mtOptions);
		  				$(document).find('input.mlevels').val(matOptions[0]);

		  				$(document).find('#fOverAllInherent').html(resp).addClass(resp);


					},
					error:function(){
						$(document).find('input.mlevels').val('');
						$(document).find('.fmTargetBtn').addClass('Incomplete').html('Incomplete').removeClass('btn-danger');
  						$(document).find('.fmTargetBtnDropdown').html('');
  						$(document).find('#fOverAllInherent').html('Incomplete').prop('class','btn btn-sm btn-secondary btn-block badge-pill');
					}
				});



  			} else {
  				$(document).find('input.mlevels').val('');
  				$(document).find('.fmTargetBtn').addClass('Incomplete').html('Incomplete').removeClass('btn-success');
  				//$(document).find('.fmTargetBtn').parent('div.dropdown').find('.fmTargetBtnDropdown').remove();
  				$(document).find('.fmTargetBtnDropdown').html('');
  				$(document).find('#fOverAllInherent').html('Incomplete').prop('class','btn btn-sm btn-secondary btn-block badge-pill');
  			}
  		}

  		$(document).on('click','a.fmTargetAnchor',function(e){
  			e.preventDefault();
  			$(this).parents('div.dropdown').find('.fmTargetBtn').html($(this).html());
  			$(document).find('input.mlevels').val($(this).html());
  		});



  	});

  </script>



<!--custom Risk Scale Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="customScalesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Custom Severity Scales</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row form-group">
        	<div class="col-8">
        		<label><b>Risk Severity Scale Name</b></label>
        	</div>
        	<div class="col-4">
        		<label><b>Score</b></label>
        	</div>
        </div>
        <div class="nnrow">
	        <div class="nrow">
		        <div class="row form-group">
		        	<div class="col-1">
		        		<button class="btn btn-sm btn-danger remNr" type="button">
		        			<i class="fa fa-times-circle"></i>
		        		</button>
		        	</div>
		        	<div class="col-7">
		        		<input type="text" class="form-control input-sm nGenRScales" name="GenRisk[rScales][name][]" placeholder="Severity Scale Name" required>
		        	</div>
		        	<div class="col-4">
		        		<input type="number" class="form-control input-sm nGenRScaleScores" min="0" name="GenRisk[rScales][score][]" placeholder="0.0" required>
		        	</div>
		        </div>
	        </div>
        </div>
        <div class="myBtn">
        	<button class="btn btn-sm btn-inverse nScaleBtn" type="button"><i class="fa fa-plus"></i> New</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary useNewRiskScales">Confirm Now</button>
      </div>
    </div>
  </div>
</div>
<script>
  	$(function(){


  		var nr = $('.nrow').html();
  		$(document).on('click','.nScaleBtn',function(){
  			$('.nrow').append(nr);
  		});
  		$(document).on('click','.remNr',function(){
  			$(this).parents('.row').remove();
  		});
  		$('#customScalesModal').on('hidden.bs.modal', function (e) {
		  $('.nrow').remove();
		  $('.nnrow').append("<div class='nrow'>"+nr+"</div>");
		  thisRbId=false;
  		});

  		$(document).on('click','.useNewRiskScales',function(){
  			nscales = $('#customScalesModal').find('.nGenRScales');
  			nscores = $('#customScalesModal').find('.nGenRScaleScores');
  			nscl = new Array();
  			nscr = new Array();
  			nscales.each(function(){
  				nscl.push($(this).val());
  			});
  			nscores.each(function(){
  				nscr.push($(this).val());
  			});

  			nsOptions = "<option value=''>--Select--</option>";
  			for(i=0;i<nscl.length;i++){
  				if(nscl[i].length>0){
  					nsOptions+="<option value='"+nscl[i]+"'>"+nscr[i]+"-"+nscl[i]+"</option>";
  				}
  			}

  			if(thisRbId==false){
  				$('.nRScales').html('');
  				$('.nRScales').html(nsOptions);
  				thisRb = "";
  				//inserting into the form to submit along with
      			nscales.each(function(){
      				$(this).clone().appendTo('.nRiskScalesUsed');
      			});
      			nscores.each(function(){
      				$(this).clone().appendTo('.nRiskScalesUsed');
      			});

      			newRisk = '<tr><td><input type="text" class="form-control input-sm" required name="GenRisk'+thisRb+'[inherent][name][]" value="" placeholder="Enter Risk Name">';
      			newRisk += '</td><td><select required class="form-control input-sm nRScales" name="GenRisk'+thisRb+'[inherent][scale][]">'+nsOptions;
				newRisk += '</select></td><td><button class="remRisk btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i></button></td></tr>';

  			} else {
  				$('.rBodyCard'+thisRbId).find('.nRScales').html('');
  				$('.rBodyCard'+thisRbId).find('.nRScales').html(nsOptions);
  				thisRb = "["+thisRbId+"]";

  				//inserting into the form to submit along with
  				$('.nRiskScalesUsed').find('[name*="GenRisk'+thisRb+'"]').remove();
      			nscales.each(function(){
      				$(this).clone().prop('name','GenRisk'+thisRb+'[rScales][name][]').appendTo('.nRiskScalesUsed');
      			});
      			nscores.each(function(){
      				$(this).clone().prop('name','GenRisk'+thisRb+'[rScales][score][]').appendTo('.nRiskScalesUsed');
      			});

      			rnewRisk = '<tr><td><input type="text" class="form-control input-sm" required name="GenRisk'+thisRb+'[inherent][name][]" value="" placeholder="Enter Risk Name">';
      			rnewRisk += '</td><td><select required class="form-control input-sm nRScales" name="GenRisk'+thisRb+'[inherent][scale][]">'+nsOptions;
				rnewRisk += '</select></td><td><button class="remRisk btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i></button></td></tr>';
      			reguNewRisk['"'+thisRbId+'"'] = rnewRisk;
  			}

  			$('.nRiskScalesUsed').find('input').prop('type','hidden');


  			$('#customScalesModal').modal('hide');
  		});

  	});
  </script>
<!-- risk scale modal ends-->
<!--Risk Description Model-->
<div class="modal" tabindex="-1" role="dialog" id="riskDescModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Risk Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<textarea class="form-control newRiskDesc"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info addNewRiskNow">Add New Risk Domain</button>
      </div>
    </div>
  </div>
</div>
<!--Risk description model ends here-->

<script>

    	$(function(){
    		pageLoader = $('.pageLoader');

    		$(document).on('click','.customRiskModalBtn',function(){
    			if($(this).hasClass('regulated')){
    				thisRbId = $(this).attr('data-rbid');
    			} else {
    				thisRbId = false;
    			}
    			$('#customScalesModal').modal('show');
    		});

    		var loading = '<div><i class="fa fa-spin fa-spinner"></i> <span class="blinking">Loading...</span></div>';
    		newRisk='';
    		//loading risks and controls for particular assessment type (Generalized and Others)
    		$(document).on('change','.atype',function(){
    			$('.subtype').trigger('change');
    		});
    		$(document).on('change','.subtype',function(){
    			if($('.atype').val()){
	    			var subtype = $(this);
	    			var subtypeval = $(this).val();
	    			var atype = $('.atype').val();
	    			var container = $('.assessmentInputs');

	    			if(subtypeval){
	    				container.html(loading);
	    				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRisksAndControls'),true); ?>";
						thisUrl = thisUrl.replace("http:", rproto);
						//console.log(encodeURI(thisUrl+"/"+subtypeval+"/"+atype));
	    				container.load(encodeURI(thisUrl+"/"+subtypeval+"/"+atype),function(response,status,xhr){
	    					//1. creating element to handle new Risk Profile addition for generalized assessment submission
	    					newRisk = container.find('.newRiskRow').html();
							container.find('.newRisk').remove();
							if(atype=='Self'){
								$('.artifact').prop('required',false);
							}
							//1. ends

							//loading the regulatory body if request redirected from
							//Regulation Exposure Table
							<?php if(!empty($reguBodyId)): ?>
					   			<?php if(is_numeric($reguBodyId)): ?>
					   				$('input.reguBody#regulatoryBody<?php echo $reguBodyId; ?>').trigger('click');
					   			<?php endif; ?>
					   		<?php endif; ?>
	    				});

	    			} else {
	    				container.html("");
	    			}
    			} else {

    				$('.atype').focus().trigger('click');
    				$(this).val('');
    			}
    		});

    		//event handler to add new Risk profile for generalized assessment submission
    		riskPtable='';
    		riskRgid ="";
    		riskDesc = "";
    		$(document).on('click','.addNewRisk',function(){
    			$('#riskDescModal').modal('show');
    			riskPtable = $(this).parents('table').find('.risks');
    			riskDesc = $('.newRiskDesc').val();
    			if($(this).hasClass('regulated')){
    				riskRgid = $(this).attr('data-rbid');
    			}
    			/*
    			ptable = $(this).parents('table').find('.risks');
    			if($(this).hasClass('regulated')){
    				rgid = $(this).attr('data-rbid');
    				$(reguNewRisk['"'+rgid+'"']).appendTo(ptable)
    			} else {
    				$(newRisk).appendTo(ptable);
    			}
    			*/
			});

			$(document).on('keyup','.newRiskDesc',function(){
				var str = $(this).val();
				str = str.replace(/[^a-z0-9\s]/gi, '');
				//str = str.replace(/'/g,'');
				$(this).val(str);
			});

			$(document).on('click','.addNewRiskNow',function(){
				thisRiskDesc = "title='"+$('.newRiskDesc').val()+"'";
				thisRiskDescValue = "value='"+$('.newRiskDesc').val()+"'";
    			if(riskRgid!=""){
    				arisk = reguNewRisk['"'+riskRgid+'"'];
    				arisk = arisk.replace('desctitle',thisRiskDesc).replace('descvalue',thisRiskDescValue);
    				//arisk = arisk.replace('descvalue',thisRiskDescValue);
    			} else {
    				arisk = newRisk.replace('desctitle',thisRiskDesc).replace('descvalue',thisRiskDescValue);
    				//arisk = newRisk.replace('descvalue',thisRiskDescValue);
    			}
    			$(arisk).appendTo(riskPtable);
    			$('[data-toggle="tooltip"]').tooltip();

    			riskPtable = "";
    			riskRgid = "";
    			thisRiskDesc = "";
    			$('.newRiskDesc').val('');
    			$('#riskDescModal').modal('hide');
			});

    		$(document).on('click','.remRisk',function(){
    			/*
				if(confirm("Are you sure ?")){
					$(this).parents('tr').remove();
				}
				*/
				swal({
				  title: "eGRC",
				  text: "Are you sure to delete ?",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				   $(this).parents('tr').remove();
				  }
				});
			});


			//handling artifact file upload.
			$(document).on('change','.artifact',function(){
				//removing error message if present
				$(this).parent('td').find('.falert').remove();
				finput=$(this);

				var file = $(this).get(0).files[0];
				var name = file.name;
				//console.log(file);

				var form_data = new FormData();
				form_data.append("afile", file);
				var ext = name.split('.').pop().toLowerCase();
				if(jQuery.inArray(ext, ['pdf']) == -1){
					$('<span class="falert alert-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
					$(this).val('');
				} else {
					//console.log(file);
					finput.parent('td').find('.falert').remove();
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'uploadArtifact'),true); ?>";
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
							finput.parent('td').find('.artifactUploaded').val('');
							if(data==3){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Only PDF file are supported.</span>').insertAfter(finput);
								finput.val('');
							} else if(data==4){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> No file provided.</span>').insertAfter(finput);
								finput.val('');
							} else if(data==0){
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Sorry! Try again.</span>').insertAfter(finput);
								finput.val('');
							} else if(data.indexOf("http")>-1){
								finput.parent('td').find('.artifactUploaded').val(data);
								finput.prop('type','hidden');
								finput.prop('required',false);
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-success"><div><i class="fa fa-check"></i> Successfully Uploaded.</div> <span class="badge bg-warning text-white reUploadArtifact pointer"><i class="fa fa-redo"></i> Re-upload</span> </span>').insertAfter(finput);
							} else {
								finput.parent('td').find('.falert').remove();
								$('<span class="falert alert-danger"><i class="fa fa-info"></i> Sorry! Something went wrong. Try again.</span>').insertAfter(finput);
								finput.val('');
							}
						}
					});

				}
			});
			//reuploading artifact
			$(document).on('click','.reUploadArtifact',function(){
				var parent = $(this).parents('td');
				parent.find('.artifactUploaded').val('');
				parent.find('.artifact').prop('type','file');
				parent.find('.falert').remove();
				parent.find('.artifact').trigger('click');
			});

			//articact file upload ends


			//control area add/remove functions
			//variables "noe" is declared in the get_risk_and_control.ctp file
			$(document).on('click','.addNewControl',function(){
				btn = $(this);
				parent = $(this).parents('.card-block').find('.accordion');
				var atype = $('.atype').val();
				noe = parent.find('.controlCard');
				noe = noe.length;
				rbid = "";
				brbid = "";
				regu ="";
				if(btn.hasClass('regulated')){
					rbid="["+btn.attr('data-rbid')+"]";
					brbid = btn.attr('data-rbid');
					regu = "regulated";
				}



				//adding New Control
				crow = '<div class="card controlCard" style="border:1px solid #ccc;" data-number="'+(noe)+'">';
				crow += '<div class="card-header" id="controlHeadingNew'+(noe+1)+'" style="padding:4px 8px;">';
				crow += '<button class="btn btn-danger btn-sm remControl float-right" type="button"><i class="fa fa-times-circle"></i></button><h6 style="cursor:pointer;" ><button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#controlCollapseNew'+(noe+1)+'" aria-expanded="true" aria-controls="controlCollapseNew'+(noe+1)+'">';
				crow += '<i class="fa fa-chevron-down"></i></button>';
				crow += '<input type="text" style="width:50%;display:inline-block;" placeholder="Enter Control Area Name" required class="form-control input-sm" name="GenControl'+rbid+'[control]['+(noe)+'][name][]" value="">';
				crow += '</h6></div><div id="controlCollapseNew'+(noe+1)+'" class="collapse show" aria-labelledby="controlHeadingNew'+(noe+1)+'" data-parent="#controlRequirements'+brbid+'">';
				crow += '<div class="card-bod"><textarea class="form-control" placeholder="Enter Control Description" required name="GenControl'+rbid+'[control]['+(noe)+'][description][]"></textarea><table class="table table-borderless table-hover">';
				crow += '<thead><tr class="bg-light text-dark"><th>Control Requirements</th><!--<th>Artifact File</th>-->';
				crow += '<!--<th>Reference</th>--></tr></thead><tbody class="controlReqBody"></tbody></table><p style="padding:8px;"><button class="btn btn-sm btn-primary addNewControlReq '+regu+'" data-rbid="'+brbid+'" type="button"><i class="fa fa-plus-square"></i>';
				crow += ' Add Control Requirement</button></p></div></div></div>';
				parent.append(crow);
				//alert(crow);
				noe++;
			});

			//adding control requirement to particular control
			$(document).on('click','.addNewControlReq',function(){
				btn=$(this);
				parent = $(this).parents('.controlCard');
				noc = parent.attr('data-number');

				var reqrd = "";
				if(atype=='Self'){
					reqrd="required";
					readonly="";
				} else {
					if($('.subtype').val()!="Other"){
						readonly="disabled";
					} else {
						readonly="";
					}

				}
				rbid = "";
				if(btn.hasClass('regulated')){
					rbid="["+btn.attr('data-rbid')+"]";
				}
				//adding new control requirement to control
				rqRow = '<tr><td style="width:40%;"><input type="text" class="form-control input-sm" name="GenControl'+rbid+'[control]['+noc+'][req][name][]" required value="">';
				rqRow += '</td><!--<td style="width:25%;"><input type="hidden" class="artifactUploaded" name="GenControl'+rbid+'[control]['+noc+'][req][artifact][]">';
				rqRow += '<input type="file" '+reqrd+' '+readonly+' class="form-control input-sm artifact" accept=".pdf">-->';
				rqRow += '</td><!--<td ><input type="text" '+readonly+' class="form-control input-sm" placeholder="Reference info" name="GenControl'+rbid+'[control]['+noc+'][req][reference][]"></td>--></tr>';
				//alert(rqRow);
				parent.find('.controlReqBody').append(rqRow);
			});

			//removing control area
			$(document).on('click','.remControl',function(){
				var btn = $(this);
				/*
				if(confirm("Are you sure to remove this Control ?")){
					btn.parents('.controlCard').remove();
				}
				*/
				swal({
				  title: "eGRC",
				  text: "Are you sure to remove this Control ?",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				   btn.parents('.controlCard').remove();
				  }
				});
			});
			//controlarea add/remove functions ends





			//for regulated assessments
			reguRisksControls="";
			reguNewRisk = {"test":"test value"};
			$(document).on('click','.thisRegulatoryBodies .reguBody',function(){
				var rbody = $(this);
				var atype = $('.atype').val();
				pageLoader.addClass('open');
				rcontainer = $('.reguRisksControls');
				if(rbody.prop('checked')==true){
					//if selected any regulatory body
					var thisUrl = "<?php echo $this->Url->build(array('controller'=>'assessments','action'=>'getRisksAndControlsRegulated'),true); ?>";
					thisUrl = thisUrl.replace("http:", rproto);
					$.get(thisUrl+"/"+rbody.val()+"/"+atype,function(resp){
						//return resp;
						pageLoader.removeClass('open');
						rcontainer.append(resp);

						//console.log(resp);
						resp = $('.rBodyCard'+rbody.val());
						rnewRisk = resp.find('.newRiskRow').html();
						resp.find('.newRisk').remove();
						reguNewRisk['"'+rbody.val()+'"']=rnewRisk;
						//console.log(reguNewRisk);

						resp.find('[data-toggle="collapse"]').trigger('click');

					});
    			} else {
    				/*
					if(confirm("All of your data updated for this regulatory body will be lost. Are you sure ?")){
						rcontainer.find('.rBodyCard'+rbody.val()).remove();
					} else {
						rbody.prop('checked',true);
					}
					*/
					swal({
					  title: "eGRC",
					  text: "All of your data updated for this regulatory body will be lost. Are you sure?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) {
					    rcontainer.find('.rBodyCard'+rbody.val()).remove();
					  } else {
					  	rbody.prop('checked',true);
					  }
					});

					pageLoader.removeClass('open');
				}

			});

			//removing regulatory body for assessment
			$(document).on('click','.remRBody',function(){
				$($(this).attr('data-rbody')).trigger('click');
			});

			//for regulated assessments ends here


		   $(document).on('submit','.assessmentForm',function(e){
		   		//at least 1 regulatory body must be selected for
		   		//regulated assessments
		   		var regus = $('.reguBody');
		   		var required = 0;
		   		if(regus.length>0){
		   			regus.each(function(){
		   				if($(this).prop('checked')==true){
		   					required++;
		   				}
		   			});
		   			if(required==0){
		   				//alert("Kindly select atleast one regulatory body.");
		   				swal({
						  title: "eGRC",
						  text: "Kindly select atleast one regulatory body.",
						  icon: "warning",
						  buttons: true,
						  //dangerMode: true,
						});
		   				e.preventDefault();
		   				return;
		   			}


		   		}


		   		//cehcking if control area requirement present
		   		//for each control
		   		var controlCards = $('.controlCard');
		   		required=0;
		   		controlCards.each(function(){
		   			var a = $(this).find('.controlReqBody tr');
		   			if(a.length==0){
		   				required++;
		   			}
		   			//console.log(required);
		   		});
		   		if(required>0){
		   			swal({
					  title: "eGRC",
					  text: "Control Area must have at least 1 Control Area Requirement. Kindly check your custom control areas.",
					  icon: "warning",
					  buttons: true,
					  //dangerMode: true,
					});
		   			e.preventDefault();
		   		}

		   		//checking for ffiec assessment


		   		if($('.inherentField').length>0){
		   			var freq=0;
		   			$('.inherentField').each(function(){
		   				if($(this).val()==""){
		   					freq++;
		   				}
		   			});
		   			$('.ffIRiskLevelSelect').each(function(){
		   				if($(this).val()==""){
		   					freq++;
		   				}
		   			});
		   			if(freq>0){
			   			swal({
						  title: "iRCA",
						  text: "Inherent Risk Calculations must be done before Starting the Assessment. Kindly check and try again.",
						  icon: "warning",
						 // buttons: true,
						  dangerMode: true,
						});
			   			e.preventDefault();
			   		}

		   		}


		   });

		}); //document ready ends

   	$(function(){
   		$('[data-toggle="popover"]').popover();

   		<?php if(!empty($reguBodyId)): ?>
   			$('select.atype').val('Self');
   			<?php if(is_numeric($reguBodyId)): ?>
   				$('select.subtype').val('Regulated').trigger('change');
   			<?php elseif($reguBodyId=='ffiec'): ?>
   				$('select.subtype').val('FFIEC Regulated').trigger('change');
   			<?php endif; ?>
   		<?php endif; ?>

   	});
</script>
