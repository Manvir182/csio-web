<style>
	.form-control {
		color:#505867 !important;
	}
	.error label {
		color:crimson;
	}
	.error .form-control {
		border-color:crimson !important;
		color:crimson
		
	}
	.error .error-message {
		color:crimson;
		display:block;
		padding:8px 4px;
		//background:lightpink;
		margin-top:-10px;
		font-size:12px;
		font-weight:bold;
	}
	.form-row div.input {
		width:100%;
		padding-left:20px;
		padding-right:20px;
	}
</style>
<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
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
            		echo $this->Html->link('Approvers',array(
						'controller'=>'Approvers','action'=>'listApprovers'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Create New Approver</li>
        </ol>
    </div>                   
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			
				echo $this->Html->link('<i class="fa fa-list-alt"></i> All Approvers',array(
					'controller'=>'approvers','action'=>'listApprovers'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
    		?>
    		
    	</div>
    </div>  
</div>

<div class="row">
<!-- Column -->
<div class="col-lg-3 col-xlg-3 col-md-1"></div>
<div class="col-lg-6 col-xlg-6 col-md-10">
    <div class="card" style="border:1px solid #ccc;">
        <div class="card-header">
           <div class="row">
               <div class="col-md-8">
                  Create New Approver
               </div>
                <div class="col-md-4 text-right">
                  
               </div>
            </div>
        </div>
        <div class="card-block">  
        	<?= $this->Form->create($approver) ?>
        	<?php 
        		$this->Form->setTemplates([
				    'inputContainer' => '<div class="col-md-6 m-t-20">
				        {{content}} </div>'
				]);
        	?>
        		<div class="row ">
                   
                    <?php
			            echo $this->Form->control('first_name',array(
							'class'=>'form-control',
							'required'=>true,
							
							'label'=>array('class'=>'cl-font-13','text'=>'First Name')
						));
						echo $this->Form->control('last_name',array(
							'class'=>'form-control',
							'required'=>true,
							
							'label'=>array('class'=>'cl-font-13','text'=>'Last Name')
						));
					?>
					
					<?php 
		        		$this->Form->setTemplates([
						    'inputContainer' => '<div class="col-md-12 m-t-20">
						        {{content}} </div>'
						]);
		        	?>
		        	
					<?php
						echo $this->Form->control('email',array(
							'class'=>'form-control',
							'required'=>true,
							
							'label'=>array('class'=>'cl-font-13','text'=>'Email')
						));
			           
					?>
					
		    		<div class="col-md-12 m-t-20">
		    			<?= $this->Form->button(__('Save Now'),array('class'=>'btn btn-success')) ?>
		    		</div>
		    		</div>
		    		<?= $this->Form->end() ?>
        </div>
    </div>
   </div>
</div>

