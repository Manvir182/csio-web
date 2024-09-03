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
            		echo $this->Html->link('Maturity Attributes',array(
						'controller'=>'MaturityAttributes','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Maturity Attributes List</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['action'=>'add'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="maturityAttributes index large-9 medium-8 columns content">
    <h3><?= __('Maturity Attributes') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-hover bg-white">
        <thead>
            <tr class="active">
                <th scope="col">No.</th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
               
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $sr=1; foreach ($maturityAttributes as $maturityAttribute): ?>
            <tr>
                <td class="text-center"><?php echo $sr++; ?>.</td>
                <td><?= h($maturityAttribute->name) ?></td>
                <td><?= h($maturityAttribute->description) ?></td>
                
                <td class="actions" style="min-width:140px;">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $maturityAttribute->id],['class'=>'btn btn-sm btn-outline-warning','escape'=>false]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $maturityAttribute->id], ['class'=>'btn btn-sm btn-outline-danger','escape'=>false,'confirm' => __('Are you sure you want to delete # {0}?', $maturityAttribute->id)]) ?>
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
