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
    public function getTypeProduitt():String{return $this ->typeProduit;}
    public function getStockProdui():int{return $this ->stockProdui;}
}