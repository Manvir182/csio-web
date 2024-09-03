<nav class="navbar navbar-expand-xl bg-dark navbar-dark fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="#">
   <div class="text-logo brand-text text-center">

       <?php
       		echo $this->Html->image('labs/logo.svg',array(
				'class'=>'brand-img'
			));
       ?>
        </div>
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">

      <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">DASHBOARD</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	        <?php
	        	echo $this->Html->link('iRCA Dashboard',array(
					'controller'=>'Lab','action'=>'dashboard'
				),array('class'=>'dropdown-item'));

				echo $this->Html->link('eGRC Dashboard',array(
					'controller'=>'Lab','action'=>'dashboard','eGRC'
				),array('class'=>'dropdown-item'));
	        ?>
        </div>

      </li>
       <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">TOOLS</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
        	echo $this->Html->link('Integrated Risk Controls Assessment (iRCA)',array(
				'controller'=>'Assessments','action'=>'assessmentRequest'
			),array('class'=>'dropdown-item'));
         ?>
         <?php
        	echo $this->Html->link('Regulations and Compliance Assessment Wizard (iRCW)',array(
				'controller'=>'lab','action'=>'regulationComplianceWizard'
			),array('class'=>'dropdown-item'));
         ?>
         <?php
        	echo $this->Html->link('Enhanced Governance, Risk and Controls (eGRC)',array(
				'controller'=>'lab','action'=>'policiesAndStandards'
			),array('class'=>'dropdown-item'));
         ?>
          <?php
        	echo $this->Html->link('Cybersecurity Maturity Model Certification (CMMC) readiness',array(
				'controller'=>'Assessments','action'=>'assessmentRequestCmmc'
			),array('class'=>'dropdown-item'));
         ?>
        </div>
      </li>
      <li class="nav-item">
        <?php
          echo $this->Html->link('TPRM',array(
        'controller'=>'tprm','action'=>'invite'
        ),array('class'=>'nav-link'));
        ?>
      </li>
       <li class="nav-item">

        <?php
        	echo $this->Html->link('REPORTS',array(
				'controller'=>'Assessments','action'=>'tracking'
			),array('class'=>'nav-link'));
        ?>
      </li>

       <li class="nav-item">

        <?php
        	echo $this->Html->link('ACCOUNT',array(
				'controller'=>'Lab','action'=>'account'
			),array('class'=>'nav-link'));
        ?>
      </li>
      <!--
       <li class="nav-item">

        <?php
        	echo $this->Html->link('ABOUT',array(
				'controller'=>'Lab','action'=>'about'
			),array('class'=>'nav-link'));
        ?>
       </li>
       -->

         <li class="nav-item">

        <?php
        	echo $this->Html->link('SERVICES',array(
				'controller'=>'Lab','action'=>'services'
			),array('class'=>'nav-link'));
        ?>
      </li>
      <!--
      <li class="nav-item">

        <?php
        	echo $this->Html->link('RESULTS',array(
				'controller'=>'Lab','action'=>'results'
			),array('class'=>'nav-link'));
        ?>
       </li> -->
       <li class="nav-item">

        <?php
        	echo $this->Html->link('CONTACT US',array(
				'controller'=>'Lab','action'=>'contactus'
			),array('class'=>'nav-link'));
        ?>
      </li>
        <li class="nav-item">

        	<?php
        		echo $this->Html->link('LOGOUT',array(
					'controller'=>'Lab','action'=>'logout'
				),array(
					'class'=>'nav-link'
				));
        	?>
        </li>
    </ul>
  </div>
</nav>