<?php
class Index extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
    }
    function render(){
        $this->view->render('index/index');
    }
    function example(){
        try {
            $resp = IndexModel::example();
            $data = [
                'estatus' => 'success',
                'titulo' => 'Titulo',
                'mensaje' => 'Mensaje'
            ];
        } catch (\Throwable $th) {
            $data = [
                'estatus' => 'error',
                'titulo' => 'Titulo',
                'mensaje' => 'Mensaje'
            ];
        }
        echo json_encode($data);
    }
}
?>