<div class="row page-titles">
    <div class="col-md-8 col-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'users','action'=>'dashboard'
					));
            	?>
            </li>
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Risk Severity Scales',array(
						'controller'=>'RiskSeverityScales','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Add Risk Severity Scale</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',array(
					'action'=>'index'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				
				
    		?>
    		
    	</div>
    </div>                  
</div>
<div class="row">
	<div class="col-3"></div>

	<div class="col-6">
	    <div class="card">
	    	<div class="card-header">
	    		<h5 class="m-b-0">Add Risk Severity Scale</h5>
	    	</div>
			<div class="card-body p-20">
			    <?= $this->Form->create($riskSeverityScale) ?>
			    <?php 
	        		$this->Form->setTemplates([
					    'inputContainer' => '<div class="col-md-12 m-t-10">
					        {{content}} </div>'
					]);
	        	?>
		        <?php
		            echo $this->Form->control('severity_scale',array('class'=>'form-control input-sm','required'=>true));
		            echo $this->Form->control('financial_loss',array('class'=>'form-control input-sm'));
		            echo $this->Form->control('customer',array('class'=>'form-control input-sm'));
		            echo $this->Form->control('regulatory',array('class'=>'form-control input-sm'));
		            echo $this->Form->control('business_disruption',array('class'=>'form-control input-sm'));
		            echo $this->Form->control('headline_risk',array('class'=>'form-control input-sm'));
					echo "<div class='row'><div class='col-md-4'>";
		            echo $this->Form->control('score',array('class'=>'form-control input-sm','min'=>'0','required'=>true));
					echo "</div></div>";
		        ?>
			    <div class="col-md-12 m-t-30">
			    	<button class="btn btn-inverse" type="submit">
			    		<i class="fa fa-check"></i>
			    		Save Now
			    	</button>
			    </div>
			    <?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>