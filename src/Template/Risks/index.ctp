
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
            		echo $this->Html->link('Risks Profiling',array(
						'controller'=>'risks','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Risk Domains</li>
        </ol>
    </div>                   
    <div class="col-md-4 col-4 text-right">
    	<?php if(empty($thisrisk->id)): ?>
	    	<a class="btn btn-danger" href="#addNewRisk">
	    		<i class="fa fa-plus"></i> Add New
	    	</a>
	    <?php else: ?>
	    	<?php 
	    		echo $this->Html->link('View All',['action'=>'index'],['class'=>'btn btn-warning']);
	    	?>
	    <?php endif; ?>
    </div>
</div>
<div class="row">
	<?php if(empty($thisrisk->id)): ?>
    <div class="col-12">
    	<div class="card">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="active">
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
		                <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($risks as $risk): ?>
                    <tr>
                        <td style="min-width:200px;"><?= h($risk->name) ?></td>
		                <td><?= $risk->description ?></td>
		                <td >
		                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'index', $risk->id],array('class'=>'btn btn-sm text-white btn-warning','escape'=>false)) ?>
	                        <?= $this->Form->postLink(__('<i class="fa fa-times"></i> Delete'), ['action' => 'delete', $risk->id],array('class'=>'btn btn-sm text-white btn-danger','confirm' => __('Are you sure you want to delete Risk {0}?', $risk->name),'escape'=>false)) ?>
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
	<?php endif; ?>
	<div class="col-12" id="addNewRisk">
		<div class='card' >
			<div class="card-header">
				Add / Edit Risk Domain
			</div>
			<div class="card-block">
				<?= $this->Form->create($thisrisk) ?>
		        <?php
		            echo $this->Form->control('name',array(
			        	'class'=>'form-control',
			        	'required'=>true,
						'label'=>array('text'=>'Risk Name','class'=>'cl-font-13'),
						'div'=>array('class'=>'form-group')
					));
		             echo $this->Form->control('description',array(
			        	'class'=>'form-control ckeditor',
						'label'=>array('text'=>'Description','class'=>'cl-font-13'),
						'div'=>array('class'=>'form-group'),
					));
		        ?>
		    
			    <div class="form-group">
			    	<br>
			    	<?= $this->Form->button(__('Save Now'),array('class'=>'btn btn-success')) ?>
			    </div>
			    <?= $this->Form->end() ?>
			</div>
		</div>
		
	</div>
</div>


