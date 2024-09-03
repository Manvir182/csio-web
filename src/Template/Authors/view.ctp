<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Author $author
 */
?>

<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'users','action'=>'dashboard'
					));
            	?>
            </li>
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Authors',array(
						'controller'=>'authors','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Author Profile</li>
        </ol>
    </div>                   
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'authors','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				
				echo $this->Html->link('<i class="fa fa-list-alt"></i> All Authors',array(
					'controller'=>'authors','action'=>'index'
				),array(
					'escape'=>false, 'class'=>'btn btn-warning'
				));
    		?>
    		
    	</div>
    </div>  
</div>

<div class="row">
<!-- Column -->
<div class="col-lg-3 col-xlg-3 col-md-1"></div>
<div class="col-lg-6 col-xlg-6 col-md-10">
    <div class="card" style="border:1px solid #ccc;">
        <div class="card-header">
           <div class="row">
               <div class="col-md-6">
                  <strong>Author Profile</strong>
                  
               </div>
               <div class="col-md-6 text-right">
               		<span class="badge badge-primary">Created on <?php echo date('d-M-Y',strtotime($author->created )); ?></span>
              </div>
            </div>
        </div>
        <div class="card-block">  
        	
        		<div class="row ">
                    <div class="col-md-12">
                        <h4 class="cisoredc">Personal Information</h4>
                    </div>
                   	<div class="col-md-6">
                   		<label class="cl-font-13">Name</label>
                        <h4><?= $author->name ?></h4>
                    </div>
                    <div class="col-md-6">
                   		<label class="cl-font-13">Enabled</label>
                        <h4><?= $author->enabled ?></h4>
                    </div>
	    		</div>
        </div>
    </div>
   </div>
</div>


































<div class="authors view large-9 medium-8 columns content">
    <h3><?= h($author->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($author->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enabled') ?></th>
            <td><?= h($author->enabled) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($author->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($author->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($author->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Articles') ?></h4>
        <?php if (!empty($author->article)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Author Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Published') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($author->articles as $articles): ?>
            <tr>
                <td><?= h($articles->id) ?></td>
                <td><?= h($articles->category_id) ?></td>
                <td><?= h($articles->author_id) ?></td>
                <td><?= h($articles->title) ?></td>
                <td><?= h($articles->content) ?></td>
                <td><?= h($articles->image) ?></td>
                <td><?= h($articles->published) ?></td>
                <td><?= h($articles->slug) ?></td>
                <td><?= h($articles->created) ?></td>
                <td><?= h($articles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Articles', 'action' => 'view', $articles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Articles', 'action' => 'edit', $articles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Articles', 'action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
