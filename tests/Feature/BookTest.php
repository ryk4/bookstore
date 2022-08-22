<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_book_index_displays_books_correctly()
    {
        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
        $response->assertSeeText('BookStore.lt');
        $response->assertSeeText('Available books');
    }
}
