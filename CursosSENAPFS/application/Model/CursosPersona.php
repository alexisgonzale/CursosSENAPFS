<?php

namespace Mini\Model;

use Mini\core\Model;

class CursosPersona extends Model {

    private $cod_personas;
    private $idCursos;

public function __SET ($attr,$value){

    $this->$attr=$value;
} 

public function __GET($attr){

    return $this->$attr; 

}

// $sql="CALL esteSi";
//         $stm= $this->db->prepare($sql);
//         return $stm->execute();     

public function eliminarCurso(){

    $sql="CALL eliminarCurso (?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1,$this->cod_personas);
    $stm->bindParam(2,$this->idCursos);
    return $stm->execute();
}

public function misCursos(){

    $sql="SELECT c.nombreCurso,c.encargadoCurso,c.fechaInicio,c.fechaFin,c.estadoCurso,c.idCursos from personas p join cursos_has_personas cp on (p.cod_personas=cp.Personas_codPersona) JOIN cursos c on(cp.Cursos_idCursos=c.idCursos) where p.cod_personas =?";
    $sml=$this->db->prepare($sql);
    $sml->bindParam(1, $this->cod_personas);
    $sml->execute();
    return $sml->fetchAll();
}
 
public function fechaInicio(){

$sql="SELECT c.fechaInicio from cursos c where idCursos = ?";
$sml=$this->db->prepare($sql);
$sml->bindParam(1,$this->idCursos);
$sml->execute();
return $sml->fetch();

}

public function fechaFin(){

    $sql="SELECT c.fechaFin from cursos c where idCursos = ?";
    $sml=$this->db->prepare($sql);
    $sml->bindParam(1,$this->idCursos);
    $sml->execute();
    return $sml->fetch();
    
    }

   

    }










?>