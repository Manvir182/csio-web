<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaturityAttribute $maturityAttribute
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Maturity Attribute'), ['action' => 'edit', $maturityAttribute->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Maturity Attribute'), ['action' => 'delete', $maturityAttribute->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maturityAttribute->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Maturity Attributes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Maturity Attribute'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="maturityAttributes view large-9 medium-8 columns content">
    <h3><?= h($maturityAttribute->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($maturityAttribute->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($maturityAttribute->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($maturityAttribute->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($maturityAttribute->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($maturityAttribute->description)); ?>
    </div>
</div>
