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
                events: 'dropletpcr_json_data.php',
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
        .laydate-time-list>li:last-child{display: none;}
    </style>
</head>




<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>Droplet Digital PCR Booking</h6><br>
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
<p style="font-size:18px;color:red"><b>Please check the availability calendar before making a reservation.</b></p><br><br>
<p style="font-size:18px;color:red"><b>Your booking history: <a class="button" href="dropletpcr_user.php">Click</a></b></p><br><br>

<body>
<div id='calendar'></div>

<br>
<br>

<form name="dropletpcr" action="dropletpcr_add_mysql.php#top" method="get">
    <p style="color:red"><b>Please select your time slot:</b></p><br><br>
    <p style="color:#002A60"><b>Start</b></p><br>
    <input type="text" id="startdate" name="startdate" placeholder="Select date">&nbsp&nbsp
    <input type="text" id="starttime" name="starttime" placeholder="Select time">
    <br><br>
    <p style="color:#002A60"><b>End</b></p><br>
    <input type="text" id="enddate" name="enddate" placeholder="Select date">&nbsp&nbsp
    <input type="text" id="endtime" name="endtime" placeholder="Select time">
    <br><br><br><br><br><br><br><br><br><br>
    <input class="button" type="submit" onclick="javascript:{this.disabled=true;document.dropletpcr.submit();}">
    <br><p style="color:#002A60;font-size:12px;line-height:30px">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p>
</form>



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

<br><br><br><br><br><br><br><hr><br><br><br><br><br><br>
</body>


</html>