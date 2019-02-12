<?php


require_once 'Model.php';

// Ce fichier prend le nom d'une classe

class MealModel extends Model {
    
    protected $table = 'meal';
    
    // requête de type SELECT
    public function getAll()
    {
        // $pdo = $this->getPDO(); // obsolète car $this->PDO au dessus. on peut effacer cette ligne dans chacune des fonctions du dessous
        $sql = "SELECT meal.*, category.title as category_title 
                FROM meal 
                INNER JOIN category ON category.id = meal.category_id"; 
    
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultats;
    }
    
}