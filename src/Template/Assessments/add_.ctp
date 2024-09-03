<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assessment $assessment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['controller' => 'AssessmentRisks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['controller' => 'AssessmentRisks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Severity Scales'), ['controller' => 'AssessmentSeverityScales', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Severity Scale'), ['controller' => 'AssessmentSeverityScales', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Statuses'), ['controller' => 'AssessmentStatuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Status'), ['controller' => 'AssessmentStatuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessments form large-9 medium-8 columns content">
    <?= $this->Form->create($assessment) ?>
    <fieldset>
        <legend><?= __('Add Assessment') ?></legend>
        <?php
            echo $this->Form->control('owner_id');
            echo $this->Form->control('requester_id');
            echo $this->Form->control('case_number');
            echo $this->Form->control('atype');
            echo $this->Form->control('sub_type');
            echo $this->Form->control('name');
            echo $this->Form->control('status');
            echo $this->Form->control('evidence_file');
            echo $this->Form->control('file_name');
            echo $this->Form->control('file_description');
            echo $this->Form->control('signature');
            echo $this->Form->control('result_status');
            echo $this->Form->control('regulatory_bodies._ids', ['options' => $regulatoryBodies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
