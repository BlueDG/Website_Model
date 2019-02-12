<?php

// connexion BDD
$dsn = 'mysql:host=localhost;dbname=restaurant';
$user = 'guillaumedg'; 
$password = ''; 
$pdo = new PDO($dsn, $user, $password, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);  
$pdo->exec('SET NAMES UTF8');


function getPDO()
{
  $dsn = 'mysql:host=localhost;dbname=restaurant';
  $user = 'guillaumedg'; 
  $password = '';
  $pdo = new PDO($dsn, $user, $password, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]); 
  return $pdo;
}



// requête de type SELECT
function getMeals()
{
    $pdo = getPDO();
    $sql = "SELECT meal.*, category.title as category_title 
            FROM meal 
            INNER JOIN category ON category.id = meal.category_id"; 

    $query = $pdo->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $resultats;
}

function getMealsFromCategory($category_id){
    $pdo = getPDO();
    $sql = "SELECT meal.*
            FROM meal 
            WHERE category_id = ?"; 

    $query = $pdo->prepare($sql);
    $query->execute([$category_id]);
    $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $resultats;
}


/**
 * Permet de choper un plat grâce à son identifiant
 */
function getMeal($id)
{
    $pdo = getPDO();
    $sql = 'SELECT * FROM meal WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
    $meal = $query->fetch();
    
    return $meal;
}


// requête de type INSERT
function addMeal($title, $description, $price, $image, $vegan, $category)
{
    $pdo = getPDO(); // on insère une variable extérieure dans la fonction
    
    $sql = 'INSERT INTO meal (title, description, price, image, vegan, category_id)
        VALUES (?, ?, ?, ?, ?, ?)';
        
    $query = $pdo->prepare($sql);
    $query->execute([$title, $description, $price, $image, $vegan, $category]);  // suivre l'ordre des points d'interrogation, pas des paramètres
}


// requête de type UPDATE
function updateMeal($title, $description, $price, $photo, $vegan, $category, $id)
{
    $pdo = getPDO();
    $sql = 'UPDATE meal SET title = ?, description = ?, price = ?, image = ?, vegan = ?, category_id = ? WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$title, $description, $price, $photo, $vegan, $category, $id]);
}

// requête de type DELETE
function deleteMeal($id) // un param = un ? // la fonction a besoin de ces variables
{
    $pdo = getPDO();
    $sql = 'DELETE  FROM meal WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
}


/********************************************* ON S'OCCUPE DES CATEGORIES **************************************/


// requête de type SELECT
function getCategories()
{
    $pdo = getPDO();
    $sql = "SELECT * 
            FROM category"; 

    $query = $pdo->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $resultats;
}


function getCategory($id)
{
    $pdo = getPDO();
    $sql = 'SELECT * FROM category WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
    $category = $query->fetch();
    
    return $category;
}





// requête de type INSERT
function addCategory($title)
{
    $pdo = getPDO(); // on insère une variable extérieure dans la fonction
    
    $sql = 'INSERT INTO category (title)
        VALUES (?)';
        
    $query = $pdo->prepare($sql);
    $query->execute([$title]);  // suivre l'ordre des points d'interrogation, pas des paramètres
}



// requête de type UPDATE
function updateCategory($categoryTitle, $categoryId)
{
    $pdo = getPDO();
    $sql = 'UPDATE category SET title = ? WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$categoryTitle, $categoryId]);
}


// requête de type DELETE
function deleteCategory($id) // un param = un ? // la fonction a besoin de ces variables
{
    $pdo = getPDO();
    $sql = 'DELETE  FROM category WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
}



/********************************************* ON S'OCCUPE DES RESERVATIONS **************************************/


// requête de type SELECT
function getReservations()
{
    $pdo = getPDO();
    $sql = "SELECT * 
            FROM reservation"; 

    $query = $pdo->prepare($sql);
    $query->execute();
    $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $reservations;
}

// requête de type INSERT
function addReservation($lastName, $firstName, $number, $phone, $date)
{
    $pdo = getPDO(); // on insère une variable extérieure dans la fonction
    
    $sql = 'INSERT INTO reservation (date_reservation, pax, last_name, first_name, phone_number)
        VALUES (?, ?, ?, ?, ?)';
        
    $query = $pdo->prepare($sql);
    $query->execute([$date, $number, $lastName, $firstName, $phone]);  // suivre l'ordre des points d'interrogation, pas des paramètres
}



// requête de type SELECT
function getReservation($id)
{
    $pdo = getPDO();
    $sql = 'SELECT * FROM reservation WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
    $reservation = $query->fetch();
    
    return $reservation;
}

// requête de type UPDATE
function updateReservation($lastName, $firstName, $date, $phone, $number, $id)
{
    $pdo = getPDO();
    $sql = 'UPDATE reservation SET last_name = ?, first_name = ?, date_reservation = ?, phone_number = ?, pax = ? WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$lastName, $firstName, $date, $phone, $number, $id]);
}

