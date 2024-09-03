<ul class="nav nav-pills justify-content-center">
	<li class="nav-item">
		<?php
			echo $this->Html->link('eGRC Dashboard',[
				'controller'=>'lab','action'=>'dashboard','eGRC'
			],[
				'class'=>'nav-link eDashboard',
				'escape'=>false
			]);
		?>
	</li>
	<li class="nav-item">
		<?php
			echo $this->Html->link('Policies &amp; Standards Library',[
				'controller'=>'lab','action'=>'policiesAndStandards'
			],[
				'class'=>'nav-link policiesAndStandards',
				'escape'=>false
			]);
		?>
	</li>
	<li class="nav-item">
		<?php
			echo $this->Html->link('Risks &amp; Control Registry',[
				'controller'=>'lab','action'=>'riskControlRegistry'
			],[
				'class'=>'nav-link riskControlRegistry',
				'escape'=>false
			]);
		?>
	</li>
	<li class="nav-item">
		<?php
			echo $this->Html->link('Remediation Management',[
				'controller'=>'lab','action'=>'remediationManagement'
			],[
				'class'=>'nav-link remediationManagement',
				'escape'=>false
			]);
		?>
	</li>
	<li class="nav-item">
		<?php
			echo $this->Html->link('External Deficiency Management',[
				'controller'=>'lab','action'=>'deficiencyManagement'
			],[
				'class'=>'nav-link deficiencyManagement',
				'escape'=>false
			]);
		?>
	</li>
</ul>