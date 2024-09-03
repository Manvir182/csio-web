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
            <!--
            <li class="breadcrumb-item">
            	<?php 
            		echo $this->Html->link('FFIEC Control Domains',array(
						'controller'=>'FfiecDomains','action'=>'index'
					));
            	?>
            </li>
            -->
            <li class="breadcrumb-item active">FFIEC Risk Control Mappings</li>
        </ol>
    </div>    
    <div class="col-4 text-right">
    	<?php 
    		//echo $this->Html->link('<i class="fa fa-plus"></i> Add New',['action'=>'add'],['class'=>'btn btn-info','escape'=>false,'style'=>'margin-right:4px;']);
			//echo $this->Html->link(('<i class="fa fa-pencil"></i> Edit This'), ['action' => 'edit', $genControl->id],['class'=>'btn btn-inverse','escape'=>false,'style'=>'margin-right:4px;']);
    		//echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-warning','escape'=>false]);
    	?>
    </div>               
</div>
<div class="">
    <div class="crd">
    	
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
			  			<!--<th  class="bg-light-info"></th>-->
			  			<th class="bg-warning text-white"></th>
			  			<th  class="bg-inverse" colspan="<?php echo count($risks); ?>">FFIEC Risks &rarr;</th>
			  		</tr>
			  		<tr>
			  			<!--<th class="bg-light-info">No.</th>-->
			  			<th class="bg-warning text-white"> FFIEC Domains &darr;</th>
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th  class="bg-inverse"><?php echo $risk; ?></th>	
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<!--<td><?php echo $i++; ?></td>-->
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
			  		Submit Now
			  	</button>
		  	</div>
	  	<?php echo $this->Form->end(); ?>
		
	</div>
	
</div>
