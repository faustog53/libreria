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
<?php // require_once('../CSS/INC/errori.inc.php'); ?>
<?php
// $_SERVER['REMOTE_ADDR']
// $_SERVER['HTTP_USER_AGENT']
// $_SESSION['MM_Username']
 // or die(mysql_stampa_errore(mysql_error(), $_SERVER['PHP_SELF'], $query_limit_Recordset1));
    // <!--[if IE]>
    // <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    // <![endif]-->
function mysql_stampa_errore($errore, $procedura, $interrogazione)
{
?>
<doctype! html>
<html>
<head>
<title>Errore<?php echo $procedura;?></title>
<head>
<body>
    <br>
    <table align="center" width="800" cellspacing="0" cellpadding="4" border="1">
      <tr bgcolor="#e2e2e2">
        <td>
          <font color="#000000" face="helvetica,verdana" size="5">
           <b>ERRORE NELLA INTERROGAZIONE DEL DATABASE</b>
          </font>
        </td>
      </tr>
      <tr>
        <td>
          <font size="2" color="#4F4F4F" face="Helvetica, Verdana">
		  <br /> <br />
		    <h1 align="center">C' e' un errore nel programma: <br />Vi preghiamo di comunicarlo al responsabile!</h1><br /> <br />
            Procedura: <b> <?php echo $procedura;?></b> <br />
			Errore: <b> <?php echo $errore;?></b> <br />
			Interrogazione: <b> <?php echo $interrogazione;?></b> <br /><br />
			<ul>
			<li><b><i><a href="javascript: history.go(-1)">Torna indietro</a></i></b>.</li>
            <li><b><i><a href="index.php">Torna alla pagina iniziale</a></i></b>.</li>
			<li>
            <a href="mailto:fausto.gambardella@beniculturali.it?subject=ERRORE NELLA PROCEDURA: <?php echo $procedura;?>&body=Procedura: <?php echo $procedura;?>; Errore: <?php echo $errore;?>; Interrogazione: <?php echo $interrogazione;?>; Operatore: <?php echo $_SESSION['MM_Username'];?>">Scrivi una mail all'amministratore: fg</a></i></b>. </li>
			<li><a href="javascript:print();">Stampa questa pagina con l'errore</a></li>
			<li>Salva questa pagina con [Ctrl+S]!</li>
			</ul>
			<?php echo date('l d/m/Y H:i');?>
          </font>
        </td>
      </tr>
    </table>
</body>
</html>
	<?php
}
?>