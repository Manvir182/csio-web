<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
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
        <table class="table table-bordered " cellpadding="0" cellspacing="0">
            <thead>
                <tr class="table-active">
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('author_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('published') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $this->Number->format($article->id) ?></td>
                    <!-- <td><?php $article->has('category') ? $this->Html->link($article->category->name, ['controller' => 'Categories', 'action' => 'view', $article->category->id]) : '' ?></td> -->
                    <!-- <td><?php $article->has('author') ? $this->Html->link($article->author->name, ['controller' => 'Authors', 'action' => 'view', $article->author->id]) : '' ?></td> -->
                    <td><?= $article->has('category') ? $article->category->name : '' ?></td>
                    <td><?= $article->has('category') ? $article->author->name : '' ?></td>
                    <td><?= h($article->title) ?></td>
                    <td><img src="<?= h($article->image) ?>" height="100px" width="100px"></td>
                    <td><?= h($article->published) ?></td>
                    <td><?= h($article->slug) ?></td>
                    <td><?= h($article->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'), ['action' => 'edit', $article->id],['escape'=>false,'class'=>'btn btn-sm btn-warning text-white']) ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-times"></i> Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete {0}?', $article->name),'escape'=>false,'class'=>'btn btn-sm btn-danger text-white']) ?>
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
