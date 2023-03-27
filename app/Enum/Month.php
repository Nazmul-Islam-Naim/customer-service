<?php
namespace App\Enum;
use Illuminate\Validation\Rules\Enum;
use ReflectionEnum;
enum Month: string {
    case January = 'January';
    case February = 'February';
    case March = 'March';
    case April = 'April';
    case May = 'May';
    case June = 'June';
    case July = 'July';
    case August = 'August';
    case September = 'September';
    case October = 'October';
    case November = 'November';
    case December = 'December';

    public static function getCases(){
        return array_column(self::cases(),'value');
    }
}