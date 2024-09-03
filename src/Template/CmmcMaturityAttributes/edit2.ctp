<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MaturityAttribute $maturityAttribute
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $maturityAttribute->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $maturityAttribute->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Maturity Attributes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="maturityAttributes form large-9 medium-8 columns content">
    <?= $this->Form->create($maturityAttribute) ?>
    <fieldset>
        <legend><?= __('Edit Maturity Attribute') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
