<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AcrStatus $acrStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Acr Status'), ['action' => 'edit', $acrStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Acr Status'), ['action' => 'delete', $acrStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acrStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Acr Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acr Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['controller' => 'AssessmentControlRequirements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['controller' => 'AssessmentControlRequirements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="acrStatuses view large-9 medium-8 columns content">
    <h3><?= h($acrStatus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment Control Requirement') ?></th>
            <td><?= $acrStatus->has('assessment_control_requirement') ? $this->Html->link($acrStatus->assessment_control_requirement->name, ['controller' => 'AssessmentControlRequirements', 'action' => 'view', $acrStatus->assessment_control_requirement->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $acrStatus->has('user') ? $this->Html->link($acrStatus->user->id, ['controller' => 'Users', 'action' => 'view', $acrStatus->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($acrStatus->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($acrStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($acrStatus->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Status Log') ?></h4>
        <?= $this->Text->autoParagraph(h($acrStatus->status_log)); ?>
    </div>
</div>
