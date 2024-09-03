<style>
	.pagination li {
		display:inline-block;
	}
	.pagination li a {
		display:inline-block;
		padding:3px 6px;
		border:1px solid #ccc;
	}
	.pagination li a.current,
	.pagination li a.active {
		background:#007BB6;
		color:#fff;
	}
</style>
<div class="row page-titles">
    <div class="col-md-8 col-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Dashboard',array(
						'controller'=>'companies','action'=>'dashboard'
					));
            	?>
            </li>
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('Questions',array(
						'controller'=>'Questions','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Questions List</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'Questions','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				
				
    		?>
    		
    	</div>
   	</div>             
</div>
<div class="">
    <div class="card">
    	<div class="card-header" style="font-weight:bold;">
    		Existing Questions
    	</div>
		<div class="card-block">
		    
		    <table cellpadding="0" class="table table-bordered table-striped table-hover dataTable" cellspacing="0">
		        <thead>
		            <tr>
		                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
		                <th scope="col">Question Type</th>
		                <th scope="col">Answer Options</th>
		                <th scope="col" class="actions"><?= __('Actions') ?></th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php foreach ($questions as $question): ?>
		            <tr>
		                <td><?= $this->Number->format($question->id) ?></td>
		                <td><?= h($question->name) ?></td>
		                <td><?= h($question->qtype) ?> Option</td>
		                <td>
		                	<ol type="a">
		                		<?php foreach($question->question_options as $qoption): ?>
		                			<li><?php echo $qoption->name; ?></li>
		                		<?php endforeach; ?>
		                	</ol>
		                </td>
		                <td class="actions">
		                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->id],['class'=>'btn btn-info text-white','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Modify']) ?>
		                    <!--<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?>-->
		                </td>
		            </tr>
		            <?php endforeach; ?>
		        </tbody>
		    </table>
		    <div class="paginator">
		        <ul class="pagination">
		            <?= $this->Paginator->first('<< ' . __('first')) ?>
		            <?= $this->Paginator->prev('< ' . __('previous')) ?>
		            <?= $this->Paginator->numbers() ?>
		            <?= $this->Paginator->next(__('next') . ' >') ?>
		            <?= $this->Paginator->last(__('last') . ' >>') ?>
		        </ul>
		        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
		    </div>
		</div>
	</div>
</div>
