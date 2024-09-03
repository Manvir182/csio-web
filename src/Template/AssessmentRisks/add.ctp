<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentRisk $assessmentRisk
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['controller' => 'RcMappings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['controller' => 'RcMappings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentRisks form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentRisk) ?>
    <fieldset>
        <legend><?= __('Add Assessment Risk') ?></legend>
        <?php
            echo $this->Form->control('assessment_id', ['options' => $assessments, 'empty' => true]);
            echo $this->Form->control('risk');
            echo $this->Form->control('risk_description');
            echo $this->Form->control('inherent_scale');
            echo $this->Form->control('residual_score');
            echo $this->Form->control('residual_scale');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
