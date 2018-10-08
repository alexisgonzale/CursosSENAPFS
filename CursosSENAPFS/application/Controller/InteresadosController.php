<?php

namespace Mini\Controller;
use Mini\Model\Personas;
use Mini\Model\Login;
use Mini\Model\Home;


class InteresadosController
{

    public function index()
    {
        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();   

        $personas = new Personas();
        $resultados=$personas->listartipoDocu();
        $personas->__SET("cod_personas",$_SESSION["cod_personas"]);
        $res = $personas->searchWithEmail();

        require APP. 'view/_templates/headeraprendiz.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/Interesados-View.php';
        require APP. 'view/_templates/footer.php';
    }



    public function mod_completar()
    {
        $personas = new Personas();
        $personas->__SET("documentoPersona", $_POST['txtdocumentoPersona']);
        $personas->__SET("tipoDocumento", $_POST['txttipoDocumento']);
        $personas->__SET("nombrePersona", $_POST['txtnombrePersona']);
        $personas->__SET("apellidoPersona", $_POST['txtapellidoPersona']);
        $personas->__SET("telefonoPersona", $_POST['txttelefonoPersona']);
        $personas->__SET("direccionPersona", $_POST['txtdireccionPersona']);
        $personas->__SET("LugarProfesion", $_POST['txtLugarProfesion']);
        $personas->__SET("cod_personas", $_POST['txtcod_personas']);


        $respuesta=$personas->completarPersona();
    
        if($respuesta){

            $_SESSION["mensaje"] = "<script>swal('¡Actualización Exitosa!', '', 'success')</script>";

        }else{
            $_SESSION["mensaje"] = "<script><script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
        }
         header ("location: " .URL."Interesados/index");
    }
                  
 
    public function indexRegistrar(){
        $lg = new Login();
        $lgn = $lg->getAllProfessions();
        
        $personas = new Personas();
        $resultados=$personas->listartipoDocu();

        require APP. 'view/_templates/header.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/interesadoR.php';
        require APP. 'view/_templates/footer.php';
    }

    public function registrarInteresado()
    {

        $personas = new Personas();
        $personas->__SET("documentoPersona", $_POST['txtdocumentoPersona']);
        $personas->__SET("tipoDocumento", $_POST['txttipoDocumento']);
        $personas->__SET("nombrePersona", $_POST['txtnombrePersona']);
        $personas->__SET("apellidoPersona", $_POST['txtapellidoPersona']);
        $personas->__SET("telefonoPersona", $_POST['txttelefonoPersona']);
        $personas->__SET("direccionPersona", $_POST['txtdireccionPersona']);
        $personas->__SET("rol", $_POST['txtrol']);
        $personas->__SET("correoPersona", $_POST['txtcorreoPersona']);
        $personas->__SET("LugarProfesion", $_POST['txtLugarProfesion']);
        $personas->__SET("profesionPersona", $_POST['allProfessions']);
        $caliPassword = password_hash(123456789, PASSWORD_DEFAULT);
        $personas->__SET("password", $caliPassword);

            $respuesta=$personas->registrarpersonas();

            $validarDocumentoxTipo=$personas->documentoXtipodocumento();

            if($validarDocumentoxTipo->resuldo==0){

            if($respuesta){

                $_SESSION["mensaje"] = "<script>swal('Registro Exitoso!', '', 'success')</script>";

            }else{
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
            }
        }else{     
               $_SESSION["mensaje"] = "<script>swal('Error!', 'El TIPO DE DOCUMENTO con el NÚMERO DE IDENTIFICACIÓN ya existe   ', 'error')</script>";
                

        }
            header ("location: " .URL."Personas/cargarlistar");

    }







}
