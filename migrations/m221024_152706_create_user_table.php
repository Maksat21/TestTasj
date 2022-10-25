<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m221024_152706_create_user_table extends Migration
{
    private string $tableName = '{{%user}}';
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->unique(),
            'role' => $this->tinyInteger(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'avatar' => $this->string(),
            
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'verification_token' => $this->string()->defaultValue(null),
            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(10),
        ]);
    
        $this->insert($this->tableName, [
            'role' => '1',
            'username' => 'admin',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'auth_key' => 'knrFK88QyEjIBMga3UlpuTeHyygLMMqk',
            'password_hash' => '$2y$13$HQXwsLWTYwXrLy/Dd5hLT.shamK/T1VnshuRPZzjBMLhItoqFXOym',
            'status' => '10',
            'created_at' => Yii::$app->formatter->asTimestamp(date('Y-m-d h:i:s')),
            'updated_at' => Yii::$app->formatter->asTimestamp(date('Y-m-d h:i:s')),
        ]);
    
        $this->insert($this->tableName, [
            'role' => '2',
            'username' => 'customer',
            'first_name' => 'customer',
            'last_name' => 'customer',
            'auth_key' => 'knrFK88QyEjIBMga3UlpuTeHyygLMMqk',
            'password_hash' => '$2y$13$HQXwsLWTYwXrLy/Dd5hLT.shamK/T1VnshuRPZzjBMLhItoqFXOym',
            'status' => '10',
            'created_at' => Yii::$app->formatter->asTimestamp(date('Y-m-d h:i:s')),
            'updated_at' => Yii::$app->formatter->asTimestamp(date('Y-m-d h:i:s')),
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
