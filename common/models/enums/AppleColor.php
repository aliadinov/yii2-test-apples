<?php

namespace common\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class AppleColor extends BaseEnum
{
    const GREEN = 1;
    const RED   = 2;
    const MULTI = 3;

    /**
     * @var array
     */
    public static $list = [
        self::GREEN => 'Зеленый',
        self::RED   => 'Красный',
        self::MULTI => 'Зелено-красный',
    ];

    public static function getRandomColor(): int
    {
        return array_rand(self::$list);
    }
}
