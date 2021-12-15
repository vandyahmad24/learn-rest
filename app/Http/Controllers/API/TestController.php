<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Helpers\MerubahRpJadiAngka;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class TestController extends Controller
{
    public function index()
    {
        // validator 
        $angka = MerubahRpJadiAngka::ChangeRpAngka("Rp. 50.000");
        $angka1 = MerubahRpJadiAngka::ChangeRpAngka("Rp. 90.000");
        $total = $angka+$angka1;
        // username required
        // return response()->json("username required",400);
        return ResponseFormatter::success(["username"=>"vandy Ahmad","uang"=>$total],"user berhasil");
        // return $response;
    }
    public function post(Request $request)
    {   
        $validasi = $this->validationRequest($request->all());
        if($validasi!=null){
            return ResponseFormatter::error($validasi,"input kurang");
        }

        // bisnis 
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return ResponseFormatter::success($user,"user berhasil mendaftar");
    }
    public function put(Request $request, $id)
    {
        $validasi = $this->validationRequest($request->all());
        if($validasi!=null){
            return ResponseFormatter::error($validasi,"input kurang");
        }

        // bisnis logic
        $data = $request->all();
        $user=User::find($id);
        $user->update($data);
        return ResponseFormatter::success($user,"user berhasil mengupdate");
    }
    public function delete($id)
    {
        $user=User::find($id);
        $user->delete();
        return ResponseFormatter::success(null,"berhasil menghapus user");
    }

    public function validationRequest($request)
    {
        $validator = Validator::make($request, [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $validator->messages();
        }else{
            return null;
        }
      
    }
}
