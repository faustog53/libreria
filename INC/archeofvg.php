<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_archeofvg = "localhost";
$database_archeofvg = "archeofvg";
$username_archeofvg = "archeofvg";
$password_archeofvg = "4rch30fv";
$missioni_archeofvg = "sba_missioni";
$missioni_mod_archeofvg = "sba_missioni_storico";
$utenti_archeofvg   = "bib_utenti";
$usr_archeofvg = array('mt','pl','fg','df');
$archeofvg = mysql_pconnect($hostname_archeofvg, $username_archeofvg, $password_archeofvg) or trigger_error(mysql_error(),E_USER_ERROR); 
?>