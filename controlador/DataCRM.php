<?php

require_once '../modelo/DataCRM_model.php';

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new DataCRM_model();
    }

    public function getData()
    {
        return $this->model->getData();
    }
}

$controller = new Controller();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header('Content-Type: application/json');
        echo json_encode($controller->getData());
    } else {
        throw new Exception('Método de solicitud inválido');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]); //Muestra el error como JSON
}
