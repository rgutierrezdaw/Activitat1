<?php
declare(strict_types=1);

function sum(int $number1, int $number2):int{
    return $number1+$number2;
}

function fact(int $value):int{
    $fact = 1;
    for($i = 1; $i <= $value; $i++){
        $fact *= $i;
    }
    return $fact;
}

function prime(int $value):bool{
    if($value % 2 == 0 && $value != 2){
        return false;
    } else{
        if($value == 2){
            return true;
        } else{
            $maxdiv= sqrt($value);
            for ($x = 3; $x <= $maxdiv; $x+=2){
                    if($value % $x == 0){
                        return false;
                    }
                }
                return true;
            }
        }
    }


function performOperation($operation, int $value1, int $value2=0){
    switch ($operation){
        case "sum":
            return "El resultat és".sum($value1, $value2);
        break;
        case "factorial":
            return "El factorial de ".$value1." es: ".fact($value1);
        break;
        case "prime":
            if(prime($value1)==true){
                return "El nombre es primer";
            }else{return "El nombre no és primer";}
        break;
    }
}

?>