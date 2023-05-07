<?php

namespace common\repositories;

use common\models\Apple;

class AppleRepository
{
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
}