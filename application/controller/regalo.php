<?php

class Regalo extends Controller {

    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login_model   = $this->loadModel('LoginModel');
        $login         = $this->loadController('login');
        $options_model = $this->loadModel('OptionsModel');

        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';

        }

        $procesos      = $options_model->getProcessCatalog();
        $papers        = $options_model->getPapers();
        $cartones      = $options_model->getCartones();
        $cierres       = $options_model->getCostoCierre();
        $acabados      = $options_model->getCostoAcabados();
        $accesorios    = $options_model->getCostoAccesorios();
        $descuentos    = $options_model->getCostoDescuentos();
        $bancos        = $options_model->getCostoBancos();
        $impresiones   = $options_model->getImpresiones();
        $Digital       = $options_model->getProcDigital();
        $ALaminados    = $options_model->getALaminados();
        $AHotStamping  = $options_model->getAHotStamping();
        $Colores       = $options_model->getAHotStampingColor();
        $AGrabados     = $options_model->getAGrabados();
        $APEspeciales  = $options_model->getAPEspeciales();
        $ABarnizUV     = $options_model->getABarnizUV();
        $ASuaje        = $options_model->getASuaje();
        $ALaser        = $options_model->getALaser();
        $TipoImp       = $options_model->getTipoSerigrafia();
        $modeloscaj    = $options_model->getBoxModels();
        $TipoListon    = $options_model->getTipoListon();
        $ColoresListon = $options_model->getColoresListon();
        $Porcentajes   = $options_model->getPorcentajes();
        $Herrajes      = $options_model->getHerraje();

        $nombrecliente = utf8_encode($this->getClient($options_model));

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/templates/cotizador/plantilla.php';
        echo "<script>$('#divDerecho').empty()</script>";
        echo "<script>$('#divIzquierdo').empty()</script>";
        echo "<script>$('#divDerecho').hide()</script>";
        require_once 'application/views/cotizador/regalo/nueva_cotizacion.php';
        echo "<script>$('#divDerecho').show('slow')</script>";
        require_once 'application/views/templates/footer.php';
    }


    // Calculadora Regalo (id_modelo = 4)
    private function regaloCalc($odt, $base, $alto, $profundidad_cajon, $profundidad_tapa, $grosor_carton, $grosor_tapa) {

        $calculadora = array();

        $b = round(floatval($base), 3);
        $h = round(floatval($alto), 3);
        $p = round(floatval($profundidad_cajon), 3);
        $T = round(floatval($profundidad_tapa), 3);
        $g = round(floatval($grosor_carton), 3);
        $G = round(floatval($grosor_tapa), 3);

        $e = round(floatval($g / 20), 3);
        $E = round(floatval($G / 20), 3);


        $b1  = round(floatval($b + (2 * $e)), 3);
        $h1  = round(floatval($h + (2 * $e)), 3);
        $p1  = round(floatval($p + $e), 3);
        $x   = round(floatval((2 * $p1) + $b1), 3);
        $y   = round(floatval((2 * $p1) + $h1), 3);
        $x1  = round(floatval($x + (1.2)), 3);
        $y1  = round(floatval($y + (1.2)), 3);
        $x11 = round(floatval($x + (1)), 3);
        $y11 = round(floatval($y + (1)), 3);
        $b11 = round(floatval($x + (2 * 1.6)), 3);
        $h11 = round(floatval($y + (2 * 1.6)), 3);
        $f   = round(floatval($b11 + (1.5)), 3);
        $k   = round(floatval($h11 + (1.5)), 3);

        //tapa
        $B   = round(floatval($b1 + (2 * (0.15))), 3);
        $H   = round(floatval($h1 + (2 * (0.15))), 3);
        $B1  = round(floatval($B + (2 * $E)), 3);
        $H1  = round(floatval($H + (2 * $E)), 3);
        $T   = round($T, 3);
        $X   = round(floatval((2 * $T) + $B1), 3);
        $Y   = round(floatval((2 * $T) + $H1), 3);
        $X1  = round(floatval($X + (1.2)), 3);
        $Y1  = round(floatval($Y + (1.2)), 3);
        $X11 = round(floatval($X + (1)), 3);
        $Y11 = round(floatval($Y + (1)), 3);
        $B11 = round(floatval($X + (2 * ($E + 1.4))), 3);
        $H11 = round(floatval($Y + (2 * ($E + 1.4))), 3);
        $F   = round(floatval($B11 + (1.5)), 3);
        $K   = round(floatval($H11 + (1.5)), 3);

        $calculadora["b"] = $b;
        $calculadora["h"] = $h;
        $calculadora["p"] = $p;
        $calculadora["T"] = $T;
        $calculadora["g"] = $g;
        $calculadora["G"] = $g;

        $calculadora["e"] = $e;
        $calculadora["E"] = $E;

        // base
        $calculadora["b1"]  = $b1;
        $calculadora["h1"]  = $h1;
        $calculadora["p1"]  = $p1;
        $calculadora["x"]   = $x;
        $calculadora["y"]   = $y;
        $calculadora["x1"]  = $x1;
        $calculadora["y1"]  = $y1;
        $calculadora["x11"] = $x11;
        $calculadora["y11"] = $y11;
        $calculadora["b11"] = $b11;
        $calculadora["h11"] = $h11;
        $calculadora["f"]   = $f;
        $calculadora["k"]   = $k;


        // tapa
        $calculadora["B"]   = $B;
        $calculadora["H"]   = $H;
        $calculadora["B1"]  = $B1;
        $calculadora["H1"]  = $H1;
        $calculadora["T"]   = $T;
        $calculadora["X"]   = $X;
        $calculadora["Y"]   = $Y;
        $calculadora["X1"]  = $X1;
        $calculadora["Y1"]  = $Y1;
        $calculadora["X11"] = $X11;
        $calculadora["Y11"] = $Y11;
        $calculadora["B11"] = $B11;
        $calculadora["H11"] = $H11;
        $calculadora["F"]   = $F;
        $calculadora["K"]   = $K;

        $_SESSION['calculadora'] = [];

        $_SESSION['calculadora']        = $calculadora;
        $_SESSION['calculadora']['odt'] = $odt;

        return $calculadora;
    }


    // Convierte las cotizaciones (presupuesto) a ODTs 
    public function convPresupToODT() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');


        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        if (isset($_GET['id'])) {

            $id_odt = $_GET['id'];
            $id_odt = intval($id_odt);
        } else {

            return false;
        }

        $row = $ventas_model->getPresupById($id_odt);

        $status = "";

        $status = $row['status'];
        $status = trim(strval($status));

        $id_odt_orig = $row['id_odt_orig'];
        $id_odt_orig = intval($id_odt_orig);


        if ($status == "A" or $status == "M" or $status == "P") {

            $ventas_model->convPresupToODT($id_odt, $id_odt_orig);
        }

        header(URL.'regalo/getCotizaciones');
    }


    public function modCajaRegalo() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');
        $regalo_model  = $this->loadModel('RegaloModel');


        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        if (isset($_GET['num_odt'])) {

            $odt = $_GET['num_odt'];
            $odt = strtoupper($odt);
            $odt = self::strip_slashes_recursive($odt);

            $_POST['odt'] = $odt;

            $num_odt = $odt;
        } else {

            return false;
        }

        $cierres           = $options_model->getCostoCierre();
        $acabados          = $options_model->getCostoAcabados();
        $accesorios        = $options_model->getCostoAccesorios();
        $procesos          = $options_model->getProcessCatalog();
        $papers            = $options_model->getPapers();
        $cartones          = $options_model->getCartones();
        $cierres           = $options_model->getCostoCierre();
        $acabados          = $options_model->getCostoAcabados();
        $accesorios        = $options_model->getCostoAccesorios();
        $descuentos        = $options_model->getCostoDescuentos();
        $bancos            = $options_model->getCostoBancos();
        $impresiones       = $options_model->getImpresiones();
        $Digital           = $options_model->getProcDigital();
        $ALaminados        = $options_model->getALaminados();
        $AHotStamping      = $options_model->getAHotStamping();
        $Colores           = $options_model->getAHotStampingColor();
        $AGrabados         = $options_model->getAGrabados();
        $APEspeciales      = $options_model->getAPEspeciales();
        $ABarnizUV         = $options_model->getABarnizUV();
        $ASuaje            = $options_model->getASuaje();
        $ALaser            = $options_model->getALaser();
        $TipoImp           = $options_model->getTipoSerigrafia();
        $modeloscaj        = $options_model->getBoxModels();
        $TipoListon        = $options_model->getTipoListon();
        $ColoresListon     = $options_model->getColoresListon();
        $Porcentajes       = $options_model->getPorcentajes();
        $Herrajes          = $options_model->getHerraje();


        $id_modelo = 4;

        $aJson = [];

        $tabla_db = $ventas_model->getNumOdt($num_odt);

        foreach ($tabla_db as $row) {

            $id_odt            = intval($row['id_odt']);
            $status            = trim($row['status']);
            $id_usuario        = intval($row['id_usuario']);
            $id_cliente        = intval($row['id_cliente']);
            $tiraje            = intval($row['tiraje']);
            $base              = floatval($row['base']);
            $alto              = floatval($row['alto']);
            $profundidad_cajon = intval($row['profundidad_cajon']);
            $profundidad_tapa  = intval($row['profundidad_tapa']);
            $id_vendedor       = intval($row['id_vendedor']);
            $id_tienda         = intval($row['id_tienda']);
            $costo_total       = floatval($row['costo_total']);
            $subtotal          = floatval($row['subtotal']);
            $utilidad          = floatval($row['utilidad']);
            $iva               = floatval($row['iva']);
            $ISR               = floatval($row['ISR']);
            $comisiones        = floatval($row['comisiones']);
            $indirecto         = floatval($row['indirecto']);
            $venta             = floatval($row['venta']);
            $descuento         = floatval($row['descuento']);
            $descuento_pcte    = floatval($row['descuento_pcte']);
            $empaque           = floatval($row['empaque']);
            $mensajeria        = floatval($row['mensajeria']);
            $procesos          = self::strip_slashes_recursive($row['procesos']);
            $fecha_odt         = strtotime($row['fecha_odt']);
            $hora_odt          = strtotime($row['hora_odt']);
        }


        $fecha = date("Y/m/d", $fecha_odt);
        $hora  = date("H:i:s", $hora_odt);


        $tienda_db = $ventas_model->getNombTienda($id_tienda);

        foreach ($tienda_db as $row) {

            $nomb_tienda = $row['nombre_tienda'];
            $nomb_tienda = trim($nomb_tienda);
        }


        if (is_array($tienda_db)) {

            unset($tienda_db);
        }

        $aJson['papel_Emp']    = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelempcaj");
        $aJson['papel_FCaj']   = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelfcaj");
        $aJson['papel_EmpTap'] = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelemptap");
        $aJson['papel_FTap']   = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelftap");

        $id_papel_emp    = intval($aJson['papel_Emp']['id_papel']);
        $id_papel_fcaj   = intval($aJson['papel_FCaj']['id_papel']);
        $id_papel_emptap = intval($aJson['papel_EmpTap']['id_papel']);
        $id_papel_ftap   = intval($aJson['papel_FTap']['id_papel']);


        // carton cajon
        $aJson['costo_grosor_carton'] = $ventas_model->getIdCartonTabla($id_odt, "cot_reg_carton");

        $id_papel = intval($aJson['costo_grosor_carton']['id_cajon']);

        $id_grosor_carton = $ventas_model->getCartonIdPapel($id_papel);


        // carton tapa
        $aJson['costo_grosor_tapa'] = $ventas_model->getIdCartonTabla($id_odt, "cot_reg_cartontap");

        $id_cajon_tap         = intval($aJson['costo_grosor_tapa']['id_cajon']);
        $id_grosor_carton_tap = $ventas_model->getCartonIdPapel($id_cajon_tap);

        $carton_db = $ventas_model->getDatos($id_grosor_carton);


        $tabla_db = $ventas_model->getClientById($id_cliente);

        foreach ($tabla_db as $row) {

            $Nombre_cliente = $row['nombre'];
            $Nombre_cliente = utf8_encode(self::strip_slashes_recursive($Nombre_cliente));
        }

        $nombrecliente = $Nombre_cliente;

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }



        $tabla_db = $ventas_model->getNombUsuario($id_usuario);

        foreach ($tabla_db as $row) {

            $id_tienda    = intval($row['id_tienda']);
            $nomb_usuario = self::strip_slashes_recursive($row['nombre_usuario']);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $aJson['mensaje']             = "OK";
        $aJson['error']               = "";
        $aJson['id_odt']              = $id_odt;
        $aJson['num_odt']             = $num_odt;
        $aJson['tiraje']              = $tiraje;
        $aJson['modelo']              = $id_modelo;
        $aJson['id_cliente']          = $id_cliente;
        $aJson['Nombre_cliente']      = $Nombre_cliente;
        $aJson['id_usuario']          = $id_usuario;
        $aJson['id_tienda']           = $id_tienda;
        $aJson['nomb_tienda']         = $nomb_tienda;
        $aJson['base']                = $base;
        $aJson['alto']                = $alto;
        $aJson['profundidad_cajon']   = $profundidad_cajon;
        $aJson['profundidad_tapa']    = $profundidad_tapa;
        $aJson['id_tienda']           = $id_tienda;
        $aJson['id_vendedor']         = $id_vendedor;
        $aJson['costo_odt']           = $costo_total;
        $aJson['costo_subtotal']      = $subtotal;
        $aJson['Utilidad']            = $utilidad;
        $aJson['iva']                 = $iva;
        $aJson['comisiones']          = $comisiones;
        $aJson['indirecto']           = $indirecto;
        $aJson['ventas']              = $venta;
        $aJson['descuento']           = $descuento;
        $aJson['descuento_pctje']     = $descuento_pcte;
        $aJson['ISR']                 = $ISR;
        $aJson['empaque']             = $empaque;
        $aJson['mensajeria']          = $mensajeria;
        //$aJson['procesos']          = $procesos;
        $aJson['Fecha']               = $fecha;
        $aJson['hora']                = $hora;

        $aJson['id_grosor_carton']     = $id_grosor_carton;
        $aJson['id_grosor_carton_tap'] = $id_grosor_carton_tap;
        $aJson['id_vendedor']          = $id_vendedor;
        $aJson['id_papel_emp']         = $id_papel_emp;
        $aJson['id_papel_fcaj']        = $id_papel_fcaj;
        $aJson['id_papel_emptap']      = $id_papel_emptap;
        $aJson['id_papel_ftap']        = $id_papel_ftap;


        // empiezan los costos variables (procesos)
        $num_procesos = 0;

        if (strlen($procesos) > 0) {

            if ($procesos[strlen($procesos) -1 ] === ";") {

                $procesos = substr($procesos, 0, strlen($procesos) - 1);
            }

            $tabla_procesos = explode(";", $procesos);

            $num_procesos = count($tabla_procesos);
        }


        // Inicia procesos

        $prefijo = "cot_reg_";
        $len_prefijo = strlen($prefijo);

        for ($i = 0; $i < $num_procesos; $i++) {

            $nombre_tabla_tmp = self::strip_slashes_recursive($tabla_procesos[$i]);

            $aOffset_tmp     = "";
            $aOffset_tmp_len = 0;

            if ($nombre_tabla_tmp == "cot_accesorios" or $nombre_tabla_tmp == "cot_bancos" or $nombre_tabla_tmp == "cot_cierres") {

                $nombreProcesoTabla = $nombre_tabla_tmp;
                $proceso            = substr($nombre_tabla_tmp, 4, 3);
            } else {

                $nombreProcesoTabla = substr($nombre_tabla_tmp, $len_prefijo);
                $proceso            = substr($nombre_tabla_tmp, $len_prefijo, 3);
            }

            switch ($proceso) {

                case 'off':

                    if (strlen($nombre_tabla_tmp) <= 20) {

                        $nombre_seccion_tmp = substr($nombreProcesoTabla, strlen("offset"));
                    } else {

                        $nombre_seccion_tmp = substr($nombreProcesoTabla, strlen("offset"));
                    }

                    $grupo_seccion = 'aImp' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getOffsetTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);


                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Offset"][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'dig':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_dig") - 1);

                    $grupo_seccion = 'aImp' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getDigitalTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);


                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Digital"][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'ser':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_ser") - 1);

                    $grupo_seccion = 'aImp' . $nombre_seccion_tmp;

                    $aOffset_tmp = $ventas_model->getSerigrafiaTabla($id_odt, $nombre_tabla_tmp);


                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Serigrafia"][$ii] = $aOffset_tmp[$ii];
                    }


                    break;
                case 'bar':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_barnizuv") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp = $ventas_model->getBarnizuvTabla($id_odt, $nombre_tabla_tmp);


                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Barniz"][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'las':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_laser") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getLaserTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Laser'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'gra':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_grab") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getGrabadoTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Grabado'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'lam':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_lam") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getLaminadoTabla($id_odt, $nombre_tabla_tmp);

                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Laminado'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'sua':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_suaje") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getSuajeTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Suaje'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'acc':

                    $aJson['Accesorios'] = self::detalle_proc_Accesorios($id_odt, "cot_accesorios", $ventas_model);

                    break;
                case 'ban':

                    $aJson['Bancos'] = self::detalle_proc_Bancos($id_odt, "cot_bancos", $ventas_model);

                    break;
                case 'cie':

                    $aJson['Cierres'] = self::detalle_proc_Cierres($id_odt, "cot_cierres", $ventas_model);

                    break;
            }


            $proceso = substr($nombre_tabla_tmp, $len_prefijo, 2);

            if( $proceso == "hs"){

                $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_hs") - 1);

                $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                $aOffset_tmp     = $ventas_model->getHotStampingTabla($id_odt, $nombre_tabla_tmp);
                $aOffset_tmp_len = count($aOffset_tmp);


                for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                    $aJson[$grupo_seccion]['HotStamping'][$ii] = $aOffset_tmp[$ii];
                }
            }
        }


        json_encode($aJson);

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/templates/cotizador/plantilla.php';
        echo "<script>$('#divDerecho').empty()</script>";
        echo "<script>$('#divIzquierdo').empty()</script>";
        echo "<script>$('#divDerecho').hide()</script>";
        require_once 'application/views/cotizador/regalo/modificacion.php';
        echo "<script>$('#divDerecho').show('slow')</script>";
        require_once 'application/views/templates/footer.php';
    }


    public function impCajaRegalo() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');
        $regalo_model  = $this->loadModel('RegaloModel');


        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        if (isset($_GET['num_odt'])) {

            $odt = $_GET['num_odt'];
            $odt = strtoupper($odt);
            $odt = self::strip_slashes_recursive($odt);

            $_POST['odt'] = $odt;

            $num_odt = $odt;
        } else {

            return false;
        }

        $cierres           = $options_model->getCostoCierre();
        $acabados          = $options_model->getCostoAcabados();
        $accesorios        = $options_model->getCostoAccesorios();
        $procesos          = $options_model->getProcessCatalog();
        $papers            = $options_model->getPapers();
        $cartones          = $options_model->getCartones();
        $cierres           = $options_model->getCostoCierre();
        $acabados          = $options_model->getCostoAcabados();
        $accesorios        = $options_model->getCostoAccesorios();
        $descuentos        = $options_model->getCostoDescuentos();
        $bancos            = $options_model->getCostoBancos();
        $impresiones       = $options_model->getImpresiones();
        $Digital           = $options_model->getProcDigital();
        $ALaminados        = $options_model->getALaminados();
        $AHotStamping      = $options_model->getAHotStamping();
        $Colores           = $options_model->getAHotStampingColor();
        $AGrabados         = $options_model->getAGrabados();
        $APEspeciales      = $options_model->getAPEspeciales();
        $ABarnizUV         = $options_model->getABarnizUV();
        $ASuaje            = $options_model->getASuaje();
        $ALaser            = $options_model->getALaser();
        $TipoImp           = $options_model->getTipoSerigrafia();
        $modeloscaj        = $options_model->getBoxModels();
        $TipoListon        = $options_model->getTipoListon();
        $ColoresListon     = $options_model->getColoresListon();
        $Porcentajes       = $options_model->getPorcentajes();
        $Herrajes          = $options_model->getHerraje();


        $id_modelo = 4;

        $aJson = [];

        
        $row = $ventas_model->getOdtById($num_odt);

        $id_odt            = intval($row['id_odt']);
        $status            = trim($row['status']);
        $id_usuario        = intval($row['id_usuario']);
        $id_cliente        = intval($row['id_cliente']);
        $tiraje            = intval($row['tiraje']);
        $base              = floatval($row['base']);
        $alto              = floatval($row['alto']);
        $profundidad_cajon = intval($row['profundidad_cajon']);
        $profundidad_tapa  = intval($row['profundidad_tapa']);
        $id_vendedor       = intval($row['id_vendedor']);
        $id_tienda         = intval($row['id_tienda']);
        $costo_total       = floatval($row['costo_total']);
        $subtotal          = floatval($row['subtotal']);
        $utilidad          = floatval($row['utilidad']);
        $iva               = floatval($row['iva']);
        $ISR               = floatval($row['ISR']);
        $comisiones        = floatval($row['comisiones']);
        $indirecto         = floatval($row['indirecto']);
        $venta             = floatval($row['venta']);
        $descuento         = floatval($row['descuento']);
        $descuento_pcte    = floatval($row['descuento_pcte']);
        $empaque           = floatval($row['empaque']);
        $mensajeria        = floatval($row['mensajeria']);
        $procesos          = self::strip_slashes_recursive($row['procesos']);
        $fecha_odt         = strtotime($row['fecha_odt']);
        $hora_odt          = strtotime($row['hora_odt']);


        $fecha = date("Y/m/d", $fecha_odt);
        $hora  = date("H:i:s", $hora_odt);


        $tienda_db = $ventas_model->getNombTienda($id_tienda);

        foreach ($tienda_db as $row) {

            $nomb_tienda = $row['nombre_tienda'];
            $nomb_tienda = trim($nomb_tienda);
        }


        if (is_array($tienda_db)) {

            unset($tienda_db);
        }


        $aJson['papel_Emp']    = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelempcaj");
        $aJson['papel_FCaj']   = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelfcaj");
        $aJson['papel_EmpTap'] = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelemptap");
        $aJson['papel_FTap']   = $ventas_model->getPapelTabla($id_odt, "cot_reg_papelftap");


        $id_papel_emp    = intval($aJson['papel_Emp']['id_papel']);
        $id_papel_fcaj   = intval($aJson['papel_FCaj']['id_papel']);
        $id_papel_emptap = intval($aJson['papel_EmpTap']['id_papel']);
        $id_papel_ftap   = intval($aJson['papel_FTap']['id_papel']);


        // carton cajon
        $aJson['costo_grosor_carton'] = $ventas_model->getIdCartonTabla($id_odt, "cot_reg_carton");

        $id_papel = intval($aJson['costo_grosor_carton']['id_cajon']);

        $id_grosor_carton = $ventas_model->getCartonIdPapel($id_papel);


        // carton tapa
        $aJson['costo_grosor_tapa'] = $ventas_model->getIdCartonTabla($id_odt, "cot_reg_cartontap");

        $id_cajon_tap         = intval($aJson['costo_grosor_tapa']['id_cajon']);
        $id_grosor_carton_tap = $ventas_model->getCartonIdPapel($id_cajon_tap);

        $carton_db = $ventas_model->getDatos($id_grosor_carton);


        $tabla_db = $ventas_model->getClientById($id_cliente);

        foreach ($tabla_db as $row) {

            $Nombre_cliente = $row['nombre'];
            $Nombre_cliente = utf8_encode(self::strip_slashes_recursive($Nombre_cliente));
        }

        $nombrecliente = $Nombre_cliente;

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }



        $tabla_db = $ventas_model->getNombUsuario($id_usuario);

        foreach ($tabla_db as $row) {

            $id_tienda    = intval($row['id_tienda']);
            $nomb_usuario = self::strip_slashes_recursive($row['nombre_usuario']);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $aJson['mensaje']             = "OK";
        $aJson['error']               = "";
        $aJson['id_odt']              = $id_odt;
        $aJson['num_odt']             = $num_odt;
        $aJson['tiraje']              = $tiraje;
        $aJson['modelo']              = $id_modelo;
        $aJson['id_cliente']          = $id_cliente;
        $aJson['Nombre_cliente']      = $Nombre_cliente;
        $aJson['id_usuario']          = $id_usuario;
        $aJson['id_tienda']           = $id_tienda;
        $aJson['nomb_tienda']         = $nomb_tienda;
        $aJson['base']                = $base;
        $aJson['alto']                = $alto;
        $aJson['profundidad_cajon']   = $profundidad_cajon;
        $aJson['profundidad_tapa']    = $profundidad_tapa;
        $aJson['id_tienda']           = $id_tienda;
        $aJson['id_vendedor']         = $id_vendedor;
        $aJson['costo_odt']           = $costo_total;
        $aJson['costo_subtotal']      = $subtotal;
        $aJson['Utilidad']            = $utilidad;
        $aJson['iva']                 = $iva;
        $aJson['comisiones']          = $comisiones;
        $aJson['indirecto']           = $indirecto;
        $aJson['ventas']              = $venta;
        $aJson['descuento']           = $descuento;
        $aJson['descuento_pctje']     = $descuento_pcte;
        $aJson['ISR']                 = $ISR;
        $aJson['empaque']             = $empaque;
        $aJson['mensajeria']          = $mensajeria;
        //$aJson['procesos']          = $procesos;
        $aJson['Fecha']               = $fecha;
        $aJson['hora']                = $hora;

        $aJson['id_grosor_carton']     = $id_grosor_carton;
        $aJson['id_grosor_carton_tap'] = $id_grosor_carton_tap;
        $aJson['id_vendedor']          = $id_vendedor;
        $aJson['id_papel_emp']         = $id_papel_emp;
        $aJson['id_papel_fcaj']        = $id_papel_fcaj;
        $aJson['id_papel_emptap']      = $id_papel_emptap;
        $aJson['id_papel_ftap']        = $id_papel_ftap;


        // empiezan los costos variables (procesos)
        $num_procesos = 0;

        if (strlen($procesos) > 0) {

            if ($procesos[strlen($procesos) -1 ] === ";") {

                $procesos = substr($procesos, 0, strlen($procesos) - 1);
            }

            $tabla_procesos = explode(";", $procesos);

            $num_procesos = count($tabla_procesos);
        }


        // Inicia procesos

        $prefijo = "cot_reg_";
        $len_prefijo = strlen($prefijo);

        for ($i = 0; $i < $num_procesos; $i++) {

            $nombre_tabla_tmp = self::strip_slashes_recursive($tabla_procesos[$i]);

            $aOffset_tmp     = "";
            $aOffset_tmp_len = 0;

            if ($nombre_tabla_tmp == "cot_accesorios" or $nombre_tabla_tmp == "cot_bancos" or $nombre_tabla_tmp == "cot_cierres") {

                $nombreProcesoTabla = $nombre_tabla_tmp;
                $proceso            = substr($nombre_tabla_tmp, 4, 3);
            } else {

                $nombreProcesoTabla = substr($nombre_tabla_tmp, $len_prefijo);
                $proceso            = substr($nombre_tabla_tmp, $len_prefijo, 3);
            }

            switch ($proceso) {

                case 'off':

                    if (strlen($nombre_tabla_tmp) <= 20) {

                        $nombre_seccion_tmp = substr($nombreProcesoTabla, strlen("offset"));
                    } else {

                        $nombre_seccion_tmp = substr($nombreProcesoTabla, strlen("offset"));
                    }

                    $grupo_seccion = 'aImp' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getOffsetTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);


                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Offset"][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'dig':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_dig") - 1);

                    $grupo_seccion = 'aImp' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getDigitalTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);


                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Digital"][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'ser':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_ser") - 1);

                    $grupo_seccion = 'aImp' . $nombre_seccion_tmp;

                    $aOffset_tmp = $ventas_model->getSerigrafiaTabla($id_odt, $nombre_tabla_tmp);


                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Serigrafia"][$ii] = $aOffset_tmp[$ii];
                    }


                    break;
                case 'bar':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_barnizuv") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp = $ventas_model->getBarnizuvTabla($id_odt, $nombre_tabla_tmp);


                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]["Barniz"][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'las':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_laser") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getLaserTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Laser'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'gra':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_grab") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getGrabadoTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Grabado'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'lam':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_lam") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getLaminadoTabla($id_odt, $nombre_tabla_tmp);

                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Laminado'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'sua':

                    $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_suaje") - 1);

                    $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                    $aOffset_tmp     = $ventas_model->getSuajeTabla($id_odt, $nombre_tabla_tmp);
                    $aOffset_tmp_len = count($aOffset_tmp);

                    for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                        $aJson[$grupo_seccion]['Suaje'][$ii] = $aOffset_tmp[$ii];
                    }

                    break;
                case 'acc':

                    $aJson['Accesorios'] = self::detalle_proc_Accesorios($id_odt, "cot_accesorios", $ventas_model);

                    break;
                case 'ban':

                    $aJson['Bancos'] = self::detalle_proc_Bancos($id_odt, "cot_bancos", $ventas_model);

                    break;
                case 'cie':

                    $aJson['Cierres'] = self::detalle_proc_Cierres($id_odt, "cot_cierres", $ventas_model);

                    break;
            }


            $proceso = substr($nombre_tabla_tmp, $len_prefijo, 2);

            if( $proceso == "hs"){

                $nombre_seccion_tmp = substr($nombre_tabla_tmp, $len_prefijo + strlen("_hs") - 1);

                $grupo_seccion = 'aAcb' . $nombre_seccion_tmp;

                $aOffset_tmp     = $ventas_model->getHotStampingTabla($id_odt, $nombre_tabla_tmp);
                $aOffset_tmp_len = count($aOffset_tmp);


                for ($ii = 0; $ii < $aOffset_tmp_len; $ii++) {

                    $aJson[$grupo_seccion]['HotStamping'][$ii] = $aOffset_tmp[$ii];
                }
            }
        }


        json_encode($aJson);

        require_once 'application/views/templates/head.php';
        require_once 'application/views/cotizador/regalo/impresion.php';
        require_once 'application/views/templates/footer.php';
    }


    // Empieza el calculo de circular
    public function saveCaja() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');
        $regalo_model  = $this->loadModel('RegaloModel');


        if( !$login->isLoged() ) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        $id_modelo = 4;

        $aJson   = [];
        $aCortes = [];

        $l_existe = false;

        $odt               = "";
        $tiraje            = 0;
        $base              = 0;
        $alto              = 0;
        $profundidad_cajon = 0;
        $profundidad_tapa  = 0;
        $grosor_carton     = 0;
        $grosor_tapa       = 0;
        $id_cliente        = 0;
        $nombre_cliente    = "";
        $id_usuario        = 0;
        $id_tienda         = 0;
        $cantidad          = 0;
        $costo_total       = 0;
        $costo_corte       = 0;
        $cantidad_offset   = 0;


        $odt = trim(strval($_POST['odt']));
        $odt = strtoupper($odt);
        $odt = self::strip_slashes_recursive($odt);


        //$l_existe = $ventas_model->chkODT();
        $l_existe = $options_model->checaODT($odt);

        if ($l_existe) {

            self::msgError("Ya hay una ODT con el mismo nombre");
        }


        $starttime = microtime(true);


        $tiraje = $_POST['qty'];
        $tiraje = intval($tiraje);

        $id_usuario = $_SESSION['id_usuario'];
        $id_usuario = intval($id_usuario);


        $nomb_usuario_db = $ventas_model->getNombUsuario($id_usuario);

        foreach ($nomb_usuario_db as $row) {

            $nomb_usuario = $row['nombre_usuario'];
            $nomb_usuario = trim($nomb_usuario);
        }

        $id_tienda = $_SESSION['id_tienda'];
        $id_tienda = intval($id_tienda);

        $tienda_db = $ventas_model->getNombTienda($id_tienda);

        foreach ($tienda_db as $row) {

            $nomb_tienda = $row['nombre_tienda'];
            $nomb_tienda = trim($nomb_tienda);
        }

        if (is_array($tienda_db)) {

            unset($tienda_db);
        }

        $base = $_POST['base'];
        $base = floatval($base);

        $alto = $_POST['alto'];
        $alto = floatval($alto);

        $profundidad_cajon = $_POST['profundidad_cajon'];
        $profundidad_cajon = floatval($profundidad_cajon);

        $profundidad_tapa = $_POST['profundidad_tapa'];
        $profundidad_tapa = floatval($profundidad_tapa);

        $grosor_carton = $_POST['grosor_carton'];
        $grosor_carton = floatval($grosor_carton);

        $grosor_tapa = $_POST['grosor_tapa'];
        $grosor_tapa = floatval($grosor_tapa);

        $nombre_cliente = $_POST['nombre_cliente'];
        $id_cliente     = $ventas_model->getIdClient($nombre_cliente);


        $aCalculadora = self::regaloCalc($odt, $base, $alto, $profundidad_cajon, $profundidad_tapa, $grosor_carton, $grosor_tapa);


        $NombProcesos = "";

    // aJson
        // crea el array principal
        $aJson['tiempo_transcurrido'] = 0.00;
        $aJson['mensaje']             = "Correcto";
        $aJson['error']               = "";
        $aJson['id_cliente']          = $id_cliente;
        $aJson['nombre_cliente']      = $nombre_cliente;
        $aJson['nomb_odt']            = self::strip_slashes_recursive($_POST['odt']);
        $aJson['Fecha']               = date("Y-m-d");
        $aJson['modelo']              = $id_modelo;
        $aJson['tiraje']              = $tiraje;
        $aJson['id_usuario']          = $id_usuario;
        $aJson['nomb_usuario']        = $nomb_usuario;
        $aJson['id_tienda']           = $id_tienda;
        $aJson['nomb_tienda']         = $nomb_tienda;
        $aJson['base']                = $base;
        $aJson['alto']                = $alto;
        $aJson['base']                = $base;
        $aJson['profundidad_cajon']   = $profundidad_cajon;
        $aJson['profundidad_tapa']    = $profundidad_tapa;
        $aJson['grosor_carton']       = $grosor_carton;
        $aJson['grosor_tapa']         = $grosor_tapa;


        $aJson['costo_odt']                = 0;
        $aJson['costo_subtotal']           = 0;
        $aJson['Utilidad']                 = 0;
        $aJson['iva']                      = 0;
        $aJson['comisiones']               = 0;
        $aJson['indirecto']                = 0;
        $aJson['ventas']                   = 0;
        $aJson['descuento']                = 0;
        $aJson['descuento_pctje']          = floatval($_POST['descuento_pctje']);
        $aJson['ISR']                      = 0;
        $aJson['empaque']                  = 0;
        $aJson['mensajeria']               = 0;

        $aJson['costo_papeles']            = 0;
        $aJson['costo_cartones']           = 0;

        $aJson['corte_papeles']            = 0;
        $aJson['corte_cartones']           = 0;

        $aJson['costos_fijos']             = 0;
        $aJson['costo_accesorios']         = 0;
        $aJson['costo_bancos']             = 0;
        $aJson['costo_cierres']            = 0;

        $aJson['Imp_EmpCaj']               = 0;
        $aJson['Imp_EmpCaj_maq']           = 0;
        $aJson['Imp_FCaj']                 = 0;
        $aJson['Imp_FCaj_maq']             = 0;
        $aJson['Imp_EmpTap']               = 0;
        $aJson['Imp_EmpTap_maq']           = 0;
        $aJson['Imp_FTap']                 = 0;
        $aJson['Imp_FTap_maq']             = 0;

        $aJson['Acb_EmpFCaj']              = 0.0;
        $aJson['Acb_FCaj']                 = 0.0;
        $aJson['Acb_EmpTap']               = 0.0;
        $aJson['Acb_FTap']                 = 0.0;


        $aJson['Calculadora'] = $aCalculadora;


        $subtotal = 0;
        $mensaje  = "ERROR";
        $error    = "No existe costo para ";


