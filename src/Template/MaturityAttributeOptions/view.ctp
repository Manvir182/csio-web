<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaturityAttributeOption $maturityAttributeOption
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Maturity Attribute Option'), ['action' => 'edit', $maturityAttributeOption->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Maturity Attribute Option'), ['action' => 'delete', $maturityAttributeOption->id], ['confirm' => __('Are you sure you want to delete # {0}?', $maturityAttributeOption->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Maturity Attribute Options'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Maturity Attribute Option'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="maturityAttributeOptions view large-9 medium-8 columns content">
    <h3><?= h($maturityAttributeOption->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($maturityAttributeOption->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($maturityAttributeOption->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($maturityAttributeOption->score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($maturityAttributeOption->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($maturityAttributeOption->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($maturityAttributeOption->description)); ?>
    </div>
</div>
