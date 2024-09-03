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
      .section-blog
      {
          background:rgba(14, 10,87, 1);
          padding: 120px;
          color:#fff;
          font-family: MicroExtendFLF-Bold;
      }
      .card-blog
      {
          background-image:linear-gradient(to right, rgba(0, 0, 0, .8) 60%, rgba(0, 0, 0, 0)),url('1.jpg');
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
        .single-blog-full p {
                font-size: 13px;
                font-weight: 400;
                line-height: 30px;
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
        .card-thumbnail-full
        {
            width: 100%;
            height: 350px;
        }
        .card-thumbnail-full img
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
        .media-img
        {
            width: 70px;
            height: 70px;;
        }
        .media-img img
        {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .cat-list
        {
            margin:0;
            padding:0;
        }
        .cat-list
        {
            list-style:none;
            line-height: 40px;
            font-size: 13px;;
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
    <section class="mb-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-8">
                    <div class="card rounded-0 single-blog-full">
                        <div class="card-header p-0">
                            <div class="card-thumbnail-full">
                                <img src="<?= $article->image ?>">
                            </div>
                        </div>
                        <div class="card-body ">
                            <h4 class="mt-3"><?= $article->title ?></h4>
                            <small class="mr-2"> <em class="fa fa-th-large mr-2"></em> <?= $article->category->name ?></small>|
                            <small class="ml-1 mr-2"> <em class="fa fa-calendar mr-2"></em><?= $article->created ?></small>|
                            <small class="ml-1"> <em class="fa fa-user mr-2"></em><?= $article->author->name ?></small>
                            <p class="mt-4"><?= $article->content ?></p>
                        </div>
                    </div>
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
                <div class="col-lg-4 ">
                   <div class="row">
                       <div class="col-12">
                            <div class="card rounded-0 single-blog">
                                <div class="card-header bg-transparent">
                                    <h6 class="mt-2">Categories</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="cat-list">
                                        <?php foreach($categories as $category){ ?>
                                            <li><?= $category->name ?> </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                   <div class="row mt-2">
                    <div class="col-12">
                         <div class="card rounded-0 single-blog">
                             <div class="card-header bg-transparent">
                                 <h6 class="mt-2">Recent Posts</h6>
                             </div>
                             <div class="card-body">
                                <?php foreach($popularArticles as $popularArticle) {
                                    if($popularArticle->id != $article->id){?>
                                 <div class="media mt-4 pb-4 border-bottom">
                                     <div class="media-img mr-3 "><img src="<?= $popularArticle->image ?>" class="align-self-center mr-3 " alt="...">
                                     </div>
                                     <div class="media-body">
                                         <?= $this->Html->link(__($popularArticle->title), ['action' => 'blog-detail',$popularArticle->slug],['escape'=>false,]) ?>

                                             <div class="text-info">
                                                 <small class="mr-2"> <em class="fa fa-th-large mr-2"></em> <?= $popularArticle->category->name ?></small>|
                                                 <small class="ml-1 mr-2"> <em class="fa fa-calendar mr-2"></em> <?= Date('Y-m-d',strtotime($popularArticle->created)); ?></small>
                                             </div>
                                     </div>
                                 </div>
                                <?php } } ?>
                             </div>
                         </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </section>
</body>
</html>