/**************** Inicia el calculo de todos los papeles **************/

        $id_papel_empalme      = 0;
        $id_papel_forro_cajon  = 0;
        $id_papel_empalme_tapa = 0;
        $id_papel_forro_tapa   = 0;

        $tot_costo_papeles = 0;

    // papeles
        $id_papel_empalme      = intval($_POST['optEC']);
        $id_papel_forro_cajon  = intval($_POST['optFC']);
        $id_papel_empalme_tapa = intval($_POST['optET']);
        $id_papel_forro_tapa   = intval($_POST['optFT']);

        $id_papel_EmpTap = $id_papel_empalme_tapa;
        $id_papel_FCaj   = $id_papel_forro_cajon;
        $id_papel_FTap   = $id_papel_forro_tapa;


    /*********** Empalme del Cajon *************/

        $id_papel_empalme = intval($id_papel_empalme);

        $x11        = $aCalculadora['x11'];
        $secc_largo = floatval($x11);

        $y11        = $aCalculadora['y11'];
        $secc_ancho = floatval($y11);

        $aPapel_tmp = self::calculaPapel("empalme", $id_papel_empalme, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);


        if ($aPapel_tmp['tot_costo'] <= 0) {

            self::mError($aJson, $mensaje, $error . "empalme del cajon;");
        }

        if (intval($aPapel_tmp['corte']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en empalme del cajon;");
        }


        $aJson['cortes']['papel_Emp'] = $aPapel_tmp['corte'];

        $aJson['papel_Emp'] = $aPapel_tmp;

        $aJson['costo_papeles'] += $aPapel_tmp['tot_costo'];
        $tot_costo_papeles      += $aPapel_tmp['tot_costo'];
        $subtotal               += $aPapel_tmp['tot_costo'];

        if (is_array($aPapel_tmp) and count($aPapel_tmp) > 0) {

            unset($aPapel_tmp);
        }


    /*********** Forro del Cajon *************/

        $id_papel = intval($id_papel_forro_cajon);

        $f          = $aCalculadora['f'];           // largo
        $secc_largo = floatval($f);

        $k          = $aCalculadora['k'];           // ancho
        $secc_ancho = floatval($k);

        $aPapel_tmp = self::calculaPapel("FCaj", $id_papel, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        if ($aPapel_tmp['tot_costo'] <= 0) {

            self::mError($aJson, $mensaje, $error. "papel forro del cajon;");
        }

        if (intval($aPapel_tmp['corte']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en forro del cajon;");
        }


        $aJson['cortes']['papel_FCaj'] = $aPapel_tmp['corte'];

        $aJson['papel_FCaj'] = $aPapel_tmp;


        $aJson['costo_papeles'] += $aPapel_tmp['tot_costo'];
        $tot_costo_papeles      += $aPapel_tmp['tot_costo'];
        $subtotal               += $aPapel_tmp['tot_costo'];


        if (is_array($aPapel_tmp) and count($aPapel_tmp) > 0) {

            unset($aPapel_tmp);
        }


    /*********** Empalme de la Tapa *************/

        $id_papel = intval($id_papel_empalme_tapa);

        $secc_ancho = $aCalculadora['Y11'];
        $secc_ancho = floatval($secc_ancho);

        $secc_largo = $aCalculadora['X11'];
        $secc_largo = floatval($secc_largo);

        $aPapel_tmp = self::calculaPapel("FextCaj", $id_papel, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        if ($aPapel_tmp['tot_costo'] <= 0) {

            self::mError($aJson, $mensaje, $error . "papel empalme de la tapa;");
        }

        if (intval($aPapel_tmp['corte']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego empalme de la Tapa;");
        }

        $aJson['cortes']['papel_EmpTap'] = $aPapel_tmp['corte'];

        $aJson['papel_EmpTap'] = $aPapel_tmp;

        $aJson['costo_papeles'] += $aPapel_tmp['tot_costo'];
        $tot_costo_papeles      += $aPapel_tmp['tot_costo'];
        $subtotal               += $aPapel_tmp['tot_costo'];

        if (is_array($aPapel_tmp) and count($aPapel_tmp) > 0) {

            unset($aPapel_tmp);
        }


    /*********** Forro de la Tapa *************/

        $id_papel = intval($id_papel_forro_tapa);

        $F          = $aCalculadora['F'];       // largo
        $secc_largo = floatval($F);

        $K          = $aCalculadora['K'];       // ancho
        $secc_ancho = floatval($K);

        $aPapel_tmp = self::calculaPapel("PomCaj", $id_papel, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        if ($aPapel_tmp['tot_costo'] <= 0) {

            self::mError($aJson, $mensaje, $error . "papel forro de la tapa;");
        }

        if (intval($aPapel_tmp['corte']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en Forro de la Tapa;");
        }


        $aJson['cortes']['papel_FTap'] = $aPapel_tmp['corte'];

        $aJson['papel_FTap'] = $aPapel_tmp;

        $aJson['costo_papeles'] += $aPapel_tmp['tot_costo'];
        $tot_costo_papeles      += $aPapel_tmp['tot_costo'];
        $subtotal               += $aPapel_tmp['tot_costo'];


        if (is_array($aPapel_tmp) and count($aPapel_tmp) > 0) {

            unset($aPapel_tmp);
        }


        $aJson['costo_papeles'] = round($tot_costo_papeles, 2);


/**************** Termina el calculo de todos los papeles **************/


/*************** Inicia el calculo de los cartones ******************/

    // Grosor Carton (Empalme del cajon)
        $id_grosor_carton_db = $ventas_model->getCartonById($grosor_carton);


        $id_grosor_carton = 0;

        $id_grosor_carton = $id_grosor_carton_db['id_papel'];
        $id_grosor_carton = intval($id_grosor_carton);

        $cart_ancho = $aJson['Calculadora']['x1'];
        $cart_largo = $aJson['Calculadora']['y1'];


        $aPapel_tmp = self::calculaPapel("grosor_carton", $grosor_carton, $cart_ancho, $cart_largo, $tiraje, $options_model, $ventas_model);

        $aPapel_tmp['id_papel'] = $id_grosor_carton;

        $corte_cajon = intval($aPapel_tmp['calculadora']['corte']['cortesT']);


        if ($aPapel_tmp['tot_costo'] <= 0) {

            self::mError($aJson, $mensaje, $error . "Grosor Carton Empalme del cajon;");
        }

        if ($corte_cajon <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al carton del cajon (empalme del cajon);");
        }

        $aCortes['cajon']             = $corte_cajon;
        $aJson['costo_grosor_carton'] = $aPapel_tmp;

        $aJson['costo_cartones'] += $aPapel_tmp['tot_costo'];
        $subtotal                += $aPapel_tmp['tot_costo'];


    // Grosor Tapa (Empalme de la tapa)
        $id_grosor_tapa = 0;

        $id_grosor_tapa_db = $ventas_model->getCartonById($grosor_tapa);

        $id_grosor_tapa = $id_grosor_tapa_db['id_papel'];
        $id_grosor_tapa = intval($id_grosor_tapa);

        $cart_ancho = floatval($aJson['Calculadora']['X1']);
        $cart_largo = floatval($aJson['Calculadora']['Y1']);

        $aPapel_tmp = self::calculaPapel("grosor_tapa", $grosor_tapa, $cart_ancho, $cart_largo, $tiraje, $options_model, $ventas_model);

        $corte_tapa = intval($aPapel_tmp['calculadora']['corte']['cortesT']);


        if ($aPapel_tmp['tot_costo'] <= 0) {

            self::mError($aJson, $mensaje, $error . "Grosor Tapa Empalme de la tapa;");
        }

        if ($corte_tapa <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al carton (empalme de la tapa);");
        }

        $aCortes['tapa']            = $corte_tapa;
        $aJson['costo_grosor_tapa'] = $aPapel_tmp;

        $aJson['costo_cartones'] += $aPapel_tmp['tot_costo'];
        $subtotal                += $aPapel_tmp['tot_costo'];

        $aJson['costo_cartones'] = $aJson['costo_grosor_carton']['tot_costo'] + $aJson['costo_grosor_tapa']['tot_costo'];


/*************** Termina el calculo de los cartones ******************/


        $aMerma = [];


/******************* Inicia Costos fijos *************************/


    /****** inicia costos de corte *******/

        // suma de todos los pliegos de papeles
        $tot_pliegos_papeles = intval($aJson['papel_Emp']['tot_pliegos'])
                             + intval($aJson['papel_FCaj']['tot_pliegos'])
                             + intval($aJson['papel_EmpTap']['tot_pliegos'])
                             + intval($aJson['papel_FTap']['tot_pliegos']);

        $tot_pliegos_cartones = intval($aJson['costo_grosor_carton']['tot_pliegos'])
                             + intval($aJson['costo_grosor_tapa']['tot_pliegos']);

        $aJson['corte_papeles']  = self::costo_guillotina("Corte", $tot_pliegos_papeles, $ventas_model);
        $aJson['corte_cartones'] = self::costo_guillotina("Corte", $tot_pliegos_cartones, $ventas_model);

        $subtotal += round(floatval($aJson['corte_papeles']), 2) + round(floatval($aJson['corte_cartones']), 2);


        // carton empalme cajon
        $aJson['costo_corte_carton_empcaj'] = [];

        $cortes_pliego_emp = $corte_cajon;

        $aJson['costo_corte_carton_empcaj'] = self::costo_corte("Corte", $tiraje, $cortes_pliego_emp, $ventas_model);

        $aJson['costo_tot_corte_carton'] = $aJson['costo_corte_carton_empcaj']['tot_costo_corte'];

        //$subtotal += $aJson['costo_tot_corte_carton'];


        // carton empalme tapa
        $aJson['costo_corte_carton_emptap'] = [];

        $cortes_pliego_emp = $corte_tapa;

        $aJson['costo_corte_carton_emptap'] = self::costo_corte("Corte", $tiraje, $cortes_pliego_emp, $ventas_model);

        $aJson['costo_tot_corte_carton'] = $aJson['costo_corte_carton_emptap']['tot_costo_corte'];

        //$subtotal += $aJson['costo_tot_corte_carton'];



        // papel empalme
        $cortes_papel_cajon = $aJson['cortes']['papel_Emp'];

        $aJson['costo_papel_corte']     = self::costo_corte("Corte", $tiraje, $cortes_papel_cajon, $ventas_model);

        $aJson['costo_tot_corte_papel'] = $aJson['costo_papel_corte']['tot_costo_corte'];

        //$subtotal += $aJson['costo_tot_corte_papel'];


        // refine empalme
        $cortes_papel_refine = $aJson['cortes']['papel_Emp'];

        $aJson['costo_corte_refine_emp'] = self::costo_corte("Corte", $tiraje, $cortes_papel_refine, $ventas_model);

        $subtotal += $aJson['costo_corte_refine_emp']['tot_costo_corte'];


        // papel empalme tapa
        $cortes_papel_emptap = intval($aJson['cortes']['papel_EmpTap']);

        $aJson['costo_papel_corte_emptap'] = self::costo_corte("Corte", $tiraje, $cortes_papel_emptap, $ventas_model);

        //$subtotal += $aJson['costo_papel_corte_emptap']['tot_costo_corte'];


        // refine empalme tapa
        $aJson['costo_corte_refine_emptap'] = self::costo_corte("Corte", $tiraje, $cortes_papel_emptap, $ventas_model);

        $subtotal += $aJson['costo_corte_refine_emptap']['tot_costo_corte'];


    /****** termina costos de corte *******/


    /********** inicia costo corte(guillotina) ***************/

    $tot_pliegos_corte = intval($aJson['papel_Emp']['tot_pliegos']
                     + $aJson['papel_FCaj']['tot_pliegos']
                     + $aJson['papel_EmpTap']['tot_pliegos']
                     + $aJson['papel_FTap']['tot_pliegos']
                     + $aJson['costo_grosor_carton']['tot_pliegos']
                     + $aJson['costo_grosor_tapa']['tot_pliegos']
                     + $aJson['costo_corte_refine_emp']['tot_pliegos']
                     + $aJson['costo_corte_refine_emptap']['tot_pliegos']
                     );

    $tot_pliegos_papel = $aJson['papel_Emp']['tot_pliegos'] + $aJson['papel_FCaj']['tot_pliegos'] + $aJson['papel_EmpTap']['tot_pliegos'] + $aJson['papel_FTap']['tot_pliegos'];

    $aJson['costo_tot_corte_papel'] = self::costo_tot_corte($tiraje, $tot_pliegos_papel, $ventas_model);

    $aJson['costo_tot_corte'] = 0;

    $aJson['costo_tot_corte'] = $aJson['costo_tot_corte_papel'];


    $tot_pliegos_carton = $aJson['costo_grosor_carton']['tot_pliegos'] + $aJson['costo_grosor_tapa']['tot_pliegos'];

    $aJson['costo_tot_corte_carton'] = self::costo_tot_corte($tiraje, $tot_pliegos_carton, $ventas_model);

    $aJson['costo_tot_corte'] += $aJson['costo_tot_corte_carton'];


    $tot_pliegos_refine = $aJson['costo_corte_refine_emp']['tot_pliegos'] + $aJson['costo_corte_refine_emptap']['tot_pliegos'];

    $aJson['costo_tot_corte_refine'] = self::costo_tot_corte($tiraje, $tot_pliegos_refine, $ventas_model);


    $aJson['costo_tot_corte'] += $aJson['costo_tot_corte_refine'];

    $subtotal += $aJson['costo_tot_corte'];


    /********** termina costo corte(guillotina) ***************/


    /****************** ranurado empalme tapa ****************/

    // areglo ranurado empalme tapa
        $aJson['arreglo_ranurado_hor_emptap'] = [];
        $aJson['arreglo_ranurado_ver_emptap'] = [];

        $aJson['arreglo_ranurado_hor_emptap'] = self::calculoRanurado($tiraje, $ventas_model);

        $aJson['costos_fijos'] += $aJson['arreglo_ranurado_hor_emptap']['costo_tot_proceso'];
        $subtotal              += $aJson['arreglo_ranurado_hor_emptap']['costo_tot_proceso'];


        if ($aJson['arreglo_ranurado_hor_emptap']['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, $error . "arreglo ranurado hor emptap;");
        }


        if ($base > $alto or $base < $alto) {

            $aJson['arreglo_ranurado_ver_emptap'] = $aJson['arreglo_ranurado_hor_emptap'];


            if ($aJson['arreglo_ranurado_ver_emptap']['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error . "arreglo ranurado ver emptap;");
            }

            $aJson['costos_fijos'] += $aJson['arreglo_ranurado_ver_emptap']['costo_tot_proceso'];
            $subtotal              += $aJson['arreglo_ranurado_ver_emptap']['costo_tot_proceso'];
        } else {

            $aJson['arreglo_ranurado_ver_emptap']['costo_tot_proceso'] = 0;
        }



    /****************** ranurado empalme ***********************/

        $costo_ranurado = self::calculoRanurado($tiraje, $ventas_model);

        $aJson['ranurado'] = $costo_ranurado;

        if ($costo_ranurado['arreglo'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo arreglo;");
        }

        if ($costo_ranurado['costo_unit_por_ranura'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario por ranura;");
        }


        $aJson['costos_fijos'] += $costo_ranurado['costo_tot_proceso'];
        $subtotal              += $costo_ranurado['costo_tot_proceso'];

        if ($costo_ranurado['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, "No existe algun costo para ranurado;");
        }


    // areglo ranurado empalme
        $aJson['arreglo_ranurado_hor_emp'] = [];
        $aJson['arreglo_ranurado_ver_emp'] = [];

        $proc_temp = [];

        $proc_temp = self::calculoRanurado($tiraje, $ventas_model);

        if ($proc_temp['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, $error . "arreglo ranurado empalme;");
        }


        $aRanurado      = [];
        $aRanurado_Fcar = [];

        $aRanurado['tiraje']                = $proc_temp['tiraje'];
        $aRanurado['arreglo']               = $proc_temp['arreglo'];
        $aRanurado['costo_unit_por_ranura'] = $proc_temp['costo_unit_por_ranura'];
        $aRanurado['costo_por_ranura']      = $proc_temp['costo_por_ranura'];
        $aRanurado['costo_tot_ranurado']    = $proc_temp['costo_tot_proceso'];

        $aJson['arreglo_ranurado_hor_emp'] = $aRanurado;

        $aJson['costos_fijos'] += $aRanurado['costo_tot_ranurado'];
        $subtotal              += $aRanurado['costo_tot_ranurado'];


        $aRanurado_Fcar['costo_unit_por_ranura'] = $proc_temp['costo_unit_por_ranura'];
        $aRanurado_Fcar['costo_por_ranura']      = $proc_temp['costo_por_ranura'];


        if ($base > $alto or $base < $alto) {

            $aJson['arreglo_ranurado_ver_emp'] = $aRanurado;

            $aJson['costos_fijos'] += $aRanurado['costo_tot_ranurado'];
            $subtotal              += $aRanurado['costo_tot_ranurado'];
        } else {

            $aJson['arreglo_ranurado_ver_emp']['costo_tot_ranurado'] = 0;
        }



    /****************** ranurado tapa ********************************/

        $costo_ranurado_tapa = self::calculoRanurado($tiraje, $ventas_model);

        $aJson['ranurado_tapa'] = $costo_ranurado_tapa;

        if ($costo_ranurado_tapa['arreglo'] <= 0) {

            self::mError($aJson, $mensaje, $error . "arreglo (ranurado tapa);");
        }

        if ($costo_ranurado_tapa['costo_unit_por_ranura'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario por ranura (ranurado tapa);");
        }

        if ($costo_ranurado_tapa['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, $error . "ranurado tapa;");
        }


        $aJson['costos_fijos'] += $costo_ranurado_tapa['costo_tot_proceso'];
        $subtotal              += $costo_ranurado_tapa['costo_tot_proceso'];



    /********************* encuadernacion empalme ******************************/

        $enc_cortes_emp = intval($aJson['cortes']['papel_Emp']);

        $id_papel_emp = intval($aJson['papel_Emp']['id_papel']);


        $aJson['encuadernacion'] = self::calculoEncuadernacion($tiraje, $enc_cortes_emp, $id_papel_emp, $ventas_model);


        $temp = floatval($aJson['encuadernacion']['costo_tot_proceso']);

        if ($temp <= 0) {

            self::mError($aJson, $mensaje, $error . "encuadernacion;");
        }


        $subtotal += floatval($aJson['encuadernacion']['costo_tot_proceso']);


    /********************* encuadernacion cajon ******************************/

        $enc_cortes_emp = intval($aJson['cortes']['papel_FCaj']);

        $id_papel_emp = intval($aJson['papel_FCaj']['id_papel']);


        $aJson['encuadernacion_fcaj'] = self::calculoEncuadernacion_FCaj($tiraje, $enc_cortes_emp, $id_papel_emp, $ventas_model);


        $temp = floatval($aJson['encuadernacion_fcaj']['costo_tot_proceso']);

        if ($temp <= 0) {

            self::mError($aJson, $mensaje, $error . "encuadernacion forro cajon;");
        }


        $aJson['costos_fijos'] += floatval($aJson['encuadernacion_fcaj']['costo_tot_proceso']);
        $subtotal              += floatval($aJson['encuadernacion_fcaj']['costo_tot_proceso']);


        // encajada cajon
        $aJson['encajada'] = self::calculoEncajada($tiraje, $ventas_model);

        $temp = 0;
        $temp = floatval($aJson['encajada']['costo_tot_proceso']);

        if ($temp <= 0) {

            self::mError($aJson, $mensaje, $error , "encajada;");
        }

        $aJson['costos_fijos'] += floatval($aJson['encajada']['costo_tot_proceso']);
        $subtotal              += floatval($aJson['encajada']['costo_tot_proceso']);


    /******* despunte de esquinas empalme tapa ******/

        $desp_tmp = self::calculoDespunteEsquinasCajon($tiraje, $ventas_model);

        if($desp_tmp['costo_unitario_esquinas'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario despunte esquinas en empalme cajon");
        }

        $aJson['despunte_esquinas_emptap'] = $desp_tmp;

        $aJson['costos_fijos'] += $desp_tmp['costo_tot_proceso'];
        $subtotal              += $desp_tmp['costo_tot_proceso'];



    /************ forro exterior del cajon  ******************/

        $aJson['elab_FCaj'] = self::calculoForradoCajon($tiraje, $aJson['cortes']['papel_FCaj'], $id_papel_FCaj, $ventas_model);


        $temp = floatval($aJson['elab_FCaj']['costo_tot_proceso']);

        if ($temp <= 0) {

            self::mError($aJson, $mensaje, $error . "forro del cajon;");
        }

        $aJson['costos_fijos'] += floatval($aJson['elab_FCaj']['costo_tot_proceso']);
        $subtotal              += floatval($aJson['elab_FCaj']['costo_tot_proceso']);



        $cortes_pliego_fcaj = $aJson['cortes']['papel_FCaj'];

        $aJson['costo_corte_papel_fcaj'] = self::costo_corte("Corte", $tiraje, $cortes_pliego_fcaj, $ventas_model);


        $subtotal += $aJson['costo_corte_papel_fcaj']['tot_costo_corte'];



        //suaje(fijo)
        $tipoGrabado = "Perimetral";


        // suaje forro cajon
        $Largo            = round(floatval($aJson['costo_grosor_carton']['calculadora']['corte_largo']), 2);
        $Ancho            = round(floatval($aJson['costo_grosor_carton']['calculadora']['corte_ancho']), 2);
        $papel_costo_unit = floatval($aJson['costo_grosor_carton']['costo_unit_papel']);
        $cortes           = intval($aJson['costo_grosor_carton']['corte']);
        $tot_pliegos      = $aJson['costo_grosor_carton']['tot_pliegos'];


        $aJson['suaje_fcaj_fijo'] = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model, true);

        $aJson['costos_fijos'] += $aJson['suaje_fcaj_fijo']['costo_tot_proceso'];
        $subtotal              += $aJson['suaje_fcaj_fijo']['costo_tot_proceso'];




        // suaje forro tapa
        $Largo            = $aJson['costo_grosor_tapa']['calculadora']['corte_largo'];
        $Ancho            = $aJson['costo_grosor_tapa']['calculadora']['corte_ancho'];
        $papel_costo_unit = $aJson['costo_grosor_tapa']['costo_unit_papel'];
        $cortes           = $aJson['costo_grosor_tapa']['corte'];
        $tot_pliegos      = $aJson['costo_grosor_tapa']['tot_pliegos'];

        $aJson['suaje_ftap_fijo'] = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model, true);

        $aJson['costos_fijos'] += $aJson['suaje_ftap_fijo']['costo_tot_proceso'];
        $subtotal              += $aJson['suaje_ftap_fijo']['costo_tot_proceso'];


        // encajada forro tapa
        $aJson['encajada_ftap'] = self::calculoEncajada($tiraje, $ventas_model);

        $temp = 0;
        $temp = floatval($aJson['encajada_ftap']['costo_tot_proceso']);

        if ($temp <= 0) {

            self::mError($aJson, $mensaje, $error , "encajada forro tapa;");
        }

        $aJson['costos_fijos'] += floatval($aJson['encajada_ftap']['costo_tot_proceso']);
        $subtotal              += floatval($aJson['encajada_ftap']['costo_tot_proceso']);


    /************ Elaboración Forro de la Tapa  ******************/


        $aJson['elab_FTap'] = self::calculoForradoCajon($tiraje, $aJson['cortes']['papel_FTap'], $id_papel_FTap, $ventas_model);

        $temp = floatval($aJson['elab_FTap']['costo_tot_proceso']);

        if ($temp <= 0) {

            self::mError($aJson, $mensaje, $error . "forro de la tapa;");
        }

        $aJson['costos_fijos'] += floatval($aJson['elab_FTap']['costo_tot_proceso']);
        $subtotal              += floatval($aJson['elab_FTap']['costo_tot_proceso']);


/************** Termina Costos fijos *************************/



        $aJson['cortes']['carton_fcaj']   = $corte_cajon;
        $aJson['cortes']['carton_emptap'] = $corte_tapa;



/******************* inicia boton de Impresion ******************************/


    /****************** Inicia los calculos de Empalme del Cajon *****************/


        $secc_sufijo = "Emp";
        $nomb_inner  = "papel_" . $secc_sufijo;

        // Base del Cajon
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpEC'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);


        $num_rows = count($Tipo_proceso_tmp2);

        $a_tmp             = $aJson[$nomb_inner];
        $a_tmp_calculadora = $a_tmp['calculadora'];

        $papel_corte_ancho = $a_tmp_calculadora['corte_ancho'];
        $papel_corte_largo = $a_tmp_calculadora['corte_largo'];

        $id_papel_Emp = intval($aJson['papel_Emp']['id_papel']);

        $aOffEmp      = [];
        $aOff_maq_Emp = [];
        $aDigEmp      = [];
        $aSerEmp      = [];

        // boton impresion
        if ($num_rows > 0) {

            for ($i = 0; $i < $num_rows; $i++) {

                $Nombre_proceso         = "";
                $laminas_db_tmp         = "";
                $laminas_db_num_color   = 0;
                $arreglo_db_tmp         = "";
                $tiro_db_tmp            = "";
                $pantone_db_tmp         = "";
                $arreglo_pantone_db_tmp = "";

                $num_tintas                        = 0;
                $costo_unitario_laminas            = 0;
                $costo_laminas_offset              = 0;
                $arreglo_tiraje_max                = 0;
                $arreglo_num_color                 = 0;
                $arreglo_costo_unitario            = 0;
                $costo_arreglo_offset              = 0;
                $tiro_por_millar                   = 0;
                $costo_unitario_tiro               = 0;
                $alfa                              = 0;
                $costo_tiro_offset                 = 0;
                $pantone_tiraje_max                = 0;
                $pantone_por_millar                = 0;
                $costo_unitario_pantone            = 0;
                $costo_pantone_offset              = 0;
                $arreglo_pantone_color             = 0;
                $costo_unitario_arreglo_de_pantone = 0;
                $costo_arreglo_de_pantone          = 0;
                $maquila_por_millar                = 0;


                $i = intval($i);

                $Nombre_proceso = $Tipo_proceso_tmp[$i]["Tipo_impresion"];


                $cortes_por_pliego = intval($aJson[$nomb_inner]['corte']);
                $costo_unit_papel  = floatval($aJson[$nomb_inner]["costo_unit_papel"]);

                if ($Nombre_proceso == "Offset") {

                    $es_offset = true;

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    // merma offset
                    $cantidad_offset = $tiraje;

                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);


                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);


                    $Tipo_impresion = $Tipo_proceso_tmp[$i]['Tipo_impresion'];
                    $tipo_offset    = $Tipo_proceso_tmp[$i]['tipo_offset'];

                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $offset_tiro = parent::calculoOffset("Tiro", $id_papel_Emp, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }


                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = parent::calculoOffset("Tiro Pantone", $id_papel_Emp, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        if (!self::checaCostos($offset_tiro, "Offset")) {

                            self::mError($aJson, $mensaje, $error . "Offset(Empalme del Cajon);");
                        }

                        $aOffEmp[$i] = $offset_tiro;

                        $aOffEmp[$i]["mermas"] = $aMerma;

                        $aJson['Imp_EmpCaj'] += $offset_tiro['costo_tot_proceso'];
                        $subtotal            += $offset_tiro['costo_tot_proceso'];

                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $aOff_maq_Emp[$i] = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                        $aJson['Imp_EmpCaj_maq'] += $aOff_maq_Emp[$i]['costo_tot_proceso'];
                        $subtotal                += $aOff_maq_Emp[$i]['costo_tot_proceso'];

                        if (!self::checaCostos($aOff_maq_Emp[$i], "Offset_Maquila")) {

                            $self::mError($aJson, $mensaje, $error .  "Offset Maquila(Empalme del Cajon);");
                        }
                    }
                }


                if ($Nombre_proceso == "Digital") {

                    //$nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_digital'];
                    //$nombre_tipo_offset = utf8_encode(trim(strval($nombre_tipo_offset)));

                    $corte_ancho_proceso = $papel_corte_ancho;
                    $corte_largo_proceso = $papel_corte_largo;


                    $tam0 = self::calcTamDigital($corte_ancho_proceso, $corte_largo_proceso);


                    $tam          = "";
                    $tam1         = 0;
                    $nomb_tam_emp = "";

                    if (count($tam0) > 0) {

                        $tam          = $tam0[0];
                        $tam1         = $tam0[1];
                        $nomb_tam_emp = $tam0['tipo_digital'];
                    }


                    $aDigEmp[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ( $tam1 ) {

                        //$papel_digital =  calculaPapel("BCaj", $id_papel, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

                        $aJson['Imp_EmpCaj'] += $aDigEmp[$i]['costo_tot_proceso'];
                        $subtotal            += $aDigEmp[$i]['costo_tot_proceso'];

                        if ($aDigEmp[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "Digital. No cabe con las medidas proporcionadas (Base del cajon);");
                        } elseif (!self::checaCostos($aDigEmp[$i], "Digital")) {

                            self::mError($aJson, $mensaje, "Digital. No existe costo (Empalme del cajon);");
                        }
                    } else {

                        self::mError($aJson, $mensaje, "Digital. No cabe con las medidas proporcionadas en Empalme del cajon;");
                    }
                }


                if ($Nombre_proceso === "Serigrafia") {

                    $costo_unitario_serigrafia = 0;
                    $merma_serigrafia          = 0;
                    $cantidad_serigrafia       = 0;

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $tipo_offset_serigrafia = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $tipo_offset_serigrafia = self::strip_slashes_recursive($tipo_offset_serigrafia);

                    $cortes_pliego = intval($aJson['cortes'][$nomb_inner]);

                    $costo_unit_papel = floatval($aJson[$nomb_inner]['costo_unit_papel']);


                    $aSerEmp[$i] = self::calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    $aJson['Imp_EmpCaj'] += $aSerEmp[$i]['costo_tot_proceso'];
                    $subtotal            += $aSerEmp[$i]['costo_tot_proceso'];

                    if ( !self::checaCostos($aSerEmp[$i], "Serigrafia") ) {

                            self::mError($aJson, $mensaje, $error . "Serigrafia(Base del Cajon);");
                    }


                    $aSerEmp[$i]['mermas'] = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);
                }
            }
        }


        if (count($aOffEmp) > 0) {

            $aOffEmp_R = array_values($aOffEmp);

            $aJson['aImpEmp']['Offset'] = $aOffEmp_R;

            $NombProcesos = $NombProcesos . "cot_reg_offsetempcaj;";

            unset($aOffEmp);
            unset($aOffEmp_R);
        }


        if (count($aOff_maq_Emp) > 0) {

            $aOff_maq_Emp_R = array_values($aOff_maq_Emp);

            $aJson['aImpEmp']['Maquila'] = $aOff_maq_Emp_R;

            $NombProcesos = $NombProcesos . "cot_reg_offset_maq_empcaj;";

            unset($aOff_maq_Emp);
            unset($aOff_maq_Emp_R);
        }


        if (count($aDigEmp) > 0) {

            $aDigEmp_R = array_values($aDigEmp);

            $aJson['aImpEmp']['Digital'] = $aDigEmp_R;

            $NombProcesos = $NombProcesos . "cot_reg_digempcaj;";

            unset($aDigEmp);
            unset($aDigEmp_R);
        }


        if (count($aSerEmp) > 0) {

            $aSerEmp_R = array_values($aSerEmp);

            $aJson['aImpEmp']['Serigrafia'] = $aSerEmp_R;

            $NombProcesos = $NombProcesos . "cot_reg_serempcaj;";

            unset($aSerEmp);
            unset($aSerEmp_R);
        }


        if (is_array($Tipo_proceso_tmp)) {

            unset($Tipo_proceso_tmp);
        }



    /******************* Termina los calculos de la Empalme del Cajon ***************/


    /*************** Inicia los calculos de Forro del cajon ***************/


        $secc_sufijo = "FCaj";
        $nomb_inner  = "papel_" . $secc_sufijo;

        // Forro del Cajon
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpFC'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);

        $num_rows = count($Tipo_proceso_tmp2);


        $a_tmp             = $aJson[$nomb_inner];
        $a_tmp_calculadora = $a_tmp['calculadora'];

        $papel_corte_ancho = $a_tmp_calculadora['corte_ancho'];
        $papel_corte_largo = $a_tmp_calculadora['corte_largo'];

        $cortes_por_pliego = intval($aJson[$nomb_inner]['corte']);
        $costo_unit_papel  = floatval($aJson[$nomb_inner]["costo_unit_papel"]);

        $aOffFCaj      = [];
        $aOff_maq_FCaj = [];
        $aDigFCaj      = [];
        $aSerFCaj      = [];


        if ($num_rows > 0) {

            for ($i = 0; $i < $num_rows; $i++) {

                $Nombre_proceso         = "";
                $laminas_db_tmp         = "";
                $laminas_db_num_color   = 0;
                $arreglo_db_tmp         = "";
                $tiro_db_tmp            = "";
                $pantone_db_tmp         = "";
                $arreglo_pantone_db_tmp = "";

                $num_tintas                        = 0;
                $costo_unitario_laminas            = 0;
                $costo_laminas_offset              = 0;
                $arreglo_tiraje_max                = 0;
                $arreglo_num_color                 = 0;
                $arreglo_costo_unitario            = 0;
                $costo_arreglo_offset              = 0;
                $tiro_por_millar                   = 0;
                $costo_unitario_tiro               = 0;
                $alfa                              = 0;
                $costo_tiro_offset                 = 0;
                $pantone_tiraje_max                = 0;
                $pantone_por_millar                = 0;
                $costo_unitario_pantone            = 0;
                $costo_pantone_offset              = 0;
                $arreglo_pantone_color             = 0;
                $costo_unitario_arreglo_de_pantone = 0;
                $costo_arreglo_de_pantone          = 0;
                $maquila_por_millar                = 0;


                $i = intval($i);

                $Nombre_proceso = $Tipo_proceso_tmp[$i]["Tipo_impresion"];


                if ($Nombre_proceso == "Offset") {

                    $es_offset = true;

                    // merma offset
                    $cantidad_offset = $tiraje;

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    //$nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);


                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);


                    $cortes_por_pliego = intval($aJson[$nomb_inner]['corte']);
                    $costo_unit_papel  = floatval($aJson[$nomb_inner]["costo_unit_papel"]);


                    $Tipo_impresion = $Tipo_proceso_tmp[$i]['Tipo_impresion'];
                    $tipo_offset    = $Tipo_proceso_tmp[$i]['tipo_offset'];


                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);


                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_FCaj, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }


                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_FCaj, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        if (!self::checaCostos($offset_tiro, "Offset")) {

                                self::mError($aJson, $mensaje, $error . "Offset(Forro del Cajon);");
                        }

                        $aOffFCaj[$i]           = $offset_tiro;
                        $aOffFCaj[$i]["mermas"] = $aMerma;

                        $aJson['Imp_FCaj'] += $aOffFCaj[$i]['costo_tot_proceso'];
                        $subtotal          += $aOffFCaj[$i]['costo_tot_proceso'];

                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $aOff_maq_FCaj[$i] = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                        $aJson['Imp_FCaj_maq'] += $aOff_maq_FCaj[$i]['costo_tot_proceso'];
                        $subtotal              += $aOff_maq_FCaj[$i]['costo_tot_proceso'];

                        if (!self::checaCostos($aOff_maq_FCaj[$i], "Offset_Maquila")) {

                            self::mError($aJson, $mensaje, $error .  "Offset Maquila(Forro del cajon);");
                        }
                    }
                }


                if ($Nombre_proceso == "Digital") {

                    $corte_ancho_proceso = $papel_corte_ancho;
                    $corte_largo_proceso = $papel_corte_largo;


                    $tam0 = self::calcTamDigital($corte_ancho_proceso, $corte_largo_proceso);


                    $tam          = "";
                    $tam1         = 0;
                    $nomb_tam_emp = "";

                    if (count($tam0) > 0) {

                        $tam          = $tam0[0];
                        $tam1         = $tam0[1];
                        $nomb_tam_emp = $tam0['tipo_digital'];
                    }

                        $aDigFCaj[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ( $tam1 ) {

                        $aJson['Imp_FCaj'] += $aDigFCaj[$i]['costo_tot_proceso'];
                        $subtotal          += $aDigFCaj[$i]['costo_tot_proceso'];

                        if ($aDigFCaj[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "No cabe con las medidas proporcionadas (Forro del cajon);");
                        } elseif (!self::checaCostos($aDigFCaj[$i], "Digital")) {

                            self::mError($aJson, $mensaje, $error . "Digital (Forro del cajon);");
                        }
                    } else {

                        if ($aDigFCaj[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "No cabe con las medidas proporcionadas (Forro del cajon);");
                        } elseif (!self::checaCostos($aDigFCaj[$i], "Digital")) {

                            self::mError($aJson, $mensaje, $error . "Digital (Forro del cajon);");
                        }
                    }
                }


                if ($Nombre_proceso === "Serigrafia") {

                    $costo_unitario_serigrafia = 0;
                    $merma_serigrafia          = 0;
                    $cantidad_serigrafia       = 0;

                    $tipo_offset_serigrafia = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $tipo_offset_serigrafia = self::strip_slashes_recursive($tipo_offset_serigrafia);

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $cortes_pliego    = intval($aJson['cortes'][$nomb_inner]);
                    $costo_unit_papel = floatval($aJson[$nomb_inner]['costo_unit_papel']);

                    $aSerFCaj[$i] = self::calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);


                    $aJson['Imp_FCaj'] += $aSerFCaj[$i]['costo_tot_proceso'];
                    $subtotal          += $aSerFCaj[$i]['costo_tot_proceso'];

                    if ( !self::checaCostos($aSerFCaj[$i], "Serigrafia") ) {

                            self::mError($aJson, $mensaje, $error . "Serigrafia(Forro del Cajon);");
                    }


                    $Merma_Ser_tmp = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);

                    $aSerFCaj[$i]["mermas"] = $Merma_Ser_tmp;


                    if (is_array($Merma_Ser_tmp)) {

                        unset($Merma_Ser_tmp);
                    }
                }
            }
        }


        if (count($aOffFCaj) > 0) {

            $aOffFCaj_R = array_values($aOffFCaj);

            $aJson['aImpFCaj']['Offset'] = $aOffFCaj_R;

            $NombProcesos = $NombProcesos . "cot_reg_offsetfcaj;";

            unset($aOffFCaj);
            unset($aOffFCaj_R);
        }


        if (count($aOff_maq_FCaj) > 0) {

            $aOff_maq_FCaj_R = array_values($aOff_maq_FCaj);

            $aJson['aImpFCaj']['Maquila'] = $aOff_maq_FCaj_R;

            $NombProcesos = $NombProcesos . "cot_reg_offset_maq_fcaj;";

            unset($aOff_maq_FCaj);
            unset($aOff_maq_FCaj_R);
        }

        if (count($aDigFCaj) > 0) {

            $aDigFCaj_R = array_values($aDigFCaj);

            $aJson['aImpFCaj']['Digital'] = $aDigFCaj_R;

            $NombProcesos = $NombProcesos . "cot_reg_digfcaj;";

            unset($aDigFCaj);
            unset($aDigFCaj_R);
        }


        if (count($aSerFCaj) > 0) {

            $aSerFCaj_R = array_values($aSerFCaj);

            $aJson['aImpFCaj']['Serigrafia'] = $aSerFCaj_R;

            $NombProcesos = $NombProcesos . "cot_reg_serfcaj;";

            unset($aSerFCaj);
            unset($aSerFCaj_R);
        }


        if (is_array($Tipo_proceso_tmp)) {

            unset($Tipo_proceso_tmp);
        }



    /******************* Termina los calculos Forro del Cajon ***********/



    /******************* Inicia los calculos Empalme de la Tapa **********/


        $num_rows                          = 0;
        $costo_corte                       = 0;
        $costo_offset                      = 0;
        $costo_offset_laminas              = 0;
        $costo_offset_arreglo              = 0;
        $costo_offset_tiro                 = 0;
        $costo_offset_pantone              = 0;
        $costo_offset_arreglo_pantone      = 0;
        $costo_offset_maquila              = 0;
        $costo_offset_maquila_lamina       = 0;
        $costo_offset_maquila_pantone      = 0;
        $costo_unitario_serigrafia         = 0;
        $costo_unitario_arreglo_serigrafia = 0;
        $costo_arreglo_serigrafia          = 0;
        $costo_total_serigrafia            = 0;
        $costo_serigrafia_total            = 0;
        $costo_serigrafia_arreglo          = 0;
        $costo_unitario_digital            = 0;
        $costo_tot_digital                 = 0;
        $costo_digital_frente              = 0;
        $cantidad_serigrafia               = 0;
        $cantidad_digital                  = 0;
        $costo_maquila_lamina              = 0;
        $costo_serigrafia                  = 0;
        $costo_maquila                     = 0;


        $aOffEmpTap      = [];
        $aOff_maq_EmpTap = [];
        $aDigEmpTap      = [];
        $aSerEmpTap      = [];


        $secc_sufijo = "EmpTap";
        $nomb_inner  = "papel_" . $secc_sufijo;

        // Empalme de la Tapa
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpET'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);

        $cortes_por_pliego = intval($aJson[$nomb_inner]['corte']);
        $costo_unit_papel  = floatval($aJson[$nomb_inner]["costo_unit_papel"]);

        $num_rows = count($Tipo_proceso_tmp2);


        $a_tmp             = $aJson[$nomb_inner];
        $a_tmp_calculadora = $a_tmp['calculadora'];

        $papel_corte_ancho = $a_tmp_calculadora['corte_ancho'];
        $papel_corte_largo = $a_tmp_calculadora['corte_largo'];


        // boton impresion
        if ($num_rows > 0) {

            for ($i = 0; $i < $num_rows; $i++) {

                $Nombre_proceso         = "";
                $laminas_db_tmp         = "";
                $laminas_db_num_color   = 0;
                $arreglo_db_tmp         = "";
                $tiro_db_tmp            = "";
                $pantone_db_tmp         = "";
                $arreglo_pantone_db_tmp = "";

                $num_tintas                        = 0;
                $costo_unitario_laminas            = 0;
                $costo_laminas_offset              = 0;
                $arreglo_tiraje_max                = 0;
                $arreglo_num_color                 = 0;
                $arreglo_costo_unitario            = 0;
                $costo_arreglo_offset              = 0;
                $tiro_por_millar                   = 0;
                $costo_unitario_tiro               = 0;
                $alfa                              = 0;
                $costo_tiro_offset                 = 0;
                $pantone_tiraje_max                = 0;
                $pantone_por_millar                = 0;
                $costo_unitario_pantone            = 0;
                $costo_pantone_offset              = 0;
                $arreglo_pantone_color             = 0;
                $costo_unitario_arreglo_de_pantone = 0;
                $costo_arreglo_de_pantone          = 0;
                $maquila_por_millar                = 0;


                $i = intval($i);

                $Nombre_proceso = $Tipo_proceso_tmp[$i]["Tipo_impresion"];


                $Tipo_impresion = $Tipo_proceso_tmp[$i]['Tipo_impresion'];


                if ($Nombre_proceso == "Offset") {

                    $es_offset = true;

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    // merma offset
                    $cantidad_offset = $tiraje;

                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);


                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);


                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_EmpTap, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }


                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_EmpTap, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        if (!self::checaCostos($offset_tiro, "Offset")) {

                            self::mError($aJson, $mensaje, $error . "Offset (Empalme de la Tapa);");
                        }

                        $aOffEmpTap[$i]           = $offset_tiro;
                        $aOffEmpTap[$i]["mermas"] = $aMerma;

                        $aJson['Imp_EmpTap'] += $aOffEmpTap[$i]['costo_tot_proceso'];
                        $subtotal            += $aOffEmpTap[$i]['costo_tot_proceso'];

                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $aOff_maq_EmpTap[$i] = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                        $aJson['Imp_EmpTap_maq'] += $aOff_maq_EmpTap[$i]['costo_tot_proceso'];
                        $subtotal                += $aOff_maq_EmpTap[$i]['costo_tot_proceso'];

                        if (!self::checaCostos($aOff_maq_EmpTap[$i], "Offset_Maquila")) {

                            self::mError($aJson, $mensaje, $error .  "Offset Maquila(Empalme de la Tapa);");
                        }
                    }
                }


                if ($Nombre_proceso == "Digital") {

                    $corte_ancho_proceso = $papel_corte_ancho;
                    $corte_largo_proceso = $papel_corte_largo;

                    $tam0 = self::calcTamDigital($corte_ancho_proceso, $corte_largo_proceso);

                    $tam          = "";
                    $tam1         = 0;
                    $nomb_tam_emp = "";

                    if (count($tam0) > 0) {

                        $tam          = $tam0[0];
                        $tam1         = $tam0[1];
                        $nomb_tam_emp = $tam0['tipo_digital'];
                    }

                    $aDigEmpTap[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ( $tam1 ) {

                        $aJson['Imp_EmpTap'] += $aDigEmpTap[$i]['costo_tot_proceso'];
                        $subtotal            += $aDigEmpTap[$i]['costo_tot_proceso'];

                        if ($aDigEmpTap[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "No cabe con las medidas proporcionadas (Empalme de la Tapa);");
                        } elseif (!self::checaCostos($aDigEmpTap[$i], "Digital")) {

                            self::mError($aJson, $mensaje, $error . "Digital (Empalme de la Tapa);");
                        }
                    } else {

                        if ($aDigEmpTap[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "No cabe con las medidas proporcionadas (Empalme de la Tapa);");
                        } elseif (!self::checaCostos($aDigEmpTap[$i], "Digital")) {

                            self::mError($aJson, $mensaje, $error . "Digital (Empalme de la Tapa);");
                        }
                    }
                }


                if ($Nombre_proceso === "Serigrafia") {

                    $costo_unitario_serigrafia = 0;
                    $merma_serigrafia          = 0;
                    $cantidad_serigrafia       = 0;

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $tipo_offset_serigrafia = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $tipo_offset_serigrafia = self::strip_slashes_recursive($tipo_offset_serigrafia);

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $cortes_pliego    = intval($aJson['cortes'][$nomb_inner]);
                    $costo_unit_papel = floatval($aJson[$nomb_inner]['costo_unit_papel']);

                    $Merma_Ser_tmp = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);


                    $aSerEmpTap[$i] = self::calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);


                    $aJson['Imp_EmpTap'] += $aSerEmpTap[$i]['costo_tot_proceso'];
                    $subtotal            += $aSerEmpTap[$i]['costo_tot_proceso'];

                    if ( !self::checaCostos($aSerEmpTap[$i], "Serigrafia") ) {

                        self::mError($aJson, $mensaje, $error . "Serigrafia (Empalme de la Tapa);");
                    }

                    $aSerEmpTap[$i]["mermas"] = $Merma_Ser_tmp;


                    if (is_array($Merma_Ser_tmp)) {

                        unset($Merma_Ser_tmp);
                    }
                }
            }
        }


        if (count($aOffEmpTap) > 0) {

            $aOffEmpTap_R = array_values($aOffEmpTap);

            $aJson['aImpEmpTap']['Offset'] = $aOffEmpTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_offsetemptap;";

            unset($aOffEmpTap);
            unset($aOffEmpTap_R);
        }


        if (count($aOff_maq_EmpTap) > 0) {

            $aOff_maq_EmpTap_R = array_values($aOff_maq_EmpTap);

            $aJson['aImpEmpTap']['Maquila'] = $aOff_maq_EmpTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_offset_maq_emptap;";

            unset($aOff_maq_EmpTap);
            unset($aOff_maq_EmpTap_R);
        }


        if (count($aDigEmpTap) > 0) {

            $aDigEmpTap_R = array_values($aDigEmpTap);

            $aJson['aImpEmpTap']['Digital'] = $aDigEmpTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_digemptap;";

            unset($aDigEmpTap);
            unset($aDigEmpTap_R);
        }


        if (count($aSerEmpTap) > 0) {

            $aSerEmpTap_R = array_values($aSerEmpTap);

            $aJson['aImpEmpTap']['Serigrafia'] = $aSerEmpTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_seremptap;";

            unset($aSerEmpTap);
            unset($aSerEmpTap_R);
        }


        if (is_array($Tipo_proceso_tmp)) {

            unset($Tipo_proceso_tmp);
        }



    /***************** Termina los calculos Empalme de la Tapa ************/



    /******************* Inicia los calculos de Forro de la Tapa ********************/


        $num_rows                          = 0;
        $costo_corte                       = 0;
        $costo_offset                      = 0;
        $costo_offset_laminas              = 0;
        $costo_offset_arreglo              = 0;
        $costo_offset_tiro                 = 0;
        $costo_offset_pantone              = 0;
        $costo_offset_arreglo_pantone      = 0;
        $costo_offset_maquila              = 0;
        $costo_offset_maquila_lamina       = 0;
        $costo_offset_maquila_pantone      = 0;
        $costo_unitario_serigrafia         = 0;
        $costo_unitario_arreglo_serigrafia = 0;
        $costo_arreglo_serigrafia          = 0;
        $costo_total_serigrafia            = 0;
        $costo_serigrafia_total            = 0;
        $costo_serigrafia_arreglo          = 0;
        $costo_unitario_digital            = 0;
        $costo_tot_digital                 = 0;
        $costo_digital_frente              = 0;
        $cantidad_serigrafia               = 0;
        $cantidad_digital                  = 0;
        $costo_maquila_lamina              = 0;
        $costo_serigrafia                  = 0;
        $costo_maquila                     = 0;


        $aOffFTap      = [];
        $aOff_maq_FTap = [];
        $aDigFTap      = [];
        $aSerFTap      = [];


        $secc_sufijo = "FTap";
        $nomb_inner  = "papel_" . $secc_sufijo;

        // Circunferencia del Cajon
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpFT'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);

        $num_rows = count($Tipo_proceso_tmp2);


        $a_tmp             = $aJson[$nomb_inner];
        $a_tmp_calculadora = $a_tmp['calculadora'];

        $cortes_por_pliego = intval($aJson[$nomb_inner]['corte']);
        $costo_unit_papel  = floatval($aJson[$nomb_inner]["costo_unit_papel"]);

        $papel_corte_ancho = $a_tmp_calculadora['corte_ancho'];
        $papel_corte_largo = $a_tmp_calculadora['corte_largo'];


        // boton impresion
        if ($num_rows > 0) {

            for ($i = 0; $i < $num_rows; $i++) {

                $Nombre_proceso         = "";
                $laminas_db_tmp         = "";
                $laminas_db_num_color   = 0;
                $arreglo_db_tmp         = "";
                $tiro_db_tmp            = "";
                $pantone_db_tmp         = "";
                $arreglo_pantone_db_tmp = "";

                $num_tintas                        = 0;
                $costo_unitario_laminas            = 0;
                $costo_laminas_offset              = 0;
                $arreglo_tiraje_max                = 0;
                $arreglo_num_color                 = 0;
                $arreglo_costo_unitario            = 0;
                $costo_arreglo_offset              = 0;
                $tiro_por_millar                   = 0;
                $costo_unitario_tiro               = 0;
                $alfa                              = 0;
                $costo_tiro_offset                 = 0;
                $pantone_tiraje_max                = 0;
                $pantone_por_millar                = 0;
                $costo_unitario_pantone            = 0;
                $costo_pantone_offset              = 0;
                $arreglo_pantone_color             = 0;
                $costo_unitario_arreglo_de_pantone = 0;
                $costo_arreglo_de_pantone          = 0;
                $maquila_por_millar                = 0;


                $i = intval($i);

                $Nombre_proceso = $Tipo_proceso_tmp[$i]["Tipo_impresion"];


                if ($Nombre_proceso == "Offset") {

                    $es_offset = true;

                    // merma offset
                    $cantidad_offset = $tiraje;

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $Tipo_impresion = $Tipo_proceso_tmp[$i]['Tipo_impresion'];
                    $tipo_offset    = $Tipo_proceso_tmp[$i]['tipo_offset'];

                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);


                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);

                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_FTap, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }


                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_FTap, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        if (!self::checaCostos($offset_tiro, "Offset")) {

                            self::mError($aJson, $mensaje, $error . "Offset (Forro de la Tapa);");
                        }

                        $aOffFTap[$i]           = $offset_tiro;
                        $aOffFTap[$i]["mermas"] = $aMerma;

                        $aJson['Imp_FTap'] += $aOffFTap[$i]['costo_tot_proceso'];
                        $subtotal          += $aOffFTap[$i]['costo_tot_proceso'];


                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $aOff_maq_FTap[$i] = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);


                        $aJson['Imp_FTap_maq'] += $aOff_maq_FTap[$i]['costo_tot_proceso'];
                        $subtotal              += $aOff_maq_FTap[$i]['costo_tot_proceso'];

                        if (!self::checaCostos($aOff_maq_FTap[$i], "Offset_Maquila")) {

                            self::mError($aJson, $mensaje, $error .  "Offset Maquila(Forro de la Tapa);");
                        }
                    }
                }



                if ($Nombre_proceso == "Digital") {

                    $corte_ancho_proceso = $papel_corte_ancho;
                    $corte_largo_proceso = $papel_corte_largo;

                    $tam0 = self::calcTamDigital($corte_ancho_proceso, $corte_largo_proceso);

                    $tam          = "";
                    $tam1         = 0;
                    $nomb_tam_emp = "";

                    if (count($tam0) > 0) {

                        $tam          = $tam0[0];
                        $tam1         = $tam0[1];
                        $nomb_tam_emp = $tam0['tipo_digital'];
                    }

                    $aDigFTap[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ( $tam1 ) {

                        $aJson['Imp_FTap'] += $aDigFTap[$i]['costo_tot_proceso'];
                        $subtotal          += $aDigFTap[$i]['costo_tot_proceso'];

                        if ($aDigFTap[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "No cabe con las medidas proporcionadas (Forro de la Tapa);");
                        } elseif (!self::checaCostos($aDigFTap[$i], "Digital")) {

                            self::mError($aJson, $mensaje, $error . "Digital (Forro de la Tapa);");
                        }
                    } else {

                        if ($aDigFTap[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "No cabe con las medidas proporcionadas (Forro de la Tapa);");
                        } elseif (!self::checaCostos($aDigFTap[$i], "Digital")) {

                            self::mError($aJson, $mensaje, $error . "Digital (Forro de la Tapa);");
                        }
                    }
                }


                if ($Nombre_proceso === "Serigrafia") {

                    $costo_unitario_serigrafia = 0;
                    $merma_serigrafia          = 0;
                    $cantidad_serigrafia       = 0;

                    $tipo_offset_serigrafia = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $tipo_offset_serigrafia = self::strip_slashes_recursive($tipo_offset_serigrafia);

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $cortes_pliego = intval($aJson['cortes'][$nomb_inner]);

                    $costo_unit_papel = floatval($aJson[$nomb_inner]['costo_unit_papel']);


                    $Merma_Ser_tmp = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);


                    $aSerFTap[$i] = self::calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);


                    $aJson['Imp_FTap'] += $aSerFTap[$i]['costo_tot_proceso'];
                    $subtotal          += $aSerFTap[$i]['costo_tot_proceso'];

                    if ( !self::checaCostos($aSerFTap[$i], "Serigrafia") ) {

                        self::mError($aJson, $mensaje, $error . "Serigrafia (Forro de la Tapa;");
                    }

                    $aSerFTap[$i]["mermas"] = $Merma_Ser_tmp;


                    if (is_array($Merma_Ser_tmp)) {

                        unset($Merma_Ser_tmp);
                    }
                }
            }
        }


        if (count($aOffFTap) > 0) {

            $aOffFTap_R = array_values($aOffFTap);

            $aJson['aImpFTap']['Offset'] = $aOffFTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_offsetftap;";

            unset($aOffFTap);
            unset($aOffFTap_R);
        }


        if (count($aOff_maq_FTap) > 0) {

            $aOff_maq_FTap_R = array_values($aOff_maq_FTap);

            $aJson['aImpFTap']['Maquila'] = $aOff_maq_FTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_offset_maq_ftap;";

            unset($aOff_maq_FTap);
            unset($aOff_maq_FTap_R);
        }

        if (count($aDigFTap) > 0) {

            $aDigFTap_R = array_values($aDigFTap);

            $aJson['aImpFTap']['Digital'] = $aDigFTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_digftap;";

            unset($aDigFTap);
            unset($aDigFTap_R);
        }


        if (count($aSerFTap) > 0) {

            $aSerFTap_R = array_values($aSerFTap);

            $aJson['aImpFTap']['Serigrafia'] = $aSerFTap_R;

            $NombProcesos = $NombProcesos . "cot_reg_serftap;";

            unset($aSerFTap);
            unset($aSerFTap_R);
        }


        if (is_array($Tipo_proceso_tmp)) {

            unset($Tipo_proceso_tmp);
        }


    /****************** Termina los calculos de Forro de la Tapa ********************/


