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


            <h4><span style="color: #ec6820;">會員登入</span></h4>
            <!-- 
            <div class="welcome-msg mt-3">歡迎您的到來，此為註冊會員的頁面。請輸入簡單的信息即可成為會員。
            </div> -->


            <table class="reg-table mt-4">
                <tr>
                    <td><label for="email">登記電郵：</label> </td>
                    <td> <input id="email" name="email" type="text" class="form-control">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">會員密碼：</label></td>
                    <td> <input id="password" name="password" type="password" class="form-control">
                        <div class="error"></div>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="float-end btn   form-submit-btn">登入</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end">
                        <a class="login-a" href="/registration/"> 會員註冊</a>
                        <a class="login-a" href="/forget-pw/"> 忘記密碼</a>

                    </td>
                </tr>

            </table>





            </form>


            <?php

//    echo get_the_content();?>
        </div>
    </div>

</main>

<script type="text/javascript">
$(function() {

    $('.form-submit-btn').click(function() {


        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: '<?php echo get_site_url();?>/wp-json/api/member-login',
            data: {
                email: email,
                password: password
            },
            dataType: "json",


            success: function(data) {
                console.log(data);
                if (data.status === '1') {


                    $.ajax({
                        type: "POST",
                        url: '<?php echo get_site_url();?>/wp-json/api/log-history',
                        data: {
                            log_msg: '會員登入網站成功。',
                        },
                        dataType: "json",
                        success: function(data) {}
                    })




                    window.location = "<?php echo get_site_url();?>";
                }

                if (data.status === '-1') {
                    alert('登入電郵或密碼不正確');
                    // alert('!');
                    // $('#captcha-txt').next().next('.error').html(err8_str);
                }
            }
        });


    })



});
</script>

<?php
get_footer();