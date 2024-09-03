<style>
.text-left {
    text-align: left !important;
    color: black;
}
</style>
<div class="list-group text-left">
	<?php foreach($activities as $activity): ?>
		<?php if(count($activity->regulatory_bodies)==0 && $activity->name!='Banking Services' && $activity->name!='Government Contractor Defence Industrial Base (DIB)'){continue;} ?>
			<div class="list-group-item text-left">
				<span class="badge badge-info">
					<?php echo $activity->name; ?>
				</span>
				<br>
				<?php $sr=1; foreach($activity->regulatory_bodies as $rBody): ?>
					<b><?php echo $sr++; ?> &nbsp;:&nbsp;</b>
					<?php echo $rBody->name; ?>
					<br>
				<?php endforeach; ?>
				<?php if($activity->name=='Banking Services'): ?>
					<b><?php echo $sr++; ?> &nbsp;:&nbsp;</b>
					Federal Financial Institutions Examination Council (FFIEC)
				<?php endif; ?>
				<?php if($activity->name=='Government Contractor Defence Industrial Base (DIB)'): ?>
					<b><?php echo $sr++; ?> &nbsp;:&nbsp;</b>
					Cybersecurity Maturity Model Certification (CMMC)
				<?php endif; ?>
			</div>
	<?php endforeach; ?>	
</div>
