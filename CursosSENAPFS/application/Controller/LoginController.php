<?php

namespace Mini\Controller;

use Mini\Model\Login;
use Mini\Model\Personas;
use Mini\Model\Preguntas;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


class LoginController {

    public function index(){

        $qs = new Preguntas();
        $questions = $qs->showQuestions();

        $lg = new Login();
        $lgn = $lg->getAllProfessions();
        $tdocumento = new Personas();
        $resultados = $tdocumento->listartipoDocu();
        require APP. 'view/Login/login.php';
    }

    public function passwordChangeAspirante()
    {
        require APP. 'view/_templates/headeraprendiz.php';
        require APP. 'view/Login/ChangePasswordAp.php';
        require APP. 'view/_templates/footer.php';
    }

    public function passwordChangeAdmin()
    {
        require APP. 'view/_templates/header.php';
        require APP. 'view/Login/ChangePassword.php';
        require APP. 'view/_templates/footer.php';
    }

    public function validarSesion()
    {
        $login = new login();
        $login->__SET("correoPersona", $_POST['txtcorreoPersona']);
        $validacion=$login->traerEstadoYRol();
        if($validacion->estado=='Inactivo' && $validacion->rol==1)
            {
                
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Esta cuenta se encuentra INACTIVA.', 'error')</script>";
                header ("location: " .URL."Login");

            }
             else{

            $respuesta = $login->validarLogin();       

            if($respuesta !=false)
            {
                
                if(password_verify($_POST['txtpassword'], $respuesta->password))
                {
                    if ($respuesta->rol == 1) {
                    
                        $_SESSION["nombrePersona"] = $respuesta->nombrePersona;
                        $_SESSION["apellidoPersona"] = $respuesta->apellidoPersona;
                        $_SESSION["correoPersona"] = $respuesta->correoPersona;
                        $_SESSION["profesionPersona"] = $respuesta->profesionPersona;
                        $_SESSION["rol"] = $respuesta->rol;
                        $_SESSION['cod_personas']=$respuesta->cod_personas;
                        $_SESSION['nameRol']=$respuesta->nombreRol;
                        $_SESSION['password']=$respuesta->password;
                    
                        header ("location: " .URL."home/index");
                    }else if ($respuesta->rol == 2) {
                        session_start();
                        
                        $_SESSION["nombrePersona"] = $respuesta->nombrePersona;
                        $_SESSION["apellidoPersona"] = $respuesta->apellidoPersona;
                        $_SESSION["correoPersona"] = $respuesta->correoPersona;
                        $_SESSION["profesionPersona"] = $respuesta->profesionPersona;
                        $_SESSION["rol"] = $respuesta->rol;
                        $_SESSION['cod_personas']=$respuesta->cod_personas;
                        $_SESSION['nameRol']=$respuesta->nombreRol;
                        $_SESSION['estado_persona']=$respuesta->estado_persona;
                        $_SESSION['password']=$respuesta->password;
                    
                        header ("location: " .URL."home/index");
                    }
                }
                else 
                {
                    $_SESSION["mensaje"] = "<script>swal('Error!', 'La contraseña es incorrecta!', 'error')</script>";
                    header("location: ".URL."Login"); 
                }
            }
            else
            {
                $_SESSION["mensaje"] = "<script>swal('Error!', 'El correo electrónico/usuario es incorrecta!', 'error')</script>";
                
                header("location: ".URL."Login");
            }
        }
    }

    public function registrarUsuario()
    {
       
        $login = new login();
        $login->__SET("nombrePersona", $_POST['txtnombrePersona']);
        $login->__SET("apellidoPersona", $_POST['txtapellidoPersona']);
        $login->__SET("correoPersona", $_POST['txtcorreoPersona']);
        $caliPassword = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);
        $login->__SET("password", $caliPassword);
        $login->__SET("rol", $_POST['txtrol']);
        $login->__SET("documentoPersona", $_POST['txtdocumentoPersona']);
        $login->__SET("tipoDocumento", $_POST['txttipoDocumento']);
        $login->__SET("LugarProfesion", $_POST['txtLugarProfesion']);
        $login->__SET("profesionPersona", $_POST['allProfessions']);

        $validarDocumentoxTipo=$login->documentoXtipodocumento();

        if($validarDocumentoxTipo->resuldo==0){

        $validarCorreo= $login->validacionCorreo();                     
        if($validarCorreo->cantidad==0){
            $respuesta = $login->registrarUsuarios();
        
            if($respuesta !=false)
            {
                $_SESSION["mensaje"] = "<script>swal('Registro Exitoso!', '', 'success')</script>";

            }else{
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
                
            }     
         }else if($validarCorreo->cantidad==1){
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Este correo ya existe!', 'error')</script>";

         }
        }else{
            $_SESSION["mensaje"] = "<script>swal('Error!', 'El TIPO DE DOCUMENTO con el NÚMERO DE IDENTIFICACIÓN ya existe   ', 'error')</script>";

        }
            
