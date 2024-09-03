<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentStatus[]|\Cake\Collection\CollectionInterface $assessmentStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentStatuses index large-9 medium-8 columns content">
    <h3><?= __('Assessment Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentStatuses as $assessmentStatus): ?>
            <tr>
                <td><?= $this->Number->format($assessmentStatus->id) ?></td>
                <td><?= $assessmentStatus->has('assessment') ? $this->Html->link($assessmentStatus->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentStatus->assessment->id]) : '' ?></td>
                <td><?= $assessmentStatus->has('user') ? $this->Html->link($assessmentStatus->user->id, ['controller' => 'Users', 'action' => 'view', $assessmentStatus->user->id]) : '' ?></td>
                <td><?= h($assessmentStatus->status) ?></td>
                <td><?= h($assessmentStatus->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentStatus->id)]) ?>
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
