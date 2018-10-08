<?php 

namespace Mini\Controller;
use Mini\Model\rol;
use Mini\Model\tipoDocumento;
use Mini\Model\Personas;
use Mini\Model\Home;



class ConfiguracionesController{

    public function index(){

        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();

        $personas = new Personas();
        $resultados1=$personas->listarAdmin();

        $perso = new rol();
        $listar = $perso->listar();
        
        $td = new tipoDocumento();
        $listarTD = $td->listar();

        include APP. 'view/_templates/header.php';
        include APP. 'view/vistas_CursosSENA/Vistas_Admin/Configuraciones-All.php';
        include APP. 'view/_templates/footer.php';  

    }

    public function editar(){
        $perso = new rol();
        $perso->__SET("id",$_POST["id"]);
        $personas = $perso->editar();
        echo json_encode($personas);

    }



    public function modificarPersona(){

        $perso= new rol();

        $perso->__SET("rol",$_POST['txtrol']);        
        $perso->__SET("id",$_POST['idrol']);

        $respuesta= $perso->modificar();

            if ($respuesta) {

                $_SESSION["mensaje"] = "<script>swal('Modificación Exitosa!', 'el rol se a modoficado correctamente.', 'success')</script>";
            }
            else {
                 $_SESSION["mensaje"] = "<script>swal('Registro Exitoso!', '', 'success')</script>";
            }

        header("location: ".URL."Configuraciones");

    }

    public function consultar(){
    
        $tipodocument = new tipoDocumento();
        $tipodocument->__SET("id",$_POST["idtipod"]);
        $respuesta=$tipodocument->consultar();
        echo json_encode($respuesta);

    }

    public function modificar(){

        $tipodocument = new tipoDocumento();
        $tipodocument->__SET("id",$_POST['idtipod']);
        $tipodocument->__SET("td",$_POST['descripciontd']);
        
        $respuesta=$tipodocument->modificar();

            if($respuesta){
                
                $_SESSION["mensaje"] = "<script>swal('Modificación Exitosa!', 'El tipo documento se a modificado correctamente.', 'success')</script>";

            }else{
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
            }

        header("location: ".URL."Configuraciones");
        
    }

    public function cursosXadmin()
    {
        $people = new Personas();
        $people->__SET("cod_personas",$_POST['id']);
        $answer = $people->cursosPersona();
        echo json_encode($answer);
    }

}
   
?>