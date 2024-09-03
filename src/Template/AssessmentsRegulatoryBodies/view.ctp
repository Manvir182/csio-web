<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentsRegulatoryBody $assessmentsRegulatoryBody
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessments Regulatory Body'), ['action' => 'edit', $assessmentsRegulatoryBody->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessments Regulatory Body'), ['action' => 'delete', $assessmentsRegulatoryBody->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentsRegulatoryBody->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessments Regulatory Bodies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessments Regulatory Body'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentsRegulatoryBodies view large-9 medium-8 columns content">
    <h3><?= h($assessmentsRegulatoryBody->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment') ?></th>
            <td><?= $assessmentsRegulatoryBody->has('assessment') ? $this->Html->link($assessmentsRegulatoryBody->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentsRegulatoryBody->assessment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regulatory Body') ?></th>
            <td><?= $assessmentsRegulatoryBody->has('regulatory_body') ? $this->Html->link($assessmentsRegulatoryBody->regulatory_body->name, ['controller' => 'RegulatoryBodies', 'action' => 'view', $assessmentsRegulatoryBody->regulatory_body->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentsRegulatoryBody->id) ?></td>
        </tr>
    </table>
</div>
