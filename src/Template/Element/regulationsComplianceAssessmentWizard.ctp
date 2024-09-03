<style>
	/*form styles*/
	#msform {
		width: 80%px;
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
<div class="modal fade" tabindex="-1" role="dialog" id="wizardModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
      <h3 class="modal-title mb-0 text-white">Regulations and Compliance Assessment Wizard</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div style="position:static;min-height:600px;">
      		<!-- multistep form -->
			
			<?php echo $this->Form->create($activities,['id'=>'msform']); ?>
			  <!-- progressbar -->
			  <ul id="progressbar">
			    <li class="active">Select Activities</li>
			    <li>Review Activities</li>
			  </ul>
			  <!-- fieldsets -->
			  <fieldset>
			   
			    <h3 class="fs-subtitle">Select Your Company Activities</h3>
			    <ul>
			   		<?php foreach($regulatoryBodies as $rBody): ?>
						<li>
				    		<?php 
				        		echo $this->Form->control('regulatoryBody['.$rBody->id.'][]',[
				        			'value'=>$rBody->id,
				        			'id'=>'regulatoryBody'.$rBody->id,
				        			'label'=>array('text'=>" ".$rBody->name,),
				        			'type'=>'checkbox',
				        			'hiddenField'=>false,
				        			'class'=>'reguBody'
				        		]);
				        	?>
			    		</li>
			    	<?php endforeach; ?>
				</ul>
			   
			    
			    
			    <input type="button" name="next" class="next action-button" value="Next" />
			  </fieldset>
			  <fieldset>
			    <!-- <h2 class="fs-title">Personal Details</h2> -->
			    <h3 class="fs-subtitle">
			    	Based on your company activities you may be required to comply with these regulations 
			    	and/or industry standards.
			    </h3>
			    <input type="text" name="fname" placeholder="First Name" />
			    <input type="text" name="lname" placeholder="Last Name" />
			    <input type="text" name="phone" placeholder="Phone" />
			    <textarea name="address" placeholder="Address"></textarea>
			    <input type="button" name="previous" class="previous action-button" value="Previous" />
			    <input type="submit" name="submit" class="submit action-button" value="Submit" />
			  </fieldset>
			<?php echo $this->Form->end(); ?>
      	</div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script>
	
	$(function(){
		$('#wizardModal').modal('show');
		
				
		//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches
		
		$(".next").click(function(){
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
				}, 
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});
		
		$(".submit").click(function(){
			return false;
		})

		
	});
</script>