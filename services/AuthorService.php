<?php
namespace app\services;

use app\models\Author;
use app\modules\v1\forms\AuthorForm;
use DomainException;

class AuthorService
{
    
    private $_form;
    
    /**
     * AuthorService constructor.
     * @param AuthorForm $form
     */
    public function __construct(AuthorForm $form)
    {
        $this->_form = $form;
    }
    
    public function create()
    {
        $author = new Author();
        $author->name = $this->_form->name;
        $author->country = $this->_form->country;
    
        if (!$author->save(false)) {
            throw new DomainException("Author $author->name save error");
        }
    }
}
