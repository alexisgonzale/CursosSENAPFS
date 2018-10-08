<?php 
namespace Mini\Controller;

use Mini\Model\Profesiones;
use Mini\Model\Home;

class ProfesionesController
{
    public function add()
    {
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();
        
        $professions = new Profesiones();
        $professions->__SET("nombreProfesion", $_POST["txtProfesionMD"]);
        $answer1 = $professions->adds();
                        
        if($answer1 !=false)
        {
            $_SESSION["mensaje"] = "<script> swal('Registro exitoso', 'La profesión se ha registrado con éxito.','success')</script>";
        }else{
            $_SESSION["mensaje"] = "<script> swal('Error!', 'Verifique los campos ingresados!','error')</script>";
        }
        header('location: ' . URL . 'categories/index');
    }

    public function get()
    {
        $professions = new Profesiones();
        $professions->__SET("idProfesion", $_POST['id']);
        $answer = $professions->get();
        echo json_encode($answer);
    }

    public function update()
    {
        $professions = new Profesiones();
        $professions->__SET("nombreProfesion", $_POST['txtEditProfesion']);
        $professions->__SET("idProfesion", $_POST['idEditProfesion']);
        $answer = $professions->update();
        
        if($answer !=false)
        {
            $_SESSION["mensaje"] = "<script> swal('Modificación exitosa', 'La profesión se ha Modificación correctamente.','success')</script>";
        }else{
            $_SESSION["mensaje"] = "<script> swal('Error!', 'Verifique los campos ingresados!','error')</script>";
        }
        header('location: ' . URL . 'categories/index');
    }

    public function destroy()
    {
        $professions = new Profesiones();
        $professions->__SET("idProfesion", $_POST['id']);
        $answer = $professions->destroy();
        echo json_encode($answer);
    }
}