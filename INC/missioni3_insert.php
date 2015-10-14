<?php require_once('inc/introiti_inc.php'); ?>
<?php require_once('inc/archeofvg.php'); ?>
<?php require_once('inc/html-inc.php');
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

// include('missioni3_storico_ins_inc.php'); 
// Non si può perché non ho ancora l'id ???
// 29 ottobre 2011
$next_missioneSQL = sprintf("SELECT MAX(missione) AS max FROM %s", $missioni_archeofvg);
mysql_select_db($database_archeofvg, $archeofvg);
$Recorset2 = mysql_query($next_missioneSQL, $archeofvg) or die(mysql_error().'<strong>'.$next_missioneSQL);
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$next_missione = $row_Recordset1['max']+1;

  $insertSQL = sprintf("INSERT INTO %s (id, firma_titolo, firma_nome, `data`, `data_da`, `data_a`, mese, titolo, nome, cognome, partenza,  partenza_ore, localita, sede, sede_indirizzo, sede_cap, protocollo_ufficio, protocollo_sede, protocollo, protocollo_data, missione, rientro, motivo, mezzo, autorizzazione, spese, spese_trasporti, spese_pasti, spese_pernotte, note, ore, ore_dalle, ore_alle, dalle, alle, modifica, relazione_data, relazione_prot, relazione_prot_sede,relazione_prot_data, ip, agent, oper)  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
  					$missioni_archeofvg,
					GetSQLValueString($next_missione, "int"),
					StrToUpper(GetSQLValueString($_POST['firma_titolo'], "text")),
					GetSQLValueString($_POST['firma_nome'], "text"),
					GetSQLValueString(data2mysql($_POST['data_da']), "date"),
					GetSQLValueString(data2mysql($_POST['data_da']), "date"),
					GetSQLValueString(data2mysql($_POST['data_a']), "date"),
					GetSQLValueString(Substr(data2mysql($_POST['data_da']),5,2),"int"),
					GetSQLValueString($_POST['titolo'], "text"),
					GetSQLValueString($_POST['nome'], "text"),
					GetSQLValueString($_POST['cognome'], "text"),
					StrToUpper(GetSQLValueString($_POST['partenza'], "text")),
					GetSQLValueString($_POST['partenza_ore'], "date"),
					StrToUpper(GetSQLValueString($_POST['localita'], "text")),
					GetSQLValueString($_POST['sede'], "text"),
					GetSQLValueString($_POST['sede_indirizzo'], "text"),
					StrToUpper(GetSQLValueString($_POST['sede_cap'], "text")),
					StrToUpper(GetSQLValueString($_POST['protocollo_ufficio'], "text")),
					StrToUpper(GetSQLValueString($_POST['protocollo_sede'], "text")),
					GetSQLValueString($_POST['protocollo'], "int"),
					GetSQLValueString(data2mysql($_POST['protocollo_data']), "date"),
					GetSQLValueString($nextMissione, "int"),
					GetSQLValueString($_POST['rientro'], "text"),
					StrToUpper(GetSQLValueString($_POST['motivo'], "text")),
					StrToUpper(GetSQLValueString($_POST['mezzo'], "text")),
					StrToUpper(GetSQLValueString($_POST['autorizzazione'], "text")),
					GetSQLValueString($_POST['spese'], "double"),
					GetSQLValueString($_POST['spese_trasporti'], "double"),
					GetSQLValueString($_POST['spese_pasti'], "double"),
					GetSQLValueString($_POST['spese_pernotte'], "double"),
					GetSQLValueString($_POST['note'], "text"),
					GetSQLValueString($_POST['ore'], "double"),
					GetSQLValueString($_POST['ore_dalle'], "date"),
					GetSQLValueString($_POST['ore_alle'], "date"),
					GetSQLValueString($_POST['dalle'], "date"),
					GetSQLValueString($_POST['alle'], "date"),
					GetSQLValueString(Date('Y-m-d'), "date"),
  					GetSQLValueString(data2mysql($_POST['relazione_data']), "date"),
					GetSQLValueString($_POST['relazione_prot'], "int"),
				   GetSQLValueString($_POST['relazione_prot_sede'], "text"),
					GetSQLValueString(data2mysql($_POST['relazione_prot_data']), "date"),
					GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
					GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"),
					GetSQLValueString($_SESSION['MM_Username'], "text"));

  // mysql_select_db($database_archeofvg, $archeofvg);
  $Result1 = mysql_query($insertSQL, $archeofvg) or die(mysql_error().'<strong>'.$insertSQL);

    $insertSQL = sprintf("INSERT INTO %s (id_missione, missione, `data`, data_da, data_a, dalle, alle, ore_totali, partenza, partenza_ore, autorizzazione, titolo, nome, cognome, mese, localita, sede, sede_cap, sede_indirizzo, protocollo_ufficio, protocollo_sede, protocollo, protocollo_data, motivo, firma_titolo, firma_nome, mezzo, spese, spese_trasporti, spese_pasti, spese_pernotte, note, ore, ore_dalle, ore_alle, data_dipendente, modifica, ip, oper, scansione, agent, capitolo, af, perizia, piano_spesa, rientro, km, relazione, relazione_data, relazione_prot, relazione_prot_sede, relazione_prot_data, relazione_scansione) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       $missioni_mod_archeofvg, 
					        GetSQLValueString($_POST['missione'], "int"),
                       GetSQLValueString($_POST['missione'], "int"),
                       GetSQLValueString(data2mysql($_POST['data_da']), "date"),
                       GetSQLValueString(data2mysql($_POST['data_da']), "date"),
                       GetSQLValueString(data2mysql($_POST['data_a']), "date"),
                       GetSQLValueString($_POST['dalle'], "date"),
                       GetSQLValueString($_POST['alle'], "date"),
                       GetSQLValueString($_POST['ore_totali'], "double"),
                       GetSQLValueString($_POST['partenza'], "text"),
                       GetSQLValueString($_POST['partenza_ore'], "date"),
                       GetSQLValueString($_POST['autorizzazione'], "text"),
                       GetSQLValueString($_POST['titolo'], "text"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['cognome'], "text"),
                       GetSQLValueString(Substr(data2mysql($_POST['data_da']),5,2), "int"),
                       StrToUpper(GetSQLValueString($_POST['localita'], "text")),
                       GetSQLValueString($_POST['sede'], "text"),
                       GetSQLValueString($_POST['sede_cap'], "text"),
                       GetSQLValueString($_POST['sede_indirizzo'], "text"),
                       StrToUpper(GetSQLValueString($_POST['protocollo_ufficio'], "text")),
                       StrToUpper(GetSQLValueString($_POST['protocollo_sede'], "text")),
                       GetSQLValueString($_POST['protocollo'], "int"),
                       GetSQLValueString(data2mysql($_POST['protocollo_data']), "date"),
                       StrToUpper(GetSQLValueString($_POST['motivo'], "text")),
                       StrToUpper(GetSQLValueString($_POST['firma_titolo'], "text")),
                       GetSQLValueString($_POST['firma_nome'], "text"),
                       StrToUpper(GetSQLValueString($_POST['mezzo'], "text")),
                       GetSQLValueString($_POST['spese'], "double"),
                       GetSQLValueString($_POST['spese_trasporti'], "double"),
                       GetSQLValueString($_POST['spese_pasti'], "double"),
                       GetSQLValueString($_POST['spese_pernotte'], "double"),
					   GetSQLValueString($_POST['note'], "text"),
                       GetSQLValueString($_POST['ore'], "double"),
                       GetSQLValueString($_POST['ore_dalle'], "date"),
                       GetSQLValueString($_POST['ore_alle'], "date"),
                       GetSQLValueString($_POST['data_dipendente'], "date"),
					   GetSQLValueString(Date('Y-m-d'), "date"),
					   GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
                       GetSQLValueString($_SESSION['MM_Username'], "text"),
                       GetSQLValueString($_POST['scansione'], "text"),
  					   GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"),
                       GetSQLValueString($_POST['capitolo'], "int"),
                       GetSQLValueString($_POST['af'], "date"),
                       GetSQLValueString($_POST['perizia'], "int"),
                       GetSQLValueString($_POST['piano_spesa'], "text"),
                       GetSQLValueString($_POST['rientro'], "text"),
                       GetSQLValueString($_POST['km'], "int"),
                       GetSQLValueString($_POST['relazione'], "text"),
                       GetSQLValueString(data2mysql($_POST['relazione_data']), "date"),
                       GetSQLValueString($_POST['relazione_prot'], "int"),
					   GetSQLValueString($_POST['relazione_prot_sede'], "text"),
                       GetSQLValueString(data2mysql($_POST['relazione_prot_data']), "date"),
                       GetSQLValueString($_POST['relazione_scansione'], "text"));

  // mysql_select_db($database_archeofvg, $archeofvg);
  $Result1 = mysql_query($insertSQL, $archeofvg) or die(mysql_error().': <br /><strong>'.$insertSQL);
  
  $insertGoTo = "missioni3_index.php?cognome=".$_POST['cognome']."&mese=".SubStr($_POST['data_da'],3,2);
