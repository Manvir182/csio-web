<style>
	form .error-message {
	    display: block;
	    padding: 0.375rem 0.5625rem 0.5625rem;
	    margin-top: -1px;
	    //margin-bottom: 1rem;
	    font-size: 0.75rem;
	    font-weight: bold;
	    font-style: italic;
	    color: red !important;
	}
</style>
<div class="row">
	<div class="col-4 offset-2">
		<div class="text-right p-10">
	    	<?php
	    		echo $this->Html->link('<i class="fa fa-plus"></i> Add New',[
	    			'action'=>'add'
	    		],[
	    			'class'=>'btn btn-sm btn-info',
	    			'escape'=>false
	    		]);
	    	?>
	    	<?php
	    		echo $this->Html->link('<i class="fa fa-users"></i> View All',[
	    			'action'=>'index'
	    		],[
	    			'class'=>'btn btn-sm btn-primary',
	    			'escape'=>false
	    		]);
	    	?>
	    </div>
		<div class="card">
			<div class="card-body p-10">
				<?= $this->Form->create($user) ?>
				<fieldset>
					<?php
			            echo $this->Form->control('first_name',[
			            	'class'=>'form-control'
			            ]);
			            echo $this->Form->control('last_name',[
			            	'class'=>'form-control'
			            ]);
						echo $this->Form->control('email',[
			            	'class'=>'form-control'
			            ]);
						echo $this->Form->control('password',[
			            	'class'=>'form-control',
			            	'required'=>false
			            ]);
					?>
					<span class="help-block">
						Leave Password field empty if do not want to change.
					</span>
					<?= $this->Form->button(__('Save Now'),['class'=>'btn btn-danger'])
					?>
				</fieldset>

				<?= $this -> Form -> end() ?>
			</div>
		</div>
	</div>
</div>
