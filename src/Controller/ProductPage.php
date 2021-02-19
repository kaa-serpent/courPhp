<?php

namespace App\Controller;

use App\Core\Database;
use App\Query\ProductQuerry;

//include "";

class ProductPage extends AbstractController
{

    public function index():void
    {
       $this->render('Product/index');
       $ProductQuery = new ProductQuerry(new Database);
       $ProductQuery->getMethod();
    }
}