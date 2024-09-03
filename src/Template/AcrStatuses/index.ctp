<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcrStatus[]|\Cake\Collection\CollectionInterface $acrStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Acr Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['controller' => 'AssessmentControlRequirements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['controller' => 'AssessmentControlRequirements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acrStatuses index large-9 medium-8 columns content">
    <h3><?= __('Acr Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_control_requirement_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($acrStatuses as $acrStatus): ?>
            <tr>
                <td><?= $this->Number->format($acrStatus->id) ?></td>
                <td><?= $acrStatus->has('assessment_control_requirement') ? $this->Html->link($acrStatus->assessment_control_requirement->name, ['controller' => 'AssessmentControlRequirements', 'action' => 'view', $acrStatus->assessment_control_requirement->id]) : '' ?></td>
                <td><?= $acrStatus->has('user') ? $this->Html->link($acrStatus->user->id, ['controller' => 'Users', 'action' => 'view', $acrStatus->user->id]) : '' ?></td>
                <td><?= h($acrStatus->status) ?></td>
                <td><?= h($acrStatus->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $acrStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $acrStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $acrStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acrStatus->id)]) ?>
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
