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

  <?php $firstArticle = $articles->first();?>
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
      .section-blog
      {
          background:rgba(14, 10,87, 1);
          padding: 120px;
          color:#fff;
          font-family: MicroExtendFLF-Bold;
      }
      .card-blog
      {
          background-image:linear-gradient(to right, rgba(0, 0, 0, .8) 60%, rgba(0, 0, 0, 0)),url('<?= $firstArticle->image ?>');
            width: 100%;
            height: 400px;
            background-position: right 0% center;
            color: white;
            padding: 20px;
            background-size: cover;
            background-repeat: no-repeat;
            margin-top:-40px;
            box-shadow: 0px 10px 40px rgba(0,0,0,0.2);
        }

        .card-blog p
        {
            font-size: 14px;
        }
        .single-blog p
        {
            font-size: 14px;
            font-weight: 400;
        }
        .btn-outline-white
        {
            border: 1px solid #fff;
            border-radius: 0;
            color: #fff;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 500;
            padding: 8px 20px;
            transition: all .5s;
        }
        .btn-outline-white:hover
        {
            border: 1px solid #fff;
            background: #fff;;

        }
        .card-thumbnail
        {
            width: 100%;
            height: 250px;
        }
        .card-thumbnail img
        {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .gray-btn {
            border: 1px solid #0e0a57;
            color: #0e0a57;
            transition: all .5s;
        }
        .gray-btn:hover {
            border: 1px solid #0e0a57;
            background: #0e0a57;
            color: #fff;
        }
        .single-blog h4
        {
            font-weight: 500;
            font-size: 23px;
        }
        .page-link {
            font-size: 12px;
            font-weight: 400;
            color: #827e7e;
            padding: 10px 20px;
            border-radius: 0 !important;
            transition: all .5s;
        }
        .page-link:hover {
            z-index: 2;
            color: #fff;
            text-decoration: none;
            background-color: #0e0a57;
            border-color: #0e0a57;

        }

        @media (max-width: 767px)
        {
            .section-blog {
                padding: 50px;
            }
            .card-blog
            {
                height: auto;
            }
            .card-blog h1
            {
                font-size:22px;
            }
            .small, small {
                font-size: 77%;
                font-weight: 400;
            }
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
    padding: 0px;
    border-bottom: 1px solid #ccc;
    margin-bottom:30px;
}
ul.meta-wrape {
    padding: 0px;
    margin: 0px;
}
.card-body h4 {
    font-size: 20px;
    line-height: 32px;
    font-weight: 400;
    color: #000000;
}
.card-body ul li {
    display: inline-block;
    margin-bottom: 10px;
    padding: 0px 1px;
    font-size:10px;
    font-weight:600;
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
.pagination-body {
    margin-top: 45px;
    display: flex;
    justify-content: center;
}
ul.pagination li.page-item a.page-link {
    text-decoration: none;
    color: #000;
}
.pagination a:hover {
    color: #000 !important;
    background:transparent;
}
ul.pagination li:first-child, ul.pagination li:last-child, ul.pagination li:nth-last-child(2), ul.pagination li:nth-child(2) {
    padding: 2px;
    background: rgb(16,10,87) /*rgb(43, 64, 93)*/ !important;
    border: 1px solid#000000;
}
ul.pagination li:nth-last-child(2), ul.pagination li:nth-child(2) {
    margin-right: 10px;
    margin-left: 5px;
}
ul.pagination li a {
    color: #fff;
    padding: 4px 6px;
    text-decoration: none;
}
ul.pagination li a:hover{
    color:#0000;
}
ul.pagination li {
    background: #000;
    margin: 0px 4px;
    padding-left: 10px;
    padding-right: 10px;
}
}
ul.pagination li.active {
    background: rgb(16,10,87) /*rgb(43, 64, 93)*/ !important;
}
.resonsive-img-sec{
    height: 100%;
    padding: 10px 0px 30px 0px;
}
.resonsive-img-sec img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
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
        padding:0px;
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
    ul.pagination li a {
        color: #fff;
        padding: 4px 8px;
        text-decoration: none;
    }
    ul.pagination li:first-child, ul.pagination li:last-child {
    display: none;
}

}


