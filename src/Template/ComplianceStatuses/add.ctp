<div class="row page-titles">
    <div class="col-8 align-self-center">
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
            		echo $this->Html->link('Compliance Statuses',array(
						'controller'=>'ComplianceStatuses','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Add Compliance Status</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="complianceStatuses form large-9 medium-8 columns content">
	<div class="row">
		<div class="col-4"></div>
		<div class="col-4">
			<div class="card card-default">
				<div class="card-header">
					Add Compliance Status
				</div>
				<div class="card-body p-10">
					<?php
						$this->Form->setTemplates([
						    'inputContainer' => '<div class="form-group"> {{content}} </div>',
						]);
					?>
					<?= $this->Form->create($complianceStatus) ?>
				   
				        <?php
				            echo $this->Form->control('name',['class'=>'form-control','required'=>true]);
							echo $this->Form->control('score',['class'=>'form-control','required'=>true]);
				            echo $this->Form->control('description',['class'=>'form-control']);
				        ?>
				    
				    <button class="btn btn-inverse" type="submit">
				    	<i class="fa fa-save"></i>
				    	Save Now
				    </button>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
    
</div>
