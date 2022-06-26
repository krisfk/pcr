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
            <!-- 加入會員


歡迎您的到來，此為註冊會員的頁面。請輸入簡單的信息即可成為會員。


用戶名稱

電郵地址

密碼 *6-15字數（英文大/小寫字母，數字或記號組合）

確認密碼


確定加入   取消


* 本平台將發送「視角文化資源發送的認證郵件」，請到您的郵箱中確認並完成會員註冊，為了成功完成會員註冊，請輸入正確的郵箱地址。
 -->


            <h4><span style="color: #ec6820;">註冊會員</span></h4>

            <div class="welcome-msg mt-3">歡迎您的到來，此為註冊會員的頁面。請輸入簡單的信息即可成為會員。
            </div>


            <table class="reg-table mt-4">
                <tr>
                    <td><label for="account-name">姓名：</label> </td>
                    <td> <input id="account-name" name="account-name" type="text" class="form-control">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">電郵地址：</label></td>
                    <td> <input id="email" name="email" type="text" class="form-control">
                        <div class="error"></div>

                    </td>
                </tr>
                <tr>
                    <td><label for="tel">聯絡電話(選填)：</label></td>
                    <td> <input id="tel" name="tel" type="text" class="form-control">
                        <div class="error"></div>

                    </td>
                </tr>
                <tr>
                    <td><label for="address">聯絡地址(選填)：</label></td>
                    <td> <input id="address" name="address" type="text" class="form-control">

                    </td>
                </tr>


                <tr>
                    <td><label for="age">年齡：</label></td>
                    <td>
                        <input class="form-check-input" type="radio" name="age" id="age-1" checked="checked"
                            value="22-30">
                        <label class="form-check-label" for="age-1">
                            22-30
                        </label>
                        <input class="form-check-input" type="radio" name="age" id="age-2" value="31-45">
                        <label class="form-check-label" for="age-2">
                            31-45
                        </label>
                        <input class="form-check-input" type="radio" name="age" id="age-3" value="46或以上">
                        <label class="form-check-label" for="age-3">
                            46或以上
                        </label>
                        <!-- <input id="address" name="address" type="text" class="form-control"> -->

                    </td>
                </tr>

                <tr>
                    <td>子女數量：</td>
                    <td> <input class="form-check-input" type="radio" name="child" id="child-1" value="不適用"
                            checked="checked">
                        <label class="form-check-label" for="child-1">
                            不適用
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-2" value="1">
                        <label class="form-check-label" for="child-2">
                            1
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-3" value="2">
                        <label class="form-check-label" for="child-3">
                            2
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-4" value="3">
                        <label class="form-check-label" for="child-4">
                            3
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-5" value="4">
                        <label class="form-check-label" for="child-4">
                            4
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-5" value="5">
                        <label class="form-check-label" for="child-5">
                            4個以上
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>關注資訊(可多項)：</td>
                    <td>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-1" value="親子活動">
                        <label class="form-check-label" for="subscribe-info-1">
                            親子活動
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-2" value="音樂">
                        <label class="form-check-label" for="subscribe-info-2">
                            音樂
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-3" value="文化">
                        <label class="form-check-label" for="subscribe-info-3">
                            文化
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-4" value="繪本">
                        <label class="form-check-label" for="subscribe-info-4">
                            繪本
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-5" value="飲食">
                        <label class="form-check-label" for="subscribe-info-5">
                            飲食
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-6" value="運動">
                        <label class="form-check-label" for="subscribe-info-6">
                            運動
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-7" value="天文">
                        <label class="form-check-label" for="subscribe-info-7">
                            天文
                        </label>

                        <input type="text" class="form-control" placeholder="關注其他資訊" name="subscribe-info-other">


                        <!-- 音樂。文化。繪本。飲食。運動。天文。其它 -->
                    </td>
                </tr>


                <tr>
                    <td><label for="password">密碼：</label>
                    </td>
                    <td><input id="password" name="password" maxlength="15" type="password" class="form-control">
                        <div class="password-des">
                            6-15字數（英文大/小寫字母，數字或符號組合）</div>
                        <div class="error"></div>

                    </td>
                </tr>
                <tr>
                    <td><label for="confirm-password">確認密碼：</label>
                    </td>
                    <td><input id="confirm-password" name="confirm-password" maxlength="15" type="password"
                            class="form-control">
                        <div class="error"> </div>
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
                        <a href="javascript:void(0);" class="refresh-captcha-btn-a"> <img class="refresh-captcha-btn"
                                src="<?php echo get_template_directory_uri() .'/assets/images/refresh-btn.png'?>"
                                alt="">
                        </a>
                        <div class="error">

                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="align-top" style="line-height:1.2">聲明</td>
                    <td>
                        <div class="reject-promote-div"> <input class="form-check-input" type="checkbox"
                                name="reject-promote-1" value="" id="reject-promote-1">
                            <label for="reject-promote-1">本人反對視角文化資源使用我的個人資料作直接促銷之用。</label>
                        </div>
                        <div class="reject-promote-div mt-2">
                            <input class="form-check-input" type="checkbox" value="" name="reject-promote-2"
                                id="reject-promote-2">
                            <label for="reject-promote-2">本人反對視角文化資源將我的個人資料提供及轉移予其合作夥伴以讓他們作直接促銷之用。</label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>

                        <button type="text" class="btn enter" value="">確定</button>
                        <button type="text" class="btn cancel" value="">取消</button>

                    </td>
                </tr>
            </table>


            <div class="remark mt-4 d-block">
                * 本平台將發送「啓動您的視角文化源會員」郵件至閣下填寫的電郵，請根據郵件指示啓動您的帳戶。
            </div>



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
            url: '<?php echo get_site_url();?>/captcha/gen_captcha.php',
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
    var err7_str = "此電郵信箱已註冊";
    var err8_str = "驗證碼輸入不正確";
    var success_msg = "表格遞交成功！你將會收到視角文化資源發送的認證郵件，確認新會員註冊。";




    $('.btn.enter').click(function() {
        var reject_promote_1 = $('#reject-promote-1').is(":checked");
        var reject_promote_2 = $('#reject-promote-2').is(":checked");
        var account_name = $('#account-name').val();
        var email = $('#email').val();
        var tel = $('#tel').val();
        var address = $('#address').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm-password').val();
        var captcha = $('#captcha-txt').val();
        var valid = true;
        var age = $('input[name="age"]:checked').val();
        var child = $('input[name="child"]:checked').val();

        var subscribe_info_arr = [];
        $('input[name="subscribe-info"]:checkbox:checked').each(function(i) {
            subscribe_info_arr[i] = $(this).val();
        });

        var subscribe_info_other = $('input[name="subscribe-info-other"]').val();
        // alert(subscribe_other);


        $('.error').html('');

        if (!account_name) {
            $('#account-name').next('.error').html(err1_str);
            valid = false;
        }

        if (!/^([\w\.\+]{1,})([^\W])(@)([\w]{1,})(\.[\w]{1,})+$/.test(email)) {
            $('#email').next('.error').html(err2_str);
            valid = false;
        }

        if (!(/^[0-9]{8}$/.test(tel)) && tel) {
            $('#tel').next('.error').html(err３_str);
            valid = false;
        }

        if (password.length < 6) {
            $('#password').next().next('.error').html(err5_str);
            valid = false;

        } else if (password != confirm_password) {
            $('#confirm-password').next('.error').html(err6_str);
            valid = false;

        }

        if (valid) {
            //     var account_name = $('#account-name').val();
            // var email = $('#email').val();
            // var tel = $('#tel').val();
            // var address = $('#address').val();
            // var password = $('#password').val();
            // var confirm_password = $('#confirm-password').val();
            $.ajax({
                type: "POST",
                url: '<?php echo get_site_url();?>/wp-json/api/register',
                data: {
                    account_name: account_name,
                    email: email,
                    tel: tel,
                    address: address,
                    password: password,
                    captcha: captcha,
                    reject_promote_1: reject_promote_1,
                    reject_promote_2: reject_promote_2,
                    child: child,
                    subscribe_info: subscribe_info_arr,
                    subscribe_info_other: subscribe_info_other,
                    age: age

                },
                dataType: "json",


                success: function(data) {
                    console.log(data);
                    if (data.status === '1') {
                        $('.reg-table,.welcome-msg').fadeOut(0);
                        $('.remark').html(success_msg);
                    }


                    if (data.status === '0') {
                        $('#email').next('.error').html(err7_str);

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