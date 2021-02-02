<?php 



class eeerrores extends Controller
{
    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');
        $optionsmodel =$this->loadModel('OptionsModel');
        $login_model = $this->loadModel('LoginModel');

        $rows = $optionsmodel->geterror();
       
        if($login->isLoged()){
            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/eeerrores/index.php';
            require_once 'application/views/templates/footer.php';
          
            }else{

                    echo '<script language="javascript">';
                    echo 'window.location.href="' . URL . 'login/"';
                    echo '</script>';
                //header("Location:".URL.'login/');
            }
      }



  public function registrar() {

        if (!isset($_SESSION)) {

            session_start();
        }

        $optionsmodel=$this->loadModel('OptionsModel');
        $register = $optionsmodel->getReerrores($_POST);
       
        if ($register) {   
    ?>       
<script>   
        alert('Se han registrado');
        window.location= '<?php echo URL?>eeerrores/reg'   
</script>
<?php 
      }else 
           echo "El registro fallo";
      {
   }                                                                                           
}



public function borrar(){
    $id=$_POST['id_errores'];
    $optionsmodel=$this->loadModel('OptionsModel');
    $delete = $optionsmodel->getBorrar($id);
      if ($delete) {
       ?>       
<script>   
        alert('Se han eliminado los registros');
        window.location='<?php echo URL?>eeerrores/index'  
</script>
<?php 
      }else 
      echo "No se pudo eliminar el registro :(";
      {
   }          
  }


public function modificar(){
    $optionsmodel=$this->loadModel('OptionsModel');
    $modif=$optionsmodel->getmodif($_POST);
    if ($modif) {
      echo "El registro a sido actualizado ";
      echo '<a href="<?php echo URL?>eeerrores/index">Volver </a>';
      }else 
      {
      echo "No se pudo modificar el registro :(";
   } 
}


  public function mod() {

        if (!isset($_SESSION)) {

            session_start();
        }
      
      $login=$this->loadController('login');
      $optionsmodel=$this->loadModel('OptionsModel');
      $login_model=$this->loadModel('LoginModel');

            
      if($login->isLoged()){

      $id=$_GET['id'];
      $datos = $optionsmodel->getadjust($id);
      require_once 'application/views/templates/head.php';
      require_once 'application/views/templates/top_menu.php';
      require_once 'application/views/eeerrores/modificar.php';
      require_once 'application/views/templates/footer.php';
    }else{
        
        echo '<script language="javascript">';
        echo 'window.location.href="' . URL . 'login/"';
        echo '</script>';
        //header("Location:".URL.'login/');
    }
  }


  public function geterror() {

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');        
        $login_model = $this->loadModel('LoginModel');
        $options_model = $this->loadModel('OptionsModel');
        
    if($login->isLoged()){
      
    

    $process=$_POST['process'];

    $html='';
    $i=1;
    $options=$options_model->getOptionsByProcess($process);
    
    

    foreach ($options as $option) {
      
      
      if ($option['nombre']=='parent') {
        $childs=$options_model->getOptionChilds($option['id_errores']);

                  }
          }
        }
    }


      public function reg(){

        if (!isset($_SESSION)) {

            session_start();
        }
      
        $login        = $this->loadController('login');
        $optionsmodel = $this->loadModel('OptionsModel');
        $login_model  = $this->loadModel('LoginModel');
        
          
       if($login->isLoged()){
 
       require_once 'application/views/templates/head.php';
       require_once 'application/views/templates/top_menu.php';
       require_once 'application/views/eeerrores/documento.php';
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
