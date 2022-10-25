<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre}}`.
 */
class m221024_152947_create_genre_table extends Migration
{
    private string $tableName = '{{%genre}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
