<?php require_once('inc/sba.php'); ?><?php
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['codice'])) {
  $colname_DetailRS1 = (get_magic_quotes_gpc()) ? $_GET['codice'] : addslashes($_GET['codice']);
}
mysql_select_db($database_sba, $sba);
$recordID = $_GET['recordID'];
$query_DetailRS1 = sprintf("SELECT * FROM sba_prodotti  WHERE codice = '$recordID'", $colname_Recordset1);
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $sba) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="/CSS/stile1.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>

<body>
		
<table border="1" align="center">
  
  <tr>
    <td>codice</td>
    <td><?php echo $row_DetailRS1['codice']; ?> </td>
  </tr>
  <tr>
    <td>prodotto</td>
    <td><?php echo $row_DetailRS1['prodotto']; ?> </td>
  </tr>
  <tr>
    <td>volume</td>
    <td><?php echo $row_DetailRS1['volume']; ?> </td>
  </tr>
  <tr>
    <td>indicatore</td>
    <td><?php echo $row_DetailRS1['indicatore']; ?> </td>
  </tr>
  
  
</table>

</body>
</html><?php
mysql_free_result($DetailRS1);
?>
