<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionOption $questionOption
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Question Options'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionOptions form large-9 medium-8 columns content">
    <?= $this->Form->create($questionOption) ?>
    <fieldset>
        <legend><?= __('Add Question Option') ?></legend>
        <?php
            echo $this->Form->control('question_id', ['options' => $questions, 'empty' => true]);
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
