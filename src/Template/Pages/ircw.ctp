<style>
	.dropdown:hover>.dropdown-menu {
  display: block;
}
</style>
<style>
	/*form styles*/
	#msform {
		width: 70%;
		margin: 50px auto;
		text-align: center;
		position: relative;
	}
	#msform fieldset {
		background: white;
		border: 0 none;
		border-radius: 3px;
		box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
		padding: 20px 30px;
		box-sizing: border-box;
		width: 80%;
		margin: 0 10%;

		/*stacking fieldsets above each other*/
		position: relative;
	}
	/*Hide all except first fieldset*/
	#msform fieldset:not(:first-of-type) {
		display: none;
	}
	/*inputs*/
	#msform input, #msform textarea {
		padding: 15px;
		border: 1px solid #ccc;
		border-radius: 3px;
		margin-bottom: 10px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		font-size: 13px;
	}
	/*buttons*/
	#msform .action-button {
		width: 100px;
		background: #27AE60;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 1px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px;
	}
	#msform .action-button:hover, #msform .action-button:focus {
		box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
	}
	/*headings*/
	.fs-title {
		font-size: 15px;
		text-transform: uppercase;
		color: #2C3E50;
		margin-bottom: 10px;
	}
	.fs-subtitle {
		font-weight: normal;
		font-size: 13px;
		color: #666;
		margin-bottom: 20px;
	}
	/*progressbar*/
	#progressbar {
		margin:0px;
		padding:0px;
		margin-bottom: 30px;
		overflow: hidden;
		/*CSS counters to number the steps*/
		counter-reset: step;
	}

	#progressbar li {
		list-style-type: none;
		color: #eee;
		text-transform: uppercase;
		font-size: 14px;
		width: 33.33%;
		//float: left;
		display:inline-block;
		position: relative;
	}
	#progressbar li:before {
		content: counter(step);
		counter-increment: step;
		width: 24px;
		line-height: 24px;
		display: block;
		font-size: 18px;
		color: #eee;
		background: #ccc;
		border-radius: 3px;
		margin: 0px auto 2px auto;
		font-weight:bold;
	}
	/*progressbar connectors*/
	#progressbar li:after {
		content: '';
		width: 92%;
		height: 2px;
		background: #eee;
		position: absolute;
		left: -46%;
		top: 9px;
		z-index: 0; /*put it behind the numbers*/
	}
	#progressbar li:first-child:after {
		/*connector not needed before the first step*/
		content: none;
	}
	/*marking active/completed steps green*/
	/*The number of the step and the connector before it = green*/
	#progressbar li.active,
	#progressbar li {
		z-index: 2;
	}
	#progressbar li.active:before,  #progressbar li.active:after{
		background: #fff;
		color: #111

	}
	.badge
	{
    text-align: left;
    white-space: normal;
	}




    @media (max-width:768px){
		#msform
		{
			width: 100%;;
		}
		#msform fieldset
		{
			width: 100%;
			margin: 0 0%;
		}
		#progressbar li
		{
		width: 46%;
		}
	}

</style>









