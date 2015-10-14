<?php
function bold($stringa){echo '<b>'.$stringa.'</b>';}
function italic($stringa){echo '<i>'.$stringa.'</i>';}
function underline($stringa){echo '<u>'.$stringa.'</u>';}
function br(){echo '<br />';}
function kbd($stringa){echo '<kbd>'.$stringa.'</kbd>';}
function center($stringa) {echo '<div align="center">'.$stringa.'</div>';}
function data2mysql($data){
if ($data and strtotime($data)){
	$anno=SubStr($data,6,4);
	$mese=SubStr($data,3,2);
	$giorno=SubStr($data,0,2);
	$div='-';
	return $anno.$div.$mese.$div.$giorno;}
else {
	return '';}
}	
function mysql2data($data){
if ($data and strtotime($data)){
	$anno=SubStr($data,0,4);
	$mese=SubStr($data,5,2);
	$giorno=SubStr($data,8,2);
	$div='/';
	return $giorno.$div.$mese.$div.$anno;}
else {
	return '';}
}
function data($data){
if ($data){
$anno=SubStr($data,0,4);
$mese=SubStr($data,5,2);
$giorno=SubStr($data,8,2);
$div='-';
	echo $giorno.$div.$mese.$div.$anno;}
else {
	echo '';}
}
?>