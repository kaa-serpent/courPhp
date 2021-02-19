<?php

namespace App\Controller;

use App\Controller\AbstractController; // on est dans le meme espace de nom donc cette ligne est obtionelle 
use DateInterval;

class Homepage extends AbstractController
{
    /* id est une variable
     public function index(int $id):void
    {
       $this->render('homepage/index', [
           'message' => $id,
       ]);
    }*/

    public function index():void
    {
       $this->render('homepage/index');
    }
}