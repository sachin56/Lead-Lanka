<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('book-category');
    }

    public function create(){

        $result = Book::all();

        return DataTables($result)->make(true);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'book_type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = new Book;
                $type->book_type = $request->book_type;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'Added New Book Category']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }


    }

    public function show($id){
        $result = Book::find($id);

        return response()->json($result);

    }

    public function update(Request $request,string $id){

        $validator = Validator::make($request->all(), [
            'book_type' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = Book::find($id);
                $type->book_type = $request->book_type;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'Book Category Updated']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }

    }

    public function destroy(string $id){

        $result = Book::destroy($id);

        return response()->json($result);
    }
}
