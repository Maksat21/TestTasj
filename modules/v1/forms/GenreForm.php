<?php

namespace app\modules\v1\forms;

use app\components\Form;

class GenreForm extends Form
{
    public string $name;
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['name'], 'required'],
        ];
    }
}
