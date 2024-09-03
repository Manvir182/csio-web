<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RbControlRequirement $rbControlRequirement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rbControlRequirement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rbControlRequirement->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rb Control Requirements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Rb Controls'), ['controller' => 'RbControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rb Control'), ['controller' => 'RbControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rbControlRequirements form large-9 medium-8 columns content">
    <?= $this->Form->create($rbControlRequirement) ?>
    <fieldset>
        <legend><?= __('Edit Rb Control Requirement') ?></legend>
        <?php
            echo $this->Form->control('rb_control_id', ['options' => $rbControls, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
