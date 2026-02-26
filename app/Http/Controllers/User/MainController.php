<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Message;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke(Request $request)
    {
        $blogs = Blog::where('status', 'published')->latest()->take(7)->get();
        
        $latestBlogs = $blogs->take(3)->values();
        $recentBlogs = $blogs->slice(3)->values();

        $books = Book::where('launch_date', '<=', now())
            ->latest('launch_date')
            ->take(3)
            ->get();

        return inertia('User/Index', [
            'latestBlogs' => $latestBlogs,
            'recentBlogs' => $recentBlogs,
            'books' => $books,
        ]);
    }

    public function message(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}
