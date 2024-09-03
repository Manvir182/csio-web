<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentControlRequirement $assessmentControlRequirement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assessmentControlRequirement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentControlRequirement->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Acr Statuses'), ['controller' => 'AcrStatuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Acr Status'), ['controller' => 'AcrStatuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentControlRequirements form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentControlRequirement) ?>
    <fieldset>
        <legend><?= __('Edit Assessment Control Requirement') ?></legend>
        <?php
            echo $this->Form->control('assessment_control_id', ['options' => $assessmentControls, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('artifact');
            echo $this->Form->control('reference');
            echo $this->Form->control('compliance_status');
            echo $this->Form->control('compliance_score');
            echo $this->Form->control('assessed_by');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
