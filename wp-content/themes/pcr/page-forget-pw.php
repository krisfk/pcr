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


<main id="site-content" class="mt-5" role="main">

    <div class="container">

        <div class="inner-container">




            <h4><span style="color: #ec6820;">忘記密碼</span></h4>

            <div class="welcome-msg mt-3">請輸入你的登記電郵，我們會再發密碼給你
            </div>

            <table class="reg-table mt-4">

                <tr>
                    <td><label for="email">登記電郵：</label></td>
                    <td> <input id="email" name="email" type="text" class="form-control">
                        <div class="error"></div>

                    </td>
                    <td> <button type="text" class="btn enter float-start ms-3" value="">確定</button>
                    </td>
                </tr>


            </table>


            <div class="remark mt-4 d-block">
            </div>



            </form>


            <?php
    echo get_the_content();?>
        </div>
    </div>

</main>

<script type="text/javascript">
$(function() {

    $('.btn.enter').click(function() {

        var email = $('#email').val();

        $.ajax({
            type: "POST",
            url: '<?php echo get_site_url();?>/wp-json/api/forgetpw',
            data: {
                email: email
            },
            dataType: "json",


            success: function(data) {
                console.log(data);
                if (data.status === '1') {
                    $('.reg-table,.welcome-msg').fadeOut(0);
                    $('.remark').html('重設會員密碼已寄出，請查看你的電子郵箱');
                } else {
                    $('.error').html('這個電郵並沒有被使用來註冊或電郵輸入格式不正確')
                }



            }
        });


    })






});
</script>

<?php
get_footer();