/********************** Termina boton impresion ****************************/



/********************** Inicia boton acabados ****************************/


/************************ Inicia Empalme del Cajon *******************************/


    $aEmpBUV   = [];
    $aEmpLaser = [];
    $aEmpGrab  = [];
    $aEmpHS    = [];
    $aEmpLam   = [];
    $aEmpSuaje = [];

    $aAcb = [];

    $aAcb = json_decode($_POST['aAcbEC'], true);

    $cuantos_aAcb = 0;

    $cuantos_aAcb = count($aAcb);


    $papel_costo_unit = floatval($aJson['papel_Emp']['costo_unit_papel']);
    $papel_costo_unit = round($papel_costo_unit, 4);

    $cortes = $aJson['papel_Emp']['corte'];


    for ($i = 0; $i < $cuantos_aAcb; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['Tipo_acabado']));


        if ($tipo_acabado == "Barniz UV") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['tipoGrabado']));

            $AnchoBarniz = floatval($aJson['papel_Emp']['calculadora']['corte_ancho']);
            $LargoBarniz = floatval($aJson['papel_Emp']['calculadora']['corte_largo']);


            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $AnchoBarniz = floatval($aAcb[$i]['Ancho']);
                $LargoBarniz = floatval($aAcb[$i]['Largo']);
            }

            $barniz_tmp = self::calculoBarniz($tipoGrabado, $tiraje, $AnchoBarniz, $LargoBarniz, $ventas_model);


            $merma_Acab = $ventas_model->merma_acabados("Barniz UV");

            foreach ($merma_Acab as $row) {

                $cantidad_minima = intval($row['cantidad_minima']);
                $cantidad        = intval($row['cantidad']);
                $por_cada_x      = intval($row['por_cada_x']);
                $adicional       = intval($row['adicional']);
            }


            if (is_array($merma_Acab)) {

                unset($merma_Acab);
            }


            // calcula la merma de acabados
            $merma_HS_tmp = self:: calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

            $merma_tot_pliegos = intval($merma_HS_tmp[2]);
            $merma_cortes      = $cortes;


            $tot_pliegos = self::Deltax($merma_tot_pliegos, $merma_cortes);

            $costo_tot_pliegos_merma = floatval($papel_costo_unit * $tot_pliegos);
            $costo_tot_pliegos_merma = round($costo_tot_pliegos_merma, 2);

            $aMerma_BUV = [];

            $aMerma_BUV['merma_min']               = $merma_HS_tmp[0];
            $aMerma_BUV['merma_adic']              = $merma_HS_tmp[1];
            $aMerma_BUV['merma_tot']               = $merma_HS_tmp[2];
            $aMerma_BUV['cortes_por_pliego']       = $merma_cortes;
            $aMerma_BUV['merma_tot_pliegos']       = $tot_pliegos;
            $aMerma_BUV['costo_unit_merma']        = $papel_costo_unit;
            $aMerma_BUV['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;


            if ( !self::checaCostos($barniz_tmp,"Barniz") ) {

                self::mError($aJson, $mensaje, $error . "Barniz UV (Empalme del cajon);");
            }

            $aEmpBUV[$i] = $barniz_tmp;


            $aJson['Acb_EmpFCaj'] += $aEmpBUV[$i]['costo_tot_proceso'];
            $subtotal             += $aEmpBUV[$i]['costo_tot_proceso'];

            $aEmpBUV[$i]['mermas'] = $aMerma_BUV;


            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }

        }


        if ($tipo_acabado == "Corte Laser") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['tipoGrabado']));

            $costo_laser_tmp = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            if ( !self::checaCostos($costo_laser_tmp,"Laser") ) {

                self::mError($aJson, $mensaje, $error . "Corte Laser (Empalme del cajon);");
            }


            $aEmpLaser[$i] = $costo_laser_tmp;

            $aJson['Acb_EmpFCaj'] += $aEmpLaser[$i]['costo_tot_proceso'];
            $subtotal             += $aEmpLaser[$i]['costo_tot_proceso'];

            if (is_array($costo_laser_tmp)) {

                unset($costo_laser_tmp);
            }
        }


        if ($tipo_acabado == "Grabado") {

            $tipoGrabado   = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['tipoGrabado']));
            $LargoGrab     = floatval($aAcb[$i]['Largo']);
            $AnchoGrab     = floatval($aAcb[$i]['Ancho']);
            $ubicacionGrab = $aAcb[$i]['ubicacion'];

            $papel_seccion        = intval($aJson['cortes']['papel_Emp']);
            $papel_costo_unit_tmp = floatval($aJson['papel_Emp']['costo_unit_papel']);


            $grabado_temp = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);


            if ( !self::checaCostos($grabado_temp,"Grabado") ) {

                self::mError($aJson, $mensaje, $error . "Grabado (Empalme del cajon);");
            }

            $aEmpGrab[$i] = $grabado_temp;


            $aJson['Acb_EmpFCaj'] += $aEmpGrab[$i]['costo_tot_proceso'];
            $subtotal             += $aEmpGrab[$i]['costo_tot_proceso'];

            if (is_array($grabado_temp)) {

                unset($grabado_temp);
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $tipoGrabado = self::strip_slashes_recursive($aAcb[$i]['tipoGrabado']);
            $LargoHS     = round(floatval($aAcb[$i]['LargoHS']), 2);
            $AnchoHS     = round(floatval($aAcb[$i]['AnchoHS']), 2);
            $ColorHS     = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['ColorHS']));

            $papel_seccion        = intval($aJson['cortes']['papel_Emp']);
            $papel_costo_unit_tmp = floatval($aJson['papel_Emp']['costo_unit_papel']);


            $grabado_HS_temp = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);

            if ( !self::checaCostos($grabado_HS_temp,"HotStamping") ) {

                self::mError($aJson, $mensaje, $error . "HotStamping (Empalme del cajon);");
            }

            $aEmpHS[$i] = $grabado_HS_temp;


            $aJson['Acb_EmpFCaj'] += $aEmpHS[$i]['costo_tot_proceso'];
            $subtotal             += $aEmpHS[$i]['costo_tot_proceso'];

            if (is_array($grabado_HS_temp)) {

                unset($grabado_HS_temp);
            }
        }


        if ($tipo_acabado == "Laminado") {

            $tipoGrabado = self::strip_slashes_recursive($aAcb[$i]['tipo']);
            $LargoLam    = floatval($aJson['papel_Emp']['calculadora']['corte_largo']);
            $AnchoLam    = floatval($aJson['papel_Emp']['calculadora']['corte_ancho']);

            $papel_costo_unit = $aJson['papel_Emp']['costo_unit_papel'];
            $cortes           = $aJson['cortes']['papel_Emp'];

            $Laminado_tmp = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);


            if ( !self::checaCostos($Laminado_tmp,"Laminado") ) {

                self::mError($aJson, $mensaje, $error . "Laminado (Empalme del cajon);");
            }

            $aEmpLam[$i] = $Laminado_tmp;


            $aJson['Acb_EmpFCaj'] += $aEmpLam[$i]['costo_tot_proceso'];
            $subtotal             += $aEmpLam[$i]['costo_tot_proceso'];

            if (count($Laminado_tmp) > 0) {

                unset($Laminado_tmp);
            }
        }


        if ($tipo_acabado == "Suaje") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['tipoGrabado']));
            $Largo       = round(floatval($aAcb[$i]['LargoSuaje']), 2);
            $Ancho       = round(floatval($aAcb[$i]['AnchoSuaje']),2);

            $aAcbSuaje_tmp = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);

            if ( !self::checaCostos($aAcbSuaje_tmp,"Suaje") ) {

                self::mError($aJson, $mensaje, $error . "Suaje (Empalme del cajon);");
            }

            $aEmpSuaje[$i] = $aAcbSuaje_tmp;


            $aJson['Acb_EmpFCaj'] += $aEmpSuaje[$i]['costo_tot_proceso'];
            $subtotal             += $aEmpSuaje[$i]['costo_tot_proceso'];
        }
    }


    if (count($aEmpBUV) > 0) {

        $aEmpBUV_R = array_values($aEmpBUV);

        $aJson['aAcbEmp']['Barniz_UV'] = $aEmpBUV_R;

        $NombProcesos = $NombProcesos . "cot_reg_barnizuvempcaj;";

        unset($aEmpBUV);
        unset($aEmpBUV_R);
    }


    if (count($aEmpLaser) > 0) {

        $aEmpLaser_R = array_values($aEmpLaser);

        $aJson['aAcbEmp']['Corte_Laser'] = $aEmpLaser_R;

        $NombProcesos = $NombProcesos . "cot_reg_laserempcaj;";

        unset($aEmpLaser);
        unset($aEmpLaser_R);
    }


    if (count($aEmpGrab) > 0) {

        $aEmpGrab_R = array_values($aEmpGrab);

        $aJson['aAcbEmp']['Grabado'] = $aEmpGrab_R;

        $NombProcesos = $NombProcesos . "cot_reg_grabempcaj;";

        unset($aEmpGrab);
        unset($aEmpGrab_R);
    }


    if (count($aEmpHS) > 0) {

        $aEmpHS_R = array_values($aEmpHS);

        $aJson['aAcbEmp']['HotStamping'] = $aEmpHS_R;

        $NombProcesos = $NombProcesos . "cot_reg_hsempcaj;";

        unset($aEmpHS);
        unset($aEmpHS_R);
    }


    if (count($aEmpLam) > 0) {

        $aEmpLam_R = array_values($aEmpLam);

        $aJson['aAcbEmp']['Laminado'] = $aEmpLam_R;

        $NombProcesos = $NombProcesos . "cot_reg_lamempcaj;";

        unset($aEmpLam);
        unset($aEmpLam_R);
    }


    if (count($aEmpSuaje) > 0) {

        $aEmpSuaje_R = array_values($aEmpSuaje);

        $aJson['aAcbEmp']['Suaje'] = $aEmpSuaje_R;

        $NombProcesos = $NombProcesos . "cot_reg_suajeempcaj;";

        unset($aEmpSuaje);
        unset($aEmpSuaje_R);
    }


