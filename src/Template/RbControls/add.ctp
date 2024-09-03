<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RbControl $rbControl
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rb Controls'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rb Control Requirements'), ['controller' => 'RbControlRequirements', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rb Control Requirement'), ['controller' => 'RbControlRequirements', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rbControls form large-9 medium-8 columns content">
    <?= $this->Form->create($rbControl) ?>
    <fieldset>
        <legend><?= __('Add Rb Control') ?></legend>
        <?php
            echo $this->Form->control('regulatory_body_id', ['options' => $regulatoryBodies, 'empty' => true]);
            echo $this->Form->control('name');
			echo $this->Form->control('guidance');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
