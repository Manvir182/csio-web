<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Risk $risk
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Risks'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="risks form large-9 medium-8 columns content">
    <?= $this->Form->create($risk) ?>
    <?php
        echo $this->Form->control('name',array(
        	'class'=>'form-control',
			'label'=>array('text'=>'Risk Name','class'=>'cl-font-13'),
			'div'=>array('class'=>'form-group')
		));
        echo $this->Form->control('status');
    ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
