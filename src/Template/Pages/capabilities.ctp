<!-- Navigation -->
<style>
	.dropdown:hover>.dropdown-menu {
  display: block;
}
</style>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <div class="topnavv">
	  <a class="navbar-brand js-scroll-trigger" href="#page-top">
         <div class="text-logo brand-text text-center">
          <h4 class="brand-title">THE CLOUD CISO</h4>
          <p class="tag-line">
          		RISK & ADVISORY
          </p>
        </div>
        </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="menu">Menu</span>
        <i class="fas fa-bars"></i>
      </button>
	  </div>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <!-- <a class="nav-link js-scroll-trigger" href="#home">Home</a> -->
            <?php
	          	echo $this->Html->link( '<i class="fa fa-home"></i>',array(
					'controller'=>'pages',
					'action'=>'cisohome#home'
				),array(
					'class'=>'nav-link',
					"escape"=>false
				));
	        ?>
          </li>

          <li class="nav-item">
            <!-- <a class="nav-link js-scroll-trigger" href="#about">About</a> -->
             <?php
	          	echo $this->Html->link('About',array(
					'controller'=>'pages',
					'action'=>'cisohome#about'
				),array(
					'class'=>'nav-link'
				));
	        ?>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link js-scroll-trigger" href="#register">Services</a> -->
             <?php
	          	echo $this->Html->link('Services',array(
					'controller'=>'pages',
					'action'=>'cisohome#register'
				),array(
					'class'=>'nav-link'
				));
	        ?>
          </li>

          <!-- <li class="nav-item">
            <?php
	          	echo $this->Html->link('Government',array(
					'controller'=>'pages',
					'action'=>'capabilities'
				),array(
					'class'=>'nav-link active'
				));
	        ?>
          </li> -->
          <li class="nav-item">
            <!-- <a class="nav-link js-scroll-trigger" href="#features">Features</a> -->
             <?php
	          	echo $this->Html->link('Features',array(
					'controller'=>'pages',
					'action'=>'cisohome#features'
				),array(
					'class'=>'nav-link'
				));
	        ?>

          </li>


          <li class="nav-item">
            <!-- <a class="nav-link js-scroll-trigger" href="#contactus">Contact</a> -->
             <?php
	          	echo $this->Html->link('Contact',array(
					'controller'=>'pages',
					'action'=>'cisohome#contactus'
				),array(
					'class'=>'nav-link'
				));
	        ?>

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
<!--
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
         <div class="text-logo brand-text text-center">
          <h4 class="brand-title">THE CLOUD CISO</h4>
          <p class="tag-line">
          	Technology &amp; Cybersecurity
          </p>
        </div>
        </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="menu">Menu</span>
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
             <?php
              	echo $this->Html->link('Back To Home',array(
					'controller'=>'pages',
					'action'=>'home'
				),array(
					'class'=>'nav-link'
				));
              ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 -->

  <!-- Header -->
  <header class="masthead" id="regform">
    <div class="container masterhead">
        <div class="row cisomt50">
            <div class="col-md-12">
                 <h1 class="page-title">
                 	Government
                 </h1>
                 <?php
		          	echo $this->Html->link('ASSESS CMMC &rarr;',array(
						'_name'=>'cmmclanding'
					),array(
						'class'=>'text-white',
						'style'=>'font-weight:bold;',
						'escape'=>false
					));
		        ?>
            </div>
        </div>

    </div>
  </header>


  <!-- Services -->
  <section id="about">
      <div class="container text-center">

           <h3 class="">
                Company Info &amp; Capabilities Statement
           </h3>
           <hr>
            <p class="">
            	THE CLOUD CISO specializes in Information Technology Consulting
				and Management, Risk Management, Cyber Security and Privacy
				and Software Development.
            </p>
            <p>
				Founded in 2013, THE CLOUD CISO mission is to provide end-to-end quality of service.
            </p>
            <p>
            	Our goal is to provide superior results for our clients, delivered with the highest standards of
				honesty, integrity, and quality. We are dedicated to establishing enduring professional relationships
				with each of our clients. Our firm views each engagement as an opportunity to demonstrate our
				unique ability to provide the client with specific, tailored solutions that achieve remarkable results.
            </p>

      </div>

  </section>

      <!-- Services -->
  <section id="register" class="register">
  	  <div class="container ">
          <div class="row ">
              <div class="col-md-12 tcenter">
              		<h3 class="">
		                CORE COMPETENCIES
		           </h3>
		           <hr>
		           <p>
		           	THE CLOUD CISO can quickly and effectively analyze complex
					situations and develop straightforward solutions
					tailored to an organization's needs.
		           </p>
		           <p>
		           	<strong>Core Competencies Include:</strong>
		           </p>
		           <br>
		           <div class="row">
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Information Technology
			           			</divi>
			           		</div>
			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Consulting, Implementation, Integration
			           			</divi>
			           		</div>
			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Cybersecurity (NIST, FedRAMP, ISO)
			           			</divi>
			           		</div>
			           	</div>

			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Data Privacy
			           			</divi>
			           		</div>

			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Enterprise Operations Risk Management
			           			</divi>
			           		</div>

			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Software Development
			           			</divi>
			           		</div>

			           	</div>

			           	<div class="col-sm-4 offset-sm-4 col-xs-12">
			           		<div class="card bg-primary text-white">
			           			<divi class="card-body">
			           				Data Research and Analytics
			           			</divi>
			           		</div>

			           	</div>


		           </div>



                    <h3 class="mt-5">KEY CERTIFICATIONS</h3>
                    <hr>
                    <br>


                    <div class="row">
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Certified Information Systems Security Professionals (CISSP)
			           			</divi>
			           		</div>
			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Certified Secure Software Lifecycle Professionals (CSSLP)
			           			</divi>
			           		</div>
			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Certified in the Governance of Enterprise IT (CGEIT)
			           			</divi>
			           		</div>
			           	</div>

			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Certified Project Management Professionals (PMP)
			           			</divi>
			           		</div>

			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Microsoft Certified: Azure Solutions Architect Expert
			           			</divi>
			           		</div>

			           	</div>
			           	<div class="col-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Certified Information Systems Auditors (CISA)
			           			</divi>
			           		</div>

			           	</div>


		           </div>
                   <div class="row">
                    	<div class="col-sm-4 offset-sm-4 col-xs-12">
			           		<div class="card bg-info text-white">
			           			<divi class="card-body">
			           				Key Team Experience<br>
			           				<div class="mt-3 py-2 bg-white text-primary rounded-pill">
			           					<b>NAVAIR, BAE Systems</b>
			           				</div>
			           			</divi>
			           		</div>

			           	</div>
                    </div>
              </div>
          </div>


      </div>
  </section>
    <!-- Services -->


 <section id="features">
      <div class="container text-center">
           <h3 class="">
                DoD Baseline
           </h3>
           <hr>
           <h4>
           	Our certifications align with DoD 8570 Baseline Certifications
           	to include, but not limited to: IAT Level III, IAM
			Level II, IAM Level III, CND Auditor &amp; IASAE I, II, III
		   </h4>

      </div>

  </section>





  <!-- contact us -->
  <section class="contactus register" id="contactus">
      <div class="container tcenter">
        <h3>
        	GSA Schedule &amp; Government
        </h3>
        <hr>
        <div class="row">

	          <div class="col-md-5 offset-md-1">
	          	<div class="card bg-primary text-white mb-2" style="min-height:250px;">
	          		<div class="card-header text-center">
					  	<h5 class="card-title mb-0">Minority Owned Small Disadvantaged Business</h5>
					  </div>
	          		<div class="card-body">
	          			<ul type="circle" class="text-left">
	          				<li>
	          					Dun &amp; Bradstreet (DUNS): 117221031
	          				</li>
	          				<li>
	          					CAGE Code: 8FUC5
	          				</li>
	          				<li>
	          					GSA Schedule Contract Number: 47QTCA20D008Z
	          				</li>
	          			</ul>
	          		</div>

	          	</div>
	          </div>
	           <div class="col-md-5">
	          	<div class="card bg-primary text-white mb-2" style="min-height:250px;">
	          		<div class="card-header text-center">
					  	<h5 class="card-title mb-0">Primary NAICS</h5>
					  </div>
	          		<div class="card-body">
	          			<ul type="circle" class="text-left">
	          				<li>
	          					541512 - Computer Systems Design Services
	          				</li>
	          				<li>
	          					541690 - Other Scientific and Technical Consulting Services
	          				</li>

	          			</ul>
	          		</div>

	          	</div>
	          </div>
	          <div class="col-md-10 offset-sm-1">
	          	<div class="card bg-primary text-white mb-2">
	          		<div class="card-header text-center">
					  	<h5 class="card-title mb-0">Additional Services NAICS</h5>
					  </div>
	          		<div class="card-body">


		          		<ul type="circle" class="text-left">

		          			<li>
		          				541611 - Administrative and General Mgmt Consulting Services
		          			</li>
		          			<li>
		          				611420 - Computer Training
		          			</li>
		          			<li>
		          				541990 - All Other Professional, Scientific, and Technical Services
		          			</li>
		          			<li>
		          				541519 - Other Computer Related Services
		          			</li>
		          			<li>
		          				511210 - Software Publishers
		          			</li>
		          			<li>
		          				541720 - Research and Development in the Social Sciences &amp; Humanities
		          			</li>
		          			<li>
		          				541715 - Research &amp; Dev. in the Physical, Engineering, &amp; Life Sciences
		          			</li>
		          			<li>
		          				541430 - Graphic Design Services
		          			</li>
		          			<li>
		          				541930 - Translation and Interpretation Services
		          			</li>
		          		</ul>

	          		</div>

	          	</div>
	          </div>


          </div>
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

  </section>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <script>
   function onSubmit(token) {
   		document.getElementById("register-form").submit();
   }
 </script>