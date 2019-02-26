<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'scpbzcode' => ['required', Rule::in([env('SCP_BZ_CODE')])],
            'wikidotusername' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // Make our new user.
        $newuser = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'wikidotusername' => $data['wikidotusername'],
            'metadata' => json_encode([], JSON_FORCE_OBJECT)
        ]);

        // Stick them in the 'Everyone' group.
        DB::table('group_membership')->insert([
                'group_id' => DB::table('groups')->where('name', 'Everyone')->pluck('id')->first(), // Parent group
                'member_type' => 'App\User', // Child member type (User or Group)
                'member_id' => $newuser->id, // Child user
                'metadata' => json_encode([], JSON_FORCE_OBJECT)
            ]);

        // Calculate their new permissions.
        $newuser->recursememberships();

        // Return the expected user object.
        return $newuser;
    }
}
