<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentsRegulatoryBody[]|\Cake\Collection\CollectionInterface $assessmentsRegulatoryBodies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessments Regulatory Body'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assessments'), ['controller' => 'Assessments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Assessment'), ['controller' => 'Assessments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Regulatory Bodies'), ['controller' => 'RegulatoryBodies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Regulatory Body'), ['controller' => 'RegulatoryBodies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentsRegulatoryBodies index large-9 medium-8 columns content">
    <h3><?= __('Assessments Regulatory Bodies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('assessment_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('regulatory_body_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessmentsRegulatoryBodies as $assessmentsRegulatoryBody): ?>
            <tr>
                <td><?= $this->Number->format($assessmentsRegulatoryBody->id) ?></td>
                <td><?= $assessmentsRegulatoryBody->has('assessment') ? $this->Html->link($assessmentsRegulatoryBody->assessment->name, ['controller' => 'Assessments', 'action' => 'view', $assessmentsRegulatoryBody->assessment->id]) : '' ?></td>
                <td><?= $assessmentsRegulatoryBody->has('regulatory_body') ? $this->Html->link($assessmentsRegulatoryBody->regulatory_body->name, ['controller' => 'RegulatoryBodies', 'action' => 'view', $assessmentsRegulatoryBody->regulatory_body->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentsRegulatoryBody->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentsRegulatoryBody->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentsRegulatoryBody->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentsRegulatoryBody->id)]) ?>
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
