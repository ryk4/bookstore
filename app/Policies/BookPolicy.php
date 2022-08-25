<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function update(User $user, Book $book): bool
    {
        if ($user->isAdmin() || $user->id === $book->user_id) {
            return true;
        }

        return false;
    }
}
