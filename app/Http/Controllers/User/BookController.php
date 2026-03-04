<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Setting;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('launch_date', '<=', now())
            ->latest('launch_date')
            ->paginate(9);

        return inertia('User/Book/Index', [
            'books' => $books,
        ]);
    }

    public function show($slug)
    {
        $setting = Setting::first();
        $book = Book::where('slug', $slug)
            ->where('launch_date', '<=', now())
            ->firstOrFail();

        $sessionKey = 'viewed_book_' . $book->id;
        if (!session()->has($sessionKey)) {
            $book->increment('views');
            session()->put($sessionKey, true);
        }

        $description = Str::limit(strip_tags($book->description), 150);

        return inertia('User/Book/Show', [
            'setting'     => $setting,
            'book'        => $book,
            'description' => $description,
            'current_url' => url()->current(),
            'app_url'     => rtrim($setting->site_url, '/'),
        ])->withViewData([
            'meta_title'       => $book->title . ' − ' . $setting->site_title,
            'meta_description' => $description,
            'meta_image'       => asset('storage/' . $book->image),
            'meta_url'         => url()->current(),
        ]);
    }
}
