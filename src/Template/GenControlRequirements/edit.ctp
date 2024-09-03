<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GenControlRequirement $genControlRequirement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $genControlRequirement->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $genControlRequirement->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Gen Control Requirements'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Gen Controls'), ['controller' => 'GenControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gen Control'), ['controller' => 'GenControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="genControlRequirements form large-9 medium-8 columns content">
    <?= $this->Form->create($genControlRequirement) ?>
    <fieldset>
        <legend><?= __('Edit Gen Control Requirement') ?></legend>
        <?php
            echo $this->Form->control('gen_control_id', ['options' => $genControls, 'empty' => true]);
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
