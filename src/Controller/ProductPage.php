<?php

namespace App\Controller;



class ProductPage extends AbstractController
{
    public function index():void
    {
       $this->render('Product/index');
    }
}