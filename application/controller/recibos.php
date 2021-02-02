<?php

class Recibos extends Controller
{
    
 public function index(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

       
if($login->isLoged()){
    require_once 'application/views/templates/head.php';
    require_once 'application/views/templates/top_menu.php';
    require_once 'application/views/recibos/altas.php';
    require_once 'application/views/templates/footer.php';
  
    }else{

        header("Location:".URL.'login/');

    }
 }


 public function detallesRecibo() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

        $row = $ventas_model->getAddTicket($_GET['id_boleta']);


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/addticket.php';
            require_once 'application/views/templates/footer.php';

        } else {

            header("Location:" . URL . 'login/');
        }
    }

    public function facturacion() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/facturarcheck.php';
            require_once 'application/views/templates/footer.php';

        } else {

            header("Location:" . URL . 'login/');
        }
    }

    public function facturar() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');


        if($login->isLoged()) {

          $inserted = $ventas_model->getFacturar($_POST['factura'],$_POST['total'],$_POST['porvalidar'], $_POST['totalrecibos']);

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/facturadas.php';
            require_once 'application/views/templates/footer.php';
        
        } else {

            header("Location:" . URL . 'login/');
        }
    }

 public function uploadFiles(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

        $store=$_SESSION['user']['id_tienda'];

        $id_boleta = "";

        $id_boleta=$_POST['id_boleta'];

        $inserted=$ventas_model->getUpdatetoRevisado($id_boleta);

        if($login->isLoged()){

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/altas.php';
            require_once 'application/views/templates/footer.php';
                
  
    }else{

        header("Location:".URL.'login/');

    }

    }


    public function altas(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

if($login->isLoged()){
        
    
    require_once 'application/views/templates/head.php';
    require_once 'application/views/templates/top_menu.php';
    require_once 'application/views/recibos/altas.php';
    require_once 'application/views/templates/footer.php';
  
    }else{

        header("Location:".URL.'login/');

    }
 }

 public function revisadas(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

if($login->isLoged()){
        
    
    require_once 'application/views/templates/head.php';
    require_once 'application/views/templates/top_menu.php';
    require_once 'application/views/recibos/revisadas.php';
    require_once 'application/views/templates/footer.php';
  
    }else{

        header("Location:".URL.'login/');

    }
 }
 public function facturadas(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

if($login->isLoged()){
        
    
    require_once 'application/views/templates/head.php';
    require_once 'application/views/templates/top_menu.php';
    require_once 'application/views/recibos/facturadas.php';
    require_once 'application/views/templates/footer.php';
  
    }else{

        header("Location:".URL.'login/');

    }
 }

 public function factura() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

        $row = $ventas_model->getDetallesFactura($_GET['factura']);


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/factura.php';
            require_once 'application/views/templates/footer.php';
        
        } else {

            header("Location:" . URL . 'login/');
        }
    }

     public function BuscarFechas() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

        $row = $ventas_model->getFiles5();


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/facturarCheck.php';
            require_once 'application/views/templates/footer.php';

        } else {

            header("Location:" . URL . 'login/');
        }
    }


public function detallesFactura() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

        $row = $ventas_model->getFacturaModificar($_GET['factura']);


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/modificarfactura.php';
            require_once 'application/views/templates/footer.php';

        } else {

            header("Location:" . URL . 'login/');
        }
    }

public function actualizarFactura() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');


        if($login->isLoged()) {

          $inserted = $ventas_model->getActualizaFactura();

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/facturadas.php';
            require_once 'application/views/templates/footer.php';
        
        } else {

            header("Location:" . URL . 'login/');
        }
    }

    public function eliminarElemento() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');

        $row = $ventas_model->getModFacElement($_GET['id_boleta'], $_GET['factura']);


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/modfactura1.php';
            require_once 'application/views/templates/footer.php';

        } else {

            header("Location:" . URL . 'login/');
        }
    }


    public function eliminarBFac() {


        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        
        $login_model = $this->loadModel('LoginModel');

        $ventas_model = $this->loadModel('VentasModel');


        if($login->isLoged()) {

          $inserted = $ventas_model->getFacturaMod2();
          $inserted2 = $ventas_model->getFacturaMod3();

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/recibos/facturadas.php';
            require_once 'application/views/templates/footer.php';
        
        } else {

            header("Location:" . URL . 'login/');
        }
    }
}



?>
