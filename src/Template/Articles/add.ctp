<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
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
                <?= $this->Form->create($article,['enctype' => 'multipart/form-data']) ?>
                    <fieldset>
                        <legend><?= __('Add Article') ?></legend>
                        <?php
                         echo $this->Form->control('title',[
                            'class'=>'form-control'
                        ]);
                        ?>
                        <div class = "row">
                        <div class="col-md-6"> 
                            <?php 
                             echo $this->Form->control('category_id', [
                                'options' => $categories,
                                'class'=>'form-control'
                            ]);
                            ?>
                            </div>
                            <div class="col-md-6"> 
                            <?php 
                            echo $this->Form->control('author_id', [
                                'options' => $authors,
                                'class'=>'form-control'
                            ]);       
                            ?>
                         </div>
                         </div>
                        <?php
                                               
                            echo $this->Form->control('content',[
                                'class'=>'form-control ckeditor'
                            ]);
                           
                            echo $this->Form->control('image',[
                                "label" => "Banner Image",
                                'type' => 'file',
                                'class'=>'form-control',
                               
                            ]);
                            echo $this->Form->control('published',[
                                'class'=>'form-control'
                            ]);
                            // echo $this->Form->control('slug',[
                            //     'class'=>'form-control'
                            // ]);
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

