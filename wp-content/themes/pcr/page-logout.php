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


            <h4><span style="color: #ec6820;">會員登出</span></h4>

            <?php
            session_destroy();

            ?>
            <div class="welcome-msg mt-3">

                已登出，五秒後自動返回主頁;

                <script type="text/javascript">
                setTimeout(() => {
                    window.location = "<?php echo get_site_url();?>";

                }, 5000);
                </script>

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