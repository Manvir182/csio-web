<style>
	.dropdown:hover>.dropdown-menu {
  display: block;
}
</style>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" style="background:#100a57;" id="mainNav">
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
					'class'=>'nav-link'
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


  <!-- Header -->






    <div class="container-fluid mt-5 pt-3">
       <div class="row">

        <div class="col-sm-12 text-center mt-5">

          <h4 class="title mt-5">THE CLOUD CISO</h4>
          <p class="subtitle mt-2">CMMC READINESS PROCESS</p>

        </div>
      </div>

      <div class="row">

        <div class="col-sm-5 col-md-5 col-lg-4">
          <ul class="process-list">
            <li>
                <div class="row">
                   <div class="col-sm-12 c-right" id="element2">
                        <div class="c-article" >
                           <span class="box-c mob-float"> CMMC directive updates</span> <img src="cmmc/img/01.svg" class="c-image count_img">
                        </div>
                  </div>
                </div>
            </li>
               <li>
                <div class="row">
                   <div class="col-sm-12 c-right" id="element3">
                        <div class="c-mr75 c-article" >
                           <span class="box-c mob-float"> Review and  CMMC suite of practices to be assessed</span> <img src="cmmc/img/02.svg" class="count_img c-image">
                        </div>
                  </div>
                </div>
            </li>
             <li>
                <div class="row">
                   <div class="col-sm-12 c-right" id="element4">
                       <div class="c-article">
                           <span class="box-c mob-float"> Assess CMMC practices using using evidenced based testing</span> <img src="cmmc/img/03.svg" class="count_img c-image">
                        </div>
                  </div>
                </div>
            </li>
               <li>
                <div class="row">
                   <div class="col-sm-12 c-right" id="element5">
                      <div class="c-mr75 c-article">
                           <span class="box-c mob-float"> Assess CMMC process maturity using THE CLOUD CISO CObIT (tm) proprietary scoring methodolgy</span> <img src="cmmc/img/04.svg" class="c-image count_img">
                        </div>
                  </div>
                </div>
            </li>
             <li>
                <div class="row">
                   <div class="col-sm-12 c-right" id="element6">
                        <div class="c-article">
                           <span class="box-c mob-float"> Review and analyze assessment results and reports</span> <img src="cmmc/img/05.svg" class="c-image count_img">
                        </div>
                  </div>
                </div>
            </li>
          </ul>

        </div>
         <div class="col-sm-12 col-sm-2 col-md-2  col-lg-4 d-none d-sm-block text-center">
            <div class="row c-height">
              <div class="col-sm-12 text-center center-box">
              <img src="cmmc/img/path1.png" class="img-fluid count_img" id="element1">
            </div>
          </div>
        </div>
         <div class="col-sm-5 col-md-5  col-lg-4 text-center">

               <ul class="process-list">
            <li>
                <div class="row">
                   <div class="col-sm-12 text-left " id="element7">
                        <div class="c-article d-none d-sm-block">
                           <img src="cmmc/img/06.svg" class="c-image count_img"><span class="box-c ml-2"> Develop plan of actions and milestones (POAM)</span>
                           </div>
                         <div class="c-ml-75 c-article d-block d-sm-none">
                           <img src="cmmc/img/06M.svg" class="c-image"><span class="box-c "> Develop plan of actions and milestones (POAM)</span>
                        </div>
                  </div>
                </div>
            </li>
               <li>
                <div class="row">
                   <div class="col-sm-12 text-left" id="element8">
                         <div class="c-ml-75  c-article d-none d-sm-block" >
                           <img src="cmmc/img/07.svg" class="c-image count_img"><span class="box-c ml-2 "> Remediate deficiencies in practices</span>
                        </div>
                          <div class="c-article d-block d-sm-none">
                            <img src="cmmc/img/07M.svg" class="c-image"><span class="box-c "> Remediate deficiencies in practices</span>
                        </div>
                  </div>
                </div>
            </li>
             <li>
                <div class="row">
                   <div class="col-sm-12 text-left " id="element9">
                       <div class=" c-article d-none d-sm-block">
                         <img src="cmmc/img/08.svg" class="c-image count_img">  <span class="box-c ml-2 "> Remediate deficiencies in processes, establish maturity roadmap </span>
                        </div>
                         <div class="c-ml-75 c-article d-block d-sm-none">
                          <img src="cmmc/img/08M.svg" class="c-image">  <span class="box-c "> Remediate deficiencies in processes, establish maturity roadmap </span>
                        </div>
                  </div>
                </div>
            </li>
               <li>
                <div class="row">
                   <div class="col-sm-12 text-left" id="element10">
                       <div class="c-ml-75 c-article d-none d-sm-block">
                          <img src="cmmc/img/09.svg" class="c-image count_img"> <span class="box-c ml-2">Monitor compliance, continuous monitoring </span>
                        </div>
                        <div class="c-article d-block d-sm-none">
                           <img src="cmmc/img/09M.svg" class="c-image"> <span class="box-c "> Monitor compliance, continuous monitoring </span>
                        </div>

                  </div>
                </div>
            </li>
             <li>
                <div class="row">
                   <div class="col-sm-12 text-left" id="element11">
                        <div class="c-article d-none d-sm-block">
                           <img src="cmmc/img/10.svg" class="c-image count_img"> <span class="box-c ml-2"> Re-assess CMMC periodically </span>
                        </div>
                         <div class="c-ml-75 c-article d-block d-sm-none">
                            <img src="cmmc/img/10M.svg" class="c-image"> <span class="box-c "> Re-assess CMMC periodically </span>
                        </div>
                  </div>
                </div>
            </li>
          </ul>

        </div>
      </div>
          <div class="row ">
        <div class="col-sm-12 text-center">
          <?php
          	echo $this->Html->link('Assess your CMMC Readiness today using THE CLOUD CISO CMMC Readiness Tool &rarr;',[
          		'controller'=>'Companies','action'=>'register'
          	],[
          		'class'=>'btn btn-link',
          		'style'=>'color:#263853;',
          		'escape'=>false
          	]);
          ?>
        </div>
      </div>


     </div>
<section class="footer mt-5">
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <!--  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
 <!-- jQuery library -->
<script src="<?php echo $this->request->getAttribute('webroot').'cmmc/css/leader-line.min.js'; ?>"></script>


     <script type="text/javascript">


     	function allImagesLoaded() {
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element2'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element3'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element4'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element5'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element6'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element7'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element8'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element9'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element10'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});
		     new LeaderLine(document.getElementById('element1'),document.getElementById('element11'), {endPlug:'disc', color: '#869096', size:2, dash: {animation: true}});



	    	  resized();

		 }






      $( window ).resize(function() {
          resized();
      });
	    function resized()
	    {


	        var w_size=$( window ).width();

	       if(w_size<767)
	        {
	              $('.leader-line').hide();

	        }
	        else
	        {
	         	$('.leader-line').show();

	        }

	    }

	     setTimeout(function(){
	     	allImagesLoaded();
	     },1500);




     </script>
