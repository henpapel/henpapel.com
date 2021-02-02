<?php 

class Velada extends Controller {

	public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');

        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/index.php';
            require_once 'application/views/templates/footer.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }

    // Inserta en las tablas
    public function Guardar() {
       
        error_reporting(0);

        $optionsmodel = $this->loadModel('OptionsModel');
        $insertar     = $optionsmodel->getInsert($_POST);

        $response = array();
      
        if ($insertar) {

            $response['message'] = '<div class="notification success"><div></div><p><span>Exito: </span>Datos guardados correctamente!</p></div>';
      
            $response['success'] = 'true';
        } else {

            $response['message'] = '<div class="notification fail"><div></div><p><span>Error: </span>Ocurrio un problema y no se guardo la informacion</p></div>';

            $response['success'] = 'false';
        }  

        echo json_encode($response);
    }
    

    public function reporte() {
  
        if (!isset($_SESSION)) {

            session_start();
        }
      
        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');

        if($login->isLoged()){

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/reporte.php';
            require_once 'application/views/templates/footer.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function editar() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
   
        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/editar.php';
            require_once 'application/views/templates/footer.php';

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

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/detalles.php';
            require_once 'application/views/templates/footer.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function detalles2() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/detalles2.php';
            require_once 'application/views/templates/footer.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function envio() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            $id    = $_GET['id'];
            $datos = $optionsmodel->getDatospersonal($id);

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/modificar.php';
            require_once 'application/views/templates/footer.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL .'login/');
        }
    }


    public function envio2() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            $id    = $_GET['id'];

            $datos = $optionsmodel->getDatosorden($id);

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/modificarorden.php';
            require_once 'application/views/templates/footer.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function envio3() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            $id    = $_GET['id'];
            $datos = $optionsmodel->getDatosgasto($id);
            
            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/modificargastos.php';
            require_once 'application/views/templates/footer.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function envio4() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
       
        if($login->isLoged()) {

            $id    = $_GET['id'];
            $datos = $optionsmodel->getDatosvelada($id);

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/velada/modificarvelada.php';
            require_once 'application/views/templates/footer.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }


    public function Updateper() {

        $optionsmodel = $this->loadModel('OptionsModel');
        $update       = $optionsmodel->getUpdateper($_POST);

        if ($update) {

            echo " Se ha modificado el registro exitosamente" ;
        }else {

            echo "error";
        }
    }


    public function Updateor() {

        $optionsmodel = $this->loadModel('OptionsModel');
        $update       = $optionsmodel->getUpdateor($_POST);

        if ($update) {

            echo " Se ha modificado el registro exitosamente" ;
        } else {
        
            echo "error";
        }
    }
  

    public function Updatevel() {

        $optionsmodel = $this->loadModel('OptionsModel');
        $update       = $optionsmodel->getUpdatevel($_POST);

        if ($update) {

            echo " Se ha modificado el registro exitosamente" ;
        } else {

            echo "error";
        }
    }
}

