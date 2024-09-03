<div class="main-content white-bg">
       <div class="container-fluid questionborder">
           <div class="row">
               <div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">CMMC Assessment Submission Form</h5>
               </div>
           </div>
           <div class="row questionborder1 ">
           	   <?php echo $this->Form->create('Assessment',['class'=>'w-100 assessmentForm','type'=>'file','autocomplete'=>'off']); ?>
           	   <?php
           	   		//echo $this->Form->control('client_id',['value'=>'1','type'=>'hidden']);
           	   ?>
               		<?php
		        		$this->Form->setTemplates([
						    'inputContainer' => '
						        {{content}} ',
						    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
							'radioWrapper' => '<li>{{label}}<li>'
						]);
		        	?>
                    <div class="col-md-12">
                        <div class="row cisobpadding tool-form-submission">
                        	<div class="col-md-12">
                        		<div class="row">
                        			<div class="col-sm-3">
                        				<h6 class="questions" style="padding-top:5px;">Assessment Submission Name</h6>
                        			</div>
                        			<div class="col-sm-6">
                        				<?php
		                                	echo $this->Form->control('name',array(
		                                		'class'=>'form-control input-sm',
		                                		'label'=>false,
		                                		'style'=>'width:100%;',
		                                		'required'=>true
		                                	));
		                                ?>
                        			</div>
                        		</div>
                                <br>

                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<h6 class="questions">
                            		Assessment Classification
                            		<i class="fa fa-info-circle text-info" style="margin-top:10px;" data-toggle="popover"
                            			data-trigger="hover"
										data-content="<b>Self Assessment </b>: This type of assessment is conducted by your team/company to assess your risk internally.<br><br><b>Independent</b>: This type of assessment is an objective assessment conducted by an independent third party/THE CLOUD CISO to assess risks. Selecting this option delegates the assessment to the independent third party/THE CLOUD CISO for conducting the assessment."
										data-placement='right'
										data-html='true'
										title=""
										data-original-title="Select a classification"
                            		></i>
                            	</h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-md-3 col-xs-12">
                            	<?php
                            		echo $this->Form->control('atype',[
                            			'label'=>false,
                            			'class'=>'form-control input-sm atype',
                            			'type'=>'select',
                            			'options'=>array(''=>'-- Select --','Self'=>'Self Assessment','Independent'=>'Independent Assessment'),
                            			'required'=>true
                            		]);
                            	?>
                            </div>
                            <div class="col-12" style="padding:6px;"></div>
                            <div class="assessmentInputs col-12" style="padding:35px;">
                            	<div class="row">
									<div class="col-12">
										<h4 class="text-dark">CMMC Domains</h4>

										<div class="accordion" id="caccordionExample">
										<?php foreach($cdomains as $cdomain): ?>
										  <div class="card">
										    <div class="card-header bg-dark" id="cdomainHeading<?php echo $cdomain['id']; ?>">
										      <h2 class="mb-0">
										        <button class="btn btn-link btn-block text-left text-white" type="button" data-toggle="collapse" data-target="#cdomain<?php echo $cdomain['id']; ?>" aria-expanded="true" aria-controls="cdomain<?php echo $cdomain['id']; ?>">
										          <?php echo $cdomain['name']; ?>
										        </button>
										      </h2>
										    </div>

										    <div id="cdomain<?php echo $cdomain['id']; ?>" class="collapse" aria-labelledby="cdomainHeading<?php echo $cdomain['id']; ?>" data-parent="#caccordionExample">
										      <div class="card-body">

										      	<div class="accordion" id="cdaccordionExample<?php echo $cdomain['id']; ?>">
										      	  <?php foreach($cdomain['levels'] as $level=>$levelData): ?>
										      	  	<?php $lname = str_replace(' ','',$level); ?>
													  <div class="card">
													    <div class="card-header">
													      <h2 class="mb-0">
													        <button class="btn btn-link btn-block text-dark text-left" type="button" data-toggle="collapse" data-target="#cdomain<?php echo $cdomain['id']; ?>level<?php echo $lname; ?>" >
													          <?php echo $level; ?>
													        </button>
													      </h2>
													    </div>

													    <div id="cdomain<?php echo $cdomain['id']; ?>level<?php echo $lname; ?>" class="collapse"  data-parent="#cdaccordionExample<?php echo $cdomain['id']; ?>">
													      <div class="card-body">
													      	<h4>Practices</h4>
													      	<ul>
													      		<?php foreach($levelData as $ldata): ?>
													      			<li>
													      				<?php echo $ldata->code; ?> &mdash; <?php echo $ldata->name; ?>
													      			</li>
													      		<?php endforeach; ?>
													      	</ul>
													      </div>
													    </div>
													  </div>
												  <?php endforeach; ?>

												</div>

										      </div>
										    </div>
										  </div>
										<?php endforeach; ?>

										</div>
									</div>
								</div>

                            </div>


                            <div class="col-md-12 cisosp">

                                <div class="row">
                                    <div class="col-md-3">

                                             <div class="image-upload-prw" style=" text-align: center;width:100%;">
                                                <?php
                                                	echo $this->Form->control('signature',array(
														'type'=>'text','class'=>'form-control text-center',
														'required'=>true,
														'label'=>false,
														'value'=>$thisUser['first_name']." ".$thisUser['last_name'],
														'style'=>'height:100%;border:none;',
														'readonly'=>true
													));

                                                ?>

                                             </div>

                                    </div>
                                    <div class="col-md-2">
                                        <center>
                                             <div class="currentdate">
                                             	<?php echo date('M d, Y',time()); ?>
                                             </div>
                                        </center>
                                    </div>
                                    <div class="col-md-7 text-right">
		                               <button type="submit" class="cisobtn cisoblue  cisoblue-outline submit-form-btn" style="padding:5px 10px;">Start</button>
		                            </div>
                                </div>
                            </div>


                        </div>
                    </div>

               <?php echo $this->Form->end(); ?>
           </div>
       </div>
        <!-- content wrapper -->
  </div>




<script>

   	$(function(){
   		$('[data-toggle="popover"]').popover();
   	});
</script>
