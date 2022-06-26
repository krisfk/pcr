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

// echo 11;
if(!$_SESSION['user_id'])
{
    // echo 999;
    wp_redirect( get_site_url() );
    exit();

}

$term = get_queried_object();

$current_slug=$term->slug;

?>


<main id="site-content" role="main">

    <div class="container">


        <?php
             echo get_template_part( 'nav','article-top' ); 
        ?>



        <h2><?php echo get_the_title();?><?php //single_cat_title();?></h2>
        <div class="h2-line mt-1"></div>

        <div class="container mt-3 g-0">


            <!-- <div class="row"> -->

            <ul class="inbox-ul">
                <li><a class="inbox-a active" href="javascript:void(0);" rel="all">顯示全部</a></li>
                <li><a class="inbox-a" href="javascript:void(0);" rel="msg-type-1">公告訊息</a></li>
                <li><a class="inbox-a" href="javascript:void(0);" rel="msg-type-2">行蹤</a></li>
            </ul>
            <div class="d-flex flex-wrap">

                <ul class="inbox-content-ul">

                    <!-- public-inbox-msg -->
                    <?php
                            date_default_timezone_set('Asia/Hong_Kong');
                    
                    $query_args = array(
                        'post_type' => 'public-inbox-msg',
                    );
                    
                    $the_query = new WP_Query( $query_args );
                    
                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();

                        ?>
                    <li class="position-relative msg-type-1 msg-type-li">

                        <div>
                            <div class="msg-type">公告訊息</div>

                            <div class="msg-datetime">
                                <span><?php echo get_the_date();?></span>
                                <span class="ms-1"><?php echo get_the_time();?></span>
                            </div>


                        </div>
                        <div class="inbox-msg-title mb-2"><?php echo get_the_title();?></div>
                        <div class="inbox-msg-content"><?php echo get_the_content();?></div>

                    </li>
                    <?php
                        
                        }
                        wp_reset_postdata();
                    } else {
                    }
                    ?>

                </ul>
                <ul class="inbox-content-ul-2">

                    <?php
      
      $query_args = array(
        'p' => $_SESSION['user_id'],
        'post_type' => 'member'
    );
    
       $the_query = new WP_Query( $query_args );
       
       if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            
            ?>
                    <?php if( have_rows('history') ){ ?>

                    <?php
// echo 111;
                 while( have_rows('history') ){ the_row();
                
                    ?>

                    <li class="position-relative msg-type-2 msg-type-li">
                        <div>
                            <div class="msg-type">行蹤</div>

                            <div class="msg-datetime">
                                <span><?php echo get_sub_field('history_datetime');?></span>
                            </div>
                        </div>
                        <div class="inbox-msg-content"><?php echo get_sub_field('history_log');?></div>
                    </li>
                    <?php
                }
                
                ?>

                    <?php } ?>

                    <?php
            // echo 1;
            
        }
     }
    
?>





                </ul>






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
$(function() {

    var list = $('.inbox-content-ul-2');
    var listItems = list.children('li');
    list.append(listItems.get().reverse());


})

$('.inbox-a').click(function() {
    $('.inbox-a').removeClass('active');
    $(this).addClass('active');

    var target_type = $(this).attr('rel');

    $('.msg-type-li').fadeOut(0);
    if (target_type == 'all') {
        $('.msg-type-li').fadeIn(0);
    } else {
        $('.' + target_type).fadeIn(0);
    }
    // alert(target_type);

})
</script>
<?php
get_footer();