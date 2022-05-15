<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        $this->middleware('api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $request->validate([
            'email' =>  'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)) {
            $token = Str::random(64);

            $user->api_token = $token;
            $user->save();

            return [
                'token' => $token,
            ];
        }

        return response()->json([
            'error' => 'Invalid Username Or Password',
        ]);


        }
}
