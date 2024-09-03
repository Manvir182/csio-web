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
            		echo $this->Html->link('Regulatory Bodies',array(
						'controller'=>'RegulatoryBodies','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Edit Regulatory Body</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="row">
	
</div>

<div class="regulatoryBodies form large-9 medium-8 columns content">
	<h3>Editing: <?= $regulatoryBody->name; ?></h3>
	<?= $this->Form->create($regulatoryBody) ?>
	<?php 
		$this->Form->setTemplates([
		    'inputContainer' => '<div class="form-group">	
		        {{content}} </div>',
		    //'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
			//'radioWrapper' => '<li>{{label}}<li>'
		]);
	?>
	<div class="card card-default" style="box-shadow:0 0 4px #999;">
		<div class="card-header">
			Edit Regulatory Body
		</div>
		<div class="card-body p-20">
			
		    <div class="row">
		    	<div class="col-8">
		    		<?php
				        echo $this->Form->control('name',[
				        	'label'=>['text'=>'Regulatory Body Name','class'=>'control-label'],
				        	'class'=>'form-control',
				        	'placeholder'=>'Enter Name of Regulatory Body',
				        	'required'=>true
				        ]);
				    ?>		
		    	</div>
		    	<div class="col-4">
		    		<?php
				        echo $this->Form->control('activity_id',[
				        	'label'=>['text'=>'Activity Name','class'=>'control-label'],
				        	'class'=>'form-control',
				        	'placeholder'=>'Select Activity',
				        	'required'=>true,
				        	'empty'=>'-- Choose Activity --'
				        ]);
				    ?>	
		    	</div>
		    </div>
		</div>
		
		
	</div>
	
	
    <hr>
    
    <div class="text-center">
    	<button class="btn btn-primary" type="submit">
	    	<i class="fa fa-save"></i>
	    	Save Regulatory Body
	    </button>
    </div>
    
    <?= $this->Form->end() ?>
</div>

<script>
	$(function(){cArea=$(".controlAreasTemplate").html(),cAreaReq=$('.controlAreasTemplate').find(".cRequirement").html(),$(".controlAreasTemplate").remove()});
	
</script>