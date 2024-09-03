<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
         @font-face {
        font-family: MicroExtendFLF-Bold;
        src: url('font/MicroExtendFLF-Bold.ttf');
        }
        @font-face {
        font-family: 'MicroExtendFLF';
        src: url(font/MicroExtendFLF.ttf);
        }
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap'); body{
            font-family: 'Montserrat', sans-serif;
        }
        *{
    padding:0px;
    margin:0px;
    box-sizing:border-box;
}
html{
    overflow-x: hidden;
}
body{
    padding:0px;
    margin:0px;
}
.Blog-section {
    margin-top: 25px;
    margin-bottom: 20px;
}
.card-body {
    padding: 20px;
    /* border-bottom: 1px solid #ccc; */
}
ul.meta-wrape {
    padding: 0px;
    margin: 0px;
}
.card-body h4 {
    font-size: 20px;
    line-height: 40px;
    font-weight: 400;
    color: #000000;
}
.card-body ul li {
    display: inline-block;
    margin-bottom: 10px;
    padding: 0px 1px;
}
ul li:first-child {
    padding-left: 0px;
}
.card-body p {
    font-size: 15px;
    font-weight: 400;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.card-body p a.btn-custom {
    text-decoration: none;
    color: #000000;
    font-weight: 600;
}
ul.categories {
    padding: 0px;
    margin: 0px;
    margin-bottom: 15px;
    margin-top: 30px;
}
ul.categories li {
    /* display: inline-block; */
    list-style: none;
    padding: 4px 12px;
    background: transparent;
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
}
ul.categories li a {
    text-decoration: none;
    color: #000000;
    font-weight: 600;
    font-size: 12px;
}
ul.categories li span.cat-status-value {
    float: right;
    color: #000000;
    font-weight: 600;
    font-size: 12px;
}
span.icon.icon-search {
    position: absolute;
    right: 26px;
    top: 7px;
}
.card-body.card-article-lines p {
    font-size: 15px;
    font-weight: 400;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
h3.sidebar-heading-articles, h3.sidebar-heading-categories {
    font-size: 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid;
    line-height: 64px;
}
.custome p {
    line-height: 30px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.sidebar {
    background: #f8f9fa !important;
    padding: 40px 20px;
}
ul.meta-wrape i.fa {
    color: #ccc;
}
/*************Details-section-style*********/
.card-body.card-body-details h4, .post-share-buttons h {
    font-size: 30px;
}
.card-body.card-body-details p {
    font-size: 18px;
    display: -webkit-box;
    -webkit-line-clamp: unset;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.post-share-buttons h4 {
    font-size: 30px;
    line-height: 40px;
    font-weight: 400;
    color: #000000;
    margin-top: 20px;
}
.align-items-center.images-details-styling img.img-fluid {
    width: 100%;
    object-fit: fill;
}
.card-body-details ul {
    padding: 0px;
    margin: 0px;
}
.share-buttons-custome li{
    list-style: none;
    cursor: pointer;
}
.share-buttons-custome li a{
    list-style: none;
    padding: 20px;
    background: #ccc;
    margin: 0px 20px;
}
.share-buttons-custome li a:hover{

    background: #000000;
    color: #ffffff;

}
.share-buttons-custome {
    margin-top: 34px;
}
.col-12.post-share-buttons {
    margin-bottom: 30px;
}
.share-buttons-custome li:first-child a {
    margin-left: 0px;
    padding: 20px 24px;
}
ul.categories li.active {
    background: #ccc;
}


/********pagination-body*******/
.pagination-body {
    margin-top: 45px;
    display: flex;
    justify-content: center;
}
ul.pagination li.page-item a.page-link {
    text-decoration: none;
    color: #000;
}
/********pagination-body-end*******/

@media (max-width: 992px){
    span.date {
        display: none;
    }
    .custome img.img-fluid {
        margin: 0 auto;
    }
}
@media (max-width: 768px){
    span.date {
        display: none;
    }
    .custome img.img-fluid {
        margin: 0 auto;
    }
    .card-body {

        margin-bottom: 25px;
    }
}
@media (max-width: 767px){

  img.img-fluid {
        margin: 0 auto !important;
    }
    .card-body.card-body-details p {
        font-size: 16px;
    }
    .card-body.card-body-details h4 {
        font-size: 25px;
        line-height: 32px;
        margin-bottom: 20px;
    }
    .share-buttons-custome li a {

        padding: 14px;
        margin: 0px 12px;
    }
    .share-buttons-custome li:first-child a {
        margin-left: 0px;
        padding: 14px 17px;
    }
}
@media (max-width: 575px){
    span.date {
        display: none;
    }
    ul.categories li {
        margin-bottom: 10px;
    }
    .card-body ul li {
        padding: 0px 1px;
    }
  img.img-fluid {
        margin: 0 auto !important;
    }
    .card-body h4 {
        line-height: 26px;

    }
    .card-body {

        margin-bottom: 25px;
    }
    .custome p {
        line-height: 22px;

    }
    .card-body.card-card {
        padding: 0px 10px 0px 0px;
        margin-bottom: 7px;
        margin: 2px 0px;
    }
}
  </style>

</head>
<body>
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
						'class'=>'nav-link'
					));
		        ?>
	          </li>
			  <!-- <li class="nav-item">
			  <?php
		          	echo $this->Html->link('Blog',array(
						'controller'=>'articles',
						'action'=>'blog'
					),array(
						'class'=>'nav-link active'
					));
		        ?>
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
  <header class="masthead" id="regform">
    <div class="container masterhead">
        <div class="row cisomt50">
            <div class="col-md-12">
                 <h1 class="page-title">
                     <?= $article->title ?>
                 </h1>
                 <h5><?= $article->category->name ?></h5>
            </div>
        </div>
    </div>
  </header>
  <div class="Blog-section details">
         <div class="container">
            <div class="row">
               <div class=" col-lg-8 col-md-12 image-style">
                  <div class="row">
                     <div class="col-12 d-flex align-items-center images-details-styling">
                     <?php if(!empty($article->image)) {?>
                     <img src="<?= $article->image ?>" class="img-fluid " alt="Responsive image">
                     <?php } ?>
                     </div>
                    <div class="col-12 card-body card-body-details">
                        <h4> <?= $article->title ?></h4>
                        <ul class="meta-wrape">
                            <li>
                                By <i class="fa fa-user" aria-hidden="true"></i>
                                  <span><?= $article->author->name ?></span>
                               </li>
                             <li>
                             <i class="fa fa-clock-o" aria-hidden="true"></i>
                             <?= date("F j, Y",strtotime($article->created)); ?>
                            </li>
                            <li>
                             <i class="fa fa-folder-o" aria-hidden="true"></i>
                               <span><?= $article->category->name ?></span>
                            </li>
                         </ul>
                        <p><?= $article->content ?></p>
                        <div class="row mt-5">
                         <div class="col-12 ">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-center">
                                  <li class="page-item ">
                                    <?= $this->Html->link(__('<i class="fa fa-angle-double-left"></i> Back'), ['action' => 'blog'],['escape'=>false,'class'=>'page-link']) ?>
                                  </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-12 col-sm-12 sidebar">
                  <!-- <div class="row">
                     <div class="col-md-12">
                        <div class="sidebar-box-categories">
                            <h3 class="sidebar-heading-categories"><i class="fa fa-tags" aria-hidden="true"></i> Categories</h3>
                            <ul class="categories">
                            <?php foreach($categories as $category){ ?>
                                <li><?= $category->name ?></li>
                                        <?php } ?>
                            </ul>
                         </div>
                     </div>
                  </div> -->
                  <?php echo $this->element('blog-categories', array('cat' => $article->category->name)); ?>
               </div>
            </div>
         </div>
      </div>
</body>
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
</html>