// requête de type DELETE
function deleteReservation($id) // un param = un ? // la fonction a besoin de ces variables
{
    $pdo = getPDO();
    $sql = 'DELETE  FROM reservation WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
}

/********************************************* ON S'OCCUPE DU REPERTOIRE CLIENTELE **************************************/


// requête de type SELECT
function getClients()
{
    $pdo = getPDO();
    $sql = "SELECT * 
            FROM client"; 

    $query = $pdo->prepare($sql);
    $query->execute();
    $clients = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $clients;
}

function getClient($id)
{
    $pdo = getPDO();
    $sql = 'SELECT * FROM client WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
    $client = $query->fetch();
    
    return $client;
}



// requête de type INSERT
function addClient($lastName, $firstName, $phone, $email, $password)
{
    $pdo = getPDO(); // on insère une variable extérieure dans la fonction
    
    $sql = 'INSERT INTO client (last_name, first_name, phone_number, email, password)
        VALUES (?, ?, ?, ?, ?)';
        
    $query = $pdo->prepare($sql);
    $query->execute([$lastName, $firstName, $phone, $email, $password]);  // suivre l'ordre des points d'interrogation, pas des paramètres
}



// requête de type UPDATE
function updateClient($lastName, $firstName, $phoneNumber, $email, $password, $id)
{
    $pdo = getPDO();
    $sql = 'UPDATE client SET last_name = ?, first_name = ?, email = ?, phone_number = ?, password = ? WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$lastName, $firstName, $email, $phoneNumber, $password, $id]);
}


// requête de type DELETE
function deleteClient($id) // un param = un ? // la fonction a besoin de ces variables
{
    $pdo = getPDO();
    $sql = 'DELETE  FROM client WHERE Id = ?';

    $query=$pdo->prepare($sql);
    $query->execute([$id]);
}




/********************************************* ON S'OCCUPE DES COMMANDES ***/


function getOrders()
{
    $pdo = getPDO();
    $sql = "SELECT `order`.*, SUM(meal.price) as total FROM `order`
            INNER JOIN order_meal ON `order`.id = order_meal.order_id
            INNER JOIN meal ON meal.id = order_meal.meal_id
            GROUP BY `order`.id"; 

    $query = $pdo->prepare($sql);
    $query->execute();
    $resultats = $query->fetchAll(PDO::FETCH_ASSOC);
    
    return $resultats;
}


/* function getOrderDetails()
{
    $pdo = getPDO();
    $sql = "SELECT *
            FROM `order`
            WHERE ID = ?"; 

    $query = $pdo->prepare($sql);
    $query->execute();
    $orderDetail = $query->fetch(PDO::FETCH_ASSOC);
    
    return $orderDetail;
} */


function getUserByEmail($email)
{
    $pdo = getPDO();
    
    $sql = 'SELECT * FROM user WHERE email = :email';

    $query=$pdo->prepare($sql);
    $query->execute([':email' => $email]);
    
    $user = $query->fetch();
    
    return $user;
}


/**
 * ajoute un utilisateur dans la table USER
 * 
 * @param string $email L'adresse email du compte
 * @param string $hash Le password hashé
 * @param string $username
 * @param int $isAdmin qui est par défaut 0 mais on peut en faire un admin avec 1
 * 
 */ 
function addUser($email, $hash, $username, $isAdmin = 0)
{
    $pdo = getPDO();
    // technique avec marqueurs
    $query = $pdo->prepare('INSERT INTO user (email, password, username, admin)
                            VALUES (:e, :p, :u, :a)');
    $query->execute([
        ':e' => $email,
        ':p' => $hash,                    /* remplacé par le hash $password*/
        ':u' => $username,
        ':a' => $isAdmin
        
        ]);
}

// permet d'ajouter une commande dans la table order
function addOrder($lastName, $firstName, $email, $phoneNumber, $address, $postalCode, $city, $review)
{
    $pdo = getPDO();
        // Insertion de la commande
    $sql = 'INSERT INTO `order` (last_name, first_name, email, phone_number, address, postal_code, city, order_date, review)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)';
            
    $query = $pdo->prepare($sql);
    $query->execute([$lastName, $firstName, $email, $phoneNumber, $address, $postalCode, $city, $review]);
    
    // Récupération de l'identifiant de la commande    
    $id = $pdo->lastInsertId();
    return $id;
}

// permet d'ajouter un plat dans une commande 
function addMealToOrder($mealId, $id)
{
    $pdo = getPDO();
    
    $sql = 'INSERT INTO order_meal (meal_Id, order_Id) VALUES (?, ?)';
    
    $query = $pdo->prepare($sql);
    $query->execute([$mealId, $id]);
}