<?php


class produccion extends Controller {

    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $login= $this->loadController('login');

        $login_model = $this->loadModel('LoginModel');

        if($login->isLoged()){

            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/ventas/index.php';
            require_once 'application/views/templates/footer.php';

        }else{

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:".URL.'login/');
        }
    }
}