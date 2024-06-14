<?php

require_once '../modelo/DataCRM_model.php';

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new DataCRM_model();
    }

    public function getDatos()
    {
        return $this->model->getDatos();

    }

    public function actualizar($sessionName, $datos)
    {
        return $this->model->actualizar($sessionName, $datos);
    }

    public function getSessionName()
    {
        $token = $this->model->getChallenge();
        return $this->model->autenticar($token);
    }
}

$controller = new Controller();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header('Content-Type: application/json');
        echo json_encode($controller->getDatos());
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Leer datos del cuerpo de la solicitud POST (esperando JSON)
        $postData = file_get_contents('php://input');
        $jsonData = json_decode($postData, true);

        if ($jsonData === null) {
            throw new Exception('Error al decodificar JSON');
        }

        // Validar y obtener datos
        if (!isset($jsonData['sessionName'])) {
            throw new Exception('Falta sessionName en los datos');
        }
        $sessionName = $jsonData['sessionName'];

        if (!isset($jsonData['element'])) {
            throw new Exception('Falta element en los datos');
        }
        $datos = $jsonData['element'];

        // Actualizar datos
        $result = $controller->actualizar($sessionName, $datos);

        // Respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Datos han sido actualizados correctamente.', 'result' => $result]);
        exit;
    } else {
        throw new Exception('Método incorrecto');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
