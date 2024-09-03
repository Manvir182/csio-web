<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RbControl $rbControl
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rb Control'), ['action' => 'edit', $rbControl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rb Control'), ['action' => 'delete', $rbControl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbControl->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rb Controls'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rb Control'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rb Control Requirements'), ['controller' => 'RbControlRequirements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rb Control Requirement'), ['controller' => 'RbControlRequirements', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rbControls view large-9 medium-8 columns content">
    <h3><?= h($rbControl->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Regulatory Body') ?></th>
            <td><?= $rbControl->has('regulatory_body') ? $this->Html->link($rbControl->regulatory_body->name, ['controller' => 'RegulatoryBodies', 'action' => 'view', $rbControl->regulatory_body->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rbControl->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rbControl->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($rbControl->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($rbControl->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($rbControl->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rb Control Requirements') ?></h4>
        <?php if (!empty($rbControl->rb_control_requirements)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Rb Control Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rbControl->rb_control_requirements as $rbControlRequirements): ?>
            <tr>
                <td><?= h($rbControlRequirements->id) ?></td>
                <td><?= h($rbControlRequirements->rb_control_id) ?></td>
                <td><?= h($rbControlRequirements->name) ?></td>
                <td><?= h($rbControlRequirements->description) ?></td>
                <td><?= h($rbControlRequirements->created) ?></td>
                <td><?= h($rbControlRequirements->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RbControlRequirements', 'action' => 'view', $rbControlRequirements->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RbControlRequirements', 'action' => 'edit', $rbControlRequirements->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RbControlRequirements', 'action' => 'delete', $rbControlRequirements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbControlRequirements->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
