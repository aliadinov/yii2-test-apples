<?php

use yii\db\Migration;

/**
 * Class m230507_160000_apples
 */
class m230507_160000_apples extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apples}}', [
            'id'          => $this->primaryKey(),
            'color'       => $this->smallInteger()->notNull(),
            'status'      => $this->smallInteger()->notNull(),
            'size'        => $this->decimal()->notNull()->defaultValue(100),
            'created_at'  => $this->timestamp(),
            'fell_at'     => $this->timestamp()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%apples}}');
    }
}
