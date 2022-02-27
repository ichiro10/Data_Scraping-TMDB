<?php
function cumul(float $somme , float $taux , float $durée){
     $cumul= $somme * pow((1 + $taux/100) , $durée);

    return $cumul;
}
