<?php

namespace App\Http\Controllers;

use App\Models\DangNhap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function postLogin(Request $request){
        $status = 401;

        $this->validate($request,
        [
            'name' =>'required',
            'password' =>'required|min:5|max:32',
        ]);

        $login = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $payload[$login] = $request->name;
        $payload['password'] = $request->password;

         if (Auth::attempt($payload)) {
            return "true";
         }

        return "false";

        // if(Auth::attempt(['name'=>$rq->name,'password'=>$rq->password])){
        //     $status = 200;
        // }

        // return $status;

        // if(Auth::attempt(['name'=>$rq->name,'password'=>$rq->password])){
        //     $status = 200;
        //     return response()->json([
        //         'user' => Auth::user(),
        //         'status' =>$status,
        //         'token' => Auth::user()->createToken('buiduy')->accessToken,
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'status' =>$status
        //     ]);
        // }
    }

        
    
}
