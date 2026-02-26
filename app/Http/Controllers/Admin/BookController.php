<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::when(request()->q, function ($query) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request()->q . '%')
                  ->orWhere('description', 'like', '%' . request()->q . '%');
            });
        })->latest()->paginate(10);

        $books->appends(['q' => request()->q]);

        return inertia('Admin/Book/Index', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        return inertia('Admin/Book/Create', []);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|unique:books,title',
            'id_book'     => 'required|unique:books,id_book',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'author'      => 'required',
            'launch_date' => 'required',
            'total_pages' => 'required',
            'description' => 'nullable',
        ], [
            'title.unique'     => 'Judul sudah digunakan. Gunakan judul lain.',
            'id_book.unique'   => 'ID gdrive sudah digunakan. Gunakan yang lain.',
            'image.required'   => 'Gambar tidak boleh kosong.',
            'image.image'      => 'Gambar buku harus berupa file gambar.',
            'image.mimes'      => 'Gambar buku harus berekstensi jpg, jpeg, atau png.',
            'image.max'        => 'Ukuran gambar buku maksimal 10MB.',
        ]);

        $path_image = $request->file('image')->store('books', 'public');

        Book::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'id_book'     => $request->id_book,
            'image'       => $path_image,
            'author'      => $request->author,
            'launch_date' => $request->launch_date,
            'total_pages' => $request->total_pages,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.books.index');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $book->image_name = basename($book->image);
        $book->image_size = Storage::disk('public')->size($book->image);

        return inertia('Admin/Book/Edit', [
            'book'        => $book,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'       => 'required|unique:books,title,' . $book->id,
            'id_book'     => 'required|unique:books,id_book,' . $book->id,
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'author'      => 'required',
            'launch_date' => 'required',
            'total_pages' => 'required',
            'description' => 'nullable',
        ], [
            'title.unique'     => 'Judul sudah digunakan. Gunakan judul lain.',
            'id_book.unique'   => 'ID gdrive sudah digunakan. Gunakan yang lain.',
            'image.image'      => 'Gambar buku harus berupa file gambar.',
            'image.mimes'      => 'Gambar buku harus berekstensi jpg, jpeg, atau png.',
            'image.max'        => 'Ukuran gambar buku maksimal 10MB.',
        ]);

        $path_image = $book->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('books', 'public');
        }

        $book->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'id_book'     => $request->id_book,
            'image'       => $path_image,
            'author'      => $request->author,
            'launch_date' => $request->launch_date,
            'total_pages' => $request->total_pages,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.books.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index');
    }
}
