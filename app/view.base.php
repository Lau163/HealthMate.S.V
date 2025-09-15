<?php
/**
 *
 */
class ViewBase{

  function __construct(){
    // echo "<p>Vista base</p>";
    
  }

  function render($vista){
      require("views/".$vista.".view.php");
  }
}

 ?>
