<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}
// TODO: controlador de productos 
require_once('../models/productos.model.php');
error_reporting(0);
$productos = new Productos;
switch ($_GET["op"]) {
    // TODO: operaciones de productos
    case 'buscar': // Procedimiento para buscar productos
        if (!isset($_POST["texto"])) {
            echo json_encode(["error" => "Search text not specified."]);
            exit();
        }
        $texto = $_POST["texto"];
        $datos = array();
        $datos = $productos->buscar($texto);
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    
    case 'todos': // Procedimiento para cargar todos los datos de los productos
        $datos = array();
        $datos = $productos->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno': // Procedimiento para obtener un producto por ID
        if (!isset($_POST["producto_id"])) {
            echo json_encode(["error" => "Product ID not specified."]);
            exit();
        }
        $producto_id = intval($_POST["producto_id"]);
        $datos = array();
        $datos = $productos->uno($producto_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar': // Procedimiento para insertar un producto en la base de datos
        if (!isset($_POST["nombre"]) || !isset($_POST["descripcion"]) || !isset($_POST["precio"]) || !isset($_POST["stock"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = floatval($_POST["precio"]);
        $stock = intval($_POST["stock"]);
        
        $datos = array();
        $datos = $productos->insertar($nombre, $descripcion, $precio, $stock);
        echo json_encode($datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un producto en la base de datos
        if (!isset($_POST["producto_id"]) || !isset($_POST["nombre"]) || !isset($_POST["descripcion"]) || !isset($_POST["precio"]) || !isset($_POST["stock"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $producto_id = intval($_POST["producto_id"]);
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = floatval($_POST["precio"]);
        $stock = intval($_POST["stock"]);
        
        $datos = array();
        $datos = $productos->actualizar($producto_id, $nombre, $descripcion, $precio, $stock);
        echo json_encode($datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un producto en la base de datos
        if (!isset($_POST["producto_id"])) {
            echo json_encode(["error" => "Product ID not specified."]);
            exit();
        }
        $producto_id = intval($_POST["producto_id"]);
        $datos = array();
        $datos = $productos->eliminar($producto_id);
        echo json_encode($datos);
        break;

    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}
?>
