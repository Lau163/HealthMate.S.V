<?php

/**
 *
 */
class IndexModel extends ModelBase
{

    public function __construct()
    {
        parent::__construct();
    }
    public static function example()
    {
        try {
            $con = new Database;
            $query = $con->pdo->prepare("SELECT e.*,(e.limite_boletos - (SELECT COUNT(*) FROM concentrado_boletos cb WHERE cb.fk_id_evento = e.id_evento)) as disponibles FROM eventos e WHERE e.estatus_evento = 1");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo "Error recopilado model getEventos: " . $e->getMessage();
            return;
        }
    }
}
