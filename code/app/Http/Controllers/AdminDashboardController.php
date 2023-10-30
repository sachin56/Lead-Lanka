<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Reader;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $category = BookCategory::count();
        $book = Book::count();
        $staffuser = User::count();
        $reader = Reader::count();
        return view('admin.admin-dashboard')->with(['category'=>$category,'book'=>$book,'staffuser'=>$staffuser,'reader'=>$reader]);
    }

}
