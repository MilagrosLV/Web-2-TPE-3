<?php
    require_once 'app/models/model.php';

class TaskModel  extends Model {  
    //Obtiene y devuelve de la base de datos todas las sugerencias.
    function getTasks() {
        $query = $this->db->prepare('SELECT * FROM sugerencias');
        $query->execute();

        // $tasks es un arreglo de sugerencias
        $tasks = $query->fetchAll(PDO::FETCH_OBJ);

        return $tasks;
    }

    function getTask($id) {
        $query = $this->db->prepare('SELECT * FROM sugerencias WHERE id = ?');
        $query->execute([$id]);

        // $task es una sugerencias sola
        $task = $query->fetch(PDO::FETCH_OBJ);

        return $task;
    }

    //Inserta la sugerencia en la base de datos
    function insertTask($title, $genero, $description, $priority) {
        $query = $this->db->prepare('INSERT INTO sugerencias (titulo, genero, descripción, prioridad) VALUES(?,?,?,?)');
        $query->execute([$title, $genero, $description, $priority]);

        return $this->db->lastInsertId();
    }
    
    function deleteTask($id) {
        $query = $this->db->prepare('DELETE FROM sugerencias WHERE id = ?');
        $query->execute([$id]);
    }

    function updateTask($id) {    
        $query = $this->db->prepare('UPDATE sugerencias SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }

    function updateTaskData($id, $titulo, $descripción, $prioridad) {    
        $query = $this->db->prepare('UPDATE sugerencias SET titulo = ?, descripción = ?, prioridad = ?, genero = ? WHERE id = ?');
        $query->execute([$titulo, $descripción, $prioridad, $id]);
    }
}