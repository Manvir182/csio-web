
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
            		echo $this->Html->link('Regulatory Bodies',array(
						'controller'=>'RegulatoryBodies','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Regulatory Bodies</li>
        </ol>
    </div>
    <div class="col-4 text-right">
    	<?php
    		echo $this->Html->link('<i class="fa fa-plus"></i> Create New',['action'=>'add'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>
</div>
<div class="row">
    <div class="col-12">
    	<div class="card">
        <div class="table-responsiv">
            <table class="table table-bordered">
                <thead>
                    <tr class="active">
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('activity_id') ?></th>
		                <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($regulatoryBodies as $rbody): ?>
                    <tr>
                        <td><?= h($rbody->name) ?></td>
                        <td><?= h(empty($rbody->activity->name)?'':$rbody->activity->name) ?></td>
		                <td>
		                	<?= $this->Html->link(__('View'), ['action' => 'view', $rbody->id],['class'=>'btn btn-info text-white']) ?>
			               	<?= $this->Html->link(__('Edit'), ['action' => 'edit', $rbody->id],['class'=>'btn btn-primary text-white']) ?>
		               	    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rbody->id], ['class'=>'btn btn-danger text-white', 'confirm' => __('Are you sure you want to delete this Regulatory Body ?')]) ?>

			               	<?php if(!empty($rbody->rb_rc_mappings[0]->pendings) && $rbody->rb_rc_mappings[0]->pendings > 0): ?>
			               		<span class="label label-warning">
			               			<i class="fa fa-exclamation-triangle"></i>
			               			RC Mapping Update Required
			               		</span>
			               	<?php endif; ?>
			            </td>
                    </tr>
                    <?php endforeach; ?>
                 </tobody>
        	</table>
    	</div>
    	</div>
		<!-- Pagination -->
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

</div>


