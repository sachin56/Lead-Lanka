<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Book;
use App\Models\User;
use App\Models\BookCategory;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $b_category = BookCategory::all();
        $user = User::all();
        return view('book')->with(['b_category'=>$b_category,'user'=>$user]);
    }

    public function create(){

        $result = Book::all();

        return DataTables::of($result)
                        ->addColumn('category_type', function(book $book){
                            return $book->category->book_type;
                        })
                        ->make(true);

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'book_name' => 'required',
            'auther_name' => 'required',
            'stock' => 'required',
            'category_type' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = new Book;
                $type->book_name = $request->book_name;
                $type->auther_name = $request->auther_name;
                $type->stock = $request->stock;
                $type->category_type = $request->category_type;
                $type->description = $request->description;
                $type->assign_user = $request->assign_user;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'Added New Book']);

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
            'book_name' => 'required',
            'auther_name' => 'required',
            'stock' => 'required',
            'category_type' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = Book::find($id);
                $type->book_name = $request->book_name;
                $type->auther_name = $request->auther_name;
                $type->stock = $request->stock;
                $type->category_type = $request->category_type;
                $type->description = $request->description;
                $type->assign_user = $request->assign_user;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'Book Updated']);

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

    public function assignbook(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'assignuser' => 'required',

        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = new BorrowedBook;
                $type->book_id = $request->id;
                $type->user_id = $request->assignuser;

                $type->save();

                $result = Book::find($request->id);
                $result->stock= $result->stock - 1;

                $result->save();

                DB::commit();
                return response()->json(['db_success' => 'Book Assign']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }
    }
}
