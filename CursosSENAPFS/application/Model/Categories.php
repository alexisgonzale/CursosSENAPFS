<?php
namespace Mini\Model;

use Mini\Core\Model;

class Categories extends Model
{
    private $idCategory;
    Private $idCategoria_Cursos;
    private $nameCategory;
    private $fechaInicio;
    private $fechaFin;


    public function __SET($attr, $value)
    {
        $this->$attr = $value;
    }

    private function getMax()
    {
        $sql = "SELECT MAX(idCategoria_Cursos) AS id FROM categoria_cursos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function addCategories()
    {
        $sql = "INSERT INTO categoria_cursos (nombreCategoria) VALUES (?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->nameCategory);
        
        if($query->execute())
        {
            return $this->getMax();
        }
        else
        {
            return false;
        }

    }

    public function getCategory()
    {
        $sql = "SELECT idCategoria_Cursos, nombreCategoria FROM categoria_cursos WHERE idCategoria_Cursos = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCategory);
        $query->execute();

        return $query->fetch();
    }

    public function updateCategories()
    {
        $sql = "UPDATE categoria_cursos SET nombreCategoria = ? WHERE idCategoria_Cursos = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->nameCategory);
        $query->bindParam(2, $this->idCategory);

        return $query->execute();
    }

    public function deleteCategories()
    {
        $sql = "DELETE FROM categoria_cursos WHERE idCategoria_Cursos = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCategory);

        return $query->execute();
    }
    
    public function getAllCategories()
    {
        $sql = "SELECT idCategoria_Cursos, nombreCategoria FROM categoria_cursos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

   
public function reporteCategoriaFechas(){
     
       
    $sql="SELECT DISTINCT c.nombreCurso, c.cupos,c.cupos1,(c.cupos1-c.cupos) as sobrantes,c.fechaInicio,c.fechaFin,cc.nombreCategoria from cursos c JOIN categorias_has_profesiones cp ON (c.idCategorias_Has_Profesiones=cp.categoria_id) JOIN categoria_cursos cc ON (cp.categoria_id=cc.idCategoria_Cursos) WHERE C.fechaInicio AND C.fechaFin BETWEEN ? AND ? and cc.idCategoria_Cursos =?";
     
    $query = $this->db->prepare($sql);
    $query->bindParam(1, $this->fechaInicio);
    $query->bindParam(2, $this->fechaFin);
    $query->bindParam(3, $this->idCategory);
   
    $query->execute();
    return $query->fetchAll();
   
}



}