/************************ Termina Empalme del Cajon ******************************/



/************************* Inicia Forro del Cajon **********************/


    $aFCajBUV   = [];
    $aFCajLaser = [];
    $aFCajGrab  = [];
    $aFCajHS    = [];
    $aFCajLam   = [];
    $aFCajSuaje = [];


    $aAcbFCaj = [];

    $aAcbFCaj = json_decode($_POST['aAcbFC'], true);

    $cuantos_aAcb = 0;

    $cuantos_aAcb = count($aAcbFCaj);


    for ($i = 0; $i < $cuantos_aAcb; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['Tipo_acabado']));

        $papel_costo_unit = $aJson['papel_FCaj']['costo_unit_papel'];
        $papel_costo_unit_tmp = round(floatval($papel_costo_unit), 4);

        $cortes = intval($aJson['cortes']['papel_FCaj']);

        $merma_cortes = intval($aJson['papel_FCaj']['corte']);


        if ($tipo_acabado == "Barniz UV") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipoGrabado']));
            $AnchoBarniz = floatval($aJson['papel_FCaj']['calculadora']['corte_ancho']);
            $LargoBarniz = floatval($aJson['papel_FCaj']['calculadora']['corte_largo']);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $AnchoBarniz = round(floatval($aAcbFCaj[$i]['Ancho']), 2);
                $LargoBarniz = round(floatval($aAcbFCaj[$i]['Largo']), 2);
            }

            $barniz_tmp = self::calculoBarniz($tipoGrabado, $tiraje, $AnchoBarniz, $LargoBarniz, $ventas_model);

            $merma_Acab = $ventas_model->merma_acabados("Barniz UV");

            foreach ($merma_Acab as $row) {

                $cantidad_minima = intval($row['cantidad_minima']);
                $cantidad        = intval($row['cantidad']);
                $por_cada_x      = intval($row['por_cada_x']);
                $adicional       = intval($row['adicional']);
            }


            if (is_array($merma_Acab)) {

                unset($merma_Acab);
            }


            // calcula la merma de acabados
            $merma_tmp = self:: calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

            $merma_tot_pliegos = intval($merma_tmp[2]);

            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $merma_cortes);


            $costo_tot_pliegos_merma = floatval($papel_costo_unit * $tot_pliegos);
            $costo_tot_pliegos_merma = round($costo_tot_pliegos_merma, 2);

            $aMerma_BUV = [];

            $aMerma_BUV['merma_min']               = $merma_tmp[0];
            $aMerma_BUV['merma_adic']              = $merma_tmp[1];
            $aMerma_BUV['merma_tot']               = $merma_tmp[2];
            $aMerma_BUV['cortes_por_pliego']       = $merma_cortes;
            $aMerma_BUV['merma_tot_pliegos']       = $tot_pliegos;
            $aMerma_BUV['costo_unit_merma']        = $papel_costo_unit;
            $aMerma_BUV['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;

            if ( !self::checaCostos($barniz_tmp,"Barniz") ) {

                self::mError($aJson, $mensaje, $error . "Barniz UV (Forro del cajon);");
            }

            $aFCajBUV[$i]           = $barniz_tmp;
            $aFCajBUV[$i]['mermas'] = $aMerma_BUV;


            $aJson['Acb_FCaj'] += $aFCajBUV[$i]['costo_tot_proceso'];
            $subtotal          += $aFCajBUV[$i]['costo_tot_proceso'];

            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }

        }


        if ($tipo_acabado == "Corte Laser") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipoGrabado']));

            $aFCajLaser[$i] = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);


            $aJson['Acb_FCaj'] += $aFCajLaser[$i]['costo_tot_proceso'];
            $subtotal          += $aFCajLaser[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFCajLaser[$i],"Laser") ) {

                self::mError($aJson, $mensaje, $error . "Corte Laser (Forro del cajon);");
            }
        }


        if ($tipo_acabado == "Grabado") {

            $tipoGrabado   = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipoGrabado']));
            $LargoGrab     = round(floatval($aAcbFCaj[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcbFCaj[$i]['Ancho']), 2);
            $ubicacionGrab = trim($aAcbFCaj[$i]['ubicacion']);


            $aFCajGrab[$i] = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $cortes, $papel_costo_unit, $ventas_model);


            $aJson['Acb_FCaj'] += $aFCajGrab[$i]['costo_tot_proceso'];
            $subtotal          += $aFCajGrab[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFCajGrab[$i],"Grabado") ) {

                self::mError($aJson, $mensaje, $error . "Grabado (Forro del cajon);");
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipoGrabado']));
            $LargoHS     = round(floatval($aAcbFCaj[$i]['LargoHS']), 2);
            $AnchoHS     = round(floatval($aAcbFCaj[$i]['AnchoHS']), 2);
            $ColorHS     = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['ColorHS']));


            $aFCajHS[$i] = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $cortes, $papel_costo_unit, $ventas_model);


            $aJson['Acb_FCaj'] += $aFCajHS[$i]['costo_tot_proceso'];
            $subtotal          += $aFCajHS[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFCajHS[$i],"HotStamping") ) {

                self::mError($aJson, $mensaje, $error . "HotStamping (Forro del cajon);");
            }
        }


        if ($tipo_acabado == "Laminado") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipo']));
            $LargoLam    = floatval($aJson['papel_FCaj']['calculadora']['corte_largo']);
            $AnchoLam    = floatval($aJson['papel_FCaj']['calculadora']['corte_ancho']);

            $papel_costo_unit = floatval($aJson['papel_FCaj']['costo_unit_papel']);


            $aFCajLam[$i] = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);


            $aJson['Acb_FCaj'] += $aFCajLam[$i]['costo_tot_proceso'];
            $subtotal          += $aFCajLam[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFCajLam[$i],"Laminado") ) {

                self::mError($aJson, $mensaje, $error . "Laminado (Forro del cajon);");
            }
        }


        if ($tipo_acabado == "Suaje") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipoGrabado']));
            $Largo       = round(floatval($aAcbFCaj[$i]['LargoSuaje']), 2);
            $Ancho       = round(floatval($aAcbFCaj[$i]['AnchoSuaje']), 2);

            $cortes = $aJson['cortes']['papel_FCaj'];

            $aFCajSuaje[$i] = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);


            $aJson['Acb_FCaj'] += $aFCajSuaje[$i]['costo_tot_proceso'];
            $subtotal          += $aFCajSuaje[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFCajSuaje[$i],"Suaje") ) {

                self::mError($aJson, $mensaje, $error . "Suaje (Forro del cajon);");
            }
        }
    }



    if (count($aFCajBUV) > 0) {

        $aFCajBUV_R = array_values($aFCajBUV);

        $aJson['aAcbFCaj']['Barniz_UV'] = $aFCajBUV_R;

        $NombProcesos = $NombProcesos . "cot_reg_barnizuvfcaj;";

        unset($aFCajBUV);
        unset($aFCajBUV_R);
    }


    if (count($aFCajLaser) > 0) {

        $aFCajLaser_R = array_values($aFCajLaser);

        $aJson['aAcbFCaj']['Corte_Laser'] = $aFCajLaser_R;

        $NombProcesos = $NombProcesos . "cot_reg_laserfcaj;";

        unset($aFCajLaser);
        unset($aFCajLaser_R);
    }


    if (count($aFCajGrab) > 0) {

        $aFCajGrab_R = array_values($aFCajGrab);

        $aJson['aAcbFCaj']['Grabado'] = $aFCajGrab_R;

        $NombProcesos = $NombProcesos . "cot_reg_grabfcaj;";

        unset($aFCajGrab);
        unset($aFCajGrab_R);
    }


    if (count($aFCajHS) > 0) {

        $aFCajHS_R = array_values($aFCajHS);

        $aJson['aAcbFCaj']['HotStamping'] = $aFCajHS_R;

        $NombProcesos = $NombProcesos . "cot_reg_hsfcaj;";

        unset($aFCajHS);
        unset($aFCajHS_R);
    }


    if (count($aFCajLam) > 0) {

        $aFCajLam_R = array_values($aFCajLam);

        $aJson['aAcbFCaj']['Laminado'] = $aFCajLam_R;

        $NombProcesos = $NombProcesos . "cot_reg_lamfcaj;";

        unset($aFCajLam);
        unset($aFCajLam_R);
    }


    if (count($aFCajSuaje) > 0) {

        $aFCajSuaje_R = array_values($aFCajSuaje);

        $aJson['aAcbFCaj']['Suaje'] = $aFCajSuaje_R;

        $NombProcesos = $NombProcesos . "cot_reg_suajefcaj;";

        unset($aFCajSuaje);
        unset($aFCajSuaje_R);
    }


