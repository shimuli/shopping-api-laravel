<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends ApiController
{
     public function __construct()
    {
        $this->middleware('client.credentials')->only(['resend']);
        $this->middleware('auth:api')->except(['resend', 'verify','store']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page') ?? 8;

        $users = User::paginate($perPage)->appends(
            [
                'per_page' => $perPage,
            ]
        );

       // return response()->json(['users' => $users], 200);
        return response()->json($users, 200);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10|unique:users',
            'password' => 'required|min:6',
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $users = User::create($data);

        return response()->json(['data' => $users], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$user = User::findOrFail($id);
        return response()->json(['user' => $user], 200);
       // return $this->showOne($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [

            'email' => 'email|unique:users,email,' . $user->id,
            'phone' => 'phone|digits:10|unique:users,phone,' . $user->id,
            'password' => 'min:6', // confirmed
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];
        $this->validate($request, $rules);

        if ($request->has('user_name')) {
            $user->user_name = $request->user_name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        // if ($request->has('phone')) {
        //     $user->verified = User::UNVERIFIED_USER;
        //     $user->verification_token = User::generateVerificationCode();
        //     $user->phone = $request->phone;
        // }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return $this->errorResponse('Only verified users are allowed to modify admin field', 409);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }
        $user->save();
        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        //return response()->json(['data' => $user], 200);

        return response()->json([
            "message" => 'Deleted Successfully','code'=>'204'
        ], 200);

    }

    // verify user

    public function verify($token){
        $user = User::where('verification_token', $token)->firstOrFail();
        $user->verified = User::VERIFIED_USER;
        $user->verification_token = 1;

        $user->save();

        return $this->showMessage("The account has been verified");
    }

    public function resend(User $user){
        if($user->isVerified()){
            return $this->errorResponse("This user is already verified", 409);
        }

        // retry after every 10 seconds five times before failing
         retry(5, function () use ($user) {
             //sed email method use in production
             Mail::to($user)->send(new UserCreated($user));
         }, 100);


        return $this->showMessage('The verification email was resend');
    }

}
