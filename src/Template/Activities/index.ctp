
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
            <li class="breadcrumb-item active">Company Activities</li>
        </ol>
    </div>                   
    <div class="col-md-4 col-4 text-right">
    	<?php if(empty($thisrisk->id)): ?>
    		<!--
	    	<a class="btn btn-danger" href="#addNewActivity">
	    		<i class="fa fa-plus"></i> Add New
	    	</a>
	    	-->
	    <?php else: ?>
	    	<?php 
	    		echo $this->Html->link('View All',['action'=>'index'],['class'=>'btn btn-warning']);
	    	?>
	    <?php endif; ?>
    </div>
</div>
<div class="row">
	<?php if(empty($thisactivity->id)): ?>
    <div class="col-7">
    	<div class="card">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-active">
                        <th scope="col">Activity Name</th>
		                <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($activities as $activity): ?>
                    <tr>
                        <td style="min-width:200px;"><?= h($activity->name) ?></td>
		               
		                <td>
		                	
		                	<?php if(!in_array($activity->name,['Banking Services','Unsure','Government Contractor Defence Industrial Base (DIB)'])): ?>
			                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'index', $activity->id],array('class'=>'btn btn-sm text-white btn-info','escape'=>false)) ?>
		                        <?= $this->Form->postLink(__('<i class="fa fa-times"></i> Delete'), ['action' => 'delete', $activity->id],array('class'=>'btn btn-sm text-white btn-danger','confirm' => __('Are you sure you want to delete Activity {0}?', $activity->name),'escape'=>false)) ?>
		                    <?php else: ?>
		                    	<i class="fa fa-info-circle text-danger" data-toggle="tooltip" title="Reserved Activity"></i>
	                        <?php endif; ?>
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
	<div class="col-5" id="addNewActivity">
		<div class='card' >
			<div class="card-header bg-primary text-white">
				Add / Edit Company Activity
			</div>
			<div class="card-block">
				<?= $this->Form->create($thisactivity) ?>
		        <?php
		            echo $this->Form->control('name',array(
			        	'class'=>'form-control',
			        	'required'=>true,
						'label'=>array('text'=>'Activity Name','class'=>'cl-font-13'),
						'div'=>array('class'=>'form-group')
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


