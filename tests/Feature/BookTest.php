<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BookTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'user_level' => User::ROLE_ADMIN
        ]);
    }

    public function test_book_index_displays_books_correctly()
    {
        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
        $response->assertSeeText('BookStore.lt');
        $response->assertSeeText('Available books');
    }

    public function test_book_create_only_accessible_by_auth_user()
    {
        $response = $this->get(route('books.create'));
        $response->assertStatus(403);
    }

    public function test_book_store_redirects_back_if_validation_fails()
    {
        $data = [
            'description' => 'test description',
            'price' => 100,
            'discount' => 10,
            'authors' => 'author 1, author 2',
            'genres' => 'Romance,History'
        ];

        $response = $this->actingAs($this->user)->post(route('books.store', $data));
        $response->assertStatus(302);
        $response->assertInvalid(['title']);
    }

    public function test_book_store_is_successful()
    {
        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'price' => 100,
            'discount' => 10,
            'authors' => 'author 1, author 2',
            'genres' => ['Romance', 'History']
        ];

        $response = $this->actingAs($this->user)->post(route('books.store', $data));
        $response->assertStatus(302);
        $response->assertRedirect(route('books.index'));

        self::assertDatabaseHas('books', ['title' => $data['title'], 'description' => $data['description']]);
    }

    public function test_book_update_is_successful()
    {
        $book = Book::first();

        $data = [
            'title' => 'new test title',
            'description' => $book->description,
            'price' => $book->price,
            'discount' => $book->discount,
            'authors' => 'author 3, author 4',
            'genres' => $book->genres->toArray()
        ];

        $response = $this->actingAs($this->user)->put(route('books.update', $book), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('books.index'));

        self::assertDatabaseHas('books', ['title' => $data['title'], 'description' => $data['description']]);
    }

    public function test_book_edit_cannot_be_accessed_by_another_user()
    {
        $user1 = User::factory()->create(['user_level' => User::ROLE_NORMAL]);

        $user2 = User::factory()->create(['user_level' => User::ROLE_NORMAL]);

        $book = Book::factory()->create([
            'user_id' => $user2->id
        ]);

        $response = $this->actingAs($user1)->get(route('books.edit', $book));
        $response->assertStatus(403);
    }

    public function test_book_edit_can_be_accessed_by_admin_who_doesnt_own_the_book()
    {
        $user1 = User::factory()->create(['user_level' => User::ROLE_ADMIN]);

        $user2 = User::factory()->create(['user_level' => User::ROLE_NORMAL]);

        $book = Book::factory()->create([
            'user_id' => $user2->id
        ]);

        $response = $this->actingAs($user1)->get(route('books.edit', $book));
        $response->assertStatus(200);
        $response->assertSee($book->title);
    }

    public function test_book_delete()
    {
        $book = Book::first();

        $response = $this->actingAs($this->user)->delete(route('books.destroy', $book));
        self::assertDatabaseMissing('books', ['id' => $book->id, 'title' => $book->title]);
        $response->assertStatus(302);
    }
}
