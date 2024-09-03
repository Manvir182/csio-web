<style>
	.error textarea {
	    border: 1px solid #f62d51;
	}
</style>
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
			//echo $this->Html->link('<i class="fa fa-pencil"></i> Edit This',['action'=>'edit',$regulatoryBody->id],['class'=>'btn btn-warning','escape'=>false,'style'=>'margin-right:6px;']);
			echo $this->Html->link('<i class="fa fa-list-alt"></i> View All',['action'=>'index'],['class'=>'btn btn-success','escape'=>false]);
			
    	?>
    </div>                    
</div>
<div>
	<h2>
    	<?= h($regulatoryBody->name) ?>
    	<?php 
    		echo $this->Form->postLink('<i class="fa fa-copy"></i> Make Duplicate',['action'=>'makeDuplicate',$regulatoryBody->id],['class'=>'btn btn-danger btn-sm float-right pull-right','escape'=>false,'confirm' => 'Are you sure?']);
		?>
    	<?php 
    		echo $this->Html->link('<i class="fa fa-pencil"></i>',['action'=>'edit',$regulatoryBody->id],['class'=>'btn btn-outline-info btn-sm','escape'=>false,'style'=>'margin-left:6px;','data-toggle'=>'tooltip','title'=>'Edit Regulatory Body']);
		?>
    	<br>
    	<small>
    		<span class="p-10 bg-light">
	    		[<u>Activity</u>: <?= $regulatoryBody->activity->name ?>]
	    	</span>
    	</small>
    </h2>
    <br>
	<h4>Risk Control Mappings</h4>
	<?php if(!empty($table)): ?>
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
		<div style='overflow-y: scroll;'>
    	  <table class="table table-bordered table-hover myTable" style="font-size:14px;margin-bottom:0px;">

		  	<thead>
		  		<tr>
		  			<!--<th  class="bg-light-info"></th>-->
		  			<th class="bg-warning text-white"></th>
		  			<th  class="bg-inverse" colspan="<?php echo count($risks); ?>">Risks &rarr;</th>
		  		</tr>
		  		<tr>
		  			<!--<th class="bg-light-info">No.</th>-->
		  			<th class="bg-warning text-white" style="width:10%;"> Control Areas &darr;</th>
		  			<?php $CellWidth=round(90/count($risks),5); ?>
		  			<?php foreach($risks as $k=>$risk): ?>
		  				<th  class="bg-inverse" style="width:<?php echo $CellWidth; ?>%;"><?php echo $risk; ?></th>	
		  			<?php endforeach; ?>
		  		</tr>
		  	</thead>
	  	  </table>
	  	</div>
		<div style="max-height:550px;overflow-y: scroll;">
			<table class="table table-bordered table-hover myTable" style="font-size:14px;margin-bottom:0px;">
				<tbody>
		  		<?php $i=1; foreach($table as $risk_id=>$rows): ?>
			  		<tr>
			  			<td style="width:10%;"><?php echo $risk_id; ?></td>
				  			<?php foreach($rows as $row): ?>
				  				<td align="center" style="width:<?php echo $CellWidth; ?>%;">
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
	<hr>
	<!--
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
	 -->
	  </div>
	  <div style="padding:10px 8px;">
  		<button type="submit" class="btn btn-success">
  			<i class="fa fa-check"></i>
	  		Update Mapping
	  	</button>
  	</div>
  	<?php echo $this->Form->end(); ?>
  	<?php else: ?>
  		<div class="alert alert-warning text-center">
  			Kindly Update Control Areas to get Mapping Table.
  		</div>
  	<?php endif; ?>
