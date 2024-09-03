<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentStatus $assessmentStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Status'), ['action' => 'edit', $assessmentStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Status'), ['action' => 'delete', $assessmentStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentStatuses view large-9 medium-8 columns content">
    <h3><?= h($assessmentStatus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment') ?></th>
            <td><?= $assessmentStatus->has('assessment') ? $this->Html->link($assessmentStatus->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentStatus->assessment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $assessmentStatus->has('user') ? $this->Html->link($assessmentStatus->user->id, ['controller' => 'Users', 'action' => 'view', $assessmentStatus->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($assessmentStatus->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assessmentStatus->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Status Log') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentStatus->status_log)); ?>
    </div>
</div>
