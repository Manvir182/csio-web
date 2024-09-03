<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentRisk[]|\Cake\Collection\CollectionInterface $assessmentRisks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rc Mappings'), ['controller' => 'RcMappings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['controller' => 'RcMappings', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentRisks index large-9 medium-8 columns content">
    <h3><?= __('Assessment Risks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('risk') ?></th>
                <th scope="col"><?= $this->Paginator->sort('residual_score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentRisks as $assessmentRisk): ?>
            <tr>
                <td><?= $this->Number->format($assessmentRisk->id) ?></td>
                <td><?= $assessmentRisk->has('assessment') ? $this->Html->link($assessmentRisk->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentRisk->assessment->id]) : '' ?></td>
                <td><?= h($assessmentRisk->risk) ?></td>
                <td><?= $this->Number->format($assessmentRisk->residual_score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentRisk->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentRisk->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentRisk->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentRisk->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
