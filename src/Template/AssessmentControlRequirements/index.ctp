<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentControlRequirement[]|\Cake\Collection\CollectionInterface $assessmentControlRequirements
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acr Statuses'), ['controller' => 'AcrStatuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acr Status'), ['controller' => 'AcrStatuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentControlRequirements index large-9 medium-8 columns content">
    <h3><?= __('Assessment Control Requirements') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_control_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('compliance_score') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessed_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentControlRequirements as $assessmentControlRequirement): ?>
            <tr>
                <td><?= $this->Number->format($assessmentControlRequirement->id) ?></td>
                <td><?= $assessmentControlRequirement->has('assessment_control') ? $this->Html->link($assessmentControlRequirement->assessment_control->name, ['controller' => 'AssessmentControls', 'action' => 'view', $assessmentControlRequirement->assessment_control->id]) : '' ?></td>
                <td><?= h($assessmentControlRequirement->name) ?></td>
                <td><?= $this->Number->format($assessmentControlRequirement->compliance_score) ?></td>
                <td><?= $this->Number->format($assessmentControlRequirement->assessed_by) ?></td>
                <td><?= h($assessmentControlRequirement->status) ?></td>
                <td><?= h($assessmentControlRequirement->created) ?></td>
                <td><?= h($assessmentControlRequirement->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentControlRequirement->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentControlRequirement->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentControlRequirement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentControlRequirement->id)]) ?>
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
