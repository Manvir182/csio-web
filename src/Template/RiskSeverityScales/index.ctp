<div class="row page-titles">
    <div class="col-md-8 col-8">
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
            		echo $this->Html->link('Risk Severity Scales',array(
						'controller'=>'RiskSeverityScales','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">Risk Severity Scales Listing</li>
        </ol>
    </div> 
    <div class="col-md-4 col-4 text-right">
    	<div class="btn-group btn-sm">
    		<?php
    			echo $this->Html->link('<i class="fa fa-plus"></i> Create New',array(
					'action'=>'add'
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
		    <table class="table table-bordered">
		        <thead>
		            <tr class="active">
		                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('severity_scale') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('financial_loss') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('customer') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('regulatory') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('business_disruption') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('headline_risk') ?></th>
		                <th scope="col"><?= $this->Paginator->sort('score') ?></th>
		                <th scope="col" class="actions"><?= __('Actions') ?></th>
		            </tr>
		        </thead>
		        <tbody>
		            <?php foreach ($riskSeverityScales as $riskSeverityScale): ?>
		            <tr>
		                <td><?= $this->Number->format($riskSeverityScale->id) ?></td>
		                <td><?= h($riskSeverityScale->severity_scale) ?></td>
		                <td><?= h($riskSeverityScale->financial_loss) ?></td>
		                <td><?= h($riskSeverityScale->customer) ?></td>
		                <td><?= h($riskSeverityScale->regulatory) ?></td>
		                <td><?= h($riskSeverityScale->business_disruption) ?></td>
		                <td><?= h($riskSeverityScale->headline_risk) ?></td>
		                <td><?= $this->Number->format($riskSeverityScale->score) ?></td>
		                <td class="actions" style="width:90px;">
		                    <?= $this->Html->link(__('<i class="fa fa-edit"></i>'), ['action' => 'edit', $riskSeverityScale->id],['class'=>'btn btn-sm btn-outline-info','escape'=>false]) ?>
		                    <?= $this->Form->postLink(__('<i class="fa fa-times"></i>'), ['action' => 'delete', $riskSeverityScale->id], ['class'=>'btn btn-sm btn-outline-danger','escape'=>false,'confirm' => __('Are you sure you want to delete # {0}?', $riskSeverityScale->severity_scale)]) ?>
		                </td>
		            </tr>
		            <?php endforeach; ?>
		        </tbody>
		    </table>
	    	<div class="card-body p-20 sr-only">
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
</div>
