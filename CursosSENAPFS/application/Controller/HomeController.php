<?php
namespace Mini\Controller;

use Mini\Model\Categories;
use Mini\Model\Home;
use Mini\Model\Publicaciones;
use Mini\Model\Cursos;
use Mini\Model\Personas;


class HomeController
{
    public function index()
    {
        $c = new Cursos();
        $var = new Home();
        $p = new Publicaciones();
        $personas = new Personas();
        $resultados=$personas->listartipoDocu();
       
        $cursosSelect = $c->getAllCourses();
        $cat = $var->countCategories();
        $cursos = $var->countCourses();
        $people = $var->countPeople();
        $td = $var->countTD();

        if($_SESSION["rol"] == 2)
        {
            $p = new Publicaciones();
            $p->__SET("profesionPersona", $_SESSION['profesionPersona']);

            $publications = $p->showWithProfession();
           
        require APP .'view/_templates/headeraprendiz.php';
        require APP . 'view/home/aprendiz.php';
        require APP . 'view/_templates/footer.php';
        }
        else
        {
            $p = new Publicaciones();
            $publications = $p->getAllPublicaciones();
            // $p->__SET("idCurso",$_POST['idCurso']);
            // $publications2 = $p->getAllPublicaciones2();
            // echo json_encode($publications2);


        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
        }
    }

    // public function list_t(){
    //     $p = new Publicaciones();
    //     $p->__SET("idCurso",$_POST['idCurso']);
    //     $publications2 = $p->getAllPublicaciones2();
    //     echo json_encode($publications2);
    // }
   

    public function reporteCategoriaFechas()
    {
       

        $c = new Categories();
        $c->__SET("fechaInicio",$_POST['txtfechaInicio']);
        $c->__SET("fechaFin",$_POST['txtfechaFin']);

        if($_POST['txtfechaInicio']<$_POST['txtfechaFin']){
            $c->__SET("idCategory",$_POST['idCategoria']);
       
            $uesta=$c->reporteCategoriaFechas();            
            // var_dump($uesta);
            // exit;
            if($uesta){
                require APP.'view/vistas_CursosSENA/Vistas_Admin/ReporteFechasCategoria.php';
            }else{
                $_SESSION["mensaje"] = "<script>swal('Atención','En la categoría escogida no se encontraron resultados','info')</script>";
                header("location: " .URL. "home/vistaReporte");
            }
        }else if($_POST['txtfechaInicio']>=$_POST['txtfechaFin']){
            $_SESSION["mensaje"] = "<script>swal('ERROR','La fecha FINAL no puede ser menor a la fecha INICIAL','error')</script>";
            header("location: " .URL. "home/vistaReporte");
        }    
    }

    
    public function vistaReporte(){

        $cat= new Categories();
         
        $traerCat = $cat->getAllCategories();

        require APP . 'view/_templates/header.php';
        require APP . 'view/Vistas_CursosSENA/Vistas_Admin/Vista-reporteCategoria.php';
        require APP . 'view/_templates/footer.php';
    }
   
}
