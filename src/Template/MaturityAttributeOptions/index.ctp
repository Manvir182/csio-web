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
<div class="maturityAttributeOptions index large-9 medium-8 columns content">
    <h3><?= __('Maturity Attribute Options') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table table-bordered bg-white">
        <thead>
            <tr class="active">
                <th scope="col">No.</th>
                <th scope="col">Maturity Attribute Option</th>
                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
                <th scope="col">Description</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $sr=1; foreach ($maturityAttributeOptions as $maturityAttributeOption): ?>
            <tr>
                <td><?php echo $sr++; ?></td>
                <td><?= h($maturityAttributeOption->name) ?></td>
                <td><?= $this->Number->format($maturityAttributeOption->score) ?></td>
                <td><?= h($maturityAttributeOption->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $maturityAttributeOption->id],['class'=>'btn btn-sm btn-outline-warning']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $maturityAttributeOption->id], ['class'=>'btn btn-sm btn-outline-danger','confirm' => __('Are you sure you want to delete # {0}?', $maturityAttributeOption->id)]) ?>
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
