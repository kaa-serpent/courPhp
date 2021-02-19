<?php

namespace App\Core;

use App\Controller\Authentication;
use App\Controller\NotFound;
use App\Query\ProductQuerry;
use App\Query\UserQuery;
use App\Service\JWT;
use App\Model\Product;
use App\Controller\ProductPage;
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

            Product::class => function () {
                return new \App\Model\Product();
            },
            ProductPage::class => function () {
                return new \App\Controller\ProductPage();
            },
            Authentication::class => function () {
                return new \App\Controller\Authentication(
                    self::getInstance('App\Query\UserQuery'),
                    self::getInstance(JWT::class),
                );
            },
            JWT::class => function () {
                return new \App\Service\JWT();
            },

        ];
        return $instances[$namespace]();
    }
}
