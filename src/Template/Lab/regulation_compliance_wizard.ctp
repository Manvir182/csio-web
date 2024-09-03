<style>
	/*form styles*/
	#msform {
		width: 50%;
		margin: 50px auto;
		text-align: center;
		position: relative;
	}
	#msform fieldset {
		background: white;
		border: 0 none;
		border-radius: 3px;
		box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
		padding: 20px 30px;
		box-sizing: border-box;
		width: 80%;
		margin: 0 10%;
		
		/*stacking fieldsets above each other*/
		position: relative;
	}
	/*Hide all except first fieldset*/
	#msform fieldset:not(:first-of-type) {
		display: none;
	}
	/*inputs*/
	#msform input, #msform textarea {
		padding: 15px;
		border: 1px solid #ccc;
		border-radius: 3px;
		margin-bottom: 10px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		font-size: 13px;
	}
	/*buttons*/
	#msform .action-button {
		width: 100px;
		background: #27AE60;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 1px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px;
	}
	#msform .action-button:hover, #msform .action-button:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
	}
	/*headings*/
	.fs-title {
		font-size: 15px;
		text-transform: uppercase;
		color: #2C3E50;
		margin-bottom: 10px;
	}
	.fs-subtitle {
		font-weight: normal;
		font-size: 13px;
		color: #666;
		margin-bottom: 20px;
	}
	/*progressbar*/
	#progressbar {
		margin:0px;
		padding:0px;
		margin-bottom: 30px;
		overflow: hidden;
		/*CSS counters to number the steps*/
		counter-reset: step;
	}
	
	#progressbar li {
		list-style-type: none;
		color: #233149;
		text-transform: uppercase;
		font-size: 14px;
		width: 33.33%;
		//float: left;
		display:inline-block;
		position: relative;
	}
	#progressbar li:before {
		content: counter(step);
		counter-increment: step;
		width: 24px;
		line-height: 24px;
		display: block;
		font-size: 18px;
		color: #233149;
		background: #ccc;
		border-radius: 3px;
		margin: 0px auto 2px auto;
		font-weight:bold;
	}
	/*progressbar connectors*/
	#progressbar li:after {
		content: '';
		width: 92%;
		height: 2px;
		background: #ccc;
		position: absolute;
		left: -46%;
		top: 9px;
		z-index: 0; /*put it behind the numbers*/
	}
	#progressbar li:first-child:after {
		/*connector not needed before the first step*/
		content: none; 
	}
	/*marking active/completed steps green*/
	/*The number of the step and the connector before it = green*/
	#progressbar li.active,
	#progressbar li {
		z-index: 2;
	}
	#progressbar li.active:before,  #progressbar li.active:after{
		background: #233149;
		color: white;
		
	}
