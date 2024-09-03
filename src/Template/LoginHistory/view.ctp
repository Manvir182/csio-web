<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LoginHistory $loginHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Login History'), ['action' => 'edit', $loginHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Login History'), ['action' => 'delete', $loginHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $loginHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Login History'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Login History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="loginHistory view large-9 medium-8 columns content">
    <h3><?= h($loginHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $loginHistory->has('user') ? $this->Html->link($loginHistory->user->id, ['controller' => 'Users', 'action' => 'view', $loginHistory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip Address') ?></th>
            <td><?= h($loginHistory->ip_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($loginHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Log Time') ?></th>
            <td><?= h($loginHistory->log_time) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Remarks') ?></h4>
        <?= $this->Text->autoParagraph(h($loginHistory->remarks)); ?>
    </div>
</div>
