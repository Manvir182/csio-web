<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RbControl[]|\Cake\Collection\CollectionInterface $rbControls
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rb Control'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rb Control Requirements'), ['controller' => 'RbControlRequirements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rb Control Requirement'), ['controller' => 'RbControlRequirements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rbControls index large-9 medium-8 columns content">
    <h3><?= __('Rb Controls') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('regulatory_body_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rbControls as $rbControl): ?>
            <tr>
                <td><?= $this->Number->format($rbControl->id) ?></td>
                <td><?= $rbControl->has('regulatory_body') ? $this->Html->link($rbControl->regulatory_body->name, ['controller' => 'RegulatoryBodies', 'action' => 'view', $rbControl->regulatory_body->id]) : '' ?></td>
                <td><?= h($rbControl->name) ?></td>
                <td><?= h($rbControl->created) ?></td>
                <td><?= h($rbControl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rbControl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rbControl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rbControl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbControl->id)]) ?>
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
