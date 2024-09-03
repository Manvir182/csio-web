<div class="row page-titles">
    <div class="col-8 align-self-center">
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
            		echo $this->Html->link('Generalized Assessment Control Areas',array(
						'controller'=>'GenControls','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">View Control Area Details</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['action'=>'add'],['class'=>'btn btn-info','escape'=>false,'style'=>'margin-right:4px;']);
			echo $this->Html->link(('<i class="fa fa-pencil"></i> Edit This'), ['action' => 'edit', $genControl->id],['class'=>'btn btn-inverse','escape'=>false,'style'=>'margin-right:4px;']);
    		echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="genControls view large-9 medium-8 columns content">
    <h2><?= h($genControl->name) ?></h2>
    <hr>
    <div class="ro">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($genControl->description)); ?>
    </div>
    <hr>
    <div class="related">
        <h4><?= h($genControl->name) ?> <?= __('Requirements') ?></h4>
        <ul type="circle">
        	<?php foreach($genControl->gen_control_requirements as $genReq): ?>
        		<li>
        			<?php echo $genReq->name; ?>
        		</li>
        	<?php endforeach; ?>
        </ul>
    </div>
</div>
