<?php

namespace App\Core;

use App\Controller\Authentication;
use App\Controller\NotFound;
use App\Query\ProductQuerry;
use App\Query\UserQuery;
use App\Service\JWT;
/*
    container d'instances des classes utilisées dans l'application
    cette classe revoie les instances
*/
class Container
{
    static public function getInstance(String $namespace)
    {
        /*
            fontion qui est utilsé pour différer l'instanciation
        */
        $instances = [
            NotFound::class => function () {
                return new \App\Controller\NotFound();
            },
            'App\Controller\Homepage' => function () {
                return new \App\Controller\Homepage();
            },
            'App\Core\Routing' => function () {
                return new \App\Core\Routing();
            },
            'App\Core\Database' => function () {
                return new \App\Core\Database();
            },
            'App\Core\Dotenv' => function () {
                return new \App\Core\Dotenv();
            },
            User::class => function () {
                return new \App\Model\User();
            },
            
            Authentication::class => function () {
                return new \App\Controller\Authentication(
                   self::getInstance( 'App\Query\UserQuery'),
                   self::getInstance(JWT::class),
                );
            },
            JWT::class => function () {
                return new \App\Service\JWT();
            },
            'App\Query\ProductQuerry' => function () {
                return new \App\Query\productQuerry(
                    self::getInstance('App\Core\Database'),
                );
            },            
            'App\Query\UserQuery' => function () {
                return new \App\Query\UserQuery(
                    self::getInstance('App\Core\Database'),
                );
            }
        ];
        return $instances[$namespace]();
    }
}
