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
            		echo $this->Html->link('Regulatory Bodies',array(
						'controller'=>'RegulatoryBodies','action'=>'index'
					));
            	?>
            </li>
            <li class="breadcrumb-item active">View Regulatory Body</li>
        </ol>
    </div> 
    <div class="col-4 text-right">
    	<?php 
    		echo $this->Html->link('<i class="fa fa-plus"></i> Create New',['action'=>'add'],['class'=>'btn btn-info','escape'=>false,'style'=>'margin-right:6px;']);
			echo $this->Html->link('<i class="fa fa-pencil"></i> Edit This',['action'=>'edit',$regulatoryBody->id],['class'=>'btn btn-warning','escape'=>false,'style'=>'margin-right:6px;']);
			echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-success','escape'=>false]);
			
    	?>
    </div>                    
</div>
<div class="regulatoryBodies view large-9 medium-8 columns content">
    <h2><?= h($regulatoryBody->name) ?></h2>
    <br>
    <div class="related">
    	<h4>
    		<span class="pull-right float-right m-r-10 mr-2">Control Aread Number</span>
    		Control Areas
    	</h4>
    	<div class="accordion" id="controlAccordion">
    	  <?php foreach ($regulatoryBody->rb_controls as $rbControls): ?>
			  <div class="card" style="margin-bottom:6px !important;">
			    <div class="card-header bg-light-info" id="heading<?php echo $rbControls->id; ?>control<?php echo $rbControls->id; ?>">
			      <h2 class="mb-0">
			      	<span class="float-right pull-right">
			      		<span class="btn btn-link text-dark"> <?= h($rbControls->control_number) ?></span>
			      	</span>
			        <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse<?php echo $rbControls->id; ?>control<?php echo $rbControls->id; ?>" aria-expanded="true" aria-controls="collapse<?php echo $rbControls->id; ?>control<?php echo $rbControls->id; ?>">
			        	
			          <?= h($rbControls->name) ?>
			        </button>
			      </h2>
			    </div>
			
			    <div id="collapse<?php echo $rbControls->id; ?>control<?php echo $rbControls->id; ?>" class="collapse" aria-labelledby="heading<?php echo $rbControls->id; ?>control<?php echo $rbControls->id; ?>" data-parent="#controlAccordion">
			      <div class="card-body p-30">
			      
			        <?= h($rbControls->description) ?>
			        <br><br>
			        <div class="list-group">
					  <a class="list-group-item bg-light-inverse" style="display:block;white-space: nowrap !important;">
					  
					  	<?= h($rbControls->name) ?> Requirements
					  	
					  </a>
					  	
					  <?php foreach($rbControls->rb_control_requirements as $rbReq): ?>
					  	<a class="list-group-item">
					  		<div class="row">
					  			<div class="col-12">
					  				<u><?= h($rbReq->req_number) ?></u>
					  			</div>
					  			<div class="col-12">
					  				<div class="rcReq">
							  			<?php echo $rbReq->name; ?>
							  		</div>		
					  			</div>
					  		</div>
					      	
					  	</a>
					  <?php endforeach; ?>
					  
					</div>
			      </div>
			    </div>
			  </div>
		  <?php endforeach; ?>
		</div>
    </div>
</div>
<div>
	<br>
	<h4>Risk Control Mappings</h4>
	<?php echo $this->Form->create('RcMappings'); ?>
	<?php 
		$this->Form->setTemplates([
		    'inputContainer' => '	
		        {{content}} ',
		    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
			'radioWrapper' => '<li>{{label}}<li>'
		]);
	?>
	<div class="table-responsive">
	<table class="table table-bordered table-hover myTable">

	  	<thead>
	  		<tr>
	  			<th class="bg-warning text-white"></th>
	  			<th  class="bg-inverse" colspan="<?php echo count($risks); ?>">Risks &rarr;</th>
	  		</tr>
	  		<tr>
	  			<th class="bg-warning text-white"> Control Areas &darr;</th>
	  			<?php foreach($risks as $k=>$risk): ?>
	  				<th  class="bg-inverse"><?php echo $risk; ?></th>	
	  			<?php endforeach; ?>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
		  		<tr>
		  			<td><?php echo $risk_id; ?></td>
		  			<?php foreach($rows as $row): ?>
		  				<td>
		  					<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
							  <label class="btn btn-secondary <?php echo $row['mapping']=='P'?'active':''; ?>">
							    <input type="radio" name="mapping~<?php echo $row['id']; ?>" <?php echo $row['mapping']=='P'?'checked':''; ?> value="P" id="optionmapping~<?php echo $row['id']; ?>" autocomplete="off"> P
							  </label>
							  <label class="btn btn-secondary <?php echo $row['mapping']=='S'?'active':''; ?>">
							    <input type="radio" name="mapping~<?php echo $row['id']; ?>" <?php echo $row['mapping']=='S'?'checked':''; ?> value="S" id="optionmapping~<?php echo $row['id']; ?>" autocomplete="off"> S
							  </label>
							  <label class="btn btn-secondary <?php echo $row['mapping']==''?'active':''; ?>">
							    <input type="radio" name="mapping~<?php echo $row['id']; ?>" <?php echo $row['mapping']==''?'checked':''; ?> value="" id="optionmapping~<?php echo $row['id']; ?>" autocomplete="off"> N
							  </label>
							</div>
		  				</td>
		  			<?php endforeach; ?>
		  		</tr>
	  		<?php endforeach; ?>
	  	</tbody>
	  </table>
	  </div>
	  <div style="padding:10px 8px;">
  		<button type="submit" class="btn btn-success">
  			<i class="fa fa-check"></i>
	  		Update Mapping
	  	</button>
  	</div>
  	<?php echo $this->Form->end(); ?>
</div>
