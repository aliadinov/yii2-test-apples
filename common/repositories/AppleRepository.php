<?php

namespace common\repositories;

use common\models\Apple;
use common\models\enums\AppleStatus;
use Yii;
use yii\db\Expression;

class AppleRepository
{
    public function finById(int $appleId): ?Apple
    {
        return Apple::findOne($appleId);
    }

    public function save(Apple $apple): bool
    {
        return $apple->save();
    }

    public function delete(Apple $apple): false|int
    {
        return $apple->delete();
    }

    public function deleteAll(): void
    {
        Yii::$app->db->createCommand()->truncateTable(Apple::tableName())->execute();
    }

    public function getAll(): array
    {
        return Apple::find()->all();
    }

    public function markRottenApples(int $rottenIntervalSeconds): int
    {
        return Apple::updateAll([
            'status' => AppleStatus::ROTTEN
        ], ['AND',
            ['=', 'status', AppleStatus::ON_GROUND],
            ['<', 'fallen_at', new Expression("NOW() - INTERVAL $rottenIntervalSeconds SECOND")]
        ]);
    }
}