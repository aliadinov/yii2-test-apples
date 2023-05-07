<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * @property int $id [int]
 * @property int $color [smallint]
 * @property int $status [smallint]
 * @property string $size [decimal(10)]
 * @property int $created_at [timestamp]
 * @property int $fallen_at [timestamp]
 */
class Apple extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%apples}}';
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
