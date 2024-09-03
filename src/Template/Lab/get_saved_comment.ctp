<li class="media">
	<span class="rounded-circle mr-3 text-center"> 
		<?php echo strtoupper(substr($thisUser['first_name'],0,1)).strtoupper(substr($thisUser['last_name'],0,1)); ?>
	</span>
	<div class="media-body">
		<span class="badge badge-pill float-right" style="background:#eee;color:#222;">
    		<?php echo date('d-m-Y h:i a',strtotime($comment->created)); ?>
    	</span>
		<h5 class="mt-0 mb-1"><?php echo $thisUser['first_name']." ".$thisUser['last_name']; ?></h5>
		<p style="font-size:small;">
			<?php echo $comment->remarks; ?>
		</p>
	</div>
</li>