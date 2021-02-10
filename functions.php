<?php

function formatPrice(float $preco){
    return number_format($preco, 2, ",", ".");
}

?>