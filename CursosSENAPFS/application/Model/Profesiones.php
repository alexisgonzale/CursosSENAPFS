<?php
namespace Mini\Model;

use Mini\Core\Model;

class Profesiones extends Model
{
    private $idProfesion;
    private $nombreProfesion;

    public function __SET($attr, $value)
    {
        $this->$attr = $value;
    }

    public function __GET($attr)
    {
        return $this->$attr;
    }

    public function adds()
    {
        $sql = "INSERT INTO profesiones (nombreProfesion) VALUES (?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->nombreProfesion);
        
        return $query->execute();  
    }

    public function get()
    {
        $sql = "SELECT idProfesion, nombreProfesion FROM profesiones WHERE idProfesion = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idProfesion);
        $query->execute();

        return $query->fetch();
    }

    public function update()
    {
        $sql = "UPDATE profesiones SET nombreProfesion = ? WHERE idProfesion = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->nombreProfesion);
        $query->bindParam(2, $this->idProfesion);
        
        return $query->execute();
    }

    public function destroy()
    {
        $sql = "DELETE FROM profesiones WHERE idProfesion = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idProfesion);

        return $query->execute();
    }

    public function show()
    {
        $sql = "SELECT idProfesion, nombreProfesion FROM profesiones";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}