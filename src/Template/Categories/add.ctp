<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>

<div class="row">
	<div class="col-8 align-left">
		<div class="text-right p-10">
	    	<?php
	    		echo $this->Html->link('<i class="fa fa-users"></i> View All',[
	    			'action'=>'index'
	    		],[
	    			'class'=>'btn btn-sm btn-primary',
	    			'escape'=>false
	    		]);
	    	?>
	    </div>
		<div class="card">
			<div class="card-body p-10">
                <?= $this->Form->create($category) ?>
                <fieldset>
                    <legend><?= __('Add Category') ?></legend>
                    <?php
                        echo $this->Form->control('name',[
                            'class'=>'form-control'
                        ]);
                        echo $this->Form->control('slug',[
                            'class'=>'form-control'
                        ]);
                        echo $this->Form->control('enabled',[
                            'class'=>'form-control'
                        ]);
                        echo $this->Form->control('sort_order',[
                            'class'=>'form-control'
                        ]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-danger']) ?>
                <?= $this->Form->end() ?>
            </div>
		</div>
	</div>
    <div class="col-4 align-right">
        <?= $this->Element('blogNav') ?>                    
    </div>
</div>
