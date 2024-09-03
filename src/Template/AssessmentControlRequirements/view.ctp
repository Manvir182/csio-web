<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentControlRequirement $assessmentControlRequirement
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Control Requirement'), ['action' => 'edit', $assessmentControlRequirement->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Control Requirement'), ['action' => 'delete', $assessmentControlRequirement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentControlRequirement->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Acr Statuses'), ['controller' => 'AcrStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Acr Status'), ['controller' => 'AcrStatuses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentControlRequirements view large-9 medium-8 columns content">
    <h3><?= h($assessmentControlRequirement->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment Control') ?></th>
            <td><?= $assessmentControlRequirement->has('assessment_control') ? $this->Html->link($assessmentControlRequirement->assessment_control->name, ['controller' => 'AssessmentControls', 'action' => 'view', $assessmentControlRequirement->assessment_control->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assessmentControlRequirement->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($assessmentControlRequirement->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentControlRequirement->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Compliance Score') ?></th>
            <td><?= $this->Number->format($assessmentControlRequirement->compliance_score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assessed By') ?></th>
            <td><?= $this->Number->format($assessmentControlRequirement->assessed_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assessmentControlRequirement->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assessmentControlRequirement->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControlRequirement->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Artifact') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControlRequirement->artifact)); ?>
    </div>
    <div class="row">
        <h4><?= __('Reference') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControlRequirement->reference)); ?>
    </div>
    <div class="row">
        <h4><?= __('Compliance Status') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControlRequirement->compliance_status)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Acr Statuses') ?></h4>
        <?php if (!empty($assessmentControlRequirement->acr_statuses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Control Requirement Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Status Log') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assessmentControlRequirement->acr_statuses as $acrStatuses): ?>
            <tr>
                <td><?= h($acrStatuses->id) ?></td>
                <td><?= h($acrStatuses->assessment_control_requirement_id) ?></td>
                <td><?= h($acrStatuses->user_id) ?></td>
                <td><?= h($acrStatuses->status) ?></td>
                <td><?= h($acrStatuses->status_log) ?></td>
                <td><?= h($acrStatuses->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AcrStatuses', 'action' => 'view', $acrStatuses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AcrStatuses', 'action' => 'edit', $acrStatuses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AcrStatuses', 'action' => 'delete', $acrStatuses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acrStatuses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
