<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Setting;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')->latest()->paginate(10);

        return inertia('User/Blog/Index', [
            'blogs'   => $blogs,
        ]);
    }

    public function show($slug)
    {
        $setting = Setting::first();
        $blog = Blog::where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $description = Str::limit(strip_tags($blog->content), 150);

        return inertia('User/Blog/Show', [
            'setting'     => $setting,
            'blog'        => $blog,
            'description' => $description,
            'current_url' => url()->current(),
            'app_url'     => rtrim($setting->site_url, '/'),
        ]);
    }
}
