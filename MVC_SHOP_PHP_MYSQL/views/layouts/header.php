<!DOCTYPE html>
<html lang="ua">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Інтернет-магазин BEST-PC</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/prettyPhoto.css" rel="stylesheet">
        <link href="/template/css/price-range.css" rel="stylesheet">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <link href="/template/css/responsive.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="/template/images/icon/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/template/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/template/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/template/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/template/images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
        <div class="page-wrapper">
            <header id="header"><!--header-->
                <div class="header_top"><!--header_top-->
                    <div class="container">
                        <div class="row">
                           
                            <div class="col-sm-6">
                                <div class="contactinfo">
                                    <ul class="nav nav-pills">
                                        <li><a href="#"><i class="fa fa-phone"></i>  (098) 848-84-03</a></li>
                                        <li><a href="#"><i class="fa fa-envelope"></i> stashkiv77@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                         <li><a href="#"><i class="fa fa"></i>Ми в соцмережах:</a></li>
                                        <li><a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://www.google.com.ua" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header_top-->

                <div class="header-middle"><!--header-middle-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="logo pull-left">
                                    <a href="/"><img src="/template/images/home/logo_bg.png" alt="Інтернет-магазин BEST-PC"/></a>
                                </div>
                            </div>
                            
                            <div class="col-sm-8">
                                <div class="shop-menu pull-right">
                                    <ul class="nav navbar-nav">
                                       <li>
                                        <form class="searchform" name="search_p" method="post" action="/search">
	                                        <input type="search" name="search" value="<?php if(isset($srch)) {echo $srch;}?>" placeholder="Я шукаю..."/>
	                                       <button type="submit">Знайти</button>
                                           </form>
                                        </li>
                                        
                                        <li><a href="/cart">
                                                <i class="fa fa-shopping-cart"></i> Кошик 
                                                (<span id="cart-count"><?php echo Cart::countItems(); ?></span>)
                                            </a>
                                        </li>
                                        <?php if (User::isGuest()): ?>                                        
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i>Увійти в особистий кабінет</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-user"></i> Акаунт</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Вихід</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-middle-->

                <div class="header-bottom"><!--header-bottom-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="mainmenu pull-left">
                                    <ul class="nav navbar-nav collapse navbar-collapse">
                                        <li><a href="/">Головна</a></li>
                                        <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                            <ul role="menu" class="sub-menu">
                                                <li><a href="/catalog/">Каталог товарів</a></li>
                                                <li><a href="/cart/">Кошик</a></li> 
                                            </ul>
                                        </li>
                                        <li><a href="/about/">Про нас</a></li>
                                        <li><a href="/contacts/">Контакти</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-bottom-->

            </header><!--/header-->