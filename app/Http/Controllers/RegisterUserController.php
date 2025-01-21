<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'profile_image_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (request()->hasFile('profile_image_url')) {
            $file = request()->file('profile_image_url');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/profile_images/';
            $file->move($path, $filename);
            $attributes['profile_image_url'] = $path . $filename;
        } else {
            $attributes['profile_image_url'] = 'uploads/profile_images/no_image.jpg';
        }

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/posts');
    }

    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(User $user)
    {
        $image_url = 'uploads/profile_images/no_image.jpg';
        $attributes = request()->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if (request()['profile_image_url'] == 'no.jpg') {
            $attributes['profile_image_url'] = $image_url;
        } else {
            $attributes['profile_image_url'] = request('profile_image_url');
        }
        if (request()->hasFile('profile_image_url')) {
            $file = request()->file('profile_image_url');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/profile_images/';
            $file->move($path, $filename);
            $attributes['profile_image_url'] = $path . $filename;
        } elseif ($attributes['profile_image_url'] != $image_url) {
            $attributes['profile_image_url'] = $user->profile_image_url;
        }
        $user->update($attributes);
        return redirect('/posts');
    }

    public function promotion(User $user){
        Auth::user()->can('superadmin');
        $user->update(['status' => 'admin']);
        return redirect('/authors');
    }

    public function removeadmin(User $user){
        Auth::user()->can('superadmin');
        $user->update(['status' => 'author']);
        return redirect('/authors');
    }

}
