<?php


namespace shop\helpers;


use shop\entities\Shop\Characteristic;
use yii\helpers\ArrayHelper;

class CharacteristicHelper
{
    public static function typeList(): array
    {
        return[
            Characteristic::TYPE_STRING => 'Строка',
            Characteristic::TYPE_INTEGER => 'Целое число',
            Characteristic::TYPE_FLOAT => 'Число с точкой',
        ];
    }

    public static function typeName($type): string
    {
        return ArrayHelper::getValue(self::typeList(), $type);
    }

}