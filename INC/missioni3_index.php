<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "http://www.archeo-fvg.beniculturali.it/archeofvg/";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php require_once('inc/archeofvg.php'); ?>
<?php require_once('inc/introiti_inc.php'); ?>
<?php require_once('inc/html-inc.php');

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 1000;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['cognome']) and isset($_GET['mese'])) {
  $cognome = (get_magic_quotes_gpc()) ? $_GET['cognome'] : addslashes($_GET['cognome']);
  $mese = (get_magic_quotes_gpc()) ? $_GET['mese'] : addslashes($_GET['mese']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE cognome = '%s'  AND EXTRACT(MONTH FROM data) = '%s'  ORDER BY data", $missioni_archeofvg, $cognome, $mese);
}
elseif (isset($_GET['missione'])) {
  $missione = (get_magic_quotes_gpc()) ? $_GET['missione'] : addslashes($_GET['missione']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE missione = %s " ,$missioni_archeofvg, $missione);
}
elseif (isset($_GET['query']) and isset($_GET['cognome'])) {
  $cognome = (get_magic_quotes_gpc()) ? $_GET['cognome'] : addslashes($_GET['cognome']);
  // $query = (get_magic_quotes_gpc()) ? $_GET['query'] : addslashes($_GET['query']);
  $query = $_GET['query'];
  $query_Recordset1 = sprintf( "%s AND cognome = '%s'", $query, $cognome);
}
elseif (isset($_GET['km'])) {
  $km = (get_magic_quotes_gpc()) ? $_GET['km'] : addslashes($_GET['km']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE km > 0 ", $missioni_archeofvg, $km);
}
elseif(isset($_GET['colonna']) AND isset($_GET['testo'])) { 
  $colonna = (get_magic_quotes_gpc()) ? $_GET['colonna'] : addslashes($_GET['colonna']);
  $testo   = (get_magic_quotes_gpc()) ? $_GET['testo'] : addslashes($_GET['testo']);
  // print $colonna;  print $testo;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE %s like '%".$testo."%'", 
  							$missioni_archeofvg, 
							$colonna);
}
elseif (isset($_GET['order'])) {
  $order = (get_magic_quotes_gpc()) ? $_GET['order'] : addslashes($_GET['order']);
  $query_Recordset1 = sprintf("SELECT * FROM %s ORDER BY %s", $missioni_archeofvg, $order);
}
elseif (isset($_GET['id'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE id = %s", $missioni_archeofvg, $colname_Recordset1);
}
elseif (isset($_GET['modifica'])) {
  $modifica = (get_magic_quotes_gpc()) ? $_GET['modifica'] : addslashes($_GET['modifica']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE modifica = '%s' ", $missioni_archeofvg, $modifica);
}
elseif (isset($_GET['ip'])) {
  $ip = (get_magic_quotes_gpc()) ? $_GET['ip'] : addslashes($_GET['ip']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE ip = '%s' ", $missioni_archeofvg, $ip);
}
elseif (isset($_GET['oper'])) {
  $oper = (get_magic_quotes_gpc()) ? $_GET['oper'] : addslashes($_GET['oper']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE oper = '%s' ", $missioni_archeofvg, $oper);
}
elseif (isset($_GET['data'])) {
  $data = (get_magic_quotes_gpc()) ? $_GET['data'] : addslashes($_GET['data']);
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE data = '%s' ", $missioni_archeofvg, $data);
}
elseif (isset($_GET['sede'])) {
  $sede = (get_magic_quotes_gpc()) ? $_GET['sede'] : addslashes($_GET['sede']);
  // $maxRows_inv = 100;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE sede = '%s' ORDER BY data", $missioni_archeofvg, $sede); 
}
elseif (isset($_GET['localita'])) {
  $localita = (get_magic_quotes_gpc()) ? $_GET['localita'] : addslashes($_GET['localita']);
  // $maxRows_inv = 100;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE localita = '%s' ORDER BY data", $missioni_archeofvg, $localita); 
}
elseif (isset($_GET['mezzo'])) {
  $mezzo = (get_magic_quotes_gpc()) ? $_GET['mezzo'] : addslashes($_GET['mezzo']);
  // $maxRows_inv = 100;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE mezzo = '%s' ORDER BY data", $missioni_archeofvg, $mezzo); 
}
elseif (isset($_GET['motivo'])) {
  $motivo = (get_magic_quotes_gpc()) ? $_GET['motivo'] : addslashes($_GET['motivo']);
  // $maxRows_inv = 100;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE motivo = '%s' ORDER BY data", $missioni_archeofvg, $motivo); 
}
elseif (isset($_GET['mese']) AND isset($_GET['cognome'])) {
  $mese = (get_magic_quotes_gpc()) ? $_GET['mese'] : addslashes($_GET['mese']);
  $anno = (get_magic_quotes_gpc()) ? $_GET['anno'] : addslashes($_GET['anno']);
  $cognome = (get_magic_quotes_gpc()) ? $_GET['cognome'] : addslashes($_GET['cognome']);
  // $maxRows_inv = 100;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE (cognome = '%s' AND EXTRACT(MONTH FROM Data) = '%s' AND EXTRACT(YEAR FROM Data) = '%s')  ORDER BY data", $missioni_archeofvg, $cognome, $mese, $anno); 
}
elseif (isset($_GET['cognome'])) {
  $cognome = (get_magic_quotes_gpc()) ? $_GET['cognome'] : addslashes($_GET['cognome']);
  // $maxRows_inv = 100;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE cognome = '%s' ORDER BY data DESC", $missioni_archeofvg, $cognome); 
}
elseif (isset($_GET['mese'])) {
  $mese = (get_magic_quotes_gpc()) ? $_GET['mese'] : addslashes($_GET['mese']);
  $anno = (get_magic_quotes_gpc()) ? $_GET['anno'] : addslashes($_GET['anno']);
  $maxRows_inv = 1000;
  $query_Recordset1 = sprintf("SELECT * FROM %s WHERE (EXTRACT(MONTH FROM Data) = '%s' AND EXTRACT(YEAR FROM Data) = '%s')  ORDER BY data", $missioni_archeofvg, $mese, $anno); 
}
elseif (isset($_GET['elenco'])) {
  $query_Recordset1 = "SELECT * FROM $missioni_archeofvg ORDER BY data DESC";
}
else {
   // $query_Recordset1 = "SELECT * FROM missioni_mese ";
	$query_Recordset1 = sprintf("SELECT * FROM %s 	WHERE EXTRACT(YEAR FROM data)= %s ORDER BY data DESC ", $missioni_archeofvg, date('Y')); // LIMIT 0, 10
}
mysql_select_db($database_archeofvg, $archeofvg);
// $query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$query_limit_Recordset1 = $query_Recordset1;
$Recordset1 = mysql_query($query_limit_Recordset1, $archeofvg) or die(mysql_error().'<strong>'.$query_limit_Recordset1);
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/CSS/stile1.css" rel="stylesheet" type="text/css" />
<title>MBAC-SBA-FVG-Missioni-<?php echo $cognome;?></title>
</head>

<body>
<?php 
if (!isset($_GET['stampa'])) {
include ("inc/introiti_head_inc.php");?>
<a href="missioni3_insert.php" title="INSERIMENTO NUOVA MISSIONE">inserimento</a> 
 - <a href="?elenco" title="ELENCO COMPLETO DELLE MISSIONI">elenco</a> - 
<a href="missioni3_riepiloghi.php" title="STAMPA RIEPILOGO DELLE MISSIONI">riepilogo</a> - 
<a href="missioni3_backup.php" title="BACKUP SALVATAGGIO COPIA DATI MISSIONI E UTENTI">backup</a> - 
<a href="missioni3_create_sql.php" title="BACKUP MMINISTRATORE - SALVATAGGIO STRUTTURA TABELLA MISSIONI">create</a> - 
<a href="blog_index.php" title="BLOG DELLA SOPRINTENDENZA">blog</a> -
<a href="missioni3_relazioni_index.php" title="CONTEGGIO DELLE MISSIONI E DELLE RELAZIONI REGISTRATE">relazioni</a>
<?php
$query_Recordset4 = sprintf("SELECT DISTINCT EXTRACT(YEAR FROM data) AS anno, EXTRACT(MONTH FROM data) AS mese FROM %s ORDER BY anno, mese ", $missioni_archeofvg);
$Recordset4 = mysql_query($query_Recordset4, $archeofvg) or die(mysql_error().'<strong>'.$query_Recordset3);
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
?><br />
Stampe dei mesi di: 
<table border="1" align="center">
    <tr>
  <?php  do { ?>
		 <td>
		 <a href="?stampa=&mese=<?php echo $row_Recordset4['mese'];?>&anno=<?php echo $row_Recordset4['anno']; ?>" title="RIEPILOGO DELLE MISSIONE DEL MESE: <?php echo $row_Recordset4['mese']; ?> E ANNO <?php echo $row_Recordset4['anno']; ?>">prosp.<?php echo $row_Recordset4['mese']; ?></a> -
		 <a href="missioni3_trasmissioni_index.php?stampa=&mese=<?php echo $row_Recordset4['mese'];?>&anno=<?php echo $row_Recordset4['anno']; ?>" title="RIEPILOGO DELLE MISSIONI REGISTRATE NEL MESE: <?php echo $row_Recordset4['mese']; ?> E ANNO <?php echo $row_Recordset4['anno']; ?>">trasm.<?php echo $row_Recordset4['mese']; ?></a> -
		 <a href="missioni3_riepiloghi.php?stampa=&mese=<?php echo $row_Recordset4['mese'];?>&anno=<?php echo $row_Recordset4['anno']; ?>" title="RIEPILOGO DELLE MISSIONI REGISTRATE NEL MESE: <?php echo $row_Recordset4['mese']; ?> E ANNO <?php echo $row_Recordset4['anno']; ?>">riepil.<?php echo $row_Recordset4['mese']; ?></a> -
		 </td>	
    <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
	     </tr>
</table>
<?php } ?>
<?php 
// 087-11-2013  STAMPA DELLE MISSIONI RICEVUTE
// SELECT DISTINCT cognome FROM missioni_2013 WHERE EXTRACT(YEAR FROM DATA)=2013 AND EXTRACT(MONTH FROM DATA)=10 LIMIT 0 , 30
?>
<?php // echo $query_Recordset2; ?>
<table border="1" align="center">
<caption><h1>Soprintendenza per i beni archeologici del Friuli Venezia Giulia<br />Riepilogo delle missioni
<?php 
if (isset($_GET['mese']) AND isset($_GET['anno'])){
?>
<br  />anno: <?php echo $anno; ?> - mese: <?php echo $mese; ?> 
<?php }?>
</h1> 
</caption>
  <tr>
  <td>ord.</td>
  <?php if (!isset($_GET['stampa'])) { ?>
    <td><a href="?order=id DESC " title="MISSIONI ORDINATE SECONDO IL NUMERO DI SEQUENZA DI IMMISSIONE">id</a></td>
	 <td>mese</td>
	 <td><a href="?order=missione DESC " title="MISSIONI ORDINATE SECONDO IL NUMERO DELLA MISSIONE">missione</a></td>
	 <td>prot.</td>
  <?php } ?>	 
    <td><a href="?order=data DESC " title="MISSIONI ORDINATE SECONDO LA DATA DELLA MISSIONE">data</a></td>
	 <td>dalle</td>
	 <td>alle</td>
    <td>
	 <a href="?order=cognome, nome "title="MISSIONI ORDINATE SECONDO COGNOME E NOME">cognome</a>
	 <a href="missioni3_menu.php?colonna=cognome"><img src="img/key.png" alt="seleziona" /></a>
	 </td>
<?php if (!isset($_GET['stampa'])) {?>
	 <td><img src="img/key.png" alt="seleziona" /></td>
<?php }?>
	 <td><a href="?order=sede" title="MISSIONI ORDINATE SECONDO LA SEDE DI SERVIZIO">sede</a></td>
    <td><a href="missioni3_ricerca.php?colonna=localita" title="RICERCA">localita'</a></td>
    <td><a href="missioni3_ricerca.php?colonna=motivo" title="RICERCA">motivo</a></td>
    <td><a href="missioni3_ricerca.php?colonna=mezzo" title="RICERCA">mezzo</a></td>
    <td>spese</td>
    <td><a href="?km=" title="SELEZIONI MISSIONI CON CHILOMETRAGGIO">km</a></td>
    <td>ore</td>
    <!--<td>note</td>-->
<!--    <td>modifica</td>-->
  <?php if (!isset($_GET['stampa'])) {?>
    <td><a href="?order=relazione_prot_data DESC " title="MISSIONI ORDINATE SECONDO LA DATA DEL PROTOCOLLO DELLA RELAZIONE DELLA MISSIONE">relazione</td>
    <td>
	 	<a href="?order=modifica DESC " title="MISSIONI ORDINATE SECONDO LA DATA DELL'ULTIMA MODIFICA">modifica</a> 
	 	<a href="missioni3_menu.php?colonna=modifica"><img src="img/key.png" alt="seleziona" /></a>
	 </td>
	 <td><img src="img/file.png" alt="incarico" /></td>
	 <td><img src="img/file.png" alt="scheda" /></td>
	 <td><img src="img/file.png" alt="relazione"/></td>
	 <td><img src="img/edit.png" alt="modifica" /></td>
	 <td><img src="img/insert.png" alt="inserisci" /></td>
	 <td><img src="img/delete.png" alt="elimina" /></td>
	 <td><img src="img/save.png" alt="backup" /></td>
  <?php }?>
  </tr>
  <?php  $ordine = 1; do { ?>
    <tr>
	 <td align="right"><?php echo $ordine;?></td>
	   <?php if (!isset($_GET['stampa'])) { ?>
      <td align="right"><a href="missioni3_disp.php?id=<?php echo $row_Recordset1['id']; ?>" title="MISSIONE N. <?php echo $row_Recordset1['missione']; ?>"> <?php echo $row_Recordset1['id']; ?></a> </td>
      <td align="center"><a href="?mese=<?php echo SubStr($row_Recordset1['data'],5,2); ?>&anno=<?php echo SubStr($row_Recordset1['data'],0,4); ?>" title="SELEZIONE LE MISSIONI CON MESE: <?php echo SubStr($row_Recordset1['data'],5,2); ?> "><?php echo SubStr($row_Recordset1['data'],5,2); ?></a></td>
		<td align="right"><a href="?missione=<?php echo $row_Recordset1['missione']; ?>"><?php echo $row_Recordset1['missione']; ?></a></td>
      <td align="right"><a href="missioni3_disp.php?id=<?php echo $row_Recordset1['id']; ?>" title="PROTOCOLLO DI <?php echo $row_Recordset1['protocollo_sede']; ?> N. <?php echo $row_Recordset1['protocollo']; ?> del <?php echo $row_Recordset1['protocollo_data']; ?>"> <?php echo $row_Recordset1['protocollo']; ?></a> </td>
		  <?php }?>
      <td><a href="?data=<?php echo $row_Recordset1['data']; ?>" title="SELEZIONA LE MISSIONI CON DATA: <?php echo mysql2data($row_Recordset1['data']); ?>"><?php echo mysql2data($row_Recordset1['data']); ?></a></td>
		<td><?php echo Substr($row_Recordset1['dalle'],0,5); ?>&nbsp; </td>
		<td><?php echo Substr($row_Recordset1['alle'],0,5); ?>&nbsp; </td>
      <td><a href="?cognome=<?php echo $row_Recordset1['cognome']; ?>"><?php echo $row_Recordset1['cognome']; ?> <?php echo $row_Recordset1['nome']; ?></a></td>
<?php if (!isset($_GET['stampa'])) {?>
		<td>
<a href="?cognome=<?php echo $row_Recordset1['cognome']; ?>&mese=<?php echo SubStr($row_Recordset1['data'],5,2); ?>&anno=<?php echo SubStr($row_Recordset1['data'],0,4); ?>" 
		title="SELEZIONE DELLE MISSIONI DI <?php echo $row_Recordset1['cognome']; ?> DELL'ANNO <?php echo SubStr($row_Recordset1['data'],0,4); ?> DEL MESE <?php echo SubStr($row_Recordset1['data'],5,2); ?>"><img src="img/key.png" alt="seleziona" /></a>		
		</td>
<?php }?>
      <td><a href="?sede=<?php echo $row_Recordset1['sede']; ?>" title="SELEZIONA LE MISSIONI CON SEDE: <?php echo $row_Recordset1['sede']; ?> (<?php echo $row_Recordset1['sede_indirizzo']; ?>)"><?php echo $row_Recordset1['sede']; ?></a></td>
      <td><a href="?localita=<?php echo $row_Recordset1['localita']; ?>"><?php echo $row_Recordset1['localita']; ?></a></td>
      <td><a href="?motivo=<?php echo $row_Recordset1['motivo']; ?>" title="MISSIONE N. <?php echo $row_Recordset1['missione']; ?>"><?php echo $row_Recordset1['motivo']; ?></a></td>
      <td><a href="?mezzo=<?php echo $row_Recordset1['mezzo']; ?>"><?php echo $row_Recordset1['mezzo']; ?></a></td>
      <td align="right"><?php echo $row_Recordset1['spese']; ?>&nbsp; </td>
		<td align="right"><?php echo $row_Recordset1['km']; ?>&nbsp; </td>
      <td><?php echo $row_Recordset1['ore']; ?>-<?php echo //SubStr($row_Recordset1['ore_dalle'],0,5); ?>-<?php //echo SubStr($row_Recordset1['ore_alle'],0,5); ?></td>
     <!-- <td><?php // echo Substr($row_Recordset1['note'],0,5); ?>&nbsp; </td>-->
      <!--<td><?php // echo $row_Recordset1['modifica']; ?>-<?php // echo $row_Recordset1['ip']; ?>-<?php // echo $row_Recordset1['oper']; ?></td>-->
	<?php if (!isset($_GET['stampa'])) {?>
		<td><a href="<?php echo $row_Recordset1['relazione_scansione']; ?>" title="relazione prot.n. <?php echo $row_Recordset1['relazione_prot']; ?> del <?php echo mysql2data($row_Recordset1['relazione_prot_data']); ?> di <?php echo $row_Recordset1['relazione_prot_sede']; ?>"><?php echo mysql2data($row_Recordset1['relazione_data']); ?><hr /><?php echo bold(mysql2data($row_Recordset1['relazione_prot_data'])); ?></a></td>
		<td>
		   <a href="missioni3_storico.php?id_missione=<?php echo $row_Recordset1['id']; ?>">mod</a>
			<a href="?oper=<?php echo $row_Recordset1['oper']; ?>" title="operatore: <?php echo $_SESSION['MM_UserCognome']; ?>"><?php echo $row_Recordset1['oper']; ?></a>-
			<a href="?modifica=<?php echo $row_Recordset1['modifica']; ?>"><?php echo mysql2data($row_Recordset1['modifica']); ?></a>-
			<a href="?ip=<?php echo $row_Recordset1['ip']; ?>"><?php echo $row_Recordset1['ip']; ?></a>-
			<a href="?agent=<?php echo $row_Recordset1['agent']; ?>" title="<?php echo $row_Recordset1['agent']; ?>">ua</a>
		</td>
		<td><a href="missioni3_incarico.php?id=<?php echo $row_Recordset1['id']; ?>" title="STAMPA L'INCARICO"><img src="img/file.png" alt="incarico" /></a></td>
		<td><a href="missioni3_relazione.php?id=<?php echo $row_Recordset1['id']; ?>" title="STAMPA LA RELAZIONE"><img src="img/file.png" alt="scheda" /></a></td>
		<td><a href="missioni3_scheda.php?id=<?php echo $row_Recordset1['id']; ?>" title="STAMPA LA SCHEDA "><img src="img/file.png" alt="relazione" /></a></td>
		<td><a href="missioni3_edit.php?id=<?php echo $row_Recordset1['id']; ?>" title="MODIFICA MISSIONE"><img src="img/edit.png" alt="modifica" /></a></td>
		<td><a href="missioni3_insert.php?id=<?php echo $row_Recordset1['id']; ?>" title="COPIA MISSIONE"><img src="img/insert.png" alt="aggiungi" /></a></td>
		<td><a href="missioni3_item.php?id=<?php echo $row_Recordset1['id']; ?>"  title="ELIMINA MISSIONE"><img src="img/delete.png" alt="elimina" /></a></td>		
		<td><a href="missioni3_backup_nome.php?cognome=<?php echo $row_Recordset1['cognome'];?>" title="copia di sicurezza locale delle missioni di <?php echo $row_Recordset1['cognome']; ?>"><img src="img/save.png" alt="backup" /></a></td>
	<?php }?>		
    </tr>
    <?php $ordine += 1; } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<h1 align="center"><a href="javascript: history.go(-2)">Back</a></h1>
stampato il <?php echo date('H:i d-m-Y');?> - <?php echo $query_limit_Recordset1;?> 
<!--<form action="?" method="get" name="f_query">query: <input name="query" type="text" size="80" value="<?php // echo $query_Recordset1;?>" /><input name="" type="submit" value="cerca" /></form> -->
<?php
if ((isset($_GET['elenco'])) and !isset($_GET['stampa'])) {
$query_Recordset2 = sprintf("SELECT DISTINCT cognome FROM %s ORDER BY cognome", $missioni_archeofvg); 
$Recordset2 = mysql_query($query_Recordset2, $archeofvg) or die(mysql_error().'<strong>'.$query_Recordset2);
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

?>
<table border="1" align="center">
    <tr>
  <?php do { 
		echo '<td><a href="?cognome='.$row_Recordset2['cognome'].'">'.$row_Recordset2['cognome'].'</a></td>';	
    } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
	     </tr>
</table>
<?php
//$query_Recordset3 = "SELECT DISTINCT motivo FROM missioni ORDER BY motivo"; 
//$Recordset3 = mysql_query($query_Recordset3, $archeofvg) or die(mysql_error().'<strong>'.$query_Recordset3);
//$row_Recordset3 = mysql_fetch_assoc($Recordset3);
?>
<table border="1" align="center">
    <tr>
  <?php // do { 
		// echo '<td><a href="?motivo='.$row_Recordset3['motivo'].'">'.$row_Recordset3['motivo'].'</a></td>';	
    //} while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
	     </tr>
</table>
<?php // echo $query_Recordset2; ?>
<br />
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">Primo</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Indietro</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Avanti</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Ultimo</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>

Record da <?php echo ($startRow_Recordset1 + 1) ?> a <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> su <?php echo $totalRows_Recordset1 ?>
<div align="center">
<?php 

mysql_free_result($Recordset2);
// mysql_free_result($Recordset3);
?>
<?php } ?>
</div>
<?php include ("inc/footer.inc.php");?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

