<?php

namespace App\Model;

class Product
{
    private int $id;
    private String $nomProduit;
    private String $typeProduit;
    private int $stockProduit;
    private int $prixProduit;

    public function getId():int{return $this ->id;}
    public function getNomProduit():String{return $this ->nomProduit;}
    public function getTypeProduit():String{return $this ->typeProduit;}
    public function getStockProduit():int{return $this ->stockProduit;}
    public function getPrixProduit():int{return $this ->prixProduit;}

    public function setNomProduit(String $value):void {$this->nomProduit = $value;}
    public function setTypeProduit(String $value):void {$this->typeProduit = $value;}
    public function setStockProduit(int $value):void {$this->stockProduit = $value;}
    public function setPrixProduit(String $value):void {$this->prixProduitt = $value;}

  

}