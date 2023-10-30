<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.admin-user');
    }

    public function create(){

        $result = User::all();

        return DataTables($result)->make(true);

    }

    public function show($id){
        $result = User::find($id);

        return response()->json($result);

    }

    public function update(Request $request,string $id){

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['validation_error' => $validator->errors()->all()]);
        }else{
            try{
                DB::beginTransaction();

                $type = User::find($id);
                $type->status = $request->status;

                $type->save();

                DB::commit();
                return response()->json(['db_success' => 'User Status Updated']);

            }catch(\Throwable $th){
                DB::rollback();
                throw $th;
                return response()->json(['db_error' =>'Database Error'.$th]);
            }

        }

    }

    public function destroy(string $id){

        $result = User::destroy($id);

        return response()->json($result);
    }
}
