<?php


class Controller {

    public $db = null;

    function __construct() {

        $this->openDatabaseConnection();
    }


    private function openDatabaseConnection() {

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");

        try {

            $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);

        } catch (PDOException $e) {

            print "ERROR de conexion PDO: " . $e->getMessage() . "<br/>";

            exit();
        }
    }


    public function loadModel($model_name) {

        require_once 'application/models/' . strtolower($model_name) . '.php';

        return new $model_name($this->db);
    }


    public function loadController($controller_name) {

        require_once 'application/controller/' . strtolower($controller_name) . '.php';

        return new $controller_name();
    }


    public function mError(&$aJson, $mensaje, $error) {

        $aJson["mensaje"] = strval($mensaje);
        $aJson["error"]   = $aJson["error"] . strval($error);

        return $aJson;
    }


    public function msgError($text) {

        $text = trim(strval($text));

        $aJson['error'] = $text;

        echo json_encode($aJson);

        die();
    }


    public function suma_costo_procesos($aJson_tmp, $nomb_proceso) {

        $costo_proc_tmp = 0;

        if (array_key_exists($nomb_proceso, $aJson_tmp)) {

            $nomb_proceso_tmp = array_values($aJson_tmp[$nomb_proceso]);

            for ($k = 0; $k < count($nomb_proceso_tmp); $k++) {

                $costo_tot_proceso = $nomb_proceso_tmp[$k]['costo_tot_proceso'];
                $costo_tot_proceso = round(floatval($costo_tot_proceso), 2);

                $costo_proc_tmp = round(($costo_proc_tmp + $costo_tot_proceso), 2);
            }
        }

        return $costo_proc_tmp;
    }


    public function suma_costo_cierres($aJson_tmp, $nomb_proceso) {

        $nombre_proceso = trim(strval($nomb_proceso));

        $costo_proc_tmp = 0;

        if (array_key_exists($nombre_proceso, $aJson_tmp)) {

            $nomb_proceso_tmp = array_values($aJson_tmp[$nombre_proceso]);

            for ($k = 0; $k < count($nomb_proceso_tmp); $k++) {

                $costo_tot_proceso = round(floatval($nomb_proceso_tmp[$k]['costo_cierre']), 2);

                $costo_proc_tmp = round(floatval($costo_proc_tmp + $costo_tot_proceso), 2);
            }
        }

        return $costo_proc_tmp;
    }


    public function suma_costo_bancos($aJson_tmp, $nomb_proceso) {

        $nombre_proceso = trim(strval($nomb_proceso));

        $costo_proc_tmp = 0;
        if (array_key_exists($nombre_proceso, $aJson_tmp)) {

            $nomb_proceso_tmp = array_values($aJson_tmp[$nombre_proceso]);

            for ($k = 0; $k < count($nomb_proceso_tmp); $k++) {

                $costo_tot_proceso = round(floatval($nomb_proceso_tmp[$k]['costo_bancos']), 2);

                $costo_proc_tmp = round(floatval($costo_proc_tmp + $costo_tot_proceso), 2);
            }
        }

        return $costo_proc_tmp;
    }


    public function suma_costo_accesorios($aJson_tmp, $nomb_proceso) {

        $nombre_proceso = trim(strval($nomb_proceso));

        $costo_proc_tmp = 0;
        if (array_key_exists($nombre_proceso, $aJson_tmp)) {

            $nomb_proceso_tmp = array_values($aJson_tmp[$nombre_proceso]);

            for ($k = 0; $k < count($nomb_proceso_tmp); $k++) {

                $costo_tot_proceso = round(floatval($nomb_proceso_tmp[$k]['costo_accesorios']), 2);

                $costo_proc_tmp = round(floatval($costo_proc_tmp + $costo_tot_proceso), 2);
            }
        }

        return $costo_proc_tmp;
    }


    public function admin() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $options_model = $this->loadModel('OptionsModel');

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/cajas/admin.php';
        require_once 'application/views/templates/footer.php';
    }


    public function getClient($opt) {

        $nombrecliente = '--';

        if (isset($_GET['cliente'])) {

            $nombrecliente = $opt->getClientInfo($_GET['cliente'],'nombre');
        }

        return $nombrecliente;
    }


    public function getCotizacionesByCliente() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login         = $this->loadController('login');
        $options_model = $this->loadModel('OptionsModel');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            if (isset($_GET['c'])) {

                $rows = $ventas_model->getCotizacionByClient($_GET['c']);

                require_once 'application/views/templates/head.php';
                require_once 'application/views/templates/top_menu.php';
                require_once 'application/views/cotizador/cotizaciones.php';
                require_once 'application/views/templates/footer.php';
            } else {

                echo '<script language="javascript">';
                echo 'window.location.href="' . URL . 'cotizador/clientes/"';
                echo '</script>';
            }
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
        }
    }


    public function getCotizaciones() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            $cotizaciones = $ventas_model->getCotizaciones();
            $clientes     = $ventas_model->getClients();


            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizador/listaCotizaciones.php';
            require_once 'application/views/templates/footer.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
        }
    }


    // carga los modelos de cajas
    public function cajas() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');


        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
        }


        $procesos   = $options_model->getProcessCatalog();
        $papers     = $options_model->getPapers();
        $cartones   = $options_model->getCartones();

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
        if (isset($_GET['cliente'])) {

            $nombre_cliente = $options_model->getClientInfo($_GET['cliente'], 'nombre');
            $nombrecliente  = utf8_encode($nombre_cliente);

        } else {

            $nombrecliente = '--';
        }

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/cotizador/cajas.php';
        require_once 'application/views/templates/footer.php';
    }


    public function sumArrayDato($aArray, $seccion, $dato) {

        $suma = 0;

        if (array_key_exists($seccion, $aArray)) {

            $suma = round(floatval(array_sum(array_column($aArray[$seccion], $dato))), 2);
        }

        return $suma;
    }


    protected function findKeyInArray($array, $keySearch) {

        foreach ($array as $key => $item) {

            if ($key == $keySearch) {

                return true;
            } elseif (is_array($item) && $this->findKeyInArray($item, $keySearch)) {

                return true;
            }
        }
        return false;
    }


    public function prettyPrint($aArray, $texto = null, $num_linea = null) {

        echo PHP_EOL;

        if ($texto == null and $num_linea == null) {

            echo '<pre>' . print_r($aArray, true) . '</pre>';
        } elseif($num_linea == null) {

            echo '<pre>' . $texto . ": " . print_r($aArray, true) . '</pre>';
        } else {

            echo '<pre>(' . $num_linea . ") " . $texto . ": " . print_r($aArray, $return = TRUE) . '</pre>';
        }
    }


    protected function checaAnchoLargo($ancho, $largo) {

        if ($largo > $ancho) {

            return true;
        } elseif($ancho > $largo) {

            return false;
        }
    }


    protected function checaCostos($aArray, $proceso) {

        $proceso = trim(strval($proceso));

        $checa_ok = true;

        switch ($proceso) {
            case 'Offset':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['corte_costo_unitario'] <= 0
                 or $aArray['corte_por_millar'] <= 0
                 or $aArray['costo_corte'] <= 0
                 or $aArray['costo_unitario_laminas'] <= 0
                 or $aArray['costo_tot_laminas'] <= 0
                 or $aArray['costo_unitario_arreglo'] <= 0
                 or $aArray['costo_tot_arreglo'] <= 0
                 or $aArray['costo_unitario_tiro'] <= 0
                 or $aArray['costo_tiro'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Offset_Maquila':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['arreglo_costo_unitario'] <= 0
                 or $aArray['arreglo_costo'] <= 0
                 or $aArray['costo_unitario_laminas'] <= 0
                 or $aArray['costo_laminas'] <= 0
                 or $aArray['costo_unitario_maq'] <= 0
                 or $aArray['costo_tot_maq'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Digital':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['costo_unitario'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Serigrafia':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['costo_unit_arreglo'] <= 0
                 or $aArray['costo_arreglo'] <= 0
                 or $aArray['costo_unitario_tiro'] <= 0
                 or $aArray['costo_tiro'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Barniz':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['costo_unitario'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Laser':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['costo_unitario'] <= 0
                 or $aArray['tiempo_requerido'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Grabado':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['placa_costo_unitario'] <= 0
                 or $aArray['placa_costo'] <= 0
                 or $aArray['arreglo_costo_unitario'] <= 0
                 or $aArray['arreglo_costo'] <= 0
                 or $aArray['costo_unitario'] <= 0
                 or $aArray['costo_tiro'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'HotStamping':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['placa_costo_unitario'] <= 0
                 or $aArray['placa_costo'] <= 0
                 or $aArray['pelicula_costo_unitario'] <= 0
                 or $aArray['pelicula_costo'] <= 0
                 or $aArray['arreglo_costo_unitario'] <= 0
                 or $aArray['arreglo_costo'] <= 0
                 or $aArray['costo_unitario'] <= 0
                 or $aArray['costo_tiro'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Laminado':

                if ($aArray['costo_tot_proceso'] <= 0
                    or $aArray['costo_unitario'] <= 0) {

                    $checa_ok = false;
                }

                break;

            case 'Suaje':

                if ($aArray['costo_tot_proceso'] <= 0
                 or $aArray['arreglo'] <= 0
                 or $aArray['tiro_costo_unitario'] <= 0
                 or $aArray['costo_tiro'] <= 0) {

                    $checa_ok = false;
                }

                break;
        }

        return $checa_ok;
    }


    // calculo del corte de papel y/o carton
    public function getPapelCarton($seccion, $id_papel, $options_model) {

        $nombre_papel     = "";
        $ancho_papel      = 0;
        $largo_papel      = 0;
        $costo_unit_papel = 0;

        $seccion = trim(strval($seccion));

        $l_carton = false;

        switch ($seccion) {
            case 'grosor_carton':

                $row  = $options_model->getMaxCostoCartonId($id_papel);

                $l_carton = true;

                break;
            case 'grosor_tapa':

                $row  = $options_model->getMaxCostoCartonId($id_papel);

                $l_carton = true;

                break;
            case 'grosor_cajon':

                $row  = $options_model->getMaxCostoCartonId($id_papel);

                $l_carton = true;

                break;
            case 'grosor_cartera':

                $row  = $options_model->getMaxCostoCartonId($id_papel);

                $l_carton = true;

                break;
            default:

                $row = $options_model->getPapelId($id_papel);

                break;
        }

        $id_papel = $row['id_papel'];
        $id_papel = intval($id_papel);

        $nombre_papel = $row['nombre'];
        $nombre_papel = utf8_decode(trim(strval($nombre_papel)));

        $ancho_papel = $row['ancho'];
        $ancho_papel = round(floatval($ancho_papel), 2);

        $largo_papel = $row['largo'];
        $largo_papel = round(floatval($largo_papel), 2);

        $costo_unit_papel = $row['costo_unitario'];
        $costo_unit_papel = round(floatval($costo_unit_papel), 4);

        if ($id_papel > 0) {

            $aCalcPapel = array();

            $aCalcPapel['id_papel']         = $id_papel;
            $aCalcPapel['Parte']            = "Carton";
            $aCalcPapel['papel']            = utf8_decode(trim(strval($row['tipo'])));
            $aCalcPapel['nombre_papel']     = $nombre_papel;
            $aCalcPapel['ancho_papel']      = $ancho_papel;
            $aCalcPapel['largo_papel']      = $largo_papel;
            $aCalcPapel['costo_unit_papel'] = $costo_unit_papel;
            $aCalcPapel['carton']           = $l_carton;

            return $aCalcPapel;
        } else {

            return false;
        }
    }


    protected function checaCortes(&$aJson) {

        foreach ($aJson['cortes'] as $key => $value) {

            $valor = $aJson['cortes'][$key];

            if( !is_int($valor) or $valor <= (int)0) {

                $aJson['mensaje'] = "ERROR";
                $aJson['error']   = $aJson['error'] . " Error en el calculo de cortes. Medidas de algun papel?" . " (" . $key . ");";

                return false;
            }
        }

        return true;
    }


    protected function costo_tot_corte($tiraje, $tot_pliegos, $ventas_model) {

        $corte_db = $ventas_model->costo_offset("corte");

        $corte_costo_unitario = 0;

        foreach($corte_db as $row) {

            $corte_costo_unitario = round(floatval($row['costo_unitario']), 2);
            $corte_por_millar     = round(floatval($row['por_millar']), 2);
        }


        $costo_millar = self::Deltax($tot_pliegos, $corte_por_millar);
        $costo_corte  = round(floatval($costo_millar * $corte_costo_unitario), 2);

        if ($corte_costo_unitario <= 0) {

            $costo_corte = 0;
        }

        return $costo_corte;
    }


    protected function costo_guillotina($corte, $pliegos, $ventas_model) {

        $corte_db = $ventas_model->costo_offset($corte);

        $corte_costo_unitario = 0;

        foreach($corte_db as $row) {

            $corte_costo_unitario = round(floatval($row['costo_unitario']), 2);
            $corte_por_millar     = round(floatval($row['por_millar']), 2);
        }

        $pliegos_por_millar = self::Deltax($pliegos, $corte_por_millar);

        $costo_guillotina = round(floatval($pliegos_por_millar * $corte_costo_unitario), 2);

        return $costo_guillotina;
    }


    protected function costo_corte($corte, $tiraje, $cortes_pliego, $ventas_model) {

        $aJson_corte_tmp = [];

        $corte_db = $ventas_model->costo_offset($corte);

        $corte_costo_unitario = 0;

        foreach($corte_db as $row) {

            $corte_costo_unitario = round(floatval($row['costo_unitario']), 2);
            $corte_por_millar     = round(floatval($row['por_millar']), 2);
        }


        $tot_pliegos_emp = self::Deltax($tiraje, $cortes_pliego);

        $costo_millar = self::Deltax($tot_pliegos_emp, $corte_por_millar);
        $costo_corte  = round(floatval($costo_millar * $corte_costo_unitario), 2);

        $aJson_corte_tmp['tiraje']                     = intval($tiraje);
        $aJson_corte_tmp['costo_unitario_corte_papel'] = floatval($corte_costo_unitario);
        $aJson_corte_tmp['cortes_pliego']              = intval($cortes_pliego);
        $aJson_corte_tmp['tot_pliegos']                = intval($tot_pliegos_emp);
        $aJson_corte_tmp['millares']                   = intval($costo_millar);
        $aJson_corte_tmp['tot_costo_corte']            = $costo_corte;

        if ($corte_costo_unitario <= 0) {

            $aJson_corte_tmp['tot_costo_corte'] = 0;
        }

        return $aJson_corte_tmp;
    }


    // calculo del papel incluyendo cortes
    protected function calculaPapel($seccion, $id_papel, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model) {


        $papel_secc = self::getPapelCarton($seccion, $id_papel, $options_model);

        $costo_unit_papel = round(floatval($papel_secc['costo_unit_papel']), 4);

        $p_ancho = round(floatval($papel_secc['ancho_papel']), 2);
        $p_largo = round(floatval($papel_secc['largo_papel']), 2);
        $c_ancho = $secc_ancho;
        $c_largo = $secc_largo;

        $b  = max($p_ancho, $p_largo);
        $h  = min($p_ancho, $p_largo);
        $cb = $c_ancho;
        $ch = $c_largo;

        $cortes = self::Acomoda($b, $h, $c_ancho, $c_largo, "V", "V");

        $totalCortes = $cortes['cortesT'];

        $cortes_H = self::Acomoda($b, $h, $c_ancho, $c_largo, "H", "V");

        $totalCortes_H = $cortes_H['cortesT'];


        $corte   = $cortes['cortesT'];
        $corte_H = $cortes_H['cortesT'];

        if($corte = $corte_H) {

            $corte_secc = $corte;
        } else {

            $corte_secc = max($corte, $corte_H);
        }

        $tot_pliegos = self::Deltax($tiraje, $corte_secc);

        $tot_costo = round(floatval($tot_pliegos * $costo_unit_papel), 2);


        $aPapel_secc = [];

        $aPapel_secc['tiraje']   = $tiraje;
        $aPapel_secc['id_papel'] = $papel_secc['id_papel'];

        if ($papel_secc['carton'] === true) {

            $aPapel_secc['num_carton'] = $id_papel;
        }

        $aPapel_secc['nombre_papel']     = $papel_secc['nombre_papel'];
        $aPapel_secc['ancho_papel']      = round($papel_secc['ancho_papel'], 2);
        $aPapel_secc['largo_papel']      = round($papel_secc['largo_papel'], 2);
        $aPapel_secc['costo_unit_papel'] = round($papel_secc['costo_unit_papel'], 4);
        $aPapel_secc['corte']            = $corte_secc;
        $aPapel_secc['tot_pliegos']      = $tot_pliegos;
        $aPapel_secc['tot_costo']        = $tot_costo;


        if ($papel_secc['costo_unit_papel'] <= 0) {

            $aPapel_secc['tot_costo'] = 0;
        }

        $a_Calculadora_secc = array();

        $a_Calculadora_secc['corte_ancho'] = min($secc_ancho, $secc_largo);
        $a_Calculadora_secc['corte_largo'] = max($secc_ancho, $secc_largo);

        if ($corte > $corte_H) {

            $cortes['orientacion']       = "vertical";
            $a_Calculadora_secc['corte'] = $cortes;
        } else {

            $cortes_H['orientacion']     = "horizontal";
            $a_Calculadora_secc['corte'] = $cortes_H;
        }


        $aPapel_secc['calculadora'] = $a_Calculadora_secc;

        unset($a_Calculadora_secc);

        return $aPapel_secc;
    }


    protected function reordenaCarton($tiraje, $aPapel_tmp, $id_grosor_carton, $corte_cajon) {

        $aGrosor_carton = array();

        $id_carton         = $aPapel_tmp['id_papel'];
        $nombre_carton     = $aPapel_tmp['nombre_papel'];
        $ancho_carton      = $aPapel_tmp['ancho_papel'];
        $largo_carton      = $aPapel_tmp['largo_papel'];
        $costo_unit_carton = $aPapel_tmp['costo_unit_papel'];

        $tot_pliegos_carton = self::Deltax($tiraje, $corte_cajon);

        $tot_costo_carton = round(floatval($tot_pliegos_carton * $costo_unit_carton), 2);


        $aGrosor_carton['id_carton']     = $id_carton;
        $aGrosor_carton['nombre']        = $nombre_carton;
        $aGrosor_carton['grosor_carton'] = $id_grosor_carton;
        $aGrosor_carton['ancho']         = $ancho_carton;
        $aGrosor_carton['largo']         = $largo_carton;
        $aGrosor_carton['corte']         = $corte_cajon;
        $aGrosor_carton['costo_unit']    = $costo_unit_carton;
        $aGrosor_carton['tot_pliegos']   = $tot_pliegos_carton;
        $aGrosor_carton['tot_costo']     = $tot_costo_carton;
        $aGrosor_carton['calculadora']   = $aPapel_tmp['calculadora'];

        return $aGrosor_carton;
    }


    // Redondea al entero superior siguiente
    protected function Deltax($cant, $algo) {

        $cant_red1 = 0;
        $cant_red2 = 0;
        $delta     = 0;
        $alfa      = 0;

        $cant = intval($cant);
        $algo = intval($algo);

        if ($algo <= 0) {

            return 0;
        }

        $cant_red1 = ($cant / $algo);
        $cant_red2 = intval($cant / $algo);

        $delta = $cant_red1 - $cant_red2;

        if ($algo <= 0) {

            $alfa = 0;
        } elseif($delta > 0) {

            $alfa = $cant_red2 + 1;
        } else {

            $alfa = $cant_red2;
        }

        return $alfa;
    }


    protected function Acomoda($d1, $d2, $c_ancho, $c_largo, $acomodoCorte, $acomodoPliego) {

        $d1         = floatval($d1);
        $d2         = floatval($d2);
        $corteAncho = floatval($c_ancho);
        $corteLargo = floatval($c_largo);

        if ($d1 <= 0) {

            $d1 = 0;
        }

        if ($d2 <= 0) {

            $d2 = 0;
        }

        if ($corteAncho <= 0) {

            $corteAncho = 0;
        }

        if ($corteLargo <= 0) {

            $corteLargo = 0;
        }

        $b  = $d1;
        $h  = $d2;
        $cb = $corteAncho;
        $ch = $corteLargo;

        $acom_corte  = "";
        $acom_pliego = "";

        if($acomodoPliego === "V") {

            // Acomodo del pliego en vertical para el calculo del máximo
            $b = max($d1, $d2);
            $h = min($d1, $d2);

            $acom_pliego = "V";
        } else if ($acomodoPliego === "H") {

            // Acomodo del pliego en horizontal para el calculo del máximo
            $b = max($d1, $d2);
            $h = min($d1, $d2);

            $acom_pliego = "H";
        }


        if ($acomodoCorte === 'H') {

            $cb = max($corteAncho, $corteLargo);
            $ch = min($corteAncho, $corteLargo);

            $acom_corte = "H";
        } else if($acomodoCorte === 'V') {

            $cb = min($corteAncho, $corteLargo);
            $ch = max($corteAncho, $corteLargo);

            $acom_corte = "V";
        }


        $cortesT       = 0;
        $cortesB       = 0;
        $cortesH       = 0;
        $sobranteB     = 0;
        $sobranteH     = 0;
        $areaUtilizada = 0;
        $orientacion   = "";

        $Desperdicio       = 0;
        $Desperdicio_pctje = 0;
        $areaTotal         = 0;
        $Utilizacion_pctje = 0;



        if ($b > 0 and $h > 0 and $cb > 0 and $ch > 0) {

            $areaTotal         = round(floatval($b * $h));
            $cortesB           = intval($b / $cb);
            $cortesH           = intval($h / $ch);
            $cortesT           = $cortesB * $cortesH;
            $sobranteB         = round(floatval($b - ($cortesB * $cb)), 2);
            $sobranteH         = round(floatval($h - ($cortesH * $ch)), 2);
            $areaUtilizada     = round(floatval( ($cb * $ch) * $cortesT ), 2);
            $Utilizacion_pctje = round(floatval(($areaUtilizada * 100) / $areaTotal), 2);
            $Desperdicio       = round(floatval($areaTotal - $areaUtilizada), 2);
            $Desperdicio_pctje = round(floatval(($Desperdicio * 100) / $areaTotal), 2);
            $orientacion       = $acom_corte . $acom_pliego;
        }

        $cortes_tmp = array();

        $cortes_tmp['cortesT']           = $cortesT;
        $cortes_tmp['cortesB']           = $cortesB;
        $cortes_tmp['cortesH']           = $cortesH;
        $cortes_tmp['sobranteB']         = $sobranteB;
        $cortes_tmp['sobranteH']         = $sobranteH;
        $cortes_tmp['areaUtilizada']     = $areaUtilizada;
        $cortes_tmp['desperdicio']       = $Desperdicio;
        $cortes_tmp['areaTotal']         = $areaTotal;
        $cortes_tmp['Utilizacion_pctje'] = $Utilizacion_pctje;
        $cortes_tmp['Desperdicio_pctje'] = $Desperdicio_pctje;
        $cortes_tmp['b']                 = $b;
        $cortes_tmp['cb']                = $cb;
        $cortes_tmp['h']                 = $h;
        $cortes_tmp['ch']                = $ch;
        $cortes_tmp['corte_pliego']      = $orientacion;


        return $cortes_tmp;
    }



/**** Inician las funciones de Impresión *******/


    // calcula los costos de offset
    protected function calculoOffset($tipo_offset, $id_papel = null, $nombre_tipo_offset, $tiraje, $num_tintas, $corte_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model) {

        $aCosto_Offset = [];

        $aCosto_Offset['maquila'] = "NO";

        $l_ok = true;

        // corte
        $db_tmp = $ventas_model->costo_proceso("proc_offset", "Corte");

        $corte_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $corte_costo_unitario = $row['costo_unitario'];
            $corte_costo_unitario = round(floatval($corte_costo_unitario), 2);

            $corte_por_millar = $row['por_millar'];
            $corte_por_millar = round(floatval($corte_por_millar), 2);
        }


        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($corte_costo_unitario <= 0) {

            $l_ok = false;
        }

        $delta_costo = self:: Deltax($tiraje, $corte_pliego);
        $delta_corte = self:: Deltax($tiraje, $corte_por_millar);

        $costo_corte = round(floatval($corte_costo_unitario * $delta_corte), 2);

        $aCosto_Offset["id_papel"]             = $id_papel;
        $aCosto_Offset["tipo_offset"]          = $nombre_tipo_offset;
        $aCosto_Offset["cantidad"]             = $tiraje;
        $aCosto_Offset["num_tintas"]           = $num_tintas;
        $aCosto_Offset["papel_corte_ancho"]    = $papel_corte_ancho;
        $aCosto_Offset["papel_corte_largo"]    = $papel_corte_largo;
        $aCosto_Offset["corte_pliego"]         = $corte_pliego;
        $aCosto_Offset["total_pliegos"]        = $delta_costo;
        $aCosto_Offset["corte_costo_unitario"] = $corte_costo_unitario;
        $aCosto_Offset["corte_por_millar"]     = $corte_por_millar;
        $aCosto_Offset["costo_corte"]          = $costo_corte;


        if ($nombre_tipo_offset == "Seleccion") {


            // Laminas
            $db_tmp = $ventas_model->costo_proceso("proc_offset", "Laminas");

            $costo_unitario_laminas = 0;

            foreach ($db_tmp as $row) {

                $costo_unitario_laminas = $row['costo_unitario'];
                $costo_unitario_laminas = round(floatval($costo_unitario_laminas), 2);
            }

            if ($costo_unitario_laminas <= 0) {

                $l_ok = false;
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }


            $costo_laminas_offset = round(floatval($costo_unitario_laminas * $num_tintas), 2);

            $aCosto_Offset["costo_unitario_laminas"] = $costo_unitario_laminas;

            $aCosto_Offset["costo_tot_laminas"] = $costo_laminas_offset;


            // Arreglo
            $db_tmp = $ventas_model->costo_proceso("proc_offset", "Arreglo");


            $arreglo_costo_unitario = 0;

            foreach ($db_tmp as $row) {

                $arreglo_tiraje_min = $row['tiraje_minimo'];
                $arreglo_tiraje_min = intval($arreglo_tiraje_min);

                $arreglo_tiraje_max = $row['tiraje_maximo'];
                $arreglo_tiraje_max = intval($arreglo_tiraje_max);

                if ($tiraje >= $arreglo_tiraje_min and $tiraje <= $arreglo_tiraje_max) {

                    $arreglo_costo_unitario = $row['costo_unitario'];
                    $arreglo_costo_unitario = round(floatval($arreglo_costo_unitario), 2);

                    break;
                }
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }

            if ($arreglo_costo_unitario <= 0) {

                $l_ok = false;
            }


            $costo_arreglo_offset = round(floatval($arreglo_costo_unitario * $num_tintas), 2);


            $aCosto_Offset["costo_unitario_arreglo"] = $arreglo_costo_unitario;
            $aCosto_Offset["costo_tot_arreglo"]      = $costo_arreglo_offset;


            $db_tmp = $ventas_model->costo_proceso("proc_offset", $tipo_offset);

            $costo_unitario = 0;

            foreach ($db_tmp as $row) {

                $costo_unitario = $row['costo_unitario'];
                $costo_unitario = round(floatval($costo_unitario), 2);

                $por_millar = $row['por_millar'];
                $por_millar = intval($por_millar);

                if ($tipo_offset == "Tiro") {

                    $num_color = $row['num_color'];
                    $num_color = intval($num_color);
                }
            }

            if ($costo_unitario <= 0) {

                $l_ok = false;
            }


            $alfa = self:: Deltax($tiraje, $por_millar);

            // tiro
            if ($tipo_offset == "Tiro") {

                $num_tintas_alfa = intval($num_tintas / $num_color);

                $costo_tiro_offset = round(floatval($costo_unitario * $alfa * $num_tintas_alfa), 2);
            } else {

                $costo_tiro_offset = round(floatval($costo_unitario * $alfa), 2);
            }

            $costo_proceso = round(floatval($costo_corte + $costo_laminas_offset + $costo_arreglo_offset + $costo_tiro_offset), 2);

            $aCosto_Offset['costo_unitario_tiro'] = $costo_unitario;
            $aCosto_Offset['costo_tiro']          = $costo_tiro_offset;
            $aCosto_Offset['costo_tot_proceso']   = $costo_proceso;

            if (!$l_ok) {

                $aCosto_Offset['costo_tot_proceso'] = 0;
            }
        }


        if ($nombre_tipo_offset === "Pantone") {

            $l_ok = true;

            $db_tmp = $ventas_model->costo_offset("Laminas Pantone");

            $pantone_costo_unitario_laminas = 0;

            foreach ($db_tmp as $row) {

                $pantone_costo_unitario_laminas = $row['costo_unitario'];
                $pantone_costo_unitario_laminas = round(floatval($pantone_costo_unitario_laminas), 2);
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }


            if ($pantone_costo_unitario_laminas <= 0) {

                $l_ok = false;
            }


            $aCosto_Offset['costo_unitario_laminas'] = $pantone_costo_unitario_laminas;

            $costo_tot_laminas = round(floatval($pantone_costo_unitario_laminas * $num_tintas), 2);

            $aCosto_Offset['costo_tot_laminas'] = $costo_tot_laminas;



            // Arreglo de Pantone
            $db_tmp = $ventas_model->costo_offset("Arreglo de Pantone");

            $arreglo_pantone_costo_unitario = 0;

            foreach ($db_tmp as $row) {

                $arreglo_pantone_costo_unitario = $row['costo_unitario'];

                $arreglo_pantone_costo_unitario = round(floatval($arreglo_pantone_costo_unitario), 2);
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }


            if ($arreglo_pantone_costo_unitario <= 0) {

                $l_ok = false;
            }

            $costo_tot_arreglo_pantone = round(floatval($arreglo_pantone_costo_unitario * $num_tintas), 2);

            $aCosto_Offset["costo_unitario_arreglo"] = $arreglo_pantone_costo_unitario;

            $aCosto_Offset["costo_tot_arreglo"] = $costo_tot_arreglo_pantone;

            $costo_offset_arreglo_pantone = $costo_tot_arreglo_pantone;


            // tiro
            $db_tmp = $ventas_model->costo_offset("Tiro Pantone");

            $tiro_pantone_costo_unitario = 0;

            foreach ($db_tmp as $row) {

                $tiro_pantone_costo_unitario = $row['costo_unitario'];
                $tiro_pantone_costo_unitario = round(floatval($tiro_pantone_costo_unitario), 2);

                $por_millar = $row['por_millar'];
                $por_millar = round(floatval($por_millar), 2);
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }

            if ($tiro_pantone_costo_unitario <= 0) {

                $l_ok = false;
            }


            $alfa = self::Deltax($tiraje, $por_millar);

            $costo_tiro_offset = round(floatval($tiro_pantone_costo_unitario * $alfa), 2);

            $aCosto_Offset['costo_unitario_tiro'] = $tiro_pantone_costo_unitario;
            $aCosto_Offset['costo_tiro']          = $costo_tiro_offset;

            $costo_proceso = round(floatval($costo_corte + $costo_tot_laminas + $costo_tot_arreglo_pantone + $costo_tiro_offset), 2);

            $aCosto_Offset['costo_tot_proceso'] = $costo_proceso;

            if (!$l_ok) {

                $aCosto_Offset['costo_tot_proceso'] = 0;
            }
        }

        return $aCosto_Offset;
    }


    // calcula los costos de digital
    protected function calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model) {

        $aDig_tmp = [];

        $digital_db_rango = $ventas_model->costo_digital_rango($nomb_tam_emp);

        $costo_unitario_digital = 0;
        $tiraje_min             = 0;
        $tiraje_max             = 0;

        foreach ($digital_db_rango as $row) {

            $tiraje_min = $row['tiraje_minimo'];
            $tiraje_max = $row['tiraje_maximo'];

            $tiraje_min = intval($tiraje_min);
            $tiraje_max = intval($tiraje_max);

            if ($tiraje >= $tiraje_min and $tiraje <= $tiraje_max) {

                $costo_unitario_digital = $row['costo_unitario'];
                $costo_unitario_digital = round(floatval($costo_unitario_digital), 2);

                break;
            }
        }

        if (is_array($digital_db_rango)) {

            unset($digital_db_rango);
        }


        // tamaño carta digital
        $imp_ancho_dig = 20.5;
        $imp_largo_dig = 27;

        // tamaño doble carta digital
        $t_2carta_ancho = 32;
        $t_2carta_largo = 46.5;

        if ($nomb_tam_emp === "Frente Doble Carta") {

            $imp_ancho = $t_2carta_ancho;
            $imp_largo = $t_2carta_largo;
        } else {

            $imp_ancho = $imp_ancho_dig;
            $imp_largo = $imp_largo_dig;
        }


        if ($imp_ancho > $corte_ancho_proceso and $imp_largo > $corte_largo_proceso) {

            $tam_ok = 1;
        } else {

            $tam_ok = 0;
        }

        $tot_pliegos = self:: Deltax($tiraje, $cortes_por_pliego);

        $costo_tot_proceso = round(floatval($tot_pliegos * $costo_unitario_digital), 2);

        if ( $tam_ok ) {

            $aDig_tmp['cabe_digital']      = "SI";
            $aDig_tmp['tiraje']            = $tiraje;
            $aDig_tmp['tipo_impresion']    = $nomb_tam_emp;
            $aDig_tmp['imp_ancho']         = $imp_ancho;
            $aDig_tmp['imp_largo']         = $imp_largo;
            $aDig_tmp["corte_ancho"]       = $corte_ancho_proceso;
            $aDig_tmp["corte_largo"]       = $corte_largo_proceso;
            $aDig_tmp["cortes_por_pliego"] = $cortes_por_pliego;
            //$aDig_tmp['papel_corte_ancho'] = $papel_corte_ancho;
            //$aDig_tmp['papel_corte_largo'] = $papel_corte_largo;
            $aDig_tmp["costo_unitario"]    = $costo_unitario_digital;
            $aDig_tmp["tot_pliegos"]       = $tot_pliegos;
            $aDig_tmp["costo_tot_proceso"] = $costo_tot_proceso;


            if ($costo_unitario_digital <= 0) {

                $aDig_tmp["costo_tot_proceso"] = 0;
            }


            $Merma_digital_tmp = $ventas_model->getCotizaMermaDigital();

            foreach ($Merma_digital_tmp as $row) {

                $cantidad_minima = intval($row['cantidad_minima']);
                $cantidad        = intval($row['cantidad']);
                $por_cada_x      = intval($row['por_cada_x']);
                $adicional       = intval($row['adicional']);
            }


            if (is_array($Merma_digital_tmp)) {

                unset($Merma_digital_tmp);
            }

            $merma_color      = 0;
            $merma_color_adic = 0;
            $num_tintas_adic  = 0;

            $num_tintas_tmp  = 1;
            $num_tintas_adic = 1;

            $cantidad_color_merma = $tiraje;


            if ($tiraje < $cantidad_minima) {

                $merma_color      = $cantidad_color_merma;
                $merma_color_adic = 0;
                $merma_tot        = $merma_color + $merma_color_adic;
            } else {

                $cantidad_adic = $tiraje - $cantidad_minima;

                $cant_adic = self::Deltax($cantidad_adic, $por_cada_x);

                $merma_color      = $cantidad_color_merma;
                $merma_color_adic = $cant_adic * $adicional;
                $merma_tot        = $merma_color + $merma_color_adic;
            }

            $merma_tot = $merma_color + $merma_color_adic;

            $aMerma_DigBCaj = [];

            $aMerma_DigBCaj['merma_min']      = $merma_color;
            $aMerma_DigBCaj['merma_adic']     = $merma_color_adic;
            $aMerma_DigBCaj['merma_tot']      = $merma_tot;
            $aMerma_DigBCaj['costo_unitario'] = floatval($costo_unitario_digital);
            $aMerma_DigBCaj['costo_tot']      = round(floatval($tot_pliegos * $costo_unitario_digital), 2);

            $aDig_tmp['mermas'] = $aMerma_DigBCaj;

            unset($aMerma_DigBCaj);
        } else {

            $aDig_tmp['cabe_digital']      = "NO";
            $aDig_tmp['tiraje']            = $tiraje;
            $aDig_tmp['tipo_impresion']    = $nomb_tam_emp;
            $aDig_tmp['imp_ancho']         = $imp_ancho;
            $aDig_tmp['imp_largo']         = $imp_largo;
            $aDig_tmp["corte_ancho"]       = $corte_ancho_proceso;
            $aDig_tmp["corte_largo"]       = $corte_largo_proceso;
            $aDig_tmp["cortes_por_pliego"] = $cortes_por_pliego;
            $aDig_tmp["costo_unitario"]    = $costo_unitario_digital;
            $aDig_tmp["tot_pliegos"]       = $tot_pliegos;
            $aDig_tmp["costo_tot_proceso"] = $costo_tot_proceso;
        }

        return $aDig_tmp;
    }


    // calcula los costos de serigrafia
    protected function calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model) {


        $aSerigrafia_tmp = [];

        $l_ok = true;

        $aSerigrafia_tmp['tipo']              = $tipo_offset_serigrafia;
        $aSerigrafia_tmp['cantidad']          = $tiraje;
        $aSerigrafia_tmp['num_tintas']        = $num_tintas;
        $aSerigrafia_tmp['papel_corte_ancho'] = $papel_corte_ancho;
        $aSerigrafia_tmp['papel_corte_largo'] = $papel_corte_largo;

        // Arreglo
        $arreglo_db_tmp = $ventas_model->costo_arreglo_serigrafia("Arreglo");

        $costo_unitario_arreglo = $arreglo_db_tmp['costo_unitario'];
        $costo_unitario_arreglo = round(floatval($costo_unitario_arreglo), 2);

        $por_cada = $arreglo_db_tmp['por_cada'];

        $delta = self::Deltax($tiraje, $por_cada);

        $costo_arreglo = round(floatval($costo_unitario_arreglo * $delta * $num_tintas), 2);


        if (is_array($arreglo_db_tmp)) {

            unset($arreglo_db_tmp);
        }

        if ($costo_unitario_arreglo <= 0) {

            $l_ok = false;
        }


        if ($tipo_offset_serigrafia == "Seleccion") {

            $rango_db_tmp = $ventas_model->costo_serigrafia_rango("cantidad");
        } else {

            $rango_db_tmp = $ventas_model->costo_serigrafia_rango("cantidad Pantone");
        }


        $costo_unitario_tiro = 0;
        $por_cada            = 0;
        $delta               = 0;
        $tiraje_min          = 0;
        $tiraje_max          = 0;

        foreach ($rango_db_tmp as $row) {

            $tiraje_min = intval($row['tiraje_minimo']);
            $tiraje_max = intval($row['tiraje_maximo']);

            if ($tiraje >= $tiraje_min and $tiraje <= $tiraje_max) {

                $costo_unitario_tiro = $row['costo_unitario'];
                $costo_unitario_tiro = round(floatval($costo_unitario_tiro), 2);

                $por_cada = intval($row['por_cada']);

                break;
            }
        }


        if (is_array($rango_db_tmp)) {

            unset($rango_db_tmp);

        }

        if ($costo_unitario_tiro <= 0) {

            $l_ok = false;
        }


        $delta = self::Deltax($tiraje, $por_cada);

        $costo_tiro = round(floatval($costo_unitario_tiro * $delta * $num_tintas), 2);

        $costo_tot_serigrafia = round(floatval($costo_tiro + $costo_arreglo), 2);
        $costo_tot_serigrafia = round($costo_tot_serigrafia, 2);


        $aSerigrafia_tmp['costo_unit_arreglo']  = floatval($costo_unitario_arreglo);
        $aSerigrafia_tmp['costo_arreglo']       = $costo_arreglo;
        $aSerigrafia_tmp['costo_unitario_tiro'] = $costo_unitario_tiro;
        $aSerigrafia_tmp['costo_tiro']          = $costo_tiro;
        $aSerigrafia_tmp['costo_tot_proceso']   = $costo_tot_serigrafia;

        if (!$l_ok) {

            $aSerigrafia_tmp['costo_tot_proceso'] = 0;
        }

        return $aSerigrafia_tmp;
    }


    protected function calcTamDigital($corte_ancho_proceso, $corte_largo_proceso) {

        // medidas fisicas de impresion de la maquina digital(en cms)
        $ancho_fis = 33;
        $largo_fis = 100;

        $aTam = [];

        if ( $ancho_fis > $corte_ancho_proceso and $largo_fis > $corte_largo_proceso ) {

            // tamaño carta
            $imp_ancho_dig = 20.5;
            $imp_largo_dig = 27;

            // tamaño doble carta
            $imp_ancho_dig2 = 32;
            $imp_largo_dig2 = 46.5;

            if ( $imp_ancho_dig > $corte_ancho_proceso and $imp_largo_dig > $corte_largo_proceso ) {

                $aTam[0]               = "TC";
                $aTam[1]               = 1;
                $aTam['imp_ancho_dig'] = $imp_ancho_dig;
                $aTam['imp_largo_dig'] = $imp_largo_dig;
                $aTam['tipo_digital']  = "Frente Carta";
                $aTam['cabe_digital']  = "SI";
            } elseif ( $imp_ancho_dig2 > $corte_ancho_proceso and $imp_largo_dig2 > $corte_largo_proceso ) {

                $aTam[0]               = "T2C";
                $aTam[1]               = 1;
                $aTam['imp_ancho_dig'] = $imp_ancho_dig;
                $aTam['imp_largo_dig'] = $imp_largo_dig;
                $aTam['tipo_digital']  = "Frente Doble Carta";
                $aTam['cabe_digital']  = "SI";
            }
        } else {

            $aTam[0]              = "";
            $aTam[1]              = 0;
            $aTam['tipo_digital'] = "";
        }

        return $aTam;
    }


    protected function esDigital($nomb_tam_emp) {

        $tam = "";
        $tam1 = 0;

        $aTam = [];

        switch ($nomb_tam_emp) {
            case 'Frente Carta':

                $imp_ancho_dig = 20.5;
                $imp_largo_dig = 27;
                $tam = "TC";
                $tam1 = 1;

                break;
            case 'Vuelta Carta':

                $imp_ancho_dig = 20.5;
                $imp_largo_dig = 27;
                $tam = "TC";
                $tam1 = 1;

                break;
            case 'Frente Doble Carta':

                $imp_ancho_dig = 32;
                $imp_largo_dig = 46.5;
                $tam = "T2C";
                $tam1 = 1;

                break;
            case 'Vuelta Doble Carta':

                $imp_ancho_dig = 32;
                $imp_largo_dig = 46.5;
                $tam = "T2C";
                $tam1 = 1;

                break;
        }

        $aTam[0] = $tam;
        $aTam[1] = $tam1;
        $aTam['imp_ancho_dig'] = $imp_ancho_dig;
        $aTam['imp_largo_dig'] = $imp_largo_dig;

        return $aTam;
    }


    // Checa si la ODT (Offset) se va a maquila
    protected function recMaquila($ancho, $largo) {

        $datox = floatval($ancho);
        $datoy = floatval($largo);

        $datox1 = intval(51);
        $datoy1 = intval(70);

        $datox2 = intval(72);
        $datoy2 = intval(102);


        // medidas entre rangos
        if ( ($datox >= $datox1 and $datox <= $datox2) or ($datoy >= $datoy1 and $datoy <= $datoy2) ) {

            return true;
        } else {

            return false;
        }
    }


    protected function calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $corte_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model) {

        $Off_maq_tmp = [];

        $l_ok = true;

        $Off_maq_tmp["es_maquila"]        = "SI";
        $Off_maq_tmp["Tipo"]              = $nombre_tipo_offset;
        $Off_maq_tmp["cantidad"]          = $tiraje;
        $Off_maq_tmp["num_tintas"]        = $num_tintas;
        $Off_maq_tmp["papel_corte_ancho"] = $papel_corte_ancho;
        $Off_maq_tmp["papel_corte_largo"] = $papel_corte_largo;


        if ($nombre_tipo_offset == "Seleccion") {

            // Maquila arreglo
            $db_tmp = $ventas_model->costo_offset("Maquila Arreglo");

            $arreglo_costo_unitario = 0;

            foreach ($db_tmp as $row) {

                $arreglo_costo_unitario = $row['costo_unitario'];
                $arreglo_costo_unitario = round(floatval($arreglo_costo_unitario), 2);
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }

            if ($arreglo_costo_unitario <= 0) {

                $l_ok = false;
            }

            $costo_arreglo = $arreglo_costo_unitario * $num_tintas;
            $costo_arreglo = round(floatval($costo_arreglo), 2);


            $Off_maq_tmp["arreglo_costo_unitario"] = $arreglo_costo_unitario;
            $Off_maq_tmp["arreglo_costo"]          = $costo_arreglo;


            // Maquila lamina
            $db_tmp = $ventas_model->costo_offset("Maquila Lamina");

            $costo_unitario_laminas_maquila = 0;

            foreach ($db_tmp as $row) {

                $costo_unitario_laminas_maquila = $row['costo_unitario'];
                $costo_unitario_laminas_maquila = round(floatval($costo_unitario_laminas_maquila), 2);
            }


            if (is_array($db_tmp)) {

                unset($db_tmp);
            }

            if ($costo_unitario_laminas_maquila <= 0) {

                $l_ok = false;
            }

            $costo_laminas = $costo_unitario_laminas_maquila * $num_tintas;
            $costo_laminas = round(floatval($costo_laminas), 2);

            $Off_maq_tmp["costo_unitario_laminas"] = $costo_unitario_laminas_maquila;
            $Off_maq_tmp["costo_laminas"]          = $costo_laminas;



            // Maquila
            $maquila_db_rango = $ventas_model->costo_offset("Maquila");

            $maquila_costo_unitario = 0;
            $por_millar_maq         = 1;

            foreach ($maquila_db_rango as $row) {

                $tiraje_min_maq = intval($row['tiraje_minimo']);
                $tiraje_max_maq = intval($row['tiraje_maximo']);

                if ($tiraje >= $tiraje_min_maq and $tiraje <= $tiraje_max_maq) {

                    $maquila_costo_unitario = $row['costo_unitario'];
                    $maquila_costo_unitario = round(floatval($maquila_costo_unitario), 2);

                    $por_millar_maq = $row['por_millar'];
                    $por_millar_maq = intval($por_millar_maq);

                    break;
                }
            }

            if (is_array($maquila_db_rango)) {

                unset($maquila_db_rango);
            }


            if ($maquila_costo_unitario <= 0 or $por_millar_maq <= 0) {

                $l_ok = false;
            }

            $delta_maq = self::Deltax($tiraje, $por_millar_maq);

            $costo_maquila = $delta_maq * $maquila_costo_unitario * $num_tintas;
            $costo_maquila = round(floatval($costo_maquila), 2);


            $costo_proceso_maq = round(floatval($costo_arreglo + $costo_laminas + $costo_maquila), 2);


            $Off_maq_tmp["costo_unitario_maq"] = $maquila_costo_unitario;
            $Off_maq_tmp["costo_tot_maq"]      = $costo_maquila;
            $Off_maq_tmp["costo_tot_proceso"]  = $costo_proceso_maq;

            if (!$l_ok) {

                $Off_maq_tmp["costo_tot_proceso"] = 0;
            }
        }



        if ($nombre_tipo_offset == "Pantone") {

            $db_tmp = $ventas_model->costo_offset("Maquila Arreglo Pantone");

            $costo_maq_arreglo_pantone = 0;

            foreach ($db_tmp as $row) {

                 $costo_maq_arreglo_pantone = $row['costo_unitario'];

                 $costo_maq_arreglo_pantone = round(floatval($costo_maq_arreglo_pantone), 2);
            }

            if (is_array($db_tmp)) {

                unset($db_tmp);
            }

            if($costo_maq_arreglo_pantone <= 0) {

                $l_ok = false;
            }


            $arreglo_costo = round(floatval($costo_maq_arreglo_pantone * $num_tintas), 2);


            $Off_maq_tmp['arreglo_costo_unitario'] = $costo_maq_arreglo_pantone;
            $Off_maq_tmp['arreglo_costo']          = $arreglo_costo;


            // Lamina Pantone
            $db_tmp = $ventas_model->costo_offset("Maquila Lamina Pantone");

            $costo_maq_lamina_pantone = 0;

            foreach ($db_tmp as $row) {

                 $costo_maq_lamina_pantone = $row['costo_unitario'];

                 $costo_maq_lamina_pantone = round(floatval($costo_maq_lamina_pantone), 2);
            }

            if (is_array($db_tmp)) {

                unset($db_tmp);
            }

            if ($costo_maq_lamina_pantone <= 0) {

                $l_ok = false;
            }

            $costo_laminas = round(floatval($costo_maq_lamina_pantone * $num_tintas), 2);

            $Off_maq_tmp['costo_unitario_laminas'] = $costo_maq_lamina_pantone;
            $Off_maq_tmp['costo_laminas']          = $costo_laminas;


             // Maquila
            $maquila_db_rango = $ventas_model->costo_offset("Maquila Pantone");


            $maquila_costo_unitario = 0;
            $por_millar_maq         = 1;

            foreach ($maquila_db_rango as $row) {

                $tiraje_min_maq = intval($row['tiraje_minimo']);
                $tiraje_max_maq = intval($row['tiraje_maximo']);

                if ($tiraje >= $tiraje_min_maq and $tiraje <= $tiraje_max_maq) {

                    $maquila_costo_unitario = round(floatval($row['costo_unitario']), 2);

                    $por_millar_maq = intval($row['por_millar']);

                    break;
                }
            }

            if (is_array($maquila_db_rango)) {

                unset($maquila_db_rango);
            }

            if ($maquila_costo_unitario <= 0 or $por_millar_maq <= 0) {

                $l_ok = false;
            }


            $delta = self::Deltax($tiraje, $por_millar_maq);

            $costo_maquila     = round(floatval($delta * $maquila_costo_unitario * $num_tintas), 2);
            $costo_proceso_maq = round(floatval($arreglo_costo + $costo_laminas + $costo_maquila), 2);


            $Off_maq_tmp["costo_unitario_maq"] = $maquila_costo_unitario;
            $Off_maq_tmp["costo_tot_maq"]      = $costo_maquila;
            $Off_maq_tmp["costo_tot_proceso"]  = $costo_proceso_maq;

            if (!$l_ok) {

                $Off_maq_tmp["costo_tot_proceso"] = 0;
            }
        }

        return $Off_maq_tmp;
    }


    protected function calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel_merma, $ventas_model) {

        $sql_tabla_temp_db = $ventas_model->costo_offset_color_merma();

        foreach ($sql_tabla_temp_db as $row) {

            $cantidad_minima = intval($row['cantidad_minima']);
            $c_4colores      = intval($row['c_4colores']);
            $c_3colores      = intval($row['c_3colores']);
            $c_2colores      = intval($row['c_2colores']);
            $c_1color        = intval($row['c_1color']);
            $por_cada_x      = intval($row['por_cada_x']);

            $adicional_4colores = intval($row['adicional_4colores']);
            $adicional_3colores = intval($row['adicional_3colores']);
            $adicional_2colores = intval($row['adicional_2colores']);
            $adicional_1color   = intval($row['adicional_1color']);
        }


        $merma_color      = 0;
        $merma_color_adic = 0;
        $num_tintas_adic  = 0;

        $num_tintas_adic = $num_tintas - 4;


        if ($num_tintas >= 1 and $num_tintas <= 4) {

            switch ($num_tintas) {

                case 1:

                    $cantidad_color_merma = $c_1color;

                    break;
                case 2:

                    $cantidad_color_merma = $c_2colores;

                    break;
                case 3:

                    $cantidad_color_merma = $c_3colores;

                    break;
                case 4:

                    $cantidad_color_merma = $c_4colores;

                    break;
            }
        }


        if ($tiraje < $cantidad_minima) {

            if ($num_tintas >= 1 and $num_tintas <= 4) {

                $merma_color      = $cantidad_color_merma;
                $merma_color_adic = 0;
                $merma_tot        = $merma_color + $merma_color_adic;
            } elseif ($num_tintas > 4) {

                $n_tintas_adic = $num_tintas - 4;

                // colores adicionales
                $merma_color_adic = $adicional_1color * $n_tintas_adic;

                $merma_color      = $c_4colores;
                $merma_color_adic = $merma_color_adic;
                $merma_tot        = $merma_color + $merma_color_adic;
            }
        } else {

            $cantidad_adic = $tiraje - $cantidad_minima;

            //$cant_adic = $cantidad_adic / $por_cada_x;
            $cant_adic = self::Deltax($cantidad_adic, $por_cada_x);

            if ($num_tintas >= 1 and $num_tintas <= 4) {

                $merma_color      = $cantidad_color_merma;
                $merma_color_adic = $cant_adic * $cantidad_color_merma;
                $merma_tot        = $merma_color + $merma_color_adic;
            } else {

                $merma_color = $c_4colores;
                $merma_color_adic = (($num_tintas - 4) * $adicional_1color * $cant_adic);
                $merma_tot = $merma_color + $merma_color_adic;
            }
        }


        $merma_tot = $merma_color + $merma_color_adic;

        $tot_pliegos = self::Deltax($merma_tot, $cortes_por_pliego);

        $costo_tot_pliegos_merma = round(floatval($tot_pliegos * $costo_unit_papel_merma), 3);


        $aMerma_offset_tmp = [];

        $aMerma_offset_tmp['merma_min']               = $merma_color;
        $aMerma_offset_tmp['merma_adic']              = $merma_color_adic;
        $aMerma_offset_tmp['merma_tot']               = $merma_tot;
        $aMerma_offset_tmp['cortes_por_pliego']       = $cortes_por_pliego;
        $aMerma_offset_tmp['merma_tot_pliegos']       = $tot_pliegos;
        $aMerma_offset_tmp['costo_unit_papel_merma']  = $costo_unit_papel_merma;
        $aMerma_offset_tmp['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;


        if (is_array($sql_tabla_temp_db)) {

            unset($sql_tabla_temp_db);
        }

        return $aMerma_offset_tmp;
    }


    protected function calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional) {

        $tiraje = intval($_POST['qty']);

        $merma_acabados = [];

        if ($tiraje < $cantidad_minima) {

            $cantidad_min  = intval($cantidad);
            $cantidad_adic = 0;
            $cantidad_tot  = intval($cantidad);
        } else {

            $cantidad_min  = intval($cantidad);

            $delta_tmp = intval($tiraje - $cantidad_minima);

            $delta = self::Deltax($delta_tmp, $por_cada_x);

            $cantidad_adic = intval($delta * $adicional);
            $cantidad_tot  = intval($cantidad) + $cantidad_adic;
        }

        $merma_acabados[0] = $cantidad_min;
        $merma_acabados[1] = $cantidad_adic;
        $merma_acabados[2] = $cantidad_tot;

        return $merma_acabados;
    }


    protected function calculoBarniz($tipoGrabado, $tiraje, $AnchoBarniz, $LargoBarniz, $ventas_model) {

        $l_ok = true;

        $db_tmp = $ventas_model->costo_BarnizUV($tipoGrabado);

        $costo_unitario_barniz = 0;

        foreach ($db_tmp as $row) {

            $barniz_tiraje_minimo = $row['tiraje_minimo'];
            $barniz_tiraje_minimo = intval($barniz_tiraje_minimo);

            $barniz_tiraje_maximo = $row['tiraje_maximo'];
            $barniz_tiraje_maximo = intval($barniz_tiraje_maximo);

            if ($tiraje >= $barniz_tiraje_minimo and $tiraje <= $barniz_tiraje_maximo) {

                $costo_unitario_barniz = $row['costo_unitario'];

                $costo_unitario_barniz = round(floatval($row['costo_unitario']), 2);

                $costo_minimo = $row['costo_minimo'];
                $costo_minimo = round(floatval($costo_minimo), 2);

                break;
            }
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($costo_unitario_barniz <= 0) {

            $l_ok = false;
        }


        $area_barniz = round(floatval($LargoBarniz / 100) * floatval($AnchoBarniz / 100), 4);

        $costo_barniz = floatval($area_barniz * $costo_unitario_barniz * intval($tiraje));

        $costo_barniz = round($costo_barniz, 2);

        if ($costo_barniz < $costo_minimo) {

            $costo_barniz = $costo_minimo;
        }

        $barniz_temp = [];

        $barniz_temp['tiraje']            = $tiraje;
        $barniz_temp['tipoGrabado']       = $tipoGrabado;
        $barniz_temp['Largo']             = floatval($LargoBarniz);
        $barniz_temp['Ancho']             = floatval($AnchoBarniz);
        $barniz_temp['area']              = $area_barniz;
        $barniz_temp['costo_unitario']    = $costo_unitario_barniz;
        $barniz_temp['costo_tot_proceso'] = $costo_barniz;

        if (!$l_ok) {

            $barniz_temp['costo_tot_proceso'] = 0;
        }

        return $barniz_temp;
    }


    protected function calculoLaser($tipoGrabado, $tiraje, $ventas_model) {

        $costo_laser_temp = $ventas_model->costo_laser($tipoGrabado);

        $costo_unitario_laser = 0;
        $tiempo_requerido     = 0;
        $merma_min            = 0;
        $merma_tot            = 0;

        foreach ($costo_laser_temp as $row) {

            $costo_unitario_laser = $row['costo_unitario'];
            $costo_unitario_laser = round(floatval($costo_unitario_laser), 2);

            $tiempo_requerido = $row['tiempo_requerido'];
            $tiempo_requerido = intval($tiempo_requerido);

            $merma_min = $row['merma_min'];
            $merma_min = intval($merma_min);

            $merma_tot = round(floatval($costo_unitario_laser * $merma_min), 2);
        }

        if (is_array($costo_laser_temp)) {

            unset($costo_laser_temp);
        }


        $costo_laser = floatval($tiempo_requerido * $costo_unitario_laser * $tiraje);
        $costo_laser = round($costo_laser, 2);


        $laser_tmp = [];

        $laser_tmp['tiraje']            = $tiraje;
        $laser_tmp['tipo_grabado']      = $tipoGrabado;
        $laser_tmp['costo_unitario']    = $costo_unitario_laser;
        $laser_tmp['tiempo_requerido']  = $tiempo_requerido;
        $laser_tmp['costo_tot_proceso'] = $costo_laser;
        $laser_tmp['merma_min']         = $merma_min;
        $laser_tmp['merma_tot']         = $merma_tot;


        return $laser_tmp;
    }


    protected function calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $cortes, $papel_costo_unit, $ventas_model) {

        $l_ok = true;

        $aGrab_tmp = [];

        $placa_LargoGrab = $LargoGrab;
        $placa_AnchoGrab = $AnchoGrab;
        $placa_area      = round(floatval($placa_LargoGrab * $placa_AnchoGrab), 4);

        $aGrab_tmp['tiraje'] = $tiraje;

        switch ($tipoGrabado) {

            case 'G1 Estampado':

                // placa
                $costo_placa_tmp = $ventas_model->costo_grabado("G1 Placa");

                $placa_costo_unitario = 0;

                foreach ($costo_placa_tmp as $row) {

                    $placa_costo_unitario = $row['precio_unitario'];
                    $placa_costo_unitario = round(floatval($placa_costo_unitario), 2);

                    $placa_tamano_minimo  = floatval($row['tamano_minimo_placa']);
                }

                if (is_array($costo_placa_tmp)) {

                    unset($costo_placa_tmp);
                }

                if ($placa_area < $placa_tamano_minimo) {

                    $placa_area = $placa_tamano_minimo;
                }

                $placa_costo = floatval($placa_area * $placa_costo_unitario);
                $placa_costo = round($placa_costo, 2);

                $aGrab_tmp['tipoGrabado']          = $tipoGrabado;
                $aGrab_tmp['Largo']                = $placa_LargoGrab;
                $aGrab_tmp['Ancho']                = $placa_AnchoGrab;
                $aGrab_tmp['ubicacion']            = $ubicacionGrab;
                $aGrab_tmp['placa_area']           = $placa_area;
                $aGrab_tmp['placa_costo_unitario'] = $placa_costo_unitario;
                $aGrab_tmp['placa_costo']          = $placa_costo;

                if ($placa_costo_unitario <= 0) {

                    $l_ok = false;
                }

                // arreglo
                $costo_arreglo_tmp = $ventas_model->costo_grabado("G1 Arreglo");


                $arreglo_costo_unitario = 0;

                foreach ($costo_arreglo_tmp as $row) {

                    $arreglo_costo_unitario = round(floatval($row['precio_unitario']), 2);
                }


                if (is_array($costo_arreglo_tmp)) {

                    unset($costo_arreglo_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }

                $aGrab_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aGrab_tmp['arreglo_costo']          = $arreglo_costo_unitario;


                // tiro
                $estampado_tmp = $ventas_model->costo_grabado("G1 Estampado");

                $estampado_costo_unitario = 0;

                foreach ($estampado_tmp as $row) {

                    $tiraje_minimo = intval($row['tiraje_minimo']);
                    $tiraje_maximo = intval($row['tiraje_maximo']);

                    if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                        $estampado_costo_unitario = $row['precio_unitario'];
                        $estampado_costo_unitario = round(floatval($row['precio_unitario']), 2);

                        break;
                    }
                }

                if (is_array($estampado_tmp)) {

                    unset($estampado_tmp);
                }


                if ($estampado_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $estampado_costo_tiro = floatval($tiraje * $estampado_costo_unitario);
                $estampado_costo_tiro = round($estampado_costo_tiro, 2);

                $g1_estampado_costo_proceso = round(floatval($placa_costo + $arreglo_costo_unitario + $estampado_costo_tiro), 2);

                $aGrab_tmp['costo_unitario']    = $estampado_costo_unitario;
                $aGrab_tmp['costo_tiro']        = $estampado_costo_tiro;
                $aGrab_tmp['costo_tot_proceso'] = $g1_estampado_costo_proceso;

                if (!$l_ok) {

                    $aGrab_tmp['costo_tot_proceso'] = 0;
                }

                //$aMermaEmp['acbGrab_G1_Estampado'] = intval($_POST['grabadotot']);

                break;
            case 'G2 Estampado':

                // placa
                $costo_placa_tmp = $ventas_model->costo_grabado("G2 Placa");

                $placa_costo_unitario = 0;

                foreach ($costo_placa_tmp as $row) {

                    $placa_costo_unitario = $row['precio_unitario'];
                    $placa_costo_unitario = round(floatval($row['precio_unitario']), 2);

                    $placa_tamano_minimo  = floatval($row['tamano_minimo_placa']);
                }

                if (is_array($costo_placa_tmp)) {

                    unset($costo_placa_tmp);
                }

                if ($placa_costo_unitario <= 0) {

                    $l_ok = false;
                }

                if ($placa_area < $placa_tamano_minimo) {

                    $placa_area = $placa_tamano_minimo;
                }

                $placa_costo = round(floatval($placa_area * $placa_costo_unitario), 2);
                $placa_costo = round($placa_costo, 2);

                $aGrab_tmp['tipoGrabado']          = $tipoGrabado;
                $aGrab_tmp['Largo']                = $placa_LargoGrab;
                $aGrab_tmp['Ancho']                = $placa_AnchoGrab;
                $aGrab_tmp['ubicacion']            = $ubicacionGrab;
                $aGrab_tmp['placa_area']           = $placa_area;
                $aGrab_tmp['placa_costo_unitario'] = $placa_costo_unitario;
                $aGrab_tmp['placa_costo']          = $placa_costo;


                // arreglo
                $costo_arreglo_tmp = $ventas_model->costo_grabado("G2 Arreglo");


                $arreglo_costo_unitario = 0;

                foreach ($costo_arreglo_tmp as $row) {

                    $arreglo_costo_unitario = floatval($row['precio_unitario']);
                    $arreglo_costo_unitario = round($arreglo_costo_unitario, 2);
                }


                if (is_array($costo_arreglo_tmp)) {

                    unset($costo_arreglo_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $arreglo_costo = $arreglo_costo_unitario;

                $aGrab_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aGrab_tmp['arreglo_costo']          = $arreglo_costo;


                // tiro
                $estampado_tmp = $ventas_model->costo_grabado("G2 Estampado");

                $estampado_costo_unitario = 0;

                foreach ($estampado_tmp as $row) {

                    $tiraje_minimo = intval($row['tiraje_minimo']);
                    $tiraje_maximo = intval($row['tiraje_maximo']);

                    if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                        $estampado_costo_unitario = round(floatval($row['precio_unitario']), 2);

                        $estampado_costo_unitario = round(floatval($row['precio_unitario']), 2);

                        break;
                    }
                }

                if (is_array($estampado_tmp)) {

                    unset($estampado_tmp);
                }


                if ($estampado_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $estampado_costo_tiro       = floatval($tiraje * $estampado_costo_unitario);
                $estampado_costo_tiro       = round($estampado_costo_tiro, 2);

                $g2_estampado_costo_proceso = round(floatval($placa_costo + $arreglo_costo + $estampado_costo_tiro), 2);


                $aGrab_tmp['costo_unitario']    = $estampado_costo_unitario;
                $aGrab_tmp['costo_tiro']        = $estampado_costo_tiro;
                $aGrab_tmp['costo_tot_proceso'] = $g2_estampado_costo_proceso;

                if (!$l_ok) {

                    $aGrab_tmp['costo_tot_proceso'] = 0;
                }

                //$aMermaEmp['acbGrab_G2_Estampado'] = intval($_POST['grabadotot']);

                break;
        }


        $merma_HS = $ventas_model->merma_acabados("Grabado");

        foreach ($merma_HS as $row) {

            $cantidad_minima = intval($row['cantidad_minima']);
            $cantidad        = intval($row['cantidad']);
            $por_cada_x      = intval($row['por_cada_x']);
            $adicional       = intval($row['adicional']);
        }


        if (is_array($merma_HS)) {

            unset($merma_HS);
        }


        // calcula la merma de acabados
        $merma_HS_tmp = self::calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

        $merma_HS_tot_pliegos = intval($merma_HS_tmp[2]);
        $merma_HS_cortes      = $cortes;


        $tot_pliegos_HS = self::Deltax($merma_HS_tot_pliegos, $merma_HS_cortes);

        $costo_tot_pliegos_merma = round(floatval($papel_costo_unit * $tot_pliegos_HS), 2);

        $aMerma_tmp = [];

        $aMerma_tmp['merma_min']               = $merma_HS_tmp[0];
        $aMerma_tmp['merma_adic']              = $merma_HS_tmp[1];
        $aMerma_tmp['merma_tot']               = $merma_HS_tmp[2];
        $aMerma_tmp['cortes_por_pliego']       = $merma_HS_cortes;
        $aMerma_tmp['merma_tot_pliegos']       = $tot_pliegos_HS;
        $aMerma_tmp['costo_unit_merma']        = $papel_costo_unit;
        $aMerma_tmp['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;


        $aGrab_tmp['mermas'] = $aMerma_tmp;

        if (is_array($aMerma_tmp)) {

            unset($aMerma_tmp);
        }


        return $aGrab_tmp;
    }


    protected function calculoHotStamping($tipoGrabadoHS, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $papel_seccion, $papel_costo_unit, $ventas_model) {

        $aAcbHS_tmp = [];

        $placa_area = 0;

        $l_ok = true;

        // placa
        $placa_LargoHS = $LargoHS;
        $placa_AnchoHS = $AnchoHS;
        $placa_area    = floatval($placa_LargoHS * $placa_AnchoHS);

        $aAcbHS_tmp['tiraje'] = $tiraje;

        switch ($tipoGrabadoHS) {
            case 'Estampado':

                $db_tmp = $ventas_model->costo_hotstamping("Placa");

                $placa_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $placa_costo_unitario = $row['precio_unitario'];
                    $placa_costo_unitario = round(floatval($placa_costo_unitario), 2);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($placa_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $placa_costo = floatval($placa_area * $placa_costo_unitario);
                $placa_costo = round($placa_costo, 2);

                $aAcbHS_tmp['tipoGrabado']          = $tipoGrabadoHS;
                $aAcbHS_tmp['Largo']                = $LargoHS;
                $aAcbHS_tmp['Ancho']                = $AnchoHS;
                $aAcbHS_tmp['Color']                = $ColorHS;
                $aAcbHS_tmp['placa_area']           = $placa_area;
                $aAcbHS_tmp['placa_costo_unitario'] = $placa_costo_unitario;
                $aAcbHS_tmp['placa_costo']          = $placa_costo;


                // pelicula
                $pelicula_LargoHS = $LargoHS;
                $pelicula_AnchoHS = $AnchoHS;
                $pelicula_area    = round(floatval($pelicula_LargoHS * $pelicula_AnchoHS), 2);

                $db_tmp = $ventas_model->costo_hotstamping("Pelicula");

                $pelicula_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $pelicula_costo_unitario = $row['precio_unitario'];
                    $pelicula_costo_unitario = round(floatval($pelicula_costo_unitario), 4);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($pelicula_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $pelicula_costo = floatval($pelicula_area * $pelicula_costo_unitario * $tiraje);
                $pelicula_costo = round($pelicula_costo, 2);


                $aAcbHS_tmp['pelicula_Largo']          = $pelicula_LargoHS;
                $aAcbHS_tmp['pelicula_Ancho']          = $pelicula_AnchoHS;
                $aAcbHS_tmp['pelicula_area']           = $pelicula_area;
                $aAcbHS_tmp['pelicula_costo_unitario'] = $pelicula_costo_unitario;
                $aAcbHS_tmp['pelicula_costo']          = $pelicula_costo;


                $pelicula_area_costo_unitario = floatval($pelicula_area * $pelicula_costo_unitario);
                $pelicula_area_costo_unitario = round($pelicula_area_costo_unitario, 2);


                // arreglo
                $arreglo_LargoHS = $LargoHS;
                $arreglo_AnchoHS = $AnchoHS;
                $arreglo_area    = $arreglo_LargoHS * $arreglo_LargoHS;

                $db_tmp = $ventas_model->costo_hotstamping("Arreglo");

                $arreglo_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $arreglo_costo_unitario = $row['precio_unitario'];
                    $arreglo_costo_unitario = floatval($arreglo_costo_unitario);
                    $arreglo_costo_unitario = round($arreglo_costo_unitario, 2);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $arreglo_costo = floatval($arreglo_costo_unitario);
                $arreglo_costo = round($arreglo_costo, 2);


                $aAcbHS_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aAcbHS_tmp['arreglo_costo']          = $arreglo_costo;


                // tiro
                $db_tmp = $ventas_model->costo_hotstamping("Estampado");

                $estampado_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $tiraje_minimo = intval($row['tiraje_minimo']);
                    $tiraje_maximo = intval($row['tiraje_maximo']);

                    if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                        $estampado_costo_unitario = $row['precio_unitario'];
                        $estampado_costo_unitario = floatval($estampado_costo_unitario);
                        $estampado_costo_unitario = round($estampado_costo_unitario, 2);

                        break;
                    }
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($estampado_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $estampado_costo_tiro    = floatval($tiraje * $estampado_costo_unitario);
                $estampado_costo_tiro    = round($estampado_costo_tiro, 2);

                $estampado_costo_proceso = round(floatval($placa_costo + $pelicula_costo + $arreglo_costo + $estampado_costo_tiro), 2);

                $aAcbHS_tmp['costo_unitario']    = $estampado_costo_unitario;
                $aAcbHS_tmp['costo_tiro']        = $estampado_costo_tiro;
                $aAcbHS_tmp['costo_tot_proceso'] = round($estampado_costo_proceso, 2);

                if (!$l_ok) {

                    $aAcbHS_tmp['costo_tot_proceso'] = 0;
                }


                break;
            case 'HG1 Estampado':

                $db_tmp = $ventas_model->costo_hotstamping("HG1 Placa");

                $placa_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $placa_costo_unitario = $row['precio_unitario'];
                    $placa_costo_unitario = floatval($placa_costo_unitario);
                    $placa_costo_unitario = round($placa_costo_unitario, 2);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($placa_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $placa_costo = floatval($placa_area * $placa_costo_unitario);
                $placa_costo = round($placa_costo, 2);

                $aAcbHS_tmp['tipoGrabado']          = $tipoGrabadoHS;
                $aAcbHS_tmp['Largo']                = $LargoHS;
                $aAcbHS_tmp['Ancho']                = $AnchoHS;
                $aAcbHS_tmp['Color']                = $ColorHS;
                $aAcbHS_tmp['placa_area']           = $placa_area;
                $aAcbHS_tmp['placa_costo_unitario'] = $placa_costo_unitario;
                $aAcbHS_tmp['placa_costo']          = $placa_costo;


                // pelicula
                $pelicula_LargoHS = $LargoHS;
                $pelicula_AnchoHS = $AnchoHS;
                $pelicula_area    = round(floatval($pelicula_LargoHS * $pelicula_AnchoHS), 2);

                $db_tmp = $ventas_model->costo_hotstamping("HG1 Pelicula");

                $pelicula_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $pelicula_costo_unitario = $row['precio_unitario'];
                    $pelicula_costo_unitario = round(floatval($pelicula_costo_unitario), 4);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($pelicula_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $pelicula_costo = floatval($pelicula_area * $pelicula_costo_unitario * $tiraje);
                $pelicula_costo = round($pelicula_costo, 2);


                $aAcbHS_tmp['pelicula_Largo']          = $pelicula_LargoHS;
                $aAcbHS_tmp['pelicula_Ancho']          = $pelicula_AnchoHS;
                $aAcbHS_tmp['pelicula_area']           = $pelicula_area;
                $aAcbHS_tmp['pelicula_costo_unitario'] = $pelicula_costo_unitario;
                $aAcbHS_tmp['pelicula_costo']          = $pelicula_costo;

                $pelicula_area_costo_unitario = floatval($pelicula_area * $pelicula_costo_unitario);
                $pelicula_area_costo_unitario = round($pelicula_area_costo_unitario, 2);


                // arreglo
                $arreglo_LargoHS = $LargoHS;
                $arreglo_AnchoHS = $AnchoHS;
                $arreglo_area    = round(floatval($arreglo_LargoHS * $arreglo_LargoHS), 2);

                $db_tmp = $ventas_model->costo_hotstamping("HG1 Arreglo");

                $arreglo_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $arreglo_costo_unitario = $row['precio_unitario'];
                    $arreglo_costo_unitario = floatval($arreglo_costo_unitario);
                    $arreglo_costo_unitario = round($arreglo_costo_unitario, 2);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }

                $arreglo_costo = floatval($arreglo_costo_unitario);
                $arreglo_costo = round($arreglo_costo, 2);


                $aAcbHS_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aAcbHS_tmp['arreglo_costo']          = $arreglo_costo_unitario;


                // tiro
                $db_tmp = $ventas_model->costo_hotstamping("HG1 Estampado");

                $estampado_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $tiraje_minimo = intval($row['tiraje_minimo']);
                    $tiraje_maximo = intval($row['tiraje_maximo']);

                    if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                        $estampado_costo_unitario = $row['precio_unitario'];
                        $estampado_costo_unitario = floatval($estampado_costo_unitario);
                        $estampado_costo_unitario = round($estampado_costo_unitario, 2);

                        break;
                    }
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($estampado_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $estampado_costo_tiro = floatval($tiraje * $estampado_costo_unitario);
                $estampado_costo_tiro = round($estampado_costo_tiro, 2);

                $hg1_estampado_costo_proceso = round(floatval($placa_costo + $pelicula_costo + $arreglo_costo + $estampado_costo_tiro), 2);


                $aAcbHS_tmp['costo_unitario']    = $estampado_costo_unitario;
                $aAcbHS_tmp['costo_tiro']        = $estampado_costo_tiro;
                $aAcbHS_tmp['costo_tot_proceso'] = $hg1_estampado_costo_proceso;


                if (!$l_ok) {

                    $aAcbHS_tmp['costo_tot_proceso'] = 0;
                }


                break;
            case 'HG2 Estampado':

                $db_tmp = $ventas_model->costo_hotstamping("HG2 Placa");

                $placa_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $placa_costo_unitario = $row['precio_unitario'];
                    $placa_costo_unitario = round(floatval($placa_costo_unitario), 2);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($placa_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $placa_costo = round(floatval($placa_area * $placa_costo_unitario), 2);


                $aAcbHS_tmp['tipoGrabado']          = $tipoGrabadoHS;
                $aAcbHS_tmp['Largo']                = $LargoHS;
                $aAcbHS_tmp['Ancho']                = $AnchoHS;
                $aAcbHS_tmp['Color']                = $ColorHS;
                $aAcbHS_tmp['placa_area']           = $placa_area;
                $aAcbHS_tmp['placa_costo_unitario'] = $placa_costo_unitario;
                $aAcbHS_tmp['placa_costo']          = $placa_costo;


                // pelicula
                $pelicula_LargoHS = $LargoHS;
                $pelicula_AnchoHS = $AnchoHS;
                $pelicula_area    = $pelicula_LargoHS * $pelicula_AnchoHS;

                $db_tmp = $ventas_model->costo_hotstamping("HG2 Pelicula");

                $pelicula_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $pelicula_costo_unitario = $row['precio_unitario'];
                    $pelicula_costo_unitario = round(floatval($pelicula_costo_unitario), 4);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($pelicula_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $pelicula_costo = round(floatval($pelicula_area * $pelicula_costo_unitario * $tiraje), 2);


                $aAcbHS_tmp['pelicula_Largo']          = $pelicula_LargoHS;
                $aAcbHS_tmp['pelicula_Ancho']          = $pelicula_AnchoHS;
                $aAcbHS_tmp['pelicula_area']           = $pelicula_area;
                $aAcbHS_tmp['pelicula_costo_unitario'] = $pelicula_costo_unitario;
                $aAcbHS_tmp['pelicula_costo']          = $pelicula_costo;


                $pelicula_area_costo_unitario = floatval($pelicula_area * $pelicula_costo_unitario);
                $pelicula_area_costo_unitario = round($pelicula_area_costo_unitario, 2);


                // arreglo
                $arreglo_LargoHS = $LargoHS;
                $arreglo_AnchoHS = $AnchoHS;
                $arreglo_area    = round(floatval($arreglo_LargoHS * $arreglo_LargoHS), 2);

                $db_tmp = $ventas_model->costo_hotstamping("HG2 Arreglo");

                $arreglo_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $arreglo_costo_unitario = $row['precio_unitario'];
                    $arreglo_costo_unitario = round(floatval($arreglo_costo_unitario), 2);
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $arreglo_costo = round(floatval($arreglo_costo_unitario), 2);


                $aAcbHS_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aAcbHS_tmp['arreglo_costo']          = $arreglo_costo;


                // tiro
                $db_tmp = $ventas_model->costo_hotstamping("HG2 Estampado");

                $estampado_costo_unitario = 0;

                foreach ($db_tmp as $row) {

                    $tiraje_minimo = intval($row['tiraje_minimo']);
                    $tiraje_maximo = intval($row['tiraje_maximo']);

                    if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                        $estampado_costo_unitario = $row['precio_unitario'];
                        $estampado_costo_unitario = round(floatval($estampado_costo_unitario), 2);

                        break;
                    }
                }

                if (is_array($db_tmp)) {

                    unset($db_tmp);
                }


                if ($estampado_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $estampado_costo_tiro = round(floatval($tiraje * $estampado_costo_unitario), 2);

                $hg2_estampado_costo_proceso = round(floatval($placa_costo + $pelicula_costo + $arreglo_costo + $estampado_costo_tiro), 2);


                $aAcbHS_tmp['costo_unitario']    = $estampado_costo_unitario;
                $aAcbHS_tmp['costo_tiro']        = $estampado_costo_tiro;
                $aAcbHS_tmp['costo_tot_proceso'] = $hg2_estampado_costo_proceso;


                if (!$l_ok) {

                    $aAcbHS_tmp['costo_tot_proceso'] = 0;
                }

                break;
        }


        $merma_HS = $ventas_model->merma_acabados("HotStamping");

        foreach ($merma_HS as $row) {

            $cantidad_minima = intval($row['cantidad_minima']);
            $cantidad        = intval($row['cantidad']);
            $por_cada_x      = intval($row['por_cada_x']);
            $adicional       = intval($row['adicional']);
        }


        if (is_array($merma_HS)) {

            unset($merma_HS);
        }


        // calcula la merma de acabados
        $merma_HS_tmp = self::calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

        $merma_HS_tot_pliegos = intval($merma_HS_tmp[2]);
        $merma_HS_cortes      = $papel_seccion;

        $tot_pliegos_HS = self::Deltax($merma_HS_tot_pliegos, $merma_HS_cortes);

        $papel_costo_unit = floatval($papel_costo_unit);
        $papel_costo_unit = round($papel_costo_unit, 2);

        $costo_tot_pliegos_merma = round(floatval($papel_costo_unit * $tot_pliegos_HS), 2);

        $aMerma_HS = [];

        $aMerma_HS['merma_min']               = $merma_HS_tmp[0];
        $aMerma_HS['merma_adic']              = $merma_HS_tmp[1];
        $aMerma_HS['merma_tot']               = $merma_HS_tmp[2];
        $aMerma_HS['cortes_por_pliego']       = $merma_HS_cortes;
        $aMerma_HS['merma_tot_pliegos']       = $tot_pliegos_HS;
        $aMerma_HS['costo_unit_merma']        = $papel_costo_unit;
        $aMerma_HS['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;


        $aAcbHS_tmp['mermas'] = $aMerma_HS;


        if (is_array($aMerma_HS)) {

            unset($aMerma_HS);
        }


        return $aAcbHS_tmp;
    }


    protected function calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model) {

        $l_ok = true;

        $costo_minimo = 0;

        switch ($tipoGrabado) {
            case 'Mate':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Mate");

                break;
            case 'Soft Touch':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Soft Touch");

                break;
            case 'Anti Scratch':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Anti Scratch");

                break;
            case 'Superadherente':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Superadherente");

                break;
            case 'Brillante':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Brillante");

                break;
            case 'Anti Scratch Brillante':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Anti Scratch Brillante");

                break;
            case 'Soft Touch Brillante':

                $costo_laminado_tmp = $ventas_model->costo_laminado("Soft Touch Brillante");

                break;
        }


        $laminado_costo_unitario = 0;

        foreach ($costo_laminado_tmp as $row) {

            $laminado_tiraje_minimo = intval($row['tiraje_minimo']);
            $laminado_tiraje_maximo = intval($row['tiraje_maximo']);

            if ($tiraje >= $laminado_tiraje_minimo and $tiraje <= $laminado_tiraje_maximo) {

                $laminado_costo_unitario = floatval($row['costo_unitario']);
                $laminado_costo_unitario = round($laminado_costo_unitario, 2);

                if ($tipoGrabado == 'Mate' or $tipoGrabado == 'Brillante') {

                    $costo_minimo = round(floatval($row['costo_minimo']), 2);
                    $es_maquila   = intval($row['es_maquila']);
                }

                break;
            }
        }

        if (is_array($costo_laminado_tmp)) {

            unset($costo_laminado_tmp);
        }


        if ($laminado_costo_unitario <= 0) {

            $l_ok = false;
        }


        $area_laminado = round(floatval($LargoLam / 100) * floatval($AnchoLam / 100), 4);

        $costo_laminado = floatval($area_laminado * $laminado_costo_unitario * $tiraje);
        $costo_laminado = round($costo_laminado, 2);


        if ($costo_laminado < $costo_minimo and $costo_minimo > 0) {

            $costo_laminado = $costo_minimo;
        }


        $Lam_tmp = [];

        $Lam_tmp['tiraje']            = $tiraje;
        $Lam_tmp['tipoGrabado']       = $tipoGrabado;
        $Lam_tmp['Largo']             = $LargoLam;
        $Lam_tmp['Ancho']             = $AnchoLam;
        $Lam_tmp['area']              = $area_laminado;
        $Lam_tmp['costo_unitario']    = $laminado_costo_unitario;
        $Lam_tmp['costo_tot_proceso'] = $costo_laminado;


        if (!$l_ok) {

            $Lam_tmp['costo_tot_proceso'] = 0;
        }


        $merma_Lam = $ventas_model->merma_acabados("Laminado");

        foreach ($merma_Lam as $row) {

            $cantidad_minima = intval($row['cantidad_minima']);
            $cantidad        = intval($row['cantidad']);
            $por_cada_x      = intval($row['por_cada_x']);
            $adicional       = intval($row['adicional']);
        }


        if (is_array($merma_Lam)) {

            unset($merma_Lam);
        }


        // calcula la merma de acabados
        $merma_HS_tmp = self::calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

        $merma_HS_tot_pliegos = intval($merma_HS_tmp[2]);
        $merma_HS_cortes      = intval($cortes);


        $tot_pliegos_HS = self::Deltax($merma_HS_tot_pliegos, $merma_HS_cortes);


        $papel_costo_unit = round($papel_costo_unit, 4);

        $costo_tot_pliegos_merma = round(floatval($papel_costo_unit * $tot_pliegos_HS), 2);

        $aMerma_tmp = [];

        $aMerma_tmp['merma_min']               = $merma_HS_tmp[0];
        $aMerma_tmp['merma_adic']              = $merma_HS_tmp[1];
        $aMerma_tmp['merma_tot']               = $merma_HS_tmp[2];
        $aMerma_tmp['cortes_por_pliego']       = $merma_HS_cortes;
        $aMerma_tmp['merma_tot_pliegos']       = $tot_pliegos_HS;
        $aMerma_tmp['costo_unit_merma']        = $papel_costo_unit;
        $aMerma_tmp['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;


        $Lam_tmp['mermas'] = $aMerma_tmp;


        if (is_array($aMerma_tmp)) {

            unset($aMerma_tmp);
        }

        return $Lam_tmp;
    }


    protected function calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model, $l_merma=true) {

        $l_ok = true;

        $aSuaje_tmp = [];

        $aSuaje_tmp['tiraje']      = $tiraje;
        $aSuaje_tmp['tipoGrabado'] = $tipoGrabado;
        $aSuaje_tmp['Largo']       = $Largo;
        $aSuaje_tmp['Ancho']       = $Ancho;
        //$aSuaje_tmp['cortes']      = $cortes;

        $perimetro_suaje = round(floatval(($Largo * 2) + ($Ancho * 2)), 2);

        switch ($tipoGrabado) {
            case 'Perimetral':

                // tabla suaje
                $costo_arreglo_tmp = $ventas_model->costo_suaje("Perimetral");


                $perimetral_costo_unitario = 0;

                foreach ($costo_arreglo_tmp as $row) {

                    $perimetral_costo_unitario = floatval($row['costo_unitario']);
                    $perimetral_costo_unitario = round($perimetral_costo_unitario, 2);

                    $perimetro_minimo = intval($row['perimetro_minimo']);

                    $por_cada = intval($row['por_cada']);
                }

                if (is_array($costo_arreglo_tmp)) {

                    unset($costo_arreglo_tmp);
                }


                if ($perimetral_costo_unitario <= 0) {

                    $l_ok = false;
                }


                if ($perimetro_suaje < $perimetro_minimo) {

                    $perimetro_suaje = $perimetro_minimo;
                }

                $aSuaje_tmp['perimetro'] = $perimetro_suaje;


                $suaje_por_millar = self::Deltax($tiraje, $por_cada);

                $tabla_suaje = round(floatval($perimetro_suaje * $perimetral_costo_unitario), 2);

                $aSuaje_tmp['costo_unit_tabla_suaje'] = $perimetral_costo_unitario;
                $aSuaje_tmp['tabla_suaje'] = $tabla_suaje;


                // arreglo suaje
                $costo_arreglo_tmp = $ventas_model->costo_suaje("Arreglo");

                $arreglo_costo_unitario = 0;

                foreach ($costo_arreglo_tmp as $row) {

                    $arreglo_costo_unitario = $row['costo_unitario'];
                    $arreglo_costo_unitario = round(floatval($arreglo_costo_unitario), 2);
                }

                if (is_array($costo_arreglo_tmp)) {

                    unset($costo_arreglo_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $aSuaje_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aSuaje_tmp['arreglo']                = $arreglo_costo_unitario;


                // tiro
                $costo_tiro_tmp = $ventas_model->costo_suaje("Tiro");

                $tiro_costo_unitario = 0;

                foreach ($costo_tiro_tmp as $row) {

                    $tiro_costo_unitario = round(floatval($row['costo_unitario']), 2);
                }


                if (is_array($costo_tiro_tmp)) {

                    unset($costo_tiro_tmp);
                }


                if ($tiro_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $tiro_por_millar = self::Deltax($tiraje, $por_cada);

                $suaje_costo_tiro = round(floatval($tiro_por_millar * $tiro_costo_unitario), 2);

                $suaje_costo_proceso = round(floatval($tabla_suaje + $arreglo_costo_unitario + $suaje_costo_tiro), 2);

                $aSuaje_tmp['tiro_costo_unitario'] = $tiro_costo_unitario;
                $aSuaje_tmp['costo_tiro']          = $suaje_costo_tiro;
                $aSuaje_tmp['costo_tot_proceso']   = $suaje_costo_proceso;


                if (!$l_ok) {

                    $aSuaje_tmp['costo_tot_proceso'] = 0;
                }

                break;
            case 'Figura':

                // tabla suaje
                $costo_arreglo_tmp = $ventas_model->costo_suaje("Figura");


                $perimetral_costo_unitario = 0;

                foreach ($costo_arreglo_tmp as $row) {

                    $perimetral_costo_unitario = floatval($row['costo_unitario']);
                    $perimetral_costo_unitario = round($perimetral_costo_unitario, 2);

                    $perimetro_minimo = intval($row['perimetro_minimo']);

                    $por_cada = intval($row['por_cada']);
                }

                if (is_array($costo_arreglo_tmp)) {

                    unset($costo_arreglo_tmp);
                }


                if ($perimetral_costo_unitario <= 0) {

                    $l_ok = false;
                }


                if ($perimetro_suaje < $perimetro_minimo) {

                    $perimetro_suaje = $perimetro_minimo;
                }

                $aSuaje_tmp['perimetro'] = $perimetro_suaje;


                $suaje_por_millar = self::Deltax($tiraje, $por_cada);

                $tabla_suaje = round(floatval($perimetro_suaje * $perimetral_costo_unitario), 2);

                $aSuaje_tmp['costo_unit_tabla_suaje'] = $perimetral_costo_unitario;
                $aSuaje_tmp['tabla_suaje'] = $tabla_suaje;


                // arreglo suaje
                $costo_arreglo_tmp = $ventas_model->costo_suaje("Arreglo Figura");

                $arreglo_costo_unitario = 0;

                foreach ($costo_arreglo_tmp as $row) {

                    $arreglo_costo_unitario = $row['costo_unitario'];
                    $arreglo_costo_unitario = round(floatval($arreglo_costo_unitario), 2);
                }

                if (is_array($costo_arreglo_tmp)) {

                    unset($costo_arreglo_tmp);
                }


                if ($arreglo_costo_unitario <= 0) {

                    $l_ok = false;
                }


                $aSuaje_tmp['arreglo_costo_unitario'] = $arreglo_costo_unitario;
                $aSuaje_tmp['arreglo']                = $arreglo_costo_unitario;


                // tiro
                $costo_tiro_tmp = $ventas_model->costo_suaje("Tiro Figura");

                $tiro_costo_unitario = 0;

                foreach ($costo_tiro_tmp as $row) {

                    $tiro_costo_unitario = round(floatval($row['costo_unitario']), 2);
                }

                if (is_array($costo_tiro_tmp)) {

                    unset($costo_tiro_tmp);
                }


                if ($tiro_costo_unitario <= 0) {

                    $l_ok = false;
                }

                $tiro_por_millar = self::Deltax($tiraje, $por_cada);

                $suaje_costo_tiro    = round(floatval($tiro_por_millar * $tiro_costo_unitario), 2);

                $suaje_costo_proceso = round(floatval($tabla_suaje + $arreglo_costo_unitario + $suaje_costo_tiro), 2);


                $aSuaje_tmp['tiro_costo_unitario'] = $tiro_costo_unitario;
                $aSuaje_tmp['costo_tiro']          = $suaje_costo_tiro;
                $aSuaje_tmp['costo_tot_proceso']   = $suaje_costo_proceso;

                if(!$l_ok) {

                    $aSuaje_tmp['costo_tot_proceso'] = 0;
                }


                break;
        }

        if ($l_merma) {

            $merma_S = $ventas_model->merma_acabados("Suaje");

            foreach ($merma_S as $row) {

                $cantidad_minima = intval($row['cantidad_minima']);
                $cantidad        = intval($row['cantidad']);
                $por_cada_x      = intval($row['por_cada_x']);
                $adicional       = intval($row['adicional']);
            }


            if (is_array($merma_S)) {

                unset($merma_S);
            }


            // calcula la merma de acabados
            $merma_tmp = self::calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

            $merma_tot_pliegos = intval($merma_tmp[2]);
            $merma_cortes      = intval($cortes);


            $tot_pliegos_S = self::Deltax($merma_tot_pliegos, $merma_cortes);

            $costo_tot_pliegos_merma = round(floatval($papel_costo_unit * $tot_pliegos_S), 2);
            $costo_tot_pliegos_merma = round($costo_tot_pliegos_merma, 2);

            $aMerma_S = [];

            $aMerma_S['merma_min']               = $merma_tmp[0];
            $aMerma_S['merma_adic']              = $merma_tmp[1];
            $aMerma_S['merma_tot']               = $merma_tmp[2];
            $aMerma_S['cortes_por_pliego']       = $merma_cortes;
            $aMerma_S['merma_tot_pliegos']       = $tot_pliegos_S;
            $aMerma_S['costo_unit_merma']        = $papel_costo_unit;
            $aMerma_S['costo_tot_pliegos_merma'] = $costo_tot_pliegos_merma;

            $aSuaje_tmp['mermas'] = $aMerma_S;
        }

        return $aSuaje_tmp;
    }


    protected function arregloRanurado($ventas_model) {

        $ranurado_arreglo_costo = 0;

        $db_tmp = $ventas_model->costo_proceso("proc_ranurado", "Arreglo");

        foreach ($db_tmp as $row) {

            $ranurado_arreglo_costo = $row['precio_unitario'];
            $ranurado_arreglo_costo = round(floatval($ranurado_arreglo_costo), 2);
        }

        return $ranurado_arreglo_costo;
    }


    protected function calculoRanurado($tiraje, $ventas_model) {

        $l_ok = true;

        $calculo_tmp = [];

        $db_tmp = $ventas_model->costo_proceso("proc_ranurado", "Arreglo");

        $ranurado_arreglo_costo = 0;

        foreach ($db_tmp as $row) {

            $ranurado_arreglo_costo = $row['precio_unitario'];
            $ranurado_arreglo_costo = round(floatval($ranurado_arreglo_costo), 2);
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($ranurado_arreglo_costo <= 0) {

            $l_ok = false;
        }

        $db_tmp = $ventas_model->costo_proceso("proc_ranurado", "Por Ranura");

        $ranurado_costo_unit_por_ranura = 0;

        foreach ($db_tmp as $row) {

            $ranurado_por_ranura_costo_unitario_min = floatval($row['tiraje_minimo']);
            $ranurado_por_ranura_costo_unitario_max = floatval($row['tiraje_maximo']);

            if ($tiraje >= $ranurado_por_ranura_costo_unitario_min and $tiraje <= $ranurado_por_ranura_costo_unitario_max) {

                $ranurado_costo_unit_por_ranura = $row['precio_unitario'];
                $ranurado_costo_unit_por_ranura = round(floatval($ranurado_costo_unit_por_ranura), 2);

                break;
            }
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($ranurado_costo_unit_por_ranura <= 0) {

            $l_ok = false;
        }


        $costo_por_ranura = round(floatval($ranurado_costo_unit_por_ranura * $tiraje), 2);

        $calculo_tmp['tiraje']                = $tiraje;
        $calculo_tmp['arreglo']               = $ranurado_arreglo_costo;
        $calculo_tmp['costo_unit_por_ranura'] = $ranurado_costo_unit_por_ranura;
        $calculo_tmp['costo_por_ranura']      = $costo_por_ranura;
        $calculo_tmp['costo_tot_proceso']     = round(floatval($ranurado_arreglo_costo + $costo_por_ranura), 2);

        if (!$l_ok) {

            $calculo_tmp['costo_tot_proceso'] = 0;
        }

        return $calculo_tmp;
    }


    protected function calculoDespunteEsquinasCajon($tiraje, $ventas_model) {

        $calculo_tmp = [];

        $db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Despunte de esquinas para cajon");

        $costo_unitario_esquinas = 0;

        foreach ($db_tmp as $row) {

            $costo_unitario_esquinas = $row['precio_unitario'];
            $costo_unitario_esquinas = round(floatval($costo_unitario_esquinas), 2);
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        $costo_tot_proceso = round(floatval($costo_unitario_esquinas * $tiraje), 2);

        $calculo_tmp['tiraje']                  = $tiraje;
        $calculo_tmp['costo_unitario_esquinas'] = $costo_unitario_esquinas;
        $calculo_tmp['costo_tot_proceso']       = $costo_tot_proceso;


        return $calculo_tmp;
    }


    protected function calculoPegado($tiraje, $pegado, $ventas_model) {

        $aPegado_guarda = [];

        $precio_unitario = 0;

        $pegado_guarda_db = $ventas_model->costo_proc_caja($pegado);

        foreach($pegado_guarda_db as $row) {

            $tiraje_minimo   = $row['tirajeMinimo'];
            $tiraje_maximo   = $row['tirajeMaximo'];

            if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                $precio_unitario = $row['precioUnitario'];
                $precio_unitario = round(floatval($precio_unitario), 2);
            }
        }

        $costo_tot_pegado_guarda = floatval($precio_unitario * $tiraje);
        $costo_tot_pegado_guarda = round($costo_tot_pegado_guarda, 2);

        $aPegado_guarda['tiraje']            = $tiraje;
        $aPegado_guarda['costo_unitario']    = $precio_unitario;
        $aPegado_guarda['costo_tot_proceso'] = $costo_tot_pegado_guarda;

        return $aPegado_guarda;
    }


    protected function calculoArmadoCajaFinal($tiraje, $armado, $ventas_model) {

        $aArmado = [];

        $armado_caja_final_db = $ventas_model->costo_proc_caja($armado);

        $armado_costo_unit = 0;

        foreach ($armado_caja_final_db as $row) {

            $armado_costo_unit = $row['precioUnitario'];
            $armado_costo_unit = round(floatval($armado_costo_unit), 2);
        }


        $costo_tot_proceso = floatval($tiraje * $armado_costo_unit);

        $aArmado['tiraje']            = $tiraje;
        $aArmado['costo_unit']        = $armado_costo_unit;
        $aArmado['costo_tot_proceso'] = $costo_tot_proceso;

        return $aArmado;
    }


    protected function calculoPerforadoIman($tiraje, $ventas_model) {

        $perforado_iman = [];

        $db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Perforado para iman y puesta de iman");

        $perf_iman_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $perf_iman_tiraje_min = intval($row['tiraje_minimo']);
            $perf_iman_tiraje_max = intval($row['tiraje_maximo']);

            if ($tiraje >= $perf_iman_tiraje_min and $tiraje <= $perf_iman_tiraje_max) {

                $perf_iman_costo_unitario = $row['precio_unitario'];
                $perf_iman_costo_unitario = round(floatval($perf_iman_costo_unitario), 2);

                break;
            }
        }

        $perforado_iman_tot = round(floatval($perf_iman_costo_unitario * $tiraje), 2);

        $perforado_iman['tiraje']            = $tiraje;
        $perforado_iman['costo_unitario']    = $perf_iman_costo_unitario;
        $perforado_iman['costo_tot_proceso'] = $perforado_iman_tot;


        if (is_array($db_tmp)) {

            unset($db_tmp);
        }

        return $perforado_iman;
    }


    // encuadernacion empalme
    protected function calculoEncuadernacion($tiraje, $id_papel_exterior_cajon, $enc_cortes_fcaj, $ventas_model) {

        $l_ok = true;

        $calculo_tmp = [];

        $calculo_tmp['tiraje']            = $tiraje;
        $calculo_tmp['costo_tot_proceso'] = 0;


        // forrado de cajon
        $forrado_cajon = self::calculoForradoCajon($tiraje, $enc_cortes_fcaj, $id_papel_exterior_cajon, $ventas_model);

        $arreglo_forrado_cajon_costo_unitario = $forrado_cajon['arreglo_costo_unitario'];

        $forrado_cajon_costo_unitario = $forrado_cajon['forrado_cajon_costo_unitario'];

        if ($arreglo_forrado_cajon_costo_unitario <= 0) {

            $l_ok = false;
        }

        if ($forrado_cajon_costo_unitario <= 0) {

            $l_ok = false;
        }

        $forrado_cajon_costo = $forrado_cajon['forrado_cajon'];

        $calculo_tmp['arreglo_costo_unitario']       = $arreglo_forrado_cajon_costo_unitario;
        $calculo_tmp['arreglo_forrado_cajon_costo']  = $arreglo_forrado_cajon_costo_unitario;

        $calculo_tmp['forrado_cajon_costo_unitario'] = $forrado_cajon_costo_unitario;
        $calculo_tmp['forrado_cajon_costo']          = $forrado_cajon_costo;

        $calculo_tmp['costo_tot_proceso'] = ($arreglo_forrado_cajon_costo_unitario + $forrado_cajon_costo);


        if (!$l_ok) {

            $calculo_tmp['costo_tot_proceso'] = 0;
        }


        return $calculo_tmp;
    }


    // encuadernacion cajon
    protected function calculoEncuadernacion_FCaj($tiraje, $id_papel_exterior_cajon, $enc_cortes_fcaj, $ventas_model) {

        $l_ok = true;

        $calculo_tmp = [];

        $calculo_tmp['tiraje']            = $tiraje;
        $calculo_tmp['costo_tot_proceso'] = 0;


        // Forrado de cajon
        $db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Forrado de cajon");

        $enc_costo_unitario_forrado = 0;

        foreach ($db_tmp as $row) {

            $enc_costo_unitario_forrado = $row['precio_unitario'];
            $enc_costo_unitario_forrado = round(floatval($enc_costo_unitario_forrado), 2);
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($enc_costo_unitario_forrado <= 0) {

            $l_ok = false;
        }


        $calculo_tmp['forrado_cajon_costo_unit'] = round(floatval($enc_costo_unitario_forrado), 2);
        $calculo_tmp['forrado_de_cajon']         = round( floatval($enc_costo_unitario_forrado * $tiraje), 2);

        $costo_tot_proceso = $calculo_tmp['forrado_de_cajon'];


        // Empalme cajon
        $db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Empalme de cajon");

        $empalme_cajon_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $empalme_cajon_costo_unitario = $row['precio_unitario'];
            $empalme_cajon_costo_unitario = round(floatval($empalme_cajon_costo_unitario), 2);
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($empalme_cajon_costo_unitario <= 0) {

            $l_ok = false;
        }


        $empalme_del_cajon = round(floatval($empalme_cajon_costo_unitario * $tiraje), 2);

        $calculo_tmp['empalme_cajon_costo_unitario'] = round( floatval($empalme_cajon_costo_unitario), 2);
        $calculo_tmp['empalme_de_cajon']             = $empalme_del_cajon;


        $db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Arreglo de Forrado de cajon");

        $enc_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $enc_arreglo_forrado_tiraje_min = intval($row['tiraje_minimo']);
            $enc_arreglo_forrado_tiraje_max = intval($row['tiraje_maximo']);

            if ($tiraje >= $enc_arreglo_forrado_tiraje_min and $tiraje <= $enc_arreglo_forrado_tiraje_max) {

                $enc_costo_unitario = $row['precio_unitario'];
                $enc_costo_unitario = round(floatval($enc_costo_unitario), 2);
            }
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($enc_costo_unitario <= 0) {

            $l_ok = false;
        }


        $costo_tot_proceso = round(floatval($costo_tot_proceso + $empalme_del_cajon + $enc_costo_unitario), 2);

        $calculo_tmp['arreglo_costo_unitario'] = $enc_costo_unitario;
        $calculo_tmp['arreglo_costo']          = $enc_costo_unitario;
        $calculo_tmp['costo_tot_proceso']      = $costo_tot_proceso;

        if (!$l_ok) {

            $calculo_tmp['costo_tot_proceso'] = 0;
        }


        // Mermas de encuadernacion
        $Merma_SerEmp_tmp = $ventas_model->getCotizaMermaSerigrafia();

        foreach ($Merma_SerEmp_tmp as $row) {

            $c_1color        = intval($row['c_1color']);
            $cantidad_minima = intval($row['cantidad_minima']);
            $por_cada_x      = intval($row['por_cada_x']);
            $adic_1color     = intval($row['adicional_1color']);
        }

        if (is_array($Merma_SerEmp_tmp)) {

            unset($Merma_SerEmp_tmp);
        }


        $merma_color      = 0;
        $merma_color_adic = 0;
        $num_tintas_adic  = 0;


        if ($tiraje < $cantidad_minima) {

            $merma_color      = $c_1color;
            $merma_color_adic = 0;
            $merma_tot        = $merma_color;
        } else {

            $cantidad_adic = $tiraje - $cantidad_minima;

            $cant_adic = self:: deltax($cantidad_adic, $por_cada_x);

            $merma_color      = $c_1color;
            $merma_color_adic = $cant_adic * $adic_1color;
            $merma_tot        = $merma_color + $merma_color_adic;
        }


        $merma_tot = $merma_color + $merma_color_adic;


        $aMerma_enc_Fcaj = [];

        $aMerma_enc_Fcaj['merma_min']  = $merma_color;
        $aMerma_enc_Fcaj['merma_adic'] = $merma_color_adic;
        $aMerma_enc_Fcaj['merma_tot']  = $merma_tot;

        //$enc_cortes = json_decode($_POST['aCortes'], true);

        $tot_pliegos_merma_enc = self:: deltax($merma_tot, $enc_cortes_fcaj);
        $tot_pliegos_merma_enc = round($tot_pliegos_merma_enc, 2);


        $enc_costo_unit_fcaj_tmp = $ventas_model->getPrecioPapelById($id_papel_exterior_cajon);

        $enc_costo_unit_fcaj = round(floatval($enc_costo_unit_fcaj_tmp), 2);

        if (is_array($enc_costo_unit_fcaj_tmp)) {

            unset($enc_costo_unit_fcaj_tmp);
        }


        $aMerma_enc_Fcaj['cortes_por_pliego'] = $enc_cortes_fcaj;
        $aMerma_enc_Fcaj['merma_tot_pliegos'] = $tot_pliegos_merma_enc;
        $aMerma_enc_Fcaj['costo_unit_merma']  = $enc_costo_unit_fcaj;

        $aMerma_enc_Fcaj['costo_tot_pliegos_merma'] = round(floatval($enc_costo_unit_fcaj * $tot_pliegos_merma_enc), 2);


        $calculo_tmp['mermas'] = $aMerma_enc_Fcaj;

        if (is_array($aMerma_enc_Fcaj)) {

            unset($aMerma_enc_Fcaj);
        }

        return $calculo_tmp;
    }


//// esta función la lleva las tablas: cot_alm_encuadernacion y cot_reg_elab_ftap

    protected function calculoEncajada($tiraje, $ventas_model) {

        $calculo_tmp = [];

        $db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Encajada");

        $enc_encajada_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $enc_encajada_costo_unitario = $row['precio_unitario'];
            $enc_encajada_costo_unitario = round(floatval($enc_encajada_costo_unitario), 2);
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        $enc_costo_encajada = round(floatval($enc_encajada_costo_unitario * $tiraje), 2);

        $calculo_tmp['tiraje']            = $tiraje;
        $calculo_tmp['costo_unitario']    = $enc_encajada_costo_unitario;
        $calculo_tmp['costo_tot_proceso'] = $enc_costo_encajada;

        return $calculo_tmp;
    }


    protected function calculoElabCartera($proceso, $seccion, $base_tmp, $alto_tmp, $tiraje, $ventas_model) {

        $l_ok = true;

        $db_tmp = $ventas_model->costo_proceso($proceso, $seccion);

        $elab_car_forro_costo_unit = 0;

        foreach ($db_tmp as $row) {

            $elab_car_rango = "";

            $elab_car_forro_ancho = floatval($row['ancho']);
            $elab_car_forro_largo = floatval($row['largo']);
            $elab_car_rango       = trim(strval($row['rango']));

            if ( strlen($elab_car_rango) > 0 and ($base_tmp > $elab_car_forro_ancho or $alto_tmp > $elab_car_forro_largo) ) {

                $elab_car_forro_costo_unit = round(floatval($row['precio_unitario']), 2);

                break;
            } elseif ($base_tmp < $elab_car_forro_ancho and $alto_tmp < $elab_car_forro_largo) {

                $elab_car_forro_costo_unit = round(floatval($row['precio_unitario']), 2);

                break;
            }
        }


        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($elab_car_forro_costo_unit <= 0) {

            $l_ok = false;
        }


        $elab_forro_car_costo = floatval($elab_car_forro_costo_unit * $tiraje);


        $calculo_tmp = [];

        $calculo_tmp['tiraje']          = $tiraje;
        $calculo_tmp['costo_unit']      = $elab_car_forro_costo_unit;
        $calculo_tmp['forro_costo_tot'] = $elab_forro_car_costo;

        return $calculo_tmp;
    }


    protected function calculoPuestaBanco($tiraje, $ventas_model) {

        $db_tmp = $ventas_model->costo_encuadernacion("Puesta de banco");

        $puesta_banco_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $tiraje_minimo = intval($row['tiraje_minimo']);
            $tiraje_maximo = intval($row['tiraje_maximo']);

            if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                $puesta_banco_costo_unitario = $row['precio_unitario'];
                $puesta_banco_costo_unitario = round(floatval($puesta_banco_costo_unitario), 2);

                break;
            }
        }

        return $puesta_banco_costo_unitario;
    }


    protected function calculoEmpalmeCajon($tiraje, $ventas_model) {

        $db_tmp = $ventas_model->costo_encuadernacion("Empalme de cajon");

        $enc_empalme_cajon_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $tiraje_minimo = $row['tiraje_minimo'];
            $tiraje_minimo = intval($tiraje_minimo);

            $tiraje_maximo = $row['tiraje_maximo'];
            $tiraje_maximo = intval($tiraje_maximo);

            if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                $enc_empalme_cajon_costo_unitario = $row['precio_unitario'];
                $enc_empalme_cajon_costo_unitario = round(floatval($enc_empalme_cajon_costo_unitario), 2);

                break;
            }
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }

        $costo_tot = round(floatval($enc_empalme_cajon_costo_unitario * $tiraje), 2);

        $empalme_cajon_db = [];

        $empalme_cajon_db['costo_unitario'] = round(floatval($enc_empalme_cajon_costo_unitario), 2);
        $empalme_cajon_db['costo_tot']      = $costo_tot;


        return $empalme_cajon_db;
    }


    protected function calculoForradoCajon($tiraje, $enc_cortes_fcaj, $id_papel_exterior_cajon, $ventas_model) {

        $l_ok = true;

        $calculo_tmp_Fcaj = [];

        $calculo_tmp_Fcaj['tiraje']            = $tiraje;
        $calculo_tmp_Fcaj['costo_tot_proceso'] = 0;


        // forrado de cajon
        $db_tmp = $ventas_model->costo_encuadernacion("Forrado de cajon");
        //$db_tmp = $ventas_model->costo_proceso("proc_encuadernacion", "Forrado");

        $enc_forrado_costo_unitario = 0;

        foreach ($db_tmp as $row) {

            $tiraje_minimo = intval($row['tiraje_minimo']);
            $tiraje_maximo = intval($row['tiraje_maximo']);

            if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                $enc_forrado_costo_unitario = $row['precio_unitario'];
                $enc_forrado_costo_unitario = round(floatval($enc_forrado_costo_unitario), 2);

                break;
            }
        }

        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($enc_forrado_costo_unitario <= 0) {

            $l_ok = false;
        }


        $enc_costo_forrado_cajon = round(floatval($enc_forrado_costo_unitario * $tiraje), 2);

        //$calculo_tmp_Fcaj['costo_unit_forrado_cajon'] = $enc_forrado_costo_unitario;
        //$calculo_tmp_Fcaj['forrado_de_cajon']         = $enc_costo_forrado_cajon;


        // arreglo
        $db_tmp = $ventas_model->costo_encuadernacion("Arreglo de Forrado de cajon");

        $enc_arreglo_forrado = 0;

        foreach ($db_tmp as $row) {

            $tiraje_minimo = intval($row['tiraje_minimo']);
            $tiraje_maximo = intval($row['tiraje_maximo']);

            if ($tiraje >= $tiraje_minimo and $tiraje <= $tiraje_maximo) {

                $enc_arreglo_forrado = $row['precio_unitario'];
                $enc_arreglo_forrado = round(floatval($enc_arreglo_forrado), 2);

                break;
            }
        }


        if (is_array($db_tmp)) {

            unset($db_tmp);
        }


        if ($enc_arreglo_forrado <= 0) {

            $l_ok = false;
        }


        //$calculo_tmp_Fcaj['arreglo'] = $enc_arreglo_forrado;


        $empalme_cajon_db = self::calculoEmpalmeCajon($tiraje, $ventas_model);

        $empalme_cajon_costo_unit = $empalme_cajon_db['costo_unitario'];
        $empalme_cajon_costo_tot  = $empalme_cajon_db['costo_tot'];



        $costo_tot_proceso = round(floatval($enc_costo_forrado_cajon + $enc_arreglo_forrado + $empalme_cajon_costo_tot), 2);


        $calculo_tmp_Fcaj['arreglo_costo_unitario'] = $enc_arreglo_forrado;
        $calculo_tmp_Fcaj['arreglo_forrado_cajon']                = $enc_arreglo_forrado;
        $calculo_tmp_Fcaj['forrado_cajon_costo_unitario']         = round(floatval($enc_forrado_costo_unitario), 2);
        $calculo_tmp_Fcaj['forrado_cajon']                        = $enc_costo_forrado_cajon;
        $calculo_tmp_Fcaj['empalme_cajon_costo_unitario']         = $empalme_cajon_costo_unit;
        $calculo_tmp_Fcaj['empalme_de_cajon']                     = $empalme_cajon_costo_tot;
        $calculo_tmp_Fcaj['costo_tot_proceso']                    = $costo_tot_proceso;


       if (!$l_ok) {

            $calculo_tmp_Fcaj['costo_tot_proceso'] = 0;
        }


        // Mermas de encuadernacion
        $Merma_SerEmp_tmp = $ventas_model->getCotizaMermaSerigrafia();

        foreach ($Merma_SerEmp_tmp as $row) {

            $c_1color        = intval($row['c_1color']);
            $cantidad_minima = intval($row['cantidad_minima']);
            $por_cada_x      = intval($row['por_cada_x']);
            $adic_1color     = intval($row['adicional_1color']);
        }

        if (is_array($Merma_SerEmp_tmp)) {

            unset($Merma_SerEmp_tmp);
        }


        $merma_color      = 0;
        $merma_color_adic = 0;
        $num_tintas_adic  = 0;


        if ($tiraje < $cantidad_minima) {

            $merma_color      = $c_1color;
            $merma_color_adic = 0;
            $merma_tot        = $merma_color;
        } else {

            $cantidad_adic = $tiraje - $cantidad_minima;

            $cant_adic = self:: deltax($cantidad_adic, $por_cada_x);

            $merma_color      = $c_1color;
            $merma_color_adic = $cant_adic * $adic_1color;
            $merma_tot        = $merma_color + $merma_color_adic;
        }


        $merma_tot = $merma_color + $merma_color_adic;


        $aMerma_enc_Fcaj = [];

        $aMerma_enc_Fcaj['merma_min']         = $merma_color;
        $aMerma_enc_Fcaj['merma_adic']        = $merma_color_adic;
        $aMerma_enc_Fcaj['merma_tot']         = $merma_tot;
        $aMerma_enc_Fcaj['cortes_por_pliego'] = $enc_cortes_fcaj;

        $tot_pliegos_merma_enc = self:: deltax($merma_tot, $enc_cortes_fcaj);
        $tot_pliegos_merma_enc = round($tot_pliegos_merma_enc, 2);


        $enc_costo_unit_fcaj_tmp = $ventas_model->getPrecioPapelById($id_papel_exterior_cajon);

        $enc_costo_unit_fcaj = round(floatval($enc_costo_unit_fcaj_tmp), 2);

        if (is_array($enc_costo_unit_fcaj_tmp)) {

            unset($enc_costo_unit_fcaj_tmp);
        }


        $aMerma_enc_Fcaj['merma_tot_pliegos']       = $tot_pliegos_merma_enc;
        $aMerma_enc_Fcaj['costo_unit_merma']        = $enc_costo_unit_fcaj;
        $aMerma_enc_Fcaj['costo_tot_pliegos_merma'] = round(floatval($enc_costo_unit_fcaj * $tot_pliegos_merma_enc), 2);


        $calculo_tmp_Fcaj['mermas'] = $aMerma_enc_Fcaj;

        if (is_array($aMerma_enc_Fcaj)) {

            unset($aMerma_enc_Fcaj);
        }

        return $calculo_tmp_Fcaj;

    }


    protected function calculoAccesorios($Tipo_accesorio, $tiraje,  $ventas_model) {

        $l_ok = true;

        $costo_accesorios_tmp = $ventas_model->costo_accesorios($Tipo_accesorio);

        $costo_unit_accesorio = 0;

        foreach ($costo_accesorios_tmp as $row) {

            $costo_unit_accesorio = $row['costo_unitario'];
            $costo_unit_accesorio = round(floatval($costo_unit_accesorio), 2);
        }

        if (is_array($costo_accesorios_tmp)) {

            unset($costo_accesorios_tmp);
        }


        if ($costo_unit_accesorio <= 0) {

            $l_ok = false;
        }


        $costo_accesorio = floatval($tiraje * $costo_unit_accesorio);
        $costo_accesorio = round($costo_accesorio, 2);

        $aCosto_accesorios = [];

        $aCosto_accesorios['accesorio_costo_unitario'] = $costo_unit_accesorio;
        $aCosto_accesorios['costo_tot_proceso']        = $costo_accesorio;

        if (!$l_ok) {

            $aCosto_accesorios['costo_tot_proceso'] = 0;
        }


        return $aCosto_accesorios;
    }


    protected function calculoBancos($Tipo_banco, $tiraje, $ventas_model) {

        $l_ok = true;

        $costo_bancos_tmp = $ventas_model->costo_bancos($Tipo_banco);

        $costo_unit_banco = 0;

        foreach ($costo_bancos_tmp as $row) {

            $costo_unit_banco = $row['precio'];
            $costo_unit_banco = round(floatval($costo_unit_banco), 2);
        }

        if (is_array($costo_bancos_tmp)) {

            unset($costo_bancos_tmp);
        }


        if ($costo_unit_banco <= 0) {

            $l_ok = false;
        }


        $costo_banco = floatval($tiraje * $costo_unit_banco);
        $costo_banco = round($costo_banco, 2);


        $aCosto_Banco = [];

        $aCosto_Banco['banco_costo_unitario'] = $costo_unit_banco;
        $aCosto_Banco['costo_tot_proceso']    = $costo_banco;

        if(!$l_ok) {

            $aCosto_Banco['costo_tot_proceso'] = 0;
        }


        return $aCosto_Banco;
    }


    protected function calculoCierre($Tipo_cierre, $tiraje, $numpares, $ventas_model) {

        $l_ok = true;

        $costo_cierres_tmp = $ventas_model->costo_cierres($Tipo_cierre);

        $costo_unit_cierre = 0;

        foreach ($costo_cierres_tmp as $row) {

            $costo_unit_cierre = $row['precio'];
            $costo_unit_cierre = round(floatval($costo_unit_cierre), 2);
        }

        if (is_array($costo_cierres_tmp)) {

            unset($costo_cierres_tmp);
        }


        if ($costo_unit_cierre <= 0) {

            $l_ok = false;
        }


        $aCosto_cierre = [];

        $costo_cierre = round(floatval($tiraje * $numpares * $costo_unit_cierre), 2);


        $aCosto_cierre['cierre_costo_unitario'] = $costo_unit_cierre;
        $aCosto_cierre['costo_tot_proceso']     = $costo_cierre;

        if (!$l_ok) {

            $aCosto_cierre['costo_tot_proceso'] = 0;
        }


        return $aCosto_cierre;
    }


    protected function detalle_proc_Accesorios($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = trim(strval($nombre_tabla_tmp));

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt'] = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['id_modelo'] = intval($sql_tabla_temp_db[$j]['id_modelo']);
            $aJson_tmp[$j]['Tipo_accesorio'] = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['tipo_accesorio'])));
            $aJson_tmp[$j]['Tipo'] = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['tipo'])));
            $aJson_tmp[$j]['tiraje'] = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['Largo'] = floatval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['Ancho'] = floatval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['Color'] = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['color'])));
            $aJson_tmp[$j]['costo_unit_accesorio'] = round(floatval($sql_tabla_temp_db[$j]['costo_unit']), 2);
            $aJson_tmp[$j]['costo_accesorios'] = round(floatval($sql_tabla_temp_db[$j]['costo_tot_accesorio']), 2);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Bancos($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = trim(strval($nombre_tabla_tmp));

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt'] = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['Tipo_banco'] = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['tipo'])));
            $aJson_tmp[$j]['tiraje'] = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['largo']  = intval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['ancho']  = intval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['profundidad'] = intval($sql_tabla_temp_db[$j]['profundidad']);
            $aJson_tmp[$j]['Suaje'] = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['suaje'])));
            $aJson_tmp[$j]['costo_unit_banco'] = round(floatval($sql_tabla_temp_db[$j]['costo_unit']), 2);
            $aJson_tmp[$j]['costo_bancos'] = round(floatval($sql_tabla_temp_db[$j]['costo_tot_banco']), 2);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Cierres($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = trim(strval($nombre_tabla_tmp));

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']         = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['Tipo_cierre']    = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['tipo_cierre'])));
            $aJson_tmp[$j]['tiraje']         = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['numpares']       = intval($sql_tabla_temp_db[$j]['numpares']);
            $aJson_tmp[$j]['largo']          = intval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['ancho']          = intval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['tipo']           = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['tipo'])));
            $aJson_tmp[$j]['color']          = utf8_encode(trim(strval($sql_tabla_temp_db[$j]['color'])));
            $aJson_tmp[$j]['costo_unitario'] = round(floatval($sql_tabla_temp_db[$j]['costo_unit']), 2);
            $aJson_tmp[$j]['costo_cierre']   = round(floatval($sql_tabla_temp_db[$j]['costo_tot_cierre']), 2);
        }

        return $aJson_tmp;
    }


    /**** Inicia sumas por seccion *************/

    protected function sumaImp($nombSeccion, $aJson_tmp) {

        $sumaSeccion = 0;

        if (array_key_exists($nombSeccion, $aJson_tmp)) {

            $aNombSeccion = $aJson_tmp[$nombSeccion];


            if (array_key_exists("Offset", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Offset'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Digital", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Digital'];
                $cuantos   = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Serigrafia", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Serigrafia'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }
        }

        return $sumaSeccion;
    }


    protected function sumaAcb($nombSeccion, $aJson_tmp) {

        $sumaSeccion = 0;

        if (array_key_exists($nombSeccion, $aJson_tmp)) {

            $aNombSeccion = $aJson_tmp[$nombSeccion];


            if (array_key_exists("Barniz_UV", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Barniz_UV'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Corte_Laser", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Corte_Laser'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Grabado", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Grabado'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("HotStamping", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['HotStamping'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Laminado", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Laminado'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }

            if (array_key_exists("Suaje", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Suaje'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }
        }

        return $sumaSeccion;
    }


    protected function sumaBancos($nombSeccion, $aJson_tmp) {

        $sumaSeccion = 0;

        if (array_key_exists($nombSeccion, $aJson_tmp)) {

            $aNombSeccion = $aJson_tmp[$nombSeccion];


            if (array_key_exists("Offset", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Offset'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Digital", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Digital'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }


            if (array_key_exists("Serigrafia", $aNombSeccion)) {

                $aNomb_tmp = $aNombSeccion['Serigrafia'];
                $cuantos = count($aNomb_tmp);

                for ($i = 0; $i < $cuantos; $i++) {

                    $sumaSeccion = $sumaSeccion + $aNomb_tmp[$i]['costo_tot_proceso'];
                }
            }
        }

        return $sumaSeccion;
    }


    public function strip_slashes_recursive($variable) {

        if (is_string($variable)) {

            $variable = trim(strval($variable));
            $variable = strip_tags($variable);

            return stripslashes($variable);
        }


        if (is_array($variable)) {

            foreach($variable as $i => $value) {

                if (is_string($value)) {

                    $value = trim(strval($value));
                }

                $variable[$i] = strip_slashes_recursive($value);
            }
        }

        return $variable ;
    }

    public function saveBoxCalculate($odt, $calculadora) {

        $_SESSION['calculadora'] = $calculadora;
        $_SESSION['calculadora']['odt'] = $odt;
    }
}
