<!DOCTYPE html lang="en-US">
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>News Blog</title>

    <link rel='stylesheet' id='reset-css' href='/templates/css/reset.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='superfish-css' href='/templates/css/superfish.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='fontawsome-css' href='/templates/css/font-awsome/css/font-awesome.css' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='orbit-css-css' href='/templates/css/orbit.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='style-css' href='/templates/css/style.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='color-scheme-css' href='/templates/css/color/green.css' type='text/css' media='all'/>
    <link rel="stylesheet" href="/templates/css/zerogrid.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/templates/css/responsive.css" type="text/css" media="screen">
    <script type='text/javascript' src='/templates/js/jquery.js'></script>
    <script type='text/javascript' src='/templates/js/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='/templates/js/jquery-1.10.2.min.js'></script>
    <script type='text/javascript' src='/templates/js/jquery.carouFredSel-6.2.1-packed.js'></script>
    <script type='text/javascript' src='/templates/js/hoverIntent.js'></script>
    <script type='text/javascript' src='/templates/js/superfish.js'></script>
    <script type='text/javascript' src='/templates/js/orbit.min.js'></script>
    <script src="/templates/js/css3-mediaqueries.js"></script>
    <script type="text/javascript" language="javascript">
        $(function () {

            /* Start Carousel */
            $('#featured-posts').carouFredSel({
                auto: true,
                prev: '#prev2',
                next: '#next2',
            });
            /* End Carousel */


            /* Start Orbit Slider */
            $(window).load(function () {
                $('.post-gallery').orbit({
                    animation: 'fade',
                });
            });
            /* End Orbit Slider */


            /* Start Super fish */
            jQuery(document).ready(function () {
                jQuery('ul.sf-menu').superfish({
                    delay: 100,
                    speed: 'fast',
                    speedOut: 'fast',
                });
            });
            /* End Of Super fish */

        });
    </script>
</head>

<body class="home blog">

<!-- Start Header -->
<div class="container zerogrid">
    <div class="col-full">
        <div class="wrap-col">
            <div id="header-nav-container">

                <a href="/">
                    <img src="/templates/images/logo.png" id="logo" width="150" height="50"/>
                </a>

                <!-- Navigation Menu -->

                <ul class="sf-menu">
                    <li class="menu-item current-menu-item"><a href="/">Главная</a></li>
                    <li class="menu-item"><a href="/">Категории</a>
                        <ul class="sub-menu">
                            {% for category in categories %}
                            <li class="menu-item"><a
                                    href="category?id={{ category.id }}">{{ category.name }}</a>
                            </li>
                            {% endfor %}
                        </ul>
                    </li>
                    <li class="menu-item"><a href="/about">О нас</a></li>
                </ul>
                <!-- End Navigation Menu -->

                <div class="clear"></div>

            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="spacing-30"></div>
<!-- End Header -->