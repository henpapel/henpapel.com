<?php

class Cotizador extends Controller {

    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');

        $models = $options_model->getBoxModels();

        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
        }

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/cajas/index.php';
        require_once 'application/views/templates/footer.php';
    }


    private function almejaCalc($odt, $base, $alto, $profundidad, $grosor_cajon, $grosor_cartera) {

        $calculadora = array();

        $b = 0;
        $h = 0;
        $p = 0;
        $g = 0;
        $G = 0;
        $e = 0;
        $E = 0;


        $b = $base;
        $h = $alto;
        $p = $profundidad;
        $g = $grosor_cajon;
        $G = $grosor_cartera;

        $e = round(floatval($g / 20), 2);
        $E = round(floatval($G / 20), 2);

        // Diseño
        $b1  = round(floatval($b + (2 * $e)), 2);
        $h1  = round(floatval($h + (2 * $e)), 2);
        $p1  = round(floatval($p + $e), 2);
        $x   = round(floatval($b1 + (2 * $p1)), 2);
        $y   = round(floatval($h1 + (2 * $p1)), 2);
        $x1  = round(floatval($x + 1.2), 2);
        $y1  = round(floatval($y + 1.2), 2);
        $x11 = round(floatval($x + 1), 2);
        $y11 = round(floatval($y + 1), 2);

        //forro
        $b11 = round(floatval($x + 2 * ($e + 1.4)), 2);
        $h11 = round(floatval($y + 2 * ($e + 1.4)), 2);
        $f   = round(floatval($b11 + 1.5), 2);
        $k   = round(floatval($h11 + 1.5), 2);
        //$a11=$a1+$h1+3;
        //$h111=

        //cartera
        $B   = round(floatval($b1 + 0.2), 2);
        $H   = round(floatval($h1 + 0.1 + (2 * $e)), 2);
        $P   = round(floatval($p1 + 0.25), 2);
        $Y   = round(floatval($H + (2 * $P)), 2);
        $B1  = round(floatval($B + 2 * ($E + 1.4)), 2);
        $Y1  = round(floatval($Y + 2 *($E + 1.4)), 2);
        $B11 = round(floatval($B-1), 2);
        $Y11 = round(floatval($H + ($P - 0.5) + 2.5), 2);

        $calculadora["base"]           = $base;
        $calculadora["alto"]           = $alto;
        $calculadora["profundidad"]    = $profundidad;
        $calculadora["grosor_cajon"]   = $grosor_cajon;
        $calculadora["grosor_cartera"] = $grosor_cartera;

        $calculadora["b"] = $b;
        $calculadora["h"] = $h;
        $calculadora["p"] = $p;
        $calculadora["g"] = $g;
        $calculadora["G"] = $G;

        $calculadora["e"] = $e;
        $calculadora["E"] = $E;

        // diseño
        $calculadora["b1"]  = $b1;
        $calculadora["h1"]  = $h1;
        $calculadora["p1"]  = $p1;
        $calculadora["x"]   = $x;
        $calculadora["y"]   = $y;
        $calculadora["x1"]  = $x1;
        $calculadora["y1"]  = $y1;
        $calculadora["x11"] = $x11;
        $calculadora["y11"] = $y11;

        // forro
        $calculadora["b11"] = $b11;
        $calculadora["h11"] = $h11;
        $calculadora["f"]   = $f;
        $calculadora["k"]   = $k;

        // cartera
        $calculadora["B"]   = $B;
        $calculadora["H"]   = $H;
        $calculadora["P"]   = $P;
        $calculadora["Y"]   = $Y;
        $calculadora["B1"]  = $B1;
        $calculadora["Y1"]  = $Y1;
        $calculadora["B11"] = $B11;
        $calculadora["Y11"] = $Y11;

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


        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';

        require_once 'application/views/cotizador/listaCotizaciones.php';

        require_once 'application/views/templates/footer.php';
    }

    // llama al formulario (cajas_almeja.php)
    public function caja_almeja() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');
        $almeja_model  = $this->loadModel('AlmejaModel');

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
        require_once 'application/views/cotizador/almeja/nueva_cotizacion.php';
        echo "<script>$('#divDerecho').show('slow')</script>";
        require_once 'application/views/templates/footer.php';
    }


    // inicia actualizacion de almeja (cambia el estado y graba los nuevos calculos)
    public function actCajaAlmeja() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $ventas_model = $this->loadModel('VentasModel');

        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        $odt_anterior = "";
        $odt_nueva    = "";

        $odt_anterior = $_POST['odt_anterior'];
        $odt_anterior = self::strip_slashes_recursive($odt_anterior);

        $odt_nueva = $_POST['odt_nueva'];
        $odt_nueva = self::strip_slashes_recursive($odt_nueva);

        $id_cliente = $_POST['id_cliente'];
        $id_cliente = intval($id_cliente);

        $id_odt_ant_db = $ventas_model->getNumOdt($odt_anterior);

        foreach ($id_odt_ant_db as $row) {

            $id_odt_ant = $row['id_odt'];
            $id_odt_ant = intval($id_odt_ant);

            $_POST['id_odt_ant'] = $id_odt_ant;
        }

        if (is_array($id_odt_ant_db)) {

            unset($id_odt_ant_db);
        }

        $modifica_odt = self:: saveCaja();

        if ($modifica_odt) {

            // return true;

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'cotizador/listaCotizaciones/"';
            echo '</script>';
            //header("Location:" . URL . 'cotizador/listaCotizaciones');
        } else {

            return false;
        }
    }


    // regresa el JSON para renderizar la odt
    public function modCajaAlmeja() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');


        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        if (isset($_GET['num_odt'])) {

            $num_odt = $_GET['num_odt'];
            $num_odt = self::strip_slashes_recursive($num_odt);
        } else {

            return false;
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


        $tabla_db = $ventas_model->getNumOdt($num_odt);

        foreach ($tabla_db as $row) {

            $id_odt            = intval($row['id_odt']);
            $status            = trim($row['status']);
            $id_usuario        = intval($row['id_usuario']);
            $id_cliente        = intval($row['id_cliente']);
            $tiraje            = intval($row['tiraje']);
            $base              = floatval($row['base']);
            $alto              = floatval($row['alto']);
            $profundidad       = floatval($row['profundidad']);
            $id_vendedor       = intval($row['id_vendedor']);
            $costo_total       = round(floatval($row['costo_total']), 2);
            $subtotal          = round(floatval($row['subtotal']), 2);
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
            $keys              = self::strip_slashes_recursive($row['procesos']);
            $fecha_odt         = strtotime($row['fecha_odt']);
            $hora_odt          = strtotime($row['hora_odt']);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $id_grosor_cajon_db = $ventas_model->getIdCartonTabla($id_odt, "cot_alm_cartoncaj");
        $id_grosor_cajon    = $id_grosor_cajon_db['id_cajon'];
        $id_grosor_cajon    = intval($id_grosor_cajon);


        $id_grosor_cartera_db = $ventas_model->getIdCartonTabla($id_odt, "cot_alm_cartoncaj");
        $id_grosor_cartera    = $id_grosor_cartera_db['id_cajon'];
        $id_grosor_cartera    = intval($id_grosor_cartera);


        $id_papel_db = $ventas_model->getPapel($id_odt, "Empalme");
        foreach ($id_papel_db as $row) {

            $id_papel_empalme = intval($row['id_papel']);
        }


        $id_papel_db = $ventas_model->getPapel($id_odt, "FCajon");
        foreach ($id_papel_db as $row) {

            $id_papel_Fcajon = intval($row['id_papel']);
        }


        $id_papel_db = $ventas_model->getPapel($id_odt, "Fcartera");
        foreach ($id_papel_db as $row) {

            $id_papel_Fcartera = intval($row['id_papel']);
        }


        $id_papel_db = $ventas_model->getPapel($id_odt, "Guarda");
        foreach ($id_papel_db as $row) {

            $id_papel_guarda = intval($row['id_papel']);
        }



        $fecha = date("Y/m/d", $fecha_odt);
        $hora  = date("H:i:s", $hora_odt);


        $carton_db = $ventas_model->getDatos($id_grosor_cajon);

        $grosor_cajon = intval($carton_db['numcarton']);


        $carton_db = $ventas_model->getDatos($id_grosor_cartera);

        $grosor_cartera = intval($carton_db['numcarton']);

        if (is_array($carton_db)) {

            unset($carton_db);
        }


        $tabla_db = $ventas_model->getClientById($id_cliente);

        foreach ($tabla_db as $row) {

            $Nombre_cliente = $row['nombre'];
            $Nombre_cliente = utf8_encode(self::strip_slashes_recursive($Nombre_cliente));
        }

        $nombrecliente = $Nombre_cliente;

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $aJson = [];

        $aJson['mensaje']        = "OK";
        $aJson['error']          = "";
        $aJson['id_odt']         = $id_odt;
        $aJson['num_odt']        = $num_odt;
        $aJson['Fecha']          = $fecha;
        $aJson['hora']           = $hora;
        $aJson['modelo']         = 1;
        $aJson['id_cliente']     = $id_cliente;
        $aJson['Nombre_cliente'] = $Nombre_cliente;
        $aJson['id_usuario']     = $id_usuario;
        $aJson['tiraje']         = $tiraje;


        $tabla_db = $ventas_model->getNombUsuario($id_usuario);

        foreach ($tabla_db as $row) {

            $id_tienda = intval($row['id_tienda']);

            $nomb_usuario = self::strip_slashes_recursive($row['nombre_usuario']);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tienda_db = $ventas_model->getNombTienda($id_tienda);

        foreach ($tienda_db as $row) {

            $nomb_tienda = $row['nombre_tienda'];
            $nomb_tienda = trim($nomb_tienda);
        }


        if (is_array($tienda_db)) {

            unset($tienda_db);
        }

        $aJson['id_tienda']            = $id_tienda;
        $aJson['nomb_tienda']          = $nomb_tienda;
        $aJson['base']                 = $base;
        $aJson['alto']                 = $alto;
        $aJson['profundidad']          = $profundidad;
        $aJson['costo_odt']            = $costo_total;
        $aJson['costo_subtotal']       = round($subtotal, 2);
        $aJson['Utilidad']             = $utilidad;
        $aJson['iva']                  = $iva;
        $aJson['comisiones']           = $comisiones;
        $aJson['indirecto']            = $indirecto;
        $aJson['ventas']               = $venta;
        $aJson['descuento']            = $descuento;
        $aJson['descuento_pctje']      = $descuento_pcte;
        $aJson['ISR']                  = $ISR;
        $aJson['empaque']              = $empaque;
        $aJson['mensajeria']           = $mensajeria;

        $aJson['id_grosor_cajon']      = $id_grosor_cajon;
        $aJson['id_grosor_cartera']    = $id_grosor_cartera;
        $aJson['id_vendedor']          = $id_vendedor;
        $aJson['id_papel_empalme']     = $id_papel_empalme;
        $aJson['id_papel_Fcajon']      = $id_papel_Fcajon;
        $aJson['id_papel_Fcartera']    = $id_papel_Fcartera;
        $aJson['id_papel_guarda']      = $id_papel_guarda;


        $tabla_db = $ventas_model->getPapel($id_odt, "Empalme");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $aJson['Papel_Empalme'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getPapel($id_odt, "FCajon");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $tiraje = intval($row['tiraje']);;

        $aJson['Papel_FCaj'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getPapel($id_odt, "Fcartera");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $aJson['Papel_FCar'] = $aJson_tmp;


        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getPapel($id_odt, "Guarda");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $aJson['Papel_Guarda'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        // cartones
        $tabla_db = $ventas_model->getIdCarton($id_odt, "Cajon");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_cajon']          = intval($row['id_cajon']);
            $aJson_tmp['num_cajon']         = intval($row['num_cajon']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['papel']             = utf8_encode(self::strip_slashes_recursive($row['papel']));
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['precio']            = floatval($row['precio']);
            $aJson_tmp['ancho']             = floatval($row['ancho']);
            $aJson_tmp['largo']             = floatval($row['largo']);
            $aJson_tmp['corte_ancho']       = floatval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = floatval($row['corte_largo']);
            $aJson_tmp['piezas_por_pliego'] = intval($row['piezas_por_pliego']);
            $aJson_tmp['num_pliegos']       = intval($row['num_pliegos']);
            $aJson_tmp['costo_tot_carton']  = floatval($row['costo_tot_carton']);
        }

        $aJson['CartonCaj'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getIdCarton($id_odt, "Cartera");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_cartera']        = intval($row['id_cajon']);
            $aJson_tmp['num_cajon']         = floatval($row['num_cajon']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['papel']             = utf8_encode(self::strip_slashes_recursive($row['papel']));
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['precio']            = floatval($row['precio']);
            $aJson_tmp['ancho']             = floatval($row['ancho']);
            $aJson_tmp['largo']             = floatval($row['largo']);
            $aJson_tmp['corte_ancho']       = floatval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = floatval($row['corte_largo']);
            $aJson_tmp['piezas_por_pliego'] = intval($row['piezas_por_pliego']);
            $aJson_tmp['num_pliegos']       = intval($row['num_pliegos']);
            $aJson_tmp['costo_tot_carton']  = floatval($row['costo_tot_carton']);
        }

        $aJson['CartonCar'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }


        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        // empiezan los costos variables (procesos)

        //$aJson['error'] = $procesos . $aJson['error'];

        $tabla_procesos = [];

        //$procesos = str_replace("[", "", $procesos);
        //$procesos = str_replace("]", "", $procesos);

        $keys  = str_replace('"', "", $keys);
        $keys = explode(";", $keys);

        $num_procesos = count($keys);


        // Inicia Impresiones Empalme

        $nomb_proceso_keys = [];

        for ($i = 0; $i < $num_procesos; $i++) {

            $nombre_tabla = self::strip_slashes_recursive($keys[$i]);

            /*
            $nombre_tabla_db = $ventas_model->getNombTablaProceso($nombre_proceso_tmp);

            foreach($nombre_tabla_db as $row) {

                $nombre_tabla = trim(strval($row['nombre']));
            }
            */

            switch ($nombre_tabla) {
                case 'cot_alm_offsetemp':

                    $aJson['OffEmp'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offsetfcaj':

                    $aJson['OffFCaj'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offsetfcar':

                    $aJson['OffFCar'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offsetguarda':

                    $aJson['OffG'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_emp':

                    $aJson['Off_maq_Emp'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_fcaj':

                    $aJson['Off_maq_FCaj'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_fcar':

                    $aJson['Off_maq_FCar'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_guarda':

                    $aJson['Off_maq_G'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digemp':

                    $aJson['DigEmp'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digfcaj':

                    $aJson['DigFCaj'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digfcar':

                    $aJson['DigFCar'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digguarda':

                    $aJson['DigG'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_seremp':

                    $aJson['SerEmp'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_serfcaj':

                    $aJson['SerFCaj'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_serfcar':

                    $aJson['SerFCar'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_serguarda':

                    $aJson['SerG'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvemp':

                    $aJson['Barniz_UV'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvfcaj':

                    $aJson['BarnizFcaj'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvfcar':

                    $aJson['BarnizFcar'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvguarda':

                    $aJson['BarnizG'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laseremp':

                    $aJson['Laser'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laserfcaj':

                    $aJson['LaserFcaj'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laserfcar':

                    $aJson['LaserFcar'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laserguarda':

                    $aJson['LaserG'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabemp':

                    $aJson['Grabado'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabfcaj':

                    $aJson['GrabadoFcaj'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabfcar':

                    $aJson['GrabadoFcar'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabguarda':

                    $aJson['GrabadoG'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsemp':

                    $aJson['HotStamping'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsfcaj':

                    $aJson['HotStampingFcaj'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsfcar':

                    $aJson['HotStampingFcar'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsguarda':

                    $aJson['HotStampingG'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamemp':

                    $aJson['Laminado'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamfcaj':

                    $aJson['LaminadoFcaj'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamfcar':

                    $aJson['LaminadoFcar'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamguarda':

                    $aJson['LaminadoG'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajeemp':

                    $aJson['Suaje'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajefcaj':

                    $aJson['SuajeFcaj'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajefcar':

                    $aJson['SuajeFcar'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajeguarda':

                    $aJson['SuajeG'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_accesorios':

                    $aJson['Accesorios'] = self::detalle_proc_Accesorios($id_odt, "cot_accesorios", $ventas_model);

                    break;
                case 'cot_bancos':

                    $aJson['Bancos'] = self::detalle_proc_Bancos($id_odt, "cot_bancos", $ventas_model);

                    break;
                case 'cot_cierres':

                    $aJson['Cierres'] = self::detalle_proc_Cierres($id_odt, "cot_cierres", $ventas_model);

                    break;
            }

            $nomb_proceso_keys[] = $nombre_tabla;
        }


        json_encode($aJson);


        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/templates/cotizador/plantilla.php';
        echo "<script>$('#divDerecho').empty()</script>";
        echo "<script>$('#divIzquierdo').empty()</script>";
        echo "<script>$('#divDerecho').hide()</script>";
        require_once 'application/views/cotizador/almeja/modificacion.php';
        echo "<script>$('#divDerecho').show('slow')</script>";
        require_once 'application/views/templates/footer.php';
    }


    // Imprime
    public function impCajaAlmeja() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');


        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        if (isset($_GET['num_odt'])) {

            $num_odt = $_GET['num_odt'];
            $num_odt = self::strip_slashes_recursive($num_odt);
        } else {

            return false;
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


        $row = $ventas_model->getOdtById($num_odt);

        $id_odt            = intval($row['id_odt']);
        $status            = trim($row['status']);
        $id_usuario        = intval($row['id_usuario']);
        $id_cliente        = intval($row['id_cliente']);
        $tiraje            = intval($row['tiraje']);
        $base              = floatval($row['base']);
        $alto              = floatval($row['alto']);
        $profundidad       = floatval($row['profundidad']);
        $id_vendedor       = intval($row['id_vendedor']);
        $costo_total       = round(floatval($row['costo_total']), 2);
        $subtotal          = round(floatval($row['subtotal']), 2);
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
        $keys              = self::strip_slashes_recursive($row['procesos']);
        $fecha_odt         = strtotime($row['fecha_odt']);
        $hora_odt          = strtotime($row['hora_odt']);


        $id_grosor_cajon_db = $ventas_model->getIdCartonTabla($id_odt, "cot_alm_cartoncaj");
        $id_grosor_cajon    = $id_grosor_cajon_db['id_cajon'];
        $id_grosor_cajon    = intval($id_grosor_cajon);


        $id_grosor_cartera_db = $ventas_model->getIdCartonTabla($id_odt, "cot_alm_cartoncaj");
        $id_grosor_cartera    = $id_grosor_cartera_db['id_cajon'];
        $id_grosor_cartera    = intval($id_grosor_cartera);


        $id_papel_db = $ventas_model->getPapel($id_odt, "Empalme");
        foreach ($id_papel_db as $row) {

            $id_papel_empalme = intval($row['id_papel']);
        }


        $id_papel_db = $ventas_model->getPapel($id_odt, "FCajon");
        foreach ($id_papel_db as $row) {

            $id_papel_Fcajon = intval($row['id_papel']);
        }


        $id_papel_db = $ventas_model->getPapel($id_odt, "Fcartera");
        foreach ($id_papel_db as $row) {

            $id_papel_Fcartera = intval($row['id_papel']);
        }


        $id_papel_db = $ventas_model->getPapel($id_odt, "Guarda");
        foreach ($id_papel_db as $row) {

            $id_papel_guarda = intval($row['id_papel']);
        }



        $fecha = date("Y/m/d", $fecha_odt);
        $hora  = date("H:i:s", $hora_odt);


        $carton_db = $ventas_model->getDatos($id_grosor_cajon);

        $grosor_cajon = intval($carton_db['numcarton']);


        $carton_db = $ventas_model->getDatos($id_grosor_cartera);

        $grosor_cartera = intval($carton_db['numcarton']);

        if (is_array($carton_db)) {

            unset($carton_db);
        }


        $tabla_db = $ventas_model->getClientById($id_cliente);

        foreach ($tabla_db as $row) {

            $Nombre_cliente = $row['nombre'];
            $Nombre_cliente = utf8_encode(self::strip_slashes_recursive($Nombre_cliente));
        }

        $nombrecliente = $Nombre_cliente;

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $aJson = [];

        $aJson['mensaje']        = "OK";
        $aJson['error']          = "";
        $aJson['id_odt']         = $id_odt;
        $aJson['num_odt']        = $num_odt;
        $aJson['Fecha']          = $fecha;
        $aJson['hora']           = $hora;
        $aJson['modelo']         = 1;
        $aJson['id_cliente']     = $id_cliente;
        $aJson['Nombre_cliente'] = $Nombre_cliente;
        $aJson['id_usuario']     = $id_usuario;
        $aJson['tiraje']         = $tiraje;


        $tabla_db = $ventas_model->getNombUsuario($id_usuario);

        foreach ($tabla_db as $row) {

            $id_tienda = intval($row['id_tienda']);

            $nomb_usuario = self::strip_slashes_recursive($row['nombre_usuario']);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tienda_db = $ventas_model->getNombTienda($id_tienda);

        foreach ($tienda_db as $row) {

            $nomb_tienda = $row['nombre_tienda'];
            $nomb_tienda = trim($nomb_tienda);
        }


        if (is_array($tienda_db)) {

            unset($tienda_db);
        }

        $aJson['id_tienda']            = $id_tienda;
        $aJson['nomb_tienda']          = $nomb_tienda;
        $aJson['base']                 = $base;
        $aJson['alto']                 = $alto;
        $aJson['profundidad']          = $profundidad;
        $aJson['costo_odt']            = $costo_total;
        $aJson['costo_subtotal']       = round($subtotal, 2);
        $aJson['Utilidad']             = $utilidad;
        $aJson['iva']                  = $iva;
        $aJson['comisiones']           = $comisiones;
        $aJson['indirecto']            = $indirecto;
        $aJson['ventas']               = $venta;
        $aJson['descuento']            = $descuento;
        $aJson['descuento_pctje']      = $descuento_pcte;
        $aJson['ISR']                  = $ISR;
        $aJson['empaque']              = $empaque;
        $aJson['mensajeria']           = $mensajeria;

        $aJson['id_grosor_cajon']      = $id_grosor_cajon;
        $aJson['id_grosor_cartera']    = $id_grosor_cartera;
        $aJson['id_vendedor']          = $id_vendedor;
        $aJson['id_papel_empalme']     = $id_papel_empalme;
        $aJson['id_papel_Fcajon']      = $id_papel_Fcajon;
        $aJson['id_papel_Fcartera']    = $id_papel_Fcartera;
        $aJson['id_papel_guarda']      = $id_papel_guarda;


        $tabla_db = $ventas_model->getPapel($id_odt, "Empalme");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $aJson['Papel_Empalme'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getPapel($id_odt, "FCajon");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $tiraje = intval($row['tiraje']);;

        $aJson['Papel_FCaj'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getPapel($id_odt, "Fcartera");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $aJson['Papel_FCar'] = $aJson_tmp;


        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getPapel($id_odt, "Guarda");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_papel']          = intval($row['id_papel']);
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['ancho']             = intval($row['ancho']);
            $aJson_tmp['largo']             = intval($row['largo']);
            $aJson_tmp['corte_ancho']       = intval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = intval($row['corte_largo']);
            $aJson_tmp['costo_unitario']    = floatval($row['costo_unitario']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['cortes']            = intval($row['cortes']);
            $aJson_tmp['pliegos']           = intval($row['pliegos']);
            $aJson_tmp['costo_tot_pliegos'] = floatval($row['costo_tot_pliegos']);
        }

        $aJson['Papel_Guarda'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        // cartones
        $tabla_db = $ventas_model->getIdCarton($id_odt, "Cajon");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_cajon']          = intval($row['id_cajon']);
            $aJson_tmp['num_cajon']         = intval($row['num_cajon']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['papel']             = utf8_encode(self::strip_slashes_recursive($row['papel']));
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['precio']            = floatval($row['precio']);
            $aJson_tmp['ancho']             = floatval($row['ancho']);
            $aJson_tmp['largo']             = floatval($row['largo']);
            $aJson_tmp['corte_ancho']       = floatval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = floatval($row['corte_largo']);
            $aJson_tmp['piezas_por_pliego'] = intval($row['piezas_por_pliego']);
            $aJson_tmp['num_pliegos']       = intval($row['num_pliegos']);
            $aJson_tmp['costo_tot_carton']  = floatval($row['costo_tot_carton']);
        }

        $aJson['CartonCaj'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }

        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        $tabla_db = $ventas_model->getIdCarton($id_odt, "Cartera");

        $aJson_tmp = [];

        foreach ($tabla_db as $row) {

            $aJson_tmp['id_cartera']        = intval($row['id_cajon']);
            $aJson_tmp['num_cajon']         = floatval($row['num_cajon']);
            $aJson_tmp['tiraje']            = intval($row['tiraje']);
            $aJson_tmp['papel']             = utf8_encode(self::strip_slashes_recursive($row['papel']));
            $aJson_tmp['nombre']            = utf8_encode(self::strip_slashes_recursive($row['nombre']));
            $aJson_tmp['precio']            = floatval($row['precio']);
            $aJson_tmp['ancho']             = floatval($row['ancho']);
            $aJson_tmp['largo']             = floatval($row['largo']);
            $aJson_tmp['corte_ancho']       = floatval($row['corte_ancho']);
            $aJson_tmp['corte_largo']       = floatval($row['corte_largo']);
            $aJson_tmp['piezas_por_pliego'] = intval($row['piezas_por_pliego']);
            $aJson_tmp['num_pliegos']       = intval($row['num_pliegos']);
            $aJson_tmp['costo_tot_carton']  = floatval($row['costo_tot_carton']);
        }

        $aJson['CartonCar'] = $aJson_tmp;

        if (is_array($aJson_tmp)) {

            unset($aJson_tmp);
        }


        if (is_array($tabla_db)) {

            unset($tabla_db);
        }


        // empiezan los costos variables (procesos)

        //$aJson['error'] = $procesos . $aJson['error'];

        $tabla_procesos = [];

        //$procesos = str_replace("[", "", $procesos);
        //$procesos = str_replace("]", "", $procesos);

        $keys  = str_replace('"', "", $keys);
        $keys = explode(";", $keys);

        $num_procesos = count($keys);


        // Inicia Impresiones Empalme

        $nomb_proceso_keys = [];

        for ($i = 0; $i < $num_procesos; $i++) {

            $nombre_tabla = self::strip_slashes_recursive($keys[$i]);

            /*
            $nombre_tabla_db = $ventas_model->getNombTablaProceso($nombre_proceso_tmp);

            foreach($nombre_tabla_db as $row) {

                $nombre_tabla = trim(strval($row['nombre']));
            }
            */

            switch ($nombre_tabla) {
                case 'cot_alm_offsetemp':

                    $aJson['OffEmp'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offsetfcaj':

                    $aJson['OffFCaj'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offsetfcar':

                    $aJson['OffFCar'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offsetguarda':

                    $aJson['OffG'] = self::detalle_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_emp':

                    $aJson['Off_maq_Emp'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_fcaj':

                    $aJson['Off_maq_FCaj'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_fcar':

                    $aJson['Off_maq_FCar'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_offset_maq_guarda':

                    $aJson['Off_maq_G'] = self::detalle_maq_proc_offset($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digemp':

                    $aJson['DigEmp'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digfcaj':

                    $aJson['DigFCaj'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digfcar':

                    $aJson['DigFCar'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_digguarda':

                    $aJson['DigG'] = self::detalle_proc_digital($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_seremp':

                    $aJson['SerEmp'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_serfcaj':

                    $aJson['SerFCaj'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_serfcar':

                    $aJson['SerFCar'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_serguarda':

                    $aJson['SerG'] = self::detalle_proc_serigrafia($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvemp':

                    $aJson['Barniz_UV'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvfcaj':

                    $aJson['BarnizFcaj'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvfcar':

                    $aJson['BarnizFcar'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_barnizuvguarda':

                    $aJson['BarnizG'] = self::detalle_proc_Barniz_UV($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laseremp':

                    $aJson['Laser'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laserfcaj':

                    $aJson['LaserFcaj'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laserfcar':

                    $aJson['LaserFcar'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_laserguarda':

                    $aJson['LaserG'] = self::detalle_proc_Laser($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabemp':

                    $aJson['Grabado'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabfcaj':

                    $aJson['GrabadoFcaj'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabfcar':

                    $aJson['GrabadoFcar'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_grabguarda':

                    $aJson['GrabadoG'] = self::detalle_proc_Grabado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsemp':

                    $aJson['HotStamping'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsfcaj':

                    $aJson['HotStampingFcaj'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsfcar':

                    $aJson['HotStampingFcar'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_hsguarda':

                    $aJson['HotStampingG'] = self::detalle_proc_HotStamping($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamemp':

                    $aJson['Laminado'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamfcaj':

                    $aJson['LaminadoFcaj'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamfcar':

                    $aJson['LaminadoFcar'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_lamguarda':

                    $aJson['LaminadoG'] = self::detalle_proc_Laminado($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajeemp':

                    $aJson['Suaje'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajefcaj':

                    $aJson['SuajeFcaj'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajefcar':

                    $aJson['SuajeFcar'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_alm_suajeguarda':

                    $aJson['SuajeG'] = self::detalle_proc_Suaje($id_odt, $nombre_tabla, $ventas_model);

                    break;
                case 'cot_accesorios':

                    $aJson['Accesorios'] = self::detalle_proc_Accesorios($id_odt, "cot_accesorios", $ventas_model);

                    break;
                case 'cot_bancos':

                    $aJson['Bancos'] = self::detalle_proc_Bancos($id_odt, "cot_bancos", $ventas_model);

                    break;
                case 'cot_cierres':

                    $aJson['Cierres'] = self::detalle_proc_Cierres($id_odt, "cot_cierres", $ventas_model);

                    break;
            }

            $nomb_proceso_keys[] = $nombre_tabla;
        }


        json_encode($aJson);


        require_once 'application/views/templates/head.php';
        require_once 'application/views/cotizador/almeja/impresion.php';
        require_once 'application/views/templates/footer.php';
    }


    public function vistaAct() {

        if (isset($_GET['num_odt'])) {

            $num_odt = $_GET['num_odt'];
            //$num_odt = trim(strval($num_odt));

            //$nombrecliente = $opt->getClientInfo($_GET['cliente'],'nombre');
            //$nombrecliente = $opt->getClientInfo($_GET['cliente'],'nombre') . ' ' . $opt->getClientInfo($_GET['cliente'],'apellido');
        }


        if (isset($_GET['caja'])) {

            $caja = $_GET['caja'];
        }
    }



    // calculo del modelo caja almeja
    public function saveCaja() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        $ventas_model  = $this->loadModel('VentasModel');
        $almeja_model  = $this->loadModel('AlmejaModel');

        if(!$login->isLoged()) {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }


        $starttime = microtime(true);

        $aJson   = [];
        $aCortes = [];

        $modificar = "";
        $mensaje   = "ERROR";

        $odt = "";

        $odt = strip_tags(trim($_POST['odt']));
        $odt = strtoupper($odt);
        $odt = self::strip_slashes_recursive($odt);


        $modificar = $_POST['modificar'];
        if(isset($_POST['modificar']) and $_POST['modificar'] = "SI") {

            $modificar == "SI";

            //$l_existe = $ventas_model->chkODT();
            $l_existe = $options_model->checaODT($odt);

            if ($l_existe) {

                self::msgError("Ya hay una ODT con el mismo nombre");
            }
        } else {

            $modificar = "NO";
        }


        $_POST['odt'] = $odt;

        $id_usuario = $_SESSION['user']['id_usuario'];
        $id_usuario = intval($id_usuario);


        $nomb_usuario_db = $ventas_model->getNombUsuario($id_usuario);

        foreach ($nomb_usuario_db as $row) {

            $nomb_usuario = $row['nombre_usuario'];
            $nomb_usuario = trim($nomb_usuario);
        }


        $id_tienda = $_SESSION['user']['id_tienda'];
        $id_tienda = intval($id_tienda);

        $tienda_db = $ventas_model->getNombTienda($id_tienda);

        foreach ($tienda_db as $row) {

            $nomb_tienda = $row['nombre_tienda'];
            $nomb_tienda = trim($nomb_tienda);
        }

        $cantidad    = 0;
        $tiraje      = 0;
        $costo_total = 0;
        $costo_corte = 0;

        $cantidad = $_POST["qty"];
        $cantidad = intval($cantidad);
        $tiraje   = intval($cantidad);

        $nombre_cliente = $_POST['nombre_cliente'];
        $id_cliente     = $ventas_model->getClientByName($nombre_cliente);

        //$id_modelo = $_POST['modelo'];
        $id_modelo = 1;

        $modelo = intval($_POST['modelo']);


        $base           = 0;
        $alto           = 0;
        $profundidad    = 0;
        $grosor_cajon   = 0;
        $grosor_cartera = 0;


        $base = $_POST['base'];
        $base = floatval($base);

        $alto = $_POST['alto'];
        $alto = floatval($alto);

        if (!self::checaAnchoLargo($alto, $base)) {

            $ancho_temp = $alto;
            $largo_temp = $base;

            $base = $ancho_temp;
            $alto = $largo_temp;
        }

        $profundidad    = $_POST['profundidad'];
        $profundidad    = floatval($profundidad);

        $grosor_cajon   = $_POST['grosor-cajon'];
        $grosor_cajon   = floatval($grosor_cajon);

        $grosor_cartera = $_POST['grosor-cartera'];
        $grosor_cartera = floatval($grosor_cartera);

        $cajon          = $grosor_cajon;
        $cartera        = $grosor_cartera;

        $offset         = $_POST['offset'];
        $offset         = floatval($offset);

        $digital        = $_POST['digital'];
        $digital        = floatval($digital);

        $serigrafia     = $_POST['serigrafia'];
        $serigrafia     = floatval($serigrafia);

        $hs             = $_POST['hs'];
        $hs             = floatval($hs);

        $laminado       = $_POST['laminado'];
        $laminado       = floatval($laminado);

        $barnizadic     = $_POST['barnizadic'];
        $barnizadic     = floatval($barnizadic);

        $barniz         = $_POST['barniz'];
        $barniz         = floatval($barniz);

        $suaje          = $_POST['suaje'];
        $suaje          = floatval($suaje);

        $forrado        = $_POST['forrado'];
        $forrado        = floatval($forrado);


    // aJson
        // crea el array principal
        $aJson['tiempo_transcurrido']      = 0.00;
        $aJson['mensaje']                  = "Correcto";
        $aJson['error']                    = "";
        $aJson['nomb_odt']                 = self::strip_slashes_recursive($_POST['odt']);
        $aJson['Fecha']                    = date("Y-m-d");
        $aJson['modelo']                   = $id_modelo;
        $aJson['Nombre_cliente']           = $nombre_cliente;
        $aJson['id_cliente']               = $id_cliente;
        $aJson['id_usuario']               = $id_usuario;
        $aJson['nomb_usuario']             = $nomb_usuario;
        $aJson['tiraje']                   = $tiraje;
        $aJson['id_tienda']                = $id_tienda;
        $aJson['nomb_tienda']              = $nomb_tienda;
        $aJson['base']                     = $base;
        $aJson['alto']                     = $alto;
        $aJson['profundidad']              = $profundidad;
        $aJson['costo_odt']                = 0;
        $aJson['costo_subtotal']           = 0;
        $aJson['Utilidad']                 = 0;
        $aJson['utilidad_pctje']           = 0;
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

        $aJson['costo_corte_tot_papel']    = 0;
        $aJson['corte_tot_pliegos_carton'] = 0;
        $aJson['costo_corte_refine']       = 0;

        $aJson['costos_fijos']             = 0;
        $aJson['costo_accesorios']         = 0;
        $aJson['costo_bancos']             = 0;
        $aJson['costo_cierres']            = 0;

        $aJson['Imp_Emp']                  = 0;
        $aJson['Imp_Emp_maq']              = 0;
        $aJson['Imp_FCaj']                 = 0;
        $aJson['Imp_FCaj_maq']             = 0;
        $aJson['Imp_FCar']                 = 0;
        $aJson['Imp_FCar_maq']             = 0;
        $aJson['Imp_Guarda']               = 0;
        $aJson['Imp_Guarda_maq']           = 0;

        $aJson['Acb_Empalme']              = 0;
        $aJson['Acb_FCaj']                 = 0;
        $aJson['Acb_FCar']                 = 0;
        $aJson['Acb_Guarda']               = 0;

        $aJson['keys']                     = "";
        $aJson['Calculadora']              = [];
        $aJson['Cortes']                   = [];
        //$aJson['calculaPapel']             = [];
        //$aJson['costo_corte_tot_papel']    = [];
        //$aJson['costo_corte_tot_carton']   = [];


    // Calculadora
        $aJson['Calculadora'] = self::almejaCalc($odt, $base, $alto, $profundidad, $grosor_cajon, $grosor_cartera);


        $id_papel_empalme       = intval($_POST['optEC']);
        $id_papel_forro_cajon   = intval($_POST['optFCaj']);
        $id_papel_forro_cartera = intval($_POST['optFCar']);
        $id_papel_guarda        = intval($_POST['optG']);


/******************** Inicia calculo de papeles *******************/

    // corte papel Empalme
        $x11 = $aJson['Calculadora']['x11'];         // largo
        $x11 = floatval($x11);

        $y11 = $aJson['Calculadora']['y11'];         // ancho
        $y11 = floatval($y11);

        $secc_ancho = $y11;
        $secc_largo = $x11;

        $aJson['Papel_Empalme'] = self::calculaPapel("Empalme", $id_papel_empalme, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        if ($aJson['Papel_Empalme']['tot_costo'] <= 0 or $aJson['Papel_Empalme']['costo_unit_papel'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para papel empalme;");
        }


        if (intval($aJson['Papel_Empalme']['calculadora']['corte']['cortesT']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en Empalme;");
        }


        $aJson['Cortes']['empalme']  = intval($aJson['Papel_Empalme']['corte']);


        $aJson['costo_papeles'] = round(floatval($aJson['costo_papeles'] + $aJson['Papel_Empalme']['tot_costo']), 2);

        $aJson['costo_subtotal'] = round(floatval($aJson['costo_subtotal'] + $aJson['costo_papeles']), 2);


    // Corte papel Forro Cajon
        $f = $aJson['Calculadora']['f'];           // largo
        $f = floatval($f);

        $k = $aJson['Calculadora']['k'];           // ancho
        $k = floatval($k);

        $secc_ancho = $k;
        $secc_largo = $f;

        $aJson['Papel_FCaj'] = self::calculaPapel("FCaj", $id_papel_forro_cajon, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        if ($aJson['Papel_FCaj']['costo_unit_papel'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario papel forro del cajon;");
        }


        $papel_tot_costo = 0.0;
        $papel_tot_costo = round(floatval($aJson['Papel_FCaj']['tot_costo']), 2);

        if ($papel_tot_costo <= 0) {

            self::mError($aJson, $mensaje, "No existe costo papel forro del cajon;");
        }

        if (intval($aJson['Papel_FCaj']['calculadora']['corte']['cortesT']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en Forro del cajon;");
        }


        $aJson['Cortes']['forro_cajon'] = intval($aJson['Papel_FCaj']['calculadora']['corte']['cortesT']);


        $aJson['costo_papeles'] = round(floatval($aJson['costo_papeles'] + $papel_tot_costo), 2);

        $aJson['costo_subtotal'] = round(floatval($aJson['costo_subtotal'] + $papel_tot_costo), 2);


    // Corte papel Forro Cartera
        $B1 = $aJson['Calculadora']['B1'];
        $B1 = round(floatval($B1), 2);

        $Y1 = $aJson['Calculadora']['Y1'];
        $Y1 = round(floatval($Y1), 2);

        $secc_ancho = $B1;
        $secc_largo = $Y1;

        $aJson['Papel_FCar'] = self::calculaPapel("FCar", $id_papel_forro_cartera, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        $papel_tot_costo = round(floatval($aJson['Papel_FCar']['costo_unit_papel']), 2);

        if ($papel_tot_costo <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario papel Forro cartera;");
        }

        $papel_tot_costo = round(floatval($aJson['Papel_FCar']['tot_costo']), 2);

        if ($papel_tot_costo <= 0) {

            self::mError($aJson, $mensaje, "No existe costo papel Forro cartera;");
        }

        if (intval($aJson['Papel_FCar']['calculadora']['corte']['cortesT']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en Forro de la cartera;");
        }


        $aJson['Cortes']['forro_cartera'] = intval($aJson['Papel_FCar']['calculadora']['corte']['cortesT']);

        $aJson['costo_papeles'] = round(floatval($aJson['costo_papeles'] + $papel_tot_costo), 2);

        $aJson['costo_subtotal'] = round(floatval($aJson['costo_subtotal'] + $papel_tot_costo), 2);


    // Corte papel Guarda
        $B11 = $aJson['Calculadora']['B11'];       // largo
        $B11 = floatval($B11);

        $Y11 = $aJson['Calculadora']['Y11'];       // ancho
        $Y11 = floatval($Y11);

        $secc_ancho = $Y11;
        $secc_largo = $B11;

        $aJson['Papel_Guarda'] = self::calculaPapel("Guarda", $id_papel_guarda, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        $papel_tot_costo = round(floatval($aJson['Papel_Guarda']['costo_unit_papel']), 2);

        if ($papel_tot_costo <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario papel guarda;");
        }

        $papel_tot_costo = round(floatval($aJson['Papel_Guarda']['tot_costo']), 2);

        if (intval($aJson['Papel_Guarda']['calculadora']['corte']['cortesT']) <= 0) {

            self::mError($aJson, $mensaje, "No existe costo papel guarda;");
        }

        if (intval($aJson['Papel_Guarda']['calculadora']['corte']['cortesT']) <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al pliego en la Guarda;");
        }


        $aJson['Cortes']['guarda'] = intval($aJson['Papel_Guarda']['calculadora']['corte']['cortesT']);

        $aJson['costo_papeles'] = round(floatval($aJson['costo_papeles'] + $papel_tot_costo), 2);

        $aJson['costo_subtotal'] = round(floatval($aJson['costo_subtotal'] + $papel_tot_costo), 2);


    // Corte Grosor Cajon
        $grosor_cajon = $_POST['grosor-cajon'];
        $grosor_cajon = floatval($grosor_cajon);


        // Empalme Carton
        $x1 = $aJson['Calculadora']['x1'];         // largo
        $x1 = floatval($x1);

        $y1 = $aJson['Calculadora']['y1'];         // ancho
        $y1 = floatval($y1);

        $secc_ancho = $x1;
        $secc_largo = $y1;

        $aJson['CartonCaj'] = self::calculaPapel("grosor_cajon", $grosor_cajon, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        $cost_tot_carton = round(floatval($aJson['CartonCaj']['costo_unit_papel']), 2);

        if ($cost_tot_carton <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario carton empalme del cajon;");
        }

        $corte_cajon = intval($aJson['CartonCaj']['calculadora']['corte']['cortesT']);

        if ($corte_cajon <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al carton del cajon;");
        }

        $aJson['Cortes']['carton_cajon'] = $corte_cajon;

        $cost_tot_carton = round(floatval($aJson['CartonCaj']['tot_costo']), 2);

        if ($cost_tot_carton <= 0) {

            self::mError($aJson, $mensaje, "No existe costo carton empalme del cajon;");
        }

        $aJson['costo_cartones'] += $cost_tot_carton;
        $aJson['costo_subtotal'] += $cost_tot_carton;


    // Corte Grosor Cartera
        $grosor_cartera = $_POST['grosor-cartera'];
        $grosor_cartera = floatval($grosor_cartera);

        $B = $aJson['Calculadora']['B'];         // ancho
        $B = floatval($B);

        $Y = $aJson['Calculadora']['Y'];         // largo
        $Y = floatval($Y);

        $secc_ancho = $B;
        $secc_largo = $Y;

        $aJson['CartonCar'] = self::calculaPapel("grosor_cartera", $grosor_cartera, $secc_ancho, $secc_largo, $tiraje, $options_model, $ventas_model);

        $corte_cajon_cartera = intval($aJson['CartonCar']['calculadora']['corte']['cortesT']);

        if ($corte_cajon_cartera <= 0) {

            self::mError($aJson, $mensaje, "Las medidas del corte son mayores al carton de la cartera;");
        }

        $cost_tot_carton = round(floatval($aJson['CartonCar']['costo_unit_papel']), 2);

        if ($cost_tot_carton <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario carton cartera;");
        }

        $cost_tot_carton = round(floatval($aJson['CartonCar']['tot_costo']), 2);

        if ($cost_tot_carton <= 0) {

            self::mError($aJson, $mensaje, "No existe costo carton cartera;");
        }

        $aJson['Cortes']['cartera'] = $corte_cajon_cartera;

        $aJson['costo_cartones'] += $cost_tot_carton;
        $aJson['costo_subtotal'] += $cost_tot_carton;

        $aMerma = [];


    // corte(guillotina)

        // cortes papeles
        $suma_pliegos_papeles = intval($aJson['Papel_Empalme']['tot_pliegos']) + intval($aJson['Papel_FCaj']['tot_pliegos']) + intval($aJson['Papel_FCar']['tot_pliegos']) + intval($aJson['Papel_Guarda']['tot_pliegos']);

        $aJson['costo_corte_tot_papel'] = self::costo_guillotina("Corte", $suma_pliegos_papeles, $ventas_model);


        // cortes cartones
        $suma_pliegos_cartones = intval($aJson['CartonCaj']['tot_pliegos']) + intval($aJson['CartonCar']['tot_pliegos']) ;

        $aJson['corte_tot_pliegos_carton'] = self::costo_guillotina("Corte", $suma_pliegos_cartones, $ventas_model);


    // termina corte

        $aJson['costo_subtotal'] += round(floatval($aJson['costo_corte_tot_papel'] + $aJson['corte_tot_pliegos_carton']), 2);

    // ************ Corte Refine **********************

        $aJson['costo_corte_refine'] = self::costo_guillotina("Corte", $tiraje, $ventas_model);

        $aJson['costo_subtotal'] += round(floatval($aJson['costo_corte_refine']), 2);



/******************* Inicia Costos fijos *************************/

        $aJson['costos_fijos'] = 0.0;


    /************** Suaje Forro del cajon *****************/

        $Largo            = floatval($aJson['Papel_FCaj']['largo_papel']);
        $Ancho            = floatval($aJson['Papel_FCaj']['ancho_papel']);
        $papel_costo_unit = floatval($aJson['Papel_FCaj']['costo_unit_papel']);
        $cortes           = intval($aJson['Papel_FCaj']['corte']);

        $aJson['suaje_Fcaj_fijo'] = self::calculoSuaje("Perimetral", $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model, false);

        $aJson['costos_fijos'] = $aJson['suaje_Fcaj_fijo']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['suaje_Fcaj_fijo']['costo_tot_proceso'];



    // ************ Elaboracion de Cartera **********************


        $base_tmp = floatval($aJson['Calculadora']['B1']);
        $alto_tmp = floatval($aJson['Calculadora']['Y1']);


        $aElab_Car_tmp = [];

        $aElab_Car_tmp = self::calculoElabCartera("proc_cartera", "Forro de Cartera", $base_tmp, $alto_tmp, $tiraje, $ventas_model);

        $aElab_Car['tiraje']           = $aElab_Car_tmp['tiraje'];
        $aElab_Car['forro_costo_unit'] = $aElab_Car_tmp['costo_unit'];
        $aElab_Car['forro_car']        = $aElab_Car_tmp["forro_costo_tot"];


        if ($aElab_Car_tmp['forro_costo_tot'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para elaboracion forro cartera;");
        }

        $aJson['Elab_Car'] = $aElab_Car_tmp;

        $aJson['costos_fijos'] += $aElab_Car_tmp['forro_costo_tot'];

        $aJson['costo_subtotal'] += $aElab_Car_tmp['forro_costo_tot'];


        $aElab_Car_tmp = [];


    // ************ Elaboracion de Guarda **********************


        $base_tmp = floatval($aJson['Calculadora']['B11']);
        $alto_tmp = floatval($aJson['Calculadora']['Y11']);

        $aElab_Car_tmp = [];

        $aElab_Car_tmp = self::calculoElabCartera("proc_cartera", "Guarda", $base_tmp, $alto_tmp, $tiraje, $ventas_model);


        $aElab_G   = [];

        $aElab_G['tiraje']            = $aElab_Car_tmp['tiraje'];
        $aElab_G['guarda_costo_unit'] = $aElab_Car_tmp['costo_unit'];
        $aElab_G['guarda']            = $aElab_Car_tmp['forro_costo_tot'];


        if ($aElab_Car_tmp['forro_costo_tot'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para elaboracion forro guarda;");
        }


        $aJson['elab_guarda'] = $aElab_Car_tmp;

        $aJson['costos_fijos'] += $aElab_Car_tmp['forro_costo_tot'];

        $aJson['costo_subtotal'] += $aElab_Car_tmp['forro_costo_tot'];


        $aElab_Car_tmp = [];


    // ****************** ranurado ********************************

        // areglo y ranurado

        //empalme
        $aJson['arreglo_ranurado_hor_emp'] = [];
        $aJson['arreglo_ranurado_ver_emp'] = [];

        $aJson['arreglo_ranurado_hor_emp'] = self::calculoRanurado($tiraje, $ventas_model);


        if ($aJson['arreglo_ranurado_hor_emp']['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para arreglo ranurado empalme;");
        }


        if ($base > $alto or $base < $alto) {

            $aJson['arreglo_ranurado_ver_emp'] = $aJson['arreglo_ranurado_hor_emp'];
        } else {

            $aJson['arreglo_ranurado_ver_emp']['costo_tot_proceso'] = 0;
        }


        $aJson['costos_fijos'] += $aJson['arreglo_ranurado_hor_emp']['costo_tot_proceso'];


        $aJson['costos_fijos'] += $aJson['arreglo_ranurado_ver_emp']['costo_tot_proceso'];


        $aJson['costo_subtotal'] += $aJson['arreglo_ranurado_hor_emp']['costo_tot_proceso'];
        $aJson['costo_subtotal'] += $aJson['arreglo_ranurado_ver_emp']['costo_tot_proceso'];


        // carton car
        $aJson['arreglo_ranurado_hor_fcar'] = [];

        $aJson['arreglo_ranurado_hor_fcar'] = self::calculoRanurado($tiraje, $ventas_model);


        if ($aJson['arreglo_ranurado_hor_fcar']['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para arreglo ranurado cartera;");
        }


        $aJson['costos_fijos'] += $aJson['arreglo_ranurado_hor_fcar']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['arreglo_ranurado_hor_fcar']['costo_tot_proceso'];



    // ************ encajada ******************************

        $aJson['encajada'] = self::calculoEncajada($tiraje, $ventas_model);


        $aJson['costos_fijos'] += $aJson['encajada']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['encajada']['costo_tot_proceso'];


    // ************ encuadernacion ******************************

        $aEncuadernacion_Fcaj = [];

        $enc_cortes = intval($aJson['Papel_Empalme']['corte']);


        $aJson['Encuadernacion_emp'] = self::calculoEncuadernacion($tiraje, $id_papel_forro_cajon, $enc_cortes, $ventas_model);


        if ($aJson['Encuadernacion_emp']['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para encuadernacion guarda cajon;");
        }


        $aJson['costos_fijos'] += $aJson['Encuadernacion_emp']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['Encuadernacion_emp']['costo_tot_proceso'];



    // ************ encuadernacion fcaj ******************************

        $enc_cortes_fcaj = intval($aJson['Papel_FCaj']['corte']);

        $aJson['Encuadernacion_FCaj'] = self::calculoEncuadernacion_FCaj($tiraje, $id_papel_forro_cajon, $enc_cortes_fcaj, $ventas_model);

        if ($aJson['Encuadernacion_FCaj']['arreglo_costo_unitario'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para costo unitario forrado cajon(encuadernacion_Fcaj;");
        }


        if ($aJson['Encuadernacion_FCaj']['costo_tot_proceso'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para arreglo forrado de cajon;");
        }

        $aJson['costos_fijos'] += $aJson['Encuadernacion_FCaj']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['Encuadernacion_FCaj']['costo_tot_proceso'];



    /************** despunte de esquinas **************/

        $aJson['despunte_esquinas'] = self::calculoDespunteEsquinasCajon($tiraje, $ventas_model);


        if ($aJson['despunte_esquinas']['costo_unitario_esquinas'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo para despunte esquinas;");
        }


        $aJson['costos_fijos'] += $aJson['despunte_esquinas']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['despunte_esquinas']['costo_tot_proceso'];



    /************* pegado guarda ********************/

        $aJson['pegado_guarda'] = self::calculoPegado($tiraje, "Pegado de Guarda", $ventas_model);

        if ($aJson['pegado_guarda']['costo_unitario'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario pegado guarda;");
        }


        $aJson['costos_fijos'] += $aJson['pegado_guarda']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['pegado_guarda']['costo_tot_proceso'];



    /*********** armado caja final **************/


        $aJson['armado_caja_final'] = self::calculoArmadoCajaFinal($tiraje, "Armado Final Caja", $ventas_model);


        if ($aJson['armado_caja_final']['costo_unit'] <= 0) {

            self::mError($aJson, $mensaje, "No existe costo unitario armado final caja;");
        }


        $aJson['costos_fijos'] += $aJson['armado_caja_final']['costo_tot_proceso'];

        $aJson['costo_subtotal'] += $aJson['armado_caja_final']['costo_tot_proceso'];


/************** Termina Costos fijos *************************/


/******************* proceso Impresion ******************************/


    $mensaje = "ERROR";
    $error   = "No existe costo para ";

    $subtotal_b = round(floatval($aJson['costo_subtotal']), 2);
    $subtotal   = round(floatval($aJson['costo_subtotal']), 2);

    $is_maquila = 0;


/****************** Inicia los calculos de Empalme *****************/

        $aOffEmp      = [];
        $aOff_maq_Emp = [];
        $aDigEmp      = [];
        $aSerEmp      = [];
        $aHSEmp       = [];
        $aGrabEmp     = [];


        // Empalme
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpEC'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);


        $aPapelEmp = $aJson['Papel_Empalme'];

        $cortes_por_pliego = intval($aPapelEmp['corte']);

        $papel_emp_corte_ancho = $aPapelEmp['calculadora']['corte_ancho'];
        $papel_emp_corte_largo = $aPapelEmp['calculadora']['corte_largo'];

        $num_rows = 0;
        $num_rows = count($Tipo_proceso_tmp2);


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

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $Tipo_impresion = $Tipo_proceso_tmp[$i]['Tipo_impresion'];
                    $tipo_offset    = $Tipo_proceso_tmp[$i]['tipo_offset'];

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);


                    $es_maquila = self::recMaquila($papel_emp_corte_ancho, $papel_emp_corte_largo);


                    $costo_unit_papel = floatval($aPapelEmp['costo_unit_papel']);

                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);


                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $id_papel_empalme = $aPapelEmp['id_papel'];

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_empalme, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_emp_corte_ancho, $papel_emp_corte_largo, $ventas_model);
                        }


                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_empalme, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_emp_corte_ancho, $papel_emp_corte_largo, $ventas_model);
                        }

                        $offset_tiro_tmp = floatval($offset_tiro['costo_tot_proceso']);

                        if ( $offset_tiro_tmp <= 0 ) {

                            self::mError($aJson, $mensaje, $error . "Offset(Empalme);");
                        }

                        $aOffEmp[$i] = $offset_tiro;

                        $aOffEmp[$i]["mermas"] = $aMerma;

                        $aJson['Imp_Emp'] += round(floatval($offset_tiro_tmp), 2);
                        $subtotal              += round(floatval($offset_tiro_tmp), 2);
                    } else {        // si es maquila

                        $offset_tiro = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_emp_corte_ancho, $papel_emp_corte_largo, $ventas_model);

                        $offset_tiro_tmp = round(floatval($offset_tiro['costo_tot_proceso']), 2);

                        if ( $offset_tiro_tmp <= 0 ) {

                            self::mError($aJson, $mensaje, $error . "Offset Maquila(Empalme);");
                        }

                        $aOff_maq_Emp[$i] = $offset_tiro;

                        $aOff_maq_Emp[$i]["mermas"] = $aMerma;

                        $aJson['Imp_Emp_maq'] += $offset_tiro_tmp;
                        $subtotal             += $offset_tiro_tmp;

                        $is_maquila = 1;
                    }
                }


                if ($Nombre_proceso == "Digital") {

                    $corte_ancho_proceso = $x1;
                    $corte_largo_proceso = $y1;

                    $tam0 = self::calcTamDigital($corte_ancho_proceso, $corte_largo_proceso);

                    $tam          = "";
                    $tam1         = 0;
                    $nomb_tam_emp = "";

                    if (count($tam0) > 0) {

                        $tam          = $tam0[0];
                        $tam1         = $tam0[1];
                        $nomb_tam_emp = $tam0['tipo_digital'];
                    }

                    $aDigEmp[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_emp_corte_ancho, $papel_emp_corte_largo, $ventas_model);

                    if ( $tam1 ) {

                        if ($aDigEmp[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, $error . "Digital. No cabe con las medidas proporcionadas en Empalme;");
                        }

                        if ($aDigEmp[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error . "Digital. No existe costo en Digital Empalme;");
                        }

                        $aJson['Imp_Emp'] += round(floatval($aDigEmp[$i]['costo_tot_proceso']), 2);
                        $subtotal             += round(floatval($aDigEmp[$i]['costo_tot_proceso']), 2);
                    } else {

                        self::mError($aJson, $mensaje, $error . "Digital. No cabe con las medidas proporcionadas en Digital Empalme;");
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

                    $cortes_pliego = intval($aPapelEmp['corte']);

                    $costo_unit_papel = floatval($aPapelEmp['costo_unit_papel']);


                    $aSerEmp[$i] = self::calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_emp_corte_ancho, $papel_emp_corte_largo, $ventas_model);

                    if ($aSerEmp[$i]['costo_tot_proceso'] <= 0) {

                        self::mError($aJson, $mensaje, $error . "Serigrafia(Empalme);");
                    }

                    $aSerEmp[$i]['mermas'] = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);

                    $aJson['Imp_Emp'] += round(floatval($aSerEmp[$i]['costo_tot_proceso']), 2);
                    $subtotal             += round(floatval($aSerEmp[$i]['costo_tot_proceso']), 2);
                }
            }
        }


        if (count($aOffEmp) > 0 ) {

            $aOffEmp_R = array_values($aOffEmp);

            $aJson['OffEmp'] = $aOffEmp_R;
            $aJson['keys']   = $aJson['keys'] . "cot_alm_offsetemp;";

            if (is_array($aOffEmp)) {

                unset($aOffEmp);
                unset($aOffEmp_R);
            }
        }

        if (count($aOff_maq_Emp) > 0) {

            $aOff_maq_Emp_R = array_values($aOff_maq_Emp);

            $aJson['Off_maq_Emp'] = $aOff_maq_Emp_R;
            $aJson['keys']        = $aJson['keys'] . "cot_alm_offset_maq_emp;";

            if (is_array($aOff_maq_Emp)) {

                unset($aOff_maq_Emp);
                unset($aOff_maq_Emp_R);
            }
        }


        if (count($aDigEmp) > 0) {

            $aDigEmp_R = array_values($aDigEmp);

            $aJson['DigEmp'] = $aDigEmp_R;
            $aJson['keys']   = $aJson['keys'] . "cot_alm_digemp;";

            if (is_array($aDigEmp)) {

                unset($aDigEmp);
                unset($aDigEmp_R);
            }
        }

        if (count($aSerEmp) > 0) {

            $aSerEmp_R = array_values($aSerEmp);

            $aJson['SerEmp'] = $aSerEmp_R;
            $aJson['keys']   = $aJson['keys'] . "cot_alm_seremp;";

            if (is_array($aSerEmp)) {

                unset($aSerEmp);
                unset($aSerEmp_R);
            }
        }


/******************* Termina los calculos de Empalme ***************/



/***************** Inicia los calculos Forro del Cajon **************/


        // Forro del Cajon
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpFCaj'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);

        $a_tmp             = $aJson['Papel_FCaj'];
        $a_tmp_calculadora = $a_tmp['calculadora'];

        $papel_corte_ancho = $a_tmp_calculadora['corte_ancho'];
        $papel_corte_largo = $a_tmp_calculadora['corte_largo'];


        $num_rows = count($Tipo_proceso_tmp2);


        $aJsonFcaj = [];

        $aOffFCaj      = [];
        $aOff_maq_FCaj = [];
        $aDigFCaj      = [];
        $aSerFCaj      = [];

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

                    // merma offset
                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);


                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);


                    $cortes_por_pliego = intval($aJson['Papel_FCaj']['corte']);
                    $costo_unit_papel  = floatval($aJson['Papel_FCaj']["costo_unit_papel"]);
                    $Tipo_impresion    = $Tipo_proceso_tmp[$i]['Tipo_impresion'];
                    $tipo_offset       = $Tipo_proceso_tmp[$i]['tipo_offset'];

                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);

                    $id_papel_Fcaj = intval($_POST['optFCaj']);

                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_Fcaj, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_Fcaj, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        if ($offset_tiro['costo_tot_proceso'] <= 0) {

                                self::mError($aJson, $mensaje, $error . "Offset(Forro del Cajon);");
                        }

                        $aOffFCaj[$i] = $offset_tiro;

                        $aOffFCaj[$i]["mermas"] = $aMerma;

                        $aJson['Imp_FCaj'] += round(floatval($offset_tiro['costo_tot_proceso']), 2);
                        $subtotal          += round(floatval($offset_tiro['costo_tot_proceso']), 2);

                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $offset_tiro = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                        $offset_tiro_tmp = floatval($offset_tiro['costo_tot_proceso']);

                        if ($offset_tiro_tmp <= 0) {

                            self::mError($aJson, $mensaje, $error . "Offset Maquila(Forro del Cajon);");
                        }

                        $aOff_maq_FCaj[$i] = $offset_tiro;

                        $aOff_maq_FCaj[$i]["mermas"] = $aMerma;

                        $aJson['Imp_FCaj_maq'] += round(floatval($offset_tiro_tmp), 2);
                        $subtotal              += round(floatval($offset_tiro_tmp), 2);

                        $is_maquila = 1;
                    }
                }


                if ($Nombre_proceso == "Digital") {

                    $corte_ancho_proceso = $f;
                    $corte_largo_proceso = $k;

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

                        if ($aDigFCaj[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "Digital. No cabe con las medidas proporcionadas en Digital Forro del cajon;");
                        } elseif ($aDigFCaj[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error . "Digital Forro del cajon;");
                        }

                        $aJson['Imp_FCaj'] += round(floatval($aDigFCaj[$i]['costo_tot_proceso']), 2);
                        $subtotal          += round(floatval($aDigFCaj[$i]['costo_tot_proceso']), 2);
                    } else {

                        self::mError($aJson, $mensaje, $error . "Digital. No cabe con las medidas proporcionadas (Forro del cajon);");
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

                    $cortes_pliego = intval($aJson['Papel_FCaj']['corte']);

                    $costo_unit_papel = floatval($aJson['Papel_FCaj']['costo_unit_papel']);


                    $Merma_Ser_tmp = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);


                    $aSerFCaj[$i] = self::calculoSerigrafia($tiraje, $tipo_offset_serigrafia, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);


                    if ($aSerFCaj[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error . "Serigrafia(Forro del Cajon);");
                    }

                    $aSerFCaj[$i]["mermas"] = $Merma_Ser_tmp;


                    $aJson['Imp_FCaj'] += round(floatval($aSerFCaj[$i]['costo_tot_proceso']), 2);
                    $subtotal          += round(floatval($aSerFCaj[$i]['costo_tot_proceso']), 2);

                    if (is_array($Merma_Ser_tmp)) {

                        unset($Merma_Ser_tmp);
                    }

                }
            }
        }


        if (count($aOffFCaj) > 0 ) {

            $aOffFCaj_R = array_values($aOffFCaj);

            $aJson['OffFCaj'] = $aOffFCaj_R;
            $aJson['keys']    = $aJson['keys'] . "cot_alm_offsetfcaj;";

            if (is_array($aOffFCaj)) {

                unset($aOffFCaj);
                unset($aOffFCaj_R);
            }
        }

        if (count($aOff_maq_FCaj) > 0) {

            $aOff_maq_FCaj_R  = array_values($aOff_maq_FCaj);

            $aJson['Off_maq_FCaj'] = $aOff_maq_FCaj_R;
            $aJson['keys']         = $aJson['keys'] . "cot_alm_offset_maq_fcaj;";

            if (is_array($aOff_maq_FCaj)) {

                unset($aOff_maq_FCaj);
                unset($aOff_maq_FCaj_R);
            }
        }

        if (count($aDigFCaj) > 0) {

            $aDigFCaj_R = array_values($aDigFCaj);

            $aJson['DigFCaj'] = $aDigFCaj_R;
            $aJson['keys']    = $aJson['keys'] . "cot_alm_digfcaj;";

            if (is_array($aDigFCaj)) {

                unset($aDigFCaj);
                unset($aDigFCaj_R);
            }
        }


        if (count($aSerFCaj) > 0) {

            $aSerFCaj_R = array_values($aSerFCaj);

            $aJson['SerFCaj'] = $aSerFCaj_R;
            $aJson['keys']    = $aJson['keys'] . "cot_alm_serfcaj;";

            if (is_array($aSerFCaj)) {

                unset($aSerFCaj);
                unset($aSerFCaj_R);
            }
        }



/******************* Termina los calculos Forro del Cajon ***********/


/******************* Inicia los calculos Forro de la Cartera **********/


        // Forro de la Cartera
        $Tipo_proceso_FCar_tmp2 = json_decode($_POST['aImpFCar'], true);
        $Tipo_proceso_tmp       = array_values($Tipo_proceso_FCar_tmp2);

        $num_rows = 0;
        $num_rows = count($Tipo_proceso_tmp);

        $papel_corte_ancho = $aJson['Papel_FCar']['calculadora']['corte_ancho'];
        $papel_corte_largo = $aJson['Papel_FCar']['calculadora']['corte_largo'];


        $aJsonFcar     = [];
        $aOffFCar      = [];
        $aOff_maq_FCar = [];
        $aDigFCar      = [];
        $aSerFCar      = [];

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


                $cortes_por_pliego = intval($aJson['Papel_FCar']['corte']);
                $costo_unit_papel  = floatval($aJson['Papel_FCar']["costo_unit_papel"]);


                if ($Nombre_proceso == "Offset") {

                    $id_papel_FCar = intval($aJson['Papel_FCar']['id_papel']);

                    $nombre_tipo_offset = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $nombre_tipo_offset = utf8_encode(self::strip_slashes_recursive($nombre_tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    // merma offset
                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);

                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);

                    if (!$es_maquila) {

                        if ($nombre_tipo_offset == "Seleccion") {

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_FCar, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }


                        if ($nombre_tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_FCar, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        $offset_tiro_tmp = floatval($offset_tiro['costo_tot_proceso']);

                        if ($offset_tiro_tmp <= 0) {

                            self::mError($aJson, $mensaje, $error . "Offset(Forro de la Cartera);");
                        }

                        $aOffFCar[$i] = $offset_tiro;

                        $aOffFCar[$i]["mermas"] = $aMerma;


                        $aJson['Imp_FCar'] += round(floatval($offset_tiro_tmp), 2);
                        $subtotal          += round(floatval($offset_tiro_tmp), 2);

                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $offset_tiro = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                        $offset_tiro_tmp = floatval($offset_tiro['costo_tot_proceso']);

                        if ($offset_tiro_tmp <= 0) {

                            self::mError($aJson, $mensaje, $error . "Offset Maquila(Forro Cartera);");
                        }

                        $aOff_maq_FCar[$i] = $offset_tiro;

                        $aOff_maq_FCar[$i]["mermas"] = $aMerma;

                        $aJson['Imp_FCar_maq'] += round(floatval($offset_tiro_tmp), 2);
                        $subtotal              += round(floatval($offset_tiro_tmp), 2);

                        $is_maquila = 1;
                    }
                }



                if ($Nombre_proceso === "Digital") {

                    $corte_ancho_proceso = $B1;
                    $corte_largo_proceso = $Y1;

                    $tam0 = self::calcTamDigital($corte_ancho_proceso, $corte_largo_proceso);

                    $tam          = "";
                    $tam1         = 0;
                    $nomb_tam_emp = "";

                    if (count($tam0) > 0) {

                        $tam          = $tam0[0];
                        $tam1         = $tam0[1];
                        $nomb_tam_emp = $tam0['tipo_digital'];
                    }

                    if ($tam == "TC") {

                        $imp_ancho_dig = 20.5;
                        $imp_largo_dig = 27;
                    } elseif ($tam == "T2C") {

                        $imp_ancho_dig = 32;
                        $imp_largo_dig = 46.5;
                    }

                    $aDigFCar[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ( $tam1 ) {


                        if ($aDigFCar[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "Digital. No cabe con las medidas proporcionadas (Forro Cartera);");
                        } elseif ($aDigFCar[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error .  "Digital. No existe costo en Forro de la Cartera;");
                        }

                        $aJson['Imp_FCar'] += round(floatval($aDigFCar[$i]['costo_tot_proceso']), 2);
                        $subtotal          += round(floatval($aDigFCar[$i]['costo_tot_proceso']), 2);
                    } else {

                        self::mError($aJson, $mensaje, $error .  "Digital. No cabe con las medidas proporcionadas en Forro de la Cartera;");
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


                    $aSerFCar[$i] = self::calculoSerigrafia($tiraje, $nombre_tipo_offset, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);


                    if ($aSerFCar[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error .  "Serigrafia(Forro de la Cartera);");
                    }

                    $aSerFCar[$i]['mermas'] = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);

                    $aJson['Imp_FCar'] += round(floatval($aSerFCar[$i]['costo_tot_proceso']), 2);
                    $subtotal          += round(floatval($aSerFCar[$i]['costo_tot_proceso']), 2);
                }
            }
        }

        if (count($aOffFCar) > 0 ) {

            $aOffFCar_R = array_values($aOffFCar);

            $aJson['OffFCar'] = $aOffFCar_R;
            $aJson['keys']    = $aJson['keys'] . "cot_alm_offsetfcar;";

            if (is_array($aOffFCar)) {

                unset($aOffFCar);
                unset($aOffFCar_R);
            }
        }

        if (count($aOff_maq_FCar) > 0) {

            $aOff_maq_FCar_R = array_values($aOff_maq_FCar);

            $aJson['Off_maq_FCar'] = $aOff_maq_FCar_R;
            $aJson['keys']         = $aJson['keys'] . "cot_alm_offset_maq_fcar;";

            if (is_array($aOff_maq_FCar)) {

                unset($aOff_maq_FCar);
                unset($aOff_maq_FCar_R);
            }
        }

        if (count($aDigFCar) > 0) {

            $aDigFCar_R = array_values($aDigFCar);

            $aJson['DigFCar'] = $aDigFCar_R;
            $aJson['keys']    = $aJson['keys'] . "cot_alm_digfcar;";

            if (is_array($aDigFCar)) {

                unset($aDigFCar);
                unset($aDigFCar_R);
            }
        }

        if (count($aSerFCar) > 0) {

            $aSerFCar_R = array_values($aSerFCar);

            $aJson['SerFCar'] = $aSerFCar_R;
            $aJson['keys']    = $aJson['keys'] . "cot_alm_serfcar;";

            if (is_array($aSerFCar)) {

                unset($aSerFCar);
                unset($aSerFCar_R);
            }
        }


/******************* Termina los calculos Forro de la Cartera ************/



/******************* Inicia los calculos de la Guarda ********************/

        // Guarda
        $Tipo_proceso_tmp2 = json_decode($_POST['aImpG'], true);
        $Tipo_proceso_tmp  = array_values($Tipo_proceso_tmp2);

        $num_rows = 0;
        $num_rows = count($Tipo_proceso_tmp2);

        $papel_corte_ancho = $aJson['Papel_Guarda']['calculadora']['corte_ancho'];
        $papel_corte_largo = $aJson['Papel_Guarda']['calculadora']['corte_largo'];


        $aOffG       = [];
        $aOff_maq_G  = [];
        $aDigG       = [];
        $aSerG       = [];

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


                $cortes_por_pliego = intval($aJson['Papel_Guarda']['corte']);
                $costo_unit_papel  = floatval($aJson['Papel_Guarda']["costo_unit_papel"]);

                $Tipo_impresion = $Tipo_proceso_tmp[$i]['Tipo_impresion'];


                $id_papel_guarda = intval($aJson['Papel_Guarda']['id_papel']);

                if ($Nombre_proceso == "Offset") {

                    $tipo_offset    = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $tipo_offset    = utf8_encode(self::strip_slashes_recursive($tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    // merma offset
                    $es_maquila = $this->recMaquila($papel_corte_ancho, $papel_corte_largo);

                    $aMerma = self::calculoMermaOffset($tiraje, $num_tintas, $cortes_por_pliego, $costo_unit_papel, $ventas_model);


                    if (!$es_maquila) {

                        if ($tipo_offset == "Seleccion") {

                            $offset_tiro = self::calculoOffset("Tiro", $id_papel_guarda, $tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }


                        if ($tipo_offset === "Pantone") {

                            $offset_tiro = self::calculoOffset("Tiro Pantone", $id_papel_guarda, $tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);
                        }

                        $offset_tiro_tmp = floatval($offset_tiro['costo_tot_proceso']);

                        if ($offset_tiro_tmp <= 0) {

                            self::mError($aJson, $mensaje, $error .  "Offset(Guarda);");
                        }

                        $aOffG[$i] = $offset_tiro;

                        $aOffG[$i]["mermas"] = $aMerma;

                        $aJson['Imp_Guarda'] += round(floatval($offset_tiro_tmp), 2);
                        $subtotal            += round(floatval($offset_tiro_tmp), 2);

                        if (is_array($aMerma)) {

                            unset($aMerma);
                        }
                    } else {        // si es maquila

                        $offset_tiro = self::calculo_offset_merma($tipo_offset, $nombre_tipo_offset, $tiraje, $num_tintas, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                        $offset_tiro_tmp = floatval($offset_tiro['costo_tot_proceso']);

                        if ($offset_tiro_tmp <= 0) {

                            self::mError($aJson, $mensaje, $error .  "Offset Maquila(Guarda);");
                        }

                        $aOff_maq_G[$i] = $offset_tiro;

                        $aOff_maq_G[$i]["mermas"] = $aMerma;

                        $aJson['Imp_Guarda_maq'] += round(floatval($offset_tiro_tmp), 2);
                        $subtotal                += round(floatval($offset_tiro_tmp), 2);

                        $is_maquila = 1;
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

                    $aDigG[$i] = self::calculoDigital($tiraje, $nomb_tam_emp, $corte_ancho_proceso, $corte_largo_proceso, $cortes_por_pliego, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ( $tam1 ) {

                        if ($aDigG[$i]['cabe_digital'] === "NO") {

                            self::mError($aJson, $mensaje, "Digital. No cabe con las medidas proporcionadas en Guarda;");
                        } elseif ($aDigG[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error .  "Digital(Guarda);");
                        }

                        $aJson['Imp_Guarda'] += round(floatval($aDigG[$i]['costo_tot_proceso']), 2);
                        $subtotal            += round(floatval($aDigG[$i]['costo_tot_proceso']), 2);
                    } else {

                        self::mError($aJson, $mensaje, $error .  "Digital. No cabe con las medidas proporcionadas en Guarda;");
                    }
                }


                if ($Nombre_proceso === "Serigrafia") {

                    $tipo_offset    = $Tipo_proceso_tmp[$i]['tipo_offset'];
                    $tipo_offset    = utf8_encode(self::strip_slashes_recursive($tipo_offset));

                    $num_tintas = $Tipo_proceso_tmp[$i]['tintas'];
                    $num_tintas = intval($num_tintas);

                    $cortes_pliego = intval($aJson['Papel_Guarda']['corte']);

                    $costo_unit_papel = floatval($aJson['Papel_Guarda']['costo_unit_papel']);


                    $aSerG[$i] = self::calculoSerigrafia($tiraje, $tipo_offset, $num_tintas, $papel_corte_ancho, $papel_corte_largo, $ventas_model);

                    if ($aSerG[$i]['costo_tot_proceso'] <= 0) {

                            self::mError($aJson, $mensaje, $error .  "Serigrafia(Guarda);");
                    }

                    $aSerG[$i]['mermas'] = self:: calculoMermaOffset($tiraje, $num_tintas, $cortes_pliego, $costo_unit_papel, $ventas_model);

                    $aJson['Imp_Guarda'] += round(floatval($aSerG[$i]['costo_tot_proceso']), 2);
                    $subtotal            += round(floatval($aSerG[$i]['costo_tot_proceso']), 2);
                }
            }
        }


        if (count($aOffG) > 0 ) {

            $aOffG_R = array_values($aOffG);

            $aJson['OffG'] = $aOffG_R;
            $aJson['keys'] = $aJson['keys'] . "cot_alm_offsetguarda;";

            if (is_array($aOffG)) {

                unset($aOffG);
                unset($aOffG_R);
            }
        }


        if (count($aOff_maq_G) > 0) {

            $aOff_maq_G_R = array_values($aOff_maq_G);

            $aJson['Off_maq_G'] = $aOff_maq_G_R;
            $aJson['keys']      = $aJson['keys'] . "cot_alm_offset_maq_guarda;";

            if (is_array($aOff_maq_G)) {

                unset($aOff_maq_G);
                unset($aOff_maq_G_R);
            }
        }


        if (count($aDigG) > 0) {

            $aDigG_R = array_values($aDigG);

            $aJson['DigG'] = $aDigG_R;
            $aJson['keys'] = $aJson['keys'] . "cot_alm_digguarda;";

            if (is_array($aDigG)) {

                unset($aDigG);
                unset($aDigG_R);
            }
        }


        if (count($aSerG) > 0) {

            $aSerG_R = array_values($aSerG);

            $aJson['SerG'] = $aSerG_R;
            $aJson['keys'] = $aJson['keys'] . "cot_alm_serguarda;";

            if (is_array($aSerG)) {

                unset($aSerG);
                unset($aSerG_R);
            }
        }


/****************** Termina los calculos de la Guarda ********************/


/********************** Inicia boton acabados ****************************/


/************************ Inicia Empalme *******************************/


    $aAcb = json_decode($_POST['aAcbEC'], true);

    $cuantos_aAcb = count($aAcb);

    $papel_corte_ancho = floatval($aJson['Papel_Empalme']['calculadora']['corte_ancho']);
    $papel_corte_largo = floatval($aJson['Papel_Empalme']['calculadora']['corte_largo']);
    $papel_costo_unit  = floatval($aJson['Papel_Empalme']['costo_unit_papel']);

    $cortes = $aJson['Papel_Empalme']['corte'];


    $aAcbBUV   = [];
    $aAcbLaser = [];
    $aAcbGrab  = [];
    $aAcbHS    = [];
    $aAcbLam   = [];
    $aAcbSuaje = [];

    $aAcbMaq   = [];

    
    for ($i = 0; $i < $cuantos_aAcb; $i++) {
        
        $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['tipoGrabado']));

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['Tipo_acabado']));


        if ($tipo_acabado == "Barniz UV") {

            $AnchoBarniz = round(floatval($aJson['Papel_Empalme']['ancho_papel']), 2);
            $LargoBarniz = round(floatval($aJson['Papel_Empalme']['largo_papel']), 2);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $AnchoBarniz = round(floatval($aAcb[$i]['Ancho']), 2);
                $LargoBarniz = round(floatval($aAcb[$i]['Largo']), 2);
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


            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $merma_cortes);

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

            if ($barniz_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Barniz UV (Empalme);");
            }

            $aAcbBUV[$i] = $barniz_tmp;

            $aAcbBUV[$i]['mermas'] = $aMerma_BUV;

            $aAcb_Empalme_temp = $barniz_tmp['costo_tot_proceso'];
            $aJson['Acb_Empalme'] += round(floatval($aAcb_Empalme_temp), 2);

            $subtotal += round(floatval($barniz_tmp['costo_tot_proceso']), 2);

            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }
        }


        if ($tipo_acabado == "Corte Laser") {

            $costo_laser_tmp = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            if ($costo_laser_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Corte Laser (Empalme);");
            }


            $aAcbLaser[$i] = $costo_laser_tmp;

            $aAcb_Empalme_temp = $costo_laser_tmp['costo_tot_proceso'];
            $aJson['Acb_Empalme'] += round(floatval($aAcb_Empalme_temp), 2);

            $subtotal             += round(floatval($costo_laser_tmp['costo_tot_proceso']), 2);

            if (is_array($costo_laser_tmp)) {

                unset($costo_laser_tmp);
            }
        }


        if ($tipo_acabado == "Grabado") {

            $LargoGrab     = round(floatval($aAcb[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcb[$i]['Ancho']),2);
            $ubicacionGrab = trim($aAcb[$i]['ubicacion']);

            $papel_seccion        = intval($aJson['Papel_Empalme']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_Empalme']['costo_unit_papel']);


            $grabado_temp = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);

            if ($grabado_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Grabado (Empalme);");
            }

            $aAcbGrab[$i] = $grabado_temp;

            $aJson['Acb_Empalme'] += round(floatval($grabado_temp['costo_tot_proceso']), 2);
            $subtotal             += round(floatval($grabado_temp['costo_tot_proceso']), 2);

            if (is_array($grabado_temp)) {

                unset($grabado_temp);
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $LargoHS = round(floatval($aAcb[$i]['LargoHS']), 2);
            $AnchoHS = round(floatval($aAcb[$i]['AnchoHS']), 2);
            $ColorHS = utf8_encode(self::strip_slashes_recursive($aAcb[$i]['ColorHS']));

            $papel_seccion        = intval($aJson['Papel_Empalme']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_Empalme']['costo_unit_papel']);


            $grabado_HS_temp = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);


            if ($grabado_HS_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "HotStamping (Empalme);");
            }

            $aAcbHS[$i] = $grabado_HS_temp;

            $aJson['Acb_Empalme'] += round(floatval($grabado_HS_temp['costo_tot_proceso']), 2);
            $subtotal             += round(floatval($grabado_HS_temp['costo_tot_proceso']), 2);

            if (is_array($grabado_HS_temp)) {

                unset($grabado_HS_temp);
            }
        }


        if ($tipo_acabado == "Laminado") {

            $LargoLam = floatval($aJson['Papel_Empalme']['largo_papel']);
            $AnchoLam = floatval($aJson['Papel_Empalme']['ancho_papel']);

            $papel_costo_unit = $aJson['Papel_Empalme']['costo_unit_papel'];

            $cortes = intval($aJson['Papel_Empalme']['corte']);

            $Laminado_tmp = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);

            if ($Laminado_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Laminado (Empalme);");
            }

            $aAcbLam[$i] = $Laminado_tmp;

            $aJson['Acb_Empalme'] += round(floatval($Laminado_tmp['costo_tot_proceso']), 2);
            $subtotal             += round(floatval($Laminado_tmp['costo_tot_proceso']), 2);

            if (count($Laminado_tmp) > 0) {

                unset($Laminado_tmp);
            }
        }


        if ($tipo_acabado == "Suaje") {

            $papel_costo_unit = floatval($aJson['Papel_Empalme']['costo_unit_papel']);
            $cortes           = intval($aJson['Papel_Empalme']['corte']);

            $Largo = round(floatval($aAcb[$i]['LargoSuaje']), 2);
            $Ancho = round(floatval($aAcb[$i]['AnchoSuaje']), 2);

            $aAcbSuaje_tmp = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);

            if ($aAcbSuaje_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Suaje (Empalme);");
            }

            $aAcbSuaje[$i] = $aAcbSuaje_tmp;

            $aAcb_emp_temp = $aAcbSuaje_tmp['costo_tot_proceso'];
            $aJson['Acb_Empalme'] += round(floatval($aAcb_emp_temp), 2);

            $subtotal += round(floatval($aAcbSuaje_tmp['costo_tot_proceso']), 2);

            if (count($aAcbSuaje_tmp) > 0) {

                unset($aAcbSuaje_tmp);
            }
        }
    }


    if (count($aAcbBUV) > 0) {

        $aAcbBUV_R = array_values($aAcbBUV);

        $aJson['Barniz_UV'] = $aAcbBUV_R;
        $aJson['keys']      = $aJson['keys'] . "cot_alm_barnizuvemp;";

        if (is_array($aAcbBUV)) {

            unset($aAcbBUV);
            unset($aAcbBUV_R);
        }
    }


    if (count($aAcbLaser) > 0) {

        $aAcbLaser_R = array_values($aAcbLaser);

        $aJson['Laser'] = $aAcbLaser_R;
        $aJson['keys']  = $aJson['keys'] . "cot_alm_laseremp;";

        if (is_array($aAcbLaser)) {

            unset($aAcbLaser);
            unset($aAcbLaser_R);
        }
    }


    if (count($aAcbGrab) > 0) {

        $aAcbGrab_R = array_values($aAcbGrab);

        $aJson['Grabado'] = $aAcbGrab_R;
        $aJson['keys']    = $aJson['keys'] . "cot_alm_grabemp;";

        if (is_array($aAcbGrab)) {

            unset($aAcbGrab);
            unset($aAcbGrab_R);
        }
    }


    if (count($aAcbHS) > 0) {

        $aAcbHS_R = array_values($aAcbHS);

        $aJson['HotStamping'] = $aAcbHS_R;
        $aJson['keys']        = $aJson['keys'] . "cot_alm_hsemp;";

        if (is_array($aAcbHS)) {

            unset($aAcbHS);
            unset($aAcbHS_R);
        }
    }


    if (count($aAcbLam) > 0) {

        $aAcbLam_R = array_values($aAcbLam);

        $aJson['Laminado'] = $aAcbLam_R;
        $aJson['keys']     = $aJson['keys'] . "cot_alm_lamemp;";

        if (is_array($aAcbLam)) {

            unset($aAcbLam);
            unset($aAcbLam_R);
        }
    }


    if (count($aAcbSuaje) > 0) {

        $aAcbSuaje_R = array_values($aAcbSuaje);

        $aJson['Suaje'] = $aAcbSuaje_R;
        $aJson['keys']  = $aJson['keys'] . "cot_alm_suajeemp;";

        if (is_array($aAcbSuaje)) {

            unset($aAcbSuaje);
            unset($aAcbSuaje_R);
        }
    }


/************************ Termina Empalme ******************************/



/************************* Inicia Forro del Cajon **********************/


    $aAcbFCaj = json_decode($_POST['aAcbFCaj'], true);

    $cuantos_aAcbFCaj = count($aAcbFCaj);

    $aAcbFcajBUV   = [];
    $aAcbFcajLaser = [];
    $aAcbFcajGrab  = [];
    $aAcbFcajHS    = [];
    $aAcbFcajLam   = [];
    $aAcbFcajSuaje = [];

    $aAcbFcajMaq   = [];


    for ($i = 0; $i < $cuantos_aAcbFCaj; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['Tipo_acabado']));

        $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['tipoGrabado']));


        if ($tipo_acabado == "Barniz UV") {

            $AnchoBarniz = round(floatval($aJson['Papel_FCaj']['ancho_papel']), 2);
            $LargoBarniz = round(floatval($aJson['Papel_FCaj']['largo_papel']), 2);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $LargoBarniz = round(floatval($aAcbFCaj[$i]['Largo']), 2);
                $AnchoBarniz = round(floatval($aAcbFCaj[$i]['Ancho']), 2);
            }

            $barniz_tmp = [];

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
            $merma_HS_tmp = [];

            $merma_HS_tmp = self:: calculoMermaAcabados($cantidad_minima, $cantidad, $por_cada_x, $adicional);

            $merma_tot_pliegos = intval($merma_HS_tmp[2]);

            $merma_cortes = intval($aJson['Papel_FCaj']['corte']);


            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $merma_cortes);

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


            if ($barniz_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Barniz UV (Forro del Cajon);");
            }

            $aAcbFcajBUV[$i] = $barniz_tmp;

            $aAcbFcajBUV[$i]['mermas'] = $aMerma_BUV;

            $barniz_tot_proceso = 0;

            $barniz_tot_proceso = $barniz_tmp['costo_tot_proceso'];
            $barniz_tot_proceso = round(floatval($barniz_tot_proceso), 2);

            $aJson['Acb_FCaj'] += round(floatval($barniz_tot_proceso), 2);
            $subtotal          += round(floatval($barniz_tot_proceso), 2);


            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }
        }


        if ($tipo_acabado == "Corte Laser") {

            $costo_laser_tmp = [];

            $costo_laser_tmp = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            if ($costo_laser_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Corte Laser (Forro del Cajon);");
            }


            $aAcbFcajLaser[$i] = $costo_laser_tmp;

            $laser_tot_proceso_tmp = 0;
            $laser_tot_proceso_tmp = $costo_laser_tmp['costo_tot_proceso'];
            $laser_tot_proceso_tmp = round(floatval($laser_tot_proceso_tmp), 2);

            $aJson['Acb_FCaj'] += round(floatval($laser_tot_proceso_tmp), 2);
            $subtotal          += round(floatval($laser_tot_proceso_tmp), 2);


            if (is_array($costo_laser_tmp)) {

                unset($costo_laser_tmp);
            }
        }


        if ($tipo_acabado == "Grabado") {

            $papel_seccion        = intval($aJson['Papel_FCaj']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_FCaj']['costo_unit_papel']);

            $LargoGrab     = round(floatval($aAcbFCaj[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcbFCaj[$i]['Ancho']), 2);
            $ubicacionGrab = trim($aAcbFCaj[$i]['ubicacion']);

            $grabado_temp = [];

            $grabado_temp = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);

            if ($grabado_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Grabado (Forro del Cajon);");
            }

            $aAcbFcajGrab[$i] = $grabado_temp;

            $grabado_tot_proceso_tmp = 0;
            $grabado_tot_proceso_tmp = $grabado_temp['costo_tot_proceso'];
            $grabado_tot_proceso_tmp = round(floatval($grabado_tot_proceso_tmp), 2);

            $aJson['Acb_FCaj'] += round(floatval($grabado_tot_proceso_tmp), 2);
            $subtotal          += round(floatval($grabado_tot_proceso_tmp), 2);


            if (is_array($grabado_temp)) {

                unset($grabado_temp);
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $papel_seccion        = intval($aJson['Papel_FCaj']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_FCaj']['costo_unit_papel']);

            $LargoHS = round(floatval($aAcbFCaj[$i]['LargoHS']), 2);
            $AnchoHS = round(floatval($aAcbFCaj[$i]['AnchoHS']), 2);
            $ColorHS = utf8_encode(self::strip_slashes_recursive($aAcbFCaj[$i]['ColorHS']));

            $grabado_HS_temp = [];

            $grabado_HS_temp = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);


            if ($grabado_HS_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "HotStamping (Forro del Cajon);");
            }

            $aAcbFcajHS[$i] = $grabado_HS_temp;

            $grabado_hs_tot_proceso_tmp = 0;
            $grabado_hs_tot_proceso_tmp = $grabado_HS_temp['costo_tot_proceso'];
            $grabado_hs_tot_proceso_tmp = round(floatval($grabado_hs_tot_proceso_tmp), 2);

            $aJson['Acb_FCaj'] += round(floatval($grabado_hs_tot_proceso_tmp), 2);
            $subtotal          += round(floatval($grabado_hs_tot_proceso_tmp), 2);

            if (is_array($grabado_HS_temp)) {

                unset($grabado_HS_temp);
            }
        }


        if ($tipo_acabado == "Laminado") {

            $LargoLam = floatval($aJson['Papel_FCaj']['largo_papel']);
            $AnchoLam = floatval($aJson['Papel_FCaj']['ancho_papel']);

            $papel_costo_unit = $aJson['Papel_FCaj']['costo_unit_papel'];

            $cortes = intval($aJson['Papel_FCaj']['corte']);

            $Laminado_tmp = [];

            $Laminado_tmp = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);

            if ($Laminado_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Laminado (Forro del Cajon);");
            }

            $aAcbFcajLam[$i] = $Laminado_tmp;

            $laminado_tot_proceso_tmp = 0;
            $laminado_tot_proceso_tmp = $Laminado_tmp['costo_tot_proceso'];
            $laminado_tot_proceso_tmp = round(floatval($laminado_tot_proceso_tmp), 2);

            $aJson['Acb_FCaj'] += round(floatval($laminado_tot_proceso_tmp), 2);
            $subtotal          += round(floatval($laminado_tot_proceso_tmp), 2);

            if (count($Laminado_tmp) > 0) {

                unset($Laminado_tmp);
            }
        }


        if ($tipo_acabado == "Suaje") {

            $papel_costo_unit = floatval($aJson['Papel_FCaj']['costo_unit_papel']);
            $cortes           = intval($aJson['Papel_FCaj']['corte']);

            $Largo = round(floatval($aAcbFCaj[$i]['LargoSuaje']), 2);
            $Ancho = round(floatval($aAcbFCaj[$i]['AnchoSuaje']), 2);


            $aAcbSuaje_tmp = [];

            $aAcbSuaje_tmp = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);

            if ($aAcbSuaje_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Suaje (Forro del Cajon);");
            }

            $aAcbFcajSuaje[$i] = $aAcbSuaje_tmp;

            $suaje_tot_proceso_tmp = 0;
            $suaje_tot_proceso_tmp = $aAcbSuaje_tmp['costo_tot_proceso'];
            $suaje_tot_proceso_tmp = round(floatval($suaje_tot_proceso_tmp), 2);

            $aJson['Acb_FCaj'] += round(floatval($suaje_tot_proceso_tmp), 2);
            $subtotal          += round(floatval($suaje_tot_proceso_tmp), 2);

            if (count($aAcbSuaje_tmp) > 0) {

                unset($aAcbSuaje_tmp);
            }
        }
    }


    if (count($aAcbFcajBUV) > 0) {

        $aAcbFcajBUV_R = array_values($aAcbFcajBUV);

        $aJson['BarnizFcaj'] = $aAcbFcajBUV_R;
        $aJson['keys']       = $aJson['keys'] . "cot_alm_barnizuvfcaj;";

        if (is_array($aAcbFcajBUV)) {

            unset($aAcbFcajBUV);
            unset($aAcbFcajBUV_R);
        }
    }


    if (count($aAcbFcajLaser) > 0) {

        $aAcbFcajLaser_R = array_values($aAcbFcajLaser);

        $aJson['LaserFcaj'] = $aAcbFcajLaser_R;
        $aJson['keys']      = $aJson['keys'] . "cot_alm_laserfcaj;";

        if (is_array($aAcbFcajLaser)) {

            unset($aAcbFcajLaser);
            unset($aAcbFcajLaser_R);
        }
    }


    if (count($aAcbFcajGrab) > 0) {

        $aAcbFcajGrab_R = array_values($aAcbFcajGrab);

        $aJson['GrabadoFcaj'] = $aAcbFcajGrab_R;
        $aJson['keys']        = $aJson['keys'] . "cot_alm_grabfcaj;";

        if (is_array($aAcbFcajGrab)) {

            unset($aAcbFcajGrab);
            unset($aAcbFcajGrab_R);
        }
    }


    if (count($aAcbFcajHS) > 0) {

        $aAcbFcajHS_R = array_values($aAcbFcajHS);

        $aJson['HotStampingFcaj'] = $aAcbFcajHS_R;
        $aJson['keys']            = $aJson['keys'] . "cot_alm_hsfcaj;";

        if (is_array($aAcbFcajHS)) {

            unset($aAcbFcajHS);
            unset($aAcbFcajHS_R);
        }
    }


    if (count($aAcbFcajLam) > 0) {

        $aAcbFcajLam_R = array_values($aAcbFcajLam);

        $aJson['LaminadoFcaj'] = $aAcbFcajLam_R;
        $aJson['keys']         = $aJson['keys'] . "cot_alm_lamfcaj;";

        if (is_array($aAcbFcajLam)) {

            unset($aAcbFcajLam);
            unset($aAcbFcajLam_R);
        }
    }


    if (count($aAcbFcajSuaje) > 0) {

        $aAcbFcajSuaje_R = array_values($aAcbFcajSuaje);

        $aJson['SuajeFcaj'] = $aAcbFcajSuaje_R;
        $aJson['keys']      = $aJson['keys'] . "cot_alm_suajefcaj;";

        if (is_array($aAcbFcajSuaje)) {

            unset($aAcbFcajSuaje);
            unset($aAcbFcajSuaje_R);
        }
    }


/************************* Termina Forro del Cajon *********************/



/************************* Inicia Forro de la Cartera ******************/


    $aAcbFCar = json_decode($_POST['aAcbFCar'], true);

    $cuantos_aAcbFCar = count($aAcbFCar);


    $aAcbFcarBUV   = [];
    $aAcbFcarLaser = [];
    $aAcbFcarGrab  = [];
    $aAcbFcarHS    = [];
    $aAcbFcarLam   = [];
    $aAcbFcarSuaje = [];

    $aAcbFcarMaq   = [];


    for ($i = 0; $i < $cuantos_aAcbFCar; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcbFCar[$i]['Tipo_acabado']));

        $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbFCar[$i]['tipoGrabado']));


        if ($tipo_acabado == "Barniz UV") {

            $AnchoBarniz = round(floatval($aJson['Papel_FCar']['ancho_papel']), 2);
            $LargoBarniz = round(floatval($aJson['Papel_FCar']['largo_papel']), 2);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $LargoBarniz = round(floatval($aAcbFCar[$i]['Largo']), 2);
                $AnchoBarniz = round(floatval($aAcbFCar[$i]['Ancho']), 2);
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

            $merma_cortes = intval($aJson['Papel_FCar']['corte']);


            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $merma_cortes);

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


            if ($barniz_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Barniz UV (Forro de la Cartera);");
            }

            $aAcbFcarBUV[$i] = $barniz_tmp;

            $aAcbFcarBUV[$i]['mermas'] = $aMerma_BUV;

            $aJson['Acb_FCar'] += round(floatval($barniz_tmp['costo_tot_proceso']), 2);
            $subtotal          += round(floatval($barniz_tmp['costo_tot_proceso']), 2);

            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }
        }


        if ($tipo_acabado == "Corte Laser") {

            $costo_laser_tmp = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            if ($costo_laser_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Corte Laser (Forro de la Cartera);");
            }


            $aAcbFcarLaser[$i] = $costo_laser_tmp;

            $aJson['Acb_FCar'] += round(floatval($costo_laser_tmp['costo_tot_proceso']), 2);
            $subtotal          += round(floatval($costo_laser_tmp['costo_tot_proceso']), 2);

            if (is_array($costo_laser_tmp)) {

                unset($costo_laser_tmp);
            }
        }


        if ($tipo_acabado == "Grabado") {

            $papel_seccion        = intval($aJson['Papel_FCar']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_FCar']['costo_unit_papel']);

            $LargoGrab     = round(floatval($aAcbFCar[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcbFCar[$i]['Ancho']), 2);
            $ubicacionGrab = trim($aAcbFCar[$i]['ubicacion']);


            $grabado_temp = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);

            if ($grabado_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Grabado (Forro de la Cartera);");
            }

            $aAcbFcarGrab[$i] = $grabado_temp;

            $aJson['Acb_FCar'] += round(floatval($grabado_temp['costo_tot_proceso']), 2);
            $subtotal          += round(floatval($grabado_temp['costo_tot_proceso']), 2);

            if (is_array($grabado_temp)) {

                unset($grabado_temp);
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $papel_seccion        = intval($aJson['Papel_FCar']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_FCar']['costo_unit_papel']);

            $LargoHS = round(floatval($aAcbFCar[$i]['LargoHS']), 2);
            $AnchoHS = round(floatval($aAcbFCar[$i]['AnchoHS']), 2);
            $ColorHS = utf8_encode(self::strip_slashes_recursive($aAcbFCar[$i]['ColorHS']));


            $grabado_HS_temp = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);


            if ($grabado_HS_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "HotStamping (Forro de la Cartera);");
            }

            $aAcbFcarHS[$i] = $grabado_HS_temp;

            $aJson['Acb_FCar'] += round(floatval($grabado_HS_temp['costo_tot_proceso']), 2);
            $subtotal          += round(floatval($grabado_HS_temp['costo_tot_proceso']), 2);

            if (is_array($grabado_HS_temp)) {

                unset($grabado_HS_temp);
            }
        }


        if ($tipo_acabado == "Laminado") {

            $LargoLam = floatval($aJson['Papel_FCar']['largo_papel']);
            $AnchoLam = floatval($aJson['Papel_FCar']['ancho_papel']);

            $papel_costo_unit = $aJson['Papel_FCar']['costo_unit_papel'];

            $cortes = intval($aJson['Papel_FCar']['corte']);

            $Laminado_tmp = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);

            if ($Laminado_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Laminado (Forro de la Cartera);");
            }

            $aAcbFcarLam[$i] = $Laminado_tmp;

            $aJson['Acb_FCar'] += round(floatval($Laminado_tmp['costo_tot_proceso']), 2);
            $subtotal          += round(floatval($Laminado_tmp['costo_tot_proceso']), 2);

            if (count($Laminado_tmp) > 0) {

                unset($Laminado_tmp);
            }
        }


        if ($tipo_acabado == "Suaje") {

            $papel_costo_unit = floatval($aJson['Papel_FCar']['costo_unit_papel']);
            $cortes           = intval($aJson['Papel_FCar']['corte']);

            $Largo = round(floatval($aAcbFCar[$i]['LargoSuaje']), 2);
            $Ancho = round(floatval($aAcbFCar[$i]['AnchoSuaje']), 2);

            $aAcbSuaje_tmp = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);

            if ($aAcbSuaje_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Suaje (Forro de la Cartera);");
            }

            $aAcbFcarSuaje[$i] = $aAcbSuaje_tmp;

            $aAcb_FCar_temp = $aAcbSuaje_tmp['costo_tot_proceso'];
            $aJson['Acb_FCar'] += round(floatval($aAcb_FCar_temp), 2);

            $subtotal          += round(floatval($aAcbSuaje_tmp['costo_tot_proceso']), 2);

            if (count($aAcbSuaje_tmp) > 0) {

                unset($aAcbSuaje_tmp);
            }
        }
    }


    if (count($aAcbFcarBUV) > 0) {

        $aAcbFcarBUV_R = array_values($aAcbFcarBUV);

        $aJson['BarnizFcar'] = $aAcbFcarBUV_R;
        $aJson['keys']       = $aJson['keys'] . "cot_alm_barnizuvfcar;";

        if (is_array($aAcbFcarBUV)) {

            unset($aAcbFcarBUV);
            unset($aAcbFcarBUV_R);
        }
    }


    if (count($aAcbFcarLaser) > 0) {

        $aAcbFcarLaser_R = array_values($aAcbFcarLaser);

        $aJson['LaserFcar'] = $aAcbFcarLaser_R;
        $aJson['keys']      = $aJson['keys'] . "cot_alm_laserfcar;";

        if (is_array($aAcbFcarLaser)) {

            unset($aAcbFcarLaser);
            unset($aAcbFcarLaser_R);
        }
    }


    if (count($aAcbFcarGrab) > 0) {

        $aAcbFcarGrab_R = array_values($aAcbFcarGrab);

        $aJson['GrabadoFcar'] = $aAcbFcarGrab_R;
        $aJson['keys']        = $aJson['keys'] . "cot_alm_grabfcar;";

        if (is_array($aAcbFcarGrab)) {

            unset($aAcbFcarGrab);
            unset($aAcbFcarGrab_R);
        }
    }


    if (count($aAcbFcarHS) > 0) {

        $aAcbFcarHS_R = array_values($aAcbFcarHS);

        $aJson['HotStampingFcar'] = $aAcbFcarHS_R;
        $aJson['keys']            = $aJson['keys'] . "cot_alm_hsfcar;";

        if (is_array($aAcbFcarHS)) {

            unset($aAcbFcarHS);
            unset($aAcbFcarHS_R);
        }
    }


    if (count($aAcbFcarLam) > 0) {

        $aAcbFcarLam_R = array_values($aAcbFcarLam);

        $aJson['LaminadoFcar'] = $aAcbFcarLam_R;
        $aJson['keys']         = $aJson['keys'] . "cot_alm_lamfcar;";

        if (is_array($aAcbFcarLam)) {

            unset($aAcbFcarLam);
            unset($aAcbFcarLam_R);
        }
    }


    if (count($aAcbFcarSuaje) > 0) {

        $aAcbFcarSuaje_R = array_values($aAcbFcarSuaje);

        $aJson['SuajeFcar'] = $aAcbFcarSuaje_R;
        $aJson['keys']      = $aJson['keys'] . "cot_alm_suajefcar;";

        if (is_array($aAcbFcarSuaje)) {

            unset($aAcbFcarSuaje);
            unset($aAcbFcarSuaje_R);
        }
    }


/************************* Termina Forro de la Cartera *****************/



/*************************** Inicia Guarda *****************************/


    $aAcbG = json_decode($_POST['aAcbG'], true);

    $cuantos_aAcbG = count($aAcbG);

    $aAcbGBUV   = [];
    $aAcbGLaser = [];
    $aAcbGGrab  = [];
    $aAcbGHS    = [];
    $aAcbGLam   = [];
    $aAcbGSuaje = [];

    $aAcbGMaq   = [];

    for ($i = 0; $i < $cuantos_aAcbG; $i++) {

        $tipo_acabado = utf8_encode(self::strip_slashes_recursive($aAcbG[$i]['Tipo_acabado']));

        $tipoGrabado = utf8_encode(self::strip_slashes_recursive($aAcbG[$i]['tipoGrabado']));


        if ($tipo_acabado == "Barniz UV") {

            $AnchoBarniz = round(floatval($aJson['Papel_Guarda']['ancho_papel']), 2);
            $LargoBarniz = round(floatval($aJson['Papel_Guarda']['largo_papel']), 2);

            if ($tipoGrabado == "Registro Mate" or $tipoGrabado == "Registro Brillante") {

                $LargoBarniz = round(floatval($aAcbG[$i]['Largo']), 2);
                $AnchoBarniz = round(floatval($aAcbG[$i]['Ancho']), 2);
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

            $merma_cortes = intval($aJson['Papel_Guarda']['corte']);


            $tot_pliegos = self:: Deltax($merma_tot_pliegos, $merma_cortes);

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


            if ($barniz_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Barniz UV (Guarda);");
            }

            $aAcbGBUV[$i] = $barniz_tmp;

            $aAcbGBUV[$i]['mermas'] = $aMerma_BUV;

            $aJson['Acb_Guarda'] += round(floatval($barniz_tmp['costo_tot_proceso']), 2);
            $subtotal            += round(floatval($barniz_tmp['costo_tot_proceso']), 2);

            if (is_array($barniz_tmp)) {

                unset($barniz_tmp);
            }

            if (is_array($aMerma_BUV)) {

                unset($aMerma_BUV);
            }
        }


        if ($tipo_acabado == "Corte Laser") {

            $costo_laser_tmp = self::calculoLaser($tipoGrabado, $tiraje, $ventas_model);

            if ($costo_laser_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Corte Laser (Guarda);");
            }


            $aAcbGLaser[$i] = $costo_laser_tmp;

            $aJson['Acb_Guarda'] += round(floatval($costo_laser_tmp['costo_tot_proceso']), 2);
            $subtotal            += round(floatval($costo_laser_tmp['costo_tot_proceso']), 2);

            if (is_array($costo_laser_tmp)) {

                unset($costo_laser_tmp);
            }
        }


        if ($tipo_acabado == "Grabado") {

            $papel_seccion        = intval($aJson['Papel_Guarda']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_Guarda']['costo_unit_papel']);

            $LargoGrab     = round(floatval($aAcbG[$i]['Largo']), 2);
            $AnchoGrab     = round(floatval($aAcbG[$i]['Ancho']), 2);
            $ubicacionGrab = trim($aAcbG[$i]['ubicacion']);


            $grabado_temp = self::calculoGrabado($tipoGrabado, $tiraje, $AnchoGrab, $LargoGrab, $ubicacionGrab, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);

            if ($grabado_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Grabado (Guarda);");
            }

            $aAcbGGrab[$i] = $grabado_temp;

            $aJson['Acb_Guarda'] += round(floatval($grabado_temp['costo_tot_proceso']), 2);
            $subtotal            += round(floatval($grabado_temp['costo_tot_proceso']), 2);

            if (is_array($grabado_temp)) {

                unset($grabado_temp);
            }
        }


        if ($tipo_acabado == "HotStamping") {

            $papel_seccion        = intval($aJson['Papel_Guarda']['corte']);
            $papel_costo_unit_tmp = floatval($aJson['Papel_Guarda']['costo_unit_papel']);

            $LargoHS = round(floatval($aAcbG[$i]['LargoHS']), 2);
            $AnchoHS = round(floatval($aAcbG[$i]['AnchoHS']), 2);
            $ColorHS = utf8_encode(self::strip_slashes_recursive($aAcbG[$i]['ColorHS']));


            $grabado_HS_temp = self::calculoHotStamping($tipoGrabado, $tiraje, $AnchoHS, $LargoHS, $ColorHS, $papel_seccion, $papel_costo_unit_tmp, $ventas_model);


            if ($grabado_HS_temp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "HotStamping (Guarda);");
            }

            $aAcbGHS[$i] = $grabado_HS_temp;

            $aJson['Acb_Guarda'] += round(floatval($grabado_HS_temp['costo_tot_proceso']), 2);
            $subtotal            += round(floatval($grabado_HS_temp['costo_tot_proceso']), 2);

            if (is_array($grabado_HS_temp)) {

                unset($grabado_HS_temp);
            }
        }


        if ($tipo_acabado == "Laminado") {

            $LargoLam = floatval($aJson['Papel_Guarda']['largo_papel']);
            $AnchoLam = floatval($aJson['Papel_Guarda']['ancho_papel']);

            $papel_costo_unit = $aJson['Papel_Guarda']['costo_unit_papel'];

            $cortes = intval($aJson['Papel_Guarda']['corte']);

            $Laminado_tmp = self::calculoLaminado($tipoGrabado, $tiraje, $AnchoLam, $LargoLam, $papel_costo_unit, $cortes, $ventas_model);

            if ($Laminado_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Laminado (Guarda);");
            }

            $aAcbGLam[$i] = $Laminado_tmp;

            $aJson['Acb_Guarda'] += round(floatval($Laminado_tmp['costo_tot_proceso']), 2);
            $subtotal            += round(floatval($Laminado_tmp['costo_tot_proceso']), 2);

            if (count($Laminado_tmp) > 0) {

                unset($Laminado_tmp);
            }
        }


        if ($tipo_acabado == "Suaje") {

            $papel_costo_unit = floatval($aJson['Papel_Guarda']['costo_unit_papel']);
            $cortes           = intval($aJson['Papel_Guarda']['corte']);

            $Largo = round(floatval($aAcbG[$i]['LargoSuaje']), 2);
            $Ancho = round(floatval($aAcbG[$i]['AnchoSuaje']), 2);

            $aAcbSuaje_tmp = self::calculoSuaje($tipoGrabado, $tiraje, $Largo, $Ancho, $papel_costo_unit, $cortes, $ventas_model);

            if ($aAcbSuaje_tmp['costo_tot_proceso'] <= 0) {

                self::mError($aJson, $mensaje, $error .  "Suaje (Guarda);");
            }

            $aAcbGSuaje[$i] = $aAcbSuaje_tmp;

            $aJson['Acb_Guarda'] += round(floatval($aAcbSuaje_tmp['costo_tot_proceso']), 2);
            $subtotal            += round(floatval($aAcbSuaje_tmp['costo_tot_proceso']), 2);

            if (count($aAcbSuaje_tmp) > 0) {

                unset($aAcbSuaje_tmp);
            }
        }
    }


    if (count($aAcbGBUV) > 0) {

        $aAcbGBUV_R = array_values($aAcbGBUV);

        $aJson['BarnizG'] = $aAcbGBUV_R;
        $aJson['keys']    = $aJson['keys'] . "cot_alm_barnizuvguarda;";

        if (is_array($aAcbGBUV)) {

            unset($aAcbGBUV);
            unset($aAcbGBUV_R);
        }
    }


    if (count($aAcbGLaser) > 0) {

        $aAcbGLaser_R = array_values($aAcbGLaser);

        $aJson['LaserG'] = $aAcbGLaser_R;
        $aJson['keys']   = $aJson['keys'] . "cot_alm_laserguarda;";

        if (is_array($aAcbGLaser)) {

            unset($aAcbGLaser);
            unset($aAcbGLaser_R);
        }
    }


    if (count($aAcbGGrab) > 0) {

        $aAcbGGrab_R = array_values($aAcbGGrab);

        $aJson['GrabadoG'] = $aAcbGGrab_R;
        $aJson['keys']     = $aJson['keys'] . "cot_alm_grabguarda;";

        if (is_array($aAcbGGrab)) {

            unset($aAcbGGrab);
            unset($aAcbGGrab_R);
        }
    }


    if (count($aAcbGHS) > 0) {

        $aAcbGHS_R = array_values($aAcbGHS);

        $aJson['HotStampingG'] = $aAcbGHS_R;
        $aJson['keys']         = $aJson['keys'] . "cot_alm_hsguarda;";

        if (is_array($aAcbGHS)) {

            unset($aAcbGHS);
            unset($aAcbGHS_R);
        }
    }


    if (count($aAcbGLam) > 0) {

        $aAcbGLam_R = array_values($aAcbGLam);

        $aJson['LaminadoG'] = $aAcbGLam_R;
        $aJson['keys']      = $aJson['keys'] . "cot_alm_lamguarda;";

        if (is_array($aAcbGLam)) {

            unset($aAcbGLam);
            unset($aAcbGLam_R);
        }
    }


    if (count($aAcbGSuaje) > 0) {

        $aAcbGSuaje_R = array_values($aAcbGSuaje);

        $aJson['SuajeG'] = $aAcbGSuaje_R;
        $aJson['keys']   = $aJson['keys'] . "cot_alm_suajeguarda;";

        if (is_array($aAcbGSuaje)) {

            unset($aAcbGSuaje);
            unset($aAcbGSuaje_R);
        }
    }


/*************************** Termina Guarda ****************************/



/**************************** Termina boton acabados *******************/



/************************* Inicia Accesorios ***************************/


    if (isset($_POST["aAccesorios"]) and !empty($_POST["aAccesorios"])) {

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

            $accesorio_tiraje = intval($_POST['qty']);

            switch ($Tipo_accesorio) {
                case 'Herraje':

                    $costo_accesorios_tmp = $ventas_model->costo_accesorios("Herraje");

                    break;
                case 'Ojillos':

                    $costo_accesorios_tmp = $ventas_model->costo_accesorios("Ojillos");

                    break;
                case 'Resorte':

                    $costo_accesorios_tmp = $ventas_model->costo_accesorios("Resorte");

                    break;
                case 'Lengueta de Liston':

                    $costo_accesorios_tmp = $ventas_model->costo_accesorios("Lengueta de Liston");

                    break;
            }

            $costo_unit_accesorio = 0;

            foreach ($costo_accesorios_tmp as $row) {

                $costo_unit_accesorio = $row['costo_unitario'];
                $costo_unit_accesorio = floatval($costo_unit_accesorio);
            }


            if ($costo_unit_accesorio <= 0) {

                self::mError($aJson, $mensaje, "No existe costo unitario (Accesorios);");
            }


            if (is_array($costo_accesorios_tmp)) {

                unset($costo_accesorios_tmp);
            }


            $costo_accesorio = floatval($accesorio_tiraje * $costo_unit_accesorio);
            $costo_accesorio = round($costo_accesorio, 2);


            $aAccesorios[$i]['Tipo_accesorio']       = $Tipo_accesorio;
            $aAccesorios[$i]['Tipo']                 = $Tipo;
            $aAccesorios[$i]['tiraje']               = $accesorio_tiraje;
            $aAccesorios[$i]['Largo']                = $Largo;
            $aAccesorios[$i]['Ancho']                = $Ancho;
            $aAccesorios[$i]['Color']                = $Color;
            $aAccesorios[$i]['costo_unit_accesorio'] = $costo_unit_accesorio;
            $aAccesorios[$i]['costo_accesorios']     = $costo_accesorio;

            $aJson['costo_accesorios'] += $costo_accesorio;
            $subtotal                  += round(floatval($costo_accesorio), 2);
        }


        if (count($aAccesorios) > 0) {

            $aJson['Accesorios'] = $aAccesorios;
            $aJson['keys']       = $aJson['keys'] . "cot_accesorios;";

            if (is_array($aAccesorios)) {

                unset($aAccesorios);
            }
        }
    }


/************************* Inicia Bancos ********************************/


    if (isset($_POST["aBancos"]) and !empty($_POST["aBancos"])) {

        $aBancos_tmp = json_decode($_POST['aBancos'], true);

        $aBancos_R   = array_values($aBancos_tmp);

        $cuantos_aBancos_tmp = count($aBancos_tmp);


        $aBancos = [];


        $cierre_tiraje = intval($_POST['qty']);

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

            $banco_tiraje = intval($_POST['qty']);

            switch ($Tipo_banco) {
                case 'Carton':

                    $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));


                    $costo_bancos_tmp = $ventas_model->costo_bancos("Carton");


                    $costo_unit_banco = 0;

                    foreach ($costo_bancos_tmp as $row) {

                        $costo_unit_banco = $row['precio'];
                        $costo_unit_banco = floatval($costo_unit_banco);
                    }

                    if ($costo_unit_banco <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (bancos carton);");
                    }

                    if (is_array($costo_bancos_tmp)) {

                        unset($costo_bancos_tmp);
                    }


                    $costo_banco = floatval($banco_tiraje * $costo_unit_banco);
                    $costo_banco = round($costo_banco, 2);


                    break;
                case 'Eva':

                    $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));


                    $costo_bancos_tmp = $ventas_model->costo_bancos("Eva");


                    $costo_unit_banco = 0;

                    foreach ($costo_bancos_tmp as $row) {

                        $costo_unit_banco = $row['precio'];
                        $costo_unit_banco = floatval($costo_unit_banco);
                    }

                    if ($costo_unit_banco <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (bancos eva);");
                    }

                    if (is_array($costo_bancos_tmp)) {

                        unset($costo_bancos_tmp);
                    }


                    $costo_banco = floatval($banco_tiraje * $costo_unit_banco);
                    $costo_banco = round($costo_banco, 2);

                    break;
                case 'Espuma':

                    $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));

                    $costo_bancos_tmp = $ventas_model->costo_bancos("Espuma");


                    $costo_unit_banco = 0;

                    foreach ($costo_bancos_tmp as $row) {

                        $costo_unit_banco = $row['precio'];
                        $costo_unit_banco = floatval($costo_unit_banco);
                    }

                    if ($costo_unit_banco <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (bancos espuma);");
                    }


                    if (is_array($costo_bancos_tmp)) {

                        unset($costo_bancos_tmp);
                    }


                    $costo_banco = floatval($banco_tiraje * $costo_unit_banco);
                    $costo_banco = round($costo_banco, 2);

                    break;
                case 'Empalme Banco':

                    $suaje = utf8_encode(self::strip_slashes_recursive($aBancos_R[$i]['Suaje']));

                    $costo_bancos_tmp = $ventas_model->costo_bancos("Empalme Banco");


                    $costo_unit_banco = 0;

                    foreach ($costo_bancos_tmp as $row) {

                        $costo_unit_banco = $row['precio'];
                        $costo_unit_banco = floatval($costo_unit_banco);
                    }

                    if ($costo_unit_banco <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (bancos empalme);");
                    }


                    if (is_array($costo_bancos_tmp)) {

                        unset($costo_bancos_tmp);
                    }


                    $costo_banco = floatval($banco_tiraje * $costo_unit_banco);
                    $costo_banco = round($costo_banco, 2);

                    break;
                case 'Cartulina Suajada':

                    $suaje = "SI";

                    $costo_bancos_tmp = $ventas_model->costo_bancos("Cartulina Suajada");


                    $costo_unit_banco = 0;

                    foreach ($costo_bancos_tmp as $row) {

                        $costo_unit_banco = $row['precio'];
                        $costo_unit_banco = floatval($costo_unit_banco);
                    }

                    if ($costo_unit_banco <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (bancos cartulina suajada);");
                    }


                    if (is_array($costo_bancos_tmp)) {

                        unset($costo_bancos_tmp);
                    }


                    $costo_banco = floatval($banco_tiraje * $costo_unit_banco);
                    $costo_banco = round($costo_banco, 2);

                    break;
            }


            $aBancos[$i]['Tipo_banco']       = $Tipo_banco;
            $aBancos[$i]['tiraje']           = $banco_tiraje;
            $aBancos[$i]['largo']            = $largo;
            $aBancos[$i]['ancho']            = $ancho;
            $aBancos[$i]['profundidad']      = $profundidad;
            $aBancos[$i]['Suaje']            = $suaje;
            $aBancos[$i]['costo_unit_banco'] = $costo_unit_banco;
            $aBancos[$i]['costo_bancos']     = $costo_banco;

            $aJson['costo_bancos'] += $costo_banco;
            $subtotal              += round(floatval($costo_banco), 2);
        }


        if (count($aBancos) > 0) {

            $aJson['Bancos'] = $aBancos;
            $aJson['keys']   = $aJson['keys'] . "cot_bancos;";

            if (is_array($aBancos)) {

                unset($aBancos);
            }
        }
    }


/************************ Termina Bancos ********************************/


/*************************** Inicia Cierres *****************************/


    if (isset($_POST["aCierres"]) and !empty($_POST["aCierres"])) {

        $aCierres_tmp = json_decode($_POST['aCierres'], true);

        $cuantos_aCierres_tmp = count($aCierres_tmp);


        $aCierres = [];


        $cierre_tiraje = intval($_POST['qty']);

        for ($i = 0; $i < $cuantos_aCierres_tmp; $i++) {

            $Tipo_cierre = "";
            $Tipo_cierre = utf8_encode(self::strip_slashes_recursive($aCierres_tmp[$i]['Tipo_cierre']));


            $aCierres[$i]['Tipo_cierre'] = $Tipo_cierre;
            $aCierres[$i]['tiraje']      = $cierre_tiraje;

            $numpares = 0;
            $largo    = null;
            $ancho    = null;
            $tipo     = null;
            $color    = null;

            $costo_cierre = 0;

            $numpares = $aCierres_tmp[$i]['numpares'];
            $numpares = intval($numpares);


            switch ($Tipo_cierre) {
                case 'Iman':

                    $largo = $aCierres_tmp[$i]['largo'];
                    $ancho = $aCierres_tmp[$i]['ancho'];

                    $costo_cierres_tmp = $ventas_model->costo_cierres("Iman");


                    $costo_unit_cierre = 0;

                    foreach ($costo_cierres_tmp as $row) {

                        $costo_unit_cierre = $row['precio'];
                        $costo_unit_cierre = floatval($costo_unit_cierre);
                    }

                    if ($costo_unit_cierre <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (cierres iman);");
                    }


                    if (is_array($costo_cierres_tmp)) {

                        unset($costo_cierres_tmp);
                    }


                    $costo_cierre = round(floatval($cierre_tiraje * $numpares * $costo_unit_cierre), 2);

                    break;
                case 'Liston':

                    $largo = $aCierres_tmp[$i]['largo'];
                    $ancho = $aCierres_tmp[$i]['ancho'];
                    $tipo  = $aCierres_tmp[$i]['tipo'];
                    $color = $aCierres_tmp[$i]['color'];


                    $costo_cierres_tmp = $ventas_model->costo_cierres("Liston");


                    $costo_unit_cierre = 0;

                    foreach ($costo_cierres_tmp as $row) {

                        $costo_unit_cierre = $row['precio'];
                        $costo_unit_cierre = floatval($costo_unit_cierre);
                    }

                    if ($costo_unit_cierre <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (cierres liston);");
                    }


                    if (is_array($costo_cierres_tmp)) {

                        unset($costo_cierres_tmp);
                    }


                    $costo_cierre = round(floatval($cierre_tiraje * $numpares * $costo_unit_cierre), 2);

                    break;
                case 'Marialuisa':

                    $costo_cierres_tmp = $ventas_model->costo_cierres("Marialuisa");


                    $costo_unit_cierre = 0;

                    foreach ($costo_cierres_tmp as $row) {

                        $costo_unit_cierre = $row['precio'];
                        $costo_unit_cierre = floatval($costo_unit_cierre);
                    }

                    if ($costo_unit_cierre <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (cierres marialuisa);");
                    }


                    if (is_array($costo_cierres_tmp)) {

                        unset($costo_cierres_tmp);
                    }


                    $costo_cierre = round(floatval($cierre_tiraje * $numpares * $costo_unit_cierre), 2);

                    break;
                case 'Suaje calado':

                    $largo = intval($aCierres_tmp[$i]['largo']);
                    $ancho = intval($aCierres_tmp[$i]['ancho']);
                    $tipo  = utf8_encode(self::strip_slashes_recursive($aCierres_tmp[$i]['tipo']));


                    $costo_cierres_tmp = $ventas_model->costo_cierres("Suaje calado");


                    $costo_unit_cierre = 0;

                    foreach ($costo_cierres_tmp as $row) {

                        $costo_unit_cierre = $row['precio'];
                        $costo_unit_cierre = floatval($costo_unit_cierre);
                    }

                    if ($costo_unit_cierre <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (cierres suaje calado);");
                    }


                    if (is_array($costo_cierres_tmp)) {

                        unset($costo_cierres_tmp);
                    }


                    $costo_cierre = round(floatval($cierre_tiraje * $numpares * $costo_unit_cierre), 2);

                    break;
                case 'Velcro':

                    $costo_cierres_tmp = $ventas_model->costo_cierres("Velcro");


                    $costo_unit_cierre = 0;

                    foreach ($costo_cierres_tmp as $row) {

                        $costo_unit_cierre = $row['precio'];
                        $costo_unit_cierre = floatval($costo_unit_cierre);
                    }

                    if ($costo_unit_cierre <= 0) {

                        self::mError($aJson, $mensaje, "No existe costo unitario (cierres velcro);");
                    }


                    if (is_array($costo_cierres_tmp)) {

                        unset($costo_cierres_tmp);
                    }


                    $costo_cierre = round(floatval($cierre_tiraje * $numpares * $costo_unit_cierre), 2);

                    break;
            }


            $aCierres[$i]['numpares'] = intval($numpares);


            if ($largo != null) {

                $aCierres[$i]['largo'] = intval($largo);
            } else {

                $aCierres[$i]['largo'] = null;
            }


            if ($ancho != null) {

                $aCierres[$i]['ancho'] = intval($ancho);
            } else {

                $aCierres[$i]['ancho'] = null;
            }


            if ($tipo != null) {

                $aCierres[$i]['tipo'] = utf8_encode(self::strip_slashes_recursive($tipo));
            } else {

                $aCierres[$i]['tipo'] = null;
            }


            if ($color != null) {

                $aCierres[$i]['color'] = utf8_encode(self::strip_slashes_recursive($color));
            } else {

                $aCierres[$i]['color'] = null;
            }


            $aCierres[$i]['costo_unitario'] = $costo_unit_cierre;

            $aCierres[$i]['costo_cierre'] = $costo_cierre;


            $aJson['costo_cierres'] += $costo_cierre;
            $subtotal               += round(floatval($costo_cierre), 2);
        }


        if (count($aCierres) > 0) {

            $aJson['Cierres'] = $aCierres;
            $aJson['keys']   = $aJson['keys'] . "cot_cierres;";

            if (is_array($aCierres)) {

                unset($aCierres);
            }
        }
    }


/************************** Termina Cierres *****************************/


    // descuento porcentaje
    $descuento_pctje = floatval($_POST['descuento_pctje']);

    $descuento = 0;

    $descuento = floatval($subtotal * ($descuento_pctje / 100));

    $descuento = round($descuento, 2);

    $aJson['descuento'] = $descuento;

    if ($descuento >= $subtotal) {

        self::mError($aJson, $mensaje, " El descuento no puede ser mayor al subtotal!;");
    }


    $subtotal                -= $descuento;
    $aJson['costo_subtotal'] = round(floatval($subtotal), 2);


/********************* Termina Accesorios *****************************/

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

        $costo_playo = floatval($tarima_temp * $playo / 2);


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

                $costo_odt_total = $costo_odt_total + $costo_mensajeria;
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

                    $subtotal += $costo_mensajeria;

                    break;
                }
            }
        }


        $aJson['mensajeria'] = round(floatval($costo_mensajeria), 2);


    // utillidad
        $utilidad = 0;

        $db_tmp = $ventas_model->costos_descuentos("Utilidad");

        $utilidad_pctje = 0;

        foreach($db_tmp as $row) {

            $utilidad_pctje = $row['porcentaje'];
            $utilidad_pctje = floatval($utilidad_pctje);
        }

        $utilidad = round(floatval($subtotal * $utilidad_pctje), 2);

        $aJson['Utilidad']       = $utilidad;
        $aJson['utilidad_pctje'] = $utilidad_pctje;



    // iva
        $db_tmp = $ventas_model->costos_descuentos("IVA");

        $iva_pctje = 0;

        foreach($db_tmp as $row) {

            $iva_pctje = $row['porcentaje'];
            $iva_pctje = floatval($iva_pctje);
            $iva_pctje = round($iva_pctje, 2);
        }

        $iva = 0;

        $iva = floatval($subtotal * $iva_pctje);
        $iva = round($iva, 2);

        $aJson['iva'] = $iva;

    // comisiones
        $db_tmp = $ventas_model->costos_descuentos("Comisiones");

        $comisiones_pctje = 0;

        foreach($db_tmp as $row) {

            $comisiones_pctje = $row['porcentaje'];
            $comisiones_pctje = floatval($comisiones_pctje);
            $comisiones_pctje = round($comisiones_pctje, 2);
        }

        $comisiones = 0;

        $comisiones = floatval($subtotal * $comisiones_pctje);
        $comisiones = round($comisiones, 2);

        $aJson['comisiones'] = $comisiones;


    // indirecto
        $db_tmp = $ventas_model->costos_descuentos("Indirecto");

        $indirecto_pctje = 0;

        foreach($db_tmp as $row) {

            $indirecto_pctje = $row['porcentaje'];
            $indirecto_pctje = floatval($indirecto_pctje);
            $indirecto_pctje = round($indirecto_pctje, 2);
        }

        $indirecto = 0;

        $indirecto = floatval($subtotal * $indirecto_pctje);
        $indirecto = round($indirecto, 2);

        $aJson['indirecto'] = $indirecto;


    // ventas
        $db_tmp = $ventas_model->costos_descuentos("Venta");

        $venta_pctje = 0;

        foreach($db_tmp as $row) {

            $venta_pctje = $row['porcentaje'];
            $venta_pctje = floatval($venta_pctje);
            $venta_pctje = round($venta_pctje, 2);
        }

        $venta = 0;

        $venta = floatval($subtotal * $venta_pctje);
        $venta = round($venta, 2);

        $aJson['ventas'] = $venta;


    // isr
        $db_tmp = $ventas_model->costos_descuentos("ISR");

        $isr = 0;

        foreach($db_tmp as $row) {

            $isr_pctje = $row['porcentaje'];
            $isr_pctje = floatval($isr_pctje);
            $isr_pctje = round($isr_pctje, 2);
        }

        $isr = 0;

        $isr = floatval($subtotal * $isr_pctje);
        $isr = round($isr, 2);

        $aJson['ISR'] = $isr;


    // costo odt total
        $costo_odt_total = floatval($subtotal
                        + $utilidad
                        + $iva
                        + $comisiones
                        + $indirecto
                        + $venta
                        + $empaque
                        + $isr
                        );


        $costo_odt_total = round($costo_odt_total, 2);

        $aJson['costo_odt'] = round(floatval($costo_odt_total), 2);

        if ($costo_odt_total <= 0) {

            self::mError($aJson, $mensaje, " El costo de la ODT no puede ser negativo!;");
        }


/******************************************/
/******************************************/

/******************************************/

    // checa que se haya seleccionado correctamente el papel
    // para offset

    // papel empalme
    $id_papel_emp = $aJson['Papel_Empalme']['id_papel'];
    $id_papel_emp = intval($id_papel_emp);

    $l_papel_offset_emp = 0;

    $l_papel_offset_emp = self::checkPapelOffset($id_papel_emp, "offset", $ventas_model);


    if (!$l_papel_offset_emp) {

        $aJson['error'] = $aJson['error'] . " El papel seleccionado (Offset) para el empalme no es correcto;";
    }

    // papel forro cajon
    $id_papel_fcaj = $aJson['Papel_FCaj']['id_papel'];
    $id_papel_fcaj = intval($id_papel_fcaj);

    $l_papel_offset_fcaj = 0;

    $l_papel_offset_fcaj = self::checkPapelOffset($id_papel_fcaj, "offset", $ventas_model);


    if (!$l_papel_offset_fcaj) {

        $aJson['error'] = $aJson['error'] . " El papel seleccionado (Offset) para el forro del cajon no es correcto;";
    }

    // forro cartera
    $id_papel_fcar = $aJson['Papel_FCar']['id_papel'];
    $id_papel_fcar = intval($id_papel_fcar);

    $l_papel_offset_fcar = 0;

    $l_papel_offset_fcar = self::checkPapelOffset($id_papel_fcar, "offset", $ventas_model);


    if (!$l_papel_offset_fcar) {

        $aJson['error'] = $aJson['error'] . " El papel seleccionado (Offset) para el forro de la cartera no es correcto;";
    }

    // guarda
    $id_papel_g = $aJson['Papel_Guarda']['id_papel'];
    $id_papel_g = intval($id_papel_g);

    $l_papel_offset_g = 0;

    $l_papel_offset_g = self::checkPapelOffset($id_papel_g, "offset", $ventas_model);


    if (!$l_papel_offset_g) {

        $aJson['error'] = $aJson['error'] . " El papel seleccionado (Offset) para la guarda no es correcto;";
    }


/*
    self::prettyPrint($id_papel_emp, "id_papel_emp", 5960);
    self::prettyPrint($id_papel_fcaj, "id_papel_fcaj");
    self::prettyPrint($id_papel_fcar, "id_papel_fcar");
    self::prettyPrint($id_papel_g, "id_papel_g");
    self::prettyPrint($l_papel_offset_emp, "l_papel_offset_emp");
    self::prettyPrint($l_papel_offset_fcaj, "l_papel_offset_fcaj");
    self::prettyPrint($l_papel_offset_fcar, "l_papel_offset_fcar");
    self::prettyPrint($l_papel_offset_g, "l_papel_offset_g");
    self::prettyPrint($aJson['error'], "aJson(error)");


    die();
*/


/******************************************/

        $endtime  = microtime(true);
        $timediff = $endtime - $starttime;

        $aJson['tiempo_transcurrido'] = $timediff;


        $debuger   = false;
        $post      = false;
        $grabar    = true;
        $respuesta = false;


        $str_error_len = strlen($aJson['error']);

        if (strlen($aJson['error']) > 0) {

            self::mError($aJson, $mensaje, " No debe grabar esta ODT...");

            $grabar = false;
        }


        $id_modelo = 1;        // Almeja = 1

        if ($grabar and $_POST['grabar'] == "SI") {

            $respuesta = $almeja_model->insertCaja_Almeja($aJson, $id_modelo);

            echo json_encode($respuesta);
        } else {

            if ($post) {

                self::prettyPrint($_POST, "post", 6130);
            }

            if ($debuger) {

                self::prettyPrint($aJson, "aJson", 6135);
            } else {

                echo json_encode($aJson);
            }
        }
    }


/****************** Termina la funcion saveCaja() **********************/


    public function calcMerma() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            $qty = $_POST['cant'];
            $qty = intval($qty);

            $row1 = [];

            $row1 = $ventas_model->getCotizaMermaOffset();
            $row2 = $ventas_model->getCotizaMermaDigital();
            $row3 = $ventas_model->getCotizaMermaSerigrafia();
            $row4 = $ventas_model->getCotizaMermaHotStamping();
            $row5 = $ventas_model->getCotizaMermaLaminado();
            $row6 = $ventas_model->getCotizaMermaBarniz();
            $row7 = $ventas_model->getCotizaMermaSuaje();
            $row8 = $ventas_model->getCotizaMermaForrado();
            $row9 = $ventas_model->getCotizaMermaGrabado();


            $row_all = [];

            $row_all[0] = $row1;
            $row_all[1] = $row2;
            $row_all[]  = $row3;
            $row_all[]  = $row4;
            $row_all[]  = $row5;
            $row_all[]  = $row6;
            $row_all[]  = $row7;
            $row_all[]  = $row8;
            $row_all[]  = $row9;

            echo json_encode($row_all);
        }
    }


    protected function deltax_merma($cant, $algo) {

        $cant_red1 = 0;
        $cant_red2 = 0;
        $delta     = 0;
        $alfa      = 0;

        $cant = intval($cant);
        $algo = intval($algo);

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


/*
    protected function rec_maquila_digital($corte_ancho, $corte_largo, $impresion) {

        $impresion = trim(strval($impresion));

        // tamaño carta digital
        $imp_ancho_dig = 20.5;
        $imp_largo_dig = 27;

        // tamaño doble carta digital
        $t_2carta_ancho = 32;
        $t_2carta_largo = 46.5;


        $tam2 = 0;

        if ($impresion === "TC") {

            if (($corte_ancho <= $imp_ancho_dig) and ($corte_largo <= $imp_largo_dig)) {

                $tam2 = 1;       // tamaño carta
            }
        }

        if  ($impresion === "T2C") {

            if (($corte_ancho <= $t_2carta_ancho) and ($corte_largo <= $t_2carta_largo)) {

                $tam2 = 1;        // tamaño doble carta
            }
        }

        return $tam2;
    }
*/

    // Redondea al entero superior siguiente
    protected function deltax($cant, $algo) {

        $cant_red1 = 0;
        $cant_red2 = 0;
        $delta     = 0;
        $alfa      = 0;

        $cant = intval($cant);
        $algo = intval($algo);

        if ($algo > 0) {

            $cant_red1 = ($cant / $algo);
            $cant_red2 = intval($cant / $algo);
        }

        $delta = $cant_red1 - $cant_red2;

        if($delta > 0) {

            $alfa = $cant_red2 + 1;
        } else {

            $alfa = $cant_red2;
        }

        return $alfa;
    }


    public function calculo_merma_acabados($cantidad_minima, $cantidad, $por_cada_x, $adicional) {

        $tiraje = intval($_POST['qty']);

        $merma_acabados = [];

        if ($tiraje < $cantidad_minima) {

            $cantidad_min  = intval($cantidad);
            $cantidad_adic = 0;
            $cantidad_tot  = intval($cantidad);
        } else {

            $cantidad_min  = intval($cantidad);

            $delta_tmp = intval($tiraje - $cantidad_minima);

            $delta = self:: deltax_merma($delta_tmp, $por_cada_x);

            $cantidad_adic = intval($delta * $adicional);
            $cantidad_tot  = intval($cantidad) + $cantidad_adic;
        }

        $merma_acabados[0] = $cantidad_min;
        $merma_acabados[1] = $cantidad_adic;
        $merma_acabados[2] = $cantidad_tot;

        return $merma_acabados;
    }


    protected function detalle_proc_offset($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']                 = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['Tipo']                   = self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo']);
            $aJson_tmp[$j]['tiraje']                 = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['num_tintas']             = intval($sql_tabla_temp_db[$j]['num_tintas']);

            /*
            $aJson_tmp[$j]['corte_costo_unitario']   = floatval($sql_tabla_temp_db[$j]['corte_costo_unitario']);
            $aJson_tmp[$j]['corte_por_millar']       = intval($sql_tabla_temp_db[$j]['corte_por_millar']);
            */

            $aJson_tmp[$j]['costo_corte']            = floatval($sql_tabla_temp_db[$j]['costo_corte']);
            $aJson_tmp[$j]['costo_unitario_laminas'] = floatval($sql_tabla_temp_db[$j]['costo_unitario_laminas']);
            $aJson_tmp[$j]['costo_tot_laminas']      = floatval($sql_tabla_temp_db[$j]['costo_tot_laminas']);
            $aJson_tmp[$j]['costo_unitario_arreglo'] = floatval($sql_tabla_temp_db[$j]['costo_unitario_arreglo']);
            $aJson_tmp[$j]['costo_tot_arreglo']      = floatval($sql_tabla_temp_db[$j]['costo_tot_arreglo']);
            $aJson_tmp[$j]['costo_unitario_tiro']    = floatval($sql_tabla_temp_db[$j]['costo_unitario_tiro']);
            $aJson_tmp[$j]['costo_tot_tiro']         = floatval($sql_tabla_temp_db[$j]['costo_tot_tiro']);
            $aJson_tmp[$j]['costo_tot_proceso']      = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }


        return $aJson_tmp;
    }


    protected function detalle_maq_proc_offset($id_odt, $nombre_tabla_tmp, $ventas_model) {

        //$nombre_tabla_tmp = trim(strval($nombre_tabla_tmp));

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']                 = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['Tipo']                   = self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo']);
            $aJson_tmp[$j]['tiraje']                 = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['num_tintas']             = intval($sql_tabla_temp_db[$j]['num_tintas']);
            $aJson_tmp[$j]['arreglo_costo_unitario'] = floatval($sql_tabla_temp_db[$j]['arreglo_costo_unitario']);
            $aJson_tmp[$j]['arreglo_costo']          = intval($sql_tabla_temp_db[$j]['arreglo_costo']);
            $aJson_tmp[$j]['costo_unitario_laminas'] = floatval($sql_tabla_temp_db[$j]['costo_unitario_laminas']);
            $aJson_tmp[$j]['costo_laminas']          = floatval($sql_tabla_temp_db[$j]['costo_laminas']);
            $aJson_tmp[$j]['costo_unitario']         = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['costo_tot']              = floatval($sql_tabla_temp_db[$j]['costo_tot']);
            $aJson_tmp[$j]['costo_tot_proceso']      = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }


        return $aJson_tmp;
    }


    protected function detalle_proc_digital($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']            = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tiraje']            = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['corte_ancho']       = floatval($sql_tabla_temp_db[$j]['corte_ancho']);
            $aJson_tmp[$j]['corte_largo']       = floatval($sql_tabla_temp_db[$j]['corte_largo']);
            $aJson_tmp[$j]['imp_ancho']         = floatval($sql_tabla_temp_db[$j]['imp_ancho']);
            $aJson_tmp[$j]['imp_largo']         = floatval($sql_tabla_temp_db[$j]['imp_largo']);
            $aJson_tmp[$j]['impresion']         = utf8_encode($sql_tabla_temp_db[$j]['impresion']);
            $aJson_tmp[$j]['costo_unitario']    = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['costo_tot_proceso'] = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_serigrafia($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']              = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tipo']                = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo']));
            $aJson_tmp[$j]['tiraje']              = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['num_tintas']          = intval($sql_tabla_temp_db[$j]['num_tintas']);
            $aJson_tmp[$j]['costo_unit_arreglo']  = floatval($sql_tabla_temp_db[$j]['costo_unit_arreglo']);
            $aJson_tmp[$j]['costo_arreglo']       = floatval($sql_tabla_temp_db[$j]['costo_arreglo']);
            $aJson_tmp[$j]['costo_unitario_tiro'] = floatval($sql_tabla_temp_db[$j]['costo_unit_tiro']);
            $aJson_tmp[$j]['costo_tiro']          = floatval($sql_tabla_temp_db[$j]['costo_tiro']);
            $aJson_tmp[$j]['cortes_por_pliego']   = intval($sql_tabla_temp_db[$j]['cortes_por_pliego']);
            $aJson_tmp[$j]['costo_tot_proceso']   = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Barniz_UV($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']            = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tipoGrabado']       = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo_grabado']));
            $aJson_tmp[$j]['tiraje']            = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['Largo']             = floatval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['Ancho']             = floatval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['area']              = floatval($sql_tabla_temp_db[$j]['area']);
            $aJson_tmp[$j]['costo_unitario']    = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['costo_tot_proceso'] = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Laser($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']            = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tipo_grabado']      = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo_grabado']));
            $aJson_tmp[$j]['tiraje']            = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['costo_unitario']    = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['tiempo_requerido']  = floatval($sql_tabla_temp_db[$j]['tiempo_requerido']);
            $aJson_tmp[$j]['costo_tot_proceso'] = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Grabado($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']                 = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tipoGrabado']            = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo_grabado']));
            $aJson_tmp[$j]['Largo']                  = floatval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['Ancho']                  = floatval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['ubicacion']              = self::strip_slashes_recursive($sql_tabla_temp_db[$j]['ubicacion']);
            $aJson_tmp[$j]['placa_area']             = floatval($sql_tabla_temp_db[$j]['placa_area']);
            $aJson_tmp[$j]['placa_costo_unitario']   = floatval($sql_tabla_temp_db[$j]['placa_costo_unitario']);
            $aJson_tmp[$j]['placa_costo']            = floatval($sql_tabla_temp_db[$j]['placa_costo']);
            $aJson_tmp[$j]['arreglo_costo_unitario'] = floatval($sql_tabla_temp_db[$j]['arreglo_costo_unitario']);
            $aJson_tmp[$j]['arreglo_costo']          = floatval($sql_tabla_temp_db[$j]['arreglo_costo']);
            $aJson_tmp[$j]['costo_unitario']         = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['costo_tiro']             = floatval($sql_tabla_temp_db[$j]['costo_tiro']);
            $aJson_tmp[$j]['costo_tot_proceso']      = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_HotStamping($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']                  = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tipoGrabado']             = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo_grabado']));
            $aJson_tmp[$j]['Largo']                   = intval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['Ancho']                   = intval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['Color']                   = self::strip_slashes_recursive($sql_tabla_temp_db[$j]['color']);
            $aJson_tmp[$j]['placa_area']              = floatval($sql_tabla_temp_db[$j]['placa_area']);
            $aJson_tmp[$j]['placa_costo_unitario']    = floatval($sql_tabla_temp_db[$j]['placa_costo_unitario']);
            $aJson_tmp[$j]['placa_costo']             = floatval($sql_tabla_temp_db[$j]['placa_costo']);
            $aJson_tmp[$j]['pelicula_Largo']          = intval($sql_tabla_temp_db[$j]['pelicula_largo']);
            $aJson_tmp[$j]['pelicula_Ancho']          = intval($sql_tabla_temp_db[$j]['pelicula_ancho']);
            $aJson_tmp[$j]['pelicula_area']           = floatval($sql_tabla_temp_db[$j]['pelicula_area']);
            $aJson_tmp[$j]['pelicula_costo_unitario'] = floatval($sql_tabla_temp_db[$j]['pelicula_costo_unitario']);
            $aJson_tmp[$j]['pelicula_costo']          = floatval($sql_tabla_temp_db[$j]['pelicula_costo']);
            $aJson_tmp[$j]['arreglo_costo_unitario']  = floatval($sql_tabla_temp_db[$j]['arreglo_costo_unitario']);
            $aJson_tmp[$j]['arreglo_costo']           = floatval($sql_tabla_temp_db[$j]['arreglo_costo']);
            $aJson_tmp[$j]['costo_unitario']          = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['costo_tiro']              = floatval($sql_tabla_temp_db[$j]['costo_tiro']);
            $aJson_tmp[$j]['costo_tot_proceso']       = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Laminado($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']            = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tipoGrabado']       = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo_grabado']));
            $aJson_tmp[$j]['Largo']             = intval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['Ancho']             = intval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['area']              = floatval($sql_tabla_temp_db[$j]['area']);
            $aJson_tmp[$j]['costo_unitario']    = floatval($sql_tabla_temp_db[$j]['costo_unitario']);
            $aJson_tmp[$j]['costo_tot_proceso'] = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    protected function detalle_proc_Suaje($id_odt, $nombre_tabla_tmp, $ventas_model) {

        $nombre_tabla_tmp = self::strip_slashes_recursive($nombre_tabla_tmp);

        $aJson_tmp = [];

        $sql_tabla_temp_db = $ventas_model->detalle_tabla_offset($id_odt, $nombre_tabla_tmp);

        $cuantos_db = count($sql_tabla_temp_db);

        for ($j = 0; $j < $cuantos_db; $j++) {

            $aJson_tmp[$j]['id_odt']              = intval($sql_tabla_temp_db[$j]['id_odt']);
            $aJson_tmp[$j]['tiraje']              = intval($sql_tabla_temp_db[$j]['tiraje']);
            $aJson_tmp[$j]['tipoGrabado']         = utf8_encode(self::strip_slashes_recursive($sql_tabla_temp_db[$j]['tipo_grabado']));
            $aJson_tmp[$j]['Largo']               = floatval($sql_tabla_temp_db[$j]['largo']);
            $aJson_tmp[$j]['Ancho']               = floatval($sql_tabla_temp_db[$j]['ancho']);
            $aJson_tmp[$j]['perimetro']           = intval($sql_tabla_temp_db[$j]['perimetro']);
            $aJson_tmp[$j]['tabla_suaje']         = floatval($sql_tabla_temp_db[$j]['tabla_suaje']);
            $aJson_tmp[$j]['arreglo']             = floatval($sql_tabla_temp_db[$j]['arreglo_costo_unitario']);
            $aJson_tmp[$j]['tiro_costo_unitario'] = floatval($sql_tabla_temp_db[$j]['tiro_costo_unitario']);
            $aJson_tmp[$j]['costo_tiro']          = floatval($sql_tabla_temp_db[$j]['costo_tiro']);
            $aJson_tmp[$j]['costo_tot_proceso']   = floatval($sql_tabla_temp_db[$j]['costo_tot_proceso']);
        }

        return $aJson_tmp;
    }


    public function getAllForms($model, $options_model) {

        $html = '';
        $i    = 1;

        $options = $options_model->getOptionsByModel($model);

        foreach ($options as $option) {

            $even   = ($i & 1)? 'even':'';
            $html   .= '<div class="cajas-input-group ' . $even . '">';
            $html   .= '<div class="cajas-col-input left"><span>' . $option['nombre'] . ': </span></div>';
            $html   .= '<div class="cajas-col-input right">';
            $values = $options_model->getValuesByOption($option['id_variante']);

            switch ($option['tipo_opcion']) {

                case 'text':

                    foreach ($values as $value) {

                        $html .= '<input type="text" step="any" required placeholder="cm" class="cajas-input" name="' . $option['name'] . '">';
                    }

                    break;
                case 'number':

                    foreach ($values as $value) {

                        $html .= '<input type="number" step="any" required placeholder="cm" class="cajas-input" name="' . $option['name'] . '">';
                    }

                    break;
                case 'radio':

                    foreach ($values as $value) {

                        $html .= '<input type="radio" id="' . $value['id_valor'] . '" required  name="' . $option['name'] . '" value="' . $value['valor'] . '" ><label for="' . $value['id_valor'] . '" >' . $value['valor'] . ' </label>';
                    }

                    break;
                case 'select':

                    $html .= '<select class="cajas-input" name="' . $option['name'] . '" >';
                    $html .= '<option selected disabled>Elige una opcion</option>';

                    foreach ($values as $value) {

                        $html .= '<option value="' . $value['valor'] . '">' . $value['valor'] . '</option>';
                    }

                    $html .= '</select>';

                    break;
            }

            $html .= '</div></div>';

            $i++;
        }

        $html .= '<input class="cajas-form-submitter" type="submit" value="CALCULAR">';


        if ($model == '1') {

            return $html;
        } else {

            return "<p style='font-weight:bold;padding:30px;'>En desarrollo</p>";
        }
    }


    public function clientes() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login        = $this->loadController('login');
        $login_model  = $this->loadModel('LoginModel');
        $ventas_model = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            $title ='Pendientes';
            $rows  = $ventas_model->getClients();

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizador/clientes.php';
            require_once 'application/views/templates/footer.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function deleteCotizacion() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $ventas_model = $this->loadModel('VentasModel');

        if ( isset($_POST['id']) ) {

            $eliminacion = $ventas_model->deleteCotizacion();

            if( $eliminacion ) {

                echo "true";

                return true;
            } else {

                echo "false";

                return false;
            }
        } else {

            return false;
        }
    }


    public function deleteCliente(){

        if (!isset($_SESSION)) {

            session_start();
        }

        $ventas_model = $this->loadModel('VentasModel');

        if ( isset($_POST['id']) ) {

            $eliminacion = $ventas_model->deleteCliente($_POST['id']);

            if( $eliminacion ) {

                $respuesta = true;
            }else{

                $respuesta = false;
            }
        } else {

            $respuesta = false;
        }

        echo json_encode($respuesta);
    }


    public function getcotizacionAll() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');

        $cotizaciones = $ventas_model->getCotizaciones();

        echo json_encode($cotizaciones);
    }


    public function guardadas() {

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
                //header("Location:" . URL . 'cotizador/clientes/');
            }
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function nuevo_cliente() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $login_model  = $this->loadModel('LoginModel');
        $ventas_model = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizador/cliente_form.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function newCliente(){

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $login_model  = $this->loadModel('LoginModel');
        $ventas_model = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            $registro  = $ventas_model->addNewCliente();

            if ( $registro ) {

                $response = true;
            } else {

                $response = false;
            }
        }

        echo json_encode($response);
    }


    public function modificar_cliente() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $login_model  = $this->loadModel('LoginModel');
        $ventas_model = $this->loadModel('VentasModel');


        if($login->isLoged()) {

            if( $_GET['idCliente'] ){

                $id = $_GET['idCliente'];
                $datos = $ventas_model->getClientById($id);

                require_once 'application/views/templates/head.php';
                require_once 'application/views/templates/top_menu.php';
                require_once 'application/views/cotizador/mod_cliente_form.php';
                require_once 'application/views/cotizador/footer.php';
            }else{

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'cotizador/clientes/"';
            echo '</script>';
                //header("Location:" . URL."cotizador/clientes");
            }


        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function updateCliente(){

        if (!isset($_SESSION)) {

            session_start();
        }

        $ventas_model = $this->loadModel('VentasModel');

        $update  = $ventas_model->updateCliente();

        if ( $update ) {

            $response = true;
        } else {

            $response = false;
        }
        echo json_encode($response);
    }


    public function checkClient(){

        if (!isset($_SESSION)) {

            session_start();
        }

        $ventas_model = $this->loadModel('VentasModel');
        $nombre       = self::strip_slashes_recursive($_POST['nombre']);
        $check        = $ventas_model->checkClient($nombre);
        $response     = false;

        if ( $check ) {

            $response = true;
        }
        echo json_encode($response);
    }


    public function getOptions() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $login_model   = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');

        if($login->isLoged()) {

            $process = $_POST['process'];
            $html    = '';
            $i       = 1;
            $options = $options_model->getOptionsByProcess($process);

            foreach ($options as $option) {

                if ($option['tipo']=='parent') {

                    $childs = $options_model->getOptionChilds($option['id_opcion']);

                    foreach ($childs as $child) {

                        if ($child['tipo'] == 'parent') {

                            $grand_childs = $options_model->getOptionGrandChilds($child['id_pvariante']);

                            $html .= '<p>' . $child['texto'] . '</p>';

                            foreach ($grand_childs as $key => $grand_child) {

                                switch ($grand_child['tipo']) {

                                    case 'text':

                                        $html .= '<input type="text" step="any" required placeholder="cm" class="cajas-input" name="' . $grand_child['html_name'] . '">';

                                        break;
                                    case 'number':

                                        $html .= '<input type="number" step="any" required placeholder="cm" class="cajas-input" name="' . $grand_child['html_name'] . '">';

                                        break;
                                    case 'radio':

                                        $html .= '<input type="radio" id="' . $grand_child['id_hijo'] . '" required  name="' . $grand_child['html_name'] . '" value="' . $grand_child['value'] . '" ><label for="'.$grand_child['id_hijo'] . '" >' . $grand_child['texto'] . ' </label>';

                                        break;
                                }
                            }
                        } else {
                        }
                    }
                } else {

                    switch ($option['tipo_opcion']) {

                        case 'text':

                            foreach ($values as $value) {

                                $html .= '<input type="text" step="any" required placeholder="cm" class="cajas-input" name="' . $option['name'] . '">';
                            }

                            break;
                        case 'number':

                            foreach ($values as $value) {

                                $html .= '<input type="number" step="any" required placeholder="cm" class="cajas-input" name="' . $option['name'] . '">';
                            }

                            break;
                        case 'radio':

                            foreach ($values as $value) {

                                $html .= '<input type="radio" id="'.$value['id_valor'] . '" required name="' . $option['name'] . '" value="' . $value['valor'] . '" ><label for="' . $value['id_valor'] . '" >' . $value['valor'] . ' </label>';
                            }

                            break;
                        case 'select':

                            $html .= '<select class="cajas-input" name="' . $option['name'] . '" >';
                            $html .= '<option selected disabled>Elige una opcion</option>';

                            foreach ($values as $value) {

                                $html .= '<option value="' . $value['valor'] . '">' . $value['valor'] . '</option>';
                            }

                            $html .= '</select>';

                            break;
                    }
                }

                $i++;

                $html .= '<button class="tab-btn-sumbit" onclick="closeModal();">Listo</button>';

                echo $html;
            }

            $html .= '<input class="cajas-form-submitter" type="submit" value="CALCULAR">';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function invitaciones() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $options_model = $this->loadModel('OptionsModel');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            $title = 'Pendientes';

            if (isset($_GET['c'])) {

                $cliente       = $_GET['c'];
                $invitations   = $options_model->getInvitations();
                $rows          = $options_model->getAumentos();
                $update        = false;
                $nombrecliente = $options_model->getClientInfo($_GET['c'],'nombre');

                //$nombrecliente =$options_model->getClientInfo($_GET['c'],'nombre') . ' ' . $options_model->getClientInfo($_GET['c'],'apellido');
            } else {

                $nombrecliente = '--';
            }

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizador/invitaciones.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function detalles() {

        if (!isset($_SESSION)) {

            session_start();
        }


        $login         = $this->loadController('login');
        $options_model = $this->loadModel('OptionsModel');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');

        if($login->isLoged()) {

            $title = 'Pendientes';

            if (isset($_GET['ct']) &&! empty($_GET['ct'])) {

                $cotizacion    = $options_model->getCotizacionById($_GET['ct']);
                $invitations   = $options_model->getInvitations();
                $rows          = $options_model->getAumentos();
                $update        = true;

                $nombrecliente = $options_model->getClientInfo($_GET['c'],'nombre');

                $cliente = $_GET['c'];

                require_once 'application/views/templates/head.php';
                require_once 'application/views/templates/top_menu.php';
                require_once 'application/views/cotizador/invitaciones.php';
            } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'cotizador/clientes/"';
            echo '</script>';
                //header("Location:" . URL . 'cotizador/clientes');
            }
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function saveInvitation() {

        if (!isset($_SESSION)) {

            session_start();
        }

        error_reporting(0);


        $login         = $this->loadController('login');
        $options_model = $this->loadModel('OptionsModel');
        $login_model   = $this->loadModel('LoginModel');
        $ventas_model  = $this->loadModel('VentasModel');

        $response = array();

        if($login->isLoged()) {

            $response['logged'] = 'true';

            $total      = $_POST['total'];
            $models     = $_POST['models'];
            $prices     = $_POST['prices'];
            $p_listas   = $_POST['p_listas'];
            $idps       = $_POST['id_prods'];
            $ex_amounts = $_POST['ex-increment'];

            $detalle = array();

            $ids = (isset($_POST['ids']))? $_POST['ids']:'false';

            foreach ($ids as $key => $id) {

                $model   = $models[$id];
                $price   = $total[$id];
                $q       = (empty($qty[$id]))? 100: $qty[$id];
                $idp     = $idps[$id];
                $plista  = $p_listas[$id];
                $cliente = $_POST['cliente'];

                $detalle[$id]['modelo']    = $models[$id];
                $detalle[$id]['cantidad']  = $q;
                $detalle[$id]['monto']     = $price;
                $detalle[$id]['id_modelo'] = $idp;

                if (isset($_POST['extra-'.$id])) {

                    foreach ($_POST['extra-' . $id] as $key => $extra) {

                        $detalle[$id]['aumentos'][$extra]['costo'] = $ex_amounts[$extra];
                        $detalle[$id]['aumentos'][$extra]['id_aumento'] = $extra;
                    }
                }
            }

            $contenido = json_encode($detalle);

            if ($_POST['case'] == 'insert') {

                $saved = $ventas_model->newCotizacion($model, $q, $price, $cliente, $idp, $plista, $contenido, 'invitacion');

                if ($saved) {

                    $_SESSION['messages']     .= 'La informacion se guardo correctamente.';
                    $_SESSION['notification'] = 'success';
                    $_SESSION['result']       = 'LISTO:';
                    $response['message']      = '<div class="c-successs"><div></div><span>Exito: </span>Datos guardados correctamente!</div>';
                    $response['success']      = 'true';
                } else {

                    $response['success'] = 'false';
                }
            } else {

                $updated = $ventas_model->updateCotizacion($model, $q, $price, $cliente, $idp, $plista, $contenido, 'invitacion', $_POST['id_cotizacion']);

                if ($updated) {

                    $_SESSION['messages']     .= 'La informacion se guardo correctamente.';
                    $_SESSION['notification'] = 'success';
                    $_SESSION['result']       = 'LISTO:';
                    $response['message']      = '<div class="c-successs"><div></div><span>Exito: </span>Datos guardados correctamente!</div>';
                    $response['success']      = 'true';
                } else {

                    $response['message'] = '<div class="c-fail"><div></div><span>Error: </span>Ocurrio un problema y no se guardo la informacion</div>';
                    $response['success'] = 'false';
                }
            }
        } else {

            $response['logged'] = 'false';

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }

        echo json_encode($response);
    }


    public function getCotizacion(){

        session_start();
        $login        = $this->loadController('login');
        $cotizacion   = $this->loadModel('CotizacionModel');
        $ventas_model = $this->loadModel('VentasModel');

        if( $login->isLoged() ) {

            $cotizaciones = $cotizacion->getCotizacion();
            $clientes     = $ventas_model->getClients();

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizaciones/lista_cotizaciones.php';
        } else {

            header("Location:" . URL . 'login/');
        }
    }


    public function newCotizacion(){

        session_start();

        $login         = $this->loadController('login');
        $options_model = $this->loadModel('optionsmodel');
        $ventas_model  = $this->loadModel('VentasModel');

        $idCliente  = $_GET['cliente'];
        $cliente    = $ventas_model->getClientById($idCliente);
        $porcentaje = $options_model->getPorcentajes();

        if( $login->isLoged() ) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizaciones/nueva_cotizacion.php';
        } else {

            header("Location:" . URL . 'login/');
        }
    }


    public function saveCotizacion(){

        $modeloCotizacion            = $this->loadModel('CotizacionModel');
        $upload                      = $modeloCotizacion->uploadCotizacion();
        $result                      = false;

        if( $upload ) $result        = true;

        echo json_encode($result);
    }


    public function modificar_cotizacion(){

        session_start();

        $login            = $this->loadController('login');
        $options_model    = $this->loadModel('optionsmodel');
        $modeloCotizacion = $this->loadModel('CotizacionModel');

        $idCot  = intval($_GET['idCot']);

        $cotizacion = $modeloCotizacion->getCotizacionByID($idCot);

        $porcentaje = $options_model->getPorcentajes();

        if( $login->isLoged() ) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cotizaciones/modificar_cotizacion.php';
        } else {

            header("Location:" . URL . 'login/');
        }
    }


    public function updateCotizacion(){

        $modeloCotizacion            = $this->loadModel('CotizacionModel');
        $upload                      = $modeloCotizacion->updateCotizacion();
        $result                      = false;

        if( $upload ) $result        = true;

        echo json_encode($result);
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

        $num_odt   = "";
        $id_modelo = 0;

        $cot_odt_db = $ventas_model->getOdtById($id_odt);

        $odt = $cot_odt_db['num_odt'];
        $odt = trim($odt);

        $id_modelo = $cot_odt_db['id_modelo'];
        $id_modelo = intval($id_modelo);

        $calculadora = $ventas_model->getCalculadora($id_odt, $id_modelo);


        foreach($calculadora as $row) {

            $b         = $row['b'];
            $d         = $row['d'];
            $h         = $row['h'];
            $p         = $row['p'];
            $g         = $row['g_cajon'];
            $G         = $row['g_cartera'];
            $e         = $row['e'];
            $E         = $row['e_may'];
            $b1        = $row['b1'];
            $h1        = $row['h1'];
            $p1        = $row['p1'];
            $x         = $row['x'];
            $y         = $row['y'];
            $x1        = $row['x1'];
            $y1        = $row['y1'];
            $x11       = $row['x11'];
            $y11       = $row['y11'];
            $b11       = $row['b11'];
            $h11       = $row['h11'];
            $f         = $row['f'];
            $k         = $row['k'];
            $B         = $row['b_may'];
            $H         = $row['h_may'];
            $P         = $row['p_may'];
            $Y         = $row['y_may'];
            $B1        = $row['b1_may'];
            $Y1        = $row['y1_may'];
            $B11       = $row['b11_may'];
            $Y11       = $row['y11_may'];
        }

        require_once 'application/views/templates/head.php';
        require_once 'application/views/templates/top_menu.php';
        require_once 'application/views/calculadora/almeja3.php';
        require_once 'application/views/templates/footer.php';
    }


    public function printBoxCalculate(){

        session_start();

        $login = $this->loadController('login');

        if(!$login->isLoged()){

            header("Location:" . URL . 'login/');

        }

        if (empty($_SESSION['calculadora'])) {

            header("Location:" . URL . 'cotizador/getCotizaciones');
        }

        $odt = $_SESSION['calculadora']['odt'];

        $b = $_SESSION['calculadora']['base'];
        $h = $_SESSION['calculadora']['alto'];
        $p = $_SESSION['calculadora']['profundidad'];
        $g = $_SESSION['calculadora']['grosor_cajon'];
        $G = $_SESSION['calculadora']['grosor_cartera'];

        $e = $_SESSION['calculadora']['e'];
        $E = $_SESSION['calculadora']['E'];

        /* Diseño */
        $b1  = $_SESSION['calculadora']['b1'];
        $h1  = $_SESSION['calculadora']['h1'];
        $p1  = $_SESSION['calculadora']['p1'];
        $x   = $_SESSION['calculadora']['x'];
        $y   = $_SESSION['calculadora']['y'];
        $x1  = $_SESSION['calculadora']['x1'];
        $y1  = $_SESSION['calculadora']['y1'];
        $x11 = $_SESSION['calculadora']['x11'];
        $y11 = $_SESSION['calculadora']['y11'];

        //forro
        $b11 = $_SESSION['calculadora']['b11'];
        $h11 = $_SESSION['calculadora']['h11'];
        $f   = $_SESSION['calculadora']['f'];
        $k   = $_SESSION['calculadora']['k'];

        //cartera
        $B   = $_SESSION['calculadora']['B'];
        $H   = $_SESSION['calculadora']['H'];
        $P   = $_SESSION['calculadora']['P'];
        $Y   = $_SESSION['calculadora']['Y'];
        $B1  = $_SESSION['calculadora']['B1'];
        $Y1  = $_SESSION['calculadora']['Y1'];
        $B11 = $_SESSION['calculadora']['B11'];
        $Y11 = $_SESSION['calculadora']['Y11'];

        require 'application/views/templates/head.php';
        require 'application/views/templates/top_menu.php';
        require 'application/views/calculadora/almeja3.php';
        require 'application/views/templates/footer.php';
    }
}
