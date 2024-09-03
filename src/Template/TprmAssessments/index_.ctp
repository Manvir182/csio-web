<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assessment[]|\Cake\Collection\CollectionInterface $assessments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['controller' => 'AssessmentRisks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['controller' => 'AssessmentRisks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Severity Scales'), ['controller' => 'AssessmentSeverityScales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Severity Scale'), ['controller' => 'AssessmentSeverityScales', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Statuses'), ['controller' => 'AssessmentStatuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Status'), ['controller' => 'AssessmentStatuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessments index large-9 medium-8 columns content">
    <h3><?= __('Assessments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('owner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('requester_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('case_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('atype') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('evidence_file') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('signature') ?></th>
                <th scope="col"><?= $this->Paginator->sort('result_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessments as $assessment): ?>
            <tr>
                <td><?= $this->Number->format($assessment->id) ?></td>
                <td><?= $this->Number->format($assessment->owner_id) ?></td>
                <td><?= $this->Number->format($assessment->requester_id) ?></td>
                <td><?= h($assessment->case_number) ?></td>
                <td><?= h($assessment->atype) ?></td>
                <td><?= h($assessment->sub_type) ?></td>
                <td><?= h($assessment->name) ?></td>
                <td><?= h($assessment->status) ?></td>
                <td><?= h($assessment->evidence_file) ?></td>
                <td><?= h($assessment->file_name) ?></td>
                <td><?= h($assessment->file_description) ?></td>
                <td><?= h($assessment->signature) ?></td>
                <td><?= h($assessment->result_status) ?></td>
                <td><?= h($assessment->created) ?></td>
                <td><?= h($assessment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessment->id)]) ?>
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
