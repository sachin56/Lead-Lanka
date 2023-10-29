<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    public function show(){
        $result =Book::all();

        return response()->json($result);
    }
}
