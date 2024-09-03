
<div class="row page-titles">
    <div class="col-md-12 col-12 align-self-center">
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
            		echo $this->Html->link('Departments',array(
						'controller'=>'departments','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Employee Departments</li>
        </ol>
    </div>                   
</div>
<div class="row">
    <div class="col-8">
    	<div class="card">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="active">
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
		                <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($departments as $department): ?>
                    <tr>
                        <td><?= h($department->name) ?></td>
		               
		                <td >
		                    <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'index', $department->id],array('class'=>'btn btn-sm btn-info','escape'=>false)) ?>
		                </td>
                    </tr>
                    <?php endforeach; ?>
                 </tobody>
        	</table>
    	</div>
    	</div>
		<!-- Pagination
		<div class="paginator">
	        <ul class="pagination">
	            <?= $this->Paginator->first('<< ' . __('first')) ?>
	            <?= $this->Paginator->prev('< ' . __('previous')) ?>
	            <?= $this->Paginator->numbers() ?>
	            <?= $this->Paginator->next(__('next') . ' >') ?>
	            <?= $this->Paginator->last(__('last') . ' >>') ?>
	        </ul>
	        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
	    </div>
	   <!--Pagination Ends-->
	</div>
	<div class="col-4">
		<div class='card'>
			<div class="card-header">
				Add / Edit Department
			</div>
			<div class="card-block">
				
				<?= $this->Form->create($thisdepartment) ?>
		        <?php
		            echo $this->Form->control('name',array(
			        	'class'=>'form-control',
			        	'required'=>true,
						'label'=>array('text'=>'Department Name','class'=>'cl-font-13'),
						'div'=>array('class'=>'form-group')
					));
		            
		        ?>
		    
			    <div class="form-group text-right">
			    	<br>
			    	<?= $this->Form->button(__('Save Now'),array('class'=>'btn btn-info')) ?>
			    </div>
			    <?= $this->Form->end() ?>
			</div>
		</div>
		
	</div>
</div>


