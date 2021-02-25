<?php
use \Portfol\Model\User;
use \Portfol\Model\Cliente;

function formatPrice(float $preco){
    if (!$preco > 0) $preco = 0;
    return number_format($preco, 2, ",", ".");
}

function checkLogin($inadmin = true){
    return User::checkLogin($inadmin);
}

function getUserName(){
    $user = User::getFromSession();
    return $user->getNOME_USUARIO();
}

function getUserId(){
    $user = User::getFromSession();
    return $user->getID_USUARIO();
}

?>