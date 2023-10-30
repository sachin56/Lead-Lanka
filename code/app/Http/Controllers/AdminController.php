<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reader;

class AdminController extends Controller
{
    //display admin login
    public function index(){
        if(Auth::guard('admin')->check()){
            $category = BookCategory::count();
            $book = Book::count();
            $staffuser = User::count();
            $reader = Reader::count();
            return view('admin.admin-dashboard')->with(['category'=>$category,'book'=>$book,'staffuser'=>$staffuser,'reader'=>$reader]);
        }else{
            return view('admin.auth.admin-login');
        }    
    }

    public function dashboard(){
        $category = BookCategory::count();
        $book = Book::count();
        $staffuser = User::count();
        $reader = Reader::count();
        return view('admin.admin-dashboard')->with(['category'=>$category,'book'=>$book,'staffuser'=>$staffuser,'reader'=>$reader]);
    }
    
    public function checklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('admin')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }

    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.dashboard')
                ->withSuccess('You have successfully logged in!');
    }


}
