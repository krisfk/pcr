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
session_start();     

?>


<main id="site-content" class="mt-5" role="main">

    <div class="container">

        <div class="inner-container">


            <h4><span style="color: #ec6820;">新會員認證</span></h4>

            <div class="welcome-msg mt-3">

                <?php
            	$search_account = get_posts(array(
                    'post_type'		=> 'member',
                    'meta_key'		=> 'email_verification_code',
                    'meta_value'	=> $_GET['c']
                ));
                
                if($search_account)
                {
                    $verified_email = get_field('verified_email',$_GET['u']);
                    if($verified_email)
                    {
                        echo '此帳號之前已被認證。五秒後返回主頁...';

                    }
                    else
                    {
                        echo '新會員成功認證。五秒後自動登入...';
                        update_post_meta( $_GET['u'], 'verified_email', true );
                        $_SESSION['user_id'] = $_GET['u'];


                        $to= get_field('email',$_GET['u']);
                        $account_name = get_field('account_name',$_GET['u']);
                        $subject= '歡迎您成為視角文化資源會員';
                        $body='<!DOCTYPE html><html lang="en"><head> <meta charset="UTF-8" /> <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <title>Document</title></head><body> <div style="text-align: center; margin-top: 30px"> <a href="https://perspectivecr.org/"> <img style="height: 66px" src="https://perspectivecr.org/wp-content/themes/pcr/assets/images/logo.png" alt="" /></a> <br /><br /><span style="font-size: 16px; font-weight: bold"> '.$account_name.' 您好︰</span > <br /><br /> 歡迎您成為視角文化資源會員。 <br /> 請即瀏覽<a href="https://www.perspectivecr.org" target="_blank" style="color:#000;">視角網頁</a>，享受愉快學習吧！ <br /><br /><br />視角文化資源 <br /> <br /> <a href="https://www.perspectivecr.org/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-1.png" alt="" /> </a> <a href="https://www.facebook.com/視角文化-100798228820297" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-2.png" alt="" /> </a> <a href="https://www.instagram.com/pers.cul/" target="_blank" style="text-decoration: none; margin: 0 2px"> <img style="height: 18px" src="https://perspectivecr.org/wp-content/uploads/2021/05/edm-icon-3.png" alt="" /> </a> </div> </body></html>';
                        $headers = array('Content-Type: text/html; charset=UTF-8');
                        $mailResult = false;
                        $mailResult= wp_mail( $to, $subject, $body, $headers );

                        


                    }
                    ?>
                <script type="text/javascript">
                setTimeout(() => {
                    window.location = "<?php echo get_site_url();?>";

                }, 5000);
                </script>
                <?php

                }
                else
                {
                    echo '認證連結錯誤。五秒後自動返回...';

                }
            ?>
            </div>


            </form>


        </div>
    </div>

</main>

<script type="text/javascript">
$(function() {




});
</script>

<?php
get_footer();