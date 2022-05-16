<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $user = Auth::guard('api')->user();
//        return response()->json(['user' => $user]);
        return User::latest()->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'   =>  'required|string|max:191',
            'email'  =>  'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ]);
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => $request->usertype,
            'bio' => $request->bio,
            'photo' => $request->photo,
            'password' => Hash::make($request->password),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return Auth::guard('api')->user(); // Or auth('api')->user();
    }

    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name'   =>  'required|string|max:191',
            'email'  =>  'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6',
        ]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return [
            'message' => 'User Deleted',
        ];
    }

    public function login(Request $request){
        $validation =  Validator::make($request->all(),[
            'email' =>  'required|email',
            'password' => 'required'
        ]);


        if($validation->fails()){
            return response()->json(['error' => $validation->errors()],422);
        }

        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            $user = Auth::user();
            $data['token_type'] = 'Bearer';
            $data['access_token'] = $user->createToken('MyApp')->accessToken;
            $data['user'] = $user;

            return response()->json($data,200);
        }

        return response()->json([
            'error' => 'Invalid Username Or Password',
        ]);


        }
}
