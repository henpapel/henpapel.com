<?php 



class gastosespeciales extends Controller
{
    public function index() {

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');

        $gastosespecialesmodel=$this->loadModel('GastosespecialesModel');
        $login_model = $this->loadModel('LoginModel');

        $rows = $gastosespecialesmodel->getgastos();
       
        if($login->isLoged()){
            
            require_once 'application/views/templates/head.php';
            require_once 'application/views/templates/top_menu.php';
            require_once 'application/views/gastosespeciales/index.php';
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

        $gastosespecialesmodel=$this->loadModel('GastosespecialesModel');
        $register = $gastosespecialesmodel->getRegistrar($_POST);
       
        if ($register) {
    
    ?>       
<script>   
        alert('Se han registrado');
        window.location= '<?php echo URL?>gastosespeciales/reg'
   
</script>
<?php 

 
      }else 
           echo "El registro fallo";
      {
   }                                                                                           
}



public function borrar(){
    $id=$_POST['id_tipotec'];
    $gastosespecialesmodel=$this->loadModel('GastosespecialesModel');
    $delete = $gastosespecialesmodel->getBorrar($id);
      if ($delete) {
       ?>       
<script>   
        alert('Se han eliminado los registros');
        window.location='<?php echo URL?>gastosespeciales/index'  
</script>
<?php 
      }else 
      echo "No se pudo eliminar el registro :(";
      {
   }          
}


public function modificar(){
    $gastosespecialesmodel=$this->loadModel('GastosespecialesModel');
    $modif=$gastosespecialesmodel->getmodif($_POST);
    if ($modif) {
      echo "El registro a sido actualizado ";
      echo '<a href="<?php echo URL?>gastosespeciales/index">Volver </a>';
      }else 
      {
      echo "No se pudo modificar el registro :(";
   } 
}


  public function mod(){

        if (!isset($_SESSION)) {

            session_start();
        }
      
      $login=$this->loadController('login');
      $gastosespecialesmodel=$this->loadModel('GastosespecialesModel');
      $login_model=$this->loadModel('LoginModel');

            
      if($login->isLoged()){

      $id=$_GET['id'];
      $datos = $gastosespecialesmodel->getadjust($id);
      require_once 'application/views/templates/head.php';
      require_once 'application/views/templates/top_menu.php';
      require_once 'application/views/gastosespeciales/modificar.php';
      require_once 'application/views/templates/footer.php';
    }else{
        
        echo '<script language="javascript">';
        echo 'window.location.href="' . URL . 'login/"';
        echo '</script>';
        //header("Location:".URL.'login/');
    }
  }


  public function getgastos(){

        if (!isset($_SESSION)) {

            session_start();
        }
        
        $login= $this->loadController('login');        
        $login_model = $this->loadModel('LoginModel');
        $gastosespeciales_model = $this->loadModel('gastosespecialesmodel');
        
    if($login->isLoged()){
      
    

    $process=$_POST['process'];

    $html='';
    $i=1;
    $options=$gastosespeciales_model->getOptionsByProcess($process);
    
    

    foreach ($options as $option) {
      
      
      if ($option['nombre']=='parent') {
        $childs=$gastosespeciales_model->getOptionChilds($option['id_tipotec']);

                  }
          }
        }
    }


      public function reg(){

        if (!isset($_SESSION)) {

            session_start();
        }
      
        $login= $this->loadController('login');
        $gastosespecialesmodel =$this->loadModel('GastosespecialesModel');
        $login_model = $this->loadModel('LoginModel');
          
       if($login->isLoged()){

       
       require_once 'application/views/templates/head.php';
       require_once 'application/views/templates/top_menu.php';
       require_once 'application/views/gastosespeciales/documento.php';
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
