<?php

class CategoryController {

    protected $model;    
    
    public function __construct(){
        
        require_once '../../../libraries/models/CategoryModel.php';
        $this->model = new CategoryModel();
        
    }
    
    private function display($view, $variables = []){
        
        extract($variables);
        
        include '../../views/categories/'. $view .'.phtml';
        
    }
    
    public function index(){

        // le resultat de la fonction getDogs va dans la variable $meals
        // ça permet de faire resortir le $resultats qui est DANS la fonction (il est aussi possible de le faire sortir grâce au return)
        $categories = $this->model->getAll();
        
        // test sur la récupération
        // var_dump($_getMeals);
        
        // inclusion du phtml
        $this->display('list_category', ['categories'=>$categories]);
    }
    
    
    public function edit(){
        
        // var_dump($_GET);
        $id = $_GET['id'];
        
        
        // Requête sql récupérer id spécifique dans la BDD
        $category = $this->model->find($id);
        
        // var_dump($meal);
        
        
        $this->display('edit_category', ['category'=>$category]);
    }
        
        
}