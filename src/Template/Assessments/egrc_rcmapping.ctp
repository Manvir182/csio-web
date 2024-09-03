<div class="row page-titles">
    <div class="col-md-12 col-12">
        <ol class="breadcrumb">
        	<?php if($thisUser['role']=='Employee'): ?>
        		<li class="breadcrumb-item">
	            	<?php 
	            		echo $this->Html->link('Dashboard',array(
							'controller'=>'lab','action'=>'dashboard'
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item">
	            	<?php 
	            		echo $this->Html->link('Tracking',array(
							'controller'=>'Assessments','action'=>'tracking'
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item">
	            	<?php 
	            		if($assessment->sub_type=='Regulated'){
	            			echo $this->Html->link('View Assessments Details',array(
								'controller'=>'Assessments','action'=>'view',$assessment->id,$assessment->sub_type
							));
	            		} else {
	            			echo $this->Html->link('View Assessments Details',array(
								'controller'=>'Assessments','action'=>'view',$assessment->id,$assessment->sub_type
							));	
	            		}
	            		
						//echo $aControl;
	            	?>
	            	
	            </li>
	            <li class="breadcrumb-item active">Update Risk - Control Mapping</li>
        	<?php else: ?>
	            <li class="breadcrumb-item">
	            	<?php 
	            		echo $this->Html->link('Dashboard',array(
							'controller'=>'users','action'=>'dashboard'
						));
	            	?>
	            </li>
	            <?php if($thisUser['role']=='Company'): ?>
	            	<li class="breadcrumb-item">
		            	<?php 
		            		echo $this->Html->link('Assessments',array(
								'controller'=>'Assessments','action'=>'selfAssessments'
							));
		            	?>
		            </li>
	            <?php else: ?>
	            	<li class="breadcrumb-item">
		            	<?php 
		            		echo $this->Html->link('Assessments',array(
								'controller'=>'Assessments','action'=>'listAssessments'
							));
		            	?>
		            </li>
	            <?php endif; ?>
	            <li class="breadcrumb-item">
	            	<?php 
	            		echo $this->Html->link('View Assessment Details',array(
							'controller'=>'Assessments','action'=>'view',$assessment->id,$assessment->sub_type
						));
	            	?>
	            </li>
	            <li class="breadcrumb-item active">Update Risk - Control Mapping</li>
	        <?php endif; ?>
        </ol>
    </div> 
                    
</div>


<div class="">
	<table class="table table-bordered bg-white">
		<tr>
			<td>
				<h5 class="text-themecolor">Assessment Submission Name</h5>
				<br>
				<?php echo $assessment->name; ?>
			</td>
			<td>
				<h5 class="text-themecolor">Assessment Type</h5>
				<br>
				<?php echo $assessment->sub_type; ?> (<?php echo $assessment->atype; ?>)
				
			</td>
			<?php if(!empty($rbody)): ?>
				<td>
					<h5 class="text-themecolor">Regulatory Body</h5>
					<br>
					<?php //echo $rbody->regulatory_body->name; ?>
					<?php 
						if($thisUser['role']=='Employee'){
							echo $rbody->regulatory_body->name;
						} else {
							echo $this->Html->link($rbody->regulatory_body->name,[
								'controller'=>'RegulatoryBodies','action'=>'view',$rbody->regulatory_body->id
							],[
								'class'=>'link',
								'escape'=>false,
								'target'=>'_blank'
							]);
						}
					?>	
				</td>
				
			<?php endif; ?>
			<td>
				<h5 class="text-themecolor">Submission Date</h5>
				<br>
				<?php echo date('d-M-y h:i a',strtotime($assessment->created)); ?> 
			</td>
			
			<td>
				<h5 class="text-themecolor">Submitted By</h5>
				<br>
				<?php echo $assessment->user->first_name." ".$assessment->user->last_name; ?>
			</td>
			
		</tr>
	</table>
	<p class="bg-info p-2 text-white text-center">
		 <b>P indicates primary control 
			reliance and S indicates secondary reliance.</b> 
			Each risk must have at least one primary control.
	</p>
	<div class="card">
    	
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
	    	  <table class="table table-bordered table-hover myTable" style="font-size:14px;">

			  	<thead>
			  		<tr>
			  			<!--<th  class="bg-light-info"></th>-->
			  			<th class="bg-warning text-white"></th>
			  			<th  class="bg-info text-white" colspan="<?php echo count($risks); ?>">Risks &rarr;</th>
			  		</tr>
			  		<tr>
			  			<!--<th class="bg-light-info">No.</th>-->
			  			<th class="bg-warning text-white"> Control Domains &darr;</th>
			  			<?php foreach($risks as $k=>$risk): ?>
			  				<th  class="bg-info text-white"><?php echo $risk; ?></th>	
			  			<?php endforeach; ?>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
				  		<tr>
				  			<!--<td><?php echo $i++; ?></td>-->
				  			<td><?php echo $risk_id; ?></td>
				  			<?php foreach($rows as $row): ?>
				  				<td align="center">
				  					<div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
				  					  <?php if($row['status']=='Pending'): ?>
					  					  <label class="btn btn-secondary <?php echo $row['mapping']=='P'?'active':''; ?>">
										    <input type="radio" name="mapping~<?php echo $row['id']; ?>" <?php echo $row['mapping']=='P'?'checked':''; ?> value="P" id="optionmapping~<?php echo $row['id']; ?>" autocomplete="off">P
										  </label>
										  <label class="btn btn-secondary <?php echo $row['mapping']=='S'?'active':''; ?>">
										    <input type="radio" name="mapping~<?php echo $row['id']; ?>" <?php echo $row['mapping']=='S'?'checked':''; ?> value="S" id="optionmapping~<?php echo $row['id']; ?>" autocomplete="off">S
										  </label>
										  
										  <label class="btn btn-secondary <?php echo $row['mapping']==''?'active':''; ?>">
										    <input type="radio" name="mapping~<?php echo $row['id']; ?>" <?php echo $row['mapping']==''?'checked':''; ?> value="" id="optionmapping~<?php echo $row['id']; ?>" autocomplete="off">N
										  </label>
										  
									  <?php elseif($row['mapping']!=""): ?>
									  	<label class="btn btn-secondary active">
									    	<?php echo $row['mapping']; ?>
									  	</label>
									  <?php endif; ?>
									</div>
				  				</td>
				  			<?php endforeach; ?>
				  		</tr>
			  		<?php endforeach; ?>
			  	</tbody>
			  </table>
			</div>
			<?php if($assessment->status!='Completed'): ?>
			  	<div style="padding:10px 8px;">
			  		<button type="submit" class="btn btn-success">
			  			<i class="fa fa-check"></i>
				  		Submit Now
				  	</button>
			  	</div>
		  	<?php endif; ?>	
	  	<?php echo $this->Form->end(); ?>
		
	</div>
	
    <div class="card card-block">
        
	</div>
	
    <div class="p-20"></div>
</div>
