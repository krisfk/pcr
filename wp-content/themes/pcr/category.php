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

$term = get_queried_object();

$current_slug=$term->slug;

?>


<main id="site-content" role="main">

    <div class="container">


        <?php
             echo get_template_part( 'nav','article-top' ); 
        ?>



        <h2><?php single_cat_title();?></h2>
        <div class="h2-line mt-1"></div>

        <div class="container mt-3 g-0">


            <!-- <div class="row"> -->

            <div class="d-flex flex-wrap">



                <?php
              
                // Start the Loop.
                while ( have_posts() ) {
                    the_post();
                    ?>

                <a href="<?php echo get_permalink();?>" class=" category-bottom-article-block-a ">

                    <?php
                                
                                $img_id= get_field('small_banner');
                                $arr= wp_get_attachment_image_src($img_id, 'full');
                                ?>
                    <img class="index-slide-banner-img" src="<?php echo $arr[0];?>" alt="">

                    <div class="p-3">
                        <div><?php echo get_the_title();?></div>

                        <div class="mt-3"><?php echo  get_field('short_content');?></div>
                        <div class="article-date-time-div mt-5"><img class="timer-icon"
                                src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>" alt="">
                            <?php echo get_the_date('M d, Y');?>
                        </div>
                    </div>


                    <div class="cate-name" href="#">
                        <?php


                        ?>
                        <?php 


                        if( count(get_the_category( $id ))==1)
                        {
                            echo get_the_category( $id )[0]->name; 
                        }
                        else
                        {
                           
                            for($i=0;$i<count(get_the_category( $id ));$i++)
                            {
                                
                                echo (get_the_category( $id )[$i]->slug) !=$current_slug ? get_the_category( $id )[$i]->name :''; 
                            }
                        }
                        ?></div>
                </a>
                <?php
                }
                    ?>
                <!-- <a href="#" class=" category-bottom-article-block-a ">

                    <img class="index-slide-banner-img"
                        src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-small-banner.jpg'?>"
                        alt="">

                    <div class="p-3">
                        <div>美國亞利桑那州立大學生物學習網Ask a Biologist 開放數百種科普活動 培養孩子成為小小生物學家美國亞利桑那州立大學生物學習網</div>

                        <div class="mt-3">之前有跟大家介紹過KidsRead點讀筆所引進的全球暢銷4000萬冊、翻譯超過30種語言的英v
                            國兒童科學書《英文探索小百科第一輯：人類生活》(My First Discoveries - Human Life)，期待已久的第二輯《奇妙的動物》(Amazing
                            Animals)
                            點讀版終於出爐...</div>
                        <div class="article-date-time-div mt-5"><img class="timer-icon"
                                src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>" alt="">
                            May 18, 2018</div>
                    </div>


                    <div class="tag-name" href="#">繪本預告</div>
                </a>

                <a href="#" class=" category-bottom-article-block-a ">

                    <img class="index-slide-banner-img"
                        src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-small-banner.jpg'?>"
                        alt="">

                    <div class="p-3">
                        <div>美國亞利桑那州立大學生物學習網Ask a Biologist 開放數百種科普活動 培養孩子成為小小生物學家美國亞利桑那州立大學生物學習網</div>

                        <div class="mt-3">之前有跟大家介紹過KidsRead點讀筆所引進的全球暢銷4000萬冊、翻譯超過30種語言的英v
                            國兒童科學書《英文探索小百科第一輯：人類生活》(My First Discoveries - Human Life)，期待已久的第二輯《奇妙的動物》(Amazing
                            Animals)
                            點讀版終於出爐...</div>
                        <div class="article-date-time-div mt-5"><img class="timer-icon"
                                src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>" alt="">
                            May 18, 2018</div>
                    </div>


                    <div class="tag-name" href="#">繪本預告</div>
                </a> <a href="#" class=" category-bottom-article-block-a ">

                    <img class="index-slide-banner-img"
                        src="<?php echo get_template_directory_uri() .'/assets/images/temp-index-small-banner.jpg'?>"
                        alt="">

                    <div class="p-3">
                        <div>美國亞利桑那州立大學生物學習網Ask a Biologist 開放數百種科普活動 培養孩子成為小小生物學家美國亞利桑那州立大學生物學習網</div>

                        <div class="mt-3">之前有跟大家介紹過KidsRead點讀筆所引進的全球暢銷4000萬冊、翻譯超過30種語言的英v
                            國兒童科學書《英文探索小百科第一輯：人類生活》(My First Discoveries - Human Life)，期待已久的第二輯《奇妙的動物》(Amazing
                            Animals)
                            點讀版終於出爐...</div>
                        <div class="article-date-time-div mt-5"><img class="timer-icon"
                                src="<?php echo get_template_directory_uri() .'/assets/images/timer-icon.png'?>" alt="">
                            May 18, 2018</div>
                    </div>


                    <div class="tag-name" href="#">繪本預告</div>
                </a> -->


            </div>

            <div class="text-center cate-pagination">


                <?php
global $wp_query;
 
$big = 999999999; // need an unlikely integer
 
echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'prev_text'=>'<',
    'next_text'=>'>',

) );
?>
            </div>
            <!-- </div> -->



        </div>


        <!-- <div class="filter-form-group">
            <input type="text" class="form-control category-filter-input-text">

            <input type="submit" class="btn category-filter-submit-btn" value="">
        </div> -->
        <!-- <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div> -->
    </div>
</main>

<script type="text/javascript">
window.localStorage.clear();
</script>
<?php
get_footer();