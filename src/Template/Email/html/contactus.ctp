<div style="margin-top:20px;padding:20px;text-align:center;">
	<?php echo $this->Html->image('cisologo.png',array('fullBase'=>true, 'style'=>'display:inline-block;mragin:10px auto;max-width:200px;')); ?>
</div>
<div style="width:80%;margin:10px auto;padding:25px;background:#ffffff;border-radius:8px; box-shadow:0 0 4px #222;text-align:center;">
	<?php echo $this->Html->image('email.png',array('fullBase'=>true, 'style'=>'display:inline-block;mragin:6px auto;max-width:100px;')); ?>
	<h2 align="center">
		&mdash; Cotnact Us Submission &mdash;
	</h2>
	<p style="text-align:center;color:#777777;">
		Hi,<br><br>

		<?php echo $name; ?> submitted the Contact us form on THE CLOUD CISO Website. Details are as below.
		<br>

	</p>
	<p>
		<table style="width:55%;display:block;margin:auto;">
			<tr>
				<th valign="top">Name</th>
				<td valign="top"><?php echo $name; ?></td>
			</tr>
			<tr>
				<th valign="top">Email</th>
				<td valign="top"><?php echo $email; ?></td>
			</tr>
			<tr>
				<th valign="top">Phone</th>
				<td valign="top"><?php echo $phone; ?></td>
			</tr>
			<tr>
				<th valign="top">Remarks</th>
				<td valign="top"><?php echo $remarks; ?></td>
			</tr>
		</table>
	</p>
	<hr style="border:none;border-top:2px solid #ccc;">
	<p style="background:#e6e7e7; text-align:center;padding:20px;">
		&copy; Copyrights THE CLOUD CISO 2019

	</p>
	<p align="center">
		<hr style="border:none;border-top:2px solid #ccc;">
		<center>
			<!-- www.thecloudciso.com | info@thecloudciso.com -->
			www.thecloudciso.com
		</center>
		<small>
			&mdash; This is an auto generated email. &mdash;
		</small>
	</p>
</div>