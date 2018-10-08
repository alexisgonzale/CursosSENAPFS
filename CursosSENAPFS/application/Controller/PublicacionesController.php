<?php
namespace Mini\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Mini\Model\Publicaciones;
use Mini\Model\Cursos;
use Mini\Model\Personas;
use Mini\Model\Home;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

class PublicacionesController
{
    public function index()
    {
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();
        $p = new Publicaciones();
        
        $publications = $p->getAllPublicaciones();
        require APP.'view/_templates/header.php';
        require APP.'view/home/index.php';        
        require APP.'view/_templates/footer.php';
    }

    public function indexListar()
    {
        $p = new Publicaciones();
        
        $publications = $p->getAllPublicacionesListar();
        require APP.'view/_templates/header.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/Home-listar.php';
        require APP.'view/_templates/footer.php';
    }

    public function publicarAnuncio($id, $estado)
    {
        $p = new Publicaciones();
        $p->__SET("idPublicacion", $id);
        $p->__SET("Estado", $estado);

        $respuesta2 = $p->publicaranucios();

        

        if ($respuesta2) {

            if ($estado=="Activo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> Se ha publicado el evento correctamente"); });</script>';;
            }        }
        else{
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Erro!</strong>"); }); </script>';
        }
        header ("location: " .URL."Publicaciones/indexListar");
    }

    public function addPublications()
    {
        
        $carpeta = ROOT."public".DIRECTORY_SEPARATOR."imgcursos/";

        $nombre_subido = basename($_FILES['imag']['name']);
        

        if (move_uploaded_file($_FILES['imag']['tmp_name'], $carpeta . $nombre_subido)) {

        $publication = new Publicaciones();

        $publication->__SET("tituloPublicacion", $_POST["txtTitle"]);
        $publication->__SET("descripcionPublicacion",$_POST["txtPublicacion"]);
        $publication->__SET("idCurso", $_POST["allCursos"]);
        $publication->__SET("distribucionHoraria", $_POST['txtdistribucionHoraria']);
        $publication->__SET("requisitosCurso", $_POST['txtrequisitosCurso']);
        $publication->__SET("img", $nombre_subido);
       
        $respuesta=$publication->addPublication();

        $_SESSION["mensaje"] = "<script>swal('Publicación exitosa!', 'Se ha publicado correctamente la publicación.', 'success')</script>";
        
        }else if (move_uploaded_file($_FILES['imag']['tmp_name'], $carpeta . $nombre_subido)==NULL){
            
        $publication = new Publicaciones();

        $publication->__SET("tituloPublicacion", $_POST["txtTitle"]);
        $publication->__SET("descripcionPublicacion",$_POST["txtPublicacion"]);
        $publication->__SET("idCurso", $_POST["allCursos"]);
        $publication->__SET("distribucionHoraria", $_POST['txtdistribucionHoraria']);
        $publication->__SET("requisitosCurso", $_POST['txtrequisitosCurso']);
        $publication->__SET("img", $nombre_subido);
       
        $respuesta=$publication->addPublication();

        $_SESSION["mensaje"] = "<script>swal('Publicación exitosa!', 'Se ha publicado correctamente la publicación.', 'success')</script>";

        }else{
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los datos', 'Error')</script>";
        }
        header('location: ' . URL . 'home/index');
        
    }

    public function editPublication()
    {
        $pub = new Publicaciones();
        $pub->__SET("idPublicacion", $_POST["id"]);
        $respuesta = $pub->getPublication();
        echo json_encode($respuesta);
    }

    public function editPublicationn()
    {
        $myPublication = new Publicaciones();
        $myPublication->__SET("idPublicacion", $_POST["id"]);
        $answer = $myPublication->getPublicationn();
        echo json_encode($answer);
    }

    public function updatePublication()
    {
        $carpeta = ROOT."public".DIRECTORY_SEPARATOR."imgcursos/";

        $nombre_subido = basename($_FILES['imag']['name']);
        // var_dump($nombre_subido);
        // exit;

        if (move_uploaded_file($_FILES['imag']['tmp_name'], $carpeta . $nombre_subido)) {

            $myPub = new Publicaciones();
            $myPub->__SET("tituloPublicacion", $_POST["txtTitleModal"]);
            $myPub->__SET("distribucionHoraria", $_POST["txtdistribucionHorariaMD"]);
            $myPub->__SET("descripcionPublicacion", $_POST["txtPublicacionModal"]);
            $myPub->__SET("requisitosCurso", $_POST['txtrequisitosCursoMD']);
            $myPub->__SET("img", $nombre_subido);
            $myPub->__SET("idPublicacion", $_POST["txtCodPublicacion"]);

            $respuesta = $myPub->updatePublications();

            $_SESSION["mensaje"] = "<script>swal('Moficación Exitosa!', 'Se ha modificado la publicación correctamente.', 'success')</script>";

        }else if (move_uploaded_file($_FILES['imag']['tmp_name'], $carpeta . $nombre_subido)==NULL){

            $myPub = new Publicaciones();
            $myPub->__SET("tituloPublicacion", $_POST["txtTitleModal"]);
            $myPub->__SET("distribucionHoraria", $_POST["txtdistribucionHorariaMD"]);
            $myPub->__SET("descripcionPublicacion", $_POST["txtPublicacionModal"]);
            $myPub->__SET("requisitosCurso", $_POST['txtrequisitosCursoMD']);
            $myPub->__SET("img", $nombre_subido);
            $myPub->__SET("idPublicacion", $_POST["txtCodPublicacion"]);
    
            $respuesta = $myPub->updatePublications();

            $_SESSION["mensaje"] = "<script>swal('Moficación Exitosa!', 'Se ha modificado la publicación correctamente.', 'success')</script>";

            
        }else{
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Por favor, Verifique los datos ingresados. ', 'success')</script>";
        }

        header('location: ' . URL . 'home/index');
    }

    public function deletePublication($id,$estado)
    {
        $pub = new Publicaciones();

 
        $pub->__SET("idPublicacion", $id);
        $pub->__SET("Estado", $estado);
  

        $cantidadd= $pub->eliminarPublicacion();  

        if($cantidadd->cantidad == 0){
        
            $answer= $pub->deletePublication();

            if ($answer != false) {
                $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Hecho!</strong> La publicación se ha eliminado correctamente."); });</script>';;
            }        
            
        }else if($cantidadd->cantidad > 0)
        {
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Hay personas matrículadas en este curso', 'error')</script>";
        }
        header('location: ' . URL . 'home/index');
    }

    public function registrar()
    {
        $pub = new Publicaciones();
        $statC = new Cursos();
        $pub->__SET("codPersona", $_SESSION['cod_personas']);
        $pub->__SET("idCurso", $_POST['idCurso']);
        
      $oe=  $pub->consultarEstado();
       
      if($oe->estado=='Inactivo')  {

        $_SESSION["mensaje"] = "<script>swal('Error!', 'Usted no se puede inscribir en el curso por estar INACTIVO', 'error')</script>";

      }else if ($oe->estado=='Sancionado'){

        $_SESSION["mensaje"] = "<script>swal('Error!', 'Usted se encuentra SUSPENDIDO no podrá acceder a ningún curso.', 'error')</script>";

      }else if ($oe->estado=='Activo'){
        
        $validacion=$pub->validacion();

        if ($validacion->cantidad==0) {
        
            $respuesta= $pub->registrarCursoPersonas();

            if($respuesta != false)
            {
                $update=$pub->updateCupos();
                $consult=$statC->changeStatus(); 
                $this->sendMail();

                $respuestaInforme=$pub->informeMatricula(); 

                require APP. 'view/Vistas_CursosSENA/Vistas_Admin/comprobante.php';

                $_SESSION["mensaje"] = "<script>swal('¡Inscrito correctamente!', 'Por favor revise su dispositivo y su correo electrónico, se le ha enviado un comprobate de inscripción. ', 'success')</script>";
            }else{
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Verificar datos.', 'error')</script>";
            }
        }else if ($validacion->cantidad>=1){
            $_SESSION["mensaje"] = "<script>swal('¡Error!', 'Usted ya está inscrito a este curso.', 'error')</script>";
        }
    }else{
        $_SESSION["mensaje"] = "<script>swal('¡Error!', 'Usted no se puede inscribir en el curso: Estado Inactivo.', 'error')</script>";
    }
      
        header('location: ' . URL . 'home/index');
    }  

    public function buscarAdmPers()
    {
        $personas = new Personas();
        $personas->__SET("documentoPersona", $_POST['id']);
        $personas->__SET("tipoDocumento", $_POST['tipo']);

        $resp= $personas->buscarpersonas();
        echo json_encode($resp);

    }

    public function inscripciomAdmPers()
    {
                
        $public = new Publicaciones();
        $statC = new Cursos();
        $public->__SET("idCurso",$_POST['txtCod_Curso']);
        $response = $public->getAllPublicaciones2();
         
       $public->__SET("codPersona", $_POST['txtCod_Persona']);
       $public->__SET("idCurso", $_POST['txtCod_Curso']);
      
        $validacion=$public->validacion();

        if ($validacion->cantidad==0) {
            $respuest= $public->registrarCursoPersonas();
        
            if($respuest != false){

                $update=$public->updateCupos();
                $consult=$statC->changeStatus();
                $_SESSION["mensaje"] = "<script>swal('¡Registro exitoso!', '', 'success')</script>";
                $this->sendMailAdmn($_POST['txtCorreoPersona'],$_POST['txtNombrePersonaj'],$_POST['txtApellidoPersonaj'],$response);
            }else{
                $_SESSION["mensaje"] = "<script>swal('¡Error!', 'Por favor verifique los datos ingresados.', 'error')</script>";
            }     
        }else if ($validacion->cantidad>=1)  {
             $_SESSION["mensaje"] = "<script>swal('¡Error!', 'Usted ya se encuentra inscrito en este curso', 'error')</script>";
        }
        header('location: ' . URL . 'home/index');
    }

    public function sendMail()
    {
        $pub = new Publicaciones();
        $pub->__SET("idPublicacion", $_POST["id"]);
        $respuesta = $pub->getPublication();

        // echo json_encode($respuesta);
        echo "<br><br>";
        //mandar correo
            $tituloPublicacion = $respuesta->tituloPublicacion;
            $requisitosCurso = $respuesta->requisitosCurso;
            $schedule = $respuesta->distribucionHoraria;
            $descripcionPublicacion = $respuesta->descripcionPublicacion;
            $nombreCurso = $respuesta->nombreCurso;

            $mail = new PHPMailer(true);                          
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                
                $mail->isSMTP();                                    
                $mail->Host = 'smtp.gmail.com';                   
                $mail->SMTPAuth = true;                               
                $mail->Username = 'cursossena60@gmail.com';                
                $mail->Password = 'sena123456';                           
                $mail->SMTPSecure = 'ssl';                            
                $mail->Port = 465;      
                $mail->CharSet = 'UTF-8';                             
                //Recipients
                $mail->setFrom('cursossena60@gmail.com', 'Cursos SENA');
                $mail->addAddress($_SESSION["correoPersona"], 'Enviado por SENA');
                $mail->isHTML(true);                   
                $mail->Subject = 'Certificado de inscripcion e informacion del curso.';
                // $mail->Body = 'Hola, '.$_SESSION['nombrePersona'].' '.$_SESSION['apellidoPersona'].'
                // el presente correo es para informarle que usted ha sido inscrito al curso '.$nombreCurso.'<br>
                // La información de dicho curso es: <br>'.'<strong>Publicación: </strong>' . $tituloPublicacion . 
                // '<strong> Requisitos del curso: </strong>' . $requisitosCurso . ' <strong>Distribución horaria: </strong>' .
                // $schedule . ' <strong>Descripción : </strong>' . $descripcionPublicacion . '<br>';
                $mail->Body = 'Sr(a)'.$_SESSION['nombrePersona']. ' '. $_SESSION['apellidoPersona'].'

                <br>Ha sido preinscrito al  curso <strong>'.$nombreCurso.'.</strong> A continuación encuentra los datos asociados al curso :
                
                <br><br><strong>Publicación: '.$tituloPublicacion.'</strong>
                <br> <strong>Requisitos del curso: '.$requisitosCurso.'</strong>
                <br> <strong>Distribución horaria: '.$schedule.'</strong>
                <br> <strong>Descripción del curso: '.$descripcionPublicacion.'</strong>

                <br><br><strong> No olvide presentar su certificado de inscripción, físico o dígital, el día que asista para finalizar su proceso de matrícula.</strong>
                
                <br><br>**********************NO RESPONDER - Mensaje generado automáticamente**********************';
                $mail->send();
                echo 'El mensaje ha sido enviado.';
            } catch (Exception $e) {
            echo 'El mensaje no se pudo enviar. Error del mailer: ', $mail->ErrorInfo;
        }
    }
    public function sendMailAdmnAjax()
    {
        $p = new Publicaciones();
        $p->__SET("idCurso",$_POST['idCurso']);
        $respuesta = $p->getAllPublicaciones2();
    }

    public function sendMailAdmn($correo,$nameJa,$apellidoJa,$respuesta)
    {

        foreach($respuesta as $key=>$value)
        {
            $tituloPublicacion = $value->tituloPublicacion;
            $requisitosCurso = $value->requisitosCurso;
            $horario = $value->distribucionHoraria;
            $descripcionPublicacion = $value->descripcionPublicacion;
            $nombreCurso = $value->nombreCurso;

            $mail = new PHPMailer(true);                          
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                
                $mail->isSMTP();                                    
                $mail->Host = 'smtp.gmail.com';                   
                $mail->SMTPAuth = true;                               
                $mail->Username = 'cursossena60@gmail.com';                
                $mail->Password = 'sena123456';                           
                $mail->SMTPSecure = 'ssl';                            
                $mail->Port = 465;                                   
                //Recipients
                $mail->setFrom('cursossena60@gmail.com', 'Cursos SENA');
                $mail->addAddress($correo, 'Enviado por SENA');
                $mail->isHTML(true);                   
                $mail->Subject = 'Certificado de inscripcion e informacion del curso.';

                $mail->Body = 'Sr(a) '.$nameJa. ' '. $apellidoJa.'

                <br>Ha sido preinscrito al  curso <strong>'.$nombreCurso.'.</strong> A continuación encuentra los datos asociados al curso :
                
                <br><br><strong>Publicación: '.$tituloPublicacion.'</strong>
                <br> <strong>Requisitos del curso: '.$requisitosCurso.'</strong>
                <br> <strong>Distribución horaria: '.$horario.'</strong>
                <br> <strong>Descripción del curso: '.$descripcionPublicacion.'</strong>

                <br><br><strong> No olvide presentar su certificado de inscripción, físico o dígital, el día que asista para finalizar su proceso de matrícula.</strong>
                
                <br><br>**********************NO RESPONDER - Mensaje generado automáticamente**********************';
                $mail->send();
                echo 'El mensaje ha sido enviado.';
                } catch (Exception $e) {
            echo 'El mensaje no se pudo enviar. Error del mailer: ', $mail->ErrorInfo;
            }
        }
    }
}