<?php
/**
 *
 */
class ViewBase{
  private $data = [];

  function __construct(){
    // echo "<p>Vista base</p>";
    
  }

  function render($vista){
      // Hacer disponibles las variables asignadas en la vista
      $data = $this->data;
      if (is_array($data)) {
        extract($data, EXTR_SKIP);
      }
      require("views/".$vista.".view.php");
  }

  // Asignar variables para la vista
  function set($key, $value){
    $this->data[$key] = $value;
  }

  // Obtener variables asignadas a la vista
  function get($key, $default = null){
    return array_key_exists($key, $this->data) ? $this->data[$key] : $default;
  }
}

 ?>
