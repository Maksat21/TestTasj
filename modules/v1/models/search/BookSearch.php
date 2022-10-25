<?php

namespace app\modules\v1\models\search;

use app\models\Book;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class BookSearch
 * @package app\modules\v1\models\search
 */
class BookSearch extends Model
{
    public $author_id;
    public $genre_id;
    public $publication_date;
    public $country;

    /**
     * @return string
     */
    public function formName()
    {
        return '';
    }

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['author_id', 'genre_id'], 'integer'],
            [['country'], 'string'],
            ['publication_date', 'safe']
        ];
    }

    /**
     * @param $params
     * @param int $pageSize
     * @return ActiveDataProvider
     */
    public function search($params, $pageSize = 10)
    {
        $this->load($params);

        $query = Book::find()
            ->leftJoin('author','author.id = book.author_id');
        
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        if (!$this->validate()) {
            $query->where('0=1');
            return $provider;
        }

        $query->andFilterWhere([
            'author_id' => $this->author_id,
            'country' => $this->country
        ]);
        
        
        $query->andFilterWhere([
           'like', 'genre_id', $this->genre_id
        ]);
        

        $query->andFilterWhere(['=', 'publication_date', $this->publication_date]);

        return $provider;
    }
}
