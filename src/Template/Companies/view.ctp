<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
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
            		echo $this->Html->link('Companies',array(
						'controller'=>'Companies','action'=>'index'
					));
            	?>
            </li>
            <?php if($company->source=='Registration'): ?>
            	<li class="breadcrumb-item">
	            	<?php
	            		echo $this->Html->link('Registration Requests',array(
							'controller'=>'Companies','action'=>'companyRequests'
						));
	            	?>
	            </li>
            <?php endif; ?>
            <li class="breadcrumb-item active">Company Profile</li>
        </ol>
    </div>
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'companies','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));

				echo $this->Html->link('<i class="fa fa-list-alt"></i> All Companies',array(
					'controller'=>'companies','action'=>'index'
				),array(
					'escape'=>false, 'class'=>'btn btn-warning'
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
                  <strong>Company Profile</strong>

               </div>
               <div class="col-md-6 text-right">
               	<?php if($company->registration_status=='Pending'): ?>
               		<span class="badge badge-info">Request Submitted</span>
               	<?php elseif($company->registration_status=='Approved'): ?>
               		<span class="badge badge-primary">Approved on <?php echo date('d-M-Y',strtotime($company->reg_status_date )); ?></span>
               	<?php else: ?>
               		<span class="badge badge-danger">Request Rejected</span>
               	<?php endif; ?>
              </div>
            </div>
        </div>
        <div class="card-block">

        		<div class="row ">
                    <div class="col-md-12">
                        <h4 class="cisoredc">Personal Information</h4>
                    </div>
                   	<div class="col-md-6">
                   		<label class="cl-font-13">First Name</label>
                        <h4><?= $company->first_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Last Name</label>
                        <h4><?= $company->last_name ?></h4>
                    </div>
					<div class="col-md-12">
						<br>
                        <h4 class="cisoredc">Login Information</h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Login User Name</label>
                        <h4><?= $company->username ?></h4>
                    </div>
                    <div class="col-md-12">
						<br>
                        <h4 class="cisoredc">Company Information</h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Company Type</label>
                        <h4><?= $company->company_type ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Company Name</label>
                        <h4><?= $company->company_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Industry</label>
                        <h4><?= $company->industry ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Company Email</label>
                        <h4><?= $company->email ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Companny Phone</label>
                        <h4><?= $company->contcode.' '.$company->phone ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Extention</label>
                        <h4><?= $company->extension ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Company Size</label>
                        <h4><?= $company->company_size ?></h4>
                    </div>

					<div class="col-md-6">
                    	<label class="cl-font-13">Subscription for News/Updates</label>
                        <h4><?= $company->subscribed ?></h4>
                    </div>
                    <?php if($company->source=='Registration' && $company->registration_status=='Pending'): ?>
                    <div class="col-md-12">
                    	<hr>
                    	<?= $this->Form->postLink(__('<i class="fa fa-check"></i> Approve'), ['action' => 'approveRequest', $company->id],['class'=>'btn btn-success','data-toggle'=>'tooltip','title'=>'Approve Request','escape'=>false], ['confirm' => __('Are you sure you want to Approve # {0}?', $company->company_name)]) ?>
                    	<?= $this->Form->postLink(__('<i class="fa fa-times"></i> Reject'), ['action' => 'rejectRequest', $company->id],['class'=>'btn btn-danger pull-right','data-toggle'=>'tooltip','title'=>'Reject Request','escape'=>false], ['confirm' => __('Are you sure you want to Reject Request from  # {0}?', $company->company_name)]) ?>
                    </div>
                    <?php endif; ?>
                    <?php if($company->registration_status=='Approved'): ?>
                    <div class="col-md-12">
                    	<hr>

                    	<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#suspendModal">
                    		<i class="fa fa-times"></i>
                    		Suspend Account
                    	</button>
                    </div>
                    <?php endif; ?>
	    		</div>

        </div>
    </div>
   </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="suspendModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Suspend Company's Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo $this->Form->create($company); ?>
	      <div class="modal-body">
	      	<div class="form-group">
	    		<?php
	    			echo $this->Form->control('company_name',[
	    				'class'=>'form-control',
	    				'label'=>['text'=>'Company Name'],
	    				'disabled'=>true
	    			]);
	    		?>
	    	</div>
	        <div class="form-group">
	    		<?php
	    			echo $this->Form->control('reg_status_remarks',[
	    				'class'=>'form-control',
	    				'label'=>['text'=>'Suspend Remarks'],
	    				'required'=>true
	    			]);
	    		?>
	    	</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-danger float-right"><i class="fa fa-check"></i> Suspend Account</button>
	      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>
