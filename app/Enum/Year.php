<?php 
namespace App\Enum;
use ReflectionEnum;

enum Year : string{
    case t20 = "2020"; 
    case t21 = "2021"; 
    case t22 = "2022"; 
    case t23 = "2023"; 
    case t24 = "2024"; 
    case t25 = "2025"; 
    case t26 = "2026"; 
    case t27 = "2027"; 
    case t28 = "2028"; 
    case t29 = "2029"; 
    case t30 = "2030"; 
    case t31 = "2031"; 
    case t32 = "2032"; 
    case t33 = "2033"; 
    case t34 = "2034"; 
    case t35 = "2035"; 

    public static function getCases(){
        return array_column(self::cases(),'value');
    }
}