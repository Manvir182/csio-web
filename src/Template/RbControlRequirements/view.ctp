<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RbControlRequirement $rbControlRequirement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rb Control Requirement'), ['action' => 'edit', $rbControlRequirement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rb Control Requirement'), ['action' => 'delete', $rbControlRequirement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbControlRequirement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rb Control Requirements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rb Control Requirement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rb Controls'), ['controller' => 'RbControls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rb Control'), ['controller' => 'RbControls', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rbControlRequirements view large-9 medium-8 columns content">
    <h3><?= h($rbControlRequirement->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rb Control') ?></th>
            <td><?= $rbControlRequirement->has('rb_control') ? $this->Html->link($rbControlRequirement->rb_control->name, ['controller' => 'RbControls', 'action' => 'view', $rbControlRequirement->rb_control->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rbControlRequirement->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rbControlRequirement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($rbControlRequirement->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($rbControlRequirement->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($rbControlRequirement->description)); ?>
    </div>
</div>
