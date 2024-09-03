<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RbControlRequirement[]|\Cake\Collection\CollectionInterface $rbControlRequirements
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rb Control Requirement'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rb Controls'), ['controller' => 'RbControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rb Control'), ['controller' => 'RbControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rbControlRequirements index large-9 medium-8 columns content">
    <h3><?= __('Rb Control Requirements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rb_control_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rbControlRequirements as $rbControlRequirement): ?>
            <tr>
                <td><?= $this->Number->format($rbControlRequirement->id) ?></td>
                <td><?= $rbControlRequirement->has('rb_control') ? $this->Html->link($rbControlRequirement->rb_control->name, ['controller' => 'RbControls', 'action' => 'view', $rbControlRequirement->rb_control->id]) : '' ?></td>
                <td><?= h($rbControlRequirement->name) ?></td>
                <td><?= h($rbControlRequirement->created) ?></td>
                <td><?= h($rbControlRequirement->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rbControlRequirement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rbControlRequirement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rbControlRequirement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbControlRequirement->id)]) ?>
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
