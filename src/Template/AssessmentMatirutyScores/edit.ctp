<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentMatirutyScore $assessmentMatirutyScore
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assessmentMatirutyScore->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentMatirutyScore->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assessment Matiruty Scores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentMatirutyScores form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentMatirutyScore) ?>
    <fieldset>
        <legend><?= __('Edit Assessment Matiruty Score') ?></legend>
        <?php
            echo $this->Form->control('assessment_control_id', ['options' => $assessmentControls, 'empty' => true]);
            echo $this->Form->control('maturity_attribute');
            echo $this->Form->control('maturity_option');
            echo $this->Form->control('score');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
