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

    public function getAllProducts()
    {
        // requête sql
        $sql='
            SELECT *
            FROM api.produit
        ';
        
        $query = $this->connection->prepare($sql);
        $query->execute($args);

        return $query->fetchObject(User::class);
    }
    public function getOneProduct()
    {
        $sql='
            SELECT *
            FROM api.produit
            WHERE produit.nomProduit is $laVariable
        ';

        $query = $this->connection->prepare($sql);
        $query->execute($args);

        return $query->fetchObject(User::class);
    }
    public function addProduct()
    {
        $sql='
            INSERT INTO api.produit
            VALUES ($nomProduit, $typeProduit, $stockProduit, $prixProduit)
        ';

        $query = $this->connection->prepare($sql);
        $query->execute($args);

        return $query->fetchObject(User::class);
    }
    public function removeProduct()
    {

        $sql='
            DELETE FROM api.produit
            WHERE nomProduit IS $nomProduit 
        ';


        $query = $this->connection->prepare($sql);
        $query->execute($args);

        return $query->fetchObject(User::class);
    }
}
