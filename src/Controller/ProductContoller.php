<?php

namespace App\Controller;



class ProductController extends AbstractController
{
    public function index():void
    {
       $this->render('Product/index');
    }
}