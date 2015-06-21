<?php namespace Acme\Books;

use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract {

    public function transform(Book $book)
    {
        return [
            'id'     => (int) $book->id,
            'title' => $book->title,
            'published' => (boolean) $book->published,
            'date_published'  => (int) $book->date_published
        ];
    }
}