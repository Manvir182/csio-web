<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RegulatoryBody[]|\Cake\Collection\CollectionInterface $regulatoryBodies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gen Controls'), ['controller' => 'GenControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gen Control'), ['controller' => 'GenControls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rb Controls'), ['controller' => 'RbControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rb Control'), ['controller' => 'RbControls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="regulatoryBodies index large-9 medium-8 columns content">
    <h3><?= __('Regulatory Bodies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($regulatoryBodies as $regulatoryBody): ?>
            <tr>
                <td><?= $this->Number->format($regulatoryBody->id) ?></td>
                <td><?= h($regulatoryBody->name) ?></td>
                <td><?= h($regulatoryBody->created) ?></td>
                <td><?= h($regulatoryBody->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $regulatoryBody->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $regulatoryBody->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $regulatoryBody->id], ['confirm' => __('Are you sure you want to delete # {0}?', $regulatoryBody->id)]) ?>
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
