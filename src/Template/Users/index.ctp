<div class="users index large-9 medium-8 columns content">
    <div class="text-right p-10">
    	<?php
    		echo $this->Html->link('<i class="fa fa-plus"></i> Add New',[
    			'action'=>'add'
    		],[
    			'class'=>'btn btn-sm btn-info',
    			'escape'=>false
    		]);
    	?>
    	<?php
    		echo $this->Html->link('<i class="fa fa-users"></i> View All',[
    			'action'=>'index'
    		],[
    			'class'=>'btn btn-sm btn-primary',
    			'escape'=>false
    		]);
    	?>
    </div>
    <table class="table table-bordered" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="table-active">
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= date('d-M-Y H:i',strtotime($user->created)) ?></td>
                <td><?= date('d-M-Y H:i',strtotime($user->modified)) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $user->id],['escape'=>false,'class'=>'btn btn-sm btn-warning text-white']) ?>
                    <?= $this->Form->postLink(__('<i class="fa fa-times"></i> Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete User {0}?', $user->first_name),'escape'=>false,'class'=>'btn btn-sm btn-danger text-white']) ?>
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