/************************* Termina Forro del Cajon *********************/



/************************* Inicia Empalme de la Tapa ******************/


    $aEmpTapBUV   = [];
    $aEmpTapLaser = [];
    $aEmpTapGrab  = [];
    $aEmpTapHS    = [];
    $aEmpTapLam   = [];
    $aEmpTapSuaje = [];


    $aAcbEmpTap = [];

    $aAcbEmpTap = json_decode($_POST['aAcbET'], true);

    $cuantos_aAcb = 0;

    $cuantos_aAcb = count($aAcbEmpTap);


    for ($i = 0; $i < $cuantos_aAcb; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['Tipo_acabado']));

        $papel_costo_unit = $aJson['papel_EmpTap']['costo_unit_papel'];
        $papel_costo_unit = round(floatval($papel_costo_unit), 4);

        $cortes = intval($aJson['cortes']['papel_EmpTap']);


        if ($tipo_acabado == "Barniz UV") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['tipoGrabado']));
            $AnchoBarniz = floatval($aJson['papel_EmpTap']['calculadora']['corte_ancho']);
            $LargoBarniz = floatval($aJson['papel_EmpTap']['calculadora']['corte_largo']);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $AnchoBarniz = round(floatval($aAcbEmpTap[$i]['Ancho']), 2);
                $LargoBarniz = round(floatval($aAcbEmpTap[$i]['Largo']), 2);
            }

            $barniz_tmp = self::calculoBarniz($tipoGrabado, $tiraje, $AnchoBarniz, $LargoBarniz, $ventas_model);

            $merma_Acab = $ventas_model->merma_acabados("Barniz UV");

            foreach ($merma_Acab as $row) {

                $cantidad_minima = intval($row['cantidad_minima']);
                $cantidad        = intval($row['cantidad']);
                $por_cada_x      = intval($row['por_cada_x']);
                $adicional       = intval($row['adicional']);
            }


            if (is_array($merma_Acab)) {

                unset($merma_Acab);
            }


            // calcula la merma de acabados
            $merma_tmp = self:: calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

            $merma_tot_pliegos = intval($merma_tmp[2]);

            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $cortes);


            $costo_tot_pliegos_merma = floatval($papel_costo_unit * $tot_pliegos);
            $costo_tot_pliegos_merma = round($costo_tot_pliegos_merma, 2);

            $aMerma_BUV = [];

            $aMerma_BUV['merma_min']               = $merma_tmp[0];
            $aMerma_BUV['merma_adic']              = $merma_tmp[1];
            $aMerma_BUV['merma_tot']               = $merma_tmp[2];
            $aMerma_BUV['cortes_por_pliego']       = $cortes;
            $aMerma_BUV['merma_tot_pliegos']       = $tot_pliegos;
            $aMerma_BUV['costo_unit_merma']        = $papel_costo_unit;
            $aMerma_BUV['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;

            if ( !self::checaCostos($barniz_tmp,"Barniz") ) {

                self::mError($aJson, $mensaje, $error . "Barniz UV (Empalme de la Tapa);");
            }

            $aEmpTapBUV[$i]           = $barniz_tmp;
            $aEmpTapBUV[$i]['mermas'] = $aMerma_BUV;


            $aJson['Acb_EmpTap'] += $aEmpTapBUV[$i]['costo_tot_proceso'];
            $subtotal            += $aEmpTapBUV[$i]['costo_tot_proceso'];


            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }

        }


        if ($tipo_acabado == "Corte Laser") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['tipoGrabado']));

            $aEmpTapLaser[$i] = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            $aJson['Acb_EmpTap'] += $aEmpTapLaser[$i]['costo_tot_proceso'];
            $subtotal            += $aEmpTapLaser[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aEmpTapLaser[$i],"Laser") ) {

                self::mError($aJson, $mensaje, $error . "Corte Laser (Empalme de la Tapa);");
            }
        }


        if ($tipo_acabado == "Grabado") {

            $tipoGrabado   = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['tipoGrabado']));
            $LargoGrab     = round(floatval($aAcbEmpTap[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcbEmpTap[$i]['Ancho']), 2);
            $ubicacionGrab = $aAcbEmpTap[$i]['ubicacion'];


            $aEmpTapGrab[$i] = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $cortes, $papel_costo_unit, $ventas_model);


            $aJson['Acb_EmpTap'] += $aEmpTapGrab[$i]['costo_tot_proceso'];
            $subtotal            += $aEmpTapGrab[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aEmpTapGrab[$i],"Grabado") ) {

                self::mError($aJson, $mensaje, $error . "Grabado (Empalme de la Tapa);");
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['tipoGrabado']));
            $LargoHS     = round(floatval($aAcbEmpTap[$i]['LargoHS']), 2);
            $AnchoHS     = round(floatval($aAcbEmpTap[$i]['AnchoHS']), 2);
            $ColorHS     = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['ColorHS']));


            $aEmpTapHS[$i] = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $cortes, $papel_costo_unit, $ventas_model);


            $aJson['Acb_EmpTap'] += $aEmpTapHS[$i]['costo_tot_proceso'];
            $subtotal            += $aEmpTapHS[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aEmpTapHS[$i],"HotStamping") ) {

                self::mError($aJson, $mensaje, "HotStamping (Empalme de la Tapa;");
            }
        }


        if ($tipo_acabado == "Laminado") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['tipo']));
            $LargoLam    = floatval($aJson['papel_EmpTap']['calculadora']['corte_largo']);
            $AnchoLam    = floatval($aJson['papel_EmpTap']['calculadora']['corte_ancho']);

            $papel_costo_unit = $aJson['papel_EmpTap']['costo_unit_papel'];
            $cortes           = $aJson['cortes']['papel_EmpTap'];

            $aEmpTapLam[$i] = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);


            $aJson['Acb_EmpTap'] += $aEmpTapLam[$i]['costo_tot_proceso'];
            $subtotal            += $aEmpTapLam[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aEmpTapLam[$i],"Laminado") ) {

                self::mError($aJson, $mensaje, $error . "Laminado (Empalme de la Tapa);");
            }
        }


        if ($tipo_acabado == "Suaje") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbEmpTap[$i]['tipoGrabado']));
            $Largo       = round(floatval($aAcbEmpTap[$i]['LargoSuaje']), 2);
            $Ancho       = round(floatval($aAcbEmpTap[$i]['AnchoSuaje']), 2);

            $cortes = $aJson['cortes']['papel_FTap'];

            $aEmpTapSuaje[$i] = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);


            $aJson['Acb_EmpTap'] += $aEmpTapSuaje[$i]['costo_tot_proceso'];
            $subtotal            += $aEmpTapSuaje[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aEmpTapSuaje[$i],"Suaje") ) {

                self::mError($aJson, $mensaje, $error . "Suaje (Empalme de la Tapa);");
            }
        }
    }


    if (count($aEmpTapBUV) > 0) {

        $aEmpTapBUV_R = array_values($aEmpTapBUV);

        $aJson['aAcbEmpTap']['Barniz_UV'] = $aEmpTapBUV_R;

        $NombProcesos = $NombProcesos . "cot_reg_barnizuvemptap;";

        unset($aEmpTapBUV);
        unset($aEmpTapBUV_R);
    }


    if (count($aEmpTapLaser) > 0) {

        $aEmpTapLaser_R = array_values($aEmpTapLaser);

        $aJson['aAcbEmpTap']['Corte_Laser'] = $aEmpTapLaser_R;

        $NombProcesos = $NombProcesos . "cot_reg_laseremptap;";

        unset($aEmpTapLaser);
        unset($aEmpTapLaser_R);
    }


    if (count($aEmpTapGrab) > 0) {

        $aEmpTapGrab_R = array_values($aEmpTapGrab);

        $aJson['aAcbEmpTap']['Grabado'] = $aEmpTapGrab_R;

        $NombProcesos = $NombProcesos . "cot_reg_grabemptap;";

        unset($aEmpTapGrab);
        unset($aEmpTapGrab_R);
    }


    if (count($aEmpTapHS) > 0) {

        $aEmpTapHS_R = array_values($aEmpTapHS);

        $aJson['aAcbEmpTap']['HotStamping'] = $aEmpTapHS_R;

        $NombProcesos = $NombProcesos . "cot_reg_hsemptap;";

        unset($aEmpTapHS);
        unset($aEmpTapHS_R);
    }


    if (count($aEmpTapLam) > 0) {

        $aEmpTapLam_R = array_values($aEmpTapLam);

        $aJson['aAcbEmpTap']['Laminado'] = $aEmpTapLam_R;

        $NombProcesos = $NombProcesos . "cot_reg_lamemptap;";

        unset($aEmpTapLam);
        unset($aEmpTapLam_R);
    }


    if (count($aEmpTapSuaje) > 0) {

        $aEmpTapSuaje_R = array_values($aEmpTapSuaje);

        $aJson['aAcbEmpTap']['Suaje'] = $aEmpTapSuaje_R;

        $NombProcesos = $NombProcesos . "cot_reg_suajeemptap;";

        unset($aEmpTapSuaje);
        unset($aEmpTapSuaje_R);
    }


