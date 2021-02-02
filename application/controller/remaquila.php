<?php



class remaquila extends Controller
{
    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');

        $remaquilamodel=$this->loadModel('RemaquilaModel');
        $login_model = $this->loadModel('LoginModel');

        $rows = $remaquilamodel->getmaquila();
       
        if($login->isLoged()){
    
            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/remaquila/maquila.php';
            require_once 'application/views/templates/footer.php';
        }else{

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
            //header("Location:".URL.'login/');
        }
    }

    
    public function registrar(){
    
        if (!isset($_SESSION)) {

            session_start();
        }

        $remaquilamodel=$this->loadModel('RemaquilaModel');
        $register = $remaquilamodel->getRegistrar($_POST);

        if ($register) {

            ?>       
            <script>   
                alert('Se han registrado');
                window.location= '<?php echo URL?>remaquila/reg'
            </script>
            <?php 
        }else { 
            echo "El registro fallo";
        }
    }


 public function ConectId(){
       
  error_reporting(0);
     $remaquilamodel =$this->loadModel('RemaquilaModel');
     $insertar= $remaquilamodel->getCoMa($_POST);
     $response=array();
      if ($insertar) {
  $response['message']='<div class="notification success"><div></div><p><span>Exito: </span>Datos guardados correctamente!</p></div>';
      $response['success']='true';
   
      }else{
        $response['message']='<div class="notification fail"><div></div><p><span>Error: </span>Ocurrio un problema y no se guardo la informacion</p></div>';
      $response['success']='false';
   }  
   echo json_encode($response);                                                                                  
  }




   public function Insert(){
       
  error_reporting(0);
     $remaquilamodel =$this->loadModel('RemaquilaModel');
     $insertar= $remaquilamodel->getIn($_POST);
     $response=array();
      if ($insertar) {
  $response['message']='<div class="notification success"><div></div><p><span>Exito: </span>Datos guardados correctamente!</p></div>';
      $response['success']='true';
   
      }else{
        $response['message']='<div class="notification fail"><div></div><p><span>Error: </span>Ocurrio un problema y no se guardo la informacion</p></div>';
      $response['success']='false';
   }  
   echo json_encode($response);                                                                                  
  }



  
public function borrar(){
    $id=$_POST['id_maquila'];
    $remaquilamodel=$this->loadModel('RemaquilaModel');
    $delete = $remaquilamodel->getBorrar($id);
    if ($delete) {
       ?>       
<script>
        alert('Se han eliminado los registros');
        window.location='<?php echo URL?>remaquila/maquila'
</script>
<?php
      }else
      echo "No se pudo eliminar el registro :(";
      {
   }
}


public function modificar(){
    $remaquilamodel=$this->loadModel('RemaquilaModel');
    $modif=$remaquilamodel->getmodif($_POST);
    if ($modif) {
      echo "El registro a sido actualizado ";
      echo '<a href="<?php echo URL?>remaquila/maquila">Volver</a>';
      }else 
      {
      echo "No se pudo modificar el registro :(";
   } 
}



    public function reg() {

        if (!isset($_SESSION)) {

            session_start();
        }
      
        $login= $this->loadController('login');
        $remaquilamodel =$this->loadModel('RemaquilaModel');
        $login_model = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
          
       if($login->isLoged()){
      $rows=$options_model->getAllProcesos();
      $rows2=$options_model->getPersonal();
       require_once 'application/views/templates/head.php';
       require_once 'application/views/templates/top_menu.php';
       require_once 'application/views/remaquila/documento.php';
       require_once 'application/views/templates/footer.php';
  
    }else{
        
        echo '<script language="javascript">';
        echo 'window.location.href="' . URL . 'login/"';
        echo '</script>';
        //header("Location:".URL.'login/');
    }
  }


  public function mod() {

        if (!isset($_SESSION)) {

            session_start();
        }
      
      $login=$this->loadController('login');
      $remaquilamodel=$this->loadModel('RemaquilaModel');
      $login_model=$this->loadModel('LoginModel');

            
      if($login->isLoged()){

      $id=$_GET['id'];
      $datos = $remaquilamodel->getadjust($id);
      require_once 'application/views/templates/head.php';
      require_once 'application/views/templates/top_menu.php';
      require_once 'application/views/remaquila/modificar.php';
      require_once 'application/views/templates/footer.php';
    }else{
        
        echo '<script language="javascript">';
        echo 'window.location.href="' . URL . 'login/"';
        echo '</script>';
        //header("Location:".URL.'login/');
    }
  }



    public function documento(){

        if (!isset($_SESSION)) {

            session_start();
        }
      
      $login=$this->loadController('login');
      $remaquilamodel=$this->loadModel('RemaquilaModel');
      $login_model=$this->loadModel('LoginModel');
       
 
       
if($login->isLoged()){
  
    require_once 'application/views/templates/head.php';
    require_once 'application/views/templates/top_menu.php';
    require_once 'application/views/remaquila/conexion.php';
    require_once 'application/views/templates/footer.php';
  
    }else{

            echo '<script language="javascript">';
            echo 'window.location.href="' . URL . 'login/"';
            echo '</script>';
        //header("Location:".URL.'login/');
    }
    }


    public function reporte(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        $remaquilamodel=$this->loadModel('RemaquilaModel');
        $login_model = $this->loadModel('LoginModel');
       
if($login->isLoged()){
    
    require_once 'application/views/templates/head.php';
    require_once 'application/views/templates/top_menu.php';
    require_once 'application/views/remaquila/reporte.php';
    require_once 'application/views/templates/footer.php';
    
    }else{

        echo '<script language="javascript">';
        echo 'window.location.href="' . URL . 'login/"';
        echo '</script>';
        //header("Location:".URL.'login/');
    }
    }
}

?>
