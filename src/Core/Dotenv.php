<?php

namespace App\Core;

class Dotenv
{
    static public function load(): void
    {
        //file : charger un fichier; créer un array ou chaque ligne devient une entrée
        $file = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES);

        // parcourir le tableau pour insérer les variables dans $_ENV
        array_map(function ($line) {
            /* séparation entre la clé et la valeur
             crée un array 
                indice 0 : clé
                indice 1 :valeur
            */
            $result = explode('=', $line);
            //echo '<pre>'; var_dump($result); echo '</pre>'; exit;

            //remplir les variables d'environemment $_ENV
            $_ENV[$result[0]] = $result[1];
        }, $file);
    }
}
