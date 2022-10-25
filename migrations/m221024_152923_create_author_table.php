<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m221024_152923_create_author_table extends Migration
{
    private string $tableName = '{{%author}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'country' => $this->string()->notNull()
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
