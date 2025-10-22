<?php
/**
 * Ejemplo de vista usando el layout base
 * Esta función puede ser usada en el controlador para renderizar vistas con el layout
 */

function renderWithLayout($content, $data = []) {
    // Extraer variables del array de datos
    extract($data);

    // Incluir el layout y capturar el contenido
    ob_start();
    include 'views/doctor/layout.php';
    return ob_get_clean();
}

// Ejemplo de uso en un controlador:
/*
// En el controlador:
public function index() {
    $data = [
        'title' => 'Panel del Doctor - HealthMate',
        'pageTitle' => 'PANEL PRINCIPAL',
        'content' => $this->renderPartial('doctor/dashboard') // Contenido específico
    ];

    echo $this->renderWithLayout($data['content'], $data);
}
*/
?>
