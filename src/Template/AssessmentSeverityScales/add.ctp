<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentSeverityScale $assessmentSeverityScale
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assessment Severity Scales'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentSeverityScales form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentSeverityScale) ?>
    <fieldset>
        <legend><?= __('Add Assessment Severity Scale') ?></legend>
        <?php
            echo $this->Form->control('assessment_id', ['options' => $assessments, 'empty' => true]);
            echo $this->Form->control('severity_scale');
            echo $this->Form->control('score');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
