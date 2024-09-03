<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentControl $assessmentControl
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['action' => 'index']) ?></li>
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
<div class="assessmentControls form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentControl) ?>
    <fieldset>
        <legend><?= __('Add Assessment Control') ?></legend>
        <?php
            echo $this->Form->control('assessment_id', ['options' => $assessments, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('evidence_file');
            echo $this->Form->control('compliance_status');
            echo $this->Form->control('compliance_score');
            echo $this->Form->control('maturity_rating');
            echo $this->Form->control('sub_total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
