<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{

    public function editProfile()
    {
        return view('editprofile');
    }

    public function editPass()
    {
        return view('changepass');
    }

    public function saveProfile(Request $request)
    {
        Validator::extend('unique_user_update', function ($attribute, $value, $parameters, $validator) {
            $userExist = User::where('username', $value)
                ->where('id', '!=', auth()->user()->id)
                ->first();
            return !$userExist;
        });

        Validator::extend('unique_email_update', function ($attribute, $value, $parameters, $validator) {
            $emailExist = User::where('email', $value)
                ->where('id', '!=', auth()->user()->id)
                ->first();
            return !$emailExist;
        });

        // $baseImageName = auth()->user()->avatar;
        // $baseImagePath = 'public/user/';
        // $baseImageContents = Storage::get($baseImagePath . $baseImageName);

        // dd($baseImageContents);

        // $image = $request->file('avatar') ? $request->file('avatar') : $baseImageContents;

        // $request->avatar = $image;

        $request->validate([
            'username' => ['required', 'unique_user_update'],
            'email' => ['required', 'email', 'unique_email_update'],
        ], [
            'username.unique_user_update' => 'Username already exists.',
            'email.unique_email_update' => 'Email already exists.',
        ]);

        $user = User::find(auth()->user()->id);

        if ($request->file('avatar')) {

            $request->validate([
                'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'],
            ]);

            $file = $request->file('avatar');
            $newImageName = auth()->user()->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/user/' . $newImageName);
            $user->avatar = $newImageName;
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        $loginUser = User::find(auth()->user()->id);
        auth()->login($loginUser);
        return redirect('/profile')->with('success', 'Your profile has been updated!');
    }

    public function savePass(Request $request)
    {
        Validator::extend('oldpasscheck', function ($attribute, $value, $parameters, $validator) {
            $oldPassCheck = Hash::check($value, auth()->user()->password);
            return $oldPassCheck;
        });

        Validator::extend('not_same_pass', function ($attribute, $value, $parameters, $validator) {
            $oldPass = $validator->getData()['oldpassword'];
            return $oldPass != $value;
        });

        $request->validate([
            'oldpassword' => ['required', 'oldpasscheck'],
            'newpassword' => ['required', 'min:8', 'not_same_pass'],
            'confirmpassword' => ['required', 'min:8', 'same:newpassword'],
        ], [
            'oldpassword.oldpasscheck' => 'Old password is incorrect.',
            'newpassword.not_same_pass' => 'New password cannot be the same as the old password.',
            'confirmpassword.same' => 'Password does not match.',

        ]);

        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->newpassword);
        $user->save();

        auth()->logout();
        return redirect('/')->with('success', 'Your password has been changed!');


    }

    public function goProfile()
    {
        return view('profile');
    }

    public function viewProfile(Request $request)
    {
        return redirect('/profile');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You have successfully logged out!');
    }


    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('dashboard');
        } else {
            return view('homepage');
        }
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword']])) {
            $avatar = User::where('username', $request->loginusername)->first()
                ->avatar;
            $request->session()->put('avatar', $avatar);
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have successfully logged in!');
        } else {
            return redirect('/')->with('failure', 'Invalid login information!!!');
        }

    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:4', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);


        $user = User::create($incomingFields);
        $user->avatar = "no_image.png";
        $user->save();
        auth()->login($user);
        return redirect('/')->with('success', 'You have registered successfully! Welcome to Your Account!!!');
    }

    public function aboutPage()
    {
        return view('/about');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function goHome(Request $request)
    {
        return redirect('/');
    }

    public function goAbout(Request $request)
    {
        return redirect('/about');
    }
}