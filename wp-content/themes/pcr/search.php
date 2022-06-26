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
<!-- <div class="grey-line mt-3"></div> -->

<main id="site-content" role="main">

    <div class="container">


        <?php
             echo get_template_part( 'nav','article-top' ); 
        ?>



        <h2>搜尋<?php if($_POST['search-txt']){?>..."<?php echo $_POST['search-txt'];?>"<?php }?></h2>
        <div class="h2-line mt-1"></div>

        <div class="container mt-3 g-0">



            <div class="d-flex flex-wrap">


                <?php
                                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                                    
            // echo $_POST['cat'];
            $args = array (
                's' => (!empty($_POST['search-txt'])?$_POST['search-txt']:''),
                'post_type' => 'post',
                'post_status' =>'publish',
                // 'cat' => $_POST['cat'],
                // 'posts_per_page' => 2,
                'paged' => $paged
               );
                // 'order' =>(!empty($_GET["order"])?$_GET["order"]:'DSCE')); 
        
            if(!empty($_POST['month']))
            {$args['monthnum']=$_POST['month'];}

            if(!empty($_POST['cat']))
            {$args['cat']=$_POST['cat'];}
        
            if(!empty($_POST['year']))
            {$args['year']=$_POST['year'];}
 
            // if(!empty($tag_id))
            // {$args['tag_id']=$tag_id;}
            // echo $get_query_var["year"];
            // if(!empty($_GET["orderby"]))
            // {$args['orderby']=$_GET["orderby"];} 
        
            $query = new WP_Query( 
                $args
             );
            
             while ( $query->have_posts() ) {
                $query->the_post();
                // echo get_the_ID();
                ?>
                <a href="<?php echo get_permalink(get_the_ID());?>" class=" category-bottom-article-block-a ">

                    <?php $img_id= get_field('small_banner');
                            $arr= wp_get_attachment_image_src($img_id, 'full');
                            ?>

                    <img class="index-slide-banner-img" src="<?php echo $arr[0];?>" alt="">

                    <div class="p-3">
                        <div><?php echo get_the_title();?></div>

                        <div class="mt-3"><?php echo get_field('short_content');?></div>
                        <div class="article-date-time-div mt-5"><img class="timer-icon"
                                src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>" alt="">
                            <?php echo get_the_date('M d, Y')?>
                        </div>
                    </div>

                    <?php //print_r(get_the_category());?>
                    <div class="cate-name" href="#">
                        <?php echo get_cat_name($_POST['cat']);  //echo get_the_category()[0]->name;?>
                    </div>
                </a>

                <?php
            }
            
        
        ?>

            </div>

            <div class="text-center">

                <!-- <img src="<?php echo get_template_directory_uri() .'/assets/images/fake-pagingation.jpg'?>" alt=""> -->


                <div class="cate-pagination">
                    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( '<', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( '>', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
                </div>


            </div>



        </div>



    </div>
</main>

<script type="text/javascript">
$(function() {





    var year = <?php echo $_POST['year'] ?  $_POST['year'] : -1; ?>;
    var month = <?php echo $_POST['month'] ?  $_POST['month'] : -1; ?>;
    var cat = <?php echo $_POST['cat'] ?  $_POST['cat'] : -1; ?>;


    // alert(year);
    if (year && year != -1) {
        $('select#year option[value="' + year + '"]').attr('selected', 'selected');
        localStorage.setItem('year', $('#year').val());
    } else {
        year = localStorage.getItem('year');
        $('select#year option[value="' + year + '"]').attr('selected', 'selected');

    }


    if (month && month != -1) {
        $('select#month option[value="' + month + '"]').attr('selected', 'selected');
        localStorage.setItem('month', $('#month').val());

    } else {
        month = localStorage.getItem('month');
        $('select#month option[value="' + month + '"]').attr('selected', 'selected');

    }
    if (cat && cat != -1) {
        $('select#cat option[value="' + cat + '"]').attr('selected', 'selected');
        localStorage.setItem('cat', $('#cat').val());
    } else {
        cat = localStorage.getItem('cat');
        $('select#cat option[value="' + cat + '"]').attr('selected', 'selected');


    }



    // if (localStorage.getItem('month') != 0) {
    //     $('select option[value="' + year + '"]').attr('selected', 'selected');

    // }




    // localStorage.setItem('cat', $('#cat').val());



    // $('select#cat option[value="' + localStorage.getItem('cat') + '"]').attr('selected', 'selected');



})
</script><?php
get_footer();