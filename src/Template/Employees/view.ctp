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
            		echo $this->Html->link('Employees',array(
						'controller'=>'Employees','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Employee Profile</li>
        </ol>
    </div>
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'Employees','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				echo $this->Html->link('<i class="fa fa-edit"></i> Edit This',array(
					'controller'=>'Employees','action'=>'edit',$company->id
				),array(
					'escape'=>false, 'class'=>'btn btn-warning'
				));
				echo $this->Html->link('<i class="fa fa-list-alt"></i> All Employees',array(
					'controller'=>'Employees','action'=>'index'
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
                  <strong>Employee Profile</strong>
               </div>
               <div class="col-md-6 text-right">

              </div>
            </div>
        </div>
        <div class="card-block">

        		<div class="row ">
                    <div class="col-md-12">
                        <h4 class="cisoredc">Employee Information</h4>
                    </div>
                   	<div class="col-md-6">
                   		<label class="cl-font-13">First Name</label>
                        <h4><?= $company->first_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Last Name</label>
                        <h4><?= $company->last_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Email</label>
                        <h4><?= $company->email ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Position Title</label>
                        <h4><?= $company->position_title ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Department</label>
                        <h4><?= $company->department->name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Department Size</label>
                        <h4><?= $company->department_size ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Phone No.</label>
                        <h4><?= $company->contcode.' '.$company->phone ?></h4>
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
                    	<label class="cl-font-13">Company Name</label>
                        <h4><?= $company->company->company_name ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Industry</label>
                        <h4><?= $company->company->industry ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Company Email</label>
                        <h4><?= $company->company->email ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Companny Phone</label>
                        <h4><?= $company->company->contcode.' '.$company->company->phone ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Extention</label>
                        <h4><?= $company->company->extension ?></h4>
                    </div>
                    <div class="col-md-6">
                    	<label class="cl-font-13">Company Size</label>
                        <h4><?= $company->company->company_size ?></h4>
                    </div>



	    		</div>

        </div>
    </div>
   </div>
</div>

