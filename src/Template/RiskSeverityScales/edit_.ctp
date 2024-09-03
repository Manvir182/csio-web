<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskSeverityScale $riskSeverityScale
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $riskSeverityScale->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $riskSeverityScale->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Risk Severity Scales'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="riskSeverityScales form large-9 medium-8 columns content">
    <?= $this->Form->create($riskSeverityScale) ?>
    <fieldset>
        <legend><?= __('Edit Risk Severity Scale') ?></legend>
        <?php
            echo $this->Form->control('severity_scale');
            echo $this->Form->control('financial_loss');
            echo $this->Form->control('customer');
            echo $this->Form->control('regulatory');
            echo $this->Form->control('business_disruption');
            echo $this->Form->control('headline_risk');
            echo $this->Form->control('score');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
