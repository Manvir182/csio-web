<div style="margin-top:20px;padding:20px;text-align:center;">
	<?php echo $this->Html->image('cisologo.png',array('fullBase'=>true, 'style'=>'display:inline-block;mragin:10px auto;max-width:200px;')); ?>
</div>
<div style="width:80%;margin:10px auto;padding:25px;background:#ffffff;border-radius:8px; box-shadow:0 0 4px #222;">
	<?php echo $this->Html->image('email.png',array('fullBase'=>true, 'style'=>'display:inline-block;mragin:6px auto;max-width:100px;')); ?>
	<h2 align="center">
		&mdash; Reset Password Request. &mdash;
	</h2>
	<p style="text-align:center;color:#777777;">
		We have received the request to reset password. We at CISO are really concerned about security.
		If you didn't submit the request for password reset. kindly contact us on <a href="mailto:info@thecloudciso.com">info@thecloudciso.com</a>
		<br>
		<br>
		Kindly click below link to reset your password.
	</p>
	<hr style="border:none;border-top:2px solid #ccc;">
	<p>
		<b>Password Reset link:</b><br>
		<?php
			echo $this->Html->link('Click here to reset password',array(
				'controller'=>'companies','action'=>'resetPassword',$password_reset_token,'_full' => true
			));
		?>
	</p>
	<p>
		The above link is valid till <?php echo date('d-M-Y h:i A',strtotime($token_expiry_date)); ?> only.
	</p>

	<p style="background:#e6e7e7; text-align:center;padding:20px;">
		&copy; Copyrights THE CLOUD CISO 2019
	</p>
</div>