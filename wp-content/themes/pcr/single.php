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

    // $args = array(
	// 	'p'=> $_SESSION['user_id'],
	// 	'post_type'  => 'member',
	// );
	
	// $query = new WP_Query( $args );
	
	// if($query->have_posts())
	// {
        // echo get_the_ID().'<br>';
        // echo get_field('fav_articles',$_SESSION['user_id']);
    // }
        $bookmarked=false;
        if($_SESSION['user_id'])
        {
            $fav_articles_list = get_field('fav_articles',$_SESSION['user_id']);
            $current_post_id=get_the_ID();
            $fav_articles_list_arr=explode(",",$fav_articles_list);
           
            if (in_array($current_post_id, $fav_articles_list_arr))
            {
                $bookmarked=true;
            }
        }
 

?>
<div class="lightbox" style="">

    <div class="lightbox-bg-btn ">

    </div>

    <div class="lightbox-content lightbox-msg" style="">
        <a href="javascript:void(0);" class="close-btn">

            <img src="<?php echo get_template_directory_uri() .'/assets/images/lightbox-close-btn.png'?>" alt="">
        </a>
        <div class="lightbox-msg-txt-div">
            <span class="lightbox-msg-txt  d-block p-3">
                <?php
                echo get_field('parent_read_content');
                ?>
            </span>
        </div>

    </div>
    <div class="lightbox-content filter-content" style="display: none;">
    </div>
