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

                var str = data.value;
                var date_arr = str.split(" ");
                var from_date = date_arr[0];
                var to_date = date_arr[2];

                window.location =
                    '<?php echo get_site_url().'/traffic/article.php?aid='.$_GET['aid'].'&from_date='.$from_date.'&to_date='.$to_date;?>'
            })
    })
    </script>
</head>

<body>

    <?php
require('../wp-load.php');
date_default_timezone_set('Asia/Hong_Kong');


$servername = TRAFFIC_SERVER_NAME;
$username = TRAFFIC_USER_NAME;
$password = TRAFFIC_PASSWORD;
$dbname = TRAFFIC_DBNAME;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$aid=$_GET['aid'];

// DATE(datetime) = '2009-10-20'

$from_date = $_GET['from_date'] ? $_GET['from_date'] : date("Y-m-d");
$to_date = $_GET['to_date'] ? $_GET['to_date'] : date("Y-m-d");

$query = "SELECT * FROM traffic_record WHERE post_id = $aid AND DATE(datetime) >= '$from_date' AND  DATE(datetime) <= '$to_date'   ORDER BY datetime DESC";

$result = mysqli_query($conn, $query);


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

            <input id='out' placeholder="yy-mm-dd to yy-mm-dd" style='font-size: 14pt; width: 20em;'
                value="<?php echo date("Y-m-d");?> to <?php echo date("Y-m-d");?>" />
            <span id='i' class="fa fa-calendar"></span>
            <div id='ccc'></div>



        </div>
    </div>

    <table class="container mt-4">

        <?php
    while($row = mysqli_fetch_assoc($result))
    {
     ?>
        <tr class="row justify-content-center">

            <td class="col-2"><?php echo $row['user_id'] == 0 ? '無登入':get_field('account_name',$row['user_id']);?>
            </td>
            <td class="col-3"><?php echo $row['user_id'] == 0 ? '-':get_field('email',$row['user_id']);?></td>
            <td class="col-2"><?php echo $row['datetime'];?></td>
            <td class="col-2"><?php echo $row['IP'];?></td>

        </tr>
        <?php   
    }



?>
        </tb>


        <script type="text/javascript">
        $(function() {

            $('.articles-col .num').html($('.articles-col ul li').length)

            $('.member-col .num').html($('.member-col ul li').length)


        })
        </script>
</body>

</html>