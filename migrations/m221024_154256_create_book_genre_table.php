<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_genre}}`.
 */
class m221024_154256_create_book_genre_table extends Migration
{
    private string $tableName= '{{%book_genre}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'genre_id' => $this->integer(),
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
