<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
//TODO: controlador de ventas 
require_once('../models/ventas.model.php');
error_reporting(0);
$ventas = new Ventas;
switch ($_GET["op"]) {
    //TODO: operaciones de ventas
case 'buscar': // Procedimiento para cargar los datos de una venta
    if (!isset($_POST["venta_id"])) {
        echo json_encode(["error" => "Sale ID not specified."]);
        exit();
    }
    $venta_id = intval($_POST["venta_id"]);
    $datos = array();
    $datos = $ventas->buscar($venta_id);
    while ($row = mysqli_fetch_assoc($datos)) {
        $todos[] = $row;
    }
    echo json_encode($todos);
    break;

case 'todos': // Procedimiento para cargar todos los datos de las ventas
    $datos = array();
    $datos = $ventas->todos();
    while ($row = mysqli_fetch_assoc($datos)) {
        $todos[] = $row;
    }
    echo json_encode($todos);
    break;

case 'uno': // Procedimiento para obtener un registro de la base de datos
    if (!isset($_POST["venta_id"])) {
        echo json_encode(["error" => "Sale ID not specified."]);
        exit();
    }
    $venta_id = intval($_POST["venta_id"]);
    $datos = array();
    $datos = $ventas->uno($venta_id);
    $res = mysqli_fetch_assoc($datos);
    echo json_encode($res);
    break;

case 'insertar': // Procedimiento para insertar una venta en la base de datos
    if (!isset($_POST["fecha"]) || !isset($_POST["cliente_id"]) || !isset($_POST["producto_id"]) || !isset($_POST["cantidad"]) || !isset($_POST["total"]) || !isset($_POST["forma_pago"])) {
        echo json_encode(["error" => "Missing required parameters."]);
        exit();
    }

    $fecha = $_POST["fecha"];
    $cliente_id = intval($_POST["cliente_id"]);
    $producto_id = intval($_POST["producto_id"]);
    $cantidad = intval($_POST["cantidad"]);
    $total = floatval($_POST["total"]);
    $forma_pago = $_POST["forma_pago"];
    

    $datos = array();
    $datos = $ventas->insertar($fecha, $cliente_id, $producto_id, $cantidad, $total, $forma_pago);
    echo json_encode($datos);
    break;

case 'actualizar': // Procedimiento para actualizar una venta en la base de datos
    if (!isset($_POST["venta_id"]) || !isset($_POST["fecha"]) || !isset($_POST["cliente_id"]) || !isset($_POST["producto_id"]) || !isset($_POST["cantidad"]) || !isset($_POST["total"]) || !isset($_POST["forma_pago"])) {
        echo json_encode(["error" => "Missing required parameters."]);
        exit();
    }

    $venta_id = intval($_POST["venta_id"]);
    $fecha = $_POST["fecha"];
    $cliente_id = intval($_POST["cliente_id"]);
    $producto_id = intval($_POST["producto_id"]);
    $cantidad = intval($_POST["cantidad"]);
    $total = floatval($_POST["total"]);
    $forma_pago = $_POST["forma_pago"];
    

    $datos = array();
    $datos = $ventas->actualizar($venta_id, $fecha, $cliente_id, $producto_id, $cantidad, $total, $forma_pago);
    echo json_encode($datos);
    break;

case 'eliminar': // Procedimiento para eliminar una venta en la base de datos
    if (!isset($_POST["venta_id"])) {
        echo json_encode(["error" => "Sale ID not specified."]);
        exit();
    }
    $venta_id = intval($_POST["venta_id"]);
    $datos = array();
    $datos = $ventas->eliminar($venta_id);
    echo json_encode($datos);
    break;

default:
echo json_encode(["error" => "Ingrese el ?op=todos"]);
    break;
}

?>
