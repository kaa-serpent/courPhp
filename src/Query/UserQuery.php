<?php

namespace App\Query;

use App\Core\Database;
use App\Model\User;
use PDO;

class UserQuery
{
    /*
        injection de dépendances : gerer les dépandance entre les objets
        injection par le constructeur :
            - créer une propriété de même type que la classe à injecter
            - créer le constructeur avec un paramètre du même type que la propriété
            -dans le constructeur, liaison entre la propriété et le paramètre du constructeur    */
    private PDO $connection;

    public function __construct(Database $database)
    {
        // récupération de la connexion à la base de données
        $this->connection = $database->connect();
    }
    //requête avce des conditions sur les valeurs des colonnes
    //select user.* from api.user where user.login ='admin';
    public function findOneBy(array $args = []):User|bool
    {
        // requête sql
        $sql='
            SELECT user.*
            FROM api.user
            WHERE 
        ';

        // select from user.* from api.user where auser.login = :login

        /*
            requête préparée : évaluation de la sécutité de la requête
            création de variable dans la requête avec : 
        */ 

        foreach($args as $column => $value) {
            $sql .= "
                user.$column = :$column
            ";
        }

        $sql .= ';';

        // préparation de la requête
        $query = $this->connection->prepare($sql);

        //exécution de la requête
        //donner des valeurs aux variables de requête avec un array associatif
        $query->execute($args);

        /*
        récupération des résultats
            fechOject: permet d'associer les données à un modèle
            models > récupérter un résulta unique
            fechAll: récupérer plusieur résultats
        */
        $result = $query->fetchObject(User::class);

        // retour du résultat
        return $result;
    }

    // vérifier si l'extence de l'utilisateur et le mdp
    public function checkUser(String $login, String $password):bool
    {
        // récécupérer l'utilisateur
        $user = $this->findOneBy([
            'login' => $login,
        ]);

        /*
            password_verify : vérifier le mdp
            hachage du mdp
        */
        if($user && password_verify($password, $user->getPassword()))
        {
            return true;
        }
        return false;
    }

}