<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laxmi Consultancy</title>
    <meta name="description" content="">
    
    <!-- CSS FILES -->
    <link rel="stylesheet" href="css1/bootstrap.min.css"/>
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="css1/animate.css" data-name="layout">

    <link rel="stylesheet" type="text/css" href="css1/style.css" media="screen" data-name="skins">
    <link rel="stylesheet" href="css1/layout/wide.css" data-name="layout">

    <link rel="stylesheet" href="css1/fractionslider.css"/>
    <link rel="stylesheet" href="css1/style-fraction.css"/>

    <link rel="stylesheet" type="text/css" href="css1/switcher.css" media="screen" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!--Start Header-->
    <header id="header" class="clearfix">
        <div id="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 hidden-xs top-info">
                        <span><i class="fa fa-phone"></i>Phone: (123) 456-7890</span>
                        <span><i class="fa fa-envelope"></i>Email: mail@example.com</span>
                    </div>
                    <div class="col-sm-5 top-info">
                        <ul>
                            <li><a href="" class="my-tweet"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="" class="my-facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="" class="my-skype"><i class="fa fa-skype"></i></a></li>
                            <li><a href="" class="my-pint"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="" class="my-rss"><i class="fa fa-rss"></i></a></li>
                            <li><a href="" class="my-google"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGO bar -->
       <div id="logo-bar" class="clearfix">
           <!-- Container -->
           <div class="container">
               <div class="row">
                   <!-- Logo / Mobile Menu -->
                   <div class="col-xs-12">
                       <div id="logo">
                           <h1><a href="index.php"><img src="images/logo1.png" alt="Eve" /></a></h1>
                       </div>
                   </div>
               </div>
           </div>
           <!-- Container / End -->
       </div>
        <!--LOGO bar / End-->

        <!-- Navigation
================================================== -->
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>

                            <li><a href="#">Shortcodes</a>
                                <ul class="dropdown-menu">
                                    <li><a href="elements.html">Elements</a></li>
                                    <li><a href="columns.html">Columns</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                    <li><a href="pricing-tables.html">Pricing Tables</a></li>
                                    <li><a href="icons.html">Icons</a></li>
                                </ul>
                            </li>

                            <li><a href="about.php">About Us</a></li>

                            <li><a href="contact.php">Contact Us</a></li>

        <?php
       if (empty($_SESSION['username']))
            { 
            echo '<li><a href="login.php">Login</a></li>';
            }
            else 
            {
            echo '<li><a href="logout.php">Logout</a></li>';
            }   
        ?>
                        </ul>
                    </div>
                </div><!--/.row -->
            </div><!--/.container -->
        </div>
    </header>
    <!--End Header-->
