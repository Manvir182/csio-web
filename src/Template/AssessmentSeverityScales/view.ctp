<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentSeverityScale $assessmentSeverityScale
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Severity Scale'), ['action' => 'edit', $assessmentSeverityScale->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Severity Scale'), ['action' => 'delete', $assessmentSeverityScale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentSeverityScale->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Severity Scales'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Severity Scale'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentSeverityScales view large-9 medium-8 columns content">
    <h3><?= h($assessmentSeverityScale->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment') ?></th>
            <td><?= $assessmentSeverityScale->has('assessment') ? $this->Html->link($assessmentSeverityScale->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentSeverityScale->assessment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Severity Scale') ?></th>
            <td><?= h($assessmentSeverityScale->severity_scale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentSeverityScale->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($assessmentSeverityScale->score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assessmentSeverityScale->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assessmentSeverityScale->modified) ?></td>
        </tr>
    </table>
</div>
