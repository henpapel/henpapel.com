<?php

class CostizacionModel {

    function __construct($db) {

        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Conexion No establecida con la Base de Datos.');
        }
    }


    public function getCotizacion(){

        $idUsuario = intval($_SESSION['user']['id_usuario']);

        $sql = "SELECT cotizaciones.*, clientes.nombre as cliente, tiendas.nombre_tienda as tienda FROM cotizaciones INNER JOIN clientes on clientes.id_cliente = cotizaciones.id_cliente INNER JOIN tiendas on tiendas.id_tienda = clientes.tienda WHERE cotizaciones.status = 'A' AND cotizaciones.id_usuario = '$idUsuario' ORDER BY fecha_realizacion DESC, hora_realizacion DESC";

        $query = $this->db->prepare($sql);

        $query->execute();

        $result = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $result[] = $row;
        }

        return $result;
    }


    public function getUltimateCotizacion($idCotizacion){

        $idUsuario = intval($_SESSION['user']['id_usuario']);

        $sql = "SELECT * FROM detalle_cotizaciones inner join cotizaciones on cotizaciones.id_cotizacion = detalle_cotizaciones.id_cotizacion INNER JOIN clientes on clientes.id_cliente = cotizaciones.id_cliente WHERE cotizaciones.status = 'A' AND cotizaciones.id_usuario = '$idUsuario' and detalle_cotizaciones.id_cotizacion = $idCotizacion and detalle_cotizaciones.status= 'A'";

        $query = $this->db->prepare($sql);

        $query->execute();

        $result = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $result[] = $row;
        }

        return $result;
    }


    public function uploadCotizacion(){

        session_start();

        $idCliente = intval($_POST['idCliente']);
        $fecha     = date("Y-m-d");
        $hora      = date("H:i:s");
        $arrCotizacion   = json_decode($_POST['arrFactura']);
        $total     = floatval($_POST['txtTotal']);
        $idUsuario = intval($_SESSION['user']['id_usuario']);
        $error     = false;

        try{

            $this->db->beginTransaction();

            $ivaT = 0;

            for( $i=0; $i < count($arrCotizacion); $i++ ){

                $ivaT += floatval($arrCotizacion[$i][4]->value);
            }

            $sql = "INSERT INTO cotizaciones( id_cliente, fecha_realizacion, hora_realizacion, iva_total, monto_total, id_usuario ) VALUES( $idCliente, '$fecha', '$hora', '$ivaT' , '$total', $idUsuario )";

            $query = $this->db->prepare($sql);
            $inserted = $query->execute();

            if( !$inserted ) $error = true;

            $sql1 = "SELECT max(id_cotizacion) as id_cotizacion from cotizaciones";

            $query1 = $this->db->prepare($sql1);

            $query1->execute();
            $id = "";
            if ($row = $query1->fetch(PDO::FETCH_ASSOC)) {

                $id = $row['id_cotizacion'];
            }

            for ( $i=0; $i < count($arrCotizacion); $i++ ) {

                //$odt         = strval($arrCotizacion[$i][0]->value);
                $descripcion = strval($arrCotizacion[$i][0]->value);
                $cantidad    = intval($arrCotizacion[$i][1]->value);
                $precio      = floatval($arrCotizacion[$i][2]->value);
                $subtotal    = floatval($arrCotizacion[$i][3]->value);
                $iva         = floatval($arrCotizacion[$i][4]->value);
                $total       = floatval($arrCotizacion[$i][5]->value);


                $sql2 = "INSERT INTO detalle_cotizaciones ( id_cotizacion, descripcion, cantidad, precio, iva, monto ) VALUES ( $id, '$descripcion', '$cantidad', '$precio', '$iva', '$total' )";

                $query2 = $this->db->prepare($sql2);
                $inserted2 = $query2->execute();

                if( $inserted2 ){

                    $error = false;
                }else{

                    $error = true;
                    break;
                }
            }

            if( $error == false ){

                $this->db->commit();
                return $id;
            }else{

                $this->db->rollBack();
                return false;
            }

        }catch( Exception $ex ){

            return false;
        }

    }


    public function getCotizacionByID($idCotizacion){

        $idUsuario = intval($_SESSION['user']['id_usuario']);

        $sql = "SELECT * FROM detalle_cotizaciones inner join cotizaciones on cotizaciones.id_cotizacion = detalle_cotizaciones.id_cotizacion where cotizaciones.id_cotizacion = '$idCotizacion' and detalle_cotizaciones.status = 'A'";

        $query = $this->db->prepare($sql);

        $query->execute();

        $result = array();

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $result[] = $row;
        }

        return $result;
    }


    public function updateCotizacion(){

        session_start();

        $arrCotizacion   = json_decode($_POST['arrFactura']);
        $total     = floatval($_POST['txtTotal']);
        $idUsuario = intval($_SESSION['user']['id_usuario']);
        $idCotizacion = intval($_GET['idCot']);
        $error     = false;

        try{

            $this->db->beginTransaction();

            $ivaT = 0;

            for( $i=0; $i < count($arrCotizacion); $i++ ){

                $ivaT += floatval($arrCotizacion[$i][4]->value);
            }

            $sql = "UPDATE cotizaciones set iva_total ='$ivaT', monto_total = '$total' where id_cotizacion = '$idCotizacion'";

            $query = $this->db->prepare($sql);
            $inserted = $query->execute();

            if( !$inserted ) $error = true;

            $sql1 = "UPDATE detalle_cotizaciones set status='B' where id_cotizacion = '$idCotizacion'";

            $query1 = $this->db->prepare($sql1);
            $update = $query1->execute();

            if( !$update ) $error = true;

            for ( $i=0; $i < count($arrCotizacion); $i++ ) {

                //$odt         = strval($arrCotizacion[$i][0]->value);
                $descripcion = strval($arrCotizacion[$i][0]->value);
                $cantidad    = intval($arrCotizacion[$i][1]->value);
                $precio      = floatval($arrCotizacion[$i][2]->value);
                $subtotal    = floatval($arrCotizacion[$i][3]->value);
                $iva         = floatval($arrCotizacion[$i][4]->value);
                $total       = floatval($arrCotizacion[$i][5]->value);

                $sql2 = "INSERT INTO detalle_cotizaciones (id_cotizacion, descripcion, cantidad, precio, iva, monto) VALUES('$idCotizacion', '$descripcion', '$cantidad', '$precio', '$iva', '$total')";

                $query2 = $this->db->prepare($sql2);
                $inserted2 = $query2->execute();

                if( $inserted2 ){

                    $error = false;
                }else{

                    $error = true;
                    break;
                }
            }

            if( $error == false ){

                $this->db->commit();
                return true;
            }else{

                $this->db->rollBack();
                return false;
            }

        }catch( Exception $ex ){

            return false;
        }

    }
}


?>
