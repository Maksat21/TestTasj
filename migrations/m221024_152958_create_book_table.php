<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m221024_152958_create_book_table extends Migration
{
    private string $tableName = '{{%book}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'author_id' => $this->integer(),
            'genre_id' => $this->string(),
            'publication_date' => $this->integer()->notNull(),
        ]);
    
        // fk
        $this->addForeignKey('fk-book-author_id', $this->tableName, 'author_id', '{{%author}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
