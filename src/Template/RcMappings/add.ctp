<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RcMapping $rcMapping
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['controller' => 'AssessmentRisks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['controller' => 'AssessmentRisks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rcMappings form large-9 medium-8 columns content">
    <?= $this->Form->create($rcMapping) ?>
    <fieldset>
        <legend><?= __('Add Rc Mapping') ?></legend>
        <?php
            echo $this->Form->control('assessment_risk_id', ['options' => $assessmentRisks, 'empty' => true]);
            echo $this->Form->control('assessment_control_id', ['options' => $assessmentControls, 'empty' => true]);
            echo $this->Form->control('mapping');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
