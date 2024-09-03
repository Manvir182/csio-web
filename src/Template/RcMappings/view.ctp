<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RcMapping $rcMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rc Mapping'), ['action' => 'edit', $rcMapping->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rc Mapping'), ['action' => 'delete', $rcMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rcMapping->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['controller' => 'AssessmentRisks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['controller' => 'AssessmentRisks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rcMappings view large-9 medium-8 columns content">
    <h3><?= h($rcMapping->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment Risk') ?></th>
            <td><?= $rcMapping->has('assessment_risk') ? $this->Html->link($rcMapping->assessment_risk->id, ['controller' => 'AssessmentRisks', 'action' => 'view', $rcMapping->assessment_risk->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assessment Control') ?></th>
            <td><?= $rcMapping->has('assessment_control') ? $this->Html->link($rcMapping->assessment_control->name, ['controller' => 'AssessmentControls', 'action' => 'view', $rcMapping->assessment_control->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mapping') ?></th>
            <td><?= h($rcMapping->mapping) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rcMapping->id) ?></td>
        </tr>
    </table>
</div>
