<?php 
namespace Mini\Controller;

use Mini\Model\Preguntas;
use Mini\Model\Home;

class PreguntasController
{
    public function index()
    {
        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();
        
        $qs = new Preguntas();
        $questions = $qs->showQuestions();

        require APP.'view/_templates/header.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/Preguntas-View.php';  
        require APP.'view/_templates/footer.php';
    }

    public function fromAprendiz(){

        $qs = new Preguntas();
        $questions = $qs->showQuestion();

        require APP.'view/_templates/header.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/Preguntas-listarA.php';  
        require APP.'view/_templates/footer.php';
    }

    public function addQuestion()
    {
        $questions = new Preguntas();
        $questions->__SET("descripcionPregunta", $_POST["txtquestion"]);
        $questions->__SET("respuestaPregunta", $_POST["txtanswer"]);
        $questions->__SET("idUser", $_SESSION['cod_personas']);
        
        $answer = $questions->addQuestions();
        
        if($answer = true){

            $_SESSION["mensaje"] = "<script>swal('Registro Exitoso!', 'La pregunta se a registrado correctamente.', 'success')</script>";
            
        }else
        {
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
            
        }
        header('location: ' . URL . 'preguntas/index');
        
        
    }

    public function editQuestion()
    {
        $quest = new Preguntas();
        $quest->__SET("idPregunta", $_POST["id"]);
        $answer = $quest->getQuestion();
        echo json_encode($answer);
    }

    // método para modificar las preguntas frecuentes
    public function updateQuestion()
    {
        
        $question = new Preguntas();
        $question->__SET("descripcionPregunta", $_POST["txtQuestionModal"]);
        $question->__SET("respuestaPregunta", $_POST["txtPublicacionModal"]);
        $question->__SET("Estado", 'Inactivo');
        $question->__SET("idPregunta", $_POST["txtCodigoPregunta"]);        

        $respuesta = $question->updateQuestions();
        

        if($respuesta = true){

            $_SESSION["mensaje"] = "<script>swal('Actualizado!', 'La pregunta se a actualizado correctamente.', 'success')</script>";
            
        }else
        {
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
            
        }
        header('location: ' . URL . 'preguntas/index');
    }

    // método para responder las preguntas de los aprendices
    public function updateQuestionA()
    {
        $question = new Preguntas();
        $question->__SET("descripcionPregunta", $_POST["txtQuestionModal"]);
        $question->__SET("respuestaPregunta", $_POST["txtPublicacionModal"]);
        $question->__SET("Estado", 'Inactivo');
        $question->__SET("idPregunta", $_POST["txtCodigoPregunta"]);        

        $respuesta = $question->updateQuestions();
        
        if($respuesta = true){

            $_SESSION["mensaje"] = "<script>swal('Enviado!', 'La respuesta se a enviado correctamente.', 'success')</script>";
            
        }else
        {
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
            
        }
        header('location: ' . URL . 'preguntas/fromAprendiz');
    }

    public function deleteQuestion()
    {
        $questions = new Preguntas();
        $questions->__SET("idPregunta", $_POST["id"]);
        $answer = $questions->deleteQuestion();
        echo json_encode($answer);
    }

    // aprendiz

    public function forAprendiz(){

        $qs = new Preguntas();
        $questions = $qs->showQuestions();

        require APP.'view/_templates/headeraprendiz.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/PreguntasAprendiz.php';  
        require APP.'view/_templates/footer.php';
    }

    public function deleteMyAnswers($id)
    {
        $questions = new Preguntas();
        $questions->__SET("idPregunta", $id);
        $answer = $questions->deleteAnswers();
        echo json_encode($answer);
    }

    public function forAprendizA(){

        $qs = new Preguntas();
        $qs->__SET("idUser", $_SESSION['cod_personas']);
        $questions1 = $qs->MyAnswer();

        require APP.'view/_templates/headeraprendiz.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/MyAnswer.php';  
        require APP.'view/_templates/footer.php';
    }

    public function doQuestionAp()
    {
        $question = new Preguntas();
        $question->__SET("descripcionPregunta", $_POST['txtQuestionModal']);
        $question->__SET("idUser", $_SESSION['cod_personas']);

        $respuesta= $question->doQuestionA();

        if($respuesta = true)
        {
            $_SESSION["mensaje"] = "<script>swal('Enviado!', 'La pregunta se a enviado correctamente.', 'success')</script>";
        }else
        {
            $_SESSION["mensaje"] = "<script>swal('Error!', 'Verifique los campos ingresados!', 'error')</script>";
        }
        header('location: ' . URL . 'preguntas/forAprendiz');
    }



}