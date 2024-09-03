<div class="container">
        <div class="row account-cover">
            <div class="col-md-3">
                
                <center>
                	<div class="image-upload-prw1" style=" text-align: center;"> 
                        <?php if(empty($employee['photo'])): ?>
                        	<?php
	                        	echo $this->Html->image('labs/avatar.png',array('id'=>'vphoto'));
	                        ?>	
                        <?php else: ?>
                        	<?php
	                        	echo $this->Html->image($employee['photo'],array('id'=>'vphoto'));
	                        ?>
                        <?php endif; ?>
					</div><br>
                    <!--
                    <div class="vuploadphoto"> <input type='file' class="upfbtn" id="imgInp" />                   
                         <button type="button" id="uploadbtnvalue1" class="btn btn-primary btn-sm">Upload Photo</button>
                         <button type="button" id="deletephoto" class="btn btn-outline-danger btn-sm">Remove</button>
                    </div>
                   -->
                </center>              
            </div>             
             <div class="col-md-8">
                        <div class="profile-head">
                           <h5 style="color:#fff;">
                            	<?php echo $employee->full_name; ?>
                           </h5>
                           <div class="profile-wor">
                           		<br>
	                           <p>Department: <a href="javascript:void(0);"><?php echo $employee->department->name; ?></a></p>
	                           
	                           
	                           Department Size: <a href="javascript:void(0);"><?php echo $employee->department_size; ?></a>
	                           
	                        </div>
                           <!--
                           <h6>
                              Business Profile
                           </h6>
                           <p class="proile-rating">Business Performance : <span>8/10</span></p>
                           
                             <?php
                             	echo $this->Html->link('<i class="fa fa-edit"></i> Edit Profile',array(
									'action'=>'editMyProfile'
								),array(
									'class'=>'profile-edit-btn pull-right',
									'escape'=>false
								));
                             ?>
                            -->
                        </div>                     
            </div> 
        </div>
         
          <div class="row account-cover">
            <div class="col-md-3">     
                 <!--
                 <div class="profile-work">
                                            <p>Department</p>
                                            
                                            Name: <a href="javascript:void(0);"><?php echo $employee->EmpDepartments->name; ?></a> 
                                            <br>
                                            Size: <a href="javascript:void(0);"><?php echo $employee->department_size; ?></a>
                                            
                                         </div>-->
                 
            </div>             
             <div class="col-md-8">
                 <div class="row">
                     <div class="col-md-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Company Info</a>
                              </li>
                        </ul>   
                     </div>
                    <div class="col-md-12">
                     
                        <div class="tab-content profile-tab" id="myTabContent">
                           <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                             <div class="row aboutinfo">
                                 <div class="col-md-6">
                                    <label>User Id:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->username; ?></p>
                                 </div>
                           
                             
                                 <div class="col-md-6">
                                    <label>Name:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->full_name; ?></p>
                                 </div>
                             
                             
                                 <div class="col-md-6">
                                    <label>Email:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->email; ?></p>
                                 </div>
                            
                             
                                 <div class="col-md-6">
                                    <label>Company Number:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view">
                                    	<?php echo $employee->company->phone; ?>
                                    	&nbsp;
                                    	Ext. <?php echo $employee->company->extension; ?>
                                    </p>
                                 </div>
                              
                             
                                 <div class="col-md-6">
                                    <label>Position Title:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->position_title; ?></p>
                                 </div>
                              </div>
                           </div>
                            
                            
                           <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="row companyinfo">
                                 <div class="col-md-6">
                                    <label>Company Name:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->company->company_name; ?></p>
                                 </div>
                             
                                 <div class="col-md-6">
                                    <label>Company Email:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->company->email; ?></p>
                                 </div>
                            	<!--
                                 <div class="col-md-6">
                                    <label>Extension:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->company->extension; ?></p>
                                 </div>
                              	-->
                                 <div class="col-md-6">
                                    <label>Company Size:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->company->company_size; ?></p>
                                 </div>
                             
                                 <div class="col-md-6">
                                    <label>Industry:</label>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="user-view"><?php echo $employee->company->industry; ?></p>
                                 </div>
                              </div>
                           </div>
                        </div>                     
                     </div> 
                 </div>   
            </div> 
        </div>
     </div>            
    