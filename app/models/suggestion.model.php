<?php
    require_once 'app/models/model.php';

class SuggestionModel  extends Model {  
    //Obtiene y devuelve de la base de datos todas las sugerencias.
    function getSuggestion() {
        $query = $this->db->prepare('SELECT * FROM sugerencias');
        $query->execute();

        // $sugerencia es un arreglo de sugerencias
        $sugerencia = $query->fetchAll(PDO::FETCH_OBJ);

        return $sugerencia;
    }

    function getSuggestion($id) {
        $query = $this->db->prepare('SELECT * FROM sugerencias WHERE id = ?');
        $query->execute([$id]);

        // $sugerencia es una sugerencias sola
        $sugerencia = $query->fetch(PDO::FETCH_OBJ);

        return $sugerencia;
    }

    //Inserta la sugerencia en la base de datos
    function insertSuggestion($title, $genero, $description, $priority) {
        $query = $this->db->prepare('INSERT INTO sugerencias (titulo, genero, descripción, prioridad) VALUES(?,?,?,?)');
        $query->execute([$title, $genero, $description, $priority]);

        return $this->db->lastInsertId();
    }
    
    function deleteSuggestion($id) {
        $query = $this->db->prepare('DELETE FROM sugerencias WHERE id = ?');
        $query->execute([$id]);
    }

    function updateSuggestion($id) {    
        $query = $this->db->prepare('UPDATE sugerencias SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }

    function updateSuggestionData($id, $titulo, $descripción, $prioridad) {    
        $query = $this->db->prepare('UPDATE sugerencias SET titulo = ?, descripción = ?, prioridad = ?, genero = ? WHERE id = ?');
        $query->execute([$titulo, $descripción, $prioridad, $id]);
    }
}