ul.pagination li {
    margin: 0px 3px !important;
    padding: unset !important;
    background: rgb(16,10,87) !important;
    border: 0px solid transparent !important;
    transition: 0.5s ease;
}
ul.pagination li :hover{
    color: #ffffff !important;
    background: rgb(27 16 161) !important;
}
ul.pagination li.active{
    background: rgb(27 16 161) !important;
}
ul.pagination li a {
    padding: 4px 10px !important;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}
ul.categories li.active {
    background: #ccc;
}

</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
         <div class="text-logo brand-text text-center">
          <h4 class="brand-title">THE CLOUD CISO</h4>
          <p class="tag-line"> Technology &amp; Cybersecurity  </p>
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
                 <?php if(count($articles) > 0){ ?>
                    <?php foreach ($articles as $key=>$article){
                        $cat =  $article->category->name;
                        echo $cat;
                    break;
                     }} ?>
                 </h1>
                 <h5>Category</h5>
            </div>
        </div>
    </div>
  </header>
  <?php if(count($articles) > 0){ ?>

    <div class="Blog-section">
         <div class="container">
            <div class="row">
               <div class=" col-lg-8 col-md-12 image-style">
                  <div class="row">
                  <?php foreach ($articles as $key=>$article){ ?>
                     <div class="col-md-4 col-sm-12">
                         <div class="resonsive-img-sec">
                     <?php if(!empty($article->image)) {?>
                        <img src="<?= $article->image ?>" class="img-fluid" alt="Responsive image">
                     <?php } ?>
                     </div>
                     </div>
                     <div class="col-md-8 col-sm-12 ">
                        <div class="card-body">
                        <h4><?= $article->title ?></h4>
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
                         <?php $smallContent = substr(strip_tags($article->content), 0, 50); ?>
                        <p><?= $smallContent ."..." ?></p>
                        <p>
                        <?= $this->Html->link(__('Read More'), ['action' => 'blog-detail', $article->slug],['class'=>' btn-custom']) ?>
                        <span class="btn--icon-style"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                        </p>
                     </div>
                     </div>
                  <?php }?>

                  </div>
               </div>
               <div class="col-lg-4 col-md-12 col-sm-12 sidebar">
                  <!-- <div class="row">
                     <div class="col-md-12">
                        <div class="sidebar-box-categories">
                            <h3 class="sidebar-heading-categories"><i class="fa fa-tags" aria-hidden="true"></i> Categories</h3>
                            <ul class="categories">
                            <?php foreach($categories as $category){
                                if($cat == $category->name){
                                    $sclass = 'active';
                                }else{
                                    $sclass = '';
                                }
                                ?>
                                <a href="#"><li class = <?= !empty($sclass) ? $sclass: '' ?>><?= $category->name ?></a></li>
                                        <?php } ?>
                            </ul>
                         </div>
                     </div>
                  </div> -->
                  <?php echo $this->element('blog-categories', array('cat' => $cat)); ?>
               </div>
            </div>

            <?php if($this->Paginator->counter('{{pages}}') > 1) {?>
            <div class="row">
               <div class="col-12 pagination-body">
                  <nav aria-label="Page navigation example">
                     <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('First')) ?>
                        <?= $this->Paginator->prev('< ' . __('Prev')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('Next') . ' >') ?>
                        <?= $this->Paginator->last(__('Last') . ' >>') ?>
                    </ul>
                </nav>
               </div>
            </div>
        <?php }?>
         </div>
      </div>
                <?php } else { ?>
                    <section>
                    <h3 class="text-center">No Record Found </h3>
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
                    </section>
                <?php } ?>
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


