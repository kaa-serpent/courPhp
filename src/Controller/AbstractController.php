<?php

namespace App\Controller;

abstract class AbstractController
{
    protected function render(String $view, array $data = [], String $title = 'API'):void
    {
        // extract : permet de convertir les clés d'un tableu assotiatif en variablz
        // ['key' => 10] > $key = 10 
        extract($data);

        // afficher de la vue situee dans le dossier templates
        // __DIR__ :  constance qui revoie le dossier actif
        require_once __DIR__ . "/../../templates/$view.php";
    }

    protected function renderJSON(string $message, array $data = [], int $statusCode = 200):void
    {
        // code HTTP
        http_response_code($statusCode);

        // en-tête CORS (Cross Origin Resource Sharing)
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Method: POST, GET, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Header:Content-Type, Authorization');

        // affichage du JSON
        echo json_encode([
            'message' => $message,
            'data'=>$data,
        ]);
    }
}