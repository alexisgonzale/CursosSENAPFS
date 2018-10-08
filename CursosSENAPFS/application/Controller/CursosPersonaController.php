<?php

namespace Mini\Controller;

use Mini\Model\CursosPersona;
use Mini\Model\Home;

class CursosPersonaController{

    public function index()
    {
        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();

        $cursos = new CursosPersona();
        $cursos->__SET("cod_personas",$_SESSION["cod_personas"]);          
        $resultados=$cursos->misCursos();

        require APP. 'view/_templates/headeraprendiz.php';
        require APP. 'view/vistas_CursosSENA/Vistas_Admin/miscursos-Listar.php';
        require APP. 'view/_templates/footer.php';
    }

    public function eliminarCurso(){

        
        $hoy = date("Y-m-d");//Traer la fecha del hoy 
        $curso = new CursosPersona();   
        $curso->__SET("cod_personas",$_SESSION["cod_personas"]);  //Parámetros para la consulta
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

?>