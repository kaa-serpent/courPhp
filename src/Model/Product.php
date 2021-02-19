<?php

namespace App\Model;

class ProductController
{
    private int $id;
    private String $nomProduit;
    private String $typeProduit;
    private String $stockProduit;
    private int $prixProduit;

    public function getId():int{return $this ->id;}
    public function getNomProduit():String{return $this ->nomProduit;}
    public function getTypeProduit():String{return $this ->typeProduit;}
    public function getStockProduit():int{return $this ->stockProdui;}
}