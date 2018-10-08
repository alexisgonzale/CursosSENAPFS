<?php
namespace Mini\Controller;

use Mini\Model\Categories;
use Mini\Model\Profesiones;
use Mini\Model\CategoriaHasProfesion;
use Mini\Model\Home;

class CategoriesController
{
    public function index()
    {
        // notifications
        $var = new Home();
        $CoutNotify = $var->coutNotifications();
        $seeNotify = $var->seeNotification();

        $cat = new Categories();
        $categories = $cat->getAllCategories();
        $p = new Profesiones();
        $profesiones = $p->show();

        require APP.'view/_templates/header.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/categories-listar.php';
        require APP.'view/_templates/footer.php';
    }

    public function create()
    {
        $profession = new Profesiones();
        $prof = $profession->show();

        require APP.'view/_templates/header.php';
        require APP.'view/vistas_CursosSENA/Vistas_Admin/Categorias-View.php';
        require APP.'view/_templates/footer.php';
    }

    public function addCategories()
    {
        $category = new Categories();
        $category->__SET("nameCategory", $_POST["txtNameCategory"]);
        $respuesta = $category->addCategories();
        echo json_encode($respuesta);
    }


    public function addCategory()
    {
        
        $category = new Categories();
        $category->__SET("nameCategory", $_POST["txtNameCategoria"]);

        try{
            $respuesta = $category->addCategories(); 
            if($respuesta != false)
            {
                $ultimo = $respuesta->id;
                foreach($_POST["profesiones_id"] as $id)
                {
                    $cp = new CategoriaHasProfesion();
                    $cp->__SET("categoria_id", $ultimo);
                    $cp->__SET("profesion_id", $id);
                    $cp->add();
                }
                $_SESSION["mensaje"] = "<script> swal('Bien', 'La categoría se ha registrado correctamente.','success')</script>";
            }
            else
            {
                $_SESSION["mensaje"] = "No se guardó.";
            }
    }catch(\Exception $ex)
        {
            echo "<label> ERR </label>";
        }
        header('location: ' . URL . 'categories/create');
    }

    public function editCategory()
    {
        $myCategory = new Categories();
        $myCategory->__SET("idCategory",$_POST["id"]);
        $answer = $myCategory->getCategory();
        echo json_encode($answer);
    }

    public function updateCategory()
    {
        $category = new Categories();
        $category->__SET("nameCategory", $_POST["txtNameCategory"]);
        $category->__SET("idCategory", $_POST["txtCodCategory"]);

        $respuesta = $category->updateCategories();
        
        if($respuesta !=false)
        {
            $_SESSION["mensaje"] = "<script> swal('Modificación exitosa', 'La categoría se ha Modificación correctamente.','success')</script>";
        }else{
            $_SESSION["mensaje"] = "<script> swal('Error!', 'Verifique los campos ingresados!','error')</script>";
        }
        header('location: ' . URL . 'categories/index');
    }

    public function profesionXcategoria()
    {
        $cat_prof = new CategoriaHasProfesion();
        $cat_prof->__SET("categoria_id",$_POST['id']);
        $answer = $cat_prof->profesionXcategoria();
        echo json_encode($answer);
    }

}
