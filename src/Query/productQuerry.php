<?php
namespace App\Query;

use App\Model\Product;
use App\Core\Database;
use PDO;

class ProductQuerry{


    private PDO $connection;

    public function __construct(Database $database)
    {
        // récupération de la connexion à la base de données
        $this->connection = $database->connect();
        
    }

    public function getMethod():void{
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                echo "POST";
                $this -> getAllProducts();
                break;
            case "GET":
                echo "GET";
                $this -> getAllProducts();
                break;
            case "PUT":
                echo "PUT";
                $this -> getAllProducts();
                break;
            case "DELETE":
                echo "DELETE";
                $this -> getAllProducts();
                break;
        }
    }
    
    public function getAllProducts()
    {
        // requête sql
        $sql="
            SELECT *
            FROM amazonne.produit
        ";
        
        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchObject(User::class);
    }

//post
    public function getOneProduct($nomProduit)
    {
        $sql="
            SELECT *
            FROM amazonne.produit
            WHERE produit.nomProduit LIKE $nomProduit
        ";

        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchObject(User::class);
    }

//PUT
    public function addProduct($nomProduit, $typeProduit, $stockProduit, $prixProduit)
    {
        $sql="
            INSERT INTO amazonne.produit (nomProduit, typeProduit, stockProduit, prixProduit)
            VALUES ($nomProduit, $typeProduit, $stockProduit, $prixProduit)
        ";

        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchObject(User::class);
    }

//DELETE
    public function removeProduct($nomProduit)
    {
        $sql="
            DELETE FROM amazonne.produit
            WHERE nomProduit LIKE $nomProduit 
        ";

        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchObject(User::class);
    }
}
