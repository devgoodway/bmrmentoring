<?php
  require "views/templates/top.php";
  require "views/templates/nav.php";
  if(isset($_GET[id])) {
    require "views/{$_GET[id]}.php";
  }
  else {
    require "views/tutorial_start.php";
  }
  require "views/templates/bottom.php";
?>