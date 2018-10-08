<?php

namespace Mini\Controller;
use Mini\Model\Personas;
use Mini\Model\CursosPersona;
use Mini\Model\Home;



class PersonasController
{
    public function index()
    {
        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();
        
        $personas = new Personas();
        $resultados=$personas->listartipoDocu();
      

        require APP. 'view/_templates/header.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/Personas-View.php';
        require APP. 'view/_templates/footer.php';
    }

    public function registrarPersonas()
    {
        $personas = new Personas();
        
        $personas->__SET("documentoPersona", $_POST['txtdocumentoPersona']);
        $personas->__SET("tipoDocumento", $_POST['txttipoDocumento']);
        $personas->__SET("nombrePersona", $_POST['txtnombrePersona']);
        $personas->__SET("apellidoPersona", $_POST['txtapellidoPersona']);
        $personas->__SET("telefonoPersona", $_POST['txttelefonoPersona']);
        $personas->__SET("direccionPersona", $_POST['txtdireccionPersona']);
        $personas->__SET("correoPersona", $_POST['txtcorreoPersona']);
        $personas->__SET("rol", $_POST['txtrol']);
        $caliPassword = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);
        $personas->__SET("password", $caliPassword);

        $validarCorreos=$personas->validacionCorreo();
        $validardocXtipoDoc = $personas->documentoXtipodocumento();
        if($validardocXtipoDoc->resuldo==0){
        
        if($validarCorreos->cantidad==0){     
            
            $respuesta=$personas->registrarPersonas();

            if($respuesta){

                $_SESSION["mensaje"] = "<script>swal('Registro Exitoso!', '', 'success')</script>";
                header ("location: " .URL."Configuraciones/index");

            }else{
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
                
            }
        }else if (($validarCorreos->cantidad==1)){
            $_SESSION["mensaje"] = "<script>swal('Error!', 'El correo ya existe!', 'error')</script>";

        }
    
    }else {
        $_SESSION["mensaje"] = "<script>swal('Error!', 'El TIPO DE DOCUMENTO con el NÚMERO DE IDENTIFICACIÓN ya existe   ', 'error')</script>";
           
    }
    header ("location: " .URL."Personas");
}

    public function cargarlistar()
    {
        $personas = new Personas();
        $resultados=$personas->listartipoDocu();
        $resultado=$personas->listarPersonas();
        $prof = $personas->getAllProfessions();

        require APP. 'view/_templates/header.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/Personas-listar.php';
        require APP. 'view/_templates/footer.php';
    }

    public function cambiarEstadoPersonas($id, $estado)
    {
        $personas = new Personas();
        $personas->__SET("cod_personas", $id);
        $personas->__SET("estado_persona", $estado);

        $resultado=$personas->cambiarEstadoPersona();

        if ($resultado) {
            if ($estado=="Activo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> El estado se ha cambiado correctamente"); });</script>';;
            }
            else if ($estado=="Inactivo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> El estado se ha cambiado correctamente"); });</script>';
            }
        }
        else{
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Erro!</strong>"); }); </script>';
        }


        header ("location: " .URL."Personas/cargarlistar");
    }

    public function cambiarEstadoAdmin($id, $estado)
    {  
        $personas = new Personas();
        $personas->__SET("cod_personas", $id);
        $personas->__SET("estado_persona", $estado);
        
        $resultadoss=$personas->cambiarEstadoPersonaS();

        
        if ($resultadoss) {
            if ($estado=="Activo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> El estado se ha cambiado correctamente."); });</script>';;
            }
            else if ($estado=="Inactivo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> El estado se ha cambiado correctamente."); });</script>';
            }
        }
        else{
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Erro!</strong>"); }); </script>';
        }


        header ("location: " .URL."Configuraciones");
    }

    public function cargarEditar($id)
    {
        $personas = new Personas();
        $personas->__SET("cod_personas", $id);
        $resultados=$personas->editarPersonas();
        echo json_encode($resultados);
    }

    public function modificarPersonas()
    {
        $personas = new Personas();
        $personas->__SET("nombrePersona", $_POST['txtnombrePersona']);
        $personas->__SET("apellidoPersona", $_POST['txtapellidoPersona']);
        $personas->__SET("telefonoPersona", $_POST['txttelefonoPersona']);
        $personas->__SET("direccionPersona", $_POST['txtdireccionPersona']);
        $personas->__SET("correoPersona", $_POST['txtcorreoPersona']);
        $personas->__SET("LugarProfesion", $_POST['txtLugarProfesion']);
        $personas->__SET("profesionPersona", $_POST['allProfessions']);
        $personas->__SET("cod_personas", $_POST['txtcod_personas']);

        $respuesta=$personas->modificarPersona();

        if($respuesta){

            $_SESSION["mensaje"] = "<script>swal('¡Actualización Exitosa!', '', 'success')</script>";

        }else{
            $_SESSION["mensaje"] = "<script><script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
        }
         header ("location: " .URL."Personas/cargarlistar");
    }

    public function modificarAdmin()
    {
        $personas = new Personas();
        $personas->__SET("nombrePersona", $_POST['txtnombrePersona']);
        $personas->__SET("apellidoPersona", $_POST['txtapellidoPersona']);
        $personas->__SET("telefonoPersona", $_POST['txttelefonoPersona']);
        $personas->__SET("direccionPersona", $_POST['txtdireccionPersona']);
        $personas->__SET("correoPersona", $_POST['txtcorreoPersona']);
        $personas->__SET("cod_personas", $_POST['txtcod_personas']);

        $respuesta=$personas->modificarPersona();

        if($respuesta){

            $_SESSION["mensaje"] = "<script>swal('¡Actualización Exitosa!', 'La persona se a modificado correctamente.', 'success')</script>";

        }else{
            $_SESSION["mensaje"] = "<script><script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
        }
         header ("location: " .URL."Configuraciones");
    }

    public function cargarCursos()
    {
        $mypersonas = new Personas();
        $mypersonas->__SET("cod_personas", $_POST["id"]);
        $answer = $mypersonas->cursosPersona();
        echo json_encode($answer);
    }

    public function sancionarPersona(){

        $personas = new Personas();

        $personas->__SET("cod_personas", $_POST['codPersona']);
        $personas->__SET("meses", $_POST['txtmeses']);

        $respuesta=$personas->supender();
        if($respuesta){

            $_SESSION["mensaje"] = "<script>swal('Persona Suspendida!', '', 'success')</script>";
        }else{
            $_SESSION["mensaje"] = "<script><script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
        }
        header ("location: " .URL."Personas/cargarListar");


    }
    public function listarSanciones(){

        $personas = new Personas();

        $traer= $personas->listarSuspendidos();
 
        require APP. 'view/_templates/header.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/Suspendidos-Listar.php';
        require APP. 'view/_templates/footer.php';

    }


    public function eliminarCurso(){

        $hoy = date("Y-m-d");//Traer la fecha del hoy 
        $curso = new CursosPersona();   
        $curso->__SET("cod_personas",$_POST["Personas"]);  //Parámetros para la consulta
        $curso->__SET("idCursos",$_POST["id"]);   //Parámetros para la consulta
        $fechaIn = $curso->fechaInicio();   //Fecha para las validaciones
        $fechaFi = $curso->fechaFin();         //Fecha para las validaciones
        
        if( $fechaIn->fechaInicio<=$hoy && $fechaFi->fechaFin>$hoy ){
            $array = array('status' => "statusInCourse" );
            echo json_encode($array);  
        }else if($fechaIn->fechaInicio<$hoy && $fechaFi->fechaFin<$hoy){
            $array = array('status' => "statusFinish" );
            echo json_encode($array);       
        }else if($fechaIn->fechaInicio>=$hoy){   
            $enviar=$curso->eliminarCurso();
            echo json_encode($enviar);
        }
    }


}
