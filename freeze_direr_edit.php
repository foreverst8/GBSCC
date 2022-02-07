<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link rel="stylesheet" type="text/css" href="layout/styles/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
    <script src="moment.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 650,
                displayEventTime : false,
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                displayEventEnd: {
                    month: true,
                    basicWeek: true,
                    "default": true
                },
                events: 'freeze_drier_json_data.php',
            });

            calendar.render();
        });

    </script>

    <style>
        body {
            margin-left:18%;
            margin-right:18%;
        }
        #calendar {
            background: white;
        }
        .fc-day-today {
            background: #D1E2C4 !important;
        }
        .fc-event {
            font-weight: bold;
        }
        .fc-event {
            white-space: normal !important;
            overflow: hidden;
        }
        .laydate-time-list{padding-bottom:0;overflow:hidden}
        .laydate-time-list>li{width:50%!important;}
        .laydate-time-list>li:last-child{display:none;}
    </style>
</head>




<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>Edit Booking</h6><br>
<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission=$result_user[0]['sangerseq'];
            $result_user=search("select * from user where user_name='".$_SESSION['username']."' and sangerseq='y'");

            if(count($result_user)==0){
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }
            
            ?>
        </td>
    </tr>
</table>
<p style="font-size:18px;color:red"><b>Please check the availability calendar before editing your booking</b></p><br><br>
<p style="font-size:18px;color:red"><b>Your current selected time slot: </b></p>
<?php
$id=$_GET['id'];

$edit=search("select * from genomics_core.freezedrier where id='$id'");
if ($edit != "") {
echo "&nbsp&nbspfrom&nbsp&nbsp";
echo $edit[0]['startdate'];
echo "&nbsp&nbsp";
echo $edit[0]['starttime'];
echo "&nbsp&nbspto&nbsp&nbsp";
echo $edit[0]['enddate'];
echo "&nbsp&nbsp";
echo $edit[0]['endtime'];
echo "<br><br>";


echo "<body>";
echo "<div id='calendar'></div>";

echo "<br><br>";
echo "<form name=\"freezedrier_edit\" action=\"freeze_drier_edit_mysql.php#top\" method=\"get\">";
echo "<input type=\"hidden\" value=\"" . $edit[0]['id'] . "\" name=\"id\" id=\"id\">";
echo "<input type=\"hidden\" value=\"" . $edit[0]['user'] . "\" name=\"user\" id=\"user\">";
echo "<input type=\"hidden\" value=\"" . $edit[0]['lab'] . "\" name=\"lab\" id=\"lab\">";
echo "<p style=\"color:#002A60\"><b>change start time to:</b></p><br>";
echo "<input type=\"text\" id=\"startdate\" name=\"startdate\" placeholder=\"Select date\">";
echo "&nbsp&nbsp";
echo "<input type=\"text\" id=\"starttime\" name=\"starttime\" placeholder=\"Select time\">";
echo "<br><br>";
echo "<p style=\"color:#002A60\"><b>change end time to:</b></p><br>";
echo "<input type=\"text\" id=\"enddate\" name=\"enddate\" placeholder=\"Select date\">";
echo "&nbsp&nbsp";
echo "<input type=\"text\" id=\"endtime\" name=\"endtime\" placeholder=\"Select time\">";
echo "<br><br><br><br><br><br><br><br><br><br>";
echo "<input class=\"button\" type=\"submit\"><br><br><br><br><br><br><br><br><br><hr><br><br><br><br><br><br>";
} else {
    echo "This booking has been deleted.";
}
?>

    <script src="https://cdn.jsdelivr.net/npm/layui-laydate@5.3.1/src/laydate.min.js"></script>
    <script>
        laydate.render({
            elem: '#startdate',
            btns: ['confirm'],
            lang: 'en'
        });
        laydate.render({
            elem: '#starttime',
            type: 'time',
            format: 'HH:mm',
            lang: 'en'
        });
        laydate.render({
            elem: '#enddate',
            btns: ['confirm'],
            lang: 'en'
        });
        laydate.render({
            elem: '#endtime',
            type: 'time',
            format: 'HH:mm',
            lang: 'en'
        });
    </script>

</body>
</html>