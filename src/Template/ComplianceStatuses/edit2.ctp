<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplianceStatus $complianceStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $complianceStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $complianceStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Compliance Statuses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="complianceStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($complianceStatus) ?>
    <fieldset>
        <legend><?= __('Edit Compliance Status') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('score');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
