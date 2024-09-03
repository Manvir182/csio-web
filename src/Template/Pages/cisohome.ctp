<!-- Navigation -->
<style>
	.dropdown:hover>.dropdown-menu {
  display: block;
}
.arrow_btn {
    background: transparent;
    padding: 28px 24px;
    position: relative;
    border-radius: 100px;
    border: 2px solid #ffffff4d;
}
</style>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
	<div class="topnavv">
	 <a class="navbar-brand js-scroll-trigger" href="#page-top">
         <div class="text-logo brand-text text-center">
          <!--h4 class="brand-title">THE CLOUD CISO</h4>
          <p class="tag-line">
          		RISK & ADVISORY
          </p-->
		  <img src="../../img/web/logo.png">
        </div>
        </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="menu">Menu</span>
        <i class="fas fa-bars"></i>
      </button></div>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#home"><i class="fa fa-home"></i></a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#register">Services</a>
          </li>
          <!--
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Services</a>
            <div class="dropdown-menu">
              <a class="dropdown-item js-scroll-trigger" href="#register">Services</a>
		      <a class="dropdown-item" href="#">Capabilities</a>
		    </div>
          </li>
          -->
          <!-- <li class="nav-item">
            <?php
	          	echo $this->Html->link('Government',array(
					'controller'=>'pages',
					'action'=>'capabilities'
				),array(
					'class'=>'nav-link'
				));
	        ?>
          </li> -->
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#features">Features</a>
          </li>


          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contactus">Contact</a>
          </li>
          </li>
          	<li class="nav-item">

	            <?php
		          	echo $this->Html->link('IRCW',array(
						'controller'=>'pages',
						'action'=>'ircw'
					),array(
						'class'=>'nav-link'
					));
		        ?>
	          </li>
			<!-- <li class="nav-item">
			  <?php /*
		          	echo $this->Html->link('Blog',array(
						'controller'=>'articles',
						'action'=>'blog'
					),array(
						'class'=>'nav-link'
					)); */
		        ?>
				<a href="//blog.thecloudciso.com" class="nav-link">Blog</a>
			</li> -->
			<li class="nav-item">

				<?php
					echo $this->Html->link('Register',array(
						'controller'=>'companies',
						'action'=>'register'
					),array(
						'class'=>'nav-link'
					));
				?>
			</li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
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
	            <h1>THINK RISKS DIFFERENTLY</h1>
	            <p>
	            	Introducing THE CLOUD CISO Integrated Risk Controls Assessment (iRCA)
	            </p>
	            <p>+ THE CLOUD CISO Enhanced Governance, Risk and Controls (eGRC)</p>
	            <p>
	            	+ Integrated Regulations and Compliance Wizard (iRCW)
	            </p>
	            <p>
	            	+ Cybersecurity Maturity Model Certification (CMMC) readiness
	            </p>
            </div>
        </div>
		
		<center>
			<a class="js-scroll-trigger text-white arrow_btn" href="#about">
				<img src="../../img/web/arrow.png">
			</a>
		</center>
    </div>
  </header>

  <!-- Services -->
  <!-- <section class="register" id="about_old">
      <div class="container text-center">
				 <h2 class="mb-3">
					Principal Consultant
				</h2>
				<?php
                    echo $this->Html->image('web/a.png',array('class'=>'dellphoto'));
                ?>
				<p>
					Mr. Alfred is an accomplished leader in operational risk management, with
					exceptional achievement in delivering solutions and project deliverables to
					meet business needs and exceed objectives and has served in various
					virtual C-suite roles over the past 7 years.
				</p>
				<p>
					Mr. Alfred is generally knowledgeable in all areas of Risk Management &
					Operations including risk controls implementations and remediation, and
					strategic enterprise-wide risk program development and implementation.
					Mr. Alfred is equipped with decades of working experience in Banking and
					Finance, Retail, Intergovernmental and consulting companies with an
					extensive track record in enterprise risk management ensuring compliance
					and regulatory risk management of GDPR, EU Data Privacy, SOX and many
					other regulations. Companies include Allergan Pharmaceuticals, Chico’s
					White House Black Market, L’OREAL, BNP Paribas, Bank of New York
					Melon, USAA, the International Monetary Fund (IMF) and Fannie Mae,
					where Mr. Alfred trained exclusively in enterprise risk management under
					Dr. Zhiwei Fu, an expert developer of CObIT 4.1 for ISACA. Mr. Alfred was
					responsible for US Treasury (Fed Wire Systems) risk management,
					including supporting the development of the suite of controls for US
					HAMP program leveraging CObIT/COSO controls and maturity attributes.
				</p>
				<p>
					With this experience Mr. Alfred has led various initiatives including
					developing scalable SaaS Enterprise GRC and risk/control maturity
					solutions for a variety of regulations such as FFIEC compliance, SOX
					Compliance, CMMC, PCI DSS, GDPR and many others.
				</p>
				<p>
					Further, Mr. Alfred has global regulatory risk management expertise and
					consent order remediation activities for BNP Paribas banking and finance
					regulatory coverage, Grupo Cisneros to include global assessments
					consumer products, media and real estate in addition to Allergan
					Pharmaceuticals and International Monetary Fund (IMF) global privacy,
					enterprise risk management requirements in the EU.
				</p>
				<p>
					Mr. Alfred holds an advanced degree (MBA) from Cornell University with a
					strong focus on business management.
				</p>
		</div>
  </section> -->
  <section id="about">
      <div class="container text-center">
           <h3 class="">
                About THE CLOUD CISO Cybersecurity Risk Tools
           </h3
           <p class="">
            	THE CLOUD CISO specializes in Information Technology consulting and Management,
            	Risk Management, Cyber Security, Software Development, Data Science and Privacy.
            	Founded in 2013, THE CLOUD CISO mission is to provide end-to-end quality of service for Information Systems
            	and Technology and Business Operations deliverables in a controlled environment.
            </p>
            <p>
            	THE CLOUD CISO provides cybersecurity and compliance tools for organizations small,
            	medium and large, including startups to manage their risks. THE CLOUD CISO Cybersecurity and
            	Compliance tools allow organizations to assess the risk of best / leading practices of
            	general but comprehensive cybersecurity controls across multiple disciplines in your enterprise,
            	assess regulatory compliance to FFIEC, FISMA, GDPR, HIPAA, SOX, GLBA, CMMC and many others.
            </p>
            <p>
            	Additionally THE CLOUD CISO provides tools for Enterprise Governance, Risk and Controls for developing
            	policies and standards and measuring and monitoring compliance, tracking control deficiencies
            	and reporting in a automated dashboard on the status of IT and Business control maturity,
            	IT controls risk and Business controls risks,
            	IT controls compliance and business controls compliance.
            </p>
            <p class="">
            	THE CLOUD CISO Integrated Risk &amp; Controls Assessment
            	(iRCA) + Enhanced Governance, Risk and Controls (eGRC) are a set of enterprise risk management
            	tools for managing operational risks of small, medium and large businesses, including startups.
            </p>
            <p>
            	The Integrated Regulatory and Compliance Wizard (iRCW) allows organizations to determine which
            	regulations apply to them and reports on the regulatory exposure of
            	that regulation after assessment.
            	<div class="d-none">
	            	<br>
	            	<button class="ircWizard btn btn-secondary btn-sm rounded-pill shadow px-5" type='button'>
	            		Run iRCW Now
	            	</button>
            	</div>
            </p>
            <p>
            	The Cybersecurity Maturity Model Certification (CMMC) readiness tool allows government contractors
            	to prepare for CMMC audits and self assess against CMMC compliance.
            </p>
            <br>
            <p class="">
            	Our proprietary cybersecurity risks tools allows your organization to:
            </p>
            <div class="bg-secondary rounded p-2">
	            <div class="row text-white">
	            	<div class='col-sm-3  border-white border-right text-center p-3'>
	            		<strong>Determine which regulations apply.</strong>
	            	</div>
	            	<div class='col-sm-3 border-white border-right text-center p-2'>
	            		<strong>
	            			Assess Operational and cybersecurity risks.
	            		</strong>
	            	</div>
	            	<div class='col-sm-3 border-white border-right text-center p-2'>
	            		<strong>

	            			Assess cybersecurity and compliance to a single policy or standard.
	            		</strong>
	            	</div>
	            	<div class='col-sm-3 border-white border-right text-center p-2'>
	            		<strong>
	            			Perform evidenced based risk and control audits & assessments.
	            		</strong>
	            	</div>



	            </div>
            </div>

            <div class="bg-secondary rounded mt-1 p-2">
	            <div class="row text-white">
	            	<div class='col-sm-3 border-white border-right text-center p-3'>
	            		<strong>

							Assess control maturity.
	            		</strong>
	            	</div>
	            	<div class='col-sm-3 border-white border-right text-center p-3'>
	            		<strong>
	            			Generate appropriate Risk and Controls Matrix.

	            		</strong>
	            	</div>
	            	<div class='col-sm-3 border-white border-right text-center p-3'>
	            		<strong>
	            			Perform policy and standard remediation managemment.
	            		</strong>
	            	</div>
	            	<div class='col-sm-3 text-center p-3'>
	            		<strong>
	            			Policy and Standard Generation and Documentation Management
	            		</strong>
	            	</div>

	            </div>
            </div>

            <br>
            <p class="">
            	Our proprietary platform uses COSO, CObIT(TM), and NIST controls and methodologies to
            	offer comprehensive regulatory compliance, cybersecurity readiness, privacy compliance
            	and operational risk rediness for audits and regulatory oversight.

            	<!--Our proprietary iRCA + eGRC algorithm and proprietary risk assessment matrix leverages the
            	globally accepted CObIT<sup>(TM)</sup> methodology to offer a
            	comprehensive platform that allows you to position your company operational risk readiness for
            	audits, cybersecurity initiatives and ongoing regulatory compliance.
            	-->
            </p>
			<!--
			<center>
				<div class="linkbtn">
					<?php
					 /*echo $this->Html->link('Read More',array(
						'controller'=>'pages',
						'action'=>'aboutfounder'
					),array(
						'class'=>'nav-link'
					)); */
				?>
				</div>
			</center> -->
            <!--
            <p class="mainsubtitle">
				 Our goal at THE CLOUD CISO is to prevent you from becoming a statistic, alike to the billions of individuals and millions of companies affected by cyber attacks every year. Data security in this day and age has become paramount in ensuring the continued success and growth of businesses around the world, including yours.
            </p>
            <p class="mainsubtitle">
				 The threat of a data breach is all too real for millions of companies, and yet many still remain unprepared for the tumultuous cyber terrain that lies before them. As the problem of cyber attacks continues to evolve and become more sophisticated, the harder it is to prevent. A business's best tool is preparation; an absolute necessity in being readily equipped for the day when a cyber attack comes knocking at your company's door.
            </p>
            -->

      </div>

  </section>

      <!-- Services -->
  <section id="register" class="register">
  	  <div class="container ">
          <div class="row ">
              <div class="col-md-12 tcenter">
                    <h3 >Services</h3>
                    <br>
                    <p>
                    	THE CLOUD CISO iRCA + eGRC tool provides you with the following services to managing your risks.
                    </p>
                    <p>
                    	<b>
                    		As an organization you may elect one of two assessment classifications:
                    	</b>
                    </p>
                    <div class="row text-center">
                      <div class="col-lg-5 offset-lg-1 col-md-6 col-sm-6">
                      	<div class="card text-white bg_card mb-3" style="min-height:236px;">
						   <div class="card-header">
						  	<h5 class="card-title mb-0">Self Assessment</h5>
						  </div>
						  <div class="card-body">

						    <p class="card-text">
						    	Internally perform management assessment and testing for risk management readiness.
						    </p>
						  </div>
						</div>
                      </div>
                      <div class="col-lg-5 col-md-6 col-sm-6">
                      	<div class="card text-white bg_card mb-3"  style="min-height:236px;">
						  <div class="card-header">
						  	<h5 class="card-title mb-0">Independent Assessment</h5>
						  </div>
						  <div class="card-body">
						    <p class="card-text">
						    	Allows THE CLOUD CISO to perform the assessment as an independent third party so as
			          				to provide objectivity to the assessment of your organizations operational risks.
						    </p>
						  </div>
						</div>
                      </div>
			        </div>
              </div>
          </div>
          <hr>
          <div class="row">
          	  <div class="col-md-12">
          	  	<p align="center">
	          	  	<b>
	          	  		As an organization you may elect to perform the following assessment types as provided by our proprietary tools.
	          	  	</b>
	          	  </p>
          	  </div>
	          <div class="col-md-4">
	          	<div class="card bg-primary text-white mb-2 service_card " style="min-height:400px;">
	          		<div class="card-header text-center">
					  	<h5 class="card-title mb-0">Generalized</h5>
					  </div>
	          		<div class="card-body">

	          			<p align="center">
	          				Have you implemented and how mature are your organizational policies and practices with regards to leading best practices?
	          			</p>
	          			<ul type="circle">
	          				<li>
	          					Assess the risk of best leading practices of general but comprehensive
	          					controls across multiple disciplines in your enterprise
	          				</li>
	          			</ul>
	          		</div>

	          	</div>
	          </div>
	          <div class="col-md-4">
	          	<div class="card bg-primary text-white mb-2 service_card" style="min-height:400px;">
	          		<div class="card-header text-center">
					  	<h5 class="card-title mb-0">Regulated</h5>
					  </div>
	          		<div class="card-body">

	          			<p align="center">
		          			How do you stack up against your industry regulations?
		          		</p>
		          		<ul type="circle">
		          			<li>
		          				Regulations specific assessments offering a prescriptive approach
		          				to meeting industry or specific government regulations
		          			</li>
		          			<li>
		          				You can assess multiple regulations at the same time.
		          			</li>
		          		</ul>
		          		<p align="center">
		          			<b><i>Key Regulations:</i></b> <br>

							GDPR,

							SEC CYBER,

							DFS-23-NYCRR-500,

							HIPAA,

							SOX,

							CCPA,

							FISMA,

							PCI-DSS,

							GLBA,

							FFIEC,

							FERC/NERC - CIP,

							CMMC
		          		</p>
	          		</div>

	          	</div>
	          </div>
	          <div class="col-md-4">
	          	<div class="card bg-primary text-white service_card" style="min-height:400px;">
	          		<div class="card-header text-center">
					  	<h5 class="card-title mb-0">Other (Custom)</h5>
					  </div>
	          		<div class="card-body">

	          			<p align="center">
		          			Have a very specific risk/control area that you need to build from the ground up for assessment?
		          		</p>
		          		<ul type="circle">
		          			<li>
		          				Customize and build you own risk assessment from the ground up to include custom risks,
		          				custom controls and custom control requirements
		          			</li>
		          		</ul>
	          		</div>

	          	</div>
	          </div>
	           <div class="col-md-12">
	          	<div class="card bg_dark text-white">
	          		<div class="card-header text-center">
	          			<h5 class="card-title mb-0">Benefits of using THE CLOUD CISO Cybersecurity Risks Tools</h5>
	          		</div>
	          		<div class="card-body">
	          			<div class="row text-center">
	          				<div class="col-sm-2 col-xs-6 border-primary border-right">
	          					Internal audit readiness
	          				</div>
	          				<div class="col-sm-2 col-xs-6 border-primary border-right">
	          					External audit readiness
	          				</div>
	          				<div class="col-sm-2 col-xs-6 border-primary border-right">
	          					Regulatory readiness
	          				</div>
	          				<div class="col-sm-2 col-xs-6 border-primary border-right">
	          					Know your risks
	          				</div>
	          				<div class="col-sm-2 col-xs-6 border-primary border-right">
	          					Executive Risk Dashboard
	          				</div>
	          				<div class="col-sm-2 col-xs-6">
	          					Easy Reporting for remediation planing
	          				</div>
	          			</div>
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


 <section id="features">
      <div class="container text-center">
           <h3 class="">
                Advanced Features
           </h3>
            <p class="">
            	The iRCA + eGRC tool is extensible, with this scalability capability,
            	your organization may add or remove risks or controls and control
            	requirements as needed at the start of the
            	assessment process. eGRC tool allows for customizable risk/controls,
            	maturity attributes and regulatory compliance control requirements
            </p>
           <h4>
           		Reporting
           </h4>
           <p>
           	View assessment results online, including historical assessments
           	and view non-compliance areas for remediation planning.
           </p>
           <p>
           	 View and track your risk and maturity over time to monitor your improvement levels
           	 and provide roadmaps and historical context to your risks and maturity management performance.
           </p>
	       <p>
	       	Export draft reports from completed assessments for further drafting and dissemination.
	       </p>
	       <p>
	       	THE CLOUD CISO iRCA + eGRC allows any company, small, medium or large to manage their operational risk and to think of risk
	       	differently by creating a unified platform for Independent Risk Control Assessments
	       	and Risk and Controls Self Assessments.
	       </p>
	       <br>
	       <div class="row">
	       	<div class="col-sm-4 offset-sm-4">

                  <?php
                  	echo $this->Html->link('<div class="cisobtn cisored cisoblue-border cisored-outline">  Assess your organization Operational Risk today!</div>',array(
						'controller'=>'companies',
						'action'=>'register'
					),array(
						'class'=>'register-form-link',
						'style'=>'text-decoration:none;',
						'escape'=>false
					));
                  ?>

	       	</div>
	       </div>
      </div>

  </section>





  <!-- contact us -->
  <section class="contactus register" id="contactus">
      <div class="container">
        <div class="row">
          <h3 class="text-center w-100 text-dark" style="text-shadow:none;"> Contact Us </h3>
          <div class="col-sm-12" id="parent">
            <div class="row">

			  <div class="col-sm-3"></div>
              <div class="col-sm-6">

          		<?php echo $this->Form->create('ContactUs',['class'=>'contact-form']); ?>
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="">
                    </div>


                    <div class="form-group form_left">
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email" required="">
                    </div>

                    <div class="form-group">
                         <input type="text" class="form-control" id="phone" name="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Mobile No." required="">
                    </div>
                    <div class="form-group">
                    <textarea class="form-control textarea-contact" rows="5" id="comment" name="remarks" placeholder="Type Your Message/Feedback here..." required=""></textarea>
                    </div>
                    <div class="form-group action-btn input-col text-center">
	                  <div class="g-recaptcha"
					       data-sitekey="6LdkmBslAAAAACJHubtoaBgGdg68J7j3lTi0Y1qa"
					       data-size="invisible"
					       data-callback="onSubmit">
					  </div>
	                  <div style="text-align:center;">
                      	<button type="submit" class="btn cisobtn cisored cisoblue-border cisored-outline send-btn" id="submit-btn"> <i class="fas fa-paper-plane glyphicon glyphicon-send"></i> Send Request</button>
                      </div>
	                </div>
                  <?php $this->Form->unlockField('g-recaptcha-response'); ?>
                  <?php echo $this->Form->end(); ?>
                </div>
              </div>
            </div>
          </div>

		  <p style="text-align:center"> OSS LTD, LLC, 166 Oakdale Dr, Milner GA 30257 </p>
      </div>
  </section>
  <section class="footer">
  	<div class="">
        <ul>
            <!-- <li>
            	<i class="fa fa-envelope"></i>
            	<a href="mailto:info@thecloudciso.com">
            		 info@thecloudciso.com
            	</a>
            </li> -->
            <li>
            	<i class="fa fa-globe"></i>
            	<a href="//thecloudciso.com">
            		www.thecloudciso.com
            	</a>
            </li>

            <!-- <li>
            	<i class="fa fa-phone"></i>
            	<a href="tel:+1 202-455-5121">
            		+1 202-455-5121
            	</a>
             </li> -->

        </ul>
    </div>
  	<div class="container second-portion sr-only">
        <div class="row">
              <!-- Boxes de Acoes -->
            <div class="col-xs-12 col-sm-3 col-lg-2"></div>
            <div class="col-xs-12 col-sm-6 col-lg-4">
            <div class="box">
              <div class="icon">
                <div class="image"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <div class="info bg-white">
                  <h3 class="title text-dark">MAIL &amp; WEBSITE</h3>
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
                <div class="info bg-white text-white">
                  <h3 class="title text-dark">CONTACT</h3>
                    <p>
                    <i class="fa fa-mobile" aria-hidden="true"></i> &nbsp; <a class="alink" href="tel:+1 206 8801938">+1 206 8801938</a>
                    <br>

                  </p>
                </div>
              </div>
              <div class="space"></div>
            </div>
          </div>



        </div>
      </div>

  </section>

  <div class="modal fade" tabindex="-1" role="dialog" id="ircWizard">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">REGULATIONS AND COMPLIANCE ASSESSMENT WIZARD</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">

	      </div>
	    </div>
	  </div>
	</div>
  <script>
  	$(function(){
  		$(document).on('click','.ircWizard',function(){
  			$('#ircWizard').modal('show');
  		});
  	});
  </script>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <script>
   function onSubmit(token) {
   		document.getElementById("register-form").submit();
   }
 </script>