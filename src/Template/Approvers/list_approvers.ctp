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
           
            <li class="breadcrumb-item active">Approvers Listing</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'controller'=>'approvers','action'=>'add'
				),array(
					'escape'=>false, 'class'=>'btn btn-info'
				));
				
    		?>
    		
    	</div>
    </div>                  
</div>
<div class="">
    <div class="card">
        <div class="table-responsiv">
		    <table cellpadding="0" cellspacing="0" class="table table-bordered table-stripped">
		        <thead>
		            <tr>
		                <th scope="col">No.</th>
		                <th scope="col">Name</th>
		                <th scope="col">Email</th>
		                <th scope="col">
		                	Created On
		                </th>
		                <th scope="col">
		                	Modified On
		                </th>
		                <th scope="col" class="actions" style="width:130px;"><?= __('Actions') ?></th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php $sr=1; foreach ($approvers as $user): ?>
		            <tr>
		                <td align="center"><?= $sr++; ?>.</td>
		               	<td>
		               		<?= h($user->first_name) ?>
		               		<?= h($user->last_name) ?>
		               	</td>
		                <td><?= h($user->email) ?></td>
		                <td><?= h(date('d-M-y',strtotime($user->created))) ?></td>
		                <td><?= h(date('d-M-y',strtotime($user->modified))) ?></td>
		                
		                <td class="actions">
		                    <?= $this->Html->link(__('<i class="fa fa-eye"></i>'), ['action' => 'view', $user->id],['class'=>'btn btn-xs btn-info text-white','escape'=>false,'data-toggle'=>'tooltip','title'=>'Details']) ?>
		                    <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $user->id],['class'=>'btn btn-xs btn-warning text-white','escape'=>false,'data-toggle'=>'tooltip','title'=>'Modify']) ?>
		                   <!-- 
		                    <?= $this->Form->postLink("<i class='fa fa-trash'></i>", ['action' => 'delete', $user->id], ['class'=>'btn btn-xs btn-danger text-white','escape'=>false,'data-toggle'=>'tooltip','title'=>'Delete Approver', 'confirm' => __('Are you sure you want to delete # {0}?', $user->first_name)]) ?>
		                   -->
		                </td>
		            </tr>
		            <?php endforeach; ?>
		        </tbody>
		    </table>
		</div>
	</div>
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
