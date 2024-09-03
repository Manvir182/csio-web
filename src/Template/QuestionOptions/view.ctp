<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionOption $questionOption
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question Option'), ['action' => 'edit', $questionOption->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question Option'), ['action' => 'delete', $questionOption->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionOption->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Question Options'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Option'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionOptions view large-9 medium-8 columns content">
    <h3><?= h($questionOption->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionOption->has('question') ? $this->Html->link($questionOption->question->name, ['controller' => 'Questions', 'action' => 'view', $questionOption->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($questionOption->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($questionOption->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($questionOption->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($questionOption->name)); ?>
    </div>
</div>
