<div class="row">
	<div class="col-4"></div>
	<div class="col-4">
		<div class="card">
			<div class="card-header bg-info text-white">
				<span class="pull-right">
					<i class="fa fa-lock"></i>
				</span>
				<i class="fa fa-refresh"></i>
				Change Password
			</div>
			<div class="card-block">
				<?php echo $this->Form->create($user); ?>
				<?php 
					echo $this->Form->control('current_password',array(
						'class'=>'form-control pwd',
						'type'=>'password',
						'placeolder'=>'Current Password',
						'label'=>'Current Password'
					));
					echo $this->Form->control('new_password',array(
						'class'=>'form-control npwd',
						'type'=>'password',
						'placeolder'=>'New Password',
						'label'=>'New Password',
						'data-toggle'=>'popover',
						'data-trigger'=>'focus',
						'data-content'=>"Must be minimum 8 characters long.<br>Must contain 1 uppercase character,<br> 1 number and 1 special character",
						'data-placement'=>'right',
						'data-html'=>'true',
						'title'=>"",
						'data-original-title'=>"Password Rules"
					));
					echo $this->Form->control('confirm_password',array(
						'class'=>'form-control cpwd',
						'type'=>'password',
						'placeolder'=>'Confirm New Password',
						'label'=>'Confirm New Password',
						'data-toggle'=>'popover',
						'data-trigger'=>'focus',
						'data-content'=>"Must be minimum 8 characters long.<br>Must contain 1 uppercase character,<br> 1 number and 1 special character",
						'data-placement'=>'right',
						'data-html'=>'true',
						'title'=>"",
						'data-original-title'=>"Password Rules"
					));
				?>
				<div id="vstatus"></div>
				<div class="input">
					<button class="btn btn-info btn-lg btn-block cpwBtn" type="button">
						Change Password Now
					</button>
				</div>
				
				
				
				<?php echo $this->Form->end(); ?>
				<script>
					$(function(){
						$(document).on('keyup','.npwd, .cpwd',function(){
							var msg = "";
							var n = $('.npwd');
							var cn = $('.cpwd');
							if(n.val() || cn.val()){
								if(n.val()!=cn.val()){
									msg = '<div class="valMessage error">New and Confirm Passwords does not matched.</div>'
									$('.cpwBtn').prop('type','button');
									
								} else {
									msg = '<div class="valMessage success">Passwords matched.</div>';
									$('.cpwBtn').prop('type','submit');
								}
								$('#vstatus').html(msg);
							}
							
						});
						
					});
				</script>
			</div>
		</div>
	</div>
</div>
