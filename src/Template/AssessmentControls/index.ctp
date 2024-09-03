<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentControl[]|\Cake\Collection\CollectionInterface $assessmentControls
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['controller' => 'AssessmentControlRequirements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['controller' => 'AssessmentControlRequirements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Matiruty Scores'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Matiruty Score'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['controller' => 'RcMappings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['controller' => 'RcMappings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentControls index large-9 medium-8 columns content">
    <h3><?= __('Assessment Controls') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('compliance_score') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maturity_rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentControls as $assessmentControl): ?>
            <tr>
                <td><?= $this->Number->format($assessmentControl->id) ?></td>
                <td><?= $assessmentControl->has('assessment') ? $this->Html->link($assessmentControl->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentControl->assessment->id]) : '' ?></td>
                <td><?= h($assessmentControl->name) ?></td>
                <td><?= $this->Number->format($assessmentControl->compliance_score) ?></td>
                <td><?= $this->Number->format($assessmentControl->maturity_rating) ?></td>
                <td><?= $this->Number->format($assessmentControl->sub_total) ?></td>
                <td><?= h($assessmentControl->created) ?></td>
                <td><?= h($assessmentControl->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentControl->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentControl->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentControl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentControl->id)]) ?>
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
