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
                $this -> removeProduct();
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

        return $query->fetchObject(Product::class);
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

        return $query->fetchObject(Product::class);
    }

//PUT
    public function addProduct()
    {
        $nomProduit = htmlspecialchars($_POST["nomProduit"]);
        $typeProduit = htmlspecialchars($_POST["typeProduit"]);
        $stockProduit = htmlspecialchars($_POST["stockProduit"]);
        $prixProduit = htmlspecialchars($_POST["prixProduit"]);
        $sql="
            INSERT INTO amazonne.produit (nomProduit, typeProduit, stockProduit, prixProduit)
            VALUES ($nomProduit, $typeProduit, $stockProduit, $prixProduit)
        ";

        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchObject(Product::class);
    }

//DELETE
    public function removeProduct()
    {
        $nomProduit = file_get_contents('php://input');
        $sql="
            DELETE FROM amazonne.produit
            WHERE nomProduit LIKE $nomProduit 
        ";

        $query = $this->connection->prepare($sql);
        $query->execute();

        return $query->fetchObject(Product::class);
    }
}
