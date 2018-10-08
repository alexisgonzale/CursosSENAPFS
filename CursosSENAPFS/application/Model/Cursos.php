<?php
namespace Mini\Model;

use Mini\Core\Model;

class Cursos extends Model
{
    private $idCourse;
    private $nameCourse;
    private $quantityHours;
    private $attendant;
    private $startDate;
    private $endingDate;
    private $quota;
    private $category;
    private $img;
    private $statusCourse;

    public function __SET($attr,$value)
    {
        $this->$attr = $value;
    
    }

    public function __GET($attr)
    {
        return $this->$attr;
    }

    public function addCourses()
    {
        $sql = "INSERT INTO cursos(nombreCurso, cantidadHoras, encargadoCurso, fechaInicio, fechaFin, cupos, idCategorias_Has_Profesiones,cupos1) VALUES ( ?, ?, ?, ?, ?, ?, ?,?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->nameCourse);
        $query->bindParam(2, $this->quantityHours);
        $query->bindParam(3, $this->attendant);
        $query->bindParam(4, $this->startDate);
        $query->bindParam(5, $this->endingDate);
        $query->bindParam(6, $this->quota);
        $query->bindParam(7, $this->category);
        $query->bindParam(8, $this->quota);
        
         return $query->execute();
    }

    public function getCourse()
    {
        $sql = "SELECT distinct c.idCursos, c.nombreCurso, c.cantidadHoras, c.encargadoCurso, c.fechaInicio, c.fechaFin, c.cupos, c.estadoCurso, cp.categoria_id FROM cursos c JOIN categorias_has_profesiones cp ON(c.idCategorias_Has_Profesiones=cp.categoria_id) WHERE c.idCursos = ?";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCourse);
        $query->execute();

        return $query->fetch();
    }

    public function updateCourses()
    {
       
        $sql = "CALL actualizarCursos (?,?,?,?,?,?,?,?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCourse);
        $query->bindParam(2, $this->nameCourse);
        $query->bindParam(3, $this->quantityHours);
        $query->bindParam(4, $this->attendant);
        $query->bindParam(5, $this->startDate);
        $query->bindParam(6, $this->endingDate);
        $query->bindParam(7, $this->quota);
        $query->bindParam(8, $this->category);
        
        return $query->execute();
    }

    public function deleteCourses()
    {
        $sql = "CALL eliminarCursosss (?)";
        $query = $this->db->prepare($sql);
        $query->bindParam(1, $this->idCourse);

        return $query->execute();
    }

    public function getAllCourses()
    {
        $sql = "SELECT DISTINCT  c.idCursos, c.nombreCurso, c.cantidadHoras, c.encargadoCurso, c.fechaInicio, c.fechaFin, c.cupos, c.estadoCurso, cc.nombreCategoria
        FROM cursos AS c INNER JOIN categorias_has_profesiones AS chp ON 
        C.idCategorias_Has_Profesiones = chp.categoria_id INNER JOIN categoria_cursos AS cc ON CHP.categoria_id = cc.idCategoria_Cursos
        WHERE c.idCursos NOT IN (SELECT publicaciones.idCurso
        FROM publicaciones) and c.estadoCurso = 'Activo'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    public function getAllCourseP()
    {
        $sql = "SELECT c.idCursos, c.nombreCurso,c.cantidadHoras, c.encargadoCurso, c.fechaInicio, c.fechaFin, c.cupos, c.estadoCurso, chp.nombreCategoria , c.cupos1 FROM cursos AS c JOIN categoria_cursos AS chp ON c.idCategorias_Has_Profesiones = chp.idCategoria_Cursos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllCategories()
    {
        $sql = "SELECT idCategoria_Cursos, nombreCategoria FROM categoria_cursos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function changeStatus()
    {
        $sql = "UPDATE cursos c SET c.estadoCurso = 'Inactivo' WHERE c.cupos =0 AND c.estadoCurso= 'Activo'";
        $query = $this->db->prepare($sql);
        
        return $query->execute();
    }

    public function actualizarEstado(){
        $sql="CALL cambiarEstado";
        $stm= $this->db->prepare($sql);
        return $stm->execute();    
    }

    public function informeCurso(){
       
        $sql="SELECT c.nombreCurso,c.fechaInicio,c.fechaFin,c.encargadoCurso,c.cantidadHoras,cc.nombreCategoria FROM cursos c JOIN categorias_has_profesiones cp ON (c.idCategorias_Has_Profesiones=cp.categoria_id) JOIN categoria_cursos cc ON (cp.categoria_id=cc.idCategoria_Cursos) where c.idCursos=? GROUP BY c.idCursos";
        $stm= $this->db->prepare($sql);
        $stm->bindParam(1,$this->idCourse);
       
        $stm->execute();    
        return $stm->fetchAll();
    }
    public function informeCursoxPersona(){
        
        $sql="SELECT p.documentoPersona,p.nombrePersona,p.apellidoPersona,p.telefonoPersona,pr.nombreProfesion,p.correoPersona FROM cursos c JOIN cursos_has_personas cp ON(c.idCursos=cp.Cursos_idCursos) JOIN personas p ON (cp.Personas_codPersona=p.cod_personas) JOIN profesiones pr ON(p.profesionPersona=pr.idProfesion) where c.idCursos=?";        
        $stm= $this->db->prepare($sql);
        $stm->bindParam(1,$this->idCourse); 
        $stm->execute();
        
        return $stm->fetchAll();
    }

}