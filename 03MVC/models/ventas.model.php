<?php
require_once('../config/config.php');
class Ventas
{
    // TODO: Implementar los métodos de la clase

    public function buscar($venta_id) // select * from ventas where venta_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `ventas` WHERE `venta_id` = $venta_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function todos() // select * from ventas
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `ventas`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($venta_id) // select * from ventas where venta_id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `ventas` WHERE `venta_id` = $venta_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($fecha, $cliente_id, $producto_id, $cantidad, $total, $forma_pago) // insert into ventas
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `ventas`(`fecha`, `cliente_id`, `producto_id`, `cantidad`, `total`, `forma_pago`) 
                       VALUES ('$fecha', $cliente_id, $producto_id, $cantidad, $total, '$forma_pago')";
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

    public function actualizar($venta_id, $fecha, $cliente_id, $producto_id, $cantidad, $total, $forma_pago) // update ventas
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `ventas` SET 
                       `fecha`='$fecha',
                       `cliente_id`=$cliente_id,
                       `producto_id`=$producto_id,
                       `cantidad`=$cantidad,
                       `total`=$total,
                       `forma_pago`='$forma_pago'
                       WHERE `venta_id` = $venta_id";
            if (mysqli_query($con, $cadena)) {
                return $venta_id; // Return the updated ID
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($venta_id) // delete from ventas where venta_id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `ventas` WHERE `venta_id` = $venta_id";
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
