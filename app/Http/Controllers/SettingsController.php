<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('settings.index', ['user' => auth()->user()]);
    }

    public function store()
    {
        $this->validate(request(), [
            'first_name' => 'nullable|alpha|max:45',
            'last_name'	 => 'nullable|alpha|max:45',
            'location'	 => 'max:60',
            'about'		 => 'max:120',
            'sex'		 => 'in:none,male,female',
            'email'		 => 'required|email|unique:users,email,'.auth()->id(),
            'birthday'	 => 'nullable|date',
            'facebook'	 => 'max:80',
            'twitter'	 => 'max:80',
            'website'	 => 'nullable|url'
        ]);

        auth()->user()->update([
            'first_name' => request('first_name'),
            'last_name'	 => request('last_name'),
            'location'	 => request('location'),
            'about'		 => request('about'),
            'sex'		 => request('sex'),
            'email'		 => request('email'),
            'birthday'	 => request('birthday'),
            'facebook'	 => request('facebook'),
            'twitter'	 => request('twitter'),
            'website' 	 => request('website')
        ]);

        return back()->with('info', 'Your personal info has been updated.');
    }

    /**
     * Update user avatar and cover image
     * @return Illuminate\Http\Response
     */
    public function avatarAndCover()
    {
        $this->validate(request(), [
            'avatar'	=> 'nullable|active_url',
            'cover'		=> 'nullable|active_url'
        ]);

        auth()->user()->update([
            'avatar'	=> request('avatar'),
            'cover'		=> request('cover')
        ]);

        return back()->with('info', 'Your avatar and cover has been succsesfuly updated.');
    }

    /**
     * Change user password
     * @return Illuminate\Http\Response
     */
    public function password()
    {
        // Check if the "old_password" input isn't matches the user password.
        if (!Hash::check(request()->old_password, auth()->user()->password)) {
            return back()->withErrors(['old_password' => 'The password is wrong.']);
        }

        $this->validate(request(), [
            'old_password'	=> 'required',
            'new_password'	=> 'required|confirmed|min:6|different:old_password'
        ]);

        auth()->user()->update(['password' => bcrypt(request('new_password'))]);

        return back()->with('info', 'You changed your password succsesfuly.');
    }

    /**
     * Update user signature
     * @return Illuminate\Http\Response
     */
    public function signature()
    {
        $this->validate(request(), [
            'signature'	=> 'nullable'
        ]);

        auth()->user()->update([
            'signature' => request('signature')
        ]);

        return back()->with('info', 'Your signature updated.');
    }
}
