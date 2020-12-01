<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;

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
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Phone' => 'required|string|max:11|unique:users',
            'Sex' => 'required|string|max:10',
            'RoleId' => 'required|integer',
            'DeptId' => 'required|integer',
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
        return User::create([
            'FirstName' => $data['FirstName'],
            'LastName' => $data['FirstName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'Phone' => $data['Phone'],
            'Sex' => $data['Sex'],
            'RoleId' => $data['RoleId'],
            'DeptId' => $data['DeptId'],
            'PositionId' => $data['PositionId'],
            'LocationId' => $data['LocationId'],
            'WorkShopId' => $data['WorkShopId'],
            'VIP' => $data['VIP'],
            'Active' => $data['Active'],
            'name' => $data['name'],
            'CreatedBy' => $data['CreatedBy'],
        ]);
    }




}
