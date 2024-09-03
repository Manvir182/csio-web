<style>
	.qOptions .row:first-child .remButton {
		display:none;
	}
	.addButton,.remButton {
		display:none;
		
	}
	.qOptions .row:last-child .addButton {
		display:inline-block;
	}
	.qOptions .row:not(:first-child):hover .remButton{
		display:inline-block;
	}
	.thisRow {
		margin-bottom:15px;
	}
</style>
<div class="row page-titles">
    <div class="col-md-8 col-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'companies','action'=>'dashboard'
					));
            	?>
            </li>
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Questions',array(
						'controller'=>'Questions','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Create New Question</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',array(
					'controller'=>'Questions','action'=>'index'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				
				
    		?>
    		
    	</div>
   	</div>             
</div>
<div class="row">
	<div class="col-8 col-xlg-push-2">
	    <div class="card">
	    	<div class="card-header" style="font-weight:bold;">
	    		Add New Question
	    	</div>
	    	<?= $this->Form->create($question) ?>
			<div class="card-block">
			    
				<div class="questions form large-9 medium-8 columns content">
				    
				    <fieldset>
				        <?php
				            echo $this->Form->control('name',array(
								'class'=>'form-control',
								'label'=>'Question Title'
							));
							echo "<br>";
				            echo $this->Form->control('qtype',[
				            	'class'=>'form-control',
				            	'options'=>array('Multiple'=>'Multiple Choice','Single'=>'Single Choice'),
				            	'type'=>'select',
				            	'label'=>'Question Type'
				            ]);
				        ?>
				        <br>
				    </fieldset>
				    
			    
				  
				</div>
			</div>
			
			<div class="card-header">
				Answer Options
			</div>
			<div class="card-block">
				<div class="qOptions">
					<div class="row thisRow">
						<div class="col-10">
							<?php 
								echo $this->Form->control('QuestionOptions.name[]',[
									'class'=>'form-control',
									'label'=>false,
									'required'=>true
								]);
							?>		
						</div>
						<div class="col-2">
							<button type="button" class="btn btn-inverse addButton">
								<i class="fa fa-plus"></i>
							</button>
							<button type="button" class="btn btn-danger remButton pull-right">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					
				</div>
				<div class="form-group">
					<br>
	        		<button class="btn btn-success" type="submit">
		        		Save Now
		        	</button>
		        </div>
			</div>
			
		  <?= $this->Form->end() ?>
		  <script>
		  	$(function(){
		  		var newOption = $('.qOptions').html();
		  		$(document).on('click','.addButton',function(){
		  			$('.qOptions').append(newOption);
		  		});
		  		$(document).on('click','.remButton',function(){
		  			var a = $(this).parents('.thisRow');
		  			a.remove();
		  		});
		  	});
		  </script>
		</div>
	</div>
</div>

