<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentRisk $assessmentRisk
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Risk'), ['action' => 'edit', $assessmentRisk->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Risk'), ['action' => 'delete', $assessmentRisk->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentRisk->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['controller' => 'RcMappings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['controller' => 'RcMappings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentRisks view large-9 medium-8 columns content">
    <h3><?= h($assessmentRisk->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment') ?></th>
            <td><?= $assessmentRisk->has('assessment') ? $this->Html->link($assessmentRisk->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentRisk->assessment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Risk') ?></th>
            <td><?= h($assessmentRisk->risk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentRisk->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Residual Score') ?></th>
            <td><?= $this->Number->format($assessmentRisk->residual_score) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Risk Description') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentRisk->risk_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Inherent Risk Rank') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentRisk->inherent_scale)); ?>
    </div>
    <div class="row">
        <h4><?= __('Residual Scale') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentRisk->residual_scale)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rc Mappings') ?></h4>
        <?php if (!empty($assessmentRisk->rc_mappings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Risk Id') ?></th>
                <th scope="col"><?= __('Assessment Control Id') ?></th>
                <th scope="col"><?= __('Mapping') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assessmentRisk->rc_mappings as $rcMappings): ?>
            <tr>
                <td><?= h($rcMappings->id) ?></td>
                <td><?= h($rcMappings->assessment_risk_id) ?></td>
                <td><?= h($rcMappings->assessment_control_id) ?></td>
                <td><?= h($rcMappings->mapping) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'RcMappings', 'action' => 'view', $rcMappings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'RcMappings', 'action' => 'edit', $rcMappings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'RcMappings', 'action' => 'delete', $rcMappings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rcMappings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
