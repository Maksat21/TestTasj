<?php

namespace app\modules\v1\forms;

use app\components\Form;

class AuthorForm extends Form
{
    public string $name;
    public string $country;
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'country'], 'string'],
            [['name', 'country'], 'required'],
        ];
    }
}
