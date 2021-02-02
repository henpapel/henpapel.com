<?php


class Login extends Controller {

    public function index() {

        session_start();

        $logged = $this->isLoged();

        if(!$logged) {

            require_once 'application/views/templates/head.php';
            require_once 'application/views/login/index.php';
            require_once 'application/views/templates/footer.php';
        } else {

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . $_SESSION['area'] . '/"';
            echo '</script>';
            //header("Location:" . URL . $_SESSION['area'].'/');
        }
    }


    public function isLoged() {

        if (isset($_SESSION['logged_in'])) {

            return true;
        } else {

            return false;
        }

    }


    public function signIn() {

        $login_model = $this->loadModel('LoginModel');

        $logged = $login_model->login($_POST);

        session_start();

        if (!$logged) {

            $_SESSION['session_messages'] = '<p class="small-error-message">Usuario o contraseña incorrectos';

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . '"';
            echo '</script>';
            //header("Location:" . URL);
        } else {

            $_SESSION['user']           = $logged;
            $_SESSION['logged_in']      = 'true';

            $_SESSION['id_usuario']     = $logged['id_usuario'];
            $_SESSION['nombre_usuario'] = $logged['nombre_usuario'];
            $_SESSION['area']           = $logged['area'];
            $_SESSION['id_tienda']      = $logged['id_tienda'];
            $_SESSION['nom_tienda']     = $login_model->getStoreName($logged['id_tienda']);

            $_SESSION['cambios_pendientes'] = $login_model->getPendingCambios();

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . $logged['area'] . '/"';
            echo '</script>';
            //header("Location:" . URL . $logged['area'] . '/');
        }
    }


    public function sessionMessage($type, $text) {

        $message = '<p>';
    }
}
