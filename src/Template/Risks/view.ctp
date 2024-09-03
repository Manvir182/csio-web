<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Risk $risk
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Risk'), ['action' => 'edit', $risk->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Risk'), ['action' => 'delete', $risk->id], ['confirm' => __('Are you sure you want to delete # {0}?', $risk->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Risks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Risk'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="risks view large-9 medium-8 columns content">
    <h3><?= h($risk->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($risk->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($risk->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($risk->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($risk->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($risk->description)); ?>
    </div>
</div>
