<?php

namespace app\components;

use DomainException;
use yii\base\Model;

/**
 * Class Form
 * @package app\components
 */
class Form extends Model
{
    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->getErrorSummary(true)[0];
    }

    /**
     * @param $params
     */
    public function loadAndValidate($params, $formName = ''){
        $this->load($params, $formName);
        if (!$this->validate()) {
            throw new DomainException($this->getErrorMessage());
        }
    }
}