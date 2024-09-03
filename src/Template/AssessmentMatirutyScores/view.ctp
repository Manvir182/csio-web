<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentMatirutyScore $assessmentMatirutyScore
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Matiruty Score'), ['action' => 'edit', $assessmentMatirutyScore->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Matiruty Score'), ['action' => 'delete', $assessmentMatirutyScore->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentMatirutyScore->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Matiruty Scores'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Matiruty Score'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentMatirutyScores view large-9 medium-8 columns content">
    <h3><?= h($assessmentMatirutyScore->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment Control') ?></th>
            <td><?= $assessmentMatirutyScore->has('assessment_control') ? $this->Html->link($assessmentMatirutyScore->assessment_control->name, ['controller' => 'AssessmentControls', 'action' => 'view', $assessmentMatirutyScore->assessment_control->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maturity Attribute') ?></th>
            <td><?= h($assessmentMatirutyScore->maturity_attribute) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maturity Option') ?></th>
            <td><?= h($assessmentMatirutyScore->maturity_option) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentMatirutyScore->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($assessmentMatirutyScore->score) ?></td>
        </tr>
    </table>
</div>
