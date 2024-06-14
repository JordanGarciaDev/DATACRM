<?php

class DataCRM_model {

    private $urlEndpoint = 'https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php';
    private $sessionName; // Variable para almacenar la sessionName

    public function getChallenge() {
        $url = $this->urlEndpoint.'?operation=getchallenge&username=prueba';

        // metodo GET
        $response = file_get_contents($url);

        if ($response === FALSE) {
            die('Error getChallenge');
        }

        $responseData = json_decode($response, true); //Retornar datos en JSON

        return $responseData['result']['token']; //Retorna el token generado
    }

    public function autenticar($token) {
        $keyusuario = 'IwIHRvYcgN3SRC2B'; //Clave del usuario prueba
        $generatedKey = md5($token.$keyusuario);  // Se genera el accessKey con el token generado + la clave IwIHRvYcgN3SRC2B
        $url = $this->urlEndpoint;

        $curl = curl_init();

        $params = array(
            'operation' => 'login',
            'username' => 'prueba',
            'accessKey' => $generatedKey
        );

        $params_string = http_build_query($params);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === FALSE) { //Si hay error en el response
            die('Error autenticar');
        }

        $responseData = json_decode($response, true);

        $this->sessionName = $responseData['result']['sessionName']; // Almacenar la sesión
        return $this->sessionName;
    }

    public function getDatos() {
        $token = $this->getChallenge(); // Obtener el token para pasarlo a la variable $sessionName
        $sessionName = $this->autenticar($token); // Función para generar el login con el token
        $query = "SELECT * FROM Contacts;"; // Query a consultar al API

        // Se realiza la petición usando el sessionName generado
        $https = str_replace(' ', '', $this->urlEndpoint);
        $url = str_replace('<br/>', '', $https);
        $urlEndpoint = $url . "?operation=query&sessionName=$sessionName&query=".urlencode($query); //Usamos urlencode para asegurarnos de que el Query se codifique correctamente en la URL.


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $urlEndpoint);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === FALSE) { //Verificamos si la respuesta de curl_exec es FALSE.
            die('Se produjo un error durante la recuperación de datos.');
        }

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) { //Verificamos si json_decode devolvió un error.
            die('Error al decodificar el JSON: ' . json_last_error_msg());
        }

        if (!isset($data['result']) || !is_array($data['result'])) {
            die('La respuesta del API no contiene los datos esperados. Respuesta: ' . $response);
        }

        return [
            'sessionName' => $sessionName, // Devolver también la sesión
            'data' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'contact_no' => $item['contact_no'],
                    'lastname' => $item['lastname'],
                    'createdtime' => $item['createdtime'],
                    'modifiedtime' => $item['modifiedtime']
                ];
            }, $data['result'])
        ];
    }

    public function getDatosNegocio() {
        $token = $this->getChallenge(); // Obtener el token para pasarlo a la variable $sessionName
        $sessionName = $this->autenticar($token); // Función para generar el login con el token

        // Se realiza la petición usando el sessionName generado
        $https = str_replace(' ', '', $this->urlEndpoint);
        $url = str_replace('<br/>', '', $https);
        $urlEndpoint = $url . "?operation=describe&sessionName=$sessionName&elementType=Potentials"; //Usamos urlencode para asegurarnos de que el Query se codifique correctamente en la URL.

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $urlEndpoint);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === FALSE) { //Verificamos si la respuesta de curl_exec es FALSE.
            die('Se produjo un error durante la recuperación de datos.');
        }

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) { //Verificamos si json_decode devolvió un error.
            die('Error al decodificar el JSON: ' . json_last_error_msg());
        }

        if (!isset($data['result']) || !is_array($data['result'])) {
            die('La respuesta del API no contiene los datos esperados. Respuesta: ' . $response);
        }

        return [
            'sessionName' => $sessionName, // Devolver también la sesión
            'data' => array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'label' => $item['label'],
                    'createdtime' => $item['createdtime']
                ];
            }, $data['result']['fields'])
        ];
    }

    public function actualizar($sessionName, $element) {
        $url = $this->urlEndpoint;

        $params = array(
            'operation' => 'update',
            'sessionName' => $this->sessionName,
            'element' => json_encode($element)
        );

        $params_string = http_build_query($params);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response === FALSE) {
            die('Error al actualizar el registro.');
        }

        $responseData = json_decode($response, true);

        if (!isset($responseData['success']) || !$responseData['success']) {
            die('Error en la actualización: ' . $responseData['error']['message']);
        }

        return $responseData['result']; // Retorna el resultado de la actualización si es necesario
    }
}