/************************* Termina Empalme de la Tapa *****************/


/*********************** Inicia Forro de la Tapa **************************/


    $aFTapBUV   = [];
    $aFTapLaser = [];
    $aFTapGrab  = [];
    $aFTapHS    = [];
    $aFTapLam   = [];
    $aFTapSuaje = [];


    $aAcbFTap = [];

    $aAcbFTap = json_decode($_POST['aAcbFT'], true);

    $cuantos_aAcb = 0;

    $cuantos_aAcb = count($aAcbFTap);


    for ($i = 0; $i < $cuantos_aAcb; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['Tipo_acabado']));

        $papel_costo_unit = $aJson['papel_FTap']['costo_unit_papel'];
        $papel_costo_unit = round(floatval($papel_costo_unit), 4);

        $cortes = intval($aJson['cortes']['papel_FTap']);


        if ($tipo_acabado == "Barniz UV") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['tipoGrabado']));

            $AnchoBarniz = floatval($aJson['papel_FTap']['calculadora']['corte_ancho']);
            $LargoBarniz = floatval($aJson['papel_FTap']['calculadora']['corte_largo']);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $AnchoBarniz = round(floatval($aAcbFTap[$i]['Ancho']), 2);
                $LargoBarniz = round(floatval($aAcbFTap[$i]['Largo']), 2);
            }

            $barniz_tmp = self::calculoBarniz($tipoGrabado, $tiraje, $AnchoBarniz, $LargoBarniz, $ventas_model);

            $merma_Acab = $ventas_model->merma_acabados("Barniz UV");

            foreach ($merma_Acab as $row) {

                $cantidad_minima = intval($row['cantidad_minima']);
                $cantidad        = intval($row['cantidad']);
                $por_cada_x      = intval($row['por_cada_x']);
                $adicional       = intval($row['adicional']);
            }


            if (is_array($merma_Acab)) {

                unset($merma_Acab);
            }


            // calcula la merma de acabados
            $merma_tmp = self:: calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

            $merma_tot_pliegos = intval($merma_tmp[2]);

            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $cortes);


            $costo_tot_pliegos_merma = floatval($papel_costo_unit * $tot_pliegos);
            $costo_tot_pliegos_merma = round($costo_tot_pliegos_merma, 2);

            $aMerma_BUV = [];

            $aMerma_BUV['merma_min']               = $merma_tmp[0];
            $aMerma_BUV['merma_adic']              = $merma_tmp[1];
            $aMerma_BUV['merma_tot']               = $merma_tmp[2];
            $aMerma_BUV['cortes_por_pliego']       = $cortes;
            $aMerma_BUV['merma_tot_pliegos']       = $tot_pliegos;
            $aMerma_BUV['costo_unit_merma']        = $papel_costo_unit;
            $aMerma_BUV['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;

            if ( !self::checaCostos($barniz_tmp,"Barniz") ) {

                self::mError($aJson, $mensaje, $error . "Barniz UV (Forro de la Tapa);");
            }

            $aFTapBUV[$i]           = $barniz_tmp;
            $aFTapBUV[$i]['mermas'] = $aMerma_BUV;


            $aJson['Acb_FTap'] += $aFTapBUV[$i]['costo_tot_proceso'];
            $subtotal          += $aFTapBUV[$i]['costo_tot_proceso'];


            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }

        }


        if ($tipo_acabado == "Corte Laser") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['tipoGrabado']));

            $aFTapLaser[$i] = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            $aJson['Acb_FTap'] += $aFTapLaser[$i]['costo_tot_proceso'];
            $subtotal          += $aFTapLaser[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFTapLaser[$i],"Laser") ) {

                self::mError($aJson, $mensaje, $error . "Corte Laser (Forro de la Tap);");
            }
        }


        if ($tipo_acabado == "Grabado") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['tipoGrabado']));

            $LargoGrab     = round(floatval($aAcbFTap[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcbFTap[$i]['Ancho']), 2);
            $ubicacionGrab = trim($aAcbFTap[$i]['ubicacion']);


            $aFTapGrab[$i] = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $cortes, $papel_costo_unit, $ventas_model);


            $aJson['Acb_FTap'] += $aFTapGrab[$i]['costo_tot_proceso'];
            $subtotal          += $aFTapGrab[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFTapGrab[$i],"Grabado") ) {

                self::mError($aJson, $mensaje, $error . "Grabado (Forro de la Tapa);");
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['tipoGrabado']));

            $LargoHS = round(floatval($aAcbFTap[$i]['LargoHS']), 2);
            $AnchoHS = round(floatval($aAcbFTap[$i]['AnchoHS']), 2);
            $ColorHS = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['ColorHS']));


            $aFTapHS[$i] = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $cortes, $papel_costo_unit, $ventas_model);


            $aJson['Acb_FTap'] += $aFTapHS[$i]['costo_tot_proceso'];
            $subtotal          += $aFTapHS[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFTapHS[$i],"HotStamping") ) {

                self::mError($aJson, $mensaje, $error . "HotStamping (Forro de la Tapa);");
            }
        }


        if ($tipo_acabado == "Laminado") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['tipo']));

            $LargoLam = floatval($aJson['papel_FTap']['calculadora']['corte_largo']);
            $AnchoLam = floatval($aJson['papel_FTap']['calculadora']['corte_ancho']);

            $papel_costo_unit = $aJson['papel_FTap']['costo_unit_papel'];


            $aFTapLam[$i] = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);


            $aJson['Acb_FTap'] += $aFTapLam[$i]['costo_tot_proceso'];
            $subtotal          += $aFTapLam[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFTapLam[$i],"Laminado") ) {

                self::mError($aJson, $mensaje, $error . "Laminado (Forro de la Tapa);");
            }
        }


        if ($tipo_acabado == "Suaje") {

            $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFTap[$i]['tipoGrabado']));

            $Largo = round(floatval($aAcbFTap[$i]['LargoSuaje']), 2);
            $Ancho = round(floatval($aAcbFTap[$i]['AnchoSuaje']), 2);


            $aFTapSuaje[$i] = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);


            $aJson['Acb_FTap'] += $aFTapSuaje[$i]['costo_tot_proceso'];
            $subtotal          += $aFTapSuaje[$i]['costo_tot_proceso'];

            if ( !self::checaCostos($aFTapSuaje[$i],"Suaje") ) {

                self::mError($aJson, $mensaje, $error . "Suaje (Forro de la Tapa);");
            }
        }
    }


    if (count($aFTapBUV) > 0) {

        $aFTapBUV_R = array_values($aFTapBUV);

        $aJson['aAcbFTap']['Barniz_UV'] = $aFTapBUV_R;

        $NombProcesos = $NombProcesos . "cot_reg_barnizuvftap;";

        unset($aFTapBUV);
        unset($aFTapBUV_R);
    }


    if (count($aFTapLaser) > 0) {

        $aFTapLaser_R = array_values($aFTapLaser);

        $aJson['aAcbFTap']['Corte_Laser'] = $aFTapLaser_R;

        $NombProcesos = $NombProcesos . "cot_reg_laserftap;";

        unset($aFTapLaser);
        unset($aFTapLaser_R);
    }


    if (count($aFTapGrab) > 0) {

        $aFTapGrab_R = array_values($aFTapGrab);

        $aJson['aAcbFTap']['Grabado'] = $aFTapGrab_R;

        $NombProcesos = $NombProcesos . "cot_reg_grabftap;";

        unset($aFTapGrab);
        unset($aFTapGrab_R);
    }


    if (count($aFTapHS) > 0) {

        $aFTapHS_R = array_values($aFTapHS);

        $aJson['aAcbFTap']['HotStamping'] = $aFTapHS_R;

        $NombProcesos = $NombProcesos . "cot_reg_hsftap;";

        unset($aFTapHS);
        unset($aFTapHS_R);
    }


    if (count($aFTapLam) > 0) {

        $aFTapLam_R = array_values($aFTapLam);

        $aJson['aAcbFTap']['Laminado'] = $aFTapLam_R;

        $NombProcesos = $NombProcesos . "cot_reg_lamftap;";

        unset($aFTapLam);
        unset($aFTapLam_R);
    }


    if (count($aFTapSuaje) > 0) {

        $aFTapSuaje_R = array_values($aFTapSuaje);

        $aJson['aAcbFTap']['Suaje'] = $aFTapSuaje_R;

        $NombProcesos = $NombProcesos . "cot_reg_suajeftap;";

        unset($aFTapSuaje);
        unset($aFTapSuaje_R);
    }


