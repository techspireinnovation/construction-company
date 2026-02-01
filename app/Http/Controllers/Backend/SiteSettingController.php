<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    protected string $folderPath = 'SiteSettings';

    public function __construct()
    {
        if (!Storage::disk('public')->exists($this->folderPath)) {
            Storage::disk('public')->makeDirectory($this->folderPath);
        }
    }

    public function index()
    {
        $SiteSettings = SiteSetting::first();
        return view('admin.site_setting.index', compact('SiteSettings'));
    }

    public function edit()
    {
        $SiteSettings = SiteSetting::first() ?? new SiteSetting();
        return view('admin.site_setting.edit', compact('SiteSettings'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:100',
            'primary_mobile_no' => 'required|string|max:10',
            'secondary_mobile_no' => 'nullable|string|max:10',
            'primary_email' => 'required|email|max:100',
            'secondary_email' => 'nullable|email|max:100',
            'address' => 'required|string',
            'embedded_map' => 'required|string',
            'footer_text' => 'required|string',

            'logo_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'fav_icon_image' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:2048',

            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'whatsapp_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $SiteSettings = SiteSetting::first() ?? new SiteSetting();

        /* ---------------- Logo Upload ---------------- */
        $logoName = $SiteSettings->logo_image;
        if ($request->hasFile('logo_image')) {
            if ($logoName) {
                Storage::disk('public')->delete($this->folderPath . '/' . $logoName);
            }

            $logo = $request->file('logo_image');
            $logoName = time() . '_logo.' . $logo->extension();

            $image = Image::make($logo)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            Storage::disk('public')->put(
                $this->folderPath . '/' . $logoName,
                (string) $image->encode()
            );
        }

        /* ---------------- Favicon Upload ---------------- */
        $faviconName = $SiteSettings->fav_icon_image;
        if ($request->hasFile('fav_icon_image')) {
            if ($faviconName) {
                Storage::disk('public')->delete($this->folderPath . '/' . $faviconName);
            }

            $favicon = $request->file('fav_icon_image');
            $faviconName = time() . '_favicon.' . $favicon->extension();
            Storage::disk('public')->putFileAs(
                $this->folderPath,
                $favicon,
                $faviconName
            );
        }

        /* ---------------- Save Data ---------------- */
        $SiteSettings->fill([
            'company_name' => $request->company_name,
            'primary_mobile_no' => $request->primary_mobile_no,
            'secondary_mobile_no' => $request->secondary_mobile_no,
            'primary_email' => $request->primary_email,
            'secondary_email' => $request->secondary_email,
            'address' => $request->address,
            'embedded_map' => $request->embedded_map,
            'footer_text' => $request->footer_text,
            'logo_image' => $logoName,
            'fav_icon_image' => $faviconName,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'whatsapp_link' => $request->whatsapp_link,
            'linkedin_link' => $request->linkedin_link,
        ])->save();

        return redirect()
            ->route('admin.site_setting.index')
            ->with('success', 'Site SiteSettings updated successfully.');
    }
}
