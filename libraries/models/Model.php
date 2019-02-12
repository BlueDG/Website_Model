<?php

/**
 * Constantes de configuration de PDO, il suffit de les changer si la BDD change
 * TODO: Faire bouger ces configurations dans un fichier de configuration à la base du site
 */
const DB_HOST            = 'localhost';
const DB_USER            = 'root';
const DB_PASSWORD        = '';
const DB_NAME            = 'restaurant';


/**
 * Cette classe abstraite possède toutes les méthodes nécessaires à travailler
 * sur une table en particulier. Il suffit d'en hériter et de redéfinir la propriété $table
 * 
 * Elle possède les méthodes suivantes :
 * 
 * __construct() : Le constructeur qui met en place la connexion avec PDO
 * find($id)     : La méthode qui permet de retrouver UN SEUL enregistrement
 * getAll()      : La méthode qui permet de retrouver tous les enregistrements
 * insert($data) : La méthode qui permet d'insérer un enregistrement
 * update($data) : La méthode qui permet de mettre à jour un enregistrement
 * delete($id)   : La méthode qui permet de supprimer un enregistrement
 * 
 * @class Model
 * @author 3WA Live 09
 */
abstract class Model {
    
    /**
     * L'instance de la classe PDO qui nous permet de nous connecter 
     * @var PDO 
     */
    protected $pdo;
    
    /**
     * Le nom de la table que l'on souhaite attaquer
     * @var string
     */
    protected $table;
    
    public function __construct() {
        // Options de connexion à la base de données
        $dsn        = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
        $user       = DB_USER; 
        $password   = DB_PASSWORD;
        
        // On créé une nouvelle connexion à la base et on la stock
        // dans notre propriété $pdo déclarée en privée
        $this->pdo  = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
        ]); 
        
        if(empty($this->table) == true) {
            throw new Exception('Attention, vous n\'avez pas redéfini la propriété protégée $table dans votre classe de Model');
        }
    }
    
    /**
     * Permet de trouver un enregistrement en base grâce à son identifiant
     * 
     * @param int $id L'identifiant de ce qu'on cherche
     * @return array Les informations de l'enregistrement qu'on trouve
     */
    public function find($id)
    {
        // On prépare une requête SELECT
        $query= $this->pdo->prepare('SELECT * FROM '. $this->table .' WHERE id = ?');
        
        // On exécute en précisant l'id recherché
        $query->execute([$id]);
        
        // On retourn l'enregistrement retrouvé
        return $query->fetch();
    }
    
    
    /**
     * Permet de récupérer tous les enregistrements d'une table
     * 
     * @return array La liste des enregistrements de la table
     */
    public function getAll()
    {
        // On prépare une requête SELECT globale
        $query = $this->pdo->prepare("SELECT * 
                                        FROM $this->table");
        
        // On exécute la requête
        $query->execute();
        
        // On retourne l'ensemble des enregistrements
        return $query->fetchAll();
    }
    
    
    /**
     * Permet de supprimer un enregistrement grâce à son identifiant
     * 
     * @param int $id  L'identifiant de l'enregistrement à supprimer
     * @return void
     */
    public function delete($id) 
    {
        // On prépare une requête de type DELETE
        $query=$this->pdo->prepare('DELETE  FROM '. $this->table .' WHERE id = ?');
        
        // On exécute en précisant l'identifiant
        $query->execute([$id]);
    }
    
    /**
     * Permet d'insérer une ligne dans la table en recevant un tableau
     * de clés et de valeurs qui représentent les champs que l'on veut attaquer
     * 
     * @param array $data Un tableau de clé valeur qui dit pour chaque champ de la table 
     * quelle information on veut dedans
     * @return void
     */
    public function insert($data) {
        // On commence la requête : INSERT INTO ... (
        $sql = 'INSERT INTO ' . $this->table . ' (';
       
        // On récupère les clés qui se trouvent dans data
        $fields = array_keys($data);
       
        // On rejoint les clés par des virgules
        // Donc la requête ressemble à ça : INSERT INTO ... (clé1, clé2, clé3
        $sql .= join($fields, ', ');
       
        // On continue la requête :
        // INSERT INTO ... (clé1, clé2, clé3) VALUES (
        $sql .= ') VALUES (';
        
        // On va créer les marqueurs (les paramètres de la requête préparée)
        $markers = [];
        // Pour chaque donnée, on compte un paramètre genre ":clé1"
        foreach($data as $field => $value) {
            $markers[] = ":$field";
        }
       
        // On rejoint les marqueurs avec un virgule, donc la requête
        // ressemble à ça :
        // INSERT INTO ... (clé1, clé2, clé3) VALUES (:clé1, :clé2, :clé3
        $sql .= join($markers, ',');
       
        // On ferme la requête qui ressemble donc à :
        // INSERT INTO ... (clé1, clé2, clé3) VALUES (:clé1, :clé2, :clé3)
        $sql .= ')';
        
        // On prépare et on execute en passant le tableau des données
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }
    
    /**
     * Permet de mettre à jour un enregistrement d'une table grâce à un tableau de clés valeurs
     * 
     * @param array $data Un tableau qui dit pour chaque champ la valeur qu'on veut mettre à jour
     * @return void
     */
    public function update($data) {
        // On commence la requête : UPDATE ... SET 
        $sql = 'UPDATE ' . $this->table . ' SET ';
        
        // On va préparer les mises à jour dans un tableau
        $markers = [];
        // Pour chaque donnée envoyée, on va écrire un morceau de phrase
        foreach($data as $field => $value) {
            // Exemple : "clé1 = :clé1"
            $markers[] =  "$field = :$field";
        }
        // On rejoint les morceaux de mise à jour donc la requête
        // ressemble genre à ça :
        // UPDATE ... SET clé1 = :clé1, clé2 = :clé2, clé3 = :clé3
        $sql .= join($markers, ', ');
        
        // Si on nous a envoyé un ID, il faut un where, donc ça ressemble à :
        // UPDATE ... SET clé1 = :clé1, clé2 = :clé2, clé3 = :clé3 WHERE id = :id
        if(!empty($data['id'])) {
            $sql .= ' WHERE id = :id';
        }
        
        // On prépare la requête et on execute en fournissant les données
        $query = $this->pdo->prepare($sql);
        $query->execute($data);
    }   
}