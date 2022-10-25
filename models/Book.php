<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $author_id
 * @property string|null $genre_id
 * @property string|null $publication_date
 * @property Author[] $author
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['publication_date'], 'safe'],
            [['name', 'genre_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author_id' => 'Author ID',
            'genre_id' => 'Genre ID',
            'publication_date' => 'Publication Date',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
    
    public function getGenres()
    {
        $genres = [];
        foreach (explode(',', $this->genre_id) as $genre) {
            $item = Genre::findOne($genre)->name;
            $genres[] = $item;
        }
        return implode(',', $genres);
    }
}
