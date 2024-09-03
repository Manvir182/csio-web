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
            		echo $this->Html->link('Compliance Statuses',array(
						'controller'=>'ComplianceStatuses','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Compliance Statuses List</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['action'=>'add'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="complianceStatuses index large-9 medium-8 columns content">
    <h3><?= __('Compliance Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
                <th scope="col">Description</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $sr=1; foreach ($complianceStatuses as $complianceStatus): ?>
            <tr>
                <td><?php echo $sr++; ?></td>
                <td><?= h($complianceStatus->name) ?></td>
                <td><?= $this->Number->format($complianceStatus->score) ?></td>
                <td><?= h($complianceStatus->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $complianceStatus->id],['class'=>'btn btn-sm btn-outline-info']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $complianceStatus->id], ['class'=>'btn btn-sm btn-outline-danger','confirm' => __('Are you sure you want to delete # {0}?', $complianceStatus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>
