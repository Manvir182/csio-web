<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'dashboard','action'=>'dashboard'
					));
            	?>
            </li>
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Approvers',array(
						'controller'=>'approvers','action'=>'listApprovers'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Approver Profile</li>
        </ol>
    </div>                   
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'approvers','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				echo $this->Html->link('<i class="fa fa-edit"></i> Edit This',array(
					'controller'=>'approvers','action'=>'edit',$approver->id
				),array(
					'escape'=>false, 'class'=>'btn btn-warning'
				));
				echo $this->Html->link('<i class="fa fa-list-alt"></i> All Approvers',array(
					'controller'=>'approvers','action'=>'listApprovers'
				),array(
					'escape'=>false, 'class'=>'btn btn-inverse'
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
               <div class="col-md-6">
                  <strong>Approver Profile</strong>
               </div>
               <div class="col-md-6 text-right">
               
              </div>
            </div>
        </div>
        <div class="card-block">  
        	
        		<div class="row ">
                    
                   	<div class="col-md-6">
                   		<label class="cl-font-13">First Name</label>
                        <h4><?= $approver->first_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Last Name</label>
                        <h4><?= $approver->last_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Email</label>
                        <h4><?= $approver->email ?></h4>
                    </div>
                    <div class="col-md-12">
                    	<hr style="border-color:#eee;">
                    	<label class="cl-font-13">Has created Password ?</label>
                        <h4><?= $approver->approver_password_created ?></h4>
                    </div>
                    
					
                   
	    		</div>
		    		
        </div>
    </div>
   </div>
</div>

