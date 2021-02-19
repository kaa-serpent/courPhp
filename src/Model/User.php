<?php

namespace App\Model;



class User
{
    private int $id;
    private String $login;
    private String $password;

    public function getId():int{return $this ->id;}
    public function getLogin():String{return $this ->login;}
    public function getPassword():String{return $this ->password;}

    public function setLogin(String $value):void {$this->login = $value;}
    public function setPassword(String $value):void {$this->Password = $value;}
}