</div>
<main id="site-content" class="" role="main">

    <div class="container">

        <?php
             echo get_template_part( 'nav','article-top' ); 
        ?>


        <?php 
        // if(get_field('membership_only'))
        // {
                if(!$_SESSION['user_id'] && get_field('membership_only'))
                {
                   ?>
        <div class="inner-container">

            <div class="mb-5 text-center">
                <?php                     echo '本文章<b>('.get_the_title().')</b>需要申請成為PCR員會才可閱讀。';
?>
            </div>
            <div class="single-login-form mb-5">

                <h2 class="d-inline-block">PCR 會員</h2>

                <a class="d-inline-block sub-menu-a" href="/registration/"> 新會員註冊</a>


                <div class="h2-line mt-1"></div>
                <div class="mt-3 form-div">

                    <input id="email" type="text" class="form-control form-text-input" placeholder="電郵">
                    <input id="password" type="password" class="form-control mt-3  form-text-input" placeholder="密碼">
                    <button type="submit" class="float-end btn mt-3   form-submit-btn">登入</button>


                </div>


            </div>
        </div>
        <?php
                    
                }
                else
                {
                    ?>
        <?php echo do_shortcode(' [addtoany] '); ?>
        <!--  -->
        <?php 

        if($_SESSION['user_id'])
        {
            
        ?>
        <div class="text-center mt-3 mb-3">
            <a href="javascript:void(0);" class="add-to-fav-btn <?php echo $bookmarked ? 'active':'';?>"></a>
        </div>
        <?php
        }
        ?>

        <div class="inner-container">







            <?php

        if(get_field('half_public_post'))
        {

            
           if(!$_SESSION['user_id'])
           {

            echo get_field('half_public_post_snipper_of_full_content');
            ?>
            <div class="mb-5 mt-5">此為會員限定內容，你可 <a href="<?php echo get_site_url();?>/registration/"
                    class="want-read-btn">會員註冊</a> 或 <a href="<?php echo get_site_url();?>/member-login/"
                    class="want-read-btn">會員登入</a> 再觀看這文章內容。</div>
            <?php
           }
           else
           {
               ?>
            <?php
               echo get_the_content();
           }
        //    exit();

            ?>


            <?php

// exit();

            // echo 1;
        }
        else
        {
         
            ?>

            <?php 
if(!get_field('is_mc_test'))
{
    ?>

            <?php 
if(get_field('parent_read_content'))
{
    ?>
            <div class="text-center mt-5 mb-5">

                <a href="javascrpt:void(0);" class="parent-read-btn">
                    <!-- 家長導讀 -->
                    <img src="<?php echo get_template_directory_uri() .'/assets/images/ParentButton.png'?>" alt="">
                </a>
            </div>

            <?php
}
?>

            <?php
}
else
{
    ?>
            <div class="mt-5"></div>
            <?php
}
?>


            <?php
            echo get_the_content();
            ?>

            <?php 
if(get_field('is_mc_test'))
{
    ?>
            <div class="row gx-5 align-items-center">


                <?php

    if( have_rows('questions_and_answers') ){
    $idx=1;
    while ( have_rows('questions_and_answers') ) { the_row();
        ?>

                <div class="col-lg-6 col-md-5 col-sm-12 col-12 mb-2">Q<?php echo $idx;?>:
                    <?php echo get_sub_field('question');?></div>
                <div class="col-lg-6 col-md-7 col-sm-12 col-12 mb-2 ">


                    <div class="row">

                        <div class="col-6 selected-col"> <input class="form-check-input mt-1 me-1" type="radio"
                                name="a<?php echo $idx;?>" id="a<?php echo $idx;?>-1"
                                value="<?php echo get_sub_field('answer_left_score');?>">
                            <label class="form-check-label me-3" for="a<?php echo $idx;?>-1">
                                <?php echo get_sub_field('answer_left');?>
                            </label>
                        </div>
                        <div class="col-6 selected-col"> <input class="form-check-input mt-1 me-1" type="radio"
                                name="a<?php echo $idx;?>" id="a<?php echo $idx;?>-2"
                                value="<?php echo get_sub_field('answer_right_score');?>">
                            <label class="form-check-label me-3" for="a<?php echo $idx;?>-2">
                                <?php echo get_sub_field('answer_right');?>
                            </label>
                        </div>
                    </div>




                </div>
                <?php

        $idx++;
   
     }
    }

$question_num=$idx;
?>

                <div class="col-lg-6 col-md-5 col-sm-12 col-12 mb-2 text-end mt-3"></div>
                <div class="col-lg-6 col-md-5 col-sm-12 col-12 mb-2 mt-3">

                    <div class="error"></div>
                </div>


                <div class="col-lg-6 col-md-5 col-sm-12 col-12 mb-2 text-end mt-3">總分</div>
                <div class="col-lg-6 col-md-5 col-sm-12 col-12 mb-2 mt-3">


                    <div class="row align-items-center">

                        <div class="col-6 answer-block answer-block-1">

                        </div>
                        <div class="col-6  answer-block answer-block-2">

                        </div>
                    </div>


                </div>

            </div>

            <div class="text-center">

                <a href="javascript:void(0);" class="submit-test-btn mt-4">提交答案</a>

            </div>

            <div class="test-result mt-5">
                <?php echo get_field('test_results');?>
            </div>
            <?php
}
?>

            <?php

            
            // echo 999;
        }
// if(get_field(0))
// echo get_the_content();

?>
        </div>

        <?php

if(has_tag()) {
    ?>

        <div class="tags-div">Tags:
            <?php is_single() && the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ) ?>
        </div>
        <?php
            }            ?>

        <?php echo do_shortcode(' [addtoany] '); ?>

        <?php 

if($_SESSION['user_id'])
{
    
?>
        <div class="text-center mt-3 mb-3">
            <a href="javascript:void(0);" class="add-to-fav-btn <?php echo $bookmarked ? 'active':'';?>"></a>
        </div>
        <?php
}
?>

        <?php
                }
        // } 
        ?>




    </div>

</main>



<?php 

$category = get_the_category();
$firstCategory = $category[0]->cat_name;
// echo $firstCategory; 

$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
$category_slug = $categories[0]->slug;

?>

