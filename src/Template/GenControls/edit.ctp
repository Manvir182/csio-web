<style>
	.controlAreas > .card:before {
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
            		echo $this->Html->link('Generalized Assessment Control Areas',array(
						'controller'=>'GenControls','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Edit Control Area</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['action'=>'add'],['class'=>'btn btn-info','escape'=>false]);
    		echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="regulatoryBodies form large-9 medium-8 columns content">
	<?= $this->Form->create($genControl) ?>
	<?php 
		$this->Form->setTemplates([
		    'inputContainer' => '<div class="form-group">{{content}} </div>'
		]);
	?>
	<div class="controlAreas">
		<div class="card card-default">
			<div class="card-header">
				Edit Control Area for Generalized Assessments
			</div>
			
			<div class="card-body p-20">
				<?php
			        echo $this->Form->control('name',[
			        	'label'=>"Control Area Name",
			        	'class'=>'form-control',
			        	'placeholder'=>'Name of Control Area',
			        	'required'=>true
			        ]);
			    ?>
			    <?php
			        echo $this->Form->control('guidance',[
			        	'label'=>'Guidance',
			        	'class'=>'form-control',
			        	'type'=>'textarea',
			        	'placeholder'=>'Guidance'
			        ]);
			    ?>
			     <?php
			        echo $this->Form->control('description',[
			        	'label'=>'Description',
			        	'class'=>'form-control',
			        	'type'=>'textarea',
			        	'placeholder'=>'Description'
			        ]);
			    ?>
			    <div class="controlRequirements p-20">
			    	<h5>Control Requirements</h5>
			    	<div class="cRequirement">
			    		<?php foreach($genControl->gen_control_requirements as $genReq): ?>
			    		<div class="row">
			    			<div class="col-1"></div>
			    			<div class="col-10">
			    				<?php
			    					echo $this->Form->control('RbControlRequirements.id[]',[
							        	'label'=>false,
							        	'class'=>'form-control rcrid',
							        	'type'=>'hidden',
							        	'value'=>$genReq->id
							        ]);
							       echo $this->Form->control('RbControlRequirements.name[]',[
							        	'label'=>false,
							        	'class'=>'form-control rcr',
							        	'placeholder'=>'Control Requirement',
							        	'required'=>true,
							        	'value'=>$genReq->name
							        ]);
							    ?>		
			    			</div>
			    			<div class="col-1">
			    				<span class="remove"><i class="fa fa-times"></i></span>
			    			</div>
			    		</div>
				    	<?php endforeach; ?>
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
				<br><br><br>
				<button class="btn btn-inverse" type="submit">
					Save Now
				</button>
			</div>
		</div>
	</div>
	<!--templates-->
	<div class="controlAreasTemplate">
		<div class="card card-default ">
			<span class="remove"><i class="fa fa-times"></i></span>
			
			<div class="card-body p-20">
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
							       echo $this->Form->control('RbControlRequirements.name[]',[
							        	'label'=>false,
							        	'class'=>'form-control rcr',
							        	'placeholder'=>'Control Requirement',
							        	'required'=>true,'value'=>""
							        ]);
							    ?>		
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
	<!--templates ends-->
	<?php echo $this->Form->end(); ?>
</div>
<script>
	$(function(){cAreaReq=$('.controlAreasTemplate').find(".cRequirement").html(),$(".controlAreasTemplate").remove()});
</script>	