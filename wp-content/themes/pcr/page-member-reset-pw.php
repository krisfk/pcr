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
session_start();
get_header();
?>


<main id="site-content" class="mt-5" role="main">

    <div class="container">

        <div class="inner-container">


            <?php
$user_id = $_GET['u'];
$code = $_GET['c'];


$args = array(
    'p'=>$user_id,
    'post_type'  => 'member',
    'meta_query' => array(
        array(
            'key'     => 'reset_pw_verification_code',
            'value'   => $code,
        )
    ),
);
// echo $email.'!!'.$password;
$query = new WP_Query( $args );

if($query->have_posts())
{
    ?>
            <h4><span style="color: #ec6820;">重設密碼</span></h4>


            <div class="welcome-msg mt-3 text-center">修改密碼：
            </div>

            <input type="hidden" id="user_id" value="<?php echo $user_id;?>">

            <table class="reg-table mt-4" style="width:366px">
                <tr style="display:none;">
                    <td><label for="oldpassword"> 現有密碼：</label></td>
                    <td> <input class="form-control" type="password" id="oldpassword"
                            value="<?php echo get_field('password',$user_id);?>">

                        <div class="error">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="newpassword">新密碼：</label></td>
                    <td> <input class="form-control" type="password" id="newpassword">

                        <div class="error">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="confirm_newpassword">確認新密碼：</label></td>
                    <td> <input class="form-control" type="password" id="confirm_newpassword"> </td>

                </tr>
                <tr>
                    <td></td>
                    <td class="text-end"> <button type="text" class="btn enter2" value="">更新</button>
                    </td>
                </tr>
            </table>
            <div class="remark mt-3"></div>

            <?php
}
else
{
    ?>
            <div class="remark mt-3">重設密碼的網址不正確，五秒後自動返回主頁。</div>
            <script type="text/javascript">
            setTimeout(() => {
                window.location = "<?php echo get_site_url();?>";

            }, 5000);
            </script>
            <?php
}
?>





            </form>


            <?php
    echo get_the_content();?>
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





    var err1_str = "請填上用戶名稱";
    var err2_str = "輸入電郵格式不正確";
    var err３_str = "電話格式不正確(8個數字)";
    var err4_str = "";
    var err5_str = "請填上密碼6-15字數（英文大/小寫字母，數字或記號組合）";
    var err6_str = "確認密碼和密碼輸入不相同";
    var err7_str = "這個電郵已被註冊";
    var err8_str = "驗證碼輸入不正確";
    var success_msg = "表格遞交成功！你將會收到視角文化資源發送的認證郵件，確認新會員註冊。";




    $('.btn.enter').click(function() {
        // var account_name = $('#account-name').val();
        // var email = $('#email').val();
        var tel = $('#tel').val();
        var address = $('#address').val();
        // var password = $('#password').val();
        // var confirm_password = $('#confirm-password').val();
        var age = $('input[name="age"]:checked').val();
        var child = $('input[name="child"]:checked').val();


        var captcha = $('#captcha-txt').val();
        var valid = true;

        $('.error').html('');


        if (!(/^[0-9]{8}$/.test(tel)) && tel) {
            $('#tel').next('.error').html(err３_str);
            valid = false;
        }


        if (valid) {

            $.ajax({
                type: "POST",
                url: '<?php echo get_site_url();?>/wp-json/api/updateinfo',
                data: {
                    user_id: $('#user_id').val(),
                    tel: tel,
                    age: age,
                    child: child,
                    address: address,
                    captcha: captcha,
                },
                dataType: "json",


                success: function(data) {
                    console.log(data);
                    if (data.status === '1') {
                        $('.reg-table,.welcome-msg').fadeOut(0);
                        $('.remark').html('會員資料已更新，五秒後自動返回主頁');


                        setTimeout(() => {
                            window.location = "<?php echo get_site_url();?>";

                        }, 5000);


                    } else if (data.status === '-1') {
                        $('#captcha-txt').next().next('.error').html(err8_str);

                    }




                }
            });

        }
    })



    $('.btn.enter2').click(function() {
        $('.error').html('');


        var oldpassword = $('#oldpassword').val();
        var newpassword = $('#newpassword').val();
        var confirm_newpassword = $('#confirm_newpassword').val();

        if (newpassword || confirm_newpassword || oldpassword) {
            if (newpassword != confirm_newpassword) {
                $('#newpassword').next('.error').html(err6_str)
            } else if (!newpassword && !confirm_newpassword) {
                $('#newpassword').next('.error').html('請輸入你的新密碼');

            } else {

                $.ajax({
                    type: "POST",
                    url: '<?php echo get_site_url();?>/wp-json/api/updatepw',
                    data: {
                        user_id: $('#user_id').val(),
                        oldpassword: oldpassword,
                        newpassword: newpassword
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status === '1') {
                            $('.reg-table,.welcome-msg').fadeOut(0);


                            $('.remark').html('會員密碼已更新，五秒後自動返回主頁');
                            setTimeout(() => {
                                window.location = "<?php echo get_site_url();?>";

                            }, 5000);

                        }
                        if (data.status === '-1') {
                            $('#oldpassword').next('.error').html('現有密碼不正確')


                        }

                    }
                })
            }
        } else {
            $('#oldpassword').next('.error').html('請輸入密碼')
        }
    });


});
</script>

<?php
get_footer();