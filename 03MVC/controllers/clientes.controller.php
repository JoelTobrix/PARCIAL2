<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de clientes 
require_once('../models/clientes.model.php');
error_reporting(0);
$clientes = new Clientes;
switch ($_GET["op"]) {
    //TODO: operaciones de clientes
case 'buscar': // Procedimiento para cargar todos los datos de los clientes
    if (!isset($_POST["texto"])) {
        echo json_encode(["error" => "Client ID not specified."]);
        exit();
    }
    $texto = intval($_POST["texto"]);
    $datos = array();
    $datos = $clientes->buscar($texto);
    while ($row = mysqli_fetch_assoc($datos)) {
        $todos[] = $row;
    }
    echo json_encode($todos);
    break;
case 'todos': // Procedimiento para cargar todos los datos de los clientes
    $datos = array();
    $datos = $clientes->todos();
    while ($row = mysqli_fetch_assoc($datos)) {
        $todos[] = $row;
    }
    echo json_encode($todos);
    break;

case 'uno': // Procedimiento para obtener un registro de la base de datos
    if (!isset($_POST["cliente_id"])) {
        echo json_encode(["error" => "Client ID not specified."]);
        exit();
    }
    $cliente_id = intval($_POST["cliente_id"]);
    $datos = array();
    $datos = $clientes->uno($cliente_id);
    $res = mysqli_fetch_assoc($datos);
    echo json_encode($res);
    break;

case 'insertar': // Procedimiento para insertar un cliente en la base de datos
    if (!isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["email"]) || !isset($_POST["telefono"])) {
        echo json_encode(["error" => "Missing required parameters."]);
        exit();
    }

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    

    $datos = array();
    $datos = $clientes->insertar($nombre, $apellido, $email, $telefono);
    echo json_encode($datos);
    break;

case 'actualizar': // Procedimiento para actualizar un cliente en la base de datos
    if (!isset($_POST["cliente_id"]) || !isset($_POST["nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["email"]) || !isset($_POST["telefono"])) {
        echo json_encode(["error" => "Missing required parameters."]);
        exit();
    }

    $cliente_id = intval($_POST["cliente_id"]);
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    

    $datos = array();
    $datos = $clientes->actualizar($cliente_id, $nombre, $apellido, $email, $telefono);
    echo json_encode($datos);
    break;

case 'eliminar': // Procedimiento para eliminar un cliente en la base de datos
    if (!isset($_POST["cliente_id"])) {
        echo json_encode(["error" => "Client ID not specified."]);
        exit();
    }
    $cliente_id = intval($_POST["cliente_id"]);
    $datos = array();
    $datos = $clientes->eliminar($cliente_id);
    echo json_encode($datos);
    break;

default:
    
    break;
}

?>