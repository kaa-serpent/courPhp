<?php

/*
    Auto-chargement des classes
    App: dossier src, dosier contenant toutes les classe de
    l'application, spécifié dans le composer.json
    Core : dossier src/Core
*/

namespace App\Core;

/*
    le Routing doit trouver l'URL et trouver le controller
    et la méthode, telié a la route (l'URL)
*/
class Routing
{
    /*
        lister toutes les routes de l'application
            clé : la route
            valuer : array conteant le noù du controler et
            le nom de la méthode
    */
    private array $routes = [
        '/'=> [
            'controller' => 'Homepage',
            'method' => 'index',
        ],
        '/auth' => [
            'controller' => 'Authentication',
            'method'=> 'index'
        ],
        '/api/v1/products' => [
            'controller' => 'Product',
            'method'=> 'index'
        ],
        /*
         utilisation d'une expresion rationnelle
            () : création d'un goupe
            \d : chiffre
            + : 1 ou plusieurs
            ?<..> : nommer le groupe
         
        '/(?<id>\d+)'=> [
            'controller' => 'Homepage',
            'method' => 'index',
            'vars' => [],
        ],
        */
    ];

    // retrouver le controler et la méthode
    public function getRouteInfo():array
    {
        // récuper la route (URL)
        $uri = $_SERVER['REQUEST_URI'];

        //résultat de la recherche
        $result = [
            'controller' => 'NotFound',
            'method' => 'index',
            'vars' => [],
        ];

        //tester si la route est listé
        foreach($this->routes as $regexp => $infos)
        {
            /*
            preg_mach : tester la concordance avec une
            expression rationnelle , 3 parametre
                - expresion rationnelle
                - chaine a carateres a tester
                - récupération des groupes
            */ 
            if(preg_match("#^$regexp$#", $uri, $groupes))
            {
                $result = $infos;
                $result['vars'] = $groupes;

                // stopper la boucle

                break;
            }
        }

        // dans les groupes des exprésions rationnelles, ne conserver que les clés nom numérique
        foreach($result['vars'] as $key => $value){
            //unset : supprimer un entré dans un array
            if(is_int($key)){
                unset($result['vars'][$key]);
            }
        }


         /* rechecher la route dans la liste route
            if(array_key_exists($uri, $this->routes)){
                $result = $this->routes[$uri];
            }
        */
            
          return $result;  
        
    }
}