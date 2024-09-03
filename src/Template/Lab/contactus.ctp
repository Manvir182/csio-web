<div class="container ">


         <div class="row contactcover questionborder">
               <div class="col-md-8 col-sm-12">
    							<div class="contact-form-box">
                                    <center><h5>Get in Touch</h5></center>

    									<?php echo $this->Form->create('contactus',array('class'=>'contact-form')); ?>
										<div class="form-row">
											<div class="form-group col-md-6">
												<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
											</div>
											<div class="form-group col-md-6">
												<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<input type="email" class="form-control" name="email" id="senderemail" placeholder="Email">
											</div>
											<div class="form-group col-md-6">
												<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-12">
												<textarea class="form-control" id="inputAddress" name="remarks" placeholder="Message"></textarea>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-12">
												<button type="submit" class="btn btn-warning send-reuqest-btn">Send Request</button>
											</div>
										</div>
										<?php $this->Form->unLock('firstname'); ?>
										<?php $this->Form->unLock('lastname'); ?>
										<?php $this->Form->unLock('email'); ?>
										<?php $this->Form->unLock('subject'); ?>
										<?php $this->Form->unLock('remarks'); ?>
									<?php echo $this->Form->end(); ?>
    							</div>
    						</div>

             <div class="col-md-4 col-sm-12">
                         <div class="row contactcover">

                        <div class="col-md-12">
                                <!--
                                <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                                                                    <p>  123 demo Address, Uk </p>
                                                                </div>
                                -->

                       <!-- <div class="col-md-12">
                                <div class="icon"><i class="far fa-envelope"></i> </div>
                                    <p> <a class="=" href="mailto:info@thecloudciso.com">info@thecloudciso.com</a> </p>
                                </div>

                       <div class="col-md-12">
                            <div class="icon"><i class="fas fa-mobile-alt"></i></div>
                            <p>  <a class="alink" href="tel:+1 347-721-8166">+1 202-455-5121</a> </p>
                        </div> -->
                    </div>
             </div>


        </div>
    </div>
