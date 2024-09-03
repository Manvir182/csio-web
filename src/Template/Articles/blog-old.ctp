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
                 	Blog
                 </h1>
            </div>
        </div>
    </div>
  </header>
  <?php if(count($articles) > 0){ ?>
    <section class="pt-5 pb-2">
        <div class="container">
            <div class="card card-blog rounded-0 mt-4">
                <div class="card-body p-0 p-md-4">
                    <div class="row">
                            <div class="col-lg-7">
                                <h1><?= $firstArticle->title ?></h1>
                                <small class="mr-2"> <em class="fa fa-th-large mr-2"></em> <?= $firstArticle->category->name ?></small>|
                                <small class="ml-1 mr-2"> <em class="fa fa-calendar mr-2"></em> <?= Date('Y-m-d',strtotime($firstArticle->created)); ?></small>|
                                <small class="ml-1"> <em class="fa fa-user mr-2"></em> <?= $firstArticle->author->name ?></small>
                                <?php $smallContent = substr($firstArticle->content, 0, 50); ?>
                                <p class="mt-3" ><?= $smallContent ."..." ?></p>
                                <?= $this->Html->link(__('Read More'), ['_name'=>'blog-detail', $firstArticle->slug],['escape'=>false,'class'=>'btn btn-outline-white mt-3 ']) ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" mb-0 p-2">
        <div class="container">
            <div class="row">
                <?php foreach ($articles as $key=>$article){
                    if($key == 0){ continue; }?>
                    <div class="col-lg-4 mt-5">
                        <div class="card rounded-0 single-blog">
                            <div class="card-header p-0">
                                <div class="card-thumbnail">
                                    <img src="<?= $article->image ?>">
                                </div>
                            </div>
                            <div class="card-body ">
                                <small class="mr-2"> <em class="fa fa-th-large mr-2"></em> <?= $article->category->name ?></small>|
                                <small class="ml-1 mr-2"> <em class="fa fa-calendar mr-2"></em> <?= Date('Y-m-d',strtotime($article->created)); ?></small>|
                                <small class="ml-1"> <em class="fa fa-user mr-2"></em> <?= $article->author->name ?></small>
                                <h4 class="mt-3"><?= $article->title ?></h4>
                                <?php $smallContent = substr($article->content, 0, 50); ?>
                                <p class="mt-3" ><?= $smallContent ."..." ?></p>
                                <?= $this->Html->link(__('Read More'), ['action' => 'blog-detail', $article->slug],['escape'=>false,'class'=>' btn btn-outline-white mt-3 gray-btn']) ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="paginator">
            <ul class="pagination ">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
            <div class="row mt-5">
                <div class="col-12 ">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                          <li class="page-item ">
                            <span class="page-link">OLDER</span>
                          </li>
                          <li class="page-item ">
                            <a class="page-link" href="#">Next</a>
                          </li>
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </section>
                <?php } else { ?>
                    <section>
                    <h3 class="text-center">No Record Found </h3>
                    </section>
                <?php } ?>
</body>
</html>


