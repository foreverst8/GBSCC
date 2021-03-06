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
                displayEventTime: false,
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
            margin-left: 18%;
            margin-right: 18%;
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

        .laydate-time-list {
            padding-bottom: 0;
            overflow: hidden
        }

        .laydate-time-list>li {
            width: 50% !important;
        }

        .laydate-time-list>li:last-child {
            display: none;
        }

        div .note {
            color: red;
            font-size: 18px;
        }
    </style>
</head>

<br>
<?php session_start(); ?>
<?php require('login.php'); ?>

<div>
    <h6>Labconco Freeze Dryer (FreeZone 4.5 L 105C Benchtop) Booking</h6>
    <br>
    <p class="note"><b>Please check the availability calendar before making a reservation.</b></p>
    <br>
    <p class="note"><b>Your booking history: <a class="button" href="freeze_drier_user.php">Click</a></b></p>
    <br>
</div>


<table>
    <tr>
        <td align="left" valign="top">
            <?php
            $permission = $result_user[0]['sangerseq'];
            $result_user = search("select * from user where user_name='" . $_SESSION['username'] . "' and sangerseq='y'");

            if (count($result_user) == 0) {
                echo 'You do not have permission to access this page.<br/>';
                exit;
            }
            ?>
        </td>
    </tr>
</table>

<body>
    <div id='calendar'></div>

    <br>
    <form name="freezedrier" action="freeze_drier_add_mysql.php#top" method="get">
        <p style="color:red"><strong>Please note that the Metal adapter will be provided alongside any Chamber set selected.</strong></p>
        <br>
        <img src="./layout/metal_adapter.jpg" alt="metal adapter" title="metal adapter" height="150" width="150">
        <br>
        <br>
        <p style="color:red"><strong>Please select your chamber set:</strong></p>
        <br>
        <input type="radio" id="NoNeed" name="chamber" value="NoNeed" checked><label for="NoNeed">No chamber required</label>
        <br>
        <input type="radio" id="SetA" name="chamber" value="SetA"><label for="SetA">Set A (300ml flask with flask top)</label>
        <br>
        <img src="./layout/freezedrier_SetA.jpg" alt="freeze-drier SetA" title="freeze-drier SetA" height="150" width="150">
        <br>
        <input type="radio" id="SetB" name="chamber" value="SetB"><label for="SetB">Set B (900ml flask with flask top)</label>
        <br>
        <img src="./layout/freezedrier_SetB.jpg" alt="freeze-drier SetB" title="freeze-drier SetB" height="150" width="150">
        <br>
        <input type="radio" id="SetC" name="chamber" value="SetC"><label for="SetC">Set C (900ml flask with the 5-10ml tube holder and flask top)</label>
        <br>
        <img src="./layout/freezedrier_SetC.jpg" alt="freeze-drier SetC" title="freeze-drier SetC" height="150" width="150">
        <br>
        <p style="color:red"><b>Please select your time slot:</b>
        </p>
        <br>
        <p style="color:#002A60"><b>Start</b></p>
        <br>
        <input type="text" id="startdate" name="startdate" placeholder="Select date">&nbsp&nbsp
        <input type="text" id="starttime" name="starttime" placeholder="Select time">
        <br>
        <p style="color:#002A60"><b>End</b></p><br>
        <input type="text" id="enddate" name="enddate" placeholder="Select date">&nbsp&nbsp
        <input type="text" id="endtime" name="endtime" placeholder="Select time">
        <br>
        <br>
        <input class="button" type="submit" onclick="javascript:{this.disabled=true;document.freezedrier.submit();}">
        <p style="color:#002A60;font-size:12px;line-height:30px">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p>
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
    <hr>
</body>


</html>