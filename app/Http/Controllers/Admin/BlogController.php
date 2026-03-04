<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::when(request()->q, function ($query) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request()->q . '%')
                  ->orWhere('content', 'like', '%' . request()->q . '%');
            });
        })->latest()->paginate(10);

        $blogs->appends(['q' => request()->q]);

        return inertia('Admin/Blog/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function create()
    {
        $api_tinymce_key = Setting::value('api_tinymce_key');

        return inertia('Admin/Blog/Create', [
            'api_tinymce_key' => $api_tinymce_key,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|unique:blogs,title',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'content'     => 'required',
            'status'      => 'required',
        ], [
            'title.unique'     => 'Judul sudah digunakan. Gunakan judul lain.',
            'image.required'   => 'Gambar tidak boleh kosong.',
            'image.image'      => 'Gambar blog harus berupa file gambar.',
            'image.mimes'      => 'Gambar blog harus berekstensi jpg, jpeg, png, atau webp.',
            'image.max'        => 'Ukuran gambar blog maksimal 10MB.',
            'content.required' => 'Konten tidak boleh kosong.',
            'status.required'  => 'Status tidak boleh kosong.',
        ]);

        $path_image = $request->file('image')->store('blogs', 'public');

        Blog::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'image'       => $path_image,
            'content'     => $request->content,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.blogs.index');
    }

    public function uploadImageEditor(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('editor', 'public');
            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Upload failed'], 500);
    }

    private function cleanupEditorImages($newContent, $oldContent = '')
    {
        preg_match_all('/editor\/([^\s"\'\?<>#]+)/', $oldContent, $oldMatches);
        $oldImages = $oldMatches[1] ?? [];

        if (empty($oldImages)) {
            return;
        }

        foreach ($oldImages as $imageName) {
            if (!str_contains($newContent, $imageName)) {
                $path = 'editor/' . $imageName;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->image_name = basename($blog->image);
        $blog->image_size = Storage::disk('public')->size($blog->image);

        $api_tinymce_key = Setting::value('api_tinymce_key');

        return inertia('Admin/Blog/Edit', [
            'blog'            => $blog,
            'api_tinymce_key' => $api_tinymce_key,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'       => 'required|unique:blogs,title,' . $blog->id,
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'content'     => 'required',
            'status'      => 'required',
        ], [
            'title.unique'     => 'Judul sudah digunakan. Gunakan judul lain.',
            'image.image'      => 'Gambar blog harus berupa file gambar.',
            'image.mimes'      => 'Gambar blog harus berekstensi jpg, jpeg, png, atau webp.',
            'image.max'        => 'Ukuran gambar blog maksimal 10MB.',
            'content.required' => 'Konten tidak boleh kosong.',
            'status.required'  => 'Status tidak boleh kosong.',
        ]);

        $oldContent = $blog->content;

        $path_image = $blog->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('blogs', 'public');
        }

        $this->cleanupEditorImages($request->content, $oldContent);

        $blog->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'image'       => $path_image,
            'content'     => $request->content,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.blogs.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $this->cleanupEditorImages('', $blog->content);

        $blog->delete();

        return redirect()->route('admin.blogs.index');
    }
}
