<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentStatus $assessmentStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assessment Statuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentStatus) ?>
    <fieldset>
        <legend><?= __('Add Assessment Status') ?></legend>
        <?php
            echo $this->Form->control('assessment_id', ['options' => $assessments, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('status');
            echo $this->Form->control('status_log');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
