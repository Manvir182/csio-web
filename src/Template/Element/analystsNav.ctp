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

      <li class="nav-item ">
      <?php
        echo $this->Html->link('DASHBOARD',array(
      'controller'=>'analysts','action'=>'dashboard'
      ),array(
        'class'=>'nav-link'
      ));
      ?>
    </li>
    <li class="nav-item ">
      <?php
        echo $this->Html->link('REPORTS',array(
      'controller'=>'TprmAssessments','action'=>'tracking'
      ),array(
        'class'=>'nav-link'
      ));
      ?>
    </li>
    <li class="nav-item">
      <?php
        echo $this->Html->link('LOGOUT',array(
      'controller'=>'analysts','action'=>'logout'
      ),array(
        'class'=>'nav-link'
      ));
      ?>
    </li>
    </ul>
  </div>
</nav>