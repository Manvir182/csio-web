<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question Options'), ['controller' => 'QuestionOptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Option'), ['controller' => 'QuestionOptions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Qtype') ?></th>
            <td><?= h($question->qtype) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($question->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($question->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($question->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Name') ?></h4>
        <?= $this->Text->autoParagraph(h($question->name)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Question Options') ?></h4>
        <?php if (!empty($question->question_options)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->question_options as $questionOptions): ?>
            <tr>
                <td><?= h($questionOptions->id) ?></td>
                <td><?= h($questionOptions->question_id) ?></td>
                <td><?= h($questionOptions->name) ?></td>
                <td><?= h($questionOptions->created) ?></td>
                <td><?= h($questionOptions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'QuestionOptions', 'action' => 'view', $questionOptions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'QuestionOptions', 'action' => 'edit', $questionOptions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'QuestionOptions', 'action' => 'delete', $questionOptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionOptions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
