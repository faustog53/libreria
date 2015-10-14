<?php
$conn = mysql_connect("localhost", "root", "delphi") or die(mysql_error());
mysql_select_db("archeofvg", $conn) or die(mysql_error());
?>