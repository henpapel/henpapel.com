<?php 
/**
 * 
 */
class Prueba extends Controller
{
	
 public function index(){
        session_start();
        
        $login= $this->loadController('login');
        $optionsmodel =$this->loadModel('OptionsModel');
        $login_model = $this->loadModel('LoginModel');

       
if($login->isLoged()){
    require_once 'application/views/templates/head.php';
    require_once 'application/views/prueba/index.php';
    require_once 'application/views/templates/footer.php';
  
    }else{

        header("Location:".URL.'login/');

    }
 }


}



 ?>
