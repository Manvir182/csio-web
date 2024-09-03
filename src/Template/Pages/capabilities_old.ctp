<!-- Navigation -->
<style>
	.dropdown:hover>.dropdown-menu {
  display: block;
}
</style>
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
            <!-- <a class="nav-link js-scroll-trigger" href="#home">Home</a> -->
            <?php
	          	echo $this->Html->link('Home',array(
					'controller'=>'pages',
					'action'=>'cisohome#home'
				),array(
					'class'=>'nav-link'
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
            	THE CLOUD CISO is a minority owned small disadvantaged business specializing in Information
            	Technology consulting and Management, Risk Management, Cyber Security and Privacy.
            	Founded in 2013, THE CLOUD CISO mission is to provide end-to-end quality of service in
            	design phase of revolutionary and evolutionary information architecture implementations
            	and manage the synergies, security and co-dependence between people, processes and
            	technology while sustaining end-to-end quality of service for IT deliverables in a
            	controlled environment.
            </p>
            <p>
				Our goal is to provide superior results for our clients, delivered with the highest
				standards of honesty, integrity, and quality. We are dedicated to establishing enduring
				professional relationships with each of our clients. Our firm views each engagement as an
				opportunity to demonstrate our unique ability to provide the client with specific,
				tailored solutions that achieve remarkable results.
            </p>
            <p>
            	THE CLOUD CISO solutions and services are available via Government contracting vehicles. Providing
            	services for operational risk management, technology professional services and research, compliance
            	and cyber security management and software development.
            </p>
            <br>
            <h5>
            	GSA Contract Number:
            	<span class="d-block d-sm-none"></span>
            	47QTCA20D008Z
            </h5>
            <span class="d-block d-sm-none"><br></span>
            <h5>
            	DUNS: 117222031
            	<span class="d-none d-sm-inline">&nbsp;|&nbsp;</span>
            	<span class="d-block d-sm-none"><br></span>
             	CAGE CODE: 8FUC5
             	<span class="d-none d-sm-inline">&nbsp;|&nbsp;</span>
             	<span class="d-block d-sm-none"><br></span>
             	TAX ID: 46-2446528</h5>
      </div>

  </section>

      <!-- Services -->
  <section id="register" class="register">
  	  <div class="container ">
          <div class="row ">
              <div class="col-md-12 tcenter">
                    <h3 >Services/Capabilities</h3>
                    <hr>
                    <br>
                    <h4>NAICS CODES</h4>
                    <p>
                    	541512, 541519, 541690, 561621, 611420, 541910
                    </p>
                    <br>
                    <h4>THE CLOUD CISO focuses:</h4>
                    <p>
                    	Information Technology: Consulting, Implementation, Integration
						Information Security: Forensics, Privacy, Risk Management
                    </p>
                    <p>
                    	Cyber-Security and Privacy and offers the following services as our core competence.
                    </p>
                    <br>
                    <br>
                    <h4>Cyber-Security/Information Security</h4>
                    <p>
                    	Information Assurance - Certification and Accreditation (C & A)
                    	<br>
						System Security Life Cycle (SSLC)
						<br>
						Software/System Development Lifecycle (SDLC) Security
						<br>
						e-Discovery and Computer Forensics
						<br>
						Information Security Controls Design, Implementation and Assessment
						<br>
						Information Security Metrics
						<br>
						Control Risk & Modeling Analysis/Assessments (SOX, SAS70, GLBA, FFIEC, GDPR, NY DFS 500 etc)
						<br>
						Information Security Framework Development and Implementation (CObIT, ISO 17799/27001, SAS70 Readiness)
						<br>
						Corporate IT Security Governance
						<br>
						E-commerce Security - Web Security (OWASP)
						<br>
						Vulnerability Assessment and Remediation
						<br>
						Penetration Testing and Remediation
						<br>
						Information Security Process and Control Optimization using Business Process Re-Engineering (BPR)
						<br>
						Cyber Security Awareness Training Programs
						<br>
						Network Security Architecture
					</p>
                    <br>
                    <br>
                    <h4>Information Technology/Security Governance</h4>
                    <p>
                    	Diagramming and Systems Documentation Development
                    	<br>
						Information Technology and Security Policy and Procedure Feasibility Studies, Design, Implementation, Testing and Metrics
					</p>
					<br>
					<br>
					<h4>Privacy</h4>
					<p>
						HIPAA/HITECH/GLBA/FFEIC Compliance
						<br>
						State Breach Law Compliance
						<br>
						Privacy Impact Assessment (Non-Public Information - NPI)
					</p>
              </div>
          </div>


      </div>
  </section>
    <!-- Services -->


 <section id="features">
      <div class="container text-center">
           <h3 class="">
                THE CLOUD CISO Team
           </h3>
           <hr>
           <h4>THE CLOUD CISO Professional Qualifications: </h4>
           <br>
           <div class="row">
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Certified Information Systems Security Professionals (CISSP)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Information Systems Security Architecture Professionals (ISSAP)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Certified Secure Software Lifecycle Professionals (CSSLP)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Checkpoint Certified Security Administrators vNG (CCSA vNG)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Certified in the Governance of Enterprise IT (CGEIT)
	           	</div>
	           	<div class="col-sm-2 col-xs-12">
	           		Certified Information Systems Auditors (CISA)
	           	</div>
	           	<div class="col-12 clearfix"><br>
	           		<div class="border-top border-top-primary"></div>
	           		<br>
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Certified Project Management Professionals (PMP)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Microsoft Certified Database Administrators (MCDBA)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Microsoft Certified Systems Engineers (MCSE)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Microsoft Certified Professionals (MCP)
	           	</div>
	           	<div class="col-sm-2 col-xs-12 border-right-primary border-right">
	           		Network+ Certified Professionals (N+ -CompTIA)
	           	</div>
	           	<div class="col-sm-2 col-xs-12">
	           		Cisco Certified Network Associates (CCNA)
	           	</div>

           </div>
           <br>
           <p>
           	<br>
           		<b>
           			Our certifications align with DoD 8570 Baseline Certifications to include, but not limited to:
           		</b>
           </p>
           <p>
           	IAT Level III,

           	IAM Level II,

           	IAM Level III,
           	<br>
           	CND Auditor &amp;

           	IASAE I, II, III
           </p>
           <br>
           <p>
           		Our professionals are grounded in professionalism, integrity, and efficiency. We make objective assessments of operations and share ideas for best practices; provide counsel for improving controls, processes and procedures, performance, and risk management; suggest ways for reducing costs, enhancing
           		revenues, and improving profits; and deliver competent consulting, assurance, advisory, and facilitation services.
           </p>
           <p>
           		THE CLOUD CISO is a team of professionals possessing experience with commercial and government clients and associate directly with all levels of management. THE CLOUD CISO can quickly and effectively analyze complex situations and develop straightforward solutions tailored to an organization's needs.
           </p>
      </div>

  </section>





  <!-- contact us -->
  <section class="contactus register" id="contactus">
      <div class="container tcenter">
        <h3>
        	Experience
        </h3>
        <hr>
        <br>
        <p>
        	The Management and Staff of THE CLOUD CISO has global experience in ensuring integrity, confidentiality, and availability of technology and business process resources. Demonstrated ability in reducing IT risk based on controls assessments/recommendations, ensuring corporate continuity based on  business contingency-disaster recovery planning and change management-control, ensuring regulatory compliance based on IT audits/reviews and IT corporate governance (COSO), including SOX, GLBA, HIPAA, FISMA, DoD. Demonstrated ability in identifying security control weaknesses/vulnerabilities, performing gap analysis, assessing resultant risk/organizational impact.
        </p>
        <p>
        	THE CLOUD CISO has demonstrated ability in project planning/execution/tracking/reporting/closure, and developing Risk Management Plans. THE CLOUD CISO has proven ability to asses audit compliance with technology related compliance regulations such as SOX, GLBA, and HIPAA etc, by determining control weaknesses and recommending cost effective solutions to reduce risk and improve business performance.
        </p>
        <p>
        	THE CLOUD CISO has assessed technology related risk and controls' effectiveness in support of SAS 70 requirements for external audit-attest functions. Planned/budgeted/ lead/managed technology related compliance audits/security reviews in conjunction with operational/financial audits to ensure effectiveness of technology business controls. Scoped/planned/managed/troubleshoot client/auditee engagements/projects to complete satisfaction. Devised methodologies for painless and effective knowledge transfer to business and technical SMEs. Assess mutable real-time data and application systems with high-monetary value.
        </p>
        <p>
        	<b>
        		THE CLOUD CISO  Engagements have included, but is not limited to:
        	</b>
        </p>
        <p>
			Managing information security risk to ensure compliance to PCI DSS, SOX Compliance, DIACAP, FHFA Compliance et al.
		</p>
		<p>
			Manage and implement information security controls for multi-platform multi-protocol environment, which reduced overall risk to business financials and other non-public information.
        </p>
		<p>
			Manage Audit information security controls
		</p>
		<p>
			Implemented Information Security Frameworks; including design of custom (proprietary) frameworks.
		</p>
		<p>
			Work with Legal Counsel on Contracts and Vendor Relations - Negotiation of Statement of Work and Master Services Agreement to ensure security at inception or design.
		</p>
		<p>
			Conduct security design tests.
		</p>
		<p>
			Manage security goals and directives
		</p>
		<p>
			Serve on Change Management Committees for Software Security evaluations, approvals and testing.
		</p>
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