/*************************** Termina Forro de la Tapa ****************************/


/**************************** Termina boton acabados *******************/




/************************* Inicia Accesorios ***************************/


    $aAccesorios_tmp = json_decode($_POST['aAccesorios'], true);
    $aAccesorios_R   = array_values($aAccesorios_tmp);

    $cuantos_aAccesorios_tmp = count($aAccesorios_tmp);


    $aAccesorios = [];

    for ($i = 0; $i < $cuantos_aAccesorios_tmp; $i++) {

        $Tipo_accesorio = "";
        $Tipo           = null;
        $Largo          = null;
        $Ancho          = null;
        $Color          = null;

        $Tipo_accesorio = utf8_encode(self::strip_slashes_recursive($aAccesorios_R[$i]['Tipo_accesorio']));
        $Tipo           = $aAccesorios_R[$i]['Herraje'];
        $Largo          = $aAccesorios_R[$i]['Largo'];
        $Ancho          = $aAccesorios_R[$i]['Ancho'];
        $Color          = $aAccesorios_R[$i]['Color'];

        $accesorio_tiraje = $tiraje;

        $aCosto_accesorio = self::calculoAccesorios($Tipo_accesorio, $tiraje, $ventas_model);


        $aAccesorios[$i]['Tipo_accesorio']       = $Tipo_accesorio;
        $aAccesorios[$i]['Tipo']                 = $Tipo;
        $aAccesorios[$i]['tiraje']               = $accesorio_tiraje;
        $aAccesorios[$i]['Largo']                = $Largo;
        $aAccesorios[$i]['Ancho']                = $Ancho;
        $aAccesorios[$i]['Color']                = $Color;
        $aAccesorios[$i]['costo_unit_accesorio'] = $aCosto_accesorio['accesorio_costo_unitario'];
        $aAccesorios[$i]['costo_tot_proceso']     = $aCosto_accesorio['costo_tot_proceso'];


        $subtotal += $aAccesorios[$i]['costo_tot_proceso'];

        if ($aCosto_accesorio['accesorio_costo_unitario'] <= 0) {

            self::mError($aJson, $mensaje, $error . "accesorio;");
        }
    }


    if (count($aAccesorios) > 0) {

        $aJson['Accesorios'] = $aAccesorios;

        $NombProcesos = $NombProcesos . "cot_accesorios;";

        if (is_array($aAccesorios)) {

            unset($aAccesorios);
        }
    }


/********************* Termina Accesorios *****************************/



/************************* Inicia Bancos ********************************/


    $aBancos_tmp = json_decode($_POST['aBancos'], true);

    $aBancos_R   = array_values($aBancos_tmp);

    $cuantos_aBancos_tmp = count($aBancos_tmp);


    $aBancos = [];

    for ($i = 0; $i < $cuantos_aBancos_tmp; $i++) {

        $Tipo_banco = "";
        $Tipo_banco = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Tipo_banco']));

        $largo       = 0;
        $ancho       = 0;
        $profundidad = 0;
        $suaje       = "";

        $largo       = $aBancos_R[$i]['largo'];
        $ancho       = $aBancos_R[$i]['ancho'];
        $profundidad = $aBancos_R[$i]['Profundidad'];


        $aCosto_Banco = self::calculoBancos($Tipo_banco, $tiraje, $ventas_model);

        switch ($Tipo_banco) {
            case 'Carton':

                $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));

                break;
            case 'Eva':

                $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));

                break;
            case 'Espuma':

                $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));

                break;
            case 'Empalme Banco':

                $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));

                break;
            case 'Cartulina Suajada':

                $suaje = "SI";

                break;
        }


        $aBancos[$i]['Tipo_banco']       = $Tipo_banco;
        $aBancos[$i]['tiraje']           = $tiraje;
        $aBancos[$i]['largo']            = $largo;
        $aBancos[$i]['ancho']            = $ancho;
        $aBancos[$i]['profundidad']      = $profundidad;
        $aBancos[$i]['Suaje']            = $suaje;
        $aBancos[$i]['costo_unit_banco'] = $aCosto_Banco['banco_costo_unitario'];
        $aBancos[$i]['costo_tot_proceso']= $aCosto_Banco['costo_tot_proceso'];

        $subtotal += $aBancos[$i]['costo_tot_proceso'];

        if($aCosto_Banco['banco_costo_unitario'] <= 0) {

            self::mError($aJson, $mensaje, $error . "banco;");
        }

        if (count($aCosto_Banco) > 0) {

            unset($aCosto_accesorio);
        }
    }


    if (count($aBancos) > 0) {

        $aJson['Bancos'] = $aBancos;

        $NombProcesos = $NombProcesos . "cot_bancos;";

        if (is_array($aBancos)) {

            unset($aBancos);
        }
    }