</style>
<div class="white-bg">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Regulations and Compliance Assessment Wizard</h5>
               </div>
               
           </div>
           <div class="col-md-12" style="padding:5px;position:static;min-height:960px !important;">
           	<?php echo $this->Form->create($activities,['id'=>'msform']); ?>
			  <!-- progressbar -->
			  <ul id="progressbar">
			    <li class="active">Select Activities</li>
			    <li>Review Activities</li>
			  </ul>
			  <!-- fieldsets -->
			  <fieldset>
			   
			    <h2 class="fs-title">Select Your Company Activities</h2>
			    
			    <ul>
			   		<?php foreach($activities as $activity): ?>
						<li style="text-align:left;">
				    		<?php 
				        		echo $this->Form->control('activities['.$employee->company->id.'][]',[
				        			'value'=>$activity->id,
				        			'id'=>'compActivity'.$activity->id,
				        			'label'=>array('text'=>" ".$activity->name,'style'=>'display:block;'),
				        			'type'=>'checkbox',
				        			'hiddenField'=>false,
				        			'style'=>'width:auto;',
				        			'class'=>'activities '.($activity->name=='Unsure'?'unsure':''),
				        			'checked'=>in_array($activity->id,$compActivitiesIds)
				        		]);
				        	?>
			    		</li>
			    	<?php endforeach; ?>
			    	<!--
			    	<li style="text-align:left;">
			    		<?php 
			    			/*
			        		echo $this->Form->control('activities['.$employee->company->id.'][]',[
			        			'value'=>'0',
			        			'id'=>'compActivity0',
			        			'label'=>array('text'=>" Unsure",'style'=>'display:block;'),
			        			'type'=>'checkbox',
			        			'hiddenField'=>false,
			        			'style'=>'width:auto;',
			        			'class'=>'activities unsure',
			        			'checked'=>empty($employee->company->activities)
			        		]); */
			        	?>
		    		</li> -->
				</ul>
			   
			    
			    
			    <input type="button" name="next" class="next action-button" value="Next" />
			  </fieldset>
			  <fieldset>
			    <!-- <h2 class="fs-title">Personal Details</h2> -->
			    <h2 class="fs-title">
			    	Based on your company activities you may be required to comply with these regulations 
			    	and/or industry standards.
			    </h2>
			    
			    <div class="relatedRegulations">
			    	
			    </div>
			    
			    
			    <input type="button" name="previous" class="previous action-button" value="Previous" />
			    <input type="submit" name="submit" class="submit action-button" value="Submit" />
			    
			  </fieldset>
			<?php echo $this->Form->end(); ?>
           	
           </div>
          
               
                
           </div>      
       </div>
        <!-- content wrapper -->
        <br>
  </div> 
  <!-- main content closed -->
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script>
	var rproto = "<?php echo $uProto; ?>";
	$(function(){
		$('#wizardModal').modal('show');
		
				
		//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches
		
		$(".next").click(function(){
			if(!$('.activities:checked').length){  
				swal({
				  title: "IRCA",
				  text: "Kindly choose at least one activity.",
				  icon: "warning",
				  //buttons: true,
				  dangerMode: true,
				});
				return false;
			}
			if(animating) return false;
			animating = true;
			
			current_fs = $(this).parent();
			next_fs = $(this).parent().next();
			
			//activate next step on progressbar using the index of next_fs
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
			
			//show the next fieldset
			next_fs.show(); 
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50)+"%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({
		        'transform': 'scale('+scale+')',
		        'position': 'absolute'
		      });
					next_fs.css({'left': left, 'opacity': opacity});
				}, 
				duration: 800, 
				complete: function(){
					current_fs.hide();
					animating = false;
					loadRelatedRegulations();
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});
		
		$(".previous").click(function(){
			if(animating) return false;
			animating = true;
			
			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();
			
			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
			
			//show the previous fieldset
			previous_fs.show(); 
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1-now) * 50)+"%";
					//3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'left': left});
					previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
				}, 
				duration: 800, 
				complete: function(){
					current_fs.hide();
					animating = false;
					$('.relatedRegulations').html('');
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});
		
		
		
		function loadRelatedRegulations(){
			var activity_ids = new Array();
			var unsure = false;
			$('.activities:checked').each(function(){
				activity_ids.push($(this).val());
				if($(this).hasClass('unsure')){
					//unsure = true;
				}
			});
			if(unsure){
				$('.relatedRegulations').html(`<div class="alert alert-info">Are you sure to continue with <b>Unsure</b> option?</div>`);
			} else {
				activity_ids = activity_ids.toString();
				
				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'lab','action'=>'getActivityRegulations'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				$.ajax({
					url : thisUrl,
					method : "POST",
					headers: {
					    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
					 },
					data : {activity_ids:activity_ids},
					beforeSend : function(xhr) {
						$('.relatedRegulations').html(`<span class="text-danger font-20"><i class='fa fa-spin fa-asterisk'></i>  <span class="blinking"> Loading...</span></span>`);
			
					},
					success : function(data) {
						$('.relatedRegulations').html(data);
					}
				});
			}
			
			
			
		}
		

		$(document).on('change','.activities',function(){
			cbox = $(this);
			if(cbox.hasClass('unsure')){
				if(cbox.prop('checked')){
					$('.activities:not(.unsure)').prop('checked',false).prop('disabled',true);
				} else {
					$('.activities.unsure').prop('checked',false).prop('disabled',false);
					$('.activities:not(.unsure)').prop('disabled',false);
				}
				
			} else {
				$('.activities.unsure').prop('checked',false).prop('disabled',false);
				$('.activities:not(.unsure)').prop('disabled',false);
			}
		});



		
	});
</script>