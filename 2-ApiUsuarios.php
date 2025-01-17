<?php
// Configuración de cabeceras para permitir CORS y trabajar con JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Arreglo para almacenar usuarios (simula una base de datos)
$users = [
    ["id" => 1, "name" => "Juan Pérez", "email" => "juan@example.com"],
    ["id" => 2, "name" => "María Gómez", "email" => "maria@example.com"],
];

// Obtener el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Manejo de las solicitudes según el método HTTP
switch ($method) {
    case 'GET':
        // Retornar todos los usuarios en formato JSON
        http_response_code(200); // OK
        echo json_encode($users);
        break;

    case 'POST':
        // Agregar un nuevo usuario
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['name']) && isset($input['email'])) {
            $newUser = [
                "id" => count($users) + 1,
                "name" => $input['name'],
                "email" => $input['email'],
            ];
            array_push($users, $newUser);
            http_response_code(201); // Creado
            echo json_encode($newUser);
        } else {
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(["error" => "Los campos 'name' y 'email' son requeridos"]);
        }
        break;

    case 'PUT':
        // Actualizar un usuario existente
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['id']) && isset($input['name']) && isset($input['email'])) {
            $userId = $input['id'];
            $found = false;
            foreach ($users as &$user) {
                if ($user['id'] == $userId) {
                    $user['name'] = $input['name'];
                    $user['email'] = $input['email'];
                    $found = true;
                    http_response_code(200); // Éxito
                    echo json_encode($user);
                    break;
                }
            }
            if (!$found) {
                http_response_code(404); // No encontrado
                echo json_encode(["error" => "Usuario no encontrado"]);
            }
        } else {
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(["error" => "Los campos 'id', 'name' y 'email' son requeridos"]);
        }
        break;

    case 'DELETE':
        // Eliminar un usuario por su ID
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['id'])) {
            $userId = $input['id'];
            $found = false;
            foreach ($users as $key => $user) {
                if ($user['id'] == $userId) {
                    array_splice($users, $key, 1);
                    $found = true;
                    http_response_code(200); // Éxito
                    echo json_encode(["message" => "Usuario eliminado"]);
                    break;
                }
            }
            if (!$found) {
                http_response_code(404); // No encontrado
                echo json_encode(["error" => "Usuario no encontrado"]);
            }
        } else {
            http_response_code(400); // Solicitud incorrecta
            echo json_encode(["error" => "El campo 'id' es requerido"]);
        }
        break;

    default:
        // Método no permitido
        http_response_code(405); // Método no permitido
        echo json_encode(["error" => "Método no permitido"]);
        break;
}
?>