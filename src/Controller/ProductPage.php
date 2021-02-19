<?php

namespace App\Controller;

use App\Query\ProductQuerry;

class ProductPage extends AbstractController
{
    public function index():void
    {
       //$this->render('Product/index');
       $this->getMethod();
    }
}