</div>
<br>
<div class="regulatoryBodies view large-9 medium-8 columns content">
   
    <div class="related">
    	<h4>
    		<span class="pull-right float-right m-r-10 mr-2">Control Area Number</span>
    		Control Areas
    	</h4>
    	<div class="accordion" id="controlAccordion">
    	  <?php foreach ($regulatoryBody->rb_controls as $rbControls): ?>
			  <div class="card" style="margin-bottom:6px !important;" id="rbControl<?php echo $rbControls->id; ?>">
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
			        <span class="float-right pull-right">
			        	<button class="btn btn-sm btn-info controlAreaBtn" type="button" data-rbid="<?php echo $regulatoryBody->id; ?>" data-id="<?php echo $rbControls->id; ?>">
			        		<i class="fa fa-pencil"></i>
			        		Edit
			        	</button>
			        	<?php 
			        		echo $this->Form->postLink('<i class="fa fa-trash"></i> Delete',[
			        			'controller'=>'RegulatoryBodies','action'=>'deleteRegulatoryControl',$rbControls->id
			        		],[
			        			'escape'=>false,
			        			'class'=>'btn btn-sm btn-danger',
			        			'confirm'=>"Are you sure to delete ?",
			        			
			        		]);
			        	?>
			        </span>
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
		<button class="btn btn-info controlAreaBtn" data-rbid="<?php echo $regulatoryBody->id; ?>" type="button">
    		<i class="fa fa-plus"></i>
    		New Control Area
    	</button>
    </div>
</div>




<!--Control Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="controlModal">
  <div class="modal-dialog modal-lg modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      
    </div>
  </div>
</div>
<!-- Control Modal Ends-->


<script>
	var rproto = "<?php echo $uProto; ?>";
	var saving='<span class="bg-info badge"><i class="fa fa-spinner fa-spin"></i><span class="blinking">Saving</span></span>';
	var saved='<span class="bg-success badge"><i class="fa fa-check"></i><span>Saved</span></span>';
	var notSaved='<span class="bg-danger badge"><i class="fa fa-check"></i><span>Not Saved</span></span>';
	var modalLoading='<span class="bg-info badge"><i class="fa fa-spinner fa-spin"></i><span class="blinking">Loading...</span></span>';
	$(function(){
		
		
		
		var thisUrl = "<?php echo $this->Url->build(array('controller'=>'RegulatoryBodies','action'=>'getControlForm'),true); ?>";
			thisUrl = thisUrl.replace("http:", rproto);
		
		
		
		$(document).on('click','.controlAreaBtn',function(e){
			var myModal = $('#controlModal');
			var controlId = $(this).data('id');
			var rbId = $(this).data('rbid');
			//console.log(rbId);
			if(controlId==undefined){
				myModal.find('.modal-title').html("Add New Control Area");
			} else {
				myModal.find('.modal-title').html("Edit Control Area");
				thisUrl=thisUrl+"/"+controlId;
			}
			myModal.find('.modal-body').html(modalLoading);
			myModal.find('.modal-body').load(thisUrl,function(response,status,xhr){
				myModal.find('.modal-body').find('.cRbId').val(rbId);
				cAreaReq=$(".cRequirement1").html();
				$(".cRequirement1").remove();
				var e = $(".controlAreas").find(".cArea"), n = 0;
				e.each(function() {
					$(this).find(".rcr").each(function() {
						ename = "RbControlRequirements[" + n + "][name][]";
						$(this).prop("name", ename);
						
					});
					$(this).find(".rcrn").each(function() {
						ename = "RbControlRequirements[" + n + "][req_number][]";
						$(this).prop("name", ename);
					});
					$(this).find(".rcrid").each(function() {
						ename = "RbControlRequirements[" + n + "][id][]";
						$(this).prop("name", ename), console.log(ename);
					});
					n++;
				});
			});
			
			myModal.modal({
				backdrop: 'static',
    			keyboard: false
			});
			
		});
		
		<?php if(!empty($status)): ?>
			$("html, body").animate({ scrollTop: $("#rbControl<?php echo $status; ?>").offset().top }, 2500);
		<?php endif; ?>
		
		
		
	});
</script>

