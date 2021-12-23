<html>
<head>
    <style>
        body {
            margin-left:20%;
            margin-right:20%;
        }
        table, th, td {
            color: #002A60;
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        ol{
            list-style:none;
        }
        .test {
            font-family: sans-serif;
            font-size: 17px;
            font-weight: 100;
            display: inline;
            background-color: #ffffff;
            border: 2px solid #002A60;
            border-radius: 10px;
            color: #002A60;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .test:hover {
            background-color: #002A60;
            color: #e6ecff;
        }
    </style>
</head>

<body>
<br>
<?php session_start();?>
<?php require('login.php');?>
<hr>
<br>
<h6>CHROMIUM 10X GENOMICS REQUEST</h6>
<br>

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
            <p style="font-size:18px"> Users interested in the service are required to provide their own reagents and consumables. The Genomics core personnel will train and assist users interested in the technology to get familiarized with the set up and use of the machine. For first time users, please contact us directly to set a time for consultation.<br><br></p>
        </td>
        <td valign="top">
            <?php require("search_10x.php");?>
        </td>
    </tr>
</table>
<br><hr><br>

<form name="chromium" action="chromium10x_add_mysql.php" method="get">
    <p><b>For service request, please enter the following information: </b><br><br>
    <ul>
        <li>1.	How many samples do you want to run on Chromium 10x?&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" max="8" min="0" name="count" style="width:15mm" />&nbsp;&nbsp;samples</li><br>
        <li>2.	Cell diameter of all samples are under 30µm?&nbsp;&nbsp;&nbsp;&nbsp;<select name="diameter"><option value="ss" selected=\"selected\">Select</option><option value="Yes">YES</option><option value="No">NO</option></select></li><br>
        <li>3.	Remark&nbsp&nbsp<p style="font-size:12px">(optional, if you need to explain in detail)</p><br><br><textarea name="remark" rows="3" style="width:520px"></textarea></li>

    </ul>
    <br>
    <button class="test" id="demo" onclick="javascript:{this.disabled=true;document.chromium.submit();document.getElementById('demo').innerHTML='Waiting...';}">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="button" type="reset"/>
    <br><p style="color:#002A60;font-size:12px;line-height:30px">*Submission may take a few seconds, please do not click away from this page and wait for a response after clicking the submit button.</p><br>
</form>
