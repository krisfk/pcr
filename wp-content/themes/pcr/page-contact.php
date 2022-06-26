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

            <?php
    echo get_the_content();?>
            <?php //echo do_shortcode(' [fc id="1" align="center"]'); ?>

            <table class="comment-table mt-4">
                <tbody>
                    <tr>
                        <td class="label-td"><label for="name">名稱：</label> </td>
                        <td> <input id="name" name="name" type="text" class="form-control">
                            <div class="error"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td"><label for="email">電郵：</label></td>
                        <td> <input id="email" name="email" type="email" class="form-control">
                            <div class="error"></div>

                        </td>
                    </tr>
                    <tr>
                        <td class="label-td"><label for="comment">查詢或意見：</label></td>
                        <td> <textarea id="comment" name="comment" type="comment" class="form-control"></textarea>
                            <div class="error"></div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            驗證碼：
                        </td>
                        <td>
                            <img class="captcha" src="" alt="">

                            <input maxlength="5" type="text" id="captcha-txt" name="captcha-txt"
                                class="form-control captcha-input-text">
                            <a href="javascript:void(0);" class="refresh-captcha-btn-a"> <img
                                    class="refresh-captcha-btn"
                                    src="<?php echo get_template_directory_uri() .'/assets/images/refresh-btn.png'?>"
                                    alt="">
                            </a>
                            <div class="error">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td"></td>
                        <td><button type="submit" class="float-end btn   form-submit-btn enter btn">遞交</button></td>
                    </tr>


                </tbody>
            </table>

            <div class="remark mt-3 text-center"></div>

        </div>
    </div>

</main>


<script type="text/javascript">
$(function() {

    $('.refresh-captcha-btn-a').click(function() {

        gen_captcha();
    });

    function gen_captcha() {
        $.ajax({
            type: "GET",
            url: '/captcha/gen_captcha.php',
            success: function(data) {
                $('.captcha').attr('src', data);
            }
        });
    }

    gen_captcha();





    var err1_str = "請填上名稱";
    var err2_str = "輸入電郵格式不正確";
    var err３_str = "請填上你的查詢或意見";
    var err4_str = "";
    var err5_str = "請填上密碼6-15字數（英文大/小寫字母，數字或記號組合）";
    var err6_str = "確認密碼和密碼輸入不相同";
    var err7_str = "這個電郵已被註冊";
    var err8_str = "驗證碼輸入不正確";
    var success_msg = "表格遞交成功！我們將會盡快回覆你。";




    $('.btn.enter').click(function() {
        var name = $('#name').val();
        var email = $('#email').val();
        var comment = $('#comment').val();
        var captcha = $('#captcha-txt').val();
        var valid = true;

        $('.error').html('');

        if (!name) {
            $('#name').next('.error').html(err1_str);
            valid = false;
        }

        if (!/^([\w\.\+]{1,})([^\W])(@)([\w]{1,})(\.[\w]{1,})+$/.test(email)) {
            $('#email').next('.error').html(err2_str);
            valid = false;
        }

        if (!comment) {
            $('#comment').next('.error').html(err３_str);
            valid = false;
        }



        if (valid) {

            $.ajax({
                type: "POST",
                url: '<?php echo get_site_url();?>/wp-json/api/contact-us-submit',
                data: {
                    name: name,
                    email: email,
                    comment: comment,
                    captcha: captcha
                },
                dataType: "json",

                success: function(data) {
                    console.log(data);
                    if (data.status === '1') {
                        $('.comment-table').fadeOut(0);
                        $('.remark').html(success_msg);
                    }

                    if (data.status === '-1') {
                        // alert('!');
                        $('#captcha-txt').next().next('.error').html(err8_str);

                    }
                }
            });

        }
    })






});
</script>

<?php
get_footer();