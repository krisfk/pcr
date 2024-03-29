<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<!-- test -->
<!-- <div class="grey-line mt-3"></div> -->

<main id="site-content" role="main">


    <!-- <div class="container"> -->
    <div class="slider-container position-relative mt-3">
        <div class="position-absolute w-100 h-100">

            <div class="slide-middle-div">
                <a href="javascript:void(0);" class="slide-show-arrow slide-show-left-arrow">
                    <img class=""
                        src="<?php echo get_template_directory_uri() .'/assets/images/banner-left-arrow.png'?>" alt="">
                </a>

                <a href="javascript:void(0);" class="slide-show-arrow slide-show-right-arrow">
                    <img class=""
                        src="<?php echo get_template_directory_uri() .'/assets/images/banner-right-arrow.png'?>" alt="">
                </a>

            </div>
        </div>
        <div class="slider">

            <?php
            
              query_posts("page_id=174");
              while ( have_posts() ) { 
                  the_post();
                  
                  if( have_rows('banners') ):
                    while ( have_rows('banners') ) : the_row();
                
                            $img_id= get_sub_field('banner');
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

            <a href="<?php echo get_sub_field('banner_link'); ?>" class="index-slide-banner-a"> <img
                    class="index-slide-banner-img" src="<?php echo $arr[0];?>" alt="">

                <div class="banner-title"><?php echo get_sub_field('banner_title');?>
                </div>
            </a>
            <?php
                            // echo $arr[0];
                        // $sub_value = get_sub_field('sub_field');
                        // Do something...
                    endwhile;
                else :
                    // no rows found
                endif;
                
              }
              wp_reset_query();



                   
                    ?>
            <!-- <a href="#" class="index-slide-banner-a"> <img class="index-slide-banner-img"
                    src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-banner.jpg'?>" alt="">

                <div class="banner-title">美國最新研究：將「繪本閱讀」跟「畫畫活動」結合 有效提升孩子「空間感」與「創造力」
                </div>
            </a><a href="#" class="index-slide-banner-a"> <img class="index-slide-banner-img"
                    src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-banner.jpg'?>" alt="">

                <div class="banner-title">美國最新研究：將「繪本閱讀」跟「畫畫活動」結合 有效提升孩子「空間感」與「創造力」
                </div>
            </a><a href="#" class="index-slide-banner-a"> <img class="index-slide-banner-img"
                    src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-banner.jpg'?>" alt="">

                <div class="banner-title">美國最新研究：將「繪本閱讀」跟「畫畫活動」結合 有效提升孩子「空間感」與「創造力」
                </div>
            </a><a href="#" class="index-slide-banner-a"> <img class="index-slide-banner-img"
                    src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-banner.jpg'?>" alt="">
            </a><a href="#" class="index-slide-banner-a"> <img class="index-slide-banner-img"
                    src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-banner.jpg'?>" alt="">

                <div class="banner-title">美國最新研究：將「繪本閱讀」跟「畫畫活動」結合 有效提升孩子「空間感」與「創造力」
                </div>
            </a> -->
        </div>
    </div>

    <div class="container  mt-4">

        <div class="row">

            <div class="col-lg-8 col-md-12 col-sm-12 col-12">

                <div class="article-list-block" id="article-list-block-1">

                    <div class="mb-3">
                        <h2>資訊</h2>

                        <!-- <ul class="article-list-submenu-ul">
                            <li><a href="" class="active"> 繪本預告</a></li>
                            <li><a href="">小小華佗展覽</a></li>
                        </ul> -->
                        <div class="mt-1">
                            <div class="h2-line"></div>
                        </div>

                    </div>

                    <?php
                    
                    global $post;
                    $args = array( 'numberposts' => 20, 'category_name' => 'information' );
                    $posts = get_posts( $args );
                    $num_of_page_1 = ceil(sizeof($posts)/4); 
                    for($i=0;$i<$num_of_page_1;$i++)
                    {
                        ?>
                    <div class="page-div-1 page-div">
                        <div class="row  g-0">

                            <?php
                        if($posts[$i*4]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>

                            <?php
                        if($posts[$i*4+1]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4+1]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4+1]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4+1]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4+1]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>

                        </div>

                        <div class="row  g-0">

                            <?php
                        if($posts[$i*4+2]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4+2]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4+2]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4+2]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4+2]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>

                            <?php
                        if($posts[$i*4+3]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4+3]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4+3]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4+3]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4+3]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }
                        else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>


                        </div>

                    </div>

                    <?php
                    }
                    ?>


                    <div class="row">

                        <div class="col-12 text-center">

                            <?php //echo $num_of_page_1;?>

                            <ul class="pagination pagination-1">
                                <li>
                                    <a href="#article-list-block-1" class="arrow prev-arrow">
                                        < </a>
                                </li>

                                <?php
                                for($i=1;$i<=$num_of_page_1;$i++)
                                {
                                    if($i==1)
                                    { 
                                        echo '<li> <a class="active page-num" href="#article-list-block-1">'.$i.'</a></li>';
                                    }
                                    else
                                    {
                                        echo '<li> <a class="page-num" href="#article-list-block-1">'.$i.'</a></li>';
                                    }
                                }
                                ?>


                                <li>
                                    <a href="#article-list-block-1" class="arrow next-arrow">
                                        > </a>
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="shadow-div"></div>

                </div>


                <div class="article-list-block mt-5" id="article-list-block-2">

                    <div class="mb-3">
                        <h2>視像</h2>
                        <!-- <ul class="article-list-submenu-ul">
                            <li><a href="" class="active"> 故事姐姐</a></li>
                            <li><a href="">醫師健康</a></li>
                        </ul> -->
                        <div class="mt-1">
                            <div class="h2-line"></div>
                        </div>
                    </div>

                    <?php
                    
                    global $post;
                    $args = array( 'numberposts' => 20, 'category_name' => 'visual' );
                    $posts = get_posts( $args );
                    
                    $num_of_page_2 = ceil(sizeof($posts)/4); 
                    for($i=0;$i<$num_of_page_2;$i++)
                    {
                        ?>
                    <div class="page-div-2 page-div">
                        <div class="row  g-0">

                            <?php
                        if($posts[$i*4]->ID)
                        {?>
                            <?php
                        // echo $posts[$i*4]->ID.' '.$posts[$i*4+1]->ID.' '.$posts[$i*4+2]->ID.' '.$posts[$i*4+3]->ID.' ';
                        ?>
                            <a href="<?php echo get_permalink($posts[$i*4]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>

                            <?php
                        if($posts[$i*4+1]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4+1]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4+1]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4+1]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4+1]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>

                        </div>

                        <div class="row  g-0">

                            <?php
                        if($posts[$i*4+2]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4+2]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4+2]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4+2]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4+2]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>

                            <?php
                        if($posts[$i*4+3]->ID)
                        {?>
                            <a href="<?php echo get_permalink($posts[$i*4+3]->ID)?>"
                                class="col-lg col-md-12 col-sm-12 col-12 home-bottom-article-block-a">
                                <?php $img_id= get_field('small_banner',$posts[$i*4+3]->ID);
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                                <img class="index-slide-banner-img" src="<?php echo $arr[0]; ?>">
                                <div class=" p-3">
                                    <div><?php echo get_field('short_content',$posts[$i*4+3]->ID);?></div>
                                    <div class="article-date-time-div mt-3"><img class="timer-icon"
                                            src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>"
                                            alt="">
                                        <?php echo get_the_date('M d, Y',$posts[$i*4+3]->ID)?>
                                    </div>
                                </div>
                            </a>
                            <?php }
                        else
                        {
                            echo '<div class="col-lg col-md-12 col-sm-12 col-12 "></div>';
                        }?>


                        </div>

                    </div>

                    <?php
                    }
                    ?>

                    <div class="row">

                        <div class="col-12 text-center">



                            <ul class="pagination pagination-2">
                                <li>
                                    <a href="#article-list-block-2" class="arrow prev-arrow">
                                        < </a>
                                </li>

                                <?php
                                for($i=1;$i<=$num_of_page_1;$i++)
                                {
                                    if($i==1)
                                    { 
                                        echo '<li> <a class="active page-num" href="#article-list-block-2">'.$i.'</a></li>';
                                    }
                                    else
                                    {
                                        echo '<li> <a class="page-num" href="#article-list-block-2">'.$i.'</a></li>';
                                    }
                                }
                                ?>


                                <li>
                                    <a href="#article-list-block-2" class="arrow next-arrow">
                                        > </a>
                                </li>
                            </ul>


                        </div>
                    </div>

                    <div class="shadow-div"></div>

                </div>


            </div>


            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">

                <div class="home-right-div">

                    <h2>PCR 會員</h2> <a class="sub-menu-a" href="#"> 新會員註冊</a>
                    <div class="h2-line mt-1"></div>
                    <div class="mt-3 form-div">

                        <input type="text" class="form-control form-text-input" placeholder="電郵">
                        <input type="password" class="form-control  form-text-input" placeholder="密碼">
                        <button type="submit" class="float-end btn   form-submit-btn">登入</button>


                    </div>


                </div>
                <div class="home-right-div mt-5">

                    <h2>最新活動報名</h2> <a class="sub-menu-a" href="#"> 更多活動</a>
                    <div class="h2-line mt-1"></div>


                    <div class="slide2 mt-3">

                        <a href="#">
                            <img src="<?php echo get_template_directory_uri() .'/assets/images/temp-event-banner.jpg'?>"
                                alt="">
                        </a>
                        <a href="#">

                            <img src="<?php echo get_template_directory_uri() .'/assets/images/temp-event-banner.jpg'?>"
                                alt=""></a>
                        <a href="#">

                            <img src="<?php echo get_template_directory_uri() .'/assets/images/temp-event-banner.jpg'?>"
                                alt=""></a>
                        <a href="#">

                            <img src="<?php echo get_template_directory_uri() .'/assets/images/temp-event-banner.jpg'?>"
                                alt=""></a>
                        <a href="#">

                            <img src="<?php echo get_template_directory_uri() .'/assets/images/temp-event-banner.jpg'?>"
                                alt=""></a>

                    </div>

                </div>

                <div class="shadow-div-2"></div>


                <div class="home-right-div mt-1">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/nSjD2sgxR2U"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

                </div>

            </div>

        </div>
    </div>
    <!-- </div> -->

