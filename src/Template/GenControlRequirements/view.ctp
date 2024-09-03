<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GenControlRequirement $genControlRequirement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Gen Control Requirement'), ['action' => 'edit', $genControlRequirement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gen Control Requirement'), ['action' => 'delete', $genControlRequirement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $genControlRequirement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Gen Control Requirements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gen Control Requirement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gen Controls'), ['controller' => 'GenControls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gen Control'), ['controller' => 'GenControls', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="genControlRequirements view large-9 medium-8 columns content">
    <h3><?= h($genControlRequirement->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Gen Control') ?></th>
            <td><?= $genControlRequirement->has('gen_control') ? $this->Html->link($genControlRequirement->gen_control->name, ['controller' => 'GenControls', 'action' => 'view', $genControlRequirement->gen_control->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($genControlRequirement->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($genControlRequirement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($genControlRequirement->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($genControlRequirement->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($genControlRequirement->description)); ?>
    </div>
</div>