            header ("location: " .URL."Login");
  
    }

    public function changepassword()
    {
        $login = new Login();        
        $login->__SET("cod_personas", $_SESSION['cod_personas']);
        $selectcPassword= $login->searchPasssword();
        
        if(password_verify($_POST['txtpassword2'], $selectcPassword->password))
        {
           
            $updatePassword = password_hash($_POST['txtNewpasswor'], PASSWORD_DEFAULT);
            $login->__SET("password", $updatePassword);
            $login->__SET("cod_personas", $_SESSION['cod_personas']);

            $respo= $login->changePassword();
            
            if($respo !=false)
            {
                $_SESSION["mensaje"] = "<script>swal('Modificación exitosa!','La contraseña ha sido actualizada.', 'success')</script>";
            }else{
                $_SESSION["mensaje"] = "<script>swal('Error','Por favor, verifique los datos ingresados.', 'error')</script>";
            }
        }else{        
            $_SESSION["mensaje"] = "<script>swal('Error','Por favor, ingrese la contraseña actual correctamente.', 'error')</script>";
        }
        header("location: " .URL. "Login/passwordChangeAdmin");
    }


    public function changepasswordAP()
    {
        $login = new Login();        
        $login->__SET("cod_personas", $_SESSION['cod_personas']);
        $selectcPassword= $login->searchPasssword();
        
        if(password_verify($_POST['txtpassword2'], $selectcPassword->password))
        {
           
            $updatePassword = password_hash($_POST['txtNewpasswor'], PASSWORD_DEFAULT);
            $login->__SET("password", $updatePassword);
            $login->__SET("cod_personas", $_SESSION['cod_personas']);

            $respo= $login->changePassword();
            
            if($respo !=false)
            {
                $_SESSION["mensaje"] = "<script>swal('Modificación exitosa!','La contraseña ha sido actualizada.', 'success')</script>";
            }else{
                $_SESSION["mensaje"] = "<script>swal('Error','Por favor, verifique los datos ingresados.', 'error')</script>";
            }
        }else{        
            $_SESSION["mensaje"] = "<script>swal('Error','Por favor, ingrese la contraseña actual correctamente.', 'error')</script>";
        }
        header("location: " .URL. "Login/passwordChangeAspirante");
    }

    public function recoverPassword()
    {
        $lgn = new Login();
        $ca = new Login();

        $lgn->__SET("correoPersona", $_POST['email']);
        $answer = $lgn->recoverPassword();

        $name = $answer->nombrePersona;
        $last_name = $answer->apellidoPersona;

        $cod = $answer->cod_personas;
        $ca->__SET('cod_personas', $cod);

        $newPass = rand(1, 100000000);
        $updateP = password_hash($newPass, PASSWORD_DEFAULT);
        $ca->__SET('password', $updateP);
        

        $respuesta = $ca->changePassword();
        // var_dump($respuesta);
        // exit;

        $mail = new PHPMailer(true);                          
        try {

         $mail->SMTPDebug = 2;                                
         $mail->isSMTP();                                    
         $mail->Host = 'smtp.gmail.com';                   
         $mail->SMTPAuth = true;                               
         $mail->Username = 'cursossena60@gmail.com';                
         $mail->Password = 'sena123456';                           
         $mail->SMTPSecure = 'ssl';                            
         $mail->Port = 465;                                   

         $mail->setFrom('cursossena60@gmail.com', 'Cursos SENA');
         $mail->addAddress($_POST['email'], 'Enviado por SENA');
         $mail->isHTML(true);                   
         $mail->Subject = 'Reestablecimiento de contrasena';
         $mail->Body = 'Sr(a) '.$name.' '.$last_name.'
         <br>Recibimos una solicitud para restablecer su contraseña en Cursos sena.<br> La nueva contraseña es: <strong>'.$newPass.'</strong><br>
         <strong>Para tener una mayor seguridad en el sistema se le recomienda cambiar la contraseña inmediatamente tenga acceso.</strong><br>

         **********************NO RESPONDER - Mensaje generado automáticamente**********************';
         
         $mail->send();
            $_SESSION['mensaje'] = "<script>swal('Bien hecho','Su nueva contraseña fue enviada al correo.', 'success')</script>";
        } catch (Exception $e) {
            echo 'El mensaje no se pudo enviar. Error del mailer: ', $mail->ErrorInfo;
        }
    }


    public function cerrarSesion()
    {
        session_destroy();
        header("location: ".URL."Login");
    }



}

