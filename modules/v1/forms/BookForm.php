<?php

namespace app\modules\v1\forms;

use app\components\Form;

class BookForm extends Form
{
    public string $name;
    public array $genres;
    public string $author_id;
    public int $publication_date;
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            ['author_id', 'integer'],
            [['name', 'genres', 'author_id', 'publication_date'], 'required'],
            ['publication_date', 'safe']
        ];
    }
}