</main>

<script type="text/javascript">
// $('.slider').slick({
//     centerMode: true,
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     dots: true,
//     infinite: true,
//     cssEase: 'linear'
// });

$(function() {


    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        centerMode: true,
        variableWidth: true,
        dotsClass: 'slider-dots',
        arrows: false
    });

    $('.slide-show-right-arrow').click(function() {
        $('.slider').slick('slickNext');
    });
    $('.slide-show-left-arrow').click(function() {
        $('.slider').slick('slickPrev');


    });

    $('.slide2').slick({
        slidesToShow: 1,
        dots: true,
        arrows: false
    });


    var blk_1_current_page = 1;
    var blk_2_current_page = 1;

    update_slide_1(blk_1_current_page);
    update_slide_2(blk_2_current_page);

    $('.pagination-1 .arrow.prev-arrow').click(function() {

        if (blk_1_current_page > 1) {
            blk_1_current_page--;
            update_slide_1(blk_1_current_page);
        }
    });
    $('.pagination-1 .arrow.next-arrow').click(function() {
        if (blk_1_current_page < <?php echo $num_of_page_1;?>) {
            blk_1_current_page++;
            update_slide_1(blk_1_current_page);

        }
    });

    $('.pagination-1 a.page-num').click(function() {
        var turn_page = $(this).html();
        blk_1_current_page = turn_page;

        update_slide_1(turn_page);

    });




    $('.pagination-2 .arrow.prev-arrow').click(function() {

        if (blk_2_current_page > 1) {
            blk_2_current_page--;
            update_slide_2(blk_2_current_page);
        }
    });
    $('.pagination-2 .arrow.next-arrow').click(function() {
        if (blk_2_current_page < <?php echo $num_of_page_2;?>) {
            blk_2_current_page++;
            update_slide_2(blk_2_current_page);

        }
    });

    $('.pagination-2 a.page-num').click(function() {
        var turn_page = $(this).html();
        blk_2_current_page = turn_page;

        update_slide_2(turn_page);

    });




    function update_slide_1(page) {
        $('.page-div-1').fadeOut(0);
        $('.page-div-1').eq(page - 1).fadeIn(0);
        $('.pagination-1 a').removeClass('active');
        $('.pagination-1 a').eq(page).addClass('active');
        console.log(blk_1_current_page);
    }

    function update_slide_2(page) {
        $('.page-div-2').fadeOut(0);
        $('.page-div-2').eq(page - 1).fadeIn(0);
        $('.pagination-2 a').removeClass('active');
        $('.pagination-2 a').eq(page).addClass('active');

    }





})
</script>

<?php
get_footer();