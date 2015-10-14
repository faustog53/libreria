<?php
# Creo la funzione datadump
function datadump ($table) {
  # Creo la variabile $result
  $result .= "# Dump of $table \n";
  $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";
  # Conto i campi presenti nella tabella
  $query = mysql_query("select * from $table");
  $num_fields = @mysql_num_fields($query);
  # Conto il numero di righe presenti nella tabella
  $numrow = mysql_num_rows($query);
  # Passo con un ciclo for tutte le righe della tabella
  for ($i =0; $i<$numrow; $i++)
  {
    $row = mysql_fetch_row($query);
    # Ricreo la tipica sintassi di un comune Dump
    $result .= "INSERT INTO ".$table." VALUES(";
    # Con un secondo ciclo for stampo i valori di tutti i campi
    # trovati in ogni riga
    for($j=0; $j<$num_fields; $j++) {
      $row[$j] = addslashes($row[$j]);
      $row[$j] = ereg_replace("\n","\\n",$row[$j]);
      if (isset($row[$j])) $result .= "\"$row[$j]\"" ; else $result .= "\"\"";
      if ($j<($num_fields-1)) $result .= ",";
    }
    # Chiudo l'istruzione INSERT
    $result .= ");\n";
  }
  return $result . "\n\n\n";
}
?>
