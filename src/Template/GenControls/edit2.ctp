<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GenControl $genControl
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $genControl->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $genControl->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Gen Controls'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gen Control Requirements'), ['controller' => 'GenControlRequirements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gen Control Requirement'), ['controller' => 'GenControlRequirements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="genControls form large-9 medium-8 columns content">
    <?= $this->Form->create($genControl) ?>
    <fieldset>
        <legend><?= __('Edit Gen Control') ?></legend>
        <?php
            echo $this->Form->control('regulatory_body_id', ['options' => $regulatoryBodies, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
