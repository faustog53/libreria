<?php if ( !in_array($_SESSION['MM_Username'], $usr_archeofvg)){
echo 'missione non modificabile ! ';
echo '<a href="javascript:history.back()" title="RITORNA INDIETRO ALLA PAGINA PRECEDENTE">ritorna </a>'; 
exit;
} ?>