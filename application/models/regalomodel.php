<?php

class RegaloModel extends Controller {

    function __construct($db) {

        try {

            $this->db = $db;
        } catch (PDOException $e) {

            exit('Ups! Error de conexion a la Base de Datos. ' . $e);
        }
    }


    public function insertRegalo(&$aJson, $ventas_model) {

        $fecha = TODAY;

        $d_fecha = date("Y-m-d", strtotime($fecha));
        $time    = date("H:i:s", time());

        $id_usuario = $aJson['id_usuario'];
        $id_usuario = intval($id_usuario);

        $id_modelo         = intval($aJson['modelo']);
        $nomb_odt          = strtoupper(self::strip_slashes_recursive($aJson['nomb_odt']));
        $id_cliente        = intval($aJson['id_cliente']);
        $tiraje            = intval($aJson['tiraje']);
        $base              = round(floatval($aJson['base']), 2);
        $alto              = round(floatval($aJson['alto']), 2);
        $profundidad_cajon = round(floatval($aJson['profundidad_cajon']), 2);
        $profundidad_tapa  = round(floatval($aJson['profundidad_tapa']), 2);
        $id_grosor_carton  = intval($aJson['costo_grosor_carton']['id_papel']);
        $id_grosor_tapa    = intval($aJson['costo_grosor_tapa']['id_papel']);
        $id_usuario        = intval($aJson['id_usuario']);
        $id_tienda         = intval($aJson['id_tienda']);
        $id_papel_EmpCaj   = intval($aJson['papel_Emp']['id_papel']);
        $id_papel_FCaj     = intval($aJson['papel_FCaj']['id_papel']);
        $id_papel_EmpTap   = intval($aJson['papel_EmpTap']['id_papel']);
        $id_papel_FTap     = intval($aJson['papel_FTap']['id_papel']);


        $costo_total_odt   = round(floatval($aJson['costo_odt']), 2);
        $subtotal          = round(floatval($aJson['costo_subtotal']), 2);
        $utilidad          = round(floatval($aJson['Utilidad']), 2);
        $iva               = round(floatval($aJson['iva']), 2);
        $ISR               = round(floatval($aJson['ISR']), 2);
        $comisiones        = round(floatval($aJson['comisiones']), 2);
        $indirecto         = round(floatval($aJson['indirecto']), 2);
        $ventas            = round(floatval($aJson['ventas']), 2);
        $descuento         = round(floatval($aJson['descuento']), 2);
        $descuento_pctje   = round(floatval($aJson['descuento_pctje']), 2);
        $empaque           = round(floatval($aJson['empaque']), 2);
        $mensajeria        = round(floatval($aJson['mensajeria']), 2);

        $keys              = self::strip_slashes_recursive($aJson['keys']);

        $odt = $nomb_odt;

        $mensaje = "ERROR";
        $error   = "Error al grabar en la tabla ";

        $l_existe = $ventas_model->chkODT();

        if (!$l_existe) {

            self::mError($aJson, $mensaje, "Ya existe esta Orden de Trabajo;");

            return $aJson;
        }


        // variables booleanas

        $l_inserted = true;

        $l_modificar_odt = false;

        if (isset($_POST['modificar'])) {

            $modificar = $_POST['modificar'];
            $modificar = self::strip_slashes_recursive($modificar);
        }


        if (isset($_POST['id_odt_ant']) and $_POST['modificar'] === "SI") {

            $l_modificar_odt = true;
            $id_odt_anterior = intval($_POST['id_odt_ant']);
        }


        $is_maquila = 0;

        if (array_key_exists("aImpEmp", $aJson)) {

                $aImp_tmp = [];

                $aImp_tmp = $aJson['aImpEmp'];

                if (array_key_exists("Maquila", $aImp_tmp)) {

                    $is_maquila = 1;
                }
        }


        if (array_key_exists("aImpFCaj", $aJson)) {

                $aImp_tmp = [];

                $aImp_tmp = $aJson['aImpFCaj'];

                if (array_key_exists("Maquila", $aImp_tmp)) {

                    $is_maquila = 1;
                }
        }


        if (array_key_exists("aImpEmpTap", $aJson)) {

                $aImp_tmp = [];

                $aImp_tmp = $aJson['aImpEmpTap'];

                if (array_key_exists("Maquila", $aImp_tmp)) {

                    $is_maquila = 1;
                }
        }


        if (array_key_exists("aImpFTap", $aJson)) {

                $aImp_tmp = [];

                $aImp_tmp = $aJson['aImpFTap'];

                if (array_key_exists("Maquila", $aImp_tmp)) {

                    $is_maquila = 1;
                }
        }


        try {

            $this->db->beginTransaction();

            if ($l_modificar_odt) {

                $row = $ventas_model->getOdtById($id_odt_anterior);

                $id_odt_orig = $row['id_odt_orig'];
                $id_odt_orig = intval($id_odt_orig);


                $sql = "INSERT INTO cot_odt
                    (id_usuario, id_modelo, num_odt, id_cliente, is_maquila, tiraje, base, alto, profundidad_cajon, profundidad_tapa, id_vendedor, id_tienda, costo_total, subtotal, utilidad, iva, ISR, comisiones, indirecto, venta, descuento, descuento_pcte, empaque, mensajeria, procesos, id_odt_ant, id_odt_orig, fecha_odt, hora_odt)
                VALUES
                    ($id_usuario, $id_modelo, '$odt', $id_cliente, $is_maquila, $tiraje, $base, $alto, $profundidad_cajon, $profundidad_tapa, $id_usuario, $id_tienda, $costo_total_odt, $subtotal, $utilidad, $iva, $ISR, $comisiones, $indirecto, $ventas, $descuento, $descuento_pctje, $empaque, $mensajeria, '$keys', $id_odt_anterior, $id_odt_orig, '$d_fecha', '$time')";
            } else {

                $sql = "INSERT INTO cot_odt
                    (id_usuario, id_modelo, num_odt, id_cliente, is_maquila, tiraje, base, alto, profundidad_cajon, profundidad_tapa, id_vendedor, id_tienda, costo_total, subtotal, utilidad, iva, ISR, comisiones, indirecto, venta, descuento, descuento_pcte, empaque, mensajeria, procesos, fecha_odt, hora_odt)
                VALUES
                    ($id_usuario, $id_modelo, '$odt', $id_cliente, $is_maquila, $tiraje, $base, $alto, $profundidad_cajon, $profundidad_tapa, $id_usuario, $id_tienda, $costo_total_odt, $subtotal, $utilidad, $iva, $ISR, $comisiones, $indirecto, $ventas, $descuento, $descuento_pctje, $empaque, $mensajeria, '$keys', '$d_fecha', '$time')";
            }

            $query_odt = $this->db->prepare($sql);

            $l_inserted = $query_odt->execute();

            $id_caja_odt = 0;

            $id_caja_odt = $this->db->lastInsertId();
            $id_caja_odt = intval($id_caja_odt);

            if ($id_caja_odt <= 0 or !$l_inserted) {

                self::mError($aJson, $mensaje, $error .  "odt;");

                $l_inserted = false;
            } else {

                $aJson['id_odt_act'] = $id_caja_odt;
            }


            if (!$l_modificar_odt) {

                $sql_odt_orig = "UPDATE cot_odt SET id_odt_orig = " . $id_caja_odt . " WHERE id_odt = " . $id_caja_odt;

                $query_odt_orig = $this->db->prepare($sql_odt_orig);

                $inserted_odt_orig = $query_odt_orig->execute();

                if (!$inserted_odt_orig) {

                    $l_inserted        = false;
                    $inserted_odt_orig = false;
                }
            } else {

                $aJson['id_odt_act'] = $id_caja_odt;
            }


        // cot_procesos
            $l_procesos = true;

            $papel          = $aJson['costo_papeles'];
            $cartones       = $aJson['costo_cartones'];
            $costos_fijos   = $aJson['costos_fijos'];
            $Imp_EmpCaj     = $aJson['Imp_EmpCaj'];
            $Imp_EmpCaj_maq = $aJson['Imp_EmpCaj_maq'];
            $Imp_FCaj       = $aJson['Imp_FCaj'];
            $Imp_FCaj_maq   = $aJson['Imp_FCaj_maq'];
            $Imp_EmpTap     = $aJson['Imp_EmpTap'];
            $Imp_EmpTap_maq = $aJson['Imp_EmpTap_maq'];
            $Imp_FTap       = $aJson['Imp_FTap'];
            $Imp_FTap_maq   = $aJson['Imp_FTap_maq'];

            $Acb_EmpFCaj    = $aJson['Acb_EmpFCaj'];
            $Acb_FCaj       = $aJson['Acb_FCaj'];
            $Acb_EmpTap     = $aJson['Acb_EmpTap'];
            $Acb_FTap       = $aJson['Acb_FTap'];

            $sql_procesos = "INSERT INTO cot_reg_procesos(id_modelo, id_odt, papel, carton, costos_fijos, imp_emp, imp_emp_maq, imp_fcaj, imp_fcaj_maq, imp_emptap, imp_emptap_maq, imp_ftap, imp_ftap_maq, acb_emp, acb_fcaj, acb_emptap, acb_ftap, fecha_odt)
                VALUES($id_modelo, $id_caja_odt, $papel, $cartones, $costos_fijos, $Imp_EmpCaj, $Imp_EmpCaj_maq, $Imp_FCaj, $Imp_FCaj_maq, $Imp_EmpTap, $Imp_EmpTap_maq, $Imp_FTap, $Imp_FTap_maq, $Acb_EmpFCaj, $Acb_FCaj, $Acb_EmpTap, $Acb_FTap, '$d_fecha')";

            $query_procesos = $this->db->prepare($sql_procesos);

            $l_procesos = $query_procesos->execute();

            if (!$l_procesos) {

                self::mError($aJson, $mensaje, $error .  "procesos;");

                $l_procesos = false;
            }


        // Calculadora
            $l_calculadora = true;

            $b     = round(floatval($aJson['Calculadora']['b']), 3);
            $h     = round(floatval($aJson['Calculadora']['h']), 3);
            $p     = round(floatval($aJson['Calculadora']['p']), 3);
            $T     = round(floatval($aJson['Calculadora']['T']), 3);
            $g     = round(floatval($aJson['Calculadora']['g']), 3);
            $G     = round(floatval($aJson['Calculadora']['G']), 3);
            $e     = round(floatval($aJson['Calculadora']['e']), 3);
            $E     = round(floatval($aJson['Calculadora']['E']), 3);
            $b1    = round(floatval($aJson['Calculadora']['b1']), 3);
            $h1    = round(floatval($aJson['Calculadora']['h1']), 3);
            $p1    = round(floatval($aJson['Calculadora']['p1']), 3);
            $x     = round(floatval($aJson['Calculadora']['x']), 3);
            $y     = round(floatval($aJson['Calculadora']['y']), 3);
            $x1    = round(floatval($aJson['Calculadora']['x1']), 3);
            $y1    = round(floatval($aJson['Calculadora']['y1']), 3);
            $x11   = round(floatval($aJson['Calculadora']['x11']), 3);
            $y11   = round(floatval($aJson['Calculadora']['y11']), 3);
            $b11   = round(floatval($aJson['Calculadora']['b11']), 3);
            $h11   = round(floatval($aJson['Calculadora']['h11']), 3);
            $f     = round(floatval($aJson['Calculadora']['f']), 3);
            $k     = round(floatval($aJson['Calculadora']['k']), 3);
            $B     = round(floatval($aJson['Calculadora']['B']), 3);
            $H     = round(floatval($aJson['Calculadora']['H']), 3);
            $X     = round(floatval($aJson['Calculadora']['X']), 3);
            $Y     = round(floatval($aJson['Calculadora']['Y']), 3);
            $B1    = round(floatval($aJson['Calculadora']['B1']), 3);
            $H1    = round(floatval($aJson['Calculadora']['H1']), 3);
            $X1    = round(floatval($aJson['Calculadora']['X1']), 3);
            $Y1    = round(floatval($aJson['Calculadora']['Y1']), 3);
            $X11   = round(floatval($aJson['Calculadora']['X11']), 3);
            $Y11   = round(floatval($aJson['Calculadora']['Y11']), 3);
            $B11   = round(floatval($aJson['Calculadora']['B11']), 3);
            $H11   = round(floatval($aJson['Calculadora']['H11']), 3);
            $F     = round(floatval($aJson['Calculadora']['F']), 3);
            $K     = round(floatval($aJson['Calculadora']['K']), 3);



            $sql_calculadora = "INSERT INTO cot_reg_calculadora(id_modelo, id_odt, b, h, p, t_may, g, g_may, e, e_may, b1, h1, p1, x, y, x1, y1, x11, y11, b11, h11, f, k, b_may, h_may, x_may, y_may, b1_may, h1_may, x1_may, y1_may, x11_may, y11_may, b11_may, h11_may, f_may, k_may, fecha_odt, hora_odt)
                VALUES($id_modelo, $id_caja_odt, $b, $h, $p, $T, $g, $G, $e, $E, $b1, $h1, $p1, $x, $y, $x1, $y1, $x11, $y11, $b11, $h11, $f, $k, $B, $H, $X, $Y, $B1, $H1, $X1, $Y1, $X11, $Y11, $B11, $H11, $F, $K, '$d_fecha', '$time')";

            $query_calculadora = $this->db->prepare($sql_calculadora);

            $l_calculadora = $query_calculadora->execute();

            if (!$l_calculadora) {

                self::mError($aJson, $mensaje, $error .  "calculadora;");

                $l_calculadora = false;
            }


        /******* Carton *******/

            $inserted_papel_car = true;

            $id_papel      = intval($aJson['costo_grosor_carton']['id_papel']);
            $num_carton    = intval($aJson['costo_grosor_carton']['num_carton']);
            $cantidad      = $tiraje;
            $nombre        = self::strip_slashes_recursive($aJson['costo_grosor_carton']['nombre_papel']);
            $costo_unit    = round(floatval($aJson['costo_grosor_carton']['costo_unit_papel']), 4);
            $ancho         = round(floatval($aJson['costo_grosor_carton']['ancho_papel']), 2);
            $largo         = round(floatval($aJson['costo_grosor_carton']['largo_papel']), 2);
            $c_ancho       = round(floatval($aJson['costo_grosor_carton']['calculadora']['corte_ancho']), 2);
            $c_largo       = round(floatval($aJson['costo_grosor_carton']['calculadora']['corte_largo']), 2);
            $corte         = intval($aJson['costo_grosor_carton']['corte']);
            $tot_pliegos   = intval($aJson['costo_grosor_carton']['tot_pliegos']);
            $tot_costo     = round(floatval($aJson['costo_grosor_carton']['tot_costo']), 2);



        // Carton Cajon
            $sql_papel_car = "INSERT INTO cot_reg_carton
                (id_modelo, id_odt, id_cajon, tiraje, num_cajon, nombre, precio, ancho, largo, corte_ancho, corte_largo, piezas_por_pliego, num_pliegos, costo_tot_carton, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $id_papel, $tiraje, $num_carton, '$nombre', $costo_unit, $ancho, $largo, $c_ancho, $c_largo, $corte, $tot_pliegos, $tot_costo, '$d_fecha')";


            $query_papel_car = $this->db->prepare($sql_papel_car);

            $inserted_papel_car = $query_papel_car->execute();

            if (!$inserted_papel_car) {

                self::mError($aJson, $mensaje, $error .  "carton;");

                $inserted_papel_car = false;
            }



        /******* Carton de la Tapa *******/

            $inserted_papel_cartap = true;

            $id_papel      = intval($aJson['costo_grosor_tapa']['id_papel']);
            $num_carton    = intval($aJson['costo_grosor_tapa']['num_carton']);
            $cantidad      = $tiraje;
            $nombre        = self::strip_slashes_recursive($aJson['costo_grosor_tapa']['nombre_papel']);
            $costo_unit    = round(floatval($aJson['costo_grosor_tapa']['costo_unit_papel']), 4);
            $ancho         = round(floatval($aJson['costo_grosor_tapa']['ancho_papel']), 2);
            $largo         = round(floatval($aJson['costo_grosor_tapa']['largo_papel']), 2);
            $c_ancho       = round(floatval($aJson['costo_grosor_tapa']['calculadora']['corte_ancho']), 2);
            $c_largo       = round(floatval($aJson['costo_grosor_tapa']['calculadora']['corte_largo']), 2);
            $corte         = intval($aJson['costo_grosor_tapa']['corte']);
            $tot_pliegos   = intval($aJson['costo_grosor_tapa']['tot_pliegos']);
            $tot_costo     = floatval($aJson['costo_grosor_tapa']['tot_costo']);


        // Carton Tapa
            $sql_papel_cartap = "INSERT INTO cot_reg_cartontap
                (id_modelo, id_odt, id_cajon, tiraje, num_cajon, nombre, precio, ancho, largo, corte_ancho, corte_largo, piezas_por_pliego, num_pliegos, costo_tot_carton, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $id_papel, $tiraje, $num_carton, '$nombre', $costo_unit, $ancho, $largo, $c_ancho, $c_largo, $corte, $tot_pliegos, $tot_costo, '$d_fecha')";


            $query_papel_cartap = $this->db->prepare($sql_papel_cartap);

            $inserted_papel_cartap = $query_papel_cartap->execute();

            if (!$inserted_papel_cartap) {

                self::mError($aJson, $mensaje, $error .  "carton tapa;");

                $inserted_papel_cartap = false;
            }



    /********* inicia papeles ************/

        // papel Empalme del Cajon

            $inserted_papel_empcaj = true;

            $id_papel          = intval($aJson['papel_Emp']['id_papel']);
            $nombre            = self::strip_slashes_recursive($aJson['papel_Emp']['nombre_papel']);
            $ancho             = round(floatval($aJson['papel_Emp']['ancho_papel']), 2);
            $largo             = round(floatval($aJson['papel_Emp']['largo_papel']), 2);
            $costo_unit        = round(floatval($aJson['papel_Emp']['costo_unit_papel']), 4);
            $cortes            = intval($aJson['papel_Emp']['corte']);
            $pliegos           = intval($aJson['papel_Emp']['tot_pliegos']);
            $costo_tot_pliegos = round(floatval($aJson['papel_Emp']['tot_costo']), 2);
            $corte_ancho       = round(floatval($aJson['papel_Emp']['calculadora']['corte_ancho']), 2);
            $corte_largo       = round(floatval($aJson['papel_Emp']['calculadora']['corte_largo']), 2);


            $sql_papel_empcaj = "INSERT INTO cot_reg_papelempcaj
                (id_modelo, id_odt, id_papel, nombre, ancho, largo, costo_unitario, tiraje, cortes, pliegos, costo_tot_pliegos, corte_ancho, corte_largo, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $id_papel, '$nombre', $ancho, $largo, $costo_unit, $tiraje, $cortes, $pliegos, $costo_tot_pliegos, $corte_ancho, $corte_largo, '$d_fecha')";


            $query_papel_empcaj = $this->db->prepare($sql_papel_empcaj);

            $inserted_papel_empcaj = $query_papel_empcaj->execute();

            if (!$inserted_papel_empcaj) {

                self::mError($aJson, $mensaje, $error .  "papel empalme cajon;");

                $inserted_papel_empcaj = false;
            }


        // papel Forro del Cajon
            $inserted_papel_fcaj = true;

            $id_papel          = intval($aJson['papel_FCaj']['id_papel']);
            $nombre            = self::strip_slashes_recursive($aJson['papel_FCaj']['nombre_papel']);
            $ancho             = round(floatval($aJson['papel_FCaj']['ancho_papel']), 2);
            $largo             = round(floatval($aJson['papel_FCaj']['largo_papel']), 2);
            $costo_unit        = round(floatval($aJson['papel_FCaj']['costo_unit_papel']), 4);
            $cortes            = intval($aJson['papel_FCaj']['corte']);
            $pliegos           = intval($aJson['papel_FCaj']['tot_pliegos']);
            $costo_tot_pliegos = round(floatval($aJson['papel_FCaj']['tot_costo']), 2);
            $corte_ancho       = round(floatval($aJson['papel_FCaj']['calculadora']['corte_ancho']), 2);
            $corte_largo       = round(floatval($aJson['papel_FCaj']['calculadora']['corte_largo']), 2);


            $sql_papel_fcaj = "INSERT INTO cot_reg_papelfcaj
                (id_modelo, id_odt, id_papel, nombre, ancho, largo, costo_unitario, tiraje, cortes, pliegos, costo_tot_pliegos, corte_ancho, corte_largo, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $id_papel, '$nombre', $ancho, $largo, $costo_unit, $tiraje, $cortes, $pliegos, $costo_tot_pliegos, $corte_ancho, $corte_largo, '$d_fecha')";


            $query_papel_fcaj = $this->db->prepare($sql_papel_fcaj);

            $inserted_papel_fcaj = $query_papel_fcaj->execute();

            if (!$inserted_papel_fcaj) {

                self::mError($aJson, $mensaje, $error .  "papel forro cajon;");

                $inserted_papel_fcaj = false;
            }


        // papel empalme de la tapa
            $inserted_papel_emptap = true;

            $id_papel          = intval($aJson['papel_EmpTap']['id_papel']);
            $nombre            = self::strip_slashes_recursive($aJson['papel_EmpTap']['nombre_papel']);
            $ancho             = round(floatval($aJson['papel_EmpTap']['ancho_papel']), 2);
            $largo             = round(floatval($aJson['papel_EmpTap']['largo_papel']), 2);
            $costo_unit        = round(floatval($aJson['papel_EmpTap']['costo_unit_papel']), 4);
            $cortes            = intval($aJson['papel_EmpTap']['corte']);
            $pliegos           = intval($aJson['papel_EmpTap']['tot_pliegos']);
            $costo_tot_pliegos = round(floatval($aJson['papel_EmpTap']['tot_costo']), 2);
            $corte_ancho       = round(floatval($aJson['papel_EmpTap']['calculadora']['corte_ancho']), 2);
            $corte_largo       = round(floatval($aJson['papel_EmpTap']['calculadora']['corte_largo']), 2);


            $sql_papel_emptap = "INSERT INTO cot_reg_papelemptap
                (id_modelo, id_odt, id_papel, nombre, ancho, largo, costo_unitario, tiraje, cortes, pliegos, costo_tot_pliegos, corte_ancho, corte_largo, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $id_papel, '$nombre', $ancho, $largo, $costo_unit, $tiraje, $cortes, $pliegos, $costo_tot_pliegos, $corte_ancho, $corte_largo, '$d_fecha')";



            $query_papel_emptap = $this->db->prepare($sql_papel_emptap);

            $inserted_papel_emptap = $query_papel_emptap->execute();

            if (!$inserted_papel_emptap) {

                self::mError($aJson, $mensaje, $error .  "papel empalme tapa;");

                $inserted_papel_emptap = false;
            }


        // papel Forro de la Tapa
            $inserted_papel_ftap = true;

            $id_papel          = intval($aJson['papel_FTap']['id_papel']);
            $nombre            = self::strip_slashes_recursive($aJson['papel_FTap']['nombre_papel']);
            $ancho             = round(floatval($aJson['papel_FTap']['ancho_papel']), 2);
            $largo             = round(floatval($aJson['papel_FTap']['largo_papel']), 2);
            $costo_unit        = round(floatval($aJson['papel_FTap']['costo_unit_papel']), 4);
            $cortes            = intval($aJson['papel_FTap']['corte']);
            $pliegos           = intval($aJson['papel_FTap']['tot_pliegos']);
            $costo_tot_pliegos = round(floatval($aJson['papel_FTap']['tot_costo']), 2);
            $corte_ancho       = round(floatval($aJson['papel_FTap']['calculadora']['corte_ancho']), 2);
            $corte_largo       = round(floatval($aJson['papel_FTap']['calculadora']['corte_largo']), 2);

            $sql_papel_ftap = "INSERT INTO cot_reg_papelftap
                (id_modelo, id_odt, id_papel, nombre, ancho, largo, costo_unitario, tiraje, cortes, pliegos, costo_tot_pliegos, corte_ancho, corte_largo, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $id_papel, '$nombre', $ancho, $largo, $costo_unit, $tiraje, $cortes, $pliegos, $costo_tot_pliegos, $corte_ancho, $corte_largo, '$d_fecha')";


            $query_papel_ftap = $this->db->prepare($sql_papel_ftap);

            $inserted_papel_ftap = $query_papel_ftap->execute();

            if (!$inserted_papel_ftap) {

                self::mError($aJson, $mensaje, $error .  "papel forro tapa;");

                $inserted_papel_ftap = false;
            }



    /********* terminados los papeles **********/


    /********* inicia costos fijos **********/

        // ranurado
            $l_ranurado = true;

            $ranurado = $aJson['ranurado'];

            $arreglo               = round(floatval($ranurado['arreglo']), 2);
            $costo_unit_por_ranura = round(floatval($ranurado['costo_unit_por_ranura']), 2);
            $costo_por_ranura      = round(floatval($ranurado['costo_por_ranura']), 2);
            $costo_tot_proceso     = round(floatval($ranurado['costo_tot_proceso']), 2);


            $sql_ranurado = "INSERT INTO cot_reg_ranurado
                (id_modelo, id_odt, tiraje, arreglo, costo_unit, costo_por_ranura, costo_tot_ranurado, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $arreglo, $costo_unit_por_ranura, $costo_por_ranura, $costo_tot_proceso, '$d_fecha')";


            $query_ranurado = $this->db->prepare($sql_ranurado);

            $l_ranurado = $query_ranurado->execute();

            if (!$l_ranurado) {

                self::mError($aJson, $mensaje, $error .  "ranurado;");

                $l_ranurado = false;
            }


        // ranurado tapa
            $l_ranurado_tap = true;

            $ranurado = $aJson['ranurado'];

            $arreglo               = round(floatval($ranurado['arreglo']), 2);
            $costo_unit_por_ranura = round(floatval($ranurado['costo_unit_por_ranura']), 2);
            $costo_por_ranura      = round(floatval($ranurado['costo_por_ranura']), 2);
            $costo_tot_proceso     = round(floatval($ranurado['costo_tot_proceso']), 2);


            $sql_ranurado = "INSERT INTO cot_reg_ranurado_tap
                (id_modelo, id_odt, tiraje, arreglo, costo_unit, costo_por_ranura, costo_tot_ranurado, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $arreglo, $costo_unit_por_ranura, $costo_por_ranura, $costo_tot_proceso, '$d_fecha')";


            $query_ranurado = $this->db->prepare($sql_ranurado);

            $l_ranurado_tap = $query_ranurado->execute();

            if (!$l_ranurado_tap) {

                self::mError($aJson, $mensaje, $error .  "ranurado tapa;");

                $l_ranurado_tap = false;
            }



        // encuadernacion
            $l_encuadernacion = true;

            $arreglo_forrado_cajon_costo_unitario   = round(floatval($aJson['encuadernacion']['arreglo_costo_unitario']), 2);
            $arreglo_forrado_cajon_costo_tot        = round(floatval($aJson['encuadernacion']['arreglo_forrado_cajon_costo']), 2);
            $forrado_cajon_costo_unitario           = round(floatval($aJson['encuadernacion']['forrado_cajon_costo_unitario']), 2);
            $forrado_cajon_costo                    = round(floatval($aJson['encuadernacion']['forrado_cajon_costo']), 2);
            $encuad_costo_tot_proceso               = round(floatval($aJson['encuadernacion']['costo_tot_proceso']), 2);


            $sql_encuadernacion = "INSERT INTO cot_reg_encuadernacion
                (id_modelo, id_odt, tiraje, arreglo_forrado_cajon_costo_unitario, arreglo_forrado_cajon_costo_tot, forrado_cajon_costo_unitario, forrado_cajon_costo, costo_tot_proceso, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $arreglo_forrado_cajon_costo_unitario, $arreglo_forrado_cajon_costo_tot, $forrado_cajon_costo_unitario, $forrado_cajon_costo, $encuad_costo_tot_proceso, '$d_fecha')";


            $query_encuadernacion = $this->db->prepare($sql_encuadernacion);

            $l_encuadernacion = $query_encuadernacion->execute();

            if (!$l_encuadernacion) {

                self::mError($aJson, $mensaje, $error . "encuadernacion;");

                $l_encuadernacion = false;
            }


            // encajada
            $l_encajada = true;

            $costo_unit        = floatval($aJson['encajada']['costo_unitario']);
            $costo_tot_proceso = floatval($aJson['encajada']['costo_tot_proceso']);

            $sql_encajada = "INSERT INTO cot_reg_encajadafcaj
                (id_modelo, id_odt, tiraje, costo_unit, costo_tot_proceso, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $costo_unit, $costo_tot_proceso,'$d_fecha')";

            $query_encajada = $this->db->prepare($sql_encajada);

            $l_encajada = $query_encajada->execute();

            if (!$l_encajada) {

                self::mError($aJson, $mensaje, $error . "encajada;");

                $l_encajada = false;
            }


            $forrado_cajon_costo_unit = $aJson['encuadernacion_fcaj']['forrado_cajon_costo_unit'];
            $forrado_de_cajon = $aJson['encuadernacion_fcaj']['forrado_de_cajon'];

            $empalme_cajon_costo_unitario = $aJson['encuadernacion_fcaj']['empalme_cajon_costo_unitario'];
            $empalme_de_cajon = $aJson['encuadernacion_fcaj']['empalme_de_cajon'];

            $arreglo_de_forrado_de_cajon = $aJson['encuadernacion_fcaj']['arreglo_costo'];

            $costo_tot_proceso = $aJson['encuadernacion_fcaj']['costo_tot_proceso'];


            // encuadernacion forro del cajon
            $sql_encuadernacionfcaj = "INSERT INTO cot_reg_encuadernacionfcaj
                (id_modelo, id_odt, tiraje, arreglo_forrado_cajon_costo_unitario, arreglo_forrado_cajon_costo_tot, forrado_cajon_costo_unitario, forrado_cajon_costo, empalme_cajon_costo_unitario, empalme_de_cajon, costo_tot_proceso, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $arreglo_de_forrado_de_cajon, $arreglo_de_forrado_de_cajon, $forrado_cajon_costo_unit, $forrado_de_cajon, $empalme_cajon_costo_unitario, $empalme_de_cajon, $costo_tot_proceso, '$d_fecha')";


            $query_encuadernacionfcaj = $this->db->prepare($sql_encuadernacionfcaj);

            $l_encuadernacionfcaj = $query_encuadernacionfcaj->execute();

            if (!$l_encuadernacionfcaj) {

                self::mError($aJson, $mensaje, $error . "encuadernacion;");

                $l_encuadernacionfcaj = false;
            }


            // encajada forro tapa
            $l_encajada_ftap = true;

            $costo_unit        = floatval($aJson['encajada']['costo_unitario']);
            $costo_tot_proceso = floatval($aJson['encajada']['costo_tot_proceso']);

            $sql_encajada_ftap = "INSERT INTO cot_reg_encajadaftap
                (id_modelo, id_odt, tiraje, costo_unit, costo_tot_proceso, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $costo_unit, $costo_tot_proceso,'$d_fecha')";

            $query_encajada = $this->db->prepare($sql_encajada_ftap);

            $l_encajada_ftap = $query_encajada->execute();

            if (!$l_encajada_ftap) {

                self::mError($aJson, $mensaje, $error . "encajada forro tapa;");

                $l_encajada_ftap = false;
            }


            // Elaboracion forro del Cajon
            $l_elab_fcaj = true;

            $forro_costo_unit       = round(floatval($aJson['elab_FCaj']['forrado_cajon_costo_unitario']), 2);
            $forro_cajon            = round(floatval($aJson['elab_FCaj']['forrado_cajon']), 2);
            $arreglo                = round(floatval($aJson['elab_FCaj']['arreglo_forrado_cajon']), 2);
            $empalme_costo_unitario = round(floatval($aJson['elab_FCaj']['empalme_cajon_costo_unitario']), 2);
            $empalme_de_cajon       = round(floatval($aJson['elab_FCaj']['empalme_de_cajon']), 2);
            $costo_total            = round(floatval($aJson['elab_FCaj']['costo_tot_proceso']), 2);


            $sql_elabfcaj = "INSERT INTO cot_reg_elab_fcaj
                (id_modelo, id_odt, tiraje, forro_costo_unit, forro_cajon, arreglo, empalme_costo_unitario, empalme_de_cajon, costo_total, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $forro_costo_unit, $forro_cajon, $arreglo, $empalme_costo_unitario, $empalme_de_cajon, $costo_total, '$d_fecha')";


            $query_elabfcaj = $this->db->prepare($sql_elabfcaj);

            $l_elab_fcaj = $query_elabfcaj->execute();

            if (!$l_elab_fcaj) {

                self::mError($aJson, $mensaje, $error . "elaboracion forro cajon;");

                $l_elab_fcaj = false;
            }


            // Encuadernacion forro de la Tapa
            $l_elab_ftap = true;

            $forro_costo_unit       = round(floatval($aJson['elab_FTap']['forrado_cajon_costo_unitario']), 2);
            $forro_cajon            = round(floatval($aJson['elab_FTap']['forrado_cajon']), 2);
            $arreglo                = round(floatval($aJson['elab_FTap']['arreglo_forrado_cajon']), 2);
            $empalme_costo_unitario = round(floatval($aJson['elab_FTap']['empalme_cajon_costo_unitario']), 2);
            $empalme_de_cajon       = round(floatval($aJson['elab_FTap']['empalme_de_cajon']), 2);
            $costo_total            = round(floatval($aJson['elab_FTap']['costo_tot_proceso']), 2);

            $sql_elab_ftap = "INSERT INTO cot_reg_elab_ftap
                (id_modelo, id_odt, tiraje, forro_costo_unit, forro_cajon, arreglo, empalme_costo_unitario, empalme_de_cajon, costo_total, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $forro_costo_unit, $forro_cajon, $arreglo, $empalme_costo_unitario, $empalme_de_cajon, $costo_total, '$d_fecha')";


            $query_elab_ftap = $this->db->prepare($sql_elab_ftap);

            $l_elab_ftap = $query_elab_ftap->execute();

            if (!$l_elab_ftap) {

                self::mError($aJson, $mensaje, $error . "elaboracion forro tapa;");

                $l_elab_ftap = false;
            }


            // corte carton
            $l_corte_carton_empcaj  = true;

            // corte carton empalme
            $corte_costo_unitario = round(floatval($aJson['costo_corte_carton_empcaj']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_corte_carton_empcaj']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_corte_carton_empcaj']['tot_pliegos']);
            $millares             = intval($aJson['costo_corte_carton_empcaj']['millares']);
            $costo_corte          = round(floatval($aJson['costo_corte_carton_empcaj']['tot_costo_corte']), 2);

            $sql_corte_carton = "INSERT INTO cot_reg_corte_carton_empcaj
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_carton = $this->db->prepare($sql_corte_carton);

            $l_corte_carton_empcaj = $query_corte_carton->execute();

            if (!$l_corte_carton_empcaj) {

                self::mError($aJson, $mensaje, $error . "corte carton empalme cajon;");

                $l_corte_carton_empcaj = false;
            }


            // corte carton empalme tapa
            $l_corte_carton_emptap = true;

            $corte_costo_unitario = round(floatval($aJson['costo_corte_carton_emptap']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_corte_carton_emptap']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_corte_carton_emptap']['tot_pliegos']);
            $millares             = intval($aJson['costo_corte_carton_emptap']['millares']);
            $costo_corte          = round(floatval($aJson['costo_corte_carton_emptap']['tot_costo_corte']), 2);

            $sql_corte_carton_emptap = "INSERT INTO cot_reg_corte_carton_emptap
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_carton_emptap = $this->db->prepare($sql_corte_carton_emptap);

            $l_corte_carton_emptap = $query_corte_carton_emptap->execute();

            if (!$l_corte_carton_emptap) {

                self::mError($aJson, $mensaje, $error . "corte carton empalme tapa;");

                $l_corte_carton_emptap = false;
            }


            // corte carton empalme
            $l_corte_papel_empcaj  = true;

            $corte_costo_unitario = round(floatval($aJson['costo_papel_corte']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_papel_corte']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_papel_corte']['tot_pliegos']);
            $millares             = intval($aJson['costo_papel_corte']['millares']);
            $costo_corte          = round(floatval($aJson['costo_papel_corte']['tot_costo_corte']), 2);

            $sql_corte_papel = "INSERT INTO cot_reg_corte_papel_empcaj
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_papel = $this->db->prepare($sql_corte_papel);

            $l_corte_papel_empcaj = $query_corte_papel->execute();

            if (!$l_corte_papel_empcaj) {

                self::mError($aJson, $mensaje, $error . "corte papel empalme cajon;");

                $l_corte_papel_empcaj = false;
            }


            // corte papel empalme
            $l_corte_papel_emptap = true;

            $corte_costo_unitario = round(floatval($aJson['costo_papel_corte_emptap']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_papel_corte_emptap']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_papel_corte_emptap']['tot_pliegos']);
            $millares             = intval($aJson['costo_papel_corte_emptap']['millares']);
            $costo_corte          = round(floatval($aJson['costo_papel_corte_emptap']['tot_costo_corte']), 2);

            $sql_corte_papel_emptap = "INSERT INTO cot_reg_corte_papel_emptap
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_papel_emptap = $this->db->prepare($sql_corte_papel_emptap);

            $l_corte_papel_emp_emptap = $query_corte_papel_emptap->execute();


            if (!$l_corte_papel_emp_emptap) {

                self::mError($aJson, $mensaje, $error . "corte papel empalme tapa;");

                $l_corte_papel_emp_emptap = false;
            }


            // corte refine empalme
            $l_corte_refine_emp  = true;

            $corte_costo_unitario = round(floatval($aJson['costo_corte_refine_emp']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_corte_refine_emp']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_corte_refine_emp']['tot_pliegos']);
            $millares             = intval($aJson['costo_corte_refine_emp']['millares']);
            $costo_corte          = round(floatval($aJson['costo_corte_refine_emp']['tot_costo_corte']), 2);

            $sql_corte_refine = "INSERT INTO cot_reg_corte_refine_empcaj
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_refine = $this->db->prepare($sql_corte_refine);

            $l_corte_refine_emp = $query_corte_refine->execute();


            if (!$l_corte_refine_emp) {

                self::mError($aJson, $mensaje, $error . "corte refine empalme cajon;");

                $l_corte_refine_emp = false;
            }


            // corte refine empalmado tapa
            $l_corte_refine_emptap = true;

            $corte_costo_unitario = round(floatval($aJson['costo_papel_corte_emptap']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_papel_corte_emptap']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_papel_corte_emptap']['tot_pliegos']);
            $millares             = intval($aJson['costo_papel_corte_emptap']['millares']);
            $costo_corte          = round(floatval($aJson['costo_papel_corte_emptap']['tot_costo_corte']), 2);

            $sql_corte_refine_emptap = "INSERT INTO cot_reg_corte_refine_emptap
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_refine_emptap = $this->db->prepare($sql_corte_refine_emptap);

            $l_corte_refine_emptap = $query_corte_refine_emptap->execute();


            if (!$l_corte_refine_emptap) {

                self::mError($aJson, $mensaje, $error . "corte refine empalme tapa;");

                $l_corte_refine_emptap = false;
            }


        // arreglo ranurado horizontal
            $l_arr_ran_hor_emp = true;

            $costo_arreglo = round(floatval($aJson['arreglo_ranurado_hor_emp']['arreglo']), 2);
            $costo_unit_ranura = round(floatval($aJson['arreglo_ranurado_hor_emp']['costo_unit_por_ranura']), 2);
            $costo_ranura = round(floatval($aJson['arreglo_ranurado_hor_emp']['costo_por_ranura']), 2);
            $costo_tot_ranurado = round(floatval($aJson['arreglo_ranurado_hor_emp']['costo_tot_ranurado']), 2);

            $sql_ranurado_arreglo_ran_hor = "INSERT INTO cot_reg_arreglo_ranurado_hor_empcaj
                (id_odt, id_modelo, tiraje, costo_arreglo, costo_unit_ranura, costo_ranura, costo_tot_ranurado, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $costo_arreglo, $costo_unit_ranura, $costo_por_ranura, $costo_tot_ranurado, '$d_fecha')";

            $query_arreglo_ranurado_hor = $this->db->prepare($sql_ranurado_arreglo_ran_hor);

            $l_arr_ran_hor_emp = $query_arreglo_ranurado_hor->execute();


            if (!$l_arr_ran_hor_emp) {

                self::mError($aJson, $mensaje, $error . "arreglo ranurado horizontal empalme cajon;");

                $l_arr_ran_hor_emp = false;
            }


        // arreglo ranurado vertical
            $l_arr_ran_vert_emp = true;

            if ( ($aJson['base'] > $aJson['alto'])  or ($aJson['base'] < $aJson['alto']) ) {


                if ($costo_unit > 0) {

                    $sql_ranurado_arreglo_ran_ver = "INSERT INTO cot_reg_arreglo_ranurado_vert_empcaj
                        (id_odt, id_modelo, tiraje, costo_arreglo, costo_unit_ranura, costo_ranura, costo_tot_ranurado, fecha)
                VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $costo_arreglo, $costo_unit_ranura, $costo_por_ranura, $costo_tot_ranurado, '$d_fecha')";

                    $query_arreglo_ranurado_vert = $this->db->prepare($sql_ranurado_arreglo_ran_ver);

                    $l_arr_ran_vert_emp = $query_arreglo_ranurado_vert->execute();

                    if (!$l_arr_ran_vert_emp) {

                        self::mError($aJson, $mensaje, $error . "arreglo ranurado vertical empalme cajon;");

                        $l_arr_ran_vert_emp = false;
                    }
                }
            }


        // despunte de esquinas empalme cajon
            $l_despunte_esquinas = true;

            $costo_unit = round(floatval($aJson['despunte_esquinas_emptap']['costo_unitario_esquinas']), 2);
            $costo_tot_despunte = round(floatval($aJson['despunte_esquinas_emptap']['costo_tot_proceso']), 2);

            $sql_despunte_emp = "INSERT INTO cot_reg_despunte_esquinas_emptap(id_modelo, id_odt, tiraje, costo_unit, costo_tot_despunte, fecha)
            VALUES
                ($id_modelo, $id_caja_odt, $tiraje, $costo_unit, $costo_tot_despunte, '$d_fecha')";

            $query_despunte_emp = $this->db->prepare($sql_despunte_emp);

            $l_despunte_esquinas = $query_despunte_emp->execute();


            if (!$l_despunte_esquinas) {

                self::mError($aJson, $mensaje, $error . "despunte esquinas empalme tapa;");

                $l_despunte_esquinas = false;
            }

            // forro cajon
            $l_corte_fcaj = true;

            $corte_costo_unitario = round(floatval($aJson['costo_corte_papel_fcaj']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_corte_papel_fcaj']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_corte_papel_fcaj']['tot_pliegos']);
            $millares             = intval($aJson['costo_corte_papel_fcaj']['millares']);
            $costo_corte          = round(floatval($aJson['costo_corte_papel_fcaj']['tot_costo_corte']), 2);

            $sql_corte_fcaj = "INSERT INTO cot_reg_corte_fcaj
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_fcaj = $this->db->prepare($sql_corte_fcaj);

            $l_corte_fcaj = $query_corte_fcaj->execute();


            if (!$l_corte_fcaj) {

                self::mError($aJson, $mensaje, $error . "corte forro cajon;");

                $l_corte_fcaj = false;
            }


            // corte papel forro cajon
            $l_corte_papel_fcaj = true;

            $corte_costo_unitario = round(floatval($aJson['costo_corte_papel_fcaj']['costo_unitario_corte_papel']), 4);
            $cortes_pliego        = intval($aJson['costo_corte_papel_fcaj']['cortes_pliego']);
            $tot_pliegos          = intval($aJson['costo_corte_papel_fcaj']['tot_pliegos']);
            $millares             = intval($aJson['costo_corte_papel_fcaj']['millares']);
            $costo_corte          = round(floatval($aJson['costo_corte_papel_fcaj']['tot_costo_corte']), 2);

            $sql_corte_papel_fcaj = "INSERT INTO cot_reg_corte_papel_fcaj
                (id_odt, id_modelo, tiraje, corte_costo_unitario, cortes_pliego, tot_pliegos, millares, costo_corte, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $corte_costo_unitario, $cortes_pliego, $tot_pliegos, $millares, $costo_corte, '$d_fecha')";


            $query_corte_papel_fcaj = $this->db->prepare($sql_corte_papel_fcaj);

            $l_corte_papel_fcaj = $query_corte_papel_fcaj->execute();


            if (!$l_corte_papel_fcaj) {

                self::mError($aJson, $mensaje, $error . "corte papel forro cajon;");

                $l_corte_papel_fcaj = false;
            }


            // suaje forro cajon(fijo)
            $l_Suaje_fcaj_fijo = true;

            $tipoGrabado             = self::strip_slashes_recursive($aJson['suaje_fcaj_fijo']['tipoGrabado']);
            $Largo                   = round(floatval($aJson['suaje_fcaj_fijo']['Largo']), 2);
            $Ancho                   = round(floatval($aJson['suaje_fcaj_fijo']['Ancho']), 2);
            $perimetro               = round(floatval($aJson['suaje_fcaj_fijo']['perimetro']), 2);
            $costo_unit_tabla_suaje  = round(floatval($aJson['suaje_fcaj_fijo']['costo_unit_tabla_suaje']), 2);
            $tabla_suaje             = round(floatval($aJson['suaje_fcaj_fijo']['tabla_suaje']), 2);
            $arreglo                 = round(floatval($aJson['suaje_fcaj_fijo']['arreglo']), 2);
            $tiro_costo_unitario     = round(floatval($aJson['suaje_fcaj_fijo']['tiro_costo_unitario']), 2);
            $costo_tiro              = round(floatval($aJson['suaje_fcaj_fijo']['costo_tiro']), 2);
            $costo_tot_proceso       = round(floatval($aJson['suaje_fcaj_fijo']['costo_tot_proceso']), 2);
            $merma_min               = intval($aJson['suaje_fcaj_fijo']['mermas']['merma_min']);
            $merma_adic              = intval($aJson['suaje_fcaj_fijo']['mermas']['merma_adic']);
            $merma_tot               = intval($aJson['suaje_fcaj_fijo']['mermas']['merma_tot']);
            $cortes_por_pliego       = intval($aJson['suaje_fcaj_fijo']['mermas']['cortes_por_pliego']);
            $merma_tot_pliegos       = intval($aJson['suaje_fcaj_fijo']['mermas']['merma_tot_pliegos']);
            $costo_unit_merma        = round(floatval($aJson['suaje_fcaj_fijo']['mermas']['costo_unit_merma']), 2);
            $costo_tot_pliegos_merma = round(floatval($aJson['suaje_fcaj_fijo']['mermas']['costo_tot_pliegos_merma']), 2);

            $sql_suaje_fcaj_fijo = "INSERT INTO cot_reg_suajefcaj_fijo(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, perimetro, tabla_suaje, arreglo_costo_unitario, tiro_costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $perimetro, $tabla_suaje, $arreglo, $tiro_costo_unitario, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

            $query_suaje_fcaj_fijo = $this->db->prepare($sql_suaje_fcaj_fijo);

            $l_Suaje_fcaj_fijo = $query_suaje_fcaj_fijo->execute();


            if (!$l_Suaje_fcaj_fijo) {

                self::mError($aJson, $mensaje, $error . "suaje forro cajon;");

                $l_Suaje_fcaj_fijo = false;
            }


            // suaje forro tapasuaje_ftap_fijo(fijo)
            $l_Suaje_ftap_fijo = true;

            $tipoGrabado             = self::strip_slashes_recursive($aJson['suaje_ftap_fijo']['tipoGrabado']);
            $Largo                   = intval($aJson['suaje_ftap_fijo']['Largo']);
            $Ancho                   = intval($aJson['suaje_ftap_fijo']['Ancho']);
            $perimetro               = intval($aJson['suaje_ftap_fijo']['perimetro']);
            $tabla_suaje             = round(floatval($aJson['suaje_ftap_fijo']['tabla_suaje']), 2);
            $arreglo                 = round(floatval($aJson['suaje_ftap_fijo']['arreglo']), 2);
            $tiro_costo_unitario     = round(floatval($aJson['suaje_ftap_fijo']['tiro_costo_unitario']), 2);
            $costo_tiro              = round(floatval($aJson['suaje_ftap_fijo']['costo_tiro']), 2);
            $costo_tot_proceso       = round(floatval($aJson['suaje_ftap_fijo']['costo_tot_proceso']), 2);
            $merma_min               = intval($aJson['suaje_ftap_fijo']['mermas']['merma_min']);
            $merma_adic              = intval($aJson['suaje_ftap_fijo']['mermas']['merma_adic']);
            $merma_tot               = intval($aJson['suaje_ftap_fijo']['mermas']['merma_tot']);
            $cortes_por_pliego       = intval($aJson['suaje_ftap_fijo']['mermas']['cortes_por_pliego']);
            $merma_tot_pliegos       = intval($aJson['suaje_ftap_fijo']['mermas']['merma_tot_pliegos']);
            $costo_unit_merma        = round(floatval($aJson['suaje_ftap_fijo']['mermas']['costo_unit_merma']), 2);
            $costo_tot_pliegos_merma = round(floatval($aJson['suaje_ftap_fijo']['mermas']['costo_tot_pliegos_merma']), 2);

            $sql_suaje_ftap_fijo = "INSERT INTO cot_reg_suajeftap_fijo(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, perimetro, tabla_suaje, arreglo_costo_unitario, tiro_costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $perimetro, $tabla_suaje, $arreglo, $tiro_costo_unitario, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

            $query_suaje_ftap_fijo = $this->db->prepare($sql_suaje_ftap_fijo);

            $l_Suaje_ftap_fijo = $query_suaje_ftap_fijo->execute();


            if (!$l_Suaje_ftap_fijo) {

                self::mError($aJson, $mensaje, $error . "suaje forro tapa;");

                $l_Suaje_ftap_fijo = false;
            }


        // arreglo ranurado horizontal empalme tapa
            $l_arr_ran_hor_emptap = true;

            $arreglo                    = round(floatval($aJson['arreglo_ranurado_hor_emptap']['arreglo']), 2);
            $costo_unit_ranura          = round(floatval($aJson['arreglo_ranurado_hor_emptap']['costo_unit_por_ranura']), 2);
            $costo_ranurado             = round(floatval($aJson['arreglo_ranurado_hor_emptap']['costo_por_ranura']), 2);
            $costo_tot_arreglo_ranurado = round(floatval($aJson['arreglo_ranurado_hor_emptap']['costo_tot_proceso']), 2);

            $sql_ranurado_arreglo_ran_hor_emptap = "INSERT INTO cot_reg_arreglo_ranurado_hor_emptap
                (id_odt, id_modelo, tiraje, costo_unit_arreglo, costo_unit_ranura, costo_ranurado, costo_tot_arreglo_ranurado, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $arreglo, $costo_unit_ranura, $costo_ranurado, $costo_tot_arreglo_ranurado, '$d_fecha')";

            $query_arreglo_ranurado_hor_emptap = $this->db->prepare($sql_ranurado_arreglo_ran_hor_emptap);

            $l_arr_ran_hor_emptap = $query_arreglo_ranurado_hor_emptap->execute();


            if (!$l_arr_ran_hor_emptap) {

                self::mError($aJson, $mensaje, $error . "arreglo ranurado horizontal empalme tapa;");

                $l_arr_ran_hor_emptap = false;
            }


        // arreglo ranurado vertical empalme tapa
            $l_arr_ran_vert_emptap = true;

            if ( ($aJson['base'] > $aJson['alto'])  or ($aJson['base'] < $aJson['alto']) ) {

                $sql_ranurado_arreglo_ran_ver_emptap = "INSERT INTO cot_reg_arreglo_ranurado_vert_emptap
                    (id_odt, id_modelo, tiraje, costo_unit_arreglo, costo_unit_ranura, costo_ranurado, costo_tot_arreglo_ranurado, fecha)
            VALUES
                ($id_caja_odt, $id_modelo, $tiraje, $arreglo, $costo_unit_ranura, $costo_ranurado, $costo_tot_arreglo_ranurado, '$d_fecha')";

                $query_arreglo_ranurado_vert_emptap = $this->db->prepare($sql_ranurado_arreglo_ran_ver_emptap);

                $l_arr_ran_vert_emptap = $query_arreglo_ranurado_vert_emptap->execute();

                if (!$l_arr_ran_vert_emptap) {

                    self::mError($aJson, $mensaje, $error . "arreglo ranurado vertical empalme tapa;");

                    $l_arr_ran_vert_emptap = false;
                }
            }


        /********* termina costos fijos **********/


    /********* inicia impresion **********/


        /********* impresion empalme del cajon **********/

            $l_offset_empcaj     = true;
            $l_offset_maq_empcaj = true;
            $l_digital_empcaj    = true;
            $l_serigrafia_empcaj = true;

            if (array_key_exists("aImpEmp", $aJson)) {

                $aImpEmp = [];

                $aImpEmp = $aJson['aImpEmp'];


                if (array_key_exists("Offset", $aImpEmp)) {

                    $aOffset = [];

                    $aOffset = $aImpEmp['Offset'];

                    foreach($aOffset as $row) {

                        $costo_tot_proceso = 0;

                        $tipo_offset             = self::strip_slashes_recursive($row['tipo_offset']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $corte_costo_unitario    = round(floatval($row['corte_costo_unitario']), 2);
                        $corte_por_millar        = intval($row['corte_por_millar']);
                        $costo_corte             = round(floatval($row['costo_corte']), 2);
                        $costo_unitario_laminas  = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_tot_laminas       = round(floatval($row['costo_tot_laminas']), 2);
                        $costo_unitario_arreglo  = round(floatval($row['costo_unitario_arreglo']), 2);
                        $costo_tot_arreglo       = round(floatval($row['costo_tot_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_offset_empcaj = "INSERT INTO cot_reg_offsetempcaj(id_odt, id_modelo, tipo, tiraje, num_tintas, corte_costo_unitario, corte_por_millar, costo_corte, costo_unitario_laminas, costo_tot_laminas, costo_unitario_arreglo, costo_tot_arreglo, costo_unitario_tiro, costo_tot_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_offset', $tiraje, $num_tintas, $corte_costo_unitario, $corte_por_millar, $costo_corte, $costo_unitario_laminas, $costo_tot_laminas, $costo_unitario_arreglo, $costo_tot_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_offset_empcaj = $this->db->prepare($sql_offset_empcaj);

                        $l_offset_empcaj = $query_offset_empcaj->execute();


                        if (!$l_offset_empcaj) {

                            self::mError($aJson, $mensaje, $error . "offset empalme cajon;");

                            $l_offset_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Maquila", $aImpEmp)) {

                    $aOffset_maq = [];

                    $aOffset_maq = $aImpEmp['Maquila'];

                    foreach($aOffset_maq as $row) {

                        $costo_tot_proceso = 0;

                        $es_maquila             = self::strip_slashes_recursive($row['es_maquila']);
                        $Tipo                   = self::strip_slashes_recursive($row['Tipo']);
                        $tiraje                 = intval($row['cantidad']);
                        $num_tintas             = intval($row['num_tintas']);
                        $arreglo_costo_unitario = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo          = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_laminas = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_laminas          = round(floatval($row['costo_laminas']), 2);
                        $costo_unitario_maq     = round(floatval($row['costo_unitario_maq']), 2);
                        $costo_tot_maq          = round(floatval($row['costo_tot_maq']), 2);
                        $costo_tot_proceso      = round(floatval($row['costo_tot_proceso']), 2);

                        $sql_offset_maq_empcaj = "INSERT INTO cot_reg_offset_maq_empcaj(id_odt, id_modelo, tipo, tiraje, num_tintas, arreglo_costo_unitario, arreglo_costo, costo_unitario_laminas, costo_laminas, costo_unitario, costo_tot, costo_tot_proceso, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo', $tiraje, $num_tintas, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_laminas, $costo_laminas, $costo_unitario_maq, $costo_tot_maq, $costo_tot_proceso, '$d_fecha')";

                        $query_offset_maq_empcaj = $this->db->prepare($sql_offset_maq_empcaj);

                        $l_offset_maq_empcaj = $query_offset_maq_empcaj->execute();


                        if (!$l_offset_maq_empcaj) {

                            self::mError($aJson, $mensaje, $error . "maquila empalme cajon;");

                            $l_offset_maq_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Digital", $aImpEmp)) {

                    $aDigital = [];

                    $aDigital = $aImpEmp['Digital'];

                    foreach($aDigital as $row) {

                        $cabe_digital      = self::strip_slashes_recursive($row['cabe_digital']);
                        $tipo_impresion    = self::strip_slashes_recursive($row['tipo_impresion']);
                        $imp_ancho         = floatval($row['imp_ancho']);
                        $imp_largo         = floatval($row['imp_largo']);
                        $tiraje            = intval($row['tiraje']);
                        $corte_ancho       = round(floatval($row['corte_ancho']), 2);
                        $corte_largo       = round(floatval($row['corte_largo']), 2);
                        $costo_unitario    = round(floatval($row['costo_unitario']), 2);
                        $cortes_por_pliego = intval($row['cortes_por_pliego']);
                        $tot_pliegos       = intval($row['tot_pliegos']);
                        $costo_tot_proceso = round(floatval($row['costo_tot_proceso']), 2);

                        $merma_min         = intval($row['mermas']['merma_min']);
                        $merma_adic        = intval($row['mermas']['merma_adic']);
                        $merma_tot         = intval($row['mermas']['merma_tot']);
                        $costo_unitario    = round(floatval($row['mermas']['costo_unitario']), 2);
                        $costo_tot         = round(floatval($row['mermas']['costo_tot']), 2);

                        $sql_digital_empcaj = "INSERT INTO cot_reg_digempcaj(id_odt, id_modelo, tiraje, corte_ancho, corte_largo, imp_ancho, imp_largo, impresion, costo_unitario, cortes_por_pliego, tot_pliegos, costo_tot_proceso, merma_min, merma_adic, merma_tot, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, $corte_ancho, $corte_largo, $imp_ancho, $imp_largo, '$tipo_impresion', $costo_unitario, $cortes_por_pliego, $tot_pliegos,  $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $costo_unitario, $costo_tot, '$d_fecha')";

                        $query_digital_empcaj = $this->db->prepare($sql_digital_empcaj);

                        $l_digital_empcaj = $query_digital_empcaj->execute();

                        if (!$l_digital_empcaj) {

                            self::mError($aJson, $mensaje, $error . "digital empalme cajon;");

                            $l_digital_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Serigrafia", $aImpEmp)) {

                    $aSerigrafia = [];

                    $aSerigrafia = $aImpEmp['Serigrafia'];

                    foreach($aSerigrafia as $row) {

                        $tipo                    = self::strip_slashes_recursive($row['tipo']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $costo_unit_arreglo      = round(floatval($row['costo_unit_arreglo']), 2);
                        $costo_arreglo           = round(floatval($row['costo_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);


                        $sql_serigrafia_empcaj = "INSERT INTO cot_reg_serempcaj(id_odt, id_modelo, tipo, tiraje, num_tintas, cortes_por_pliego, costo_unit_arreglo, costo_arreglo, costo_unit_tiro, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo', $tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_arreglo, $costo_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_serigrafia_empcaj = $this->db->prepare($sql_serigrafia_empcaj);

                        $l_serigrafia_empcaj = $query_serigrafia_empcaj->execute();

                        if (!$l_serigrafia_empcaj) {

                            self::mError($aJson, $mensaje, $error . "serigrafia empalme cajon;");

                            $l_serigrafia_empcaj = false;

                            break;
                        }
                    }
                }
            }



        /********* termina impresion empalme del cajon **********/


        /********* inicia impresion forro del cajon **********/

            $l_offset_fcaj     = true;
            $l_offset_maq_fcaj = true;
            $l_digital_fcaj    = true;
            $l_serigrafia_fcaj = true;

            if (array_key_exists("aImpFCaj", $aJson)) {

                $aImpFCaj = [];

                $aImpFCaj = $aJson['aImpFCaj'];


                if (array_key_exists("Offset", $aImpFCaj)) {

                    $aOffset = [];

                    $aOffset = $aImpFCaj['Offset'];

                    foreach($aOffset as $row) {

                        $tipo_offset             = self::strip_slashes_recursive($row['tipo_offset']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $corte_costo_unitario    = round(floatval($row['corte_costo_unitario']), 2);
                        $corte_por_millar        = intval($row['corte_por_millar']);
                        $costo_corte             = round(floatval($row['costo_corte']), 2);
                        $costo_unitario_laminas  = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_tot_laminas       = round(floatval($row['costo_tot_laminas']), 2);
                        $costo_unitario_arreglo  = round(floatval($row['costo_unitario_arreglo']), 2);
                        $costo_tot_arreglo       = round(floatval($row['costo_tot_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_offset_fcaj = "INSERT INTO cot_reg_offsetfcaj(id_odt, id_modelo, tipo, tiraje, num_tintas, corte_costo_unitario, corte_por_millar, costo_corte, costo_unitario_laminas, costo_tot_laminas, costo_unitario_arreglo, costo_tot_arreglo, costo_unitario_tiro, costo_tot_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_offset', $tiraje, $num_tintas, $corte_costo_unitario, $corte_por_millar, $costo_corte, $costo_unitario_laminas, $costo_tot_laminas, $costo_unitario_arreglo, $costo_tot_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_offset_fcaj = $this->db->prepare($sql_offset_fcaj);

                        $l_offset_fcaj = $query_offset_fcaj->execute();

                        if (!$l_offset_fcaj) {

                            self::mError($aJson, $mensaje, $error . "offset forro cajon;");

                            $l_offset_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Maquila", $aImpFCaj)) {

                    $aOffset_maq = [];

                    $aOffset_maq = $aImpFCaj['Maquila'];

                    foreach($aOffset_maq as $row) {

                        $costo_tot_proceso = 0;

                        $es_maquila             = self::strip_slashes_recursive($row['es_maquila']);
                        $Tipo                   = self::strip_slashes_recursive($row['Tipo']);
                        $tiraje                 = intval($row['cantidad']);
                        $num_tintas             = intval($row['num_tintas']);
                        $arreglo_costo_unitario = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo          = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_laminas = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_laminas          = round(floatval($row['costo_laminas']), 2);
                        $costo_unitario_maq     = round(floatval($row['costo_unitario_maq']), 2);
                        $costo_tot_maq          = round(floatval($row['costo_tot_maq']), 2);
                        $costo_tot_proceso      = round(floatval($row['costo_tot_proceso']), 2);

                        if ( $costo_tot_proceso > 0 and $arreglo_costo_unitario > 0 and $arreglo_costo > 0 and $costo_unitario_laminas > 0 and $costo_laminas > 0 and $costo_unitario_maq > 0 and $costo_tot_maq > 0 ) {

                            $sql_offset_maq_fcaj = "INSERT INTO cot_reg_offset_maq_fcaj(id_odt, id_modelo, tipo, tiraje, num_tintas, arreglo_costo_unitario, arreglo_costo, costo_unitario_laminas, costo_laminas, costo_unitario, costo_tot, costo_tot_proceso, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo', $tiraje, $num_tintas, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_laminas, $costo_laminas, $costo_unitario_maq, $costo_tot_maq, $costo_tot_proceso, '$d_fecha')";

                            $query_offset_maq_fcaj = $this->db->prepare($sql_offset_maq_fcaj);

                            $l_offset_maq_fcaj = $query_offset_maq_fcaj->execute();

                            if(!$l_offset_maq_fcaj) {

                                self::mError($aJson, $mensaje, $error . "offset maquila forro cajon;");

                                $l_offset_maq_fcaj = false;

                                break;
                            }
                        } else {

                            self::mError($aJson, $mensaje, "No existe costo en Offset maquila forro del cajon;");

                            $l_offset_maq_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Digital", $aImpFCaj)) {

                    $aDigital = [];

                    $aDigital = $aImpFCaj['Digital'];

                    foreach($aDigital as $row) {

                        $cabe_digital      = self::strip_slashes_recursive($row['cabe_digital']);
                        $tipo_impresion    = self::strip_slashes_recursive($row['tipo_impresion']);
                        $imp_ancho         = floatval($row['imp_ancho']);
                        $imp_largo         = floatval($row['imp_largo']);
                        $tiraje            = intval($row['tiraje']);
                        $corte_ancho       = round(floatval($row['corte_ancho']), 2);
                        $corte_largo       = round(floatval($row['corte_largo']), 2);
                        $costo_unitario    = round(floatval($row['costo_unitario']), 2);
                        $costo_unitario    = round(floatval($row['costo_unitario']), 2);
                        $cortes_por_pliego = intval($row['cortes_por_pliego']);
                        $tot_pliegos       = intval($row['tot_pliegos']);
                        $costo_tot_proceso = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min         = intval($row['mermas']['merma_min']);
                        $merma_adic        = intval($row['mermas']['merma_adic']);
                        $merma_tot         = intval($row['mermas']['merma_tot']);
                        $costo_unitario    = round(floatval($row['mermas']['costo_unitario']), 2);
                        $costo_tot         = round(floatval($row['mermas']['costo_tot']), 2);

                        if ($cabe_digital == "NO") {

                            $l_digital_fcaj = false;

                            break;
                        }

                        $sql_digital_fcaj = "INSERT INTO cot_reg_digfcaj(id_odt, id_modelo, tiraje, corte_ancho, corte_largo, imp_ancho, imp_largo, impresion, costo_unitario, cortes_por_pliego, tot_pliegos, costo_tot_proceso, merma_min, merma_adic, merma_tot, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, $corte_ancho, $corte_largo, $imp_ancho, $imp_largo, '$tipo_impresion', $costo_unitario, $cortes_por_pliego, $tot_pliegos, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $costo_unitario, $costo_tot, '$d_fecha')";

                        $query_digital_fcaj = $this->db->prepare($sql_digital_fcaj);

                        $l_digital_fcaj = $query_digital_fcaj->execute();

                        if (!$l_digital_fcaj) {

                            self::mError($aJson, $mensaje, $error . "digital forro cajon;");

                            $l_digital_fcaj = false;

                            break;
                        }
                    }
                }



                if (array_key_exists("Serigrafia", $aImpFCaj)) {

                    $aSerigrafia = [];

                    $aSerigrafia = $aImpFCaj['Serigrafia'];

                    foreach($aSerigrafia as $row) {

                        $tipo                    = self::strip_slashes_recursive($row['tipo']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $costo_unit_arreglo      = round(floatval($row['costo_unit_arreglo']), 2);
                        $costo_arreglo           = round(floatval($row['costo_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_serigrafia_fcaj = "INSERT INTO cot_reg_serfcaj(id_odt, id_modelo, tipo, tiraje, num_tintas, cortes_por_pliego, costo_unit_arreglo, costo_arreglo, costo_unit_tiro, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo', $tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_arreglo, $costo_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_serigrafia_fcaj = $this->db->prepare($sql_serigrafia_fcaj);

                        $l_serigrafia_fcaj = $query_serigrafia_fcaj->execute();

                        if (!$l_serigrafia_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar offset serigrafia forro cajon;");

                            $l_serigrafia_fcaj = false;

                            break;
                        }
                    }
                }
            }


        /********* termina impresion forro del cajon **********/


        /********* inicia impresion empalme de la tapa **********/

            $l_offset_emptap     = true;
            $l_offset_maq_emptap = true;
            $l_digital_emptap    = true;
            $l_serigrafia_emptap = true;

            if (array_key_exists("aImpEmpTap", $aJson)) {

                $aImpEmpTap = [];

                $aImpEmpTap = $aJson['aImpEmpTap'];


                if (array_key_exists("Offset", $aImpEmpTap)) {

                    $aOffset = [];

                    $aOffset = $aImpEmpTap['Offset'];

                    foreach($aOffset as $row) {

                        $tipo_offset             = self::strip_slashes_recursive($row['tipo_offset']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $corte_costo_unitario    = round(floatval($row['corte_costo_unitario']), 2);
                        $corte_por_millar        = intval($row['corte_por_millar']);
                        $costo_corte             = round(floatval($row['costo_corte']), 2);
                        $costo_unitario_laminas  = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_tot_laminas       = round(floatval($row['costo_tot_laminas']), 2);
                        $costo_unitario_arreglo  = round(floatval($row['costo_unitario_arreglo']), 2);
                        $costo_tot_arreglo       = round(floatval($row['costo_tot_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);


                        $sql_offset_emptap = "INSERT INTO cot_reg_offsetemptap(id_odt, id_modelo, tipo, tiraje, num_tintas, corte_costo_unitario, corte_por_millar, costo_corte, costo_unitario_laminas, costo_tot_laminas, costo_unitario_arreglo, costo_tot_arreglo, costo_unitario_tiro, costo_tot_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_offset', $tiraje, $num_tintas, $corte_costo_unitario, $corte_por_millar, $costo_corte, $costo_unitario_laminas, $costo_tot_laminas, $costo_unitario_arreglo, $costo_tot_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_offset_emptap = $this->db->prepare($sql_offset_emptap);

                        $l_offset_emptap = $query_offset_emptap->execute();

                        if (!$l_offset_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar offset empalme tapa;");

                            $l_offset_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Maquila", $aImpEmpTap)) {

                    $aOffset_maq = [];

                    $aOffset_maq = $aImpEmpTap['Maquila'];

                    foreach($aOffset_maq as $row) {

                        $costo_tot_proceso = 0;

                        $es_maquila             = self::strip_slashes_recursive($row['es_maquila']);
                        $Tipo                   = self::strip_slashes_recursive($row['Tipo']);
                        $tiraje                 = intval($row['cantidad']);
                        $num_tintas             = intval($row['num_tintas']);
                        $arreglo_costo_unitario = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo          = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_laminas = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_laminas          = round(floatval($row['costo_laminas']), 2);
                        $costo_unitario_maq     = round(floatval($row['costo_unitario_maq']), 2);
                        $costo_tot_maq          = round(floatval($row['costo_tot_maq']), 2);
                        $costo_tot_proceso      = round(floatval($row['costo_tot_proceso']), 2);

                        $sql_offset_maq_emptap = "INSERT INTO cot_reg_offset_maq_emptap(id_odt, id_modelo, tipo, tiraje, num_tintas, arreglo_costo_unitario, arreglo_costo, costo_unitario_laminas, costo_laminas, costo_unitario, costo_tot, costo_tot_proceso, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo', $tiraje, $num_tintas, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_laminas, $costo_laminas, $costo_unitario_maq, $costo_tot_maq, $costo_tot_proceso, '$d_fecha')";

                        $query_offset_maq_emptap = $this->db->prepare($sql_offset_maq_emptap);

                        $l_offset_maq_emptap = $query_offset_maq_emptap->execute();

                        if(!$l_offset_maq_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar offset maquila empalme tapa;");

                            $l_offset_maq_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Digital", $aImpEmpTap)) {

                    $aDigital = [];

                    $aDigital = $aImpEmpTap['Digital'];

                    foreach($aDigital as $row) {

                        $cabe_digital      = self::strip_slashes_recursive($row['cabe_digital']);
                        $tipo_impresion    = self::strip_slashes_recursive($row['tipo_impresion']);
                        $imp_ancho         = floatval($row['imp_ancho']);
                        $imp_largo         = floatval($row['imp_largo']);
                        $tiraje            = intval($row['tiraje']);
                        $corte_ancho       = round(floatval($row['corte_ancho']), 2);
                        $corte_largo       = round(floatval($row['corte_largo']), 2);
                        $costo_unitario    = round(floatval($row['costo_unitario']), 2);
                        $cortes_por_pliego = intval($row['cortes_por_pliego']);
                        $tot_pliegos       = intval($row['tot_pliegos']);
                        $costo_tot_proceso = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min         = intval($row['mermas']['merma_min']);
                        $merma_adic        = intval($row['mermas']['merma_adic']);
                        $merma_tot         = intval($row['mermas']['merma_tot']);
                        $costo_unitario    = round(floatval($row['mermas']['costo_unitario']), 2);
                        $costo_tot         = round(floatval($row['mermas']['costo_tot']), 2);

                        $sql_digital_emptap = "INSERT INTO cot_reg_digemptap(id_odt, id_modelo, tiraje, corte_ancho, corte_largo, imp_ancho, imp_largo, impresion, costo_unitario, cortes_por_pliego, tot_pliegos, costo_tot_proceso, merma_min, merma_adic, merma_tot, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, $corte_ancho, $corte_largo, $imp_ancho, $imp_largo, '$tipo_impresion', $costo_unitario, $cortes_por_pliego, $tot_pliegos, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $costo_unitario, $costo_tot, '$d_fecha')";

                        $query_digital_emptap = $this->db->prepare($sql_digital_emptap);

                        $l_digital_emptap = $query_digital_emptap->execute();

                        if (!$l_digital_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar digital empalme tapa;");

                            $l_digital_emptap = false;

                            break;
                        }
                    }
                }




                if (array_key_exists("Serigrafia", $aImpEmpTap)) {

                    $aSerigrafia = [];

                    $aSerigrafia = $aImpEmpTap['Serigrafia'];

                    foreach($aSerigrafia as $row) {

                        $tipo                    = self::strip_slashes_recursive($row['tipo']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $costo_unit_arreglo      = round(floatval($row['costo_unit_arreglo']), 2);
                        $costo_arreglo           = round(floatval($row['costo_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_serigrafia_emptap = "INSERT INTO cot_reg_seremptap(id_odt, id_modelo, tipo, tiraje, num_tintas, cortes_por_pliego, costo_unit_arreglo, costo_arreglo, costo_unit_tiro, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo', $tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_arreglo, $costo_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_serigrafia_emptap = $this->db->prepare($sql_serigrafia_emptap);

                        $l_serigrafia_emptap = $query_serigrafia_emptap->execute();

                        if (!$l_serigrafia_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar serigrafia empalme tapa;");

                            $l_serigrafia_emptap = false;

                            break;
                        }
                    }
                }
            }


        /********* termina impresion empalme de la tapa **********/


        /********* inicia impresion forro de la tapa **********/

            $l_offset_ftap     = true;
            $l_offset_maq_ftap = true;
            $l_digital_ftap    = true;
            $l_serigrafia_ftap = true;

            if (array_key_exists("aImpFTap", $aJson)) {

                $aImpFTap = [];

                $aImpFTap = $aJson['aImpFTap'];


                if (array_key_exists("Offset", $aImpFTap)) {

                    $aOffset = [];

                    $aOffset = $aImpFTap['Offset'];

                    foreach($aOffset as $row) {

                        $tipo_offset             = self::strip_slashes_recursive($row['tipo_offset']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $corte_costo_unitario    = round(floatval($row['corte_costo_unitario']), 2);
                        $corte_por_millar        = intval($row['corte_por_millar']);
                        $costo_corte             = round(floatval($row['costo_corte']), 2);
                        $costo_unitario_laminas  = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_tot_laminas       = round(floatval($row['costo_tot_laminas']), 2);
                        $costo_unitario_arreglo  = round(floatval($row['costo_unitario_arreglo']), 2);
                        $costo_tot_arreglo       = round(floatval($row['costo_tot_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);


                        $sql_offset_ftap = "INSERT INTO cot_reg_offsetftap(id_odt, id_modelo, tipo, tiraje, num_tintas, corte_costo_unitario, corte_por_millar, costo_corte, costo_unitario_laminas, costo_tot_laminas, costo_unitario_arreglo, costo_tot_arreglo, costo_unitario_tiro, costo_tot_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_offset', $tiraje, $num_tintas, $corte_costo_unitario, $corte_por_millar, $costo_corte, $costo_unitario_laminas, $costo_tot_laminas, $costo_unitario_arreglo, $costo_tot_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_offset_ftap = $this->db->prepare($sql_offset_ftap);

                        $l_offset_ftap = $query_offset_ftap->execute();

                        if (!$l_offset_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar offset forro tapa;");

                            $l_offset_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Maquila", $aImpFTap)) {

                    $aOffset_maq = [];

                    $aOffset_maq = $aImpFTap['Maquila'];

                    foreach($aOffset_maq as $row) {

                        $costo_tot_proceso = 0;

                        $es_maquila             = self::strip_slashes_recursive($row['es_maquila']);
                        $Tipo                   = self::strip_slashes_recursive($row['Tipo']);
                        $tiraje                 = intval($row['cantidad']);
                        $num_tintas             = intval($row['num_tintas']);
                        $arreglo_costo_unitario = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo          = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_laminas = round(floatval($row['costo_unitario_laminas']), 2);
                        $costo_laminas          = round(floatval($row['costo_laminas']), 2);
                        $costo_unitario_maq     = round(floatval($row['costo_unitario_maq']), 2);
                        $costo_tot_maq          = round(floatval($row['costo_tot_maq']), 2);
                        $costo_tot_proceso      = round(floatval($row['costo_tot_proceso']), 2);

                        $sql_offset_maq_ftap = "INSERT INTO cot_reg_offset_maq_ftap(id_odt, id_modelo, tipo, tiraje, num_tintas, arreglo_costo_unitario, arreglo_costo, costo_unitario_laminas, costo_laminas, costo_unitario, costo_tot, costo_tot_proceso, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo', $tiraje, $num_tintas, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_laminas, $costo_laminas, $costo_unitario_maq, $costo_tot_maq, $costo_tot_proceso, '$d_fecha')";

                        $query_offset_maq_ftap = $this->db->prepare($sql_offset_maq_ftap);

                        $l_offset_maq_ftap = $query_offset_maq_ftap->execute();

                        if(!$l_offset_maq_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar offset maquila forro tapa;");

                            $l_offset_maq_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Digital", $aImpFTap)) {

                    $aDigital = [];

                    $aDigital = $aImpFTap['Digital'];

                    foreach($aDigital as $row) {

                        $cabe_digital      = self::strip_slashes_recursive($row['cabe_digital']);
                        $tipo_impresion    = self::strip_slashes_recursive($row['tipo_impresion']);
                        $imp_ancho         = floatval($row['imp_ancho']);
                        $imp_largo         = floatval($row['imp_largo']);
                        $tiraje            = intval($row['tiraje']);
                        $corte_ancho       = round(floatval($row['corte_ancho']), 2);
                        $corte_largo       = round(floatval($row['corte_largo']), 2);
                        $costo_unitario    = round(floatval($row['costo_unitario']), 2);
                        $cortes_por_pliego = intval($row['cortes_por_pliego']);
                        $tot_pliegos       = intval($row['tot_pliegos']);
                        $costo_tot_proceso = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min         = intval($row['mermas']['merma_min']);
                        $merma_adic        = intval($row['mermas']['merma_adic']);
                        $merma_tot         = intval($row['mermas']['merma_tot']);
                        $costo_unitario    = round(floatval($row['mermas']['costo_unitario']), 2);
                        $costo_tot         = round(floatval($row['mermas']['costo_tot']), 2);

                        $sql_digital_ftap = "INSERT INTO cot_reg_digftap(id_odt, id_modelo, tiraje, corte_ancho, corte_largo, imp_ancho, imp_largo, impresion, costo_unitario, cortes_por_pliego, tot_pliegos, costo_tot_proceso, merma_min, merma_adic, merma_tot, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, $corte_ancho, $corte_largo, $imp_ancho, $imp_largo, '$tipo_impresion', $costo_unitario, $cortes_por_pliego, $tot_pliegos, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $costo_unitario, $costo_tot, '$d_fecha')";

                        $sql_digital_ftap = $this->db->prepare($sql_digital_ftap);

                        $l_digital_ftap = $sql_digital_ftap->execute();

                        if (!$l_digital_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar digital forro tapa;");

                            $l_digital_ftap = false;

                            break;
                        }
                    }
                }



                if (array_key_exists("Serigrafia", $aImpFTap)) {

                    $aSerigrafia = [];

                    $aSerigrafia = $aImpFTap['Serigrafia'];

                    foreach($aSerigrafia as $row) {

                        $tipo                    = self::strip_slashes_recursive($row['tipo']);
                        $tiraje                  = intval($row['cantidad']);
                        $num_tintas              = intval($row['num_tintas']);
                        $costo_unit_arreglo      = round(floatval($row['costo_unit_arreglo']), 2);
                        $costo_arreglo           = round(floatval($row['costo_arreglo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario_tiro']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_papel_merma  = round(floatval($row['mermas']['costo_unit_papel_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_serigrafia_ftap = "INSERT INTO cot_reg_serftap(id_odt, id_modelo, tipo, tiraje, num_tintas, cortes_por_pliego, costo_unit_arreglo, costo_arreglo, costo_unit_tiro, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, merma_tot_pliegos, costo_unit_papel_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo', $tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_arreglo, $costo_arreglo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $merma_tot_pliegos, $costo_unit_papel_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_serigrafia_ftap = $this->db->prepare($sql_serigrafia_ftap);

                        $l_serigrafia_ftap = $query_serigrafia_ftap->execute();

                        if (!$l_serigrafia_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar serigrafia forro tapa;");

                            $l_serigrafia_ftap = false;

                            break;
                        }
                    }
                }
            }


        /********* termina impresion forro de la tapa **********/


   /********** termina impresion ********************/


   /******************** inicia acabados  ************************/


        /********* inicia acabados empalme del cajon ***************/

            $l_Barniz_UV_empcaj   = true;
            $l_Corte_Laser_empcaj = true;
            $l_Grabado_empcaj     = true;
            $l_HotStamping_empcaj = true;
            $l_Laminado_empcaj    = true;
            $l_Suaje_empcaj       = true;

            if (array_key_exists("aAcbEmp", $aJson)) {

                $aAcbEmp = [];

                $aAcbEmp = $aJson['aAcbEmp'];


                if (array_key_exists("Barniz_UV", $aAcbEmp)) {

                    $aBarniz_UV = [];

                    $aBarniz_UV = $aAcbEmp['Barniz_UV'];

                    foreach($aBarniz_UV as $row) {

                        $costo_tot_proceso = 0;

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $area                    = round(floatval($row['area']), 2);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_barnizuv_empcaj = "INSERT INTO cot_reg_barnizuvempcaj(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $area, $costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma,'$d_fecha')";

                        $query_barnizuv_empcaj = $this->db->prepare($sql_barnizuv_empcaj);

                        $l_Barniz_UV_empcaj = $query_barnizuv_empcaj->execute();

                        if (!$l_Barniz_UV_empcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar barniz empalme cajon;");

                            $l_Barniz_UV_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Corte_Laser", $aAcbEmp)) {

                    $aCorte_Laser = [];

                    $aCorte_Laser = $aAcbEmp['Corte_Laser'];

                    foreach($aCorte_Laser as $row) {

                        $tipo_grabado            = self::strip_slashes_recursive($row['tipo_grabado']);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $tiempo_requerido        = round(floatval($row['tiempo_requerido']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['merma_min']);
                        $merma_tot               = intval($row['merma_tot']);

                        $sql_laser_empcaj = "INSERT INTO cot_reg_laserempcaj(id_odt, id_modelo, tipo_grabado, tiraje, costo_unitario, tiempo_requerido, costo_tot_proceso, merma_min, merma_tot, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_grabado', $tiraje, $costo_unitario, $tiempo_requerido, $costo_tot_proceso, $merma_min, $merma_tot, '$d_fecha')";

                        $query_laser_empcaj = $this->db->prepare($sql_laser_empcaj);

                        $l_Corte_Laser_empcaj = $query_laser_empcaj->execute();

                        if (!$l_Corte_Laser_empcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar laser empalme cajon;");

                            $l_Corte_Laser_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Grabado", $aAcbEmp)) {

                    $aGrabado = [];

                    $aGrabado = $aAcbEmp['Grabado'];

                    foreach($aGrabado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $ubicacion               = self::strip_slashes_recursive($row['ubicacion']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = round(floatval($row['mermas']['merma_tot_pliegos']), 2);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_grab_empcaj = "INSERT INTO cot_reg_grabempcaj(id_odt, id_modelo, tipo_grabado, largo, tiraje, ancho, ubicacion, placa_area, placa_costo_unitario, placa_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $Largo, $tiraje, $Ancho, '$ubicacion', $placa_area, $placa_costo_unitario, $placa_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_grab_empcaj = $this->db->prepare($sql_grab_empcaj);

                        $l_Grabado_empcaj = $query_grab_empcaj->execute();

                        if (!$l_Grabado_empcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar grabado empalme cajon;");

                            $l_Grabado_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("HotStamping", $aAcbEmp)) {

                    $aHotStamping = [];

                    $aHotStamping = $aAcbEmp['HotStamping'];

                    foreach($aHotStamping as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $Color                   = self::strip_slashes_recursive($row['Color']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $pelicula_Largo          = round(floatval($row['pelicula_Largo']), 2);
                        $pelicula_Ancho          = round(floatval($row['pelicula_Ancho']), 2);
                        $pelicula_area           = round(floatval($row['pelicula_area']), 2);
                        $pelicula_costo_unitario = round(floatval($row['pelicula_costo_unitario']), 4);
                        $pelicula_costo          = round(floatval($row['pelicula_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_hs_empcaj = "INSERT INTO cot_reg_hsempcaj(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, color, placa_area, placa_costo_unitario, placa_costo, pelicula_largo, pelicula_ancho, pelicula_area, pelicula_costo_unitario, pelicula_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$Color', $placa_area, $placa_costo_unitario, $placa_costo, $pelicula_Largo, $pelicula_Ancho, $pelicula_area, $pelicula_costo_unitario, $pelicula_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_hs_empcaj = $this->db->prepare($sql_hs_empcaj);

                        $l_HotStamping_empcaj = $query_hs_empcaj->execute();

                        if (!$l_HotStamping_empcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar Hotstamping empalme cajon;");

                            $l_HotStamping_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Laminado", $aAcbEmp)) {

                    $aLaminado = [];

                    $aLaminado = $aAcbEmp['Laminado'];

                    foreach($aLaminado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = intval($row['Largo']);
                        $Ancho                   = intval($row['Ancho']);
                        $area                    = round(floatval($row['area']), 2);
                        $laminado_costo_unitario = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_laminado_empcaj = "INSERT INTO cot_reg_lamempcaj(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, $area, $laminado_costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_laminado_empcaj = $this->db->prepare($sql_laminado_empcaj);

                        $l_Laminado_empcaj = $query_laminado_empcaj->execute();

                        if (!$l_Laminado_empcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar laminado empalme cajon;");

                            $l_Laminado_empcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Suaje", $aAcbEmp)) {

                    $aSuaje = [];

                    $aSuaje = $aAcbEmp['Suaje'];

                    foreach($aSuaje as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $perimetro               = round(floatval($row['perimetro']), 2);
                        $costo_unit_tabla_suaje  = round(floatval($row['costo_unit_tabla_suaje']), 2);
                        $tabla_suaje             = round(floatval($row['tabla_suaje']), 2);
                        $arreglo                 = round(floatval($row['arreglo']), 2);
                        $tiro_costo_unitario     = round(floatval($row['tiro_costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_suaje_empcaj = "INSERT INTO cot_reg_suajeempcaj(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, perimetro, costo_unit_tabla_suaje, tabla_suaje, arreglo_costo_unitario, tiro_costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $perimetro, $costo_unit_tabla_suaje, $tabla_suaje, $arreglo, $tiro_costo_unitario, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_suaje_empcaj = $this->db->prepare($sql_suaje_empcaj);

                        $l_Suaje_empcaj = $query_suaje_empcaj->execute();

                        if (!$l_Suaje_empcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar suaje empalme cajon;");

                            $l_Suaje_empcaj = false;

                            break;
                        }
                    }
                }
            }


        /********* termina acabados empalme del cajon ***************/


        /********* inicia acabados forro del cajon ***************/

            $l_Barniz_UV_fcaj   = true;
            $l_Corte_Laser_fcaj = true;
            $l_Grabado_fcaj     = true;
            $l_HotStamping_fcaj = true;
            $l_Laminado_fcaj    = true;
            $l_Suaje_fcaj       = true;

            if (array_key_exists("aAcbFCaj", $aJson)) {

                $aAcbFCaj = [];

                $aAcbFCaj = $aJson['aAcbFCaj'];


                if (array_key_exists("Barniz_UV", $aAcbFCaj)) {

                    $aBarniz_UV = [];

                    $aBarniz_UV = $aAcbFCaj['Barniz_UV'];

                    foreach($aBarniz_UV as $row) {

                        $costo_tot_proceso = 0;

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $area                    = round(floatval($row['area']), 2);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_barnizuv_fcaj = "INSERT INTO cot_reg_barnizuvfcaj(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $area, $costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma,'$d_fecha')";

                        $query_barnizuv_fcaj = $this->db->prepare($sql_barnizuv_fcaj);

                        $l_Barniz_UV_fcaj = $query_barnizuv_fcaj->execute();

                        if (!$l_Barniz_UV_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar barniz forro cajon;");

                            $l_Barniz_UV_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Corte_Laser", $aAcbFCaj)) {

                    $aCorte_Laser = [];

                    $aCorte_Laser = $aAcbFCaj['Corte_Laser'];

                    foreach($aCorte_Laser as $row) {

                        $tipo_grabado            = self::strip_slashes_recursive($row['tipo_grabado']);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $tiempo_requerido        = round(floatval($row['tiempo_requerido']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['merma_min']);
                        $merma_tot               = intval($row['merma_tot']);

                        $sql_laser_fcaj = "INSERT INTO cot_reg_laserfcaj(id_odt, id_modelo, tipo_grabado, tiraje, costo_unitario, tiempo_requerido, costo_tot_proceso, merma_min, merma_tot, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_grabado', $tiraje, $costo_unitario, $tiempo_requerido, $costo_tot_proceso, $merma_min, $merma_tot, '$d_fecha')";

                        $query_laser_fcaj = $this->db->prepare($sql_laser_fcaj);

                        $l_Corte_Laser_fcaj = $query_laser_fcaj->execute();

                        if (!$l_Corte_Laser_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar laser forro cajon;");

                            $l_Corte_Laser_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Grabado", $aAcbFCaj)) {

                    $aGrabado = [];

                    $aGrabado = $aAcbFCaj['Grabado'];

                    foreach($aGrabado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $ubicacion               = self::strip_slashes_recursive($row['ubicacion']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_grab_fcaj = "INSERT INTO cot_reg_grabfcaj(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, ubicacion, placa_area, placa_costo_unitario, placa_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$ubicacion', $placa_area, $placa_costo_unitario, $placa_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_grab_fcaj = $this->db->prepare($sql_grab_fcaj);

                        $l_Grabado_fcaj = $query_grab_fcaj->execute();

                        if (!$l_Grabado_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar grabado forro cajon;");

                            $l_Grabado_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("HotStamping", $aAcbFCaj)) {

                    $aHotStamping = [];

                    $aHotStamping = $aAcbFCaj['HotStamping'];

                    foreach($aHotStamping as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $Color                   = self::strip_slashes_recursive($row['Color']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $pelicula_Largo          = intval($row['pelicula_Largo']);
                        $pelicula_Ancho          = intval($row['pelicula_Ancho']);
                        $pelicula_area           = round(floatval($row['pelicula_area']), 2);
                        $pelicula_costo_unitario = round(floatval($row['pelicula_costo_unitario']), 4);
                        $pelicula_costo          = round(floatval($row['pelicula_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_hs_fcaj = "INSERT INTO cot_reg_hsfcaj(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, color, placa_area, placa_costo_unitario, placa_costo, pelicula_largo, pelicula_ancho, pelicula_area, pelicula_costo_unitario, pelicula_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$Color', $placa_area, $placa_costo_unitario, $placa_costo, $pelicula_Largo, $pelicula_Ancho, $pelicula_area, $pelicula_costo_unitario, $pelicula_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_hs_fcaj = $this->db->prepare($sql_hs_fcaj);

                        $l_HotStamping_fcaj = $query_hs_fcaj->execute();

                        if (!$l_HotStamping_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar Hotstamping forro cajon;");

                            $l_HotStamping_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Laminado", $aAcbFCaj)) {

                    $aLaminado = [];

                    $aLaminado = $aAcbFCaj['Laminado'];

                    foreach($aLaminado as $row) {

                        $tipo_grabado            = self::strip_slashes_recursive($row['tipoGrabado']);
                        $largo                   = intval($row['Largo']);
                        $ancho                   = intval($row['Ancho']);
                        $area                    = round(floatval($row['area']), 2);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_laminado_fcaj = "INSERT INTO cot_reg_lamfcaj(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_grabado', $tiraje, $largo, $ancho, $area, $costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_laminado_fcaj = $this->db->prepare($sql_laminado_fcaj);

                        $l_Laminado_fcaj = $query_laminado_fcaj->execute();

                        if (!$l_Laminado_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar laminado forro cajon;");

                            $l_Laminado_fcaj = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Suaje", $aAcbFCaj)) {

                    $aSuaje = [];

                    $aSuaje = $aAcbFCaj['Suaje'];

                    foreach($aSuaje as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $perimetro               = round(floatval($row['perimetro']), 2);
                        $costo_unit_tabla_suaje  = round(floatval($row['costo_unit_tabla_suaje']), 2);
                        $tabla_suaje             = round(floatval($row['tabla_suaje']), 2);
                        $arreglo                 = round(floatval($row['arreglo']), 2);
                        $tiro_costo_unitario     = round(floatval($row['tiro_costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_suaje_fcaj = "INSERT INTO cot_reg_suajefcaj(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, perimetro, costo_unit_tabla_suaje, tabla_suaje, arreglo_costo_unitario, tiro_costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $perimetro, $costo_unit_tabla_suaje, $tabla_suaje, $arreglo, $tiro_costo_unitario, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_suaje_fcaj = $this->db->prepare($sql_suaje_fcaj);

                        $l_Suaje_fcaj = $query_suaje_fcaj->execute();

                        if (!$l_Suaje_fcaj) {

                            self::mError($aJson, $mensaje, "Error al grabar suaje forro cajon;");

                            $l_Suaje_fcaj = false;

                            break;
                        }
                    }
                }
            }


        /********* termina acabados forro del cajon ***************/


        /********* inicia acabados empalme de la tapa ***************/


            $l_Barniz_UV_emptap   = true;
            $l_Corte_Laser_emptap = true;
            $l_Grabado_emptap     = true;
            $l_HotStamping_emptap = true;
            $l_Laminado_emptap    = true;
            $l_Suaje_emptap       = true;

            if (array_key_exists("aAcbEmpTap", $aJson)) {

                $aAcbEmpTap = [];

                $aAcbEmpTap = $aJson['aAcbEmpTap'];


                if (array_key_exists("Barniz_UV", $aAcbEmpTap)) {

                    $aBarniz_UV = [];

                    $aBarniz_UV = $aAcbEmpTap['Barniz_UV'];

                    foreach($aBarniz_UV as $row) {

                        $costo_tot_proceso = 0;

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $area                    = round(floatval($row['area']), 2);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_barnizuv_emptap = "INSERT INTO cot_reg_barnizuvemptap(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $area, $costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma,'$d_fecha')";

                        $query_barnizuv_emptap = $this->db->prepare($sql_barnizuv_emptap);

                        $l_Barniz_UV_emptap = $query_barnizuv_emptap->execute();

                        if (!$l_Barniz_UV_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar barniz empalme tapa;");

                            $l_Barniz_UV_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Corte_Laser", $aAcbEmpTap)) {

                    $aCorte_Laser = [];

                    $aCorte_Laser = $aAcbEmpTap['Corte_Laser'];

                    foreach($aCorte_Laser as $row) {

                        $tipo_grabado            = self::strip_slashes_recursive($row['tipo_grabado']);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $tiempo_requerido        = round(floatval($row['tiempo_requerido']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['merma_min']);
                        $merma_tot               = intval($row['merma_tot']);

                        $sql_laser_emptap = "INSERT INTO cot_reg_laseremptap(id_odt, id_modelo, tipo_grabado, tiraje, costo_unitario, tiempo_requerido, costo_tot_proceso, merma_min, merma_tot, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_grabado', $tiraje, $costo_unitario, $tiempo_requerido, $costo_tot_proceso, $merma_min, $merma_tot, '$d_fecha')";

                        $query_laser_emptap = $this->db->prepare($sql_laser_emptap);

                        $l_Corte_Laser_emptap = $query_laser_emptap->execute();

                        if (!$l_Corte_Laser_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar laser empalme tapa;");

                            $l_Corte_Laser_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Grabado", $aAcbEmpTap)) {

                    $aGrabado = [];

                    $aGrabado = $aAcbEmpTap['Grabado'];

                    foreach($aGrabado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $ubicacion               = self::strip_slashes_recursive($row['ubicacion']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_grab_emptap = "INSERT INTO cot_reg_grabemptap(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, ubicacion, placa_area, placa_costo_unitario, placa_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$ubicacion', $placa_area, $placa_costo_unitario, $placa_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_grab_emptap = $this->db->prepare($sql_grab_emptap);

                        $l_Grabado_emptap = $query_grab_emptap->execute();

                        if (!$l_Grabado_emptap) {

                            self::mError($aJson, $mensaje, "Error al grabar grabado empalme tapa;");

                            $l_Grabado_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("HotStamping", $aAcbEmpTap)) {

                    $aHotStamping = [];

                    $aHotStamping = $aAcbEmpTap['HotStamping'];

                    foreach($aHotStamping as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $Color                   = self::strip_slashes_recursive($row['Color']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $pelicula_Largo          = intval($row['pelicula_Largo']);
                        $pelicula_Ancho          = intval($row['pelicula_Ancho']);
                        $pelicula_area           = round(floatval($row['pelicula_area']), 2);
                        $pelicula_costo_unitario = round(floatval($row['pelicula_costo_unitario']), 4);
                        $pelicula_costo          = round(floatval($row['pelicula_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_hs_emptap = "INSERT INTO cot_reg_hsemptap(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, color, placa_area, placa_costo_unitario, placa_costo, pelicula_largo, pelicula_ancho, pelicula_area, pelicula_costo_unitario, pelicula_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$Color', $placa_area, $placa_costo_unitario, $placa_costo, $pelicula_Largo, $pelicula_Ancho, $pelicula_area, $pelicula_costo_unitario, $pelicula_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_hs_emtap = $this->db->prepare($sql_hs_emptap);

                        $l_HotStamping_emptap = $query_hs_emtap->execute();

                        if (!$l_HotStamping_emptap) {

                             self::mError($aJson, $mensaje, "Error al grabar Hotstamping empalme tapa;");

                            $l_HotStamping_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Laminado", $aAcbEmpTap)) {

                    $aLaminado = [];

                    $aLaminado = $aAcbEmpTap['Laminado'];

                    foreach($aLaminado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = intval($row['Largo']);
                        $Ancho                   = intval($row['Ancho']);
                        $area                    = round(floatval($row['area']), 2);
                        $laminado_costo_unitario = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_laminado_emtap = "INSERT INTO cot_reg_lamemptap(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, $area, $laminado_costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_laminado_emptap = $this->db->prepare($sql_laminado_emtap);

                        $l_Laminado_emptap = $query_laminado_emptap->execute();

                        if (!$l_Laminado_emptap) {

                             self::mError($aJson, $mensaje, "Error al grabar laminado empalme tapa;");

                            $l_Laminado_emptap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Suaje", $aAcbEmpTap)) {

                    $aSuaje = [];

                    $aSuaje = $aAcbEmpTap['Suaje'];

                    foreach($aSuaje as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $perimetro               = round(floatval($row['perimetro']), 2);
                        $costo_unit_tabla_suaje  = round(floatval($row['costo_unit_tabla_suaje']), 2);
                        $tabla_suaje             = round(floatval($row['tabla_suaje']), 2);
                        $arreglo                 = round(floatval($row['arreglo']), 2);
                        $tiro_costo_unitario     = round(floatval($row['tiro_costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_suaje_emptap = "INSERT INTO cot_reg_suajeemptap(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, perimetro, costo_unit_tabla_suaje, tabla_suaje, arreglo_costo_unitario, tiro_costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $perimetro, $costo_unit_tabla_suaje, $tabla_suaje, $arreglo, $tiro_costo_unitario, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_suaje_emptap = $this->db->prepare($sql_suaje_emptap);

                        $l_Suaje_emptap = $query_suaje_emptap->execute();

                        if (!$l_Suaje_emptap) {

                             self::mError($aJson, $mensaje, "Error al grabar suaje empalme tapa;");

                            $l_Suaje_emptap = false;

                            break;
                        }
                    }
                }
            }

        /********* termina acabados empalme de la tapa ***************/


        /********* inicia acabados forro de la tapa ***************/


            $l_Barniz_UV_ftap   = true;
            $l_Corte_Laser_ftap = true;
            $l_Grabado_ftap     = true;
            $l_HotStamping_ftap = true;
            $l_Laminado_ftap    = true;
            $l_Suaje_ftap       = true;

            if (array_key_exists("aAcbFTap", $aJson)) {

                $aAcbFTap = [];

                $aAcbFTap = $aJson['aAcbFTap'];


                if (array_key_exists("Barniz_UV", $aAcbFTap)) {

                    $aBarniz_UV = [];

                    $aBarniz_UV = $aAcbFTap['Barniz_UV'];

                    foreach($aBarniz_UV as $row) {

                        $costo_tot_proceso = 0;

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $area                    = round(floatval($row['area']), 2);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_barnizuv_ftap = "INSERT INTO cot_reg_barnizuvftap(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $area, $costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma,'$d_fecha')";

                        $query_barnizuv_ftap = $this->db->prepare($sql_barnizuv_ftap);

                        $l_Barniz_UV_ftap = $query_barnizuv_ftap->execute();

                        if (!$l_Barniz_UV_ftap) {

                             self::mError($aJson, $mensaje, "Error al grabar barniz forro tapa;");

                            $l_Barniz_UV_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Corte_Laser", $aAcbFTap)) {

                    $aCorte_Laser = [];

                    $aCorte_Laser = $aAcbFTap['Corte_Laser'];

                    foreach($aCorte_Laser as $row) {

                        $tipo_grabado            = self::strip_slashes_recursive($row['tipo_grabado']);
                        $costo_unitario          = round(floatval($row['costo_unitario']), 2);
                        $tiempo_requerido        = round(floatval($row['tiempo_requerido']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['merma_min']);
                        $merma_tot               = intval($row['merma_tot']);

                        $sql_laser_ftap = "INSERT INTO cot_reg_laserftap(id_odt, id_modelo, tipo_grabado, tiraje, costo_unitario, tiempo_requerido, costo_tot_proceso, merma_min, merma_tot, fecha) VALUES($id_caja_odt, $id_modelo, '$tipo_grabado', $tiraje, $costo_unitario, $tiempo_requerido, $costo_tot_proceso, $merma_min, $merma_tot, '$d_fecha')";

                        $query_laser_ftap = $this->db->prepare($sql_laser_ftap);

                        $l_Corte_Laser_ftap = $query_laser_ftap->execute();

                        if (!$l_Corte_Laser_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar laser forro tapa;");

                            $l_Corte_Laser_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Grabado", $aAcbFTap)) {

                    $aGrabado = [];

                    $aGrabado = $aAcbFTap['Grabado'];

                    foreach($aGrabado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $ubicacion               = self::strip_slashes_recursive($row['ubicacion']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_grab_ftap = "INSERT INTO cot_reg_grabftap(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, ubicacion, placa_area, placa_costo_unitario, placa_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$ubicacion', $placa_area, $placa_costo_unitario, $placa_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_grab_ftap = $this->db->prepare($sql_grab_ftap);

                        $l_Grabado_ftap = $query_grab_ftap->execute();

                        if (!$l_Grabado_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar grabado forro tapa;");

                            $l_Grabado_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("HotStamping", $aAcbFTap)) {

                    $aHotStamping = [];

                    $aHotStamping = $aAcbFTap['HotStamping'];

                    foreach($aHotStamping as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $Color                   = self::strip_slashes_recursive($row['Color']);
                        $placa_area              = round(floatval($row['placa_area']), 2);
                        $placa_costo_unitario    = round(floatval($row['placa_costo_unitario']), 2);
                        $placa_costo             = round(floatval($row['placa_costo']), 2);
                        $pelicula_Largo          = intval($row['pelicula_Largo']);
                        $pelicula_Ancho          = intval($row['pelicula_Ancho']);
                        $pelicula_area           = round(floatval($row['pelicula_area']), 2);
                        $pelicula_costo_unitario = round(floatval($row['pelicula_costo_unitario']), 4);
                        $pelicula_costo          = round(floatval($row['pelicula_costo']), 2);
                        $arreglo_costo_unitario  = round(floatval($row['arreglo_costo_unitario']), 2);
                        $arreglo_costo           = round(floatval($row['arreglo_costo']), 2);
                        $costo_unitario_tiro     = round(floatval($row['costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_hs_ftap = "INSERT INTO cot_reg_hsftap(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, color, placa_area, placa_costo_unitario, placa_costo, pelicula_largo, pelicula_ancho, pelicula_area, pelicula_costo_unitario, pelicula_costo, arreglo_costo_unitario, arreglo_costo, costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, '$Color', $placa_area, $placa_costo_unitario, $placa_costo, $pelicula_Largo, $pelicula_Ancho, $pelicula_area, $pelicula_costo_unitario, $pelicula_costo, $arreglo_costo_unitario, $arreglo_costo, $costo_unitario_tiro, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_hs_ftap = $this->db->prepare($sql_hs_ftap);

                        $l_HotStamping_ftap = $query_hs_ftap->execute();

                        if (!$l_HotStamping_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar Hotstamping forro tapa;");

                            $l_HotStamping_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Laminado", $aAcbFTap)) {

                    $aLaminado = [];

                    $aLaminado = $aAcbFTap['Laminado'];

                    foreach($aLaminado as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = intval($row['Largo']);
                        $Ancho                   = intval($row['Ancho']);
                        $area                    = round(floatval($row['area']), 2);
                        $laminado_costo_unitario = round(floatval($row['costo_unitario']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_laminado_ftap = "INSERT INTO cot_reg_lamftap(id_odt, id_modelo, tipo_grabado, tiraje, largo, ancho, area, costo_unitario, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, '$tipoGrabado', $tiraje, $Largo, $Ancho, $area, $laminado_costo_unitario, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_laminado_ftap = $this->db->prepare($sql_laminado_ftap);

                        $l_Laminado_ftap = $query_laminado_ftap->execute();

                        if (!$l_Laminado_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar laminado forro tapa;");

                            $l_Laminado_ftap = false;

                            break;
                        }
                    }
                }


                if (array_key_exists("Suaje", $aAcbFTap)) {

                    $aSuaje = [];

                    $aSuaje = $aAcbFTap['Suaje'];

                    foreach($aSuaje as $row) {

                        $tipoGrabado             = self::strip_slashes_recursive($row['tipoGrabado']);
                        $Largo                   = round(floatval($row['Largo']), 2);
                        $Ancho                   = round(floatval($row['Ancho']), 2);
                        $perimetro               = round(floatval($row['perimetro']), 2);
                        $costo_unit_tabla_suaje  = round(floatval($row['costo_unit_tabla_suaje']), 2);
                        $tabla_suaje             = round(floatval($row['tabla_suaje']), 2);
                        $arreglo                 = round(floatval($row['arreglo']), 2);
                        $tiro_costo_unitario     = round(floatval($row['tiro_costo_unitario']), 2);
                        $costo_tiro              = round(floatval($row['costo_tiro']), 2);
                        $costo_tot_proceso       = round(floatval($row['costo_tot_proceso']), 2);
                        $merma_min               = intval($row['mermas']['merma_min']);
                        $merma_adic              = intval($row['mermas']['merma_adic']);
                        $merma_tot               = intval($row['mermas']['merma_tot']);
                        $cortes_por_pliego       = intval($row['mermas']['cortes_por_pliego']);
                        $merma_tot_pliegos       = intval($row['mermas']['merma_tot_pliegos']);
                        $costo_unit_merma        = round(floatval($row['mermas']['costo_unit_merma']), 2);
                        $costo_tot_pliegos_merma = round(floatval($row['mermas']['costo_tot_pliegos_merma']), 2);

                        $sql_suaje_ftap = "INSERT INTO cot_reg_suajeftap(id_odt, id_modelo, tiraje, tipo_grabado, largo, ancho, perimetro, costo_unit_tabla_suaje, tabla_suaje, arreglo_costo_unitario, tiro_costo_unitario, costo_tiro, costo_tot_proceso, merma_min, merma_adic, merma_tot, cortes_por_pliego, merma_tot_pliegos, costo_unit_merma, costo_tot_pliegos_merma, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$tipoGrabado', $Largo, $Ancho, $perimetro, $costo_unit_tabla_suaje, $tabla_suaje, $arreglo, $tiro_costo_unitario, $costo_tiro, $costo_tot_proceso, $merma_min, $merma_adic, $merma_tot, $cortes_por_pliego, $merma_tot_pliegos, $costo_unit_merma, $costo_tot_pliegos_merma, '$d_fecha')";

                        $query_suaje_ftap = $this->db->prepare($sql_suaje_ftap);

                        $l_Suaje_ftap = $query_suaje_ftap->execute();

                        if (!$l_Suaje_ftap) {

                            self::mError($aJson, $mensaje, "Error al grabar suaje forro tapa;");

                            $l_Suaje_ftap = false;

                            break;
                        }
                    }
                }
            }


        /********* termina acabados forro de la tapa ***************/


   /******************** termina acabados  ************************/


   /******************** inicia accesorios  ************************/

            $l_Accesorios = true;

            if (array_key_exists("Accesorios", $aJson)) {

                $aAccesorios = [];

                $aAccesorios = $aJson['Accesorios'];

                foreach($aAccesorios as $row) {

                    $costo_tot_proceso = 0;

                    $Tipo_accesorio = self::strip_slashes_recursive($row['Tipo_accesorio']);
                    $tiraje = intval($row['tiraje']);

                    $costo_unit_accesorio = round(floatval($row['costo_unit_accesorio']), 2);
                    $costo_tot_proceso    = round(floatval($row['costo_tot_proceso']), 2);


                    switch ($Tipo_accesorio) {
                        case 'Herraje':

                            $Tipo = self::strip_slashes_recursive($row['Tipo']);

                            $sql_accesorios = "INSERT INTO cot_accesorios(id_odt, id_modelo, tiraje, tipo, tipo_accesorio, costo_unit, costo_tot_accesorio, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$Tipo', '$Tipo_accesorio', $costo_unit_accesorio, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Lengueta de Liston':

                            $largo = intval($row['Largo']);
                            $ancho = intval($row['Ancho']);
                            $color = self::strip_slashes_recursive($row['Color']);

                            $sql_accesorios = "INSERT INTO cot_accesorios(id_odt, id_modelo, tiraje, tipo_accesorio, largo, ancho, color, costo_unit, costo_tot_accesorio, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$Tipo_accesorio', $largo, $ancho, '$color', $costo_unit_accesorio, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Ojillos':

                            $sql_accesorios = "INSERT INTO cot_accesorios(id_odt, id_modelo, tiraje, tipo_accesorio, costo_unit, costo_tot_accesorio, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$Tipo_accesorio', $costo_unit_accesorio, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Resorte':

                            $largo = intval($row['Largo']);
                            $ancho = intval($row['Ancho']);
                            $color = self::strip_slashes_recursive($row['Color']);

                            $sql_accesorios = "INSERT INTO cot_accesorios(id_odt, id_modelo, tiraje, tipo_accesorio, largo, ancho, color, costo_unit, costo_tot_accesorio, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$Tipo_accesorio', $largo, $ancho, '$color', $costo_unit_accesorio, $costo_tot_proceso, '$d_fecha')";

                            break;
                    }

                    $query_accesorios = $this->db->prepare($sql_accesorios);

                    $l_Accesorios = $query_accesorios->execute();

                    if (!$l_Accesorios) {

                        self::mError($aJson, $mensaje, "Error al grabar accesorios;");

                        $l_Accesorios = false;

                        break;
                    }
                }
            }


   /******************** termina accesorios  ************************/


   /******************** inicia bancos  ************************/

            $l_Bancos = true;

            if (array_key_exists("Bancos", $aJson)) {

                $aBancos = [];

                $aBancos = $aJson['Bancos'];

                foreach($aBancos as $row) {

                    $costo_tot_proceso = 0;

                    $Tipo_banco        = self::strip_slashes_recursive($row['Tipo_banco']);
                    $tiraje            = intval($row['tiraje']);
                    $largo             = intval($row['largo']);
                    $ancho             = intval($row['ancho']);
                    $profundidad       = intval($row['profundidad']);
                    $Suaje             = self::strip_slashes_recursive($row['Suaje']);
                    $costo_unit_banco  = round(floatval($row['costo_unit_banco']), 2);
                    $costo_tot_proceso = round(floatval($row['costo_tot_proceso']), 2);


                    $sql_bancos = "INSERT INTO cot_bancos(id_odt, id_modelo, tiraje, tipo, largo, ancho, profundidad, suaje, costo_unit, costo_tot_banco, fecha) VALUES($id_caja_odt, $id_modelo, $tiraje, '$Tipo_banco', $largo, $ancho, '$profundidad', '$Suaje', $costo_unit_banco, $costo_tot_proceso, '$d_fecha')";


                    $query_bancos = $this->db->prepare($sql_bancos);

                    $l_Bancos = $query_bancos->execute();

                    if (!$l_Bancos) {

                        self::mError($aJson, $mensaje, "Error al grabar bancos;");

                        $l_Bancos = false;

                        break;
                    }
                }
            }


   /******************** termina bancos  ************************/


   /******************** inicia cierres  ************************/

            $l_Cierres = true;

            if (array_key_exists("Cierres", $aJson)) {

                $aCierres = [];

                $aCierres = $aJson['Cierres'];

                foreach($aCierres as $row) {

                    $costo_tot_proceso = 0;

                    $Tipo_cierre       = self::strip_slashes_recursive($row['Tipo_cierre']);
                    $tiraje            = intval($row['tiraje']);
                    $numpares          = intval($row['numpares']);

                    $costo_unitario    = round(floatval($row['costo_unitario']), 2);
                    $costo_tot_proceso = round(floatval($row['costo_tot_proceso']), 2);


                    switch ($Tipo_cierre) {
                        case 'Iman':

                            $largo = intval($row['largo']);
                            $ancho = intval($row['ancho']);

                            $sql_cierres = "INSERT INTO cot_cierres(id_odt, id_modelo, tipo_cierre, tiraje, numpares, largo, ancho, costo_unit, costo_tot_cierre, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo_cierre', $tiraje, $numpares, $largo, $ancho, $costo_unitario, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Liston':

                            $largo = intval($row['largo']);
                            $ancho = intval($row['ancho']);
                            $tipo  = self::strip_slashes_recursive($row['tipo']);
                            $color = self::strip_slashes_recursive($row['color']);

                            $sql_cierres = "INSERT INTO cot_cierres(id_odt, id_modelo, tipo_cierre, tiraje, numpares, largo, ancho, tipo, color, costo_unit, costo_tot_cierre, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo_cierre', $tiraje, $numpares, $largo, $ancho, '$tipo', '$color', $costo_unitario, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Marialuisa':

                            $sql_cierres = "INSERT INTO cot_cierres(id_odt, id_modelo, tipo_cierre, tiraje, numpares, costo_unit, costo_tot_cierre, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo_cierre', $tiraje, $numpares, $costo_unitario, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Suaje calado':

                            $largo = intval($row['largo']);
                            $ancho = intval($row['ancho']);
                            $tipo  = self::strip_slashes_recursive($row['tipo']);

                            $sql_cierres = "INSERT INTO cot_cierres(id_odt, id_modelo, tipo_cierre, tiraje, numpares, largo, ancho, tipo, costo_unit, costo_tot_cierre, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo_cierre', $tiraje, $numpares, $largo, $ancho, '$tipo', $costo_unitario, $costo_tot_proceso, '$d_fecha')";

                            break;
                        case 'Velcro':

                            $sql_cierres = "INSERT INTO cot_cierres(id_odt, id_modelo, tipo_cierre, tiraje, numpares, costo_unit, costo_tot_cierre, fecha) VALUES($id_caja_odt, $id_modelo, '$Tipo_cierre', $tiraje, $numpares, $costo_unitario, $costo_tot_proceso, '$d_fecha')";

                            break;
                    }

                    $query_cierres = $this->db->prepare($sql_cierres);

                    $l_Cierres = $query_cierres->execute();

                    if (!$l_Cierres) {

                        self::mError($aJson, $mensaje, "Error al grabar cierres;");

                        $l_Cierres = false;

                        break;
                    }
                }
            }


   /******************** termina cierres  ************************/



            // variables booleanas
            if (
                ($l_inserted and $l_procesos and $l_calculadora)
                and ($inserted_papel_empcaj and $inserted_papel_fcaj)
                and ($inserted_papel_emptap and $inserted_papel_ftap)

                and ($inserted_papel_car and $inserted_papel_cartap)

                and ($l_ranurado and $l_ranurado_tap)
                and ($l_encuadernacion and $l_encuadernacionfcaj)

                and ($l_encajada and $l_encajada_ftap)

                and ($l_Suaje_fcaj_fijo and $l_Suaje_ftap_fijo and $l_despunte_esquinas and $l_corte_refine_emp)

                and ($l_elab_fcaj and $l_elab_ftap)

                and ($l_corte_carton_empcaj and $l_corte_carton_emptap)

                and ($l_corte_papel_empcaj and $l_corte_papel_emptap)
				and ($l_corte_papel_fcaj and $l_corte_refine_emptap)

                and ($l_arr_ran_hor_emp and $l_arr_ran_vert_emp)
                and ($l_arr_ran_hor_emptap and $l_arr_ran_vert_emptap)

                and ($l_offset_empcaj and $l_offset_maq_empcaj)
                and ($l_digital_empcaj and $l_serigrafia_empcaj)

                and ($l_offset_fcaj and $l_offset_maq_fcaj)
                and ($l_digital_fcaj and $l_serigrafia_fcaj)

                and ($l_offset_emptap and $l_offset_maq_emptap)
                and ($l_digital_emptap and $l_serigrafia_emptap)

                and ($l_offset_ftap and $l_offset_maq_ftap)
                and ($l_digital_ftap and $l_serigrafia_ftap)

                and ($l_Barniz_UV_empcaj and $l_Corte_Laser_empcaj)
                and ($l_Grabado_empcaj and $l_HotStamping_empcaj)
                and ($l_Laminado_empcaj and $l_Suaje_empcaj)

                and ($l_Barniz_UV_fcaj and $l_Corte_Laser_fcaj)
                and ($l_Grabado_fcaj and $l_HotStamping_fcaj)
                and ($l_Laminado_fcaj and $l_Suaje_fcaj)

                and ($l_Barniz_UV_emptap and $l_Corte_Laser_emptap)
                and ($l_Grabado_emptap and $l_HotStamping_emptap)
                and ($l_Laminado_emptap and $l_Suaje_emptap)

                and ($l_Barniz_UV_ftap and $l_Corte_Laser_ftap)
                and ($l_Grabado_ftap and $l_HotStamping_ftap)
                and ($l_Laminado_ftap and $l_Suaje_ftap)

                and ($l_Cierres and $l_Accesorios and $l_Bancos)
            ) {

                $this->db->commit();

                return $aJson;
            } else {

                $this->db->rollBack();

                return $aJson['error'];
            }
        } catch (PDOException $exception) {
        //} catch (Exception $e) {

            $this->db->rollBack();

            $excepcion = $exception->getMessage();

            $excepcion_pos  = strpos($excepcion, "Field");
            $excepcion_pos1 = strpos($excepcion, "General");

            if ($excepcion_pos) {

                $mensaje_db = substr($excepcion, $excepcion_pos);
            } elseif($excepcion_pos1) {

                $mensaje_db = substr($excepcion, $excepcion_pos1);
            } else {

                $mensaje_db = $exception->getMessage();
            }

            $aJson['error'] = $mensaje_db . "; Error al grabar en la BD";

            return $aJson;
            //return $aJson['error'];
        }
    }       // end function
}           // end class