/*  
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
*/  
header(sprintf("Location: %s", $insertGoTo));
}
$id = "-1";
if (isset($_GET['id'])) {
  $id = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_archeofvg, $archeofvg);
$query_Recordset1 = sprintf("SELECT * FROM %s WHERE id = %s",$missioni_archeofvg, $id);
$Recordset1 = mysql_query($query_Recordset1, $archeofvg) or die(mysql_error().'<strong>'.$query_Recordset1);
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
if ($row_Recordset1['protocollo_ufficio']){$protocollo_ufficio = $row_Recordset1['protocollo_ufficio'];} else {$protocollo_ufficio = 'MBAC-SBA-FVG';}
if ($row_Recordset1['protocollo_sede']){$protocollo_ufficio = $row_Recordset1['protocollo_sede'];} else {$protocollo_sede = 'Trieste';}
if ($row_Recordset1['firma_titolo']){$firma_titolo = $row_Recordset1['firma_titolo'];} else {$firma_titolo = 'IL SOPRINTENDENTE';}
if ($row_Recordset1['firma_firma']){$firma_nome = $row_Recordset1['firma_nome'];} else {$firma_nome = '(Dott. Luigi Fozzati)';}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
<link href="/CSS/stile1.css" rel="stylesheet" type="text/css" />
<title>MBAC-SBA-FVG-Missioni</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
	<caption>
		mbac-sba-fvg: incarico missione - inserimento - <a href="javascript:history.back()" title="RITORNA INDIETRO ALLA PAGINA PRECEDENTE">ritorna </a> - 
	</caption>
    <tr valign="baseline">
      <td nowrap align="center"><a href="missioni3_guida.html" target="_blank"><?php echo date('d-m-Y');?></a></td>
      <td align="center"><input type="reset" value="Annulla dati"> [ * = DATI OBBLIGATORI ! ] <input type="submit" value="Aggiungi missione"></td>
    </tr>	
    <tr valign="baseline">
      <td nowrap align="right">* Titolo e Nome:</td>
      <td><input type="text" name="titolo" value="<?php echo $row_Recordset1['titolo'];?>" size="10" title="INDICARE IL NOME TITOLO: Sig.ra, Sig., Dott.ssa, Dott., ...  [MAX 25 CARATTERI] "> <input type="text" name="nome" value="<?php echo $row_Recordset1['nome'];?>" size="25" title="INDICARE IL NOME [MAX 25 CARATTERI] "></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Cognome:</td>
      <td><input type="text" name="cognome" value="<?php echo $row_Recordset1['cognome'];?>" size="50" title="INDICARE IL COGNOME[MAX 50 CARATTERI] "></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Sede:</td>
      <td><input type="text" name="sede" value="<?php echo $row_Recordset1['sede'];?>" size="20" title="INDICARE LA SEDE DI SERVIZIO [MAX 50 CARATTERI]"> * CAP: <input type="text" name="sede_cap" value="<?php echo $row_Recordset1['sede_cap'];?>" size="5" title="INDICARE IL CAP DELLA SEDE DI SERVIZIO [5 CARATTERI]"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Indirizzo:</td>
      <td><input type="text" name="sede_indirizzo" value="<?php echo $row_Recordset1['sede_indirizzo'];?>" size="50" title="INDICARE L'INDIRIZZO DELLA SEDE DI SERVIZIO [MAX 50 CARATTERI]"></td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Missione N.:</td>
      <td>
			<input type="text" name="missione" value="<?php echo $row_Recordset1['missione'];?>" size="5" title="NUMERO DELLA MISSIONE"> 
		</td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">* Data: </td>
      <td>
			da: 
			<input type="text" name="data_da" value="<?php echo mysql2data($data_da);?>" size="10" title="INSERIRE LA DATA DI INIZIO DELLA MISSIONE: GG/MM/AAAA">
			 [GG-MM-AAAA] a:  
			<input type="text" name="data_a"  value="<?php echo mysql2data($data_a);?>"  size="10" title="INSERIRE LA DATA DI FINE DELLA MISSIONE: GG/MM/AAAA">
			[GG-MM-AAAA] 
		</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Partenza da:</td>
      <td><input type="text" name="partenza" value="<?php echo $row_Recordset1['partenza'];?>" size="25" title="INDICARE LA LOCALITA' DI PARTENZA [MAX 25 CARATTERI] "> * alle ore: <input type="text" name="partenza_ore" value="<?php echo $row_Recordset1['partenza_ore'];?>" size="5" title="ORARIO PREVISTO DELLA MISSIONE PARTENZA ALLE ORE: hh:mm"></td>
    </tr> 
    <tr valign="baseline">
      <td nowrap align="right">* Localita':</td>
      <td><input type="text" name="localita" value="<?php echo $row_Recordset1['localita'];?>" size="70" title="INDICARE TUTTI I COMUNI DI MISSIONE [MAX 250 CARATTERI]"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Motivo:</td>
      <td><input type="text" name="motivo" value="<?php echo $row_Recordset1['motivo'];?>" size="70" title="INDICARE I TIPI DI MISSIONE: AMMINISTRATIVA, ISPETTIVA, INCONTRO, RIUNIONE, VISITA GUIDATA, CORSO DI AGGIORNAMENTO ... [MAX 250 CARATTERI]"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Mezzo:</td>
      <td><input type="text" name="mezzo" value="<?php echo $row_Recordset1['mezzo'];?>" size="70" title="INDICARE I MEZZI UTILIZZATI: PUBBLICO (TRENO, CORRIERA, AEREO, ...) PROPRIO, OFFERTO, SERVIZIO, ... [MAX 250 CARATTERI]"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">* Autorizzazione:</td>
      <td><input type="text" name="autorizzazione" value="<?php echo $row_Recordset1['autorizzazione'];?>" size="70" title="INDICARE I MEZZI AUTOZIZZATI: PROPRIO (TARGA ... ) TAXI, URBANI, NAVE (COMPAGNIA ... ), AEREO (COMPAGNIA ... ), ALTRO (SPECIFICARE ... ) ... [MAX 250 CARATTERI]"></td>
    </tr>	
      <tr valign="baseline">
         <td nowrap align="right">Straordinario:</td>
         <td>
			 dalle ore: 
			<input type="text" name="ore_dalle" value="<?php echo $row_Recordset1['ore_dalle'];?>" size="5" title="starordinari dalle ore [HH:MM]"> [HH:MM] 
			 alle ore: 
			<input type="text" name="ore_alle" value="<?php echo $row_Recordset1['ore_alle'];?>" size="5" title="straordinari alle ore [HH:MM]"> [HH:MM]
			</td>
      </tr>
	<tr valign="baseline">
      <td nowrap align="right">Firma incarico:</td>
      <td>
		Titolo: <input type="text" name="firma_titolo" value="<?php echo $row_Recordset1['firma_titolo'];?>" size="25" title="TITOLO [IL SOPRINTENDENTE] [MAX 50 CARATTERI]"> 
		 Nome:  <input type="text" name="firma_nome" value="<?php echo $row_Recordset1['firma_nome'];?>" size="25" title="TITOLO NOME E COGNOME DEL TITOLARE [Dott. Luigi Fozzati] [MAX 50 CARATTERI]"> 
		</td>
    </tr> 
	 <tr>
	 <td></td>
	 <td align="center">DATI DI RIEPILOGO</td>
	 </tr>
	<tr valign="baseline">
      <td nowrap align="right">Protocollo:</td>
      <td>
		Ufficio: 
		<input type="text" name="protocollo_ufficio" value="<?php echo $row_Recordset1['protocollo_ufficio'];?>" size="12" title="INSERIRE LA SIGLA DEL PROTOCOLLO DELL'UFFICIO [MBAC-SBA-FVG] [MAX 50 CARATTERI]"> 
		Sede: 
		<input type="text" name="protocollo_sede" value="<?php echo $row_Recordset1['protocollo_sede'];?>" size="10" title="INSERIRE LA SEDE DEL PROTOCOLLO [Aquileia, Cividale del Friuli, Trieste, Udine]  [MAX 50 CARATTERI]"> 
		N.: 
		<input type="text" name="protocollo" value="<?php echo $row_Recordset1['protocollo'];?>" size="5" title="INSERIRE IL NUMERO DI PROTOCOLLO DELL'AUTORIZZAZIONE ALLA MISSIONE"> - 
		data: 
		<input type="text" name="protocollo_data" value="<?php echo mysql2data($row_Recordset1['protocollo_data']);?>" size="10" title="INSERIRE LA DATA DEL PROTOCOLLO DELL'AUTORIZZAZIONE ALLA MISSIONE: GG/MM/AAAA">
		</td>
    </tr>
	<tr valign="baseline">
      <td nowrap align="right">Luogo :</td>
      <td>
			di termine della missione: <input type="text" name="rientro" value="<?php echo $row_Recordset1['rientro'];?>" size="25" title="LUOGO DI TERNINE DELLA MISSIONE"> 
		</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Spese: [0.00]</td>
      <td>
		tasporti: 
		<input type="text" name="spese_trasporti" value="<?php echo $row_Recordset1['spese_trasporti'];?>" size="5"title="USARE UN PUNTO [0.00] PER SEPARARE I DECIMALI"> 
		pasti: 
		<input type="text" name="spese_pasti" value="<?php echo $row_Recordset1['spese_pasti'];?>" size="5"title="USARE UN PUNTO [0.00] PER SEPARARE I DECIMALI"> 
		hotel: 
		<input type="text" name="spese_pernotte" value="<?php echo $row_Recordset1['spese_pernotte'];?>" size="5"title="USARE UN PUNTO [0.00] PER SEPARARE I DECIMALI"> 
		<!--totali: 
		<input type="text" name="spese" value="<?php echo $row_Recordset1['spese'];?>" size="5"title="USARE UN PUNTO [0.00] PER SEPARARE I DECIMALI">-->
		km:  <input type="text" name="km" value="<?php echo $row_Recordset1['km'];?>" size="5"title="CHILOMETRI PERCORSI">
		</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Imputazione:</td>
      <td>
		cap.: 
		<input type="text" name="capitolo" value="<?php echo $row_Recordset1['capitolo'];?>" size="4"title="CAPITOLO DI SPESA N."> 
		anno: 
		<input type="text" name="af" value="<?php echo $row_Recordset1['af'];?>" size="4"title="ANNO FINANAZIARIO"> 
		perizia: 
		<input type="text" name="perizia" value="<?php echo $row_Recordset1['perizia'];?>" size="4"title="PERIZIA DI SPESA N."> 
		piano: 
		<input type="text" name="piano_spesa" value="<?php echo $row_Recordset1['piano_spesa'];?>" size="20"title="PIANO DI SPESA ... [MAX 255 CARATTERI]"> 
		</td>
    </tr>
      <tr valign="baseline">
         <td nowrap align="right">Orario:</td>
         <td> dalle ore: <input type="text" name="dalle" value="<?php echo $row_Recordset1['dalle'];?>" size="5" title="ORARIO EFFETTIVO DELLA MISSIONE DALLE ORE: [HH:MM]"> [HH:MM]  -  alle ore: <input type="text" name="alle" value="<?php echo $row_Recordset1['alle'];?>" size="5" title="ORARIO EFFETTIVO DELLA MISSIONE ALLE ORE hh:mm"> [HH:MM] tot.: <input type="text" name="ore_totali" value="<?php echo $row_Recordset1['ore_totali'];?>" size="5" title="ORARIO EFFETTIVO DELLA MISSIONE TOTALI ORE: [HH:MM]"> [HH:MM]</td>
      </tr>
      <tr valign="baseline">
         <td nowrap align="right">Straordinario:</td>
         <td>
			dalle ore: 
			<input type="text" name="ore_dalle" value="<?php echo $row_Recordset1['ore_dalle'];?>" size="5" title="starordinari dalle ore [HH:MM]"> [HH:MM] 
			 alle ore: 
			<input type="text" name="ore_alle" value="<?php echo $row_Recordset1['ore_alle'];?>" size="5" title="straordinari alle ore [HH:MM]"> [HH:MM]
			tot. <input type="text" name="ore" value="<?php echo $row_Recordset1['ore'];?>" size="5" title="indicare l'ammontare delle ore straordinarie in [HH.MM]"> [HH.MM]
			</td>
      </tr>
    <tr valign="baseline">
      <td nowrap align="right">Relazione:</td>
      <td>
		   <textarea  name="relazione" cols="60" rows="10" title="RELAZIONE DELLA MISSIONE"><?php echo $row_Recordset1['relazione'];?></textarea>
		</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Data:</td>
      <td>
		   <input type="text"  name="relazione_data" size="10" title="DATA RELAZIONE DELLA MISSIONE: [GG-MM-AAAA]" value="<?php echo mysql2data($row_Recordset1['relazione_data']);?>"> 
		Prot. N. 
			<input type="text"  name="relazione_prot" size="5" title="PROTOCOLLO RELAZIONE DELLA MISSIONE" value="<?php echo $row_Recordset1['relazione_prot'];?>">
		Del: 
