<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentSeverityScale[]|\Cake\Collection\CollectionInterface $assessmentSeverityScales
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Severity Scale'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentSeverityScales index large-9 medium-8 columns content">
    <h3><?= __('Assessment Severity Scales') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('severity_scale') ?></th>
                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentSeverityScales as $assessmentSeverityScale): ?>
            <tr>
                <td><?= $this->Number->format($assessmentSeverityScale->id) ?></td>
                <td><?= $assessmentSeverityScale->has('assessment') ? $this->Html->link($assessmentSeverityScale->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentSeverityScale->assessment->id]) : '' ?></td>
                <td><?= h($assessmentSeverityScale->severity_scale) ?></td>
                <td><?= $this->Number->format($assessmentSeverityScale->score) ?></td>
                <td><?= h($assessmentSeverityScale->created) ?></td>
                <td><?= h($assessmentSeverityScale->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentSeverityScale->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentSeverityScale->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentSeverityScale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentSeverityScale->id)]) ?>
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
