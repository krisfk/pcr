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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js"></script>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.14.2/jquery.daterangepicker.min.js">
    </script>

    <link href="style.css" rel="stylesheet">





    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.14.2/daterangepicker.min.css">


    <script type="text/javascript">
    $(function() {
        $('#i').dateRangePicker({
                inline: true,
                format: 'YYYY-MM-DD',
                container: '#ccc',
                alwaysOpen: false,
                singleMonth: true,
                showTopbar: false,
                setValue: function(s) {

                    // $(this).val('12-01-2017');
                }
            })
            .bind('datepicker-change', (e, data) => {
                $('#out').val(data.value);
                console.log(data);

            })
    })
    </script>
</head>

<body>

    <?php
require('../wp-load.php');
// require('./db-config.php');

require('./db-config.php');
$query = "SELECT * FROM traffic_record";

$result = mysqli_query($conn, $query);


    while($row = mysqli_fetch_assoc($result))
    {
    }



?>



    <div class="text-center mt-4">
        <h1>PCR website traffic records</h1>
        <!-- Today is <?php echo date("Y/m/d");?> -->

        <?php
        
        $post_id=$_GET['aid'];
        ?>
        <h4 class="mt-4">Traffic of <?php echo get_the_title($post_id);?> (<a target="_blank"
                href="<?php echo get_permalink($post_id);?>">link</a>)</h4>

        <div>
            <?php
            date_default_timezone_set('Asia/Hong_Kong');

            ?>
            <input id='out' placeholder="yy-mm-dd to yy-mm-dd" style='font-size: 14pt; width: 20em;'
                value="<?php echo date("Y-m-d");?> to <?php echo date("Y-m-d");?>" />
            <span id='i' class="fa fa-calendar"></span>
            <div id='ccc'></div>

            <!-- 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                    value="option1" />
                <label class="form-check-label" for="inlineRadio1">Today Traffic (<?php echo date("Y/m/d");?>)</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="option2" />
                <label class="form-check-label" for="inlineRadio2">

                    <input id='out' placeholder="mm/dd/yy to mm/dd/yy" style='font-size: 14pt; width: 20em;' />
                    <span id='i' class="fa fa-calendar"></span>
                    <div id='ccc'></div>

                </label>
            </div> -->



        </div>
    </div>

    <div class="container mt-4">

        <div class="row justify-content-center">

            <?php
        
     
   
    
    
    ?>
            <div class=""></div>


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