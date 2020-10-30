<?php
$date = date("U");
echo $date;
echo "<br>";
echo gmdate("Y-m-d H:i:s", $date);
echo "<br>";
$date = date("U") + 60;
echo $date;
echo "<br>";
echo gmdate("Y-m-d H:i:s", $date);