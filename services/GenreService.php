<?php
namespace app\services;

use app\models\Author;
use app\models\Genre;
use app\modules\v1\forms\GenreForm;
use DomainException;

class GenreService
{
    
    private $_form;
    
    /**
     * AuthorService constructor.
     * @param GenreForm $form
     */
    public function __construct(GenreForm $form)
    {
        $this->_form = $form;
    }
    
    public function create()
    {
        $author = new Genre();
        $author->name = $this->_form->name;
    
        if (!$author->save(false)) {
            throw new DomainException("Genre $author->name save error");
        }
    }
}
