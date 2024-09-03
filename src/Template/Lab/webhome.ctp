<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
         <div class="text-logo brand-text text-center">
          <h4 class="brand-title">THE CLOUD CISO</h4>
          <p class="tag-line">CYBER RISK ASSESSMENT</p>
        </div>
        </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="menu">Menu</span>
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#home">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
              <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#register">Services</a>
          </li>
          </li>
              <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#registerme">Register</a>
          </li>

          <!--
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#faq">FAQ</a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contactus">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="clearfix"></div>
  <!-- Header -->
  <header class="masthead" id="home">
    <div class="containe masterhead">
        <div class="row cisomt50">
            <div class="col-md-12">
            <p>At the end of the day, the goals are simple:</p>
             <h1>Safety<span class="hide-sm"> </span>and<span class="hide-sm"> </span>Security</h1>
            </div>
        </div>

    </div>
  </header>

  <!-- Services -->
  <section id="about">
      <div class="container">
           <h3 class="maintitle">
                About THE CLOUD CISO
           </h3>

            <p class="mainsubtitle">
				 Our goal at THE CLOUD CISO is to prevent you from becoming a statistic, alike to the billions of individuals and millions of companies affected by cyber attacks every year. Data security in this day and age has become paramount in ensuring the continued success and growth of businesses around the world, including yours.
            </p>
            <p class="mainsubtitle">
				 The threat of a data breach is all too real for millions of companies, and yet many still remain unprepared for the tumultuous cyber terrain that lies before them. As the problem of cyber attacks continues to evolve and become more sophisticated, the harder it is to prevent. A business's best tool is preparation; an absolute necessity in being readily equipped for the day when a cyber attack comes knocking at your company's door.
            </p>


      </div>

  </section>

      <!-- Services -->
  <section id="register">
  	  <div class="container register">
          <div class="row ">
              <div class="col-md-12 tcenter">
                    <h3 >Services</h3>
                    <br>
              </div>
          </div>
          <div class="row text-center">
	          <div class="col-md-12 ">
	          	<div class="card">
	          		<div class="card-block">
	          			<big><b>Risk Assessment</b></big>
	          			<p>
	          				Our proprietary risk assessment program allows clients to analyze their cybersecurity readiness, as it pertains to both industry standards, as well as global cybersecurity innovation.
	          			</p>
	          		</div>

	          	</div>
	          </div>
	          <div class="col-md-12 ">
	          	<div class="card">
	          		<div class="card-block">
	          			<big><b>Regulatory Compliance</b></big>
	          			<p>
		          			THE CLOUD CISO provides you with the ability to become compliant in a wide variety of regulatory bodies, both domestic and international. Regulatory compliance tracking is also available for real time assessment of your compliance.
		          		</p>
	          		</div>

	          	</div>
	          </div>
	          <div class="col-md-12 ">
	          	<div class="card">
	          		<div class="card-block">
	          			<big><b>Incident Preparation &amp; Response</b></big>
	          			<p>
		          			Our incident response &amp; preparation program runs parallel to our cyber risk assessment program. Through intelligently targeted preparation interwoven with exhaustive remediation management encompassing every facet of business information systems, THE CLOUD CISO brings extraordinary innovation to an otherwise static cyber preparation environment.
		          		</p>
	          		</div>

	          	</div>
	          </div>
          </div>
      </div>
  	<!--
      <div class="container register">
          <div class="row ">
              <div class="col-md-12 tcenter">
                    <h3 >Register with us</h3>
                 <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>
              </div>
          </div>
          <div class="row">      <div class="col-md-4 "> </div>
           <div class="col-md-4 ">
                  <div class="cisobtn cisored cisoblue-border cisored-outline">
                               <a href="register-new.html" class="register-form-link"> Register now</a></div>
              </div>
          </div>
      </div>
     -->

  </section>
    <!-- Services -->

 <section id="registerme">
 	<div class="container register" style="background:none;">
          <div class="row ">
              <div class="col-md-12 tcenter">
                 <h3 >Register with us</h3>
                 <p>
                 	It is a long established fact that a reader will be distracted by the readable
                 	content of a page when looking at its layout. The point of using Lorem Ipsum.
                 </p>
              </div>
          </div>
          <div class="row">
          <div class="col-md-4 "> </div>
           <div class="col-md-4 ">
                  <div class="cisobtn cisored cisoblue-border cisored-outline">
                      <?php
                      	echo $this->Html->link('Register Now',array(
							'controller'=>'companies',
							'action'=>'register'
						),array(
							'class'=>'register-form-link'
						));
                      ?>
                  </div>
              </div>
          </div>
      </div>
 </section>

    <!--
  <section id="faq">

       <div class="container cisomt-50">
           <div class="row">
             <div class="col-md-12">
               <h3 class="maintitle">Frequently Asked Questions</h3>
                 <p class="mainsubtitle">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p><br>
               </div>
               <div class="col-md-12 cisofaq">
					<div id="accordion">

                          <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse1">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse1" class="collapse show" data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>


                          <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse2">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse2" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>


                          <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse3">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse3" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>
                        <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse4">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse4" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>
                        <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse5">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse5" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>

                         <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse6">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse6" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>

                         <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse7">
                                Select level of Cybersecurity Maturity
                              </a>
                            </div>
                            <div id="collapse7" class="collapse " data-parent="#accordion">
                              <div class="card-body">
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters
                              </div>
                            </div>
                          </div>

                        </div>
				</div>

           </div>
      </div>
  </section>
	-->

  <!-- contact us -->
  <section class="contact-us" id="contactus">
      <div class="container">
        <div class="row">
          <h3 class="maintitle w-100 text-dark" style="text-shadow:none;"> Contact Us </h3>
          <div class="col-sm-12" id="parent">
            <div class="row">
             <!--
              <div class="col-sm-6">
              <iframe width="100%" height="370px;" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJaY32Qm3KWTkRuOnKfoIVZws&key=AIzaSyAf64FepFyUGZd3WFWhZzisswVx2K37RFY" allowfullscreen></iframe>
              </div>
              -->
			  <div class="col-sm-3"></div>
              <div class="col-sm-6">

          		<?php echo $this->Form->create('ContactUs',['class'=>'contact-form']); ?>
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="nm" placeholder="Name" required="">
                    </div>


                    <div class="form-group form_left">
                      <input type="text" class="form-control" id="email" name="em" placeholder="Email" required="">
                    </div>

                    <div class="form-group">
                         <input type="text" class="form-control" id="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Mobile No." required="">
                    </div>
                    <div class="form-group">
                    <textarea class="form-control textarea-contact" rows="5" id="comment" name="FB" placeholder="Type Your Message/Feedback here..." required=""></textarea>
                    <br>
                      <div style="text-align:center;">
                      	<button type="submit" class="btn cisobtn cisored cisoblue-border cisored-outline send-btn"> <i class="fas fa-paper-plane glyphicon glyphicon-send"></i> Send Request</button>
                      </div>
                    </div>
                  <?php echo $this->Form->end(); ?>
                </div>
              </div>
            </div>
          </div>

        <div class="container second-portion">
        <div class="row">
              <!-- Boxes de Acoes -->
            <div class="col-xs-12 col-sm-3 col-lg-2"></div>
            <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
              <div class="icon">
                <div class="image"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="info">
                  <h3 class="title">MAIL &amp; WEBSITE</h3>
                  <p>
                    <i class="fa fa-envelope" aria-hidden="true"></i> &nbsp; <a class="alink" href="mailto:info@thecloudciso.com">info@thecloudciso.com</a>
                    <br>
                    <br>
                    <i class="fa fa-globe" aria-hidden="true"></i> &nbsp; www.thecloudciso.com
                  </p>

                </div>
              </div>
              <div class="space"></div>
            </div>
          </div>

              <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
              <div class="icon">
                <div class="image"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                <div class="info">
                  <h3 class="title">CONTACT</h3>
                    <p>
                    <i class="fa fa-mobile" aria-hidden="true"></i> &nbsp; <a class="alink" href="tel:+1 347-721-8166">+1 347-721-8166</a>
                    <br>

                  </p>
                </div>
              </div>
              <div class="space"></div>
            </div>
          </div>

           <!--   <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
              <div class="icon">
                <div class="image"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <div class="info">
                  <h3 class="title">ADDRESS</h3>
                    <p>
                     <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp 15/3 Demo Address Content - 360001.
                  </p>
                </div>
              </div>
              <div class="space"></div>
            </div>
          </div>
          -->
          <!-- /Boxes de Acoes -->

          <!--My Portfolio  dont Copy this -->

        </div>
      </div>

      </div>
  </section>