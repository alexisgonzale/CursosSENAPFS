<?php 
namespace Mini\Controller;

use Mini\Model\Cursos;
use Mini\Model\Categories;
use Mini\Model\Home;


class CursosController
{
    public function index()
    {
        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();

        $c = new Cursos();
        $courses = $c->getAllCourseP();
        $categories = $c->getAllCategories();
        $answ = $c->getCourse();
        $resultado=$c->actualizarEstado();

        require APP.'view/_templates/header.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/Cursos-listar.php';        
        require APP.'view/_templates/footer.php';
    }

    public function create()
    {
        $c = new Cursos();
        $cat = new Categories();
        
        $categories = $c->getAllCategories();

        require APP.'view/_templates/header.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/Cursos-View.php';
        require APP.'view/_templates/footer.php';
    }

    public function addCourses()
    {      
        $cursos = new Cursos();


        $fecha_actual = date("Y-m-d");
        if($_POST['txtDateStart'] >= $fecha_actual AND $_POST["txtEndingDate"] >= $_POST['txtDateStart'])
        {       

            $cursos->__SET("nameCourse", $_POST["txtNameCourse"]);
            $cursos->__SET("quantityHours", $_POST["txtQHours"]);
            $cursos->__SET("attendant", $_POST["txtAttendant"]);
            $cursos->__SET("startDate", $_POST["txtDateStart"]);
            $cursos->__SET("endingDate", $_POST["txtEndingDate"]);
            $cursos->__SET("quota", $_POST["txtCupos"]); 
            $cursos->__SET("category", $_POST["allCategories"]);

            
            $respuesta=$cursos->addCourses();
        

            if($respuesta != false){
            
                $_SESSION["mensaje"] = "<script>swal('Registro Exitoso!', '', 'success')</script>";
            }else{
                $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
            }
        }else {
            $_SESSION["mensaje"] = "<script>swal('Error de fecha!', 'Por favor, verifique las fechas ingresadas.!', 'error')</script>";
        }
        header('location: ' . URL . 'Cursos/create');
    }

        

   
        public function editCourse()
        {
            $myCourse = new Cursos();
            $myCourse->__SET("idCourse",$_POST["id"]);
            $answer = $myCourse->getCourse();
            echo json_encode($answer);
        }
    
        public function updateCourse()
        {
            $course = new Cursos();
            $course->__SET("idCourse", $_POST["txtCodigoCurso"]);
            $course->__SET("nameCourse", $_POST["txtNameCourse"]);
            $course->__SET("quantityHours", $_POST["txtQHours"]);
            $course->__SET("attendant", $_POST["txtAttendant"]);
            $course->__SET("startDate", $_POST["txtDateStart"]);
            $course->__SET("endingDate", $_POST["txtEndingDate"]);
            $course->__SET("quota",$_POST["txtCupos"]);
            $course->__SET("category", $_POST["allCategories"]);

            if($_POST["txtDateStart"]<=$_POST["txtEndingDate"]){
                $respuesta = $course->updateCourses();
                if($respuesta !=false){
                    $resultado=$course->actualizarEstado();
                    $_SESSION["mensaje"] = "<script>swal('Moficación Exitosa!', 'El curso se a modificado correctamente.', 'success')</script>";
                }else{
                    $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
                }
            }elseif ($_POST["txtDateStart"]>=$_POST["txtEndingDate"]){
                $_SESSION["mensaje"] = "<script>swal('Error!', 'La fecha de INICIO no puedo ser MAYOR a la fecha FINAL!', 'error')</script>";
            }
            header('location: ' . URL . 'Cursos/index');
        }

    public function cambiarEstadoCursos($id,$estado)
    {
        $course = new Cursos();
        $course->__SET("idCourse", $id);
        $course->__SET("statusCourse", $estado);

        $resultado=$course->changeStatus();

        if ($resultado) {
            if ($estado=="Activo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> El estado se ha cambiado correctamente"); });</script>';;
            }
            else if ($estado=="Inactivo") {
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Bien hecho!</strong> El estado se ha cambiado correctamente"); });</script>';
            }
        }
        else{
            $_SESSION["mensaje"] = '<script language="javascript"> $(document).ready(function(){ $.notify("<strong>¡Error!</strong>"); }); </script>';
        }


        header ("location: " .URL."cursos/index");
    }
    public function eliminarCurso($id){
     
        $course = new Cursos();
        $course->__SET("idCourse", $id);

        $da=$course->deleteCourses();
        if($da){
            $_SESSION["mensaje"] = "<script>swal('Curso eliminado correctamente!', '', 'success')</script>";
            
        }else{
            $_SESSION["mensaje"] = "<script>swal('Error', 'Este curso no se puede eliminar, hay personas incritas.', 'error')</script>";

        }
        header ("location: " .URL."cursos/index");
    }

    public function informePersonaXcurso($idCurso){

     
        $cur= new Cursos();
        $cur->__SET("idCourse", $idCurso);

        $trae = $cur->informeCurso();
        $resultado = $cur->informeCursoxPersona();
       

        require APP.'view/vistas_CursosSENA/Vistas_Admin/ReportePersonaXCurso.php';
    }

}