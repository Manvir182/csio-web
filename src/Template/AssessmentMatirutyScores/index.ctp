<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentMatirutyScore[]|\Cake\Collection\CollectionInterface $assessmentMatirutyScores
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Matiruty Score'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentMatirutyScores index large-9 medium-8 columns content">
    <h3><?= __('Assessment Matiruty Scores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_control_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maturity_attribute') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maturity_option') ?></th>
                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentMatirutyScores as $assessmentMatirutyScore): ?>
            <tr>
                <td><?= $this->Number->format($assessmentMatirutyScore->id) ?></td>
                <td><?= $assessmentMatirutyScore->has('assessment_control') ? $this->Html->link($assessmentMatirutyScore->assessment_control->name, ['controller' => 'AssessmentControls', 'action' => 'view', $assessmentMatirutyScore->assessment_control->id]) : '' ?></td>
                <td><?= h($assessmentMatirutyScore->maturity_attribute) ?></td>
                <td><?= h($assessmentMatirutyScore->maturity_option) ?></td>
                <td><?= $this->Number->format($assessmentMatirutyScore->score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentMatirutyScore->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentMatirutyScore->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentMatirutyScore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentMatirutyScore->id)]) ?>
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