<input type="text"  name="relazione_prot_data" size="10" title="DATA DEL PROTOCOLLO DELLA RELAZIONE DELLA MISSIONE: [GG-MM-AAAA]" value="<?php echo mysql2data($row_Recordset1['relazione_prot_data']);?>">
		Sede:
<input type="text"  name="relazione_prot_sede" size="10" title="SEDE DEL PROTOCOLLO DELLA RELAZIONE DELLA MISSIONE" value="<?php echo $row_Recordset1['relazione_prot_sede'];?>">
		</td>
	 </tr>
    <tr valign="baseline">
      <td nowrap align="right">Scansione: </td>
		<td>
		<textarea  name="relazione_scansione" cols="60" rows="2" title="SCANSIONE DELLA RELAZIONE DELLA MISSIONE"><?php echo $row_Recordset1['relazione_scansione'];?></textarea>		
		</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Annotazioni:</td>
      <td>
		   <textarea  name="note" cols="60" rows="3" title="EVENTUALI ANNOTAZIONI [MAX 250 CARATTERI]"><?php echo $row_Recordset1['note'];?></textarea>
		</td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="center"><a href="missioni3_guida.html" target="_blank"><?php echo date('h:i');?></a></td>
      <td align="center"><input type="reset" value="Annulla dati"> [ * = DATI OBBLIGATORI ! ] <input type="submit" value="Aggiungi missione"></td>
    </tr>
	<tr>
		<td><?php echo $row_Recordset1['id']; ?></td>
		<td>
			modifica: <?php echo $row_Recordset1['modifica']; ?>: <?php echo $row_Recordset1['ip']; ?>/<?php echo $row_Recordset1['oper']; ?> 
		</td>
	</tr>
   </table>
  <input type="hidden" name="data" value="">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<?php include ("inc/footer.inc.php");?>
</body>
</html>
