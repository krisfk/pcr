<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">


</head>

<body>

    <?php
require('../wp-load.php');
?>
    <div class="text-center mt-4">
        <h1>PCR website traffic records</h1>
        Today is <?php echo date("Y/m/d");?>

        <?php
        
        $post_id=$_GET['aid'];
        ?>
        <h4 class="mt-4">Traffic of <?php echo get_the_title($post_id);?></h4>

        <div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                    value="option1" />
                <label class="form-check-label" for="inlineRadio1">1</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="option2" />
                <label class="form-check-label" for="inlineRadio2">2</label>
            </div>



        </div>
    </div>

    <div class="container mt-4">

        <div class="row justify-content-center  gx-3">


            <div class="col-5 articles-col blk">
                <h5>Articles(<span class="num"></span>)

                    <?php
                
                ?>

                </h5>
                <ul>

                    <?php

                $query_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => '-1',
                    'ignore_custom_sort' => true
                );
                // 
                // The Query
                $the_query = new WP_Query( $query_args );
                
                // The Loop
                
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        ?>

                    <li>

                        <div class="row">

                            <div class="col-6"> <a href="<?php echo 'article.php?aid='.get_the_ID();?>"><?php
                              echo get_the_title();
                        ?></a></div>
                            <div class="col-4">
                                <?php
                                echo get_the_date();
                                ?>
                            </div>
                            <div class="col-2">
                                <a target="_blank" href="<?php echo get_permalink();?>">link</a>

                            </div>
                        </div>

                    </li>

                    <?php
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                } else {
                    // no posts found
                }


                
                
                ?>
                </ul>
            </div>
            <div class="col-5 blk member-col">
                <h5>Members(<span class="num"></span>)</h5>

                <ul>
                    <?php
                
                $query_args = array(
                    'posts_per_page' => '-1',
                    'post_type' => 'member',
                    'order' => 'DESC',
                    'orderby' => 'date',
                );
                
                // The Query
                $the_query = new WP_Query( $query_args );
                
                // The Loop
                
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        ?>


                    <li>
                        <div class="row">

                            <div class="col-4">
                                <a href="./member.php?mid=<?php echo get_the_ID();?>">
                                    <?php 
                                
                                
                                echo get_field('account_name');?></a>
                            </div>
                            <div class="col-8">
                                <a href="./member.php?mid=<?php echo get_the_ID();?>">

                                    <?php echo get_field('email');?>
                                </a>
                            </div>
                        </div>
                    </li>

                    <?php
                    }
                    ?>

                    <?php
                    /* Restore original Post Data */
                    wp_reset_postdata();
                } else {
                    // no posts found
                }
                
                ?>
                </ul>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(function() {

        $('.articles-col .num').html($('.articles-col ul li').length)

        $('.member-col .num').html($('.member-col ul li').length)


    })
    </script>
</body>

</html>