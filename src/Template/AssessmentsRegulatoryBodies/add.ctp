<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentsRegulatoryBody $assessmentsRegulatoryBody
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Assessments Regulatory Bodies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentsRegulatoryBodies form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentsRegulatoryBody) ?>
    <fieldset>
        <legend><?= __('Add Assessments Regulatory Body') ?></legend>
        <?php
            echo $this->Form->control('assessment_id', ['options' => $assessments, 'empty' => true]);
            echo $this->Form->control('regulatory_body_id', ['options' => $regulatoryBodies, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
