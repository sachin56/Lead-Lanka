<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use App\Models\Reader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ReaderController extends Controller
{
    //display admin login
    public function index(){
        if(Auth::guard('reader')->check()){
            return view('reader.reader-dashboard');
        }else{
            return view('reader.auth.reader-login');
        }    
    }

    public function dashboard(){
        $result = DB::table('borrowed_books')
                    ->join('books','books.id','=','borrowed_books.book_id')
                    ->select('books.book_name as bookname','books.auther_name')
                    ->get();
        return view('reader.reader-dashboard')->with(['result' => $result]);
    }
    
    public function checklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('reader')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('reader.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }

    public function readerlogout(){
        Auth::guard('reader')->logout();
        return redirect()->route('reader.dashboard')
                ->withSuccess('You have successfully logged in!');
    }

    public function register_index(){
        return view('reader.auth.reader-register');
    }

    public function register(Request $request){

            $request->validate([
                'name' => 'required|string|max:250',
                'email' => 'required|email|max:250|unique:users',
                'password' => 'required|min:8|confirmed'
            ]);
    
            Reader::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
    
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            $request->session()->regenerate();
            return redirect()->route('reader.reader-dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }
}