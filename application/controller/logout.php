<?php


class Logout extends Controller
{
    
    public function index()
    { 

        if (!isset($_SESSION)) {

            session_start();
        }

        session_destroy();

        echo '<script language="javascript">';
        echo 'window.location.href="' . URL . '"';
        echo '</script>';
        //header("Location:" . URL);
    }
}
