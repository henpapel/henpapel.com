<?php


class Cajasedit extends Controller {
    
    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login        = $this->loadController('login');
        $login_model  = $this->loadModel('LoginModel');

        $optionsmodel = $this->loadModel('OptionsModel');
        $models       = $optionsmodel->getBoxModels();
        
        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cajasedit/editalmeja.php';
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

        $row = $optionsmodel->getNombModelsById_calculo($_GET['id_calculo']);

        $nomb_modelo = $row['nombre'];
        $nomb_modelo = strval($nomb_modelo);
        $nomb_modelo = trim($nomb_modelo);
        $nomb_modelo = strtolower($nomb_modelo);
        $nomb_modelo = "edit" . $nomb_modelo;

        $editar_modelo = 'application/views/cajasedit/' . $nomb_modelo . '.php';


        if($login->isLoged()) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/cajasedit/' . $nomb_modelo . '.php';
            require_once 'application/views/templates/footer.php';

        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:" . URL . 'login/');
        }
    }
}
