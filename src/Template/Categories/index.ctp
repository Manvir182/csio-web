<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>




<div class="row">
    <div class="col-md-10 users index large-9 medium-8 columns content">
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
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('enabled') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('sort_order') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <<td><?= $this->Number->format($category->id) ?></td>
                    <td><?= h($category->name) ?></td>
                    <td><?= h($category->slug) ?></td>
                    <td><?= h($category->enabled) ?></td>
                    <td><?= $this->Number->format($category->sort_order) ?></td>
                    <td><?= h($category->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $category->id],['escape'=>false,'class'=>'btn btn-sm btn-warning text-white']) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-times"></i> Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete {0}?', $category->name),'escape'=>false,'class'=>'btn btn-sm btn-danger text-white']) ?>
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
    <div class="col-md-2">
        <?= $this->Element('blogNav') ?> 
    </div>
</div>
