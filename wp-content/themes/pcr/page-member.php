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
            <!-- 加入會員


歡迎您的到來，此為註冊會員的頁面。請輸入簡單的信息即可成為會員。


用戶名稱

電郵地址

密碼 *6-15字數（英文大/小寫字母，數字或記號組合）

確認密碼


確定加入   取消


* 本平台將發送「視角文化資源發送的認證郵件」，請到您的郵箱中確認並完成會員註冊，為了成功完成會員註冊，請輸入正確的郵箱地址。
 -->

            <?php
$user_id = $_SESSION['user_id'];

?>
            <h4><span style="color: #ec6820;">設定</span></h4>

            <div class="welcome-msg mt-3 text-center">
                <!-- 你的會員資料如下： -->
            </div>

            <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
            <table class="reg-table mt-4">
                <tr>
                    <td style="width:32%;"><label for="account-name">姓名：</label> </td>
                    <td> <input readonly id="account-name" name="account-name" type="text" class="form-control"
                            value="<?php echo get_field('account_name',$user_id);?>">
                        <div class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">電郵地址：</label></td>
                    <td> <input readonly id="email" name="email" type="text"
                            value="<?php echo get_field('email',$user_id);?>" class="form-control">
                        <div class="error"></div>

                    </td>
                </tr>
                <tr>
                    <td><label for="tel">聯絡電話(選填)：</label></td>
                    <td> <input id="tel" name="tel" type="text" class="form-control"
                            value="<?php echo get_field('tel',$user_id);?>">
                        <div class="error"></div>

                    </td>
                </tr>
                <tr>
                    <td><label for="address">聯絡地址(選填)：</label></td>
                    <td> <input id="address" name="address" type="text" class="form-control"
                            value="<?php echo get_field('address',$user_id);?>">

                    </td>
                </tr>

                <tr>
                    <td><label for="age">年齡：</label></td>
                    <td>
                        <?php //echo get_field('age',$user_id);?>
                        <input class="form-check-input" type="radio" name="age" id="age-1" value="22-30"
                            <?php echo get_field('age',$user_id)=='22-30'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="age-1">
                            22-30
                        </label>
                        <input class="form-check-input" type="radio" name="age" id="age-2" value="31-45"
                            <?php echo get_field('age',$user_id)=='31-45'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="age-2">

                            31-45
                        </label>
                        <input class="form-check-input" type="radio" name="age" id="age-3" value="46或以上"
                            <?php echo get_field('age',$user_id)=='46或以上'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="age-3">

                            46或以上
                        </label>
                        <!-- <input id="address" name="address" type="text" class="form-control"> -->

                    </td>
                </tr>

                <tr>
                    <td>子女數量：</td>
                    <td> <input class="form-check-input" type="radio" name="child" id="child-1" value="不適用"
                            <?php echo get_field('child',$user_id)=='不適用'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="child-1">
                            不適用
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-2" value="1"
                            <?php echo get_field('child',$user_id)=='1'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="child-2">
                            1
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-3" value="2"
                            <?php echo get_field('child',$user_id)=='2'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="child-3">
                            2
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-4" value="3"
                            <?php echo get_field('child',$user_id)=='3'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="child-4">
                            3
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-5" value="4"
                            <?php echo get_field('child',$user_id)=='4'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="child-4">
                            4
                        </label>
                        <input class="form-check-input" type="radio" name="child" id="child-5" value="5"
                            <?php echo get_field('child',$user_id)=='4個以上'? 'checked="checked"' :''?>>
                        <label class="form-check-label" for="child-5">
                            4個以上
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>關注資訊(可多項)：</td>

                    <td>
                        <?php //echo get_field('age');?>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-1" value="親子活動"
                            <?php echo in_array('親子活動', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-1">
                            親子活動
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-2" value="音樂"
                            <?php echo in_array('音樂', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-2">
                            音樂
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-3" value="文化"
                            <?php echo in_array('文化', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-3">
                            文化
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-4" value="繪本"
                            <?php echo in_array('繪本', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-4">
                            繪本
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-5" value="飲食"
                            <?php echo in_array('飲食', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-5">
                            飲食
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-6" value="運動"
                            <?php echo in_array('運動', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-6">
                            運動
                        </label>
                        <input class="form-check-input checkbox-list-box" type="checkbox" name="subscribe-info"
                            id="subscribe-info-7" value="天文"
                            <?php echo in_array('天文', get_field('subscribe_info',$user_id)) ? 'checked':''; ?>>
                        <label class="form-check-label" for="subscribe-info-7">
                            天文
                        </label>

                        <input type="text" class="form-control" placeholder="關注其他資訊" name="subscribe-info-other"
                            value="<?php echo get_field('subscribe_info_other',$user_id);?>">


                        <!-- 音樂。文化。繪本。飲食。運動。天文。其它 -->
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
                    <td></td>
                    <td class="text-end">

                        <button type="text" class="btn enter" value="">更新</button>
                        <!-- <button type="text" class="btn cancel" value="">取消</button> -->

                    </td>
                </tr>
            </table>

            <div class="welcome-msg mt-3 text-center">修改密碼：
            </div>

            <table class="reg-table mt-4" style="width:100%;max-width:556px">
                <tr>
                    <td style="width:32%"><label for="oldpassword"> 現有密碼：</label></td>
                    <td> <input class="form-control" type="password" id="oldpassword">

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

            <div class="remark"></div>



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


        var subscribe_info_arr = [];
        $('input[name="subscribe-info"]:checkbox:checked').each(function(i) {
            subscribe_info_arr[i] = $(this).val();
        });

        var subscribe_info_other = $('input[name="subscribe-info-other"]').val();

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
                    subscribe_info: subscribe_info_arr,
                    subscribe_info_other: subscribe_info_other,
                    address: address,
                    captcha: captcha,
                },
                dataType: "json",


                success: function(data) {
                    console.log(data);
                    if (data.status === '1') {


                        $.ajax({
                            type: "POST",
                            url: '<?php echo get_site_url();?>/wp-json/api/log-history',
                            data: {
                                log_msg: '會員更新資料成功。',
                            },
                            dataType: "json",
                            success: function(data) {}
                        })

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
                    // 
                    dataType: "json",
                    success: function(data) {
                        if (data.status === '1') {

                            $.ajax({
                                type: "POST",
                                url: '<?php echo get_site_url();?>/wp-json/api/log-history',
                                data: {
                                    log_msg: '會員更新密碼成功。',
                                },
                                dataType: "json",
                                success: function(data) {}
                            })

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
        }
    });


});
</script>

<?php
get_footer();