<?php
require_once('../config/config.php');
class Productos
{
    // TODO: Implementar los métodos de la clase

    public function buscar($texto) // select * from productos where nombre like '%texto%'
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `productos` WHERE `nombre` LIKE '%$texto%'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from productos
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `productos`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($producto_id) // select * from productos where producto_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `productos` WHERE `producto_id` = $producto_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($nombre, $descripcion, $precio, $stock) // insert into productos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `productos`(`nombre`, `descripcion`, `precio`, `stock`) 
                       VALUES ('$nombre', '$descripcion', $precio, $stock)";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Return the inserted ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($producto_id, $nombre, $descripcion, $precio, $stock) // update productos
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `productos` SET 
                       `nombre`='$nombre',
                       `descripcion`='$descripcion',
                       `precio`=$precio,
                       `stock`=$stock
                       WHERE `producto_id` = $producto_id";
            if (mysqli_query($con, $cadena)) {
                return $producto_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($producto_id) // delete from productos where producto_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `productos` WHERE `producto_id` = $producto_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Success
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
