<?php
namespace app\services;

use app\models\Author;
use app\models\Book;
use app\modules\v1\forms\BookForm;
use DomainException;

class BookService
{
    
    private $_form;
    
    /**
     * AuthorService constructor.
     * @param BookForm $form
     */
    public function __construct(BookForm $form)
    {
        $this->_form = $form;
    }
    
    public function create()
    {
        $author = new Book();
        $author->name = $this->_form->name;
        $author->author_id = $this->_form->author_id;
        $author->genre_id = implode(',', $this->_form->genres);
        $author->publication_date = $this->_form->publication_date;
    
        if (!$author->save(false)) {
            throw new DomainException("$author->name save error");
        }
    }
}
