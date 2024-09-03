<div style="margin-top:20px;padding:20px;text-align:center;">
	<?php echo $this->Html->image('cisologo.png',array('fullBase'=>true, 'style'=>'display:inline-block;mragin:10px auto;max-width:200px;')); ?>
</div>
<div style="width:80%;margin:10px auto;padding:25px;background:#ffffff;border-radius:8px; box-shadow:0 0 4px #222;">
	<?php echo $this->Html->image('email.png',array('fullBase'=>true, 'style'=>'display:inline-block;mragin:6px auto;max-width:100px;')); ?>
	<h2 align="center">
		&mdash; Invitation as a Analyst. &mdash;
	</h2>
	<p style="text-align:center;color:#777777;">
		Hi,
		<br>
		<br>
		We are glad to invite as a analyst at THE CLOUD CISO Cyber Risk Management services.  <br>
		<hr style="border:none;border-top:2px solid #ccc;">
		<p>
			<b> Invitation link: </b><br>
			<?php
				echo $this->Html->link('Click here to access',array(
					'controller'=>'analysts','action'=>'signup',$invitation_token,'_full' => true
				));
			?>
		</p>

	</p>
	<hr style="border:none;border-top:2px solid #ccc;">
	<p style="background:#e6e7e7; text-align:center;padding:20px;">
		&copy; Copyrights THE CLOUD CISO 2019

	</p>
	<hr style="border:none;border-top:2px solid #ccc;">
	<p>
		<center>
			<!-- www.thecloudciso.com | info@thecloudciso.com -->
			www.thecloudciso.com
		</center>
	</p>
</div>