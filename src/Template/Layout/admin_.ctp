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
  <!-- Header -->
  <header class="masthead" id="regform">
    <div class="container masterhead">
        <div class="row cisomt50">
            <div class="col-md-12">
                 <h1 class="page-title">
                 	About
                 </h1>
            </div>
        </div>

    </div>
  </header>


  <!-- Services -->
  <section>
      <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <p>Mr. Alfred is an accomplished leader in operational risk management, with
exceptional achievement in delivering solutions and project deliverables to
meet business needs and exceed objectives and has served in various
virtual C-suite roles over the past 7 years.
Mr. Alfred is generally knowledgeable in all areas of Risk Management &
Operations including risk controls implementations and remediation, and
strategic enterprise-wide risk program development and implementation.
Mr. Alfred is equipped with decades of working experience in Banking and
Finance, Retail, Intergovernmental and consulting companies with an
<?php
                    echo $this->Html->image('web/a.png',array('class'=>'dellphoto'));
                ?>
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
With this experience Mr. Alfred has led various initiatives including
developing scalable SaaS Enterprise GRC and risk/control maturity
solutions for a variety of regulations such as FFIEC compliance, SOX
Compliance, CMMC, PCI DSS, GDPR and many others.
Further, Mr. Alfred has global regulatory risk management expertise and
consent order remediation activities for BNP Paribas banking and finance
regulatory coverage, Grupo Cisneros to include global assessments
consumer products, media and real estate in addition to Allergan
Pharmaceuticals and International Monetary Fund (IMF) global privacy,
enterprise risk management requirements in the EU.
Mr. Alfred holds an advanced degree (MBA) from Cornell University with a
strong focus on business management.</p>
            </div>
        </div>
    </div>
  </section>


  <section class="footer">
  	<div class="">
        <ul>
            <li>
            	<i class="fa fa-envelope"></i>
            	<a href="mailto:info@thecloudciso.com">
            		 info@thecloudciso.com
            	</a>
            </li>
            <li>
            	<i class="fa fa-globe"></i>
            	<a href="//thecloudciso.com">
            		www.thecloudciso.com
            	</a>
            </li>

            <li>
            	<i class="fa fa-phone"></i>
            	<a href="tel:+1 202-455-5121">
            		+1 202-455-5121
            	</a>
             </li>

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