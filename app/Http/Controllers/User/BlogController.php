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

        $sessionKey = 'viewed_blog_' . $blog->id;
        if (!session()->has($sessionKey)) {
            $blog->increment('views');
            session()->put($sessionKey, true);
        }

        $description = Str::limit(strip_tags($blog->content), 150);

        return inertia('User/Blog/Show', [
            'setting'     => $setting,
            'blog'        => $blog,
            'description' => $description,
            'current_url' => url()->current(),
            'app_url'     => rtrim($setting->site_url, '/'),
        ])->withViewData([
            'meta_title'       => $blog->title . ' − ' . $setting->site_title,
            'meta_description' => $description,
            'meta_image'       => asset('storage/' . $blog->image),
            'meta_url'         => url()->current(),
        ]);
    }
}
