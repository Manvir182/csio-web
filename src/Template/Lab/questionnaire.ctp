<div class="main-content white-bg">
   <div class="container-fluid questionborder">
       <div class="row">
           <div class="col-md-12">
                <h5 class="questiontitle page-title-text" style="padding-top:10px;">In-take Questionnaire</h5>
           </div>
       </div>
       <div class="row questionborder1">
       	<style>
       		form p {
       			margin-bottom:0px;
       			margin-top:4px;
       		}
       	</style>
       		<?php echo $this->Form->create($questionnaire,['type'=>'file']); ?>	
           	<?php echo $this->Form->control('quest_name',[
           		'type'=>'hidden','value'=>$questionnaire->name
           	]); ?>
                <div class="col-md-12">
					<div class="cisoclientform"> 
						 							
						<div class="form-row">
                            <div class=" col-md-6">
                                <p>Client Id: 	
	                                <u><b><?php echo $employee->company->company_code; ?></b></u>
                                </p>											
							</div>
			                <div class="col-md-6">
                                <p>Company Name: 
                                	<u><b><?php echo $employee->company->company_name; ?></b></u>
                               	</p>										
			                </div>    
			                <div class="col-md-12"><br></div>                                        
                            <div class=" col-md-6">
                                <p>
                                	Employee Name:
                                	<u><b><?php echo $employee->full_name; ?></b></u>
                                </p>										
							</div>											
                            <div class=" col-md-6">
                                <p>
                                	Company Email:
                                	<u><b><?php echo $employee->company->email; ?></b></u>
                                </p>										
                            </div>  
                            <div class="col-md-12"><br></div>                                          
                            <div class=" col-md-6">
                                <p>
                                	Company Phone:
                                	<u><b><?php echo $employee->company->phone; ?></b></u>
                                </p>										
							</div>
							<div class=" col-md-6">
                                <p>
                                	Extension:
                                	<u><b><?php echo $employee->company->extension; ?></b></u>
                                </p>										
							</div>
			            </div>    								
				    </div>               
                </div>
                <div class="col-md-12">
                    <div class="row cisobpadding">
                    	<?php 
                    		$this->Form->setTemplates([
							    'inputContainer' => '	
							        {{content}} ',
							    'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}} required="true">',
								'radioWrapper' => '<li>	{{label}}</li>',
								
							]);
                    	?>   
                    	<?php foreach($questionnaire->questions as $question): ?>
                    		<div class="col-md-12">
                    			<h6 class="questions"><?php echo $question->name; ?></h6>
                    			<?php $inputType = $question->question_type=='Single Choice'?'radio':'checkbox'; ?>
                    			<ul>
                    				<?php if($inputType=='radio'): ?>
	                    				<?php $radioOptions = array(); ?>
	                                	<?php foreach($question->question_options as $qOption): ?>
	                                		<?php 
	                                			$radioOptions[]=['hiddenField'=>false,'text'=>" ".$qOption->name,'value'=>$qOption->name,];
	                                		?>
	                                	<?php endforeach; ?>	
	                                	<?php 
	                                		echo $this->Form->radio('answer['.$question->id.']',$radioOptions);
	                                	?>
                                	<?php else: ?>
                                		<?php foreach($question->question_options as $qOption): ?>
                                			<li>
		                                		<?php 
			                                		echo $this->Form->control('answer['.$question->id.']['.$qOption->id.']',[
			                                			'value'=>$qOption->name,
			                                			'id'=>'option'.$qOption->id,
			                                			'label'=>array('text'=>" ".$qOption->name,),
			                                			'type'=>'checkbox',
			                                			'hiddenField'=>false
			                                		]);
			                                	?>
		                                	</li>
	                                	<?php endforeach; ?>	
	                                	
                                	<?php endif; ?>
                    			</ul>
                    			
                    		</div>
                    	<?php endforeach; ?>
                        <div class="col-md-12 col-sm-12 "><br><br>
                            <center><button type="button" class="cisobtn cisoblue cisopadding cisoblue-outline  sperator-line"><span class="text-blue-bg">Legal disclaimer</span></button></center>
                        </div>
                        <div class="col-md-12 cisosp">
                            <h6 class="questions">To the best of [user's] knowledge, the contents of the questionnaire and documents to be submitted have
                                not been falsified, and contain accurate and reliable information.</h6>
                            <div class="row">
                                <div class="col-md-6">
                                     <center>
                                         <div class="image-upload-prw" style=" text-align: center;"> 
                                            
                                            <?php 
                                            	//echo $this->Html->image('us.png',array('id'=>'vphoto','style'=>'cursor:pointer;'));
                                            ?>
                                            <!--<button type="button" id="uploadbtnvalue" class="btn btn-primary btn-sm">Upload Photo</button>-->
                                            <span>
                                            <?php 
                                            	/*
                                            	echo $this->Form->control('signature',[
                                            		'type'=>'file',
                                            		'id'=>'signImage',
                                            		'label'=>false,
                                            		//'style'=>'display:none;',
                                            		'class'=>'upfbtn',
                                            		'accept'=>'image/*',
                                            		'required'=>true
                                            	]);
												*/
												echo $this->Form->control('signature',array(
													'type'=>'text','class'=>'form-control text-center',
													'required'=>true,
													'label'=>false,
													'value'=>$thisUser['first_name']." ".$thisUser['last_name'],
													'style'=>'height:100%;border:none;'
												));
                                            ?>	
                                           </span>
                                         </div>
                                         <!--<span>[First Name - Last Name]</span>-->
                                     </center>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                         <div class="currentdate"><?php echo date('d M, Y') ?></div>
                                         <span>[Day/Month/Year]</span>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12"><br><br>
                            <h6 class="questions">“The submission of this signature consistutes the user’s agreement to the terms and conditions of this assessment 
                                as well as the confirmation that the information provided is accurate to the best of the signing user’s knowledge.”
                            </h6>
                       </div>
                        <div class="col-md-3 col-sm-12 "><br><br>
                           <center><button type="submit" class="cisobtn cisoblue cisopadding cisoblue-outline submit-form-btn">Submit</button></center>
                        </div>
                    </div>
                </div>
           
           <?php echo $this->Form->end(); ?>
       </div>      
   </div>
    <!-- content wrapper -->
  </div>