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
            		echo $this->Html->link('Questionnaires',array(
						'controller'=>'Questionnaires','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Create Questionnaire for Employee</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',array(
					'controller'=>'Questionnaires','action'=>'index'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
			?>
    	</div>
   	</div>             
</div>
<div class="row">
	<div class="col-6 col-xlg-push-3">
	    <div class="card">
	    	<div class="card-header">
	    		<div class="card-titl">Create Questionnaire</div>
	    	</div>
	    	<?= $this->Form->create($questionnaire) ?>
			<div class="card-block">
			    
			    <fieldset>
			        <?php
			            echo $this->Form->control('user_id', ['options' => $employees, 'empty' => true,'required'=>true,'class'=>'form-control','label'=>'For Employee']);
			            echo $this->Form->control('name',['type'=>'text','class'=>'form-control','label'=>'Questionnaire Title']);
			            //echo $this->Form->control('questions');
			        ?>
			    </fieldset>
			    
			    
			    
			</div>
			<div class="card-header">
				Add Questions to This Questionnaire
			</div>
			<div class="card-block">
				<?php 
					echo $this->Form->control('questions',[
						'class'=>'form-control select2',
						'label'=>false,
						'multiple'=>true,
						'type'=>'select','options'=>$questions
					]);
				?>
			</div>
			<div class="card-block">
		    	
		    	<button type="submit" class="btn btn-success">
		    		Create Now
		    	</button>
		    </div>
			<?= $this->Form->end() ?>
			
		</div>
	</div>
</div>