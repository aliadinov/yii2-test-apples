<?php

namespace common\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class AppleStatus extends BaseEnum
{
    const ON_TREE      = 1;
    const ON_GROUND    = 2;
    const ROTTEN_APPLE = 3;

    /**
     * @var array
     */
    public static $list = [
        self::ON_TREE      => 'На дереве',
        self::ON_GROUND    => 'На земле',
        self::ROTTEN_APPLE => 'Гнилое яблоко',
    ];
}
