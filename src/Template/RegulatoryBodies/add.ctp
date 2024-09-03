<style>
	.cRequirement .row:first-child .remove,
		.controlAreas > .card:first-child > .remove {
			display:none;
		}
</style>
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
            <li class="breadcrumb-item active">Add Regulatory Body</li>
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
			Add Regulatory Body
		</div>
		<div class="card-body p-10">
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
	<!--
	<h5>Control Areas for this Regulatory Body</h5>
	
	<div class="controlAreas">
		<div class="card card-default cArea">
			<span class="remove"><i class="fa fa-times"></i></span>
			
			<div class="card-body p-20">
				<?php
			        echo $this->Form->control('RbControls.control_number[]',[
			        	'label'=>"Control Area Number",
			        	'class'=>'form-control',
			        	'placeholder'=>'Control Area Number',
			        	'required'=>true
			        ]);
			    ?>
				<?php
			        echo $this->Form->control('RbControls.name[]',[
			        	'label'=>"Control Area Name",
			        	'class'=>'form-control',
			        	'placeholder'=>'Name of Control Area',
			        	'required'=>true
			        ]);
			    ?>
			    <?php
			        echo $this->Form->control('RbControls.description[]',[
			        	'label'=>'Description',
			        	'class'=>'form-control',
			        	'type'=>'textarea',
			        	'placeholder'=>'Description'
			        ]);
			    ?>
			    <div class="controlRequirements p-20">
			    	<h5>Control Requirements</h5>
			    	<div class="cRequirement">
			    		<div class="row">
			    			<div class="col-1"></div>
			    			<div class="col-10">
			    				<?php 
									$this->Form->setTemplates([
									    'inputContainer' => '<div class="form-group">	
									        {{content}} </div>',
									    //'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
										//'radioWrapper' => '<li>{{label}}<li>'
									]);
								?>
			    				<?php
							       echo $this->Form->control('RbControlRequirements[].req_number[]',[
							        	'label'=>false,
							        	'class'=>'form-control rcrn',
							        	'placeholder'=>'Control Requirement Number',
							        	//'required'=>true,
							        	
							        	'type'=>'text'
							        ]);
							    ?>	
							    <?php 
									$this->Form->setTemplates([
									    'inputContainer' => '<div class="form-grou">	
									        {{content}} </div>',
									    //'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
										//'radioWrapper' => '<li>{{label}}<li>'
									]);
								?>
			    				<?php
							       echo $this->Form->control('RbControlRequirements[].name[]',[
							        	'label'=>false,
							        	'class'=>'form-control rcr',
							        	'placeholder'=>'Control Requirement',
							        	'required'=>true,
							        	'type'=>'textarea'
							        ]);
							    ?>	
							    <hr>	
			    			</div>
			    			<div class="col-1">
			    				<span class="remove"><i class="fa fa-times"></i></span>
			    			</div>
			    		</div>
				    	
				    </div>
				    <div>
				    	<div class="row">
			    			<div class="col-1"></div>
			    			<div class="col-10">
								<button class="btn btn-info btn-sm addControlReq" type="button">
									<i class="fa fa-plus"></i>
									Add Control Requirement
								</button>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div>
		<button class="btn btn-inverse addControlArea" type="button">
			<i class="fa fa-plus"></i>
			Add Control Area
		</button>
	</div>
	-->
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
	$(function(){cArea=$(".controlAreas").html(),cAreaReq=$(".cRequirement").html()});
</script>