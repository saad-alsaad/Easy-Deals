<?php
session_start();
require "../../Info/good_manager_ident.php";
include "../../db.php";
$output = array();
$output1 = array();
$conn = mysqli_connect($server,$username,$password,$db,$port) or die('Error in database');
$sSQL= 'SET CHARACTER SET utf8';
mysqli_query($conn, $sSQL);
$query = "SELECT notification.notification_id, notification.sender_id,notification.Message,notification.type,users.First_name,users.Last_name FROM notification,users WHERE notification.receiver_id = '$_SESSION[id]' AND notification.type = 0 AND users.ID = notification.sender_id ORDER BY notification.sent_time DESC LIMIT 5";
$result = mysqli_query($conn, $query);

for($i = 0;$row = mysqli_fetch_array($result); $i++){
    $output[0][$i] = $row['First_name']." ".$row['Last_name'];
    $output[1][$i] = $row['Message'];
}

$query1 = "SELECT payments.dealer_id,payments.Date,payments.amount,payments.type,payments.Bill_id,users.ID,users.First_name,users.Last_name FROM payments,bills,users WHERE bills.Bill_id = payments.Bill_id AND bills.company_id = '$_SESSION[com_id]' AND users.ID = payments.dealer_id ORDER BY payments.Date DESC LIMIT 5";

mysqli_query($conn, $query1) or die("Error in query 1");
$result1 = mysqli_query($conn, $query1);

for($i = 0;$row1 = mysqli_fetch_assoc($result1);$i++){
    $output1[0][$i] = $row1['Bill_id'];
    $output1[1][$i] = $row1['First_name']." ".$row1['Last_name'];
    $output1[2][$i] = $row1['amount'];

    if($row1['type'] == '0')
        $output1[3][$i] = "كـاش";
    elseif ($row1['type'] == '1')
        $output1[3][$i] = "شـيـك";
    elseif ($row1['type'] == '2')
        $output1[3][$i] = "تـقـسـيـط";
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Easy Deals | حساب الـشـركة</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../../RTL/css/bootstrap-arabic.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="../../css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../../css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link rel="icon" type="text/png" href="../../images/Icon.png" >

        <script src="../../js/ajax_jquery3.1.0.min.js"></script>

        <style>
            #main_page{
                background-color:  #EFEBE9;}

            .counter{
                color: #ac2925;
            }
            .text-box p{
                margin: 4px 0 0 3px;

            }

            .noti-box {
                min-height: 100px;
                padding: 15px;
            }

            .noti-box .icon-box {
                display: block;
                float: right;
                margin: 0 15px 10px 0;
                width: 70px;
                height: 70px;
                line-height: 75px;
                vertical-align: middle;
                text-align: center;
                font-size: 40px;
            }

            .panel-back {
                background-color:#F8F8F8;

            }

            .set-icon {
                -webkit-border-radius: 50px;
                -moz-border-radius: 50px;
                border-radius: 50px;

            }

            .noti-box .icon-box {
                display: block;
                float: right;
                margin: 0 15px 10px 0;
                width: 70px;
                height: 70px;
                line-height: 75px;
                vertical-align: middle;
                text-align: center;
                font-size: 40px;
            }

            .chat-box {
                margin: 0;
                padding: 0;
                list-style: none;
            }
            .chat-box li {
                margin-bottom: 15px;
                padding-bottom: 5px;
                border-bottom: 1px dotted #808080;
            }
            .chat-box li.left .chat-body {
                margin-left: 90px;
            }
            .chat-box li .chat-body p {
                margin: 0;
                color: #8d8888;
            }

        </style>
    </head>

    <body>

    <?php include "../header.php"; ?>

    <div id="wrapper">
        <!-- /. NAV TOP  -->
        <?php include "Main_Menu.php"; ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" style="min-height: 700px;">
            <div id="page-inner" style="min-height: 700px;">
                <div class="container" style="width: 100%;">
                    <div class="form-group">
                        <div class="col-md-12">
                            <center><h2>الصــفــحة الرئــيــسـية</h2></center>
                            <?php echo '<h4>'.'أهـلا وسـهـلا  '.'</h4>'.$_SESSION['f_name'].' '.$_SESSION['l_name']; ?>
                            <br>
                            <hr>
                            <br>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box Edges">
                                    <span class="icon-box bg-color-red set-icon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="main-text"> جديد <span class="message_count counter"></span></p>
                                        <p class="text-muted">رسائل</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box Edges">
                                    <span class="icon-box bg-color-red set-icon">
                                        <i class="glyphicon glyphicon-star"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="main-text"> جديد <span class="reminder_count counter"></span></p>
                                        <p class="text-muted">تـنـبـيـهات</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box Edges">
                                    <span class="icon-box bg-color-red set-icon">
                                        <i class="glyphicon glyphicon-bell"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="main-text"> جديد <span class="bill_count counter"></span></p>
                                        <p class="text-muted">فـواتـير جـديدة</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="panel panel-back noti-box Edges">
                                    <span class="icon-box bg-color-brown set-icon">
                                        <i class="fa fa-rocket"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="main-text"> جديد <span class="order_count counter"></span></p>
                                        <p class="text-muted">طـلـبـات</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">

                            <!-- messages -->
                            <div class="col-md-6">
                                <div class="chat-panel panel panel-default chat-boder chat-panel-head Edges" >
                                    <div class="panel-heading Edges">
                                        <a href="Notifications.php"><i class="fa fa-comments fa-fw"></i></a>   أخر الرسائل
                                    </div>

                                    <div class="panel-body">
                                        <ul class="chat-box">
                                            <?php for($j = 0; $j < count($output[0]);$j++){ ?>
                                            <li class="left clearfix">
                                                <div class="chat-body">
                                                    <strong ><?php echo $output[0][$j]; ?></strong>
                                                    <small class="pull-right text-muted">
                                                        <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                                    </small>
                                                    <p>
                                                        <?php echo $output[1][$j]; ?>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="input-group">
                                            <!-- <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message to send..." />
                                             <span class="input-group-btn">
                                         <button class="btn btn-warning btn-sm" id="btn-chat">
                                             Send
                                         </button>
                                     </span>-->
                                         </div>
                                     </div>
                                </div>
                            </div>
                            <!-- payments -->
                            <div class="col-md-6">
                                <div class="panel panel-default Edges">
                                    <div class="panel-heading Edges">
                                    <a href="Payments.php"><i class="glyphicon glyphicon-usd"></i></a>اخر الدفعات
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>رقم الفاتورة</th>
                                                    <th>الزبون</th>
                                                    <th>قيمة الدفعة</th>
                                                    <th>نوع الدفع</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php for($j = 0; $j < count($output1[0]);$j++){ ?>
                                                <tr>
                                                    <td><a href="Payments.php"><?php echo $output1[0][$j]; ?></a></td>
                                                    <td><?php echo $output1[1][$j]; ?></td>
                                                    <td><?php echo $output1[2][$j]; ?></td>
                                                    <td><?php echo $output1[3][$j]; ?></td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <!-- JQUERY SCRIPTS -->
    <script src="../../js/jquery-1.11.3.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../RTL/js/bootstrap-arabic.min.js"></script>

    </body>
    </html>
<?php require "../../notification/notification_checker.php"; ?>