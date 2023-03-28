<?php
/*
Plugin Name: Startracker
Plugin URI: http://www.desterradum.nl
Description: This is a custom plugin that passes the current user's ID to JavaScript.
Version: 1.0
Author: Marco Olariu
Author URI: http://www.desterradum.nl
License: none
*/

function readTextFile($fileName) {
  $file = fopen($fileName, "r") or die("Unable to open file!");
  $fileContent = "";
  while(!feof($file)) {
      $fileContent .= fgets($file);
  }
  fclose($file);
  return $fileContent;
}

if (isset($_POST['fileName'])) {
  echo readTextFile($_POST['fileName']);
}

?>