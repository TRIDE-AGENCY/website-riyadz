<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return inertia('Admin/Setting/Index', [
            'setting' => $setting,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title'       => 'required',
            'site_url'         => 'required',
            'site_logo'        => 'nullable|image|max:10240',
            'site_favicon'     => 'nullable|image|max:10240',
            'email'            => 'required|email',
            'instagram'        => 'required|url',
            'linkedin'         => 'required|url',
            'meta_title'       => 'required',
            'meta_description' => 'required',
            'meta_keywords'    => 'required',
            'og_title'         => 'required',
            'og_description'   => 'required',
            'og_image'         => 'nullable|image|max:10240',
            'api_tinymce_key'   => 'required', 
            'ga_property_id'    => 'nullable|string',
            'ga_measurement_id' => 'nullable|string',
        ]);

        $setting = Setting::first();

        if ($request->hasFile('site_logo')) {
            if (!empty($setting->site_logo) && Storage::disk('public')->exists(str_replace('/storage/', '', $setting->site_logo))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $setting->site_logo));
            }
            $logoPath = $request->file('site_logo')->store('setting', 'public');
        } else {
            $logoPath = $request->input('site_logo_old') ?? ($setting->site_logo ?? null);
        }

        if ($request->hasFile('site_favicon')) {
            if (!empty($setting->site_favicon) && Storage::disk('public')->exists(str_replace('/storage/', '', $setting->site_favicon))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $setting->site_favicon));
            }
            $faviconPath = $request->file('site_favicon')->store('setting', 'public');
        } else {
            $faviconPath = $request->input('site_favicon_old') ?? ($setting->site_favicon ?? null);
        }

        if ($request->hasFile('og_image')) {
            if (!empty($setting->og_image) && Storage::disk('public')->exists(str_replace('/storage/', '', $setting->og_image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $setting->og_image));
            }
            $imagePath = $request->file('og_image')->store('setting', 'public');
        } else {
            $imagePath = $request->input('og_image_old') ?? ($setting->og_image ?? null);
        }

        $setting->update([
            'site_title'         => $request->site_title,
            'site_url'           => $request->site_url,
            'site_logo'          => $logoPath,
            'site_favicon'       => $faviconPath,
            'email'              => $request->email,
            'instagram'          => $request->instagram,
            'linkedin'           => $request->linkedin,
            'meta_title'         => $request->meta_title,
            'meta_description'   => $request->meta_description,
            'meta_keywords'      => $request->meta_keywords,
            'og_title'           => $request->og_title,
            'og_description'     => $request->og_description,
            'og_image'           => $imagePath,
            'api_tinymce_key'    => $request->api_tinymce_key,
            'ga_property_id'     => $request->ga_property_id,
            'ga_measurement_id'  => $request->ga_measurement_id,
        ]);

        return redirect()->route('admin.settings.index');
    }
}
