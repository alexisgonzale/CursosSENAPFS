<?php
namespace Mini\Model;

use Mini\Core\Model;

class CategoriaHasProfesion extends Model
{
    private $idCategorias_has_Profesiones;
    private $categoria_id;
    private $profesion_id;

    public function __SET($attr, $value)
    {
        $this->$attr=$value;
    }

    public function __GET($attr)
    {
        return $this->$attr;
    }

    public function add()
    {
        $sql = "INSERT INTO categorias_has_profesiones VALUES (null, ?, ?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->categoria_id);
        $query->bindParam(2, $this->profesion_id);

        return $query->execute();
    }

    public function update()
    {
        $sql = "UPDATE categorias_has_profesiones SET categoria_id = ?, profesion_id = ? WHERE idCategorias_has_Profesiones = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->categoria_id);
        $query->bindParam(2, $this->profesion_id);
        $query->bindParam(3, $this->idCategorias_has_Profesiones);

        return $query->execute();
    }

    public function delete()
    {
        $sql = "DELETE FROM categorias_has_profesiones WHERE idCategorias_has_Profesiones = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCategorias_has_Profesiones);
        
        return $query->execute();
    }

    public function profesionXcategoria()
    {
        $sql = "SELECT p.idProfesion, p.nombreProfesion FROM categorias_has_profesiones cp JOIN profesiones p ON(cp.profesion_id=p.idProfesion) WHERE cp.categoria_id = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->categoria_id);
        $query->execute();

        return $query->fetchAll();
    }
}