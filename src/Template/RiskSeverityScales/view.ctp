<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskSeverityScale $riskSeverityScale
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Risk Severity Scale'), ['action' => 'edit', $riskSeverityScale->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Risk Severity Scale'), ['action' => 'delete', $riskSeverityScale->id], ['confirm' => __('Are you sure you want to delete # {0}?', $riskSeverityScale->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Risk Severity Scales'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Risk Severity Scale'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="riskSeverityScales view large-9 medium-8 columns content">
    <h3><?= h($riskSeverityScale->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Severity Scale') ?></th>
            <td><?= h($riskSeverityScale->severity_scale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financial Loss') ?></th>
            <td><?= h($riskSeverityScale->financial_loss) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= h($riskSeverityScale->customer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regulatory') ?></th>
            <td><?= h($riskSeverityScale->regulatory) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Business Disruption') ?></th>
            <td><?= h($riskSeverityScale->business_disruption) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Headline Risk') ?></th>
            <td><?= h($riskSeverityScale->headline_risk) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($riskSeverityScale->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($riskSeverityScale->score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($riskSeverityScale->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($riskSeverityScale->modified) ?></td>
        </tr>
    </table>
</div>
