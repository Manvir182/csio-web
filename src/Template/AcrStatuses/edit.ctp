<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcrStatus $acrStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $acrStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $acrStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Acr Statuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['controller' => 'AssessmentControlRequirements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['controller' => 'AssessmentControlRequirements', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acrStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($acrStatus) ?>
    <fieldset>
        <legend><?= __('Edit Acr Status') ?></legend>
        <?php
            echo $this->Form->control('assessment_control_requirement_id', ['options' => $assessmentControlRequirements, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('status');
            echo $this->Form->control('status_log');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
