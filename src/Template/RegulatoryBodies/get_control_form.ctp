<div class="controlAreasTemplate controlAreas">
	<?php echo $this->Form->create($rControl,['url'=>$this->Url->build(array('controller'=>'RegulatoryBodies','action'=>'saveRegulatoryControls'),true)]); ?>
	<?php if(!empty($rControl->id)): ?>
		<input type="hidden" name="id" value="<?php echo $rControl->id; ?>">
	<?php endif; ?>
	<input type="hidden" class="cRbId" name="rb_id" value="">
	<div class="card card-default cArea">
			<span class="remove"><i class="fa fa-times"></i></span>
			
			<div class="card-body p-20">
				<?php
					
			        echo $this->Form->control('RbControls.control_number[]',[
			        	'label'=>"Control Area Number",
			        	'class'=>'form-control',
			        	'placeholder'=>'Control Area Number',
			        	'required'=>true,
			        	'value'=>$rControl->control_number
			        ]);
			    ?>
				<?php
			        echo $this->Form->control('RbControls.name[]',[
			        	'label'=>"Control Area Name",
			        	'class'=>'form-control',
			        	'placeholder'=>'Name of Control Area',
			        	'required'=>true,
			        	'value'=>$rControl->name
			        ]);
			    ?>
			    <?php
			        echo $this->Form->control('RbControls.guidance[]',[
			        	'label'=>'Guidance',
			        	'class'=>'form-control',
			        	'type'=>'textarea',
			        	'placeholder'=>'Guidance',
			        	'value'=>$rControl->guidance
			        ]);
			    ?>
			    <?php
			        echo $this->Form->control('RbControls.description[]',[
			        	'label'=>'Description',
			        	'class'=>'form-control',
			        	'type'=>'textarea',
			        	'placeholder'=>'Description',
			        	'value'=>$rControl->description
			        ]);
			    ?>
			    <div class="controlRequirements p-20">
			    	<h5>Control Requirements</h5>
			    	<div class="cRequirement">
			    		<?php if(empty($rControl->rb_control_requirements)): ?>
			    			<div class="row">
				    			<div class="col-11">
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
								        	'type'=>'textarea',
								        	
								        ]);
								    ?>	
								    <hr>	
				    			</div>
				    			<div class="col-1">
				    				<span class="remove"><i class="fa fa-times"></i></span>
				    			</div>
				    		</div>
			    		<?php else: ?>
				    		<?php foreach($rControl->rb_control_requirements as $key=>$cReq): ?>
					    		<div class="row">
					    			<div class="col-11">
					    				<?php 
											$this->Form->setTemplates([
											    'inputContainer' => '<div class="form-group">	
											        {{content}} </div>',
											    //'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
												//'radioWrapper' => '<li>{{label}}<li>'
											]);
										?>
										<?php
									       echo $this->Form->control('RbControlRequirements[].id[]',[
									        	'label'=>false,
									        	'class'=>'form-control rcrid',
									        	
									        	//'required'=>true,
									        	'value'=>$cReq->id,
									        	'type'=>'hidden'
									        ]);
									    ?>
					    				<?php
									       echo $this->Form->control('RbControlRequirements[].req_number[]',[
									        	'label'=>false,
									        	'class'=>'form-control rcrn',
									        	'placeholder'=>'Control Requirement Number',
									        	'required'=>true,
									        	'value'=>$cReq->req_number,
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
									        	'type'=>'textarea',
									        	'value'=>$cReq->name
									        ]);
									    ?>	
									    <hr>	
					    			</div>
					    			<div class="col-1">
					    				<span class="remove"><i class="fa fa-times"></i></span>
					    			</div>
					    		</div>
					    	<?php endforeach ?>
				    	<?php endif; ?>
				    </div>
				    <div class="cRequirement1">
			    		<div class="row">
			    			<div class="col-11">
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
							        	'type'=>'textarea',
							        	
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
	<div class="p-10 text-right">
		<button class='btn btn-success' type="submit">
			<i class="fa fa-check"></i>
			Save Control Area
		</button>
	</div>
	<?php echo $this->Form->end(); ?>
</div>