<script type="text/javascript">
$(function() {


    <?php
    
    if(get_field('is_mc_test'))
    {
       ?>
    $('.submit-test-btn').click(function() {

        var num_of_question = <?php echo $question_num;?>;
        var selected_all = true;
        // num_of_question
        // alert(num_of_question);
        for (i = 1; i < 19; i++) {
            if ($('input[name="a' + i + '"]').not(':checked').length != 1) {
                selected_all = false;
            }


        }

        if (!selected_all) {
            $('.error').html('請選答所有問題。');
        } else {
            $('.error').html('');

            var score_1 = 0;
            var score_2 = 0;

            for (i = 1; i < 19; i++) {
                // score_1 += $('input[name="a' + i + '"]:checked').val();
                // score_2 += $('input[name="a' + i + '"]:checked').val();

                if ($('input[name="a' + i + '"]:checked').parent('.selected-col').index() === 0) {
                    score_1 += Number($('input[name="a' + i + '"]:checked').val());
                }

                if ($('input[name="a' + i + '"]:checked').parent('.selected-col').index() === 1) {
                    score_2 += Number($('input[name="a' + i + '"]:checked').val());
                }



            }
            $('.answer-block-1').html(score_1);
            $('.answer-block-2').html(score_2);

            $('.test-result').fadeIn(0);

            <?php
            if($_SESSION['user_id'])
            {
                ?>

            $.ajax({
                type: "POST",
                url: '<?php echo get_site_url();?>/wp-json/api/log-history',
                data: {
                    log_msg: '完成了玩學遊戲小測驗 - <?php echo get_the_title();?>',
                },
                dataType: "json",
                success: function(data) {}
            })
            <?php
            }
            ?>



        }
        // alert(selected_all);

    })
    <?php
    }
    ?>



    var cate_name = '<?php echo $firstCategory;?>';
    var cate_id = '<?php echo $category_id;?>';
    var cate_slug = '<?php echo $category_slug;?>';
    $('#cat option[value="' + cate_id + '"]').attr('selected', 'selected');

    $('.' + cate_slug).addClass('active');

    // add-to-fav-btn

    $('.parent-read-btn').click(function() {

        $('.lightbox').fadeIn(200);

    })
    <?php
    if($_SESSION['user_id'])
    {
        ?>
    $('.add-to-fav-btn').html('加入我的喜愛');
    $('.add-to-fav-btn.active').html('已加入我的喜愛');

    $('.add-to-fav-btn').click(function() {
        $('.add-to-fav-btn').toggleClass('active');

        if ($('.add-to-fav-btn').hasClass('active')) {

            $.ajax({
                type: "POST",
                url: '<?php echo get_site_url();?>/wp-json/api/add-to-fav',
                data: {
                    user_id: <?php echo $_SESSION['user_id'];?>,
                    post_id: <?php echo get_the_ID();?>,
                    action: 'add'
                },
                dataType: "json",
                success: function(data) {

                    $.ajax({
                        type: "POST",
                        url: '<?php echo get_site_url();?>/wp-json/api/log-history',
                        data: {
                            log_msg: '加入文章 - <?php echo get_the_title();?> 到我的喜愛。',
                        },
                        dataType: "json",
                        success: function(data) {}
                    })

                    $('.add-to-fav-btn').html('已加入我的喜愛');
                }
            })

        } else {


            $.ajax({
                type: "POST",
                url: '<?php echo get_site_url();?>/wp-json/api/add-to-fav',
                data: {
                    user_id: <?php echo $_SESSION['user_id'];?>,
                    post_id: <?php echo get_the_ID();?>,
                    action: 'remove'
                },
                dataType: "json",
                success: function(data) {
                    $('.add-to-fav-btn').html('加入我的喜愛');
                }
            })


            $('.add-to-fav-btn').html('加入我的喜愛');
        }
    })
    <?php
    }
    ?>




    $('.a2a_kit a').click(function() {
        $.ajax({
            type: "POST",
            url: '<?php echo get_site_url();?>/wp-json/api/log-history',
            data: {
                log_msg: '分享文章 - <?php echo get_the_title();?> 。',
            },
            dataType: "json",
            success: function(data) {}
        })

    })

    $('.form-submit-btn').click(function() {


        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: '<?php echo get_site_url();?>/wp-json/api/member-login',
            data: {
                email: email,
                password: password,
                from_post: window.location.href
            },
            dataType: "json",


            success: function(data) {
                console.log(data);
                if (data.status === '1') {

                    window.location = data.from_post;
                }

                if (data.status === '-1') {
                    alert('登入電郵或密碼不正確');
                    // alert('!');
                    // $('#captcha-txt').next().next('.error').html(err8_str);
                }
            }
        });


    })

})
</script>



<?php
get_footer();