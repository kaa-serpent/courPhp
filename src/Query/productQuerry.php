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
                $this -> addProduct();
                break;
            case "GET":
                $this -> getAllProducts();
                break;
            case "PUT":
                $this -> modifyProduct();
                break;
            case "DELETE":
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
        echo json_encode($query->fetchObject(Product::class));
        return $query->fetchObject(Product::class);
    }

//put
    public function modifyProduct()
    {
        $body = json_decode(file_get_contents('php://input'));
        $sql="
            UPDATE amazonne.produit
            SET nomProduit = :nomProduit,
                typeProduit = :typeProduit,
                stockProduit = :stockProduit,
                prixProduit = :prixProduit
            WHERE produit.nomProduit LIKE :nomProduit
        ";

        $query = $this->connection->prepare($sql);
        $query->execute([
            'nomProduit'=> $body->nomProduit,
            'typeProduit'=>$body->typeProduit,
            'stockProduit'=>$body->stockProduit,
            'prixProduit'=>$body->prixProduit
        ]);

        return $query->fetchObject(Product::class);
    }

    public function addProduct()
    {
        
        $body = json_decode(file_get_contents('php://input'));
        $sql="
            INSERT INTO amazonne.produit (nomProduit, typeProduit, stockProduit, prixProduit)
            VALUES (:nomProduit, :typeProduit, :stockProduit, :prixProduit)
        ";
//$nomProduit, $typeProduit, $stockProduit, $prixProduit)
        $query = $this->connection->prepare($sql);
        $query->execute([
            'nomProduit'=> $body->nomProduit,
            'typeProduit'=>$body->typeProduit,
            'stockProduit'=>$body->stockProduit,
            'prixProduit'=>$body->prixProduit
        ]);

        return $query->fetchObject(Product::class);
    }

//DELETE
    public function removeProduct()
    {
        $body = json_decode(file_get_contents('php://input'));
        $sql="
            DELETE FROM amazonne.produit
            WHERE nomProduit LIKE :nomProduit 
        ";

        $query = $this->connection->prepare($sql);
        $query->execute([
            'nomProduit'=> $body->nomProduit
        ]);

        return $query->fetchObject(Product::class);
    }
}
