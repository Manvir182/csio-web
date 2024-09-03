<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RcMapping[]|\Cake\Collection\CollectionInterface $rcMappings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rc Mapping'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Risks'), ['controller' => 'AssessmentRisks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Risk'), ['controller' => 'AssessmentRisks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessment Controls'), ['controller' => 'AssessmentControls', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment Control'), ['controller' => 'AssessmentControls', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rcMappings index large-9 medium-8 columns content">
    <h3><?= __('Rc Mappings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_risk_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_control_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mapping') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rcMappings as $rcMapping): ?>
            <tr>
                <td><?= $this->Number->format($rcMapping->id) ?></td>
                <td><?= $rcMapping->has('assessment_risk') ? $this->Html->link($rcMapping->assessment_risk->id, ['controller' => 'AssessmentRisks', 'action' => 'view', $rcMapping->assessment_risk->id]) : '' ?></td>
                <td><?= $rcMapping->has('assessment_control') ? $this->Html->link($rcMapping->assessment_control->name, ['controller' => 'AssessmentControls', 'action' => 'view', $rcMapping->assessment_control->id]) : '' ?></td>
                <td><?= h($rcMapping->mapping) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rcMapping->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rcMapping->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rcMapping->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rcMapping->id)]) ?>
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
