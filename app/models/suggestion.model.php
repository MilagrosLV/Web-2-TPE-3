<?php
    require_once 'app/models/model.php';

class SuggestionModel  extends Model {  
<<<<<<< HEAD
=======

>>>>>>> f9098fc9dfe42898cf21713f2bc8c4aabbe37f97
    //Obtiene y devuelve de la base de datos todas las sugerencias.
    function getSuggestions() {
        $query = $this->db->prepare('SELECT * FROM sugerencias');
        $query->execute();

        $sugerencias = $query->fetchAll(PDO::FETCH_OBJ);

        return $sugerencias;
    }

    function getSuggestion($id) {
        $query = $this->db->prepare('SELECT * FROM sugerencias WHERE id = ?');
        $query->execute([$id]);

        $sugerencia = $query->fetch(PDO::FETCH_OBJ);

        return $sugerencia;
    }

    //Inserta la sugerencia en la base de datos
    function insertSuggestion($titulo, $genero, $descripción, $prioridad) {
        $query = $this->db->prepare('INSERT INTO sugerencias (titulo, genero, descripción, prioridad) VALUES(?,?,?,?)');
        $query->execute([$titulo, $genero, $descripción, $prioridad]);

        return $this->db->lastInsertId();
    }
    
    //Elimina la sugerencia en la BBDD
    function deleteSuggestion($id) {
        $query = $this->db->prepare('DELETE FROM sugerencias WHERE id = ?');
        $query->execute([$id]);
    }

<<<<<<< HEAD
    /*function updateSuggestion($id) {     //CHEQUEAR
        $query = $this->db->prepare('UPDATE sugerencias SET finalizada = 1 WHERE id = ?');//CHEQUEAR
        $query->execute([$id]);
    }*/

    //Modifica la sugerencia en la BBDD
=======
>>>>>>> f9098fc9dfe42898cf21713f2bc8c4aabbe37f97
    function updateSuggestionData($id, $titulo, $genero, $descripción, $prioridad) {    
        $query = $this->db->prepare('UPDATE sugerencias SET titulo = ?, genero = ?, descripción = ?, prioridad = ? WHERE id = ?');
        $query->execute([$titulo, $genero, $descripción, $prioridad, $id]);
    }
}