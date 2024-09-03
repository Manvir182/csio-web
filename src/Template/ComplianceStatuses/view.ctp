<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplianceStatus $complianceStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Compliance Status'), ['action' => 'edit', $complianceStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Compliance Status'), ['action' => 'delete', $complianceStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $complianceStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Compliance Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Compliance Status'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="complianceStatuses view large-9 medium-8 columns content">
    <h3><?= h($complianceStatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($complianceStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($complianceStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($complianceStatus->score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($complianceStatus->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($complianceStatus->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($complianceStatus->description)); ?>
    </div>
</div>