/************************ Termina Bancos ********************************/



/*************************** Inicia Cierres *****************************/


    $aCierres_tmp2 = json_decode($_POST['aCierres'], true);
    $aCierres_tmp = array_values($aCierres_tmp2);

    $cuantos_aCierres = 0;
    $cuantos_aCierres = count($aCierres_tmp);

    $aCierres = [];

    $tiraje = $tiraje;

    for ($i = 0; $i < $cuantos_aCierres; $i++) {

        $Tipo_cierre = "";
        $Tipo_cierre = utf8_encode(self::strip_slashes_recursive($aCierres_tmp[$i]['Tipo_cierre']));


        $aCierres[$i]['Tipo_cierre'] = $Tipo_cierre;
        $aCierres[$i]['tiraje']      = $tiraje;

        $numpares = 0;
        $largo    = null;
        $ancho    = null;
        $tipo     = null;
        $color    = null;

        $costo_cierre = 0;

        $numpares = $aCierres_tmp[$i]['numpares'];
        $numpares = intval($numpares);


        $aCosto_cierres = self::calculoCierre($Tipo_cierre, $tiraje, $numpares, $ventas_model);

        switch ($Tipo_cierre) {
            case 'Iman':

                $largo = intval($aCierres_tmp[$i]['largo']);
                $ancho = intval($aCierres_tmp[$i]['ancho']);

                break;
            case 'Liston':

                $largo = intval($aCierres_tmp[$i]['largo']);
                $ancho = intval($aCierres_tmp[$i]['ancho']);
                $tipo  = utf8_encode(self::strip_slashes_recursive($aCierres_tmp[$i]['tipo']));
                $color = utf8_encode(self::strip_slashes_recursive($aCierres_tmp[$i]['color']));

                break;
            case 'Marialuisa':

                break;
            case 'Suaje calado':

                $largo = intval($aCierres_tmp[$i]['largo']);
                $ancho = intval($aCierres_tmp[$i]['ancho']);
                $tipo  = utf8_encode(self::strip_slashes_recursive($aCierres_tmp[$i]['tipo']));

                break;
            case 'Velcro':

                break;
        }


        $aCierres[$i]['numpares'] = intval($numpares);


        $aCierres[$i]['largo'] = $largo;
        $aCierres[$i]['ancho'] = $ancho;
        $aCierres[$i]['tipo']  = $tipo;
        $aCierres[$i]['color'] = $color;

        $aCierres[$i]['costo_unitario']    = $aCosto_cierres['cierre_costo_unitario'];
        $aCierres[$i]['costo_tot_proceso'] = $aCosto_cierres['costo_tot_proceso'];

        $subtotal += $aCierres[$i]['costo_tot_proceso'];

        if($aCosto_cierres['cierre_costo_unitario'] <= 0) {

            self::mError($aJson, $mensaje, $error . "cierres;");
        }

        if (count($aCosto_cierres) > 0) {

            unset($aCosto_cierres);
        }
    }


    if (count($aCierres) > 0) {

        $aJson['Cierres'] = $aCierres;

        $NombProcesos = $NombProcesos . "cot_cierres;";

        if (is_array($aCierres)) {

            unset($aCierres);
        }
    }


/************************** Termina Cierres *****************************/



/***************** Inicia suma de costos ******************/


    /********* suma costo Empalme del Cajon ***********/

    $suma_Imp_tmp = 0;
    $suma_Acb_tmp = 0;

    $suma_Imp_tmp = self::sumaImp("aImpEmp", $aJson);
    $suma_Acb_tmp = self::sumaAcb("aAcbEmp", $aJson);

    $aJson['costo_EmpCaj'] = round(floatval($suma_Imp_tmp + $suma_Acb_tmp), 2);



    /********* Forro del Cajon ****************/

    $suma_Imp_tmp = 0;
    $suma_Acb_tmp = 0;

    $suma_Imp_tmp = self::sumaImp("aImpFCaj", $aJson);
    $suma_Acb_tmp = self::sumaAcb("aAcbFCaj", $aJson);

    $aJson['costo_FCaj'] = round(floatval($suma_Imp_tmp + $suma_Acb_tmp), 2);


    /*********** Empalme de la Tapa ***************/

    $suma_Imp_tmp = 0;
    $suma_Acb_tmp = 0;

    $suma_Imp_tmp = self::sumaImp("aImpEmpTap", $aJson);
    $suma_Acb_tmp = self::sumaAcb("aAcbEmpTap", $aJson);

    $aJson['costo_EmpTap'] = round(floatval($suma_Imp_tmp + $suma_Acb_tmp), 2);


    /*********** Forro de la Tapa **********************/

    $suma_Imp_tmp = 0;
    $suma_Acb_tmp = 0;

    $suma_Imp_tmp = self::sumaImp("aImpFTap", $aJson);
    $suma_Acb_tmp = self::sumaAcb("aAcbFTap", $aJson);

    $aJson['costo_FTap'] = round(floatval($suma_Imp_tmp + $suma_Acb_tmp), 2);



    /****************** Accesorios ********************/

    if (array_key_exists('Accesorios', $aJson)) {

        $aJson['costo_accesorios'] = round(floatval(array_sum(array_column($aJson['Accesorios'], 'costo_tot_proceso'))), 2);
    }


    /**************** Bancos **********************/

    if (array_key_exists('Bancos', $aJson)) {

        $aJson['costo_bancos'] = round(floatval(array_sum(array_column($aJson['Bancos'], 'costo_tot_proceso'))), 2);
    }


    /****************** Cierres ********************/

    if (array_key_exists('Cierres', $aJson)) {

        $aJson['costo_cierres'] = round(floatval(array_sum(array_column($aJson['Cierres'], 'costo_tot_proceso'))), 2);
    }



/***************** Termina suma de costos ******************/


    $subtotal = round($subtotal, 2);

    $aJson['costo_subtotal'] = $subtotal;


    /***************** Inicia empaque ******************/

        $empaque    = 0;
        $mensajeria = 0;

        $unid_por_tarima = 50;


        // Empaque
        $db_tmp = $ventas_model->costos_empaque("Tarima");

        $tarima = 0;

        foreach($db_tmp as $row) {

            $tarima = $row['importe'];
            $tarima = floatval($tarima);
            $tarima = round($tarima, 2);
        }


        $tarima_temp = ceil($tiraje / $unid_por_tarima);

        $costo_tarima = floatval($tarima * $tarima_temp);


        $db_tmp = $ventas_model->costos_empaque("Playo");

        $playo = 0;

        foreach($db_tmp as $row) {

            $playo = $row['importe'];
            $playo = floatval($playo);
            $playo = round($playo, 2);
        }

        $costo_playo = round(floatval($tarima_temp * $playo / 2), 2);


        $db_tmp = $ventas_model->costos_empaque("Caja");

        $caja = 0;

        foreach($db_tmp as $row) {

            $caja = $row['importe'];
            $caja = floatval($caja);
            $caja = round($caja, 2);
        }


        $costo_caja = floatval($caja * $tarima_temp);

        $empaque = $costo_tarima + $costo_playo + $costo_caja;
        $empaque = round(floatval($empaque), 2);


        $aJson['empaque'] = $empaque;


    /***************** termina empaque ******************/


    /***************** Inicia mensajeria ******************/

        // mensajeria
        $l_grabar_mensajeria = false;

        $costo_odt_total = 0;
        $costo_subtotal  = 0;


        $db_tmp = $ventas_model->costos_empaque("Mensajeria");

        $costo_mensajeria  = 0;
        $costo_mensajeria1 = 0;

        foreach($db_tmp as $row) {

            $tiraje_minimo = $row['tiraje_minimo'];
            $tiraje_minimo = intval($tiraje_minimo);

            $tiraje_maximo = $row['tiraje_maximo'];
            $tiraje_maximo = intval($tiraje_maximo);

            if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                $costo_mensajeria = $row['importe'];
                $costo_mensajeria = floatval($costo_mensajeria);

                break;
            }
        }


        if ($tiraje <= $tiraje_maximo) {

                $costo_odt_total = $costo_mensajeria;
        } else {

            $db_tmp = $ventas_model->costos_empaque("Flete");

            foreach($db_tmp as $row) {

                $tiraje_minimo1 = $row['tiraje_minimo'];
                $tiraje_minimo1 = intval($tiraje_minimo1);

                $tiraje_maximo1 = $row['tiraje_maximo'];
                $tiraje_maximo1 = intval($tiraje_maximo1);

                if ($tiraje >= $tiraje_minimo1 and $tiraje <= $tiraje_maximo1) {

                    $costo_mensajeria1 = $row['importe'];
                    $costo_mensajeria  = floatval($costo_mensajeria1);

                    //$subtotal = $costo_mensajeria;

                    break;
                }
            }
        }


        $aJson['mensajeria'] = round(floatval($costo_mensajeria), 2);


    /***************** Termina mensajeria ******************/



    /***************** Inicia utilidad ******************/

        $db_tmp = $ventas_model->costos_descuentos("Utilidad");

        $utilidad_pctje = 0;

        foreach($db_tmp as $row) {

            $utilidad_pctje = $row['porcentaje'];
            $utilidad_pctje = floatval($utilidad_pctje);
            $utilidad_pctje = round($utilidad_pctje, 2);
        }


        $utilidad = 0;

        $utilidad = floatval($aJson['costo_subtotal'] * $utilidad_pctje);
        $utilidad = round($utilidad, 2);

        $aJson['Utilidad'] = $utilidad;


    /***************** Termina utilidad ******************/



    /***************** Inicia IVA ******************/

        $db_tmp = $ventas_model->costos_descuentos("IVA");

        $iva_pctje = 0;

        foreach($db_tmp as $row) {

            $iva_pctje = $row['porcentaje'];
            $iva_pctje = floatval($iva_pctje);
            $iva_pctje = round($iva_pctje, 2);
        }

        $iva = 0;

        $iva = floatval($aJson['costo_subtotal'] * $iva_pctje);
        $iva = round($iva, 2);

        $aJson['iva'] = $iva;


    /***************** Termina IVA ******************/



    /***************** Inicia comisiones ******************/

        $db_tmp = $ventas_model->costos_descuentos("Comisiones");

        $comisiones_pctje = 0;

        foreach($db_tmp as $row) {

            $comisiones_pctje = $row['porcentaje'];
            $comisiones_pctje = floatval($comisiones_pctje);
            $comisiones_pctje = round($comisiones_pctje, 2);
        }

        $comisiones = 0;

        $comisiones = floatval($aJson['costo_subtotal'] * $comisiones_pctje);
        $comisiones = round($comisiones, 2);

        $aJson['comisiones'] = $comisiones;


    /***************** Termina comisiones ******************/



    /***************** Inicia indirecto ******************/

        $db_tmp = $ventas_model->costos_descuentos("Indirecto");

        $indirecto_pctje = 0;

        foreach($db_tmp as $row) {

            $indirecto_pctje = $row['porcentaje'];
            $indirecto_pctje = floatval($indirecto_pctje);
            $indirecto_pctje = round($indirecto_pctje, 2);
        }

        $indirecto = 0;

        $indirecto = floatval($aJson['costo_subtotal'] * $indirecto_pctje);
        $indirecto = round($indirecto, 2);

        $aJson['indirecto'] = $indirecto;


    /***************** Termina indirecto ******************/



    /***************** Inicia venta ******************/

        $db_tmp = $ventas_model->costos_descuentos("Venta");

        $venta_pctje = 0;

        foreach($db_tmp as $row) {

            $venta_pctje = $row['porcentaje'];
            $venta_pctje = floatval($venta_pctje);
            $venta_pctje = round($venta_pctje, 2);
        }

        $venta = 0;

        $venta = floatval($aJson['costo_subtotal'] * $venta_pctje);
        $venta = round($venta, 2);


        $aJson['ventas'] = $venta;


    /***************** Termina venta ******************/



    /***************** Inicia ISR ******************/

        $db_tmp = $ventas_model->costos_descuentos("ISR");

        $isr = 0;

        foreach($db_tmp as $row) {

            $isr_pctje = $row['porcentaje'];
            $isr_pctje = floatval($isr_pctje);
            $isr_pctje = round($isr_pctje, 2);
        }

        $isr = 0;

        $isr = floatval($aJson['costo_subtotal'] * $isr_pctje);
        $isr = round($isr, 2);

        $aJson['ISR'] = $isr;


    /***************** Termina ISR ******************/


    /***************** Inicia descuento pctje **************/

        // descuento porcentaje
        $descuento_pctje = floatval($_POST['descuento_pctje']);

        $descuento = 0;

        $descuento = floatval($aJson['costo_subtotal'] * ($descuento_pctje / 100));

        $descuento = round($descuento, 2);

        $aJson['descuento'] = $descuento;


    /***************** Termina descuento pctje **************/


/******************************************/
/******************************************/


        $aJson['costo_odt'] = round(floatval($aJson['costo_subtotal'] - $aJson['descuento'] + $aJson['ventas'] + $aJson['indirecto'] + $aJson['comisiones'] + $aJson['iva'] + $aJson['ISR'] + $aJson['Utilidad'] + $aJson['empaque'] + $aJson['mensajeria']), 2);


        $aJson['keys'] = $NombProcesos;


/******************************************/


/******************************************/

        $endtime  = microtime(true);
        $timediff = $endtime - $starttime;

        $aJson['tiempo_transcurrido'] = $timediff;


        $debuger   = false;
        $post      = false;
        $grabar    = true;
        $respuesta = false;

        $str_error_len = 0;
        $str_error_len = strlen($aJson['error']);

        if ($str_error_len > 0) {

            $aJson['error'] = $aJson['error'] . " No debe grabar esta ODT...";

            $grabar = false;
        }


        //if ($grabar and $_POST['grabar'] == "SI" and strlen($aJson['tablas_faltantes']) < 3 and
        if ($grabar and $_POST['grabar'] == "SI") {

            //$respuesta = false;

            $respuesta = $regalo_model->insertRegalo($aJson, $ventas_model);

            echo json_encode($respuesta);
        } else {

            if ($post) {

                self::prettyPrint($_POST, "post", 4581);
            }

            if ($debuger) {

                self::prettyPrint($aJson, "aJson", 4586);
            }

            echo json_encode($aJson);
        }
    }


    public function printCalc() {

        session_start();

        $login        = $this->loadController('login');
        $ventas_model = $this->loadModel('VentasModel');

        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
        }

        if (isset($_GET['id'])) {

            $id_odt = intval($_GET['id']);
        } else {

            return;
        }

        $id_odt = intval($id_odt);

        $num_odt   = "";
        $id_modelo = 0;

        $cot_odt_db = $ventas_model->getOdtById($id_odt);

        $odt = $cot_odt_db['num_odt'];
        $odt = trim($odt);

        $id_modelo = $cot_odt_db['id_modelo'];
        $id_modelo = intval($id_modelo);

        $calculadora = $ventas_model->getCalculadora($id_odt, $id_modelo);


        foreach($calculadora as $row) {

            $b   = $row['b'];
            $h   = $row['h'];
            $p   = $row['p'];
            $T   = $row['t_may'];
            $g   = $row['g'];
            $G   = $row['g_may'];
            $e   = $row['e'];
            $E   = $row['e_may'];
            $b1  = $row['b1'];
            $h1  = $row['h1'];
            $p1  = $row['p1'];
            $x   = $row['x'];
            $y   = $row['y'];
            $x1  = $row['x1'];
            $y1  = $row['y1'];
            $x11 = $row['x11'];
            $y11 = $row['y11'];
            $b11 = $row['b11'];
            $h11 = $row['h11'];
            $f   = $row['f'];
            $k   = $row['k'];
            $B   = $row['b_may'];
            $H   = $row['h_may'];
            $B1  = $row['b1_may'];
            $H1  = $row['h1_may'];
            $X   = $row['x_may'];
            $Y   = $row['y_may'];
            $X1  = $row['x1_may'];
            $Y1  = $row['y1_may'];
            $X11 = $row['x11_may'];
            $Y11 = $row['y11_may'];
            $B11 = $row['b11_may'];
            $H11 = $row['h11_may'];
            $F   = $row['f_may'];
            $K   = $row['k_may'];
        }

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/calculadora/regalo3.php';
        require_once 'application/views/templates/footer.php';
    }



    public function printBoxCalculate(){

        session_start();

        $login = $this->loadController('login');

        if(!$login->isLoged()){

            header("Location:" . URL . 'login/');
        }

        if (empty($_SESSION['calculadora'])) {

            header("Location:" . URL . 'regalo/getCotizaciones');
        }


        $b   = $_SESSION['calculadora']['b'];
        $h   = $_SESSION['calculadora']['h'];
        $p   = $_SESSION['calculadora']['p'];
        $T   = $_SESSION['calculadora']['T'];
        $g   = $_SESSION['calculadora']['g'];
        $G   = $_SESSION['calculadora']['G'];
        $e   = $_SESSION['calculadora']['e'];
        $E   = $_SESSION['calculadora']['E'];
        $b1  = $_SESSION['calculadora']['b1'];
        $h1  = $_SESSION['calculadora']['h1'];
        $p1  = $_SESSION['calculadora']['p1'];
        $x   = $_SESSION['calculadora']['x'];
        $y   = $_SESSION['calculadora']['y'];
        $x1  = $_SESSION['calculadora']['x1'];
        $y1  = $_SESSION['calculadora']['y1'];
        $x11 = $_SESSION['calculadora']['x11'];
        $y11 = $_SESSION['calculadora']['y11'];
        $b11 = $_SESSION['calculadora']['b11'];
        $h11 = $_SESSION['calculadora']['h11'];
        $f   = $_SESSION['calculadora']['f'];
        $k   = $_SESSION['calculadora']['k'];
        $B   = $_SESSION['calculadora']['B'];
        $H   = $_SESSION['calculadora']['H'];
        $B1  = $_SESSION['calculadora']['B1'];
        $H1  = $_SESSION['calculadora']['H1'];
        $X   = $_SESSION['calculadora']['X'];
        $Y   = $_SESSION['calculadora']['Y'];
        $X1  = $_SESSION['calculadora']['X1'];
        $Y1  = $_SESSION['calculadora']['Y1'];
        $X11 = $_SESSION['calculadora']['X11'];
        $Y11 = $_SESSION['calculadora']['Y11'];
        $B11 = $_SESSION['calculadora']['B11'];
        $H11 = $_SESSION['calculadora']['H11'];
        $F   = $_SESSION['calculadora']['F'];
        $K   = $_SESSION['calculadora']['K'];
        $odt = $_SESSION['calculadora']['odt'];

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/calculadora/regalo3.php';
        require_once 'application/views/templates/footer.php';
    }
}

/****************** Termina la funcion saveCaja() **********************/
