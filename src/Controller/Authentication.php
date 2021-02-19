<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Core\Database;
use App\Query\UserQuery;
use App\Service\JWT;

class Authentication extends AbstractController
{
    private UserQuery $userQuery;
    private JWT $jwt;
    public function __construct(UserQuery $userQuery, JWT $jwt )
    {
      $this->userQuery = $userQuery;
      $this->jwt = $jwt;
    }

    public function index():void
    {
      // récupéraction du corp de la requête
    $body = json_decode(file_get_contents('php://input'));

    $userQuery = new UserQuery( new Database() );
    
    
    //authentification
    $authentication = false;
    if($body){
      $authentication = $userQuery->checkUser($body->login, $body->password);
      var_dump($authentication);
    }else {
      // si aucun corp de requête n'a été envoyé
      $this->renderJSON(
        'Bad request',
        [],
        400
      );
      return;
    }

    // si l'authentificatoin a réussie
    if($authentication){
      $this->renderJSON(
        'Autehtication succes',
        [
          'access_token' => $this->jwt->generate(),
        ]
        );
    }else {
      $this->renderJSON(
        'Unauthorized',
        [],
        401
      );
    }
  


    }
}