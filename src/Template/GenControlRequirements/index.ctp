<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GenControlRequirement[]|\Cake\Collection\CollectionInterface $genControlRequirements
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Gen Control Requirement'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gen Controls'), ['controller' => 'GenControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gen Control'), ['controller' => 'GenControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="genControlRequirements index large-9 medium-8 columns content">
    <h3><?= __('Gen Control Requirements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gen_control_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genControlRequirements as $genControlRequirement): ?>
            <tr>
                <td><?= $this->Number->format($genControlRequirement->id) ?></td>
                <td><?= $genControlRequirement->has('gen_control') ? $this->Html->link($genControlRequirement->gen_control->name, ['controller' => 'GenControls', 'action' => 'view', $genControlRequirement->gen_control->id]) : '' ?></td>
                <td><?= h($genControlRequirement->name) ?></td>
                <td><?= h($genControlRequirement->created) ?></td>
                <td><?= h($genControlRequirement->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $genControlRequirement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $genControlRequirement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $genControlRequirement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $genControlRequirement->id)]) ?>
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
