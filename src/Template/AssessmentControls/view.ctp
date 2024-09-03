<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentControl $assessmentControl
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Control'), ['action' => 'edit', $assessmentControl->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Control'), ['action' => 'delete', $assessmentControl->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentControl->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Control Requirements'), ['controller' => 'AssessmentControlRequirements', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Control Requirement'), ['controller' => 'AssessmentControlRequirements', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Matiruty Scores'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Matiruty Score'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['controller' => 'RcMappings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['controller' => 'RcMappings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentControls view large-9 medium-8 columns content">
    <h3><?= h($assessmentControl->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Assessment') ?></th>
            <td><?= $assessmentControl->has('assessment') ? $this->Html->link($assessmentControl->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentControl->assessment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assessmentControl->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($assessmentControl->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Compliance Score') ?></th>
            <td><?= $this->Number->format($assessmentControl->compliance_score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maturity Rating') ?></th>
            <td><?= $this->Number->format($assessmentControl->maturity_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Total') ?></th>
            <td><?= $this->Number->format($assessmentControl->sub_total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assessmentControl->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assessmentControl->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControl->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Evidence File') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControl->evidence_file)); ?>
    </div>
    <div class="row">
        <h4><?= __('Compliance Status') ?></h4>
        <?= $this->Text->autoParagraph(h($assessmentControl->compliance_status)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Assessment Control Requirements') ?></h4>
        <?php if (!empty($assessmentControl->assessment_control_requirements)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Control Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Artifact') ?></th>
                <th scope="col"><?= __('Reference') ?></th>
                <th scope="col"><?= __('Compliance Status') ?></th>
                <th scope="col"><?= __('Compliance Score') ?></th>
                <th scope="col"><?= __('Assessed By') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assessmentControl->assessment_control_requirements as $assessmentControlRequirements): ?>
            <tr>
                <td><?= h($assessmentControlRequirements->id) ?></td>
                <td><?= h($assessmentControlRequirements->assessment_control_id) ?></td>
                <td><?= h($assessmentControlRequirements->name) ?></td>
                <td><?= h($assessmentControlRequirements->description) ?></td>
                <td><?= h($assessmentControlRequirements->artifact) ?></td>
                <td><?= h($assessmentControlRequirements->reference) ?></td>
                <td><?= h($assessmentControlRequirements->compliance_status) ?></td>
                <td><?= h($assessmentControlRequirements->compliance_score) ?></td>
                <td><?= h($assessmentControlRequirements->assessed_by) ?></td>
                <td><?= h($assessmentControlRequirements->status) ?></td>
                <td><?= h($assessmentControlRequirements->created) ?></td>
                <td><?= h($assessmentControlRequirements->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssessmentControlRequirements', 'action' => 'view', $assessmentControlRequirements->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssessmentControlRequirements', 'action' => 'edit', $assessmentControlRequirements->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssessmentControlRequirements', 'action' => 'delete', $assessmentControlRequirements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentControlRequirements->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Assessment Matiruty Scores') ?></h4>
        <?php if (!empty($assessmentControl->assessment_matiruty_scores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Control Id') ?></th>
                <th scope="col"><?= __('Maturity Attribute') ?></th>
                <th scope="col"><?= __('Maturity Option') ?></th>
                <th scope="col"><?= __('Score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assessmentControl->assessment_matiruty_scores as $assessmentMatirutyScores): ?>
            <tr>
                <td><?= h($assessmentMatirutyScores->id) ?></td>
                <td><?= h($assessmentMatirutyScores->assessment_control_id) ?></td>
                <td><?= h($assessmentMatirutyScores->maturity_attribute) ?></td>
                <td><?= h($assessmentMatirutyScores->maturity_option) ?></td>
                <td><?= h($assessmentMatirutyScores->score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'view', $assessmentMatirutyScores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'edit', $assessmentMatirutyScores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssessmentMatirutyScores', 'action' => 'delete', $assessmentMatirutyScores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentMatirutyScores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rc Mappings') ?></h4>
        <?php if (!empty($assessmentControl->rc_mappings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Assessment Risk Id') ?></th>
                <th scope="col"><?= __('Assessment Control Id') ?></th>
                <th scope="col"><?= __('Mapping') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assessmentControl->rc_mappings as $rcMappings): ?>
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
