<?php
namespace Mini\Model;

use Mini\Core\Model;

class Home extends Model
{
    public function countCategories()
    {
        $sql = "SELECT COUNT(idCategoria_Cursos) as Cantidad FROM categoria_cursos";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch(); 
    }

    public function countCourses()
    {
        $sql = "SELECT COUNT(idCursos) as Cantidad FROM cursos WHERE estadoCurso='Activo'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch(); 
    }

    public function countPeople()
    {
        $sql = "SELECT COUNT(cod_personas) as Cantidad FROM personas";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch(); 
    }

    
    public function countTD()
    {
        $sql = "SELECT COUNT(idtipoDocumento) as Cantidad FROM tipodocumento";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch(); 
    }

    // notificaciones
    public function seeNotification(){
        $sql = "SELECT concat(SUBSTRING(p.descripcionPregunta, 1, 20),'...') AS question,curdate() from preguntas p where p.respuestaPregunta='' and p.Estado='Activo' LIMIT 5";
        $sml = $this->db->prepare($sql);
        $sml->execute();

        return $sml->fetch();
    }

    public function coutNotifications(){
        $sql = "SELECT COUNT(descripcionPregunta) AS NumberNotifications FROM preguntas WHERE respuestaPregunta = '' AND Estado = 'Activo'";
        $sml = $this->db->prepare($sql);
        $sml->execute();

        return $sml->fetch();
    }
}