<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

session_start();     
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>

    <?php 
    if($_SESSION['user_id'])
    {
        ?>

    <script type="text/javascript">
    $(function() {
        $('.top-menu-ul li.member').css({
            'display': 'inline-block'
        });
    });
    </script>
    <?php

    }?>

</head>

<body <?php body_class(); ?>>




    <?php
		wp_body_open();
		?>

    <button class="mobile-menu-btn"
        onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))"
        aria-label="Main Menu">
        <svg width="50" height="50" viewBox="0 0 100 100">
            <path class="line line1"
                d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
            <path class="line line2" d="M 20,50 H 80" />
            <path class="line line3"
                d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
        </svg>
    </button>


    <a href="javascript:void(0);" class="close-btn-a" style="display: inline;"></a>

    <header id="site-header" class="header-footer-group" role="banner">

        <div class="container text-center">

            <a href="<?php echo get_site_url();?>" class="mt-3 d-inline-block"><img class="logo"
                    src="<?php echo get_template_directory_uri() .'/assets/images/logo.png'?>" alt=""></a>


            <ul class="top-menu-ul mt-3">

                <?php
        
        $main_menu = wp_get_menu_array('main menu');
        // print_r($menu_item);

        foreach ($main_menu as $menu_item) {


$url = $menu_item['url'];
$title = $menu_item['title'];
$temp_arr=explode(get_site_url(),$url);
$slug=str_replace('/en/','',$temp_arr[1]);
$slug=str_replace('/cn/','',$slug);
$slug=str_replace('/','',$slug);
// $slug=str_replace('.','',$slug);


global $post;
$post_slug = $post->post_name;
// echo $post_slug;
if(count($menu_item['children']))
{
   
    echo '<li><a class="level-1';
 
    if(is_page())
    {
        echo $post_slug == $slug ? ' active ' : '';
    }

    if(is_archive())
    {
        $term = get_queried_object();
        echo $term->slug == $slug ? ' active ' : '';    
    }


    echo' parent '.$slug.'" href="'.$url.'">'.$title.'</a>';

 
    echo '<ul class="menu-submenu">';
    foreach ($menu_item['children'] as $sub_menu_item) 
    {
        $sub_url = $sub_menu_item['url'];
        $sub_title = $sub_menu_item['title'];
        $sub_temp_arr=explode(get_site_url(),$sub_url);
        $sub_slug=str_replace('/en/','',$sub_temp_arr[1]);
        $sub_slug=str_replace('/cn/','',$sub_slug);
        $sub_slug=str_replace('/',' ',$sub_slug);
        // $sub_slug=str_replace('.','',$sub_slug);
        echo'<li><a class="';
            
      

        echo' '.$sub_slug.'" href="'.$sub_url.'">'.$sub_title.'</a></li>';
    }
    echo '</ul>';

}
else
{
echo '<li class="'.$slug.'"><a class="';

echo 'level-1 ';

if(is_archive())
{
    $term = get_queried_object();
    echo $term->slug == $slug ? ' active ' : '';

   
}



echo $slug.'" href="'.$url.'">'.$title.'</a>';

}
echo'</li>';


}


?>
            </ul>

            <?php
if($_SESSION['user_id'])
{
    $account_name = get_field('account_name', $_SESSION['user_id']);
    ?>
            <div class="mt-3">你好～<?php echo $account_name;?>!
                <a class="logined-a" rel="member" href="<?php echo get_site_url();?>/member/">個人資料</a>
                <a class="logined-a" rel="member-only" href="<?php echo get_site_url();?>/member-only/">會員專區</a>
                <a class="logined-a" rel="inbox" href="<?php echo get_site_url();?>/inbox/">收件箱</a>
                <a class="logined-a" rel="bookmark" href="<?php echo get_site_url();?>/bookmark/">我的喜愛</a>

                <a class="logined-a" rel="logout" href="<?php echo get_site_url();?>/logout/">登出</a>

            </div>

            <?php
}
else
{
    ?>
            <div class="mt-3">
                <!-- <a class="login-a" href="<?php echo get_site_url();?>/registration/"> 會員註冊</a> -->

                <a class="login-a" href="<?php echo get_site_url();?>/member-login/"> 會員登入</a>
                <!-- <a class="login-a" href="/forget-pw/"> 忘記密碼</a> -->
            </div>




            <?php
}
?>
        </div>

        <div>


        </div>
        <!-- 
        <script type="text/javascript"
            src="https://perspectivecr.org/wp-content/plugins/sassy-social-share/public/js/sassy-social-share-public.js">
        </script> -->
    </header>

    <div class="grey-line mt-3"></div>

    <script type="text/javascript">
    $(function() {



        $('.close-btn,.lightbox-bg-btn').click(function() {
            $('.lightbox').fadeOut(0);
        })


        $('.level-1').mouseenter(function() {

            $('.menu-submenu').fadeOut(0);
            $(this).next('.menu-submenu').fadeIn(0);
        })

        $('.menu-submenu').mouseleave(function() {

            $(this).fadeOut(0);

        })

        $('.slider-container,#site-content').mouseenter(function() {
            $('.menu-submenu').fadeOut(0);

        })


        // $('.close-btn-a').click(function() {

        //     $('.top-menu-ul').fadeOut(0);
        //     $(this).fadeOut(0);

        // })

        $('.mobile-menu-btn').click(function() {

            if ($(this).hasClass('opened')) {

                $('.top-menu-ul').fadeIn(200);
            } else {
                $('.top-menu-ul').fadeOut(0);

            }
        })


    })
    </script>

    <?php 
if ( is_page() && $post->post_parent > 0 ) { 
    ?>
    <script type="text/javascript">
    $(function() {
        $('.<?php echo $post_slug; ?>').closest('.menu-submenu').prev('a').addClass('active');

    })
    </script>
    <?php
    // echo $post_slug;
}

?>

    <?php 
    if(is_subcategory() )
    {
       
        $term = get_queried_object();
    ?>
    <script type="text/javascript">
    $(function() {
        $('.<?php echo $term->slug; ?>').closest('.menu-submenu').prev('a').addClass('active');

    })
    </script>
    <?php

    // $('.learn-chinese').closest('.menu-submenu').prev('a').addClass('active') 
   
}

    ?>

    <?php
		// Output the menu modal.
		// get_template_part( 'template-parts/modal-menu' );