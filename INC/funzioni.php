<?php
/*
function br($n=1)
function checkboxinput($name, $value, $checked=FALSE)
function fieldset($corpo, $legenda=NULL)
function fieldset($corpo, $legenda=NULL)
function form($action, $corpo, $method = 'post')
function input($name, $type='text', $size=20, $maxlength=40)
function h($testo, $size = 1)
function hlink($ref, $label)
function img($src, $width, $alt ='')
function li($item)
function mselect($options, $name, $size=3)
function option($option, $value=NULL, $selected=FALSE)
function p($testo)
function radioinput($name, $value, $checked=FALSE)
function select($options, $name, $size=1)
function submit($name = 'submit', $value = 'Invia')
function table($corpo, $border = 1, $cellspacing = 0, $cellpadding = 10)
function td($dato)
function textarea($name, $rows=10, $cols=40, $default='', $wrap='virtual')
function textinput($name, $size=20, $maxlength=40)
function th($dato)
function tr($celle, $bgcolor=NULL)
function ul($items)
function xhtml($titolo, $corpo, $style = 'stylesheet.css')
*/
function br($n=1)
{
  $codice = '';
  for($i=1; $i<=$n; $i++)
    $codice .= "<br />\n";
  return $codice;
}

function checkboxinput($name, $value, $checked=FALSE)
{
  $default = ($checked ? "checked='checked'" : '');
  return "<input type='checkbox' name='$name' value='$value' $default />";
}

function fieldset($corpo, $legenda=NULL)
{
  return "<fieldset>\n" . 
          ($legenda ? "<legend>$legenda</legend>\n" : '') . 
          $corpo . 
          "</fieldset>\n";
}

function form($action, $corpo, $method = 'post')
{
  $testa = "<form action='$action' method='$method'>\n";
  $coda = "</form>\n";
  return $testa . $corpo . $coda;
}

function input($name, $type='text', $size=20, $maxlength=40)
{
  return "<input type=$type name='$name' size='$size' maxlength='$maxlength' />";
}

function h($testo, $size = 1)
{
  $head = "h$size";
  $risultato = "<$head>$testo</$head>\n";
  return $risultato;
}

function hlink($ref, $label)
{
  return "<a href='$ref'>$label</a>";
}

function img($src, $width, $alt ='')
{
  return "<img src='$src' width='$width' alt='$alt' />";
}

function li($item)
{
  return "<li>$item</li>\n";
}

function mselect($options, $name, $size=3)
{
  return "<select multiple='multiple' name='$name' size='$size'>\n$options</select>\n";
}

function option($option, $value=NULL, $selected=FALSE)
{
  $valore = ($value ? " value='$value'" : '');
  $default = ($selected ? " selected='selected'" : '');
  return "<option$valore$default>$option</option>\n";
}

function p($testo)
{
  $risultato = "<p>$testo</p>\n";
  return $risultato;
}

function radioinput($name, $value, $checked=FALSE)
{
  $default = ($checked ? " checked='checked'" : '');
  return "<input type='radio' name='$name' value='$value'$default />";
}

function select($options, $name, $size=1)
{
  return "<select name='$name' size='$size'>\n$options</select>\n";
}

function submit($name = 'submit', $value = 'Invia')
{
  return "<input type='submit' name='$name' value='$value' />";
}

function table($corpo, $border = 1, $cellspacing = 0, $cellpadding = 10)
{
  $testa = "<table border='$border', cellspacing='$cellspacing', cellpadding='$cellpadding'>\n";
  $coda = "</table>\n";
  return $testa . $corpo . $coda;
}

function td($dato)
{
  return "<td>$dato</td>\n";
}

function textarea($name, $rows=10, $cols=40, $default='', $wrap='virtual')
{
  return "<textarea name='$name' rows='$rows' cols='$cols' wrap='$wrap'>\n" .
         "$default".
         "</textarea>\n";
}

function textinput($name, $size=20, $maxlength=40)
{
  return input($name, $type='text', $size=20, $maxlength=40);
}

function th($dato)
{
  return "<th>$dato</th>\n";
}

function tr($celle, $bgcolor=NULL)
{
  $style = ($bgcolor ? " style='background-color:$bgcolor'": '');
  return "<tr$style>\n$celle</tr>\n";
}

function ul($items)
{
  return "<ul>\n$items</ul>\n";
}

function xhtml($titolo, $corpo, $style = 'stylesheet.css')
{
  return "<!DOCTYPE html>
          <html lang='it' xml:lang='it'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
              <title>$titolo</title>
              <link rel='stylesheet'  type='text/css' href='$style'/>
            </head>" .
            '<body>' .
              h($titolo) .
              $corpo .
            '</body>' .
          '</html>';
}

?>
