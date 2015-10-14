<?php require_once('inc/sba.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 1000;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['codice'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['codice'] : addslashes($_GET['codice']);
  $query_Recordset1 = sprintf("SELECT * FROM sba_prodotti WHERE codice = '%s'", $colname_Recordset1);
} 
else {
  $query_Recordset1 = "SELECT * FROM sba_prodotti ORDER BY prodotto";
}
mysql_select_db($database_sba, $sba);

$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $sba) or die(mysql_error());
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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link href="/CSS/stile1.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Controllo Gestione</title>
</head>

<body>
<table border="1" align="center">
   <tr>
      <td>codice</td>
      <td>prodotto</td>
      <td>volume</td>
      <td>indicatore</td>
   </tr>
   <?php do { ?>
      <tr>
         <td><a href="prod_disp.php?recordID=<?php echo $row_Recordset1['codice']; ?>"> <?php echo $row_Recordset1['codice']; ?>&nbsp; </a> </td>
         <td><?php echo $row_Recordset1['prodotto']; ?>&nbsp; </td>
         <td><?php echo $row_Recordset1['volume']; ?>&nbsp; </td>
         <td><?php echo $row_Recordset1['indicatore']; ?>&nbsp; </td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<br>
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
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
