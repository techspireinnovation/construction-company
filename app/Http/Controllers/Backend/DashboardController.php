<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }
    public function indexProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('admin.profile.index', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'User not authenticated');
        }

        return view('admin.profile.edit', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'old_password' => 'nullable|required_with:password',
            'profile_image' => 'nullable|image|max:5120',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        /*
        |--------------------------------------------------------------------------
        | Password Update
        |--------------------------------------------------------------------------
        */
        if ($request->filled('password')) {

            if (!\Hash::check($request->old_password, $user->password)) {
                return back()->withErrors([
                    'old_password' => 'Old password is incorrect.'
                ]);
            }

            $data['password'] = bcrypt($request->password);
        }

        /*
        |--------------------------------------------------------------------------
        | Profile Image Upload via ImageService
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('profile_image')) {

            $data['profile_image'] = $this->imageService->replace(
                $user->profile_image,
                $request->file('profile_image'),
                'profile'
            );
        }

        $user->update($data);

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
