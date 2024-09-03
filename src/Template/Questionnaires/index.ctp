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
            		echo $this->Html->link('Questionnaires',array(
						'controller'=>'Questionnaires','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Questionnaires List</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'Questionnaires','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				
				
    		?>
    		
    	</div>
   	</div>             
</div>

<div class="">
    <div class="card">
    	<dic class="card-header">
    		List of Questionnaires
    	</dic>
	    <div class="card-block">
	    	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
		        <thead>
		            <tr>
		                <th scope="col">Id</th>
		                <th scope="col">Employee</th>
		                <th scope="col">Title</th>
		                <th scope="col">Questions</th>
		                <th scope="col">Created on</th>
		                <th scope="col" class="actions"><?= __('Actions') ?></th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php foreach ($questionnaires as $questionnaire): ?>
		            <tr>
		                <td><?= $this->Number->format($questionnaire->id) ?></td>
		                <td><?= $questionnaire->has('employee') ? $this->Html->link($questionnaire->employee->first_name." ".$questionnaire->employee->last_name, ['controller' => 'Employees', 'action' => 'view', $questionnaire->employee->id]) : '' ?></td>
		                <td><?= h($questionnaire->name) ?></td>
		                <td>
		                	<ol>
		                		<?php foreach($questionnaire->questions as $question): ?>
		                			<?php foreach($question as $quest): ?>
		                				<li>
			                				<?php echo $quest->name; ?>
			                			</li>
		                			<?php endforeach; ?>
		                		<?php endforeach; ?>
		                	</ol>
		                </td>
		                <td><?= h(date('d-M-y h:i a',strtotime($questionnaire->created))) ?></td>
		                <td class="actions">
		                    <!--
							<?= $this->Html->link(__('View'), ['action' => 'view', $questionnaire->id]) ?>
							-->
							<?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $questionnaire->id],['class'=>'btn btn-info text-white','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Modify','escape'=>false]) ?>
							
		                </td>
		            </tr>
		            <?php endforeach; ?>
		        </tbody>
		    </table>
	    </div>
	    <div class="card-block">
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
