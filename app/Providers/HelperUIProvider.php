<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\ServiceProvider;

class HelperUIProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View()->composer('layouts.leftbar', function ($view) {

            $count_not_approved = Book::where('status',0)->get()->count();
            $count_approved = Book::where('status',1)->get()->count();

            $view->with('not_approved_count',$count_not_approved)
                ->with('approved_count',$count_approved);
        });

        View()->composer('book.edit', function ($view) {

            $available_genres = Genre::orderBy('id')->get();

            $view->with('available_genres',$available_genres);
        });
    }
}
