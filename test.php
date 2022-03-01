<?php
ini_set("date.timezone", "Asia/Shanghai");

echo '<br>本周起始时间:<br>';
$Monday = date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")));
$Sunday = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));
$now =  date('Y-m-d h:i:s',time());

if ($now < $Sunday) {
    print 'Yes';
}
else {
    print "No";
};

echo '<br>';

if ($now > $Monday) {
    print 'Yes';
}
else {
    print "No";
}

?>