<div class="d-sm-block" style="color:#ffffff;height:100%;top:0px;left:0px;width:100%;background-image:url(img/web/bkg.png);background-repeat:no-repeat;background-position:center center;background-size:cover;">
	<div class="container">

				<div class="text-center">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
       <div class="topnavv">
	   	<a class="navbar-brand js-scroll-trigger" href="#page-top">
         <div class="text-logo brand-text text-center">
          <img src="../../img/web/logo.png">
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
						'class'=>'nav-link active'
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


           <div class="row" >


           </div>
           <div class="col-md-12 boxmargin" style="padding:5px;position:static;min-height:960px !important;">

			<div class="col-md-12">
                    <h5 class="questiontitle page-title-text" style="padding-top:10px;">Regulations and Compliance Assessment Wizard</h5>
               </div>

           	<?php echo $this->Form->create($activities,['id'=>'msform']); ?>
			  <!-- progressbar -->
			  <ul id="progressbar">
			    <li class="active">Select Activities</li>
			    <li>Review Activities</li>
			  </ul>
			  <!-- fieldsets -->
			  <fieldset>

			    <h2 class="fs-title">Select Your Company Activities</h2>

			    <ul style="list-style:none;padding:0;margin:0;">
			   		<?php foreach($activities as $activity): ?>
						<li style="text-align:left;color: black;">
				    		<?php

				        		echo $this->Form->control('activities[]',[
				        			'value'=>$activity->id,
				        			'id'=>'compActivity'.$activity->id,
				        			'label'=>array('text'=>" ".$activity->name,'style'=>'display:block;'),
				        			'type'=>'checkbox',
				        			'hiddenField'=>false,
				        			'style'=>'width:auto;',
				        			'class'=>'activities '.($activity->name=='Unsure'?'unsure':''),

				        		]);
				        	?>
			    		</li>
			    	<?php endforeach; ?>

				</ul>



			    <input type="button" name="next" class="next action-button" value="Next" />
			  </fieldset>
			  <fieldset>
			    <!-- <h2 class="fs-title">Personal Details</h2> -->
			    <h2 class="fs-title">
			    	Based on your company activities you may be required to comply with these regulations
			    	and/or industry standards.
			    </h2>

			    <div class="relatedRegulations">

			    </div>
			    <input type="button" name="previous" class="previous action-button" value="Previous" />
			    <div class="">

			    <br>
			    <a href="companies/register" class="btn btn-link">Register to assess risk &rarr;</a>
			    </div>
			  </fieldset>
			<?php echo $this->Form->end(); ?>

           </div>



           </div>
       </div>
        <!-- content wrapper -->
        <br>
  </div>
  <!-- main content closed -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script>
	var rproto = "<?php echo $uProto; ?>";
	$(function(){
		$('#wizardModal').modal('show');


		//jQuery time
		var current_fs, next_fs, previous_fs; //fieldsets
		var left, opacity, scale; //fieldset properties which we will animate
		var animating; //flag to prevent quick multi-click glitches

		$(".next").click(function(){
			if(!$('.activities:checked').length){
			//alert('No activity selected');
				swal({
				  title: "IRCA",
				  text: "Kindly choose at least one activity.",
				  icon: "warning",
				  //buttons: true,
				  dangerMode: true,
				});
				return false;
			}
			if(animating) return false;
			animating = true;

			current_fs = $(this).parent();
			next_fs = $(this).parent().next();


			//activate next step on progressbar using the index of next_fs
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale current_fs down to 80%
					scale = 1 - (1 - now) * 0.2;
					//2. bring next_fs from the right(50%)
					left = (now * 50)+"%";
					//3. increase opacity of next_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({
		        'transform': 'scale('+scale+')',
		        'position': 'absolute'
		      });
					next_fs.css({'left': left, 'opacity': opacity});
				},
				duration: 800,
				complete: function(){
					current_fs.hide();
					animating = false;
					loadRelatedRegulations();
				},
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});

		$(".previous").click(function(){
			if(animating) return false;
			animating = true;

			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();

			//de-activate current step on progressbar
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			//show the previous fieldset
			previous_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now, mx) {
					//as the opacity of current_fs reduces to 0 - stored in "now"
					//1. scale previous_fs from 80% to 100%
					scale = 0.8 + (1 - now) * 0.2;
					//2. take current_fs to the right(50%) - from 0%
					left = ((1-now) * 50)+"%";
					//3. increase opacity of previous_fs to 1 as it moves in
					opacity = 1 - now;
					current_fs.css({'left': left});
					previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
				},
				duration: 800,
				complete: function(){
					current_fs.hide();
					animating = false;
					$('.relatedRegulations').html('');
				},
				//this comes from the custom easing plugin
				easing: 'easeInOutBack'
			});
		});



		function loadRelatedRegulations(){
		    jQuery('html,body').animate({scrollTop:0},500);
			var activity_ids = new Array();
			var unsure = false;
			$('.activities:checked').each(function(){
				activity_ids.push($(this).val());
				if($(this).hasClass('unsure')){
					//unsure = true;
				}
			});
			if(unsure){
				$('.relatedRegulations').html(`<div class="alert alert-info">Are you sure to continue with <b>Unsure</b> option?</div>`);
			} else {
				activity_ids = activity_ids.toString();

				var thisUrl = "<?php echo $this->Url->build(array('controller'=>'pages','action'=>'getActivityRegulations'),true); ?>";
				thisUrl = thisUrl.replace("http:", rproto);
				$.ajax({
					url : thisUrl,
					method : "POST",
					headers: {
					    'X-CSRF-Token': <?= json_encode($this->request->getParam('_csrfToken')); ?>
					 },
					data : {activity_ids:activity_ids},
					beforeSend : function(xhr) {
						$('.relatedRegulations').html(`<span class="text-danger font-20"><i class='fa fa-spin fa-asterisk'></i>  <span class="blinking"> Loading...</span></span>`);

					},
					success : function(data) {
						$('.relatedRegulations').html(data);
					}
				});
			}



		}


		$(document).on('change','.activities',function(){
			cbox = $(this);
			if(cbox.hasClass('unsure')){
				if(cbox.prop('checked')){
					$('.activities:not(.unsure)').prop('checked',false).prop('disabled',true);
				} else {
					$('.activities.unsure').prop('checked',false).prop('disabled',false);
					$('.activities:not(.unsure)').prop('disabled',false);
				}

			} else {
				$('.activities.unsure').prop('checked',false).prop('disabled',false);
				$('.activities:not(.unsure)').prop('disabled',false);
			}
		});




	});
</script>


			</div>
		</div>
	</div>
</div>












				</div>
			</div>
		</div>



